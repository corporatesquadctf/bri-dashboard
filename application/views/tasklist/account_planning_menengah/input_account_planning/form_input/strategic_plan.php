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
                        <li class="breadcrumb-item active" aria-current="page">Edit Strategic Plan</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Strategic Plan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formStrategicPlan" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_strategic_plan'; ?>">
                            <input type="hidden" id="jumlahStrategicPlan" name="jumlahStrategicPlan" value="<?= count($StrategicPlan); ?>" />
                            <input type="hidden" id="dataStrategicPlan" name="dataStrategicPlan" value="" />
                            <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
                            <input type="hidden" id="cif" name="cif" value="<?= $CIF; ?>" />
                            <div id="strategic_plan_fields">
                                <?php if (!empty($StrategicPlan)) {?>
                                    <?php 
                                        $i = 0;
                                        foreach ($StrategicPlan as $row => $value) : ?>
                                        <div class="row form_container strategic_plan_<?= $i; ?>">
                                            <div class="form-group col-xs-12">
                                                <div class="pull-left" onclick="remove_strategic_plan_fields(<?= $i; ?>);">
                                                    <div class="div-action">
                                                        <i class="material-icons no-after no-before">delete_sweep</i>
                                                        <label class="label-action">Delete Strategic Plan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Type :</label>
                                                    <select class="form-control js-example-basic-single" id="type_<?= $i; ?>" name="type_<?= $i; ?>" style="width:100%;">
                                                        <?php
                                                            foreach ($StrategicPlanTypeOption as $row){
                                                                $selected = '';
                                                                if($value->StrategicPlanTypeId == $row->StrategicPlanTypeId) $selected = 'selected="selected"';
                                                                echo '<option value="'.$row->StrategicPlanTypeId.'" '.$selected.'>'.$row->Name.'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Description :</label>
                                                    <textarea id="name_<?= $i; ?>" name="name_<?= $i; ?>" class="form-control" rows="4" required><?= $value->Name; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; endforeach; ?>
                                <?php }else{ ?>
                                    <div class="row form_container strategic_plan_0">
                                        <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_strategic_plan_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Strategic Plan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Strategic Plan :</label>
                                                <select class="form-control js-example-basic-single" id="type_0" name="type_0" style="width:100%;">
                                                    <?php
                                                        foreach ($StrategicPlanTypeOption as $row){
                                                            echo '<option value="'.$row->StrategicPlanTypeId.'">'.$row->Name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Description :</label>
                                                <textarea id="name_0" name="name_0" class="form-control" rows="4" required></textarea>
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
                                        <button id="btn_cancel_edit_strategic_plan" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                        <button id="btn_cancel_add_strategic_plan" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_strategic_plan_fields();">ADD STRATEGIC PLAN</button>
                                        <button id="btn_save_edit_strategic_plan" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-strategic-plan" tabindex="-1" role="dialog" aria-hidden="true">
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
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    var jumlahStrategicPlan = <?= count($StrategicPlan); ?>;
    if(jumlahStrategicPlan == 0){
        var arrStrategicPlan = [0];
    }else{
        var arrStrategicPlan = [];
        for(var i=0; i<jumlahStrategicPlan; i++){
            arrStrategicPlan.push(Number(i));
        }
    }
    $('#dataStrategicPlan').val(arrStrategicPlan);
    $('#jumlahStrategicPlan').val(arrStrategicPlan.length);

    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('#btn_cancel_edit_strategic_plan').click(function(){
            window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/company_information');?>';
        });

        $("#btn_save_edit_strategic_plan").click(function(){
            if($("#formStrategicPlan").valid()){
                $(".modal-edit-strategic-plan").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#formStrategicPlan").attr("action"),
                data: $("#formStrategicPlan").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-edit-strategic-plan").modal("hide");
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

    function add_strategic_plan_fields(){
        if(arrStrategicPlan.length == 0)
            var strategicPlan = 0
        else {
            var strategicPlan = arrStrategicPlan[arrStrategicPlan.length - 1] +1;
        }
        var strategicPlanTypeOption = '';
        <?php foreach($StrategicPlanTypeOption as $row): ?>
            strategicPlanTypeOption += '<option value="<?= $row->StrategicPlanTypeId; ?>"><?= $row->Name; ?></option>';
        <?php endforeach; ?>
        var inner = '';
        var objTo = document.getElementById('strategic_plan_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row form_container strategic_plan_"+strategicPlan);
        inner +=    '<div class="form-group col-xs-12">';
        inner +=    '   <div class="pull-left" onclick="remove_strategic_plan_fields('+strategicPlan+')">';
        inner +=    '       <div class="div-action">';
        inner +=    '           <i class="material-icons no-after no-before">delete_sweep</i>';
        inner +=    '           <label class="label-action">Delete Strategic Plan</label>';
        inner +=    '       </div>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-6">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Type :</label>';
        inner +=	'		<select id="type_'+strategicPlan+'" name="type_'+strategicPlan+'" class="js-example-basic-single form-control">';
        inner +=                strategicPlanTypeOption;
        inner +=    '		</select>';
        inner +=	'	</div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-6">';
        inner +=	'	<div class="form-group">';
        inner +=    '       <label>Description :</label>';
        inner +=	'		    <textarea id="name_'+strategicPlan+'" name="name_'+strategicPlan+'" class="form-control" rows="4" required></textarea>';
        inner +=	'	</div>';
        inner +=	'</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);
        $('.js-example-basic-single').select2();
        arrStrategicPlan.push(Number(strategicPlan));
        $('#dataStrategicPlan').val(arrStrategicPlan);
        $('#jumlahStrategicPlan').val(arrStrategicPlan.length);
    }
    
    function remove_strategic_plan_fields(strategicPlan){
        $('.strategic_plan_'+strategicPlan).remove();        
        var index = arrStrategicPlan.indexOf(strategicPlan);
        if (index > -1) {
            arrStrategicPlan.splice(index, 1);
        }
        $('#dataStrategicPlan').val(arrStrategicPlan);
        $('#jumlahStrategicPlan').val(arrStrategicPlan.length);
    }
</script>