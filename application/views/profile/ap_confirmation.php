<style type="text/css">
    th { text-align: center; }
</style>


<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>PROFILE</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <?php $this->load->view('layout/profile_sidebar.php'); ?>
                        </div>
                        <div class="col-md-9">
                            <h3><b>Confirmation List</b></h3>

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#checkers">Checker List</a></li>
                                <li><a data-toggle="tab" href="#signers">Signer List</a></li>
                            </ul>

                            <div class="tab-content" style="margin-top: 20px;">
                                <div id="checkers" class="tab-pane fade in active">
                                    <table data-toggle="table" data-pagination="false" class="table table-bordered table-condensed table-striped table-hover table-responsive" style="border-collapse: collapse;">
                                        <thead style="background: #012D5A; color: #FFF;">
                                            <tr>
                                                <th>No</th>
                                                <th data-sortable="true">Company</th>
                                                <th data-sortable="true">Years</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($companies_to_check as $index => $company) : ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= $company->customer_name ?></td>
                                                    <td>
                                                        <?= $company->YEAR; ?>
                                                    </td>
                                                    <td>
                                            <center>
                                                <a href="<?= base_url('perform/viewaccountplannings/viewAp/' . $company->vcif . '/' . $company->YEAR) ?>" class="btn btn-primary">
                                                    View Account planning
                                                </a>
                                                <!--
                                                <a href="#" data-toggle="modal" data-target="#decline<?= $company->vcif; ?>" class="btn btn-danger">
                                                    Decline
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#ok<?= $company->vcif; ?>" class="btn btn-success">
                                                    OK
                                                </a>
                                                -->
                                            </center>
                                            </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- ==== SIGNER ==== -->
                                <div id="signers" class="tab-pane fade">
                                    <table data-toggle="table" data-pagination="false" class="table table-bordered table-condensed table-striped table-hover table-responsive" style="border-collapse: collapse;">
                                        <thead style="background: #012D5A; color: #FFF;">
                                            <tr>
                                                <th>No</th>
                                                <th data-sortable="true">Company</th>
                                                <th data-sortable="true">Years</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($companies_to_sign as $index => $company) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $index + 1 ?>
                                                    </td>
                                                    <td>
                                                        <?= $company->customer_name; ?>
                                                    </td>
                                                    <td>
                                                        <?= $company->YEAR; ?>
                                                    </td>
                                                    <td>
                                            <center>
                                                <a href="<?= base_url('perform/viewaccountplannings/viewAp/' . $company->vcif . '/' . $company->YEAR); ?>" class="btn btn-primary">
                                                    View Account planning
                                                </a>
                                                <!--
                                                <a href="#" data-toggle="modal" data-target="#dcsign<?= $company->vcif; ?>" class="btn btn-danger">
                                                    Decline
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#oksign<?= $company->vcif; ?>" class="btn btn-success">
                                                    Publish
                                                </a>
                                                -->
                                            </center>
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
        </div>
    </div>

    <?php foreach ($companies_to_check as $index => $company) : ?>
        <div class="modal fade" id="decline<?= $company->vcif; ?>" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-body">
                            <form id="declines" method="GET">
                                <div class="form-group">
                                    <label for="comment">Note (why decline this):</label>
                                    <textarea class="form-control" rows="5" id="comment" name="msg"></textarea>
                                </div>
                                <input type="hidden" id="vcif" name="vcif" value="<?= $company->vcif; ?>">
                                <input type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($companies_to_check as $company) : ?>
    <div class="modal fade" id="ok<?= $company->vcif; ?>" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body" align="center">
                        <form id="OKbtn" method="GET">
                            <div class="form-group" >
                                <span>
                                    Are You Sure To Change <b><?= $company->company_name; ?></b> Status To Checked
                                </span>
                            </div>
                            <input type="hidden" id="okID" type="text" name="okID" value="3">
                            <input type="hidden" id="vcif" name="vcif" name="declineID" value="<?= $company->vcif; ?>">
                            <input type="hidden" id="year" name="year" name="declineID" value="<?= $company->vcif; ?>">
                            <!-- <button type="button" class="btn btn-primary form-control" data-dismiss="modal">Submit</button> -->
                            <input type="submit" class="btn btn-sm btn-success input-block-level form-" value="OK">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($companies_to_sign as $index => $company) : ?>
    <div class="modal fade" id="dcsign<?= $company->vcif; ?>" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <form id="dcsign" method="GET">
                            <div class="form-group">
                                <label for="comment">Note (why decline this From Signer):</label>
                                <textarea class="form-control" rows="5" id="comment" name="msg"></textarea>
                            </div>
                            <input type="hidden" id="vcif" name="vcif" value="<?= $company->vcif; ?>">
                            <input type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="oksign<?= $company->vcif; ?>" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <form id="OKsign" method="GET">
                            <div class="form-group">
                                <span>
                                    Are You Sure To Change <b><?= $company->company_name; ?></b> Status To Checked
                                </span>
                            </div>
                            <input type="hidden" id="vcif" name="vcif" value="<?= $company->vcif; ?>">
                            <input type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/fastselect/fastselect.standalone.js"></script>
<script type="text/javascript">
    // CREATE
    $('#declines').validate({
        debug: true,
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "declines",
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
    // CREATE
    $('#dcsign').validate({
        debug: true,
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "DCsigner",
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
    $('#OKbtn').validate({
        debug: true,
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "OKb",
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
    $('#OKsign').validate({
        debug: true,
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "OKsigner",
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
