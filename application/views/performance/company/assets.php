<!-- 
=== I N D E X ===
-  1.1. GROUP OVERVIEW SECTION
-  1.2. KEY SHAREHOLDER SECTION
-  1.3. 
-  1.4. 
-->

<script type="text/javascript">
    $(document).ready(function () {
        $('.multiselect-ui').multiselect({
            onChange: function (option, checked) {
                // Get selected options.
                var selectedOptions = $('.multiselect-ui option:selected');

                if (selectedOptions.length >= 4) {
                    // Disable all other checkboxes.
                    var nonSelectedOptions = $('.multiselect-ui option').filter(function () {
                        return !$(this).is(':selected');
                    });

                    nonSelectedOptions.each(function () {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', true);
                        input.parent('li').addClass('disabled');
                    });
                } else {
                    // Enable all checkboxes.
                    $('.multiselect-ui option').each(function () {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', false);
                        input.parent('li').addClass('disabled');
                    });
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(".num").on("keydown", function (event) {
        if (event.which != 8 && event.which != 46 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
        }
    })
</script>

<!-- 1.2. KEY SHAREHOLDER SECTION -->

<!-- ========== LGR ======= -->




<script type="text/javascript">
    var $TABLE = $('#table');
    var $BTN = $('#cmhSave');
    var $vcif = $('#custCIF').val();
    var $EXPORT = $('#export');

    $('.table-add').click(function () {
        var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLE.find('table').append($clone);
    });

    $('.table-remove').click(function () {
        $(this).parents('tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTN.click(function () {
        var $rows = $TABLE.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            var header = $(this).text().toLowerCase();
            headers.push(header.replace(/\s/g, ''));

        });
        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        $EXPORT.text(JSON.stringify(data));
        $.ajax({
            type: 'POST',
            url: '../saveShareholder',
            data: {data: JSON.stringify(data), vcif: $vcif}
        });
    });
</script>

<script type="text/javascript">
    var $TABLExfinancial_highlights = $('#table-financial_highlights');
    var $BTNxfinancial_highlights = $('#export-financial_highlights-btn');
    var $EXPORTxfinancial_highlights = $('#export-financial_highlights');

    $('.table-financial_highlights-add').click(function () {
        var $clone = $TABLExfinancial_highlights.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExfinancial_highlights.find('table').append($clone);
    });

    $('.table-financial_highlights-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxfinancial_highlights.click(function () {
        var $rows = $TABLExfinancial_highlights.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxfinancial_highlights.text(JSON.stringify(data));
    });

// INCOME STATEMENT
    var $TABLExincome = $('#table-income');
    var $BTNxincome = $('#export-income-btn');
    var $EXPORTxincome = $('#export-income');

    $('.table-income-add').click(function () {
        var $clone = $TABLExincome.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExincome.find('table').append($clone);
    });

    $('.table-income-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxincome.click(function () {
        var $rows = $TABLExincome.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxincome.text(JSON.stringify(data));
    });
// END INCOME
// liquidity STATEMENT
    var $TABLExliquidity = $('#table-liquidity');
    var $BTNxliquidity = $('#export-liquidity-btn');
    var $EXPORTxliquidity = $('#export-liquidity');

    $('.table-liquidity-add').click(function () {
        var $clone = $TABLExliquidity.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExliquidity.find('table').append($clone);
    });

    $('.table-liquidity-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxliquidity.click(function () {
        var $rows = $TABLExliquidity.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxliquidity.text(JSON.stringify(data));
    });
// END liquidity
// activity STATEMENT
    var $TABLExactivity = $('#table-activity');
    var $BTNxactivity = $('#export-activity-btn');
    var $EXPORTxactivity = $('#export-activity');

    $('.table-activity-add').click(function () {
        var $clone = $TABLExactivity.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExactivity.find('table').append($clone);
    });

    $('.table-activity-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxactivity.click(function () {
        var $rows = $TABLExactivity.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxactivity.text(JSON.stringify(data));
    });
// END activity
// profitability STATEMENT
    var $TABLExprofitability = $('#table-profitability');
    var $BTNxprofitability = $('#export-profitability-btn');
    var $EXPORTxprofitability = $('#export-profitability');

    $('.table-profitability-add').click(function () {
        var $clone = $TABLExprofitability.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExprofitability.find('table').append($clone);
    });

    $('.table-profitability-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxprofitability.click(function () {
        var $rows = $TABLExprofitability.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxprofitability.text(JSON.stringify(data));
    });
// END profitability
// solvability STATEMENT
    var $TABLExsolvability = $('#table-solvability');
    var $BTNxsolvability = $('#export-solvability-btn');
    var $EXPORTxsolvability = $('#export-solvability');

    $('.table-solvability-add').click(function () {
        var $clone = $TABLExsolvability.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExsolvability.find('table').append($clone);
    });

    $('.table-solvability-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxsolvability.click(function () {
        var $rows = $TABLExsolvability.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxsolvability.text(JSON.stringify(data));
    });
// END solvability

// dirloan STATEMENT
    var $TABLExdirloan = $('#table-dirloan');
    var $BTNxdirloan = $('#export-dirloan-btn');
    var $EXPORTxdirloan = $('#export-dirloan');

    $('.table-dirloan-add').click(function () {
        var $clone = $TABLExdirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExdirloan.find('table').append($clone);
    });

    $('.table-dirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxdirloan.click(function () {
        var $rows = $TABLExdirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxdirloan.text(JSON.stringify(data));
    });
// END dirloan
// indirloan STATEMENT
    var $TABLExindirloan = $('#table-indirloan');
    var $BTNxindirloan = $('#export-indirloan-btn');
    var $EXPORTxindirloan = $('#export-indirloan');

    $('.table-indirloan-add').click(function () {
        var $clone = $TABLExindirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExindirloan.find('table').append($clone);
    });

    $('.table-indirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxindirloan.click(function () {
        var $rows = $TABLExindirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxindirloan.text(JSON.stringify(data));
    });
// END indirloan

// cash STATEMENT
    var $TABLExcash = $('#table-cash');
    var $BTNxcash = $('#export-cash-btn');
    var $EXPORTxcash = $('#export-cash');

    $('.table-cash-add').click(function () {
        var $clone = $TABLExcash.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExcash.find('table').append($clone);
    });

    $('.table-cash-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcash.click(function () {
        var $rows = $TABLExcash.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxcash.text(JSON.stringify(data));
    });
// END cash

// transc_banking STATEMENT
    var $TABLExtransc_banking = $('#table-transc_banking');
    var $BTNxtransc_banking = $('#export-transc_banking-btn');
    var $EXPORTxtransc_banking = $('#export-transc_banking');

    $('.table-transc_banking-add').click(function () {
        var $clone = $TABLExtransc_banking.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExtransc_banking.find('table').append($clone);
    });

    $('.table-transc_banking-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxtransc_banking.click(function () {
        var $rows = $TABLExtransc_banking.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxtransc_banking.text(JSON.stringify(data));
    });
// END transc_banking

// wallet_dirloan STATEMENT
    var $TABLExwallet_dirloan = $('#table-wallet_dirloan');
    var $BTNxwallet_dirloan = $('#export-wallet_dirloan-btn');
    var $EXPORTxwallet_dirloan = $('#export-wallet_dirloan');

    $('.table-wallet_dirloan-add').click(function () {
        var $clone = $TABLExwallet_dirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExwallet_dirloan.find('table').append($clone);
    });

    $('.table-wallet_dirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxwallet_dirloan.click(function () {
        var $rows = $TABLExwallet_dirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxwallet_dirloan.text(JSON.stringify(data));
    });
// END wallet_dirloan
// wallet_indirloan STATEMENT
    var $TABLExwallet_indirloan = $('#table-wallet_indirloan');
    var $BTNxwallet_indirloan = $('#export-wallet_indirloan-btn');
    var $EXPORTxwallet_indirloan = $('#export-wallet_indirloan');

    $('.table-wallet_indirloan-add').click(function () {
        var $clone = $TABLExwallet_indirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExwallet_indirloan.find('table').append($clone);
    });

    $('.table-wallet_indirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxwallet_indirloan.click(function () {
        var $rows = $TABLExwallet_indirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxwallet_indirloan.text(JSON.stringify(data));
    });
// END wallet_indirloan

// wallet_cash STATEMENT
    var $TABLExwallet_cash = $('#table-wallet_cash');
    var $BTNxwallet_cash = $('#export-wallet_cash-btn');
    var $EXPORTxwallet_cash = $('#export-wallet_cash');

    $('.table-wallet_cash-add').click(function () {
        var $clone = $TABLExwallet_cash.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExwallet_cash.find('table').append($clone);
    });

    $('.table-wallet_cash-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxwallet_cash.click(function () {
        var $rows = $TABLExwallet_cash.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxwallet_cash.text(JSON.stringify(data));
    });
// END wallet_cash

// wallet_transc_banking STATEMENT
    var $TABLExwallet_transc_banking = $('#table-wallet_transc_banking');
    var $BTNxwallet_transc_banking = $('#export-wallet_transc_banking-btn');
    var $EXPORTxwallet_transc_banking = $('#export-wallet_transc_banking');

    $('.table-wallet_transc_banking-add').click(function () {
        var $clone = $TABLExwallet_transc_banking.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExwallet_transc_banking.find('table').append($clone);
    });

    $('.table-wallet_transc_banking-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxwallet_transc_banking.click(function () {
        var $rows = $TABLExwallet_transc_banking.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxwallet_transc_banking.text(JSON.stringify(data));
    });
// END wallet_transc_banking

// comp_analyst_dirloan STATEMENT
    var $TABLExcomp_analyst_dirloan = $('#table-comp_analyst_dirloan');
    var $BTNxcomp_analyst_dirloan = $('#export-comp_analyst_dirloan-btn');
    var $EXPORTxcomp_analyst_dirloan = $('#export-comp_analyst_dirloan');

    $('.table-comp_analyst_dirloan-add').click(function () {
        var $clone = $TABLExcomp_analyst_dirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExcomp_analyst_dirloan.find('table').append($clone);
    });

    $('.table-comp_analyst_dirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcomp_analyst_dirloan.click(function () {
        var $rows = $TABLExcomp_analyst_dirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxcomp_analyst_dirloan.text(JSON.stringify(data));
    });
// END comp_analyst_dirloan
// comp_analyst_indirloan STATEMENT
    var $TABLExcomp_analyst_indirloan = $('#table-comp_analyst_indirloan');
    var $BTNxcomp_analyst_indirloan = $('#export-comp_analyst_indirloan-btn');
    var $EXPORTxcomp_analyst_indirloan = $('#export-comp_analyst_indirloan');

    $('.table-comp_analyst_indirloan-add').click(function () {
        var $clone = $TABLExcomp_analyst_indirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExcomp_analyst_indirloan.find('table').append($clone);
    });

    $('.table-comp_analyst_indirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcomp_analyst_indirloan.click(function () {
        var $rows = $TABLExcomp_analyst_indirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxcomp_analyst_indirloan.text(JSON.stringify(data));
    });
// END comp_analyst_indirloan

// comp_analyst_cash STATEMENT
    var $TABLExcomp_analyst_cash = $('#table-comp_analyst_cash');
    var $BTNxcomp_analyst_cash = $('#export-comp_analyst_cash-btn');
    var $EXPORTxcomp_analyst_cash = $('#export-comp_analyst_cash');

    $('.table-comp_analyst_cash-add').click(function () {
        var $clone = $TABLExcomp_analyst_cash.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExcomp_analyst_cash.find('table').append($clone);
    });

    $('.table-comp_analyst_cash-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcomp_analyst_cash.click(function () {
        var $rows = $TABLExcomp_analyst_cash.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxcomp_analyst_cash.text(JSON.stringify(data));
    });
// END comp_analyst_cash

// comp_analyst_transc_banking STATEMENT
    var $TABLExcomp_analyst_transc_banking = $('#table-comp_analyst_transc_banking');
    var $BTNxcomp_analyst_transc_banking = $('#export-comp_analyst_transc_banking-btn');
    var $EXPORTxcomp_analyst_transc_banking = $('#export-comp_analyst_transc_banking');

    $('.table-comp_analyst_transc_banking-add').click(function () {
        var $clone = $TABLExcomp_analyst_transc_banking.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExcomp_analyst_transc_banking.find('table').append($clone);
    });

    $('.table-comp_analyst_transc_banking-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcomp_analyst_transc_banking.click(function () {
        var $rows = $TABLExcomp_analyst_transc_banking.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxcomp_analyst_transc_banking.text(JSON.stringify(data));
    });
// END comp_analyst_transc_banking

// cpa_existing STATEMENT
    var $TABLExcpa_existing = $('#table-cpa_existing');
    var $BTNxcpa_existing = $('#export-cpa_existing-btn');
    var $EXPORTxcpa_existing = $('#export-cpa_existing');

    $('.table-cpa_existing-add').click(function () {
        var $clone = $TABLExcpa_existing.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExcpa_existing.find('table').append($clone);
    });

    $('.table-cpa_existing-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxcpa_existing.click(function () {
        var $rows = $TABLExcpa_existing.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxcpa_existing.text(JSON.stringify(data));
    });
// END cpa_existing

// input_form STATEMENT
    var $TABLExinput_form = $('#table-input_form');
    var $BTNxinput_form = $('#export-input_form-btn');
    var $EXPORTxinput_form = $('#export-input_form');

    $('.table-input_form-add').click(function () {
        var $clone = $TABLExinput_form.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExinput_form.find('table').append($clone);
    });

    $('.table-input_form-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxinput_form.click(function () {
        var $rows = $TABLExinput_form.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxinput_form.text(JSON.stringify(data));
    });
// END input_form
</script>

<script type="text/javascript">
// estimated_financial_dirloan STATEMENT
    var $TABLExestimated_financial_dirloan = $('#table-estimated_financial_dirloan');
    var $BTNxestimated_financial_dirloan = $('#export-estimated_financial_dirloan-btn');
    var $EXPORTxestimated_financial_dirloan = $('#export-estimated_financial_dirloan');

    $('.table-estimated_financial_dirloan-add').click(function () {
        var $clone = $TABLExestimated_financial_dirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExestimated_financial_dirloan.find('table').append($clone);
    });

    $('.table-estimated_financial_dirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxestimated_financial_dirloan.click(function () {
        var $rows = $TABLExestimated_financial_dirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            var header = $(this).text().toLowerCase();
            headers.push(header.replace(/\s/g, ''));

        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxestimated_financial_dirloan.text(JSON.stringify(data));

        $.ajax({
            type: 'POST',
            url: '../saveEstFinDirloan',
            data: {data: JSON.stringify(data), vcif: $vcif}
        });


    });

    // estimated_financial_indirloan STATEMENT
</script>
<script type="text/javascript">
    var $TABLExestimated_financial_indirloan = $('#table-estimated_financial_indirloan');
    var $BTNxestimated_financial_indirloan = $('#export-estimated_financial_indirloan-btn');
    var $EXPORTxestimated_financial_indirloan = $('#export-estimated_financial_indirloan');

    $('.table-estimated_financial_indirloan-add').click(function () {
        var $clone = $TABLExestimated_financial_indirloan.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExestimated_financial_indirloan.find('table').append($clone);
    });

    $('.table-estimated_financial_indirloan-remove').click(function () {
        $(this).parents('.tr').detach();
    });

// A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxestimated_financial_indirloan.click(function () {
        var $rows = $TABLExestimated_financial_indirloan.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            var header = $(this).text().toLowerCase();
            headers.push(header.replace(/\s/g, ''));

        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxestimated_financial_indirloan.text(JSON.stringify(data));

        $.ajax({
            type: 'POST',
            url: '../saveEstFinInLoan',
            data: {data: JSON.stringify(data), vcif: $vcif}
        });

    });
// END estimated_financial_indirloan
</script>

<script type="text/javascript">
// estimated_financial_transc_banking STATEMENT
    var $TABLExestimated_financial_transc_banking = $('#table-estimated_financial_transc_banking');
    var $BTNxestimated_financial_transc_banking = $('#export-estimated_financial_transc_banking-btn');
    var $EXPORTxestimated_financial_transc_banking = $('#export-estimated_financial_transc_banking');

    $('.table-estimated_financial_transc_banking-add').click(function () {
        var $clone = $TABLExestimated_financial_transc_banking.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExestimated_financial_transc_banking.find('table').append($clone);
    });

    $('.table-estimated_financial_transc_banking-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxestimated_financial_transc_banking.click(function () {
        var $rows = $TABLExestimated_financial_transc_banking.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            var header = $(this).text().toLowerCase();
            headers.push(header.replace(/\s/g, ''));

        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxestimated_financial_transc_banking.text(JSON.stringify(data));
        $.ajax({
            type: 'POST',
            url: '../saveEstTrans',
            data: {data: JSON.stringify(data), vcif: $vcif}
        });

    });
// END estimated_financial_transc_banking
</script>

<script type="text/javascript">
// estimated_financial_cash STATEMENT
    var $TABLExestimated_financial_cash = $('#table-estimated_financial_cash');
    var $BTNxestimated_financial_cash = $('#export-estimated_financial_cash-btn');
    var $EXPORTxestimated_financial_cash = $('#export-estimated_financial_cash');

    $('.table-estimated_financial_cash-add').click(function () {
        var $clone = $TABLExestimated_financial_cash.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLExestimated_financial_cash.find('table').append($clone);
    });

    $('.table-estimated_financial_cash-remove').click(function () {
        $(this).parents('.tr').detach();
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTNxestimated_financial_cash.click(function () {
        var $rows = $TABLExestimated_financial_cash.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            var header = $(this).text().toLowerCase();
            headers.push(header.replace(/\s/g, ''));

        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORTxestimated_financial_cash.text(JSON.stringify(data));
        $.ajax({
            type: 'POST',
            url: '../saveEstCash',
            data: {data: JSON.stringify(data), vcif: $vcif}
        });

    });
// END estimated_financial_cash
</script>