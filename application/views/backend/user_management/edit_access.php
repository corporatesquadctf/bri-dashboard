
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/custom/css/mycss.css">

<style type="text/css">
    .cntrl {
        text-align: center;
    }

    .lft {
        text-align: left;
    }

    .slct {
        width: 2px;
        text-align: left;
    }
    
    thead{
        background-color:#337ab7;
        color: #FFF;
    }
</style>

<div class="right_col" role="main">
    <div class="container">
        <div class="col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">User Management</li>
                        <li class="breadcrumb-item active" aria-current="page">Access Role</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Access Role</li>
                    </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left" style="margin-left: 5px;">Edit Access Role</div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php foreach ($ACCESS_ROLE as $acro) : ?>

                        <form class="form-horizontal form-label-left cmxform" id="accessForm" method="GET">
                            <div class="form-group">
                                <label for="roleName" class="control-label pull-left"> Role Name</label>
                                <input type="hidden" id="currentUser" name="currentUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                                <input type="hidden" id="roleId" name="roleId" value="<?php echo $acro['ROLE_ID']; ?>">
                                <input type="text" name="roleName" id="roleName" class="form-control" value="<?php echo $acro['ROLE_NAME']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="moduleName" class="control-label pull-left"> Module Name</label>
                            </div>
                            <!--<table data-toggle="table" data-pagination="true" class="table table-condensed table-striped table-hover table-bordered">-->
                            <table data-toggle="table" data-pagination="false" class="table table-condensed table-striped table-hover table-bordered">
                                <thead>
                                    <tr style="background-color: #012D5A; color: #FFF;">

                                        <th class="slct"><input type="checkbox" onclick="toggle(this);" /> Select All</th>
                                        <th class="lft" data-sortable="true">Module Name</th>
                                    </tr>
                                </thead>

                                <?php $i = 1;
                                foreach ($MASTER_MODULE as $mm) :
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <div class="checkboxs">

                                                <?php
                                                $moduleId = $mm->MODULE_ID;
                                                $accMod = $acro['MODULES'];
                                                ?>

                                                <input type="checkbox" value="<?php echo $mm->MODULE_ID; ?>" name="moduleId" id="moduleId" <?= (in_array($moduleId, $accMod) ? 'checked=""' : '') ?>>
                                            </div>
                                        </td>
                                        <td><?php echo $mm->MODULE_NAME; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <br>
                            <div class="pull-right">
                                <a href="<?= base_url() ?>admin/user_management/access" class="btn btn-sm btn-danger" id="cancelBtn">Cancel</a>
                                <input type="submit" class="btn btn-sm btn-success" value="Save">
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>


<script type="text/javascript">

                                            function toggle(source) {
                                                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                                for (var i = 0; i < checkboxes.length; i++) {
                                                    if (checkboxes[i] != source)
                                                        checkboxes[i].checked = source.checked;
                                                }
                                            }
// CREATE
                                            $('#accessForm').validate({
                                                debug: true,
                                                rules: {
                                                    roleName: {
                                                        required: true
                                                    }
                                                },
                                                messages: {
                                                    moduleId: {
                                                        required: "Please check the module..."
                                                    }
                                                },

                                                submitHandler: function (form) {
                                                    var role = $('#roleId').val();
                                                    var val = [];
                                                    $(':checkbox:checked').each(function (i) {
                                                        val[i] = $(this).val();
                                                    });
                                                    var userId = $('#currentUser').val();

                                                    var newData = {
                                                        'role': role,
                                                        'moduleID': val,
                                                        'userId': userId
                                                    };

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../insertAcc",
                                                        data: newData,
                                                        success: function (response) {
                                                            if (response == 1) {
                                                                new PNotify({
                                                                    title: 'Success!',
                                                                    text: 'New Module has been saved successfuly.',
                                                                    type: 'success',
                                                                    styling: 'bootstrap3'
                                                                });

                                                                PNotify.prototype.options.delay = 1200;

                                                                setTimeout(function () {
                                                                    location.href = "<?= base_url(); ?>admin/user_management/access";
                                                                }, 1500);
                                                            }
                                                        }
                                                    });
                                                }
                                            });

</script>
