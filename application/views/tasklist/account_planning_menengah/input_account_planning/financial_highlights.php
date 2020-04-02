<div class="row" style="padding-top: 3px; border-radius: 4px;">
  <div class="col-xs-12" id="financial-highlight-container" style="padding-right: 0;">
  </div>
</div>

<script>
  function init_financial_highlight(data){
    //console.log(data);
    //console.log(data.FinancialHighlightGroup);
    $("#financial-highlight-container").empty();
    if(data.FinancialHighlight.length > 0){ 
      var dataFinancialHighlightGroup = data.FinancialHighlight,
          FHGroupItem = "";
      $.each(dataFinancialHighlightGroup, function(index, item){
        FHGroupItem += "<div class='x_panel panel_container'>";
        FHGroupItem += "  <div class='x_title collapse-link-financial-highlight title_container'>";
        FHGroupItem += "    <i class='fa fa-chevron-up' style='color:#218FD8;'></i>";
        FHGroupItem += "    <label>"+item.Name+"</label>";
        FHGroupItem += "  </div>";
        FHGroupItem += "  <div class='x_content content_container'>";
        FHGroupItem += "    <div class='col-xs-12 pull-right <?= $DisplayAction; ?>' style='padding: 10px 30px 10px 0;'>";
        FHGroupItem += "      <div class='div-action btn_edit_financial_highlight' data-id='"+item.FinancialHighlightGroupMenengahId+"'>";
        FHGroupItem += "        <i class='material-icons'>edit</i>";
        FHGroupItem += "        <label class='label-action'>Edit Data</label>";
        FHGroupItem += "      </div>";
        FHGroupItem += "    </div>";
        FHGroupItem += "    <div class='row content_container shadow_content_container'>";
        FHGroupItem += "      <div class='col-xs-12' style='padding:10px 20px;'>";
        if(item.FinancialHighlightGroupMenengahId != 4){
        FHGroupItem += "        <div class='row'>";
        FHGroupItem += "          <div class='col-xs-12 col-sm-9' id='financial-highlight-"+item.FinancialHighlightGroupMenengahId+"-chart-container'>";
        FHGroupItem += "            <canvas id='financial-highlight-"+item.FinancialHighlightGroupMenengahId+"-chart' style='width: 100%;'></canvas>";
        FHGroupItem += "          </div>";
        FHGroupItem += "        </div>";
        }
        FHGroupItem += "        <div class='row'>";
        FHGroupItem += "          <div class='col-xs-12' id='financial-highlight-"+item.FinancialHighlightGroupMenengahId+"-legend-container'>";
        FHGroupItem += "          </div>";
        FHGroupItem += "        </div>";
        FHGroupItem += "      </div>";
        FHGroupItem += "    </div>";
        FHGroupItem += "  </div>";
        FHGroupItem += "</div>";        
      });
      $("#financial-highlight-container").append(FHGroupItem);

      init_financial_highlight_content(data.Years, dataFinancialHighlightGroup);

      /* Re-init Collapsable */
      $(".collapse-link-financial-highlight").on("click", function () {
        var a = $(this).closest(".x_panel"), b = $(this).find("i"), c = a.find(".x_content");
        a.attr("style") ? c.slideToggle(200, function () {
          a.removeAttr("style")
        }
        ) : (c.slideToggle(200), a.css("height", "auto")), b.toggleClass("fa-chevron-up fa-chevron-down")
      }),
      $(".close-link").click(function () {
        var a = $(this).closest(".x_panel");
        a.remove()
      })

      $('.btn_edit_financial_highlight').click(function(){
        var financialHighlightGroupMenengahId = $(this).data("id");
        window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_financial_highlight/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"); ?>"+financialHighlightGroupMenengahId;
      });
    }
  }

  function init_financial_highlight_content(dataYears, dataFinancialHighlightGroup){
    $.each(dataFinancialHighlightGroup, function(index, item){
        //console.log(dataFinancialHighlightGroup);
        var dataFinancialHighlightItem = item.FinancialHighlightItem,
            financialHighlightGroupId = item.FinancialHighlightGroupMenengahId,
            datasetsFinancialHighlight = [];
        var FHRowItem  = "<table width='100%' class='table table-condensed table-striped table-hover'>";
            FHRowItem += "<thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 12px; table-layout: fixed;'>";
            FHRowItem += "  <tr>";
            FHRowItem += "    <td colspan='2' style='width: 60%; font-size: 14px;'>Table Sheet</td>";
            FHRowItem += "    <td style='text-align: right; width: 20%; font-size: 14px;'>"+dataYears[0]+"</td>";
            FHRowItem += "    <td style='text-align: right; width: 20%; font-size: 14px;'>"+dataYears[1]+"</td>";
            FHRowItem += "    <td style='text-align: right; width: 20%; font-size: 14px;'>"+dataYears[2]+"</td>";
            FHRowItem += "  </tr>";
            FHRowItem += "</thead>";
        $.each(dataFinancialHighlightItem, function(index, items){
          //console.log(dataFinancialHighlightItem);
          var dataFinancialHighlight = items.FinancialHighlight,
              financialHighlightItemColor = items.Color,
              financialHighlightItemName = items.Name,
              detailFinancialHighlight = [];
          if(items.FinancialHighlightItemMenengahId != 14 && items.FinancialHighlightItemMenengahId != 24){
            $.each(dataFinancialHighlight, function(index, item_){
              //console.log(dataFinancialHighlight);
              detailFinancialHighlight.push(item_);
            });
            datasetsFinancialHighlight.push({
              label: financialHighlightItemName,
              fill: false,
              backgroundColor: financialHighlightItemColor,
              borderColor: financialHighlightItemColor,
              data: detailFinancialHighlight
            });
          }
          FHRowItem += "<tr>";
          FHRowItem += "  <td style='width: 3%;'><i class='fa fa-square' style='margin:0 5px 0  0; color:"+financialHighlightItemColor+"'></i></td>"
          FHRowItem += "  <td class='hyphenate' style='width: 37%;'><label class='label_desc' style='margin:0; color:#505D6F; font-weight:normal;'>"+financialHighlightItemName+"</label></td>"
          FHRowItem += "  <td style='text-align: right; width: 20%;'><label class='label_desc money' data-a-sep=',' data-a-dec='.' style='margin:0; color:#505D6F; font-weight:normal;'>"+dataFinancialHighlight[0]+"</label></td>"
          FHRowItem += "  <td style='text-align: right; width: 20%;'><label class='label_desc money' data-a-sep=',' data-a-dec='.' style='margin:0; color:#505D6F; font-weight:normal;'>"+dataFinancialHighlight[1]+"</label></td>"
          FHRowItem += "  <td style='text-align: right; width: 20%;'><label class='label_desc money' data-a-sep=',' data-a-dec='.' style='margin:0; color:#505D6F; font-weight:normal;'>"+dataFinancialHighlight[2]+"</label></td>"
          FHRowItem += "</tr>";
        });
        if(financialHighlightGroupId == 2){
          init_financial_highlight_chart(dataYears, datasetsFinancialHighlight, financialHighlightGroupId, "line");
        }else if(financialHighlightGroupId == 1 || financialHighlightGroupId == 3 || financialHighlightGroupId == 5 || financialHighlightGroupId == 6){
          init_financial_highlight_chart(dataYears, datasetsFinancialHighlight, financialHighlightGroupId, "bar");;
        }
        FHRowItem += "</table>";
        $("#financial-highlight-"+financialHighlightGroupId+"-legend-container").append(FHRowItem);
        $(".money").autoNumeric("init",{
          mDec: "0",
          vMax: "99999999999999999"
        });
        //console.log(datasetsFinancialHighlight);
      });
  }

  function init_financial_highlight_chart(dataYears, datasetsFinancialHighlight, financialHighlightGroupId, chartType){
    var financialHighlightConfig = {
          type: chartType,
          data: {
              labels: dataYears,
              datasets: datasetsFinancialHighlight
          },
          options: {
              responsive: true,
              title: {
                  display: false
              },
              legend: {
                  display: false
              },
              tooltips: {
                  callbacks: {
                    title: function(tooltipItem, data) {
                      return "Year : " + data['labels'][tooltipItem[0]['index']];
                    },
                    label: function(tooltipItem, data) {
                      return data['datasets'][tooltipItem['datasetIndex']]['label'] + " : " + (tooltipItem.yLabel).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                  }
              },
              hover: {
                  mode: 'nearest',
                  intersect: true
              },
              scales: {
                  xAxes: [{
                      display: true,
                      scaleLabel: {
                          display: true,
                          labelString: "Periode",
                          fontStyle: "bold",
                      }
                  }],
                  yAxes: [{
                      display: true,
                      scaleLabel: {
                          display: true,
                          labelString: "Value",
                          fontStyle: "bold",
                      }
                  }]
              }
          }
    };
    var canvas = document.getElementById("financial-highlight-"+financialHighlightGroupId+"-chart").getContext("2d");
    window.myLine = new Chart(canvas, financialHighlightConfig);
  }
</script>
