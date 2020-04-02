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
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');?>">Company Information</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Key Shareholders</li>
                    </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left">Key Shareholders</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formKeyShareholder" method="post" action="<?= base_url().'tasklist/AccountPlanning/proses_editkeyshareholders/'.$AccountPlanningId; ?>">
                            <input type="hidden" id="jumlahShareholders" name="jumlahShareholders" value="<?= count($Shareholder); ?>" />
                            <input type="hidden" id="arrShareholders" name="arrShareholders" value="" />
                            <div id="key_shareholders_fields">
                                <?php if (!empty($Shareholder)) {?>
                                    <?php 
                                        $i = 0;
                                        foreach ($Shareholder as $row => $value) : ?>
                                        <div class="row form_container key_shareholders_<?= $i; ?>">
                                            <div class="form-group col-xs-12">
                                                <?php if ($i != 0) { ?>
                                                <div class="pull-left" onclick="remove_key_shareholders_fields(<?= $i; ?>);">
                                                    <div class="div-action">
                                                        <i class="material-icons no-after no-before">delete_sweep</i>
                                                        <label class="label-action">Delete Key Shareholders</label>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Key Shareholders :</label>
                                                    <input type="text" id="name_<?= $i; ?>" name="name_<?= $i; ?>" class="form-control" value="<?= $value['Name']; ?>" required maxlength="225">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Shares (qty) :</label>
                                                    <input type="text" id="value_<?= $i; ?>" name="value_<?= $i; ?>" class="form-control money" data-a-dec="." data-a-sep="," value="<?= $value['Value']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; endforeach; ?>
                                <?php }else{ ?>
                                    <div class="row form_container key_shareholders_0">
                                        <!-- <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_key_shareholders_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Key Shareholders</label>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Key Shareholders :</label>
                                                <input type="text" id="name_0" name="name_0" class="form-control" value="" required maxlength="225">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shares (qty) :</label>
                                                <input type="text" id="value_0" name="value_0" class="form-control money" data-a-dec="." data-a-sep="," value="" required>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="row form_action">
                                    <div class="form-group pull-right">
                                        <div class="col-xs-12">
                                            <button id="btn_cancel_edit_key_shareholders" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                            <button id="btn_cancel_add_key_shareholders" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_key_shareholders_fields();">ADD KEY SHAREHOLDERS</button>
                                            <button id="btn_save_edit_key_shareholders" class="btn btn-sm btn-primary btn_save" type="submit" style="width: 200px;">SAVE</button>
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
      <div class="modal-body" style="text-align: left;">
        <p id="confirmation_text1">You're about to saved Key Shareholders details. Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    var jumlahShareholders = <?= count($Shareholder); ?>;
    if(jumlahShareholders == 0){
        var arrShareholders = [0];
    }else{
        var arrShareholders = [];
        for(var i=0; i<jumlahShareholders; i++){
            arrShareholders.push(Number(i));
        }
    }
    $('#arrShareholders').val(arrShareholders);

    function confirmModal() {
        $('#confirmModal').modal('show');
        var confirmation_text1 = $('#OK').attr('confirmation_text1');
        $("#confirmation_text1").html(confirmation_text1);
    }

    $(document).ready(function() {
        $('.money').autoNumeric('init',{
            aForm: true,
            vMax: '<?=MAX_NUMERIC?>',
            vMin: '<?=MIN_NUMERIC?>',
            mDec: '0'
        });

        $('#btn_cancel_edit_key_shareholders').click(function(){
            window.location.href= '<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/company_information');?>';
        });

        $('#formKeyShareholder').validate({
            submitHandler: function(form) {
                confirmModal();
            }
        });

        $('#OK').click(function(){
            $.ajax({
              type: 'post',
              url : $('#formKeyShareholder').attr('action'),
              data: $('#formKeyShareholder').serialize(),
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
                    window.location.href= '<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/company_information');?>';
                    $('.loaderImage').hide();
                }, 2000);
              }
            });
        });

    });

    function add_key_shareholders_fields(){
        if(arrShareholders.length == 0)
            var shareholders = 0
        else {
            var shareholders = arrShareholders[arrShareholders.length - 1] +1;
        }
        var inner = '';
        var objTo = document.getElementById('key_shareholders_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row form_container key_shareholders_"+shareholders);
        inner +=    '<div class="form-group col-xs-12">';
        inner +=    '   <div class="pull-left" onclick="remove_key_shareholders_fields('+shareholders+')">';
        inner +=    '       <div class="div-action">';
        inner +=    '           <i class="material-icons no-after no-before">delete_sweep</i>';
        inner +=    '           <label class="label-action">Delete Key Shareholders</label>';
        inner +=    '       </div>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-6">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Key Shareholders :</label>';
        inner +=	'		<input type="text" id="name_'+shareholders+'" name="name_'+shareholders+'" class="form-control" value="" required maxlength="225">';
        inner +=	'	</div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-6">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Shares (qty) :</label>';
        inner +=	'		<input type="text" id="value_'+shareholders+'" name="value_'+shareholders+'" class="form-control money" data-a-dec="." data-a-sep="," value="" required>';
        inner +=	'	</div>';
        inner +=	'</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);
        $('.money').autoNumeric('init',{
            aForm: true,
            vMax: '999999999999999',
            mDec: '0'
        });
        arrShareholders.push(Number(shareholders));
        $('#arrShareholders').val(arrShareholders);
        $('#jumlahShareholders').val(arrShareholders.length);
    }
    
    function remove_key_shareholders_fields(shareholders){
        $('.key_shareholders_'+shareholders).remove();        
        var index = arrShareholders.indexOf(shareholders);
        if (index > -1) {
            arrShareholders.splice(index, 1);
        }
        $('#arrShareholders').val(arrShareholders);
        $('#jumlahShareholders').val(arrShareholders.length);
    }
</script>