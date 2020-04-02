<div class="right_col" role="main">
    <div class="container">
        <div class="row">
        <!--
        <div style="float:left">
        <button onclick="history.go(-1);">
            <span class="fa fa-arrow-circle-left"> Back To Previous Page</span>
        </button>
        </div>
-->
        <div style="float:right">
        
        <select id="selectMonth" style="width:auto;float:left" class="form-control selectWidth" value="<?= $month ?>">
            <option value="0" <?= $month == "0" ? "selected" : "" ?>>Last Month</option>
            <option value="1" <?= $month == "1" ? "selected" : "" ?>>Januari</option>
            <option value="2" <?= $month == "2" ? "selected" : "" ?>>Februari</option>
            <option value="3" <?= $month == "3" ? "selected" : "" ?>>Maret</option>
            <option value="4" <?= $month == "4" ? "selected" : "" ?>>April</option>
            <option value="5" <?= $month == "5" ? "selected" : "" ?>>Mei</option>
            <option value="6" <?= $month == "6" ? "selected" : "" ?>>Juni</option>
            <option value="7" <?= $month == "7" ? "selected" : "" ?>>Juli</option>
            <option value="8" <?= $month == "8" ? "selected" : "" ?>>Agustus</option>
            <option value="9" <?= $month == "9" ? "selected" : "" ?>>September</option>
            <option value="10"<?= $month == "10" ? "selected" : "" ?>>Oktober</option>
            <option value="11"<?= $month == "11" ? "selected" : "" ?>>November</option>
            <option value="12"<?= $month == "12" ? "selected" : "" ?>>Desember</option>
        </select>
        <select id="selectYear" style="width:auto;float:left" class="form-control selectWidth" value="">
            <option value="0">Last Year</option>
            <option value="2017"<?= $year == "2017" ? "selected" : "" ?>>2017</option>
            <option value="2018"<?= $year == "2018" ? "selected" : "" ?>>2018</option>
        </select>
        <button id="changeMonth">GO</button>
        </div>
        </div>
        <div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#cpa-existing">CPA Existing</a></li>
            <li><a data-toggle="tab" href="#cpa-projection">CPA Projection</a></li>
            <li><a data-toggle="tab" href="#cpa-delta">CPA Delta</a></li>
        </ul>
        </div>
        <div class="tab-content">
            <div id="cpa-existing" class="tab-pane fade  in active">
                <?php $this->load->view('performance/company/cpa/cpa_existing'); ?>
            </div>
            <div id="cpa-projection" class="tab-pane fade">
                <?php $this->load->view('performance/company/cpa/cpa_projection'); ?>
            </div>
            <div id="cpa-delta" class="tab-pane fade">
                <?php $this->load->view('performance/company/cpa/cpa_delta'); ?>
            </div>
        </div>
        <!--
        <button onclick="history.go(-1);">
            <span class="fa fa-arrow-circle-left"> Back To Previous Page</span>
        </button>
-->
    </div>
</div>

<script type="text/javascript">
    document.getElementById("changeMonth").onclick = function () {
        var month = $("#selectMonth").val();
        var year = $("#selectYear").val();
        location.href = "<?= base_url('perform/summary_cpa/view/' . $vcif . '/') ?>" + month + "/" + year;
    };
</script>