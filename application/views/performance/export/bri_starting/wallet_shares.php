<h4><b>Wallet Shares</b></h4>
<div class="smallfont righ">*Dalam rupiah</div>
        <div id="wallet-shares-container"></div>
        
        <div class="x_panel wallet-shares-template hide "> 
           
            <br />
            <div class="wallet-share-name"></div>
            <div class="table-editable table-account-planning">
                <table class="table wallet-share-details-table">
                    <thead>
                        <tr style="background: #012D5A; color: #FFF;">
                            <th >Facility</th>
                            <th >Total</th>
                            <th >Nominal BRI</th>
                            <th >Portion (%) BRI</th>
                            <th >Nominal Other</th>
                            <th >Portion (%) Other</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <span class="wallet-share-message"></span>
        </div>

        <table class="table-template ">
            <tr class="wallet-share-details-template" align="center">
                <td class=" name"></td>
                <td class=" total" style="text-align: right;"></td>
                <td class=" td-number bri-nominal" style="text-align: right;"></td>
                <td class=" td-number bri-percent" style="text-align: right;"></td>
                <td class=" td-number other-nominal" style="text-align: right;"></td>
                <td class=" td-number other-percent" style="text-align: right;"></td>
            </tr>
        </table>

        <script>
            var numberWithCommas = (a) => {
                if(a){
                    a = "," + a;
                    a = a.replace(/,/g, '');
                    a = a.trim();
                    return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }else{
                    return "0";
                }
            };
            var setComma = () => {
                $('.numberOnly').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
                $('.numberOnly').on('blur', function(e){
                    e.currentTarget.innerText = numberWithCommas(e.currentTarget.innerText);
                })
            }
            var renderWalletShareDetail = function (template, details, walletShareDetailId) {
                var walletShareDetail = details[walletShareDetailId];
                var detailsTable = template.find('.wallet-share-details-table');
                var rowTemplate = $('.wallet-share-details-template').clone(true);
                rowTemplate.removeClass('wallet-share-details-template');
                var totalShare = walletShareDetail.total_share;
                //
                var briShare = walletShareDetail.bri_share;
                var otherShare = totalShare - briShare;

                var briSharePercent = 0;
                var otherSharePercent = 0;

                if (totalShare > 0) {
                    briSharePercent = briShare / totalShare * 100;
                    otherSharePercent = otherShare / totalShare * 100;
                }

                rowTemplate.data('id', walletShareDetailId);
                rowTemplate.data('mandatory', walletShareDetail.mandatory);

                rowTemplate.find('.name').text(walletShareDetail.name);
                rowTemplate.find('.total').text(numberWithCommas(totalShare));
                rowTemplate.find('.bri-nominal').text(numberWithCommas(briShare));
                rowTemplate.find('.bri-percent').text(briSharePercent.toFixed(2));
                rowTemplate.find('.other-nominal').text(numberWithCommas(otherShare));
                rowTemplate.find('.other-percent').text(otherSharePercent.toFixed(2));

                detailsTable.append(rowTemplate);
            }

            var renderWalletShare = function (response, walletShareGroupId) {
                var template = $('.wallet-shares-template').clone(true);
                var walletShare = response[walletShareGroupId];
                //
                template.removeClass('wallet-shares-template');
                template.removeClass('hide');
                //
                template.find('.wallet-share-name').text(walletShare.name);
                template.find('.wallet-share-message').attr('id', 'wallet-share-message-' + walletShareGroupId);
                //
                var tableElement = template.find('.wallet-share-details-table');
                tableElement.data('id', walletShareGroupId);

                var details = walletShare.details;

                for (var walletShareDetailId in details) {
                    if (details.hasOwnProperty(walletShareDetailId)) {
                        renderWalletShareDetail(template, details, walletShareDetailId);
                    }
                }

                template.find('.btn-save').on('click', function () {
                    saveWalletShares(tableElement);
                });
                $('#wallet-shares-container').append(template);
            }

            var renderWalletShares = function (response) {
                $('#wallet-shares-container').empty();
                for (var walletShareGroupId in response) {
                    if (response.hasOwnProperty(walletShareGroupId)) {
                        renderWalletShare(response, walletShareGroupId);
                    }
                };
                setComma()
            };

            var loadWalletShares = function () {
                var url = '<?= base_url('/rest/bri_starting/get_wallet_shares/' . $vcif) ?>';
                $.post(url, null, renderWalletShares, 'json');
            };

            $(document).ready(loadWalletShares);
        </script>

        <?php if ($mode == 'edit') : ?>
            <script>
                //Global Functions and Procedures
                var saveWalletShares = function (tableElement) {

                    var groupId = tableElement.data('id');
                    var data = [];
                    var $tableRows = tableElement.find('tbody>tr');

                    var error = false;
                    var message = '';

                    $tableRows.each(function () {
                        if (error) {
                            return;
                        }
                   
                        var tableRowElement = $(this)
                        var tableCellsElement = tableRowElement.find('td');
                        
                        var totalShareElement = tableCellsElement.eq(1);
                        var totalShare = totalShareElement.text();

                        totalShare = totalShare.replace(/,/g, '');
                        totalShare = totalShare.trim();

                        if (totalShare.length == 0) {
                            totalShareElement.addClass('td-error');
                            error = true;
                            message = 'Please Enter a value';
                            return;
                        }
                        
                        if (isNaN(totalShare)) {
                            /*
                            totalShareElement.addClass('td-error');
                            error = true;
                            message = 'Please Enter a number';
                            return;
                            */
                            totalShare = 0;
                        }

                        if(parseInt(totalShare) < 0){
                            totalShareElement.addClass('td-error');
                            error = true;
                            message = 'Data below 0';
                            return;
                        }

                        var briShare = tableCellsElement.eq(2).text();
                        briShare = briShare.replace(/,/g, '');
                        briShare = briShare.trim();

                        if (+totalShare < +briShare) {
                            totalShareElement.addClass('td-error');
                            error = true;
                            message = 'Total Share must  be larger than BRI Share';
                            return;
                        }

                        var datum = {
                            mandatory: tableRowElement.data('mandatory'),
                            detail_id: tableRowElement.data('id'),
                            //total_share: tableCellsElement.eq(1).text().replace(/[^\d.]/g, '')
                            total_share: totalShare
                        };

                        data.push(datum);
                    });

                    if (error) {
                        $('#wallet-share-message-' + groupId).text(message);
                        return;
                    }


                    var request = {
                        vcif: '<?= $vcif ?>',
                        group_id: groupId,
                        rows: data
                    };

                    var url = '<?= base_url('/rest/bri_starting/save_wallet_shares') ?>';
                    var success = function (response) {
                        new PNotify({
                            title: 'Success!',
                            text: response.message,
                            type: 'success',
                            styling: 'bootstrap3',
                            delay: 500
                        });
                        loadWalletShares();
                    };

                    request = JSON.stringify(request);

                    $.post(url, request, success, 'json');
                };
            </script>
        <?php endif; ?>