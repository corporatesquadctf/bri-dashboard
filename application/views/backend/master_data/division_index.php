<style type="text/css">
    .cntrl {
        text-align: center;
    }

    .lft {
        text-align: left;
    }
    .fixed-table-container{
        border-top: none;
    }
    .dataTables_info , .dataTables_paginate{display: none;}
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }

    thead{
        background-color:#337ab7;
        color: #FFF;
    }
</style>

<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Divisions</li>
                        </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left" style="margin-left: 5px;">Divisions</div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="pull-right">
                            <button id="btnAddDivision" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Add Division</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="toolbar">
                            <select class="form-control" >
                                <option value="all">Export All</option>
                                <option value="">Export Basic</option>
                                <option value="selected">Export Selected</option>
                            </select>
                            <button onClick ="$('#data2').tableExport({type: 'excel', escape: 'false', fileName: 'Division', exportDataType: 'all'});"> Download Excel </button>
                        </div>
                        <table id="data2" data-click-to-select="true" 
                                data-show-export="true" 
                                data-search="true" data-toggle="table" 
                                data-toolbar="#toolbar"
                                data-page-list="[5,8,10]"
                                data-export-options='{
                                "fileName": "MasterDivision",
                                "ignoreColumn": [9]
                                }'
                                data-pagination="true" class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="cntrl" data-sortable="true">No</th>
                                    <th class="lft" data-sortable="true">Division Name</th>
                                    <th class="lft" data-sortable="true">Segment</th>
                                    <th class="lft" data-sortable="true">Division Type</th>
                                    <th class="cntrl" data-sortable="true">Status</th>
                                    <th class="cntrl" data-sortable="true">Created On</th>
                                    <th class="cntrl">Created By</th>
                                    <th class="cntrl" data-sortable="true">Last Modified</th>
                                    <th class="cntrl">Modified By</th>
                                    <th class="cntrl no-print">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $k) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $k->Name; ?></td>
                                        <td class="cntrl"><?php echo $k->Segment; ?></td>
                                        <td class="cntrl"><?php
                                            if ($k->UnitKerjaTypeId == 1) {
                                                echo "Business";
                                            } else if ($k->UnitKerjaTypeId == 2) {
                                                echo "Product Owner";
                                            } else {
                                                echo "-";
                                            }
                                            ?></td>
                                        <td class="cntrl">
                                            <?php
                                            if ($k->IsActive == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Non Active";
                                            };
                                            ?>
                                        </td>
                                        <td class="lft"><?php
                                            $addon = new DateTime($k->CreatedDate);
                                            echo $addon->format('d/m/Y H:i:s');
                                            ?></td>
                                        <td class="lft"><?php echo $k->MAKER; ?></td>
                                        <td class="cntrl"><?php
                                            $modion = $k->ModifiedDate;
                                            if ($modion) {
                                                $modifiedOn = new DateTime($modion);
                                                echo $modifiedOn->format('d/m/Y H:i:s');
                                            } else {
                                                echo '-';
                                            }
                                            ?></td>
                                        <td class="cntrl"><?php echo ($k->MODIFIER) ? $k->MODIFIER : '-'; ?></td>
                                        <td class="no-print">
                                            <div
                                                class="div-action pull-left editBtn" 
                                                data-id="<?php echo $k->UnitKerjaId; ?>"
                                                data-name="<?= $k->Name; ?>" 
                                                data-segment="<?= $k->SegmentId; ?>"
                                                data-type="<?= $k->UnitKerjaTypeId; ?>"
                                                data-status="<?= $k->IsActive; ?>" style="margin-right: 15px;">
                                                <i class="material-icons">edit</i>
                                                <label>Edit</label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <div>
    </div>
</div>

<div class="modal fade modal-add-division" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Divisions</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="addDivisionForm">
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Division Id</p>
                            <input type="number" name="addDivisionId" id="addDivisionId" class="form-control" minlength="2">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Division Name</p>
                            <input type="text" name="addDivisionName" id="addDivisionName" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Segment</p>
                            <select id="addSegmentId" name="addSegmentId" class="form-control js-example-basic-single" style="width: 100%;">
                                <?php
                                    foreach ($data_segment as $row){
                                        echo '<option value="'.$row->SegmentId.'">'.$row->Name.'</option>';
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>  
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Division Type</p>                        
                            <select id="addDivisionType" name="addDivisionType" class="form-control js-example-basic-single" style="width: 100%;">
                                <?php
                                    foreach ($DivisionType as $row){
                                        echo '<option value="'.$row->UnitKerjaTypeId.'">'.$row->Name.'</option>';
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Status:</p>
                            <select class="form-control js-example-basic-single" id="addIsActive" name="addIsActive" style="width:100%;">
                                <?php
                                foreach ($IsActiveOption as $row){
                                    echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                }
                                ?>                                      
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                <button id="btnSaveAddDivision" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
            </div>
        </div>

    </div>
</div>

<!-- MODAL UPDATE -->
<div class="modal fade modal-edit-division" role="dialog" >
    <div class="modal-dialog">
        <!-- MODAL CONTENT -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Division</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="editDivisionForm">
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Division Id</p>
                            <input type="number" name="editDivisionId" id="editDivisionId" class="form-control" minlength="2" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Division Name</p>
                            <input type="text" name="editDivisionName" id="editDivisionName" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Segment:</p>
                            <select class="form-control js-example-basic-single" id="editSegmentId" name="editSegmentId" style="width:100%;">
                                <?php
                                foreach ($data_segment as $row){
                                    echo '<option value="'.$row->SegmentId.'">'.$row->Name.'</option>';
                                }
                                ?>                                       
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Division Type</p>                        
                            <select id="editDivisionType" name="editDivisionType" class="form-control js-example-basic-single" style="width: 100%;">
                                <?php
                                    foreach ($DivisionType as $row){
                                        echo '<option value="'.$row->UnitKerjaTypeId.'">'.$row->Name.'</option>';
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Status:</p>
                            <select class="form-control js-example-basic-single" id="editIsActive" name="editIsActive" style="width:100%;">
                                <?php
                                foreach ($IsActiveOption as $row){
                                    echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                }
                                ?>                                      
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                <button id="btnUpdateDivision" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DELETE -->
<?php foreach ($data as $k) : ?>
    <div id="delModal_<?php echo $k->UnitKerjaId; ?>" class="modal fade deleteModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" >Delete Division</small></h4>
                </div>
                <div class="modal-body">
                    <p> Are you sure to delete this data? </p>
                    <input type="hidden" id="curUser" name="curUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                    <input type="hidden" id="delDivId" name="delDivId">
                </div>
                <div class="modal-footer">
                    <button id="yesBtn" type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<script type="text/javascript">
    $('#divForm').validate({
        debug: true,
        rules: {
            divisionName: {
                required: true
            },
            divisionType: {
                required: true
            }
        },
        messages: {
            divisionName: {
                required: "Please enter division name..."
            },
            divisionType: {
                required: "Please select division type..."
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "divisions/insertNew",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == 1) {
                        new PNotify({
                            title: 'Success!',
                            text: 'New Division has been saved successfuly.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });

                        PNotify.prototype.options.delay = 1200;

                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                }
            });
        }
    });

    function clearModal(modalType){
        $("#"+modalType+"DivisionId").val("");
        $("#"+modalType+"DivisionName").val("");
        $("#"+modalType+"SegmentId").val(<?= $data_segment[0]->SegmentId ; ?>).trigger("change");
        $("#"+modalType+"DivisionType").val(<?= $DivisionType[0]->UnitKerjaTypeId ; ?>).trigger("change");
        $("#"+modalType+"IsActive").val(<?= $IsActiveOption[0]["IsActiveId"]; ?>).trigger("change");

        $("#"+modalType+"DivisionId").removeClass( "error" );
        $("#"+modalType+"DivisionId-error").css("display","none");

        $("#"+modalType+"DivisionName").removeClass( "error" );
        $("#"+modalType+"DivisionName-error").css("display","none");
    }

    $(document).ready(function(){        
        $(".js-example-basic-single").select2();

        $('#pageTables').dataTable();

        $('#toolbar').find('select').on('change', function (e) {
            $('#data2').bootstrapTable('destroy').bootstrapTable({
                exportDataType: $(this).val()
            });
        });

        $.validator.addMethod("required", function(value, element) {
            if(value.trim() == ""){
                return false;
            }else return true;
        });

        /* Add New Division */
        $("#btnAddDivision").click(function(){
            clearModal("add");
            $(".modal-add-division").modal("show");
        });

        $('#addDivisionForm').validate({
            rules: {
                addDivisionId: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/divisions/serviceCheckDivisionId"); ?>",
                        type: "POST",
                        data: {
                            divisionId: function() {
                                return $("#addDivisionId").val();
                            },
                        }
                    }
                },
                addDivisionName: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/divisions/serviceCheckDivisionName"); ?>",
                        type: "POST",
                        data: {
                            divisionName: function() {
                                return $("#addDivisionName").val();
                            },
                            divisionId: null
                        }
                    }
                }
            },
            messages: {
                addDivisionId: {
                    required: "Please fill division id...",
                    remote: "Division id already taken"
                },
                addDivisionName: {
                    required: "Please fill division name",
                    remote: "Division name already taken"
                }
            }
        });

        $('#btnSaveAddDivision').on('click', function (event) {
            if($("#addDivisionForm").valid()){
                var divisionId = $('#addDivisionId').val();
                var divisionName = $("#addDivisionName").val();
                var segmentId = $("#addSegmentId").val();
                var divisionTypeId = $("#addDivisionType").val();
                var isActive = $("#addIsActive").val();

                var newData = {
                    'unitKerjaId': divisionId,
                    'name': divisionName,
                    'segmentId': segmentId,
                    'unitKerjaTypeId': divisionTypeId,
                    'isActive': isActive
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("admin/divisions/insertNew"); ?>',
                    data: newData,
                    dataType: "json",
                    success: function (response) {
                        if(response.status === "success"){
                            new PNotify({
                                title: "Success!",
                                text: response["message"],
                                type: "success",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function(){ 
                                location.reload();
                            }, 1500);
                        }else if(response.status === "error"){
                            new PNotify({
                                title: "Error!",
                                text: response["message"],
                                type: "error",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                        }
                    }
                });
            }
        });

        /* Update Division */
        $("#data2 tbody").on("click", ".editBtn", function () {
            clearModal("edit");
            var selectedUnitKerjaId =  $(this).data("id");
            var selectedName = $(this).data("name");
            var selectedSegment = $(this).data("segment");
            var selectedUnitKerjaTypeId = $(this).data("type");
            var selectedIsActive = $(this).data("status");

            $('#editDivisionId').val(selectedUnitKerjaId);
            $('#editDivisionName').val(selectedName);
            $('#editSegmentId').val(selectedSegment).trigger("change");
            $('#editDivisionType').val(selectedUnitKerjaTypeId).trigger("change");
            $("#editIsActive").val(selectedIsActive).trigger("change");
            
            $(".modal-edit-division").modal("show");
        });

        $('#editDivisionForm').validate({
            rules: {
                editDivisionName: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/divisions/serviceCheckDivisionName"); ?>",
                        type: "POST",
                        data: {
                            divisionName: function() {
                                return $("#editDivisionName").val();
                            },
                            divisionId: function() {
                                return $("#editDivisionId").val();
                            }
                        }
                    }
                }
            },
            messages: {
                editDivisionName: {
                    required: "Please fill division name...",
                    remote: "Division name already taken"
                }
            }
        });

        $('#btnUpdateDivision').on('click', function (event) {
            if($("#editDivisionForm").valid()){
                var divisionId = $('#editDivisionId').val();
                var divisionName = $("#editDivisionName").val();
                var segmentId = $("#editSegmentId").val();
                var divisionTypeId = $("#editDivisionType").val();
                var isActive = $("#editIsActive").val();

                var editedData = {
                    'unitKerjaId': divisionId,
                    'name': divisionName,
                    'segmentId': segmentId,
                    'unitKerjaTypeId': divisionTypeId,
                    'isActive': isActive
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("admin/divisions/updateData"); ?>',
                    data: editedData,
                    dataType: "json",
                    success: function (response) {
                        if(response.status === "success"){
                            new PNotify({
                                title: "Success!",
                                text: response["message"],
                                type: "success",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function(){ 
                                location.reload();
                            }, 1500);
                        }else if(response.status === "error"){
                            new PNotify({
                                title: "Error!",
                                text: response["message"],
                                type: "error",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                        }
                    }
                });
            }
        });
    });
</script>