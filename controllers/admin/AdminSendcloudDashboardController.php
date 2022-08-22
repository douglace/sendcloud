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

if(!class_exists('ReturnModel'));
    require_once _PS_MODULE_DIR_.'sendcloud/classes/ReturnModel.php';

use Anthony\Sendcloud\Models\CustomerReturn;

class AdminSendcloudDashboardController extends ModuleAdminController {

    /**
     * @var ReturnModel
     */
    public $object;

    public function __construct()
    {
        $this->table = 'sc_returns';
        $this->className = 'ReturnModel';
        $this->lang = false;
        $this->bootstrap = true;

        $this->deleted = false;
        $this->allow_export = true;
        $this->list_id = 'sc_returns';
        $this->identifier = 'id_sc_returns';
        $this->_defaultOrderBy = 'id_sc_returns';
        $this->_defaultOrderWay = 'ASC';
        $this->context = Context::getContext();

        $this->addRowAction('view');

        $this->_select = 'o.reference, o.total_paid_tax_incl amount, CONCAT_WS(" ", cu.firstname, cu.lastname) customer';
        
        $this->_join = 'LEFT JOIN `'._DB_PREFIX_.'orders` o on o.id_order=a.id_order ';
        $this->_join .= 'LEFT JOIN `'._DB_PREFIX_.'customer` cu on o.id_customer=cu.id_customer ';

        parent::__construct();

        $buy_fees = [
            '1' => "Oui",
            '0' => "Non",
        ];

        $this->fields_list = array(
            'id_sc_returns'=>array(
                'title' => $this->trans('ID', [], 'Modules.Severalcardpayment.Admin'),
                'align'=>'center',
                'class'=>'fixed-width-xs'
            ),
            'reference'=>array(
                'title'=>$this->trans('Commande', [], 'Modules.Severalcardpayment.Admin'),
                'width'=>'auto'
            ),
            'customer'=>array(
                'title'=>$this->trans('Client', [], 'Modules.Severalcardpayment.Admin'),
                'width'=>'auto',
                'filter_key' => 'cu!firstname',
            ),
            'buy_fees'=>array(
                'title'=>$this->trans('Frais de retour payer', [], 'Modules.Severalcardpayment.Admin'),
                'callback'=>'buyFees',

                'type' => 'select',
                'color' => 'color',
                'list' => $buy_fees,
                'filter_key' => 'a!buy_fees',
                'filter_type' => 'int',
                'order_key' => 'buy_fees',
            ),
            'date_add'=>array(
                'title'=>$this->trans('Date de création', [], 'Modules.Severalcardpayment.Admin'),
                'type'=>'datetime',
                'width'=>'auto',
            )
        );
    }

    public function buyFees($id, $row) {
        if($id) {
            return '<span>Oui</span>';
        }
        return '<span>Non</span>';
    }

    public function renderView() {
        if(!Validate::isLoadedObject($this->object)) {
            return;
        }
        
        $returned = CustomerReturn::getReturnByIdOrderReturn($this->object->order_return);
        $order = new Order($this->object->id_order);
        $products = CustomerReturn::getReturnedProducts($this->object->order_return);
        $this->context->smarty->assign([
            'return' => $returned,
            'products' => $products,
        ]);
        $this->setTemplate('return.tpl');
        return parent::renderview();
    }

}