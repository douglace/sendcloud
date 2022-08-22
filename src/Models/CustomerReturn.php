<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

namespace Anthony\Sendcloud\Models;

use Address;
use Anthony\Sendcloud\Sendcloud\Classes\Address as ClassesAddress;
use Anthony\Sendcloud\Sendcloud\Classes\CreateReturn;
use Anthony\Sendcloud\Sendcloud\Classes\ParcelItem;
use Anthony\Sendcloud\Sendcloud\Classes\ShipWidth;
use Anthony\Sendcloud\Sendcloud\Classes\ValidateReturn;
use Anthony\Sendcloud\Mollie\Mollie;
use Carrier;
use DateTime;
use Db;
use Tools;
use Order;
use DbQuery;
use Context;
use Customer;
use Mollie\Api\Types\PaymentStatus;
use PDOStatement;
use mysqli_result;
use PrestaShopDatabaseException;
use Validate;

class CustomerReturn {

    private static $table = 'sc_returns';

    /**
     * @param int $id_customer
     *
     * @return array|false|mysqli_result|PDOStatement|resource|null
     *
     * @throws PrestaShopDatabaseException
     */
    public static function getReturns($id_customer) {
        $q = new DbQuery();
        $q->select('a.*, o.reference, o.total_paid_tax_incl amount')
            ->from(self::$table, 'a')
            ->leftJoin('orders', 'o', 'o.id_order=a.id_order')
            ->where('o.id_customer='.$id_customer)
        ;

        return array_map(function($a){
            $a['amount'] = Tools::displayPrice($a['amount']);
            $date = new DateTime($a['date_add']);
            $a['date_add'] = $date->format('Y-m-d H:i:s');
            $a['link'] = Context::getContext()->link->getModuleLink('sendcloud', 'returns', ["view" => $a['order_return']]);
            return $a;
        }, Db::getInstance()->executeS($q));
    }

    public static function getCustomerOrders($id_customer) {
        $q = new DbQuery();
        $q->select('o.id_order, o.reference')
            ->from('orders', 'o')
            ->where('o.id_customer='.$id_customer)
            ->where('NOT EXISTS(
                SELECT 1 FROM `'._DB_PREFIX_.self::$table.'` a WHERE a.id_order = o.id_order
            )')
        ;

        return Db::getInstance()->executeS($q);
    }

    /**
     * @param int $id_order
     * @param array $productsToReturn
     */
    public static function addCustomerReturn($id_order, $productsToReturn, $buy_return_fees = false) {

        if(empty($productsToReturn)) {
            return false;
        }

        $order = new Order($id_order);
        $context = Context::getContext();
        $trans = $context->getTranslator();

        if(!Validate::isLoadedObject($order)) {
            return [
                'success' => false,
                'msg' => $trans->trans('Cette commande n\'existe pas', [], 'Module.Sendcloud.Admin')
            ];
        }
        
        $returns = new CreateReturn();
        $returns->setWeight((float)$order->getTotalWeight())
            ->setOrderNumber($order->reference)
            ->setExternalReference($order->reference)
            ->setOrderTotalValue((float)$order->total_discounts_tax_incl)
        ;

        $deliveryAddress = new Address($order->id);
        $customer = new Customer($order->id_customer);

        $addresFrom = ClassesAddress::createFromPrestashopAddress($deliveryAddress, $customer->email);
        $returns->setAddressFrom($addresFrom);

        $addresTo = ClassesAddress::createAdminPrestashopAddress();
        $returns->setAddressTo($addresTo);



        $carrier = Carrier::getCarrierByReference($order->id_carrier);
        $ship_width = new ShipWidth();
        $ship_width->setCarrier($carrier->name)->setLabelles(true);
        $returns->setShipWidth($ship_width);


        $products = $order->getProducts();
        
        foreach($products as $product){
            if(in_array($product['product_id'], $productsToReturn)) {
                $parcelItem = new ParcelItem();
                $parcelItem->setDescription($product['product_name'])
                    ->setQuantity((int)$product['product_quantity'])
                    ->setWeight((float)$product['weight'])
                    ->setValue((float)$product['product_price'])
                    ->setProductId((int)$product['product_id'])
                ;
                $returns->addParcelItem($parcelItem);
            }
        }

        $validate = ValidateReturn::validate($returns);

        
        if(isset($validate->is_valid)) {
            $cr = $returns->exec();
            self::addProductReturned($cr->return, $productsToReturn);

            $data = [
                'order_return' => $cr->return,
                'id_order' => $order->id,
                'id_customer' => $order->id_customer,
                'date_add' => date('Y-m-d H:i:s')
            ];

            $link = Context::getContext()->link->getModuleLink('sendcloud', 'returns', [
                "return" => $order->reference, 
                'successAdd' => 1
            ]);
            
            if($buy_return_fees) {
                $mollie = Mollie::getInstance();

                $mollie->setRedirect(
                    $context->link->getModuleLink('sendcloud', 'redirectmollie', ['redirect' => 1,'return_id' => $cr->return,'id_order' => $order->id,])
                )->setRedirect(
                    $context->link->getModuleLink('sendcloud', 'redirectmollie', ['webhook' => 1,'return_id' => $cr->return,'id_order' => $order->id])
                )->setMetadata([
                    'id_order' => $order->id,
                ]);

                $cp = $mollie->createPayments();
                
                $data["payment_fees_id"] = $cp->id;
                $data["fees"] = (float)$mollie->getFees();
                $data["buy_fees"] = 1;

                $link = $cp->_links->checkout->href;
            }

            self::saveReturn($data);
            Tools::redirect($link);
        } else {
            $link = $context->link->getModuleLink('sendcloud', 'addreturn', ['id_order' => $order->id, 'error_add' => 1]);
            Tools::redirect($link);
        }

    }

    /**
     * @param int $data
     */
    public static function saveReturn($data) {
        return Db::getInstance()->insert('sc_returns', $data);
    }

    public static function addProductReturned($id_return, $products) {
        $data = [];
        foreach($products as $product){
            $data[] = [
                'id_return' => $id_return,
                'id_product' => $product,
            ];
        }

        return Db::getInstance()->insert('sc_returns_detail', $data, false, true, Db::INSERT_IGNORE);
    }

    /**
     * @param int $id_customer
     * @return array|null
     */
    public static function getOrdersToReturns($id_customer) {
        if(!$id_customer) {
            return [];
        }
        $q = new DbQuery();
        $q->select('o.reference, o.id_order')
            ->from('orders', 'o')
            ->where('o.id_customer='.$id_customer)
            ->where('o.date_add > NOW() - INTERVAL 46 DAY')
            ->where('NOT EXISTS(
                SELECT 1 FROM `'._DB_PREFIX_.'sc_returns` a where a.id_order = o.id_order
            )')
        ;

        return Db::getInstance()->executeS($q);
    }

    /**
     * @param int $id_order
     * @return bool
     */
    public static function isLoadReturnableOrder($id_order) {
        $q = new DbQuery();
        $q->select('1')
            ->from('orders', 'o')
            ->where('o.id_order='.$id_order)
            ->where('o.date_add > NOW() - INTERVAL 46 DAY')
            ->where('NOT EXISTS(
                SELECT 1 FROM `'._DB_PREFIX_.'sc_returns` a where a.id_order = o.id_order
            )')
        ;
        return (bool)Db::getInstance()->getValue($q);
    }

    public static function getReturnByIdOrderReturn($id_return) {
        $q = new DbQuery();
        $q->select('a.*, o.reference, o.total_paid_tax_incl amount')
            ->from(self::$table, 'a')
            ->leftJoin('orders', 'o', 'o.id_order=a.id_order')
            ->where('a.order_return='.$id_return)
        ;

        $returned = Db::getInstance()->getRow($q);
        if($returned && !empty($returned)) {
            $returned['fees'] = Tools::displayPrice((int)$returned['fees']);
            $returned['state'] = self::getReturnStateName((int)$returned['buy_fees_state']);
        }
        
        return $returned;
    }

    public static function getReturnByIdOrder($id_order) {
        $q = new DbQuery();
        $q->select('a.*, o.reference, o.total_paid_tax_incl amount')
            ->from(self::$table, 'a')
            ->leftJoin('orders', 'o', 'o.id_order=a.id_order')
            ->where('o.id_order='.$id_order)
        ;
        return Db::getInstance()->getRow($q);
    }

    public static function setPaymentState($id_return, $state) {
        return Db::getInstance()->update(self::$table, [
            'buy_fees_state' => self::getReturnStateID($state)
        ], 'order_return='.$id_return);
    }

    public static function getReturnStateID($state) {
        $state_id = 0;
        switch($state) {
            case $state == PaymentStatus::STATUS_PENDING:
                $state_id = 0;
                break;
            case $state == PaymentStatus::STATUS_PAID:
                $state_id = 1;
                break;
            case $state == PaymentStatus::STATUS_FAILED:
                $state_id = 2;
                break;
            case $state == PaymentStatus::STATUS_EXPIRED:
                $state_id = 3;
                break;
            case $state == PaymentStatus::STATUS_CANCELED:
                $state_id = 4;
                break;
        }
        return $state_id;
    }

    public static function getReturnStateName($state) {

        $context = Context::getContext();
        $trans = $context->getTranslator();
        $state_id = $trans->trans('En attente', [], 'Module.Sendcloud.Admin');
        switch($state) {
            case $state == 0:
                $state_id = $trans->trans('En attente', [], 'Module.Sendcloud.Admin');
                break;
            case $state == 1:
                $state_id = $trans->trans('Payé', [], 'Module.Sendcloud.Admin');
                break;
            case $state == 2:
                $state_id = $trans->trans('Echec de paiement', [], 'Module.Sendcloud.Admin');
                break;
            case $state == 3:
                $state_id = $trans->trans('Paiement Expirer', [], 'Module.Sendcloud.Admin');
                break;
            case $state == 4:
                $state_id = $trans->trans('Annulé', [], 'Module.Sendcloud.Admin');
                break;
        }
        return $state_id;
    }

    public static function getReturnedProducts($id_return, $id_lang = null){
        $id_lang = $id_lang ? $id_lang : Context::getContext()->language->id;

        $q = new DbQuery();
        $q->select('a.id_product, b.name')
            ->from(self::$table.'_detail', 'a')
            ->leftJoin(self::$table, 'r', 'r.order_return=a.id_return')
            ->leftJoin('product_lang', 'b', 'b.id_product=a.id_product')
            ->where('r.order_return='.$id_return)
            ->where('b.id_lang='.$id_lang)
        ;
        return Db::getInstance()->executeS($q);
    }
}