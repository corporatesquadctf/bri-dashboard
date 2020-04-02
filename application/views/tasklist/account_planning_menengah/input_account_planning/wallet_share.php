<div class="row" style="padding-top: 3px; border-radius: 4px;">
  <div class="col-xs-12" id="wallet-share-container" style="padding-right: 0;">
  </div>
</div>

<script type="text/javascript">
  function init_wallet_share(data){
    $("#wallet-share-container").empty();
    //console.log(data);
    if(data.length > 0){
      var walletShareHTML  = "";
      $.each(data, function(index, item){
        walletShareHTML += "<div class='x_panel panel_container'>";
        walletShareHTML += "  <div class='x_title collapse-link-wallet-share title_container'>";
        walletShareHTML += "    <i class='fa fa-chevron-up' style='color:#218FD8;'></i>";
        walletShareHTML += "    <label>"+item.Name+"</label>";
        walletShareHTML += "  </div>";
        walletShareHTML += "  <div class='x_content content_container'>";
        walletShareHTML += "    <div class='col-xs-12 pull-right <?= $DisplayAction; ?>' style='padding: 10px 30px 10px 0;'>";
        walletShareHTML += "      <div class='div-action btn_edit_wallet_share' data-id='"+item.BankFacilityGroupMenengahId+"'>";
        walletShareHTML += "        <i class='material-icons'>edit</i>";
        walletShareHTML += "        <label class='label-action'>Edit Data</label>";
        walletShareHTML += "      </div>";
        walletShareHTML += "    </div>";
        walletShareHTML += "    <div class='row content_container shadow_content_container'>";
        walletShareHTML += "      <div class='col-xs-12' style='padding:10px 30px;'>";
        walletShareHTML += "        <table width='100%' class='table' cellpadding='20' cellspacing='20' style='font-size: 12px; table-layout: fixed;'>";
        walletShareHTML += "          <thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;'>";
        walletShareHTML += "            <tr>";
        walletShareHTML += "              <th style='width: 20%;'>Facilities</th>";
        walletShareHTML += "              <th style='width: 20%; text-align: right;'>Total</th>";
        walletShareHTML += "              <th style='width: 20%; text-align: right;'>BRI Nominal</th>";
        walletShareHTML += "              <th style='width: 20%; text-align: right;'>Other Bank Nominal</th>";
        walletShareHTML += "              <th style='width: 20%;'>BRI Portion</th>"
        walletShareHTML += "            </tr>";
        walletShareHTML += "          </thead>";
        walletShareHTML += "          <tbody>";
        if(item.FacilitiesBankingItem.length > 0){
          $.each(item.FacilitiesBankingItem, function(index, items){
            var walletShareItem = items.WalletShare;
            walletShareHTML += "        <tr>";
            walletShareHTML += "          <td class='hyphenate' style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold; style='width: 25%;'>"+items.Name+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; text-align: right;' class='money' data-a-sep=','>"+walletShareItem.TotalAmount+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; text-align: right;' class='money' data-a-sep=','>"+walletShareItem.BRINominal+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; text-align: right;' class='money' data-a-sep=','>"+walletShareItem.OtherNominal+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;'>";
            walletShareHTML += "            <div class='progress' style='height: 20px; width: 100%; margin-bottom: 0px;'>";
            walletShareHTML += "              <div class='progress-bar' data-transitiongoal='"+walletShareItem.BRIPortion+"' style='background-color: #218FD8;' title='"+walletShareItem.BRIPortion+" %'>"+walletShareItem.BRIPortion+" %</div>";
            walletShareHTML += "            </div>"
            walletShareHTML += "          </td>";
            walletShareHTML += "        </tr>";
          });
        }
        if(item.FacilitiesBankingItemAddition.length > 0){
          $.each(item.FacilitiesBankingItemAddition, function(index, items){
            var walletShareAdditionItem = items.WalletShareAddition;
            walletShareHTML += "        <tr>";
            walletShareHTML += "          <td class='hyphenate' style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;'>"+items.Name+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.TotalAmount+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.BRINominal+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; text-align: right;' class='money' data-a-sep=','>"+walletShareAdditionItem.OtherNominal+"</td>";
            walletShareHTML += "          <td style='background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;'>";
            walletShareHTML += "            <div class='progress' style='height: 20px; width: 100%; margin-bottom: 0px;'>";
            walletShareHTML += "              <div class='progress-bar' data-transitiongoal='"+walletShareAdditionItem.BRIPortion+"' style='background-color: #218FD8;' title='"+walletShareAdditionItem.BRIPortion+" %'>"+walletShareAdditionItem.BRIPortion+" %</div>";
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
      $("#wallet-share-container").append(walletShareHTML);

      /* Re-init Collapsable */
      $(".collapse-link-wallet-share").on("click", function () {
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

      $(".money").autoNumeric("init",{
        vMax: '9999999999999999',
      });

      if ($(".progress .progress-bar")[0]) {
        $('.progress .progress-bar').progressbar();
      }

      $(".btn_edit_wallet_share").click(function(){
        var facilitiesBankingGroupMenengahId = $(this).data("id");
        window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_wallet_share/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"); ?>"+facilitiesBankingGroupMenengahId;
      });
    }
  }
</script>


