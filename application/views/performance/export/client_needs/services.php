<link rel="stylesheet" type="text/css" href="<?= base_url('template/vendors/tag_components/bootstrap-expandable-input/bootstrap-expandable-input.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('template/vendors/tag_components/bootstrap-contenteditable-autocomplete.css') ?>">
<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<style>
    [contenteditable] {
        outline: none;
        text-align: left;
        background: #fff;
        padding: 8px;
        border: 1px solid #ccc;
    }

    span[contenteditable] {
        display: inline-block;
    }
</style>

<div class="x_panel">
    <div class="x_title">
        <h2>Services</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <br />
        <div id="table-cnservices" class="table-editable table-account-planning">
            <table class="table">
                <thead>
                    <tr class="cnservices" style="background: #012D5A; color: #fff;">
                        <!-- <th>No</th> -->
                        <th width="20%" >Nama Services</th>
                        <th>Product Divisi Tag</th>
                        <?php if ($mode == 'edit') : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $index => $service) : ?>
                        <tr>
                            <!-- <td class="td-disabled"><?= $index + 1 ?></td> -->
                            <?php if ($mode == "edit") : ?>
                                <td class="txt" contenteditable="true"><?= $service['SERVICE_NAME'] ?></td>
                        <input type="hidden" name="custCIF" id="custCIF" value="<?= $account_planning['vcif']; ?>">
                        <td>
                            <!-- <select input="text" data-placeholder="Search Division Name" class="chosen-select form-control" name="tags[]" id="tags[]" multiple>
                                <option value=""></option>
                            <?php foreach ($division as $dvi) : ?>
                                                <option value="<?= $dvi->ID; ?>" 
                                <?php foreach ($service['DIVISI'] as $dd) : ?>
                                    <?= $dvi->ID == $dd ? 'selected' : '' ?> 
                                <?php endforeach ?>
                                                        >
                                <?= $dvi->DIVISION_NAME; ?></option> 
                            <?php endforeach ?>

                            </select> -->
                        </td>
                        <td>
                            <span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this); return false"></span>
                        </td>
                    <?php endif; ?>
                    <?php if ($mode == "view") : ?>
                        <td class="td-disabled"><?= $service['SERVICE_NAME'] ?></td>
                        <td><div><?php foreach ($service['DIVISI_NAME'] as $dv) : ?><?php
                                    echo $dv;
                                    echo ",  ";
                                    ?><?php endforeach ?>
                            </div>
                        </td>
                    <?php endif; ?>
                    </tr>
<?php endforeach; ?>


                </tbody>
            </table>
        </div>
<?php if ($mode == 'edit') : ?>
            <div class="btn-annual">
                <button id="export-cnservices-btn" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save Data</button>
                <button id="export-btn" class="btn btn-warning table-cnservices-add">
                    <span class="glyphicon glyphicon-plus"></span> Row
                </button>
            </div>
<?php endif; ?>
        <p id="service-message"></p>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/chosen/chosen.js"></script>
<script type="text/javascript">
                        $(".chosen-select").chosen({
                            no_results_text: "Oops, Pilihan Tidak tersedia"
                        })
</script>

<script type="text/javascript">
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

<script type="text/javascript">
    var $TABLExcnservices = $('#table-cnservices');
    var $BTNxcnservices = $('#export-cnservices-btn');
    var $EXPORTxcnservices = $('#export-cnservices');
    var $vcif = $('#custCIF').val();

    $('.table-cnservices-add').click(function () {
        var $clone = $TABLExcnservices.find('tr.hide').clone(true).removeClass('hide table-line');
        var select = $clone.find('select');
        $(select).chosen();
        $TABLExcnservices.find('table').append($clone);

    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcnservices.click(function () {

        var tableElement = $('#table-cnservices');

        var data = [];
        var $tableRows = tableElement.find('tbody>tr:not(.hide)');
        var error = false;
        var message = '';

        $tableRows.each(function () {
            var tableRowElement = $(this)
            var tableCellsElement = tableRowElement.find('td');

            var namaServis = tableCellsElement.eq(0).text().trim();
            var productDivisi = tableCellsElement.eq(1).find('select').val();

            var serviceVal = tableCellsElement.eq(0);
            var productVal = tableCellsElement.eq(1);


            if (namaServis.length == 0) {
                error = true;
                message = 'Silahkan input Nama Service';
                return;
            }

            var datum = {

                nama_service: namaServis,
                product_divisi: productDivisi

            };

            data.push(datum);
        });

        if (error) {
            $('#service-message').text(message);
            return;
        }

        var url = '<?= base_url('rest/account_planning/save_services') ?>';
        var request = {
            vcif: '<?= $vcif ?>',
            year: '<?= $account_planning['doc_year'] ?>',
            rows: data
        }
        var success = function (response) {
            $('#service-message').text('');
            new PNotify({
                title: 'Success!',
                text: response.message,
                type: 'success',
                styling: 'bootstrap3',
                delay: 500
            });
            if (response.reload) {
                location.reload();
            }
        };
        request = JSON.stringify(request);

        $.post(url, request, success, 'json');
    });
</script>

<script>
    var countries = ['IT', 'Komunikasi', 'marketing Komunikasi', 'produksi', 'Akuntansi', ];
    $(document.body).on('autocomplete:request', function (event, query, callback) {
        query = query.toLowerCase();
        callback(countries.filter(function (country) {
            return country.toLowerCase().indexOf(query) !== -1;
        }));
    });

</script>

<script type="text/javascript">
//<![CDATA[
    {
        var selector = "select";
        try {
            selector = eval("select");
        } catch (e) {
        }
        jQuery(selector).(':not(:has(option:not([value=])))').attr('disabled', true);
    }
//]]>
</script>