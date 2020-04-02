<style type="text/css">
    .index {
        width: 2px;
        text-align: center;
    }
    .actionrole {
        width: 18%;
        text-align: left;
    }
    thead{
        background-color:#337ab7;
        color: #FFF;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <!-- isi konten ditaro disini -->
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">User Management</li>
                            <li class="breadcrumb-item active" aria-current="page">Role</li>
                        </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left" style="margin-left: 5px;">Role</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="pull-right">
                            <button id="btnAddRole" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Add Role</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <table id="tableRole" data-toggle="table" data-pagination="true" class="table table-striped table-hover" width="100%">
                            <thead>
                                <tr class="headings">
                                    <th class="index" data-sortable="true">No</th>
                                    <th class="" width="20%" data-sortable="true" data-field="name">Role Name</th>
                                    <!--  <th class="" width="30%" >Signer Role</th> -->
                                    <th class="" width="20%" data-sortable="true">Segment</th>
                                    <th class="" width="40%" data-sortable="true">Description</th>
                                    <th class="" data-sortable="true">Status</th>
                                    <th class="actionrole" align="center" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $key_users) :
                                    switch($key_users->IsActive){
                                        case 1 : $IsActiveStatus = "Active"; break;
                                        case 0 : $IsActiveStatus = "Non Active"; break;
                                        default : $IsActiveStatus = ""; break;
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $key_users->Name; ?></td>
                                        <!-- <td><?php echo $key_users->SUBROLENAME; ?></td> -->
                                        <td><?php echo $key_users->SegmentName; ?></td>
                                        <td><?php echo $key_users->Description; ?></td>
                                        <td><?= $IsActiveStatus; ?></td>
                                        <td class="last" align="center" style="text-align: center;">
                                            <div
                                                class="div-action pull-left editRoleBtn" 
                                                data-id="<?php echo $key_users->RoleId; ?>" style="margin-right: 15px;">
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

    <div class="modal fade modal-add-role" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Role</h4>
                </div>
                <div class="modal-body">
                    <form id="formAddRole">
                        <div class="form-group">
                            <p>Role name:</p>
                            <input type="text" class="form-control textOnly" id="addRoleName" name="addRoleName">
                        </div>
                        <!-- 
                            <div class="form-group">
                                <label for="sel1">Choose Signer Role:</label>
                                <select class="form-control" id="subRole" name="subRole">
                                <?php
                                    $i = 1;
                                    foreach ($data_subrole as $key) :
                                ?>
                                    <option value="<?php echo $key->ID; ?>"><?php echo $key->SUBROLE_NAME; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        -->
                        <div class="form-group">
                            <p>Segment:</p>
                            <select class="form-control js-example-basic-single" id="addSegmentId" name="addSegmentId" style="width:100%;">
                                <?php
                                foreach ($data_segment as $row){
                                    echo '<option value="'.$row->SegmentId.'">'.$row->Name.'</option>';
                                }
                                ?>                                       
                            </select>
                        </div>
                        <div class="form-group">
                            <p>Status:</p>
                            <select class="form-control js-example-basic-single" id="addIsActive" name="addIsActive" style="width:100%;">
                                <?php
                                foreach ($IsActiveOption as $row){
                                    echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                }
                                ?>                                      
                            </select>
                        </div>
                        <div class="form-group">
                            <p>Description:</p>
                            <textarea class="form-control" rows="5" id="addDescription" name="addDescription"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                    <button id="btnSaveAddRole" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade modal-edit-role" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Role</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditRole">
                        <input type="hidden" id="editRoleId" name="editRoleId" value="">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Name:</p>
                                <input type="text" id="editRoleName" name="editRoleName" class="form-control textOnly">
                            </div>
                        </div>
                        <!--  
                            <div class="form-group">
                                <label for="editSubRole">Choose Signer Role:</label>
                                <select class="form-control" id="editSubRole" name="editSubRole">
                                <?php foreach ($data_subrole as $ds) : ?>
                                    <option value="<?php echo $ds->ID; ?>" 
                                    <?php
                                        if ($ds->ID == $key_users->SUBROLE_ID) {
                                        echo 'selected';
                                    }
                                    ?>>
                                <?php echo $ds->SUBROLE_NAME; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        -->
                        <div class="form-group">
                            <label for="segment">Segment:</label>
                            <select class="form-control js-example-basic-single" id="editSegmentId" name="editSegmentId" style="width:100%;">
                                <?php
                                foreach ($data_segment as $row){
                                    echo '<option value="'.$row->SegmentId.'">'.$row->Name.'</option>';
                                }
                                ?>                                       
                            </select>
                        </div>
                        <div class="form-group">
                            <p>Status:</p>
                            <select class="form-control js-example-basic-single" id="editIsActive" name="editIsActive" style="width:100%;">
                                <?php
                                foreach ($IsActiveOption as $row){
                                    echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                }
                                ?>                                      
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description:</label>
                            <textarea class="form-control" rows="5" id="editDescription"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                    <button id="btnUpdateRole" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE -->
<?php foreach ($data as $key_role) : ?>
        <div id="delModal_<?php echo $key_role->RoleId; ?>" class="modal fade deleteModal" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h4 class="modal-title" >Delete <small style="color: #FFF;">Role</small></h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure to delete this data? </p>
                        <input type="hidden" id="currentUser" name="currentUser" value="<?php echo $_SESSION['PERSONAL_NUMBER']; ?>">
                        <input type="hidden" id="delUserId" name="delUserId">
                    </div>
                    <div class="modal-footer">
                        <button id="yesBtn" type="button" class="btn btn-primary saveBtn" data-dismiss="modal">Yes</button>				
                        <button id="noBtn" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach; ?>


</div>


<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>

<script type="text/javascript">
    function getRoleInformation(roleId){
        $(".loaderImage").show();
        $.getJSON("<?= base_url("admin/user_management/serviceGetRoleInformation/");?>"+roleId, function (data){
            $("#editRoleName").val(data["Name"]);
            $("#editSegmentId").val(data["SegmentId"]).trigger('change');
            $('#editIsActive').val(data["IsActive"]).trigger('change');
            $('#editDescription').val(data["Description"]);
            $(".loaderImage").hide();
        });
    }

    function clearModal(modalType){
        $("#"+modalType+"RoleName").removeClass( "error" );
        $("#"+modalType+"RoleName-error").css("display","none");

        $("#"+modalType+"RoleName").val("");
        $("#"+modalType+"SegmentId").val(<?= $data_segment[0]->SegmentId ; ?>).trigger("change");
        $("#"+modalType+"IsActiveId").val(<?= $IsActiveOption[0]["IsActiveId"]; ?>).trigger("change");
        $("#"+modalType+"Description").val("");
    }

    $(document).ready(function(){
        $(".js-example-basic-single").select2();

        $.validator.addMethod("required", function(value, element) {
            if(value.trim() == ""){
                return false;
            }else return true;
        });

        /* Add New Role */
        $("#btnAddRole").click(function(){
            clearModal("add");
            $(".modal-add-role").modal("show");
        });

        $('#formAddRole').validate({
            rules: {
                addRoleName: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/user_management/serviceCheckRoleName"); ?>",
                        type: "POST",
                        data: {
                            roleName: function() {
                                return $("#addRoleName").val();
                            },
                            roleId: null
                        }
                    }
                }
            },
            messages: {
                addRoleName: {
                    required: "Please fill role name...",
                    remote: "Role name already taken"
                }
            }
        });

        $('#btnSaveAddRole').on('click', function (event) {
            if($("#formAddRole").valid()){
                var name = $('#addRoleName').val();
                //var subRoleType = $('#subRole').find(":selected").val();
                var segmentId = $("#addSegmentId").val();
                var isActive = $("#addIsActive").val();
                var description = $('#addDescription').val();

                var newData = {
                    'name': name,
                    //'subRoleType': subRoleType,
                    "segmentId": segmentId,
                    'isActive': isActive,
                    'description': description
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'addNewRole',
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

        /* Update Role */
        $("#tableRole tbody").on("click", ".editRoleBtn", function () {
            clearModal("edit");
            var selectedRoleId = $(this).data("id");
            $('#editRoleId').val(selectedRoleId);

            getRoleInformation(selectedRoleId);
            $(".modal-edit-role").modal("show");
        });

        $('#formEditRole').validate({
            rules: {
                editRoleName: {
                    required: true,
                    remote: {
                        url: "<?= base_url("admin/user_management/serviceCheckRoleName"); ?>",
                        type: "POST",
                        data: {
                            roleName: function() {
                                return $("#editRoleName").val();
                            },
                            roleId: function() {
                                return $("#editRoleId").val();
                            }
                        }
                    }
                }
            },
            messages: {
                editRoleName: {
                    required: "Please fill role name...",
                    remote: "Role name already taken"
                }
            }
        });

        $('#btnUpdateRole').on('click', function (event) {
            if($("#formEditRole").valid()){
                var roleId = $('#editRoleId').val();
                var roleName = $("#editRoleName").val();
                var segmentId = $("#editSegmentId").val();
                var isActive = $("#editIsActive").val();
                var description = $("#editDescription").val();

                var editedData = {
                    'editRoleId': roleId,
                    'name': roleName,
                    'segmentId': segmentId,
                    'isActive': isActive,
                    'description': description
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'updateDataRole',
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

        $(document).on('click', '.btnDel', function (event) {
            var row = $(this).closest('tr');
            var nrow = row[0];

            $('#delUserId').val($(this).data('id'));

            var modal = $($(this).data('target'))[0];
            modalId = '#' + modal.id;
            $(document).on('shown.bs.modal', modalId, function (e) {
                $(modalId + ' ' + '#yesBtn').on('click', function () {
                    var userId = $('#delUserId').val();
                    var userId2 = $('#currentUser').val();
                    var data = {
                        'userId': userId,
                        'userId2': userId2
                    };
                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'deleteRoleData',
                        data: data,
                        success: function (response) {
                            if (response == 1) {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The Role you selected has been successfully deleted',
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
                });
            });
        });
        $('.textOnly').on('keydown', function (e) {
            -1 !== $.inArray(e.keyCode, [32, 46, 8, 9, 27, 13, 110, ]) || (/65|67|86|88/.test(e.keyCode) && (e.ctrlKey === true || e.metaKey === true)) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (65 > e.keyCode || 90 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    });

</script>