<script>
    var firstRun = true;
</script>
<style type="text/css">

    .switch-field {
        overflow: hidden;
    }

    .switch-title {
        margin-bottom: 6px;
    }

    .switch-field input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .switch-field label {
        float: left;
    }

    .switch-field label {
        display: inline-block;
        width: 160px;
        background-color: #e4e4e4;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
        font-weight: normal;
        text-align: center;
        text-shadow: none;
        padding: 6px 14px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        -webkit-transition: all 0.1s ease-in-out;
        -moz-transition:    all 0.1s ease-in-out;
        -ms-transition:     all 0.1s ease-in-out;
        -o-transition:      all 0.1s ease-in-out;
        transition:         all 0.1s ease-in-out;
    }

    .switch-field label:hover {
        cursor: pointer;
    }

    .switch-field input:checked + label {
        background-color: #012D5A;
        color: #fff;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .switch-field label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .switch-field label:last-of-type {
        border-radius: 0 4px 4px 0;
    }
</style>

<!-- <div class="btn-group navbar-right panel_toolbox" id="statusMata" data-toggle="buttons">

      <label >Rupiah</label><input type="radio" value="1" id="rupiah" name="RpDollar" >
      <label >Dollar</label><input type="radio" value="0" id="dollar" name="RpDollar">
</div> -->
<br>
<div id="financial-highlights-container"></div>

<div class="x_panel financial-highlights-template hide"> 
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

<div class="financial-highlights-template-add-page hide"> 
    <!--ADD_PAGE-->
    <b class="x_panel financial-highlight-name"></b>
    <div class="table-editable table-account-planning">  
        <table 
            class="table table-condensed table-bordered">
            <thead>
                <tr class="financial-highlight-header-add-page" style="background: #012D5A; color: #FFF;">
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
        <td <?=
        $mode == 'edit' ?
                'class="txt td-number numberOnly" contenteditable="true"' : 'class="td-disabled"'
        ?>   style="text-align: right;"></td>
        <td <?=
        $mode == 'edit' ?
                'class="txt td-number numberOnly" contenteditable="true"' : 'class="td-disabled"'
        ?>   style="text-align: right;"></td>
        <td <?=
        $mode == 'edit' ?
                'class="txt td-number numberOnly" contenteditable="true"' : 'class="td-disabled"'
        ?>  
            style="text-align: right;">
        </td>
    </tr>
</table>

<script>
    var years = [];

    var changeNWC = function () {
        for (let a = 0; a <= 2; a++) {

            let temp = $('.liquidity-row-14.liquidity' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberMinus");

            temp = $('.liquidity-row-12.liquidity' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent");

            temp = $('.liquidity-row-13.liquidity' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent");

            temp = $('.solvability-row-21.solvability' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent");

            temp = $('.solvability-row-22.solvability' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent");

            temp = $('.solvability-row-23.solvability' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent");

            temp = $('.profitability-row-18.profitability' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent bigger100");

            temp = $('.profitability-row-19.profitability' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent bigger100");

            temp = $('.profitability-row-20.profitability' + a);
            temp.removeClass("txt numberOnly");
            temp.addClass("numberPercent bigger100");
        }
        $('.numberPercent').on('blur', function (e) {
            let a = e.currentTarget.innerText;
            a = a.toString().replace(/,/g, '');
            a = a.trim();
            let b = parseFloat(a).toFixed(2);
            if ($(this).hasClass('bigger100') && b > 100.00) {
                $(this).addClass('td-error');
                return;
            } else {
                $(this).removeClass('td-error');
            }
            e.currentTarget.innerText = b;
        });
        $(".numberPercent").each(function (index) {
            let a = $(this).text();
            a = a.toString().replace(/,/g, '');
            a = a.trim();
            let b = parseFloat(a).toFixed(2);
            $(this).text(b);
        })
        $(".numberMinus").on('')
    }

    var renderFinancialHighlightDetail = function (template, financialHighlightDetails, financialHighlightDetailId, nama, financialHighlightDisable) {
        var financialHighlightDetail = financialHighlightDetails[financialHighlightDetailId];
        var detailsTable = template.find('.financial-highlight-details-table');
        var rowTemplate = $('.financial-highlight-details-template').clone(true);
        rowTemplate.removeClass('financial-highlight-details-template');

        rowTemplate.data('id', financialHighlightDetailId);

        var cellTemplates = rowTemplate.find('td');
        cellTemplates.eq(1).addClass(nama + '0');
        cellTemplates.eq(2).addClass(nama + '1');
        cellTemplates.eq(3).addClass(nama + '2');
        cellTemplates.eq(1).addClass(nama + '-row-' + financialHighlightDetailId);
        cellTemplates.eq(2).addClass(nama + '-row-' + financialHighlightDetailId);
        cellTemplates.eq(3).addClass(nama + '-row-' + financialHighlightDetailId);
        cellTemplates.eq(0).text(financialHighlightDetail.name);
        /*
<?php if ($mode == 'edit'): ?>
             //rubah menjadi 0 bila account planning doc_status != 4
             if(firstRun == true){
             financialHighlightDisable[0] == 1 ? cellTemplates.eq(1).text(financialHighlightDetail[years[0]]) : cellTemplates.eq(1).text('0');
             financialHighlightDisable[0] == 1 ? cellTemplates.eq(2).text(financialHighlightDetail[years[1]]) : cellTemplates.eq(2).text('0');
             cellTemplates.eq(3).text(financialHighlightDetail[years[2]]);
             }else{
             cellTemplates.eq(1).text(financialHighlightDetail[years[0]]);
             cellTemplates.eq(2).text(financialHighlightDetail[years[1]]);
             cellTemplates.eq(3).text(financialHighlightDetail[years[2]]);
             }
<?php else: ?> 
             cellTemplates.eq(1).text(financialHighlightDetail[years[0]]);
             cellTemplates.eq(2).text(financialHighlightDetail[years[1]]);
             cellTemplates.eq(3).text(financialHighlightDetail[years[2]]);
<?php endif; ?> 
         */
        let a = financialHighlightDetail[years[0]].toString().replace(/\.00$/g, '');
        let b = financialHighlightDetail[years[1]].toString().replace(/\.00/g, '');
        let c = financialHighlightDetail[years[2]].toString().replace(/\.00/g, '');
        if (parseFloat(a) < 0) {
            a = financialHighlightDetail[years[0]].toString().replace(/,/g, '');
            a = '(' + Math.abs(a) + ')';
        }
        ;
        if (parseFloat(b) < 0) {
            b = financialHighlightDetail[years[1]].toString().replace(/,/g, '');
            b = '(' + Math.abs(b) + ')';
        }
        if (parseFloat(c) < 0) {
            c = financialHighlightDetail[years[2]].toString().replace(/,/g, '');
            c = '(' + Math.abs(c) + ')';
        }
        cellTemplates.eq(1).text(a);
        cellTemplates.eq(2).text(b);
        cellTemplates.eq(3).text(c);

        detailsTable.append(rowTemplate);
        if (parseInt(financialHighlightDetail[years[1]]) != 0 || parseInt(financialHighlightDetail[years[0]]) != 0) {
            return 1
        } else {
            return 0
        }
    }

    var renderFinancialHighlight = function (financialHighlightGroups, financialHighlightGroupId, financialHighlightDisable, financialHighlightCurrency) {
        var template = $('.financial-highlights-template').clone(true);
        var nextPage = [
            "Profitability",
            "Solvability"
        ]


        var financialHighlight = financialHighlightGroups[financialHighlightGroupId];
        var financialCurrencyId = financialHighlightCurrency;

        template.removeClass('financial-highlights-template');
        template.removeClass('hide');
        template.find('.financial-highlight-name').text(financialHighlight.name);
        template.find('.financial-highlight-message').attr('id', 'financial-highlight-message-' + financialHighlightGroupId);
        //
        var tableElement = template.find('.financial-highlight-details-table');
        tableElement.data('id', financialHighlightGroupId);

        var details = financialHighlight.details;

        for (var detailId in details) {
            if (details.hasOwnProperty(detailId)) {
                let temp = renderFinancialHighlightDetail(template, details, detailId, changeName(financialHighlight.name), financialHighlightDisable);
            }
        }
        for (let a in financialHighlightDisable) {
            if (financialHighlightDisable[a] == 1) {
                let temp = changeName(financialHighlight.name)
                let temp2 = template.find('.' + temp + a);
                temp2.removeClass("txt td-number numberOnly");
                temp2.addClass("td-disabled");
                temp2.removeAttr("contenteditable");
            }
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

        var headerCells = $('.financial-highlight-header-add-page').find('th');
        headerCells.eq(1).text(years[0]);
        headerCells.eq(2).text(years[1]);
        headerCells.eq(3).text(years[2]);

        $('#financial-highlights-container').empty();
        var financialHighlightGroups = response.data;
        var financialHighlightDisable = response.disable_year;
        var financialHighlightCurrency = response.currency;
        for (var financialHighlightGroupId in financialHighlightGroups) {
            if (financialHighlightGroups.hasOwnProperty(financialHighlightGroupId)) {
                renderFinancialHighlight(financialHighlightGroups, financialHighlightGroupId, financialHighlightDisable, financialHighlightCurrency);
            }
        }
        changeNWC();
        function isNumberKey(e) {
            var charCode = (e.which) ? e.which : e.keyCode;

            if (charCode == 189) {
                return true;
            } else {
                -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || (/65|67|86|88/.test(e.keyCode) && (e.ctrlKey === true || e.metaKey === true)) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode)
            }
            return false;

            return true;
        }
        $('.numberMinus').off("keydown");
        $('.numberMinus').on('keydown', function (e) {
            if (e.keyCode == 189) {
                return true;
            } else if (e.keyCode == 13) {
                return false;
            } else {
                -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || (/65|67|86|88/.test(e.keyCode) && (e.ctrlKey === true || e.metaKey === true)) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
            }
        });
        $('.numberOnly').on('blur', function (e) {
            let a = e.currentTarget.innerText;
            a = a.toString().replace(/,/g, '');
            if (a.toString().indexOf('.') != -1) {
                a = parseFloat(a).toFixed(2)
            }
            e.currentTarget.innerText = numberWithCommas(a);
        });
        firstRun = false;
    };

    var loadFinancialHighlights = function () {
        var url = '<?= base_url('/rest/bri_starting/get_financial_highlights/' . $vcif . '/' . $account_planning["doc_year"]) ?>';
        $.post(url, null, renderFinancialHighlights, 'json');
    };

    var changeName = function (str1) {
        let hasil = str1.toLowerCase();
        hasil = hasil.replace(/\s/g, '');
        hasil = hasil.replace(/\(/g, '');
        hasil = hasil.replace(/\)/g, '');
        return hasil;
    }

    $(document).ready(loadFinancialHighlights);
</script>

<?php if ($mode == 'edit'): ?>
    <script>
        /*
         var checkPercent = function(tableElement){
         var hasil = false;
         $(".numberPercent").each(function(index){
         let a = $(this).text()
         a = a.toString().replace(/,/g, '');
         a = a.trim();
         let b = parseFloat(a).toFixed(2);
         if($(this).hasClass('bigger100') && b > 100.00){
         $(this).addClass('td-error');
         if (!hasil){hasil = true};
         }
         })
         return hasil;
         };
         */
        var saveFinancialHighlights = function (tableElement) {
            var groupId = tableElement.data('id');
            var data = [];
            var tableRowElements = tableElement.find('tr');
            var message = '';
            /*
             var error = checkPercent(tableElement);
             if(error){
             message = "Percent need to below 100";
             $('#financial-highlight-message-' + groupId).text(message);
             return;
             }
             */
            var error = false;
            let year_current = <?= $account_planning["doc_year"] ?>;
            tableRowElements.each(function () {
                if (error) {
                    return;
                }

                let tableRowElement = $(this)
                let tableCellsElement = tableRowElement.find('td');
                let d = new Date();
                let i = [1, 2, 3];
                let j = [3, 2, 1];
                for (let x in i) {
                    let dataValueElement = tableCellsElement.eq(i[x]);
                    dataValueElement.removeClass('td-error');

                    let dataValue = dataValueElement.text();
                    mataUang = $('#statusMata input:radio:checked').val();
                    dataValue = dataValue.replace(/,/g, '');
                    dataValue = dataValue.trim();
                    let kurung = (dataValue.indexOf('(') !== -1 && dataValue.indexOf(')') !== -1);
                    if (kurung) {
                        dataValue = dataValue.replace(/\(/g, '');
                        dataValue = dataValue.replace(/\)/g, '');
                        dataValue = '-' + dataValue;
                    }
                    //Check Percent
                    if (dataValueElement.hasClass("numberPercent")) {
                        let b = parseFloat(dataValue).toFixed(2);
                        if (dataValueElement.hasClass('bigger100') && b > 100.00) {
                            dataValueElement.addClass('td-error');
                            error = true;
                            message = "Percent need to below 100";
                            return;
                        }
                    }
                    //END Check Percent
                    if (i[x] == 3) {
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
                    }
                    let year = year_current - j[x];
                    let datum = {
                        detail_id: tableRowElement.data('id'),
                        data_year: year,
                        data_value: dataValue
                    };
                    data.push(datum);
                }
            });

            if (error) {
                $('#financial-highlight-message-' + groupId).text(message);
                return;
            }

            var request = JSON.stringify({
                vcif: '<?= $vcif ?>',
                group_id: groupId,
                rows: data,
                years: [year_current - 3, year_current - 2],
                year_now: year_current,
                currency: mataUang
            });

            var url = '<?= base_url('rest/bri_starting/save_financial_highlights') ?>';
            var success = function (response) {
                $('#financial-highlight-message-' + groupId).text(response.message);
                new PNotify({
                    title: 'Success!',
                    text: response.message,
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 500
                });
                loadFinancialHighlights();
            };

            $.post(url, request, success, 'json');
        };
    </script>
<?php endif; ?> 
<script>
    $(document).ready(function () {
        $('.numberOnly').on('blur', function (e) {
            let a = e.currentTarget.innerText;
            if (a.toString().indexOf('.') != -1) {
                a = parseFloat(a).toFixed(2)
            }
            e.currentTarget.innerText = numberWithCommas(a);
        })
        $('.numberPercent').on('blur', function (e) {
            let a = e.currentTarget.innerText;
            let b = parseFloat(numberWithCommas(a)).toFixed(2);
            if ($(this).hasClass('bigger100') && b > 100.00) {
                $(this).addClass('td-error');
                return;
            } else {
                $(this).removeClass('td-error');
            }
            e.currentTarget.innerText = b;
        })
    });
</script>
