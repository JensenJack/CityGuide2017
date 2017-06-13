<div class="caption">
<span class="caption-subject font-dark sbold uppercase">OneTwoThree</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="onetwothree_enable" class="col-md-2 control-label">OneTwoThree Payment</label>
    <div class="col-md-10">
    <div class="md-checkbox">
    <input type="checkbox" name="onetwothree_enable" id="onetwothree_enable" {{ (config('payment.onetwothree.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="onetwothree_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_merchantid" class="col-md-2 control-label">Merchant ID</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.MerchantID') }}" id="onetwothree_merchantid" name="onetwothree_merchantid" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_merchantpassword" class="col-md-2 control-label">Merchant Key Password</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.Merchantpassword') }}" id="onetwothree_merchantpassword" name="onetwothree_merchantpassword" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_version" class="col-md-2 control-label">Version</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.Version') }}" id="onetwothree_version" name="onetwothree_version" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_currencycode" class="col-md-2 control-label">Currency</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.CurrencyCode') }}" id="onetwothree_currencycode" name="onetwothree_currencycode" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_agentcode" class="col-md-2 control-label">Country Code</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.CountryCode') }}" id="onetwothree_agentcode" name="onetwothree_agentcode" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_merchantid" class="col-md-2 control-label">Agent Code</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.AgentCode') }}" id="onetwothree_agentid" name="onetwothree_agentid" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_channelcode" class="col-md-2 control-label">Channel Code</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.ChannelCode') }}" id="onetwothree_channelcode" name="onetwothree_channelcode" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_apikey" class="col-md-2 control-label">API Key</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.ApiKey') }}" id="onetwothree_apikey" name="onetwothree_apikey" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_url" class="col-md-2 control-label">Payment URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.Url') }}" id="onetwothree_url" name="onetwothree_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_charge_type" class="col-md-2 control-label">OneTwoThree URL</label>
    <div class="col-md-10">
        <div class="md-radio">
        <input type="radio" {{ (config('payment.onetwothree.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="onetwothree_charge_type" id="onetwothree_charge_type1">
        <label for="onetwothree_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.onetwothree.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="onetwothree_charge_type" id="onetwothree_charge_type2">
        <label for="onetwothree_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="onetwothree_chargeonetwothree_chargeonetwothree_charge" class="col-md-2 control-label">OneTwoThree Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.onetwothree.charge') }}" id="onetwothree_charge" name="onetwothree_charge" class="form-control"><br>
    </div>
</div>

                                                                                                             