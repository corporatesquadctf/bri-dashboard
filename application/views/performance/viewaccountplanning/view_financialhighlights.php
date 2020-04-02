<div style="float: right;">
    <a href="#">See all history</a> | <a href="#">See log</a>
</div>
<?php
$today = new DateTime(date('Y-m-d H:i:s'));
$yearNow = $today->format('Y');
$yearMin1 = $yearNow - 1;
$yearMin2 = $yearMin1 - 1;
$yearMin3 = $yearMin2 - 1;
?>
<b>Balance Sheet</b>
<div id="table-financial_highlights" class="table-editable table-account-planning">  
    <table class="table">
        <tr class="financial_highlights" style="background: #012D5A; color: #FFF;">
            <th class="txt dis-none">kategori</th>
            <th>Keterangan</th>
            <th style="text-align: center;" width="18%"><?= $yearMin3 ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin2 ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin1 ?></th>
        </tr>
        <?php $totalFh = count($FINANCIAL_HIGHLIGHT['BALANCE_SHEET']); ?>
        <?php if ($totalFh > 0) : ?>
            <?php foreach ($FINANCIAL_HIGHLIGHT['BALANCE_SHEET'] as $fh) : ?>
                <tr align="center">
                    <td class="txt dis-none">balance</td>
                    <td class="txt" contenteditable="false" style="text-align: left;"><?= $fh->DETAIL_NAME ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($fh->YEAR3) ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($fh->YEAR2) ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($fh->YEAR1) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
        <?php endif; ?>
    </table>
    <p id="export-financial_highlights"></p>
</div>
<br />
<b>Income Statement</b>
<div id="table-income" class="table-editable table-account-planning">
    <table class="table">
        <tr class="income" style="background: #012D5A; color: #FFF;">
            <th class="txt dis-none">kategori</th>
            <th>Keterangan</th>
            <th style="text-align: center;" width="18%"><?= $yearMin3 ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin2 ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin1 ?></th>
        </tr>
        <?php $totalIs = count($FINANCIAL_HIGHLIGHT['INCOME_STATEMENT']); ?>
        <?php if ($totalIs > 0) : ?>
            <?php foreach ($FINANCIAL_HIGHLIGHT['INCOME_STATEMENT'] as $is) : ?>
                <tr align="center">
                    <td class="txt dis-none">income</td>
                    <td class="txt" contenteditable="false" style="text-align: left;"><?= $is->DETAIL_NAME; ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($is->YEAR3) ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($is->YEAR2) ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($is->YEAR1) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
        <?php endif; ?>
    </table>
    <p id="export-income"></p>
</div>

<br />
<b>Liquidity</b>
<div id="table-liquidity" class="table-editable table-account-planning">
    <table class="table">
        <tr class="liquidity" style="background: #012D5A; color: #FFF;">
            <th class="txt dis-none">kategori</th>
            <th>Keterangan</th>
            <th style="text-align: center;" width="18%"><?= $yearMin3 ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin2 ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin1 ?></th>
        </tr>
        <?php
        $totalLq = count($FINANCIAL_HIGHLIGHT['LIQUIDITY']);
        if ($totalLq > 0) :
            foreach ($FINANCIAL_HIGHLIGHT['LIQUIDITY'] as $lq) :
                ?>
                <tr align="center">
                    <td class="txt dis-none">liquidity</td>
                    <td class="txt" contenteditable="false" style="text-align: left;"><?= $lq->DETAIL_NAME; ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;">
                        <?= number_format($lq->YEAR3) . $lq->DETAIL_NAME == 'NWC' ? '' : '%' ?>
                    </td>
                    <td class="txt" contenteditable="false" style="text-align: right;">
                        <?= number_format($lq->YEAR2) . $lq->DETAIL_NAME == 'NWC' ? '' : '%' ?>
                    </td>
                    <td class="txt" contenteditable="false" style="text-align: right;">
                        <?= number_format($lq->YEAR1) . $lq->DETAIL_NAME == 'NWC' ? '' : '%' ?>
                    </td>
                </tr>
                <?php
            endforeach;
        else :
            ?>
            <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
        <?php endif; ?>
    </table>
    <p id="export-liquidity"></p>
</div>

<b>Activity</b>
<div id="table-activity" class="table-editable table-account-planning">
    <table class="table">
        <tr class="activity" style="background: #012D5A; color: #FFF;">
            <th class="txt dis-none">kategori</th>
            <th>Keterangan</th>
            <th style="text-align: center;" width="18%"><?= $yearMin3; ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin2; ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin1; ?></th>
        </tr>
        <?php
        $totalAv = count($FINANCIAL_HIGHLIGHT['ACTIVITY']);
        if ($totalAv > 0) :
            foreach ($FINANCIAL_HIGHLIGHT['ACTIVITY'] as $av) :
                ?>
                <tr align="center">
                    <td class="txt dis-none">activity</td>
                    <td class="txt" contenteditable="false" style="text-align: left;"><?= $av->DETAIL_NAME; ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($av->YEAR3); ?> Days</td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($av->YEAR2); ?> Days</td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($av->YEAR1); ?> Days</td>
                </tr>
                <?php
            endforeach;
        else :
            ?>
            <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
        <?php endif; ?>
    </table>
    <p id="export-activity"></p>
</div>

<b>Profitability</b>
<div id="table-profitability" class="table-editable table-account-planning">
    <table class="table">
        <tr class="profitability" style="background: #012D5A; color: #FFF;">
            <th class="txt dis-none">kategori</th>
            <th>Keterangan</th>
            <th style="text-align: center;" width="18%"><?= $yearMin3; ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin2; ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin1; ?></th>
        </tr>
        <?php
        $totalPb = count($FINANCIAL_HIGHLIGHT['PROFITABILITY']);
        if ($totalPb > 0) :
            foreach ($FINANCIAL_HIGHLIGHT['PROFITABILITY'] as $pb) :
                ?>
                <tr align="center">
                    <td class="txt dis-none">profitability</td>
                    <td class="txt" contenteditable="false" style="text-align: left;"><?= $pb->DETAIL_NAME; ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($pb->YEAR3); ?> %</td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($pb->YEAR2); ?> %</td>
                    <td class="txt" contenteditable="false" style="text-align: right;"><?= number_format($pb->YEAR1); ?> %</td>
                </tr>
                <?php
            endforeach;
        else :
            ?>
            <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
        <?php endif; ?>
    </table>
    <p id="export-profitability"></p>
</div>
<br>

<b>Solvability</b>
<div id="table-solvability" class="table-editable table-account-planning">
    <table class="table">
        <tr class="solvability" style="background: #012D5A; color: #FFF;">
            <th class="txt dis-none">kategori</th>
            <th>Keterangan</th>
            <th style="text-align: center;" width="18%"><?= $yearMin3; ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin2; ?></th>
            <th style="text-align: center;" width="18%"><?= $yearMin1; ?></th>
        </tr>
        <?php
        $totalSv = count($FINANCIAL_HIGHLIGHT['SOLVABILITY']);
        if ($totalSv > 0) :
            foreach ($FINANCIAL_HIGHLIGHT['SOLVABILITY'] as $sv) :
                ?>
                <tr align="center">
                    <td class="txt dis-none">solvability</td>
                    <td class="txt" contenteditable="false" style="text-align: left;"><?= $sv->DETAIL_NAME; ?></td>
                    <td class="txt" contenteditable="false" style="text-align: right;">
                        <?php
                        if ($sv->DETAIL_NAME == 'EBITDA') {
                            echo number_format($sv->YEAR3);
                        } else {
                            echo number_format($sv->YEAR3) . " %";
                        }
                        ?>
                    </td>
                    <td class="txt" contenteditable="false" style="text-align: right;">
                        <?php
                        if ($sv->DETAIL_NAME == 'EBITDA') {
                            echo number_format($sv->YEAR2);
                        } else {
                            echo number_format($sv->YEAR2) . " %";
                        }
                        ?>
                    </td>
                    <td class="txt" contenteditable="false" style="text-align: right;">
                        <?php
                        if ($sv->DETAIL_NAME == 'EBITDA') {
                            echo number_format($sv->YEAR1);
                        } else {
                            echo number_format($sv->YEAR1) . " %";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            endforeach;
        else :
            ?>
            <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
        <?php endif; ?>
    </table>
    <p id="export-solvability"></p>
</div>