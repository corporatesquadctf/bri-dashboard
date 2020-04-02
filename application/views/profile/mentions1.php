<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<style type="text/css">
    .roundedImg {
        border-radius: 50%;
    }
    /*.fstElement { font-size: 1.2em; }
    .fstToggleBtn { min-width: 16.5em; }*/

    .submitBtn, { display: none; }

    .fstMultipleMode { display: block; }
    .fstMultipleMode .fstControls { width: 100%; }
    thead, .dt-buttons, .dataTables_filter, .dataTables_info {
        display: none;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin-right: 40%;
    }

    td {
        display:none;
        padding: 10px;
        border-width: 0 1px 1px 0;
        border-style: solid;
        border-color: #fff;
        box-shadow: 0 1px 1px #ccc;
        margin-bottom: 5px;
    }
    tr{
        background: #fff;
    }
    .totop {
        position: fixed;
        bottom: 10px;
        right: 20px;
    }
    .totop a {
        display: none;
    }
    #loadMore {
        height: 40px;
        padding: 10px;
        text-align: center;
        background-color: #33739E;
        color: #fff;
        border-width: 0 1px 1px 0;
        border-style: solid;
        border-color: #fff;
        box-shadow: 0 1px 1px #ccc;
        transition: all 600ms ease-in-out;
        -webkit-transition: all 600ms ease-in-out;
        -moz-transition: all 600ms ease-in-out;
        -o-transition: all 600ms ease-in-out;
        margin-top: 10px;
    }
    #loadMore:hover {
        background-color: #164969;
        color: #fff;
    }
    .icon-input-btn{
        display: inline-block;
        position: relative;
        width: 100%;
        font-weight: 600;
    }
    .icon-input-btn input[type="submit"]{
        padding-left: 2em;
    }
    .icon-input-btn .glyphicon{
        display: inline-block;
        position: absolute;
        left: 35px;
        top: 30%;
        color: #fff;
    }
    .glyphicon-share{
        font-size: 16px;
        margin-top: -3px;
    }
</style>


<div class="tab-content">
    <div id="profile" class="tab-pane fade in active">
        <div class="col-md-12 col-xs-12 nopadding">
            <div class="x_panel">
                <div class="x_content">
                    <div style="background: #f5f5f5; padding: 20px; margin-bottom: 20px; height: 250px;">
                        <form id="statusform" method="GET">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <input type="hidden" name="nama" value="<?= $_SESSION['USER_ID']; ?>">
                                <input type="hidden" name="role" value="<?= $_SESSION['ROLE_ID']; ?>">
                                <textarea name="comment" id="comment" class="form-control" rows="5" ></textarea>
                            </div>
                            <div class="col-md-9 nopadding">
                                <select input="text" data-placeholder="Search Division Name" class="chosen-select form-control" name="tags[]" id="tags[]" multiple>
                                    <option value=""></option>
                                    <?php foreach ($divisions as $division) : ?>
                                        <option value="<?= $division->UnitKerjaId; ?>"><?= $division->Name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3 ">
                                <!-- <input type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Submit"> -->
                                <span class="icon-input-btn pull-right"><span class="glyphicon glyphicon-share"></span> <input type="submit" name="submit" class="btn btn-sm btn-success input-block-level form-control" style="font-size: 14px" value="Submit"></span>
                            </div>
                        </form>
                    </div>
                    <div class="container" style="margin-bottom: 20px;">
                        <ul class="nav nav-tabs">
                            <li><a href="<?= base_url(); ?>profile">All</a></li>
                            <li><a href="<?= base_url(); ?>profile/own">Own</a></li>
                            <?php if ($_SESSION['ROLE_ID'] != 1) : ?>
                                <li class="active"><a href="<?= base_url('profile/mentions') ?>">Mentions</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <table id="table1" class="tables ">
                        <thead>
                            <tr>
                                <th>All Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!isset($COMMENT)) : ?>
                            <div align="center">
                                Comment not found!
                            </div>
                        <?php else : ?>
                            <?php foreach ($COMMENT as $com) : ?>
                                <tr>
                                    <td>
                                        <div class="col-md-12 nopadding">
                                            <div class="comments-list">
                                                <div class="media">
                                                    <p class="pull-right">
                                                        <small>
                                                            <?php
                                                            $addon = new DateTime($com['ADDON']);
                                                            echo $addon->format("F j, Y");
                                                            ?> 
                                                        </small>
                                                    </p>
                                                    <a class="media-left" href="#">
                                                        <?php $userImage = $com['PROFILE_PIC']; ?>
                                                        <?php if ($userImage) : ?>
                                                            <img class="roundedImg" width="50px;" height="50px" src="<?= base_url('/uploads/' . $userImage); ?>" class="img-responsive" alt="">   
                                                        <?php else : ?>
                                                            <img class="roundedImg" width="50px;" height="50px" src="<?= base_url('assets/images/user_profile/default.png') ?>" class="img-responsive" alt="">
                                                        <?php endif; ?>
                                                    </a>
                                                    <div class="media-body">

                                                        <h4 class="media-heading user_name">
                                                            <b><?= $com['NAME']; ?></b>
                                                        </h4>
                                                        <span style="font-size: 12px;">
                                                            <h5>
                                                                <?= $com['COMS']; ?>
                                                            </h5>
                                                        </span>
                                                        <?php $divId = $com ['NAMETAG']; ?>
                                                        <div>
                                                            <?php foreach ($divId as $divdiv) : ?>
                                                                <span class="label label-info"><?= $divdiv; ?></span>
                                                            <?php endforeach; ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="divider"></div>  -->
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?> 

                        </tbody>
                    </table>
                    <a href="#" class="form-control" id="loadMore">Load More</a>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/chosen/chosen.js"></script>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/bootstrap-multiselect.js"></script>
<script> 

    $('.multipleSelect').multiselect();

</script>
<script type="text/javascript">
    $(function () {
        $("td").slice(0, 4).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $("td:hidden").slice(0, 4).slideDown();
            if ($("td:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1500);
        });
    });

    $('a[href=#top]').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.totop a').fadeIn();
        } else {
            $('.totop a').fadeOut();
        }
    });
</script>
<script type="text/javascript">
    // CREATE
    $('#statusform').validate({
        debug: true,
        rules: {
            comment: {
                required: true
            }
        },
        messages: {
            comment: {
                required: "Please Fill The Column..."
            }
        },

        submitHandler: function (form) {

            $.ajax({
                type: "POST",
                url: "insertNew",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == 1) {
                        new PNotify({
                            title: 'Success!',
                            text: 'New Comment Added',
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
</script>

<script type="text/javascript">
    $(".chosen-select").chosen({
        no_results_text: "Oops, Pilihan Tidak tersedia"
    })
</script>