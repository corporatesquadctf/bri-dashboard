<!-- <script src="<?= base_url(); ?>assets/bootstrap-datetimepicker-master/js/moment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/bootstrap-datetimepicker-master/js/datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" /> -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/jquery-ui/jquery-ui.css" /> 
<script type="text/javascript" src="<?= base_url(); ?>assets/jquery-ui/jquery-ui.js"></script>

<style type="text/css">
    .rata_kanan{
        text-align: right;
    }
    .daterangepicker .calendar-table th, .daterangepicker .calendar-table td{
        border-radius: 0px !important;
    }
    .ui-datepicker-calendar {
        display: none;
    }
    .ui-widget-header {
        background: #337ab7;
        color: #333333;
        font-weight: bold;
    }
    div.dataTables_wrapper div.dataTables_info {
        display: none;
    }
</style>
<script>
    var masterDivisi = {};
</script>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Timeseries Performance</h3>
            </div>
            <div class="pull-right lbl-million">
                <p></p> * In Milion
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <p>
                        <a class="btn btn-primary pull-right" data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="collapseExample">
                          Filter Report<!-- <span class="glyphicon glyphicon-chevron-down"></span>  -->
                        </a>
                    </p>
                    <div class="collapse" id="filter">
                        <div class="col-md-3">
                            <label for="startDate">Select Divisi :</label>
                            <select class="selectpicker form-control" data-live-search="true" id="divisi" name="divisi" value="<?php echo $_SESSION['DIVISION']; ?>">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="startDate">Date :</label>
                            <input name="startDate" id="startDate" class="date-picker form-control" />
                        </div>
                        <div class="col-md-3">
                            <label for="startDate">To :</label>
                            <input name="endDate" id="endDate" class="date-picker-end form-control" />
                        </div>

                    </div>
                    <br>


                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profit <small>Users</small></h2>
                        <div class="clearfix"></div>

                        <div id="toolbar">
                            <select class="form-control" >

                                <option value="all">Export All</option>
                                <option value="">Export Basic</option>
                                <option value="selected">Export Selected</option>
                            </select>

                            <button onClick ="$('#data2').tableExport({type: 'excel', escape: 'false', fileName: 'Division', exportDataType: 'all'});"> Download Excel </button>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="datatable"
                               class="table table-striped table-bordered" 
                               data-pagination="true"
                               data-show-export="true" 
                               data-search="true" data-toggle="table" 
                               data-toolbar="#toolbar"
                               data-page-list="[5,8,10,13]"
                               data-export-options='{
                               "fileName": "Profit",
                               "ignoreColumn": []
                               }'
                               >
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="index">No</th>
                                    <th data-sortable="true" data-field="dates">Date</th>
                                    <th data-sortable="true" data-field="profit" data-class="rata_kanan">Profit</th>
                                    <th data-sortable="true" data-field="delta" data-class="rata_kanan">Delta</th>
                                    <th data-sortable="true" data-field="percent" data-class="rata_kanan">Percentage</th>

                                </tr>
                            </thead>


                            <tbody id="profitBody">
                                <!--
                                    <tr>
                                        <td>1</td>
                                        <td>1 May 2017</td>
                                        <td>3.500</td>
                                        <td>10%</td>
                                        <td>18%</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>31 May 2017</td>
                                        <td>4.500</td>
                                        <td>15%</td>
                                        <td>9%</td>
                                    </tr>
                                -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Outsanding <small>Users</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable1" 
                               class="table table-striped table-bordered" 
                               data-pagination="true"
                               data-show-export="true" 
                               data-search="true" data-toggle="table" 
                               data-toolbar="#toolbar"
                               data-page-list="[5,8,10,13]"
                               data-export-options='{
                               "fileName": "Outstanding",
                               "ignoreColumn": []
                               }'
                               >
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="index">No</th>
                                    <th data-sortable="true" data-field="dates">Date</th>
                                    <th data-sortable="true" data-field="outstanding" data-class="rata_kanan">Outstanding</th>
                                    <th data-sortable="true" data-field="delta" data-class="rata_kanan">Delta</th>
                                    <th data-sortable="true" data-field="percent" data-class="rata_kanan">Percentage</th>

                                </tr>
                            </thead>


                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fee Income <small>Users</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable2" 
                               class="table table-striped table-bordered" 
                               data-pagination="true"
                               data-show-export="true" 
                               data-search="true" data-toggle="table" 
                               data-toolbar="#toolbar"
                               data-page-list="[5,8,10,13]"
                               data-export-options='{
                               "fileName": "Profit",
                               "ignoreColumn": []
                               }'
                               >
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="index">No</th>
                                    <th data-sortable="true" data-field="dates">Date</th>
                                    <th data-sortable="true" data-field="fee_income" data-class="rata_kanan">Fee Income</th>
                                    <th data-sortable="true" data-field="delta" data-class="rata_kanan">Delta</th>
                                    <th data-sortable="true" data-field="percent" data-class="rata_kanan">Percentage</th>

                                </tr>
                            </thead>


                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Interest Income <small>Users</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable3" 
                               class="table table-striped table-bordered" 
                               data-pagination="true"
                               data-show-export="true" 
                               data-search="true" data-toggle="table" 
                               data-toolbar="#toolbar"
                               data-page-list="[5,8,10,13]"
                               data-export-options='{
                               "fileName": "Profit",
                               "ignoreColumn": []
                               }'
                               >
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="index">No</th>
                                    <th data-sortable="true" data-field="dates">Date</th>
                                    <th data-sortable="true" data-field="interest" data-class="rata_kanan">Interest Income</th>
                                    <th data-sortable="true" data-field="delta" data-class="rata_kanan">Delta</th>
                                    <th data-sortable="true" data-field="percent" data-class="rata_kanan">Percentage</th>

                                </tr>
                            </thead>


                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>NPL <small>Users</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable4" 
                               class="table table-striped table-bordered" 
                               data-pagination="true"
                               data-show-export="true" 
                               data-search="true" data-toggle="table" 
                               data-toolbar="#toolbar"
                               data-page-list="[5,8,10,13]"
                               data-export-options='{
                               "fileName": "Profit",
                               "ignoreColumn": []
                               }'
                               >
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="index">No</th>
                                    <th data-sortable="true" data-field="dates">Date</th>
                                    <th data-sortable="true" data-field="npl" data-class="rata_kanan">NPL</th>
                                    <th data-sortable="true" data-field="delta" data-class="rata_kanan">Delta</th>
                                    <th data-sortable="true" data-field="percent" data-class="rata_kanan">Percentage</th>

                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1 May 2017</td>
                                    <td>3.500</td>
                                    <td>10%</td>
                                    <td>18%</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>31 May 2017</td>
                                    <td>4.500</td>
                                    <td>15%</td>
                                    <td>9%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>
    <input id="dateAwal" type="hidden" val="">
    <input id="dateAkhir" type="hidden" val="">
</div>
<!-- /page content -->
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript">
                                $(function () {
                                    $('.date-picker').datepicker({
                                        changeMonth: true,
                                        changeYear: true,
                                        showButtonPanel: true,
                                        dateFormat: 'MM yy',
                                        onClose: function (dateText, inst) {
                                            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                                            let a = inst.selectedMonth + 1;
                                            $("#dateAwal").val(inst.selectedYear + '-' + a + '-01');
                                            loadData();
                                        },
                                        onSelect: function () {
                                            $(this).change();
                                        }
                                    }).datepicker("setDate", "-13m");
                                });

                                $(function () {
                                    $('.date-picker-end').datepicker({
                                        changeMonth: true,
                                        changeYear: true,
                                        showButtonPanel: true,
                                        dateFormat: 'MM yy',
                                        onClose: function (dateText, inst) {
                                            $(".date-picker-end").datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                                            let a = inst.selectedMonth + 1;
                                            loadData();
                                        },
                                        onSelect: function () {
                                            $(this).change();
                                        }
                                    }).datepicker("setDate", new Date());
                                });
</script>
<script type="text/javascript">
    var loadData = function () {
        var url = '<?= base_url('/rest/timeseries/get_data') ?>';
        var division = $("#divisi").val();
        let dateAwal = $(".date-picker").val();
        let dateAkhir = $(".date-picker-end").val();
        if (dateAwal == "") {
            dateAwal = "2017-01"
        }
        if (dateAkhir == "") {
            dateAkhir = "2018-01"
        }
        var request = {
            start: dateAwal,
            end: dateAkhir,
            division: division
        };
        request = JSON.stringify(request);

        var success = function (res) {
            masterDivisi = res.divisi;
            $('#divisi').empty();
            $('#divisi').append($('<option></option>').val('0').html('Choose a Division'));
            $.each(res.masterDivisi, function (i, p) {
                if (res.divisiNow == p.id) {
                    $('#divisi').append($('<option selected></option>').val(p.id).html(p.division_name));
                } else {
                    $('#divisi').append($('<option></option>').val(p.id).html(p.division_name));
                }
            });
            $('#divisi').val(res.divisiNow);
            if (res.restricted) {
                $('#divisi').attr('disabled', true);
            }

            $('#datatable').bootstrapTable({
                data: res.profit
            });
            $('#datatable').bootstrapTable("load", res.profit);
            $('#datatable1').bootstrapTable({
                data: res.outstanding
            });
            $('#datatable1').bootstrapTable("load", res.outstanding);
            $('#datatable2').bootstrapTable({
                data: res.fee_income
            });
            $('#datatable2').bootstrapTable("load", res.fee_income);
            $('#datatable3').bootstrapTable({
                data: res.interest
            });
            $('#datatable3').bootstrapTable("load", res.interest);
            $('#datatable4').bootstrapTable({
                data: res.npl
            });
            $('#datatable4').bootstrapTable("load", res.npl);
            new PNotify({
                title: 'Success!',
                text: "Data Loaded",
                type: 'success',
                styling: 'bootstrap3',
                delay: 500
            });
        };

        $.post(url, request, success);
    };
    $(window).load(function () {
        /*
         if($(".pagination-info") && $(".pagination-info")[0]){
         $(".pagination-info")[0].innerHTML = "Showing 1 to <?= $index - 1 ?> of <?= $index - 1 ?> ";
         };*/
        loadData();
    });
    $('#divisi').on('change', function () {
        loadData();
    });
</script>
