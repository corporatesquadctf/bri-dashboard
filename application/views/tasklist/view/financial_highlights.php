<style type="text/css">
.detail_title {
  font-weight: 600;
  font-size: 14px;
  line-height: 136.89%;
  display: flex;
  align-items: center;
  letter-spacing: 0.25px;
  color: #707070;
}
.detail_property_titles {
  font-weight: 600;
  font-size: 12px;
  line-height: 24px;
  letter-spacing: 0.5px;
  color: #218FD8;
}

  .div-action{
      display: inline-flex;
      margin: auto;
      color: #F58C38;
      float: right;
  }
  .div-action i{
      font-size: 14px;
      font-weight: normal;
      margin: auto;
  }
  .div-action .fa-chevron-down:before {
      content: "none";
  }
  .div-action label{
      font-size: 14px;
      font-weight: normal;
      padding-left: 5px;
      margin-bottom: 0px;
  }
  .div-action:hover i, .div-action:hover label{
      cursor: pointer;
      font-weight: bold !important;
  }
  .label-action{
      margin:0 !important; 
      padding-left:5px !important; 
      font-weight: normal !important;
  }
  .div-disabled{
        display: inline-flex;
        margin: auto;
        color: #d4d4d4;
        float: right;
  }
  .div-disabled i{
      font-size: 14px;
      font-weight: normal;
      margin: auto;
  }
  .div-disabled .fa-chevron-down:before {
      content: "none";
  }
  .div-disabled label{
      font-size: 14px;
      font-weight: normal;
      padding-left: 5px;
      margin-bottom: 0px;
  }
  .btn-data-option:not([disabled]):not(.disabled).load, .show>.btn-data-option.dropdown-toggle {
        background-color: #1c71ff!important;
    }

    .btn-data-option.load, .btn-data-option:focus {
        background-color: #1c71ff;
        color: white;
    }

    .btn-data-option {
        background-color: white;
        border-radius:10px;
        border:1px solid #d4d4d4;
        color: #d4d4d4;
    }

</style>

                    <div class="row" style="padding-top: 3px; border-radius: 4px;">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 0;">
                        <div class="accordion" id="accordion_FinancialHighlight" role="tablist" aria-multiselectable="true">
                            <?php foreach ($account_planning['FinancialHighlight'] as $row => $value) : ?>
                            <div class="panel">
                              <a class="panel-heading<?=$value[0]['heading_panel']?>" role="tab" id="headingFinancialHighlight<?=$value[0]['FinancialHighlightGroupId']?>" data-toggle="collapse" data-parent="#accordion_FinancialHighlight" href="#collapseFinancialHighlight<?=$value[0]['FinancialHighlightGroupId']?>" aria-expanded="<?=$value[0]['expanded_panel']?>" aria-controls="collapseFinancialHighlight<?=$value[0]['FinancialHighlightGroupId']?>" style="border-bottom: 1px solid #ddd;">
                                <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> <?=$value[0]['FinancialHighlightGroupName']?></h4>
                              </a>
                              <div id="collapseFinancialHighlight<?=$value[0]['FinancialHighlightGroupId']?>" class="panel-collapse<?=$value[0]['tab_panel']?>" role="tabpanel" aria-labelledby="headingFinancialHighlight<?=$value[0]['FinancialHighlightGroupId']?>">
                                <div class="panel-body" style="padding: 0;">
                                          <div class="col-xs-12">
                                              <div class="col-xs-12" style="padding: 10px 15px 5px 10px;">
                                          <?php 
                                            if ($AccountPlanningTabType == 'input') {
                                          ?>
                                                  <div class="col-sm-6 col-xs-12">
                                                    <?php if($value[0]['FinancialHighlightGroupId'] <> 5 ) { ?>
                                                    <div class="btn-group" data-toggle="buttons">
                                                      <label class="btn btn-data-option form-check-label <?php if($value[0]['DataSource']=='lastyear') echo 'load'; ?>" title="Last Year" id="btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>-lastyear">
                                                        <i class="material-icons" style="font-size: 18px">history</i>
                                                      </label>
                                                      <label class="btn btn-data-option form-check-label <?php if($value[0]['DataSource']=='datamart') echo 'load'; ?>" title="Data Mart" id="btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>-datamart">
                                                        <i class="material-icons"  style="font-size: 18px">cloud_download</i>
                                                      </label>
                                                      <label class="btn btn-data-option form-check-label <?php if($value[0]['DataSource']=='manual') echo 'load'; ?>" title="Manual Input" id="btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>-manual">
                                                        <i class="material-icons" style="font-size: 18px">edit</i>
                                                      </label>
                                                    </div>
                                                    <?php } ?>
                                                  </div>
                                                  <div class="col-sm-6 col-xs-12 pull-right">
                                                  <?php if($value[0]['FinancialHighlightGroupId'] <> 5 ) { ?>
                                                    <div class="div-action" id="edit-btn-<?= $value[0]['FinancialHighlightGroupId'] ?>" >
                                                        <i class="material-icons">edit</i>
                                                        <label>Edit Data</label>
                                                    </div>
                                                    <!-- Modal -->
    <div class="modal fade" id="alertModal-<?= $value[0]['FinancialHighlightGroupId'] ?>" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alertModalLabel">Info
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </h5>
          </div>
          <div class="modal-body">
            <img src="<?= base_url('assets/images/error.png') ?>" style="width: 64px; height: 64px; margin-right: 20px;"><span id="infoMessage-<?= $value[0]['FinancialHighlightGroupId'] ?>"> Data history not available. </span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="confirmModal-<?= $value[0]['FinancialHighlightGroupId'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Confirm
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </h5>
          </div>
          <div class="modal-body">
            <img src="<?= base_url('assets/images/question-icon.png') ?>" style="width: 64px; height: 64px; margin-right: 20px;">Load data <?=$value[0]['FinancialHighlightGroupName']?> from <span id="confirmMessage-<?= $value[0]['FinancialHighlightGroupId'] ?>">data mart</span>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancel-btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="save-btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>" data-dismiss="modal">Load & Save</button>
          </div>
        </div>
      </div>
    </div>
                                                  <?php } ?>
                                                  </div>
                                          <?php 
                                            }
                                          ?>
                                              </div>
                                          </div>
                                  <?php if ($value[0]['FinancialHighlightGroupId'] == 1 || $value[0]['FinancialHighlightGroupId'] == 2 || $value[0]['FinancialHighlightGroupId'] == 3 || $value[0]['FinancialHighlightGroupId'] == 5 || $value[0]['FinancialHighlightGroupId'] == 6) { ?>
                                    <?php if ($value[0]['FinancialHighlightGroupId'] == 1 || $value[0]['FinancialHighlightGroupId'] == 2) { ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        Notes : <span class="detail_property_titles2" style="color: #F58C3 !important;"><?=View_Notes1?></span>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12" style="height: 40px; vertical-align: bottom;">
                                        <?php  if ($account_planning['FinancialHighlightCurrency']) { ?>
                                        #Currency in <span class="detail_property_titles2"><?= $account_planning['FinancialHighlightCurrency'] ?></span>
                                        <?php  } ?>
                                      </div>
                                    </div>
                                  <?php  } ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 margintop_con" style="border-bottom: 1px solid #ddd;">
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                          <p class="detail_property_titles"></p>
                                          <?php if ($value[0]['FinancialHighlightGroupId'] == 3 || $value[0]['FinancialHighlightGroupId'] == 5 || $value[0]['FinancialHighlightGroupId'] == 6) { ?>
                                            <canvas id="FinancialHighlight_barChart_<?=$value[0]['FinancialHighlightGroupId']?>"></canvas>
                                          <?php } else {?>
                                            <canvas id="FinancialHighlight_lineChart_<?=$value[0]['FinancialHighlightGroupId']?>" height="100px"></canvas>
                                          <?php } ?>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-12">
                                        <table width="100%" class="table-condensed table-hover">
                                          <tbody>
                                            <?php if (isset($value['FinancialHighlight_details'])) {?>
                                            <?php $indexss = 0; ?>
                                            <?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                            <tr>
                                              <td width="2%" style="vertical-align: middle;">
                                                <div style="background: <?= $account_planning['backgroundColors'][$indexss] ?>;  width: 12px; height: 12px;"></div>
                                              </td>
                                              <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                            </tr>
                                            <?php $indexss++?>
                                            <?php endforeach; ?>
                                            <?php } ?>
                                          </tbody>
                                        </table>                                    
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                                        <table width="100%" class="table table-condensed table-striped table-hover">
                                          <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 12px;" >
                                            <tr>
                                              <td>Table Sheet</td>
                                              <td style="text-align: right;"><?= $account_planning['Years'][0] ?></td>
                                              <td style="text-align: right;"><?= $account_planning['Years'][1] ?></td>
                                              <td style="text-align: right;"><?= $account_planning['Years'][2] ?></td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if (isset($value['FinancialHighlight_details'])) {?>
                                              <?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                                <tr>
                                                  <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                                  <td style="text-align: right;"><?= $rows[$account_planning['Years'][0]]['Amount'] ?></td>
                                                  <td style="text-align: right;"><?= $rows[$account_planning['Years'][1]]['Amount'] ?></td>
                                                  <td style="text-align: right;"><?= $rows[$account_planning['Years'][2]]['Amount'] ?></td>
                                                </tr>
                                              <?php endforeach; ?>
                                            <?php } ?>
                                            <?php if (isset($value['FinancialHighlight_details2'])) {?>
                                              <?php foreach ($value['FinancialHighlight_details2'] as $rows) : ?>
                                                <tr>
                                                  <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                                  <td style="text-align: right;"><?= $rows[$account_planning['Years'][0]]['Amount'] ?></td>
                                                  <td style="text-align: right;"><?= $rows[$account_planning['Years'][1]]['Amount'] ?></td>
                                                  <td style="text-align: right;"><?= $rows[$account_planning['Years'][2]]['Amount'] ?></td>
                                                </tr>
                                              <?php endforeach; ?>
                                            <?php } ?>
                                          </tbody>
                                        </table>
                                      <?php //} ?>
                                    </div>
                                  <?php } else if ($value[0]['FinancialHighlightGroupId'] == 4) { ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <table width="100%" class="table table-condensed table-striped table-hover">
                                        <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 12px;" >
                                          <tr>
                                            <td>Table Sheet</td>
                                            <td style="text-align: right;"><?= $account_planning['Years'][0] ?></td>
                                            <td style="text-align: right;"><?= $account_planning['Years'][1] ?></td>
                                            <td style="text-align: right;"><?= $account_planning['Years'][2] ?></td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($value['FinancialHighlight_details'] as $rows) : ?>
                                          <tr>
                                            <td><?=$rows[0]['FinancialHighlightItemName']?></td>
                                            <td style="text-align: right;"><?= $rows[$account_planning['Years'][0]]['Amount'] ?></td>
                                            <td style="text-align: right;"><?= $rows[$account_planning['Years'][1]]['Amount'] ?></td>
                                            <td style="text-align: right;"><?= $rows[$account_planning['Years'][2]]['Amount'] ?></td>
                                          </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                      </div>
                    </div>

<!-- Chart.js -->
<!-- <script src="<?=base_url();?>template/vendors/Chart.js/dist/Chart.PieceLabel.min.js"></script> -->
<script src="<?=base_url();?>template/vendors/Chart.js/dist/Chart.min.js"></script>


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

<script>
    var base_url = "<?= base_url(); ?>";
    $(document).ready(function() {
        var current_opt_load = [];
        <?php

      if ($AccountPlanningTabType == 'input') {                                  
        foreach($account_planning['FinancialHighlight'] as $row => $value):
        ?>
        current_opt_load[<?= $value[0]['FinancialHighlightGroupId'] ?>] = '<?= $value[0]['DataSource'] ?>';
        
        $("#edit-btn-<?= $value[0]['FinancialHighlightGroupId'] ?>").click(function(){
            edit_url('tasklist/AccountPlanning/inputform/<?= $account_planning['AccountPlanningId'] ?>/bri_starting_position/financial_highlights/<?= $value[0]['FinancialHighlightGroupId'] ?>');
        })

        $("#btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>-lastyear").click(function(){
            $('#save-btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>').off();
            $('#save-btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>').on('click', function(){save_confirm_financialHighlight('lastyear',<?= $value[0]['FinancialHighlightGroupId'] ?>);});
            $('#confirmMessage-<?= $value[0]['FinancialHighlightGroupId'] ?>').html(" <b>last year\'s</b> data ");
            $('#confirmModal-<?= $value[0]['FinancialHighlightGroupId'] ?>').modal('show');

        });

        $("#btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>-datamart").click(function(){
            $('#save-btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>').off();
            $('#save-btn-opt-<?= $value[0]['FinancialHighlightGroupId'] ?>').on('click', function(){save_confirm_financialHighlight('datamart', <?= $value[0]['FinancialHighlightGroupId'] ?>);});
            $('#confirmMessage-<?= $value[0]['FinancialHighlightGroupId'] ?>').html(" <b>data mart</b> ");
            $('#confirmModal-<?= $value[0]['FinancialHighlightGroupId'] ?>').modal('show');

        });
        <?php
        endforeach;
      }
      ?>
    })

    function edit_url(url){
        window.location.href= "<?= base_url() ?>"+url;
    }

    /*Acitve status
    lastyear | datamart | manual
    */
    function save_confirm_financialHighlight(newactive, groupId){
        $('.loaderImage').show();
        var loadFunction = '';
        if(newactive === 'lastyear')
            loadFunction = 'loadFinancialHighlightLastYear';
        else if(newactive === 'datamart')
            loadFunction = 'loadFinancialHighlightDataMart';

        $.getJSON(base_url+'tasklist/DataLoadOption/'+loadFunction+'/<?= $account_planning['AccountPlanningId'] ?>/'+groupId).done(function(result, status, xhr){
          console.log(result);
            if(result.status === 'success'){
                // $('#btn-opt-'+groupId+'-'+current_opt_load[groupId]).removeClass('load');
                $('#btn-opt-'+groupId+'-'+newactive).addClass('load');
                
                // current_opt_load[groupId] = newactive;
                window.location.href= '<?=base_url('tasklist/AccountPlanning/view/'.$account_planning['AccountPlanningId'].'/input/bri_starting_position/financial_highlights');?>';
            } else if(result.status === 'error'){
                if(newactive === 'lastyear'){
                    $('#infoMessage-'+groupId).text('Data history not available.');
                } else if(newactive === 'datamart'){
                    $('#infoMessage-'+groupId).text('Data mart not available.');
                }
                $('.loaderImage').hide();
                $('#alertModal-'+groupId).modal('show');
            }
        }).fail(function(xhr, status, error){
            // alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
            $('#infoMessage-'+groupId).text("Result: [" + status + "] " + error);
            $('.loaderImage').hide();
            $('#alertModal-'+groupId).modal('show');
        });
    }  
</script>
