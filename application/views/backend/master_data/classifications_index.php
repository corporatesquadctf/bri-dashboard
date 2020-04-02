<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?= base_url('/assets/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>">
<script src="<?= base_url('/assets/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>
<style type="text/css">
    .cntrl {
        text-align: center;
    }

    .lft {
        text-align: left;
    }
    .rght {
        text-align: right;
    }
</style>

<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-table"></i><small>Classifications Index</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="pull-right">
                        <button data-toggle="modal" data-target="#add" class="btn btn-success">Add New</button>
                    </div>
                    <!-- <div class="col-md-4 pull-right">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="selectpicker form-control" data-live-search="true" id="division">
                    <?php foreach ($src as $s) : ?>
                                                  <option value="<?php echo $s->ID; ?>" data-tokens="<?php echo $s->DIVISION_NAME; ?>"><?php echo $s->DIVISION_NAME; ?></option>
                    <?php endforeach ?>
                                </select>
                            </div>
                          </div>
                    </div> -->

                    <div class="x_content">
                        <table data-toggle="table" data-search="true" data-pagination="true" class="table table-condensed table-striped table-hover">
                            <thead style="background-color: #012D5A; color: #FFF;">
                                <tr>
                                    <th class="cntrl" data-sortable="true">No</th>
                                    <th class="lft" data-sortable="true">Division Name</th>
                                    <th class="lft" data-sortable="true">Classification Name</th>
                                    <th class="cntrl" data-sortable="true">Min Value</th>
                                    <th class="cntrl" data-sortable="true">Max Value</th>
                                    <!-- <th class="cntrl" data-sortable="true">Created On</th>
                                    <th class="cntrl">Create By</th> -->
                                   <!--  <th class="cntrl" data-sortable="true">Last Modified</th>
                                    <th class="cntrl">Modified By</th> -->
                                    <th class="cntrl" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $k) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $k->DIVISION_NAME; ?></td>
                                        <td><?php echo $k->CLASSIFICATION; ?></td>
                                        <td class="rght"><?php echo number_format($k->MIN_PARAMETER, 2); ?></td>
                                        <td class="rght"><?php echo number_format($k->MAX_PARAMETER, 2); ?></td>
                                        <!-- <td class="lft"><?php
                                        $addon = new DateTime($k->ADDON);
                                        echo $addon->format('d/m/Y H:i:s');
                                        ?></td>
                                        <td class="lft"><?php echo $k->MAKER; ?></td> -->
                                        <!-- <td class="cntrl"><?php
                                        $modion = $k->MODION;
                                        if ($modion) {
                                            $modifiedOn = new DateTime($modion);
                                            echo $modifiedOn->format('d/m/Y H:i:s');
                                        } else {
                                            echo '-';
                                        }
                                        ?></td>
                                        <td class="cntrl"><?php echo ($k->MODIFIER) ? $k->MODIFIER : '-'; ?></td> -->
                                        <td>
                                            <a href="#" class="btn btn-xs btn-info editBtn" data-toggle="modal" data-target="#modal_<?php echo $k->ID; ?>" data-id="<?php echo $k->ID; ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a id="#" href="#" class="btn btn-xs btn-danger delBtn" data-toggle="modal" data-target="#delete_<?php echo $k->ID; ?>" data-id="<?php echo $k->ID; ?>">
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

<!-- MODAL ADD -->
<div id="add" class="modal fade classModal" role="dialog" >
    <div class="modal-dialog">
        <!-- MODAL CONTENT -->
        <div class="modal-content">
            <div class="modal-header" style="background: #4682B4; color: #FFF;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ADD <small style="color: #FFF;">Classification</small></h4>
            </div>

            <div class="modal-body">
                <form id="editForm" class="form-horizontal form-label-left cmxform">
                    <div class="form-group">
                        <label for="editClsName" class="control-label">Classification</label>
                        <!--<input id="editClsNameAdd" type="text" name="editClsName" class="form-control"  placeholder="Parameter Name" />-->
                        <select class="form-control" style="height:55px;" id="editClsNameAdd" name="editClsNameAdd">
                            <option value="0">Choose Parameter</option>
                            <option value="Platinum">Platinum</option>
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                            <option value="Bronze">Bronze</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editClsDivisi" class="control-label">Divisi</label>
                        <select class="form-control" style="height:55px;" id="divisiAdd" name="divisi">
                            <option value="0">Choose Divisi</option>
                            <?php foreach ($masterDivisi as $d) : ?>
                                <option value="<?php echo $d->id; ?>"><?php echo $d->division_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-groups">
                                    <label class="control-label" for="minParam">Min Value</label>
                                    <input type="number" id="minParamAdd" name="minParam" class="form-control" placeholder="must be number">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-groups">
                                    <label class="control-label" for="maxParam">Max Value</label>
                                    <input type="number" id="maxParamAdd" name="maxParam" class="form-control" placeholder="must be number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="clsDesc">Description</label>
                        <br>
                        <textarea class="form-control" id="clsDescAdd" name="clsDesc" type="text" rows="9" cols="100%" ></textarea> 
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="saveBtnAdd" type="button" class="btn btn-success btn-sm saveBtn" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL UPDATE -->
<?php foreach ($data as $k) : ?>
    <div id="modal_<?php echo $k->ID; ?>" class="modal fade classModal" role="dialog" >
        <div class="modal-dialog">
            <!-- MODAL CONTENT -->
            <div class="modal-content">
                <div class="modal-header" style="background: #4682B4; color: #FFF;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">EDIT <small style="color: #FFF;">Classification</small></h4>
                </div>

                <div class="modal-body">
                    <form id="editForm" class="form-horizontal form-label-left cmxform">
                        <div class="form-group">
                            <label for="editClsName" class="control-label">Classification</label>
                            <input id="clsId" type="hidden" name="clsId" />
                            <input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['USER_ID']; ?>"/>
                            <!--<input id="editClsName" type="text" name="editClsName" class="form-control" disabled placeholder="<?php echo $k->CLASSIFICATION; ?>" />-->
                            <select class="form-control" style="height:55px;" id="editClsName" name="editClsName" disabled>
                                <option value="0">Choose Parameter</option>
                                <<?php foreach ($master_clas as $d) : ?>
                                    <?php if ($k->CLASSIFICATION == $d->id): ?>
                                        <option value="<?php echo $d->id; ?>" selected><?php echo $d->id; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $d->id; ?>"><?php echo $d->id; ?></option>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editClsDivisi" class="control-label">Divisi</label>
                            <select class="form-control" style="height:55px;" id="divisiEdit" name="divisi" value="<?php echo $k->DIVISI; ?>">
                                <option value="0">Choose Divisi</option>
                                <?php foreach ($masterDivisi as $d) : ?>
                                    <?php if ($k->DIVISI == $d->id): ?>
                                        <option value="<?php echo $d->id; ?>" selected><?php echo $d->division_name; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $d->id; ?>"><?php echo $d->division_name; ?></option>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <br />
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="input-groups">
                                        <label class="control-label" for="minParam">Min Value</label>
                                        <input type="number" id="minParam" name="minParam" class="form-control" value="<?php echo $k->MIN_PARAMETER; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-groups">
                                        <label class="control-label" for="maxParam">Max Value</label>
                                        <input type="number" id="maxParam" name="maxParam" class="form-control" value="<?php echo $k->MAX_PARAMETER; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="clsDesc">Description</label>
                            <br>
                            <textarea class="form-control" id="clsDesc" name="clsDesc" type="text" rows="9" cols="100%" ><?php echo $k->DESCRIPTION; ?></textarea> 
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button id="saveBtn" type="button" class="btn btn-success btn-sm saveBtn" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- MODAL DELETE -->
<?php foreach ($data as $dl) : ?>
    <div id="delete_<?php echo $dl->ID; ?>" class="modal fade classModal" role="dialog" >
        <div class="modal-dialog">
            <!-- MODAL CONTENT -->
            <div class="modal-content">
                <div class="modal-header" style="background: #4682B4; color: #FFF;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">DELETE <small style="color: #FFF;">Classification</small></h4>
                </div>

                <div class="modal-body">
                    <form id="delForm" class="form-horizontal form-label-left cmxform">
                        Are you sure want to delete <b><?php echo $dl->CLASSIFICATION; ?></b> classification from <b><?php echo $dl->DIVISION_NAME; ?></b> ?
                        <!-- <div class="form-group">
                            <label for="editClsName" class="control-label">Classification</label>
                            <input id="clsId" type="hidden" name="clsId" />
                            <input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['USER_ID']; ?>"/>
                            <input id="editClsName" type="text" name="editClsName" class="form-control" disabled placeholder="<?php echo $k->CLASSIFICATION; ?>" />
                        </div>
                        <br /> -->
                        <input id="clsIdDel" type="hidden" name="clsId" value="<?php echo $dl->ID; ?>"/>
                        <input id="userIdDel" type="hidden" name="userId" value="<?php echo $_SESSION['USER_ID']; ?>"/>
                    </form>
                </div>

                <div class="modal-footer">

                    <button id="del_confirm" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>

<script type="text/javascript">
    $(window).load(function () {
        $(document).on('click', '#saveBtnAdd', function (event) {
            var editClsName = $('#editClsNameAdd').val();
            var divisi = $('#divisiAdd').val();
            var minParam = $('#minParamAdd').val();
            var maxParam = $('#maxParamAdd').val();
            var clsDesc = $('#clsDescAdd').val();
            var userId = $('#userId').val();

            var newData = {
                'editClsName': editClsName,
                'divisi': divisi,
                'minParam': minParam,
                'maxParam': maxParam,
                'clsDesc': clsDesc,
                'userId': userId
            };

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'classifications/insertData',
                data: newData,
                success: function (response) {
                    if (response.sukses == 1) {
                        new PNotify({
                            title: 'Success!',
                            text: 'The Classification you selected has been successfully Added.',
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

        $(document).on('click', '.delBtn', function (j) {
            var row = $(this).closest('tr');
            var nrow = row[0];
            $('#clsId').val($(this).data('id'));
            var getModal = $($(this).data("target"))[0];
            modalId = '#' + getModal.id;
            $(document).on('shown.bs.modal', modalId, function (e) {
                $(modalId + ' ' + '#del_confirm').on('click', function (event) {
                    var clsId = $(modalId + ' #clsIdDel').val();
                    var userId = $(modalId + ' #userIdDel').val();

                    var newData = {
                        'clsId': clsId,
                        'userId': userId
                    };

                    event.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: 'classifications/deleteData',
                        data: newData,
                        success: function (response) {
                            if (response.sukses == 1) {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The Classification you selected has been successfully deleted.',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });

                                PNotify.prototype.options.delay = 1200;

                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else {
                                new PNotify({
                                    title: 'Failed!',
                                    text: response.msg,
                                    type: 'danger',
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

        $(document).on('click', '.editBtn', function (d) {
            // $('.editBtn').on('click', function(i) {
            var row = $(this).closest('tr');
            var nrow = row[0];
            $('#clsId').val($(this).data('id'));
            var getModal = $($(this).data("target"))[0];
            modalId = '#' + getModal.id;
            //$(modalId + ' #editClsName').val()
            $(document).on('shown.bs.modal', modalId, function (e) {

                $('#editForm').validate({
                    debug: true,
                    rules: {
                        minParam: {
                            required: true,
                            number: true
                        },
                        maxParam: {
                            required: true,
                            number: true
                        }
                    }
                });
                $(modalId + ' ' + '#saveBtn').on('click', function (event) {
                    var clsId = $('#clsId').val();
                    var divisi = $(modalId + ' #divisiEdit').val();
                    var minParam = $(modalId + ' ' + '#minParam').val();
                    var maxParam = $(modalId + ' ' + '#maxParam').val();
                    var clsDesc = $(modalId + ' ' + '#clsDesc').val();
                    var userId = $('#userId').val();

                    var newData = {
                        'clsId': clsId,
                        'divisi': divisi,
                        'minParam': minParam,
                        'maxParam': maxParam,
                        'clsDesc': clsDesc,
                        'userId': userId
                    };

                    event.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: 'classifications/updateData',
                        data: newData,
                        success: function (response) {
                            if (response.sukses == 1) {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The Classification you selected has been successfully updated.',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });

                                PNotify.prototype.options.delay = 1200;

                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            } else {
                                new PNotify({
                                    title: 'Failed!',
                                    text: response.msg,
                                    type: 'danger',
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