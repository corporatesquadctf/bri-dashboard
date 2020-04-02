<style type="text/css">
    .img_logo {
      padding-right:2px; 
      width:100%; 
      height:100%; 
      vertical-align: bottom;
    }
    .detail_title {
      font-weight: 600;
      font-size: 16px;
      line-height: 22px;
      letter-spacing: 0.5px;
      color: #252525;
    }
    .detail_property_title {
      font-weight: 600;
      font-size: 12px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.25px;
      color: #218FD8;
    }
    .detail_cont_header {
      background: #FFFFFF;
      border-radius: 4px;
      min-height: 120px;
      padding-top: 20px
    }
    .detail_property_text {
      font-weight: normal;
      font-size: 12px;
      line-height: 20px;
      letter-spacing: 0.15px;
      color: #707070;
    }
    .detail_section_title {
      font-weight: 600;
      font-size: 14px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.25px;
      color: #707070;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus {
      background: #218FD8;
      border-radius: 4px;
      color: #FFFFFF;
      border: 1px solid #ddd;
    }
    .nav-tabs>li>a {
      background: #FFFFFF;
      border-radius: 4px;
      color: #65B6F0;
      border: 1px solid #ddd;
    }
    .detail_section_header_con {
      padding-left: 20px;
      border-radius: 4px; 
      background: #FFFFFF; 
      box-shadow: 0px 4px 5px 2px rgba(14, 65, 142, 0.05), 2px 2px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .detail_section_con {
      background: #FFFFFF; 
      box-shadow: 0px 4px 5px 2px rgba(14, 65, 142, 0.05), 2px 2px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .margintop_con {
      margin-top: 10px;
    }
    .paddingtop_con {
      padding-top: 20px;
    }
    .marginleft_con {
      margin-left: 15px;
    }
    .paddingleft_con {
      padding-left: 15px;
    }
    .paddingright_con {
      padding-right: 15px;
    }
    .padding_con {
      padding: 15px;
    }
    .margin_con {
      margin: 10px;
    }
    .marginstop_con {
      margin-top: 10px;
    }
    .marginsbottom_con {
      margin-bottom: 5px;
    }
</style>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Tasklist</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?php if ($_GET['prev'] == 'performance') echo base_url('performance/AccountPlanning'); else if ($_GET['prev']=='cst') echo base_url('tasklist/AccountPlanningCst'); else echo base_url('tasklist/AccountPlanning'); ?>">Account Planning</a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Detail Account Planning</li> -->
                  </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content" style="min-height: 100px;">
                <div class="col-md-12 col-sm-12 col-xs-12" style="min-height: 25px;">
                </div>
                <!-- <div class="detail_cont_header"> -->
                  <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <img class="img-responsive" src="<?= base_url('assets/images/default.png'); ?>">
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <h5 class="detail_title"><b><?= html_escape($account_planning['CustomerName']); ?></b></h5>
                          </div>
                      <!-- </div> -->
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="detail_property_title">Tahun :</span>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <?= html_escape($account_planning['Year']); ?>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="detail_property_title">Unit Kerja :</span>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <?= html_escape($account_planning['UKER']); ?>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <img class="img-responsive" src="<?= base_url('assets/images/default.png'); ?>">
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <?= html_escape($account_planning['Clasifications']); ?>
                        <br>
                        Clasifications
                      </div>
                    </div>
                  <!-- </div> -->
                <!-- </div> -->
                <div class="clearfix"></div>
              </div>
          </div>
      </div>
    </div>
    <div class="row">

      <!-- Chart.js -->
      <!-- <script src="<?=base_url();?>template/vendors/Chart.js/dist/Chart.PieceLabel.min.js"></script> -->
      <script src="<?=base_url();?>template/vendors/Chart.js/dist/Chart.min.js"></script>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="background: none; border: none; padding: 0px;">
            <!-- <div class="x_content"> -->
              <div role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="ap_tab" class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="<?= $account_planning['ap_tab']['company_information'] ?>" style="width: 19.5%"><a href="#company_information" id="company_information-tab" role="tab" data-toggle="tab" aria-expanded="false">Company Information</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['bri_starting_position'] ?>" style="width: 19.5%"><a href="#bri_starting_position" role="tab" id="bri_starting_position-tab" data-toggle="tab" aria-expanded="true">BRI Starting Position</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['client_needs'] ?>" style="width: 19.5%"><a href="#client_needs" role="tab" id="client_needs-tab" data-toggle="tab" aria-expanded="false">Client Needs</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['action_plans'] ?>" style="width: 19.5%"><a href="#action_plans" role="tab" id="action_plans-tab" data-toggle="tab" aria-expanded="false">Action Plans</a>
                      </li>
                      <li role="presentation" class="<?= $account_planning['ap_tab']['simulation'] ?>" style="width: 22%"><a href="#simulation" role="tab" id="simulation-tab" data-toggle="tab" aria-expanded="false">Customer Profitability Account</a>
                      </li>
                  </ul>
              </div>
            <!-- </div> -->
        </div>
      </div>
    </div>
    <div class="row">
     <div class="tab-content col-xs-12" id="ap_tabContent">
                <!-- Company Information -->
                  <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['company_information'] ?>" id="company_information" aria-labelledby="company_information-tab">
                    <?php $this->load->view('tasklist/detail/company_information.php'); ?>
                  </div>
                <!-- /Company Information -->
                <!-- BRI Starting Position -->
                  <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['bri_starting_position'] ?>" id="bri_starting_position" aria-labelledby="bri_starting_position-tab">
                    <?php $this->load->view('tasklist/detail/bri_sp.php'); ?>
                  </div>
                <!-- /BRI Starting Position -->
                <!-- Client Needs -->
                  <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['client_needs'] ?>" id="client_needs" aria-labelledby="client_needs-tab">
                    <?php $this->load->view('tasklist/detail/client_needs.php'); ?>
                  </div>
                <!-- /Client Needs -->
                <!-- Action Plans -->
                  <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['action_plans'] ?>" id="action_plans" aria-labelledby="action_plans-tab">
                    <?php $this->load->view('tasklist/detail/action_plans.php'); ?>
                  </div>
                <!-- /Action Plans -->
                <!-- Simulation Input -->
                  <div role="tabpanel" class="tab-pane fade<?= $account_planning['ap_tab_content']['simulation'] ?>" id="simulation" aria-labelledby="simulation-tab">
                    <?php $this->load->view('tasklist/detail/simulation.php'); ?>
                  </div>
                <!-- /Simulation Input -->
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  function format1(n, currency) {
    return currency + n.toFixed(0).replace(/./g, function(c, i, a) {
      return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
    });
  }

  function format2(n, currency) {
    return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
  }

<?php foreach ($account_planning['FinancialHighlight'] as $row => $value) : ?>
<?php if ($value[0]['FinancialHighlightGroupId'] == 3 || $value[0]['FinancialHighlightGroupId'] == 5 || $value[0]['FinancialHighlightGroupId'] == 6) { ?>
  var g = document.getElementById("FinancialHighlight_barChart_<?=$value[0]['FinancialHighlightGroupId']?>");
  new Chart(g,
    {
        type: "bar",
        data: {
            labels: [<?= '"'.implode('", "', $account_planning['Years']).'"'; ?>],
            datasets: [
  <?php if (isset($value['FinancialHighlight_details'])) {?>
  <?php $indexs = 0; ?>
  <?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                {
                    label: "<?=$rows[0]['FinancialHighlightItemName']?>", 
                    backgroundColor: "<?= $account_planning['backgroundColors'][$indexs] ?>", 
                    data: ["<?= $rows[$account_planning['Years'][0]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][1]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][2]]['ChartAmount'] ?>"]
                }
                ,
  <?php $indexs++?>
  <?php endforeach; ?>
  <?php } ?>
            ]
        }
        ,
        options: {
            legend: false,
            scales: {
              yAxes: [{
                 display: true,
                 scaleLabel: {
                   display: true,
                   labelString: 'Value'
                 },
                 ticks: {
                   callback: function(label, index, labels) {
                    return format1(label, '');
                   }
                 },
                 gridLines: {
                   display: false
                 }
              }]
            },
            hover: {
              mode: 'label'
            },
            /*scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }
                ]
            }*/
        }
    }
  )
<?php } else if ($value[0]['FinancialHighlightGroupId'] == 1 || $value[0]['FinancialHighlightGroupId'] == 2) { ?>

  var f = document.getElementById("FinancialHighlight_lineChart_<?=$value[0]['FinancialHighlightGroupId']?>");
  new Chart(f,
    {
        type: "line",
        data: {
            labels: [<?= '"'.implode('", "', $account_planning['Years']).'"'; ?>],
            datasets: [
<?php if (isset($value['FinancialHighlight_details'])) {?>
<?php $indexs = 0; ?>
<?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                {
                    label: "<?=$rows[0]['FinancialHighlightItemName']?>", 
                    backgroundColor: "rgba(0, 0, 0, 0)",
                    borderColor: "<?= $account_planning['backgroundColors'][$indexs] ?>", 
                    pointBorderColor: "rgba(38, 185, 154, 0.7)", 
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)", 
                    pointHoverBackgroundColor: "#fff", 
                    pointHoverBorderColor: "rgba(220,220,220,1)", 
                    pointBorderWidth: 1,
                    data: ["<?= $rows[$account_planning['Years'][0]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][1]]['ChartAmount'] ?>", "<?= $rows[$account_planning['Years'][2]]['ChartAmount'] ?>"]

                }
                ,
<?php $indexs++?>
<?php endforeach; ?>
<?php } ?>
            ]
      }
      ,
      options: {
        legend: false, 
        responsive: true,
        scales: {
          yAxes: [{
             display: true,
             scaleLabel: {
               display: true,
               labelString: 'Value'
             },
             ticks: {
               callback: function(label, index, labels) {
                return format1(label, '');
               }
             },
             gridLines: {
               display: false
             }
          }]
        },
        hover: {
          mode: 'label'
        },
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              console.log(tooltipItem);
              return "Year : " + data['labels'][tooltipItem[0]['index']];
            },
            label: function(tooltipItem, data) {
              console.log(data['datasets'][tooltipItem['datasetIndex']]['data'][tooltipItem['index']]);
              return data['datasets'][tooltipItem['datasetIndex']]['label'] + " : " + format1(Number(data['datasets'][tooltipItem['datasetIndex']]['data'][tooltipItem['index']]), '');
            }
          },
        }         
      }
    }
  )
<?php } ?>
<?php endforeach; ?>

</script>






