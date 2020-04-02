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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/bri_starting_position/'.$FacilitiesBankingGroupType);?>">Wallet Share</a></li>
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
            <form class="form-horizontal" id="form-wallet-share" method="POST" action="<?= site_url('tasklist/account_planning_menengah/manage_account_planning/process_input_wallet_share') ?>" style="text-align: left;">
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
                            <label><?= $row->Name; ?></label>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label>Total:</label>
                            <input type="text" data-id="<?= $row->BankFacilityItemMenengahId; ?>" id="total_amount_<?= $row->BankFacilityItemMenengahId; ?>" name="total_amount_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money wallet-share-default" data-a-dec="." value="<?= $row->TotalAmount; ?>" style="text-align: right;">
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label>BRI Nominal:</label>
                            <input type="text" id="bri_nominal_<?= $row->BankFacilityItemMenengahId; ?>" name="bri_nominal_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BRINominal; ?>" style="text-align: right;" readonly>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label>Other Nominal:</label>
                            <input type="text" id="other_nominal_<?= $row->BankFacilityItemMenengahId; ?>" name="other_nominal_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->OtherNominal; ?>" style="text-align: right;" readonly>
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
                            <div class="form-group hyphenate">
                              <label><?= $row->Name; ?></label>
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label>Total:</label>
                              <input type="text" data-id="<?= $row->BankFacilityItemAdditionMenengahId; ?>" id="total_amount_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="total_amount_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money wallet-share-addition" value="<?= $row->TotalAmount; ?>" style="text-align: right;">
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label>BRI Nominal:</label>
                              <input type="text" id="bri_nominal_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="bri_nominal_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->BRINominal; ?>" style="text-align: right;" readonly>
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <label>Rate:</label>
                              <input type="text" id="other_nominal_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="other_nominal_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->OtherNominal; ?>" style="text-align: right;" readonly>
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
                        <button id="btn_cancel_wallet_share" class="btn w150 btn-sm btn-default btn_cancel" style="width: 200px;" type="button">BACK</button>
                        <button id="btn_save_wallet_share" class="btn w150 btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right:0px;">SAVE</button>
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
<script src="<?= base_url();?>assets/bigInt/bignumber.js"></script>
<script src="<?= base_url(); ?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {

  $(".money").autoNumeric("init",{
    mDec: "0",
    vMax: "9999999999999999",
  });

  $(".money").click(function() {
    this.select();
  });

  $(".money").blur(function() {
    if($(this).val() == "") $(this).val(0);
  });

  $(".wallet-share-default").blur(function() {
    var id = $(this).data("id");
    var total = new BigNumber($(this).autoNumeric("get"));
    var BRINominal = new BigNumber($("#bri_nominal_"+id).autoNumeric("get"));
    var otherNominal = 0;
    if(total == "" || total == 0){
      $("#other_nominal_"+id).autoNumeric("set", 0);
    }else if(total < BRINominal){
      $("#other_nominal_"+id).autoNumeric("set", 0);
    }else{
      otherNominal = total.subtract(BRINominal);
      $("#other_nominal_"+id).autoNumeric("set", otherNominal);
    }    
  });

  $(".wallet-share-addition").blur(function() {
    var id = $(this).data("id");
    var total = new BigNumber($(this).autoNumeric("get"));
    var BRINominal = new BigNumber($("#bri_nominal_addition_"+id).autoNumeric("get"));
    var otherNominal = 0;
    if(total == "" || total == 0){
      $("#other_nominal_addition_"+id).autoNumeric("set", 0);
    }else if(total < BRINominal){
      $("#other_nominal_addition_"+id).autoNumeric("set", 0);
    }else{
      otherNominal = total.subtract(BRINominal);
      $("#other_nominal_addition_"+id).autoNumeric("set", otherNominal);
    }
  });
  
  $('#btn_cancel_wallet_share').click(function(){
      window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/'.$AccountPlanningTab.'/'.$FacilitiesBankingGroupType);?>';
  });

  $.validator.addMethod("checkTotalAmount", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[2];
    var total = $("#total_amount_"+id).autoNumeric("get");
    var BRINominal = $("#bri_nominal_"+id).autoNumeric("get");
    if(Number(total) >= Number(BRINominal)){
        return true;
    }else return false;
  }, "Total must be higher or equal than BRI Nominal");

  $.validator.addMethod("checkTotalAmountAddition", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[3];
    var total = $("#total_amount_addition_"+id).autoNumeric("get");
    var BRINominal = $("#bri_nominal_addition_"+id).autoNumeric("get");
    if(Number(total) >= Number(BRINominal)){
        return true;
    }else return false;
  }, "Total must be higher or equal than BRI Nominal");

  $('#form-wallet-share').validate({
    rules: {
      <?php foreach($FacilitiesBankingItem as $row): ?>
        "total_amount_<?= $row->BankFacilityItemMenengahId; ?>" : {
          required: true,
          checkTotalAmount: true
      },
      <?php endforeach; ?>
      <?php
      if(!empty($FacilitiesBankingItemAddition)){
        foreach($FacilitiesBankingItemAddition as $row):
      ?>
      "total_amount_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
          required: true,
          checkTotalAmountAddition: true
      },
      <?php 
        endforeach;
      }
      ?>
    }
  });

  $("#btn_save_wallet_share").click(function(){
    if($("#form-wallet-share").valid()){
      $(".modal-edit-bri-sp").modal("show");
    }
  });

  $("#btn-save-confirmation").click(function(e){
    e.preventDefault();
    $.ajax({
      type: "post",
      url : $("#form-wallet-share").attr("action"),
      data: $("#form-wallet-share").serialize(),
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


