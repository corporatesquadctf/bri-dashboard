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
                      <li class="breadcrumb-item"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/client_needs');?>">Client Needs</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Services</li>
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left"><?= $CustomerName ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="row form_container">
                <table width="100%" id="table-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>" class="table table-condensed table-hover">
                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
                    <tr>
                      <!-- <td style="text-align: left; width: 5%">No</td> -->
                      <td style="text-align: left; width: 30%;">Nama Service</td>
                      <td style="text-align: left; width: 30%;">Divisi Tag</td>
                      <td style="text-align: right; width: 5%;">Target</td>
                      <td style="text-align: left; width: 30%;">Description</td>
                      <td style="text-align: right; width: 5%;">Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if (isset($inputform['Service']['dataService'])) {?>
                  <?php $index0 = 0; ?>
                  <?php $index1 = 1; ?>
                  <?php foreach ($inputform['Service']['dataService'] as $row => $value) : ?>
                        <tr>
                          <!-- <td style="text-align: left; vertical-align: top;"><?= $index1 ?></td> -->
                          <td style="text-align: left; vertical-align: top;"><input type="text" name="Name[]" id="Name" class="form-control col-md-7 col-xs-12" value="<?= $value['ServiceName'] ?>" required maxlength="100"></td>
                          <td style="text-align: left; vertical-align: top;">
                            <select data-placeholder="Search Unit Kerja" class="form-control js-example-basic-multiple" name="ServiceTag[<?=$index0?>][ServiceTags][]" multiple="multiple">
                              <?php 
                              foreach ($inputform['Service']['uker_list'] as $UnitKerjaId => $UnitKerjaName) {
                              $selected = '';
                                foreach ($value['TagServiceUnitKerjaId'] as $rows => $TagUnitKerjaId) {
                                  if ($UnitKerjaId == $TagUnitKerjaId) {
                                    $selected = ' selected';
                                  }
                                }
                              ?>
                              <option value="<?= $UnitKerjaId ?>"<?= $selected ?>><?= $UnitKerjaName ?></option>
                              <?php } ?>
                            </select>
                          </td>
                          <td style="text-align: right; vertical-align: top;">
                            <input type="text" name="Target[]" id="Target" class="form-control col-md-3 col-xs-3 pull-left month" value="<?=$value['ServiceTarget']?>" maxlength="3" style="">Bulan
                          </td>
                          <td style="text-align: left; height: 80px; vertical-align: top;">
                            <textarea name="Description[]" class="form-control col-md-12 col-xs-12" rows="4" style="width: 100%; height: 100%;" maxlength="225"><?=$value['ServiceDescription']?></textarea>
                          </td>
                          <td style="text-align: right;">
                          <?php if($index0 != 0) {?>
                            <button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRowService(this, 'ServiceId', <?=$value['ServiceId']?>); return false;" Title="Delete"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">delete_sweep</i></button>
                          <?php }  ?>
                            <input type="hidden" name="ServiceSubmit[]" value="edit">
                            <input type="hidden" name="ServiceId[]" value="<?=$value['ServiceId']?>">
                            <input type="hidden" id="rownumber" value="<?= count($inputform['Service']['dataService'])-1 ?>"/>
                          </td>
                        </tr>
                    <?php $index0++?>
                    <?php $index1++?>
                    <?php endforeach; ?>
                    <?php } else {?>
                        <tr>
                          <!-- <td style="text-align: left; vertical-align: top;"></td> -->
                          <td style="text-align: left; vertical-align: top;"><input type="text" name="Name[]" id="Name" class="form-control col-md-7 col-xs-12" required maxlength="100"></td>
                          <td style="text-align: left; vertical-align: top;">
                            <select data-placeholder="Search Unit Kerja" class="form-control js-example-basic-multiple" name="ServiceTag[0][ServiceTags][]" multiple="multiple">
                              <?php foreach ($inputform['Service']['uker_list'] as $row => $value) : ?>
                              <option value="<?= $row ?>"><?= $value ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>
                          <td style="text-align: right; vertical-align: top;">
                            <input type="text" name="Target[]" id="Target" class="form-control col-md-3 col-xs-3 pull-left month" value="" maxlength="3" style="text-align: left;">Bulan
                          </td>
                          <td style="text-align: left; height: 80px; vertical-align: top;">
                            <textarea name="Description[]" class="form-control col-md-12 col-xs-12" rows="4" style="width: 100%; height: 100%;" maxlength="225"></textarea>
                          </td>
                          <td style="text-align: right;">
                            <!-- <button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRowService(this, 'ServiceId', 0); return false;" Title="Delete"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">delete_sweep</i></button> -->
                            <input type="hidden" name="ServiceSubmit[]" value="add">
                            <input type="hidden" name="ServiceId[]" value="">
                            <input type="hidden" id="rownumber" value="0"/>
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
                    <input type="hidden" name="InputTable" value="Service">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/client_needs');?>'">BACK</button>
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="add_service_fields();" Title="Add New Row">ADD ROW</button>
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
        <p id="confirmation_text1">You're about to saved Services details. <br>Are you sure?</p>
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

  function deleteRowService(btn, IdName, RemoveId) {
    var IdName = IdName;
    var RemoveId = RemoveId;
    var row = btn.parentNode.parentNode;
    
    row.parentNode.removeChild(row);

    if (RemoveId != null) {
      $(document).ready(function() {
        var form = $('#add-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>');
        $(form).append('<input type="hidden" name="IdName[]" value="'+IdName+'" /> ');
        $(form).append('<input type="hidden" name="RemoveId[]" value="'+RemoveId+'" /> ');
      });
    }
  }

  $(document).ready(function() {
    $('.month').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '999',
      unformatOnSubmit: true
    });

    $('.js-example-basic-multiple').select2();

    // $('#add-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>').on('submit', function (e) {
    //   e.preventDefault();
    //   if(confirm('Anda yakin?')) {
   $('#OK').click(function(){
        $.ajax({
          type: 'post',
          url : $('#add-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>').attr('action'),
          data: $('#add-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>').serialize(),
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
      
  });

  function deleteRow(btn) {
      var row = btn.parentNode.parentNode;
      row.parentNode.removeChild(row);
  }

  function add_service_fields(){
    var value = parseInt(document.getElementById('rownumber').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('rownumber').value = value;
    var rownumber = value;

    $(document).ready(function() {

      var table_tr_fundings = $('#table-<?= $AccountPlanningTab; ?>-<?= $AccountPlanningSubTab; ?>');

      $(table_tr_fundings).append('<tr><td style="text-align: left; vertical-align: top;"><input type="text" name="Name[]" id="Name" class="form-control col-md-7 col-xs-12" required maxlength="100"></td><td style="text-align: left; vertical-align: top;"><select data-placeholder="Search Unit Kerja" class="form-control js-example-basic-multiple" name="ServiceTag['+rownumber+'][ServiceTags][]" multiple="multiple"><?php foreach ($inputform['Service']['uker_list'] as $row => $value) : ?><option value="<?= $row ?>"><?= $value ?></option><?php endforeach; ?></select></td><td style="text-align: right; vertical-align: top;"><input type="text" name="Target[]" id="Target" class="form-control col-md-3 col-xs-3 pull-left month" value="" maxlength="3" style="">Bulan</td><td style="text-align: left; height: 80px; vertical-align: top;"><textarea name="Description[]" class="form-control col-md-12 col-xs-12" rows="4" style="width: 100%; height: 100%;" maxlength="225"></textarea></td><td style="text-align: right;"><button class="btn btn-sm btn-default btn_cancel" type="button" onclick="deleteRowService(this);"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);" Title="Delete">delete_sweep</i></button><input type="hidden" name="ServiceSubmit[]" value="add"><input type="hidden" name="ServiceId[]" value=""></td></tr>');

      $('.js-example-basic-multiple').select2();

      $('.month').autoNumeric('init',{
        aForm: true,
        mDec: '0',
        vMax: '999',
        unformatOnSubmit: true
      });

    });
  }

</script>
