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
        <h1 class="title">{l s="My returns" d='Modules.Sendcloud.Admin'}</h1>

        <!--div class="return-header">
            <span class="add-return" title="{l s='Add return' d='Modules.Sendcloud.Admin'}">
                <span>{l s='Add return' d='Modules.Sendcloud.Admin'}</span>
                <i class="material-icons">add</i>
            </span>
        </div-->

        <table class="table table-stripped table-hover table-borderd">
            <thead>
                <tr>
                    <th>{l s='Order reference' d='Modules.Sendcloud.Admin'}</th>
                    <th>{l s='Date return' d='Modules.Sendcloud.Admin'}</th>
                    <th>{l s='Action' d='Modules.Sendcloud.Admin'}</th>
                </tr>
            </thead>
            <tbody>
            {if isset($returns) && !empty($returns)}
                
                    {foreach from=$returns item=item key=key name=name}
                        <tr>
                            <td>{$item.reference}</td>
                            <td>{$item.date_add}</td>
                            <td>
                               <a class="btn btn-default" href="{$item.link}">{l s='Detail' d='Modules.Sendcloud.Admin'}</a> 
                            </td>
                        </tr>
                    {/foreach}
                
            {/if}
            </tbody>
        </table>
    </div>
{/block}