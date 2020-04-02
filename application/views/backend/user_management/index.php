<style type="text/css">
    .index {
        width: 2px;
        text-align: center;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <!-- isi konten ditaro disini -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User <small>Master Data</small></h2>
                        <div class="pull-right">
                            <button id="addBtn" class="btn btn-success btn-sm addBtn" type="button" data-toggle="modal" data-target="#add_">
                                <i class="fa fa-plus"></i>&nbsp;
                                <b>Add New</b>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <div id="notif">

                        </div>
                    </div>

                    <div class="x_content">
                        <table data-toggle="table" data-search="true" data-pagination="true" class="table table-striped table-hover">
                            <thead style="background-color: #012D5A; color: #FFF;">
                                <tr class="headings">
                                    <th class="index" data-sortable="true">No</th>
                                    <th class="" data-sortable="true">Personal Number</th>
                                    <th class="" data-sortable="true">Name</th>
                                    <th class="">Email Pribadi</th>
                                    <th class="">Role</th>
                                    <th class="">Divisi</th>
                                    <th class="" align="center" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $key_users) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $key_users->personal_number; ?></td>
                                        <td><?php echo $key_users->name; ?></td>
                                        <td><?php echo $key_users->email_lainnya; ?></td>
                                        <td>
                                            <?php echo $key_users->ROLENAME; ?>
                                        </td>
                                        <td>
                                            <?php echo $key_users->DIVISINAME; ?>
                                        </td>
                                        <td class="last" align="center" style="text-align: center;">
                                            <a href="#" data-toggle="modal" 
                                               data-target="#edit_<?php echo $key_users->id; ?>" 
                                               class="btn btn-xs btn-info editBtn" 
                                               data-id="<?php echo $key_users->id; ?>">
                                                <i class="fa fa-edit"></i>&nbsp;<b>Edit</b>
                                            </a>
                                            <?php if ($_SESSION['USER_ID'] != $key_users->id) : ?>
                                                <a href="#" class="btn btn-xs btn-danger btnDel"
                                                   data-toggle="modal" 
                                                   data-target="#delModal_<?php echo $key_users->id; ?>"
                                                   data-id="<?php echo $key_users->id; ?>"
                                                   >
                                                    <i class="fa fa-trash"></i>&nbsp;<b>Delete</b>
                                                </a>
                                            <?php endif; ?>
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


<div class="modal fade" id="add_" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User Registration</h4>
            </div>
            <div class="modal-body">
                <form id="userForm" method="GET">
                    <div class="form-group">
                        <label style="width: 100%">Input Personal Number :</label>
                        <input type="hidden" id="curUser" name="curUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                        <input type="number" id="personal_number" name="personal_number" class="form-control max_pn" placeholder="BRISTAR PN"  required>

                    </div>
                    <div class="form-group">
                        <label style="width: 100%">Name:</label>
                        <input disabled type="text" id="name" name="name" class="form-control" placeholder="Input your full name..">
                    </div>
                    <div class="form-group">
                        <label>Select Role: </label>
                        <select class="form-control" id="role" name="role">
                            <?php
                            $i = 1;
                            foreach ($role as $key_users) :
                                ?>
                                <option value = "<?php echo $key_users->ID; ?>"><?php echo $key_users->ROLE_NAME; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Division: </label>
                        <select disabled class="form-control" id="divisi" name="divisi">
                            <?php
                            $i = 1;
                            foreach ($division as $key_users) :
                                ?>
                                <option value="<?php echo $key_users->ID; ?>"><?php echo $key_users->DIVISION_NAME; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <input type="submit"  id="saveBtn" class="btn btn-primary saveBtn" value="Submit" data-dismiss="modal">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>    
    </div>
</div>

<?php
$i = 1;
foreach ($data as $key_users) :
    ?>
    <div class="modal fade" id="edit_<?php echo $key_users->id; ?>" role="dialog">
        <div class="modal-dialog">

            <!-- Modal EDIT-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Registration</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label style="width: 100%">Input Personal Number :</label>
                            <!-- <input type="number" maxlength="8" id="editPersonalUs" name="editPersonalUs" class="form-control" placeholder="PN" value="<?php echo $key_users->personal_number; ?>" maxlength="8"> -->
                            <input type="number" id="editPersonalUs" name="editPersonalUs" class="form-control max_pn" placeholder="PN" value="<?php echo $key_users->personal_number; ?>" disabled>
                            <input type="hidden" id="editCurUser" name="editCurUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                            <input type="hidden" id="editUserId" name="editUserId">
                        </div>
                        <div class="form-group">
                            <label style="width: 100%">Input Username :</label>
                            <input type="text" id="editNameUser" name="editNameUser" class="form-control" placeholder="username" value="<?php echo $key_users->name; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Select Role: </label>
                            <select class="form-control" id="editRoleType" name="editRoleType">
                                <?php
                                $i = 1;
                                foreach ($role as $rl) :
                                    ?>
                                    <option value="<?php echo $rl->ID; ?>"<?php
                                    if ($rl->ID == $key_users->role_id) {
                                        echo 'selected';
                                    }
                                    ?>><?php echo $rl->ROLE_NAME; ?></option>
                                        <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Division: </label>
                            <select class="form-control" id="editdivType" name="editdivType" disabled>
                                <?php
                                $i = 1;
                                foreach ($division as $dv) :
                                    ?>
                                    <option value="<?php echo $dv->ID; ?>"<?php
                                    if ($dv->ID == $key_users->division_id) {
                                        echo 'selected';
                                    }
                                    ?>><?php echo $dv->DIVISION_NAME; ?></option>
                                        <?php endforeach; ?> 
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button id="saveEditBtn" type="button" class="btn btn-primary saveEditBtn" data-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>    
        </div>
    </div>
<?php endforeach; ?>

<!-- MODAL DELETE -->
<?php foreach ($data as $key_users) : ?>
    <div id="delModal_<?php echo $key_users->id; ?>" class="modal fade deleteModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #CD5C5C; color: #FFF;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" >DELETE <small style="color: #FFF;">User</small></h4>
                </div>
                <div class="modal-body">
                    <p> Are you sure to delete this data? </p>
                    <input type="hidden" id="currentUser" name="currentUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                    <input type="hidden" id="delUserId" name="delUserId">
                </div>
                <div class="modal-footer">
                    <button id="yesBtn" type="button" class="btn btn-success btn-sm saveBtn" data-dismiss="modal">Yes</button>				
                    <button id="noBtn" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>

<script type="text/javascript">
    $('#userForm').validate({
        debug: true,
        rules: {
            personal_number: {
                required: true
            },
            role: {
                required: true
            },
            divisi: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter name..."
            },
            personal_number: {
                required: "Please input personal number"
            },
            role: {
                required: "Please input role type"
            },
            divisi: {
                required: "Please input divisi type"
            }
        },
    });
    $(window).load(function () {

        $('#add_').on('shown.bs.modal', function (e) {

        });

        $('#add_ #personal_number').on('blur', function (e) {
            let pn = $('#add_ #personal_number').val();
            $('#add_ #name').val("Loading ...");
            $('#add_ #divisi').val("");
            $.ajax({
                type: 'GET',
                url: "<?= base_url() ?>logins/add_user_brisim/" + pn,
                success: function (response) {
                    let res = $.parseJSON(response);
                    if (res.nama) {
                        $('#add_ #name').val(res.nama);
                        $('#add_ #divisi').val(res.divisi);
                    }
                },
                error: function (err) {
                    if (err.status == 400) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON(err.responseText);
                        $('#add_ #name').val(json.message);
                        $('#add_ #divisi').val("");
                        new PNotify({
                            title: 'Failed!',
                            text: json.message,
                            type: 'failed',
                            styling: 'bootstrap3'
                        });

                        PNotify.prototype.options.delay = 1200;
                    }
                }
            });
        })

        $('.max_pn').on('keydown', function (e) {
            let a = $(this).val();
            if (a.length >= 8) {
                if (e.keyCode >= 48 && e.keyCode <= 57) {
                    e.preventDefault();
                }
            }
        })

        $('#saveBtn').on('click', function (event) {
            var personal_number = $('#personal_number').val();
            var name = $('#name').val();
            var roleType = $('#role').find(":selected").val();
            var divisiType = $('#divisi').find(":selected").val();
            var userId = $('#curUser').val();


            var newData = {
                'personal_number': personal_number,
                'name': name,
                'roleType': roleType,
                'divisiType': divisiType,
                'userId': userId
            };
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'user_management/addNewUser',
                data: newData,
                success: function (response) {
                    if (response == 1) {
                        new PNotify({
                            title: 'Success!',
                            text: 'The User has been successfully saved.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                        PNotify.prototype.options.delay = 1200;
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function (err) {
                    if (err.status == 400) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON(err.responseText);
                        new PNotify({
                            title: 'Failed!',
                            text: json.message,
                            type: 'failed',
                            styling: 'bootstrap3'
                        });

                        PNotify.prototype.options.delay = 1200;
                    }
                }
            });
        });

        //EDIT

        $(document).on('click', '.editBtn', function (event) {
            var row = $(this).closest('tr');
            var nrow = row[0];
            $('#editUserId').val($(this).data('id'));
            var getModal = $($(this).data("target"))[0];
            modalId = '#' + getModal.id;
            $(document).on('shown.bs.modal', modalId, function (e) {
                $(modalId + ' ' + '#saveEditBtn').on('click', function () {
                    var userId1 = $('#editUserId').val();
                    var personalNumber = $(modalId + ' ' + '#editPersonalUs').val();
                    var name = $(modalId + ' ' + '#editNameUser').val();
                    var roleType = $(modalId + ' ' + '#editRoleType').find(":selected").val();
                    var divisiType = $(modalId + ' ' + '#editdivType').find(":selected").val();
                    var userId = $('#editCurUser').val();

                    var editedData = {
                        'userId1': userId1,
                        'personalNumber': personalNumber,
                        'name': name,
                        'roleType': roleType,
                        'divisiType': divisiType,
                        'userId': userId
                    };
                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'user_management/updateData',
                        data: editedData,
                        success: function (response) {
                            if (response == 1) {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The User you selected has been successfully updated',
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
                        url: 'user_management/deleteData',
                        data: data,
                        success: function (response) {
                            if (response == 1) {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The User you selected has been successfully deleted',
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
    });
</script>