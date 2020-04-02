<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>template/vendors/tag_components/bootstrap-expandable-input/bootstrap-expandable-input.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>template/vendors/tag_components/bootstrap-contenteditable-autocomplete.css">
<style type="text/css">
    .poto{
        padding: 1px;
        border: 5px solid #808080;
        width: 100%;
    }
    .roundedImg {
        border-radius: 50%;
    }
    /*.fstElement { font-size: 1.2em; }
    .fstToggleBtn { min-width: 16.5em; }*/
    .profile_img{
        border: 1px solid #dcdcdc;
    }

    .submitBtn, { display: none; }

    .fstMultipleMode { display: block; }
    .fstMultipleMode .fstControls { width: 100%; }
    thead, .dt-buttons, .dataTables_filter, .dataTables_info {
        display: none;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin-right: 40%;
    }

</style>
<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>

<script src="<?= base_url('/template/vendors/Chart.js/dist/Chart.min.js') ?>"></script>
<!-- Custom tags  Scripts -->

<script src="<?= base_url('template/vendors/tag_components/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('template/vendors/tag_components/bootstrap-expandable-input/bootstrap-expandable-input.js') ?>"></script>
<script src="<?= base_url('template/vendors/tag_components/bootstrap-contenteditable-autocomplete-div.js'); ?>"></script>
<script>
    var div = [
<?php foreach ($divisions as $division) : ?>
        '<?= $division->Name ?>', 
<?php endforeach; ?>
    ];

// -------------- signer & checker ------------
    $(document.body).on('autocomplete_div:request', function (event, query, callback) {
        query = query.toLowerCase();
        callback(div.filter(function (sign_check) {
            return sign_check.toLowerCase().indexOf(query) !== -1;
        }));
    });
</script>


<div class="profile-sidebar">
    <!-- SIDEBAR USERPIC -->
    <div class="profile-userpic">
        <?php
        $d = $this->session->userdata('PROFILE_PIC');
        $file = base_url('assets/images/user_profile/default.png');
        $fileimage = base_url('/uploads/' . $d);
        ?>
        <?php if ($d == "") : ?> 
            <img 
                class="img-responsive img-circle profile_img" 
                style="padding:10px; height: 200px; width: 200px; margin:0 auto;" 
                src="<?= $file ?>">
            <?php else : ?>
            <img 
                class="img-responsive img-circle profile_img" 
                style="padding:10px; height: 200px; width: 200px; margin:0 auto;" 
                src="<?= $fileimage ?>">
            <?php endif; ?> 
        <span>
            <!-- <center>
                <a href="#" data-toggle="modal" data-target="#changePIC" class="btn btn-xs btn-primary" style="margin-top: 5px;">
                    Edit Profile Picture
                </a>
            </center> -->
        </span`>
    </div>

    <!-- END SIDEBAR USERPIC -->

    <!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
        <h4>
            <b><?php echo $_SESSION['NAME']; ?></b>
        </h4>
        <h4><?php echo $_SESSION['CORP_TITLE']; ?></h4>
    </div>
    <div class="profile-usermenu">
        <!-- <ul class="nav">
            <li class="active">
                <a href="<?= base_url('profile'); ?>">
                    <i class="glyphicon glyphicon-home"></i>Activity
                </a>
            </li>
            <li>
                <a href="<?= base_url('profile/setting'); ?>">
                    <i class="glyphicon glyphicon-user"></i>Account Settings
                </a>
            </li>
            <li>
                <a href="<?= base_url('profile/task'); ?>">
                    <i class="glyphicon glyphicon-list-alt"></i>Tasks
                </a>
            </li>
            <li>
                <a href="<?= base_url('profile/APconfirmation'); ?>">
                    <i class="glyphicon glyphicon-ok"></i>Confirmation
                </a>
            </li>
            <li>
                <a href="<?= base_url('profile/disposisi'); ?>">
                    <i class="glyphicon glyphicon-tags"></i>Disposition
                </a>
            </li>
        </ul> -->
    </div>
    <!-- END MENU -->
</div>


<div id="changePIC" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Profile Picture</h4>
            </div>
            <div class="modal-body">

                <?= form_open("profile/tambah", array('enctype' => 'multipart/form-data')); ?>
                <input type="hidden" name="id" value="<?= $user->id; ?>">
                <div class="input-group">
                    <span class="s">
                        <span class="s">
                            <input type="file" name="input_gambar">
                        </span>
                    </span>
                </div>

                <div class="col-sm-12 nopadding">
                    <input type="submit" name="submit" value="Save Data" class="btn btn-sm btn-primary form-control">
                </div>
                <?= form_close(); ?>

                <div style="color: #f00">
                    <i><small>format file must be PNG, JPG, JPEG, maximum file size 1MB</small></i>
                </div>
            </div>

        </div>

    </div>
</div>
