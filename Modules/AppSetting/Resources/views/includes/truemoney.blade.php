<div class="caption">
 <span class="caption-subject font-dark sbold uppercase">True Money</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="true_enable" class="col-md-2 control-label">True Money Payment</label>
    <div class="col-md-10">
    <div class="md-checkbox">
    <input type="checkbox" name="true_enable" id="true_enable" {{ (config('payment.truemoney.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="true_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="true_hash_key" class="col-md-2 control-label">Hash Secret Key</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.truemoney.hash_key') }}" id="true_hash_key" name="true_hash_key" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="true_merchant_id" class="col-md-2 control-label">Merchant ID</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.truemoney.merchant_id') }}" id="true_merchant_id" name="true_merchant_id" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="true_payment_url" class="col-md-2 control-label">Payment URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.truemoney.url') }}" id="true_payment_url" name="true_payment_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="true_backend_url" class="col-md-2 control-label">Backend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.truemoney.backend_url') }}" disabled="disabled"  id="true_backend_url" name="true_backend_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="true_charge_type" class="col-md-2 control-label">True Money Charge Type</label>
    <div class="col-md-10">
    	<div class="md-radio">
		<input type="radio" {{ (config('payment.truemoney.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="true_charge_type" id="true_charge_type1">
		<label for="true_charge_type1">
 		<span class=""></span>
 		<span class="check"></span>
 		<span class="box"></span> Percentage </label>
		</div>
		<div class="md-radio">
		<input type="radio" {{ (config('payment.truemoney.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="true_charge_type" id="true_charge_type2">
		<label for="true_charge_type2">
		<span class=""></span>
		<span class="check"></span>
		<span class="box"></span> Amount </label>
		</div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="true_charge" class="col-md-2 control-label">True Money Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.truemoney.charge') }}" id="true_charge" name="true_charge" class="form-control"><br>
    </div>
</div>

                                                 