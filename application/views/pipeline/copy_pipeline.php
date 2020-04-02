<style type="text/css">
    .div-action{
        display: inline-flex;
        margin: auto;
        color: #218FD8;
    }
    .div-action i{
        font-size: 24px;
        font-weight: normal;
        margin: auto;
    }
    .div-action:hover i{
        cursor: pointer;
    }    
    .form-control{
        color: #73879C;
        padding-left: 8px;
    }
    .well{
        background-color: #FFF;
    }
    .error {
        font-size: 14px;
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
                            <li class="breadcrumb-item active" aria-current="page">Copy Pipeline</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Copy Pipeline</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left cmxform" id="copyPipelineForm" method="POST" action="<?= base_url("pipeline/process_copy"); ?>">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="sumber_pipeline" class="control-label">Status Permohonan</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <select class="form-control js-example-basic-single" id="sumber_pipeline" name="sumber_pipeline">
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
                                    <div class="form-group no_display" id="cifDiv">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="cif" class="control-label">CIF</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <select class="form-control js-example-basic-single" id="cif" name="cif" style="width:100%;">
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
                                            <select class="form-control js-example-basic-single" id="jenis_debitur" name="jenis_debitur">
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
                                            <label for="nama_debitur" class="control-label">Nama Debitur <span class="req-field">*</span></label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" id="nama_debitur" name="nama_debitur" class="form-control" value="<?= $pipeline->nama_debitur; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="npwp_perusahaan" class="control-label">NPWP</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" id="npwp_perusahaan" name="npwp_perusahaan" class="form-control" value="<?= $pipeline->npwp_perusahaan; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="alamat" class="control-label">Alamat <span class="req-field">*</span></label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <textarea id="alamat" name="alamat" class="form-control" rows="5" required><?= $pipeline->alamat; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="contact_person" class="control-label">Contact Person <span class="req-field">*</span></label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" id="contact_person" name="contact_person" class="form-control" value="<?= $pipeline->contact_person; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="no_telp" class="control-label">No. Telepon <span class="req-field">*</span></label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" id="no_telp" name="no_telp" class="form-control" value="<?= $pipeline->no_telp; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="jenis_usaha" class="control-label">Jenis Usaha <span class="req-field">*</span></label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" id="jenis_usaha" name="jenis_usaha" class="form-control" value="<?= $pipeline->jenis_usaha; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="sektor_usaha" class="control-label">Sektor Usaha</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <select class="form-control js-example-basic-single" id="sektor_usaha" name="sektor_usaha">
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
                                            <label for="sub_sektor_ekonomi" class="control-label">Sub Sektor Ekonomi</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <select class="form-control js-example-basic-single" id="sub_sektor_ekonomi" name="sub_sektor_ekonomi">
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
                                            <label for="warna_lpg" class="control-label">Loan Portfolio Guideline (LPG) <span class="req-field">*</span></label>
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
                                            <input type="text" id="lpgDescription" name="lpgDescription" class="form-control" value="<?= $pipeline->lpgDescription; ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="status_debitur" class="control-label">Status Debitur</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <label id="status_debitur" class="control-label" style="font-weight:normal;"></label>
                                        </div>
                                    </div>
                                    <div class="form-group no_display" id="div-suplesi-facility">
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
                                                                <input placeholder="Plafond Suplesi" type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_baru_suplesi_<?= $i; ?>" name="plafond_baru_suplesi_<?= $i; ?>" data-a-dec="." data-a-sep="," value="<?= $pipeline->arrFasilitasSuplesi[$i]['PlafondSuplecy'];?>" onchange="calculate_plafond();" required />
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
                                    <div id="nasabah_baru_data_source" class="form-group" >
                                        <div class="col-sm-3 col-xs-12">
                                            <label class="control-label">Fasilitas Baru</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <div class="well clearfix" style="padding:10px 10px 15px 10px; margin-bottom:0px;">
                                                <input type="hidden" id="jumlahFasilitasBaru" name="jumlahFasilitasBaru" value="<?= $pipeline->jml_fasilitas; ?>" />
                                                <input type="hidden" id="arrFasilitasBaru" name="arrFasilitasBaru" value="" />
                                                <div id="fasilitas_fields">
                                                    <?php 
                                                        for($i=0; $i<$pipeline->jml_fasilitas; $i++){
                                                    ?>
                                                    <div class="form-group removeclass_fasilitas<?php echo $i; ?>" style="margin-bottom:0px; font-size:12px;">
                                                        <div class="col-xs-3">
                                                            <div class="form-group">
                                                                <select id="drp_fasilitas<?php echo $i; ?>" name="drp_fasilitas<?php echo $i; ?>" class="js-example-basic-single form-control">
                                                                    <?php  foreach($facility_option as $row){ 
                                                                        $selected = '';
                                                                        if($row->FacilityId == $pipeline->arr_fasilitas[$i]['FacilityId']) $selected = 'selected="selected"';
                                                                        echo '<option value="'.$row->FacilityId.'" '.$selected.'>'.$row->FacilityName.'</option>';
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <div class="form-group">
                                                                <input placeholder="Plafond" type="text" style="height:38px; text-align: right; font-size:12px;" class="form-control money" id="plafond_fasilitas<?php echo $i; ?>" name="plafond_fasilitas<?php echo $i; ?>" data-a-dec="." data-a-sep="," onchange="calculate_plafond();" value="<?= $pipeline->arr_fasilitas[$i]['Plafond']; ?>" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <div class="form-group" style="margin-bottom:0px;">
                                                                <div class="div-action">
                                                                    <div style="padding-left:0px; margin-top:7px;">
                                                                        <i class="material-icons" onclick="remove_facility_fields(<?= $i; ?>);">delete</i>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                <button class="btn w150 btn-sm btn-primary" type="button" onclick="add_facility_fields();" style="margin-left:10px;">Tambah Fasilitas</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="plafond" class="control-label">Usulan Plafond</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input type="text" id="plafond" name="plafond" data-a-dec="." data-a-sep="," class="form-control money" value="<?= $pipeline->plafond; ?>"  readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group" id="tdbDiv">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="tdb" class="control-label">Sumber Debitur <span class="req-field">*</span></label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12 radio">
                                            <?php
                                                $selected_tdb1 = "";
                                                $selected_tdb2 = "";
                                                if($pipeline->tdb == 1) $selected_tdb1 = "checked='checked'";
                                                else if($pipeline->tdb == 2) $selected_tdb2 = "checked='checked'";
                                            ?>
                                            <input type="hidden" id="tdb_value" name="tdb_value" value="<?= $pipeline->tdb; ?>">
                                            <label><input type="radio" id="tdb" name="tdb[]" value="1" <?= $selected_tdb1; ?> required>Trickle Down Business (TDB)</label>
                                            <label><input type="radio" id="tdb" name="tdb[]" value="2" <?= $selected_tdb2; ?> required>Non TDB</label>
                                            <br/><label id="tdb[]-error" for="tdb[]" class="error" style="padding-left:0px;display:none;"></label>
                                        </div>
                                    </div>
                                    <div class="form-group no_display" id="sumberTDBDiv">
                                        <div class="col-sm-3 col-xs-12">
                                            <label for="sumber_tdb" class="control-label">Sumber TDB</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <select class="form-control js-example-basic-single" id="sumber_tdb" name="sumber_tdb" style="width:100%;">
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

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group pull-right">
                                        <div class="col-xs-12">
                                            <button id="btn_cancel_copy_pipeline" class="btn w150 btn-sm btn-default" type="button">Kembali</button>
                                            <button id="btn_copy_pipeline" class="btn w150 btn-sm btn-primary" type="button" style="margin-right:5px;" >Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-copy-pipeline" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    <p>Anda akan menyalin pipeline. Lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Kembali</button>
                    <button id="btn_confirm_copy_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-notification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Notifikasi</h4>
                </div>
                <div class="modal-body">
                    <p><label id="notification_desc" style="font-weight:normal;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery.maskedinput-master/src/jquery.maskedinput.js"></script>

<script>
var base_url = "<?= base_url(); ?>";
var jml_fasilitas = "<?= $pipeline->jml_fasilitas; ?>";
if(jml_fasilitas == 0){
    var arr_fasilitas = [];
}else{
    var arr_fasilitas = [];
    for(var i=0; i<jml_fasilitas; i++){
        arr_fasilitas.push(Number(i));
    }
}
$("#arrFasilitasBaru").val(arr_fasilitas);
$("#jumlahFasilitasBaru").val(arr_fasilitas.length);

$(document).ready(function() {
    $(".js-example-basic-single").select2();
    $("#npwp_perusahaan").mask("99.999.999.9-999.99");

    $('.money').autoNumeric('init',{
		aForm: true,
		vMax: '99999999999999999',
	});

    var sumber_pipeline_value = $('#sumber_pipeline').val();
    if(sumber_pipeline_value == 2){
        $("#cifDiv").fadeIn();
        $("#div-suplesi-facility").fadeIn();
        $("#status_debitur").html("Suplesi / Deplesi");
        updateDetailInformation($("#cif").val(), 1);
    }else{
        $("#status_debitur").html("Rekening Baru");
    }

    var tdb_status = $("#tdb_value").val();
    if(tdb_status == 1){
        $("#sumberTDBDiv").fadeIn();
    }

    $("#sumber_pipeline").change(function(){
        var sumber_pipeline_value = this.value;
        if(sumber_pipeline_value == 1){
            $("#cifDiv").fadeOut();
            $("#div-suplesi-facility").fadeOut();
            $("#status_debitur").html("Rekening Baru");
            $("#jenis_debitur").prop("disabled", false);
            clearCIFValue();
        }else if(sumber_pipeline_value == 2){
            $("#cifDiv").fadeIn();
            $("#div-suplesi-facility").fadeIn();
            $("#status_debitur").html("Suplesi / Deplesi");
            setDefaultCIFValue();
        }
        calculate_plafond();
    });

    $("#jenis_debitur").change(function(){
        var jenis_debitur_id =  this.value;
        $("#jenis_debitur_id").val(jenis_debitur_id);
        calculate_plafond();
    });

    $('#cif').change(function(){
        var customer_id =  this.value;
        $("#cifId").val(customer_id);
        updateDetailInformation(customer_id, 0);
    });

    $("#sektor_usaha").change(function(){
        var segmentasi_id =  this.value;
        updateSektorUsahaOption(segmentasi_id);
    });

    $("#sub_sektor_ekonomi").change(function(){
        var subSectorEconomyId =  this.value;
        updateLpgInformation(subSectorEconomyId);
    });
    
    $("#tdbDiv input[type='radio']").on("change", function () {
        var selectedValue = $("input[name='tdb[]']:checked").val();
        if (selectedValue == 1) {
            $("#sumber_tdb :nth-child(1)").prop("selected", true).trigger("change");
            $("#sumberTDBDiv").fadeIn();
        }else{
            $("#sumberTDBDiv").fadeOut();
        }
    }); 

    $("#btn_cancel_pipeline").click(function(){
        window.location.href= base_url+"pipeline/history";
    });

    $("#btn_cancel_copy_pipeline").click(function(){
        window.location.href= base_url+"pipeline/history";
    });

    $('#btn_confirm_copy_pipeline').click(function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url : $("#copyPipelineForm").attr("action"),
            data: $("#copyPipelineForm").serialize(),
            dataType : "json",
            beforeSend:function(){
                $(".modal-copy-pipeline").modal("hide");
                $(".loaderImage").show();
            },
            success: function(response){
                $(".loaderImage").hide();
                    if(response.status === "success"){
                    new PNotify({
                        title: "Success!",
                        text: "Data has been saved.",
                        type: "success",
                        styling: "bootstrap3"
                    });
                    PNotify.prototype.options.delay = 1200;
                    setTimeout(function(){ 
                        window.location.href= "<?= base_url("pipeline/draft"); ?>";
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

    $.validator.addMethod("letterNumber", function(value, element) {
        return this.optional(element) || /^[a-z0-9 \\s]+$/i.test(value);
    }, "Must contain only letters or numbers");

    $.validator.addMethod("plafondRestriction", function(value, element) {
        var plafond = $('#plafond').autoNumeric("get");
        if(plafond < 25000000000 || plafond > 200000000000){
            return false;
        }else return true;
    }, "Must between 25M - 200M");

    $("#copyPipelineForm").validate({
        ignore: [],
        rules: {
            nama_debitur: {
                required: true,
                letterNumber: true
            },
            plafond: {
                required: true,
                plafondRestriction: true
            },            
            npwp_perusahaan: {
                remote: {
                    url: base_url+"pipeline/serviceCheckCustomerStatus",
                    type: "POST",
                    data: {
                        npwp: function() {
                            return $("#npwp_perusahaan").val();
                        }
                    }
                }
            },
            cifId: {
                remote: {
                    url: base_url+"pipeline/serviceCheckCustomerByCIF",
                    type: "POST",
                    data: {
                        cif: function() {
                            return $("#cifId").val();
                        }
                    }
                }
            }
        },
        messages:{
            npwp_perusahaan: {
                remote: "Customer is being processed by another RM"
            },
            cifId: {
                remote: "Customer is being processed"
            }
        }
    });

    $("#btn_copy_pipeline").click(function(){
        if($("#copyPipelineForm").valid()){
            $(".modal-copy-pipeline").modal("show");
        }
    });
});

function setDefaultCIFValue(){
    $("#cif :nth-child(1)").prop("selected", true).trigger("change");
}

function clearCIFValue(){
    $("#nama_debitur").prop("readonly", false);
    $("#nama_debitur").val("");

    $("#npwp_perusahaan").prop("readonly", false);
    $("#npwp_perusahaan").val("");

    $("#alamat").prop("readonly", false);
    $("#alamat").val("");

    $("#contact_person").prop("readonly", false);
    $("#contact_person").val("");

    $("#no_telp").prop("readonly", false);
    $("#no_telp").val("");
}

/*    
    Start of Service Function
*/

function updateDetailInformation(customer_id, isDefault){
    jQuery(".loaderImage").show();
    $.getJSON(base_url+'pipeline/serviceGetDetailCustomer/'+customer_id, function (data){
        if(data.length > 0){
            $("#cifId").removeClass( "error" );
            $("#cifId-error").css("display","none");
            
            $("#jenis_debitur").prop("disabled", true);
            if(data[0].CustomerMenengahTypeId != null){
                $("#jenis_debitur").val(data[0].CustomerMenengahTypeId).trigger("change");
                $("#jenis_debitur_id").val(data[0].CustomerMenengahTypeId);
            }

            $("#nama_debitur").prop("readonly", true);
            $("#nama_debitur").val(data[0].CustomerName);
            $("#nama_debitur" ).removeClass("error");
            $("#nama_debitur-error").css("display","none");

            $("#npwp_perusahaan").prop("readonly", true);
            $("#npwp_perusahaan").val(data[0].NPWP);
            $("#npwp_perusahaan" ).removeClass( "error" );
            $("#npwp_perusahaan-error").css("display","none");
            
            $("#alamat").prop("readonly", true);
            $("#alamat").val(data[0].Address);
            $("#alamat" ).removeClass("error");
            $("#alamat-error").css("display","none");
            
            $("#contact_person").prop("readonly", true);
            $("#contact_person").val(data[0].ContactPerson);
            $("#contact_person").removeClass("error");
            $("#contact_person-error").css("display","none");
        
            $("#no_telp").prop("readonly", true);
            $("#no_telp").val(data[0].PhoneNumber);
            $("#no_telp").removeClass("error");
            $("#no_telp-error").css("display","none");

            if(isDefault == 0){
                var facilityDetail = $('#fasilitas-suplesi');
                facilityDetail.empty();

                var suplesiFacility = '';
                if((data[0].FacilityDetail).length != 0){
                    var dataFacility = data[0].FacilityDetail;
                    var iSuplesi = 0;
                    if(dataFacility.length > 0){
                        suplesiFacility +=  '<div class="row" style="margin:0px;">';
                        suplesiFacility +=  '<div class="col-xs-3">';
                        suplesiFacility +=	'	<div style="margin-bottom: 5px;">';
                        suplesiFacility +=	'		<label>Fasilitas</label>';
                        suplesiFacility +=	'	</div>';
                        suplesiFacility +=	'</div>';
                        suplesiFacility +=  '<div class="col-xs-3">';
                        suplesiFacility +=  '   <div style="margin-bottom: 5px;">';
                        suplesiFacility +=  '       <label>Semula :</label>'
                        suplesiFacility +=  '   </div>';
                        suplesiFacility +=  '</div>';
                        suplesiFacility +=  '<div class="col-xs-3">';
                        suplesiFacility +=  '   <div style="margin-bottom: 5px;">';
                        suplesiFacility +=  '       <label>Menjadi :</label>';
                        suplesiFacility +=  '   </div>';
                        suplesiFacility +=  '</div>';
                        suplesiFacility +=  '<div class="col-xs-2">';
                        suplesiFacility +=	'	<div style="margin-bottom: 5px;">';
                        suplesiFacility +=	'		<label>No. Rekening</label>';
                        suplesiFacility +=	'	</div>';
                        suplesiFacility +=	'</div>';
                        suplesiFacility +=  '<div class="col-xs-1">';
                        suplesiFacility +=	'	<div style="margin-bottom: 5px;">';
                        suplesiFacility +=	'		<label>EWS</label>';
                        suplesiFacility +=	'	</div>';
                        suplesiFacility +=	'</div>';
                        suplesiFacility +=  '</div>';
                        $.each(dataFacility, function(index, item){
                            var warna = item.warna;
                            switch(warna){
                                case 'Merah': var colorCode = 'E74545'; break;
                                case 'Kuning': var colorCode = 'FFEF9D'; break;
                                case 'Hijau' : var colorCode = '62D159'; break;
                                default: colorCode = ''; break;
                            }
                            suplesiFacility +=  '<div class="row" style="margin:0px;">';
                            suplesiFacility +=  '<div class="col-xs-3">';
                            suplesiFacility +=  '   <input type="hidden" id="fasilitas_suplesi_id_'+iSuplesi+'" name="fasilitas_suplesi_id_'+iSuplesi+'" value="'+item.FacilityId+'" />';
                            suplesiFacility +=	'	<div class="form-group">';
                            suplesiFacility +=	'		<input class="form-control" type="text" style="height:38px; width: calc(100% - 1px); font-size: 12px;" id="fasilitas_suplesi_'+iSuplesi+'" name="fasilitas_suplesi_'+iSuplesi+'" value="'+item.FacilityName+'" readonly />';
                            suplesiFacility +=	'	</div>';
                            suplesiFacility +=	'</div>';
                            suplesiFacility +=  '<div class="col-xs-3">';
                            suplesiFacility +=  '   <div class="form-group">';
                            suplesiFacility +=  '       <input type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_existing_suplesi_'+iSuplesi+'" name="plafond_existing_suplesi_'+iSuplesi+'" data-a-dec="." data-a-sep="," value="'+item.Plafond+'" readonly />';
                            suplesiFacility +=  '   </div>';
                            suplesiFacility +=  '</div>';
                            suplesiFacility +=  '<div class="col-xs-3">';
                            suplesiFacility +=  '   <div class="form-group">';
                            suplesiFacility +=  '       <input placeholder="Plafond Suplesi" type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_baru_suplesi_'+iSuplesi+'" name="plafond_baru_suplesi_'+iSuplesi+'" data-a-dec="." data-a-sep="," value="'+item.Plafond+'" onchange="calculate_plafond();" required />';
                            suplesiFacility +=  '   </div>';
                            suplesiFacility +=  '</div>';
                            suplesiFacility +=  '<div class="col-xs-2">';
                            suplesiFacility +=  '   <div class="form-group">';
                            suplesiFacility +=  '       <input type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control" id="no_rekening_'+iSuplesi+'" name="no_rekening_'+iSuplesi+'" value="'+item.NoRekening+'" readonly />';
                            suplesiFacility +=  '   </div>';
                            suplesiFacility +=  '</div>';
                            suplesiFacility +=  '<div class="col-xs-1">';
                            suplesiFacility +=  '   <div class="form-group">';
                            suplesiFacility +=  '       <input type="hidden" id="ews_'+iSuplesi+'" name="ews_'+iSuplesi+'" value="'+warna+'" />';
                            suplesiFacility +=  '       <i class="fa fa-square" style="color:#'+colorCode+'; margin-top: 12px;"></i>';
                            suplesiFacility +=  '   </div>';
                            suplesiFacility +=  '</div>';
                            suplesiFacility +=  '</div>';
                            iSuplesi++;
                        })
                    }
                }else{
                    suplesiFacility +=  '<div class="col-xs-12 form-group">';
                    suplesiFacility +=  '   <label style="margin:-10px; color: #555; font-weight: normal;">Tidak Ada Fasilitas Lama</label>';
                    suplesiFacility +=  '</div>';
                }
                $("#jml-fasilitas-suplesi").val((data[0].FacilityDetail).length);
                $("#fasilitas-suplesi").append(suplesiFacility);
            }
        }
        $('.money').autoNumeric('init',{
            aForm: true,
            vMax: '99999999999999999'
        });
        calculate_plafond();
        jQuery(".loaderImage").hide();
    })
}

function updateSektorUsahaOption(segmentasi_id){
    jQuery(".loaderImage").show();  
    var dropdownSektorEkonomi = $('#sub_sektor_ekonomi');
    dropdownSektorEkonomi.empty();
    $.getJSON(base_url+'pipeline/serviceGetSubSektorEkonomi/'+segmentasi_id, function (data){
        if(data.length > 0){
            $.each(data, function(index, item){
                dropdownSektorEkonomi.append($('<option>',
                {
                    value: item.SubSectorEconomyId,
                    text: item.SubSectorEconomyName
                },'</option>'));
            })
        }
        updateLpgInformation(data[0].SubSectorEconomyId);
    })    
}

function updateLpgInformation(SubSectorEconomyId){
    jQuery(".loaderImage").show(); 
    $.getJSON(base_url+'pipeline/serviceGetLpgInformation/'+SubSectorEconomyId, function (data){
        if(data.length > 0){
            $("#lpgDescription").val("");
            switch(data[0].Warna){
                case "Merah": 
                    var lpgColor = "#E74545"; var lpgStatus = 1;
                    $("#DivLpgDescription").css("display","block");
                    break;
                case "Kuning": 
                    var lpgColor = "#FFEF9D"; var lpgStatus = 2;
                    $("#DivLpgDescription").css("display","block");
                    break;
                case "Hijau": 
                    var lpgColor = "#62D159"; var lpgStatus = 3;
                    $("#DivLpgDescription").css("display","none");
                    break;
                case "Biru": 
                    var lpgColor = "#218FD8"; var lpgStatus = 4;
                    $("#DivLpgDescription").css("display","none");
                    break;
                default: 
                    var lpgColor = ""; var lpgStatus = 5;
                    $("#DivLpgDescription").css("display","none");
                    break;
            }
            $("#warna_lpg").val(lpgStatus);
            $("#lpgColor").css("color",lpgColor);
        }
        jQuery(".loaderImage").hide();
    });
}

function add_facility_fields(){
    if(arr_fasilitas.length == 0) var facility = 0
    else {
        var facility = arr_fasilitas[arr_fasilitas.length - 1] +1;
    }
	var facility_opt = '';
	<?php
        foreach($facility_option as $row){
    ?>
        facility_opt += '<option value="<?= $row->FacilityId; ?>"><?= $row->FacilityName; ?></option>';
    <?php
        }
    ?>
	var inner = '';
	var objTo = document.getElementById('fasilitas_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass_fasilitas"+facility);
	divtest.setAttribute("style", "margin-bottom:0px; font-size: 12px;");
	inner +=    '<div class="col-xs-3">';
    inner +=	'	<div class="form-group">';
    inner +=	'		<select id="drp_fasilitas'+facility+'" name="drp_fasilitas'+facility+'" class="js-example-basic-single form-control">';
	inner +=                facility_opt;
	inner +=    '		</select>';
	inner +=	'	</div>';
    inner +=	'</div>';
    inner +=    '<div class="col-xs-3">';
    inner +=    '   <div class="form-group">';
    inner +=    '       <input placeholder="Plafond" type="text" style="height:38px; text-align: right; font-size: 12px;" class="form-control money" id="plafond_fasilitas'+facility+'" name="plafond_fasilitas'+facility+'" data-a-dec="." data-a-sep="," onchange="calculate_plafond();" required />';
    inner +=    '   </div>';
    inner +=    '</div>';
    inner +=    '<div class="col-xs-6">';
    inner +=    '   <div class="form-group" style="margin-bottom:0px;">';
    inner +=    '       <div class="input-group">';
    inner +=    '           <div class="div-action">';
    inner +=    '               <div style="padding-left:0px; margin-top:7px;">';
    inner +=    '                   <i class="material-icons" onclick="remove_facility_fields('+facility+');">delete</i>';
    inner +=    '               </div>';                                                                 
    inner +=    '           </div>';
    inner +=    '       </div>';
    inner +=    '   </div>';
    inner +=    '</div>'
	divtest.innerHTML = inner;
	objTo.appendChild(divtest);
    $(".js-example-basic-single").select2();
    $(".money").autoNumeric("init",{
		aForm: true,
		vMax: "99999999999999999",
	});
    arr_fasilitas.push(Number(facility));
    $("#arrFasilitasBaru").val(arr_fasilitas);
    $("#jumlahFasilitasBaru").val(arr_fasilitas.length);
}

function remove_facility_fields(rid) {
    var sumber_pipeline_value = $("#sumber_pipeline").val();
    var total_fasilitas = arr_fasilitas.length;

    if(sumber_pipeline_value == 1){
        if(total_fasilitas <= 1){
            var desc = "Anda diwajibkan mengisi minimal 1 jenis Fasilitas";
            $(".modal-notification #notification_desc").html(desc);
            $(".modal-notification").modal('show');
        }else{
            $(".removeclass_fasilitas"+rid).remove();        
            var index = arr_fasilitas.indexOf(rid);
            if (index > -1) {
                arr_fasilitas.splice(index, 1);
            }
        }
    }else{
        $(".removeclass_fasilitas"+rid).remove();        
        var index = arr_fasilitas.indexOf(rid);
        if (index > -1) {
            arr_fasilitas.splice(index, 1);
        }
    }
    $("#arrFasilitasBaru").val(arr_fasilitas);
    $("#jumlahFasilitasBaru").val(arr_fasilitas.length);
    calculate_plafond();
}

function calculate_plafond(){
    var total_plafond = 0;
    var plafond_baru = 0;
    for(var i=0; i<arr_fasilitas.length; i++){
        var index = arr_fasilitas[i];
        var plafond = $("#plafond_fasilitas"+index).autoNumeric("get");
        plafond_baru = plafond_baru + Number(plafond);
    }
    
    var plafond_suplesi = 0;
    var sumber_pipeline_value = $("#sumber_pipeline").val();
    if(sumber_pipeline_value == 2){
        var jml_plafond_suplesi = $("#jml-fasilitas-suplesi").val();
        for(var i=0; i<jml_plafond_suplesi; i++){
            var plafond = $("#plafond_baru_suplesi_"+i).autoNumeric("get");
            plafond_suplesi = plafond_suplesi + Number(plafond);
        }
    }

    total_plafond = plafond_baru + plafond_suplesi;
    $("#plafond").autoNumeric("set",total_plafond);
}
</script>