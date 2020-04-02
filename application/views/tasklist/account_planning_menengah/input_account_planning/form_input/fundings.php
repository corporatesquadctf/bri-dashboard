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
                        <li class="breadcrumb-item active" aria-current="page">Edit Fundings</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Fundings</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formFundings" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_fundings'; ?>">
                            <input type="hidden" id="totalFundings" name="totalFundings" value="<?= count($Fundings); ?>" />
                            <input type="hidden" id="dataFundings" name="dataFundings" value="" />
                            <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
                            <div id="funding_fields">
                                <?php
                                    if (!empty($Fundings)) {
                                        $i=0;
                                        foreach ($Fundings as $row) :
                                ?>
                                            <div class="row form_container funding_<?= $i; ?>">
                                                <div class="form-group col-xs-12">
                                                    <div class="pull-left" onclick="remove_funding_fields(<?= $i; ?>);">
                                                        <div class="div-action">
                                                            <i class="material-icons no-after no-before">delete_sweep</i>
                                                            <label class="label-action">Delete Funding</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group">
                                                        <label>Kebutuhan Pendanaan:</label>
                                                        <input id="funding_need_<?= $i; ?>" name="funding_need_<?= $i; ?>" class="form-control" value="<?= $row->FundingNeed; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Jangka Waktu:</label>
                                                        <input id="time_period_<?= $i; ?>" name="time_period_<?= $i; ?>" class="form-control period" value="<?= $row->TimePeriod; ?>" style="text-align: right;" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Nominal:</label>
                                                        <input id="amount_<?= $i; ?>" name="amount_<?= $i; ?>" class="form-control money" value="<?= $row->Amount; ?>" style="text-align: right;" />
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
                                    <div class="row form_container funding_0">
                                        <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_funding_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Funding</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Kebutuhan Pendanaan:</label>
                                                <input id="funding_need_0" name="funding_need_0" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <label>Jangka Waktu:</label>
                                                <input id="time_period_0" name="time_period_0" class="form-control period" style="text-align: right;" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <label>Nominal:</label>
                                                <input id="amount_0" name="amount_0" class="form-control money" style="text-align: right;" />
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
                                        <button id="btn_cancel_edit_funding" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                        <button id="btn_cancel_add_funding" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_funding_fields();">ADD FUNDING</button>
                                        <button id="btn_save_edit_funding" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
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
    var totalFundings = <?= count($Fundings); ?>;
    if(totalFundings == 0){
        var arrFundings = [0];
    }else{
        var arrFundings = [];
        for(var i=0; i<totalFundings; i++){
            arrFundings.push(Number(i));
        }
    }
    $("#dataFundings").val(arrFundings);
    $("#totalFundings").val(arrFundings.length);

    $(document).ready(function() {
        $(".money").autoNumeric("init",{
            mDec: "0",
            vMax: "999999999999999",
        });

        $(".period").autoNumeric("init",{
            mDec: "0",
            vMax: "999",
        });
        
        $("#btn_cancel_edit_funding").click(function(){
            window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/client_needs');?>';
        });

        $("#btn_save_edit_funding").click(function(){
            if($("#formFundings").valid()){
                $(".modal-edit-client-needs").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
            type: "post",
            url : $("#formFundings").attr("action"),
            data: $("#formFundings").serialize(),
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

    function add_funding_fields(){
        if(arrFundings.length == 0)
            var fundings = 0
        else {
            var fundings = arrFundings[arrFundings.length - 1] +1;
        }
        inner = '';
        var objTo = document.getElementById('funding_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row form_container funding_"+fundings);
        inner +=    '<div class="form-group col-xs-12">';
        inner +=    '   <div class="pull-left" onclick="remove_funding_fields('+fundings+')">';
        inner +=    '       <div class="div-action">';
        inner +=    '           <i class="material-icons no-after no-before">delete_sweep</i>';
        inner +=    '           <label class="label-action">Delete Funding</label>';
        inner +=    '       </div>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=    '    <div class="form-group">';
        inner +=    '        <label>Kebutuhan Pendanaan:</label>';
        inner +=    '        <input id="funding_need_'+fundings+'" name="funding_need_'+fundings+'" class="form-control" required />';
        inner +=    '    </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-2">';
        inner +=    '    <div class="form-group">';
        inner +=    '        <label>Jangka Waktu:</label>';
        inner +=    '        <input id="time_period_'+fundings+'" name="time_period_'+fundings+'" class="form-control period" style="text-align: right;" />';
        inner +=    '    </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-2">';
        inner +=    '    <div class="form-group">';
        inner +=    '        <label>Nominal:</label>';
        inner +=    '        <input id="amount_'+fundings+'" name="amount_'+fundings+'" class="form-control money" style="text-align: right;" />';
        inner +=    '    </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=    '    <div class="form-group">';
        inner +=    '        <label>Description:</label>';
        inner +=    '        <textarea id="description_'+fundings+'" name="description_'+fundings+'" class="form-control" rows="4"></textarea>';
        inner +=    '    </div>';
        inner +=    '</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);

        $(".money").autoNumeric("init",{
            mDec: "0",
            vMax: "999999999999999",
        });

        $(".period").autoNumeric("init",{
            mDec: "0",
            vMax: "999",
        });

        arrFundings.push(Number(fundings));
        $('#dataFundings').val(arrFundings);
        $('#totalFundings').val(arrFundings.length);
    }

    function remove_funding_fields(funding){
        $('.funding_'+funding).remove();        
        var index = arrFundings.indexOf(funding);
        if (index > -1) {
            arrFundings.splice(index, 1);
        }
        $('#dataFundings').val(arrFundings);
        $('#totalFundings').val(arrFundings.length);
    }
</script>