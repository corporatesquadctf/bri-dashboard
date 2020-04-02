
<?php
$indexing_page = 1;
?>
<?php foreach ($banking_facilities as $banking_facility_id => $banking_facility): ?>

    <br>       
    <b><?= $banking_facility['name'] ?></b>

    <div id="banking-facility-group-<?= $banking_facility_id ?>" class="x_panel ">
        <table id="banking-facility-table-<?= $banking_facility_id ?>" class="table">
            <thead>
                <tr style="background: #012D5A; color: #FFF;">
                    <th rowspan="2" width="18%">Facility</th>
                    <th width="18%">Nominal IDR</th>
                    <th width="18%">Rate (%) IDR</th>
                    <th width="18%">Nominal Valas</th>
                    <th width="18%">Rate (%) Valas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($banking_facility['details'] as $banking_facility_detail_id => $banking_facility_detail) : ?>
                    <?php
                    $editable = !in_array($banking_facility_id, array(BANK_FACIL_DIRECT_LOAN));
                    $editable = $editable;
                    $direct_loan = in_array($banking_facility_id, array(BANK_FACIL_DIRECT_LOAN));
                    $direct_loan = $direct_loan || $banking_facility_detail['optional'];


                    if ($mode == 'edit') {
                        $editable = TRUE;
                    } else {
                        $editable = FALSE;
                    }
                    ?>
                    <tr 
                        data-mandatory="<?= $banking_facility_detail['mandatory'] ? 'true' : 'false' ?>" 
                        data-id="<?= $banking_facility_detail_id ?>" >
                        <td style="text-align: left;">

                            <?= $banking_facility_detail['detail_name'] ?></td>
                        <td style="text-align: right;">
                            <?= ($banking_facility_detail['amount_idr']) ?></td>
                        <td style="text-align: right;">
                            <?= number_format((float) $banking_facility_detail['amount_idr_percent'], 2, '.', '') ?></td>
                        <td style="text-align: right;">
                            <?= ($banking_facility_detail['amount_valas']) ?></td>
                        <td style="text-align: right;"
                            <?= number_format((float) $banking_facility_detail['amount_valas_percent'], 2, '.', '') ?></td>
                            <?php if ($mode == 'edit'): ?>
                            <td>
                                <?php if ($banking_facility_detail['optional']): ?>
                                    <span class="table-remove glyphicon glyphicon-remove" onclick="removeBankingFacility(this)"></span>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>

                    </tr>
                <?php endforeach; ?>
                <?php if ($mode == 'edit') : ?>
                    <tr data-mandatory="false" class="hide" align="center">
                        <td class="txt" contenteditable="true"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td>
                            <span class="table-remove glyphicon glyphicon-remove" onclick="removeBankingFacility(this)"></span>
                        </td>
                    </tr>
                <?php endif; ?> 
            </tbody>
        </table>
        <?php if ($mode == 'edit'): ?>
            <div class="btn-annual">
                <button class="btn btn-warning" onclick="addBankingFacilities(<?= $banking_facility_id ?>)">
                    <span class="glyphicon glyphicon-plus"></span> Row
                </button>
                <button class="btn btn-primary" onclick="saveBankingFacilities(<?= $banking_facility_id ?>)">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
                </button>
            </div>
        <?php endif; ?>

        <p id="banking-facility-message-<?= $banking_facility_id ?>"></p>

    </div>
    <?php
    $indexing_page += 1;
    ?>
<?php endforeach; ?>

<?php if ($mode == 'edit') : ?>
    <script>
        var addBankingFacilities = function (groupId) {
            var tableElement = $('#banking-facility-group-' + groupId);
            var clonedElement = tableElement.find('tr.hide').clone(true).removeClass('hide table-line');
            clonedElement.find('.table-remove').on('click', function () {
                clonedElement.detach();
            });
            tableElement.find('table').append(clonedElement);
        }

        var removeBankingFacility = function (callingElement) {
            $(callingElement).closest('tr').detach();
        };

        //Global Functions and Procedures
        var saveBankingFacilities = function (groupId) {
            $('#banking-facility-message-' + groupId).text("");

            var tableElement = $('#banking-facility-group-' + groupId);

            var data = [];
            var $tableRows = tableElement.find('tbody>tr:not(.hide)');
            var valid = true;

            var error = false;
            var message = '';
            var fieldName = ['', 'amount_idr', 'amount_idr_percent', 'amount_valas', 'amount_valas_percent'];
            $(".td-error").removeClass('td-error');

            $tableRows.each(function () {
                var tableRowElement = $(this)
                var tableCellsElement = tableRowElement.find('td');
                var cellValue0 = tableCellsElement.eq(0).text().replace(/,/g, '').trim();
                if (cellValue0.length == 0) {
                    tableCellsElement.eq(0).addClass('td-error');
                    error = true;
                    message = 'Please Enter a value';
                    return;
                }
                var datum = {
                    detail_id: tableRowElement.data('id'),
                    mandatory: tableRowElement.data('mandatory'),
                    detail_name: tableCellsElement.eq(0).text().trim()
                };

                for (var index = 1; index < 5; index++) {

                    var cellElement = tableCellsElement.eq(index);
                    var cellValue = cellElement.text();
                    cellValue = cellValue.replace(/,/g, '');
                    cellValue = cellValue.trim();
                    cellElement.removeClass('td-error');

                    let kurung = (cellValue.indexOf('(') !== -1 && cellValue.indexOf(')') !== -1);
                    if (kurung) {
                        cellValue = cellValue.replace(/\(/g, '');
                        cellValue = cellValue.replace(/\)/g, '');
                        cellValue = '-' + cellValue;
                    }

                    if (cellValue.length == 0) {
                        cellElement.addClass('td-error');
                        error = true;
                        message = 'Please Enter a value';
                        return;
                    }

                    if (cellElement.hasClass('numberPercent') && cellValue > 100.00) {
                        cellElement.addClass('td-error');
                        error = true;
                        message = 'Value bigger than 100.00';
                        return;
                    }

                    if (isNaN(cellValue)) {
                        cellValue = 0;
                    }

                    datum[fieldName[index]] = cellValue;
                }
                data.push(datum);
            });

            if (error) {
                $('#banking-facility-message-' + groupId).text(message);
                return;
            }

            var request = {
                vcif: '<?= $vcif ?>',
                group_id: groupId,
                rows: data
            };

            var url = '<?= base_url('rest/bri_starting/save_banking_facilities') ?>';
            var success = function (response) {
                new PNotify({
                    title: 'Success!',
                    text: response.message,
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 500
                });
                loadWalletShares();
                loadCompetitionAnalyses();
                loadEstimatedFinan();

            };

            request = JSON.stringify(request);

            $.post(url, request, success, 'json');
        };

        $('.numberMinus').on('blur', function (e) {
            let a = e.currentTarget.innerText;
            e.currentTarget.innerText = numberWithCommas(a);
        });
    </script>
<?php endif; ?>