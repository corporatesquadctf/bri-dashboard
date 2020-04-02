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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning');?>">Manage Account Planning Menengah</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/bri_starting_position');?>">BRI Starting Position</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/bri_starting_position/'.$FinancialHighlightGroupType);?>">Financial Highlights</a></li>
                  </ol>
                </nav>
                <div class="page_title" style="padding: 1px 5px 6px;">
                    <div class="pull-left"><?= $FinancialHighlightGroupName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="padding: 10px 0;">
          <div class="x_content" style="padding: 0 0 6px;">
            <form id="formFinancialHighlight" class="form-horizontal" method="POST" action="<?= site_url('tasklist/account_planning_menengah/manage_account_planning/process_input_financial_highlight') ?>" style="text-align: left;">
              <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
              <input type="hidden" id="mainTab" name="mainTab" value="<?= $AccountPlanningTab; ?>" />
              <input type="hidden" id="secondTab" name="secondTab" value="<?= $FinancialHighlightGroupType; ?>" />
              <input type="hidden" id="financialHighlightGroupId" name="financialHighlightGroupId" value="<?= $FinancialHighlightGroupId; ?>" />
              <div class="row form-group" style="padding: 0 30px;">
                <div class="col-sm-4 col-xs-12 pull-right" style="text-align: right;">
                  Notes : <span style="font-weight: 600; font-size: 12px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=Form_Notes1?></span>
                </div>
              </div>
              <div class="form_container">
                <div class="row form-group">
                  <div class="col-xs-3"></div>
                  <div class="col-xs-3" style="text-align: center;"><label><?= $Years[0]; ?></label></div>
                  <div class="col-xs-3" style="text-align: center;"><label><?= $Years[1]; ?></label></div>
                  <div class="col-xs-3" style="text-align: center;"><label><?= $Years[2]; ?></label></div>
                </div>
                <?php foreach($FinancialHighlightItem as $row): 
                  if($row->FinancialHighlightItemMenengahId == 12 || $row->FinancialHighlightItemMenengahId == 13 || $row->FinancialHighlightItemMenengahId == 18 ||
                  $row->FinancialHighlightItemMenengahId == 19 || $row->FinancialHighlightItemMenengahId == 20 || $row->FinancialHighlightItemMenengahId == 21 ||
                  $row->FinancialHighlightItemMenengahId == 22 || $row->FinancialHighlightItemMenengahId == 23){
                    $numericClass = "percentage";
                  }else{
                    $numericClass = "money";
                  }

                  $isReadonly = "";
                  if($row->FinancialHighlightItemMenengahId == 4 || $row->FinancialHighlightItemMenengahId == 6 || $row->FinancialHighlightItemMenengahId == 12 ||
                  $row->FinancialHighlightItemMenengahId == 18 || $row->FinancialHighlightItemMenengahId == 19 || $row->FinancialHighlightItemMenengahId == 20 ||
                  $row->FinancialHighlightItemMenengahId == 22){
                    $isReadonly = "readonly";
                    $numericClass = "moneySum";
                  }

                  
                ?>
                  <div class="row form-group">
                    <div class="col-xs-3"><label><?= $row->Name; ?></label></div>
                    <div class="col-xs-3">
                      <input type="text" id="amount_<?= $row->FinancialHighlightItemMenengahId."_".$Years[0]; ?>" name="amount_<?= $row->FinancialHighlightItemMenengahId."_".$Years[0]; ?>" class="form-control <?= $numericClass; ?>" data-a-dec="." value="<?= $arrFinancialHighlight[$row->FinancialHighlightItemMenengahId][$Years[0]]; ?>" style="text-align: right;" <?= $isReadonly; ?>>
                    </div>
                    <div class="col-xs-3" style="text-align: center;">
                      <input type="text" id="amount_<?= $row->FinancialHighlightItemMenengahId."_".$Years[1]; ?>" name="amount_<?= $row->FinancialHighlightItemMenengahId."_".$Years[1]; ?>" class="form-control <?= $numericClass; ?>" data-a-dec="." value="<?= $arrFinancialHighlight[$row->FinancialHighlightItemMenengahId][$Years[1]]; ?>" style="text-align: right;" <?= $isReadonly; ?>>
                    </div>
                    <div class="col-xs-3" style="text-align: center;">
                      <input type="text" id="amount_<?= $row->FinancialHighlightItemMenengahId."_".$Years[2]; ?>" name="amount_<?= $row->FinancialHighlightItemMenengahId."_".$Years[2]; ?>" class="form-control <?= $numericClass; ?>" data-a-dec="." value="<?= $arrFinancialHighlight[$row->FinancialHighlightItemMenengahId][$Years[2]]; ?>" style="text-align: right;" <?= $isReadonly; ?>>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
                <?php if($FinancialHighlightGroupId != 5): ?>
                <div class="row form_action">
                  <div class="form-group pull-right">
                      <div class="col-xs-12">
                          <button id="btn_cancel_financial_highlight" class="btn w150 btn-sm btn-default btn_cancel" type="button" style="width:200px;">BACK</button>
                          <button id="btn_save_financial_highlight" class="btn w150 btn-sm btn-primary btn_save" type="button" style="margin-right:0px; width:200px;">SAVE</button>
                      </div>
                  </div>
                </div>
                <?php endif; ?>
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
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
$(document).ready(function() {
  $(".money, .percentage").click(function() {
    this.select();
  });

  $(".money").autoNumeric("init",{
    mDec: "0",
    vMax: "999999999999999"
  });

  $(".moneySum").autoNumeric("init",{
    mDec: "0",
    vMax: "9999999999999999"    
  });

  $(".percentage").autoNumeric("init");

  $(".money, .percentage").blur(function() {
    if($(this).val() == "") $(this).val(0);
  });

  <?php foreach ($Years as $row) : ?>
  $("#amount_1_<?= $row; ?>, #amount_2_<?= $row; ?>, #amount_3_<?= $row; ?>, #amount_5_<?= $row; ?>").on("blur", function() {
    var kas_<?= $row; ?> = $("#amount_1_<?= $row; ?>").autoNumeric("get");
    var piutang_<?= $row; ?> = $("#amount_2_<?= $row; ?>").autoNumeric("get");
    var persediaan_lainnya_<?= $row; ?> = $("#amount_3_<?= $row; ?>").autoNumeric("get");
    
    var current_assets_<?= $row; ?> = addNumber(kas_<?= $row; ?>, piutang_<?= $row; ?>);
        current_assets_<?= $row; ?> = addNumber(current_assets_<?= $row; ?>, persediaan_lainnya_<?= $row; ?>);
    $("#amount_4_<?= $row; ?>").autoNumeric("set",current_assets_<?= $row; ?>);

    var fixed_assets_<?= $row; ?> = $("#amount_5_<?= $row; ?>").autoNumeric("get");

    var total_assets_<?= $row; ?> = addNumber(current_assets_<?= $row; ?>, fixed_assets_<?= $row; ?>);
    $("#amount_6_<?= $row; ?>").autoNumeric("set",total_assets_<?= $row; ?>);
  });
  <?php endforeach; ?>

  $('#btn_cancel_financial_highlight').click(function(){
      window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/'.$AccountPlanningTab);?>';
  });

  $("#btn_save_financial_highlight").click(function(){
    $(".modal-edit-bri-sp").modal("show");
  });

  $("#btn-save-confirmation").click(function(e){
    e.preventDefault();
    $.ajax({
      type: "post",
      url : $("#formFinancialHighlight").attr("action"),
      data: $("#formFinancialHighlight").serialize(),
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
                  window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input/".$apMenengahId."/".$AccountPlanningTab."/".$FinancialHighlightGroupType); ?>";
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


