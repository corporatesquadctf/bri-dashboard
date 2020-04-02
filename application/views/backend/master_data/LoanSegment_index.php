<style type="text/css">
    .cntrl {
        text-align: center;
    }

    .lft {
        text-align: left;
    }
    .fixed-table-container{
        border-top: none;
    }
    .dataTables_info , .dataTables_paginate{display: none;}
    thead{
        background-color:#337ab7;
        color: #FFF;
    }
</style>


<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Loan Segment</li>
                        </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left" style="margin-left: 5px;">Loan Segment</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="pull-right">
                            <button id="addBtn" class="btn w150 btn-sm btn-primary pull-right addBtn" data-toggle="modal" data-target="#add_LoanSegment" type="button">Add New</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <!-- <div id="toolbar">
                            <select class="form-control">
                                <option value="">Export Basic</option>
                                <option value="all" selected="true">Export All</option>
                                <option value="selected">Export Selected</option>
                            </select>
                        </div> -->
                        <table id="data1 section-to-print" data-toggle="table" data-pagination="true" data-search="true"
                                data-page-size="10"
                                data-page-list="[10, 50, ALL]"
                                data-toolbar="#toolbar"
                                data-click-to-select="true"
                                data-show-export="true"
                                data-export-options='{
                                "fileName": "MasterLoanSegment",
                                "ignoreColumn": [7]

                                }'
                                class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="cntrl" data-sortable="true">No</th>
                                    <th class="lft" data-sortable="true">Loan Segment Name</th>
                                    <th class="lft" data-sortable="true">EL</th>
                                    <th class="lft" data-sortable="true">EAD</th>
                                    <th class="cntrl" data-sortable="true">Status</th>
                                    <th class="cntrl" data-sortable="true">Created On</th>
                                    <th class="cntrl">Created By</th>
                                    <th class="cntrl" data-sortable="true">Last Modified</th>
                                    <th class="cntrl">Modified By</th>
                                    <th class="cntrl">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($LoanSegment as $k) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $k->SegmentName; ?></td>
                                        <td><span class="money"><?php echo $k->AmountEL; ?></span></td>
                                        <td><span class="money"><?php echo $k->AmountEAD; ?></span></td>
                                        <td>
                                            <?php
                                            if ($k->IsActive == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Not Active";
                                            };
                                            ?>
                                        </td>
                                        <td class="cntrl"><?php
                                            $CreatedDate = $k->CreatedDate;
                                            if ($CreatedDate) {
                                                $addon = new DateTime($k->CreatedDate);
                                                echo $addon->format('d/m/Y H:i:s');
                                            } else {
                                                echo '-';
                                            }
                                            ?></td>
                                        <td class="cntrl"><?php echo $k->CreatedBy; ?></td>
                                        <td class="cntrl"><?php
                                            $modion = $k->ModifiedDate;
                                            if ($modion) {
                                                $modifiedOn = new DateTime($modion);
                                                echo $modifiedOn->format('d/m/Y H:i:s');
                                            } else {
                                                echo '-';
                                            }
                                            ?></td>
                                        <td class="cntrl"><?php echo ($k->ModifiedBy) ? $k->ModifiedBy : '-'; ?></td>
                                        <td>
                                            <div
                                                class="div-action pull-left editBtn" 
                                                data-toggle="modal"
                                                data-target="#modal_<?php echo $k->SektorEkonomiRarocId; ?>"
                                                data-id="<?php echo $k->SektorEkonomiRarocId; ?>">
                                                <i class="material-icons">edit</i>
                                                <label>Edit</label>
                                            </div>
                                            <div
                                                class="div-action pull-left btnDel" 
                                                data-toggle="modal"
                                                data-target="#delModal_<?php echo $k->SektorEkonomiRarocId; ?>" 
                                                data-id="<?php echo $k->SektorEkonomiRarocId; ?>">
                                                <i class="material-icons">delete</i>
                                                <label>Delete</label>
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
</div>

<!-- MODAL UPDATE -->
<div class="modal fade" id="add_LoanSegment" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Loan Segment</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="form_LoanSegment" method="GET">
                    <div class="form-group">
                        <label for="SegmentName" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Segment Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="SegmentName" id="SegmentName" class="form-control textOnly" minlength="2" placeholder="Input new Loan Segment name here...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AmountEL" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Amount EL</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="AmountEL" id="AmountEL" class="form-control money" minlength="2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AmountEAD" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Amount EAD</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="AmountEAD" id="AmountEAD" class="form-control money" minlength="2">
                        </div>
                    </div>
                    <div class="pull-right" style="padding-right: 5px;">
                        <input type="hidden" id="currentUser" name="currentUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                        <!-- <button id="saveBtn" type="button" class="btn btn-primary btn-sm saveBtn" onclick="myFunction()">Save</button> -->
                        <input type="submit" class="btn btn-primary btn-sm saveBtn" value="Submit">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>

<?php foreach ($LoanSegment as $k) : ?>
    <div id="modal_<?php echo $k->SektorEkonomiRarocId; ?>" class="modal fade SegmentModal" role="dialog" >
        <div class="modal-dialog">
            <!-- MODAL CONTENT -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Loan Segment</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left" id="form_LoanSegment_<?php echo $k->SektorEkonomiRarocId; ?>">
                        <div class="form-group">
                            <label for="editSegmentName" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Segment Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" name="editSegmentName" id="editSegmentName" class="form-control textOnly" value="<?php echo $k->SegmentName; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editAmountEL" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Amount EL</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" name="editAmountEL" id="editAmountEL" class="form-control money" minlength="2" value="<?php echo $k->AmountEL; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editAmountEAD" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Amount EAD</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" name="editAmountEAD" id="editAmountEAD" class="form-control money" minlength="2" value="<?php echo $k->AmountEAD; ?>">
                            </div>
                        </div>
                        <div class="pull-right" style="padding-right: 5px;">
                        <input type="hidden" id="curUser" name="curUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                            <input type="hidden" id="editSektorEkonomiRarocId" name="editSektorEkonomiRarocId" value="<?php echo $k->SektorEkonomiRarocId; ?>">
                            <button id="saveBtn" type="button" class="btn btn-primary btn-sm saveBtn" onclick="myFunction()">Save</button>
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- MODAL DELETE -->
<?php foreach ($LoanSegment as $k) : ?>
    <div id="delModal_<?php echo $k->SektorEkonomiRarocId; ?>" class="modal fade deleteModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" >Delete Loan Segment</h4>
                </div>
                <div class="modal-body">
                    <p> Are you sure to delete this data? </p>
                    <input type="hidden" id="curUser" name="curUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                    <input type="hidden" id="delSektorEkonomiRarocId" name="delSektorEkonomiRarocId">
                </div>
                <div class="modal-footer">
                    <button id="yesBtn" type="button" class="btn btn-success btn-sm" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>                               
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
    $(document).ready(function() {

        $('.money').autoNumeric('init',{
          aForm: true,
          mDec: '0',
          vMax: '<?=MAX_NUMERIC?>',
          vMin: '<?=MIN_NUMERIC?>',
          aPad: false,
          unformatOnSubmit: true
        });
    });


function myFunction() {
    var x, text;

    // Get the value of the input field with id="numb"
    x = document.getElementById("editSegmentName").value;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x) || x < 1 || x > 10) {
        text = "Input not valid";
    } else {
        text = "Input OK";
    }
}
</script>
<script type="text/javascript">

    $(window).load(function () {
        // UPDATE
        $(document).on('click', '.editBtn', function (event) {
            var row = $(this).closest('tr');
            var nrow = row[0];

            //$('#editSektorEkonomiRarocId').val($(this).data('id'));

            var getModal = $($(this).data("target"))[0];
            modalId = '#' + getModal.id;

            $(document).on('shown.bs.modal', modalId, function (e) {
                $(modalId + ' ' + '#saveBtn').on('click', function () {
                    // var SektorEkonomiRarocId = $('#editSektorEkonomiRarocId').val();
                    var SektorEkonomiRarocId = $(modalId + ' ' + '#editSektorEkonomiRarocId').val();
                    var SegmentName = $(modalId + ' ' + '#editSegmentName').val();
                    var AmountEL = $(modalId + ' ' + '#editAmountEL').val();
                    var AmountEAD = $(modalId + ' ' + '#editAmountEAD').val();
                    var userId = $('#curUser').val();
                    var newData = {
                        'SektorEkonomiRarocId': SektorEkonomiRarocId,
                        'SegmentName': SegmentName,
                        'AmountEL': AmountEL,
                        'AmountEAD': AmountEAD,
                        'userId': userId
                    };

                    var form = '#form_LoanSegment_'+SektorEkonomiRarocId;
                    event.preventDefault();
                    if (SegmentName.trim() == "") {
                        new PNotify({
                            title: 'Notification!',
                            text: 'You must fill the Loan Segment Name',
                            type: 'danger',
                            styling: 'bootstrap3'
                        });

                        PNotify.prototype.options.delay = 3000;
                        return;
                    }
                    // console.log(SektorEkonomiRarocId);
                    // console.log(SegmentName);
                    // console.log(Amount);
                    // console.log(userId);
                    // console.log(newData);
                    // console.log(form);

                    $.ajax({
                        type: 'POST',
                        url: 'LoanSegment/updateData',
                        // data: $(form).serialize(),
                        data: newData,
                        dataType : 'json',
                        beforeSend:function(){
                            $("#modal_<?= $k->SektorEkonomiRarocId ?>").modal('hide');
                            $('.loaderImage').show();
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                          $('.loaderImage').hide();
                          new PNotify({
                              title: 'Error Thrown!',
                              text: "Message : "+errorThrown,
                              type: 'error',
                              styling: 'bootstrap3'
                          });

                          PNotify.prototype.options.delay = 3000;
                        },
                        success: function (response) {
                          $('.loaderImage').hide();
                            if (response.status == 'success') {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The Loan Segment you selected has been successfully updated.<br>New Loan Segment name is <b>' + SegmentName + '</b>',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                PNotify.prototype.options.delay = 3000;

                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            }
                            else if (response.status == 'error') {
                                new PNotify({
                                    title: 'Response Error!',
                                    text: response.message,
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });

                                PNotify.prototype.options.delay = 3000;

                                setTimeout(function () {
                                    //location.reload();
                                }, 3000);
                            }
                        }
                    });
                });
            });
        });

        // DELETE
        $(document).on('click', '.btnDel', function (j) {
            var row = $(this).closest('tr');
            var nrow = row[0];

            $('#delSektorEkonomiRarocId').val($(this).data('id'));

            var modal = $($(this).data('target'))[0];
            modalId = '#' + modal.id;

            $(document).on('shown.bs.modal', modalId, function (e) {
                $(modalId + ' ' + '#yesBtn').on('click', function (event) {
                    var SektorEkonomiRarocId = $('#delSektorEkonomiRarocId').val();
                    var userId = $('#curUser').val();

                    var data = {
                        'SektorEkonomiRarocId': SektorEkonomiRarocId,
                        'userId': userId
                    };

                    event.preventDefault();

                    // console.log(SektorEkonomiRarocId);
                    // console.log(userId);
                    // console.log(data);

                    $.ajax({
                        type: 'POST',
                        url: 'LoanSegment/deleteData',
                        data: data,
                        dataType : 'json',
                        beforeSend:function(){
                            $("#delModal_<?= $k->SektorEkonomiRarocId ?>").modal('hide');
                            $('.loaderImage').show();
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                          $('.loaderImage').hide();
                          new PNotify({
                              title: 'Error Thrown!',
                              text: "Message : "+errorThrown,
                              type: 'error',
                              styling: 'bootstrap3'
                          });

                          PNotify.prototype.options.delay = 3000;
                        },
                        success: function (response) {
                          $('.loaderImage').hide();
                            if (response.status == 'success') {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'The Loan Segment you selected has been successfully deleted',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                PNotify.prototype.options.delay = 3000;

                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            }
                            else if (response.status == 'error') {
                                new PNotify({
                                    title: 'Response Error!',
                                    text: response.message,
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });

                                PNotify.prototype.options.delay = 3000;

                                setTimeout(function () {
                                    //location.reload();
                                }, 3000);
                            }
                        }
                    });
                });
            });
        });
    });

</script>
<script>
    $(window).load(function () {
        $('.textOnly').on('keydown', function (e) {
            -1 !== $.inArray(e.keyCode, [32, 46, 8, 9, 27, 13, 110, ]) || (/65|67|86|88/.test(e.keyCode) && (e.ctrlKey === true || e.metaKey === true)) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (65 > e.keyCode || 90 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
        $('#toolbar').find('select').on('change', function (e) {
            $('#data1').bootstrapTable('destroy').bootstrapTable({
                exportDataType: $(this).val()
            });
        });
    });

    $('#form_LoanSegment').validate({
        debug: true,
        rules: {
            SegmentName: {
                required: true
            }
        },
        messages: {
            SegmentName: {
                required: "Please enter Loan Segment Name..."
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "LoanSegment/insertNew",
                data: $(form).serialize(),
                dataType : 'json',
                beforeSend:function(){
                  $('#add_LoanSegment').hide();
                  $('.loaderImage').show();
                },
                error: function(jqXHR, textStatus, errorThrown){
                  $('.loaderImage').hide();
                  new PNotify({
                      title: 'Error Thrown!',
                      text: "Message : "+errorThrown,
                      type: 'error',
                      styling: 'bootstrap3'
                  });

                  PNotify.prototype.options.delay = 3000;
                },
                success: function (response) {
                  $('.loaderImage').hide();
                    if (response.status == 'success') {
                        new PNotify({
                            title: 'Success!',
                            text: 'New Loan Segment has been saved successfuly.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });

                        PNotify.prototype.options.delay = 3000;

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                    else if (response.status == 'error') {
                        new PNotify({
                            title: 'Response Error!',
                            text: response.message,
                            type: 'error',
                            styling: 'bootstrap3'
                        });

                        PNotify.prototype.options.delay = 3000;

                        setTimeout(function () {
                            //location.reload();
                        }, 3000);
                    }
                }
            });
        }
    });

</script>
<script type="text/javascript">
    function printini() {
        window.print();
    }
</script>