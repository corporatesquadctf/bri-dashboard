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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/bri_starting_position/'.$FacilitiesBankingGroupType);?>">Facilities Banking</a></li>
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
            <form class="form-horizontal" id="form-facilities-banking" method="POST" action="<?= site_url('tasklist/account_planning_menengah/manage_account_planning/process_input_facilities_banking') ?>" style="text-align: left;">
              <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
              <input type="hidden" id="mainTab" name="mainTab" value="<?= $AccountPlanningTab; ?>" />
              <input type="hidden" id="secondTab" name="secondTab" value="<?= $FacilitiesBankingGroupType; ?>" />
              <input type="hidden" id="facilitiesBankingGroupId" name="facilitiesBankingGroupId" value="<?= $FacilitiesBankingGroupId; ?>" />
              <div class="row form-group" style="padding: 0 30px;">
                <div class="col-md-4 col-sm-4 col-xs-12 pull-right" style="text-align: right;">
                  <table style="width: 100%;">
                    <tr>
                      <td style="width: 30%; text-align: left;">Notes : </td>
                      <td style="width: 70%; text-align: right;"><span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes1?></span></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes2?></span></td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <div id="facilities-banking-item-container">
                <?php foreach($FacilitiesBankingItem as $row): ?>
                  <div class="row form-group form_container">
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label><?= $row->Name; ?></label>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Nominal IDR:</label>
                            <input type="text" id="nom_idr_<?= $row->BankFacilityItemMenengahId; ?>" name="nom_idr_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->IDRAmount; ?>" style="text-align: right;">
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Rate (%):</label>
                            <input type="text" id="rate_idr_<?= $row->BankFacilityItemMenengahId; ?>" name="rate_idr_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control percentage" data-a-dec="." value="<?= $row->IDRRate; ?>" style="text-align: right;">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Nominal Valas:</label>
                            <input type="text" id="nom_valas_<?= $row->BankFacilityItemMenengahId; ?>" name="nom_valas_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->ValasAmount; ?>" style="text-align: right;">
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="form-group">
                            <label>Rate (%):</label>
                            <input type="text" id="rate_valas_<?= $row->BankFacilityItemMenengahId; ?>" name="rate_valas_<?= $row->BankFacilityItemMenengahId; ?>" class="form-control percentage" data-a-dec="." value="<?= $row->ValasRate; ?>" style="text-align: right;">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div id="update-facilities-banking-item-container">
                <?php
                  if(!empty($FacilitiesBankingItemAddition)){
                    foreach($FacilitiesBankingItemAddition as $row):
                ?>
                    <div class="row form-group form_container update_facilities_banking_item_addition_<?= $row->BankFacilityItemAdditionMenengahId; ?>">
                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="div-action pull-left" onclick="remove_update_facilities_banking_item_addition(<?= $row->BankFacilityItemAdditionMenengahId; ?>)">
                                  <i class="material-icons no-after no-before">delete_sweep</i>
                                  <label class="label-action">Delete Facilities Bank Item</label>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label></label>
                              <input type="text" id="adt_name_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="adt_name_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control" maxlength="100" value="<?= $row->Name; ?>" style="margin-top: 5px;">
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Nominal IDR:</label>
                              <input type="text" id="adt_nom_idr_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="adt_nom_idr_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->IDRAmount; ?>" style="text-align: right;">
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Rate (%):</label>
                              <input type="text" id="adt_rate_idr_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="adt_rate_idr_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control percentage" data-a-dec="." value="<?= $row->IDRRate; ?>" style="text-align: right;">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-4">
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Nominal Valas:</label>
                              <input type="text" id="adt_nom_valas_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="adt_nom_valas_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control money" data-a-dec="." value="<?= $row->ValasAmount; ?>" style="text-align: right;">
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Rate (%):</label>
                              <input type="text" id="adt_rate_valas_<?= $row->BankFacilityItemAdditionMenengahId; ?>" name="adt_rate_valas_<?= $row->BankFacilityItemAdditionMenengahId; ?>" class="form-control percentage" data-a-dec="." value="<?= $row->ValasRate; ?>" style="text-align: right;">
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

              <div id="new-facilities-banking-item-addition-container">
                <input type="hidden" id="jmlFacilitiesBankingItemAddition" name="jmlFacilitiesBankingItemAddition" value="<?= count($FacilitiesBankingItemAddition); ?>" />
                <input type="hidden" id="dataFacilitiesBankingItemAddition" name="dataFacilitiesBankingItemAddition" value="" />
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                    <div class="col-xs-12">
                        <button id="btn_cancel_facilities_banking" class="btn w150 btn-sm btn-default btn_cancel" style="width: 200px;" type="button">BACK</button>
                        <button id="btn_add_row_facilities_banking" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_facilities_banking_fields();">ADD FACILITIES BANKING ITEM</button>
                        <button id="btn_save_facilities_banking" class="btn w150 btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right:0px;">SAVE</button>
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
var jmlFacilitiesBankingItemAddition = <?= count($FacilitiesBankingItemAddition); ?>;
  if(jmlFacilitiesBankingItemAddition == 0){
      var arrFacilitiesBankingItemAddition = [];
  }else{
    var arrFacilitiesBankingItemAddition = [];
    for(var i=0; i<jmlFacilitiesBankingItemAddition; i++){
      arrFacilitiesBankingItemAddition.push(Number(i));
    }
    $('#dataFacilitiesBankingItemAddition').val(arrFacilitiesBankingItemAddition);
  }
  
$(document).ready(function() {

  $(".money").autoNumeric("init",{
    mDec: "0",
    vMax: "999999999999999",
  });

  $(".percentage").autoNumeric("init",{
    mDec: "0",
    vMax: "999",
  });

  $(".money, .percentage").click(function() {
    this.select();
  });

  $(".money, .percentage").blur(function() {
    if($(this).val() == ""){$(this).val(0);}
  });

  $('#btn_cancel_facilities_banking').click(function(){
      window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/'.$AccountPlanningTab.'/'.$FacilitiesBankingGroupType);?>';
  });

  $("#btn_save_facilities_banking").click(function(){
    if($("#form-facilities-banking").valid()){
      $(".modal-edit-bri-sp").modal("show");
    }
  });

  $("#btn-save-confirmation").click(function(e){
    e.preventDefault();
    $.ajax({
      type: "post",
      url : $("#form-facilities-banking").attr("action"),
      data: $("#form-facilities-banking").serialize(),
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

function add_facilities_banking_fields(){
  if(arrFacilitiesBankingItemAddition.length == 0)
      var facilitiesBankingItemAddition = 0
  else {
      var facilitiesBankingItemAddition = arrFacilitiesBankingItemAddition[arrFacilitiesBankingItemAddition.length - 1] +1;
  }
  
  var inner = '';
  var objTo = document.getElementById('new-facilities-banking-item-addition-container')
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "row form-group form_container facilities_banking_item_addition_"+facilitiesBankingItemAddition);
  inner +=  '<div class="col-xs-12">';
  inner +=  ' <div class="row">';
  inner +=  '   <div class="col-xs-12">';
  inner +=  '       <div class="div-action pull-left" onclick="remove_facilities_banking_item_addition('+facilitiesBankingItemAddition+')">';
  inner +=  '           <i class="material-icons no-after no-before">delete_sweep</i>';
  inner +=  '           <label class="label-action">Delete Facilities Bank Item</label>';
  inner +=  '       </div>';
  inner +=  '   </div>';
  inner +=  '</div>';
  inner +=  '<div class="row">';
  inner +=  ' <div class="col-xs-4">';
  inner +=  '   <div class="form-group">';
  inner +=  '     <label></label>';
  inner +=  '     <input type="text" id="name_addition_'+facilitiesBankingItemAddition+'" name="name_addition_'+facilitiesBankingItemAddition+'" class="form-control" maxlength="100" value="" style="margin-top: 5px;" required>';
  inner +=  '   </div>';
  inner +=  ' </div>';
  inner +=  ' <div class="col-xs-4">';
  inner +=  '   <div class="form-group">';
  inner +=  '     <label>Nominal IDR:</label>';
  inner +=  '     <input type="text" id="nom_idr_addition_'+facilitiesBankingItemAddition+'" name="nom_idr_addition_'+facilitiesBankingItemAddition+'" class="form-control money" data-a-dec="." value="0" style="text-align: right;">';
  inner +=  '   </div>';
  inner +=  ' </div>';
  inner +=  ' <div class="col-xs-4">';
  inner +=  '   <div class="form-group">';
  inner +=  '     <label>Rate (%):</label>';
  inner +=  '     <input type="text" id="rate_idr_addition_'+facilitiesBankingItemAddition+'" name="rate_idr_addition_'+facilitiesBankingItemAddition+'" class="form-control percentage" data-a-dec="." value="0" style="text-align: right;">';
  inner +=  '   </div>';
  inner +=  ' </div>';
  inner +=  '</div>';
  inner +=  '<div class="row">';
  inner +=  ' <div class="col-xs-4">';
  inner +=  '   <div class="form-group">';
  inner +=  '     <label></label>';
  inner +=  '   </div>';
  inner +=  ' </div>';
  inner +=  ' <div class="col-xs-4">';
  inner +=  '   <div class="form-group">';
  inner +=  '     <label>Nominal Valas:</label>';
  inner +=  '     <input type="text" id="nom_valas_addition_'+facilitiesBankingItemAddition+'" name="nom_valas_addition_'+facilitiesBankingItemAddition+'" class="form-control money" data-a-dec="." value="0" style="text-align: right;">';
  inner +=  '   </div>';
  inner +=  ' </div>';
  inner +=  ' <div class="col-xs-4">';
  inner +=  '   <div class="form-group">';
  inner +=  '     <label>Rate (%):</label>';
  inner +=  '     <input type="text" id="rate_valas_addition_'+facilitiesBankingItemAddition+'" name="rate_valas_addition_'+facilitiesBankingItemAddition+'" class="form-control percentage" data-a-dec="." value="0" style="text-align: right;">';
  inner +=  '   </div>';
  inner +=  ' </div>';
  inner +=  '</div>';
  divtest.innerHTML = inner;
  objTo.appendChild(divtest);
  arrFacilitiesBankingItemAddition.push(Number(facilitiesBankingItemAddition));
  $('#dataFacilitiesBankingItemAddition').val(arrFacilitiesBankingItemAddition);
  $('#jmlFacilitiesBankingItemAddition').val(arrFacilitiesBankingItemAddition.length);
  
  $(".money").autoNumeric("init",{
    mDec: "0",
    vMax: "999999999999999"
  });

  $(".percentage").autoNumeric("init",{
    mDec: "0",
    vMax: "999",
  });
  
  $(".money, .percentage").click(function() {
    this.select();
  });

  $(".money, .percentage").blur(function() {
    if($(this).val() == ''){$(this).val(0);}
  });  

}

function remove_facilities_banking_item_addition(facilitiesBankingItemAddition){
  $('.facilities_banking_item_addition_'+facilitiesBankingItemAddition).remove();        
  var index = arrFacilitiesBankingItemAddition.indexOf(facilitiesBankingItemAddition);
  if (index > -1) {
    arrFacilitiesBankingItemAddition.splice(index, 1);
  }
  $('#dataFacilitiesBankingItemAddition').val(arrFacilitiesBankingItemAddition);
  $('#jmlFacilitiesBankingItemAddition').val(arrFacilitiesBankingItemAddition.length);
}

function remove_update_facilities_banking_item_addition(index){
  $('.update_facilities_banking_item_addition_'+index).remove();
}
        
</script>


