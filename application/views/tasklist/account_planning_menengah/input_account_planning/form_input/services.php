<style>
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
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/client_needs');?>">Client Needs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Services</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Service</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formServices" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_services'; ?>">
                            <input type="hidden" id="totalServices" name="totalServices" value="<?= count($Services); ?>" />
                            <input type="hidden" id="dataServices" name="dataServices" value="" />
                            <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
                            <div id="service_fields">
                                <?php
                                    if (!empty($Services)) {
                                        $i=0;
                                        foreach ($Services as $row) :
                                ?>
                                            <div class="row form_container service_<?= $i; ?>">
                                                <div class="form-group col-xs-12">
                                                    <div class="pull-left" onclick="remove_service_fields(<?= $i; ?>);">
                                                        <div class="div-action">
                                                            <i class="material-icons no-after no-before">delete_sweep</i>
                                                            <label class="label-action">Delete Service</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <div class="form-group">
                                                        <label>Nama Service:</label>
                                                        <input id="name_<?= $i; ?>" name="name_<?= $i; ?>" class="form-control" value="<?= $row->Name; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <div class="form-group">
                                                        <label>Divisi Tag:</label>
                                                        <select class="form-control js-example-basic-multiple" id="type_<?= $i; ?>" name="type_<?= $i; ?>[]" style="width:100%;" multiple="multiple">
                                                            <?php
                                                                foreach ($UnitKerja as $rowUnitKerja){
                                                                    echo '<option value="'.$rowUnitKerja->UnitKerjaId.'">'.$rowUnitKerja->Name.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Target (Bln):</label>
                                                        <input id="target_<?= $i; ?>" name="target_<?= $i; ?>" class="form-control period" value="<?= $row->Target; ?>" style="text-align: right;" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea id="description_<?= $i; ?>" name="description_<?= $i; ?>" class="form-control" rows="4"><?= $row->Description; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                <?php 
                                        $i++;
                                        endforeach;
                                    }else{ 
                                ?>
                                    <div class="row form_container service_0">
                                        <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_service_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Service</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <div class="form-group">
                                                <label>Nama Service:</label>
                                                <input id="name_0" name="name_0" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <div class="form-group">
                                                <label>Divisi Tag:</label>
                                                <select class="form-control js-example-basic-multiple" id="type_0" name="type_0[]" style="width:100%;" multiple="multiple">
                                                    <?php
                                                        foreach ($UnitKerja as $rowUnitKerja){
                                                            $selected = '';
                                                            echo '<option value="'.$rowUnitKerja->UnitKerjaId.'" '.$selected.'>'.$rowUnitKerja->Name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <label>Target (Bln):</label>
                                                <input id="target_0" name="target_0" class="form-control period" style="text-align: right;" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea id="description_0" name="description_0" class="form-control" rows="4"></textarea>
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
                                        <button id="btn_cancel_edit_service" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                        <button id="btn_cancel_add_service" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_service_fields();">ADD Service</button>
                                        <button id="btn_save_edit_service" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-client-needs" tabindex="-1" role="dialog" aria-hidden="true">
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
<script src="<?= base_url(); ?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script>
    var totalServices = <?= count($Services); ?>;
    if(totalServices == 0){
        var arrServices = [0];
    }else{
        var arrServices = [];
        for(var i=0; i<totalServices; i++){
            arrServices.push(Number(i));
        }
    }
    $("#dataServices").val(arrServices);
    $("#totalServices").val(arrServices.length);

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        
        $(".period").autoNumeric("init",{
            mDec: "0",
            vMax: "999",
        });

        <?php
            if (!empty($Services)) {
                $i=0;
                foreach ($Services as $row) :
        ?>
                    $("#type_<?= $i; ?>").val(<?= json_encode($row->UnitKerjaTag); ?>).change();
        <?php
                $i++;
                endforeach;
            }
        ?>
        
        $("#btn_cancel_edit_service").click(function(){
            window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/client_needs');?>';
        });

        $("#btn_save_edit_service").click(function(){
            if($("#formServices").valid()){
                $(".modal-edit-client-needs").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
            type: "post",
            url : $("#formServices").attr("action"),
            data: $("#formServices").serialize(),
            dataType : "json",
            beforeSend:function(){
                $(".modal-edit-client-needs").modal("hide");
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
                        window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input/".$apMenengahId."/".$AccountPlanningTab); ?>";
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

    function add_service_fields(){
        if(arrServices.length == 0)
            var service = 0
        else {
            var service = arrServices[arrServices.length - 1] +1;
        }
        var unitKerjaOption = '';
        <?php foreach($UnitKerja as $row): ?>
        unitKerjaOption += '<option value="<?= $row->UnitKerjaId; ?>"><?= $row->Name; ?></option>';
        <?php endforeach; ?>
        inner = '';
        var objTo = document.getElementById('service_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row form_container service_"+service);
        inner +=    '<div class="form-group col-xs-12">';
        inner +=    '   <div class="pull-left" onclick="remove_service_fields('+service+')">';
        inner +=    '       <div class="div-action">';
        inner +=    '           <i class="material-icons no-after no-before">delete_sweep</i>';
        inner +=    '           <label class="label-action">Delete Service</label>';
        inner +=    '       </div>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-3">';
        inner +=    '   <div class="form-group">';
        inner +=    '       <label>Nama Service:</label>';
        inner +=    '       <input id="name_'+service+'" name="name_'+service+'" class="form-control" required />';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-3">';
        inner +=    '   <div class="form-group">';
        inner +=    '      <label>Divisi Tag:</label>';
        inner +=    '      <select class="form-control js-example-basic-multiple" id="type_'+service+'" name="type_'+service+'[]" style="width:100%;" multiple="multiple">';
        inner +=                unitKerjaOption;
        inner +=    '      </select>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-2">';
        inner +=    '   <div class="form-group">';
        inner +=    '       <label>Target (Bln):</label>';
        inner +=    '       <input id="target_'+service+'" name="target_'+service+'" class="form-control period" style="text-align: right;" />';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=    '   <div class="form-group">';
        inner +=    '       <label>Description:</label>';
        inner +=    '       <textarea id="description_'+service+'" name="description_'+service+'" class="form-control" rows="4"></textarea>';
        inner +=    '   </div>';
        inner +=    '</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);

        $('.js-example-basic-multiple').select2();

        $(".period").autoNumeric("init",{
            mDec: "0",
            vMax: "999",
        });

        arrServices.push(Number(service));
        $('#dataServices').val(arrServices);
        $('#totalServices').val(arrServices.length);
    }

    function remove_service_fields(service){
        $('.service_'+service).remove();        
        var index = arrServices.indexOf(service);
        if (index > -1) {
            arrServices.splice(index, 1);
        }
        $('#dataServices').val(arrServices);
        $('#totalServices').val(arrServices.length);
    }
</script>