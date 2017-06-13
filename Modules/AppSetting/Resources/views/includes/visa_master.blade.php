<div class="caption">
<span class="caption-subject font-dark sbold uppercase">Visa/Master</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="visa_master_enable" class="col-md-2 control-label">Visa/Master Payment</label>
    <div class="md-checkbox">
    <input type="checkbox" name="visa_master_enable" id="visa_master_enable" {{ (config('payment.visa_master.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="visa_master_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_version" class="col-md-2 control-label">Version</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.version') }}" id="visa_master_version" name="visa_master_version" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_currency" class="col-md-2 control-label">Currency</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.currency') }}" id="visa_master_currency" name="visa_master_currency" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_hash_key" class="col-md-2 control-label">Hash Secret Key</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.hash_key') }}" id="visa_master_hash_key" name="visa_master_hash_key" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_merchant_id" class="col-md-2 control-label">Merchant ID</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.merchant_id') }}" id="visa_master_merchant_id" name="visa_master_merchant_id" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_payment_url" class="col-md-2 control-label">Payment URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.payment_url') }}" id="visa_master_payment_url" name="visa_master_payment_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_frontend_url" class="col-md-2 control-label">Frontend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.frontend_url') }}" disabled="disabled" id="visa_master_frontend_url" name="visa_master_frontend_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_backend_url" class="col-md-2 control-label">Backend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.backend_url') }}" disabled="disabled" id="visa_master_backend_url" name="visa_master_backend_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-radios">                                 
<label for="visa_master_backend_url" class="col-md-2 control-label">Visa/Master Charge Type</label>
    <div class="col-md-10">
    <div class="md-radio">
        <input type="radio" {{ (config('payment.visa_master.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="visa_master_charge_type" id="visa_master_charge_type1">
        <label for="visa_master_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.visa_master.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="visa_master_charge_type" id="visa_master_charge_type2">
        <label for="visa_master_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="visa_master_charge" class="col-md-2 control-label">Visa/Master Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.visa_master.charge') }}"  id="visa_master_charge" name="visa_master_charge" class="form-control"><br>
    </div>
</div>
