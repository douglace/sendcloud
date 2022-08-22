<div class="container">
    <div class="panel">
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
    </div>
</div>
