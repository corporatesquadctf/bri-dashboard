<style type="text/css">
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
    }
    .update_link{
        vertical-align:middle; 
        text-decoration: underline; 
        color:#337ab7;
    }

</style>
<script type="text/javascript">
    function manual_import() {
        $.ajax({type: "GET",
            url: "<?= base_url($link_import)?>",
            data: '',
            beforeSend: function() {
                $('.loaderImage').show();
            },
            success:function(result) {
                $('.loaderImage').hide();
                location.reload();
            },
            error:function(result) {
              alert('error');
            }
        });
    }
 
</script>
<div class="right_col" role="main">

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Log</li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url(html_escape($links));?>"><?= html_escape($title); ?></a></li>
                        </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left" ><?= html_escape($title); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#scheduler" id="scheduler-tab" role="tab" data-toggle="tab" aria-expanded="true">Scheduler</a>
                                </li>
                                <li role="presentation" class=""><a href="#manual" role="tab" id="manual-tab" data-toggle="tab" aria-expanded="false">Manual</a>
                                </li>
                            </ul>
                            <div class="tab-content col-xs-12" id="myTabContent">
                                <div role="tabpanel" class="tab-pane fade active in" id="scheduler" aria-labelledby="scheduler-tab">
                                            <div class="bs-bars pull-right" style="vertical-align: bottom; line-height: 57px; height: 57px; margin-left: 5px;">
                                                <button type="button" class="btn btn-primary w150" onclick="manual_import();" id="manual_import_button">Manual Import</button>
                                            </div>
                                    
                                    <table id="data2" 
                                        data-click-to-select="true" 
                                        data-sortable="true"
                                        data-show-export="true" 
                                        data-search="true" 
                                        data-toggle="table" 
                                        data-toolbar="#toolbar"
                                        data-page-list="[10,25,100, 1000]"
                                        data-export-options='{
                                        "fileName": "<?= html_escape($title); ?>",
                                        "ignoreColumn": [8]
                                        }'
                                        data-pagination="true" 
                                        class="table table-condensed table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;" data-sortable="true">No.</th>
                                                <th style="width:10%;" data-sortable="true">Tanggal</th>
                                                <th style="width:10%;" data-sortable="true">Waktu</th>
                                                <th style="width:20%;" data-sortable="true">Nama Prosedur</th>
                                                <th style="width:15%;" data-sortable="true">Status</th>
                                                <!-- <th style="width:5%;">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            foreach($log_list_scheduler as $row_scheduler){
                                                switch($row_scheduler['IsSuccess']){
                                                    case 0: 
                                                        $IsSuccess = '<i class="fa fa-times-circle" title="Failed" style="color:#f82d2d; font-size: 19px;"></i> Failed'; 
                                                        break;
                                                    default: 
                                                        $IsSuccess = '<i class="fa fa-check-circle" title="Success" style="color: #57d62b; font-size: 19px;"></i> Success'; 
                                                        break;
                                                }

                                        ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= date("j F Y", strtotime($row_scheduler['CreatedDate'])); ?></td>
                                                    <td><?= date("g:i a", strtotime($row_scheduler['CreatedDate'])); ?></td>
                                                    <td><?= $row_scheduler['ProcedureName']; ?></td>
                                                    <td><?= $IsSuccess; ?></td>
                                                    <!-- <td><a href="<?= base_url('scheduled-scripts/script-import-monitoring/import_monitoring.php?procedure=0')?>" target="_blank"><i class="fa fa-paper-plane"> Import</i></a></td> -->
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="manual" aria-labelledby="manual-tab">
                                    <table id="data2" 
                                        data-click-to-select="true" 
                                        data-sortable="true"
                                        data-show-export="true" 
                                        data-search="true" 
                                        data-toggle="table" 
                                        data-toolbar="#toolbar"
                                        data-page-list="[10,25,100, 1000]"
                                        data-export-options='{
                                        "fileName": "<?= html_escape($title); ?>",
                                        "ignoreColumn": [8]
                                        }'
                                        data-pagination="true" 
                                        class="table table-condensed table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;" data-sortable="true">No.</th>
                                                <th style="width:10%;" data-sortable="true">Tanggal</th>
                                                <th style="width:10%;" data-sortable="true">Waktu</th>
                                                <th style="width:20%;" data-sortable="true">Nama Prosedur</th>
                                                <th style="width:15%;" data-sortable="true">Status</th>
                                                <!-- <th style="width:5%;">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            foreach($log_list_manual as $row_manual){
                                                switch($row_manual['IsSuccess']){
                                                    case 0: 
                                                        $IsSuccess = '<i class="fa fa-times-circle" title="Failed" style="color:#f82d2d; font-size: 19px;"></i> Failed'; 
                                                        break;
                                                    default: 
                                                        $IsSuccess = '<i class="fa fa-check-circle" title="Success" style="color: #57d62b; font-size: 19px;"></i> Success'; 
                                                        break;
                                                }

                                        ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= date("j F Y", strtotime($row_manual['CreatedDate'])); ?></td>
                                                    <td><?= date("g:i a", strtotime($row_manual['CreatedDate'])); ?></td>
                                                    <td><?= $row_manual['ProcedureName']; ?></td>
                                                    <td><?= $IsSuccess; ?></td>
                                                    <!-- <td><a href="<?= base_url('scheduled-scripts/script-import-monitoring/import_monitoring.php?procedure=0')?>" target="_blank"><i class="fa fa-paper-plane"> Import</i></a></td> -->
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>
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
</div>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
