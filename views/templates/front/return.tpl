{*
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
*}

{extends file='page.tpl'}


{block name='content'}
    <div class="sc-returns">
        <h1 class="title">{l s="Return" d='Modules.Sendcloud.Admin'} : {$return.reference}</h1>

        <label>{l s="List des produits retourner" d='Modules.Sendcloud.Admin'} </label>
        <table class="table table-stripped table-hover table-borderd">
            <thead>
                <tr>
                    <th>{l s='Produit' d='Modules.Sendcloud.Admin'}</th>
                </tr>
            </thead>
            <tbody>
            {if isset($products) && !empty($products)}
                {foreach from=$products item=item key=key name=name}
                    <tr>
                        <td>{$item.name}</td>
                    </tr>
                {/foreach}
            {/if}
            </tbody>
        </table>

        {if $return.buy_fees}
        <div class="group">
            <table class="table table-stripped table-hover table-borderd">
                <thead>
                    <tr>
                        <th>{l s='Frais de retour' d='Modules.Sendcloud.Admin'}</th>
                        <th>{l s='Status du paiement' d='Modules.Sendcloud.Admin'}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{$return.fees}</td>
                        <td>{$return.state}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        {else}
            <label class="alert alert-info">{l s='Frais de retours non payer' d='Modules.Sendcloud.Admin'}</label>
        {/if}
    </div>
{/block}