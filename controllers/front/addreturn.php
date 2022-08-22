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

class sendcloudAddreturnModuleFrontController extends ModuleFrontController
{

    public $auth = true;

    /**
     * @var Order
     */
    public $order;

    public $products;

    public function init() {
        parent::init();
        $id_order = Tools::getValue('id_order');
        $this->order = new Order($id_order);
        if(!Validate::isLoadedObject($this->order) || !CustomerReturn::isLoadReturnableOrder($id_order)) {
            Tools::redirect(
                $this->context->link->getPageLink('index')
            );
        }

        if(Tools::isSubmit('createReturn')) {
            CustomerReturn::addCustomerReturn($id_order, Tools::getValue('products'), (bool)Tools::getValue('buy_return_fees'));
            
        }

        $this->products = $this->order->getProducts();

        
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS($this->module->getPathUri().'public/front.css');
    }

    public function initContent()
    {
        parent::initContent();
        
        $currency = new Currency($this->order->id_currency);
        $order_date = new DateTime($this->order->date_add);
        $state = new OrderState($this->order->current_state, $this->context->language->id);

        $this->context->smarty->assign(array(
            'order' => $this->order,
            'order_date' => $order_date->format('d/m/Y'),
            'state' => $state->name,
            'state_color' => $state->color,
            'order_total_price' => Tools::displayPrice($this->order->total_paid_tax_incl, $currency),
            'products' => $this->products,
            'action' => $this->context->link->getModuleLink($this->module->name, 'addreturn', ['id_order' => $this->order->id, 'createReturn' => 1])
        ));
        
        $this->setTemplate('module:sendcloud/views/templates/front/addreturn.tpl');
    }
}