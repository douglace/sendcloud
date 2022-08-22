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

use Anthony\Sendcloud\Models\CustomerReturn;
use Anthony\Sendcloud\Mollie\Mollie;

class sendcloudRedirectmollieModuleFrontController extends ModuleFrontController
{

    /**
     * @var Order
     */
    public $order;

    public function init() {
        parent::init();
        
        $id_order = Tools::getValue('id_order');
        $this->order = new Order($id_order);

        if(!Validate::isLoadedObject($this->order)) {
            Tools::redirect(
                $this->context->link->getPageLink('index')
            );
        }
        
        $returned = CustomerReturn::getReturnByIdOrder($id_order);

        if(!empty($returned) && $returned) {
            if(isset($returned['payment_fees_id']) && $returned['payment_fees_id']) {
                $payment = Mollie::getInstance()->getPayment($returned['payment_fees_id']);
                CustomerReturn::setPaymentState($returned['order_return'], $payment->status);
            }
            
            Tools::redirect(
                $this->context->link->getModuleLink($this->module->name, 'returns', ['view' => $returned['order_return']])
            );
        } else {
            Tools::redirect(
                $this->context->link->getPageLink('index')
            );
        }
        
    }
}