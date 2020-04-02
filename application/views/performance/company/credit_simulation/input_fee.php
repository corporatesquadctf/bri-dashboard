<div class="col-md-12 col-sm-12 col-xs-12">
    <table class="table">
        <tr class="input_form" style="background: #012D5A; color: #FFF;">
            <th>Keterangan</th>
            <th>IDR</th>
            <th>Valas</th>
        </tr>
        <?php if ($mode == 'edit') : ?>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income Simpanan</td>
                <td class="txt td-number numberOnly"  id="fee-simpanan-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_simpanan_idr']) ?> </td>
                <td class="txt td-number numberOnly"  id="fee-simpanan-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_simpanan_valas']) ?> </td>	     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income Pinjaman</td>
                <td class="txt td-number numberOnly"  id="fee-pinjaman-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_pinjaman_idr']) ?> </td>
                <td class="txt td-number numberOnly"  id="fee-pinjaman-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_pinjaman_valas']) ?> </td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Outstanding Trade Finance</td>
                <td class="txt td-number numberOnly"  id="outstanding-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['outstanding_idr']) ?> </td>
                <td class="txt td-number numberOnly"  id="outstanding-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['outstanding_valas']) ?> </td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income Trade Finance</td>
                <td class="txt td-number numberOnly"  id="fee-income-idr" contenteditable="true" style="text-align: right;"> <?= number_format($credit_simulation_fee['fee_income_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="fee-income-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income lainnya</td>
                <td class="txt td-number numberOnly"  id="fee-lainnya-idr" contenteditable="true" style="text-align: right;"> <?= number_format($credit_simulation_fee['fee_income_lainnya_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="fee-lainnya-valas" contenteditable="true" style="text-align: right"><?= number_format($credit_simulation_fee['fee_income_lainnya_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Perkreditan</td>
                <td class="txt td-number numberOnly"  id="fee-jasa-kredit-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_kredit_idr']) ?> </td>
                <td class="txt td-number numberOnly"  id="fee-jasa-kredit-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_kredit_valas']) ?> </td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Simpanan</td>
                <td class="txt td-number numberOnly"  id="fee-jasa-simpanan-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_simpanan_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="fee-jasa-simpanan-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_simpanan_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Transaksi Bisnis Internasional</td>
                <td class="txt td-number numberOnly"  id="fee-jasa-transaksi-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_bisnis_int_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="fee-jasa-transaksi-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_bisnis_int_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Transfer</td>
                <td class="txt td-number numberOnly"  id="fee-jasa-transfer-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_transfer_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="fee-jasa-transfer-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_transfer_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Beban Administrasi dan Umum</td>
                <td class="txt td-number numberOnly"  id="beban-adm-idr" contenteditable="true" style="text-align: right;"> <?= number_format($credit_simulation_fee['beban_adm_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="beban-adm-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_adm_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Beban Operasional Lain</td>
                <td class="txt td-number numberOnly"  id="beban-operasional-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_ops_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="beban-operasional-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_ops_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Beban Personalia</td>
                <td class="txt td-number numberOnly"  id="beban-personalia-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_person_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="beban-personalia-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_person_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">PPAP</td>
                <td class="txt td-number numberOnly"  id="ppap-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['ppap_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="ppap-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['ppap_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Biaya Modal</td>
                <td class="txt td-number numberOnly"  id="total-biaya-idr" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['total_biaya_modal_idr']) ?></td>
                <td class="txt td-number numberOnly"  id="total-biaya-valas" contenteditable="true" style="text-align: right;"><?= number_format($credit_simulation_fee['total_biaya_modal_valas']) ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($mode == 'view') : ?>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income Simpanan</td>
                <td class="txt numberOnly"  id="fee-simpanan-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_simpanan_idr']) ?> </td>
                <td class="txt numberOnly"  id="fee-simpanan-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_simpanan_valas']) ?> </td>      
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income Pinjaman</td>
                <td class="txt numberOnly"  id="fee-pinjaman-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_pinjaman_idr']) ?> </td>
                <td class="txt numberOnly"  id="fee-pinjaman-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_pinjaman_valas']) ?> </td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Outstanding Trade Finance</td>
                <td class="txt numberOnly"  id="outstanding-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['outstanding_idr']) ?> </td>
                <td class="txt numberOnly"  id="outstanding-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['outstanding_valas']) ?> </td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income Trade Finance</td>
                <td class="txt numberOnly"  id="fee-income-idr" contenteditable="false" style="text-align: right;"> <?= number_format($credit_simulation_fee['fee_income_idr']) ?></td>
                <td class="txt numberOnly"  id="fee-income-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_income_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Income lainnya</td>
                <td class="txt numberOnly"  id="fee-lainnya-idr" contenteditable="false" style="text-align: right;"> <?= number_format($credit_simulation_fee['fee_income_lainnya_idr']) ?></td>
                <td class="txt numberOnly"  id="fee-lainnya-valas" contenteditable="false" style="text-align: right"><?= number_format($credit_simulation_fee['fee_income_lainnya_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Perkreditan</td>
                <td class="txt numberOnly"  id="fee-jasa-kredit-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_kredit_idr']) ?> </td>
                <td class="txt numberOnly"  id="fee-jasa-kredit-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_kredit_valas']) ?> </td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Simpanan</td>
                <td class="txt numberOnly"  id="fee-jasa-simpanan-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_simpanan_idr']) ?></td>
                <td class="txt numberOnly"  id="fee-jasa-simpanan-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_simpanan_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Transaksi Bisnis Internasional</td>
                <td class="txt numberOnly"  id="fee-jasa-transaksi-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_bisnis_int_idr']) ?></td>
                <td class="txt numberOnly"  id="fee-jasa-transaksi-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_bisnis_int_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Fee Based Jasa Transfer</td>
                <td class="txt numberOnly"  id="fee-jasa-transfer-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_transfer_idr']) ?></td>
                <td class="txt numberOnly"  id="fee-jasa-transfer-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['fee_jasa_transfer_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Beban Administrasi dan Umum</td>
                <td class="txt numberOnly"  id="beban-adm-idr" contenteditable="false" style="text-align: right;"> <?= number_format($credit_simulation_fee['beban_adm_idr']) ?></td>
                <td class="txt numberOnly"  id="beban-adm-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_adm_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Beban Operasional Lain</td>
                <td class="txt numberOnly"  id="beban-operasional-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_ops_idr']) ?></td>
                <td class="txt numberOnly"  id="beban-operasional-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_ops_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Beban Personalia</td>
                <td class="txt numberOnly"  id="beban-personalia-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_person_idr']) ?></td>
                <td class="txt numberOnly"  id="beban-personalia-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['beban_person_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">PPAP</td>
                <td class="txt numberOnly"  id="ppap-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['ppap_idr']) ?></td>
                <td class="txt numberOnly"  id="ppap-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['ppap_valas']) ?></td>     
            </tr>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">Biaya Modal</td>
                <td class="txt numberOnly"  id="total-biaya-idr" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['total_biaya_modal_idr']) ?></td>
                <td class="txt numberOnly"  id="total-biaya-valas" contenteditable="false" style="text-align: right;"><?= number_format($credit_simulation_fee['total_biaya_modal_valas']) ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php if ($mode == 'edit') : ?>
    <div class="btn-annual" style="padding-top: 5px">
        <button class="btn btn-primary" onclick="saveInputFee()">
            <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
        </button>
        <p id="credit-simulation-assumptions-message"></p>
    </div>
    <?php endif; ?>
    <br><br><br>
    <div class="btn-annual" style="padding-top: 5px">
    <a target="blank" href="<?= base_url('perform/summary_cpa/view/' . $vcif); ?>" class="btn btn-info">
       <span class="glyphicon glyphicon-eye-open icon"></span> View CPA
    </a>            
    </div>
</div>


<?php if ($mode == 'edit') : ?>
    <script>
        var saveInputFee = function () { 
            let data = [];

            let feeSimpananIdr = $('#fee-simpanan-idr').text().replace(/,/g, '').trim();
            let feeSimpananVls = $('#fee-simpanan-valas').text().replace(/,/g, '').trim();
            let feePinjamanIdr = $('#fee-pinjaman-idr').text().replace(/,/g, '').trim();
            let feePinjamanVls = $('#fee-pinjaman-valas').text().replace(/,/g, '').trim();

            let outstandingIdr = $('#outstanding-idr').text().replace(/,/g, '').trim();
            let outstandingVls = $('#outstanding-valas').text().replace(/,/g, '').trim();
            let feeIncomeIdr = $('#fee-income-idr').text().replace(/,/g, '').trim();
            let feeIncomeVls = $('#fee-income-valas').text().replace(/,/g, '').trim();

            let feeLainIdr = $('#fee-lainnya-idr').text().replace(/,/g, '').trim();
            let feeLainVls = $('#fee-lainnya-valas').text().replace(/,/g, '').trim();
            let feeJasaKreditIdr = $('#fee-jasa-kredit-idr').text().replace(/,/g, '').trim();
            let feeJasaKreditVls = $('#fee-jasa-kredit-valas').text().replace(/,/g, '').trim();

            let feeJasaSimIdr = $('#fee-jasa-simpanan-idr').text().replace(/,/g, '').trim();
            let feeJasaSimVls = $('#fee-jasa-simpanan-valas').text().replace(/,/g, '').trim();
            let feeJasaTransIdr = $('#fee-jasa-transaksi-idr').text().replace(/,/g, '').trim();
            let feeJasaTransVls = $('#fee-jasa-transaksi-valas').text().replace(/,/g, '').trim();

            let feeTransferIdr = $('#fee-jasa-transfer-idr').text().replace(/,/g, '').trim();
            let feeTransferVls = $('#fee-jasa-transfer-valas').text().replace(/,/g, '').trim();
            let bebanAdmIdr = $('#beban-adm-idr').text().replace(/,/g, '').trim();
            let bebanAdmVls = $('#beban-adm-valas').text().replace(/,/g, '').trim();

            let bebanOpsIdr = $('#beban-operasional-idr').text().replace(/,/g, '').trim();
            let bebanOpsVls = $('#beban-operasional-valas').text().replace(/,/g, '').trim();
            let bebanPersonIdr = $('#beban-personalia-idr').text().replace(/,/g, '').trim();
            let bebanPersonVls = $('#beban-personalia-valas').text().replace(/,/g, '').trim();

            let ppapIdr = $('#ppap-idr').text().replace(/,/g, '').trim();
            let ppapVls = $('#ppap-valas').text().replace(/,/g, '').trim();
            let totalBiayaIdr = $('#total-biaya-idr').text().replace(/,/g, '').trim();
            let totalBiayaVls = $('#total-biaya-valas').text().replace(/,/g, '').trim();

            var request = JSON.stringify({
               vcif: '<?= $credit_simulation_fee['vcif'] ?>',
               FEE_INCOME_SIMPANAN_IDR: feeSimpananIdr,
               FEE_INCOME_SIMPANAN_VALAS: feeSimpananVls,
               FEE_INCOME_PINJAMAN_IDR: feePinjamanIdr,
               FEE_INCOME_PINJAMAN_VALAS: feePinjamanVls,
               OUTSTANDING_IDR: outstandingIdr,
               OUTSTANDING_VALAS: outstandingVls,
               FEE_INCOME_IDR: feeIncomeIdr,
               FEE_INCOME_VALAS: feeIncomeVls,
               FEE_INCOME_LAINNYA_IDR: feeLainIdr,
               FEE_INCOME_LAINNYA_VALAS: feeLainVls,
               FEE_JASA_KREDIT_IDR: feeJasaKreditIdr,
               FEE_JASA_KREDIT_VALAS: feeJasaKreditVls,
               FEE_JASA_SIMPANAN_IDR: feeJasaSimIdr,
               FEE_JASA_SIMPANAN_VALAS: feeJasaSimVls,
               FEE_JASA_BISNIS_INT_IDR: feeJasaTransIdr,
               FEE_JASA_BISNIS_INT_VALAS: feeJasaTransVls,
               FEE_JASA_TRANSFER_IDR: feeTransferIdr,
               FEE_JASA_TRANSFER_VALAS: feeTransferVls,
               BEBAN_ADM_IDR: bebanAdmIdr,
               BEBAN_ADM_VALAS: bebanAdmVls,
               BEBAN_OPS_IDR: bebanOpsIdr,
               BEBAN_OPS_VALAS: bebanOpsVls,
               BEBAN_PERSON_IDR: bebanPersonIdr,
               BEBAN_PERSON_VALAS: bebanPersonVls,
               PPAP_IDR: ppapIdr,
               PPAP_VALAS: ppapVls,
               TOTAL_BIAYA_MODAL_IDR: totalBiayaIdr,
               TOTAL_BIAYA_MODAL_VALAS: totalBiayaVls
            });

            var url = '<?= base_url('/rest/account_planning/save_fee_simulation') ?>';
                var success = function (response) {
                    new PNotify({
                        title: 'Success!',
                        text: 'Data Has Been Save.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                };

                $.post(url, request, success, 'json');
            

        }
       
        
    </script>
<?php endif; ?>