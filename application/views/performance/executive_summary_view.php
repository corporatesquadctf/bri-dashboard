<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/jquery-ui/jquery-ui.css" />
<script type="text/javascript" src="<?= base_url(); ?>assets/jquery-ui/jquery-ui.js"></script>
<style type="text/css">
    .td-error {
        border-color: red !important;
        border-width: 2px !important;
    }

    .rata_kanan {
        text-align: right;
    }

    .daterangepicker .calendar-table th,
    .daterangepicker .calendar-table td {
        border-radius: 0px !important;
    }

    .ui-datepicker-calendar {
        display: none;
    }

    .ui-widget-header {
        background: #337ab7;
        color: #333333;
        font-weight: bold;
    }

    div.dataTables_wrapper div.dataTables_info {
        display: none;
    }

    .topsearch .form-control {
        border-radius: 0px !important;
    }
</style>

<script>
    var sumAllTables = 9;
    var dataLoaded = 0;
</script>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Executive Summary<small></small></h3>
            </div>

            <div class="container">
                <div class="x_panel col-xs-12">
                    <a class="btn btn-primary pull-right" data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Filter Report
                    </a>
                    <div class="collapse" id="filter">
                        <div class="container">
                            <div class="col-md-3">
                                <label for="startDate">From :</label>
                                <input name="startDate" id="startDate" class="date-picker form-control" />
                            </div>
                            <div class="col-md-3">
                                <label for="endDate">To :</label>
                                <input name="endDate" id="endDate" class="date-picker form-control" />
                            </div>
                            <div class="col-md-4 col-sm-4 form-group top_search">
                                <div class="input-group" style="padding-top: 25px;">
                                    <select style="border-radius: 0px; border: 1px #dcdcdc solid;" id="division" class="form-control" "<?= $user_is_restricted ? 'disabled' : '' ?>">
                                        <?php foreach ($divisions as $division) : ?>
                                            <option value="<?= $division->division_id ?>">
                                                <?= $division->division_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 form group">
                                <label id="error_filter" class="hide" style="color:red"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- ======================== CHART ROW 1 ======================== -->
        <div class="row">
            <!-- =================== 1. PLAFOND =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Plafond<small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="plafond"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 1. PLAFOND =================== -->
            <!-- =================== 2. LOAN OUTSTANDING =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Loan Outstanding<small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="loanOutstanding"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 2. LOAN OUTSTANDING =================== -->
        </div>
        <!-- ======================== CHART ROW 1 ======================== -->
        <div class="clearfix"></div>
        <!-- ======================== CHART ROW 2 ======================== -->
        <div class="row">
            <!-- =================== 3. CUSTOMER PROFITABILITY =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Customer Profitability <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="custProfit"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 3. CUSTOMER PROFITABILITY =================== -->

            <!-- =================== 4. LOAN SECTOR =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Loan Sector <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="sectorLoan"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 4. LOAN SECTOR =================== -->
        </div>
        <!-- ======================== CHART ROW 2 ======================== -->
        <div class="clearfix"></div>
        <!-- ======================== CHART ROW 3 ======================== -->
        <div class="row">
            <!-- =================== 5. INTEREST INCOME =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Interest Income <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="interestIncome"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 5. INTEREST INCOME =================== -->

            <!-- =================== 6. FEE INCOME =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fee Income <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="feeIncome"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 6. FEE INCOME =================== -->
        </div>
        <!-- ======================== CHART ROW 3 ======================== -->
        <div class="clearfix"></div>
        <!-- ======================== CHART ROW 4 ======================== -->
        <div class="row">
            <!-- =================== 7. CLASSIFIED LOAN =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Classified Loan<small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="classified-loan"></canvas>
                    </div>
                </div>
            </div>
            <!-- =================== 7. CLASSIFIED LOAN =================== -->

            <!-- =================== 8. DPK =================== -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>DPK <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="dpk"></canvas>
                    </div>
                </div>
                <!-- =================== 8. DPK =================== -->
            </div>
            <!-- ======================== CHART ROW 4 ======================== -->
            <div class="clearfix"></div>
            <!-- ======================== CHART ROW 5 ======================== -->
            <div class="row">
                <!-- =================== 9. GIRO =================== -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Giro<small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="giro"></canvas>
                        </div>
                    </div>
                </div>
                <!-- =================== 9. GIRO =================== -->

                <!-- =================== 10. DEPOSITO =================== -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Deposito <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="deposito"></canvas>
                        </div>
                    </div>
                </div>
                <!-- =================== 10. DEPOSITO =================== -->
            </div>
            <!-- ======================== CHART ROW 5 ======================== -->
            <div class="clearfix"></div>
            <!-- ======================== CHART ROW 6 ======================== -->
            <div class="row">
                <!-- =================== 11. LOAN YIELD =================== -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Loan Yield <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="loany"></canvas>
                        </div>
                    </div>
                </div>
                <!-- =================== 11. LOAN YIELD =================== -->
            </div>
            <!-- ======================== CHART ROW 6 ======================== -->
        </div>
    </div>
</div>

<script src="<?= base_url('assets/chart.js/dist/Chart.min.js'); ?>"></script>

<script>
    var request = {};
    var months = [
        ["JAN", "2017"],
        ["FEB", "2017"],
        ["MAR", "2017"],
        ["APR", "2017"],
        ["MAY", "2017"],
        ["JUN", "2017"],
        ["JUL", "2017"],
        ["AUG", "2017"],
        ["SEP", "2017"],
        ["OCT", "2017"],
        ["NOV", "2017"],
        ["DEC", "2017"],
        ["JAN", "2018"]
    ];
    var sctr = ["Pertambangan", "Property", "Textile", "Transportasi", "Energi", "Industry Kertas", "Semen", "Jasa", "Kontraktor"];
    var kolekta = ["Lancar", "Dalam Perhatian Khusus", "Kurang Lancar", "Diragukan", "Macet"];
    var dx = function () {
        return Math.floor(1000 + Math.random() * 9000);
    };
    var successAll = function () {
        if (dataLoaded >= sumAllTables) {
            new PNotify({
                title: 'Success!',
                text: "Data Loaded",
                type: 'success',
                styling: 'bootstrap3',
                delay: 500
            });
            dataLoaded = 0;
        }
    };

    Chart.defaults.global.tooltipTemplate = "<%if (label){%><%=label%>: <%}%><%=value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ", ")%>";
    // ============================= 1. PLAFOND =============================
    var plaf = document.getElementById('plafond').getContext('2d');
    var plafondChart = new Chart(plaf, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Initial Ceiling",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(220, 20, 60, 0.7)'
                }]
        },
        options: {
            scaleLabel: {
                function(label) {
                    return label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

            },
            scales: {
                yAxes: [{
                        ticks: {
                            baginAtZero: true,
                            fontSize: 10,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadPlafon = function () {
        var url = '<?= base_url("/rest/executive_summary/get_plafon") ?>';
        var success = function (response) {
            plafondChart.data.datasets[0].data = [];
            plafondChart.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                plafondChart.data.labels.push(temp);
                plafondChart.data.datasets[0].data.push((row.plafon / 1000000000).toFixed(2));
            });
            plafondChart.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };

    // ============================= 2. LOAN OUTSTANDING =============================
    var loan = document.getElementById('loanOutstanding').getContext('2d');
    var louts = new Chart(loan, {
        type: 'line',
        theme: 'light',
        data: {
            labels: [],
            datasets: [{
                    label: "Outstanding",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(0, 128, 128, 0.7)'
                }, {
                    label: "Ratas Outstanding",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(107, 142, 35, 0.7)'
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            baginAtZero: true,
                            fontSize: 10,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadLoanOut = function () {
        var url = '<?= base_url("/rest/executive_summary/get_loan_outstanding") ?>';
        var success = function (response) {
            louts.data.datasets[0].data = [];
            louts.data.datasets[1].data = [];
            louts.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                louts.data.labels.push(temp);
                louts.data.datasets[0].data.push((row.outstanding / 1000000000).toFixed(2));
                louts.data.datasets[1].data.push((row.ratas / 1000000000).toFixed(2));
            });
            louts.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ============================= 3. CUSTOMER PROFITABILITY =============================
    var cprof = document.getElementById('custProfit').getContext('2d');
    var custp = new Chart(cprof, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "CPA",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(102, 205, 170, 0.7)'
                }]
        },
        options: {
            responsive: true,
            elements: {
                line: {
                    tension: 0.0001
                }
            },
            scales: {
                yAxes: [{
                        ticks: {
                            baginAtZero: true,
                            fontSize: 10,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }
        }
    });
    var loadCustProfit = function () {
        var url = '<?= base_url("/rest/executive_summary/get_customer_profit") ?>';
        var success = function (response) {
            custp.data.datasets[0].data = [];
            custp.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                custp.data.labels.push(temp);
                custp.data.datasets[0].data.push(row.setelah_modal / 1000000000);
            });
            custp.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ============================= 4. LOAN SECTOR =============================
    var randomColorFactor = function () {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function (opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.7') + ')';
    };
    var loansectorlabel = [
        "KI",
        "KMK",
    ];
    var loansc = document.getElementById('sectorLoan').getContext('2d');
    var lnsc = new Chart(loansc, {
        type: 'pie',
        data: {
            labels: loansectorlabel,
            datasets: [{
                    data: [],
                    rek: [],
                    borderColor: '#F0FFFF',
                    borderWidth: 1,
                    backgroundColor: [
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor()
                    ]
                }]
        },
        options: {
            legend: {
                position: 'right'
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var kembali = [];
                        var label = data.labels[tooltipItem.index].trim() || '';
                        if (label) {
                            label += ': ';
                        }
                        var hasil = parseFloat(data.datasets[0].data[tooltipItem.index]);
                        label += hasil.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        kembali.push(label);
                        var rek = 'Total Rekening: ';
                        var temp = parseFloat(data.datasets[0].rek[tooltipItem.index]);
                        rek += temp;
                        kembali.push(rek);
                        var total = 0
                        var data2 = data.datasets[0].data
                        data2.forEach(function (row) {
                            if (row) {
                                total += parseFloat(row);
                            }
                        })
                        var percent = "Persentase: ";
                        temp = (parseFloat(hasil) / total) * 100;
                        percent += temp.toFixed(2) + '%';
                        kembali.push(percent);
                        return kembali;
                    }
                }
            }
        }
    });
    var loadLoanSector = function () {
        var division = $('#division').val();
        var url = '<?= base_url("rest/executive_summary/get_loan_sector") ?>';
        var success = function (response) {
            lnsc.data.datasets[0].data = [];
            response.forEach(function (row) {
                lnsc.data.datasets[0].data.push(row.baki_debet);
                lnsc.data.datasets[0].rek.push(row.rek);
            });
            lnsc.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ============================= 5. INTEREST INCOME =============================
    var intin = document.getElementById('interestIncome').getContext('2d');
    var income = new Chart(intin, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Interest Income",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 140, 0, 0.7)'
                }, {
                    label: "Accumulated Interest Income",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 160, 122, 0.7)'
                }]
        },
        options: {
            snapGaps: false,
            elements: {
                line: {
                    tension: 0.000001
                }
            },
            scales: {
                yAxes: [{
                        ticks: {
                            fontSize: 10,
                            beginAtZero: true,
                            maxRotation: 0,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadInterestIncome = function () {
        var url = '<?= base_url("/rest/executive_summary/get_interest_income") ?>';
        var success = function (response) {
            income.data.datasets[0].data = [];
            income.data.datasets[1].data = [];
            income.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                income.data.labels.push(temp);
                income.data.datasets[0].data.push(row.bunga / 1000000000);
                income.data.datasets[1].data.push(row.bunga_total / 1000000000);
            });
            income.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ============================= 6. FEE INCOME =============================
    var fein = document.getElementById('feeIncome').getContext('2d');
    var feeinc = new Chart(fein, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Fee Income",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 255, 0, 0.7)'
                }]
        },
        options: {
            snapGaps: false,
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            maxRotation: 0,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadFeeIncome = function () {
        var url = '<?= base_url("/rest/executive_summary/get_fee_income") ?>';
        var success = function (response) {
            feeinc.data.datasets[0].data = [];
            feeinc.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                feeinc.data.labels.push(temp);
                feeinc.data.datasets[0].data.push(row.fee / 1000000000);
            });
            feeinc.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ============================= 7. CLASSIFIED LOAN =============================

    var classifiedLoanLabels = [
        "Lancar",
        "Dalam Perhatian Khusus",
        "Kurang Lancar",
        "Diragukan",
        "Macet"
    ];
    var classifiedLoanElement = document.getElementById('classified-loan').getContext('2d');
    var classifiedLoanChart = new Chart(classifiedLoanElement, {
        type: 'pie',
        data: {
            labels: classifiedLoanLabels,
            datasets: [{
                    data: [],
                    rek: [],
                    backgroundColor: [
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor(),
                        randomColor()
                    ]
                }]
        },
        options: {
            legend: {
                position: 'right'
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var kembali = [];
                        var label = data.labels[tooltipItem.index].trim() || '';
                        if (label) {
                            label += ': ';
                        }
                        var hasil = parseFloat(data.datasets[0].data[tooltipItem.index]);
                        label += hasil.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        kembali.push(label);
                        var rek = 'Total Rekening: ';
                        var temp = parseFloat(data.datasets[0].rek[tooltipItem.index]);
                        rek += temp;
                        kembali.push(rek);
                        var total = 0
                        var data2 = data.datasets[0].data
                        data2.forEach(function (row) {
                            if (row) {
                                total += parseFloat(row);
                            }
                        })
                        var percent = "Persentase: ";
                        temp = (parseFloat(hasil) / total) * 100;
                        percent += temp.toFixed(2) + '%';
                        kembali.push(percent);
                        return kembali;
                    }
                }
            }
        }
    });
    var loadClassifiedLoan = function () {
        var division = $('#division').val();
        var url = '<?= base_url("/rest/executive_summary/get_classified_loan") ?>';
        var success = function (response) {
            classifiedLoanChart.data.datasets[0].data = [];
            classifiedLoanChart.data.datasets[0].rek = [];
            classifiedLoanChart.data.labels = [];
            response.forEach(function (row) {
                classifiedLoanChart.data.labels.push(row.kolektibilitas);
                classifiedLoanChart.data.datasets[0].data.push(row.baki_debet);
                classifiedLoanChart.data.datasets[0].rek.push(row.total_rekening);
            });
            classifiedLoanChart.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ============================= 8. DPK =============================
    var dpkc = document.getElementById('dpk').getContext('2d');
    var dpkch = new Chart(dpkc, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Saldo",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 255, 0, 0.7)'
                }, {
                    label: "Avg. Saldo Simpanan",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(34, 139, 34, 0.7)'
                }]
        },
        options: {
            snapGaps: false,
            scales: {
                yAxes: [{
                        ticks: {
                            fontSize: 10,
                            beginAtZero: true,
                            maxRotation: 0,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadDPK = function () {
        var url = '<?= base_url("/rest/executive_summary/get_dpk") ?>';
        var success = function (response) {
            dpkch.data.datasets[0].data = [];
            dpkch.data.datasets[1].data = [];
            dpkch.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                dpkch.data.labels.push(temp);
                dpkch.data.datasets[0].data.push(row.saldo / 1000000000);
                dpkch.data.datasets[1].data.push(row.avrgsaldo / 1000000000);
            });
            dpkch.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ================================================================================

    // ============================= 9. GIRO =============================
    var giroc = document.getElementById('giro').getContext('2d');
    var giroch = new Chart(giroc, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Saldo",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 255, 0, 0.7)'
                }, {
                    label: "Avg. Saldo Simpanan",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(34, 139, 34, 0.7)'
                }]
        },
        options: {
            snapGaps: false,
            scales: {
                yAxes: [{
                        ticks: {
                            fontSize: 10,
                            beginAtZero: true,
                            maxRotation: 0,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadGiro = function () {
        var url = '<?= base_url("/rest/executive_summary/get_giro") ?>';
        var success = function (response) {
            giroch.data.datasets[0].data = [];
            giroch.data.datasets[1].data = [];
            giroch.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                giroch.data.labels.push(temp);
                giroch.data.datasets[0].data.push(row.saldo / 1000000000);
                giroch.data.datasets[1].data.push(row.avrgsaldo / 1000000000);
            });
            giroch.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ================================================================================

    // ============================= 10. deposito =============================
    var depositoc = document.getElementById('deposito').getContext('2d');
    var depositoch = new Chart(depositoc, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Saldo",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 255, 0, 0.7)'
                }]
        },
        options: {
            snapGaps: false,
            scales: {
                yAxes: [{
                        ticks: {
                            fontSize: 10,
                            beginAtZero: true,
                            maxRotation: 0,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Billions',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadDeposito = function () {
        var url = '<?= base_url("rest/executive_summary/get_deposito") ?>';
        var success = function (response) {
            depositoch.data.datasets[0].data = [];
            depositoch.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                depositoch.data.labels.push(temp);
                depositoch.data.datasets[0].data.push(row.saldo / 1000000000);
            });
            depositoch.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ================================================================================

    // ============================= 11. loany =============================
    var loanyc = document.getElementById('loany').getContext('2d');
    var loanych = new Chart(loanyc, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: "Loan Yield",
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 255, 0, 0.7)'
                }]
        },
        options: {
            snapGaps: false,
            scales: {
                yAxes: [{
                        ticks: {
                            fontSize: 10,
                            beginAtZero: true,
                            maxRotation: 0,
                            userCallback: function (value, index, values) {
                                if (parseInt(value) >= 1000 || -1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }],
                xAxes: [{
                        ticks: {
                            fontSize: 10,
                            maintainAspectRatio: false,
                        }
                    }]
            },
            title: {
                display: true,
                text: '* in Precentage',
                fontStyle: "bold",
                fontSize: 11,
                verticalAlign: "top",
                horizontalAlign: "right",
                position: "left",
                fontColor: "red",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
    var loadLoany = function () {
        var url = '<?= base_url("/rest/executive_summary/get_loany") ?>';
        var success = function (response) {
            loanych.data.datasets[0].data = [];
            loanych.data.labels = [];
            response.forEach(function (row) {
                var temp = [];
                temp.push(row.Month)
                temp.push(row.Year)
                loanych.data.labels.push(temp);
                loanych.data.datasets[0].data.push(row.saldo);
            });
            loanych.update();
            dataLoaded += 1;
            successAll();
        };
        $.post(url, request, success);
    };
    // ================================================================================

    $.ajax({
        method: "GET",
        url: "<?= base_url('performance/exec_summary') ?>",
        dataType: "json"
    });
    var monthDiff = (d1, d2) => {
        var months;
        months = (d2.getFullYear() - d1.getFullYear()) * 12;
        months -= d1.getMonth() + 1;
        months += d2.getMonth();
        return months <= 0 ? 0 : months;
    };

    var showError = function (errorMessage) {
        $("#error_filter").html(errorMessage);
        $("#error_filter").removeClass("hide");
    }

    var loadAll = function () {
        $(".date-picker").removeClass('td-error');
        $("#error_filter").addClass("hide");

        var division = $("#division").val();

        var dateAwalString = $("#startDate").val();
        if (dateAwalString == "") {
            var d = new Date();
            d.setMonth(d.getMonth() - 12);
            dateAwalString = d.getFullYear() + '-' + d.getMonth();
        }
        var dateAwal = new Date(dateAwalString);

        var dateAkhirString = $("#endDate").val();
        if (dateAkhirString == "") {
            var d = new Date();
            d.setMonth(d.getMonth() + 1);
            dateAkhirString = d.getFullYear() + '-' + d.getMonth();
        }
        var dateAkhir = new Date(dateAkhirString);

        var diff = dateAkhir - dateAwal;

        if (diff < 0) {
            $(".date-picker").addClass('td-error');
            $(".date-picker").addClass('td-error');
            showError("End date has to be higher than start date");
            return;
        }

        if (monthDiff(dateAwal, dateAkhir) > 13) {
            $(".date-picker").addClass('td-error');
            $(".date-picker").addClass('td-error');
            showError("Can't show more than 13 months");
            return;

        }

        request = {};

        if (division && division != "") {
            request = {
                start: dateAwal.getFullYear() + '-' + (1+(+dateAwal.getMonth())),
                end: dateAkhir.getFullYear() + '-' + (1+(+dateAkhir.getMonth())),
                division: division
            };
        }

        request = JSON.stringify(request);

        dataLoaded = 0;

        loadPlafon();
        loadLoanOut();
        loadCustProfit();
        loadLoanSector();
        loadInterestIncome();
        loadFeeIncome();
        loadClassifiedLoan();
        loadDPK();
        loadGiro();
        loadDeposito();
        loadLoany();
    };

    $(document).ready(function () {
        $('.date-picker').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd MM yy',
            maxDate: 'M',
            onClose: function (dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                loadAll();
            }
        })
        $('#startDate').datepicker("setDate", "-13m");
        $('#endDate').datepicker("setDate", new Date());
        $('select#division').on('change', function () {
            loadAll();
        });
        loadAll();
    });
</script>