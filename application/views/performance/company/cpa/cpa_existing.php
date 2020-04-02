<div class="col-sm-12 col-xs-12 nopadding">
    <h2>CPA Existing</h2>

    <div class="x_panel">
        <div class="x_title">
            <h2><small>Simpanan</small></h2>
           
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-bordered">
                <thead>
                    <tr class="cnfunding" style="background: #d8dae2" >
                        <th>Keterangan</th>
                        <th>IDR</th>
                        <th>Valas</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >Saldo </td>
                        <td align="right"><?= $existing['simpanan']['saldo']['IDR'] ?></td>
                        <td align="right"><?= $existing['simpanan']['saldo']['VALAS'] ?></td>
                        <td align="right"><?= $existing['simpanan']['saldo']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Ratas Harian Saldo </td>
                        <td align="right"><?= $existing['simpanan']['ratas_harian_saldo']['IDR'] ?></td>
                        <td align="right"><?= $existing['simpanan']['ratas_harian_saldo']['VALAS'] ?></td>
                        <td align="right"><?= $existing['simpanan']['ratas_harian_saldo']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Fee Based Income </td>
                        <td align="right"><?= $existing['simpanan']['fee_based_income']['IDR'] ?></td>
                        <td align="right"><?= $existing['simpanan']['fee_based_income']['VALAS'] ?></td>
                        <td align="right"><?= $existing['simpanan']['fee_based_income']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Beban Bunga </td>
                        <td align="right"><?= $existing['simpanan']['beban_bunga']['IDR'] ?></td>
                        <td align="right"><?= $existing['simpanan']['beban_bunga']['VALAS'] ?></td>
                        <td align="right"><?= $existing['simpanan']['beban_bunga']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Bunga Akumulasi </td>
                        <td align="right"><?= $existing['simpanan']['beban_bunga_akumulasi']['IDR'] ?></td>
                        <td align="right"><?= $existing['simpanan']['beban_bunga_akumulasi']['VALAS'] ?></td>
                        <td align="right"><?= $existing['simpanan']['beban_bunga_akumulasi']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Jumlah Rekening </td>
                        <td align="right"><?= $existing['simpanan']['jumlah_rekening']['IDR'] ?></td>
                        <td align="right"><?= $existing['simpanan']['jumlah_rekening']['VALAS'] ?></td>
                        <td align="right"><?= $existing['simpanan']['jumlah_rekening']['TOTAL'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2><small>Pinjaman</small></h2>
           
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-bordered">
                <thead>
                    <tr class="cnfunding" style="background: #d8dae2" >
                        <th>Keterangan</th>
                        <th>IDR</th>
                        <th>Valas</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >Nilai Tercatat </td>
                        <td align="right"><?= $existing['pinjaman']['nilai_tercatat']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['nilai_tercatat']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['nilai_tercatat']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Ratas Harian Nilai Tercatat </td>
                        <td align="right"><?= $existing['pinjaman']['nilai_tercatat_ratas']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['nilai_tercatat_ratas']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['nilai_tercatat_ratas']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Baki Debet </td>
                        <td align="right"><?= $existing['pinjaman']['baki_debet']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['baki_debet']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['baki_debet']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Ratas Harian Baki Debet </td>
                        <td align="right"><?= $existing['pinjaman']['baki_debet_ratas']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['baki_debet_ratas']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['baki_debet_ratas']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Plafond </td>
                        <td align="right"><?= $existing['pinjaman']['plafond']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['plafond']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['plafond']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Kelonggaran tarik </td>
                        <td align="right"><?= $existing['pinjaman']['kelonggaran_tarik']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['kelonggaran_tarik']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['kelonggaran_tarik']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Fee Based Income </td>
                        <td align="right"><?= $existing['pinjaman']['fee_based_income']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['fee_based_income']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['fee_based_income']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Pendapatan bunga </td>
                        <td align="right"><?= $existing['pinjaman']['pendapatan_bunga']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['pendapatan_bunga']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['pendapatan_bunga']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Pendapatan bunga akumulasi </td>
                        <td align="right"><?= $existing['pinjaman']['pendapatan_bunga_akumulasi']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['pendapatan_bunga_akumulasi']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['pendapatan_bunga_akumulasi']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Jumlah rekening </td>
                        <td align="right"><?= $existing['pinjaman']['jumlah_rekening']['IDR'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['jumlah_rekening']['VALAS'] ?></td>
                        <td align="right"><?= $existing['pinjaman']['jumlah_rekening']['TOTAL'] ?></td>
                    </tr>

                    <!-- ================SIMPANAN============= -->
                    <tr>
                        <td colspan="4" style="background: #d8dae2" class="td-head"><b>Trade Finance</b> </td>
                    </tr>
                    <tr>
                        <td >Outstanding </td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                    </tr>
                    <tr>
                        <td >Fee Based Income </td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                    </tr>
                    <tr>
                      <!-- <td >-</td> -->
                        <td >Jumlah Tf Ref </td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                    </tr>

                    <!-- ================Lain nya============= -->
                    <tr>
                        <td colspan="4" style="background: #d8dae2" class="td-head"><b>Lainnya</b>-</td>
                    </tr>
                    <tr>
                      <!-- <td >-</td> -->
                        <td >Fee Based Income </td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2><small>Laba Rugi</small></h2>
           
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table class="table table-bordered">
                <thead>
                    <tr class="cnfunding" style="background: #d8dae2" >
                        <th>Keterangan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background: #d8dae2" >
                        <td><b>Total Pendapatan Bunga</b> </td>
                        <td align="right"><?= $existing['labarugi']['pendapatan_bunga_total'] ?></td>
                    </tr>
                    <tr>
                        <td >Pendapatan Bunga </td>
                        <td align="right"><?= $existing['labarugi']['pendapatan_bunga'] ?></td>
                    </tr>
                    <tr>
                        <td >Pendapatan FTP </td>
                        <td align="right"><?= $existing['labarugi']['pendapatan_ftp'] ?></td>
                    </tr>
                    <tr>
                        <td >Provisi</td>
                        <td align="right"><?= $existing['labarugi']['pendapatan_provisi'] ?></td>
                    </tr>

                    <!-- ================Total Beban Bunga============= -->
                    <tr style="background: #d8dae2" >
                        <td><b>Total Beban Bunga</b> </td>
                        <td align="right"><?= $existing['labarugi']['beban_bunga_total'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Bunga </td>
                        <td align="right"><?= $existing['labarugi']['beban_bunga'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Bunga FTP </td>
                        <td align="right"><?= $existing['labarugi']['beban_ftp'] ?></td>
                    </tr>
                    <!-- ================NII============= -->
                    <!--
                    <tr style="background: #d8dae2" >
                        <td colspan="2"><b>NII</b> </td>
                    </tr>
                    -->
                    <tr style="background: #d8dae2">
                        <td >NII </td>
                        <td align="right"><?= $existing['labarugi']['nii'] ?></td>
                    </tr>
                    <tr style="background: #d8dae2">
                        <td >NII Dengan FTP </td>
                        <td align="right"><?= $existing['labarugi']['nii_ftp'] ?></td>
                    </tr>

                    <!-- ================Fee Based============= -->
                    <tr style="background: #d8dae2" >
                        <td><b>Fee Based</b> </td>
                        <td align="right"><?= $existing['labarugi']['fee_based_total'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Perkreditan</td>
                        <td align="right"><?= $existing['labarugi']['jasa_perkreditan'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Simpanan </td>
                        <td align="right"><?= $existing['labarugi']['jasa_simpanan'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Transaksi Bisnis Internasional </td>
                        <td align="right"><?= $existing['labarugi']['jasa_trans_bis_int'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Transfer</td>
                        <td align="right"><?= $existing['labarugi']['jasa_transfer'] ?></td>
                    </tr>

                    <!-- ================Total Biaya Operasional============= -->
                    <tr style="background: #d8dae2" >
                        <td><b>Total Biaya Operasional</b> </td>
                        <td align="right"><?= $existing['labarugi']['biaya_operasional_total'] ?></td>

                    </tr>
                    <tr>
                        <td >Beban Administrasi & Umum </td>
                        <td align="right"><?= $existing['labarugi']['beban_administrasi'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Operasional Lain </td>
                        <td align="right"><?= $existing['labarugi']['beban_lain'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Personalia </td>
                        <td align="right"><?= $existing['labarugi']['beban_personalia'] ?></td>
                    </tr>
                    <!-- ================PPAP============= -->
                    <tr style="background: #d8dae2" >
                        <td align="left"><b>PPAP</b> </td>
                        <td align="right"><?= $existing['labarugi']['sum_ppap'] ?></td>
                    </tr>
                    <!-- ================Laba Sebelum Modal============= -->

                    <tr>
                        <td >Laba Rugi Sebelum Modal Tanpa FTP </td>
                        <td align="right"><?= $existing['labarugi']['laba_rugi_sebelum'] ?></td>
                    </tr>
                    <tr>
                        <td >Laba Rugi Sebelum Modal Dengan FTP</td>
                        <td align="right"><?= $existing['labarugi']['laba_rugi_ftp_sebelum'] ?></td>
                    </tr>
                    <!-- ================Total Biaya Modal============= -->
                    <tr>
                        <td colspan="2" style="background: #d8dae2" class="td-head"><b>Total Biaya Modal</b> </td>
                    </tr>
                    <tr>
                        <td >Laba rugi tanpa FTP </td>
                        <td align="right"><?= $existing['labarugi']['total_biaya'] ?></td>
                    </tr>
                    <tr>
                        <td >Laba rugi dengan FTP</td>
                        <td align="right"><?= $existing['labarugi']['total_biaya_ftp'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
