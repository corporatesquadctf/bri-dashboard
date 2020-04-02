<?php
$disabled_cell = 'class="td-disabled"';
$enabled_cell = 'class="txt" contenteditable="true"';
?>

<link rel="stylesheet" href="<?= base_url('/assets/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>">
<script src="<?= base_url('/assets/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>

<style type="text/css">
    .errorx {
        color: #F00;
        font-size: 11px;
    }
    .fa-input {
        font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    .table-remove{
        text-align: center;
    }
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .fa-close{
        color: #e21b1b;
        font-size: 16px;
    }

    #img-upload{
        width: 100%;
    }
    .thumbnail{
        height: 300px;
        width: 100%;
    }
    .icon-input-btn{
        display: inline-block;
        position: relative;
    }
    .icon-input-btn input[type="submit"]{
        padding-left: 2em;
    }
    .icon-input-btn .glyphicon{
        display: inline-block;
        position: absolute;
        left: 0.65em;
        top: 30%;
        color: #fff;
    }
    small{
        color: #f00;
    }
    .x_panel{
        min-height: 200px;
    }

</style>

<script type="text/javascript">
    function myFunction(e) {
        let a = $(e.target).children(":selected").attr("id")
        $("#globalrating_description").val(a);
    }
</script>

<!-- 1.1 GROUP OVERVIEIW SECTION -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel"    >
        <div class="x_title">
            <h2>Group Overview</h2>
            <!-- <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul> -->
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="group-overview-form">
                <div class="col-sm-6 setengah" width="50%">
                    <div>
                        <label for="companyName">
                            Customer Name: <div class="left20"> <?= $account_planning['customer_name']; ?> </div>
                        </label>
                        <input 
                            type="text" 
                            id="customer_name" 
                            class="form-control dispnone" 
                            value="<?= $account_planning['customer_name']; ?>" 
                            disabled 
                            />
                        <input 
                            type="hidden" 
                            id="group_id" 
                            value="<?= $account_planning['group_id'] ?>"
                            />
                        <input 
                            type="hidden" 
                            id="user_id" 
                            value="<?= $_SESSION['USER_ID']; ?>"
                            />
                    </div>    
                    <br>
                    <div class="form-group">
                        <label >CIF / Virtual CIF : <?= $account_planning['vcif']; ?></label>
                        <input 
                            type="text" 
                            id="vcif" 
                            class="form-control dispnone" 
                            value="<?= $account_planning['vcif']; ?>" 
                            disabled 
                            />
                    </div>
                    <!-- <div class="form-group">
                        <label >Parent Company : -</label>
                        <input 
                            type="text" 
                            class="form-control dispnone" 
                            value="" disabled
                            />
                    </div> -->

                    <div class="form-group">
                        <label>Address:  <?= $groupoverview['ADDRESS1']; ?> 
                        </label>
                        <textarea 
                            class="form-control dispnone" 
                            rows="7" 
                            id="address1" 
                            style="resize: none"
                            <?= $mode == 'view' ? 'disabled' : '' ?>
                            ></textarea>
                    </div>
                    <div class="form-group">
                        <label>City : <?= $groupoverview['Description']; ?>

                        </label>

                    </div>
                </div>

                <div class="col-sm-6 setengah" width="50%">


                    <div class="form-group">
                        <div class="form-inline">
                            <label for="globalRate">Global Rating : 
                                <?= $groupoverview['name_global']; ?>
                            </label>
                            <br />



                            <input disabled type="hidden" 
                                   class="form-control dispnone" 
                                   name="globalrating_description" 
                                   id="globalrating_description" 
                                   value=""
                                   >

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-inline">
                            <label for="globalRate">Global Description : 
                                <?= $groupoverview['global_desc']; ?>
                            </label>
                            <br />



                            <input disabled type="hidden" 
                                   class="form-control dispnone" 
                                   name="globalrating_description" 
                                   id="globalrating_description" 
                                   value=""
                                   >

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="domesticRate">Domestic Rating : <?= $groupoverview['name_domestic']; ?></label>
                        <select 
                            width="60%" 
                            class="form-control dispnone" 
                            id="domesticrating_id" 
                            <?= $mode == 'view' ? 'disabled' : '' ?>
                            >
                                <?php foreach ($domrate as $dom) : ?>
                                <option value="<?= $dom['DOMESTICRATING_ID']; ?>" >
                                    <?= $dom['DOMESTICRATING']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="industryName">Industry : <?= $groupoverview['INDUSTRY_NAME']; ?></label>
                        <input type="text" 
                               class="form-control dispnone" 
                               id="industry_name" 
                               name="industryName" 
                               <?= $mode == 'view' ? 'disabled' : '' ?>>
                    </div>
                    <div class="form-group">
                        <label>Industry Trend : <?= $groupoverview['name_industrytrend']; ?></label>
                        <select 
                            class="form-control dispnone" 
                            id="industrytype_id" 
                            <?= $mode == 'view' ? 'disabled' : '' ?>

                            >
                                <?php foreach ($indtrend as $idt) : ?>
                                <option value="<?= $idt['INDUSTRYTREND_ID']; ?>"><?= $idt['INDUSTRYTREND']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lifeCycle">Life-cycle : <?= $groupoverview['name_life']; ?></label>
                        <select 
                            class="form-control dispnone" 
                            id="lifecycle_id" 
                            <?= $mode == 'view' ? 'disabled' : '' ?>
                            >
                                <?php foreach ($lifecycle as $lfc) : ?>
                                <option value="<?= $lfc['LIFECYCLE_ID'] ?>">
                                    <?= $lfc['LIFECYCLE']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- 1.2. KEY SHAREHOLDER SECTION -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <b>Key Shareholders</b>
            <!-- <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul> -->
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div id="table" class="table-editable table-account-planning" style="margin-top: 20px;">
                <table class="table table-hover table-condensed table-bordered" id="key-shareholders-table">
                    <thead>
                        <tr style="background: #012D5A; color: #FFF;">
                            <th width="6%">No</th>
                            <th width="43%">Key Shareholders</th>
                            <th>Shares</th>
                            <th>portions (%)</th>
                            <?php if ($mode == 'edit') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <table class="hide">
                    <tr class="key-shareholder-row">
                        <?php if ($mode == 'edit') : ?>
                            <td class="td-disabled index"><span class='fa fa-chevron-right'></td>
                            <td class="txt shareholder" contenteditable="true"></td>
                            <td class="txt td-number share-value" contenteditable="true"></td>
                            <td class="td-disabled portion"></td>
                            <td>
                                <span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this)"></span>
                            </td>
                        <?php endif; ?>
                        <?php if ($mode == 'view') : ?>
                            <td class="td-disabled index"><span class='fa fa-chevron-right'></td>
                            <td class="td-disabled shareholder"></td>
                            <td class="td-disabled share-value"></td>
                            <td class="td-disabled portion"></td>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>
        </div>
        <?php if ($mode == 'edit') : ?>
            <div class="x_footer">
                <div class="row">
                    <div class="col-md-12" align="center" id="key-shareholder-message">
                    </div>
                </div>
                <div class="btn-annual">
                    <div class="col-md-12" align="center">
                        <button class="btn btn-primary btn-sm" onclick="saveKeyShareholders()">
                            <span class="glyphicon glyphicon-floppy-disk"></span>  Save Data
                        </button>
                        <button class="btn btn-warning btn-sm table-sh-add" onclick="addKeyShareholders()">
                            <span class="glyphicon glyphicon-plus"></span> Row
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?> 
    </div>
</div>
<!--ADD_PAGE-->
<!-- 1.3. STRATEGIC PLAN  -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <b>Strategic Plan</b>
            <!-- <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul> -->
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div>1-3 Years Planning</div>
            <table class="table table-condensed table-bordered" id="spaTable">
                <thead>
                    <tr class="splan" style="background: #012D5A; color: #FFF;">
                        <th style="width:5%; text-align: center;">No</th>
                        <th>Planning</th>
                        <?php if ($mode == 'edit') : ?>
                            <th style="width: 15%; text-align: center;">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="strategic-plans-table-1">
                </tbody>
            </table>
            <table class="hide">
                <tr class="strategic-plan-row-1">
                    <?php if ($mode == 'view') : ?>
                        <td class="td-disabled index"><span class='fa fa-chevron-right'></td>
                        <td class="td-disabled planning"></td>

                    <?php endif; ?>
                </tr>
            </table>
            <!--ADD_PAGE-->
            <div>>3 Years Planning</div>
            <table class = "table table-hover table-condensed table-bordered" id = "spbTable">
                <thead>
                    <tr class = "splan" style = "background: #012D5A; color: #FFF;">
                        <th style = "width:5%; text-align: center;">No</th>
                        <th>Planning</th>
                        <?php if ($mode == 'edit') : ?>
                            <th style = "width: 15%; text-align: center;">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="strategic-plans-table-2">
                </tbody>
            </table>
            <table class="hide">
                <tr class="strategic-plan-row-2">
                    <?php if ($mode == 'view') : ?>
                        <td class="td-disabled index"><span class='fa fa-chevron-right'></td>
                        <td class="td-disabled planning"></td>
                    <?php endif; ?>
                </tr>
            </table>
            <div class="x_footer">
            </div>
        </div>
    </div>
    <!--ADD_PAGE-->
    <div class="col-md-4 col-sm-12 col-xs-12 nopadding dispnone">
        <div class="x_panel">
            <div class="x_title">
                <b>Business Process</b> : < Terlampir >
                <!-- <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="col-md-12">
                    <!-- <div class="form-group">
                        <div>
                    <?php foreach ($gambarBisnis as $data) : ?>
                                        <a href="<?= base_url("uploads/" . $data->PATH) ?>">
                                            <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
                        <?php echo "$data->PATH"; ?>
                                        </a>
                    <?php endforeach; ?>
                        </div>
    
                    <?php if ($mode == 'edit') : ?>
                                        <div style="color: red;">
                        <?= (isset($message)) ? $message : ""; ?>
                                        </div>
                
                        <?= form_open("perform/companyinformations/tambah", array('enctype' => 'multipart/form-data')); ?>
                                        <input type="hidden" name="TITLE" value="BISNISPROCESS">
                                        <input type="hidden" name="YEAR" value="<?= $account_planning['doc_year']; ?>">
                                        <input type="hidden" name="VCIF" value="<?= $account_planning['vcif']; ?>">
                                        <div class="input-group" style="padding-top: 20px;">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    Browse...<input type="file" name="input_gambar">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control dispnone" readonly>
                                        </div>
                                        <small>Format file must be PDF,<br> Maximum Filesize 5MB</small>
                
                                        <div class="col-sm-12 nopadding">
                                            <span class="icon-input-btn pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> <input type="submit" name="submit" class="btn btn-primary btn-sm " value="Save Data"></span>
                                        </div>
                        <?= form_close(); ?>
                    <?php endif; ?>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12 nopadding dispnone">
        <div class="x_panel">
            <div class="x_title">
                <b>Organization</b> : < Terlampir >
                <!-- <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul> -->
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

            </div>
        </div>
    </div>


    <!-- 1.4. COVERAGE MAPPING SECTION -->
    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
        <div class="x_panel">
            <div class="x_title">
                <b>Coverage Mapping</b>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div id="table-cmap" class="table-editable table-account-planning" style="margin-top: 20px; overflow-x:auto;" >
                <table class="table table-hover table-condensed table-bordered" id="cmTable">
                    <thead>
                        <tr style="background: #012D5A; color: #FFF;">
                            <th>No</th>
                            <th>Position at Client</th>
                            <th>Name of the Client</th>
                            <th>Contact Number</th>
                            <th>Other Information </th>
                            <th>Position at the Bank</th>
                            <th>Name of the Bank's Person</th>
                            <?php if ($mode == 'edit') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="coverage-mappings-table">
                    </tbody>
                </table>
                <table class="hide">
                    <tr class="coverage-mapping-row">
                        <td class="td-disabled"><i class="fa fa-chevron-right"></i></td>
                        <?php if ($mode == 'edit') : ?>
                            <td contenteditable="true" class="txt position"></td>
                            <td contenteditable="true" class="txt name"></td>
                            <td contenteditable="true" class="txt contact"></td>
                            <td contenteditable="true" class="txt other-info"></td>
                            <td contenteditable="true" class="txt position-bank"></td>
                            <td contenteditable="true" class="txt name-person-bank"></td>
                            <td><span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this)"></span>
                            </td>
                        <?php else: ?>
                            <td class="td-disabled"></td>
                            <td class="td-disabled"></td>
                            <td class="td-disabled allownumericwithoutdecimal"></td>
                            <td class="td-disabled"></td>
                            <td class="td-disabled"></td>
                            <td class="td-disabled"></td>
                        <?php endif; ?>

                    </tr>
                </table>
            </div>
            <p id="coverage-mapping-message">
            </p>
            <?php if ($mode == 'edit') : ?>
                <div class="row">
                    <div class="btn-annual">
                        <button class="btn btn-primary btn-sm" onclick="saveCoverageMappings()">
                            <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
                        </button>
                        <button class="btn btn-warning btn-sm" onclick="addCoverageMappings()">
                            <span class="glyphicon glyphicon-plus"></span> Row
                        </button>
                    </div>
                </div>



            <?php endif; ?>
        </div>
    </div>

    <!-- MODAL -->
    <div id="edit_structure" class="modal fade hide" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <b class="modal-title">Modal Header</b>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".allownumericwithdecimal").on("keypress keyup blur", function (event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-file :file').on('change', function () {
                var input = $(this);
                var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });
            $('.btn-file :file').on('fileselect', function (event, label) {

                var input = $(this).parents('.input-group').find(':text')
                var log = label;
                if (input.length) {
                    input.val(log);
                } else {
                    if (log) {
                        alert(log);
                    }
                }
            });
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function () {
                readURL(this);
            });
            // ===================== COVERAGE MAPPING SECTION =====================
            window.coverageMappingsTable = $('#coverage-mappings-table');

            var renderCoverageMappings = function (response) {
                window.coverageMappingsTable.empty();
                var index = 1;
                response.forEach(function (row) {
                    row.index = index++;
                });

                var fields = [
                    'index', 'client_position', 'client_name', 'contact_person',
                    'other_information', 'bank_position', 'bank_person'
                ];

                response.forEach(function (coverageMapping) {

                    var rowElement = $('.coverage-mapping-row').clone(true);
                    rowElement.removeClass('coverage-mapping-row');
                    var cellElements = rowElement.find('td');
                    for (var fieldIndex = 0; fieldIndex < fields.length; fieldIndex++) {
                        var field = fields[fieldIndex];
                        cellElements.eq(fieldIndex).text(coverageMapping[field]);
                    }
                    window.coverageMappingsTable.append(rowElement);
                });
            };

            window.loadCoverageMappings = function () {
                var url = '<?= base_url('rest/company_information/get_coverage_mappings/' . $vcif . '/' . $account_planning['doc_year']) ?>'
                $.post(url, null, renderCoverageMappings);
            }

            window.addCoverageMappings = function () {
                $('#coverage-mapping-nodata').hide();
                var newRowElement = $('.coverage-mapping-row').clone(true);
                newRowElement.removeClass('coverage-mapping-row');
                coverageMappingsTable.append(newRowElement);
            };

            window.saveCoverageMappings = function () {

                var coverageMappingRows = coverageMappingsTable.find('tr');
                var data = [];

                var error = false;
                var message = '';

                $(".td-error").removeClass('td-error');

                coverageMappingRows.each(function (index, element) {
                    if (error) {
                        return;
                    }

                    var coverageMappingRow = $(element);
                    tableCellsElement = coverageMappingRow.find('td');

                    var positionVal = tableCellsElement.eq(1);
                    var nameVal = tableCellsElement.eq(2);
                    var contactVal = tableCellsElement.eq(3);
                    var positionBankVal = tableCellsElement.eq(5);
                    var nameBankPersVal = tableCellsElement.eq(6);

                    var positionAtClient = positionVal.text();
                    var clientName = nameVal.text();
                    var contactNum = contactVal.text();
                    var positionBank = positionBankVal.text();
                    var nameBankPers = nameBankPersVal.text();

                    var position = coverageMappingRow.find('.position').text().trim();
                    var name = coverageMappingRow.find('.name').text().trim();
                    var contact = coverageMappingRow.find('.contact').text().trim();
                    var other_info = coverageMappingRow.find('.other-info').text().trim();
                    var position_bank = coverageMappingRow.find('.position-bank').text().trim();
                    var name_person_bank = coverageMappingRow.find('.name-person-bank').text().trim();

                    var regex = /^(\s*|\d+)$/;
                    var ph = /^$|^(?!0+$)\d{5,}$/;
                    let alphanumeric = /^[a-z0-9\ ]+$/i;
                    let alphabet = /^[a-z\ ]+$/i

                    if (positionAtClient.length == 0) {
                        positionVal.addClass('td-error');
                        error = true;
                        message = 'Please enter position at client';
                        return;
                    }

                    if (clientName.length == 0) {
                        nameVal.addClass('td-error');
                        error = true;
                        message = 'Please enter name of the client';
                        return;
                    }

                    if (!alphabet.test(clientName)) {
                        nameVal.addClass('td-error');
                        error = true;
                        message = 'Please enter only alphabet';
                        return;
                    }


                    if (contactNum.length > 14) {
                        contactVal.addClass('td-error');
                        error = true;
                        message = 'Please enter only 14 digit contact number';
                        return;
                    }

                    if (!ph.test(contactNum)) {
                        contactVal.addClass('td-error');
                        error = true;
                        message = 'Invalid format/ minimum 8 digit';
                        return;
                    }

                    if (!regex.test(contactNum)) {
                        contactVal.addClass('td-error');
                        error = true;
                        message = 'Please enter only number';
                        return;
                    }

                    if (positionBank.length == 0) {
                        positionBankVal.addClass('td-error');
                        error = true;
                        message = 'Please enter position at the bank';
                        return;
                    }

                    if (nameBankPers.length == 0) {
                        nameBankPersVal.addClass('td-error');
                        error = true;
                        message = "Please enter name of the bank's person";
                        return;
                    }

                    data.push({
                        client_position: position,
                        client_name: name,
                        contact_person: contact,
                        other_information: other_info,
                        bank_position: position_bank,
                        bank_person: name_person_bank
                    });
                });

                if (error) {
                    $('#coverage-mapping-message').text(message);
                    return;
                }

                var url = '<?= base_url('rest/company_information/save_coverage_mappings') ?>';
                var request = {
                    vcif: '<?= $vcif ?>',
                    year: '<?= $account_planning['doc_year'] ?>',
                    rows: data
                }
                var success = function (response) {
                    window.loadCoverageMappings();
                    $('#coverage-mapping-message').text('');

                };
                request = JSON.stringify(request);

                $.post(url, request, success, 'json');
                new PNotify({
                    title: 'Success!',
                    text: 'Coverage Mapping Has Been Save.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            };

            window.loadCoverageMappings();


            // ===================== KEY SHAREHOLDERS SECTION =====================
            window.keyShareholdersTable = $('#key-shareholders-table tbody');

            var renderKeyShareholders = function (response) {
                window.keyShareholdersTable.empty();
                for (var index = 0; index < response.length; index++) {
                    var keyShareholder = response[index];
                    var rowElement = $('.key-shareholder-row').clone(true);
                    rowElement.removeClass('key-shareholder-row');
                    rowElement.find('.index').text(index + 1);
                    rowElement.find('.shareholder').text(keyShareholder.shareholder);
                    rowElement.find('.share-value').text(keyShareholder.share_value_formatted);
                    rowElement.find('.portion').text(keyShareholder.portion);
                    window.keyShareholdersTable.append(rowElement);
                }
            };

            window.loadKeyShareholders = function () {
                var url = '<?= base_url('rest/company_information/get_key_shareholders/' . $vcif . '/' . $account_planning['doc_year']) ?>'
                $.post(url, null, renderKeyShareholders);
            }

            window.addKeyShareholders = function () {
                $('#key-shareholder-nodata').hide();
                var newRowElement = $('.key-shareholder-row').clone(true);
                newRowElement.removeClass('key-shareholder-row');
                keyShareholdersTable.append(newRowElement);
            };

            window.saveKeyShareholders = function () {
                var error = false;
                var keyShareholderRows = keyShareholdersTable.find('tr');
                var data = [];

                keyShareholderRows.each(function (index, element) {
                    if (error) {
                        return;
                    }

                    var keyShareholderRow = $(element);

                    var shareholder = keyShareholderRow.find('.shareholder').text().trim();
                    var shareValue = keyShareholderRow.find('.share-value').text().trim();
                    let shareName = keyShareholderRow.find('.shareholder');
                    let shareContain = keyShareholderRow.find('.share-value');
                    shareContain.removeClass('td-error');

                    if (shareholder.length == 0) {
                        $('#key-shareholder-message').text('Please enter a share holder name');
                        error = true;
                        shareName.addClass('td-error');
                    }

                    shareValue = shareValue.replace(/,/g, '');
                    if (!error && shareValue.trim().length == 0) {
                        $('#key-shareholder-message').text('Please enter a share value or minimal 0');
                        error = true;
                        shareContain.addClass('td-error');
                    }


                    if (isNaN(shareValue)) {
                        $('#key-shareholder-message').text('Please enter a valid number');
                        error = true;
                        shareContain.addClass('td-error');
                    }

                    data.push({
                        shareholder: shareholder,
                        share_value: shareValue
                    });
                });

                if (error) {
                    return;
                }


                var url = '<?= base_url('rest/company_information/save_key_shareholders') ?>';
                var request = {
                    vcif: '<?= $vcif ?>',
                    year: '<?= $account_planning['doc_year'] ?>',
                    rows: data
                }
                var success = function (response) {
                    $('#key-shareholder-message', response.message);
                    window.loadKeyShareholders();
                };

                request = JSON.stringify(request);

                $.post(url, request, success);
                new PNotify({
                    title: 'Success!',
                    text: 'Key Shareholders Has Been Save.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            };

            window.loadKeyShareholders();

            // ===================== STRATEGIC PLANNING SECTION =====================


            var renderStrategicPlans = function (response, planningType) {
                window.strategicPlansTable = $('#strategic-plans-table-' + planningType);

                window.strategicPlansTable.empty();
                for (var index = 0; index < response[planningType].length; index++) {
                    var strategicPlan = response[planningType][index];
                    var rowElement = $('.strategic-plan-row-' + planningType).clone(true);
                    rowElement.removeClass('strategic-plan-row-' + planningType);
                    rowElement.find('.index').text(index + 1);
                    rowElement.find('.planning').text(strategicPlan.planning);
                    window.strategicPlansTable.append(rowElement);
                }
            };

            window.loadStrategicPlans = function () {
                var url = '<?= base_url('rest/company_information/get_strategic_plans/' . $vcif . '/' . $account_planning['doc_year']) ?>'
                $.post(url, null, function (response) {
                    renderStrategicPlans(response, 1);
                    renderStrategicPlans(response, 2);
                });
            }

            window.addStrategicPlans = function (planningType) {
                var strategicPlansTable = $('#strategic-plans-table-' + planningType);
                $('.strategic-plan-nodata').hide();
                var newRowElement = $('.strategic-plan-row').clone(true);
                newRowElement.removeClass('strategic-plan-row');
                strategicPlansTable.append(newRowElement);
            };

            window.saveStrategicPlans = function (planningType) {
                var error = false;
                var strategicPlansTable = $('#strategic-plans-table-' + planningType);
                var strategicPlanRows = strategicPlansTable.find('tr');
                var data = [];

                strategicPlanRows.each(function (index, element) {
                    if (error) {
                        return;
                    }

                    var strategicPlanRow = $(element);
                    strategicPlanRow.removeClass('td-error');

                    var planning = strategicPlanRow.find('.planning').text().trim();

                    if (planning.length == 0) {
                        $('#strategic-plan-message-' + planningType).text('Please enter a plan');
                        error = true;
                    }

                    data.push({planning: planning});
                });

                if (error) {
                    return;
                }

                var url = '<?= base_url('rest/company_information/save_strategic_plans') ?>';
                var request = {
                    vcif: '<?= $vcif ?>',
                    year: '<?= $account_planning['doc_year'] ?>',
                    planning_type: planningType,
                    rows: data
                }
                var success = function (response) {
                    $('#strategic-plan-message-' + planningType).text(response.message);
                    window.loadStrategicPlans();
                };
                request = JSON.stringify(request);
                $.post(url, request, success);
                new PNotify({
                    title: 'Success!',
                    text: 'strategic Plan Has Been Save.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            };

            window.loadStrategicPlans();

            window.saveGroupOverview = function () {
                var formFieldElements = $('#group-overview-form .form-control');
                var request = {};
                formFieldElements.each(function (index, element) {
                    var formFieldElement = $(this);
                    var fieldKey = formFieldElement.attr('id');
                    if (fieldKey == undefined) {
                        return;
                    }
                    var fieldValue = formFieldElement.val();
                    request[fieldKey] = fieldValue;
                });

                var url = '<?= base_url('rest/company_information/save_group_overview') ?>'
                request = JSON.stringify(request);
                $.post(url, request, function (response) {
                    $('#group-overview-message').text(response.message);
                });
                new PNotify({
                    title: 'Success!',
                    text: 'Group Overview Has Been Save.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            };

            window.loadGroupOverview = function () {
                var url = '<?= base_url('rest/company_information/get_group_overview/' . $vcif . '/' . $account_planning['doc_year']) ?>'
                $.post(url, null, function (response) {
                    for (var key in response) {
                        $('#' + key).val(response[key]);
                    }
                });
            }

            window.loadGroupOverview();
        });

        $('.table-remove').click(function () {
            $(this).parents('tr').detach();
        });

        $('.table-up').click(function () {
            var $row = $(this).parents('tr');
            if ($row.index() === 1)
                return; // Don't go above the header
            $row.prev().before($row.get(0));
        });

        $('.table-down').click(function () {
            var $row = $(this).parents('tr');
            $row.next().after($row.get(0));
        });

    </script>
    <script type="text/javascript">
        $('.selectpicker').selectpicker({
            style: 'btn-default',
            size: 10
        });

    </script>
