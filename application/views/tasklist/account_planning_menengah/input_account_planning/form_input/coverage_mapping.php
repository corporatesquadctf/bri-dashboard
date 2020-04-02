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
                        <li class="breadcrumb-item active" aria-current="page">Edit Coverage Mapping</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Coverage Mapping</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formCoverageMapping" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_coverage_mapping'; ?>">
                            <input type="hidden" id="jumlahCoverageMapping" name="jumlahCoverageMapping" value="<?= count($CoverageMapping); ?>" />
                            <input type="hidden" id="dataCoverageMapping" name="dataCoverageMapping" value="" />
                            <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>">
                            <input type="hidden" id="cif" name="cif" value="<?= $CIF; ?>" />
                            <div id="coverage_mapping_fields">
                                <?php if (!empty($CoverageMapping)) {?>
                                    <?php 
                                        $i = 0;
                                        foreach ($CoverageMapping as $row => $value) : ?>
                                        <div class="row form_container coverage_mapping_<?= $i; ?>">
                                            <div class="form-group col-xs-12">
                                                <div class="pull-left" onclick="remove_coverage_mapping_fields(0);">
                                                    <div class="div-action">
                                                        <i class="material-icons no-after no-before">delete_sweep</i>
                                                        <label class="label-action">Delete Coverage Mapping</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Client Name :</label>
                                                        <input type="text" id="client_name_<?= $i; ?>" name="client_name_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value->ClientName; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Client Contact :</label>
                                                        <input type="text" id="client_contact_<?= $i; ?>" name="client_contact_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value->ContactNumber; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Client Position :</label>
                                                        <input type="text" id="client_position_<?= $i; ?>" name="client_position_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value->ClientPosition; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Bank Person Name :</label>
                                                        <input type="text" id="bank_person_name_<?= $i; ?>" name="bank_person_name_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value->BankPerson; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 form-group">
                                                        <label>Bank Contact :</label>
                                                        <input type="text" id="bank_contact_<?= $i; ?>" name="bank_contact_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value->BankContact; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 form-group">
                                                        <label>Bank Position :</label>
                                                        <input type="text" id="bank_position_<?= $i; ?>" name="bank_position_<?= $i; ?>" class="form-control" maxlength="200" value="<?= $value->BankPosition; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 form-group">
                                                        <label>Other Information :</label>
                                                        <textarea id="other_information_<?= $i; ?>" name="other_information_<?= $i; ?>" class="form-control" rows="5"><?= $value->OtherInformation; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; endforeach; ?>
                                <?php }else{ ?>
                                    <div class="row form_container coverage_mapping_0">
                                        <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_coverage_mapping_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Coverage Mapping</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Client Name :</label>
                                                    <input type="text" id="client_name_0" name="client_name_0" class="form-control" maxlength="200" value="" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Client Contact :</label>
                                                    <input type="text" id="client_contact_0" name="client_contact_0" class="form-control" maxlength="200" value="" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Client Position :</label>
                                                    <input type="text" id="client_position_0" name="client_position_0" class="form-control" maxlength="200" value="">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Bank Person Name :</label>
                                                    <input type="text" id="bank_person_name_0" name="bank_person_name_0" class="form-control" maxlength="200" value="" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 form-group">
                                                    <label>Bank Contact :</label>
                                                    <input type="text" id="bank_contact_0" name="bank_contact_0" class="form-control" value="" maxlength="200" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 form-group">
                                                    <label>Bank Position :</label>
                                                    <input type="text" id="bank_position_0" name="bank_position_0" class="form-control" maxlength="200" value="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 form-group">
                                                    <label>Other Information :</label>
                                                    <textarea id="other_information_0" name="other_information_0" class="form-control" rows="5"></textarea>
                                                </div>
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
                                        <button id="btn_cancel_edit_coverage_mapping" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                        <button id="btn_cancel_add_coverage_mapping" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_coverage_mapping_fields();">ADD COVERAGE MAPPING</button>
                                        <button id="btn_save_edit_coverage_mapping" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-coverage-mapping" tabindex="-1" role="dialog" aria-hidden="true">
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
    var jumlahCoverageMapping = <?= count($CoverageMapping); ?>;
    if(jumlahCoverageMapping == 0){
        var arrCoverageMapping = [0];
    }else{
        var arrCoverageMapping = [];
        for(var i=0; i<jumlahCoverageMapping; i++){
            arrCoverageMapping.push(Number(i));
        }
    }
    $('#dataCoverageMapping').val(arrCoverageMapping);
    $('#jumlahCoverageMapping').val(arrCoverageMapping.length);
    
    $(document).ready(function() {
        $('#btn_cancel_edit_coverage_mapping').click(function(){
            window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/company_information');?>';
        });
        
        $("#btn_save_edit_coverage_mapping").click(function(){
            if($("#formCoverageMapping").valid()){
                $(".modal-edit-coverage-mapping").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#formCoverageMapping").attr("action"),
                data: $("#formCoverageMapping").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-edit-coverage-mapping").modal("hide");
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

    function add_coverage_mapping_fields(){
        if(arrCoverageMapping.length == 0)
            var coverageMapping = 0
        else {
            var coverageMapping = arrCoverageMapping[arrCoverageMapping.length - 1] +1;
        }
        var inner = '';
        var objTo = document.getElementById('coverage_mapping_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row form_container coverage_mapping_"+coverageMapping);
        inner +=    '<div class="form-group col-xs-12">';
        inner +=    '    <div class="pull-left" onclick="remove_coverage_mapping_fields('+coverageMapping+');">';
        inner +=    '        <div class="div-action">';
        inner +=    '            <i class="material-icons no-after no-before">delete_sweep</i>';
        inner +=    '            <label class="label-action">Delete Coverage Mapping</label>';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-6">';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-sm-12 form-group">';
        inner +=    '            <label>Client Name :</label>';
        inner +=    '            <input type="text" id="client_name_'+coverageMapping+'" name="client_name_'+coverageMapping+'" class="form-control" maxlength="200" value="" required>';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-sm-12 form-group">';
        inner +=    '            <label>Client Contact :</label>';
        inner +=    '            <input type="text" id="client_contact_'+coverageMapping+'" name="client_contact_'+coverageMapping+'" class="form-control" maxlength="200" value="" required>';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-sm-12 form-group">';
        inner +=    '            <label>Client Position :</label>';
        inner +=    '            <input type="text" id="client_position_'+coverageMapping+'" name="client_position_'+coverageMapping+'" maxlength="200" class="form-control" value="">';
        inner +=    '        </div>';
        inner +=    '    </div>';        
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-6">';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-sm-12 form-group">';
        inner +=    '           <label>Bank Person Name :</label>';
        inner +=    '            <input type="text" id="bank_person_name_'+coverageMapping+'" name="bank_person_name_'+coverageMapping+'" class="form-control" maxlength="200" value="" required>';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-xs-12 form-group">';
        inner +=    '            <label>Bank Contact :</label>';
        inner +=    '            <input type="text" id="bank_contact_'+coverageMapping+'" name="bank_contact_'+coverageMapping+'" class="form-control" maxlength="200" value="" required>';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-xs-12 form-group">';
        inner +=    '            <label>Bank Position :</label>';
        inner +=    '            <input type="text" id="bank_position_'+coverageMapping+'" name="bank_position_'+coverageMapping+'" class="form-control" maxlength="200" value="">';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '    <div class="row">';
        inner +=    '        <div class="col-xs-12 form-group">';
        inner +=    '            <label>Other Information :</label>';
        inner +=    '            <textarea id="other_information_'+coverageMapping+'" name="other_information_'+coverageMapping+'" class="form-control" rows="5"></textarea>';
        inner +=    '        </div>';
        inner +=    '    </div>';
        inner +=    '</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);
        arrCoverageMapping.push(Number(coverageMapping));
        //console.log(arrCoverageMapping.length);
        $('#dataCoverageMapping').val(arrCoverageMapping);
        $('#jumlahCoverageMapping').val(arrCoverageMapping.length);
    }
    
    function remove_coverage_mapping_fields(coverageMapping){
        $('.coverage_mapping_'+coverageMapping).remove();        
        var index = arrCoverageMapping.indexOf(coverageMapping);
        if (index > -1) {
            arrCoverageMapping.splice(index, 1);
        }
        //console.log(arrCoverageMapping.length);
        $('#dataCoverageMapping').val(arrCoverageMapping);
        $('#jumlahCoverageMapping').val(arrCoverageMapping.length);
    }
</script>