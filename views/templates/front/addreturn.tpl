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
    <div id="add-return">
        <h1 class="title">{l s="Ajouter un retour" d='Modules.Sendcloud.Admin'}</h1>
        <form action='{$action}' method="post">
            <table class="table table-stripped table-hover table-borderd">
                <thead>
                    <tr>
                        <th>{l s="Commande" d='Modules.Sendcloud.Admin'}</th>
                        <td>{l s="Date" d='Modules.Sendcloud.Admin'}</td>
                        <td>{l s="Prix Total" d='Modules.Sendcloud.Admin'}</td>
                        <td>{l s="État" d='Modules.Sendcloud.Admin'}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{$order->reference}</th>
                        <td>{$order_date}</td>
                        <td>{$order_total_price}</td>
                        <td><span class="order-state" style="background-color:{$state_color}">{$state}</span></td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <label class="control-label">{l s='Sélectionnez produits à retourner' d='Modules.Sendcloud.Admin'}</label>
                <table class="table table-stripped table-hover table-borderd">
                    <thead>
                        <tr>
                            <th>{l s="Produit" d='Modules.Sendcloud.Admin'}</th>
                            <th>{l s="Quantité" d='Modules.Sendcloud.Admin'}</th>
                            <th>{l s="Prix Unitaire" d='Modules.Sendcloud.Admin'}</th>
                            <th>{l s="Prix Total" d='Modules.Sendcloud.Admin'}</th>
                            <th>{l s="" d='Modules.Sendcloud.Admin'}</th>
                        </tr>
                    </thead>
                    {if isset($products) && !empty($products)}
                        <tbody>
                            {foreach from=$products item=product key=k}
                                <tr>
                                    <td>{$product.product_name}</td>
                                    <td>{$product.product_quantity}</td>
                                    <td>{$product.product_price_wt}</td>
                                    <td>{$product.total_wt}</td>
                                    <td>
                                        <input type="checkbox" name="products[]" value="{$product.id_product}"/>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    {/if}
                </table>
            </div>
            <div class="form-group">
                <label class="buy-fees">
                    {l s="Payer le frais de retrais" d='Modules.Sendcloud.Admin'}
                    <input type="checkbox" name="buy_return_fees" value="1" />
                </label>
            </div>
            <button type="submit" class="btn btn-primary">{l s='Créé un retour' d='Modules.Sendcloud.Admin'}</button>
        </form>
    </div>
{/block}