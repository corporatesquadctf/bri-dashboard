
<style type="text/css">
    .fnt {
        font-size: 12px;
        color: #000;
    }   
</style>
    <div class="x_title">
        <h2><small>Fundings</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="table-editable table-account-planning" style="overflow-x:auto;">
            <table class="table table-condensed table-hover funding-details-table" id ="funding-table">
                <thead>
                    <tr style="background: #012D5A; color: #fff;">
                        <th class="hide">ID</th>
                        <th>No</th>
                        <th>Kebutuhan Pendanaan</th>
                        <th colspan="2">Jangka waktu</th>
                        <th>Nominal</th>
                        <?php if ($mode == 'edit') : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <table class="hide">
                <tr class="funding-row" align="center">
                    <?php if ($mode == 'edit') : ?>
                        <td class="td-disabled index"><span class='fa fa-chevron-right'></td>
                        <td class="txt kebutuhan-pendanaan" contenteditable="true" style="text-align: left;"></td>
                        <td class="txt jangka-waktu" contenteditable="true" style="text-align: center;"></td>
                        <td class="txt" width="18%" style="text-align: center; background: #D7DBD7;">Bulan/Month</td>
                        <td class="txt numberOnly nominal" contenteditable="true" style="text-align: right;"></td>
                        <td>
                            <span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this); return false"></span>
                        </td>
                    <?php endif; ?>

                    <?php if ($mode == 'view') : ?>
                        <td class="td-disabled index"><span class='fa fa-chevron-right'></td>
                        <td class="td-disabled kebutuhan-pendanaan" style="text-align: left;"></td>
                        <td class="td-disabled jangka-waktu" style="text-align: center;"></td>
                        <td class="td-disabled" width="18%" style="text-align: center; background: #D7DBD7;">Bulan/Month</td>
                        <td class="td-disabled nominal" style="text-align: right;"></td>
                    <?php endif; ?>
                </tr>
            </table>
            <?php if ($mode == 'edit') : ?>
            <div class="x_footer">
                <div class="btn-annual">
                    <button class="btn btn-primary btn-save" onclick="saveFundings()">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
                    </button>
                    <button class="btn btn-warning btn-sm table-sh-add" onclick="addFunding()">
                        <span class="glyphicon glyphicon-plus"></span> Row
                    </button>
                </div>
            </div>
        <?php endif; ?>
        <p id="funding-message"></p>
        </div>
    </div>

<script>
    var loadFunding = function () {
        var url = '<?= base_url('/rest/account_planning/get_funding/' . $vcif . '/' . $account_planning['doc_year']) ?>';
        $('#funding-message').text('');
        $.post(url, null, renderFunding, 'json');
    };

    $(document).ready(loadFunding);

    var fundingTable = $('#funding-table tbody');

    var renderFunding = function (response) {
       
        fundingTable.empty();

        for (var index = 0; index < response.length; index++) {
                var fundingCons = response[index];
                var rowElement = $('.funding-row').clone(true);
                rowElement.removeClass('funding-row');
                rowElement.find('.index').text(index + 1);
                rowElement.find('.kebutuhan-pendanaan').text(fundingCons.FUNDING_NEED);
                rowElement.find('.jangka-waktu').text(fundingCons.TIME_PERIOD);
                rowElement.find('.nominal').text(fundingCons.nominal_formatted);
                fundingTable.append(rowElement);

            }
    };

    var addFunding = function () {
            $('#funding-nodata').hide();
            var newRowElement = $('.funding-row').clone(true);
            newRowElement.removeClass('funding-row');
            fundingTable.append(newRowElement);
        };


    var saveFundings = function () {

        var data = [];
        var fundingRows = fundingTable.find('tr');

        var error = false;
        var message = '';

        fundingRows.each(function (index, element) {
            if (error) {
                return;
            }

            var fundingRow = $(element);
            tableCellsElement = fundingRow.find('td');
            var kebutuhanDana = fundingRow.find('.kebutuhan-pendanaan').text().trim();
            var jangkaWaktu  = fundingRow.find('.jangka-waktu').text().trim();
            var nominal = fundingRow.find('.nominal').text().trim();

            var danaVal = tableCellsElement.eq(1);
            var jangkaVal = tableCellsElement.eq(2);
            var nominalVal = tableCellsElement.eq(4);

            if (kebutuhanDana.length == 0){
                danaVal.addClass('td-error');
                error = true;
                message = 'Silahkan input kebutuhan dana';
                return;
            }

            if (jangkaWaktu.length == 0){
                jangkaVal.addClass('td-error');
                error = true;
                message = 'Silahkan input jangka waktu';
                return;
            }

            if(isNaN(jangkaWaktu)){
                jangkaVal.addClass('td-error');
                error = true;
                message = 'Silahkan input angka';
                return;
            }

            nominal = nominal.replace(/,/g, '');
            if (nominal.length == 0){
                nominalVal.addClass('td-error');
                error = true;
                message = 'Silahkan input nominal';
                return;
            }

            if(isNaN(nominal)){
                nominalVal.addClass('td-error');
                error = true;
                message = 'Silahkan input angka';
                return;
            }

            var datum = {
                funding_need : kebutuhanDana,
                time_period : jangkaWaktu,
                nominal: nominal
            };
            data.push(datum);
        });

        if (error) {
                $('#funding-message').text(message);
                return;
            }

        var url = '<?= base_url('rest/account_planning/save_fundings') ?>';
            var request = {
                vcif: '<?= $vcif ?>',
                year: '<?= $account_planning['doc_year']?>',
                rows: data
            }
            var success = function (response) {
                 new PNotify({
                    title: 'Success!',
                    text: response.message,
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 500
                });
                if (response.reload){
                    location.reload();
                } else {
                  loadFunding();
                }
            };

            request = JSON.stringify(request);

            $.post(url, request, success, 'json');
    };
</script>
<!-- <script>
    $('.max_month').on('keydown', function(e){
        let a = $(this).val();
        if(a.length >=2){
            if (e.keyCode >=48 && e.keyCode <= 57){
                e.preventDefault();
            }
        }
    })
</script> -->