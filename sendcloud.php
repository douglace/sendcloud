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

        /*$lists = new Lists();
        $lists->setDateFrom("2022-03-01 00:00:00")
            ->setDateTo("2022-04-30 00:00:00")
        ;

        $returnItem = new ReturnItem(1);
        $createReturn = new CreateReturn();
        $CancelReturn = new CancelReturn(2);
        //dump($lists->exec(), $returnItem->exec(), $createReturn->simulReturn());
        dump($createReturn->simulReturn()->validate());
        die;*/

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
        return " <div id='sendcloud-container'>
        <span class='text-red'>Hello world</span>
        <p><span class='user-icon'></span> lorem ipsum <span class='poppins-black'>dolor</span></p>
        </div>";
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path.'public/index.module.js');
            $this->context->controller->addCSS($this->_path.'public/index.css');
            //$this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
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
