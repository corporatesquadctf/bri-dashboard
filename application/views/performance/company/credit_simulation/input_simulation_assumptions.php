</br>
<div class="form-group" style="margin-bottom: 20px;">
    <label class="control-label col-sm-2" for="pwd">Kurs USD:</label>
    <div class="col-sm-2">          
        <input 
            class="txt td-number numberOnly" 
            class="form-control" 
            id="kurs-usd"
            value="<?= $credit_simulation_assumptions['kurs_usd'] ?>"
            <?= $mode == 'view' ? 'disabled' : '' ?>
            >
    </div>
</div>
<br/>
<br/>
<div class="col-md-12 col-sm-12 col-xs-12">
    <table class="table">
        <tr class="input_form" style="background: #012D5A; color: #FFF;">
            <th></th>
            <th>IDR %</th>
            <th>Valas %</th>
        </tr>
        <?php if ($mode == 'edit') : ?>
            <tr align="center">
                <td class="txt"  contenteditable="false" style="text-align: left;">FTP Simpanan</td>
                <td class="txt td-number numberPercent bigger100"  id="ftp-simpanan-idr" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_simpanan_idr'] ?></td>
                <td class="txt td-number numberPercent bigger100"  id="ftp-simpanan-valas" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_simpanan_valas'] ?></td>		     		     
            </tr>
            <tr align="center">
                <td class="txt" contenteditable="false" style="text-align: left;">FTP Pinjaman</td>
                <td class="txt td-number numberPercent bigger100" id="ftp-pinjaman-idr" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_pinjaman_idr'] ?></td>
                <td class="txt td-number numberPercent bigger100" id="ftp-pinjaman-valas" contenteditable="true" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_pinjaman_valas'] ?></td>		     		     
            </tr>
        <?php endif; ?>

        <?php if ($mode == 'view') : ?>
            <tr align="center">
                <td class="td-disabled" style="text-align: left;">FTP Simpanan</td>
                <td class="td-disabled" id="ftp-simpanan-idr" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_simpanan_idr'] ?></td>
                <td class="td-disabled" id="ftp-simpanan-valas" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_simpanan_valas'] ?></td>		     		     
            </tr>
            <tr align="center">
                <td class="td-disabled" style="text-align: left;">FTP Pinjaman</td>
                <td class="td-disabled" id="ftp-pinjaman-idr" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_pinjaman_idr'] ?></td>
                <td class="td-disabled" id="ftp-pinjaman-valas" style="text-align: right;"><?= $credit_simulation_assumptions['ftp_pinjaman_valas'] ?></td>		     		     
            </tr>
        <?php endif; ?>
    </table>
    <?php if ($mode == 'edit') : ?>
        <div class="btn-annual">
            <button class="btn btn-primary" onclick="saveCreditSimulationAssumptions()">
                <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
            </button>
            <p id="credit-simulation-assumptions-message"></p>
        </div>
    <?php endif; ?>
</div>
<?php if ($mode == 'edit') : ?>
    <script>
        var saveCreditSimulationAssumptions = function () {

            let ftpIdr = parseFloat($('#ftp-simpanan-idr').text()).toFixed(2);
            let ftpValas = parseFloat($('#ftp-simpanan-valas').text()).toFixed(2);
            let ftp2Idr = parseFloat($('#ftp-pinjaman-idr').text()).toFixed(2);
            let ftp2Valas = parseFloat($('#ftp-pinjaman-valas').text()).toFixed(2);

            if (ftpIdr > 100.00) {
                $("#ftp-simpanan-idr").addClass('td-error');
                return;
            }

            if (ftpValas > 100.00) {
                $("#ftp-simpanan-valas").addClass('td-error');
                return;
            }

            if (ftp2Idr > 100.00) {
                $("#ftp-pinjaman-idr").addClass('td-error');
                return;
            }

            if (ftp2Valas > 100.00) {
                $("#ftp-pinjaman-valas").addClass('td-error');
                return;
            }

            var request = JSON.stringify({
                vcif: '<?= $credit_simulation_assumptions['vcif'] ?>',
                kurs_usd: $('#kurs-usd').val(),
                ftp_simpanan_idr: ftpIdr,
                ftp_simpanan_valas: ftpValas,
                ftp_pinjaman_idr: ftp2Idr,
                ftp_pinjaman_valas: ftp2Valas,
            });

            var url = '<?= base_url('/rest/account_planning/save_credit_simulation_assumptions') ?>';
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