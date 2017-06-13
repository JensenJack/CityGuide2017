<div class="caption">
<span class="caption-subject font-dark sbold uppercase">Deposit</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="deposite_enable" class="col-md-2 control-label">Deposit Payment</label>
    <div class="md-checkbox">
    <input type="checkbox" name="deposite_enable" id="deposite_enable" {{ (config('payment.deposite.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="deposite_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="deposite_charge_type" class="col-md-2 control-label">Deposit Charge Type</label>
    <div class="col-md-10">
        <div class="md-radio">
        <input type="radio" {{ (config('payment.deposite.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="deposite_charge_type" id="deposite_charge_type1">
        <label for="deposite_charge_type1">
         <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.deposite.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="deposite_charge_type" id="deposite_charge_type2">
        <label for="deposite_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="deposite_charge" class="col-md-2 control-label">Deposit Charge Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.deposite.charge') }}" id="deposite_charge" name="deposite_charge" class="form-control"><br>
    </div>
</div>
                                                             