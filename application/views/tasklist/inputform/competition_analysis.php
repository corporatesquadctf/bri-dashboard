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
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$BankFacilityGroupType);?>">Competition Analysis</a></li>
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
                  <?php if (isset($inputform[$BankFacilityGroupType])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType] as $rows => $values) : ?>
                  <tr>
                    <td style="vertical-align: bottom;" width="20%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $values['BankFacilityItemName'] ?></label></td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Bank Name #1</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><?= $dataBankLists[$values['BankFacilityItemId']][1]; ?></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Bank Name #2</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><?= $dataBankLists[$values['BankFacilityItemId']][2]; ?></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Bank Name #3</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><?= $dataBankLists[$values['BankFacilityItemId']][3]; ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" height="30">
                      <input type="hidden" name="BankFacilityItemId[]" value="<?= $values['BankFacilityItemId']; ?>">
                      <input type="hidden" name="CompetitionAnalysisId[]" value="<?=$values['CompetitionAnalysisId']?>">
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <tr>
                    <td colspan="4">
                      <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                      <input type="hidden" name="CompetitionAnalysisSubmit" value="<?= $CompetitionAnalysisSubmit; ?>">
                      <input type="hidden" name="InputTable" value="CompetitionAnalysis">
                    </td>
                  </tr>
                </table>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/bri_starting_position/'.$BankFacilityGroupType);?>'">BACK</button>
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
        <p id="confirmation_text1">You're about to saved Competition Analysis details. <br>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var base_url = "<?= base_url(); ?>";

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

$(document).ready(function() {

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
  });
    
});

</script>


