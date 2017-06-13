<div class="caption">
 <span class="caption-subject font-dark sbold uppercase">MAB Mobile Banking</span>
</div>

<div class="form-group form-md-checkboxes">                            
<label for="mab_enable" class="col-md-2 control-label">MAB Payment</label>
    <div class="md-checkbox">
    <input type="checkbox" name="mab_enable" id="mab_enable" {{ (config('payment.mab.enable'))?'checked="checked"':'' }} value="true" class="md-check">
    <label for="mab_enable">
    <span class=""></span>
    <span class="check"></span>
    <span class="box"></span> Enable</label>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mab_mid" class="col-md-2 control-label">Merchant ID</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.MID') }}" id="mab_mid" name="mab_mid" class="form-control"><br>
    </div>
</div>


<div class="form-group form-md-line-input">                                 
<label for="mab_sharekey" class="col-md-2 control-label">Share Key</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.ShareKey') }}" id="mab_sharekey" name="mab_sharekey" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mab_mname" class="col-md-2 control-label">Merchant Name</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.MName') }}" id="mab_mname" name="mab_mname" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mab_url" class="col-md-2 control-label">Payment URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.url') }}" id="mab_url" name="mab_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mab_frontend_url" class="col-md-2 control-label">Frontend URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.frontend_url') }}"  disabled="disabled" id="mab_frontend_url" name="mab_frontend_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mab_act_url" class="col-md-2 control-label">Act URL</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.act_url') }}" id="mab_act_url" name="mab_act_url" class="form-control"><br>
    </div>
</div>

<div class="form-group form-md-radios">                                 
<label for="mab_charge_type1" class="col-md-2 control-label">MAB Charge Type</label>
    <div class="col-md-10">
    <div class="md-radio">
        <input type="radio" {{ (config('payment.mab.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="mab_charge_type" id="mab_charge_type1">
        <label for="mab_charge_type1">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
        <input type="radio" {{ (config('payment.mab.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="mab_charge_type" id="mab_charge_type2">
        <label for="mab_charge_type2">
        <span class=""></span>
        <span class="check"></span>
        <span class="box"></span> Amount </label>
        </div>
    </div>
</div>

<div class="form-group form-md-line-input">                                 
<label for="mab_charge" class="col-md-2 control-label">MAB Charge Amount/Percentage</label>
    <div class="col-md-10">
    <input type="text" value="{{ config('payment.mab.charge') }}" id="mab_charge" name="mab_charge" class="form-control"><br>
    </div>
</div>
