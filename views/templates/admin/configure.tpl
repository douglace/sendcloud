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

<div class="panel">
	<h3><i class="icon icon-credit-card"></i> {l s='Gestion des retours' mod='sendcloud'}</h3>
	<p>
		<strong>{l s='Here is my new generic module!' mod='sendcloud'}</strong><br />
		{l s='Thanks to PrestaShop, now I have a great module.' mod='sendcloud'}<br />
		{l s='I can configure it using the following configuration form.' mod='sendcloud'}
	</p>
	<br />
	<p>
		{l s='This module will boost your sales!' mod='sendcloud'}
	</p>
</div>
<div id='sendcloud-container'>
	<div class="panel">
		<h3><i class="icon icon-cogs"></i> {l s='Sendcloud' mod='sendcloud'}</h3>
		<div class=''>
			<form method="post">
				<div class="row">
					<div class="col-md-6 form-group">
						<label class="form-label">{l s='Nom d\'utilisateur' mod='sendcloud'}</label>
						<input name="SC_USERNAME" value="{$SC_USERNAME}" class="form-control" />
					</div>
					<div class="col-md-6 form-group">
						<label class="form-label">{l s='Mot de passe' mod='sendcloud'}</label>
						<input name="SC_PASSWORD" value="{$SC_PASSWORD}" class="form-control" />
					</div>
					<div class="col-md-6 form-group">
						<label class="form-label">
							<span>{l s='Live mode' mod='sendcloud'}</span>
							<input type="checkbox" name="SC_LIVE_MODE" value="1" {if isset($SC_LIVE_MODE) && $SC_LIVE_MODE}checked="checked"{/if} />
						</label>
					</div>
				</div>
				<button class="btn btn-primary" type="submit" name="submitConf">{l s='Enregistrer' mod='sendcloud'}</button>
			</form>
		</div>
	</div>

	<div class="panel">
		<h3><i class="icon icon-cogs"></i> {l s='Mollie' mod='sendcloud'}</h3>
		<div class=''>
			<form method="post">
				<div class="row">
					<div class="col-md-6 form-group">
						<label class="form-label">{l s='Api live' mod='sendcloud'}</label>
						<input name="SC_API_MOLLIE_LIVE" value="{$SC_API_MOLLIE_LIVE}" class="form-control" />
					</div>
					<div class="col-md-6 form-group">
						<label class="form-label">{l s='Api test' mod='sendcloud'}</label>
						<input name="SC_API_MOLLIE_TEST" value="{$SC_API_MOLLIE_TEST}" class="form-control" />
					</div>
					<div class="col-md-6 form-group">
						<label class="form-label">{l s='Frais de retours' mod='sendcloud'}</label>
						<input name="SC_API_MOLLIE_FEES" value="{$SC_API_MOLLIE_FEES}" class="form-control" />
					</div>
				</div>
				<button class="btn btn-primary" type="submit" name="submitConfigMollie">{l s='Enregistrer' mod='sendcloud'}</button>
			</form>
		</div>
	</div>
</div>
