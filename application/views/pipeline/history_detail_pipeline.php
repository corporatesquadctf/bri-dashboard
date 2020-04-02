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
    .update_link{
        vertical-align:middle; 
        text-decoration: underline; 
        color:#337ab7;
    }
    thead{
        background-color:#218FD8;
    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #218FD8;
        border-color: #337ab7;
    }
    .form-control{
        color: #73879C;
        padding-left: 8px;
    }    
    .well{
        background-color: #FFF;
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
                            <li class="breadcrumb-item"><a href="<?= base_url().'pipeline/history'; ?>">History</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History Detail</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">History Detail</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_detail" id="detail-tab" role="tab" data-toggle="tab" aria-expanded="true">Detail</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_log" role="tab" id="log-tab" data-toggle="tab" aria-expanded="false">Log</a>
                                </li>
                            </ul>
                            <div id="tabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_detail" aria-labelledby="detail-tab">
                                    <form class="form-horizontal form-label-left">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="sumber_pipeline" class="control-label">Status Permohonan</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <select class="form-control js-example-basic-single" id="sumber_pipeline" name="sumber_pipeline" readonly disabled>
                                                            <?php
                                                                foreach ($data_source_option as $row){
                                                                    $selected = '';
                                                                    if($pipeline->sumber_pipeline == $row->PipelineDataSourceId) $selected = 'selected="selected"';
                                                                    echo '<option value="'.$row->PipelineDataSourceId.'" '.$selected.'>'.$row->DataSourceName.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                                    if($pipeline->sumber_pipeline == 1) $civ_class = "no_display";
                                                    else $civ_class = "";
                                                ?>
                                                <div class="form-group <?= $civ_class; ?>" id="cifDiv">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="cif" class="control-label">CIF</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <select class="form-control js-example-basic-single" id="cif" name="cif" readonly disabled>
                                                            <?php
                                                                foreach ($customer_option as $row){
                                                                    $selected = '';
                                                                    if($pipeline->cif == $row->CustomerMenengahId) $selected = 'selected="selected"';
                                                                    echo '<option value="'.$row->CustomerMenengahId.'" '.$selected.'>'.$row->CIF.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="jenis_debitur" class="control-label">Bentuk Usaha</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="hidden" id="jenis_debitur_id" name="jenis_debitur_id" value="<?= $pipeline->jenis_debitur; ?>" />
                                                        <select class="form-control js-example-basic-single" id="jenis_debitur" name="jenis_debitur" readonly disabled>
                                                            <?php
                                                                foreach ($customer_type_option as $row){
                                                                    $selected = '';
                                                                    if($pipeline->jenis_debitur == $row->CustomerMenengahTypeId) $selected = 'selected="selected"';
                                                                    echo '<option value="'.$row->CustomerMenengahTypeId.'" '.$selected.'>'.$row->CustomerMenengahTypeName.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="nama_debitur" class="control-label">Nama Debitur</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="nama_debitur" name="nama_debitur" class="form-control" value="<?= $pipeline->nama_debitur; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="npwp_perusahaan" class="control-label">NPWP</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="npwp_perusahaan" name="npwp_perusahaan" class="form-control" value="<?= $pipeline->npwp_perusahaan; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="alamat" class="control-label">Alamat</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <textarea id="alamat" name="alamat" class="form-control" rows="5" readonly disabled><?= $pipeline->alamat; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="contact_person" class="control-label">Contact Person</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="contact_person" name="contact_person" class="form-control" value="<?= $pipeline->contact_person; ?>"  readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="no_telp" class="control-label">No. Telepon</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="no_telp" name="no_telp" class="form-control" value="<?= $pipeline->no_telp; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="jenis_usaha" class="control-label">Jenis Usaha</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="jenis_usaha" name="jenis_usaha" class="form-control" value="<?= $pipeline->jenis_usaha; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="sektor_usaha" class="control-label">Sektor Usaha</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <select class="form-control js-example-basic-single" id="sektor_usaha" name="sektor_usaha" readonly disabled>
                                                            <?php
                                                                foreach ($sektor_usaha_option as $row){
                                                                    $selected = '';
                                                                    if($pipeline->sektor_usaha == $row->SegmentationId) $selected = 'selected="selected"';
                                                                    echo '<option value="'.$row->SegmentationId.'" '.$selected.'>'.$row->SegmentationName.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="sektor_ekonomi" class="control-label">Sub Sektor Ekonomi</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <select class="form-control js-example-basic-single" id="sektor_ekonomi" name="sektor_ekonomi" readonly disabled>
                                                            <?php
                                                                foreach ($sub_sektor_ekonomi_option as $row){
                                                                    $selected = '';
                                                                    if($pipeline->sub_sektor_ekonomi == $row->SubSectorEconomyId) $selected = 'selected="selected"';
                                                                    echo '<option value="'.$row->SubSectorEconomyId.'" '.$selected.'>'.$row->SubSectorEconomyName.'</option>';
                                                                }
                                                            ?>                                               
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="warna_lpg" class="control-label">Loan Portfolio Guideline (LPG)</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <?php
                                                            switch($pipeline->warna_lpg){
                                                                case 1: 
                                                                    $lpgColor = "#E74545"; $lpgStatus = 1;
                                                                    $lpgDescriptionStyle = "";
                                                                    break;
                                                                case 2: 
                                                                    $lpgColor = "#FFEF9D"; $lpgStatus = 2;
                                                                    $lpgDescriptionStyle = "";
                                                                    break;
                                                                case 3: 
                                                                    $lpgColor = "#62D159"; $lpgStatus = 3;
                                                                    $lpgDescriptionStyle = "no_display";
                                                                    break;
                                                                case 4: 
                                                                    $lpgColor = "#218FD8"; $lpgStatus = 4;
                                                                    $lpgDescriptionStyle = "no_display";
                                                                    break;
                                                                default: 
                                                                    $lpgColor = ""; $lpgStatus = 5;
                                                                    $lpgDescriptionStyle =""; 
                                                                    break;
                                                            }
                                                        ?>
                                                        <i id="lpgColor" class="fa fa-square" style="color:<?= $lpgColor; ?>; margin-top: 12px;"></i>
                                                        <input type="hidden" id="warna_lpg" name="warna_lpg[]" value="<?= $lpgStatus; ?>">
                                                    </div>
                                                </div>
                                                <div id="DivLpgDescription" class="form-group <?= $lpgDescriptionStyle; ?>">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="lpgDescription" class="control-label">Keterangan LPG</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="lpgDescription" name="lpgDescription" class="form-control" value="<?= $pipeline->lpgDescription; ?>" readonly disabled>
                                                    </div>
                                                </div>
                                                <?php
                                                    if($pipeline->status_debitur == 1){
                                                        $status_debitur = "Rekening Baru";
                                                    }else if($pipeline->status_debitur == 2){
                                                        $status_debitur = "Suplesi / Deplesi";
                                                    }else {
                                                        $status_debitur = "Deplesi";
                                                    }
                                                ?>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="status_debitur" class="control-label">Status Debitur</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <label id="status_debitur" class="control-label" style="font-weight:normal;"><?= $status_debitur; ?></label>
                                                    </div>
                                                </div>
                                                <?php
                                                    if($pipeline->sumber_pipeline == 1) {
                                                        $suplesi_class = "no_display";
                                                    }else $suplesi_class = "";
                                                ?>
                                                <div class="form-group <?= $suplesi_class; ?>" id="div-suplesi-facility">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label class="control-label">Fasilitas Lama</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <div class="well clearfix" style="padding:10px 10px 0 10px; margin-bottom: 0px;">
                                                            <input type="hidden" name="jml-fasilitas-suplesi" id="jml-fasilitas-suplesi" value="<?= $pipeline->jmlFasilitasSuplesi; ?>">
                                                            <div class="row form-group" id="fasilitas-suplesi" style="margin-bottom:0px;">
                                                                <div class="row" style="margin:0px;">
                                                                    <div class="col-xs-3">
                                                                        <div class="form-group">
                                                                            <label>Fasilitas</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-3">
                                                                        <div class="form-group">
                                                                            <label>Semula</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-3">
                                                                        <div class="form-group">
                                                                            <label>Menjadi</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-2">
                                                                        <div class="form-group">
                                                                            <label>No. Rekening</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <div class="form-group">
                                                                            <label>EWS</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    for($i=0; $i<$pipeline->jmlFasilitasSuplesi; $i++): 
                                                                        switch($pipeline->arrFasilitasSuplesi[$i]['EWS']){
                                                                            case 'Merah': $colorCode = 'E74545'; break;
                                                                            case 'Kuning': $colorCode = 'FFEF9D'; break;
                                                                            case 'Hijau' : $colorCode = '62D159'; break;
                                                                            default: $colorCode = ''; break;
                                                                        }
                                                                ?>
                                                                <div class="row" style="margin:0px;">
                                                                    <div class="col-xs-3">
                                                                        <input type="hidden" id="fasilitas_suplesi_id_<?= $i; ?>" name="fasilitas_suplesi_id_<?= $i; ?>" value="<?= $pipeline->arrFasilitasSuplesi[$i]['FacilityId'];?>" />
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="text" style="height:38px; width: calc(100% - 1px); font-size: 12px;" id="fasilitas_suplesi_<?= $i; ?>" name="fasilitas_suplesi_<?= $i; ?>" value="<?= $pipeline->arrFasilitasSuplesi[$i]['FacilityName'];?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-3">
                                                                        <div class="form-group">
                                                                            <input type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_existing_suplesi_<?= $i; ?>" name="plafond_existing_suplesi_<?= $i; ?>" data-a-dec="." data-a-sep="," value="<?= $pipeline->arrFasilitasSuplesi[$i]['PlafondExisting'];?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-3">
                                                                        <div class="form-group">
                                                                            <input placeholder="Plafond Suplesi" type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_baru_suplesi_<?= $i; ?>" name="plafond_baru_suplesi_<?= $i; ?>" data-a-dec="." data-a-sep="," value="<?= $pipeline->arrFasilitasSuplesi[$i]['PlafondSuplecy'];?>" onchange="calculate_plafond();" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-2">
                                                                        <div class="form-group">
                                                                            <input type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control" id="no_rekening_<?= $i; ?>" name="no_rekening_<?= $i; ?>" value="<?= $pipeline->arrFasilitasSuplesi[$i]['NoRekening'];?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <div class="form-group">
                                                                            <input type="hidden" id="ews_<?= $i; ?>" name="ews_<?= $i; ?>" value="<?= $pipeline->arrFasilitasSuplesi[$i]['EWS']; ?>" />
                                                                            <i class="fa fa-square" style="color:#<?= $colorCode; ?>; margin-top: 12px;"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endfor; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="nasabah_baru_data_source" >
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label class="control-label">Fasilitas Baru</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <div class="well clearfix" style="padding:10px 10px 0 10px; margin-bottom: 0px; ">
                                                            <input type="hidden" id="jml_fasilitas" name="jml_fasilitas" value="<?= $pipeline->jml_fasilitas ?>" />
                                                            <div id="fasilitas_fields">
                                                            <?php 
                                                                if($pipeline->jml_fasilitas != 0){
                                                                    for($i=0; $i<$pipeline->jml_fasilitas; $i++){
                                                            ?>
                                                                    <div class="form-group removeclass_fasilitas<?php echo $i; ?>" style="margin-bottom:0px; ">
                                                                        <div class="col-xs-3">
                                                                            <div class="form-group">
                                                                                <input type="hidden" class="form-control" id="txt_id_fasilitas<?php echo $i; ?>" name="txt_id_fasilitas[]" value="<?= $pipeline->arr_fasilitas[$i]['PipelineDetailNewFacilityId']; ?>" readonly="readonly">
                                                                                <select id="drp_fasilitas<?php echo $i; ?>" name="drp_fasilitas[]" class="js-example-basic-single form-control" style="font-size: 12px;" readonly disabled>
                                                                                    <?php  foreach($facility_option as $row){ 
                                                                                        $selected = '';
                                                                                        if($row->FacilityId == $pipeline->arr_fasilitas[$i]['FacilityId']) $selected = 'selected="selected"';
                                                                                        echo '<option value="'.$row->FacilityId.'" '.$selected.'>'.$row->FacilityName.'</option>';
                                                                                    } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-3">
                                                                            <div class="form-group" style="margin-bottom:0px; ">
                                                                                <input placeholder="Plafond" type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_fasilitas<?php echo $i; ?>" name="plafond_fasilitas[]" data-a-dec="." data-a-sep="," onchange="calculate_plafond();" value="<?= $pipeline->arr_fasilitas[$i]['Plafond']; ?>" readonly disabled />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                    }
                                                                }else{
                                                                    echo '<div class="col-xs-12 form-group"><label style="margin:-10px; color: #73879C; font-weight: normal;">Tidak Ada Fasilitas Lama</label></div>';
                                                                }
                                                            ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="plafond" class="control-label">Usulan Plafond</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <input type="text" id="plafond" name="plafond" data-a-dec="." data-a-sep="," class="form-control money" value="<?= $pipeline->plafond; ?>"  readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="tdbDiv">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="tdb" class="control-label">Sumber Debitur</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <label id="tdb" class="control-label" style="font-weight:normal;">
                                                        <?php
                                                            if($pipeline->tdb == 1) {
                                                                echo '<label style="font-weight: normal;">Trickle Down Business (TDB)</label>';
                                                            }
                                                            else if($pipeline->tdb == 2) echo '<label style="font-weight: normal;">Non TDB</label>';
                                                        ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php
                                                    if($pipeline->tdb == 1) {
                                                        $sumber_tdb_class = "";
                                                    }
                                                    else {
                                                        $sumber_tdb_class = "no_display";
                                                    }
                                                ?>
                                                <div class="form-group <?= $sumber_tdb_class; ?>" id="sumberTDBDiv">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="sumber_tdb" class="control-label">Sumber TDB</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <select class="form-control js-example-basic-single" id="sumber_tdb" name="sumber_tdb" readonly disabled>
                                                            <?php
                                                            foreach ($sumber_tdb_option as $row){
                                                                $selected = '';
                                                                if($pipeline->sumber_tdb == $row->TdbSourceId) $selected = 'selected="selected"';
                                                                echo '<option value="'.$row->TdbSourceId.'" '.$selected.'>'.$row->Name.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="additional_desc" class="control-label">Keterangan</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <textarea id="additional_desc" name="additional_desc" class="form-control" rows="5" maxlength="700"><?= $pipeline->additional_desc; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-xs-12">
                                                        <label for="sumber_tdb" class="control-label">Catatan</label>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12">
                                                        <table>
                                                        <?php foreach($pipeline->log_comment as $row){
                                                            if($row->PipelineStatusId == 5) $commentRejected = 'Ditolak ';
                                                            else $commentRejected = '';
                                                            if($row->Comment == NULL) continue;
                                                            echo '<tr>';
                                                            echo '<td>'.date("d F Y H:i:s", strtotime($row->CreatedDate)).'</td>';
                                                            echo '<td style="padding:0 5px;">-</td>';
                                                            echo '<td>['.$commentRejected.$row->CreatedByName.' as <b>'.$row->ROLE_NAME.'</b>]</td>';
                                                            echo '<td style="padding:0 5px;">:</td>';
                                                            echo '<td>'.$row->Comment.'</td>';
                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>                          
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_log" aria-labelledby="log-tab">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <table id="tbl_log_pipeline" class="table table-striped table-hover" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%;">No.</th>
                                                        <th style="width:15%;">Tanggal</th>
                                                        <th style="width:10%;">Status Pipeline</th>
                                                        <!--<th style="width:15%;">Layer Level</th>-->
                                                        <th style="width:20%;">Aktor</th>
                                                        <th style="width:35%;">Komentar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach($log_pipeline as $row){
                                                ?>
                                                    <tr>
                                                        <td style="width:5%;"><?= $i; ?></td>
                                                        <td style="width:15%;"><?= date("d F Y H:i:s", strtotime($row->CreatedDate)); ?></td>
                                                        <td style="width:10%;"><?= $row->StatusName; ?></td>
                                                        <!--<td style="width:15%;"><?= $row->ROLE_NAME; ?></td>-->
                                                        <td style="width:20%;"><?= $row->CreatedByName; ?></td>
                                                        <td style="width:35%;"><?= $row->Comment; ?></td>
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
    </div>
</div>

<!-- Auto Numeric Plugin Js -->
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-checkbox/js/dataTables.checkboxes.min.js"></script>

<script>
    var base_url = "<?= base_url(); ?>";
    var created_by = "<?= $pipeline->created_by; ?>";

    $(document).ready(function() {
        $('.money').autoNumeric('init');
        $('#btn_cancel_pipeline').click(function(){
            window.location.href= base_url+'pipeline/history';
        });

        var table = $('#tbl_log_pipeline').DataTable({
            'bLengthChange': false,
            'dom': 'rt<"bottom"pi>',
            'language': {
                'search': '',
                'searchPlaceholder' : "Search"
            },
            'order': [[0, 'asc']],
            
        });
        $('div.dataTables_filter input').removeClass('input-sm');
        $('div.dataTables_filter input').css('border-radius','25px');
    });
</script>
