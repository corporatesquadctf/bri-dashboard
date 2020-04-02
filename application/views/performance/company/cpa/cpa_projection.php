
<div class="col-sm-12 col-xs-12 nopadding">
    <h2>CPA Projection</h2>

    <div class="x_panel">
        <div class="x_title">
            <h2><small>Assumptions</small></h2>
          
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="form-group" style="margin-bottom: 20px;">
                <label class="control-label col-sm-2" for="pwd">Kurs USD:</label>
                <div class="col-sm-2">    
                <div><?= $credit_simulation_assumptions['kurs_usd'] ?></div>
                    <!--
                    <input 
                        type="number" 
                        class="form-control" 
                        id="kurs-usd"
                        value="<?= $credit_simulation_assumptions['kurs_usd'] ?>"
                        >
-->
                </div>
            </div>
            <br/>
            <br/>

            <table class="table">
                <tr class="input_form" style="background: #012D5A; color: #FFF;">
                    <th></th>
                    <th>IDR</th>
                    <th>Valas </th>
                </tr>
                <tr align="center">
                    <td class="txt" contenteditable="false" style="text-align: left;">FTP Simpanan</td>
                    <td class="txt" id="ftp-simpanan-idr" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_simpanan_idr'] ?></td>
                    <td class="txt" id="ftp-simpanan-valas" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_simpanan_valas'] ?></td>		     		     
                </tr>
                <tr align="center">
                    <td class="txt" contenteditable="falase" style="text-align: left;">FTP Pinjaman</td>
                    <td class="txt" id="ftp-pinjaman-idr" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_pinjaman_idr'] ?></td>
                    <td class="txt" id="ftp-pinjaman-valas" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_pinjaman_valas'] ?></td>		     		     
                </tr>
            </table>
        </div>
    </div>

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
                        <td align="right"><?= $projection['simpanan']['saldo']['IDR'] ?></td>
                        <td align="right"><?= $projection['simpanan']['saldo']['VALAS'] ?></td>
                        <td align="right"><?= $projection['simpanan']['saldo']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Ratas Harian Saldo </td>
                        <td align="right"><?= $projection['simpanan']['ratas_harian_saldo']['IDR'] ?></td>
                        <td align="right"><?= $projection['simpanan']['ratas_harian_saldo']['VALAS'] ?></td>
                        <td align="right"><?= $projection['simpanan']['ratas_harian_saldo']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Fee Based Income </td>
                        <td align="right"><?= $projection['simpanan']['fee_based_income']['IDR'] ?></td>
                        <td align="right"><?= $projection['simpanan']['fee_based_income']['VALAS'] ?></td>
                        <td align="right"><?= $projection['simpanan']['fee_based_income']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Beban Bunga </td>
                        <td align="right"><?= $projection['simpanan']['beban_bunga']['IDR'] ?></td>
                        <td align="right"><?= $projection['simpanan']['beban_bunga']['VALAS'] ?></td>
                        <td align="right"><?= $projection['simpanan']['beban_bunga']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Bunga Akumulasi </td>
                        <td align="right"><?= $projection['simpanan']['beban_bunga_akumulasi']['IDR'] ?></td>
                        <td align="right"><?= $projection['simpanan']['beban_bunga_akumulasi']['VALAS'] ?></td>
                        <td align="right"><?= $projection['simpanan']['beban_bunga_akumulasi']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Jumlah Rekening </td>
                        <td align="right"><?= $projection['simpanan']['jumlah_rekening']['IDR'] ?></td>
                        <td align="right"><?= $projection['simpanan']['jumlah_rekening']['VALAS'] ?></td>
                        <td align="right"><?= $projection['simpanan']['jumlah_rekening']['TOTAL'] ?></td>
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
                        <td align="right"><?= $projection['pinjaman']['nilai_tercatat']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['nilai_tercatat']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['nilai_tercatat']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Ratas Harian Nilai Tercatat </td>
                        <td align="right"><?= $projection['pinjaman']['nilai_tercatat_ratas']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['nilai_tercatat_ratas']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['nilai_tercatat_ratas']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Baki Debet </td>
                        <td align="right"><?= $projection['pinjaman']['baki_debet']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['baki_debet']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['baki_debet']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Ratas Harian Baki Debet </td>
                        <td align="right"><?= $projection['pinjaman']['baki_debet_ratas']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['baki_debet_ratas']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['baki_debet_ratas']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Plafond </td>
                        <td align="right"><?= $projection['pinjaman']['plafond']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['plafond']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['plafond']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Kelonggaran tarik </td>
                        <td align="right"><?= $projection['pinjaman']['kelonggaran_tarik']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['kelonggaran_tarik']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['kelonggaran_tarik']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Fee Based Income </td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income_pinjaman']['IDR']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income_pinjaman']['VALAS']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income_pinjaman']['TOTAL']) ?></td>
                    </tr>
                    <tr>
                      <!-- <td >1</td> -->
                        <td >Pendapatan bunga </td>
                        <td align="right"><?= $projection['pinjaman']['pendapatan_bunga']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['pendapatan_bunga']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['pendapatan_bunga']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Pendapatan bunga akumulasi </td>
                        <td align="right"><?= $projection['pinjaman']['pendapatan_bunga_akumulasi']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['pendapatan_bunga_akumulasi']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['pendapatan_bunga_akumulasi']['TOTAL'] ?></td>
                    </tr>
                    <tr>
                        <td >Jumlah rekening </td>
                        <td align="right"><?= $projection['pinjaman']['jumlah_rekening']['IDR'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['jumlah_rekening']['VALAS'] ?></td>
                        <td align="right"><?= $projection['pinjaman']['jumlah_rekening']['TOTAL'] ?></td>
                    </tr>

                    <!-- ================SIMPANAN============= -->
                    <tr>
                        <td colspan="4" style="background: #d8dae2" class="td-head"><b>Trade Finance</b> </td>
                    </tr>
                    <tr>
                        <td >Outstanding </td>
                        <td align="right"><?= number_format($projection['pinjaman']['outstanding']['IDR']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['outstanding']['VALAS']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['outstanding']['TOTAL']) ?></td>
                    </tr>
                    <tr>
                        <td >Fee Based Income </td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income']['IDR']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income']['VALAS']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income']['TOTAL']) ?></td>
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
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income_lainnya']['IDR']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income_lainnya']['VALAS']) ?></td>
                        <td align="right"><?= number_format($projection['pinjaman']['fee_income_lainnya']['TOTAL']) ?></td>
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
                        <td ><b>Total Pendapatan Bunga</b> </td>
                        <td align="right"><?= $projection['labarugi']['pendapatan_bunga_total'] ?></td>
                    </tr>
                    <tr>
                        <td >Pendapatan Bunga </td>
                        <td align="right"><?= $projection['labarugi']['pendapatan_bunga'] ?></td>
                    </tr>
                    <tr>
                        <td >Pendapatan FTP </td>
                        <td align="right"><?= $projection['labarugi']['pendapatan_ftp'] ?></td>
                    </tr>
                    <tr>
                        <td >Provisi</td>
                        <td align="right"><?= $projection['labarugi']['pendapatan_provisi'] ?></td>
                    </tr>

                    <!-- ================Total Beban Bunga============= -->
                    <tr style="background: #d8dae2" >
                        <td ><b>Total Beban Bunga</b> </td>
                        <td align="right"><?= $projection['labarugi']['beban_bunga_total'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Bunga </td>
                        <td align="right"><?= $projection['labarugi']['beban_bunga'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Bunga FTP </td>
                        <td align="right"><?= $projection['labarugi']['beban_ftp'] ?></td>
                    </tr>
                    <!-- ================NII============= -->
                    <!--
                    <tr style="background: #d8dae2" >
                        <td colspan="2"><b>NII</b> </td>
                    </tr>
                    -->
                    <tr style="background: #d8dae2">
                        <td >NII </td>
                        <td align="right"><?= $projection['labarugi']['nii'] ?></td>
                    </tr>
                    <tr style="background: #d8dae2">
                        <td >NII Dengan FTP </td>
                        <td align="right"><?= $projection['labarugi']['nii_ftp'] ?></td>
                    </tr>

                    <!-- ================Fee Based============= -->
                    <tr style="background: #d8dae2" >
                        <td><b>Fee Based</b> </td>
                        <td align="right"><?= $projection['labarugi']['fee_based_total'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Perkreditan</td>
                        <td align="right"><?= $projection['labarugi']['jasa_perkreditan'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Simpanan </td>
                        <td align="right"><?= $projection['labarugi']['jasa_simpanan'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Transaksi Bisnis Internasional </td>
                        <td align="right"><?= $projection['labarugi']['jasa_trans_bis_int'] ?></td>
                    </tr>
                    <tr>
                        <td >Jasa Transfer</td>
                        <td align="right"><?= $projection['labarugi']['jasa_transfer'] ?></td>
                    </tr>

                    <!-- ================Total Biaya Operasional============= -->
                    <tr style="background: #d8dae2" >
                        <td><b>Total Biaya Operasional</b> </td>
                        <td align="right"><?= number_format($projection['labarugi']['operasional_total']) ?></td>

                    </tr>
                    <tr>
                        <td >Beban Administrasi & Umum </td>
                        <td align="right"><?= $projection['labarugi']['beban_administrasi'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Operasional Lain </td>
                        <td align="right"><?= $projection['labarugi']['beban_lain'] ?></td>
                    </tr>
                    <tr>
                        <td >Beban Personalia </td>
                        <td align="right"><?= $projection['labarugi']['beban_personalia'] ?></td>
                    </tr>
                    <!-- ================PPAP============= -->
                    <tr style="background: #d8dae2" >
                        <td ><b>PPAP</b> </td>
                        <td align="right"><?= $projection['labarugi']['sum_ppap'] ?></td>
                    </tr>
                    <!-- ================Laba Sebelum Modal============= -->

                    <tr>
                        <td >Laba Rugi Sebelum Modal Tanpa FTP </td>
                        <td align="right"><?= $projection['labarugi']['laba_rugi_sebelum'] ?></td>
                    </tr>
                    <tr>
                        <td >Laba Rugi Sebelum Modal Dengan FTP</td>
                        <td align="right"><?= $projection['labarugi']['laba_rugi_ftp_sebelum'] ?></td>
                    </tr>
                    <!-- ================Total Biaya Modal============= -->
                    <tr style="background: #d8dae2">
                        <td ><b>Total Biaya Modal</b> </td>
                        <td align="right"><?= $projection['labarugi']['biaya_modal'] ?></td>
                    </tr>
                    <tr>
                        <td >Laba rugi tanpa FTP </td>
                        <td align="right"><?= $projection['labarugi']['total_biaya'] ?></td>
                    </tr>
                    <tr>
                        <td >Laba rugi dengan FTP</td>
                        <td align="right"><?= $projection['labarugi']['total_biaya_ftp'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- DONE -->