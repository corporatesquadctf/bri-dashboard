<div class="row" style="padding-top: 3px; border-radius: 4px;">
  <div class="col-xs-12" id="estimated-financial-container" style="padding-right: 0;">
  </div>
</div>

<script type="text/javascript">
  function init_estmated_financial(data){
    $("#estimated-financial-container").empty();
    //console.log(data);
    if(data.length > 0){
      var walletShareHTML  = "";
      $.each(data, function(index, item){
        walletShareHTML += "<div class='x_panel panel_container'>";
        walletShareHTML += "  <div class='x_title collapse-link-estimated-financial title_container'>";
        walletShareHTML += "    <i class='fa fa-chevron-up' style='color:#218FD8;'></i>";
        walletShareHTML += "    <label>"+item.Name+"</label>";
        walletShareHTML += "  </div>";
        walletShareHTML += "  <div class='x_content content_container'>";
        walletShareHTML += "    <div class='col-xs-12 pull-right <?= $DisplayAction; ?>' style='padding: 10px 30px 10px 0;'>";
        walletShareHTML += "      <div class='div-action btn_edit_estimated_financial' data-id='"+item.BankFacilityGroupMenengahId+"'>";
        walletShareHTML += "        <i class='material-icons'>edit</i>";
        walletShareHTML += "        <label class='label-action'>Edit Data</label>";
        walletShareHTML += "      </div>";
        walletShareHTML += "    </div>";
        walletShareHTML += "    <div class='row content_container shadow_content_container'>";
        walletShareHTML += "      <div class='col-xs-12' style='padding:10px 30px;'>";
        walletShareHTML += "        <table width='100%' class='table' cellpadding='20' cellspacing='20' style='font-size: 12px; table-layout: fixed;'>";
        walletShareHTML += "          <thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;'>";
        walletShareHTML += "            <tr>";
        walletShareHTML += "              <th style='text-align: left; width: 20%;'>Facilities</td>";
        walletShareHTML += "              <th style='text-align: left; width: 10%;'>Currency</td>";
        walletShareHTML += "              <th style='text-align: right; width: 20%;'>Projection Customer</td>";
        walletShareHTML += "              <th style='text-align: right; width: 20%;'>Target BRI</td>";
        walletShareHTML += "              <th style='text-align: center; width: 30%;'>Portion</td>";
        walletShareHTML += "            </tr>";
        walletShareHTML += "          </thead>";
        walletShareHTML += "          <tbody>";
        if(item.FacilitiesBankingItem.length > 0){
          $.each(item.FacilitiesBankingItem, function(index, items){
            var walletShareItem = items.EstimatedFinancial;
            walletShareHTML += "        <tr>";
            walletShareHTML += "          <td rowspan='2' style='font-weight: bold;'>"+items.Name+"</td>";
            walletShareHTML += "          <td class='hyphenate' style='text-align: left; font-weight: bold;'>IDR</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareItem.IDRProjection+"</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareItem.IDRTarget+"</td>";
            walletShareHTML += "          <td>";
            walletShareHTML += "            <div class='progress' style='height: 20px; width: 100%; margin-bottom: 0px;'>";
            walletShareHTML += "              <div class='progress-bar' data-transitiongoal='"+walletShareItem.IDRProgressBar+"' style='background-color: #218FD8;' title='"+walletShareItem.IDRProgressValue+" %'>"+walletShareItem.IDRProgressValue+" %</div>";
            walletShareHTML += "            </div>"
            walletShareHTML += "          </td>";
            walletShareHTML += "        </tr>";
            walletShareHTML += "        <tr>";
            walletShareHTML += "          <td style='text-align: left; font-weight: bold;'>Valas</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareItem.ValasProjection+"</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareItem.ValasTarget+"</td>";
            walletShareHTML += "          <td>";
            walletShareHTML += "            <div class='progress' style='height: 20px; width: 100%; margin-bottom: 0px;'>";
            walletShareHTML += "              <div class='progress-bar' data-transitiongoal='"+walletShareItem.ValasProgressBar+"' style='background-color: #218FD8;' title='"+walletShareItem.ValasProgressValue+" %'>"+walletShareItem.ValasProgressValue+" %</div>";
            walletShareHTML += "            </div>"
            walletShareHTML += "          </td>";
            walletShareHTML += "        </tr>";
          });
        }
        if(item.FacilitiesBankingItemAddition.length > 0){
          $.each(item.FacilitiesBankingItemAddition, function(index, items){
            var walletShareAdditionItem = items.EstimatedFinancialAddition;
            walletShareHTML += "        <tr>";
            walletShareHTML += "          <td class='hyphenate' rowspan='2' style='font-weight: bold;'>"+items.Name+"</td>";
            walletShareHTML += "          <td style='text-align: left; font-weight: bold;'>IDR</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.IDRProjection+"</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.IDRTarget+"</td>";
            walletShareHTML += "          <td>";
            walletShareHTML += "            <div class='progress' style='height: 20px; width: 100%; margin-bottom: 0px;'>";
            walletShareHTML += "              <div class='progress-bar' data-transitiongoal='"+walletShareAdditionItem.IDRProgressBar+"' style='background-color: #218FD8;' title='"+walletShareAdditionItem.IDRProgressValue+" %'>"+walletShareAdditionItem.IDRProgressValue+" %</div>";
            walletShareHTML += "            </div>"
            walletShareHTML += "          </td>";
            walletShareHTML += "        </tr>";
            walletShareHTML += "        <tr>";
            walletShareHTML += "          <td style='text-align: left; font-weight: bold;'>Valas</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.ValasProjection+"</td>";
            walletShareHTML += "          <td style='text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.ValasTarget+"</td>";
            walletShareHTML += "          <td>";
            walletShareHTML += "            <div class='progress' style='height: 20px; width: 100%; margin-bottom: 0px;'>";
            walletShareHTML += "              <div class='progress-bar' data-transitiongoal='"+walletShareAdditionItem.ValasProgressBar+"' style='background-color: #218FD8;' title='"+walletShareAdditionItem.ValasProgressValue+" %'>"+walletShareAdditionItem.ValasProgressValue+" %</div>";
            walletShareHTML += "            </div>"
            walletShareHTML += "          </td>";
            walletShareHTML += "        </tr>";
          });
        }
        walletShareHTML += "          </tbody>";
        walletShareHTML += "        </table>";
        walletShareHTML += "      </div>";
        walletShareHTML += "    </div>";
        walletShareHTML += "  </div>";
        walletShareHTML += "</div>";
      });
      $("#estimated-financial-container").append(walletShareHTML);

      $(".money").autoNumeric("init",{
        mDec: "0",
        vMax: '9999999999999999',
      });

      if ($(".progress .progress-bar")[0]) {
        $('.progress .progress-bar').progressbar();
      }

      /* Re-init Collapsable */
      $(".collapse-link-estimated-financial").on("click", function () {
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

      $(".btn_edit_estimated_financial").click(function(){
        var facilitiesBankingGroupMenengahId = $(this).data("id");
        window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_estimated_financial/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"); ?>"+facilitiesBankingGroupMenengahId;
      });
    }
  }
</script>


