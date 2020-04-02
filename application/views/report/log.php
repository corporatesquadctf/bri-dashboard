
<script src="<?= base_url(); ?>assets/bootstrap-select/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap-select/dist/css/bootstrap-multiselect.css" />
<script type="text/javascript" src="<?= base_url(); ?>assets/moment/moment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>template/vendors/bootstrap-daterangepicker/daterangepicker.css" />
<style type="text/css">
    .multiselect {
        width: 200px;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
        background: #fff;
    }

    #checkboxes label {
        padding: 5px;
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
        color: #000;
    }
    #logAction{
        text-align: left;
    }
    .multiselect-container .input-group {
        margin: 5px
            width: 95% !important;
    }
    .daterangepicker .calendar-table th{
        border-radius: 0px;
    }
    thead{
        color: #848484;
    }
    .ranges li {
        background: none;
    }
    .ranges li:hover {
        background: none;
        color: #333;
    }
    .dataTables_paginate {
    float: left !important;
    }
    .dataTables_info {
        width: 40%;
        float: left;
        margin-left: 25px;
    }
    .dataTables_filter {
        width: auto;
        float: right;
        text-align: right;
    }
    thead{
        background-color:#337ab7;
        color: #FFF;
    }
    .update_link{
        vertical-align:middle; 
        text-decoration: underline; 
        color:#337ab7;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Log</li>
                            <li class="breadcrumb-item active" aria-current="page">Application Log</li>
                        </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left" style="margin-left: 5px;">Log Report</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="data2" data-click-to-select="true" 
                            data-show-export="true" 
                            data-search="true" data-toggle="table" 
                            data-toolbar="#toolbar"
                            data-page-list="[10,25,100, 1000]"
                            data-export-options='{
                            "fileName": "Log Report",
                            "ignoreColumn": [8]
                            }'
                            data-pagination="true" class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="cntrl" data-sortable="true">No</th>
                                    <th class="cntrl" data-sortable="true">Level</th>
                                    <th class="cntrl" data-sortable="true">Log Date</th>
                                    <th class="lft" data-sortable="true">Personal ID</th>
                                    <th class="lft" data-sortable="true">Action</th>
                                    <th>Message</th>
                                    <th>Change Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($tb_log as $logs) :
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $logs->Level; ?></td>
                                        <td><?php echo $logs->LogDate; ?></td>
                                        <td><?php echo $logs->CreatedBy; ?></td>
                                        <td><?php echo $logs->Action; ?></td>
                                        <td><?php echo $logs->Message; ?></td>
                                        <td><?php echo $logs->NewValue; ?></td>
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

<script>
    $(document).ready(function () {
        $('#logAction').multiselect({
            nonSelectedText: 'Select Action List',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
        });


    });

</script>

<script type="text/javascript">
    $('#demo').daterangepicker({
        "showDropdowns": true,
        "showWeekNumbers": true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "startDate": "07/12/2018",
        "endDate": "07/18/2018"
    });
</script>