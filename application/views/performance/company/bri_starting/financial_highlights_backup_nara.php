<div id="financial-highlights-container"></div>

<div class="financial-highlights-template hide"> 
    <b class="financial-highlight-name"></b>
    <div class="table-editable table-account-planning">  
        <table 
            class="table table-condensed table-bordered" >
            <thead>
                <tr class="financial-highlight-header" style="background: #012D5A; color: #FFF;">
                    <th>Keterangan</th>
                    <th style="text-align: center;" width="18%"></th>
                    <th style="text-align: center;" width="18%"></th>
                    <th style="text-align: center;" width="18%"></th>
                </tr>
            </thead>
            <tbody class="financial-highlight-details-table">
            </tbody>
        </table>
        <?php if ($mode == 'edit'): ?>
            <div class="btn-annual">
                <button class="btn btn-primary btn-save">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Save Data
                </button>
                <span class="financial-highlight-message"></span>
            </div>
        <?php endif; ?> 
    </div>
</div>

<table class="table-template hide">
    <tr class="financial-highlight-details-template" align="center">
        <td class="td-disabled" style="text-align: left;"></td>
        <td class="td-disabled" style="text-align: right;"></td>
        <td class="td-disabled" style="text-align: right;"></td>
        <td <?=
        $mode == 'edit' ?
                'class="txt td-number" contenteditable="true"' : 'class="td-disabled"'
        ?>  
            style="text-align: right;">
        </td>
    </tr>
</table>


<script>
    var years = [];

    var renderFinancialHighlightDetail = function (template, financialHighlightDetails, financialHighlightDetailId, nama) {
        var financialHighlightDetail = financialHighlightDetails[financialHighlightDetailId];
        var detailsTable = template.find('.financial-highlight-details-table');
        var rowTemplate = $('.financial-highlight-details-template').clone(true);
        rowTemplate.removeClass('financial-highlight-details-template');

        rowTemplate.data('id', financialHighlightDetailId);

        var cellTemplates = rowTemplate.find('td');
        cellTemplates.eq(1).addClass(nama);
        cellTemplates.eq(2).addClass(nama);
        cellTemplates.eq(3).addClass(nama);
        cellTemplates.eq(0).text(financialHighlightDetail.name);
        
        cellTemplates.eq(1).text(financialHighlightDetail[years[0]]);
        cellTemplates.eq(2).text(financialHighlightDetail[years[1]]);
        cellTemplates.eq(3).text(financialHighlightDetail[years[2]]);
        detailsTable.append(rowTemplate);
        if(parseInt(financialHighlightDetail[years[1]]) != 0 || parseInt(financialHighlightDetail[years[0]]) != 0){
            return 1
        }else{
            return 0
        }
    }

    var renderFinancialHighlight = function (financialHighlightGroups, financialHighlightGroupId) {
        var template = $('.financial-highlights-template').clone(true);
        var financialHighlight = financialHighlightGroups[financialHighlightGroupId];
        //
        template.removeClass('financial-highlights-template');
        template.removeClass('hide');
        //
        template.find('.financial-highlight-name').text(financialHighlight.name);
        template.find('.financial-highlight-message').attr('id', 'financial-highlight-message-' + financialHighlightGroupId);
        //
        var tableElement = template.find('.financial-highlight-details-table');
        tableElement.data('id', financialHighlightGroupId);

        var details = financialHighlight.details;
        var adaNol = 0
        for (var detailId in details) {
            if (details.hasOwnProperty(detailId)) {
                let temp = renderFinancialHighlightDetail(template, details, detailId, changeName(financialHighlight.name));
                if (adaNol == 0 && temp == 1){
                    adaNol = 1
                }
            }
        }
        
        if (adaNol == 0){
            let temp = changeName(financialHighlight.name)
            let temp2 = template.find('.' + temp);
            temp2.removeClass("td-disabled");
            temp2.addClass("txt td-number");
            temp2.attr("contenteditable","true");
        }
        

        template.find('.btn-save').on('click', function () {
            saveFinancialHighlights(tableElement);
        });
        $('#financial-highlights-container').append(template);
    }

    var renderFinancialHighlights = function (response) {
        years = response.years;
        
        var headerCells = $('.financial-highlight-header').find('th');

        headerCells.eq(1).text(years[0]);
        headerCells.eq(2).text(years[1]);
        headerCells.eq(3).text(years[2]);

        $('#financial-highlights-container').empty();
        var financialHighlightGroups = response.data;

        for (var financialHighlightGroupId in financialHighlightGroups) {
            if (financialHighlightGroups.hasOwnProperty(financialHighlightGroupId)) {
                renderFinancialHighlight(financialHighlightGroups, financialHighlightGroupId);
            }
        }
    };

    var loadFinancialHighlights = function () {
        var url = '<?= base_url('/rest/bri_starting/get_financial_highlights/' . $vcif) ?>';
        $.post(url, null, renderFinancialHighlights, 'json');
    };

    var changeName = function(str1){
        let hasil = str1.toLowerCase();
        hasil = hasil.replace(/\s/g, '');
        return hasil;
    }

    $(document).ready(loadFinancialHighlights);
</script>

<?php if ($mode == 'edit'): ?>
    <script>
        var saveFinancialHighlights = function (tableElement) {
            var groupId = tableElement.data('id');
            var data = [];
            var tableRowElements = tableElement.find('tr');

            var error = false;
            var message = '';

            tableRowElements.each(function () {
                if (error) {
                    return;
                }

                var tableRowElement = $(this)
                var tableCellsElement = tableRowElement.find('td');
                var dataValueElement = tableCellsElement.eq(3);

                dataValueElement.removeClass('td-error');

                var dataValue = dataValueElement.text();
                dataValue = dataValue.replace(/,/g, '');
                dataValue = dataValue.trim();

                if (dataValue.length == 0) {
                    dataValueElement.addClass('td-error');
                    error = true;
                    message = 'Please Enter a value';
                    return;
                }

                if (isNaN(dataValue)) {
                    dataValueElement.addClass('td-error');
                    error = true;
                    message = 'Please Enter a number';
                    return;
                }

                var datum = {
                    detail_id: tableRowElement.data('id'),
                    data_value: tableCellsElement.eq(3).text().replace(/,/g, '')
                };
                data.push(datum);
            });

            if (error) {
                $('#financial-highlight-message-' + groupId).text(message);
                return;
            }

            var request = JSON.stringify({
                vcif: '<?= $vcif ?>',
                group_id: groupId,
                rows: data
            });

            var url = '<?= base_url('rest/bri_starting/save_financial_highlights') ?>';
            var success = function (response) {
                $('#financial-highlight-message-' + groupId).text(response.message);
                loadFinancialHighlights();
            };

            $.post(url, request, success, 'json');
        };
    </script>
<?php endif; ?> 
