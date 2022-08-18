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

    public function init() {
        parent::init();
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addJS($this->module->getPathUri().'public/front.module.js');
        $this->addCSS($this->module->getPathUri().'public/front.css');
    }

    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign([
            'returns' => CustomerReturn::getReturns($this->context->customer->id)
        ]);
        $this->setTemplate('module:sendcloud/views/templates/front/returns.tpl');
    }
}