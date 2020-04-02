<style type="text/css">
    .detail_title {
      font-weight: 600;
      font-size: 15px;
      line-height: 22px;
      letter-spacing: 0.5px;
      color: #707070;
    }

</style>

<div class="right_col" role="main">
  <div class="container">
    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel container_header">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Performance</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('performance/CustomerLeaderboard');?>">Customer Leaderboard</a></li>
                  </ol>
              </nav>
              <div class="x_title">
                <div class="page_title">
                    <div class="pull-left"><?= $details['CustomerName'] ?><!--  (<?= $details['VCIF'] ?>) --></div>
                </div>
              </div>
          </div>
      </div>
    </div>


    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel row content_container shadow_content_container">
          <div class="x_title row collapse-link" style="padding:0; margin:0;">
            <div class="col-xs-12">
                <div class="col-xs-12" style="padding: 10px 15px 15px 10px; cursor: pointer;">
                  <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Simpanan</h4>
                </div>
            </div>
          </div>
          <div class="x_content" style="margin-bottom: 10px;">
            <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if ($countSimpananVcif['NumRows'] > 500) {?>
              <button class="btn btn-success btn-sm pull-right" type="button" id="btn-download" style="margin-bottom: 20px;">Download Data Simpanan</button>
          <?php } ?>
        <?php if ($countSimpananVcif['NumRows'] <= 500) {?>
              <table width="100%" id="Simpanan_VCIF" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                  <tr class="modal_table_title">
                    <td style="text-align: left; width: 5%;">No</td>
                    <td style="text-align: left;">CIF</td>
                    <td style="text-align: left;">No Rekening</td>
                    <td style="text-align: left;" nowrap>Ratas Simpanan</td>
                    <td style="text-align: left;" nowrap>Total Simpanan</td>
                  </tr>
                </thead>
                <tbody>
        <?php if (!empty($Simpanan)) {?>
        <?php $indexSimp = 1; ?>
        <?php foreach ($Simpanan as $Simpanans => $Simpanan_row) : ?>
                  <tr>
                    <td><?= $indexSimp ?></td>
                    <td><?= $Simpanan_row['Cif'] ?></td>
                    <td><?= $Simpanan_row['NoRek'] ?></td>
                    <td><?= number_format($Simpanan_row['RatasSimpanan'], 0) ?></td>
                    <td><?= number_format($Simpanan_row['TotalSimpanan'], 0) ?></td>
                  </tr>
        <?php $indexSimp++?>
        <?php endforeach;?>
          <?php } ?>
                </tbody>
              </table>
          <?php } ?>
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel row content_container shadow_content_container">
          <div class="x_title row collapse-link" style="padding:0; margin:0;">
            <div class="col-xs-12">
                <div class="col-xs-12" style="padding: 10px 15px 15px 10px; cursor: pointer;">
                  <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Pinjaman</h4>
                </div>
            </div>
          </div>
          <div class="x_content" style="margin-bottom: 10px;">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table width="100%" id="Pinjaman_VCIF" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                  <tr class="modal_table_title">
                    <td style="text-align: left; width: 5%;">No</td>
                    <td style="text-align: left;">CIF</td>
                    <td style="text-align: left;">No Rekening</td>
                    <td style="text-align: left;" nowrap>Ratas Pinjaman</td>
                    <td style="text-align: left;" nowrap>Total Pinjaman</td>
                  </tr>
                </thead>
                <tbody>
        <?php if (!empty($Pinjaman)) {?>
        <?php $indexPinj = 1; ?>
        <?php foreach ($Pinjaman as $Pinjamans => $Pinjaman_row) : ?>
                  <tr>
                    <td><?= $indexPinj ?></td>
                    <td><?= $Pinjaman_row['Cif'] ?></td>
                    <td><?= $Pinjaman_row['NoRek'] ?></td>
                    <td><?= number_format($Pinjaman_row['RatasPinjaman'], 0) ?></td>
                    <td><?= number_format($Pinjaman_row['TotalPinjaman'], 0) ?></td>
                  </tr>
        <?php $indexPinj++?>
        <?php endforeach;?>
          <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel row content_container shadow_content_container">
          <div class="x_title row collapse-link" style="padding:0; margin:0;">
            <div class="col-xs-12">
                <div class="col-xs-12" style="padding: 10px 15px 15px 10px; cursor: pointer;">
                  <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Profitability</h4>
                </div>
            </div>
          </div>
          <div class="x_content" style="margin-bottom: 10px;">
            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel content_container shadow_content_container">
                <div class="x_title row collapse-link" style="padding:0; margin:0;">
                  <div class="col-xs-12">
                      <div class="col-xs-12" style="padding: 10px 15px 10px 10px; cursor: pointer;">
                        <h4 class="panel-title detail_title" style="font-size: 14px; font-weight: bold;"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Simpanan</h4>
                      </div>
                  </div>
                </div>
                <div class="x_content" style="margin-bottom: 10px;">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <table width="100%" class="table" cellpadding="20" cellspacing="20">
                      <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                          <tr>
                              <th style="text-align: left;">Keterangan</th>
                              <th style="text-align: right; padding-right: 20px;">Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <!-- <td align="left">1</td> -->
                              <td >Saldo </td>
                              <td align="right"><?= number_format($Existing['SaldoSimpanan']/VALUE_PER) ?></td>
                          </tr>
                          <tr>
                              <!-- <td align="left">2</td> -->
                              <td >Ratas Harian Saldo </td>
                              <td align="right"><?= number_format($Existing['AverageSaldoSimpanan']/VALUE_PER) ?></td>
                          </tr>
                          <tr>
                              <!-- <td align="left">3</td> -->
                              <td >Fee Based Income </td>
                              <td align="right"><?= number_format($Existing['AkumulasiNominalFeeSimpanan']/VALUE_PER) ?></td>
                          </tr>
                          <tr>
                              <!-- <td align="left">4</td> -->
                              <td >Beban Bunga </td>
                              <td align="right"><?= number_format($Existing['BebanBunga']/VALUE_PER) ?></td>
                          </tr>
                          <tr>
                              <!-- <td align="left">5</td> -->
                              <td >Beban Bunga Akumulasi </td>
                              <td align="right"><?= number_format($Existing['BebanBungaAkumulasi']/VALUE_PER) ?></td>
                          </tr>
                          <!-- <tr>
                              <td align="left">6</td>
                              <td >Jumlah Rekening </td>
                              <td align="right"><?= number_format($Existing['JumlahRekSimpanan']) ?></td>
                          </tr> -->
                      </tbody>
                    </table>

                  </div>

                </div>
              </div>


              <div class="x_panel content_container shadow_content_container">
                <div class="x_title row collapse-link" style="padding:0; margin:0;">
                  <div class="col-xs-12">
                      <div class="col-xs-12" style="padding: 10px 15px 10px 10px; cursor: pointer;">
                        <h4 class="panel-title detail_title" style="font-size: 14px; font-weight: bold;"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Pinjaman</h4>
                      </div>
                  </div>
                </div>
                <div class="x_content" style="margin-bottom: 10px;">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <table width="100%" class="table" cellpadding="20" cellspacing="20">
                      <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                            <tr>
                                <th style="width: 3%"><!-- No --></th>
                                <th style="text-align: left;">Keterangan</th>
                                <th style="text-align: right; padding-right: 20px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td align="left">1</td>
                                <td >Nilai Tercatat </td>
                                <td align="right"><?= number_format($Existing['NilaiTercatat']/VALUE_PER) ?></td>
                            </tr> -->
                            <!-- <tr>
                                <td align="left">2</td>
                                <td >Ratas Harian Nilai Tercatat </td>
                                <td align="right"><?= number_format($Existing['NilaiTercatatRatas']/VALUE_PER) ?></td>
                            </tr> -->
                            <tr>
                                <td align="left"><!-- 3 --></td>
                                <td >Baki Debet </td>
                                <td align="right"><?= number_format($Existing['BakiDebet']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 4 --></td>
                                <td >Ratas Harian Baki Debet </td>
                                <td align="right"><?= number_format($Existing['BakiDebetRatas']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 5 --></td>
                                <td >Plafond </td>
                                <td align="right"><?= number_format($Existing['PlafonEfektif']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 6 --></td>
                                <td >Kelonggaran tarik </td>
                                <td align="right"><?= number_format($Existing['KelonggaranTarik']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 7 --></td>
                                <td >Fee Based Income </td>
                                <td align="right"><?= number_format($Existing['AkumulasiNominalFee']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 8 --></td>
                                <td >Pendapatan bunga </td>
                                <td align="right"><?= number_format($Existing['PendapatanBunga']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 9 --></td>
                                <td >Pendapatan bunga akumulasi </td>
                                <td align="right"><?= number_format($Existing['PendapatanBungaAkumulasi']/VALUE_PER) ?></td>
                            </tr>
                            <!-- <tr>
                                <td align="left">10</td>
                                <td >Jumlah rekening </td>
                                <td align="right"><?= number_format($Existing['JumlahRekKredit']) ?></td>
                            </tr> -->

                            <!-- ================Trade Finance============= -->
                            <tr>
                                <th colspan="5" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Trade Finance</b></th>
                            </tr>
                            <tr>
                                <td align="left"><!-- 11 --></td>
                                <td >Outstanding </td>
                                <td align="right"><?= number_format($Existing['AkumulasiNominalTrxTf']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 12 --></td>
                                <td >Fee Based Income Trade Finance</td>
                                <td align="right"><?= number_format($Existing['AkumulasiNominalFeeTf']/VALUE_PER) ?></td>
                            </tr>
                            <!-- <tr>
                                <td align="left">13</td>
                                <td >Jumlah Tf Ref </td>
                                <td align="right"><?= number_format($Existing['AkumulasiJumlahTrxTf']) ?></td>
                            </tr> -->

                            <!-- ================Lain nya============= -->
                            <tr>
                                <th colspan="5" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Lainnya</b></th>
                            </tr>
                            <tr>
                                <td align="left"><!-- 14 --></td>
                                <td >Fee Based Income </td>
                                <td align="right"><?= number_format($Existing['FeeBased']/VALUE_PER) ?></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>

                </div>
              </div>


              <div class="x_panel content_container shadow_content_container">
                <div class="x_title row collapse-link" style="padding:0; margin:0;">
                  <div class="col-xs-12">
                      <div class="col-xs-12" style="padding: 10px 15px 10px 10px; cursor: pointer;">
                        <h4 class="panel-title detail_title" style="font-size: 14px; font-weight: bold;"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Laba Rugi</h4>
                      </div>
                  </div>
                </div>
                <div class="x_content" style="margin-bottom: 10px;">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <table width="100%" class="table" cellpadding="20" cellspacing="20">
                      <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                            <tr>
                                <th style="width: 3%"><!-- No --></th>
                                <th style="width: 40%; text-align: left;">Keterangan</th>
                                <th style="text-align: right; padding-right: 20px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Pendapatan Bunga</b> </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format(($Existing['PendapatanBunga'] + $Existing['PendapatanFtp'])/VALUE_PER) ?></th>
                            </tr>
                            <tr>
                                <td align="left"><!-- 1 --></td>
                                <td >Pendapatan Bunga </td>
                                <td align="right"><?= number_format($Existing['PendapatanBunga']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 2 --></td>
                                <td >Pendapatan FTP </td>
                                <td align="right"><?= number_format($Existing['PendapatanFtp']/VALUE_PER) ?></td>
                            </tr>

                            <!-- ================Total Beban Bunga============= -->
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Beban Bunga</b> </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format(($Existing['BebanBunga'] + $Existing['BebanFtpAkumulasi'])/VALUE_PER) ?></th>
                            </tr>
                            <tr>
                                <td align="left"><!-- 4 --></td>
                                <td >Beban Bunga </td>
                                <td align="right"><?= number_format($Existing['BebanBunga']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 5 --></td>
                                <td >Beban Bunga FTP </td>
                                <td align="right"><?= number_format($Existing['BebanFtpAkumulasi']/VALUE_PER) ?></td>
                            </tr>
                            <!-- ================NII============= -->
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format(($Existing['PendapatanBunga'] + $Existing['Provisi'] - $Existing['BebanBunga'])/VALUE_PER) ?></th>
                            </tr>
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII Dengan FTP </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?=number_format((($Existing['PendapatanBunga'] + $Existing['PendapatanFtp']) - ($Existing['BebanBunga']+ $Existing['BebanFtpAkumulasi']))/VALUE_PER) ?></th>
                            </tr>

                            <!-- ================Fee Based============= -->
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Fee Based</b> </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format($Existing['FeeBased']/VALUE_PER) ?></th>
                            </tr>
                            <tr>
                                <td align="left"><!-- 6 --></td>
                                <td >Jasa Perkreditan*</td>
                                <td align="right">0</td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 7 --></td>
                                <td >Jasa Simpanan* </td>
                                <td align="right">0</td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 8 --></td>
                                <td >Jasa Transaksi Bisnis Internasional* </td>
                                <td align="right">0</td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 9 --></td>
                                <td >Jasa Transfer*</td>
                                <td align="right">0</td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 3 --></td>
                                <td >Provisi</td>
                                <td align="right"><?= number_format($Existing['Provisi']/VALUE_PER) ?></td>
                            </tr>

                            <!-- ================Total Biaya Operasional============= -->
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Operasional</b> </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format($Existing['TotalBiayaOperasional']/VALUE_PER) ?></th>

                            </tr>
                            <tr>
                                <td align="left"><!-- 10 --></td>
                                <td >Beban Administrasi & Umum* </td>
                                <td align="right">0</td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 11 --></td>
                                <td >Beban Operasional Lain* </td>
                                <td align="right">0</td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 12 --></td>
                                <td >Beban Personalia* </td>
                                <td align="right">0</td>
                            </tr>
                            <!-- ================PPAP============= -->
                            <tr>
                                <th colspan="2" align="left" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>PPAP</b> </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;"><?= number_format($Existing['BiayaPpap']/VALUE_PER) ?></th>
                            </tr>
                            <!-- ================Laba Sebelum Modal============= -->

                            <tr>
                                <td align="left"><!-- 13 --></td>
                                <td >Laba Rugi Sebelum Modal Tanpa FTP </td>
                                <td align="right"><?= number_format($Existing['LabaRugiSebelumModal']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 14 --></td>
                                <td >Laba Rugi Sebelum Modal Dengan FTP</td>
                                <td align="right"><?= number_format($Existing['LabaRugiFtpSeblumModal']/VALUE_PER) ?></td>
                            </tr>
                            <!-- ================Total Biaya Modal============= -->
                            <tr>
                                <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Modal</b> </th>
                                <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format($Existing['BiayaModal']/VALUE_PER) ?></th>
                            </tr>
                            <tr>
                                <td align="left"><!-- 15 --></td>
                                <td >Laba rugi tanpa FTP </td>
                                <td align="right"><?= number_format($Existing['LabaRugiSetelahModal']/VALUE_PER) ?></td>
                            </tr>
                            <tr>
                                <td align="left"><!-- 16 --></td>
                                <td >Laba rugi dengan FTP</td>
                                <td align="right"><?= number_format($Existing['LabaRugiFtpSetelahModal']/VALUE_PER) ?></td>
                            </tr>
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

<!-- 
    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel row content_container shadow_content_container">
          <div class="x_title row collapse-link" style="padding:0; margin:0;">
            <div class="col-xs-12">
                <div class="col-xs-12" style="padding: 10px 15px 15px 10px; cursor: pointer;">
                  <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> RoRa</h4>
                </div>
            </div>
          </div>
          <div class="x_content" style="margin-bottom: 10px;">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                  <tr class="modal_table_title">
                    <td style="text-align: left; width: 5%;">No</td>
                    <td style="text-align: left;">CIF</td>
                    <td style="text-align: left;">No Rekening</td>
                    <td style="text-align: left;" nowrap>Nama Debitur</td>
                    <td style="text-align: left;" nowrap>Sektor Industri</td>
                    <td style="text-align: left;">EAD</td>
                    <td style="text-align: left;">Expected Loss</td>
                    <td style="text-align: left;">RaRoc</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
 -->
 <!-- 
    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel row content_container shadow_content_container">
          <div class="x_title row collapse-link" style="padding:0; margin:0;">
            <div class="col-xs-12">
                <div class="col-xs-12" style="padding: 10px 15px 15px 10px; cursor: pointer;">
                  <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> RaRoc</h4>
                </div>
            </div>
          </div>
          <div class="x_content" style="margin-bottom: 10px;">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                  <tr class="modal_table_title">
                    <td style="text-align: left; width: 5%;">No</td>
                    <td style="text-align: left;">CIF</td>
                    <td style="text-align: left;">No Rekening</td>
                    <td style="text-align: left;" nowrap>Nama Debitur</td>
                    <td style="text-align: left;" nowrap>Sektor Industri</td>
                    <td style="text-align: left;">EAD</td>
                    <td style="text-align: left;">Expected Loss</td>
                    <td style="text-align: left;">RaRoc</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
 -->


  </div>
</div>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

  $(document).ready(function(){
    $('#btn-download').click(function(e){
      e.preventDefault();
      document.location.href = "<?=site_url($link_export_simpanan)?>";
    });
    $('#Simpanan_VCIF').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });
    $('#Pinjaman_VCIF').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });
  });  
</script>