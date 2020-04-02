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
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/simulation');?>">Simulation</a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Input Account Planning</li> -->
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left">Assumption</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <table width="100%" id="table-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType ?>-1" class="table">
                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
                    <tr>
                      <th style="width: 50%;">KURS USD</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="USDExchange" id="USDExchange" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $account_planning['CreditSimulationAssumption']['USDExchange'] ?>" style="text-align: right;"></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <table width="100%" id="table-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType ?>-2" class="table">
                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
                    <tr>
                      <th style="text-align: left;">FTP Simpanan IDR (%)</th>
                      <th style="text-align: left;">FTP Simpanan Valas (%)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="IDRFTPSimpanan" id="IDRFTPSimpanan" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $account_planning['CreditSimulationAssumption']['IDRFTPSimpanan'] ?>" style="text-align: right;"></td>
                      <td><input type="text" name="ValasFTPSimpanan" id="ValasFTPSimpanan" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $account_planning['CreditSimulationAssumption']['ValasFTPSimpanan'] ?>" style="text-align: right;"></td>
                    </tr>
                  </tbody>
                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
                    <tr>
                      <th style="text-align: left;">FTP Pinjaman IDR (%)</th>
                      <th style="text-align: left;">FTP Pinjaman Valas (%)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="IDRFTPPinjaman" id="IDRFTPPinjaman" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $account_planning['CreditSimulationAssumption']['IDRFTPPinjaman'] ?>" style="text-align: right;"></td>
                      <td><input type="text" name="ValasFTPPinjaman" id="ValasFTPPinjaman" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $account_planning['CreditSimulationAssumption']['ValasFTPPinjaman'] ?>" style="text-align: right;"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <input type="hidden" name="CreditSimulationAssumptionId" value="<?= $account_planning['CreditSimulationAssumption']['CreditSimulationAssumptionId'] ?>">
                    <input type="hidden" name="CreditSimulationAssumptionSubmit" value="<?=$CreditSimulationAssumptionSubmit?>">
                    <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                    <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType ?>">
                    <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                    <input type="hidden" name="InputTable" value="CreditSimulationAssumption">
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
        <p id="confirmation_text1">You're about to saved Input Assumption details. <br>Are you sure?</p>
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

    $('.money').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '<?=MAX_NUMERIC?>',
      vMin: '<?=MIN_NUMERIC?>',
      aPad: false,
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
    //   if(confirm('Your\'e about to saved Input Assumption details. \nAre you sure?')) {
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
        
    $('#USDExchange').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#USDExchange').on('blur', function() {
      if($(this).val() == ''){$(this).val(0);}
    });
    $('#IDRFTPSimpanan').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#IDRFTPSimpanan').on('blur', function() {
      if($(this).val() == ''){$(this).val(0.00);}
    });
    $('#ValasFTPSimpanan').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#ValasFTPSimpanan').on('blur', function() {
      if($(this).val() == ''){$(this).val(0.00);}
    });
    $('#IDRFTPPinjaman').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#IDRFTPPinjaman').on('blur', function() {
      if($(this).val() == ''){$(this).val(0.00);}
    });
    $('#ValasFTPPinjaman').on('focus', function() {
      if($(this).val() == 0){$(this).val('');}
    });
    $('#ValasFTPPinjaman').on('blur', function() {
      if($(this).val() == ''){$(this).val(0.00);}
    });
  });

</script>
