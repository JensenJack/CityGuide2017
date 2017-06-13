<div class="caption">
<span class="caption-subject font-dark sbold uppercase">MPU</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="mpu_enable" class="col-md-2 control-label">MPU Payment</label>
    <div class="col-md-10">
    <div class="md-checkbox">
    <input type="checkbox" name="mpu_enable" id="mpu_enable" {{ (config('payment.mpu.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="mpu_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
    </div>
</div>


<div class="form-group form-md-line-input">                                 
<label for="mpu_merchant_id" class="col-md-2 control-label">Merchant ID</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mpu.merchant_id') }}" id="mpu_merchant_id" name="mpu_merchant_id" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mpu_payment_url" class="col-md-2 control-label">Payment URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mpu.payment_url') }}" id="mpu_payment_url" name="mpu_payment_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mpu_hash_key" class="col-md-2 control-label">Hash Secret Key</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mpu.hash_key') }}" id="mpu_hash_key" name="mpu_hash_key" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mpu_frontend_url" class="col-md-2 control-label">Frontend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mpu.frontend_url') }}" id="mpu_frontend_url" disabled="disabled" name="mpu_frontend_url" class="form-control"><br>
    </div>
</div>


<div class="form-group form-md-line-input">                                 
<label for="mpu_backend_url" class="col-md-2 control-label">Backend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mpu.backend_url') }}" id="mpu_backend_url" disabled="disabled"  name="mpu_backend_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-radios">                                 
<label for="mpu_charge_type" class="col-md-2 control-label">MPU Charge Type</label>
    <div class="col-md-10">
        <div class="md-radio">
        <input type="radio" {{ (config('payment.mpu.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="mpu_charge_type" id="mpu_charge_type1">
        <label for="mpu_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.mpu.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="mpu_charge_type" id="mpu_charge_type2">
        <label for="mpu_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mpu_charge" class="col-md-2 control-label">MPU Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mpu.charge') }}" id="mpu_charge" name="mpu_charge" class="form-control"><br>
    </div>
</div>
