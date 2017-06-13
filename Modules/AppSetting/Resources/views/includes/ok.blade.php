<div class="caption">
    <span class="caption-subject font-dark sbold uppercase">OK</span>
</div>

<div class="form-group form-md-checkboxes">                       
<label for="ok_payment_enable" class="col-md-2 control-label">OK Payment</label>
    <div class="col-md-10">
   <div class="md-checkbox">
            <input type="checkbox" name="ok_payment_enable" id="ok_payment_enable" {{ (config('payment.ok.enable'))?'checked="checked"':'' }} value="true" class="md-check">
            <label for="ok_payment_enable">
             <span class=""></span>
             <span class="check"></span>
             <span class="box"></span> Enable</label>
        </div>    
    </div>
</div>

 <div class="form-group form-md-line-input">                          
<label for="ok_apikey" class="col-md-2 control-label">OK API Key</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.ok.apikey') }}" id="ok_apikey" name="ok_apikey" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                       
<label for="ok_destination" class="col-md-2 control-label">Merchant Destination</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.ok.destination') }}" id="ok_destination" name="ok_destination" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                       
<label for="ok_merchant_name" class="col-md-2 control-label">Merchant Name</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.ok.merchant_name') }}" id="ok_merchant_name" name="ok_merchant_name" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                       
<label for="ok_payment_url" class="col-md-2 control-label">Payment URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.ok.url') }}" id="ok_payment_url" name="ok_payment_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                       
<label for="ok_frontend_url" class="col-md-2 control-label">Frontend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.ok.frontend_url') }}" id="ok_frontend_url"  name="ok_frontend_url" disabled="disabled" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-checkboxes">                       
<label for="ok_frontend_url" class="col-md-2 control-label">Ok Charge Type</label>
    <div class="col-md-10">
      <div class="md-radio-inline">
        <div class="md-radio">
        <input type="radio" {{ (config('payment.ok.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="ok_charge_type" id="ok_charge_type1">
        <label for="ok_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.ok.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="ok_charge_type" id="ok_charge_type2">
        <label for="ok_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
      </div>
    </div>
</div>

<div class="form-group form-md-line-input">                       
<label for="ok_charge" class="col-md-2 control-label">Ok Charge Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.ok.charge') }}" id="ok_charge"  name="ok_charge"  class="form-control"><br>
    </div>
</div>
                                                           