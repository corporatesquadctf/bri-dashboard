<style type="text/css">
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
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
    table { 
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
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #218FD8;
        border-color: #337ab7;
    }
    .div-disabled-action{
        display: inline-flex;
        margin: auto;
        color: #000000;
        opacity: 0.38;
    }
    .div-disabled-action i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-disabled-action label{
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }
    .proses_pipeline::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    .proses_pipeline::-webkit-scrollbar
    {
        width: 7px;
        background-color: #F5F5F5;
    }
    .proses_pipeline::-webkit-scrollbar-thumb
    {
        background-color: #218FD8;
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
                            <li class="breadcrumb-item active" aria-current="page">Approved</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Approved</div>
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
                        <div class="form-group">
                        <?php if($user['ROLE_ID'] != 12 && $user['ROLE_ID'] != 13 && $user['ROLE_ID'] != 14):?>
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
                        <?php if($user['ROLE_ID'] != 12){ ?>
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
                        <?php } ?>
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
                    <form id="approvalPipelineForm" action="<?= base_url().'pipeline/multiple_comment_pipeline'; ?>" method="POST">
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="tbl_approved_pipeline" class="table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:5%; text-align:center;"><input name="select_all" value="1" type="checkbox"></th>
                                            <th style="width:3%;">No.</th>
                                            <th style="width:15%;">Nama Debitur</th>
                                            <th style="width:10%;">Nama RM</th>
                                            <th style="width:10%;">Status Permohonan</th>
                                            <th style="width:12%;">Alamat</th>
                                            <th style="width:10%;">Jenis Usaha</th>
                                            <th style="width:3%;">LPG</th>
                                            <th style="width:5%;">Sumber Debitur</th>
                                            <th style="width:9%;">Usulan Plafond</th>
                                            <th style="width:5%;">Status</th>
                                            <?php if($user['ROLE_ID'] == 12){ ?>
                                                <th style="width:10%;">Action</th>
                                            <?php } ?>
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
                                            
                                            switch($row->StatusId){                                                
                                                case '6': 
                                                    $status = $row->STATUS_NAME;
                                                    $isProcess = "class='div-disabled-action pull-left'"; 
                                                    $isCancel = "class='div-action btn_batal_approved_pipeline pull-left'"; 
                                                    $isMaintain = "class='div-action btn_maintain_approved_pipeline pull-left'";
                                                    $label_status = "style='font-weight: bold; color:#198c19;'";
                                                    break;
                                                case '7': $status = $row->STATUS_NAME; 
                                                    $isProcess = "class='div-disabled-action pull-left'"; 
                                                    $isCancel = "class='div-disabled-action pull-left'"; 
                                                    $isMaintain = "class='div-disabled-action pull-left'";
                                                    $label_status = "style='font-weight: bold; color:#cc0000;'";
                                                    break;
                                                case '8': 
                                                    $status = $row->STATUS_NAME; 
                                                    $isProcess = "class='div-action btn_proses_approved_pipeline pull-left'"; 
                                                    $isCancel = "class='div-action btn_batal_approved_pipeline pull-left'"; 
                                                    $isMaintain = "class='div-disabled-action pull-left'";
                                                    $label_status = "style='font-weight: bold; color:#eaea32;'";
                                                    break;
                                                default : 
                                                    $status = "";
                                                    $isProcess = "class='div-action btn_proses_approved_pipeline pull-left'"; 
                                                    $isCancel = "class='div-action btn_batal_approved_pipeline pull-left'"; 
                                                    $isMaintain = "class='div-action btn_maintain_approved_pipeline pull-left'";
                                                    $label_status = ''; 
                                                    break;
                                            }

                                            switch($row->CustomerResouceId){
                                                case '1': $tdb_status = 'TDB'; break;
                                                case '2': $tdb_status = 'Non TDB'; break;
                                                default: $tdb_status = ''; break;
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $row->PipelineId; ?></td>
                                                <td><?= $i; ?></td>
                                                <td><a style="color:#218FD8; text-decoration:underline;" href="<?= base_url().'pipeline/approved_detail/'.$row->PipelineId; ?>"><?= $row->CustomerName; ?></a></td>
                                                <td><?= $row->RM_NAME; ?></td>
                                                <td><?= $row->DataSourceName; ?></td>
                                                <td><?= $row->Address; ?></td>
                                                <td><?= $row->BusinessType; ?></td>
                                                <td><?= $lpg; ?></td>
                                                <td><?= $tdb_status; ?></td>
                                                <td><label style="font-weight:normal;" class="money" data-a-sep="," data-a-dec="."><?= $row->Plafond; ?></label></td>
                                                <td><label <?= $label_status; ?>><?= $status; ?></label></td>
                                                <?php if($user['ROLE_ID'] == 12){ ?>
                                                <td>
                                                    <div <?php echo $isProcess; ?> data-id="<?= $row->PipelineId; ?>" data-realisasi="<?= $row->BulanRealisasi; ?>" data-jangkawaktu="<?= $row->JangkaWaktu; ?>">
                                                        <i class="material-icons">send</i>
                                                        <label>Proses</label>
                                                    </div><br/>
                                                    <!--
                                                    <div <?php echo $isMaintain; ?> data-id="<?= $row->PipelineId; ?>">
                                                        <i class="material-icons">pause_circle_filled</i>
                                                        <label>Tunda</label>
                                                    </div><br/>
                                                    -->
                                                    <div <?php echo $isCancel; ?> data-id="<?= $row->PipelineId; ?>">
                                                        <i class="material-icons">cancel</i>
                                                        <label>Batal</label>
                                                    </div>
                                                </td>
                                                <?php } ?>                                                
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
                        <div class="modal fade modal-comment-pipeline" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Komentar</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            <div class="col-xs-12">
                                                <p>Tuliskan pesan yang ingin anda berikan:</p>
                                                <textarea id="comment" name="comment" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                                        <button id="btn_confirm_comment_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade modal-proses-pipeline" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                                    </div>
                                    <div class="modal-body proses_pipeline" style="height: 500px; overflow-y: auto;">
                                        <form action="<?= base_url().'pipeline/proses_pipeline'; ?>" id="form_proses_pipeline" method="post">
                                            <input type="hidden" id="pipeline_id" name="pipeline_id" />
                                            <div class="row form-group">
                                                <div class="col-xs-12">
                                                    <p style="font-weight: bold; color: #000;">Bulan Realisasi:</p>
                                                    <select id="realisasi" name="realisasi" class="js-example-basic-single form-control" style="width:100%;"></select>
                                                </div>
                                            </div>
                                            <p style="font-weight: bold; color: #000; margin-top: 15px;">Surat Permohonan</p>
                                            <div class="row form-group">
                                                <div class="col-xs-12">
                                                    <p style="font-weight: bold; color: #000;">Jangka Waktu (Bulan):</p>
                                                    <input class="form-control periode" type="text" id="jangka_waktu" name="jangka_waktu" value="" required />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-xs-12">
                                                    <p style="font-weight: bold; color: #000;">Fasilitas:</p>
                                                    <input type="hidden" id="data_fasilitas_permohonan" name="data_fasilitas_permohonan" value="" />
                                                    <div id="fasilitas_permohonan"></div>
                                                </div>
                                                <button id="btn_add_fasilitas" class="btn w150 btn-sm btn-primary" type="button" onclick="addPermohonanFacility();" style="margin:10px;">Tambah Fasilitas</button>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-xs-12">
                                                    <p style="font-weight: bold; color: #000;">Plafond Usulan:</p>
                                                    <input class="form-control total" type="text" id="plafond_permohonan" name="plafond_permohonan" data-a-dec="." data-a-sep="," value="" readonly />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btn_confirm_proses_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Mulai</button>
                                        <button id="btn_confirm_simpan_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade modal-batal-pipeline" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Komentar</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url().'pipeline/batal_pipeline'; ?>" id="form_batal_pipeline" method="post">
                                        <div class="row form-group">
                                            <div class="col-xs-12">
                                                <input type="hidden" id="pipeline_id" name="pipeline_id" />
                                                <p>Anda akan membatalkan pipeline. Berikan alasan anda:</p>
                                                <textarea id="comment" name="comment" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                                        <button id="btn_confirm_batal_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade modal-maintain-pipeline" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Komentar</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url().'pipeline/maintain_pipeline'; ?>" id="form_maintain_pipeline" method="post">
                                        <div class="row form-group">
                                            <div class="col-xs-12">
                                                <input type="hidden" id="pipeline_id" name="pipeline_id" />
                                                <p>Anda akan menunda proses prakarsa pipeline. Berikan alasan:</p>
                                                <textarea id="comment" name="comment" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                                        <button id="btn_confirm_maintain_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                                    </div>
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
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-checkbox/js/dataTables.checkboxes.min.js"></script>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script>
    var base_url = "<?= base_url(); ?>";
    var hide = 0;
    function updateDataTableSelectAllCtrl(table){
        var $table             = table.table().node();
        var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

        if($chkbox_checked.length === 0){
            chkbox_select_all.checked = false;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }
        } else if ($chkbox_checked.length === $chkbox_all.length){
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }
        } else {
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = true;
            }
        }
    }

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
                        value: item.id,
                        text: item.name
                    },'</option>'));
                })
            }
            jQuery(".loaderImage").hide();
        })    
    }

    function getFasilitasPermohonan(pipelineId){
        $("#fasilitas_permohonan").empty();
        $("#plafond_permohonan").autoNumeric("set","");
        
        var fasilitasPermohonan = "";
        $.getJSON(base_url+'pipeline/serviceGetFasilitasPermohonan/'+pipelineId, function (data){
            //console.log(data);
            if(data.length > 0){
                var i = 0;
                var total_plafond = 0;
                var data_fasilitas_permohonan = "";
                $.each(data, function(index, item){
                    fasilitasPermohonan += "<div class='row fasilitas_"+i+"'>";
                    fasilitasPermohonan += "    <div class='col-xs-5'>";
                    fasilitasPermohonan += "        <div class='form-group'>";
                    fasilitasPermohonan += "            <select id='fasilitas_permohonan_"+i+"' name='fasilitas_permohonan_"+i+"' class='js-example-basic-single form-control' style='width:100%;'>";
                    fasilitasPermohonan += "                <?= $facility_option; ?>";
                    <?php 
                        foreach($fasilitasOption as $row):
                    ?>
                    var selected = "";
                    if(<?= $row->FacilityId;?> == item.FacilityId) selected = "selected";
                    fasilitasPermohonan += "<option value='<?= $row->FacilityId; ?>' "+selected+"><?= $row->FacilityName; ?></option>";
                    <?php
                        endforeach;
                    ?>fasilitasPermohonan += "            </select>";
                    fasilitasPermohonan += "        </div>";
                    fasilitasPermohonan += "    </div>";
                    fasilitasPermohonan += "    <div class='col-xs-6'>";
                    fasilitasPermohonan += "        <div class='form-group'>";
                    fasilitasPermohonan += "            <input type='text' placeholder='Plafond' style='height:39px; text-align:right;' class='form-control money' id='plafond_"+i+"' name='plafond_"+i+"' data-a-dec='.' data-a-sep=',' value='"+item.Plafond+"' onchange='calculatePlafond();' required />";
                    fasilitasPermohonan += "        </div>";
                    fasilitasPermohonan += "    </div>";
                    if(i != 0){
                    fasilitasPermohonan += "    <div class='col-xs-1'>";
                    fasilitasPermohonan += "        <div class='form-group' style='margin-bottom:0px;'>";
                    fasilitasPermohonan += "            <div class='div-action pull-left'>";
                    fasilitasPermohonan += "                <div style='padding-left:0px; margin-top:7px;'>";
                    fasilitasPermohonan += "                    <i class='material-icons' style='font-size:24px;' onclick='removePermohonanFacility("+index+");'>delete</i>";
                    fasilitasPermohonan += "                </div>";
                    fasilitasPermohonan += "            </div>";
                    fasilitasPermohonan += "        </div>";
                    fasilitasPermohonan += "    </div>";
                    }
                    fasilitasPermohonan += "</div>";
                    data_fasilitas_permohonan += i+",";
                    total_plafond += Number(item.Plafond);
                    i++;
                });
                var dataFasilitasPermohonan = data_fasilitas_permohonan.substring(0, data_fasilitas_permohonan.length - 1);
                $("#data_fasilitas_permohonan").val(dataFasilitasPermohonan);
                $("#plafond_permohonan").autoNumeric("set", total_plafond);
            }else{
                fasilitasPermohonan += "<div class='row fasilitas_0'>";
                fasilitasPermohonan += "    <div class='col-xs-5'>";
                fasilitasPermohonan += "        <div class='form-group'>";
                fasilitasPermohonan += "            <select id='fasilitas_permohonan_0' name='fasilitas_permohonan_0' class='js-example-basic-single form-control' style='width:100%;'>";
                fasilitasPermohonan += "                <?= $facility_option; ?>";
                fasilitasPermohonan += "            </select>";
                fasilitasPermohonan += "        </div>";
                fasilitasPermohonan += "    </div>";
                fasilitasPermohonan += "    <div class='col-xs-6'>";
                fasilitasPermohonan += "        <div class='form-group'>";
                fasilitasPermohonan += "            <input type='text' placeholder='Plafond' style='height:39px; text-align:right;' class='form-control money' id='plafond_0' name='plafond_0' data-a-dec='.' data-a-sep=',' onchange='calculatePlafond();' required />";
                fasilitasPermohonan += "        </div>";
                fasilitasPermohonan += "    </div>";
                fasilitasPermohonan += "</div>";

                $("#data_fasilitas_permohonan").val(0);
            }
            $("#fasilitas_permohonan").append(fasilitasPermohonan);
            $(".js-example-basic-single").select2();
            $(".money").autoNumeric("init",{
                vMax: "999999999999",
            });
            jQuery(".loaderImage").hide();
        });
    }

    function addPermohonanFacility(){
        var data_fasilitas_permohonan = $("#data_fasilitas_permohonan").val();
        var arr_data_fasilitas_permohonan = data_fasilitas_permohonan.split(",");
        var index = Number(arr_data_fasilitas_permohonan[arr_data_fasilitas_permohonan.length - 1]) + 1;
        
        var fasilitasPermohonan = "";
        fasilitasPermohonan += "<div class='row fasilitas_"+index+"'>";
        fasilitasPermohonan += "    <div class='col-xs-5'>";
        fasilitasPermohonan += "        <div class='form-group'>";
        fasilitasPermohonan += "            <select id='fasilitas_permohonan_"+index+"' name='fasilitas_permohonan_"+index+"' class='js-example-basic-single form-control' style='width:100%;'>";
        fasilitasPermohonan += "                <?= $facility_option; ?>";
        fasilitasPermohonan += "            </select>";
        fasilitasPermohonan += "        </div>";
        fasilitasPermohonan += "    </div>";
        fasilitasPermohonan += "    <div class='col-xs-6'>";
        fasilitasPermohonan += "        <div class='form-group'>";
        fasilitasPermohonan += "            <input type='text' placeholder='Plafond' style='height:39px; text-align:right;' class='form-control money' id='plafond_"+index+"' name='plafond_"+index+"' data-a-dec='.' data-a-sep=',' onchange='calculatePlafond();' required />";
        fasilitasPermohonan += "        </div>";
        fasilitasPermohonan += "    </div>";
        fasilitasPermohonan += "    <div class='col-xs-1'>";
        fasilitasPermohonan += "        <div class='form-group' style='margin-bottom:0px;'>";
        fasilitasPermohonan += "            <div class='div-action pull-left'>";
        fasilitasPermohonan += "                <div style='padding-left:0px; margin-top:7px;'>";
        fasilitasPermohonan += "                    <i class='material-icons' style='font-size:24px;' onclick='removePermohonanFacility("+index+");'>delete</i>";
        fasilitasPermohonan += "                </div>";
        fasilitasPermohonan += "            </div>";
        fasilitasPermohonan += "        </div>";
        fasilitasPermohonan += "    </div>";
        fasilitasPermohonan += "</div>";

        $("#fasilitas_permohonan").append(fasilitasPermohonan);
        $(".js-example-basic-single").select2();
        $(".money").autoNumeric("init",{
            vMax: "999999999999",
        });

        data_fasilitas_permohonan += ","+index;
        $("#data_fasilitas_permohonan").val(data_fasilitas_permohonan);

        var total_fasilitas = arr_data_fasilitas_permohonan.length + 1;
        if(total_fasilitas == 5)
            $("#btn_add_fasilitas").prop("disabled", true);
    }

    function removePermohonanFacility(index){
        $(".fasilitas_"+index).remove();

        var data_fasilitas_permohonan = $("#data_fasilitas_permohonan").val();
        var arr_data_fasilitas_permohonan = data_fasilitas_permohonan.split(",");

        var x = data_fasilitas_permohonan.replace(","+index,"");
        $("#data_fasilitas_permohonan").val(x);

        calculatePlafond();

        var total_fasilitas = arr_data_fasilitas_permohonan.length - 1;
        if(total_fasilitas < 5)
            $("#btn_add_fasilitas").prop("disabled", false);
    }

    function calculatePlafond(){
        var data_fasilitas_permohonan = $("#data_fasilitas_permohonan").val();
        var arr_data_fasilitas_permohonan = data_fasilitas_permohonan.split(",");

        var total_plafond = 0;
        for(var i=0; i<arr_data_fasilitas_permohonan.length; i++){
            var index = arr_data_fasilitas_permohonan[i];
            var plafond = $("#plafond_"+index).autoNumeric("get");
            total_plafond = total_plafond + Number(plafond);
        }

        $("#plafond_permohonan").autoNumeric("set",total_plafond);
    }

    $(document).ready(function() {
        $(".money").autoNumeric("init",{
            vMax: "999999999999",
        });
        $(".total").autoNumeric("init",{
            vMax: "9999999999990",
        });
        $(".periode").autoNumeric("init",{
            vMin: "0",
            vMax: "99",
        });
        $('.js-example-basic-single').select2();
        var user_role = <?php echo $user['ROLE_ID']; ?>;
        if(user_role == <?= USER_ROLE_KADIV ?>){
            var visible = true;
            var display = "";
        }else {            
            var visible = false;
            var display = "no_display"
        }

        var rows_selected = [];
        var table = $('#tbl_approved_pipeline').DataTable({
            'bLengthChange': false,
            'dom': 'rt<"bottom"pi><"comment_div">',
            'pageLength': 10,
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'width': '1%',
                'className': 'dt-body-center',
                'visible' : visible,
                'render': function (data, type, full, meta){
                    return '<input type="checkbox">';
                }
            }],
            'ordering': false,
            'order': [[1, 'asc']],
            'rowCallback': function(row, data, dataIndex){
                var rowId = data[0];
                
                if($.inArray(rowId, rows_selected) !== -1){
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        <?php if($this->session->ROLE_ID == USER_ROLE_KADIV): ?>
        $("div.comment_div").html('<button id="btn_comment_pipeline" class="btn w150 btn-sm btn-primary pull-right '+display+'" style="margin-right:0px;" type="button" data-toggle="modal" data-target=".modal-comment-pipeline" disabled>Komentar</button>');
        <?php endif; ?>

        $('#tbl_approved_pipeline tbody').on('click', 'input[type="checkbox"]', function(e){
            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var rowId = data[0];
            var index = $.inArray(rowId, rows_selected);

            if(this.checked && index === -1){
                rows_selected.push(rowId);

            } else if (!this.checked && index !== -1){
                rows_selected.splice(index, 1);
            }

            if(this.checked){
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            updateDataTableSelectAllCtrl(table);
            e.stopPropagation();

            if(rows_selected.length != 0){
                $('#btn_comment_pipeline').prop("disabled", false); 
            }else{
                $('#btn_comment_pipeline').prop("disabled", true);
            }

        });

        $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
            if(this.checked){
                $('#tbl_approved_pipeline tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#tbl_approved_pipeline tbody input[type="checkbox"]:checked').trigger('click');
            }
            e.stopPropagation();
        });

        table.on('draw', function(){
            updateDataTableSelectAllCtrl(table);
        });

        $('#uker_id').change(function(){
            var uker_id =  this.value;
            updateRMOption(uker_id);
        });

        $('#btn_confirm_comment_pipeline').click(function(e){
            var form = $("#approvalPipelineForm");
            var comment = $(".modal-comment-pipeline #comment").val();
            $.each(rows_selected, function(index, rowId){
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });
            
            $(form).append('<input type="hidden" name="comment" value="'+comment+'" /> ');

            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#approvalPipelineForm").attr("action"),
                data: $("#approvalPipelineForm").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-comment-pipeline").modal("hide");
                    $(".loaderImage").show();
                },
                success: function(response){
                    $(".loaderImage").hide();
                        if(response.status === "success"){
                        new PNotify({
                            title: "Success!",
                            text: response.message,
                            type: "success",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                        setTimeout(function(){ 
                            window.location.href= "<?= base_url("pipeline/approved"); ?>";
                        }, 2000);                
                    }else if(response.status === "error"){
                        new PNotify({
                            title: "Error!",
                            text: response.message,
                            type: "error",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $(".loaderImage").hide();
                    $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                    $(".modal-error-notification").modal("show");
                }
            });
        });

        $('#tbl_approved_pipeline tbody').on('click', '.btn_proses_approved_pipeline', function () {
            jQuery(".loaderImage").show();
            var pipelineId = $(this).data('id');
            getFasilitasPermohonan(pipelineId);
            var bulanRealisasiId = $(this).data("realisasi");
            var jangka_waktu = $(this).data("jangkawaktu");
            var option = "";
            $('#realisasi').empty();
            <?php 
                $currentMonth = date('n');
                foreach($month as $row):
                    if($row['value'] < $currentMonth) continue;
            ?>
                    var selected = "";
                    if(<?= $row["value"];?> == bulanRealisasiId) selected = "selected";
                    option += "<option value='<?= $row['value']; ?>' "+selected+"><?= $row['name']; ?></option>";
            <?php
                endforeach;
            ?>
            $('#realisasi').append(option);
            $("#jangka_waktu").val(jangka_waktu);
            
            $('.modal-proses-pipeline #pipeline_id').val(pipelineId);
            $('.modal-proses-pipeline').modal('show');
        });

        $.validator.addMethod("plafondRestriction", function(value, element) {
            var plafond = $('#plafond_permohonan').autoNumeric("get");
            if(plafond <= <?= MIN_PLAFOND; ?> || plafond >= <?= MAX_PLAFOND; ?>){
                return false;
            }else return true;
        }, "Must between <?= number_format(MIN_PLAFOND);?> - <?= number_format(MAX_PLAFOND); ?>");

        $("#form_proses_pipeline").validate({
            rules: {
                plafond_permohonan: {
                    required: true,
                    plafondRestriction: true
                },
            },
            messages:{}
        });

        $('#btn_confirm_proses_pipeline').click(function(e){
            if($("#form_proses_pipeline").valid()){
                $('#form_proses_pipeline').append('<input type="hidden" name="isProcess" value="1" /> ');
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#form_proses_pipeline").attr("action"),
                    data: $("#form_proses_pipeline").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-proses-pipeline").modal("hide");
                        $(".loaderImage").show();
                    },
                    success: function(response){
                        $(".loaderImage").hide();
                        if(response.status === "success"){
                            new PNotify({
                                title: "Success!",
                                text: response.message,
                                type: "success",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function(){ 
                                window.location.href= "<?= base_url("pipeline/approved"); ?>";
                            }, 2000);                
                        }else if(response.status === "error"){
                            new PNotify({
                                title: "Error!",
                                text: response.message,
                                type: "error",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function(){ 
                                window.location.href= "<?= base_url("pipeline/approved"); ?>";
                            }, 2000); 
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $(".loaderImage").hide();
                        $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                        $(".modal-error-notification").modal("show");
                    }
                });
            }            		
        });

        $('#btn_confirm_simpan_pipeline').click(function(e){
            $('#form_proses_pipeline').append('<input type="hidden" name="isProcess" value="0" /> ');
            if($("#form_proses_pipeline").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#form_proses_pipeline").attr("action"),
                    data: $("#form_proses_pipeline").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-proses-pipeline").modal("hide");
                        $(".loaderImage").show();
                    },
                    success: function(response){
                        $(".loaderImage").hide();
                        if(response.status === "success"){
                            new PNotify({
                                title: "Success!",
                                text: response.message,
                                type: "success",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function(){ 
                                window.location.href= "<?= base_url("pipeline/approved"); ?>";
                            }, 2000);                
                        }else if(response.status === "error"){
                            new PNotify({
                                title: "Error!",
                                text: response.message,
                                type: "error",
                                styling: "bootstrap3"
                            });
                            PNotify.prototype.options.delay = 1200;
                            setTimeout(function(){ 
                                window.location.href= "<?= base_url("pipeline/approved"); ?>";
                            }, 2000); 
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $(".loaderImage").hide();
                        $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                        $(".modal-error-notification").modal("show");
                    }
                });
            }            
        });
        
        $('#tbl_approved_pipeline tbody').on('click', '.btn_batal_approved_pipeline', function () {
            var pipelineId = $(this).data('id');
            $('.modal-batal-pipeline #comment').val("");
            $('.modal-batal-pipeline #pipeline_id').val(pipelineId);
            $('.modal-batal-pipeline').modal('show');
        });

        $('#btn_confirm_batal_pipeline').click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#form_batal_pipeline").attr("action"),
                data: $("#form_batal_pipeline").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-batal-pipeline").modal("hide");
                    $(".loaderImage").show();
                },
                success: function(response){
                    $(".loaderImage").hide();
                    if(response.status === "success"){
                        new PNotify({
                            title: "Success!",
                            text: response.message,
                            type: "success",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                        setTimeout(function(){ 
                            window.location.href= "<?= base_url("pipeline/approved"); ?>";
                        }, 2000);                
                    }else if(response.status === "error"){
                        new PNotify({
                            title: "Error!",
                            text: response.message,
                            type: "error",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                        setTimeout(function(){ 
                            window.location.href= "<?= base_url("pipeline/approved"); ?>";
                        }, 2000); 
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $(".loaderImage").hide();
                    $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                    $(".modal-error-notification").modal("show");
                }
            });
        });

        /*
        $('.btn_maintain_approved_pipeline').click(function(){
            var pipelineId = $(this).data('id');
            
            $('.modal-maintain-pipeline #pipeline_id').val(pipelineId);
            $('.modal-maintain-pipeline').modal('show');
        });

        $('#btn_confirm_maintain_pipeline').click(function(){
            $('#modal-maintain-pipeline').modal('hide');
            setTimeout(function(){ 
                $('#form_maintain_pipeline').submit();
            }, 500);		
        });
        */
        
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