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
    .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
        border-radius: 4px;
    }
    .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
        min-height: 34px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-top: 3px;
    }    
    .error {
        font-weight: normal !important;
        color: #f00 !important;
    }
    .btn_save:active, .btn_save:focus{
        border-color: #F58C38;
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
                        <li class="breadcrumb-item active" aria-current="page">Edit Debitur Overview</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Debitur Overview</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formDebiturOverview" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_debitur_overview'; ?>">
                            <div class="row form_container">
                                <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>">
                                <input type="hidden" id="CIF" name="CIF" value="<?= $CIF; ?>">
                                <input type="hidden" id="type" name="type" value="<?= $Type; ?>">
                                <?php
                                    if(!empty($DebiturOverview)){
                                ?>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Customer Name :</label>
                                        <input type="text" id="child_company" name="child_company" class="form-control" value="<?= $CustomerName; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Address :</label>
                                        <textarea id="address" name="address" class="form-control" rows="5" required><?= $DebiturOverview->Address; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>City :</label>
                                        <select class="form-control js-example-basic-single" id="city" name="city" style="width:100%;">
                                            <?php
                                                foreach ($CityOption as $row){
                                                    $selected = '';
                                                    if($DebiturOverview->ProvinceId == $row->ProvinceId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->ProvinceId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Industry :</label>
                                        <input type="text" id="industry" name="industry" class="form-control" maxlength="200" value="<?= $DebiturOverview->IndustryName; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Industry Trend :</label>
                                        <select class="form-control js-example-basic-single" id="industry_trend" name="industry_trend" style="width:100%;">
                                            <?php
                                                foreach ($IndustryTrendOption as $row){
                                                    $selected = '';
                                                    if($DebiturOverview->IndustryTrendId == $row->IndustryTrendId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->IndustryTrendId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top: 21px;">
                                        <label>Life Cycle :</label>
                                        <select class="form-control js-example-basic-single" id="life_cycle" name="life_cycle" style="width:100%;">
                                            <?php
                                                foreach ($LifeCycleOption as $row){
                                                    $selected = '';
                                                    if($DebiturOverview->LifeCycleId == $row->LifeCycleId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->LifeCycleId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    }else{
                                ?>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Customer Name :</label>
                                            <input type="text" id="child_company" name="child_company" class="form-control" value="<?= $CustomerName; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <textarea id="address" name="address" class="form-control" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>City :</label>
                                            <select class="form-control js-example-basic-single" id="city" name="city" style="width:100%;">
                                                <?php
                                                    foreach ($CityOption as $row){
                                                        echo '<option value="'.$row->ProvinceId.'">'.$row->Name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Industry :</label>
                                            <input type="text" id="industry" name="industry" class="form-control" maxlength="200" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Industry Trend :</label>
                                            <select class="form-control js-example-basic-single" id="industry_trend" name="industry_trend" style="width:100%;">
                                                <?php
                                                    foreach ($IndustryTrendOption as $row){
                                                        echo '<option value="'.$row->IndustryTrendId.'">'.$row->Name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="margin-top: 21px;">
                                            <label>Life Cycle :</label>
                                            <select class="form-control js-example-basic-single" id="life_cycle" name="life_cycle" style="width:100%;">
                                                <?php
                                                    foreach ($LifeCycleOption as $row){
                                                        $selected = '';
                                                        if($DebiturOverview->LifeCycleId == $row->LifeCycleId) $selected = 'selected="selected"';
                                                        echo '<option value="'.$row->LifeCycleId.'" '.$selected.'>'.$row->Name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="row form_action">
                                    <div class="form-group pull-right">
                                        <div class="col-xs-12">
                                            <button id="btn_cancel_edit_group_overview" class="btn w150 btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                            <button id="btn_save_edit_group_overview" class="btn w150 btn-sm btn-primary btn_save" type="button" style="margin-right:0px; width: 200px;">SAVE</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-debitur-overview" tabindex="-1" role="dialog" aria-hidden="true">
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
    $(document).ready(function() {
        $(".js-example-basic-single").select2();

        $("#btn_cancel_edit_group_overview").click(function(){
            window.location.href= "<?=base_url("tasklist/account_planning_menengah/manage_account_planning/input/".$apMenengahId."/company_information");?>";
        });

        $("#btn_save_edit_group_overview").click(function(){
            if($("#formDebiturOverview").valid()){
                $(".modal-edit-debitur-overview").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#formDebiturOverview").attr("action"),
                data: $("#formDebiturOverview").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-edit-debitur-overview").modal("hide");
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
</script>