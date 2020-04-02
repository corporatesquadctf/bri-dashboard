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
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #218FD8;
        border-color: #337ab7;
    }
    .search-form{
        margin-bottom: 0px;
        font-weight: normal;
    }
    table{ 
        border-collapse: separate; 
        border-spacing: 0 10px; 
        margin-top: -10px;
    }
    thead{
        color:#218FD8;
    }
    thead tr{
        background-color:#F7F7F7;
        box-shadow: none;
    }
    tr{
        box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    tr th{
        border: none !important;
    }
    td {
        border: 1px solid #ddd;
        border-style: solid none;
        padding: 10px;
        background: #FFF;        
    }
    td>a:hover{
        font-weight:bold;
    }
    td:first-child{
        border-left-style: solid;
        border-top-left-radius: 4px; 
        border-bottom-left-radius: 4px;
    }
    td:last-child{
        border-right-style: solid;
        border-bottom-right-radius: 4px; 
        border-top-right-radius: 4px; 
    }
</style>
<div class="right_col" role="main">    
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Pipeline</li>
                            <li class="breadcrumb-item active" aria-current="page">Submitted</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Submitted</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="padding:1px 0px;">
                        <ul class="nav navbar-right panel_toolbox" style="min-width:0px;">
                            <li><a class="collapse-link btn btn-sm w150 btn-default" style="margin-bottom:0px;"><label class="search-form">Hide Filter</label></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <form id="updatePipelineForm" method="POST" class="form-horizontal form-label-left">
                        <?php if($user['ROLE_ID'] != 12 && $user['ROLE_ID'] != 13 && $user['ROLE_ID'] != 14):?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uker_id">Unit Kerja</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="uker_id" name="uker_id" style="width:100%;">
                                    <?php
                                    if($user['ROLE_ID'] == 15 || $user['ROLE_ID'] == 16)
                                        echo '<option value="0" >Semua Unit Kerja</option>';
                                    foreach ($uker_option as $row){
                                        $selected = '';
                                        if($uker_id == $row->UnitKerjaId) $selected = 'selected="selected"';
                                        echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->Name.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rm_id">Nama RM</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="rm_id" name="rm_id" style="width:100%;">
                                    <option value="0">Semua RM</option>
                                    <?php
                                    foreach ($rm_option as $row){
                                        $selected = '';
                                        if($rm_id == $row->UserId) $selected = 'selected="selected"';
                                        echo '<option value="'.$row->UserId.'" '.$selected.'>'.$row->Name.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php if($user['ROLE_ID'] == 16): ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uker_id">Sektor Usaha</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="sektorUsahaId" name="sektorUsahaId" style="width:100%;">
                                    <option value="0">Semua Sektor Usaha</option>
                                    <?php
                                        foreach ($sektor_usaha_option as $row){
                                            $selected = '';
                                            if($sektorUsahaId == $row->SegmentationId) $selected = 'selected="selected"';
                                            echo '<option value="'.$row->SegmentationId.'" '.$selected.'>'.$row->SegmentationName.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <?php endif; ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Pencarian</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="keyword" name="keyword" class="form-control col-md-7 col-xs-12" value="<?= $keyword; ?>" placeholder="Ketik Keyword">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
                                <button id="btn_filter_pipeline" class="btn w150 btn-sm btn-primary pull-left" style="margin-right:0px;" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background:none; border:none; padding: 0px;">
                    <div class="x_content">

                        <form id="approvalPipelineForm" action="<?= base_url().'pipeline/approval_pipeline'; ?>" method="POST">
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="tbl_submitted_pipeline" class="table table-striped table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">No.</th>
                                            <th style="width:20%;">Nama Debitur</th>
                                            <th style="width:15%;">Nama RM</th>
                                            <th style="width:10%;">Status Permohonan</th>
                                            <th style="width:20%;">Alamat</th>
                                            <th style="width:10%;">Jenis Usaha</th>
                                            <th style="width:3%;">LPG</th>
                                            <th style="width:5%;">Sumber Debitur</th>
                                            <th style="width:9%;">Usulan Plafond</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 1;
                                        foreach($pipeline as $row){
                                            switch($row->LPGStatus){
                                                case '1': $lpg = '<i id="lpg_red" class="fa fa-square" style="color:#E74545"></i>'; break;
                                                case '2': $lpg = '<i id="lpg_yellow" class="fa fa-square" style="color:#FFEF9D"></i>'; break;
                                                case '3': $lpg = '<i id="lpg_green" class="fa fa-square" style="color:#62D159"></i>'; break;
                                                case '4': $lpg = '<i id="lpg_blue" class="fa fa-square" style="color:#218FD8"></i>'; break;
                                                default: $ews = ''; break;
                                            }
                                            switch($row->CustomerResouceId){
                                                case '1': $tdb_status = 'TDB'; break;
                                                case '2': $tdb_status = 'Non TDB'; break;
                                                default: $tdb_status = ''; break;
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><a style="color:#218FD8; text-decoration:underline;" href="<?= base_url().'pipeline/detail/'.$row->PipelineId; ?>"><?= $row->CustomerName; ?></a></td>
                                                <td><?= $row->RM_NAME; ?></td>
                                                <td><?= $row->DataSourceName; ?></td>
                                                <td><?= $row->Address; ?></td>
                                                <td><?= $row->BusinessType; ?></td>
                                                <td><?= $lpg; ?></td>
                                                <td><?= $tdb_status; ?></td>
                                                <td><label style="font-weight:normal;" class="money" data-a-sep="," data-a-dec="."><?= $row->Plafond; ?></label></td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-checkbox/js/dataTables.checkboxes.min.js"></script>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script>
    var base_url = "<?= base_url(); ?>";
    var hide = 0;
    
    function updateRMOption(uker_id){
        jQuery(".loaderImage").show();  
        var dropdownRM = $('#rm_id');
        dropdownRM.empty();
        dropdownRM.append($('<option>',
        {
            value: 0,
            text: 'Semua RM'
        },'</option>'));
        $.getJSON(base_url+'pipeline/serviceGetRM/'+uker_id, function (data){
            if(data.length > 0){
                $.each(data, function(index, item){
                    dropdownRM.append($('<option>',
                    {
                        value: item.UserId,
                        text: item.Name
                    },'</option>'));
                })
            }
            jQuery(".loaderImage").hide();
        })    
    }

    $(document).ready(function() {
        $('.money').autoNumeric('init');
        $('.js-example-basic-single').select2();

        var rows_selected = [];
        var table = $('#tbl_submitted_pipeline').DataTable({
            'bLengthChange': false,
            'dom': 'rt<"bottom"pi><"approve_div">',
            'pageLength': 10,
            'ordering': false,
            'order': [[0, 'asc']]
        });

        $('div.dataTables_filter input').removeClass('input-sm');
        $('div.dataTables_filter input').css('border-radius','25px');

        $('#uker_id').change(function(){
            var uker_id =  this.value;
            updateRMOption(uker_id);
        });
        
        $('.collapse-link').click(function(){
            if(hide == 0){
                $('.search-form').html('Show Filter');
                hide = 1;
            }else{
                $('.search-form').html('Hide Filter');
                hide = 0;
            }
        });
    });   
</script>