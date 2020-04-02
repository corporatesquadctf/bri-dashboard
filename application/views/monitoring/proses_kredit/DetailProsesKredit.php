<style>
    .bootstrap-datetimepicker-widget .picker-switch td span{
        margin: 0;
    }
    .table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
        padding: 2px;
    }
    .yscroller::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    .yscroller::-webkit-scrollbar
    {
        width: 7px;
        background-color: #F5F5F5;
    }
    .yscroller::-webkit-scrollbar-thumb
    {
        background-color: #218FD8;
    }
    .edit_tanggapan:hover{
        cursor: pointer;
    }
    .checkbox, .radio {
        margin-top: 5px;
        margin-bottom: 5px;
    }
</style>
<div class="right_col" role="main">    
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Monitoring</li>
                            <li class="breadcrumb-item"><a href="<?= base_url().'monitoring/proseskredit'; ?>">Proses Kredit</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Detail Proses Kredit</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="row hyphenate">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php
                            $startDate = date("Y-m-d", strtotime($prosesKredit->CreatedDate));
                            $startDateTime = strtotime($startDate);
                            $endDate = $prosesKredit->TanggalPutusan;
                            if($endDate == null){
                                $endDate = date("Y-m-d");
                            }else{
                                $endDate = date("Y-m-d", strtotime($prosesKredit->TanggalPutusan));
                            }
                            $endDateTime = strtotime($endDate);
                            $difference = $endDateTime - $startDateTime;
                            $TAT = floor($difference / (60*60*24) );                
                            if($TAT < 0) $TAT = 0;
                        ?>
                        <div class="row">
                            <div class="col-xs-12 col-lg-8">
                            
                                <div class="row">
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Debitur :</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $pipeline->CustomerName; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Status Permohonan :</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $pipeline->DataSourceName; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Usulan Plafond :</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight:normal;" class="money" data-a-sep="," data-a-dec="."><?= $pipeline->TotalPlafondPermohonan; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">TAT :</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $TAT; ?> Hari</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-4">
                                <?php
                                    if($prosesKredit->StatusPutusan == 0){
                                        if($prosesKredit->StatusApplicationId == $roleId) :
                                            echo '<button id="btn_teruskan_proses_kredit" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Kirim</button>';
                                            if($roleId != 12) :
                                                echo '<button id="btn_kembalikan_proses_kredit" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button" data-toggle="modal" data-target=".modal-kembalikan-proses-kredit">Kembalikan</button>';
                                            endif;
                                        endif;
                                    }else if($prosesKredit->StatusPutusan == 1){
                                        if($roleId == 17 && $prosesKredit->StatusApplicationId == 17 && $prosesKredit->IsAkad == 0):
                                            echo '<button id="btn_akad_kredit" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button" data-toggle="modal" data-target=".modal-akad-kredit">Akad Kredit</button>';
                                        endif;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($prosesKredit->IsAkad == 1): ?>
        <div class="row hyphenate">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12 col-lg-8">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Tanggal Akad:</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= date("d F Y", strtotime($prosesKredit->TanggalAkad)); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Nama Notaris:</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight: normal;"><?= $prosesKredit->NamaNotaris; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="form-group col-xs-12"><label style="color: #218FD8;">Keterangan:</label></div>
                                        <div class="form-group col-xs-12">
                                            <label style="font-weight:normal;"><?= $prosesKredit->Keterangan; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row hyphenate">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div style="display: flow-root;">
                            <label style="font-weight: 600; font-size: 14px; color: #218FD8; margin: 0 10px;">LKN</label>
                            <a href="<?= base_url("export/dokumen_lkn/".$prosesKredit->ProsesKreditId); ?>" target="_blank" class="btn btn-sm btn-primary pull-right" style="margin-bottom:0px; font-size: 12px;" type="button">Export Dokumen LKN</a>
                        </div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label>Nama Debitur</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label style="font-weight: 600; font-size: 14px; color: #000;"><?= $prosesKredit->CustomerName; ?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label>Alamat</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label style="font-weight: 600; font-size: 14px; color: #000;"><?= $prosesKredit->Address; ?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label>Waktu Kunjungan</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label style="font-weight: 600; font-size: 14px; color: #000;"><?= $WaktuKunjungan = empty($prosesKredit->WaktuKunjungan) ? "-": date("Y-m-d h:i:s", strtotime($prosesKredit->WaktuKunjungan)); ?></label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label>Hasil Kunjungan</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label style="font-weight: 600; font-size: 14px; color: #000;"><?= $prosesKredit->HasilKunjungan; ?></label></div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;">
                                        <label>Tanggapan Atasan</label>
                                        <?php if($roleId == USER_ROLE_WP || $roleId == USER_ROLE_KADIV): ?>
                                            <img class="edit_tanggapan" src="<?= base_url("assets/images/icons/edit2.svg"); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="padding: 0 20px;"><label style="font-weight: 600; font-size: 14px; color: #000;"><?= $prosesKredit->Tanggapan; ?></label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hyphenate">
            <div class="col-xs-6">
                <div class="x_panel">
                    <div class="x_title">
                        <div style="display: flow-root;">
                        <label style="font-weight: 600; font-size: 14px; color: #218FD8; margin: 0 10px;">Surat Permohonan</label>
                        <a href="<?= base_url("export/surat_permohonan/".$prosesKredit->ProsesKreditId); ?>" target="_blank" class="btn btn-sm btn-primary pull-right" style="margin-bottom:0px; font-size: 12px;" type="button">Export Surat Permohonan</a>
                        </div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0 20px;"><label>Jangka Waktu (Bulan)</label></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0 20px;"><label style="font-weight: 600; font-size: 14px; color: #000;"><?= $prosesKredit->JangkaWaktu; ?></label></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0 20px;"><label>Fasilitas</label></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0 20px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding: 5px; font-weight: 600; font-size: 14px; color: #000; border: 1px solid #ddd; width: 10%;">No</td>
                                        <td style="padding: 5px; font-weight: 600; font-size: 14px; color: #000; border: 1px solid #ddd; width: 40%;">Fasilitas</td>
                                        <td style="padding: 5px; font-weight: 600; font-size: 14px; color: #000; border: 1px solid #ddd; width: 50%; text-align: right;">Plafond</td>
                                    </tr>
                                <?php 
                                    $totalPlafond = 0;
                                    if(!empty($fasilitasPermohonan)):
                                        $i=1;
                                        foreach($fasilitasPermohonan as $row):
                                            $totalPlafond += $row->Plafond;
                                ?>
                                            <tr>
                                                <td style="padding: 5px; font-weight: 600; font-size: 14px; color: #000; border: 1px solid #ddd;"><?= $i; ?>.</td>
                                                <td style="padding: 5px; font-weight: 600; font-size: 14px; color: #000; border: 1px solid #ddd;"><?= $row->FacilityName; ?></td>
                                                <td style="padding: 5px; font-weight: 600; font-size: 14px; color: #000; border: 1px solid #ddd; text-align: right;" class="money" data-a-sep="," data-a-dec="."><?= $row->Plafond; ?></td>
                                            </tr>
                                <?php
                                        $i++; endforeach;
                                    endif;
                                ?>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-xs-12" style="padding: 0 20px;"><label>Total Plafond Usulan</label></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0 20px;"><label class="total" data-a-sep="," data-a-dec="." style="font-weight: 600; font-size: 14px; color: #000;"><?= $totalPlafond; ?></label></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="x_panel">
                    <div class="x_title">
                        <label style="font-weight: 600; font-size: 14px; color: #218FD8; margin: 0 10px;">Daftar Kelengkapan Dokumen</label>
                        <a href="<?= base_url("export/kelengkapan_dokumen/".$prosesKredit->ProsesKreditId); ?>" target="_blank" class="btn btn-sm btn-primary pull-right" style="margin-bottom:0px; font-size: 12px;" type="button">Export Kelengkapan Dokumen</a>
                    </div>
                    <div class="x_content">
                    <?php foreach($ProsesKreditDocument as $row): 
                            $imgStatus = "unchecked_document.svg";
                            if($row->Status == 1)
                                $imgStatus = "checked_document.svg";
                        ?>
                    <div class="row form-group">
                        <div class="col-xs-1" style="padding: 0 20px;">
                            <img src="<?= base_url("assets/images/icons/".$imgStatus); ?>" />
                        </div>
                        <div class="col-xs-11" style="padding: 0 20px 0 0;">
                            <label style="font-weight: 600; font-size: 14px; color: #000; margin: 1px 0 0 0;"><?= $row->Name; ?></label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-1" style="padding: 0 20px;">
                        </div>
                        <div class="col-xs-11" style="padding: 0 20px 0 0;">
                            <label style="font-weight: normal; font-size: 14px; color: #000;"><?= $row->Description; ?></label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    </div>               
                </div>
            </div>
        </div>
        <?php if(!empty($commentKadiv)): ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12 col-lg-8">
                                <div class="row">
                                    <div class="col-sm-2 col-xs-12">
                                        <label class="control-label">Komentar Kadiv</label>
                                    </div>
                                    <div class="col-sm-10 col-xs-12">
                                        <table>
                                        <?php foreach($commentKadiv as $row){
                                            if($row->Comment == NULL) continue;
                                            echo '<tr>';
                                            echo '<td>'.date("d F Y H:i:s", strtotime($row->CreatedDate)).'</td>';
                                            echo '<td style="padding:0 5px;">-</td>';
                                            echo '<td>['.$row->CreatedByName.']</td>';
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
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <?php 
                $visitedRM = '';
                $visitedADK = '';
                $visitedARK = '';
                $visitedKomite = '';
                if(!empty($historyProsesKreditRM)) $visitedRM = "ellipse-visited";
                if(!empty($historyProsesKreditADK)) $visitedADK = "ellipse-visited";
                if(!empty($historyProsesKreditARK)) $visitedARK = "ellipse-visited";
                if(!empty($historyProsesKreditKomite) || !empty($historyProsesKreditKadiv)) $visitedKomite = "ellipse-visited";
                
                $activeRM = '';
                $activeADK = '';
                $activeARK = '';
                $activeKomite = '';
                switch($prosesKredit->StatusApplicationId){
                    case 12: $activeRM = 'ellipse-active'; break;
                    case 14: $activeKomite = 'ellipse-active'; break;
                    case 17: 
                        if($prosesKredit->StatusPutusan == 0){
                            $activeADK = 'ellipse-active'; 
                        }else{
                            $activeADK = 'ellipse-finished';
                        }                        
                        break;
                    case 18: $activeARK = 'ellipse-active'; break;
                    default: break;
                }
            ?>
            <div class="col-xs-12">
                <div class="x_panel" style="background:none; border:none; padding: 0px;">
                    <div class="x_content" style="padding:0px; margin-top:0px;">
                        <div class="dashboard-widget-content" style="padding:0px;">
                            <ul class="list-unstyled widget" style="max-width: none;">
                                <li class="li-card">
                                    <?php
                                        if(!empty($historyProsesKreditKomite)){
                                            $komiteDesc = $historyProsesKreditKomite[0]->CreatedByName;
                                            if($historyProsesKreditKomite[0]->IsApproved == 1){
                                                $komiteDesc .= ' Mengirim Paket ke ';
                                            }else $komiteDesc .= ' Mengembalikan Paket ke ';
                                            $komiteDesc .= $historyProsesKreditKomite[0]->ROLE_NAME;
                                            $komiteLastDescription = $komiteDesc;
                                            $komiteLastDate = date("d F Y H:i:s", strtotime($historyProsesKreditKomite[0]->CreatedDate));
                                            $komiteLastComment = $historyProsesKreditKomite[0]->Comment;
                                        }else{
                                            $komiteLastDescription = '-';
                                            $komiteLastDate = '-';
                                            $komiteLastComment = '-';
                                        }
                                    ?>
                                    <div class="ellipse <?= $visitedKomite.' '.$activeKomite; ?>"></div>
                                    <div class="li-block" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                                        <div class="block_content">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group col-xs-12">
                                                        <label style="color: #218FD8; font-weight: bold; font-size:20px;">Komite</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">contacts</i>
                                                            <label>Aktifitas</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: bold; color:#000;"><?= $komiteLastDescription; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">today</i>
                                                            <label>Tanggal</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $komiteLastDate; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">comment</i>
                                                            <label>Komentar</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $komiteLastComment; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="li-block" style="padding: 0px;">
                                        <div class="block-content">
                                            <div class="row detail_div" id="rowDetailKomite">
                                                <div class="col-xs-12">
                                                <?php
                                                    $iKomite = 0;
                                                    if(count($historyProsesKreditKomite) < 2){
                                                        echo '<div class="row" style="margin:0 5px;">';
                                                        echo    '<div class="col-xs-12" style="text-align:center; margin-bottom:5px;">';
                                                        echo    'Tidak Ada Data Detail';
                                                        echo    '</div>';
                                                        echo '</div>';
                                                    }else{
                                                    foreach($historyProsesKreditKomite as $row) {
                                                        $iKomite++;
                                                        if($iKomite == 1) continue;
                                                        $detailKomiteDesc = $row->CreatedByName;
                                                        if($row->IsApproved == 1){
                                                            $detailKomiteDesc .= ' Mengirim Paket ke ';
                                                        }else $detailKomiteDesc .= ' Mengembalikan Paket ke ';
                                                        $detailKomiteDesc .= $row->ROLE_NAME;
                                                        $detailKomiteLastDescription = $detailKomiteDesc;
                                                        $detailKomiteLastDate = date("d F Y H:i:s", strtotime($row->CreatedDate));
                                                        $detailKomiteLastComment = $row->Comment;
                                                ?>
                                                        <div class="row" style="margin:0 5px;">
                                                            <div class="col-lg-3">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">contacts</i>
                                                                        <label>Aktifitas</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: bold; color:#000;"><?= $detailKomiteLastDescription; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">today</i>
                                                                        <label>Tanggal</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailKomiteLastDate; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">comment</i>
                                                                        <label>Komentar</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailKomiteLastComment; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    <?php }} ?>                                                    
                                                </div>
                                            </div>
                                            <div class="row btn_detail_div" id="rowShowDetailKomite">
                                                <div class="col-xs-12">
                                                    <a style="display: block; padding: 5px; color: #FFF; text-align: center;">
                                                        <label id="labelDetailKomite" style="font-weight: normal; margin-bottom:0px;">Tampilkan Lebih Banyak<i class="fa fa-chevron-down" style=" margin-left:10px;"></i></label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="li-separator"></div>
                                </li>                                
                                <li class="li-card">
                                    <?php
                                        if(!empty($historyProsesKreditARK)){
                                            $ARKDesc = $historyProsesKreditARK[0]->CreatedByName;
                                            if($historyProsesKreditARK[0]->IsApproved == 1){
                                                $ARKDesc .= ' Mengirim Paket ke ';
                                            }else $ARKDesc .= 'Mengembalikan Paket ke ';
                                            $ARKDesc .= $historyProsesKreditARK[0]->ROLE_NAME;
                                            $ARKLastDescription = $ARKDesc;
                                            $ARKLastDate = date("d F Y H:i:s", strtotime($historyProsesKreditARK[0]->CreatedDate));
                                            $ARKLastComment = $historyProsesKreditARK[0]->Comment;
                                        }else{
                                            $ARKLastDescription = '-';
                                            $ARKLastDate = '-';
                                            $ARKLastComment = '-';
                                        }
                                    ?>
                                    <div class="ellipse <?= $visitedARK.' '.$activeARK; ?>"></div>
                                    <div class="li-block" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                                        <div class="block_content">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group col-xs-12">
                                                        <label style="color: #218FD8; font-weight: bold; font-size:20px;">ARK</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">contacts</i>
                                                            <label>Aktifitas</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: bold; color:#000;"><?= $ARKLastDescription; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">today</i>
                                                            <label>Tanggal</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $ARKLastDate; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">comment</i>
                                                            <label>Komentar</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $ARKLastComment; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="li-block" style="padding: 0px;">
                                        <div class="block-content">
                                            <div class="row detail_div" id="rowDetailARK">
                                                <div class="col-xs-12">
                                                <?php
                                                    $iARK = 0;
                                                    if(count($historyProsesKreditARK) < 2){
                                                        echo '<div class="row" style="margin:0 5px;">';
                                                        echo    '<div class="col-xs-12" style="text-align:center; margin-bottom:5px;">';
                                                        echo    'Tidak Ada Data Detail';
                                                        echo    '</div>';
                                                        echo '</div>';
                                                    }else{
                                                    foreach($historyProsesKreditARK as $row) {
                                                        $iARK++;
                                                        if($iARK == 1) continue;
                                                        $detailARKDesc = $row->CreatedByName;
                                                        if($row->IsApproved == 1){
                                                            $detailARKDesc .= ' Mengirim Paket ke ';
                                                        }else $detailARKDesc .= 'Mengembalikan Paket ke ';
                                                        $detailARKDesc .= $row->ROLE_NAME;
                                                        $detailARKLastDescription = $detailARKDesc;
                                                        $detailARKLastDate = date("d F Y H:i:s", strtotime($row->CreatedDate));
                                                        $detailARKLastComment = $row->Comment;
                                                ?>
                                                        <div class="row" style="margin:0 5px;">
                                                            <div class="col-lg-3">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">contacts</i>
                                                                        <label>Aktifitas</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: bold; color:#000;"><?= $detailARKLastDescription; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">today</i>
                                                                        <label>Tanggal</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailARKLastDate; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">comment</i>
                                                                        <label>Komentar</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailARKLastComment; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    <?php }} ?>                                                    
                                                </div>
                                            </div>
                                            <div class="row btn_detail_div" id="rowShowDetailARK">
                                                <div class="col-xs-12">
                                                    <a style="display: block; padding: 5px; color: #FFF; text-align: center;">
                                                        <label id="labelDetailARK" style="font-weight: normal; margin-bottom:0px;">Tampilkan Lebih Banyak<i class="fa fa-chevron-down" style=" margin-left:10px;"></i></label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="li-separator"></div>
                                </li>
                                <li class="li-card">
                                    <?php
                                        if(!empty($historyProsesKreditADK)){
                                            $ADKDesc = $historyProsesKreditADK[0]->CreatedByName;
                                            if($historyProsesKreditADK[0]->IsApproved == 1){
                                                $ADKDesc .= ' Mengirim Paket ke ';
                                            }else $ADKDesc .= ' Mengembalikan Paket ke ';
                                            $ADKDesc .= $historyProsesKreditADK[0]->ROLE_NAME;
                                            $ADKLastDescription = $ADKDesc;
                                            $ADKLastDate = date("d F Y H:i:s", strtotime($historyProsesKreditADK[0]->CreatedDate));
                                            $ADKLastComment = $historyProsesKreditADK[0]->Comment;
                                        }else{
                                            $ADKLastDescription = '-';
                                            $ADKLastDate = '-';
                                            $ADKLastComment = '-';
                                        }
                                    ?>
                                    <div class="ellipse <?= $visitedADK.' '.$activeADK; ?>"></div>
                                    <div class="li-block" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                                        <div class="block_content">
                                        <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group col-xs-12">
                                                        <label style="color: #218FD8; font-weight: bold; font-size:20px;">ADK</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">contacts</i>
                                                            <label>Aktifitas</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: bold; color:#000;"><?= $ADKLastDescription; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">today</i>
                                                            <label>Tanggal</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $ADKLastDate; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">comment</i>
                                                            <label>Komentar</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $ADKLastComment; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="li-block" style="padding: 0px;">
                                        <div class="block-content">
                                            <div class="row detail_div" id="rowDetailADK">
                                                <div class="col-xs-12">
                                                    <?php
                                                        $iADK = 0;
                                                        if(count($historyProsesKreditADK) < 2){
                                                            echo '<div class="row" style="margin:0 5px;">';
                                                            echo    '<div class="col-xs-12" style="text-align:center; margin-bottom:5px;">';
                                                            echo    'Tidak Ada Data Detail';
                                                            echo    '</div>';
                                                            echo '</div>';
                                                        }else{
                                                        foreach($historyProsesKreditADK as $row) {
                                                            $iADK++;
                                                            if($iADK == 1) continue;
                                                            $detailADKDesc = $row->CreatedByName;
                                                            if($row->IsApproved == 1){
                                                                $detailADKDesc .= ' Mengirim Paket ke ';
                                                            }else $detailADKDesc .= ' Mengembalikan Paket ke ';
                                                            $detailADKDesc .= $row->ROLE_NAME;
                                                            $detailADKLastDescription = $detailADKDesc;
                                                            $detailADKLastDate = date("d F Y H:i:s", strtotime($row->CreatedDate));
                                                            $detailADKLastComment = $row->Comment;
                                                    ?>
                                                        <div class="row" style="margin:0 5px;">
                                                            <div class="col-lg-3">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">contacts</i>
                                                                        <label>Aktifitas</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: bold; color:#000;"><?= $detailADKLastDescription; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">today</i>
                                                                        <label>Tanggal</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailADKLastDate; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">comment</i>
                                                                        <label>Komentar</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailADKLastComment; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    <?php }} ?>                                                    
                                                </div>
                                            </div>
                                            <div class="row btn_detail_div" id="rowShowDetailADK">
                                                <div class="col-xs-12">
                                                    <a style="display: block; padding: 5px; color: #FFF; text-align: center;">
                                                        <label id="labelDetailADK" style="font-weight: normal; margin-bottom:0px;">Tampilkan Lebih Banyak<i class="fa fa-chevron-down" style=" margin-left:10px;"></i></label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="li-separator"></div>
                                </li>
                                <li class="li-card">
                                    <?php
                                        if(!empty($historyProsesKreditRM)){
                                            $RMDesc = $historyProsesKreditRM[0]->CreatedByName;
                                            if($historyProsesKreditRM[0]->IsApproved == 1){
                                                $RMDesc .= ' Mengirim Paket ke ';
                                            }else $RMDesc .= 'Mengembalikan Paket ke ';
                                            $RMDesc .= $historyProsesKreditRM[0]->ROLE_NAME;
                                            $RMLastDescription = $RMDesc;
                                            $RMLastDate = date("d F Y H:i:s", strtotime($historyProsesKreditRM[0]->CreatedDate));
                                            $RMLastComment = $historyProsesKreditRM[0]->Comment;
                                        }else{
                                            $RMLastDescription = '-';
                                            $RMLastDate = '-';
                                            $RMLastComment = '-';
                                        }
                                    ?>
                                    <div class="ellipse <?= $visitedRM.' '.$activeRM; ?>"></div>
                                    <div class="li-block" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                                        <div class="block_content">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group col-xs-12">
                                                        <label style="color: #218FD8; font-weight: bold; font-size:20px;">RM Menengah:</label>
                                                        <label style="font-weight: normal;  font-weight: bold; font-size:20px;  color:#218FD8;"><?= $prosesKredit->RMName; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">contacts</i>
                                                            <label>Aktifitas</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: bold; color:#000;"><?= $RMLastDescription; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">today</i>
                                                            <label>Tanggal</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $RMLastDate; ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group col-xs-12">
                                                        <div class="div-description">
                                                            <i class="material-icons">comment</i>
                                                            <label>Komentar</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label style="font-weight: normal;"><?= $RMLastComment; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="li-block" style="padding: 0px;">
                                        <div class="block-content">
                                            <div class="row detail_div" id="rowDetailRM">
                                                <div class="col-xs-12">
                                                    <?php
                                                        $iRM = 0;
                                                        if(count($historyProsesKreditRM) < 2){
                                                            echo '<div class="row" style="margin:0 5px;">';
                                                            echo    '<div class="col-xs-12" style="text-align:center; margin-bottom:5px;">';
                                                            echo    'Tidak Ada Data Detail';
                                                            echo    '</div>';
                                                            echo '</div>';
                                                        }else{
                                                        foreach($historyProsesKreditRM as $row) {
                                                            $iRM++;
                                                            if($iRM == 1) continue;
                                                            $detailRMDesc = $row->CreatedByName;
                                                            if($row->IsApproved == 1){
                                                                $detailRMDesc .= ' Mengirim Paket ke ';
                                                            }else $detailRMDesc .= ' Mengembalikan Paket ke ';
                                                            $detailRMDesc .= $row->ROLE_NAME;
                                                            $detailRMLastDescription = $detailRMDesc;
                                                            $detailRMLastDate = date("d F Y H:i:s", strtotime($row->CreatedDate));
                                                            $detailRMLastComment = $row->Comment;
                                                    ?>
                                                        <div class="row" style="margin:0 5px;">
                                                            <div class="col-lg-3">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">contacts</i>
                                                                        <label>Aktifitas</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: bold; color:#000;"><?= $detailRMLastDescription; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">today</i>
                                                                        <label>Tanggal</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailRMLastDate; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-group col-xs-12">
                                                                    <div class="div-description">
                                                                        <i class="material-icons">comment</i>
                                                                        <label>Komentar</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label style="font-weight: normal;"><?= $detailRMLastComment; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    <?php 
                                                        }}
                                                    ?>                                                    
                                                </div>
                                            </div>
                                            <div class="row btn_detail_div" id="rowShowDetailRM">
                                                <div class="col-xs-12">
                                                    <a style="display: block; padding: 5px; color: #FFF; text-align: center;">
                                                        <label id="labelDetailRM" style="font-weight: normal; margin-bottom:0px;">Tampilkan Lebih Banyak<i class="fa fa-chevron-down" style=" margin-left:10px;"></i></label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>            
            </div>
        </div>        
        <div class="modal fade modal-teruskan-proses-kredit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Komentar</h4>
                    </div>
                    <div class="modal-body yscroller" style="height: 500px; overflow-y: auto;">
                        <form id="formTeruskanProsesKredit" action="<?= base_url().'monitoring/proseskredit/teruskan_proses_kredit'; ?>" method="POST">
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <input type="hidden" id="prosesKreditId" name="prosesKreditId" value="<?= $prosesKredit->ProsesKreditId; ?>"> 
                                    <?php
                                        if($roleId == 14 || $roleId == 16):
                                    ?>
                                        <p style="font-weight: bold; color: #000;">Putusan:</p>
                                        <p>
                                            <label style="font-weight: normal;"><input type="radio" name="putusanId" value="1" style="margin-right:10px;">Setuju</label>
                                            <label style="font-weight: normal;"><input type="radio" name="putusanId" value="2" style="margin:0 10px;">Tolak</label>
                                            <label style="font-weight: normal;"><input type="radio" name="putusanId" value="0" style="margin:0 10px;">Tunda</label>                                        
                                        </p>
                                    <?php
                                        endif;
                                    ?>
                                    <p style="font-weight: bold; color: #000;">Tujuan:</p>
                                    <p><select class="form-control js-example-basic-single" id="tujuanDiteruskanId" name="tujuanDiteruskanId" style="width:100%;">
                                        <?php
                                            foreach ($tujuanDiteruskanOption as $row){
                                                if($row->ID == 14) $roleName = 'Komite';
                                                else $roleName = $row->ROLE_NAME;
                                                $selected = '';
                                                echo '<option value="'.$row->ID.'" '.$selected.'>'.$roleName.'</option>';
                                            }
                                        ?>                                       
                                    </select></p>
                                    <?php 
                                        if($roleId == USER_ROLE_RM_MENENGAH): 
                                            $waktuKunjungan = $prosesKredit->WaktuKunjungan != null ? date("Y-m-d h:i:s", strtotime($prosesKredit->WaktuKunjungan)) : "";
                                            $hasilKunjungan = $prosesKredit->HasilKunjungan != null ? $prosesKredit->HasilKunjungan : "";                                    
                                    ?>
                                    <p style="font-weight: bold; color: #000;">Nama Debitur:</p>
                                    <p><input type="text" class="form-control" value="<?= $prosesKredit->CustomerName; ?>" readonly /></p>
                                    <p style="font-weight: bold; color: #000;">Alamat:</p>
                                    <p><textarea class="form-control" rows="3" readonly><?= $prosesKredit->Address; ?></textarea></p>
                                    <p style="font-weight: bold; color: #000;">Waktu Kunjungan:</p>
                                    <div class="form-group">
                                        <div class='input-group date' id='myDatepicker'>
                                            <input type='text' id="waktu_kunjungan" name="waktu_kunjungan" class="form-control" style="background-color: #FFF;" value="<?= $waktuKunjungan; ?>" readonly/>
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <input type="hidden" id="hidden_waktu_kunjungan" name="hidden_waktu_kunjungan" value="<?= $waktuKunjungan; ?>" required/>
                                    </div>
                                    <p style="font-weight: bold; color: #000;">Hasil Kunjungan:</p>
                                    <p><textarea id="hasil_kunjungan" name="hasil_kunjungan" class="form-control" rows="3" maxlength="1000" required><?= $hasilKunjungan; ?></textarea></p>
                                    <?php endif; ?>
                                    <?php if($roleId == USER_ROLE_ADK): ?>
                                    <div id="document-container" style="display: none;">
                                    <p style="font-weight: bold; color: #000;">Kelengkapan Dokumen:</p>
                                    <?php foreach($ProsesKreditDocument as $row): 
                                            $checked = "";
                                            if($row->Status == 1)
                                                $checked = "checked='checked'";
                                        ?>
                                    <div class="row form-group">
                                        <div class="col-xs-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="document_proses_kredit_<?= $row->ProsesKreditDocumentId; ?>" name="document_proses_kredit_<?= $row->ProsesKreditDocumentId; ?>" class="flat" <?= $checked; ?> >
                                                    <span style="margin-left: 10px; font-weight: 600; color: #555555;"><?= $row->Name; ?></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-8">
                                            <input type="text" placeholder="Keterangan" class="form-control" id="desc_document_<?= $row->ProsesKreditDocumentId; ?>" name="desc_document_<?= $row->ProsesKreditDocumentId; ?>" value="<?= $row->Description ;?>" />
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <p style="font-weight: bold; color: #000;">Komentar:</p>
                                    <p><textarea id="comment" maxlength="100" name="comment" class="form-control" rows="3" placeholder="Max 100 Character"></textarea></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                        <button id="btn_confirm_teruskan_proses_kredit" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-kembalikan-proses-kredit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Komentar</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formBatalkanProsesKredit" action="<?= base_url().'monitoring/proseskredit/kembalikan_proses_kredit'; ?>" method="POST">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <input type="hidden" id="prosesKreditId" name="prosesKreditId" value="<?= $prosesKredit->ProsesKreditId; ?>">     
                                <p style="font-weight: bold; color: black;">Tujuan:</p>
                                <p><select class="form-control js-example-basic-single" id="tujuanDikembalikanId" name="tujuanDikembalikanId" style="width:100%;">
                                    <?php
                                            foreach ($tujuanDikembalikanOption as $row){
                                                if($row->ID == 14) $roleName = 'Komite ('.$row->ROLE_NAME.')';
                                                else $roleName = $row->ROLE_NAME;
                                                $selected = '';
                                                echo '<option value="'.$row->ID.'" '.$selected.'>'.$roleName.'</option>';
                                            }
                                        
                                    ?>                                       
                                </select></p>
                                <p style="font-weight: bold; color: #000;">Komentar:</p>
                                <p><textarea maxlength="100" id="comment" name="comment" class="form-control" rows="3" placeholder="Max 100 Character"></textarea></p>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                        <button id="btn_confirm_kembalikan_proses_kredit" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-akad-kredit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Informasi</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formAkadKredit" class="form-horizontal" action="<?= base_url().'monitoring/proseskredit/akad_kredit'; ?>" method="POST">
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <input type="hidden" id="prosesKreditId" name="prosesKreditId" value="<?= $prosesKredit->ProsesKreditId; ?>"> 
                                    <p style="font-weight: bold; color: #000;">Tanggal Akad:</p>
                                    <p>
                                        <div class='input-group date tanggalAkad' style="width:228px;">
                                            <input type='text' class="form-control tanggalAkad" id='tanggalAkad' name='tanggalAkad' />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </p>
                                    <p style="font-weight: bold; color: #000;">Nama Notaris:</p>
                                    <input type="text" id="notarisName" name="notarisName" class="form-control form-group">
                                    <p style="font-weight: bold; color: #000;">Keterangan:</p>
                                    <p><textarea id="desc" maxlength="250" name="desc" class="form-control" rows="3"></textarea></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                        <button id="btn_confirm_akad_kredit" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-tanggapan-lkn" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Informasi</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formTanggapanLKN" class="form-horizontal" action="<?= base_url().'monitoring/proseskredit/edit_tanggapan_lkn'; ?>" method="POST">
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <input type="hidden" id="prosesKreditId" name="prosesKreditId" value="<?= $prosesKredit->ProsesKreditId; ?>"> 
                                    <p style="font-weight: bold; color: #000;">Tanggapan:</p>
                                    <p><textarea id="tanggapan_lkn" name="tanggapan_lkn" maxlength="250" name="desc" class="form-control" rows="3" required></textarea></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                        <button id="btn_confirm_tanggapan" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/auto-numeric/autoNumeric.js");?>"></script>
<script src="<?= base_url("template/vendors/iCheck/icheck.min.js");?>"></script>

<script>
    var base_url = "<?= base_url(); ?>";
    var user_role = <?= $roleId; ?>;
    var showRM = 0;
    var showADK = 0;
    var showARK = 0;
    var showKomite = 0;
    var tanggalPutusan = new Date("<?= date("m/d/Y", strtotime($prosesKredit->TanggalPutusan)); ?>");
    
    $(document).ready(function() {
        $('#myDatepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            ignoreReadonly: true
        }).on('dp.change', function (e) {
            $("#hidden_waktu_kunjungan").val(e.timeStamp);
        });

        $(".money").autoNumeric("init",{
            vMax: "999999999999",
        });
        $(".total").autoNumeric("init",{
            vMax: "9999999999990",
        });
        $('.js-example-basic-single').select2();
        $('.tanggalAkad').datetimepicker({
            format: 'DD/MM/YYYY',
            minDate: tanggalPutusan,
        });

        $('.modal-kembalikan-proses-kredit #btn_confirm_kembalikan_proses_kredit').click(function(){
            //$('#formBatalkanProsesKredit').submit();
            $.ajax({
                type: "post",
                url : $("#formBatalkanProsesKredit").attr("action"),
                data: $("#formBatalkanProsesKredit").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-kembalikan-proses-kredit").modal("hide");
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
                            location.reload();
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

        $('#rowShowDetailKomite').click(function(){
            if(showKomite == 0){
                showKomite = 1;
                $('#labelDetailKomite').html('Tampilkan Lebih Sedikit <i class="fa fa-chevron-up" style=" margin-left:10px;"></i>');
                $('#rowDetailKomite').fadeIn();                
            }else{
                showKomite = 0;
                $('#labelDetailKomite').html('Tampilkan Lebih Banyak <i class="fa fa-chevron-down" style=" margin-left:10px;"></i>');
                $('#rowDetailKomite').fadeOut();                
            }
        });

        $('#rowShowDetailARK').click(function(){
            if(showARK == 0){
                showARK = 1;
                $('#labelDetailARK').html('Tampilkan Lebih Sedikit <i class="fa fa-chevron-up" style=" margin-left:10px;"></i>');
                $('#rowDetailARK').fadeIn();                
            }else{
                showARK = 0;
                $('#labelDetailARK').html('Tampilkan Lebih Banyak <i class="fa fa-chevron-down" style=" margin-left:10px;"></i>');
                $('#rowDetailARK').fadeOut();                
            }
        });

        $('#rowShowDetailADK').click(function(){
            if(showADK == 0){
                showADK = 1;
                $('#labelDetailADK').html('Tampilkan Lebih Sedikit <i class="fa fa-chevron-up" style=" margin-left:10px;"></i>');
                $('#rowDetailADK').fadeIn();                
            }else{
                showADK = 0;
                $('#labelDetailADK').html('Tampilkan Lebih Banyak <i class="fa fa-chevron-down" style=" margin-left:10px;"></i>');
                $('#rowDetailADK').fadeOut();                
            }
        });

        $('#rowShowDetailRM').click(function(){
            if(showRM == 0){
                showRM = 1;
                $('#labelDetailRM').html('Tampilkan Lebih Sedikit <i class="fa fa-chevron-up" style=" margin-left:10px;"></i>');
                $('#rowDetailRM').fadeIn();                
            }else{
                showRM = 0;
                $('#labelDetailRM').html('Tampilkan Lebih Banyak <i class="fa fa-chevron-down" style=" margin-left:10px;"></i>');
                $('#rowDetailRM').fadeOut();                
            }
        });

        /* Update Tanggapan atas LKN */
        $(".edit_tanggapan").click(function(e){
            $("#formTanggapanLKN")[0].reset();
            $(".modal-tanggapan-lkn").modal("show");
        });

        $("#btn_confirm_tanggapan").click(function(e){
            if($("#formTanggapanLKN").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#formTanggapanLKN").attr("action"),
                    data: $("#formTanggapanLKN").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-tanggapan-lkn").modal("hide");
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
                                location.reload();
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
            };
        });

        /* Teruskan Paket Kredit */
        $("#formTeruskanProsesKredit").validate({
            ignore: [],
        });
        
        $("#btn_teruskan_proses_kredit").click(function(e){
            $("#formTeruskanProsesKredit")[0].reset();
            $("#tujuanDiteruskanId").val(<?= $tujuanDiteruskanOption[0]->ID; ?>).select2().trigger('change');            
            $(".modal-teruskan-proses-kredit").modal("show");
                 
        });

        $(".modal-teruskan-proses-kredit").on("hidden.bs.modal", function (e) {
            <?php
                foreach($ProsesKreditDocument as $row):
                    $checked = "uncheck";
                    if ($row->Status == 1) $checked = "check"; 
            ?>
                $("#document_proses_kredit_<?= $row->ProsesKreditDocumentId; ?>").iCheck("<?= $checked; ?>"); 
            <?php
                endforeach;
            ?>
        })

        $("#tujuanDiteruskanId").change(function(){
            var tujuan = this.value;
            var role = <?= $roleId; ?>;
            
            if(role == <?= USER_ROLE_ADK; ?> && tujuan == 14){
                <?php
                foreach($ProsesKreditDocument as $row):
                    $checked = "uncheck";
                    if ($row->Status == 1) $checked = "check"; 
                ?>
                    $("#document_proses_kredit_<?= $row->ProsesKreditDocumentId; ?>").iCheck("<?= $checked; ?>"); 
                    $("#desc_document_<?= $row->ProsesKreditDocumentId; ?>").val("<?= $row->Description; ?>");
                <?php
                    endforeach;
                ?>
                $("#document-container").fadeIn();
            }else{
                <?php
                foreach($ProsesKreditDocument as $row):
                    $checked = "uncheck";
                    if ($row->Status == 1) $checked = "check"; 
                ?>
                    $("#document_proses_kredit_<?= $row->ProsesKreditDocumentId; ?>").iCheck("<?= $checked; ?>");                    
                    $("#desc_document_<?= $row->ProsesKreditDocumentId; ?>").val("<?= $row->Description; ?>");
                <?php
                    endforeach;
                ?>
                $("#document-container").fadeOut();
            }
        });

        $("#btn_confirm_teruskan_proses_kredit").click(function(e){
            if($("#formTeruskanProsesKredit").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#formTeruskanProsesKredit").attr("action"),
                    data: $("#formTeruskanProsesKredit").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-teruskan-proses-kredit").modal("hide");
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
                                location.reload();
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
                //$('#formTeruskanProsesKredit').submit();
            }
        });

        $('.modal-akad-kredit #btn_confirm_akad_kredit').click(function(){
            $.ajax({
                type: "post",
                url : $("#formAkadKredit").attr("action"),
                data: $("#formAkadKredit").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-akad-kredit").modal("hide");
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
                            location.reload();
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
    });
</script>