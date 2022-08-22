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
use Anthony\Sendcloud\Sendcloud\Classes\CancelReturn;
use Anthony\Sendcloud\Sendcloud\Classes\Lists;
use Anthony\Sendcloud\Sendcloud\Classes\ReturnItem;
use Anthony\Sendcloud\Sendcloud\Classes\CreateReturn;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(_PS_MODULE_DIR_. 'sendcloud/vendor/autoload.php')) {
    require_once _PS_MODULE_DIR_.  'sendcloud/vendor/autoload.php';
}

class Sendcloud extends Module
{
    /**
     * @param array $tabs
     */
    public $tabs = [];

    /**
     * @param Anthony\Sendcloud\Repository $repository
     */
    protected $repository;

    public function __construct()
    {
        $this->name = 'sendcloud';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'bewebcreation';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        $this->tabs = array(
            array(
                'name'=> $this->trans('SendCloud', array(), 'Modules.Severalcardpayment.Admin'),
                'class_name'=>'AdminParentSendcloud',
                'parent'=>'AdminParentModulesSf',
            ),
            array(
                'name'=> $this->trans('Dashboard', array(), 'Modules.Severalcardpayment.Admin'),
                'class_name'=>'AdminSendcloudDashboard',
                'parent'=>'AdminParentSendcloud',
            )
        );
        $this->repository = new Anthony\Sendcloud\Repository($this);

        parent::__construct();

        $this->displayName = $this->l('Gestion des retours');
        $this->description = $this->l('Permet au marchand de gérer les retours clients');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        return parent::install() && $this->repository->install();
    }

    public function uninstall()
    {
        return parent::uninstall() && $this->repository->uninstall();
    }

    public function getContent() {
        $this->postProcess();
        $this->assignValues();

        return $this->fetch('module:'.$this->name.'/views/templates/admin/configure.tpl');
    }

    public function assignValues() {
        $configs = array_merge(
            $this->getMollieConfig(),
            $this->getGlobalConf(),
        );
        $data = [];
        foreach($configs as $conf) {
            $data[$conf] = Configuration::get($conf);
        }
        $this->context->smarty->assign($data);
    }

    public function getMollieConfig() {
        return [
            'SC_API_MOLLIE_LIVE',
            'SC_API_MOLLIE_TEST',
            'SC_API_MOLLIE_FEES',
        ];
    }

    public function getGlobalConf() {
        return [
            'SC_USERNAME',
            'SC_PASSWORD',
            'SC_LIVE_MODE',
        ];
    }

    public function postProcess() {
        if(Tools::isSubmit('submitConfigMollie')) {
            foreach($this->getMollieConfig() as $conf) {
                Configuration::updateValue($conf, Tools::getValue($conf));
            }
        }

        if(Tools::isSubmit('submitConf')) {
            foreach($this->getGlobalConf() as $conf) {
                Configuration::updateValue($conf, Tools::getValue($conf));
            }
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path.'public/index.js');
            $this->context->controller->addCSS($this->_path.'public/index.css');
            //$this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
       if(Tools::getValue('controller') == "history") {
            Media::addJsDef(array(
                'toreturns' => $this->getReturned()
            ));
            $this->context->controller->addJS($this->_path.'public/history.js');
       }

       /**
        * 
        *$this->context->controller->addJS($this->_path.'/views/js/front.js');
        *$this->context->controller->addCSS($this->_path.'/views/css/front.css');
        */
    }

    public function getReturned() {
        $self = $this;
        return array_map(function($a)use($self){
            $link = $self->context->link->getModuleLink($self->name, 'addreturn', ['id_order' => $a['id_order']]);
            return [
                'reference' => $a['reference'],
                'button' => '<a href="'.$link.'"><i class="material-icons">&#xE860;</i>'.$this->l('Retourner').'</a>'
            ];
        }, CustomerReturn::getOrdersToReturns($this->context->customer->id));
    }

    public function hookDisplayCustomerAccount()
    {
        $my_return_link = $this->context->link->getModuleLink($this->name, 'returns');
        $this->context->smarty->assign(array(
            'my_return_link' => $my_return_link
        ));
        return $this->display(__FILE__, 'myaccount.tpl');
    }
}
