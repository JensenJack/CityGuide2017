<div class="caption">
  <span class="caption-subject font-dark sbold uppercase">Paylater</span>
 </div>

<div class="form-group form-md-checkboxes">                       
<label for="paylater_enable" class="col-md-2 control-label">Paylater Payment</label>
    <div class="col-md-10">
   <div class="md-checkbox">
            <input type="checkbox" name="paylater_enable" id="paylater_enable" {{ (config('payment.paylater.enable'))?'checked="checked"':'' }} value="true" class="md-check">
            <label for="paylater_enable">
             <span class=""></span>
             <span class="check"></span>
             <span class="box"></span> Enable</label>
        </div>    
    </div>
</div>

<div class="form-group form-md-line-input">                          
<label for="paylater_expiry" class="col-md-2 control-label">Paylater Expiry</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.paylater.expiry') }}" id="paylater_expiry" name="paylater_expiry" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-radios">                          
<label for="payllater_charege_type" class="col-md-2 control-label">Paylater Expiry</label>
    <div class="col-md-10">
    <div class="md-radio">
    <input type="radio" {{ (config('payment.paylater.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="paylater_charge_type" id="paylater_charge_type1">
    <label for="paylater_charge_type1">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Percentage </label>
    </div>
    <div class="md-radio">
    <input type="radio" {{ (config('payment.paylater.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="paylater_charge_type" id="paylater_charge_type2">
    <label for="paylater_charge_type2">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Amount </label>
     </div>
    </div>
</div>

<div class="form-group form-md-line-input">                          
<label for="paylater_charge" class="col-md-2 control-label">Paylater Charge Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.paylater.charge') }}" id="paylater_charge" name="paylater_charge" class="form-control"><br>
    </div>
</div>
                                                               
