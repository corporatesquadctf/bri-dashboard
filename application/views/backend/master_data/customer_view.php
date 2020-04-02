<script type="text/javascript">
    var globalParam = "all";
</script>
<div class="right_col" role="main">
    <div class="container">
        <div class="row" id="indexDiv">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Customer</h2>
                        <div class="pull-right">
                            <button id="addBtn" class="btn btn-success btn-sm addBtn" type="button" data-toggle="modal" data-target="#add_">
                                <i class="fa fa-plus"></i>&nbsp;
                                <b>Add New</b>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div id="toolbar">
                            <select class="form-control">
                                <option value="">Export Basic</option>
                                <option value="all" selected="true">Export All</option>
                                <option value="selected">Export Selected</option>
                            </select>
                        </div>
                        <div id="toolbar2 col-xs-12">
                            <div class="col-xs-3" style=" margin-top: 10px;">
                                <select id="new_or_old" class="form-control">
                                    <option value="all" selected>All</option>
                                    <option value="new">New Customer</option>
                                    <option value="old">Customer</option>
                                </select>
                            </div>
                        </div>
                        <table id="data1" data-toggle="table" data-pagination="true" data-search="true"
                               data-page-size="10"
                               data-page-list="[10, 50, ALL]"
                               data-toolbar="#toolbar"
                               data-click-to-select="true"
                               data-show-export="true"
                               data-export-options='{
                               "fileName": "Mastercustomer",
                               "ignoreColumn": [7]

                               }'
                               class="table table-condensed table-striped table-hover">
                            <thead style="background-color: #012D5A; color: #FFF;">
                                <tr>
                                    <th class="cntrl" data-sortable="true" data-field="index">No</th>
                                    <th class="lft" data-sortable="true" data-field="CNAME">Customer Name</th>
                                    <th class="cntrl" data-sortable="true" data-field="GNAME">Group Name</th>
                                    <th class="cntrl" data-events="removeEvents" data-formatter="action_field" data-field="status_vcif">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL INSERT -->
<div class="modal fade" id="add_" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Customer</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="customerForm" method="GET">
                    <div class="form-group">
                        <label for="Group Name" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Customer Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="hidden" id="currentUser" name="currentUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                            <input type="text" name="custName" id="custName" class="form-control textOnly" minlength="2" placeholder="Input Customer name here...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Account Name" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Group Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <select id="groupName" class="form-control" >
                                <option value="0">Please Select</option>
                                <option value="1">Create New</option>
                                <?php foreach ($group as $gr) : ?> 
                                    <option value="<?= $gr->id ?>">
                                        <?= $gr->nama ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <label id="groupNameLabel" for="Group Name" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left hide">Group Name</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" name="groupNameInput" id="groupNameInput" class="form-control textOnly hide" minlength="2" placeholder="Input account customer name here...">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 pull-right" style="margin-top: 20px">
                        <!-- <input type="button" class="btn btn-sm btn-danger" id="cancelBtn" value="Cancel" onclick="this.form.reset();"> -->
                        <input id="addThis" type="submit" class="btn btn-sm btn-success form-control" data-dismiss="modal" value="Submit">
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

<!-- MODAL EDIT -->
<div class="modal fade" id="edit_" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Customer</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="customerForm" method="GET">
                    <div class="form-group">
                        <label for="Group Name" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Customer Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="hidden" id="edit_id" name="edit_id" value="">
                            <input type="text" name="edit_name" id="edit_name" class="form-control textOnly" minlength="2" placeholder="Input Customer name here...">
                        </div>
                        <label id="groupNameLabel" for="Group Name" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left hide">Group Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="groupNameInput" id="groupNameInput" class="form-control textOnly hide" minlength="2" placeholder="Input account customer name here...">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 pull-right" style="margin-top: 20px">
                            <!-- <input type="button" class="btn btn-sm btn-danger" id="cancelBtn" value="Cancel" onclick="this.form.reset();"> -->
                            <input id="editThis" type="submit" class="btn btn-sm btn-success form-control" data-dismiss="modal" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>

<script type="text/javascript">
    $('#add_').on('shown.bs.modal', function () {
        $("#custName").focus();
    })
    $('#edit_').on('shown.bs.modal', function () {
        $("#edit_name").focus();
    })
    $("#groupName").on('change', function (e) {
        let a = $(this).val();
        if (a == 1) {
            $("#groupNameLabel").removeClass("hide");
            $("#groupNameInput").removeClass("hide");
            $("#groupNameInput").focus();
        } else {
            $("#groupNameLabel").addClass("hide");
            $("#groupNameInput").addClass("hide");
        }
    })
    var loadData = function (param = 'all') {
        var url = '<?= base_url('/rest/customer/get_customer') ?>';
        var request = {
            param: param
        };
        request = JSON.stringify(request);

        var success = function (res) {
            $('#data1').bootstrapTable({
                data: res.cust
            });
            $('#data1').bootstrapTable("load", res.cust);
        }
        $.post(url, request, success);
    };
    $("#editThis").on('click', function (e) {
        e.preventDefault();
        var url = '<?= base_url('/rest/customer/edit_customer') ?>';
        var id = $("#edit_ #edit_id").val();
        var name = $("#edit_ #edit_name").val();
        var request = {
            id: id,
            nama: name
        };
        request = JSON.stringify(request);
        let success = function (res) {
            if (res.error == 0) {
                loadData()
                //Render Notif
                new PNotify({
                    title: 'Success!',
                    text: "Data Edited",
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 500
                });
            } else {
                new PNotify({
                    title: 'Failed!',
                    text: res.msg,
                    type: 'danger',
                    styling: 'bootstrap3',
                    delay: 500
                });
            }
        };
        $.post(url, request, success);
    })
    $("#addThis").on('click', function (e) {
        e.preventDefault();
        var url = '<?= base_url('/rest/customer/add_customer') ?>';
        var custName = $("#custName").val();
        var groupName = $("#groupName").val();
        var groupNameInput = $("#groupNameInput").val();
        var request = {
            cust: custName,
            group_id: groupName,
            group_name: groupNameInput
        };
        request = JSON.stringify(request);
        let success = function (res) {
            if (res.error == 0) {
                //Render select Box
                $('#groupName').empty();
                $('#groupName').append($('<option></option>').val('0').html('Please Select'));
                $('#groupName').append($('<option></option>').val('1').html('Create New'));
                $.each(res.group, function (i, p) {
                    $('#groupName').append($('<option></option>').val(p.id).html(p.nama));
                });
                loadData()
                //Render Notif
                new PNotify({
                    title: 'Success!',
                    text: "Data Added",
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 500
                });
            } else {
                new PNotify({
                    title: 'Failed!',
                    text: res.msg,
                    type: 'danger',
                    styling: 'bootstrap3',
                    delay: 500
                });
            }
        };
        $.post(url, request, success);
    })
    $("#new_or_old").on('change', function (e) {
        loadData($(this).val());
    })
    $(window).load(function () {
        loadData();
    });
    var action_field = function (value, row) {
        if (row.new == 1 && value == 1) {
            return '<button class="btn-primary edit_this">Edit</button> <button class="btn-danger remove_this">Remove</button>';
        } else if (row.new == 1 && value == 0) {
            return '<button class="btn-primary edit_this">Edit</button><button class="btn-warning un_remove_this">UnRemove</button>';
        }
    };
    window.removeEvents = {
        'click .remove_this': function (e, value, row) {
            var url = '<?= base_url('/rest/customer/remove_new_customer') ?>';
            var request = {
                id: row.par_vcif_id,
            };
            request = JSON.stringify(request);

            var success = function (res) {
                if (res.error == 0) {
                    new PNotify({
                        title: 'Success!',
                        text: "Data Removed",
                        type: 'success',
                        styling: 'bootstrap3',
                        delay: 500
                    });
                    loadData();
                } else {
                    new PNotify({
                        title: 'Failed!',
                        text: res.msg,
                        type: 'danger',
                        styling: 'bootstrap3',
                        delay: 500
                    });
                }
            }
            $.post(url, request, success);
        },
        'click .un_remove_this': function (e, value, row) {
            var url = '<?= base_url('/rest/customer/un_remove_new_customer') ?>';
            var request = {
                id: row.par_vcif_id,
            };
            request = JSON.stringify(request);

            var success = function (res) {
                if (res.error == 0) {
                    new PNotify({
                        title: 'Success!',
                        text: "Data UnRemoved",
                        type: 'success',
                        styling: 'bootstrap3',
                        delay: 500
                    });
                    loadData();
                } else {
                    new PNotify({
                        title: 'Failed!',
                        text: res.msg,
                        type: 'danger',
                        styling: 'bootstrap3',
                        delay: 500
                    });
                }
            }
            $.post(url, request, success);
        },
        'click .edit_this': function (e, value, row) {
            $("#edit_ #edit_id").val(row.par_vcif_id);
            $("#edit_ #edit_name").val(row.CNAME);
            $('#edit_').modal('show');
        }
    };
</script>