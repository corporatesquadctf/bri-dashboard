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
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/action_plans');?>">Action Plans</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Initiative & Action Plan</li>
                    </ol>
                    </nav>
                    <div class="page_title" style="padding: 1px 5px 6px;">
                        <div class="pull-left">Initiative & Action Plan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formInitiativesAction" method="post" action="<?= base_url().'tasklist/account_planning_menengah/manage_account_planning/process_input_initiatives_action'; ?>">
                            <input type="hidden" id="totalInitiativesAction" name="totalInitiativesAction" value="<?= count($InitiativesAction); ?>" />
                            <input type="hidden" id="dataInitiativesAction" name="dataInitiativesAction" value="" />
                            <input type="hidden" id="apMenengahId" name="apMenengahId" value="<?= $apMenengahId; ?>" />
                            <div id="initiatives_action_fields">
                                <?php
                                    if (!empty($InitiativesAction)) {
                                        $i=0;
                                        foreach ($InitiativesAction as $row) :
                                ?>
                                            <div class="row form_container initiatives_action_<?= $i; ?>">
                                                <div class="form-group col-xs-12">
                                                    <div class="pull-left" onclick="remove_intiatives_action_fields(<?= $i; ?>);">
                                                        <div class="div-action">
                                                            <i class="material-icons no-after no-before">delete_sweep</i>
                                                            <label class="label-action">Delete Initiative Action</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group">
                                                        <label>Initiative:</label>
                                                        <input id="name_<?= $i; ?>" name="name_<?= $i; ?>" class="form-control" value="<?= $row->Name; ?>" maxlength="100" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group">
                                                        <label>Action Plan:</label>
                                                        <div class="input-group date InitiativeActionYMpicker" style="margin-bottom: 0">
                                                            <input type="text" name="period_<?= $i; ?>" id="period_<?= $i; ?>" class="action_plan form-control col-md-3 col-xs-12" value="<?= $row->Period; ?>" readonly style="background-color: #FFF;">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                        </div>
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
                                    <div class="row form_container initiatives_action_0">
                                        <div class="form-group col-xs-12">
                                            <div class="pull-left" onclick="remove_intiatives_action_fields(0);">
                                                <div class="div-action">
                                                    <i class="material-icons no-after no-before">delete_sweep</i>
                                                    <label class="label-action">Delete Initiative Action</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Initiative:</label>
                                                <input id="name_0" name="name_0" class="form-control" maxlength="100" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Action Plan:</label>
                                                <div class="input-group date InitiativeActionYMpicker" style="margin-bottom: 0">
                                                    <input type="text" name="period_0" id="period_0" class="action_plan form-control col-md-3 col-xs-12" value="" readonly style="background-color: #FFF;">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
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
                                        <button id="btn_cancel_edit_initiatives_action" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                        <button id="btn_cancel_add_initiatives_action" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_initiatives_action_fields();">ADD INITITIVE ACTION</button>
                                        <button id="btn_save_edit_initiatives_action" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-estimated-financial" tabindex="-1" role="dialog" aria-hidden="true">
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
    var totalInitiativesAction = <?= count($InitiativesAction); ?>;
    if(totalInitiativesAction == 0){
        var arrInitiativesAction = [0];
    }else{
        var arrInitiativesAction = [];
        for(var i=0; i<totalInitiativesAction; i++){
            arrInitiativesAction.push(Number(i));
        }
    }
    $("#dataInitiativesAction").val(arrInitiativesAction);
    $("#totalInitiativesAction").val(arrInitiativesAction.length);

    $(document).ready(function() {
        var today = "<?= date("Y-m"); ?>";
        
        $('.InitiativeActionYMpicker').datetimepicker({
            defaultDate: today,
            useCurrent: false,
            minDate: today,
            format: 'YYYY-MM',
            viewMode: 'years',
            ignoreReadonly: true
        });
        
        $("#btn_cancel_edit_initiatives_action").click(function(){
            window.location.href= '<?=base_url('tasklist/account_planning_menengah/manage_account_planning/input/'.$apMenengahId.'/action_plans/initiatives_action');?>';
        });

        $("#btn_save_edit_initiatives_action").click(function(){
            if($("#formInitiativesAction").valid()){
                $(".modal-edit-estimated-financial").modal("show");
            }
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
            type: "post",
            url : $("#formInitiativesAction").attr("action"),
            data: $("#formInitiativesAction").serialize(),
            dataType : "json",
            beforeSend:function(){
                $(".modal-edit-estimated-financial").modal("hide");
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
                        window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input/".$apMenengahId."/".$AccountPlanningTab."/".$FacilitiesBankingGroupType); ?>";
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

    function add_initiatives_action_fields(){
        if(arrInitiativesAction.length == 0)
            var initiatives_action = 0
        else {
            var initiatives_action = arrInitiativesAction[arrInitiativesAction.length - 1] +1;
        }
        
        inner = '';
        var objTo = document.getElementById('initiatives_action_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row form_container initiatives_action_"+initiatives_action);
        inner +=    '<div class="form-group col-xs-12">';
        inner +=    '   <div class="pull-left" onclick="remove_intiatives_action_fields('+initiatives_action+')">';
        inner +=    '       <div class="div-action">';
        inner +=    '           <i class="material-icons no-after no-before">delete_sweep</i>';
        inner +=    '           <label class="label-action">Delete Initiative Action</label>';
        inner +=    '       </div>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=    '   <div class="form-group">';
        inner +=    '       <label>Initiative:</label>';
        inner +=    '       <input id="name_'+initiatives_action+'" name="name_'+initiatives_action+'" class="form-control" required />';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=    '   <div class="form-group">';
        inner +=    '       <label>Action Plan:</label>';
        inner +=    '       <div class="input-group date InitiativeActionYMpicker">';
        inner +=    '           <input type="text" name="period_'+initiatives_action+'" id="period_'+initiatives_action+'" class="form-control col-md-3 col-xs-12" value="" readonly style="background-color: #FFF;">';
        inner +=    '           <span class="input-group-addon">';
        inner +=    '               <span class="glyphicon glyphicon-calendar"></span>';
        inner +=    '           </span>';
        inner +=    '       </div>';
        inner +=    '   </div>';
        inner +=    '</div>';
        inner +=    '<div class="col-xs-12 col-sm-4">';
        inner +=    '   <div class="form-group">';
        inner +=    '       <label>Description:</label>';
        inner +=    '       <textarea id="description_'+initiatives_action+'" name="description_'+initiatives_action+'" class="form-control" rows="4"></textarea>';
        inner +=    '   </div>';
        inner +=    '</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);

        var today = "<?= date("Y-m"); ?>";
        $('.InitiativeActionYMpicker').datetimepicker({
            defaultDate: today,
            useCurrent: false,
            minDate: today,
            format: 'YYYY-MM',
            viewMode: 'years',
            ignoreReadonly: true
        });

        arrInitiativesAction.push(Number(initiatives_action));
        $('#dataInitiativesAction').val(arrInitiativesAction);
        $('#totalInitiativesAction').val(arrInitiativesAction.length);
    }

    function remove_intiatives_action_fields(initiatives_action){
        $('.initiatives_action_'+initiatives_action).remove();        
        var index = arrInitiativesAction.indexOf(initiatives_action);
        if (index > -1) {
            arrInitiativesAction.splice(index, 1);
        }
        $('#dataInitiativesAction').val(arrInitiativesAction);
        $('#totalInitiativesAction').val(arrInitiativesAction.length);
    }
</script>