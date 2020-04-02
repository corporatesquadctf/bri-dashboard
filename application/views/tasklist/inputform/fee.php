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
  .shadow_content_container {
      margin: 0;
      padding: 0;
      box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
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
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/simulation');?>">Credit Simulation</a></li>
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left">Fee</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <table width="100%" style="color: #00000; font-size: 13px; margin-top: 20px;">
                  <?php if (!empty($inputform[$BankFacilityGroupType])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType] as $rows => $values) : ?>
                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
                    <!-- <tr>
                      <th colspan="4"><?= $values['FeeTypeName'] ?></th>
                    </tr> -->
                    <tr>
                      <th style="width: 30%"></th>
                      <th style="width: 35%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                      <th style="width: 35%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th><?= $values['FeeTypeName'] ?></th>
                      <?php if ($values['FeeTypeId'] == 1 || $values['FeeTypeId'] == 2) { ?>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <input type="text" name="IDRAmount[]" id="IDRAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['IDRAmount'] ?>" style="text-align: right;" disabled>
                        <input type="hidden" name="IDRAmount[]" value="<?= $values['IDRAmount'] ?>"></td>
                      </td>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <input type="text" name="ValasAmount[]" id="ValasAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['ValasAmount'] ?>" style="text-align: right;" disabled>
                        <input type="hidden" name="ValasAmount[]" value="<?= $values['ValasAmount'] ?>"></td>
                      </td>
                      <?php } else if ($values['FeeTypeId'] == 6 || $values['FeeTypeId'] == 7) { ?>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <input type="text" name="IDRAmount[]" id="IDRAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="0" style="text-align: right;" disabled>
                        <input type="hidden" name="IDRAmount[]" value="0"></td>
                      </td>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <input type="text" name="ValasAmount[]" id="ValasAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="0" style="text-align: right;" disabled>
                        <input type="hidden" name="ValasAmount[]" value="0"></td>
                      </td>
                      <?php } else if ($values['FeeTypeId'] == 13) { ?>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <?php
                          $Ppap_dropdown = array(0 => '0'
                                                , 1 => '1'
                                                , 5 => '5'
                                                , 15 => '15'
                                                , 50 => '50'
                                                , 100 => '100'
                                              );
                          echo form_dropdown('IDRAmount[]', $Ppap_dropdown, $values['IDRAmount'], ' class="form-control col-md-7 col-xs-12" style="width: 30%;"');
                        ?>
                        <!-- <input type="text" name="IDRAmount[]" id="IDRAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values['IDRAmount'] ?>" style="text-align: right; width: 50%;"> --><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label>
                      </td>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <?php
                          echo form_dropdown('ValasAmount[]', $Ppap_dropdown, $values['ValasAmount'], ' class="form-control col-md-7 col-xs-12" style="width: 30%;"');

                        ?>
                        <!-- <input type="text" name="ValasAmount[]" id="ValasAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values['ValasAmount'] ?>" style="text-align: right; width: 50%;"> --><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label>
                      </td>
                      <?php } else {  ?>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <input type="text" name="IDRAmount[]" id="IDRAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['IDRAmount'] ?>" style="text-align: right;">
                      </td>
                      <td style="padding-right: 20px; padding-left: 20px;">
                        <input type="text" name="ValasAmount[]" id="ValasAmount_<?= $values['FeeTypeId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['ValasAmount'] ?>" style="text-align: right;">
                      </td>
                      <?php } ?>
                    </tr>
                  </tbody>
                    <tr>
                      <td colspan="3" height="30">
                        <input type="hidden" name="FeeTypeId[]" value="<?= $values['FeeTypeId']; ?>">
                        <input type="hidden" name="CreditSimulationFeeId[]" value="<?=$values['CreditSimulationFeeId']?>">
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <tr>
                    <td colspan="4">
                      <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                      <input type="hidden" name="CreditSimulationFeeSubmit" value="<?= $CreditSimulationFeeSubmit; ?>">
                      <input type="hidden" name="InputTable" value="CreditSimulationFee">
                    </td>
                  </tr>
                </table>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/simulation');?>'">BACK</button>
                    <!-- <button class="btn btn-sm btn-primary btn_save" type="submit" style="width: 200px;">SAVE</button> -->
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
        <p id="confirmation_text1">You're about to saved Input Fee details. <br>Are you sure?</p>
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
    // vMax: '999999999999999999999999',
    vMax: '<?=MAX_NUMERIC?>',
    vMin: '<?=MIN_NUMERIC?>',
    unformatOnSubmit: true
  });
  $('.portion').autoNumeric('init',{
    aForm: true,
    mDec: '2',
    vMax: '100',
    unformatOnSubmit: true
  });

  // $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').on('submit', function (e) {
  //   e.preventDefault();
  //     if(confirm('Your\'e about to saved Input Fee details. \nAre you sure?')) {
    $('#OK').click(function(){
      $.ajax({
        type: 'post',
        url : $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').attr('action'),
        data: $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').serialize(),
          dataType : 'json',
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
          success: function(response){
            console.log(response);
            if(response.status === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Data Saved',
                  type: 'success',
                  styling: 'bootstrap3'
              });
              
              PNotify.prototype.options.delay = 3000;
              
              setTimeout(function(){ 
                window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>';
                $('.loaderImage').hide();
              }, 2000);
            }
            else if(response.status === 'error'){
              $('.modal-backdrop.in').hide();
              $('.loaderImage').hide();
              new PNotify({
                  title: 'Response Error!',
                  text: response.message,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 3000;
              setTimeout(function(){
                window.location.reload();
              }, 2000);
            }          
          }
      });
    // }
  });

  <?php if (!empty($inputform[$BankFacilityGroupType])) {?>
  <?php foreach ($inputform[$BankFacilityGroupType] as $rows => $values) : ?>

    $('#IDRAmount_<?= $values['FeeTypeId'] ?>').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#IDRAmount_<?= $values['FeeTypeId'] ?>').on('blur', function() {
      if($(this).val() == ''){$(this).val(0.00);}
    });
    $('#ValasAmount_<?= $values['FeeTypeId'] ?>').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#ValasAmount_<?= $values['FeeTypeId'] ?>').on('blur', function() {
      if($(this).val() == ''){$(this).val(0.00);}
    });

  <?php endforeach; ?>
  <?php } ?>
    
});

</script>
