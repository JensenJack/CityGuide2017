<div class="caption">
<span class="caption-subject font-dark sbold uppercase">Bank Transfer</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="transfer_enable" class="col-md-2 control-label">Bank Transfer Payment</label>
    <div class="col-md-10">
    <div class="md-checkbox">
    <input type="checkbox" name="transfer_enable" id="transfer_enable" {{ (config('payment.transfer.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="transfer_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_1" class="col-md-2 control-label">Bank Transfer 1</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_1') }}" id="transfer_1" name="transfer_1" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_2" class="col-md-2 control-label">Bank Transfer 2</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_2') }}" id="transfer_2" name="transfer_2" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_3" class="col-md-2 control-label">Bank Transfer 3</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_3') }}" id="transfer_3" name="transfer_3" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_4" class="col-md-2 control-label">Bank Transfer 4</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_4') }}" id="transfer_4" name="transfer_4" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_5" class="col-md-2 control-label">Bank Transfer 5</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_5') }}" id="transfer_5" name="transfer_5" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_6" class="col-md-2 control-label">Bank Transfer 6</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_6') }}" id="transfer_6" name="transfer_6" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_7" class="col-md-2 control-label">Bank Transfer 7</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_7') }}" id="transfer_7" name="transfer_7" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_8" class="col-md-2 control-label">Bank Transfer 8</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_8') }}" id="transfer_8" name="transfer_8" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_9" class="col-md-2 control-label">Bank Transfer 9</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_9') }}" id="transfer_9" name="transfer_9" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_10" class="col-md-2 control-label">Bank Transfer 10</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.transfer_10') }}" id="transfer_10" name="transfer_10" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-radios">                                 
<label for="transfer_charge_type" class="col-md-2 control-label">Transfer Charge Type</label>
    <div class="col-md-10">
        <div class="md-radio">
        <input type="radio" {{ (config('payment.transfer.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="transfer_charge_type" id="transfer_charge_type1">
        <label for="transfer_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.transfer.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="transfer_charge_type" id="transfer_charge_type2">
         <label for="transfer_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="transfer_charge" class="col-md-2 control-label">Transfer Charge Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.transfer.charge') }}" id="transfer_charge" name="transfer_charge" class="form-control"><br>
    </div>
</div>

                                                             