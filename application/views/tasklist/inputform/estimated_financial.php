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
                      <li class="breadcrumb-item"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/action_plans');?>">Action Plans</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/action_plans/'.$BankFacilityGroupType);?>">Estimated Financial</a></li>
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
                  Notes : <span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes1?></span>
                </div>
                <table width="100%" cellpadding="2" cellspacing="2" style="color: #00000; font-size: 13px;">
                  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancial_detail'])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancial_detail'] as $rows => $EstimatedFinancial) : ?>
                  <tr>
                    <td style="vertical-align: bottom;" width="20%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $EstimatedFinancial['BankFacilityItemName'] ?></label></td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Projection Customer By IDR</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRProjection[]" id="IDRProjection_<?= $EstimatedFinancial['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $EstimatedFinancial['IDRProjection'] ?>" style="text-align: right;"></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Projection Customer By Valas</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasProjection[]" id="ValasProjection_<?= $EstimatedFinancial['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-dec="." value="<?= $EstimatedFinancial['ValasProjection'] ?>" style="text-align: right;"></div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Target BRI By IDR</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRTarget[]" id="IDRTarget_<?= $EstimatedFinancial['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $EstimatedFinancial['IDRTarget'] ?>" style="text-align: right;"></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Target BRI By Valas</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasTarget[]" id="ValasTarget_<?= $EstimatedFinancial['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-dec="." value="<?= $EstimatedFinancial['ValasTarget'] ?>" style="text-align: right;"></div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <div id="errIDR_<?= $EstimatedFinancial['BankFacilityItemId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px;">Target IDR harus lebih kecil dari Projection IDR</label>
                      </div>
                    </td>
                    <td>
                      <div id="errValas_<?= $EstimatedFinancial['BankFacilityItemId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px; width: 373px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px; width: 373px;">Target Valas harus lebih kecil dari Projection Valas</label>
                      </div>
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #ddd;">
                    <td colspan="4" height="30">
                      <input type="hidden" name="BankFacilityItemId[]" value="<?= $EstimatedFinancial['BankFacilityItemId']; ?>">
                      <input type="hidden" name="EstimatedFinancialId[]" value="<?= $EstimatedFinancial['EstimatedFinancialId']; ?>">
                      <input type="hidden" name="VCIF[]" value="<?= $VCIF; ?>">
                      <input type="hidden" name="EstimatedFinancialSubmit[]" value="<?= $EstimatedFinancial['EstimatedFinancialSubmit']; ?>">
                      <input type="hidden" name="InputTable" value="EstimatedFinancial">
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancialAddition_detail'])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancialAddition_detail'] as $rows => $EstimatedFinancialAddition) : ?>
                  <tr>
                    <td style="vertical-align: bottom;" width="20%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $EstimatedFinancialAddition['BankFacilityItemAdditionName'] ?></label></td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Projection Customer By IDR</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRProjectionAddition[]" id="IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $EstimatedFinancialAddition['IDRProjectionAddition'] ?>" style="text-align: right;"></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Projection Customer By Valas</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasProjectionAddition[]" id="ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $EstimatedFinancialAddition['ValasProjectionAddition'] ?>" style="text-align: right;"></div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Target BRI By IDR</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRTargetAddition[]" id="IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $EstimatedFinancialAddition['IDRTargetAddition'] ?>" style="text-align: right;"></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Target BRI By Valas</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasTargetAddition[]" id="ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId']; ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $EstimatedFinancialAddition['ValasTargetAddition'] ?>" style="text-align: right;"></div>
                    </td>
                  </tr>
                    <td></td>
                    <td>
                      <div id="errIDRAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px;">Target IDR harus lebih kecil dari Projection IDR</label>
                      </div>
                    </td>
                    <td>
                      <div id="errValasAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>" style="display: none; padding-left: 10px; padding-right: 10px; width: 373px;">
                        <label class="label label-warning" style="text-align: center; padding: 5px; font-weight: normal; font-size: 12px; width: 373px;">Target Valas harus lebih kecil dari Projection Valas</label>
                      </div>
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #ddd;">
                    <td colspan="4" height="30">
                      <input type="hidden" name="BankFacilityItemAdditionId[]" value="<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId']; ?>">
                      <input type="hidden" name="EstimatedFinancialAdditionId[]" value="<?= $EstimatedFinancialAddition['EstimatedFinancialAdditionId']; ?>">
                      <input type="hidden" name="EstimatedFinancialAdditionSubmit[]" value="<?= $EstimatedFinancialAddition['EstimatedFinancialAdditionSubmit']; ?>">
                      <input type="hidden" name="InputTableAddition" value="EstimatedFinancialAddition">
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <tr>
                    <td colspan="4">
                      <input type="hidden" name="VCIF" value="<?= $VCIF; ?>">
                      <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                    </td>
                  </tr>
                </table>

              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/action_plans/'.$BankFacilityGroupType);?>'">BACK</button>
                    <button id="btn_save_edit_estimated_financial" class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right: 0px;" onclick="isValid(); return false;">SAVE</button>
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
        <p id="confirmation_text1">You're about to saved Estimated Financial details. <br>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK2" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation 2</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK2" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
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


  function isValid() {

    $(document).ready(function() {

      var errCount = 0;

    <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancial_detail'])) {?>
    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancial_detail'] as $rows => $values) : ?>
        var IDRTarget_<?= $values['BankFacilityItemId'] ?> = Number($('#IDRTarget_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
        var IDRProjection_<?= $values['BankFacilityItemId'] ?> = Number($('#IDRProjection_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
        var ValasTarget_<?= $values['BankFacilityItemId'] ?> = Number($('#ValasTarget_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
        var ValasProjection_<?= $values['BankFacilityItemId'] ?> = Number($('#ValasProjection_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));


        if (IDRProjection_<?= $values['BankFacilityItemId'] ?> != 0 || IDRTarget_<?= $values['BankFacilityItemId'] ?> != 0) {
          if (IDRProjection_<?= $values['BankFacilityItemId'] ?> < IDRTarget_<?= $values['BankFacilityItemId'] ?>) {
            errCount = errCount+1;
            $('#errIDR_<?= $values['BankFacilityItemId'] ?>').show();
            $(".btn_save").attr("disabled", true);
          }
        }

        if (ValasProjection_<?= $values['BankFacilityItemId'] ?> != 0 || ValasTarget_<?= $values['BankFacilityItemId'] ?> != 0) {
          if (ValasProjection_<?= $values['BankFacilityItemId'] ?> < ValasTarget_<?= $values['BankFacilityItemId'] ?>) {
            errCount = errCount+1;
            $('#errValas_<?= $values['BankFacilityItemId'] ?>').show();
            $(".btn_save").attr("disabled", true);
          }
        }

    <?php endforeach; ?>
    <?php } ?>

    <?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancialAddition_detail'])) {?>
    <?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancialAddition_detail'] as $rows => $EstimatedFinancialAddition) : ?>
        var IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
        var IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
        var ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
        var ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

        if (IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> != 0 && IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> != 0) {
          if (IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> < IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>) {
            errCount = errCount+1;
            $('#errIDRAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').show();
            $(".btn_save").attr("disabled", true);
          }
        }   

        if (ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> != 0 && ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> != 0) {
          if (ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> < ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>) {
            errCount = errCount+1;
            $('#errValasAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').show();
            $(".btn_save").attr("disabled", true);
          }
        }

    <?php endforeach; ?>
    <?php } ?>

      if (errCount == 0) {
        $('#confirmModal').modal('show');
        // if(confirm('Anda yakin?')) {
        //   $.ajax({
        //     type: 'post',
        //     url : $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').attr('action'),
        //     data: $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').serialize(),
        //       dataType : 'html',
        //     beforeSend:function(){
        //       $('.loaderImage').show();
        //     },
        //     error: function(jqXHR, textStatus, errorThrown){
        //       console.log(jqXHR);
        //       $('.loaderImage').hide();
        //       new PNotify({
        //           title: 'Error!',
        //           text: "Message : "+errorThrown,
        //           type: 'error',
        //           styling: 'bootstrap3'
        //       });

        //       PNotify.prototype.options.delay = 1200;
        //     },
        //     success: function(data){
        //       new PNotify({
        //           title: 'Success!',
        //           text: 'Data Saved',
        //           type: 'success',
        //           styling: 'bootstrap3'
        //       });
              
        //       PNotify.prototype.options.delay = 1200;
                
        //       setTimeout(function(){ 
        //         window.location.href= base_url+'tasklist/AccountPlanning/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
        //         $('.loaderImage').hide();
        //       }, 2000);
        //     }
        //   });
        // }

      }
    });

  }

$(document).ready(function() {
  $('#OK').click(function(){
    console.log('asdasd');
      // $('#confirmModal').modal('hide');
      $('#confirmModal2').modal('show');
  });
  $('#OK2').click(function(){
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
            window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
            $('.loaderImage').hide();
          }, 2000);
        }
      });
  });


  $(".btn_save").attr("disabled", true);

<?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancial_detail'])) {?>
<?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancial_detail'] as $rows => $values) : ?>
  $('#IDRProjection_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
    removeZero('Projection', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
  });
  $('#IDRProjection_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
    setZero('Projection', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
  });
  $('#IDRTarget_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
    removeZero('Target', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
  });
  $('#IDRTarget_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
    setZero('Target', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    var IDRTarget_<?= $values['BankFacilityItemId'] ?> = Number($('#IDRTarget_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
    var IDRProjection_<?= $values['BankFacilityItemId'] ?> = Number($('#IDRProjection_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

    if (IDRProjection_<?= $values['BankFacilityItemId'] ?> >= IDRTarget_<?= $values['BankFacilityItemId'] ?>) {
      $('#errIDR_<?= $values['BankFacilityItemId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else {
      $('#errIDR_<?= $values['BankFacilityItemId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }

    var ValasTarget_<?= $values['BankFacilityItemId'] ?> = Number($('#ValasTarget_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
    var ValasProjection_<?= $values['BankFacilityItemId'] ?> = Number($('#ValasProjection_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

    if (ValasProjection_<?= $values['BankFacilityItemId'] ?> >= ValasTarget_<?= $values['BankFacilityItemId'] ?>) {
      $('#errValas_<?= $values['BankFacilityItemId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else {
      $('#errValas_<?= $values['BankFacilityItemId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }

  });

  $('#ValasProjection_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
    removeZero('Projection', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
  });
  $('#ValasProjection_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
    setZero('Projection', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
  });
  $('#ValasTarget_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
    removeZero('Target', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
  });
  $('#ValasTarget_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
    setZero('Target', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    var ValasTarget_<?= $values['BankFacilityItemId'] ?> = Number($('#ValasTarget_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
    var ValasProjection_<?= $values['BankFacilityItemId'] ?> = Number($('#ValasProjection_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

    if (ValasProjection_<?= $values['BankFacilityItemId'] ?> >= ValasTarget_<?= $values['BankFacilityItemId'] ?>) {
      $('#errValas_<?= $values['BankFacilityItemId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else {
      $('#errValas_<?= $values['BankFacilityItemId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }
  });
<?php endforeach; ?>
<?php } ?>
<?php if (isset($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancialAddition_detail'])) {?>
<?php foreach ($inputform[$BankFacilityGroupType][$BankFacilityGroupId]['EstimatedFinancialAddition_detail'] as $rows => $EstimatedFinancialAddition) : ?>
  $('#IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
    removeZero('Projection', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
  });
  $('#IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
    setZero('Projection', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
  });
  $('#IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
    removeZero('Target', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
  });
  $('#IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
    setZero('Target', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
    var IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
    var IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

    // console.log(IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>);
    // console.log(IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>);

    if (IDRProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> >= IDRTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>) {
      $('#errIDRAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else {
      $('#errIDRAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }
  });

  $('#ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
    removeZero('Projection', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
  });
  $('#ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
    setZero('Projection', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
  });
  $('#ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
    removeZero('Target', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
  });
  $('#ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
    setZero('Target', <?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
    var ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
    var ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> = Number($('#ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

    if (ValasProjectionAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?> >= ValasTargetAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>) {
      $('#errValasAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').hide();
      $(".btn_save").attr("disabled", false);
    }
    else {
      $('#errValasAddition_<?= $EstimatedFinancialAddition['BankFacilityItemAdditionId'] ?>').show();
      $(".btn_save").attr("disabled", true);
    }
  });
<?php endforeach; ?>
<?php } ?>

  $('.money').autoNumeric('init',{
    aForm: true,
    mDec: '0',
    vMax: '<?=MAX_NUMERIC?>',
    vMin: '<?=MIN_NUMERIC?>',
    unformatOnSubmit: true
  });
  $('.portion').autoNumeric('init',{
    aForm: true,
    mDec: '0',
    vMax: '100',
    unformatOnSubmit: true
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
