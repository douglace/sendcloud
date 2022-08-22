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

class ReturnModel extends ObjectModel
{
    /**
     * @param int $id_customer
     */
    public $id_customer;

    /**
     * @param int $id_order
     */
    public $id_order;

    /**
     * @param string $order_return
     */
    public $order_return;

    /**
     * @param string $payment_fees_id
     */
    public $payment_fees_id;

    /**
     * @param float $fees
     */
    public $fees;

    /**
     * @param int $buy_fees
     */
    public $buy_fees;

    /**
     * @param int $buy_fees_state
     */
    public $buy_fees_state;

    /**
     * @param string $date_add
     */
    public $date_add;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'sc_returns',
        'primary' => 'id_sc_returns',
        'multilang' => false,
        'fields' => array(
            'id_customer' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true,
            ),
            'id_order' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true,
            ),
            'order_return' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true,
            ),
            'payment_fees_id' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isName',
                'size' => 255
            ),
            'fees' => array(
                'type' => self::TYPE_FLOAT,
                'validate' => 'isFloat'
            ),
            'buy_fees' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'buy_fees_state' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'date_add' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            )
        ),
    );
}