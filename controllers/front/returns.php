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
class sendcloudReturnsModuleFrontController extends ModuleFrontController
{

    public $auth = true;
    public $returned;
    public $products;
    public $returns;

    public function init() {
        parent::init();

        $id_customer = $this->context->customer->id;
        if(Tools::isSubmit('view')) {
            $this->returned = CustomerReturn::getReturnByIdOrderReturn(Tools::getValue('view'));
            $order = new Order($this->returned['id_order']);
            if($order->id_customer != $id_customer) {
                Tools::redirectLink($this->context->link->getModuleLink($this->module->name, 'returns'));
            }
            $this->products = CustomerReturn::getReturnedProducts(Tools::getValue('view'));

        } else {
            $this->returns = CustomerReturn::getReturns($id_customer);
            $this->setTemplate('module:sendcloud/views/templates/front/returns.tpl');
        }
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addJS($this->module->getPathUri().'public/front.js');
        $this->addCSS($this->module->getPathUri().'public/front.css');
    }

    public function initContent()
    {
        parent::initContent();
        
        if(Tools::isSubmit('view')) {
            $this->context->smarty->assign([
                'return' => $this->returned,
                'products' => $this->products,
            ]);
    
            $this->setTemplate('module:sendcloud/views/templates/front/return.tpl');
        } else {
            $this->context->smarty->assign([
                'returns' => $this->returns
            ]);
    
            $this->setTemplate('module:sendcloud/views/templates/front/returns.tpl');
        }
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();
        
        $breadcrumb['links'][] = [
            'title' => $this->trans('Mes retours', [], 'Module.Sendcloud.Return'),
            'url' => $this->context->link->getModuleLink($this->module->name, 'returns'),
        ];

        if(Tools::isSubmit('view')) {
            $breadcrumb['links'][] = [
                'title' => $this->returned['reference'],
                'url' => "#",
            ];
        }

        return $breadcrumb;
    }
}