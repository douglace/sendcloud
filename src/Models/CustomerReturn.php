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

use DateTime;
use Db;
use Tools;
use DbQuery;
use Context;
use PDOStatement;
use mysqli_result;
use PrestaShopDatabaseException;

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
            $a['link'] = Context::getContext()->link->getModuleLink('sendcloud', 'returns', ["return" => $a['reference']]);
            return $a;
        }, Db::getInstance()->executeS($q));
    }
}