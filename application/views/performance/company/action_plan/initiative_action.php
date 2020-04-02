<?php
$disabled_cell = 'class="td-disabled"';
$enabled_cell = 'class="txt" contenteditable="true"';
?>
<br />
<script src="<?= base_url(); ?>assets/bootstrap-datetimepicker-master/js/moment.js"></script>
<script src="<?= base_url(); ?>assets/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
<link href="<?= base_url(); ?>assets/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>

<div id="table-initiative_action" class="table-editable table-account-planning">
    <table class="table">
        <thead>
            <tr class="initiative_action" style="background: #012D5A; color: #fff;">
                <th width="30%">Initiative</th>
                <th width="30%">Action Plan</th>
                <th width="30%">Description</th>
                <?php if ($mode == 'edit') : ?>
                    <th width="10%">Actions</th>
                <?php endif; ?> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($initiative_actions as $initiative_action) : ?>
                <tr class="">
                    <td 
                        style="text-align: left;"
                        <?= $mode == 'edit' ? $enabled_cell : $disabled_cell ?>
                        >
                        <?= $initiative_action['initiatives']; ?></td>
                    <td 
                        style="text-align: left;"
                        <?= $mode == 'view' ? 'disabled' : '' ?> 
                        >
                        <!-- <select 
                       
                        <?= $mode == 'view' ? 'disabled' : '' ?>
                        >
                        <?php foreach ($periods as $periode) : ?>
                                        <option 
                                            value="<?= $periode->ID ?>"
                            <?= $periode->ID == $initiative_action['quarter_id'] ? 'selected' : '' ?>
                                            >
                            <?= $periode->QUARTER_NAME ?> <?= $periode->MONTH_NAME ?>
                                        </option>
                        <?php endforeach; ?>          
                        </select> -->
                        <div class="form-group">
                            <div class='input-group date datetimepicker1'>
                                <input type='text' class="form-control" value="<?= $initiative_action['period_date']; ?>"  readonly <?= $mode == 'view' ? 'disabled' : '' ?>/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </td>
                    <td 
                        style="text-align: left;"
                        <?= $mode == 'edit' ? $enabled_cell : $disabled_cell ?>
                        >
                            <?= $initiative_action['description']; ?>
                    </td>
                    <?php if ($mode == 'edit') : ?>
                        <td>
                            <span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this)"></span>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

            <?php if (empty($initiative_actions)) : ?>
                <?php if ($mode == 'edit') : ?>
                    <tr id="norecordInitiative" class="">
                        <td class="txt" contenteditable="true" style="text-align: left;"></td>
                        <td class="txt numberOnly" >

                           <!--  <select>
                            <?php foreach ($periods as $period) : ?>
                                                <option value="<?= $period->ID ?>"> <?= $period->QUARTER_NAME ?> <?= $period->MONTH_NAME ?></option>
                            <?php endforeach; ?>          
                            </select> -->
                            <div class="form-group">
                                <div class='input-group date datetimepicker1'>
                                    <input type='text' class="form-control" readonly/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <input type="hidden" name="custCIF" id="custCIF" value="<?= $account_planning['vcif']; ?>">
                        </td>
                        <td class="txt" contenteditable="true" style="text-align: left;"></td>
                        <td>
                            <span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this); return false"></span>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($mode == 'edit') : ?>
                <tr id="norecordInitiative" class="hide">
                    <td class="txt" contenteditable="true" style="text-align: left;"></td>
                    <td class="txt numberOnly">
                      <!--   <select>
                        <?php foreach ($periods as $period) : ?>
                                            <option value="<?= $period->ID ?>"> <?= $period->QUARTER_NAME ?> <?= $period->MONTH_NAME ?></option>
                        <?php endforeach; ?>
                        </select> -->
                        <div class="form-group">
                            <div class='input-group date'>
                                <input type='text' class="form-control" readonly/>
                                <span type="button" class="input-group-addon" <?= $mode == 'view' ? 'disabled' : '' ?>>
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="txt" contenteditable="true" style="text-align: left;"></td>
                    <td>
                        <span class="table-remove glyphicon glyphicon-remove" onclick="deleteRow(this); return false"></span>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if ($mode == 'edit') : ?>
    <div class="btn-annual">
        <button id="export-initiative_action-btn" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save Data</button>
        <button id="export-cm-btn" class="btn btn-warning table-initiative_action-add">
            <span class="glyphicon glyphicon-plus"></span> Row
        </button>
    </div>
    <p id="export-initiative_action"></p>
<?php endif; ?>

<?php if ($mode == 'edit') : ?>
    <script type="text/javascript">
        // initiative_action STATEMENT
        var $TABLExinitiative_action = $('#table-initiative_action');
        var $BTNxinitiative_action = $('#export-initiative_action-btn');
        var $EXPORTxinitiative_action = $('#export-initiative_action');
        var $vcif = $('#custCIF').val();

        $('.table-initiative_action-add').click(function () {
            var $clone = $TABLExinitiative_action.find('tr.hide').clone(true).removeClass('hide table-line');
            ;
            $clone.find('div.input-group').addClass('datetimepicker1');
            $TABLExinitiative_action.find('table').append($clone);
            $('.datetimepicker1').each(function () {
                if (!$(this).hasClass('adaDate')) {
                    $(this).datetimepicker({
                        format: 'YYYY-MM',
                        viewMode: 'years',
                        ignoreReadonly: true
                    });
                }
                ;
            });
        });

        $('.table-initiative_action-remove').click(function () {
            $(this).parents('.tr').detach();
        });

        // A few jQuery helpers for exporting only
        jQuery.fn.pop = [].pop;
        jQuery.fn.shift = [].shift;

        $BTNxinitiative_action.click(function () {

            var tableElement = $('#table-initiative_action');

            var data = [];
            var $tableRows = tableElement.find('tbody>tr:not(.hide)');
            var error = false;
            var message = '';


            $tableRows.each(function () {
                var tableRowElement = $(this)
                var tableCellsElement = tableRowElement.find('td');

                var getInitiative = tableCellsElement.eq(0).text().trim();
                var getAction_plan = tableCellsElement.eq(1).find('input').val();
                var getDescription = tableCellsElement.eq(2).text().trim();
                var initiaveVal = tableCellsElement.eq(0);
                var actionVal = tableCellsElement.eq(1);

                if (getInitiative.length == 0) {
                    error = true;
                    message = 'Silahkan input Initiative name';
                    return;
                }

                var datum = {

                    initiative: tableCellsElement.eq(0).text().replace(/,/g, ''),
                    action_plan: tableCellsElement.eq(1).find('input').val(),
                    description: tableCellsElement.eq(2).text().replace(/,/g, '')

                };
                data.push(datum);
            });

            if (error) {
                $('#export-initiative_action').text(message);
                return;
            }

            var url = '<?= base_url('rest/account_planning/save_initiative') ?>';
            var request = {
                vcif: '<?= $vcif ?>',
                year: '<?= $account_planning['doc_year'] ?>',
                rows: data
            };

            var success = function (response) {
                $('#export-initiative_action').text('');
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
    // END initiative_action
    </script>
<?php endif; ?>
<script type="text/javascript">
    $(function () {
        // Bootstrap DateTimePicker v4
        $('.datetimepicker1').datetimepicker({
            format: 'YYYY-MM',
            viewMode: 'years',
            ignoreReadonly: true
        });
        $('.datetimepicker1').addClass('adaDate');
    });
</script>