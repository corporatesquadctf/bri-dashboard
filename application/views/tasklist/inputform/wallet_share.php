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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/bri_starting_position');?>">BRI Starting Position</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$BankFacilityGroupType);?>">Wallet Share</a></li>
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
                <table width="100%" cellpadding="2" cellspacing="2" style="color: #00000; font-size: 13px;">
                  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletShares_detail'])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletShares_detail'] as $rows => $values) : ?>
                  <tr>
                    <td style="vertical-align: bottom;" width="20%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $values['BankFacilityItemName'] ?></label></td>
                    <td width="25%">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Total</label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="TotalAmount[]" id="TotalAmount_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-12 col-xs-12 total" data-a-sep="," value="<?= $values['TotalAmount'] ?>" style="text-align: right;">
                        <input type="hidden" name="oldTotalAmount[]" value="<?= $values['TotalAmount'] ?>">
                      </div>
                    </td>
                    <td width="25%">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">BRI Nominal</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="BRINominal_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['BRINominal'] ?>" readonly>
                        <input type="hidden" name="BRINominal[]" value="<?= $values['BRINominal'] ?>"></div>
                    </td>
                    <!-- <td width="25%">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Other Nominal</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="OtherNominal_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['OtherNominal'] ?>" readonly>
                        <input type="hidden" name="OtherNominal[]" id="OtherNominalHidden_<?= $values['BankFacilityItemId'] ?>" value="<?= $values['OtherNominal'] ?>"></div>
                    </td> -->
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" height="30">
                      <div id="errTotalAmount_<?= $values['BankFacilityItemId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px;">Total harus lebih besar dari BRI Nominal</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <input type="hidden" name="BankFacilityItemId[]" value="<?= $values['BankFacilityItemId']; ?>">
                      <input type="hidden" name="WalletShareId[]" value="<?= $values['WalletShareId']; ?>">
                      <input type="hidden" name="WalletShareSubmit[]" value="<?= $values['WalletShareSubmit']; ?>">
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <?php if (!empty($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletSharesAddition_detail'])) {?>
                    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletSharesAddition_detail'] as $rows => $WalletSharesAddition) : ?>
                      <tr>
                      <td style="vertical-align: bottom;" width="20%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $WalletSharesAddition['BankFacilityItemAdditionName'] ?></label></td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Total</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="TotalAmountAddition[]" id="TotalAmountAddition_<?= $WalletSharesAddition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $WalletSharesAddition['TotalAmountAddition'] ?>" style="text-align: right;">
                        <input type="hidden" name="oldTotalAmountAddition[]" value="<?= $WalletSharesAddition['TotalAmountAddition'] ?>">
                        </div>
                      </td>
                      <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">BRI Nominal</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="BRINominalAddition_<?= $WalletSharesAddition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $WalletSharesAddition['BRINominalAddition'] ?>" readonly>
                          <input type="hidden" name="BRINominalAddition[]" value="<?= $WalletSharesAddition['BRINominalAddition'] ?>"></div>
                      </td>
                      <!-- <td>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Other Nominal</label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="OtherNominalAddition_<?= $WalletSharesAddition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $WalletSharesAddition['OtherNominalAddition'] ?>" readonly>
                          <input type="hidden" name="OtherNominalAddition[]" id="OtherNominalAdditionHidden_<?= $WalletSharesAddition['BankFacilityItemAdditionId'] ?>" value="<?= $WalletSharesAddition['OtherNominalAddition'] ?>"></div>
                      </td> -->
                    </tr>
                  <tr>
                    <td></td>
                    <td colspan="3" height="30">
                      <div id="errTotalAmountAddition_<?= $WalletSharesAddition['BankFacilityItemAdditionId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px;">Total harus lebih besar dari BRI Nominal</label>
                      </div>
                    </td>
                  </tr>
                    <tr>
                      <td colspan="4">
                        <input type="hidden" name="BankFacilityItemAdditionId[]" value="<?= $WalletSharesAddition['BankFacilityItemAdditionId']; ?>">
                        <input type="hidden" name="WalletShareAdditionId[]" value="<?= $WalletSharesAddition['WalletShareAdditionId']; ?>">
                        <input type="hidden" name="WalletShareAdditionSubmit[]" value="<?= $WalletSharesAddition['WalletShareSubmitAddition']; ?>">
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  <?php } ?>
                  <tr>
                    <td colspan="4">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                      <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="VCIF" value="<?= $VCIF; ?>">
                      <input type="hidden" name="InputTable" value="WalletShare">
                      <input type="hidden" name="InputTableAddition" value="WalletShareAddition">
                    </td>
                  </tr>
                </table>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$BankFacilityGroupType);?>'">BACK</button>
                    <!-- <button class="btn btn-sm btn-primary btn_save" type="submit" style="width: 200px;" onclick="isValid(); return false;">SAVE</button> -->
                    <button class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right: 0px;" onclick="confirmModal(); return false;">SAVE</button>
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
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">You're about to change Wallet Share details. <br>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok" onclick="isValid(); return false;">OK</button>
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
    var Currency = Currency;
    if ($('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('get') == 0) {
      $('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('set', '');
    }
  }

  function calculateOtherNominal(Total, BRINominal, ItemId, ItemType) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }

    if (Total > 0) {
      aTotal = Total;
    } else {
      aTotal = 0;
    }

    if (BRINominal > 0) {
      aBRINominal = BRINominal;
    } else {
      aBRINominal = 0;
    }

    bOtherNominal = aTotal - aBRINominal;
    // console.log(aTotal);
    // console.log(aBRINominal);
    console.log(bOtherNominal);

    // $('#OtherNominal' + aItemType + aItemId).autoNumeric('set',bOtherNominal);
    // $('#OtherNominalHidden' + aItemType + aItemId).val(bOtherNominal);
  }

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function isValid() {
    $(document).ready(function() {
      var errCount = 0;
    <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletShares_detail'])) {?>
    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletShares_detail'] as $rows => $values) : ?>

      var BRINominal = Number($('#BRINominal_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var TotalAmount = Number($('#TotalAmount_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

      if (TotalAmount < BRINominal) {
        calculateOtherNominal(TotalAmount, BRINominal, <?= $values['BankFacilityItemId'] ?>, '');
        errCount = errCount+1;
        $('#errTotalAmount_<?= $values['BankFacilityItemId'] ?>').show();
        $(".btn_save").attr("disabled", true);
      }

    <?php endforeach; ?>
    <?php } ?>

    <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletSharesAddition_detail'])) {?>
    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletSharesAddition_detail'] as $rows => $values) : ?>

      var BRINominalAddition = Number($('#BRINominalAddition_<?= $values['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var TotalAmountAddition = Number($('#TotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

      if (TotalAmountAddition < BRINominalAddition) {
        calculateOtherNominal(TotalAmountAddition, BRINominalAddition, <?= $values['BankFacilityItemAdditionId'] ?>, 'Addition');
        errCount = errCount+1;
        $('#errTotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').show();
        $(".btn_save").attr("disabled", true);
      }

    <?php endforeach; ?>
    <?php } ?>

      if (errCount == 0) {
        // $('#confirmModal').modal('show');
        // if(confirm('Anda yakin?')) {
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
              $('.modal-backdrop.in').hide();
              console.log(jqXHR);
              $('.loaderImage').hide();
              new PNotify({
                  title: 'Error!',
                  text: "Message : "+errorThrown,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
            },
            success: function(data){
              new PNotify({
                  title: 'Success!',
                  text: 'Data Saved',
                  type: 'success',
                  styling: 'bootstrap3'
              });
              
              PNotify.prototype.options.delay = 1200;
              
              setTimeout(function(){ 
                window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
                $('.loaderImage').hide();
              }, 2000);
            }
          });
        // }
      }
    });
  }

$(document).ready(function() {
  // $(".btn_save").attr("disabled", true);

<?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletShares_detail'])) {?>
<?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletShares_detail'] as $rows => $values) : ?>

  $('#TotalAmount_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
    removeZero('TotalAmount', <?= $values['BankFacilityItemId'] ?>, '', '');
  });
  $('#TotalAmount_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
    setZero('TotalAmount', <?= $values['BankFacilityItemId'] ?>, '', '');

    var BRINominal = Number($('#BRINominal_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
    var TotalAmount = Number($('#TotalAmount_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

    console.log(BRINominal);
    console.log(TotalAmount);

    if (TotalAmount >= BRINominal) {
      calculateOtherNominal(TotalAmount, BRINominal, <?= $values['BankFacilityItemId'] ?>, '');
      $('#errTotalAmount_<?= $values['BankFacilityItemId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else if (TotalAmount < BRINominal) {
      $('#errTotalAmount_<?= $values['BankFacilityItemId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }
  });

<?php endforeach; ?>
<?php } ?>

<?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletSharesAddition_detail'])) {?>
<?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['WalletSharesAddition_detail'] as $rows => $values) : ?>

  $('#TotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').on('focus', function() {
    removeZero('TotalAmount', <?= $values['BankFacilityItemAdditionId'] ?>, 'Addition', '');
  });
  $('#TotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').on('blur', function() {
    setZero('TotalAmount', <?= $values['BankFacilityItemAdditionId'] ?>, 'Addition', '');
    var BRINominalAddition = Number($('#BRINominalAddition_<?= $values['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
    var TotalAmountAddition = Number($('#TotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

    if (TotalAmountAddition >= BRINominalAddition) {
      calculateOtherNominal(TotalAmountAddition, BRINominalAddition, <?= $values['BankFacilityItemAdditionId'] ?>, 'Addition');
      $('#errTotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else if (TotalAmountAddition < BRINominalAddition) {
      $('#errTotalAmountAddition_<?= $values['BankFacilityItemAdditionId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }
  });

<?php endforeach; ?>
<?php } ?>

    $('.total').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '<?=MAX_NUMERIC_TOTAL?>',
      vMin: '<?=MIN_NUMERIC_TOTAL?>',
      unformatOnSubmit: false,
      aPad: false,
    });

    $('.money').autoNumeric('init',{
      aForm: true,
      vMax: '<?=MAX_NUMERIC?>',
      vMin: '<?=MIN_NUMERIC?>',
      mDec: '2',
      unformatOnSubmit: false,
      aPad: false,
    });
    $('.portion').autoNumeric('init',{
      aForm: true,
      mDec: '2',
      aPad: false,
      // vMax: '999',
      unformatOnSubmit: true
    });

    $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').validate({
        rules: {
            plafond: {
                required: true,
                plafondRestriction: true
            }
        }
    });
/*
  $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').on('submit', function (e) {
    e.preventDefault();
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

            PNotify.prototype.options.delay = 1200;
          },
          success: function(data){
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });
            
            PNotify.prototype.options.delay = 1200;
            
            setTimeout(function(){ 
              window.location.href= base_url+'tasklist/AccountPlanning/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
              $('.loaderImage').hide();
            }, 2000);
          }
        });
      }
  });
*/    
});

</script>
