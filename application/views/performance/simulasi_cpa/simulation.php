<?php
$disabled_cell = 'class="td-disabled"';
$enabled_cell = 'class="txt td-number numberOnly" contenteditable="true"';
?>
<style type="text/css">
    .cntr{
        text-align: center;
    }
    .td-error {
        border-color: red !important; 
        border-width: 2px !important; 
    }
    .td-disabled {
        background-color: #ddd;
    }
</style>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>SIMULATION</small></h2>
            <div class="clearfix"></div>
        </div>
        <ul class="nav navbar-right panel_toolbox">
            <p class="help-block">*Valas dalam bentuk dollar dan IDR dalam bentuk rupiah</small></p>
        </ul>
        <br>

        <?php foreach ($calculate_simulations as $credit_simulation_id => $credit_simulation): ?>
            <b><?= $credit_simulation['name'] ?></b>
            <div class="table-editable table-account-planning" style="overflow-x:auto;" >
                <table id="credit-simulation-group-<?= $credit_simulation_id ?>"
                       class="table table-condensed table-striped table-hover table-bordered" style="padding-bottom: 5px;"
                       >
                    <thead align="center">
                        <tr class="input_form" style="background: #012D5A; color: #FFF;">
                            <th class="cntr" rowspan="2" width="15%">Facilities</th>
                            <th class="cntr" colspan="2">Plafond</th>
                            <th class="cntr" colspan="2">Outstanding </th>
                            <th class="cntr" colspan="2">Ratas Harian</th>
                            <th class="cntr" colspan="2">Tenor (Bulan)</th>
                            <th class="cntr" colspan="2">Indicative Rate (%)</th>
                            <th class="cntr" colspan="2">Income / Expense</th>
                            <th class="cntr" colspan="2">Provision Rate (%)</th>
                            <th class="cntr" colspan="2">Provision</th>
                            <th class="cntr" colspan="2">Fee</th>

                        </tr>
                        <tr class="input_form cntr" style="background: #012D5A; color: #FFF;">
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                            <th>IDR</th>
                            <th>Valas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($credit_simulation['details'] as $credit_simulation_detail_id => $credit_simulation_detail) : ?>
                            <tr align="center"
                                data-id="<?= $credit_simulation_detail_id ?>"
                                data-mandatory="<?= $credit_simulation_detail['mandatory'] ? 'true' : 'false' ?>">
                                <td 
                                    class="td-disabled" 
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
                                    <?php
                                    $editable = TRUE;
                                    if ($credit_simulation['name'] == 'Cash') {
                                        $editable = !in_array($field, array(
                                                    'plafond_idr', 'plafond_valas',
                                                    'income_expense_idr', 'income_expense_valas',
                                                    'provision_rate_idr', 'provision_rate_valas',
                                                    'provision_idr', 'provision_valas'
                                        ));
                                    }
                                    ?>

                                    <td 
                                        data-field-name="<?= $field ?>"   
                                        style="text-align: right;"
                                        <?= $editable == TRUE ? $enabled_cell : $disabled_cell ?>
                                        >   
                                            <?= $credit_simulation_detail[$field] ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <div class="btn-annual" style="padding-top: 5px; text-align: right;">
                <button class="btn btn-primary" onclick="saveCalcSimulation(<?= $credit_simulation_id ?>)">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
                </button>
            </div>
            <p id="credit-simulation-message-<?= $credit_simulation_id ?>"></p>

        <?php endforeach; ?>
        <br><br>
    </div>
</div>

<script type="text/javascript">
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
    var saveCalcSimulation = function (groupId) {
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
            }
            if (c > 100.00) {
                error = true;
                rateValas.addClass('td-error');
                return;
            }
            if (d > 100.00) {
                error = true;
                rateIdr2.addClass('td-error');

                return;
            }
            if (e > 100.00) {
                error = true;
                rateValas2.addClass('td-error');

                return;
            }

            rateIdr.removeClass('td-error');
            rateValas.removeClass('td-error');
            rateIdr2.removeClass('td-error');
            rateValas2.removeClass('td-error');

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
                user_id: '<?= $_SESSION['USER_ID'] ?>',
                group_id: groupId,
                rows: data
            });

            var url = '<?= base_url('/rest/calculate/save_calc_simulation') ?>';
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

    $('.td-number').on('click', function () {
        var tdElement = $(this);
        var tdText = tdElement.text();
        let kurung = (tdText.indexOf('(') !== -1 && tdText.indexOf(')') !== -1);
        tdText = tdText.replace(/,/g, '');
        if (tdText == 0 || tdText == "0.00") {
            tdElement.text("");
        } else if (kurung) {
            tdText = tdText.replace(/\(/g, '');
            tdText = tdText.replace(/\)/g, '').trim();
            tdText = '-' + tdText;
            tdElement.text(tdText);
        } else {
            tdElement.text(tdText);
        }
    })
</script>