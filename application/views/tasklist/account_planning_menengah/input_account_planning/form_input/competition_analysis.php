<style>
.error {
    font-weight: normal !important;
    color: #f00 !important;
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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning');?>">Manage Account Planning Menengah</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/bri_starting_position');?>">BRI Starting Position</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/bri_starting_position/'.$FacilitiesBankingGroupType);?>">Competition Analysis</a></li>
                  </ol>
                </nav>
                <div class="page_title" style="padding: 1px 5px 6px;">
                    <div class="pull-left"><?= $FacilitiesBankingGroupName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="padding: 10px 0;">
          <div class="x_content" style="padding: 0 0 6px;">
            <form class="form-horizontal" id="form-competition-analysis" method="POST" action="<?= site_url('tasklist/account_planning_menengah/manage_account_planning/process_input_competition_analysis') ?>" style="text-align: left;">
              <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
              <input type="hidden" id="mainTab" name="mainTab" value="<?= $AccountPlanningTab; ?>" />
              <input type="hidden" id="secondTab" name="secondTab" value="<?= $FacilitiesBankingGroupType; ?>" />
              <input type="hidden" id="facilitiesBankingGroupId" name="facilitiesBankingGroupId" value="<?= $FacilitiesBankingGroupId; ?>" />
              
              <div id="facilities-banking-item-container">
                <?php foreach($FacilitiesBankingItem as $row): ?>
                  <div class="row form-group form_container">
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label><?= $row->Name; ?> ( Total: <?= number_format($row->OtherNominal, 2); ?> )</label>
                            <input type="hidden" id="total_<?= $row->BankFacilityItemMenengahId; ?>" value="<?= $row->OtherNominal; ?>" >
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label>Bank Name #1:</label>
                            <select class="form-control js-example-basic-single" id="bank1_<?= $row->BankFacilityItemMenengahId; ?>" name="bank1_<?= $row->BankFacilityItemMenengahId; ?>" style="width:100%;">
                              <option value="0">Please Choose</option>
                              <?php
                                foreach ($Bank as $rowBank){
                                  $selected = "";
                                  if($rowBank->BankId == $row->BankId1) $selected = "selected='selected'";
                                  echo "<option value='".$rowBank->BankId."' ".$selected.">".$rowBank->Name."</option>";
                                }
                              ?>
                            </select>
                            <input type="text" data-id="" id="bank1_portion_<?= $row->BankFacilityItemMenengahId; ?>" name="bank1_portion_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BankId1Portion; ?>" style="text-align: right; margin-top: 5px;">
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label>Bank Name #2:</label>
                            <select class="form-control js-example-basic-single" id="bank2_<?= $row->BankFacilityItemMenengahId; ?>" name="bank2_<?= $row->BankFacilityItemMenengahId; ?>" style="width:100%;">
                              <option value="0">Please Choose</option>
                              <?php
                                foreach ($Bank as $rowBank){
                                  $selected = "";
                                  if($rowBank->BankId == $row->BankId2) $selected = "selected='selected'";
                                  echo "<option value='".$rowBank->BankId."' ".$selected.">".$rowBank->Name."</option>";
                                }
                              ?>
                            </select>
                            <input type="text" data-id="" id="bank2_portion_<?= $row->BankFacilityItemMenengahId; ?>" name="bank2_portion_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BankId2Portion; ?>" style="text-align: right; margin-top: 5px;">
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label>Bank Name #3:</label>
                            <select class="form-control js-example-basic-single" id="bank3_<?= $row->BankFacilityItemMenengahId; ?>" name="bank3_<?= $row->BankFacilityItemMenengahId; ?>" style="width:100%;">
                              <option value="0">Please Choose</option>
                              <?php
                                foreach ($Bank as $rowBank){
                                  $selected = "";
                                  if($rowBank->BankId == $row->BankId3) $selected = "selected='selected'";
                                  echo "<option value='".$rowBank->BankId."' ".$selected.">".$rowBank->Name."</option>";
                                }
                              ?>
                            </select>
                            <input type="text" data-id="" id="bank3_portion_<?= $row->BankFacilityItemMenengahId; ?>" name="bank3_portion_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BankId3Portion; ?>" style="text-align: right; margin-top: 5px;">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div id="facilities-banking-addition-item-container">
                <?php
                  if(!empty($FacilitiesBankingItemAddition)){
                    foreach($FacilitiesBankingItemAddition as $row):
                ?>
                    <div class="row form-group form_container update_facilities_banking_item_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>">
                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label><?= $row->Name; ?> ( Total: <?= number_format($row->OtherNominal, 2); ?> )</label>
                              <input type="hidden" id="total_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" value="<?= $row->OtherNominal; ?>" >
                          </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label>Bank Name #1:</label>
                              <select class="form-control js-example-basic-single" id="bank1_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bank1_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" style="width:100%;">
                                <option value="0">Please Choose</option>
                                <?php
                                  foreach ($Bank as $rowBank){
                                    $selected = "";
                                    if($rowBank->BankId == $row->BankId1) $selected = "selected='selected'";
                                    echo "<option value='".$rowBank->BankId."' ".$selected.">".$rowBank->Name."</option>";
                                  }
                                ?>
                              </select>
                              <input type="text" data-id="" id="bank1_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bank1_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BankId1Portion; ?>" style="text-align: right; margin-top: 5px;">
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label>Bank Name #2:</label>
                              <select class="form-control js-example-basic-single" id="bank2_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bank2_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" style="width:100%;">
                                <option value="0">Please Choose</option>
                                <?php
                                  foreach ($Bank as $rowBank){
                                    $selected = "";
                                    if($rowBank->BankId == $row->BankId2) $selected = "selected='selected'";
                                    echo "<option value='".$rowBank->BankId."' ".$selected.">".$rowBank->Name."</option>";
                                  }
                                ?>
                              </select>
                              <input type="text" data-id="" id="bank2_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bank2_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BankId2Portion; ?>" style="text-align: right; margin-top: 5px;">
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label>Bank Name #3:</label>
                              <select class="form-control js-example-basic-single" id="bank3_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bank3_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" style="width:100%;">
                                <option value="0">Please Choose</option>
                                <?php
                                  foreach ($Bank as $rowBank){
                                    $selected = "";
                                    if($rowBank->BankId == $row->BankId3) $selected = "selected='selected'";
                                    echo "<option value='".$rowBank->BankId."' ".$selected.">".$rowBank->Name."</option>";
                                  }
                                ?>
                              </select>
                              <input type="text" data-id="" id="bank3_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bank3_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BankId3Portion; ?>" style="text-align: right; margin-top: 5px;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php
                    endforeach; 
                  }
                ?>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                    <div class="col-xs-12">
                        <button id="btn_cancel_competition_analysis" class="btn w150 btn-sm btn-default btn_cancel" style="width: 200px;" type="button">BACK</button>
                        <button id="btn_save_competition_analysis" class="btn w150 btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right:0px;">SAVE</button>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-edit-bri-sp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>You want to make data changes, are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">No</button>
          <button id="btn-save-confirmation" type="button" class="btn w150 btn-primary modal-button-ok">Yes</button>
        </div>
      </div>
    </div>
  </div>
</div>  
<script src="<?= base_url(); ?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
  $('.js-example-basic-single').select2();

  $(".money").autoNumeric("init",{
    mDec: "0",
    vMax: "999999999999999",
  });

  $(".money").blur(function() {
    if($(this).val() == "") $(this).val(0);
  });

  $('#btn_cancel_competition_analysis').click(function(){
      window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/'.$AccountPlanningTab.'/'.$FacilitiesBankingGroupType);?>';
  });

  $.validator.addMethod("checkSelectedBank", function(value, element) {    
    var arrIndex = (element.id).split("_");
    var selectedElement = arrIndex[0];
    var id = arrIndex[2];
    var portion = $("#"+selectedElement+"_portion_"+id).autoNumeric("get");
    var bank = $("#"+selectedElement+"_"+id).val();
    if(portion > 0){
      if(bank == 0) return false;
      else return true;
    }else{
      return true;
    };
  }, "Portion > 0, Bank must be selected");

  $.validator.addMethod("checkSelectedBankAddition", function(value, element) {    
    var arrIndex = (element.id).split("_");
    var selectedElement = arrIndex[0];
    var id = arrIndex[3];
    var portion = $("#"+selectedElement+"_portion_addition_"+id).autoNumeric("get");
    var bank = $("#"+selectedElement+"_addition_"+id).val();
    if(portion > 0){
      if(bank == 0) return false;
      else return true;
    }else{
      return true;
    };
  }, "Portion > 0, Bank must be selected");

  $.validator.addMethod("checkPortion", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[2];
    var bank_portion_1 = $("#bank1_portion_"+id).autoNumeric("get");
    var bank_portion_2 = $("#bank2_portion_"+id).autoNumeric("get");
    var bank_portion_3 = $("#bank3_portion_"+id).autoNumeric("get");
    var total = $("#total_"+id).val();
    var result = Number(bank_portion_1) + Number(bank_portion_2) + Number(bank_portion_3);
    if(Number(total) == Number(result)){
        return true;
    }else return false;
  }, "Total Bank Portion must be equal with Total");

  $.validator.addMethod("checkPortionAddition", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[3];
    var bank_portion_1 = $("#bank1_portion_addition_"+id).autoNumeric("get");
    var bank_portion_2 = $("#bank2_portion_addition_"+id).autoNumeric("get");
    var bank_portion_3 = $("#bank3_portion_addition_"+id).autoNumeric("get");
    var total = $("#total_addition_"+id).val();
    var result = Number(bank_portion_1) + Number(bank_portion_2) + Number(bank_portion_3);
    if(Number(total) == Number(result)){
        return true;
    }else return false;
  }, "Total Bank Portion must be equal with Total");

  $("#form-competition-analysis").validate({
    rules: {
      <?php foreach($FacilitiesBankingItem as $row): ?>
        "bank1_portion_<?= $row->BankFacilityItemMenengahId; ?>" : {
          checkPortion: true,
          checkSelectedBank: true,
        },
        "bank2_portion_<?= $row->BankFacilityItemMenengahId; ?>" : {
          checkPortion: true,
          checkSelectedBank: true,
        },
        "bank3_portion_<?= $row->BankFacilityItemMenengahId; ?>" : {
          checkPortion: true,
          checkSelectedBank: true,
        },
      <?php endforeach; ?>
      <?php
        if(!empty($FacilitiesBankingItemAddition)){
          foreach($FacilitiesBankingItemAddition as $row):
      ?>
        "bank1_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
          checkPortionAddition: true,
          checkSelectedBankAddition: true
        },
        "bank2_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
          checkPortionAddition: true,
          checkSelectedBankAddition: true,
        },
        "bank3_portion_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
          checkPortionAddition: true,
          checkSelectedBankAddition: true,
        },
      <?php 
          endforeach;
        }
      ?>
    }
  });

  $("#btn_save_competition_analysis").click(function(){
    if($("#form-competition-analysis").valid()){
      $(".modal-edit-bri-sp").modal("show");
    }
  });

  $("#btn-save-confirmation").click(function(e){
    e.preventDefault();
    $.ajax({
      type: "post",
      url : $("#form-competition-analysis").attr("action"),
      data: $("#form-competition-analysis").serialize(),
      dataType : "json",
      beforeSend:function(){
        $(".modal-edit-bri-sp").modal("hide");
        $(".loaderImage").show();
      },
      success: function(response){
        $(".loaderImage").hide();
            if(response.status === "success"){
            new PNotify({
                title: "Success!",
                text: "Data has been saved.",
                type: "success",
                styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
            setTimeout(function(){ 
                window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input/".$apMenengahId."/".$AccountPlanningTab."/".$FacilitiesBankingGroupType); ?>";
            }, 2000);                
        }else if(response.status === "error"){
            new PNotify({
                title: "Error!",
                text: response.message,
                type: "error",
                styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $(".loaderImage").hide();
        $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
        $(".modal-error-notification").modal("show");
      }
    });
  });
});        
</script>


