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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$FinancialHighlightGroupType);?>">Financial Highlights</a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Input Account Planning</li> -->
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left"><?= $FinancialHighlightGroupName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $FinancialHighlightGroupType; ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="row form_container">
                <!-- <div class="col-md-6 col-sm-6 col-xs-12 pull-left" style="text-align: right;">
                </div> -->
                <div class="col-md-4 col-sm-4 col-xs-12 pull-right" style="text-align: right;">
                  Notes : <span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes1?></span>
                </div>
                <table width="100%" cellpadding="2" cellspacing="2" style="color: #00000; font-size: 13px;">
                  <?php if (!empty($inputform[$FinancialHighlightGroupType])) {?>
                    <?php if($FinancialHighlightGroupId == 1) { ?>
                  <tr height="50">
                    <td>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Currency</label>
                        <?php
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group" data-toggle="buttons">
                            <!-- <button class="btn btn-<?= $FinancialHighlight['class_idr1'] ?>" onclick="update_currency(<?= $AccountPlanningId; ?>, 'IDR');">IDR</button>
                            <button class="btn btn-<?= $FinancialHighlight['class_usd1'] ?>" onclick="update_currency(<?= $AccountPlanningId; ?>, 'USD');">USD</button> -->
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="financial_highlight_currency" value="IDR" onchange="update_currency(<?= $AccountPlanningId; ?>, this.value);">  IDR 
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-active-class="btn-primary">
                              <input type="radio" name="financial_highlight_currency" value="USD" onchange="update_currency(<?= $AccountPlanningId; ?>, this.value);">  USD 
                            </label>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td></td>
                    <td colspan="2">
                    </td>
                  </tr>
                    <?php } ?>
                  <tr height="50">
                    <td></td>
                    <td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: center;"><?= $account_planning['Years'][0] ?></label></td>
                    <td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: center;"><?= $account_planning['Years'][1] ?></label></td>
                    <td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: center;"><?= $account_planning['Years'][2] ?></label></td>
                  </tr>
                  <?php foreach ($inputform[$FinancialHighlightGroupType] as $rows) : ?>
                    <?php
                      if ($rows['FinancialHighlightItemId'] == 12 || $rows['FinancialHighlightItemId'] == 18 || $rows['FinancialHighlightItemId'] == 19 || $rows['FinancialHighlightItemId'] == 20 || $rows['FinancialHighlightItemId'] == 22 || $rows['FinancialHighlightItemId'] == 21) {
                        $isDisabled = "disabled";
                      } else {
                        $isDisabled = "";
                      }

                    ?>
                    <?php if($FinancialHighlightGroupId == 1 && ($rows['FinancialHighlightItemId'] == 1 || $rows['FinancialHighlightItemId'] == 2)) { ?>
                  <tr>
                    <td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $rows['FinancialHighlightItemName'] ?></label></td>
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][0] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][0]]['Amount'] ?>" style="text-align: right;" id="InputAsset_<?=$rows['FinancialHighlightItemId']?>_<?= $account_planning['Years'][0] ?>" >
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][0] ?>][]" value="<?= $account_planning['Years'][0] ?>">
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][0] ?>][]" value="<?= $rows[$account_planning['Years'][0]]['FinancialHighlightId'] ?>">
                    </td>
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][1] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][1]]['Amount'] ?>" style="text-align: right;" id="InputAsset_<?=$rows['FinancialHighlightItemId']?>_<?= $account_planning['Years'][1] ?>">
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][1] ?>][]" value="<?= $account_planning['Years'][1] ?>">
                    </td>
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][1] ?>][]" value="<?= $rows[$account_planning['Years'][1]]['FinancialHighlightId'] ?>">
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][2] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][2]]['Amount'] ?>" style="text-align: right;" id="InputAsset_<?=$rows['FinancialHighlightItemId']?>_<?= $account_planning['Years'][2] ?>">
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][2] ?>][]" value="<?= $account_planning['Years'][2] ?>">
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][2] ?>][]" value="<?= $rows[$account_planning['Years'][2]]['FinancialHighlightId'] ?>">
                    </td>
                  </tr>
                    <?php }else if($FinancialHighlightGroupId == 1 && $rows['FinancialHighlightItemId'] == 3) { ?>
                  <tr>
                    <td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $rows['FinancialHighlightItemName'] ?></label></td>
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][0] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][0]]['Amount'] ?>" style="text-align: right;" disabled id="TotalAsset_<?=$rows['FinancialHighlightItemId']?>_<?= $account_planning['Years'][0] ?>">
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][0] ?>][]" value="<?= $account_planning['Years'][0] ?>">
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][0] ?>][]" value="<?= $rows[$account_planning['Years'][0]]['FinancialHighlightId'] ?>">
                    </td>
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][1] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][1]]['Amount'] ?>" style="text-align: right;" disabled id="TotalAsset_<?=$rows['FinancialHighlightItemId']?>_<?= $account_planning['Years'][1] ?>">
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][1] ?>][]" value="<?= $account_planning['Years'][1] ?>">
                    </td>
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][1] ?>][]" value="<?= $rows[$account_planning['Years'][1]]['FinancialHighlightId'] ?>">
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][2] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][2]]['Amount'] ?>" style="text-align: right;" disabled id="TotalAsset_<?=$rows['FinancialHighlightItemId']?>_<?= $account_planning['Years'][2] ?>">
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][2] ?>][]" value="<?= $account_planning['Years'][2] ?>">
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][2] ?>][]" value="<?= $rows[$account_planning['Years'][2]]['FinancialHighlightId'] ?>">
                    </td>
                  </tr>
                    <?php } else { ?>
                  <tr>
                    <td><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $rows['FinancialHighlightItemName'] ?></label></td>
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][0] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][0]]['Amount'] ?>" style="text-align: right;" <?= $isDisabled ?>>
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][0] ?>][]" value="<?= $account_planning['Years'][0] ?>">
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][0] ?>][]" value="<?= $rows[$account_planning['Years'][0]]['FinancialHighlightId'] ?>">
                    </td>
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][1] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][1]]['Amount'] ?>" style="text-align: right;" <?= $isDisabled ?>>
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][1] ?>][]" value="<?= $account_planning['Years'][1] ?>">
                    </td>
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][1] ?>][]" value="<?= $rows[$account_planning['Years'][1]]['FinancialHighlightId'] ?>">
                    <td>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="Amount[<?= $account_planning['Years'][2] ?>][<?= $rows['FinancialHighlightItemId'] ?>]" class="form-control col-md-7 col-xs-12 <?= $rows['FinancialHighlight_inputform_type'] ?>" data-a-dec="." value="<?= $rows[$account_planning['Years'][2]]['Amount'] ?>" style="text-align: right;" <?= $isDisabled ?>>
                      </div>
                      <input type="hidden" name="FinancialHighlightYears[<?= $account_planning['Years'][2] ?>][]" value="<?= $account_planning['Years'][2] ?>">
                      <input type="hidden" name="FinancialHighlightId[<?= $account_planning['Years'][2] ?>][]" value="<?= $rows[$account_planning['Years'][2]]['FinancialHighlightId'] ?>">
                    </td>
                  </tr>
                    <?php } ?>
                  <tr>
                    <td colspan="4" height="15">
                      <input type="hidden" name="FinancialHighlightItemId[]" value="<?= $rows['FinancialHighlightItemId']; ?>">
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <tr>
                    <td colspan="4" height="30">
                      <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="FinancialHighlightGroupType" value="<?= $FinancialHighlightGroupType; ?>">
                      <input type="hidden" name="FinancialHighlightSubmit" value="<?= $FinancialHighlightSubmit ?>">
                      <input type="hidden" name="InputTable" value="FinancialHighlight">
                    </td>
                  </tr>
                </table>
              </div>
              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$FinancialHighlightGroupType);?>'">BACK</button>
                    <!-- <button id="btn_save_edit_strategic_plan" class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right:0px;">SAVE</button> -->
                    <button class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right:0px;" onclick="confirmModal(); return false;">SAVE</button>
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
        <p id="confirmation_text1">You're about to saved Financial Highligts details. Are you sure?</p>
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

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }

  function toFixed(x) {
  if (Math.abs(x) < 1.0) {
    var e = parseInt(x.toString().split('e-')[1]);
    if (e) {
        x *= Math.pow(10,e-1);
        x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
    }
  } else {
    var e = parseInt(x.toString().split('+')[1]);
    if (e > 20) {
        e -= 20;
        x /= Math.pow(10,e);
        x += (new Array(e+1)).join('0');
    }
  }
  return x;
}

  <?php foreach ($account_planning['Years'] as $rows => $Val_year) : ?>
  $('#InputAsset_1_<?=$Val_year?>').on('blur', function() {
    var TotalAsset_3_<?=$Val_year?> = 0;
    var InputAsset_1_<?=$Val_year?> = 0;
    if($('#InputAsset_1_<?=$Val_year?>').val() != ''){
      var aInputAsset_1_<?=$Val_year?> = $('#InputAsset_1_<?=$Val_year?>').val();
      var InputAsset_1_<?=$Val_year?> = toFixed(aInputAsset_1_<?=$Val_year?>.replace(/,/g, ""));
    }
    var InputAsset_2_<?=$Val_year?> = 0;
    if($('#InputAsset_2_<?=$Val_year?>').val() != ''){
      var bInputAsset_2_<?=$Val_year?> = $('#InputAsset_2_<?=$Val_year?>').val();
      var InputAsset_2_<?=$Val_year?> = toFixed(bInputAsset_2_<?=$Val_year?>.replace(/,/g, ""));
    }

  // console.log("InputAsset_1_<?=$Val_year?>:"+InputAsset_1_<?=$Val_year?>);
  // console.log("InputAsset_2_<?=$Val_year?>:"+InputAsset_2_<?=$Val_year?>);
  // console.log("cTotalAsset_3_<?=$Val_year?>:"+cTotalAsset_3_<?=$Val_year?>);

    var cTotalAsset_3_<?=$Val_year?> = parseInt(InputAsset_1_<?=$Val_year?>) + parseInt(InputAsset_2_<?=$Val_year?>);
    var TotalAsset_3_<?=$Val_year?> = formatNumber(toFixed(cTotalAsset_3_<?=$Val_year?>));

    if (isNaN(cTotalAsset_3_<?=$Val_year?>) == false) {
      $('#TotalAsset_3_<?=$Val_year?>').val(TotalAsset_3_<?=$Val_year?>);
    }
  });

  $('#InputAsset_2_<?=$Val_year?>').on('blur', function() {
    var TotalAsset_3_<?=$Val_year?> = 0;
    var InputAsset_1_<?=$Val_year?> = 0;
    if($('#InputAsset_1_<?=$Val_year?>').val() != ''){
      var aInputAsset_1_<?=$Val_year?> = $('#InputAsset_1_<?=$Val_year?>').val();
      var InputAsset_1_<?=$Val_year?> = toFixed(aInputAsset_1_<?=$Val_year?>.replace(/,/g, ""));
    }
    var InputAsset_2_<?=$Val_year?> = 0;
    if($('#InputAsset_2_<?=$Val_year?>').val() != ''){
      var bInputAsset_2_<?=$Val_year?> = $('#InputAsset_2_<?=$Val_year?>').val();
      var InputAsset_2_<?=$Val_year?> = toFixed(bInputAsset_2_<?=$Val_year?>.replace(/,/g, ""));
    }

    var cTotalAsset_3_<?=$Val_year?> = parseInt(InputAsset_1_<?=$Val_year?>) + parseInt(InputAsset_2_<?=$Val_year?>);
    var TotalAsset_3_<?=$Val_year?> = formatNumber(toFixed(cTotalAsset_3_<?=$Val_year?>));

  // console.log("InputAsset_1_<?=$Val_year?>:"+InputAsset_1_<?=$Val_year?>);
  // console.log("InputAsset_2_<?=$Val_year?>:"+InputAsset_2_<?=$Val_year?>);
  // console.log("cTotalAsset_3_<?=$Val_year?>:"+cTotalAsset_3_<?=$Val_year?>);

    if (isNaN(cTotalAsset_3_<?=$Val_year?>) == false) {
      $('#TotalAsset_3_<?=$Val_year?>').val(TotalAsset_3_<?=$Val_year?>);
    }
  });

<?php endforeach; ?>


  function update_currency(AccountPlanningId, FinancialHighlightCurrency) {
      $.ajax({type: "GET",
          url: base_url + 'tasklist/AccountPlanning/update_currency/'+AccountPlanningId+'/'+ FinancialHighlightCurrency,
          data: '',
          beforeSend: function() {
              $('.loaderImage').show();
          },
          success:function(result) {
              $('.loaderImage').hide();
              //location.reload();
          },
          error:function(result) {
            alert('error');
          }
      });
  }

  $(document).ready(function() {

    $('.total').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '<?=MAX_NUMERIC_TOTAL?>',
      vMin: '<?=MIN_NUMERIC_TOTAL?>',
      unformatOnSubmit: true,
      aPad: false,
    });

    $('.money').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '<?=MAX_NUMERIC?>',
      vMin: '<?=MIN_NUMERIC?>',
      unformatOnSubmit: true,
      aPad: false,
    });
    $('.portion').autoNumeric('init',{
      aForm: true,
      mDec: '2',
      // vMax: '100',
      unformatOnSubmit: true
    });
    $('.portion2').autoNumeric('init',{
      aForm: true,
      mDec: '2',
      // vMax: '999',
      unformatOnSubmit: true
    });

    // $('#add-<?= $AccountPlanningTab; ?>-<?= $FinancialHighlightGroupType; ?>').on('submit', function (e) {
    //   e.preventDefault();
    //   if(confirm('Anda yakin?')) {
   $('#OK').click(function(){
        $.ajax({
          type: 'post',
          url : $('#add-<?= $AccountPlanningTab; ?>-<?= $FinancialHighlightGroupType; ?>').attr('action'),
          data: $('#add-<?= $AccountPlanningTab; ?>-<?= $FinancialHighlightGroupType; ?>').serialize(),
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
             window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $FinancialHighlightGroupType; ?>';
              $('.loaderImage').hide();
            }, 2000);
          }
        });
      // }
    });
      
  });

</script>


