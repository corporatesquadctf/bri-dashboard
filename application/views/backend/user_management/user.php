<style type="text/css">
    .form-control{
        color: #73879C;
    }
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    thead{
        background-color:#337ab7;
        color: #FFF;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">User Management</li>
                            <li class="breadcrumb-item active" aria-current="page">User</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Master Data User</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="padding:1px 0px;">
                        <ul class="nav navbar-right panel_toolbox" style="min-width:0px;">
                            <li>
                                <button id="btnAddUser" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Add User</button>
                            </li>
                            <li>
                                <a class="collapse-link btn w150 btn-sm btn-default" style="margin-bottom:0px;"><label class="search-form">Hide Filter</label></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <form id="filterUserForm" method="POST" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="roleId">Role</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="roleId" name="roleId" style="width:100%;">
                                    <option value="all">All Role</option>
                                    <?php
                                    foreach ($RoleOption as $row){
                                        $selected = "";
                                        if($row->RoleId == $RoleId) $selected = "selected";
                                        echo '<option value="'.$row->RoleId.'" '.$selected.'>'.$row->RoleName.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php if($RegionalId != 2) { ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unitKerjaId">Unit Kerja</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="unitKerjaId" name="unitKerjaId" style="width:100%;">
                                    <option value="all">All Unit Kerja</option>
                                    <?php
                                    foreach ($UnitKerjaOption as $row){
                                        $selected = "";
                                        if($row->UnitKerjaId == $UnitKerjaId) $selected = "selected";
                                        echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->UnitKerjaName.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isActiveId">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="isActiveId" name="isActiveId" style="width:100%;">
                                    <option value="all">All Status</option>
                                    <?php
                                    foreach ($IsActiveOption as $row){
                                        $selected = "";
                                        if($row["IsActiveId"] == $IsActiveId) $selected = "selected";
                                        echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Keyword</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="keyword" name="keyword" class="form-control col-md-7 col-xs-12" value="<?= $Keyword; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
                                <button id="btnFilterUser" class="btn w150 btn-sm btn-primary pull-left" style="margin-right:0px;" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="tableUser" data-click-to-select="true" 
                            data-toggle="table" 
                            data-toolbar="#toolbar"
                            data-page-list="[10,25,100, 1000]"
                            data-pagination="true" class="table table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="cntrl" data-sortable="true" style="width:5%;">No.</th>
                                    <th class="cntrl" data-sortable="true" style="width:15%;">Personal Number</th>
                                    <th class="cntrl" data-sortable="true" style="width:20%;">Name</th>
                                    <th class="cntrl" data-sortable="true" style="width:15%;">Role</th>
                                    <th class="cntrl" data-sortable="true" style="width:25%;">Unit Kerja</th>
                                    <th class="cntrl" data-sortable="true" style="width:10%;">Status</th>
                                    <th class="cntrl" data-sortable="true" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                foreach($User as $row){
                                    switch($row->IsActive){
                                        case 1 : $IsActiveStatus = "Active"; break;
                                        case 0 : $IsActiveStatus = "Non Active"; break;
                                        default : $IsActiveStatus = ""; break;
                                    }                                      
                            ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $row->UserId; ?></td>
                                        <td><?= $row->Name; ?></td>
                                        <td><?= $row->RoleName; ?></td>
                                        <td><?= $row->UnitKerjaName; ?></td>
                                        <td><?= $IsActiveStatus; ?></td>
                                        <td>
                                            <div class="div-action pull-left btnEditUser" data-id="<?= $row->UserId; ?>" data-name="<?= $row->Name;?>" data-unitkerja="<?= $row->UnitKerjaId; ?>" data-role="<?= $row->RoleId; ?>" data-isactive="<?= $row->IsActive; ?>">
                                                <i class="material-icons">edit</i>
                                                <label>Edit</label>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <div class="modal fade modal-add-user" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">User Registration</h4>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Input Personal Number:</p>
                                <input type="text" id="addUserId" name="addUserId" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Name:</p>
                                <input type="text" id="addUserName" name="addUserName" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Unit Kerja:</p>
                                <select class="form-control js-example-basic-single" id="addUnitKerjaId" name="addUnitKerjaId" style="width:100%;" disabled>
                                    <option value="0">Pilih Unit Kerja</option>
                                    <?php
                                    foreach ($UnitKerjaOption as $row){
                                        echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->UnitKerjaName.'</option>';
                                    }
                                    ?>                                       
                                </select>
                                <input type="hidden" id="addHiddenUnitKerjaId" name="addHiddenUnitKerjaId" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Role:</p>
                                <select class="form-control js-example-basic-single" id="addRoleId" name="addRoleId" style="width:100%;">
                                    <?php
                                    foreach ($RoleOption as $row){
                                        echo '<option value="'.$row->RoleId.'" '.$selected.'>'.$row->RoleName.'</option>';
                                    }
                                    ?>                                       
                                </select>
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
                    <button id="btnSaveAddUser" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edit-user" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit User Information</h4>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Input Personal Number:</p>
                                <input type="text" id="editUserId" name="editUserId" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Name:</p>
                                <input type="text" id="editUserName" name="editUserName" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Unit Kerja:</p>
                                <select class="form-control js-example-basic-single" id="editUnitKerjaId" name="editUnitKerjaId" style="width:100%;" disabled>
                                    <option value="0">Pilih Unit Kerja</option>
                                    <?php
                                    foreach ($UnitKerjaOption as $row){
                                        echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->UnitKerjaName.'</option>';
                                    }
                                    ?>                                       
                                </select>
                                <input type="hidden" id="editHiddenUnitKerjaId" name="editHiddenUnitKerjaId" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <p>Role:</p>
                                <select class="form-control js-example-basic-single" id="editRoleId" name="editRoleId" style="width:100%;">
                                    <?php
                                    foreach ($RoleOption as $row){
                                        echo '<option value="'.$row->RoleId.'" '.$selected.'>'.$row->RoleName.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                            <p>Status:</p>
                                <select class="form-control js-example-basic-single" id="editIsActiveId" name="editIsActiveId" style="width:100%;">
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
                    <button id="btnSyncUser" type="button" class="btn w150 btn-primary modal-button-ok">Maintain</button>
                    <button id="btnSaveEditUser" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    var hide = 0;
    var arrUnitKerja = [];

    function setArrayUnitKerja(){
        <?php
            foreach($UnitKerjaOption as $row):
        ?>
                arrUnitKerja.push(<?= $row->UnitKerjaId; ?>);
        <?php
            endforeach;
        ?>
    }

    function getUserInformation(userId, modal){
        $(".loaderImage").show();
        $.getJSON("<?= base_url();?>"+'logins/add_user_brisim/'+userId, function (data){
            $("#"+modal+"UserName").val(data.nama);
            $("#"+modal+"UnitKerjaId").val(data.divisi).trigger('change');
            $('#'+modal+'HiddenUnitKerjaId').val(data.divisi);
            $(".loaderImage").hide();
        }).fail(function(jqXHR) {
            $(".loaderImage").hide();
            $(".modal-"+modal+"-user").modal("hide");
            $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Status:  "+jqXHR.statusText+"<br/>Error Messages: "+jqXHR["responseJSON"]["message"]);
            $(".modal-error-notification").modal("show");
        });            
    }

    function clearModal(modalType){
        $("#"+modalType+"UserId").val("");
        $("#"+modalType+"UserName").val("");
        $("#"+modalType+"UnitKerjaId").val(0).trigger("change");
        $("#"+modalType+"RoleId").val(<?= $RoleOption[0]->RoleId; ?>).trigger("change");
        $("#"+modalType+"IsActiveId").val(<?= $IsActiveOption[0]["IsActiveId"]; ?>).trigger("change");

        $("#"+modalType+"UserId").removeClass( "error" );
        $("#"+modalType+"UserId-error").css("display","none");

        $("#"+modalType+"UserName").removeClass( "error" );
        $("#"+modalType+"UserName-error").css("display","none");

        $("#"+modalType+"HiddenUnitKerjaId").removeClass( "error" );
        $("#"+modalType+"HiddenUnitKerjaId-error").css("display","none");
    }

    $(document).ready(function() {
        setArrayUnitKerja();
        
        $(".js-example-basic-single").select2();

        $(".collapse-link").click(function(){
            if(hide == 0){
                $(".search-form").html("Hide Filter");
                hide = 1;
            }else{
                $(".search-form").html("Show Filter");
                hide = 0;
            }
        });

        $.validator.addMethod("requiredSelect", function(value, element) {
            var index = arrUnitKerja.indexOf(parseInt(value));
            if(index == -1){
                return false;
            }else return true;
        }, "Please choose one option on this field");

        /* Add User Function */
        $("#btnAddUser").click(function(){
            clearModal("add");
            $(".modal-add-user").modal("show");
        });

        $("#addUserId").change(function(){
            var userId = $(this).val();
            getUserInformation(userId,"add");
        });

        $("#addUnitKerjaId").change(function(){
            var unitKerjaId = $(this).val();
            $('#addHiddenUnitKerjaId').val(unitKerjaId);
        });

        $("#addUserForm").validate({
            ignore: [],
            rules: {
                addUserId: {
                    required: true
                },
                addUserName: {
                    required: true
                },
                addHiddenUnitKerjaId: {
                    requiredSelect: true
                }
            },
            messages:{}
        });

        $("#btnSaveAddUser").on("click", function (event) {
            if($("#addUserForm").valid()){
                var userId = $("#addUserId").val();
                var name = $("#addUserName").val();
                var unitKerjaId = $("#addUnitKerjaId").val();
                var roleId = $("#addRoleId").val();
                var isActiveId = $("#addIsActiveId").val();

                var newData = {
                    "userId" : userId,
                    "name" : name,
                    "unitKerjaId" : unitKerjaId,
                    "roleId" : roleId,
                    "isActive" : isActiveId
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'addNewUser',
                    data: newData,
                    success: function (response) {
                        if (response == 1) {
                            new PNotify({
                                title: 'Success!',
                                text: 'User has been successfully added.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(e) {
                        var responseText = JSON.parse(e.responseText);
                        new PNotify({
                            title: "Error!",
                            text: responseText["message"],
                            type: "error",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                    }
                });
            }
        });

        /* Edit User Function */
        $('#tableUser tbody').on('click', '.btnEditUser', function () {
            clearModal("edit");
            var userId = $(this).data("id");
            var name = $(this).data("name");
            var unitKerjaId = $(this).data("unitkerja");
            var roleId = $(this).data("role");
            var isActiveId = $(this).data("isactive");

            $("#editUserId").val(userId);
            $("#editUserName").val(name);
            $("#editRoleId").val(roleId).trigger("change");
            $("#editUnitKerjaId").val(unitKerjaId).trigger("change");
            $("#editIsActiveId").val(isActiveId).trigger("change");

            $(".modal-edit-user").modal("show");
        });        

        $("#btnSyncUser").click(function(){
            var userId = $("#editUserId").val();
            getUserInformation(userId,"edit");
        });

        $("#editUnitKerjaId").change(function(){
            var unitKerjaId = $(this).val();
            $('#editHiddenUnitKerjaId').val(unitKerjaId);
        });

        $("#editUserForm").validate({
            ignore: [],
            rules: {
                editUserId: {
                    required: true
                },
                editUserName: {
                    required: true
                },
                editHiddenUnitKerjaId: {
                    requiredSelect: true
                }
            },
            messages:{}
        });

        $("#btnSaveEditUser").on("click", function (event) {
            if($("#editUserForm").valid()){
                var userId = $("#editUserId").val();
                var name = $("#editUserName").val();
                var unitKerjaId = $("#editUnitKerjaId").val();
                var roleId = $("#editRoleId").val();
                var isActiveId = $("#editIsActiveId").val();

                var newData = {
                    "userId" : userId,
                    "name" : name,
                    "unitKerjaId" : unitKerjaId,
                    "roleId" : roleId,
                    "isActive" : isActiveId
                };

                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'updateUser',
                    data: newData,
                    success: function (response) {
                        if (response == 1) {
                            new PNotify({
                                title: 'Success!',
                                text: 'User has been successfully updated.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            PNotify.prototype.options.delay = 750;
                            setTimeout(function () {
                                location.reload();
                            }, 1200);
                        }
                    },
                    error: function(e) {
                        var responseText = JSON.parse(e.responseText);
                        new PNotify({
                            title: "Error!",
                            text: responseText["message"],
                            type: "error",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                    }
                });
            }
        });
    });

    
</script>
                