<b><h4>Estimated Financial (End of The Year)</b></h4>
<div id="action-plan-container"></div>

<div class="x_panel action-plan-template hide"> 
     &nbsp
    <br/>
    <div class="action-plan-name"></div>
    <div class="table-editable table-account-planning" >
        <table class="table table-condensed table-hover action-plan-details-table">
            <thead>
                <tr style="background: #012D5A; color: #fff;">
                    <th width="21%">Facilities</th>
                    <th width="21%">Projection Customer by IDR</th>
                    <th width="21%">Projection Customer by Valas</th>
                    <th width="21%">Target BRI by IDR</th>
                    <th width="21%">Target BRI by Valas</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div>
</div>

<table class="table-template hide">
    <tr class="action-plan-details-template" align="center">
        <td class="td-disabled name" style="text-align: left;"></td>
            <td class="td-disabled projection-idr" style="text-align: right;"></td>
            <td class="td-disabled projection-valas" style="text-align: right;"></td>
            <td class="td-disabled target-idr" style="text-align: right;"></td>
            <td class="td-disabled target-valas" style="text-align: right;"></td>
    </tr>
</table>

<script>
    var numberWithCommas = (a) => {
        if(a){
            a = a.toString().replace(/,/g, '');
            a = a.trim();
            let temp = a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            if (parseFloat(a).toFixed(2) < 0){
                a = Math.abs(a);
                temp = a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                temp = '(' + temp + ')';
            }
            return temp
        }else{
            return "0";
        }
    };
    
    var actionPlanDetail = function (template, details, actionPlanDetailId) {
        var actionPlanDetail = details[actionPlanDetailId];
        var detailsTable = template.find('.action-plan-details-table');
        var rowTemplate = $('.action-plan-details-template').clone(true);
        rowTemplate.removeClass('action-plan-details-template');

        var name = actionPlanDetail.name;
        var projectionIdr = actionPlanDetail.projection_idr;
        var projectionValas = actionPlanDetail.projection_valas;
        var targetIdr = actionPlanDetail.target_idr;
        var targetValas = actionPlanDetail.target_valas;

        projectionIdr = projectionIdr ? numberWithCommas(projectionIdr) : 0;
        projectionValas = projectionValas ? numberWithCommas(projectionValas) : 0;
        targetIdr = targetIdr ? numberWithCommas(targetIdr) : 0;
        targetValas = targetValas ? numberWithCommas(targetValas) : 0;
        
        rowTemplate.data('id', actionPlanDetailId);
        rowTemplate.data('mandatory', actionPlanDetail.mandatory);

        rowTemplate.find('.name').text(name);
        rowTemplate.find('.projection-idr').text(projectionIdr);
        rowTemplate.find('.projection-valas').text(projectionValas);
        rowTemplate.find('.target-idr').text(targetIdr);
        rowTemplate.find('.target-valas').text(targetValas);

        detailsTable.append(rowTemplate);
    }

    var renderEstimatedPl = function (response, estimatedPlanGroupId) {
        var template = $('.action-plan-template').clone(true);
        var estimatedPlan = response[estimatedPlanGroupId];
        //
        template.removeClass('action-plan-template');
        template.removeClass('hide');
        //
        template.find('.action-plan-name').text(estimatedPlan.name);
        template.find('.action-plan-message').attr('id', 'action-plan-message-' + estimatedPlanGroupId);
        //
        var tableElement = template.find('.action-plan-details-table');
        tableElement.data('id', estimatedPlanGroupId);

        var details = estimatedPlan.details;

        for (var actionPlanDetailId in details) {
            if (details.hasOwnProperty(actionPlanDetailId)) {
                actionPlanDetail(template, details, actionPlanDetailId);
            }
        }

        template.find('.btn-save').on('click', function () {
            saveActionPlanEstimated(tableElement);
        });
        $('#action-plan-container').append(template);
    }

    var renderEstimatedPlan = function (response) {
        $('#action-plan-container').empty();
        for (var estimatedPlanGroupId in response) {
            if (response.hasOwnProperty(estimatedPlanGroupId)) {
                renderEstimatedPl(response, estimatedPlanGroupId);
            }
        }
    };

    var loadEstimatedFinan = function () {
        var url = '<?= base_url('/rest/account_planning/get_action_plan_estimated/' . $vcif) ?>';
        $.post(url, null, renderEstimatedPlan, 'json');
    };

    $(document).ready(loadEstimatedFinan);
</script>

<script>
    var saveActionPlanEstimated = function (tableElement) {

        var groupId = tableElement.data('id');
        var data = [];
        var $tableRows = tableElement.find('tbody>tr');

        var error = false;
        var message = '';
        $(".td-error").removeClass("td-error");
        $tableRows.each(function () {

            if (error) {
                return;
            }

            var tableRowElement = $(this)
            var tableCellsElement = tableRowElement.find('td');
            var projectionIdr = tableCellsElement.eq(1);
            var projectionValas = tableCellsElement.eq(2);
            var targetIdr = tableCellsElement.eq(3);
            var targetValas = tableCellsElement.eq(4);
            var getProjectionIdr = projectionIdr.text().replace(/,/g, '');
            var getProjectionVls = projectionValas.text().replace(/,/g, '');
            var getTargetIdr = targetIdr.text().replace(/,/g, '');
            var getTargetVls = targetValas.text().replace(/,/g, '');

            if (+getProjectionIdr < +getTargetIdr) {
                projectionIdr.addClass('td-error');
                error = true;
                message = 'Projection IDR must be bigger than Target BRI IDR';
                return;
            }

            if (+getProjectionVls < +getTargetVls) {
                projectionValas.addClass('td-error');
                error = true;
                message = 'Projection Valas must be bigger than Target BRI Valas';
                return;
            }

           if (getProjectionIdr.length == 0) {
                    projectionIdr.addClass('td-error');                                
                    error = true;
                    message = 'Please enter a value';
                    return;
                }
           if (getProjectionVls.length == 0) {
                    projectionValas.addClass('td-error');                                
                    error = true;
                    message = 'Please enter a value';
                    return;
                }
            if (getTargetIdr.length == 0){
                    targetIdr.addClass('td-error');
                    error = true;
                    message = "Please enter a value";
                    return;
            }
            if (getTargetVls.length == 0){
                    targetValas.addClass('td-error');
                    error = true;
                    message = "Please enter a value"
                    return;
            }

            if (isNaN(getProjectionIdr)) {
                    projectionIdr.addClass('td-error');                                
                    error = true;
                    message = 'Please enter a number';
                    return;
                }
           if (isNaN(getProjectionVls)) {
                    projectionValas.addClass('td-error');                                
                    error = true;
                    message = 'Please enter a number';
                    return;
                }
            if (isNaN(getTargetIdr)){
                    targetIdr.addClass('td-error');
                    error = true;
                    message = "Please enter a number";
                    return;
            }
            if (isNaN(getTargetVls)){
                    targetValas.addClass('td-error');
                    error = true;
                    message = "Please enter a number"
                    return;
            }


            var datum = {
                mandatory: tableRowElement.data('mandatory'),
                detail_id: tableRowElement.data('id'),
                projection_idr: tableCellsElement.eq(1).text().replace(/,/g, ''),
                projection_valas: tableCellsElement.eq(2).text().replace(/,/g, ''),
                target_idr: tableCellsElement.eq(3).text().replace(/,/g, ''),
                target_valas: tableCellsElement.eq(4).text().replace(/,/g, '')
            };

            data.push(datum);
        });

        if (error) {
                $('#action-plan-message-' + groupId).text(message);
                return;
            }

        var request = JSON.stringify({
            vcif: vcif,
            group_id: groupId,
            rows: data
        });

        var url = '<?= base_url('/rest/account_planning/save_action_plan_estimated') ?>';
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
                  loadEstimatedFinan();
                }
        };

        $.post(url, request, success, 'json');
    };
</script>
