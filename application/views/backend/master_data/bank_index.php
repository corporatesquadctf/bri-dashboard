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
                            <li class="breadcrumb-item active" aria-current="page">Banks</li>
                        </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left" style="margin-left: 5px;">Banks</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="pull-right">
                            <button id="btnAddBank" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Add Bank</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <table id="tableBank" data-toggle="table" data-pagination="true" data-search="true"
                                data-page-size="10"
                                data-page-list="[10, 50, ALL]"
                                data-toolbar="#toolbar"
                                data-click-to-select="true"
                                data-show-export="true"
                                data-export-options='{
                                "fileName": "MasterBank",
                                "ignoreColumn": [7]

                                }'
                                class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="cntrl" data-sortable="true">No</th>
                                    <th class="lft" data-sortable="true">Bank Name</th>
                                    <th class="cntrl" data-sortable="true">Status</th>
                                    <th class="cntrl" data-sortable="true">Created On</th>
                                    <th class="cntrl">Created By</th>
                                    <th class="cntrl" data-sortable="true">Last Modified</th>
                                    <th class="cntrl">Modified By</th>
                                    <th class="cntrl">Action</th>
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
                                        <td>
                                            <?php
                                            if ($k->IsActive == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Not Active";
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
                                        <td>
                                            <div
                                                class="div-action pull-left editBtn" 
                                                data-id="<?php echo $k->BankId; ?>"
                                                data-name="<?= $k->Name; ?>"
                                                data-status="<?= $k->IsActive; ?>">
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
        </div>
    </div>
</div>

<!-- MODAL ADD -->
<div class="modal fade modal-add-bank" role="dialog">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bank Registration</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="addBankForm">
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Bank Name:</p>
                            <input type="text" id="addBankName" name="addBankName" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-12">
                        <p>Status:</p>
                            <select class="form-control js-example-basic-single" id="addIsActiveId" name="addIsActiveId" style="width:100%;">
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
                <button id="btnSaveAddBank" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
            </div>
        </div>    
    </div>
</div>

<!-- MODAL UPDATE -->
<div class="modal fade modal-edit-bank" role="dialog" >
    <div class="modal-dialog">
        <!-- MODAL CONTENT -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Bank</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left" id="editBankForm">
                    <input type="hidden" id="editBankId" name="editBankId" value="">
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Bank Name:</p>
                            <input type="text" id="editBankName" name="editBankName" class="form-control">
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
                <div class="pull-right">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                    <button id="btnUpdateBank" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>                               
<script type="text/javascript">
    function clearModal(modalType){
        $("#"+modalType+"BankName").val("");
        $("#"+modalType+"IsActiveId").val(<?= $IsActiveOption[0]["IsActiveId"]; ?>).trigger("change");

        $("#"+modalType+"BankName").removeClass( "error" );
        $("#"+modalType+"BankName-error").css("display","none");
    }

    $(document).ready(function() {
        $(".js-example-basic-single").select2();

        $.validator.addMethod("required", function(value, element) {
            if(value.trim() == ""){
                return false;
            }else return true;
        });

        /* Add New Bank */
        $("#btnAddBank").click(function(){
            clearModal("add");
            $(".modal-add-bank").modal("show");
        });

        $("#addBankForm").validate({
            ignore: [],
            rules: {
                addBankName: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/banks/serviceCheckBankName"); ?>",
                        type: "POST",
                        data: {
                            bankName: function() {
                                return $("#addBankName").val();
                            },
                            bankId: null
                        }
                    }
                }
            },
            messages:{
                addBankName: {
                    required: "Please fill bank name...",
                    remote: "Bank name already taken"
                }
            }
        });

        $("#btnSaveAddBank").on("click", function (event) {
            if($("#addBankForm").valid()){
                var bankName = $("#addBankName").val();
                var isActiveId = $("#addIsActiveId").val();

                var newData = {
                    "bankName" : bankName,
                    "isActive" : isActiveId
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'banks/insertNew',
                    data: newData,
                    dataType : "json",
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

        /* Update Bank */
        $("#tableBank tbody").on("click", ".editBtn", function () {
            clearModal("edit");
            var selectedBankId = $(this).data("id");
            var selectedName = $(this).data("name");
            var selectedIsActive = $(this).data("status");

            $('#editBankId').val(selectedBankId);
            $('#editBankName').val(selectedName);
            $("#editIsActive").val(selectedIsActive).trigger("change");

            $(".modal-edit-bank").modal("show");
        });

        $("#editBankForm").validate({
            ignore: [],
            rules: {
                editBankName: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/banks/serviceCheckBankName"); ?>",
                        type: "POST",
                        data: {
                            bankName: function() {
                                return $("#editBankName").val();
                            },
                            bankId: function() {
                                return $("#editBankId").val();
                            }
                        }
                    }
                }
            },
            messages:{
                editBankName: {
                    required: "Please fill bank name...",
                    remote: "Bank name already taken"
                }
            }
        });

        $("#btnUpdateBank").on("click", function (event) {
            if($("#editBankForm").valid()){
                var bankId = $('#editBankId').val();
                var bankName = $("#editBankName").val();
                var isActiveId = $("#editIsActive").val();

                var newData = {
                    "bankId" : bankId,
                    "bankName" : bankName,
                    "isActive" : isActiveId
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'banks/updateData',
                    data: newData,
                    dataType : "json",
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