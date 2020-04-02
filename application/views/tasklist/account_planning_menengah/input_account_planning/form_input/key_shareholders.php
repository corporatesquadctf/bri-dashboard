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
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning');?>">Manage Account Planning Menengah</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/company_information');?>">Company Information</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Key Shareholders</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Key Shareholders</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formKeyShareholder" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_key_shareholders'; ?>">
                            <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
                            <input type="hidden" id="jumlahShareholders" name="jumlahShareholders" value="<?= count($Shareholder); ?>" />
                            <input type="hidden" id="arrShareholders" name="arrShareholders" value="" />
                            <div class="row form_container" style="box-shadow: none; padding: 20px 30px 5px 30px;">
                                <div class="col-xs-12" style="padding-right: 0;">
                                    <div class="form-group pull-right">
                                        <div class="col-xs-5">
                                            <label>Value per Share :</label>
                                        </div>
                                        <div class="col-xs-7">
                                            <input type="text" id="rate" name="rate" class="form-control shares" onchange="calculate_all_nominal();" data-a-dec="." data-a-sep="," value="<?= $Rate; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="key_shareholders_fields">
                                <?php if (!empty($Shareholder)) {?>
                                    <?php 
                                        $i = 0;
                                        foreach ($Shareholder as $row => $value) : ?>
                                        <div class="row form_container key_shareholders_<?= $i; ?>">
                                            <div class="form-group col-xs-12">
                                                <div class="pull-left" onclick="remove_key_shareholders_fields(<?= $i; ?>);">
                                                    <div class="div-action">
                                                        <i class="material-icons no-after no-before">delete_sweep</i>
                                                        <label class="label-action">Delete Key Shareholders</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label>Key Shareholders :</label>
                                                    <input type="text" id="name_<?= $i; ?>" name="name_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value['Name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label>Shares (qty) :</label>
                                                    <input type="text" id="value_<?= $i; ?>" name="value_<?= $i; ?>" class="form-control money" data-a-dec="." data-a-sep="," onchange="calculate_nominal(<?= $i; ?>)" value="<?= $value['Value']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label>Nominal :</label>
                                                    <input type="text" id="nominal_<?= $i; ?>" name="nominal_<?= $i; ?>" class="form-control moneySum" data-a-dec="." data-a-sep="," value="<?= $value['Nominal']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; endforeach; ?>
                                <?php }else{ ?>
                                    <div class="row form_container key_shareholders_0">
                                        <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_key_shareholders_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Key Shareholders</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Key Shareholders :</label>
                                                <input type="text" id="name_0" name="name_0" class="form-control" maxlength="200" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Shares (qty) :</label>
                                                <input type="text" id="value_0" name="value_0" class="form-control money" onchange="calculate_nominal(0)" data-a-dec="." data-a-sep="," value="" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Nominal :</label>
                                                <input type="text" id="nominal_0" name="nominal_0" class="form-control moneySum" data-a-dec="." data-a-sep="," value="" readonly>
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
                                            <button id="btn_save_edit_key_shareholders" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-key-shareholders" tabindex="-1" role="dialog" aria-hidden="true">
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

    $(document).ready(function() {
        $('.shares').autoNumeric('init',{
            aForm: true,
            vMax: '9999999',
            mDec: '0'
        });

        $('.money').autoNumeric('init',{
            aForm: true,
            vMax: '999999999999',
            mDec: '0'
        });

        $('.moneySum').autoNumeric('init',{
            aForm: true,
            vMax: '999999999999999999',
            mDec: '0'
        });

        $('#btn_cancel_edit_key_shareholders').click(function(){
            window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/company_information');?>';
        });

        $("#btn_save_edit_key_shareholders").click(function(){
            if($("#formKeyShareholder").valid()){
                $(".modal-edit-key-shareholders").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#formKeyShareholder").attr("action"),
                data: $("#formKeyShareholder").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-edit-key-shareholders").modal("hide");
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
                            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input/".$apMenengahId); ?>";
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
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Key Shareholders :</label>';
        inner +=	'		<input type="text" id="name_'+shareholders+'" name="name_'+shareholders+'" class="form-control" value="" required>';
        inner +=	'	</div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Shares (qty) :</label>';
        inner +=	'		<input type="text" id="value_'+shareholders+'" name="value_'+shareholders+'" class="form-control money" data-a-dec="." data-a-sep="," value="" onchange="calculate_nominal('+shareholders+')" required>';
        inner +=	'	</div>';
        inner +=	'</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Nominal :</label>';
        inner +=	'		<input type="text" id="nominal_'+shareholders+'" name="nominal_'+shareholders+'" class="form-control moneySum" data-a-dec="." data-a-sep="," value="" readonly>';
        inner +=	'	</div>';
        inner +=	'</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);
        $('.money').autoNumeric('init',{
            aForm: true,
            vMax: '999999999999',
            mDec: '0'
        });

        $('.moneySum').autoNumeric('init',{
            aForm: true,
            vMax: '999999999999999999',
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

    function calculate_nominal(index){
        var rate = new BigNumber($("#rate").autoNumeric("get"));
        var val = new BigNumber($("#value_"+index).autoNumeric("get"));
        var nominal = "";
        if(val != ""){
            nominal = val.multiply(rate);
        }
        $("#nominal_"+index).autoNumeric("set",nominal);
    }

    function calculate_all_nominal(){
        var rate = new BigNumber($("#rate").autoNumeric("get"));
        if(rate == "") {
            $("#rate").val(1);
            rate = 1;
        }
        $.each(arrShareholders, function(index, item){
            var val = new BigNumber($("#value_"+item).autoNumeric("get"));
            var nominal = "";
            if(val != ""){
                nominal = val.multiply(rate);
            }
            $("#nominal_"+item).autoNumeric("set",nominal);
        });
    }
</script>