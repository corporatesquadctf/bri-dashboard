<!-- 
* = I N D E X = *
* =================== 
* 1.1. GROUP OVERVIEW
* 1.2. KEY SHAREHOLDERS
* 1.3. STRATEGIC PLAN
* 1.4. COVERAGE MAPPING
-->

<style type="text/css">
    .errorx {
        color: #F00;
        font-size: 11px;
    }
</style>

<!-- 1.1 GROUP OVERVIEIW SECTION -->
<div class="col-md-5 col-sm-12 col-xs-12">
    <div class="x_panel" style="background: #f7f7f7">
        <div class="x_title">
            <h2><small>Group Overview</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <?php foreach ($accountplanning as $dt) : ?>
                <?php
                $checkAP = $dt['GROUP_OVERVIEWS'];
                if ($checkAP) {
                    $address = $dt['GROUP_OVERVIEWS']['ADDRESS'];
                    $city = $dt['GROUP_OVERVIEWS']['CITY_NAME'];
                    $globalRate = $dt['GROUP_OVERVIEWS']['GLOBALRATING'];
                    $globalRateDesc = $dt['GROUP_OVERVIEWS']['GLOBALRATING_DESC'];
                    $domesticRate = $dt['GROUP_OVERVIEWS']['DOMESTICRATING'];
                    $industryName = $dt['GROUP_OVERVIEWS']['INDUSTRY_NAME'];
                    $industryTrend = $dt['GROUP_OVERVIEWS']['INDUSTRYTREND'];
                    $lifeCycle = $dt['GROUP_OVERVIEWS']['LIFECYCLE'];
                } else {
                    $address = '';
                    $city = '';
                    $globalRate = '';
                    $globalRateDesc = '';
                    $domesticRate = '';
                    $industryName = '';
                    $industryTrend = '';
                    $lifeCycle = '';
                }
                ?>
                <div class="form-group">
                    <label for="custName">Customer Name</label>
                    <input type="hidden" id="custID" name="custID" value="<?php echo $dt['GROUP_ID']; ?>">
                    <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['USER_ID']; ?>">
                    <input type="text" id="custName" name="custName" class="form-control" value="<?php echo $dt['CUSTOMER_NAME']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="custCIF">CIF / Virtual CIF</label>
                    <input type="text" id="custCIF" name="custCIF" class="form-control" value="<?php echo $dt['VCIF']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="custParent">Parent Company</label>
                    <input type="text" id="custParent" name="custParent" class="form-control" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="custAddress">Address</label>
                    <textarea class="form-control" rows="7" id="custAddress" name="custAddress" style="resize: none;" disabled="true"><?php echo $address; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="custCity">City</label>
                    <input type="text" id="custCity" name="custCity" value="<?php echo $city; ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="globalRate">Global Rating</label>
                        <br />
                        <input type="text" id="globalRate" name="globalRate" value="<?php echo $globalRate; ?>" class="form-control" size="15" disabled>
                        <input type="text" class="form-control" id="globalRateDesc" name="globalRateDesc" value="<?php echo $globalRateDesc; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="domesticRate">Domestic Rating</label>
                    <input type="text" id="domesticRate" name="domesticRate" value="<?php echo $domesticRate; ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="industryName">Industry</label>
                    <input type="text" class="form-control" id="industryName" name="industryName" value="<?php echo $industryName; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="industryTrend">Industry Trend</label>
                    <input type="text" id="industryTrend" name="industryTrend" value="<?php echo $industryTrend; ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="lifeCycle">Life-cycle: </label>
                    <input type="text" id="lifeCycle" name="lifeCycle" value="<?php echo $lifeCycle; ?>" class="form-control" disabled>
                </div>
            <?php endforeach; ?>
            <div class="form-group">
            </div>
        </div>
    </div>
</div>

<!-- 1.2. KEY SHAREHOLDER SECTION -->
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Key Shareholders</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <!-- <div style="float: right; margin-bottom: 20px;">
                    <b>View Structure : </b>
                    <br>
                    <div class="col-md-6">
                            <a href="http://lipi.go.id/public/uploads/default/Struktur_2017-08-16-14-32-09_struktur_organisasi_20171608-01.jpg" title="tes">
                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                            </a>
                    </div>

                    <div class="col-md-6">
                            <a href="http://lipi.go.id/public/uploads/default/Struktur_2017-08-16-14-32-09_struktur_organisasi_20171608-01.jpg">
                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                            </a>
                    </div>
            </div>
            <br /> -->
            <!-- ===== Table Edit ========== -->
            <div id="table" class="table-editable table-account-planning" style="margin-top: 20px;">
                <table id="shTable" class="table" style="border-color: #000;">
                    <thead>
                        <tr style="background: #012D5A; color: #FFF;">
                            <th width="6%">#</th>
                            <th width="43%">Key Shareholders</th>
                            <th>Shares</th>
                            <th>Portions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="color: #000; font-size: 12px; font-weight: bold;">
                            <td colspan="2" style="text-align: center;"><b>TOTAL</b></td>
                            <td id="shareTotal" style="text-align: right;"></td>
                            <td id="percTotal" style="text-align: right;"></td>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php
                        $p = 1;
                        foreach ($accountplanning as $sh) :
                            ?>
                            <?php
                            $checkKS = count($sh['KEY_SHAREHOLDERS']);
                            if ($checkKS > 0) :
                                foreach ($sh['KEY_SHAREHOLDERS'] as $shd) :
                                    $shareholderName = $shd['SHAREHOLDER'];
                                    $shareValue = $shd['SHARE_VALUE'];
                                    $sharePercent = $shd['PORTION'] . ' %';
                                    ?>
                                    <tr class="shareRow" style="font-size: 12px;">
                                        <td><?php echo $p++; ?></td>
                                        <td class="txt" contenteditable="false">
                                            <?php echo $shareholderName; ?>
                                        </td>
                                        <td class="txt shValue" contenteditable="false" style="text-align: right;">
                                            <?php echo number_format($shareValue); ?>
                                        </td>
                                        <td class="shPercent" style="text-align: right;">
                                            <?php echo $sharePercent; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" style="text-align: center;"><small>No records available.</small></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>	
                </table>
            </div>
            <p id="export"></p>
        </div>
    </div>
</div>
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>BUSINESS PROCESS</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="col-md-6">
                <div class="form-group">
                    <!-- <label>ORGANITATION</label> -->
                    <div class="input-group">
                        <!-- <img class="img-responsive" src="https://cdn.bmkg.go.id/Web/Struktur.jpg">	 -->
                        <?php
                        if (!empty($gambarBisnis)) { // Jika data pada database tidak sama dengan empty (alias ada datanya)
                            foreach ($gambarBisnis as $data) { // Lakukan looping pada variabel gambar dari controller
                                echo "<img src='" . base_url("uploads/" . $data->PATH) . "' class='img-responsive'></td>";
                            }
                        } else { // Jika data tidak ada
                            echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                        }
                        ?>
                    </div>
                    <!-- <img id='img-upload'/> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>ORGANITATION</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ORGANITATION</label>
                    <div class="input-group">
                        <!-- <img class="img-responsive" src="https://cdn.bmkg.go.id/Web/Struktur.jpg">	 -->
                        <?php
                        if (!empty($gambar)) { // Jika data pada database tidak sama dengan empty (alias ada datanya)
                            foreach ($gambar as $data) { // Lakukan looping pada variabel gambar dari controller
                                echo "<img src='" . base_url("uploads/" . $data->PATH) . "' class='img-responsive'></td>";
                            }
                        } else { // Jika data tidak ada
                            echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                        }
                        ?>
                    </div>
                    <!-- <img id='img-upload'/> -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>STRUCTURE</label>
                    <div class="input-group">
                        <!-- <img class="img-responsive" src="https://cdn.bmkg.go.id/Web/Struktur.jpg">	 -->
                        <?php
                        if (!empty($gambarS)) { // Jika data pada database tidak sama dengan empty (alias ada datanya)
                            foreach ($gambarS as $data) { // Lakukan looping pada variabel gambar dari controller
                                echo "<a href='" . base_url("uploads/" . $data->PATH) . "'>";
                                echo "<img src='" . base_url("uploads/" . $data->PATH) . "'class='img-responsive'>";
                                echo "</a>";
                            }
                        } else { // Jika data tidak ada
                            echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                        }
                        ?>
                    </div>
                    <!-- <img id='img-upload'/> -->
                </div>
            </div>


        </div>
    </div>
</div>

<!-- 1.3. STRATEGIC PLAN  -->
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Strategic Plan</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <br />
            <div class="tab">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><b>1-3 Year Strategic Plan:</b></a></li>
                    <li><a data-toggle="tab" href="#menu2"> <b> > 3 Year Strategic Plan: </b> </a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div id="table-splan" class="table-editable table-account-planning">
                            <table class="table">
                                <tr class="splan" style="background: #012D5A; color: #FFF;">
                                    <th>#</th>
                                    <th>Planning</th>
                                </tr>
                                <?php
                                $o = 1;
                                foreach ($accountplanning as $ap) :
                                    ?>
                                    <?php
                                    $checkSPA = count($ap['STRATEGIC_PLANS_A']);

                                    if ($checkSPA > 0) :
                                        foreach ($ap['STRATEGIC_PLANS_A'] as $spn) :
                                            $planAName = $spn['PLANNING'];
                                            ?>
                                            <tr style="font-size: 12px;">
                                                <td><?php echo $o++; ?></td>
                                                <td class="txt" contenteditable="false"><?php echo $planAName; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else :
                                        ?>
                                        <tr>
                                            <td colspan="2" style="text-align: center;"><small>No records available.</small></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <div class="btn-annual">

                        </div>

                        <p id="export-splan"></p>
                    </div>

                    <div id="menu2" class="tab-pane fade">
                        <div id="table-splan3" class="table-editable table-account-planning">
                            <table class="table">
                                <tr class="splan" style="background: #012D5A; color: #FFF;">
                                    <th>#</th>
                                    <th>Planning</th>
                                </tr>
                                <?php
                                $u = 1;
                                foreach ($accountplanning as $ap) :
                                    ?>
                                    <?php
                                    $checkSPB = count($ap['STRATEGIC_PLANS_B']);
                                    if ($checkSPB > 0) :
                                        foreach ($ap['STRATEGIC_PLANS_B'] as $spnb) :
                                            $planBName = $spnb['PLANNING'];
                                            ?>
                                            <tr style="font-size: 12px;">
                                                <td><?php echo $u++ ?></td>
                                                <td class="txt" contenteditable="false"><?php echo $planBName; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else :
                                        ?>
                                        <tr>
                                            <td colspan="2" style="text-align: center;"><small>No records available.</small></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="btn-annual">

                        </div>
                        <p id="export-splan3"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 1.4. COVERAGE MAPPING SECTION -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Coverage Mapping</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div id="table-cm" class="table-editable table-account-planning">
                <table class="table">
                    <tr class="cm" style="background: #012D5A; color: #FFF;">
                        <th>#</th>
                        <th>Position at Client</th>
                        <th>Name of the Client</th>
                        <th>Contact Person</th>
                        <th>Other Information </th>
                        <th>Position at the Bank</th>
                        <th>Name of the Bank's Person</th>
                    </tr>
                    <?php
                    $t = 1;
                    foreach ($accountplanning as $cm) :
                        ?>
                        <?php
                        $checkCM = count($ap['COVERAGE_MAPPINGS']);
                        if ($checkCM > 0) :
                            foreach ($ap['COVERAGE_MAPPINGS'] as $cmp) :
                                $clientPosition = $cmp['CLIENT_POSITION'];
                                $clientName = $cmp['CLIENT_NAME'];
                                $contactPerson = $cmp['CONTACT_PERSON'];
                                $otherInfo = $cmp['OTHER_INFORMATION'];
                                $bankPosition = $cmp['BANK_POSITION'];
                                $bankPerson = $cmp['BANK_PERSON'];
                                ?>
                                <tr align="center" style="font-size: 12px;">
                                    <td><?php echo $t++; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $clientPosition; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $clientName; ?></td>
                                    <td class="txt num" contenteditable="false"><?php echo $contactPerson; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $otherInfo; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $bankPosition; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $bankPerson; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        else :
                            ?>
                            <tr>
                                <td colspan="7" style="text-align: center;"><small>No records available.</small></td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </table>
            </div>

            <div class="btn-annual"></div>
            <p id="export-cm"></p>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // SHAREHOLDER TOTAL & PERCENTAGE
        var rowCount = $('#shTable > tbody > tr').length - 1;
        var shareTotal = [];
        var totalPerc = [];

        $('#shTable tr').each(function () {
            $('.shValue', this).each(function (index, val) {
                if (!shareTotal[index])
                    shareTotal[index] = 0;
                removeComma = $(val).text().replace(/,/g, '');
                shareTotal[index] += parseInt(removeComma);
                intoDecimal = parseFloat(shareTotal).toFixed(0);

                $('#shareTotal').text(intoDecimal.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            });
        });

        $('.shareRow').each(function () {
            total = $('#shareTotal').text().replace(/,/g, '');
            eachRow = $('.shValue', this).text().replace(/,/g, '');

            $('.shPercent', this).text(parseFloat((eachRow / total) * 100).toFixed(2) + ' %');
        });

        $('#shTable tr').each(function () {
            $('.shPercent', this).each(function (index, val) {
                if (!totalPerc[index])
                    totalPerc[index] = 0;
                totalPerc[index] += parseFloat($(val).text());

                $('#percTotal').text(parseFloat(totalPerc).toFixed(2) + ' %');
            });
        });
    });
</script>
=======
<!-- 
* = I N D E X = *
* =================== 
* 1.1. GROUP OVERVIEW
* 1.2. KEY SHAREHOLDERS
* 1.3. STRATEGIC PLAN
* 1.4. COVERAGE MAPPING
-->

<style type="text/css">
    .errorx {
        color: #F00;
        font-size: 11px;
    }
</style>

<!-- 1.1 GROUP OVERVIEIW SECTION -->
<div class="col-md-5 col-sm-12 col-xs-12">
    <div class="x_panel" style="background: #f7f7f7">
        <div class="x_title">
            <h2><small>Group Overview</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <?php foreach ($accountplanning as $dt) : ?>
                <?php
                $checkAP = $dt['GROUP_OVERVIEWS'];
                if ($checkAP) {
                    $address = $dt['GROUP_OVERVIEWS']['ADDRESS'];
                    $city = $dt['GROUP_OVERVIEWS']['CITY_NAME'];
                    $globalRate = $dt['GROUP_OVERVIEWS']['GLOBALRATING'];
                    $globalRateDesc = $dt['GROUP_OVERVIEWS']['GLOBALRATING_DESC'];
                    $domesticRate = $dt['GROUP_OVERVIEWS']['DOMESTICRATING'];
                    $industryName = $dt['GROUP_OVERVIEWS']['INDUSTRY_NAME'];
                    $industryTrend = $dt['GROUP_OVERVIEWS']['INDUSTRYTREND'];
                    $lifeCycle = $dt['GROUP_OVERVIEWS']['LIFECYCLE'];
                } else {
                    $address = '';
                    $city = '';
                    $globalRate = '';
                    $globalRateDesc = '';
                    $domesticRate = '';
                    $industryName = '';
                    $industryTrend = '';
                    $lifeCycle = '';
                }
                ?>
                <div class="form-group">
                    <label for="custName">Customer Name</label>
                    <input type="hidden" id="custID" name="custID" value="<?php echo $dt['GROUP_ID']; ?>">
                    <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['USER_ID']; ?>">
                    <input type="text" id="custName" name="custName" class="form-control" value="<?php echo $dt['CUSTOMER_NAME']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="custCIF">CIF / Virtual CIF</label>
                    <input type="text" id="custCIF" name="custCIF" class="form-control" value="<?php echo $dt['VCIF']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="custParent">Parent Company</label>
                    <input type="text" id="custParent" name="custParent" class="form-control" value="" disabled>
                </div>
                <div class="form-group">
                    <label for="custAddress">Address</label>
                    <textarea class="form-control" rows="7" id="custAddress" name="custAddress" style="resize: none;" disabled="true"><?php echo $address; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="custCity">City</label>
                    <input type="text" id="custCity" name="custCity" value="<?php echo $city; ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="globalRate">Global Rating</label>
                        <br />
                        <input type="text" id="globalRate" name="globalRate" value="<?php echo $globalRate; ?>" class="form-control" size="15" disabled>
                        <input type="text" class="form-control" id="globalRateDesc" name="globalRateDesc" value="<?php echo $globalRateDesc; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="domesticRate">Domestic Rating</label>
                    <input type="text" id="domesticRate" name="domesticRate" value="<?php echo $domesticRate; ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="industryName">Industry</label>
                    <input type="text" class="form-control" id="industryName" name="industryName" value="<?php echo $industryName; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="industryTrend">Industry Trend</label>
                    <input type="text" id="industryTrend" name="industryTrend" value="<?php echo $industryTrend; ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="lifeCycle">Life-cycle: </label>
                    <input type="text" id="lifeCycle" name="lifeCycle" value="<?php echo $lifeCycle; ?>" class="form-control" disabled>
                </div>
            <?php endforeach; ?>
            <div class="form-group">
            </div>
        </div>
    </div>
</div>

<!-- 1.2. KEY SHAREHOLDER SECTION -->
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Key Shareholders</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <!-- <div style="float: right; margin-bottom: 20px;">
                    <b>View Structure : </b>
                    <br>
                    <div class="col-md-6">
                            <a href="http://lipi.go.id/public/uploads/default/Struktur_2017-08-16-14-32-09_struktur_organisasi_20171608-01.jpg" title="tes">
                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                            </a>
                    </div>

                    <div class="col-md-6">
                            <a href="http://lipi.go.id/public/uploads/default/Struktur_2017-08-16-14-32-09_struktur_organisasi_20171608-01.jpg">
                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                            </a>
                    </div>
            </div>
            <br /> -->
            <!-- ===== Table Edit ========== -->
            <div id="table" class="table-editable table-account-planning" style="margin-top: 20px;">
                <table id="shTable" class="table" style="border-color: #000;">
                    <thead>
                        <tr style="background: #012D5A; color: #FFF;">
                            <th width="6%">#</th>
                            <th width="43%">Key Shareholders</th>
                            <th>Shares</th>
                            <th>Portions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="color: #000; font-size: 12px; font-weight: bold;">
                            <td colspan="2" style="text-align: center;"><b>TOTAL</b></td>
                            <td id="shareTotal" style="text-align: right;"></td>
                            <td id="percTotal" style="text-align: right;"></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $p = 1; ?>
                        <?php foreach ($accountplanning as $sh) : ?>
                            <?php $checkKS = count($sh['KEY_SHAREHOLDERS']); ?>
                            <?php if ($checkKS > 0) : ?>
                                <?php foreach ($sh['KEY_SHAREHOLDERS'] as $shd) : ?>
                                    <?php
                                    $shareholderName = $shd['SHAREHOLDER'];
                                    $shareValue = $shd['SHARE_VALUE'];
                                    $sharePercent = $shd['PORTION'] . ' %';
                                    ?>
                                    <tr class="shareRow" style="font-size: 12px;">
                                        <td><?= $p++ ?></td>
                                        <td class="txt" contenteditable="false">
                                            <?= $shareholderName ?>
                                        </td>
                                        <td class="txt shValue" contenteditable="false" style="text-align: right;">
                                            <?= number_format($shareValue) ?>
                                        </td>
                                        <td class="shPercent" style="text-align: right;">
                                            <?php echo $sharePercent; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" style="text-align: center;"><small>No records available.</small></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>	
                </table>
            </div>
            <p id="export"></p>
        </div>
    </div>
</div>

<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Bussiness Process</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Organitation</label>
                    <div class="input-group">
                        <?php if (!empty($gambar)) : ?> 
                            <?php foreach ($gambar as $data) : ?> 
                                <img src="<?= base_url("uploads/" . $data->PATH) ?>" class='img-responsive'></td>;
                            <?php endforeach; ?>
                        <?php else: ?> 
                            <tr><td colspan='5'>Data tidak ada</td></tr>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- 1.3. STRATEGIC PLAN  -->
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Strategic Plan</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <br />
            <div class="tab">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><b>1-3 Year Strategic Plan:</b></a></li>
                    <li><a data-toggle="tab" href="#menu2"> <b> > 3 Year Strategic Plan: </b> </a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div id="table-splan" class="table-editable table-account-planning">
                            <table class="table">
                                <tr class="splan" style="background: #012D5A; color: #FFF;">
                                    <th>#</th>
                                    <th>Planning</th>
                                </tr>
                                <?php $o = 1; ?>
                                <?php foreach ($accountplanning as $ap) : ?>
                                    <?php $checkSPA = count($ap['STRATEGIC_PLANS_A']); ?>
                                    <?php if ($checkSPA > 0) : ?>`
                                        <?php foreach ($ap['STRATEGIC_PLANS_A'] as $spn) : ?>
                                            <?php $planAName = $spn['PLANNING']; ?>
                                            <tr style="font-size: 12px;">
                                                <td><?= $o++ ?></td>
                                                <td class="txt" contenteditable="false"><?php echo $planAName; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="2" style="text-align: center;"><small>No records available.</small></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <div class="btn-annual"></div>
                        <p id="export-splan"></p>
                    </div>

                    <div id="menu2" class="tab-pane fade">
                        <div id="table-splan3" class="table-editable table-account-planning">
                            <table class="table">
                                <tr class="splan" style="background: #012D5A; color: #FFF;">
                                    <th>#</th>
                                    <th>Planning</th>
                                </tr>
                                <?php
                                $u = 1;
                                foreach ($accountplanning as $ap) :
                                    ?>
                                    <?php
                                    $checkSPB = count($ap['STRATEGIC_PLANS_B']);
                                    if ($checkSPB > 0) :
                                        foreach ($ap['STRATEGIC_PLANS_B'] as $spnb) :
                                            $planBName = $spnb['PLANNING'];
                                            ?>
                                            <tr style="font-size: 12px;">
                                                <td><?php echo $u++; ?></td>
                                                <td class="txt" contenteditable="false"><?php echo $planBName; ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else :
                                        ?>
                                        <tr>
                                            <td colspan="2" style="text-align: center;"><small>No records available.</small></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="btn-annual">

                        </div>
                        <p id="export-splan3"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 1.4. COVERAGE MAPPING SECTION -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><small>Coverage Mapping</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div id="table-cm" class="table-editable table-account-planning">
                <table class="table">
                    <tr class="cm" style="background: #012D5A; color: #FFF;">
                        <th>#</th>
                        <th>Position at Client</th>
                        <th>Name of the Client</th>
                        <th>Contact Person</th>
                        <th>Other Information </th>
                        <th>Position at the Bank</th>
                        <th>Name of the Bank's Person</th>
                    </tr>
                    <?php
                    $t = 1;
                    foreach ($accountplanning as $cm) :
                        ?>
                        <?php
                        $checkCM = count($ap['COVERAGE_MAPPINGS']);
                        if ($checkCM > 0) :
                            foreach ($ap['COVERAGE_MAPPINGS'] as $cmp) :
                                $clientPosition = $cmp['CLIENT_POSITION'];
                                $clientName = $cmp['CLIENT_NAME'];
                                $contactPerson = $cmp['CONTACT_PERSON'];
                                $otherInfo = $cmp['OTHER_INFORMATION'];
                                $bankPosition = $cmp['BANK_POSITION'];
                                $bankPerson = $cmp['BANK_PERSON'];
                                ?>
                                <tr align="center" style="font-size: 12px;">
                                    <td><?php echo $t++; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $clientPosition; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $clientName; ?></td>
                                    <td class="txt num" contenteditable="false"><?php echo $contactPerson; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $otherInfo; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $bankPosition; ?></td>
                                    <td class="txt" contenteditable="false"><?php echo $bankPerson; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        else :
                            ?>
                            <tr>
                                <td colspan="7" style="text-align: center;"><small>No records available.</small></td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </table>
            </div>

            <div class="btn-annual"></div>
            <p id="export-cm"></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        // SHAREHOLDER TOTAL & PERCENTAGE
        var rowCount = $('#shTable > tbody > tr').length - 1;
        var shareTotal = [];
        var totalPerc = [];

        $('#shTable tr').each(function () {
            $('.shValue', this).each(function (index, val) {
                if (!shareTotal[index])
                    shareTotal[index] = 0;
                removeComma = $(val).text().replace(/,/g, '');
                shareTotal[index] += parseInt(removeComma);
                intoDecimal = parseFloat(shareTotal).toFixed(0);

                $('#shareTotal').text(intoDecimal.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            });
        });

        $('.shareRow').each(function () {
            total = $('#shareTotal').text().replace(/,/g, '');
            eachRow = $('.shValue', this).text().replace(/,/g, '');

            $('.shPercent', this).text(parseFloat((eachRow / total) * 100).toFixed(2) + ' %');
        });

        $('#shTable tr').each(function () {
            $('.shPercent', this).each(function (index, val) {
                if (!totalPerc[index])
                    totalPerc[index] = 0;
                totalPerc[index] += parseFloat($(val).text());

                $('#percTotal').text(parseFloat(totalPerc).toFixed(2) + ' %');
            });
        });
    });
</script>
