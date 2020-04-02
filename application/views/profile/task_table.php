<style type="text/css">
    .cntrl {
        text-align: center;
    }
    .btn-xs{
        margin-top: 10px
    }
    .lft {
        text-align: left;
    }
    .rght {
        text-align: right;
    }
    .rgt{
        float: right;
    }
    td{
        height: 50px;
    }
    .bg-pending{
        background: #ea9d29;
    }
    .bg-success{
        background: #2dbb23;
    }
    .bg-danger{
        background: #ea1b25;
    }
    .progress-title{
        font-size: 9px;
        font-weight: 600;
        color: #000;
    }
    .progress-title-danger{
        font-size: 9px;
        font-weight: 600;
        color: #f00;
    }
    .progress{
        margin-bottom: 5px !important;
    }
    .dataTables_info , .dataTables_paginate{display: none;}
    .icon {
        position: relative;
        /* Adjust these values accordingly */
        right: 8px;
    }
    .icon-s {
        position: relative;
        /* Adjust these values accordingly */
        right: 7px;
    }
    .smallwid {
        width: 25%;
        text-align: left;
    }
</style>

<h3><b>Task List</b></h3>
<div>
    <form autocomplete="off">
        <!-- <div class="title_right">
            <div  class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input id="myInput" onkeyup="myFunction()" type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div> -->
    </form>
    <table  id="myTable" data-search="true" data-toggle="table" data-pagination="true" data-search="false" class="table table-bordered table-condensed table-striped table-hover table-responsive" style="border-collapse: collapse;">
        <thead style="background: #012D5A; color: #FFF;">
            <tr>
                <!-- <th></th> -->
                <th data-sortable="true">Company Name</th>
                <th data-sortable="true">RM Name</th>
                <th data-sortable="true">Year</th>
                <th class="smallwid"> Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tasks as $vcif => $task) :
                $a = $task['vcif'];
                ?>
                <tr >
                    <td>
                        <b>
                            <a data-toggle="collapse" href="#detailsRow_<?= $task['vcif']; ?>" 
                               aria-expanded="false" 
                               aria-controls="detailsRow_<?= $task['vcif']; ?>"
                               >
                                   <?= $task['company_name']; ?>
                                <!-- <i class="fa fa-angle-down"></i> -->
                            </a>
                        </b>
                        <div style="font-size: 12px">
                            <?php
                            $doc_status_descriptions = array(
                                '', //0 
                                "<span class='label label-warning'>Draft</span>", //1
                                "<span class='label label-warning'>Waiting Checker Approval </span>", //2
                                "<span class='label label-warning'>Waiting Signer Approval </span>", //3
                                "<span class='label label-success'>Published</span>", //4
                                "<span class='label label-danger'>Rejected By Checker </span> 
                            <div style='margin-top:5px; font-size:10px;'>
                                <b>Notes : </b> <br>
                                " . $task['checker_reason'] . "
                            </div>
                            ", //5
                                "<span class='label label-danger'>Rejected By Signer </span>
                            <div style='margin-top:5px; font-size:10px;'>
                                <b>Notes : </b> <br>
                                " . $task['signer_reason'] . "
                            </div>
                            " //6
                            );
                            ?>
                            <?=
                            empty($task['doc_status']) ? 'Data is blank!' :
                                    $doc_status_descriptions[$task['doc_status']]
                            // $task['year']
                            ?>
                        </div>
                    </td>
                    <td>
                        <?php foreach ($task['makers'] as $maker) : ?>
                            <p><?= $maker['name'] ?></p>                                                        
                        <?php endforeach; ?>
                    </td> 
                    <td>
            <center>
                <span class="badge"><?= $task['year']; ?></span>
            </center>
            </td>
            <td td-align="center">
            <left>
                <?php
                $date = date("Y");
                $a = $task['doc_status'];
                $b = $task['year'];
                if ($task['status_vcif'] == 0) {
                    ?>
                    <a href="<?= base_url('perform/viewaccountplannings/viewAp/' . $task['vcif'] . '/' . $task['year']) ?>" type="button" class="btn btn-xs btn-sm btn-info" style="width: 75px;"><span class="glyphicon glyphicon-eye-open icon"></span> View</a>
                    <?php
                } else
                if ($b < $date || $b > $date) {
                    ?>
                    <a href="<?= base_url('perform/viewaccountplannings/viewAp/' . $task['vcif'] . '/' . $task['year']) ?>" type="button" class="btn btn-xs btn-sm btn-info" style="width: 75px;"><span class="glyphicon glyphicon-eye-open icon"></span> View</a>

                <?php } elseif ($a == NULL || $a == 1 || $a == 0 || $a == 5 || $a == 6) { ?>
                    <a 
                        id="openAP" 
                        name="openAP" 
                        class="btn btn-xs btn-info openAP "
                        style="width: 75px"
                        href="<?= base_url('perform/companyinformations/main/' . $task['vcif'] . '/' . $task['year']) ?>"
                        >
                        <span class="glyphicon glyphicon-pencil icon"></span>
                        Input
                    </a>

                    <a href="<?= base_url('perform/companyinformations/simulasicpa/') ?>" type="button" class="btn btn-xs btn-sm btn-warning" ><span class="glyphicon glyphicon-eye-open"></span> Simulasi</a>

                <?php } elseif ($a == 2 || $a == 3) { ?>
                    <a href="<?= base_url('perform/viewaccountplannings/viewAp/' . $task['vcif'] . '/' . $task['year']) ?>" type="button" class="btn btn-xs btn-sm btn-info" style="width: 75px"><span class="glyphicon glyphicon-eye-open icon-s" ></span>  View</a>

                    <a href="<?= base_url('perform/companyinformations/simulasicpa/') ?>" type="button" class="btn btn-xs btn-sm btn-warning" ><span class="glyphicon glyphicon-eye-open"></span> Simulasi</a>
                <?php } else { ?>
                    <a href="<?= base_url('perform/viewaccountplannings/viewAp/' . $task['vcif'] . '/' . $task['year']) ?>" type="button" class="btn btn-xs btn-sm btn-info" style="width: 75px"><span class="glyphicon glyphicon-eye-open icon-s" ></span>  View</a>
                    <a type="button" class="btn btn-xs btn-sm btn-danger" style="width: 75px;" onclick="passValidate('<?= $task['vcif'] ?>', '<?= $task['year'] ?>')"><span class="glyphicon glyphicon-repeat icon-s"></span>Update</a>

                    <a href="<?= base_url('perform/companyinformations/simulasicpa/') ?>" type="button" class="btn btn-xs btn-sm btn-warning" ><span class="glyphicon glyphicon-eye-open"></span> Simulasi</a>
                <?php } ?>
                <!-- <a 
                    id="openAP" 
                    name="openAP" 
                    class="btn btn-xs btn-primary btn-sm openAP" 
                    href="<?= base_url('perform/companyinformations/main/' . $task['vcif'] . '/' . $task['year']) ?>"
                    >
                    test
                </a> --> 
            </left>
            </td>
            </tr>
            <!-- <tr id="detailsRow_<?= $task['vcif']; ?>" class="collapse">
                <td style="width: 50%; padding: 20px;" colspan="3">
                    <div style="padding: 0px;">
                        <div class="col-md-12">
                            <b>Notes :</b>
                            <p>
                                Thank you. I downloaded/installed it and only the homepage works. All other links are broken for me.
                            </p>
                        </div>
                    </div>
                </td>
            </tr> -->
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php foreach ($tasks as $vcif => $task) : ?>
    <div id="rejected<?= $task['id']; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Notes :</h4>
                </div>
                <div class="modal-body">
                    <p>Data Belum lengkap </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php endforeach; ?>

<div id="passModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>KONFIRMASI</b></h4>
            </div>
            <div class="modal-body" style="height: 70px;">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="email" style="margin-top: 10px;">Password:</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="vcifModal" id="vcifModal" class="form-control" value="" required>
                        <input type="hidden" name="yearModal" id="yearModal" class="form-control" value="" required>
                        <input type="password" name="passwordModal" id="passwordModal" class="form-control" value="" required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button id="saved_this" type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script>
                var passValidate = function (vcif, year) {
                    $("#vcifModal").val(vcif);
                    $("#yearModal").val(year);
                    $("#passModal").modal();
                };
                $("#saved_this").on('click', function (e) {
                    var request = JSON.stringify({
                        vcif: $("#vcifModal").val(),
                        year: $("#yearModal").val(),
                        pass: $("#passwordModal").val()
                    });

                    var url = '<?= base_url('rest/bri_starting/checkDocStatus') ?>';
                    var success = function (response) {
                        if (response.success == true) {
                            window.location.assign('<?= base_url('perform/companyinformations/main/') ?>' + response.vcif + '/' + response.year)
                        } else {
                            new PNotify({
                                title: 'Failed!',
                                text: response.message,
                                type: 'notice',
                                styling: 'bootstrap3',
                                delay: 1200
                            });
                        }
                    }
                    $.post(url, request, success, 'json');
                });
</script>
<script>
    function myFunction() {
        // Declare variables 
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>