
<style type="text/css">
    .cntr{
        text-align: center;
    }
</style>

<?php foreach ($credit_simulations as $credit_simulation_id => $credit_simulation): ?>
    <b><?= $credit_simulation['name'] ?></b>
    <div>
        <table id="credit-simulation-group-<?= $credit_simulation_id ?>"
               >
            <thead align="center">
                <tr class="input_form cntr" style="background: #012D5A; color: #FFF;">
                    <th>IDR Plafond</th>
                    <th>Valas Plafond</th>
                    <th>IDR Outstanding</th>
                    <th>Valas Outstanding</th>
                    <th>IDR Ratas Harian</th>
                    <th>Valas Ratas Harian</th>
                    <th>IDR Tenor (Bulan)</th>
                    <th>Valas Tenor (Bulan)</th>
                    <th>IDR Indicative Rate (%)</th>
                    <th>Valas Indicative Rate (%)</th>
                    <th>IDR Income / Expense</th>
                    <th>Valas Income / Expense</th>
                    <th>IDR Provision Rate (%)</th>
                    <th>Valas Provision Rate (%)</th>
                    <th>IDR Provision</th>
                    <th>Valas Provision</th>
                    <th>IDR Fee</th>
                    <th>Valas Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($credit_simulation['details'] as $credit_simulation_detail_id => $credit_simulation_detail) : ?>
                    <tr align="center"
                        data-id="<?= $credit_simulation_detail_id ?>"
                        data-mandatory="<?= $credit_simulation_detail['mandatory'] ? 'true' : 'false' ?>">
                        <td 
                            style="text-align: right;">
                                <?= $credit_simulation_detail['detail_name'] ?>
                        </td>
                        <?php
                        $fields = array('plafond_idr', 'plafond_valas',
                            'outstanding_idr', 'outstanding_valas',
                            'ratas_harian_idr', 'ratas_harian_valas',
                            'tenor_idr', 'tenor_valas',
                            'indicative_rate_idr', 'indicative_rate_valas',
                            'income_expense_idr', 'income_expense_valas',
                            'provision_rate_idr', 'provision_rate_valas',
                            'provision_idr', 'provision_valas',
                            'fee_idr', 'fee_valas')
                        ?>

                        <?php foreach ($fields as $field): ?>
                            <td class="txt td-number numberOnly"
                                data-field-name="<?= $field ?>"   
                                style="text-align: right;"
                                >
                                    <?= $credit_simulation_detail[$field] ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($mode == 'edit') : ?>
        <div class="btn-annual" style="padding-top: 5px;">
            <button class="btn btn-primary" onclick="saveCreditSimulation(<?= $credit_simulation_id ?>)">
                <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
            </button>
        </div>
        <p id="credit-simulation-message-<?= $credit_simulation_id ?>"></p>
    <?php endif; ?>
<?php endforeach; ?>
<br><br>


<?php if ($mode == 'edit') : ?>

    <script>
        var parseNum = function (a) {
            a = a.replace(/,/g, '');
            return a.trim();
        };
        $(".indicative_rate_idr").on("blur", function (e) {
            let a = e.currentTarget.innerText;
            let b = parseFloat(parseNum(a)).toFixed(2);
            if (b >= 100.00) {
                $(this).addClass('td-error');
                return;
            } else {
                $(this).removeClass('td-error');
            }
            e.currentTarget.innerText = b;
        });
        $(".indicative_rate_valas").on("blur", function (e) {
            let a = e.currentTarget.innerText;
            let b = parseFloat(parseNum(a)).toFixed(2);
            if (b >= 100.00) {
                $(this).addClass('td-error');
                return;
            } else {
                $(this).removeClass('td-error');
            }
            e.currentTarget.innerText = b;
        });
        $(".provision_rate_idr").on("blur", function (e) {
            let a = e.currentTarget.innerText;
            let b = parseFloat(parseNum(a)).toFixed(2);
            if (b >= 100.00) {
                $(this).addClass('td-error');
                return;
            } else {
                $(this).removeClass('td-error');
            }
            e.currentTarget.innerText = b;
        });
        $(".provision_rate_valas").on("blur", function (e) {
            let a = e.currentTarget.innerText;
            let b = parseFloat(parseNum(a)).toFixed(2);
            if (b >= 100.00) {
                $(this).addClass('td-error');
                return;
            } else {
                $(this).removeClass('td-error');
            }
            e.currentTarget.innerText = b;
        });
        var saveCreditSimulation = function (groupId) {
            var tableElement = $('#credit-simulation-group-' + groupId);
            var error = false;
            var data = [];
            var rowsElement = tableElement.find('tbody>tr');

            rowsElement.each(function () {
                if (error) {
                    return;
                }

                var rowElement = $(this);
                var cellsElement = rowElement.find('td');
                var rateIdr = cellsElement.eq(9);
                var rateValas = cellsElement.eq(10);
                var rateIdr2 = cellsElement.eq(13);
                var rateValas2 = cellsElement.eq(14);
                let b = parseFloat(rateIdr.text().toString().replace(/,/g, '').trim()).toFixed(2);
                let c = parseFloat(rateValas.text().toString().replace(/,/g, '').trim()).toFixed(2);
                let d = parseFloat(rateIdr2.text().toString().replace(/,/g, '').trim()).toFixed(2);
                let e = parseFloat(rateValas2.text().toString().replace(/,/g, '').trim()).toFixed(2);
                if (b > 100.00) {
                    error = true;
                    rateIdr.addClass('td-error');
                    return;
                } else if (c > 100.00) {
                    error = true;
                    rateValas.addClass('td-error');
                    return;
                } else if (d > 100.00) {
                    error = true;
                    rateIdr2.addClass('td-error');
                    return;
                } else if (e > 100.00) {
                    error = true;
                    rateValas2.addClass('td-error');
                    return;
                } else {
                    rateIdr.removeClass('td-error');
                    rateValas.removeClass('td-error');
                    rateIdr2.removeClass('td-error');
                    rateValas2.removeClass('td-error');
                }

                var datum = {
                    mandatory: rowElement.data('mandatory'),
                    detail_id: rowElement.data('id')
                }

                cellsElement.each(function () {
                    var cellElement = $(this);
                    var editable = cellElement.data('editable');
                    if (editable) {
                        var fieldName = cellElement.data('field-name');
                        datum[fieldName] = cellElement.text().replace(/,/g, '').trim();
                    }
                });

                data.push(datum);
            });
            if (error == false) {
                var request = JSON.stringify({
                    vcif: '<?= $vcif ?>',
                    group_id: groupId,
                    rows: data
                });

                var url = '<?= base_url('/rest/account_planning/save_credit_simulations') ?>';
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
            ;
        };
    </script>
<?php endif; ?>