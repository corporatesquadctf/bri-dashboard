<div class="row" style="padding-top: 3px; border-radius: 4px;">
  <div class="col-xs-12" id="facilities-banking-container" style="padding-right: 0;">
  </div>
</div>

<script>
  function init_facilities_banking(data){
    $("#facilities-banking-container").empty();
    //console.log(data);
    if(data.length > 0){
      var facilitiesBankingItem  = "";
      $.each(data, function(index, item){
        facilitiesBankingItem += "<div class='x_panel panel_container'>";
        facilitiesBankingItem += "  <div class='x_title collapse-link-facilities-banking title_container'>";
        facilitiesBankingItem += "    <i class='fa fa-chevron-up' style='color:#218FD8;'></i>";
        facilitiesBankingItem += "    <label>"+item.Name+"</label>";
        facilitiesBankingItem += "  </div>";
        facilitiesBankingItem += "  <div class='x_content content_container'>";
        facilitiesBankingItem += "    <div class='col-xs-12 pull-right <?= $DisplayAction; ?>' style='padding: 10px 30px 10px 0;'>";
        facilitiesBankingItem += "      <div class='div-action btn_edit_facilites_banking' data-id='"+item.BankFacilityGroupMenengahId+"'>";
        facilitiesBankingItem += "        <i class='material-icons'>edit</i>";
        facilitiesBankingItem += "        <label class='label-action'>Edit Data</label>";
        facilitiesBankingItem += "      </div>";
        facilitiesBankingItem += "    </div>";
        facilitiesBankingItem += "    <div class='row content_container shadow_content_container'>";
        facilitiesBankingItem += "      <div class='col-xs-12' style='padding:10px 30px;'>";
        facilitiesBankingItem += "        <table width='100%' class='table' cellpadding='20' cellspacing='20' style='font-size: 12px; table-layout: fixed;'>";
        facilitiesBankingItem += "          <thead style='background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;'>";
        facilitiesBankingItem += "            <tr>";
        facilitiesBankingItem += "              <th style='text-align: left; width: 35%;'>Facilities</td>";
        facilitiesBankingItem += "              <th style='text-align: left;'>Currency</td>";
        facilitiesBankingItem += "              <th style='text-align: right; width: 20%;'>Nominal</td>";
        facilitiesBankingItem += "              <th style='text-align: right; width: 20%;'>Rate</td>";
        facilitiesBankingItem += "            </tr>";
        facilitiesBankingItem += "          </thead>";
        facilitiesBankingItem += "          <tbody>";
        if(item.FacilitiesBankingItem.length > 0){
          $.each(item.FacilitiesBankingItem, function(index, items){
            fbItem = items.BankFacility;
            facilitiesBankingItem += "            <tr>";
            facilitiesBankingItem += "              <td class='hyphenate' rowspan='2' style='font-weight: bold;'>"+items.Name+"</td>";
            facilitiesBankingItem += "              <td style='text-align: left; font-weight: bold;'>IDR</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItem.IDRAmount+"</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItem.IDRRate+" %</td>";
            facilitiesBankingItem += "            </tr>";
            facilitiesBankingItem += "            <tr>";
            facilitiesBankingItem += "              <td style='text-align: left; font-weight: bold;'>Valas</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItem.ValasAmount+"</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItem.ValasRate+" %</td>";
            facilitiesBankingItem += "            </tr>";
          });
        }
        if(item.FacilitiesBankingItemAddition.length > 0){
          $.each(item.FacilitiesBankingItemAddition, function(index, items){
            fbItemAddition = items.BankFacilityAddition;
            facilitiesBankingItem += "            <tr>";
            facilitiesBankingItem += "              <td class='hyphenate' rowspan='2' style='font-weight: bold;'>"+items.Name+"</td>";
            facilitiesBankingItem += "              <td style='text-align: left; font-weight: bold;'>IDR</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItemAddition.IDRAmount+"</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItemAddition.IDRRate+" %</td>";
            facilitiesBankingItem += "            </tr>";
            facilitiesBankingItem += "            <tr>";
            facilitiesBankingItem += "              <td style='text-align: left; font-weight: bold;'>Valas</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItemAddition.ValasAmount+"</td>";
            facilitiesBankingItem += "              <td style='text-align: right;' class='money' data-a-sep=','>"+fbItemAddition.ValasRate+" %</td>";
            facilitiesBankingItem += "            </tr>";
          });
        }
        facilitiesBankingItem += "          </tbody>";
        facilitiesBankingItem += "        </table>";
        facilitiesBankingItem += "      </div>";
        facilitiesBankingItem += "    </div>";
        facilitiesBankingItem += "  </div>";
        facilitiesBankingItem += "</div>";
      });
    }
    $("#facilities-banking-container").append(facilitiesBankingItem);

    /* Re-init Collapsable */
    $(".collapse-link-facilities-banking").on("click", function () {
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
      vMax: '99999999999999999',
    });

    $('.btn_edit_facilites_banking').click(function(){
      var facilitiesBankingGroupMenengahId = $(this).data("id");
      window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_facilities_banking/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"); ?>"+facilitiesBankingGroupMenengahId;
    });
  }
</script>


