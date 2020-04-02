<?php
$disabled_cell = 'class="td-disabled"';
?>

<div id="competition-analyses-container"></div>

<div class="competition-analyses-template hide"> 
    <br />
    <b class="competition-analysis-name"></b>
    <div class="table-editable table-account-planning" style="overflow-x:auto;">
        <table class="table table-condensed table-hover competition-analysis-details-table">
            <thead>
                <tr style="background: #012D5A; color: #FFF;">
                    <th width="19%">Facilities</th>
                    <th width="27%">1</th>
                    <th width="27%">2</th>
                    <th width="27%">3</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <?php if ($mode == 'edit') : ?> 
            <div class="btn-annual">   
                <button class="btn btn-primary btn-save">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
                </button>
                <p class="competition-analysis-message"></p>
            </div>
        <?php endif; ?>    

    </div>
</div>

<table class="table-template hide">
    <tr class="competition-analysis-details-template" align="center">
        <td class="name td-disabled"></td>
        <td class="txt">
            <select 
                class="first-bank"
                <?= $mode == 'view' ? 'disabled' : '' ?>    
                >   <option value="">Please choose</option>
                    <?php foreach ($banks as $bank) : ?>
                    <option value="<?= $bank['BANK_ID'] ?>">
                        <?= $bank['BANK'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td class="txt numberOnly" >
            <select 
                class="second-bank"
                <?= $mode == 'view' ? 'disabled' : '' ?>    
                >   <option value="">Please choose</option>
                    <?php foreach ($banks as $bank) : ?>
                    <option value="<?= $bank['BANK_ID'] ?>">
                        <?= $bank['BANK'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td class="txt numberOnly">
            <select 
                class="third-bank"
                <?= $mode == 'view' ? 'disabled' : '' ?>    
                >   <option value="">Please choose</option>
                    <?php foreach ($banks as $bank) : ?>
                    <option value="<?= $bank['BANK_ID'] ?>">
                        <?= $bank['BANK'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>

</table>

<script>
    var renderCompetitionAnalysisDetail = function (template, details, competitionAnalysisDetailId) {
        var competitionAnalysisDetail = details[competitionAnalysisDetailId];
        var detailsTable = template.find('.competition-analysis-details-table');
        var rowTemplate = $('.competition-analysis-details-template').clone(true);
        rowTemplate.removeClass('competition-analysis-details-template');

        rowTemplate.data('id', competitionAnalysisDetailId);
        rowTemplate.data('mandatory', competitionAnalysisDetail.mandatory);

        rowTemplate.find('.name').text(competitionAnalysisDetail.name);
        rowTemplate.find('.first-bank').val(competitionAnalysisDetail.first_bank);
        rowTemplate.find('.second-bank').val(competitionAnalysisDetail.second_bank);
        rowTemplate.find('.third-bank').val(competitionAnalysisDetail.third_bank);

        detailsTable.append(rowTemplate);
    }

    var renderCompetitionAnalysis = function (response, CompetitionAnalysisGroupId) {
        var template = $('.competition-analyses-template').clone(true);
        var CompetitionAnalysis = response[CompetitionAnalysisGroupId];
        //
        template.removeClass('competition-analyses-template');
        template.removeClass('hide');
        //
        template.find('.competition-analysis-name').text(CompetitionAnalysis.name);
        var tableElement = template.find('.competition-analysis-details-table');
        tableElement.data('id', CompetitionAnalysisGroupId);

        var details = CompetitionAnalysis.details;

        for (var competitionAnalysisDetailId in details) {
            if (details.hasOwnProperty(competitionAnalysisDetailId)) {
                renderCompetitionAnalysisDetail(template, details, competitionAnalysisDetailId);
            }
        }

        template.find('.btn-save').on('click', function () {
            saveCompetitionAnalyses(tableElement);
        });

        $('#competition-analyses-container').append(template);
    }

    var renderCompetitionAnalyses = function (response) {
        $('#competition-analyses-container').empty();
        for (var CompetitionAnalysisGroupId in response) {
            if (response.hasOwnProperty(CompetitionAnalysisGroupId)) {
                renderCompetitionAnalysis(response, CompetitionAnalysisGroupId);
            }
        }
    };

    var loadCompetitionAnalyses = function () {
        var url = '<?= base_url('/rest/bri_starting/get_competition_analyses/' . $vcif) ?>';
        $.post(url, null, renderCompetitionAnalyses, 'json');
    };

    $(document).ready(loadCompetitionAnalyses);

</script>

<?php if ($mode == 'edit') : ?> 
    <script>
        var saveCompetitionAnalyses = function (tableElement) {
            var groupId = tableElement.data('id')
            var data = [];
            var $tableRows = tableElement.find('tbody>tr');

            $tableRows.each(function () {
                var tableRowElement = $(this)
                var tableCellsElement = tableRowElement.find('td');

                var datum = {
                    mandatory: tableRowElement.data('mandatory'),
                    detail_id: tableRowElement.data('id'),
                    //
                    first_bank: tableCellsElement.eq(1).find('select').val(),
                    second_bank: tableCellsElement.eq(2).find('select').val(),
                    third_bank: tableCellsElement.eq(3).find('select').val()
                };


                data.push(datum);
            });

            var request = {
                vcif: '<?= $vcif ?>',
                group_id: groupId,
                rows: data
            };

            var url = '<?= base_url('/rest/bri_starting/save_competition_analyses') ?>';
            var success = function (response) {
                new PNotify({
                    title: 'Success!',
                    text: response.message,
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 500
                });
            };

            request = JSON.stringify(request);
            $.post(url, request, success, 'json');
        };
    </script>
<?php endif; ?>