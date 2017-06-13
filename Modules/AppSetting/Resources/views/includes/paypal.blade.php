<div class="caption">
 <span class="caption-subject font-dark sbold uppercase">Paypal</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="paypal_enable" class="col-md-2 control-label">Paypal Payment</label>
    <div class="col-md-10">
    <div class="md-checkbox">
    <input type="checkbox" name="paypal_enable" id="paypal_enable" {{ (config('payment.paypal.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="paypal_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
    </div>
</div>


<div class="form-group form-md-line-input">                                 
<label for="paypal_payment_url" class="col-md-2 control-label">Payment URL </label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.paypal.payment_url') }}" id="paypal_payment_url" name="paypal_payment_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="paypal_email" class="col-md-2 control-label">Paypal Account Email</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.paypal.email') }}" id="paypal_email" name="paypal_email" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-radios">
<label for="paypal_charge_type" class="col-md-2 control-label">Paypal Charge Type</label>
    <div class="col-md-10">
        <div class="md-radio">
        <input type="radio" {{ (config('payment.paypal.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="paypal_charge_type" id="paypal_charge_type1">
        <label for="paypal_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.paypal.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="paypal_charge_type" id="paypal_charge_type2">
        <label for="paypal_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="paypal_charge" class="col-md-2 control-label">Paypal Charge Amount/Percentage</label>
  <div class="col-md-10">
  <input type="text" value="{{ config('payment.paypal.charge') }}" id="paypal_charge" name="paypal_charge" class="form-control"><br>
  </div>
</div>

