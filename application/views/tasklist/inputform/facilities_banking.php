<style type="text/css">
    .form_container{
        margin: 0;
        padding: 15px 30px;
        box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .form_container label{
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.87);
    }
    .form_container .form-control{
        border-radius: 4px;
    }
    .form_action{
        margin: 0;
        padding: 30px 30px 0 15px;
    }
    .form_action button{
        border: 1px solid #F58C38;
        box-sizing: border-box;
        border-radius: 2px;
        font-size: 10px;
        color: #FFFFFF;
    }
    .form_action .btn_save{
        background: #F58C38;
    }
    .form_action .btn_save:hover{
        border: 1px solid #F58C38;
    }
    .form_action .btn_save:active:hover{
        background: #c4702c;
        border: 1px solid #F58C38;
    }
    .form_action .btn_cancel{
        color: #F58C38;
    }
    .form_action .btn_cancel:hover{
        border: 1px solid #F58C38;
    }
    .form_action .btn-default.focus, .btn-default:focus {
        border-color: #F58C38;
    }
    .div-action{
        display: inline-flex;
        margin: auto;
        color: #F58C38;
        float: right;
    }
    .div-action i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-action label{
        color: #F58C38;
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }
    .div-action:hover i, .div-action:hover label{
        cursor: pointer;
        font-weight: bold !important;
    }
    .label-action{
        margin:0 !important; 
        padding-left:5px !important; 
        font-weight: normal !important;
    }
</style>
<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Tasklist</li>
                      <li class="breadcrumb-item"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                      <li class="breadcrumb-item"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/bri_starting_position');?>">BRI Starting Position</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$BankFacilityGroupType);?>">Facilities with Banking</a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Input Account Planning</li> -->
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left"><?= $BankFacilityGroupName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="row form_container">
                <label class="label_title" style="font-size: 14px; color: #218FD8;"><?= $CompanyName ?></label>
                <div class="col-md-4 col-sm-4 col-xs-12 pull-right" style="text-align: right;">
                  <table>
                    <tr>
                      <td style="width: 30%; text-align: left;">Notes : </td>
                      <td><span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes1?></span></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes2?></span></td>
                    </tr>
                  </table>
                </div>
                <table id="table-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>" width="100%" cellpadding="2" cellspacing="2" style="color: #00000; font-size: 13px;">
                  <tbody>
                  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacility_detail'])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacility_detail'] as $rows => $BankFacility) : ?>
                    <tr>
                      <td style="vertical-align: bottom;" width="30%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $BankFacility['BankFacilityItemName'] ?></label></td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Nominal IDR</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRAmount[]" id="IDRAmount_<?= $BankFacility['BankFacilityItemId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $BankFacility['IDRAmount'] ?>" style="text-align: right;">
                          <input type="hidden" name="oldIDRAmount[]" value="<?= $BankFacility['IDRAmount'] ?>"></div>
                      </td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Rate</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRRate[]" id="IDRRate_<?= $BankFacility['BankFacilityItemId']; ?>" class="form-control col-md-7 col-xs-12 portion" data-a-dec="." value="<?= $BankFacility['IDRRate'] ?>" style="text-align: right;"></div>
                      </td>
                      <td rowspan="2" valign="top" style="padding-top: 25px; width: 6%;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Nominal Valas </label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasAmount[]" id="ValasAmount_<?= $BankFacility['BankFacilityItemId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $BankFacility['ValasAmount'] ?>" style="text-align: right;">
                        <input type="hidden" name="oldValasAmount[]" value="<?= $BankFacility['ValasAmount'] ?>"></div>
                      </td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Rate</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasRate[]" id="ValasRate_<?= $BankFacility['BankFacilityItemId']; ?>" class="form-control col-md-7 col-xs-12 portion" data-a-dec="." value="<?= $BankFacility['ValasRate'] ?>" style="text-align: right;"></div>
                      </td>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="4" height="30">
                      <div id="errBRINominal_<?= $BankFacility['BankFacilityItemId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px;">Nominal IDR + Nominal Valas harus lebih kecil dari <?=number_format($BankFacility['IDRAmount']+$BankFacility['ValasAmount'])?></label>
                      </div>
                      </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ddd;">
                      <td colspan="5" height="30">
                        <input type="hidden" name="BankFacilityItemId[]" value="<?= $BankFacility['BankFacilityItemId']; ?>">
                        <input type="hidden" name="VCIF[]" value="<?= $VCIF; ?>">
                        <input type="hidden" name="BankFacilitySubmit[]" value="<?= $BankFacility['BankFacilitySubmit']; ?>">
                        <input type="hidden" name="BankFacilityId[]" value="<?= $BankFacility['BankFacilityId']; ?>">
                        <input type="hidden" name="InputTable" value="BankFacility">
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacilityAddition_detail'])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacilityAddition_detail'] as $rows => $BankFacilityAddition) : ?>
                    <tr id="tr1_Addition<?= $BankFacilityAddition['BankFacilityAdditionId']; ?>">
                      <td style="vertical-align: bottom;" width="30%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $BankFacilityAddition['BankFacilityItemAdditionName'] ?></label></td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Nominal IDR</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRAmountAddition[]" id="IDRAmountAddition_<?= $BankFacilityAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $BankFacilityAddition['IDRAmountAddition'] ?>" style="text-align: right;">
                          <input type="hidden" name="oldIDRAmountAddition[]" value="<?= $BankFacilityAddition['IDRAmountAddition'] ?>"></div>
                      </td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Rate</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRRateAddition[]" id="IDRRateAddition_<?= $BankFacilityAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 portion" data-a-dec="." value="<?= $BankFacilityAddition['IDRRateAddition'] ?>" style="text-align: right;"></div>
                      </td>
                      <td rowspan="2" valign="top" style="padding-top: 27px;">
                        <button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRowFacilitiesAddition('Addition<?= $BankFacilityAddition['BankFacilityAdditionId']; ?>', 'BankFacilityAdditionId', <?= $BankFacilityAddition['BankFacilityAdditionId']; ?>, <?= $BankFacilityAddition['BankFacilityItemAdditionId']; ?>); return false;"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);" title="Delete">delete_sweep</i></button>
                      </td>
                    </tr>
                    <tr id="tr2_Addition<?= $BankFacilityAddition['BankFacilityAdditionId']; ?>">
                      <td></td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Nominal Valas </label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasAmountAddition[]" id="ValasAmountAddition_<?= $BankFacilityAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $BankFacilityAddition['ValasAmountAddition'] ?>" style="text-align: right;">
                          <input type="hidden" name="oldValasAmountAddition[]" value="<?= $BankFacilityAddition['ValasAmountAddition'] ?>"></div>
                      </td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Rate</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasRateAddition[]" id="ValasRateAddition_<?= $BankFacilityAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 portion" data-a-dec="." value="<?= $BankFacilityAddition['ValasRateAddition'] ?>" style="text-align: right;"></div>
                      </td>
                    </tr>
                    <tr id="tr3_Addition<?= $BankFacilityAddition['BankFacilityAdditionId']; ?>" style="border-bottom: 1px solid #ddd;">
                      <td></td>
                      <td colspan="4" height="30">
                      <div id="errBRINominalAddition_<?= $BankFacilityAddition['BankFacilityItemAdditionId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px;">Nominal IDR + Nominal Valas harus lebih kecil dari <?=number_format($BankFacilityAddition['IDRAmountAddition']+$BankFacilityAddition['ValasAmountAddition'])?></label>
                      </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5" height="30">
                        <input type="hidden" name="BankFacilityItemAdditionId[]" value="<?= $BankFacilityAddition['BankFacilityItemAdditionId']; ?>">
                        <input type="hidden" name="VCIF[]" value="<?= $VCIF; ?>">
                        <input type="hidden" name="BankFacilityAdditionSubmit[]" value="<?= $BankFacilityAddition['BankFacilityAdditionSubmit']; ?>">
                        <input type="hidden" name="BankFacilityAdditionId[]" value="<?= $BankFacilityAddition['BankFacilityAdditionId']; ?>">
                        <input type="hidden" name="InputTableAddition" value="BankFacilityAddition">
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                    <tr>
                      <td colspan="4">
                        <input type="hidden" name="VCIF" value="<?= $VCIF; ?>">
                        <input type="hidden" name="BankFacilityGroupId" value="<?= $BankFacilityGroupId; ?>">
                        <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                        <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                        <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                        <input type="hidden" id="rownumber" value="0"/>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$BankFacilityGroupType);?>'">BACK</button>
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="add_facilities_banking_fields();">ADD ROW</button>
                    <!-- <button class="btn w150 btn-sm btn-primary btn_save" type="submit" style="width: 200px;" onclick="isValid(); return false;">SAVE</button> -->
                    <button class="btn w150 btn-sm btn-primary btn_save" type="button" style="margin-right: 0px;" onclick="confirmModal(); return false;">SAVE</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: left;">
        <p id="confirmation_text1">You're about to change Facilities With Banking details. Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  function setZero(ItemName, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    else if (ItemType == 'AdditionNew') {
      var aItemType = 'AdditionNew';
    }
    var Currency = Currency;
    if ($('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('get') == '') {
      $('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('set', 0);
    }
  }

  function removeZero(ItemName, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    else if (ItemType == 'AdditionNew') {
      var aItemType = 'AdditionNew';
    }
    var Currency = Currency;
    if ($('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('get') == 0) {
      $('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('set', '');
    }
  }

  function calculateBRINominal(iBRINominal, cBRINominal, ItemId, ItemType) {
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    else if (ItemType == 'AdditionNew') {
      var aItemType = 'AdditionNew';
    }
    if (cBRINominal > 0) {
      if (iBRINominal <= cBRINominal) {
        $('#errBRINominal'+aItemType+'_'+ItemId).hide();
        $(".btn_save").attr("disabled", false);
      }
      else {
        $('#errBRINominal'+aItemType+'_'+ItemId).show();
        $(".btn_save").attr("disabled", true);
      }
    }
  }

  function deleteRowFacilitiesAddition(tr_id, IdName, RemoveId, ItemId) {
    var IdName = IdName;
    var RemoveId = RemoveId;

    if (RemoveId != null) {
      $(document).ready(function() {
        var form = $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>');
        $(form).append('<input type="hidden" name="DelAddition" value="1" /> ');
        $(form).append('<input type="hidden" name="BankFacilityItemAdditionId[]" value="'+ItemId+'" /> ');
        $(form).append('<input type="hidden" name="IdName[]" value="'+IdName+'" /> ');
        $(form).append('<input type="hidden" name="RemoveId[]" value="'+RemoveId+'" /> ');
      });
    }

    deleteRowFacilities(tr_id);
  }

  function deleteRowFacilities(tr_id) {
    var row1 = "#tr1_"+tr_id;
    var row2 = "#tr2_"+tr_id;
    var row3 = "#tr3_"+tr_id;
    
    $(row1).remove();
    $(row2).remove();
    $(row3).remove();
  }

  function add_facilities_banking_fields(){
    var value = parseInt(document.getElementById('rownumber').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('rownumber').value = value;
    var rownumber = value;

    $(document).ready(function() {
      var table_tr = $('#table-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>');

      $(table_tr).append('<tr id="tr1_'+rownumber+'"><td style="vertical-align: bottom;" width="30%"><input type="text" name="NewAddition[BankFacilityItemAdditionName][]" id="NewAddition[BankFacilityItemAdditionName]'+rownumber+'" class="form-control col-md-7 col-xs-12" required maxlength="32"></td><td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Nominal IDR</label><div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="NewAddition[IDRAmountAddition][]" id="IDRAmountAdditionNew_'+rownumber+'" class="form-control col-md-7 col-xs-12 money" data-a-sep="," style="text-align: right;" value="0"></div></td><td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Rate</label><div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="NewAddition[IDRRateAddition][]" id="IDRRateAdditionNew_'+rownumber+'" class="form-control col-md-7 col-xs-12 portion" data-a-dec="." style="text-align: right;" value="0"></div></td><td rowspan="3" valign="top" style="padding-top: 27px;"><button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRowFacilities(\''+rownumber+'\'); return false;"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);" Title="Delete">delete_sweep</i></button></td></tr><tr id="tr2_'+rownumber+'"><td></td><td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Nominal Valas </label><div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="NewAddition[ValasAmountAddition][]" id="ValasAmountAdditionNew_'+rownumber+'" class="form-control col-md-7 col-xs-12 money" data-a-sep="," style="text-align: right;" value="0"></div></td><td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Rate</label><div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="NewAddition[ValasRateAddition][]" id="ValasRateAdditionNew_'+rownumber+'" class="form-control col-md-7 col-xs-12 portion" data-a-dec="." style="text-align: right;" value="0"></div></td></tr><tr id="tr3_'+rownumber+'" style="border-bottom: 1px solid #ddd;"><td colspan="4" height="30"><input type="hidden" name="NewAddition[BankFacilityAdditionSubmit][]" value="add"><input type="hidden" name="NewAddition[InputTableAddition]" value="BankFacilityAddition"></td></tr>');


      $('.money').autoNumeric('init',{
        aForm: true,
        vMax: '<?=MAX_NUMERIC?>',
        vMin: '<?=MIN_NUMERIC?>',
        // mDec: '2',
        aPad: false,
        unformatOnSubmit: true
      });
      $('.portion').autoNumeric('init',{
        aForm: true,
        mDec: '2',
        aPad: false,
        vMax: '999',
        unformatOnSubmit: true
      });

      $('#IDRAmountAdditionNew_'+rownumber).on('focus', function() {
        removeZero('Amount', rownumber, 'AdditionNew', 'IDR');
      });
      $('#IDRAmountAdditionNew_'+rownumber).on('blur', function() {
        setZero('Amount', rownumber, 'AdditionNew', 'IDR');
      });

      $('#IDRRateAdditionNew_'+rownumber).on('focus', function() {
        removeZero('Rate', rownumber, 'AdditionNew', 'IDR');
      });
      $('#IDRRateAdditionNew_'+rownumber).on('blur', function() {
        setZero('Rate', rownumber, 'AdditionNew', 'IDR');
      });

      $('#ValasAmountAdditionNew_'+rownumber).on('focus', function() {
        removeZero('Amount', rownumber, 'AdditionNew', 'Valas');
      });
      $('#ValasAmountAdditionNew_'+rownumber).on('blur', function() {
        setZero('Amount', rownumber, 'AdditionNew', 'Valas');
      });

      $('#ValasRateAdditionNew_'+rownumber).on('focus', function() {
        removeZero('Rate', rownumber, 'AdditionNew', 'Valas');
      });
      $('#ValasRateAdditionNew_'+rownumber).on('blur', function() {
        setZero('Rate', rownumber, 'AdditionNew', 'Valas');
      });
    });
  }

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function isValid() {
    $(document).ready(function() {
      var errCount = 0;
    <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacility_detail'])) {?>
    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacility_detail'] as $rows => $BankFacility) : ?>
      // var cIDRAmount = <?= $BankFacility['IDRAmount'] ?>;
      // var cValasAmount = <?= $BankFacility['ValasAmount'] ?>;
      // var cBRINominal = cIDRAmount + cValasAmount;
      // var IDRAmount = Number($('#IDRAmount_<?= $BankFacility['BankFacilityItemId'] ?>').autoNumeric("get"));
      // var ValasAmount = Number($('#ValasAmount_<?= $BankFacility['BankFacilityItemId'] ?>').autoNumeric("get"));
      // iBRINominal = IDRAmount + ValasAmount;

      // if (iBRINominal > cBRINominal) {
      //   errCount = errCount+1;
      //   $('#errBRINominal_<?= $BankFacility['BankFacilityItemId'] ?>').show();
      //   $(".btn_save").attr("disabled", true);
      // }

    <?php endforeach; ?>
    <?php } ?>

    <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacilityAddition_detail'])) {?>
    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacilityAddition_detail'] as $rows => $BankFacility) : ?>
      // var cIDRAmountAddition = <?= $BankFacility['IDRAmountAddition'] ?>;
      // var cValasAmountAddition = <?= $BankFacility['ValasAmountAddition'] ?>;
      // var cBRINominalAddition = cIDRAmountAddition + cValasAmountAddition;
      // var IDRAmountAddition = Number($('#IDRAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      // var ValasAmountAddition = Number($('#ValasAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      // iBRINominalAddition = IDRAmountAddition + ValasAmountAddition;

      // if (iBRINominalAddition > cBRINominalAddition) {
      //   errCount = errCount+1;
      //   $('#errBRINominalAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').show();
      //   $(".btn_save").attr("disabled", true);
      // }

    <?php endforeach; ?>
    <?php } ?>
      console.log(errCount);

      if (errCount == 0) {
        if(confirm('Anda yakin?')) {
          $.ajax({
            type: 'post',
            url : $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').attr('action'),
            data: $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').serialize(),
              dataType : 'html',
            beforeSend:function(){
              $('.loaderImage').show();
            },
            error: function(jqXHR, textStatus, errorThrown){
              console.log(jqXHR);
              $('.loaderImage').hide();
              new PNotify({
                  title: 'Error!',
                  text: "Message : "+errorThrown,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 3000;
            },
            success: function(data){
              new PNotify({
                  title: 'Success!',
                  text: 'Data Saved',
                  type: 'success',
                  styling: 'bootstrap3'
              });
              
              PNotify.prototype.options.delay = 3000;

              setTimeout(function(){ 
                window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
                $('.loaderImage').hide();
              }, 2000);
            }
          });
        }
      }
    });
  }

$(document).ready(function() {
  // $(".btn_save").attr("disabled", true);
  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacility_detail'])) {?>
  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacility_detail'] as $rows => $BankFacility) : ?>

    $('#IDRAmount_<?= $BankFacility['BankFacilityItemId']; ?>').on('focus', function() {
      removeZero('Amount', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRAmount_<?= $BankFacility['BankFacilityItemId']; ?>').on('blur', function() {
      // var cIDRAmount = <?= $BankFacility['IDRAmount'] ?>;
      // var cValasAmount = <?= $BankFacility['ValasAmount'] ?>;
      // var cBRINominal = cIDRAmount + cValasAmount;
      // var IDRAmount = Number($('#IDRAmount_<?= $BankFacility['BankFacilityItemId'] ?>').autoNumeric("get"));
      // var ValasAmount = Number($('#ValasAmount_<?= $BankFacility['BankFacilityItemId'] ?>').autoNumeric("get"));
      // iBRINominal = IDRAmount + ValasAmount;

      // calculateBRINominal(iBRINominal, cBRINominal, <?= $BankFacility['BankFacilityItemId']; ?>, '');
      setZero('Amount', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'IDR');
    });

    $('#IDRRate_<?= $BankFacility['BankFacilityItemId']; ?>').on('focus', function() {
      removeZero('Rate', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRRate_<?= $BankFacility['BankFacilityItemId']; ?>').on('blur', function() {
      setZero('Rate', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'IDR');
    });

    $('#ValasAmount_<?= $BankFacility['BankFacilityItemId']; ?>').on('focus', function() {
      removeZero('Amount', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasAmount_<?= $BankFacility['BankFacilityItemId']; ?>').on('blur', function() {
      // var cIDRAmount = <?= $BankFacility['IDRAmount'] ?>;
      // var cValasAmount = <?= $BankFacility['ValasAmount'] ?>;
      // var cBRINominal = cIDRAmount + cValasAmount;
      // var IDRAmount = Number($('#IDRAmount_<?= $BankFacility['BankFacilityItemId'] ?>').autoNumeric("get"));
      // var ValasAmount = Number($('#ValasAmount_<?= $BankFacility['BankFacilityItemId'] ?>').autoNumeric("get"));
      // iBRINominal = IDRAmount + ValasAmount;

      // calculateBRINominal(iBRINominal, cBRINominal, <?= $BankFacility['BankFacilityItemId']; ?>, '');
      setZero('Amount', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'Valas');
    });

    $('#ValasRate_<?= $BankFacility['BankFacilityItemId']; ?>').on('focus', function() {
      removeZero('Rate', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasRate_<?= $BankFacility['BankFacilityItemId']; ?>').on('blur', function() {
      setZero('Rate', <?= $BankFacility['BankFacilityItemId'] ?>, '', 'Valas');
    });
  <?php endforeach; ?>
  <?php } ?>

  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacilityAddition_detail'])) {?>
  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['BankFacilityAddition_detail'] as $rows => $BankFacility) : ?>

    $('#IDRAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('focus', function() {
      removeZero('Amount', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
    });
    $('#IDRAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('blur', function() {
      // var cIDRAmountAddition = <?= $BankFacility['IDRAmountAddition'] ?>;
      // var cValasAmountAddition = <?= $BankFacility['ValasAmountAddition'] ?>;
      // var cBRINominalAddition = cIDRAmountAddition + cValasAmountAddition;
      // var IDRAmountAddition = Number($('#IDRAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      // var ValasAmountAddition = Number($('#ValasAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      // iBRINominalAddition = IDRAmountAddition + ValasAmountAddition;

      // calculateBRINominal(iBRINominalAddition, cBRINominalAddition, <?= $BankFacility['BankFacilityItemAdditionId']; ?>, 'Addition');
      setZero('Amount', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
    });

    $('#IDRRateAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('focus', function() {
      removeZero('Rate', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
    });
    $('#IDRRateAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('blur', function() {
      setZero('Rate', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
    });

    $('#ValasAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('focus', function() {
      removeZero('Amount', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
    });
    $('#ValasAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('blur', function() {
      // var cIDRAmountAddition = <?= $BankFacility['IDRAmountAddition'] ?>;
      // var cValasAmountAddition = <?= $BankFacility['ValasAmountAddition'] ?>;
      // var cBRINominalAddition = cIDRAmountAddition + cValasAmountAddition;
      // var IDRAmountAddition = Number($('#IDRAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      // var ValasAmountAddition = Number($('#ValasAmountAddition_<?= $BankFacility['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      // iBRINominalAddition = IDRAmountAddition + ValasAmountAddition;

      // calculateBRINominal(iBRINominalAddition, cBRINominalAddition, <?= $BankFacility['BankFacilityItemAdditionId']; ?>, 'Addition');
      setZero('Amount', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
    });

    $('#ValasRateAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('focus', function() {
      removeZero('Rate', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
    });
    $('#ValasRateAddition_<?= $BankFacility['BankFacilityItemAdditionId']; ?>').on('blur', function() {
      setZero('Rate', <?= $BankFacility['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
    });
  <?php endforeach; ?>
  <?php } ?>

    $('.money').autoNumeric('init',{
      vMax: '<?=MAX_NUMERIC?>',
      vMin: '<?=MIN_NUMERIC?>',
      aDec: '.',
      aSep: ',',
      // mDec: '2',
      aPad: false,
    });
    $('.portion').autoNumeric('init',{
      aDec: '.',
      aSep: ',',
      mDec: '2',
      aPad: false,
      vMax: '999',
    });

  // $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').on('submit', function (e) {
  //   e.preventDefault();
  //   if(confirm('Anda yakin?')) {
   $('#OK').click(function(){
          $.ajax({
            type: 'post',
            url : $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').attr('action'),
            data: $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').serialize(),
              dataType : 'html',
            beforeSend:function(){
              $('#confirmModal').hide();
              $('.loaderImage').show();
            },
            error: function(jqXHR, textStatus, errorThrown){
              console.log(jqXHR);
              $('.loaderImage').hide();
              new PNotify({
                  title: 'Error!',
                  text: "Message : "+errorThrown,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 3000;
            },
            success: function(data){
              new PNotify({
                  title: 'Success!',
                  text: 'Data Saved',
                  type: 'success',
                  styling: 'bootstrap3'
              });
              
              PNotify.prototype.options.delay = 3000;

              setTimeout(function(){ 
                $('.loaderImage').hide();
                window.location.href= base_url+'tasklist/AccountPlanning/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
              }, 2000);
            }
          });
    // }
  });
  
});

</script>
