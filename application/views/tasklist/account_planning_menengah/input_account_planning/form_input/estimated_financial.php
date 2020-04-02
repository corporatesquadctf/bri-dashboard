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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/action_plans');?>">Action Plans</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/action_plans/'.$FacilitiesBankingGroupType);?>">Estimated Financial</a></li>
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
            <form class="form-horizontal" id="form-estimated-financial" method="POST" action="<?= site_url('tasklist/account_planning_menengah/manage_account_planning/process_input_estimated_financial') ?>" style="text-align: left;">
              <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
              <input type="hidden" id="mainTab" name="mainTab" value="<?= $AccountPlanningTab; ?>" />
              <input type="hidden" id="secondTab" name="secondTab" value="<?= $FacilitiesBankingGroupType; ?>" />
              <input type="hidden" id="facilitiesBankingGroupId" name="facilitiesBankingGroupId" value="<?= $FacilitiesBankingGroupId; ?>" />
              
              <div id="facilities-banking-item-container">
                <?php foreach($FacilitiesBankingItem as $row): ?>
                  <div class="row form-group form_container">
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group hyphenate">
                            <label><?= $row->Name; ?></label>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Projection Customer By IDR:</label>
                            <input type="text" data-id="<?= $row->BankFacilityItemMenengahId; ?>" id="idr_projection_<?= $row->BankFacilityItemMenengahId; ?>" name="idr_projection_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money estimated-financial-default" data-a-dec="." value="<?= $row->IDRProjection; ?>" style="text-align: right;">
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Projection Customer By Valas:</label>
                            <input type="text" data-id="<?= $row->BankFacilityItemMenengahId; ?>" id="valas_projection_<?= $row->BankFacilityItemMenengahId; ?>" name="valas_projection_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money estimated-financial-default" data-a-dec="." value="<?= $row->ValasProjection; ?>" style="text-align: right;">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group">
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Target By IDR:</label>
                            <input type="text" data-id="<?= $row->BankFacilityItemMenengahId; ?>" id="idr_target_<?= $row->BankFacilityItemMenengahId; ?>" name="idr_target_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money estimated-financial-default" data-a-dec="." value="<?= $row->IDRTarget; ?>" style="text-align: right;">
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Target By Valas:</label>
                            <input type="text" data-id="<?= $row->BankFacilityItemMenengahId; ?>" id="valas_target_<?= $row->BankFacilityItemMenengahId; ?>" name="valas_target_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money estimated-financial-default" data-a-dec="." value="<?= $row->ValasTarget; ?>" style="text-align: right;">
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
                          <div class="col-xs-4">
                            <div class="form-group hyphenate">
                              <label><?= $row->Name; ?></label>
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Projection Customer By IDR:</label>
                              <input type="text" data-id="<?= $row->BankFacilityItemAdditionMenengahId; ?>" id="idr_projection_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="idr_projection_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money estimeted-financial-addition" value="<?= $row->IDRProjection; ?>" style="text-align: right;">
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Projection Customer By Valas:</label>
                              <input type="text" data-id="<?= $row->BankFacilityItemAdditionMenengahId; ?>" id="valas_projection_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="valas_projection_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money estimeted-financial-addition" data-a-dec="." value="<?= $row->ValasProjection; ?>" style="text-align: right;">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-4">
                            <div class="form-group">
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Target By IDR:</label>
                              <input type="text" data-id="<?= $row->BankFacilityItemAdditionMenengahId; ?>" id="idr_target_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="idr_target_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money estimeted-financial-addition" value="<?= $row->IDRTarget; ?>" style="text-align: right;">
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Target By Valas:</label>
                              <input type="text" data-id="<?= $row->BankFacilityItemAdditionMenengahId; ?>" id="valas_target_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="valas_target_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money estimeted-financial-addition" data-a-dec="." value="<?= $row->ValasTarget; ?>" style="text-align: right;">
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
                        <button id="btn_cancel_estimated_financial" class="btn w150 btn-sm btn-default btn_cancel" style="width: 200px;" type="button">BACK</button>
                        <button id="btn_save_estimated_financial" class="btn w150 btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right:0px;">SAVE</button>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-edit-estimated-financial" tabindex="-1" role="dialog" aria-hidden="true">
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

  $(".money").autoNumeric("init",{
    mDec: "0",
    vMax: "999999999999999",
  });

  $(".money").click(function() {
    this.select();
  });

  $('#btn_cancel_estimated_financial').click(function(){
      window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/'.$AccountPlanningTab.'/'.$FacilitiesBankingGroupType);?>';
  });

  $.validator.addMethod("checkValueIDR", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[2];
    var projection = $("#idr_projection_"+id).autoNumeric("get");
    var target = $("#idr_target_"+id).autoNumeric("get");
    if(Number(target) <= Number(projection)){
        $("#idr_target_"+id).removeClass("error");
        $("#idr_target_"+id+"-error").css('display','none');

        $("#idr_projection_"+id).removeClass("error");
        $("#idr_projection_"+id+"-error").css('display','none');

        return true;
    }else return false;
  }, "Projection must be higher or equal than Target");

  $.validator.addMethod("checkValueValas", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[2];
    var projection = $("#valas_projection_"+id).autoNumeric("get");
    var target = $("#valas_target_"+id).autoNumeric("get");
    if(Number(target) <= Number(projection)){
        $("#valas_target_"+id).removeClass("error");
        $("#valas_target_"+id+"-error").css('display','none');

        $("#valas_projection_"+id).removeClass("error");
        $("#valas_projection_"+id+"-error").css('display','none');

        return true;
    }else return false;
  }, "Projection must be higher or equal than Target");

  $.validator.addMethod("checkValueIDRAddition", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[3];
    var projection = $("#idr_projection_addition_"+id).autoNumeric("get");
    var target = $("#idr_target_addition_"+id).autoNumeric("get");
    if(Number(target) <= Number(projection)){
        $("#idr_target_addition_"+id).removeClass("error");
        $("#idr_target_addition_"+id+"-error").css('display','none');

        $("#idr_projection_addition_"+id).removeClass("error");
        $("#idr_projection_addition_"+id+"-error").css('display','none');

        return true;
    }else return false;
  }, "Projection must be higher or equal than Target");

  $.validator.addMethod("checkValueValasAddition", function(value, element) {
    var arrIndex = (element.id).split("_");
    var id = arrIndex[3];
    var projection = $("#valas_projection_addition_"+id).autoNumeric("get");
    var target = $("#valas_target_addition_"+id).autoNumeric("get");
    if(Number(target) <= Number(projection)){
        $("#valas_target_addition_"+id).removeClass("error");
        $("#valas_target_addition_"+id+"-error").css('display','none');

        $("#valas_projection_addition_"+id).removeClass("error");
        $("#valas_projection_addition_"+id+"-error").css('display','none');

        return true;
    }else return false;
  }, "Projection must be higher or equal than Target");

  $('#form-estimated-financial').validate({
    rules: {
      <?php foreach($FacilitiesBankingItem as $row): ?>
        "idr_projection_<?= $row->BankFacilityItemMenengahId; ?>" : {
          required: true,
          checkValueIDR: true
        },
        "idr_target_<?= $row->BankFacilityItemMenengahId; ?>" : {
          required: true,
          checkValueIDR: true
        },
        "valas_projection_<?= $row->BankFacilityItemMenengahId; ?>" : {
          required: true,
          checkValueValas: true
        },
        "valas_target_<?= $row->BankFacilityItemMenengahId; ?>" : {
          required: true,
          checkValueValas: true
        },
      <?php endforeach; ?>
      <?php
      if(!empty($FacilitiesBankingItemAddition)){
        foreach($FacilitiesBankingItemAddition as $row):
      ?>
      "idr_projection_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
        required: true,
        checkValueIDRAddition: true
      },
      "idr_target_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
        required: true,
        checkValueIDRAddition: true
      },
      "valas_projection_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
        required: true,
        checkValueValasAddition: true
      },
      "valas_target_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>" : {
        required: true,
        checkValueValasAddition: true
      },
      <?php 
        endforeach;
      }
      ?>
    }
  });

  $("#btn_save_estimated_financial").click(function(){
    if($("#form-estimated-financial").valid()){
      $(".modal-edit-estimated-financial").modal("show");
    }
  });

  $("#btn-save-confirmation").click(function(e){
    e.preventDefault();
    $.ajax({
    type: "post",
    url : $("#form-estimated-financial").attr("action"),
    data: $("#form-estimated-financial").serialize(),
    dataType : "json",
    beforeSend:function(){
        $(".modal-edit-estimated-financial").modal("hide");
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


