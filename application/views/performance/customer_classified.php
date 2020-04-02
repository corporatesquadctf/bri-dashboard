<style type="text/css">
    .detail_button_con {
      background: #218FD8; 
      padding-top: 3px; 
      text-align: center; 
      height: 30px; 
      border-radius: 0px 0px 4px 4px; 
      vertical-align: middle;
    }
    .detail_button, .detail_button:focus, .detail_button:hover {
      letter-spacing: 0.15px; 
      color: #fff; 
      font-size: 10px; 
      font-weight: bold; 
    }
    .img_Logo {
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
      font-size: 14px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.15px;
      color: #707070;
      vertical-align: middle;
    }
    .detail_property_title2 {
      font-weight: 600;
      font-size: 12px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.15px;
      color: #707070;
      vertical-align: middle;
    }
    .detail_property_title_icon {
      font-size: 15px;
      color: #218FD8;
      vertical-align: middle;
      margin-left: -10px;
    }
    .detail_head_title_icon {
      font-size: 15px;
      color: #F58C38;
      vertical-align: middle;
      /*margin-left: -10px;*/
    }
    .detail_property_text {
      font-weight: normal;
      font-size: 12px;
      line-height: 22px;
      letter-spacing: 0.15px;
      color: #707070;
    }
    .detail_property_text2 {
      font-style: normal;
      font-weight: 600;
      font-size: 11px;
      line-height: 20px;
      letter-spacing: 0.15px;
      color: #218FD8;
      margin-left: -20px;
    }
    .detail_cont_header {
      background: #FFFFFF;
      border-radius: 4px;
      min-height: 120px;
      padding-top: 20px
    }
    .margintop_con {
      margin-top: 20px;
    }
    .marginleft_con {
      margin-left: 15px;
    }
    .paddingleft_con {
      padding-left: 15px;
    }
    .padding_con {
      padding: 15px;
    }

    button {
     font-size: 14px !important; 
    }
   .sort_active {
     background-color: #FFFFFF; 
     color: #2980B9 !important; 
     font-weight: bold !important; 
     border-radius: 0px;
     box-shadow: 0px 5px 0px #2980B9;

    } 
   .sort_nonactive {
     background-color: #FFFFFF; 
     font-weight: bold !important; 
    }

</style>

<div class="right_col" role="main">
  <div class="container">
    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel container_header">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Performance</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('performance/ClassifiedCustomer');?>">Segment Client By Profit</a></li>
                  </ol>
              </nav>
              <div class="x_title">
                <div class="page_title">
                    <div class="pull-left">Segment Client By Profit</div>
                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <i class="material-icons detail_head_title_icon">album</i> Value <sub style="font-size: 60%;">UNIT</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;">In <?= VALUE_UNIT ?></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <i class="material-icons detail_head_title_icon">business_center</i> Pinjaman <sub style="font-size: 60%;">LAST UPADATE</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;">Total: <?= $totalPinjamanLastUpdateDate ?></span>
                    <br>
                    <span style="font-size: 11px">Ratas: <?= $ratasPinjamanLastUpdateDate ?></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <i class="material-icons detail_head_title_icon">account_balance_wallet</i> Simpanan <sub style="font-size: 60%;">LAST UPADATE</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;"> Total: <?= $totalSimpananLastUpdateDate ?></span>
                    <br>
                    <span style="font-size: 11px;"> Ratas: <?= $ratasSimpananLastUpdateDate ?></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <i class="material-icons detail_head_title_icon">insert_chart</i> Current CPA <sub style="font-size: 60%;">LAST UPADATE</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;"><?= $cpaLastUpdateDate ?></span>
                  </div>
                </div>
              </div>

              <!-- <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="text-align:right; padding-bottom: 40px">
                <div class="x_title">
                  <ul class="nav panel_toolbox">
                    <li><a class="btn btn-default collapse-link">Search By Filter <i class="fa fa-chevron-down" title="Expand" style="margin-left: 10px"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="x_content" <?= ($search_box) ? $search_box : 'style="display: none;"' ?>>
                <form action="<?=base_url();?>performance/CustomerLeaderboard/search?group_rowno=0" method="get" class="form-horizontal form-label-left" style="background-color: #f4f4f4; padding: 12px 12px 12px 12px; border: 1px solid #d0d0d0">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Keyword</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="keyword_search_box" id="keyword_search_box" class="form-control col-md-7 col-xs-12" placeholder="Search for..." value="<?= ($keyword_search_box) ? $keyword_search_box : "" ?>">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn w150 btn-sm btn-primary pull-left" type="submit">Search</button>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </form>
              </div> -->
          </div>
      </div>
    </div>

    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel row content_container shadow_content_container">
            <div class="x_title row collapse-link" style="padding:0; margin:0;">
              <div class="col-xs-12">
                  <div class="col-xs-12" style="padding: 10px 15px 15px 10px; cursor: pointer;">
                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Segment Client Leaderboard Classification</h4>
                  </div>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="x_content scollable">
              <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 50px;">
                <div id="echart_donuts" style="height:350px;"></div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 50px;">

                  <div class="row form_actions">
                    <div style="text-align: left; padding-left: 20px;">
                      <?php 
                      foreach ($Classification as $Classification_row => $Classification_value) : 
                        if ($ClassificationId == $Classification_value['ClassificationId']) {
                          $active_button = ' sort_active';
                        }
                        else {
                          $active_button = ' sort_nonactive';
                        }
                      ?>                      
                      <button class="btn btn-sm <?=$active_button?>" type="button" style="width: 24%;" id="button_Classification_<?=$Classification_value['ClassificationId']?>" ClassificationId="<?=$Classification_value['ClassificationId']?>" oldClassificationId="<?=$ClassificationId?>" ><?=$Classification_value['Name']?></button>
                      <?php endforeach;?>
                    </div>
                  </div>

                  <div id="ClassificationList" style="padding-top: 20px;">
                  <?php if (!empty($results)) {?>
                    <table width="100%" id="table_ClassificationList" class="table" style="font-size: 12px;">
                      <thead style="background-color: transparent; color: #218FD8;">
                        <tr class="modal_table_title">
                          <th width="5%">No</th>
                          <th>Company</th>
                          <th style="text-align: right;">Ratas Pinjaman</th>
                          <th style="text-align: right;">Total Pinjaman</th>
                          <th style="text-align: right;">Ratas Simpanan</th>
                          <th style="text-align: right;">Total Simpanan</th>
                          <!-- <th style="text-align: right;">RoRa</th>
                          <th style="text-align: right;">RaRoc</th> -->
                          <th style="text-align: right;">Current CPA</th>
                       </tr>
                      </thead>
                      <tbody>
                        <?php $indexAP = 1; ?>
                        <?php foreach ($results as $rows => $values) : ?>
                        <tr class="modal_table_list">
                          <td><?= $indexAP; ?></td>
                          <td><?= $values['CustomerGroupName'] ?></td>
                          <td align="right"><?= $values['PinjamanTotalGroup'] ?></td>
                          <td align="right"><?= $values['PinjamanTotalGroup'] ?></td>
                          <td align="right"><?= $values['SimpananTotalGroup'] ?></td>
                          <td align="right"><?= $values['SimpananRatasGroup'] ?></td>
                          <!-- <td align="right"><?= $values['RoRaGroup'] ?></td>
                          <td align="right"><?= $values['RarocGroup'] ?></td> -->
                          <td align="right"><?= $values['CurrentCPAGroup'] ?></td>
                        </tr>
                        <?php $indexAP++?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    <div>No data.</div>
                  <?php } ?>
                  </div>

              </div>
            </div>
         </div>
      </div>
    </div>

  </div>
</div>

<script src="<?=base_url();?>template/vendors/echarts/dist/echarts.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  $(document).ready(function(){
    $('#table_ClassificationList').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });



  <?php foreach ($Classification as $Classification_row => $Classification_value) : ?>

    $("#button_Classification_<?=$Classification_value['ClassificationId']?>").click(function(){
      var ClassificationId = $(this).attr('ClassificationId');
      var oldClassificationId = $(this).attr('oldClassificationId');

      $('#button_Classification_' + ClassificationId).removeClass('sort_nonactive');
      $('#button_Classification_' + ClassificationId).addClass('sort_active');
      $('#button_Classification_' + oldClassificationId).removeClass('sort_active');
      $('#button_Classification_' + oldClassificationId).addClass('sort_nonactive');

      $(".btn").attr("oldClassificationId", ClassificationId);

      $('.loaderImage').show();

      $("#ClassificationList").load("<?= base_url('performance/ClassifiedCustomer/details/')?>" + ClassificationId , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }
      });
    });

  <?php endforeach;?>

  }); 

    var a = {
        color: [
            "#E4E4E4", //Platinum
            "#FFD15C", //Gold
            "#C7C7C7", //Silver
            "#E3A051", //Bronze

            "#26B99A",
            "#34495E",
            "#BDC3C7",
            "#3498DB",
            "#9B59B6",
            "#8abb6f",
            "#759c6a",
            "#bfd3b7"],
        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: "normal", color: "#408829"
            }
        }
        ,
        dataRange: {
            color: ["#1f610a", "#97b58d"]
        }
        ,
        toolbox: {
            color: ["#408829", "#408829", "#408829", "#408829"]
        }
        ,
        tooltip: {
            backgroundColor: "rgba(0,0,0,0.5)",
            axisPointer: {
                type: "line",
                lineStyle: {
                    color: "#408829", type: "dashed"
                }
                ,
                crossStyle: {
                    color: "#408829"
                }
                ,
                shadowStyle: {
                    color: "rgba(200,200,200,0.3)"
                }
            }
        }
        ,
        dataZoom: {
            dataBackgroundColor: "#eee", fillerColor: "rgba(64,136,41,0.2)", handleColor: "#408829"
        }
        ,
        grid: {
            borderWidth: 0
        }
        ,
        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: "#408829"
                }
            }
            ,
            splitLine: {
                lineStyle: {
                    color: ["#eee"]
                }
            }
        }
        ,
        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: "#408829"
                }
            }
            ,
            splitArea: {
                show: !0,
                areaStyle: {
                    color: ["rgba(250,250,250,0.1)", "rgba(200,200,200,0.1)"]
                }
            }
            ,
            splitLine: {
                lineStyle: {
                    color: ["#eee"]
                }
            }
        }
        ,
        timeline: {
            lineStyle: {
                color: "#408829"
            }
            ,
            controlStyle: {
                normal: {
                    color: "#408829"
                }
                ,
                emphasis: {
                    color: "#408829"
                }
            }
        }
        ,
        k: {
            itemStyle: {
                normal: {
                    color: "#68a54a",
                    color0: "#a9cba2",
                    lineStyle: {
                        width: 1, color: "#408829", color0: "#86b379"
                    }
                }
            }
        }
        ,
        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: "#ddd"
                    }
                    ,
                    label: {
                        textStyle: {
                            color: "#c12e34"
                        }
                    }
                }
                ,
                emphasis: {
                    areaStyle: {
                        color: "#99d2dd"
                    }
                    ,
                    label: {
                        textStyle: {
                            color: "#c12e34"
                        }
                    }
                }
            }
        }
        ,
        force: {
            itemStyle: {
                normal: {
                    linkStyle: {
                        strokeColor: "#408829"
                    }
                }
            }
        }
        ,
        chord: {
            padding: 4,
            itemStyle: {
                normal: {
                    lineStyle: {
                        width: 1, color: "rgba(128, 128, 128, 0.5)"
                    }
                    ,
                    chordStyle: {
                        lineStyle: {
                            width: 1, color: "rgba(128, 128, 128, 0.5)"
                        }
                    }
                }
                ,
                emphasis: {
                    lineStyle: {
                        width: 1, color: "rgba(128, 128, 128, 0.5)"
                    }
                    ,
                    chordStyle: {
                        lineStyle: {
                            width: 1, color: "rgba(128, 128, 128, 0.5)"
                        }
                    }
                }
            }
        }
        ,
        gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
                show: !0,
                lineStyle: {
                    color: [[.2, "#86b379"], [.8, "#68a54a"], [1, "#408829"]], width: 8
                }
            }
            ,
            axisTick: {
                splitNumber: 10,
                length: 12,
                lineStyle: {
                    color: "auto"
                }
            }
            ,
            axisLabel: {
                textStyle: {
                    color: "auto"
                }
            }
            ,
            splitLine: {
                length: 18,
                lineStyle: {
                    color: "auto"
                }
            }
            ,
            pointer: {
                length: "90%", color: "auto"
            }
            ,
            title: {
                textStyle: {
                    color: "#333"
                }
            }
            ,
            detail: {
                textStyle: {
                    color: "auto"
                }
            }
        }
        ,
        textStyle: {
            fontFamily: "Arial, Verdana, sans-serif"
        }
    }
    ;
    if ($("#echart_donuts").length) {
        var i = echarts.init(document.getElementById("echart_donuts"),
                a);
        i.setOption({
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            }
            ,
            calculable: !0,
            legend: {
                x: "center", y: "bottom", data: ["Platinum", "Gold", "Silver", "Bronze"]
            }
            ,
            toolbox: {
                show: !0,
                feature: {
                    magicType: {
                        show: !0,
                        type: ["pie",
                            "funnel"],
                        option: {
                            funnel: {
                                x: "25%", width: "50%", funnelAlign: "center", max: 1548
                            }
                        }
                    }
                    ,
                    restore: {
                        show: !0, title: "Restore"
                    }
                    ,
                    saveAsImage: {
                        show: !0, title: "Save Image"
                    }
                }
            }
            ,
            series: [{
                    name: "Segment Client Leaderboard Classification",
                    type: "pie",
                    radius: ["35%",
                        "55%"],
                    itemStyle: {
                        normal: {
                            label: {
                                show: !0
                            }
                            ,
                            labelLine: {
                                show: !0
                            }
                        }
                        ,
                        emphasis: {
                            label: {
                                show: !0,
                                position: "center",
                                textStyle: {
                                    fontSize: "14", fontWeight: "normal"
                                }
                            }
                        }
                    }
                    ,
                    data: [
                        {
                            value: <?=$countCustomerGroupClassification['Platinum']?>, name: "Platinum"
                        }
                        ,
                        {
                            value: <?=$countCustomerGroupClassification['Gold']?>, name: "Gold"
                        }
                        ,
                        {
                            value: <?=$countCustomerGroupClassification['Silver']?>, name: "Silver"
                        }
                        ,
                        {
                            value: <?=$countCustomerGroupClassification['Bronze']?>, name: "Bronze"
                        }
                    ]
                }
            ]
        }
        )
    }
</script>
