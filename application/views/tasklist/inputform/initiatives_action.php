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
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/action_plans/initiatives_action');?>">Initiatives & Action Plan</a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Input Account Planning</li> -->
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left"><?= $CustomerName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $VCIF ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="row form_container">
                <table width="100%" id="table-<?= $AccountPlanningTab; ?>-<?= $VCIF ?>" class="table">
                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
                    <tr>
                      <!-- <td style="text-align: left; width: 5%">No</td> -->
                      <td style="text-align: left;">Initiatives</td>
                      <td style="text-align: left;">Action Plans</td>
                      <td style="text-align: left;">Description</td>
                      <td style="text-align: right; width: 10%;">Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($inputform['InitiativeAction'][$VCIF])) {?>
                  <?php $index0 = 0; ?>
                  <?php $index1 = 1; ?>
                  <?php foreach ($inputform['InitiativeAction'][$VCIF] as $row => $value) : ?>
                        <tr id="row_<?= $index0 ?>">
                          <!-- <td style="text-align: left; vertical-align: top;"><?= $index1 ?></td> -->
                          <td style="text-align: left; vertical-align: top;"><input type="text" name="Name[]" id="Name" class="form-control col-md-7 col-xs-12" value="<?= $value['Name'] ?>" required maxlength="100"></td>
                          <td style="text-align: left; vertical-align: top;">
                            <div class='input-group date InitiativeActionYMpicker'>
                                <input type="text" name="Period[]" id="Period" class="form-control col-md-3 col-xs-12" value="<?=$value['Period']?>" required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                          </td>
                          <td style="text-align: left; height: 80px; vertical-align: top;">
                            <textarea name="Description[]" class="form-control col-md-12 col-xs-12" rows="4" style="width: 100%; height: 100%;" maxlength="225"><?=$value['Description']?></textarea>
                          </td>
                          <td style="text-align: right;">
                          <?php if($index0 != 0) {?>
                            <button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRow(this, 'InitiativeActionId', <?=$value['InitiativeActionId']?>); return false;"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);" Title="Delete">delete_sweep</i></button>
                          <?php }  ?>
                            <input type="hidden" name="InitiativeActionSubmit[]" value="<?= $InitiativeActionSubmit ?>">
                            <input type="hidden" name="InitiativeActionId[]" value="<?=$value['InitiativeActionId']?>">
                          </td>
                        </tr>
                    <?php $index0++?>
                    <?php $index1++?>
                    <?php endforeach; ?>
                    <?php } else { ?>
                        <tr>
                          <!-- <td style="text-align: left; vertical-align: top;"></td> -->
                          <td style="text-align: left; vertical-align: top;"><input type="text" name="Name[]" id="Name" class="form-control col-md-7 col-xs-12" value="" required maxlength="100"></td>
                          <td style="text-align: left; vertical-align: top;">
                            <div class='input-group date InitiativeActionYMpicker'>
                                <input type="text" name="Period[]" id="Period" class="form-control col-md-3 col-xs-12" value="">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                          </td>
                          <td style="text-align: left; height: 80px; vertical-align: top;">
                            <textarea name="Description[]" class="form-control col-md-12 col-xs-12" rows="4" style="width: 100%; height: 100%;" maxlength="225"></textarea>
                          </td>
                          <td style="text-align: right;">
                            <!-- <button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRow(this, 'InitiativeActionId', 0); return false;" Title="Delete"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">delete_sweep</i></button> -->
                            <input type="hidden" name="InitiativeActionSubmit[]" value="<?= $InitiativeActionSubmit ?>">
                            <input type="hidden" name="InitiativeActionId[]" value="">
                          </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                    <input type="hidden" name="VCIF" value="<?= $VCIF ?>">
                    <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                    <input type="hidden" name="InputTable" value="InitiativeAction">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/action_plans/initiatives_action');?>'">BACK</button>
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="add_initatives_action_fields();" Title="Add New Row">ADD ROW</button>
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
        <p id="confirmation_text1">You're about to saved Initiatives & Action Plan details. <br>Are you sure?</p>
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

  function deleteRow(btn, IdName, RemoveId) {
    var IdName = IdName;
    var RemoveId = RemoveId;
    var row = btn.parentNode.parentNode;
    
    row.parentNode.removeChild(row);

    if (RemoveId != null) {
      $(document).ready(function() {
        var form = $('#add-<?= $AccountPlanningTab; ?>-<?= $VCIF ?>');
        $(form).append('<input type="hidden" name="IdName[]" value="'+IdName+'" /> ');
        $(form).append('<input type="hidden" name="RemoveId[]" value="'+RemoveId+'" /> ');
      });
    }
  }

  $(function () {
      // Bootstrap DateTimePicker v4
      $('.InitiativeActionYMpicker').datetimepicker({
          useCurrent: true,
          minDate: 'now',
          format: 'YYYY-MM',
          viewMode: 'years',
          ignoreReadonly: true,
      });
      $('.InitiativeActionYMpicker').addClass('adaDate');
  });


  function add_initatives_action_fields(){
    $(document).ready(function() {
      var table_tr = $('#table-<?= $AccountPlanningTab; ?>-<?= $VCIF ?>');

      $(table_tr).append('<tr><td style="text-align: left; vertical-align: top;"><input type="text" name="Name[]" id="Name" class="form-control col-md-7 col-xs-12" required maxlength="100"></td><td style="text-align: left; vertical-align: top;"><div class="input-group date InitiativeActionYMpicker"><input type="text" name="Period[]" id="Period" class="form-control col-md-3 col-xs-12" required><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></td><td style="text-align: left; height: 80px; vertical-align: top;"><textarea name="Description[]" class="form-control" rows="4" style="width: 100%; height: 100%;" maxlength="225"></textarea></td><td style="text-align: right;"><button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRow(this); return false;"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);" Title="Delete">delete_sweep</i></button><input type="hidden" name="InitiativeActionSubmit[]" value="add"><input type="hidden" name="InitiativeActionId[]" value=""></td></tr>');

      $('.InitiativeActionYMpicker').datetimepicker({
          useCurrent: true,
          minDate: 'now',
          format: 'YYYY-MM',
          viewMode: 'years',
          ignoreReadonly: true,
      });
      $('.InitiativeActionYMpicker').addClass('adaDate');
    });
  }

  $(document).ready(function() {

    // $('#add-<?= $AccountPlanningTab; ?>-<?= $VCIF; ?>').on('submit', function (e) {
    //   e.preventDefault();
    //   if(confirm('Anda yakin?')) {
    $('#OK').click(function(){
        $.ajax({
          type: 'post',
          url : $('#add-<?= $AccountPlanningTab; ?>-<?= $VCIF; ?>').attr('action'),
          data: $('#add-<?= $AccountPlanningTab; ?>-<?= $VCIF; ?>').serialize(),
          dataType : 'json',
          beforeSend:function(){
            $('#confirmModal').hide();
            $('.loaderImage').show();
          },
          error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
            $('.loaderImage').hide();
            new PNotify({
                title: 'errorThrown!',
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
                window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>/<?= $AccountPlanningSubTab; ?>/0/<?= $VCIF; ?>';
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
      
  });

</script>
