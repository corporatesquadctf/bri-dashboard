<style type="text/css">
    .content-container{
        padding: 0; 
        background: #FBFBFB; 
        margin-top: 0px;
    }
    .no-margin{
        margin: 0;
    }
    .customer-header{
        margin-top: 10px;
        padding: 10px 25px;
        background: #FFF;
        box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);
    }
    .show-more {
        margin: 0;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        background: #218FD8;
        box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
        cursor: pointer;
    }
    .show-more a {
        display: block;
        padding: 5px;
        color: #FFF;
        text-align: center;
    }
    .show-more label {
        cursor: pointer;
        font-size: 12px;
        font-weight: normal;
        margin-bottom:0;
    }
    table {
        width: 100%;
    }
    thead {
        background: #FFFFFF;
        box-shadow: 0px 4px 4px #EDEDED;
        border-radius: 5px 5px 0px 0px;        
    }
    th {
        border: 1px solid #ddd;
        color: #4BB8FF;
        font-size: 12px;
        padding: 8px;
    }
    tbody tr {
        box-shadow: 0 4px 4px #EDEDED;
    }
    td {
        background: #FFFFFF;
        min-height: 56px;
        color: #8F8F8F;
        font-size: 12px;
        padding: 8px;

        vertical-align: top;
        border: 1px solid #ddd;
    }
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    .search-form{
        margin-bottom: 0px;
        font-weight: normal;
    }
    .div-action{
        font-size: 12px;
        float: inherit;
    }
    /*
    .div-action{
        display: inline-flex;
        margin: auto;
        color: #218FD8;
        float: inherit;
    }
    .div-action i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-action label{
        font-size: 12px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 2px;
    }
    .div-action:hover i, .div-action:hover label{
        cursor: pointer;
        font-weight: bold;
    }
    */
    .div-disabled-action{
        display: inline-flex;
        margin: auto;
        color: #000000;
        opacity: 0.38;
        float: inherit;
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
    .proses_portofolio::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    .proses_portofolio::-webkit-scrollbar
    {
        width: 7px;
        background-color: #F5F5F5;
    }
    .proses_portofolio::-webkit-scrollbar-thumb
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
                            <li class="breadcrumb-item">Portofolio</li>
                            <li class="breadcrumb-item active">Portofolio RM</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Portofolio RM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="padding:1px 0px;">
                        <ul class="nav navbar-right panel_toolbox" style="min-width:0px;">
                            <li>
                                <a class="collapse-link btn w150 btn-sm btn-default" style="margin-bottom:0px;"><label class="search-form">Hide Filter</label></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <form id="filterPortofolioRmForm" action="<?=base_url("portofolio/portofolioRm/search");?>" method="POST" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Pencarian</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="keyword" name="keyword" class="form-control col-md-7 col-xs-12" placeholder="Ketik Keyword" value="<?= $keyword; ?>">
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
            <div class="col-xs-12">
                <div class="x_panel no-padding" style="border: none;">
                    <div class="x_content content-container">
                        <?php
                            if(!empty($Customer)){
                                $iPortofolioRm = 0;
                                foreach($Customer as $row):
                                    switch($row->WarnaLPG){
                                        case 'Merah': $lpg = '<i id="lpg_red" class="fa fa-square" style="color:#E74545"></i>'; break;
                                        case 'Kuning': $lpg = '<i id="lpg_yellow" class="fa fa-square" style="color:#FFEF9D"></i>'; break;
                                        case 'Hijau': $lpg = '<i id="lpg_green" class="fa fa-square" style="color:#62D159"></i>'; break;
                                        case 'Biru': $lpg = '<i id="lpg_blue" class="fa fa-square" style="color:#218FD8"></i>'; break;
                                        default: $lpg = ''; break;
                                    }
                        ?>
                        <div class="row no-margin">
                            <div class="col-xs-12 customer-header">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">CIF</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $row->Cif; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Nama Debitur</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $row->CustomerName; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Total Plafond</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;" class="money" data-a-sep="," data-a-dec="."><?= $row->TotalPlafondKredit; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Subsektor Ekonomi</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $row->SubSectorEconomyName; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Alamat</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $row->Address; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">LPG</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $lpg; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="collapsePortofolio_<?= $iPortofolioRm; ?>" style="margin: 10px 0; display: none;">
                            <input type="hidden" id="collapsePortofolioStatus_<?= $iPortofolioRm; ?>" value="0">
                            <div class="col-xs-12" style="padding: 0 20px;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">No. Rekening</th>
                                            <th rowspan="2">Fasilitas</th>
                                            <th rowspan="2" style="text-align:right;">Plafond</th>
                                            <th rowspan="2" style="text-align:center;">EWS</th>
                                            <th rowspan="2" style="text-align:center;">Kolektibilitas</th>
                                            <th rowspan="2">Produk Pinjaman</th>
                                            <th rowspan="2" style="text-align:center;">Restruct</th>
                                            <th colspan="2" style="text-align:center;">Tanggal</th>
                                            <?php if($this->session->ROLE_ID == 12): ?>
                                            <th rowspan="2" style="text-align:center;">Action</th>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center;">Realisasi</th>
                                            <th style="text-align:center;">Jatuh Tempo</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($row->DetailRekeningKredit)):
                                                $iRekening = 1;
                                                foreach($row->DetailRekeningKredit as $rowRekeningKredit):
                                                    switch($rowRekeningKredit->WarnaEWS){
                                                        case 'Merah': $colorCode = 'E74545'; break;
                                                        case 'Kuning': $colorCode = 'FFEF9D'; break;
                                                        case 'Hijau' : $colorCode = '62D159'; break;
                                                        default: $colorCode = ''; break;
                                                    }
                                                    switch($rowRekeningKredit->Status){
                                                        case 1: $restruct = 'Yes'; break;
                                                        default: $restruct = 'No'; break;
                                                    }
                                                    switch($rowRekeningKredit->Kolektibilitas){
                                                        case 1: $colorCodeKolektibilitas = "62D159"; break;
                                                        case 2: $colorCodeKolektibilitas = "EBD618"; break;
                                                        case 3:
                                                        case 4: 
                                                        case 5: $colorCodeKolektibilitas = "E74545"; break;
                                                        default: $colorCodeKolektibilitas = "8F8F8F"; break;
                                                    }
                                                    $dueDate = date("d-m-Y", strtotime($rowRekeningKredit->TglJatuhTempo." -108 months"));
                                                    //$dueDate = date("d-m-Y", strtotime($rowRekeningKredit->TglJatuhTempo." -3 months"));
                                                    $today = date("d-m-Y");
                                                    if(strtotime($dueDate) < strtotime($today)){
                                                        if($rowRekeningKredit->IsProcess == 0) $act = "div-action btn_proses_portofolio";
                                                        else $act = "div-disabled-action";
                                                        $divProcess =  "<div class='".$act."' data-norek='".$rowRekeningKredit->NoRekening."' data-periode='".$rowRekeningKredit->Periode."' data-realisasi='".$rowRekeningKredit->BulanRealisasi."' data-jangkawaktu='".$rowRekeningKredit->JangkaWaktu."'>
                                                                            <i class='material-icons'>send</i>
                                                                            <label>Proses</label>
                                                                        </div>";
                                                    }else $divProcess = "";
                                        ?>
                                        <tr>
                                            <td><?= $iRekening; ?></td>
                                            <td><?= $rowRekeningKredit->NoRekening; ?></td>
                                            <td><?= $rowRekeningKredit->JenisPenggunaan; ?></td>
                                            <td style="text-align: right;"><label style="font-weight:normal;" class="money" data-a-sep="," data-a-dec="."><?= $rowRekeningKredit->PlafonAwal; ?></label></td>
                                            <td style="text-align:center;"><i class="fa fa-square" style="color:#<?= $colorCode; ?>;"></i></td>
                                            <td style="text-align:center; color: #<?= $colorCodeKolektibilitas; ?>"><?= $rowRekeningKredit->Kolektibilitas; ?></td>
                                            <td><?= $rowRekeningKredit->SegmentationName; ?></td>
                                            <td style="text-align:center;"><?= $restruct; ?></td>
                                            <td style="text-align:center;"><?= date("d-m-Y", strtotime($rowRekeningKredit->TglRealisasi)); ?></td>
                                            <td style="text-align:center;"><?= date("d-m-Y", strtotime($rowRekeningKredit->TglJatuhTempo)); ?></td>
                                            <?php if($this->session->ROLE_ID == 12): ?>
                                            <td style="text-align:center;">
                                                <?= $divProcess; ?>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php
                                                $iRekening++;
                                                endforeach;
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-12" style="padding: 0 20px; margin-top: 10px;">
                                <div style="width:100%; background: #FFF;">
                                    <div style="width: 100%; padding: 20px; display: flex;">
                                        <div style="width: 75%;">
                                            <canvas id="canvasKredit_<?= $iPortofolioRm; ?>"></canvas>
                                        </div>
                                        <div style="width: 25%; padding: 20px;">
                                            <table width="100%">
                                                    <tr style="box-shadow: none;">
                                                        <td style="border: none;"></td>
                                                        <td style="border: none;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:bold;">No. Rekening</label></td>
                                                    </tr>
                                                <?php foreach($row->DetailRekeningKredit as $rowRekeningKredit): ?>
                                                    <tr style="box-shadow: none;">
                                                        <td style="border: none;"><i class="fa fa-square" style="margin:0 5px 0  0; color:<?= $rowRekeningKredit->Warna; ?>"></i></td>
                                                        <td style="border: none;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:normal;"><?= $rowRekeningKredit->NoRekening; ?></label></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                    <tr style="box-shadow: none;">
                                                        <td style="border: none;"><i class="fa fa-square" style="margin:0 5px 0  0; color:#FF0000"></i></td>
                                                        <td style="border: none;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:bold;">Ratas Δ Outstanding : <?= $row->AverageDelta; ?></label></td>
                                                    </tr>                                                  
                                            </table>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-xs-12" style="padding: 0 20px; margin-top: 10px;">
                                <div style="width:100%; background: #FFF;">
                                    <div style="width: 100%; padding: 20px; display: flex;">
                                        <div style="width: 75%;">
                                            <canvas id="canvasAvgOs_<?= $iPortofolioRm; ?>"></canvas>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-xs-12" style="padding: 0 20px; margin-top: 10px;">
                                <div style="width:100%; background: #FFF;">
                                    <div style="width: 100%; padding: 20px; display: flex;">
                                        <div style="width: 75%;">
                                            <canvas id="canvasSimpanan_<?= $iPortofolioRm; ?>"></canvas>
                                        </div>
                                        <div style="width: 25%; padding: 20px;">
                                            <table width="100%">
                                                    <tr style="box-shadow: none;">
                                                        <td style="border: none;"></td>
                                                        <td style="border: none;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:bold;">No. Rekening</label></td>
                                                    </tr>
                                                <?php foreach($row->DetailRekeningSimpanan as $rowRekeningSimpanan): ?>
                                                    <tr style="box-shadow: none;">
                                                        <td style="border: none;"><i class="fa fa-square" style="margin:0 5px 0  0; color:<?= $rowRekeningSimpanan->Warna; ?>"></i></td>
                                                        <td style="border: none;"><label class="label_desc" style="margin:0; color:#505D6F; font-weight:normal;"><?= $rowRekeningSimpanan->NoRekening; ?></label></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row show-more" id="rowShowDetailCollapsePortofolio_<?= $iPortofolioRm; ?>" data-id="<?= $iPortofolioRm; ?>">
                            <div class="col-xs-12">
                                <a>
                                    <label id="labelDetailCollapsePortofolio_<?= $iPortofolioRm; ?>">Tampilkan Lebih Banyak<i class="fa fa-chevron-down" style="margin-left:10px;"></i></label>
                                </a>
                            </div>
                        </div>
                        <?php
                                $iPortofolioRm++;
                                endforeach; 
                        ?>
                        <div class="pull-left">
                            <?php if (isset($links)) { ?>
                            <?php echo $links ?>
                            <?php } ?>
                        </div>
                        <?php
                            } else {
                                echo "<div>No data.</div>";
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-proses-portofolio" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                </div>
                <div class="modal-body proses_portofolio" style="height: 450px; overflow-y: auto;">
                    <form action="<?= base_url().'portofolio/portofolioRm/proses_portofolio'; ?>" id="form_proses_portofolio" method="post">
                        <input type="hidden" id="portofolio_no_rekening" name="portofolio_no_rekening" />
                        <input type="hidden" id="portofolio_periode" name="portofolio_periode" />
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
                    <button id="btn_confirm_proses_portofolio" type="button" class="btn w150 btn-primary modal-button-ok">Mulai</button>
                    <button id="btn_confirm_simpan_portofolio" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
    var hide = 1;
    function getFasilitasPermohonan(noRek, periode){
        $("#fasilitas_permohonan").empty();
        $("#plafond_permohonan").autoNumeric("set","");
        
        var fasilitasPermohonan = "";
        var form_data = new FormData();
            form_data.append("noRekening", noRek);
            form_data.append("periode", periode);
        $.ajax({
            url: "<?php echo base_url()."portofolio/portofolioRm/serviceGetFasilitasPermohonan"; ?>",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: "post",
            success	: function (data)
            {
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
            }
        });
        jQuery(".loaderImage").hide();
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
        $(".js-example-basic-single").select2();

        $(".collapse-link").click(function(){
            if(hide == 0){
                $('.search-form').html('Show Filter');
                hide = 1;
            }else{
                $('.search-form').html('Hide Filter');
                hide = 0;
            }
        });

        $(".show-more").click(function(){
            var id = $(this).data('id');
            var collapseStatus = $("#collapsePortofolioStatus_"+id).val();
            if(collapseStatus == 0){
                $("#collapsePortofolioStatus_"+id).val(1);
                $("#labelDetailCollapsePortofolio_"+id).html("Tampilkan Lebih Sedikit <i class='fa fa-chevron-up' style='margin-left:10px;'></i>");
                $("#collapsePortofolio_"+id).fadeIn("slow");                
            }else{
                $("#collapsePortofolioStatus_"+id).val(0);
                $("#labelDetailCollapsePortofolio_"+id).html("Tampilkan Lebih Banyak <i class='fa fa-chevron-down' style='margin-left:10px;'></i>");
                $("#collapsePortofolio_"+id).fadeOut("slow");                
            }
        });

        $(".btn_proses_portofolio").click(function(e){
            jQuery(".loaderImage").show();
            var noRek = $(this).data("norek");
            var periode = $(this).data("periode");
            getFasilitasPermohonan(noRek, periode);
            var bulanRealisasiId = $(this).data("realisasi");
            var jangkaWaktu = $(this).data("jangkawaktu");
            var option = "";
            $("#realisasi").empty();
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
            $("#realisasi").append(option);
            $("#portofolio_no_rekening").val(noRek);
            $("#portofolio_periode").val(periode);
            $("#jangka_waktu").val(jangkaWaktu);
            $(".modal-proses-portofolio").modal("show");
        });

        $.validator.addMethod("plafondRestriction", function(value, element) {
            var plafond = $('#plafond_permohonan').autoNumeric("get");
            if(plafond <= <?= MIN_PLAFOND; ?> || plafond >= <?= MAX_PLAFOND; ?>){
                return false;
            }else return true;
        }, "Must between <?= number_format(MIN_PLAFOND);?> - <?= number_format(MAX_PLAFOND); ?>");

        $("#form_proses_portofolio").validate({
            rules: {
                plafond_permohonan: {
                    required: true,
                    plafondRestriction: true
                },
            },
            messages:{}
        });

        $('#btn_confirm_proses_portofolio').click(function(e){
            $('#form_proses_portofolio').append('<input type="hidden" name="isProcess" value="1" /> ');
            if($("#form_proses_portofolio").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#form_proses_portofolio").attr("action"),
                    data: $("#form_proses_portofolio").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-proses-portofolio").modal("hide");
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
                                window.location.href= "<?= base_url("portofolio/portofolioRm"); ?>";
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
            }            
        });

        $('#btn_confirm_simpan_portofolio').click(function(e){
            $('#form_proses_portofolio').append('<input type="hidden" name="isProcess" value="0" /> ');
            if($("#form_proses_portofolio").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#form_proses_portofolio").attr("action"),
                    data: $("#form_proses_portofolio").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-proses-portofolio").modal("hide");
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
                                window.location.href= "<?= base_url("portofolio/portofolioRm"); ?>";
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
            }            
        });

        /* Config Chart Label */
        var xLabel = [];
        <?php foreach($Labels as $rowLabel): ?>
            xLabel.push("<?= $rowLabel; ?>");
        <?php endforeach; ?>
        
        /* Config Chart for All Customer */
        <?php
            $iCustomer = 0;
            foreach($Customer as $rowCustomer):
        ?>
                /* Config Chart Outstanding Pinjaman */
                var datasetsKreditConfig = [];
                <?php foreach($rowCustomer->DetailRekeningKredit as $rowKredit): ?>
                    var dataKredit = [];
                    <?php foreach($rowKredit->DatasetKredit as $datasetKredit): ?>
                        dataKredit.push("<?= $datasetKredit; ?>");
                    <?php endforeach; ?>
                    datasetsKreditConfig.push({
                        label: "<?= $rowKredit->NoRekening; ?>",
                        fill: false,
                        backgroundColor: "<?= $rowKredit->Warna; ?>",
                        borderColor: "<?= $rowKredit->Warna; ?>",
                        data: dataKredit
                    });                    
                <?php endforeach; ?>
                /* Add Delta Total Outstanding Into Chart */
                var dataDeltaKredit = [];
                <?php foreach($rowCustomer->DetailDeltaKredit as $rowDatasetsDeltaKredit): ?>
                    dataDeltaKredit.push("<?= $rowDatasetsDeltaKredit; ?>");
                <?php endforeach; ?>
                datasetsKreditConfig.push({
                    label: "Total Delta Kredit",
                    fill: false,
                    backgroundColor: "#FF0000",
                    borderColor: "#FF0000",
                    data: dataDeltaKredit
                });
                var kreditConfig = {
                    type: "line",
                    data: {
                        labels: xLabel,
                        datasets: datasetsKreditConfig
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: false
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                            label: function(tooltipItem) {
                                    return (tooltipItem.yLabel).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }
                            }
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Periode",
                                    fontStyle: "bold",
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Outstanding Kredit",
                                    fontStyle: "bold",
                                },
                                ticks: {
                                    //max: 200000000000,
                                    //min: 0,
                                    //stepSize: 25000000000,
                                    callback: function(value, index, values) {
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                }
                            }]
                        }
                    }
                };
                var canvasKredit = document.getElementById('canvasKredit_<?= $iCustomer; ?>').getContext('2d');
                window.myLine = new Chart(canvasKredit, kreditConfig);

                /* Config Chart Average Outstanding Kredit */
                var datasetsAverageOutstandingKreditConfig = [];
                var dataAverageOutstandingKredit = [];
                <?php foreach($rowCustomer->AverageOutstandingKredit as $rowDatasetsAverageOutstandingKredit): ?>
                    dataAverageOutstandingKredit.push("<?= $rowDatasetsAverageOutstandingKredit; ?>");
                <?php endforeach; ?>
                datasetsAverageOutstandingKreditConfig.push({
                    label: "Average Kredit Outstanding",
                    fill: false,
                    backgroundColor: "rgba(25,152,223, 0.5)",
                    borderColor: "rgba(25,152,223)",
                    data: dataAverageOutstandingKredit
                });
                var averageOutstandingKreditConfig = {
                    type: 'bar',
                    data: {
                        labels: xLabel,
                        datasets: datasetsAverageOutstandingKreditConfig
                    },                   
                    options: {
                        responsive: true,
                        legend: {
                                display: false
                        },
                        title: {
                            display: false
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return Number(tooltipItem.yLabel) +" %";
                                }
                            }
                        }, 
                        scales: {
                                xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Periode",
                                        fontStyle: "bold",
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Outstanding Kredit Average (%)",
                                        fontStyle: "bold",
                                    }
                                }]
                            }
                    }
                };
                var canvasAverageKredit = document.getElementById('canvasAvgOs_<?= $iCustomer; ?>').getContext('2d');
                window.myBar = new Chart(canvasAverageKredit, averageOutstandingKreditConfig);
                

                /* Config Chart Instanding Simpanan */
                var datasetsSimpananConfig = [];
                <?php foreach($rowCustomer->DetailRekeningSimpanan as $rowSimpanan): ?>
                    var dataSimpanan = [];
                    <?php foreach($rowSimpanan->DatasetSimpanan as $datasetSimpanan): ?>
                        dataSimpanan.push("<?= $datasetSimpanan; ?>");
                    <?php endforeach; ?>
                    datasetsSimpananConfig.push({
                        label: "<?= $rowSimpanan->NoRekening; ?>",
                        fill: false,
                        backgroundColor: "<?= $rowSimpanan->Warna; ?>",
                        borderColor: "<?= $rowSimpanan->Warna; ?>",
                        data: dataSimpanan
                    });                    
                <?php endforeach; ?>
                var simpananConfig = {
                        type: "line",
                        data: {
                            labels: xLabel,
                            datasets: datasetsSimpananConfig
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: false
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                label: function(tooltipItem) {
                                        return (tooltipItem.yLabel).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                }
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Periode",
                                        fontStyle: "bold",
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Simpanan",
                                        fontStyle: "bold",
                                    },
                                    ticks: {
                                        //max: 200000000000,
                                        //min: 0,
                                        //stepSize: 25000000000,
                                        callback: function(value, index, values) {
                                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        }
                                    }
                                }]
                            }
                        }
                    };
                var canvasSimpanan = document.getElementById('canvasSimpanan_<?= $iCustomer; ?>').getContext('2d');
                window.myLine = new Chart(canvasSimpanan, simpananConfig);

        <?php $iCustomer++; endforeach; ?>
    });

    
</script>