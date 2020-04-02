<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?= base_url('/assets/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>">
<script src="<?= base_url('/assets/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>
<style type="text/css">
    .frmdiv{
        height: 400px;
        overflow: scroll;
    }
    .fixed-table-container{
        border:none;
    }
    .checkbox, .radio {
        margin: 5px;
    }
    .checkbox label, .radio label {
        width: 100%;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Delegation Relation Division</h2>
                        <div class="clearfix"></div>
                        <div id="notif" class="">
                            <!-- NOTIFICATION -->
                        </div>
                    </div>

                    <div class="x_content">
                        <div class="pull-right">
                            <button id="addBtn" class="btn btn-success btn-sm addBtn" type="button" data-toggle="modal" data-target="#add_" style="margin-top: 10px;">
                                <i class="fa fa-plus"></i>&nbsp;
                                <b>Add New</b>
                            </button>
                        </div>

                        <table id="data1" data-search="true" data-toggle="table" data-pagination="true" class="table table-hover table-striped table-bordered table-condensed" style="border-collapse: collapse; margin-top: 20px;">
                            <thead style="background-color: #012D5A; color: #FFF; ">
                                <tr class="headings">
                                    <th data-sortable="true">No</th>
                                    <!-- <th data-sortable="true" data-field="customer_name">Group / Company</th> -->
                                    <th data-sortable="true">Company Name</th>
                                    <th data-sortable="true">Divisi</th>
                                    <!-- <th data-sortable="true">vcif</th> -->
                                    <th width="12%" >Action</th>
                                    <!--<th width="12%"><center>Action</center></th>-->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                foreach ($relDiv as $k) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $k->COMPANY_NAME; ?></td>
                                        <td><?php echo $k->DIVISION_NAME; ?></td>
                                        <td>
                                <center>
                                    <a href="#" class="btn btn-xs btn-info editBtn" data-toggle="modal" data-target="#modal_<?php echo $k->ID; ?>" >
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a href="#" class="btn btn-xs btn-danger editBtn" data-toggle="modal" data-target="#delete_<?php echo $k->ID; ?>" >
                                        <i class="fa fa-close"></i> 
                                    </a>

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

<?php foreach ($relDiv as $div) : ?>
    <div id="modal_<?php echo $div->ID; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--UPDATE -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $div->GROUP_NAME; ?></h4>
                </div>
                <div class="modal-body">
                    <label>Select Division :</label>
                    <br>
                    <form class="update">
                        <input type="hidden" id="_edit_id_<?php echo $div->ID ?>" value="<?php echo $div->ID; ?>">
                        <input type="hidden" id="___edit_id_<?php echo $div->ID ?>" value="<?php echo $div->VCIF; ?>">
                        <select class="selectpicker form-control divId" data-live-search="true" id="__edit_id_<?php echo $div->ID ?>">
                            <?php foreach ($src as $sc) : ?>
                                <?php if ($sc->ID == $div->DIV_ID): ?>
                                    <option value="<?php echo $sc->ID; ?>" selected data-tokens="<?php echo $sc->DIVISION_NAME; ?>"><?php echo $sc->DIVISION_NAME; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $sc->ID; ?>" data-tokens="<?php echo $sc->DIVISION_NAME; ?>"><?php echo $sc->DIVISION_NAME; ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>


                        <div class="col-md-12" style="margin-top: 20px">
                            <button type="button" type="submit" id="edit_id_<?php echo $div->ID ?>" class="btn btn-primary btn_edit">Save</button>
                        </div>

                    </form>
                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>
<?php endforeach; ?>


<!-- DELETE -->
<?php foreach ($relDiv as $div) : ?>
    <div id="delete_<?php echo $div->ID; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background: #4682B4; color: #FFF;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $div->COMPANY_NAME; ?></h4>
                </div>
                <div class="modal-body">
                    <form id="delete" method="POST">
                        <br>
                        <div class="col-md-12" style="margin-top: -10px;">
                            <input id="_delete_id_<?php echo $div->ID ?>" type="hidden" name="id" value="<?php echo $div->ID; ?>">
                            Are You sure want to Delete <b><?php echo $div->COMPANY_NAME; ?></b> Relation Division ?
                        </div>
                        <div class="divider" style="margin-top: 25px;"></div>
                        <div class="col-md-12">
                            <a class="pull-right" href="<?php echo base_url() . "index.php/admin/DivisionRelation/del/" . $div->ID; ?>">
                                <button id="delete_id_<?php echo $div->ID ?>" class="hapusRel btn btn-danger">Yes</button>
                            </a>
                            <!-- <button type="button" type="submit" id="btn_del" class="btn btn-danger btn-sm" >Delete</button> -->
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="add_" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Company Relation Division</h4>
            </div>
            <div class="modal-body">
                <form id="relasiForm">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Pilih Company</label>
                            <br>
                            <select class="selectpicker form-control" data-live-search="true" id="company">
                                <?php foreach ($company as $cp) : ?>
                                    <option value="<?php echo $cp->VCIF; ?>" data-tokens="<?php echo $cp->COMPANY_NAME; ?>"><?php echo $cp->COMPANY_NAME; ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <label>Pilih Divisi</label>
                            <br>
                            <select class="selectpicker form-control" data-live-search="true" id="division">
                                <?php foreach ($src as $s) : ?>
                                    <option value="<?php echo $s->ID; ?>" data-tokens="<?php echo $s->DIVISION_NAME; ?>"><?php echo $s->DIVISION_NAME; ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                        <!--
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label>Pilih Divisi 2</label>
                            <br>
                            <select class="selectpicker form-control" data-live-search="true" id="division_2">
                              <option value="0">- None -</option>
                        <?php foreach ($src as $s) : ?>
                                                      <option value="<?php echo $s->ID; ?>" data-tokens="<?php echo $s->DIVISION_NAME; ?>"><?php echo $s->DIVISION_NAME; ?></option>
                        <?php endforeach ?>
                            </select>

                        </div>
                        -->
                        <div class="col-md-12" style="margin-top: 20px">
                            <!-- <input type="button" class="btn btn-sm btn-danger" id="cancelBtn" value="Cancel" onclick="this.form.reset();"> -->
                            <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <input type="submit"  id="saveBtn" class="btn btn-primary saveBtn" value="Submit" data-dismiss="modal">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>    
    </div>
</div>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("divtbl");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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

<script type="text/javascript">
    $('#btn_save').on('click', function () {
        var company = $('#company').val();
        var division = $('#division').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/DivisionRelation/insert') ?>",
            dataType: "JSON",
            data: {company: company, division: division},
            success: function (response) {

                if (response == 1) {
                    new PNotify({
                        title: 'Success!',
                        text: 'Data has been successfully updated.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 1200;

                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else if (response == 2) {
                    new PNotify({
                        title: 'Failed!',
                        text: 'Divisi Maksimal 2 per Company.',
                        type: 'danger',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 1200;
                } else if (response == 3) {
                    new PNotify({
                        title: 'Failed!',
                        text: 'Divisi sudah ada.',
                        type: 'danger',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 1200;
                }
            }
        });
        return false;
    });
</script>
<script type="text/javascript">
    $('.btn_edit').on('click', function () {
        var id = $(this)[0].id;
        var divisi = $("#__" + id).val();
        var vcif = $("#___" + id).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/DivisionRelation/update') ?>",
            dataType: "JSON",
            data: {id: $("#_" + id).val(), divisi: divisi, vcif: vcif},
            success: function (response) {
                if (response == 1) {
                    new PNotify({
                        title: 'Success!',
                        text: 'Data has been successfully updated.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 500;

                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else if (response == 2) {
                    new PNotify({
                        title: 'Failed!',
                        text: 'Divisi sama dengan aslinya.',
                        type: 'danger',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 500;
                } else if (response == 3) {
                    new PNotify({
                        title: 'Failed!',
                        text: 'Divisi sudah ada.',
                        type: 'danger',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 500;
                }
            }
        });
        return false;
    });
</script>
<script type="text/javascript">
    $(".hapusRel").on('click', function (e) {
        id = $(this)[0].id;
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('admin/DivisionRelation/del/') ?>",
            type: 'post',
            data: {id: $("#_" + id).val()},
            success: function () {
                location.reload();
            }});
    })
</script>