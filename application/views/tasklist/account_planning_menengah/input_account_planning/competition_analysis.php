<div class="row" style="padding-top: 3px; border-radius: 4px;">
  <div class="col-xs-12" id="competition-analysis-container" style="padding-right: 0;">
  </div>
</div>

<script>
  function init_competition_analysis(data){
    $("#competition-analysis-container").empty();
    console.log(data);
    if(data.length > 0){
      var competitionAnalysisHTML  = "";
      $.each(data, function(index, item){
        competitionAnalysisHTML += "<div class='x_panel panel_container'>";
        competitionAnalysisHTML += "  <div class='x_title collapse-link-competition-analysis title_container'>";
        competitionAnalysisHTML += "    <i class='fa fa-chevron-up' style='color:#218FD8;'></i>";
        competitionAnalysisHTML += "    <label>"+item.Name+"</label>";
        competitionAnalysisHTML += "  </div>";
        competitionAnalysisHTML += "  <div class='x_content content_container'>";
        competitionAnalysisHTML += "    <div class='col-xs-12 pull-right <?= $DisplayAction; ?>' style='padding: 10px 30px 10px 0;'>";
        competitionAnalysisHTML += "      <div class='div-action btn_edit_competition_analysis' data-id='"+item.BankFacilityGroupMenengahId+"'>";
        competitionAnalysisHTML += "        <i class='material-icons'>edit</i>";
        competitionAnalysisHTML += "        <label class='label-action'>Edit Data</label>";
        competitionAnalysisHTML += "      </div>";
        competitionAnalysisHTML += "    </div>";
        competitionAnalysisHTML += "    <div class='row content_container shadow_content_container'>";
        competitionAnalysisHTML += "      <div class='col-xs-12' style='padding:10px 30px 10px 20px;'>";
        if(item.FacilitiesBankingItem.length > 0){
          $.each(item.FacilitiesBankingItem, function(index, items){
            competitionAnalysisItem = items.CompetitionAnalysis;
            competitionAnalysisHTML += "    <div class='row' style='padding: 10px 10px 10px 30px'>";
            competitionAnalysisHTML += "      <p class='detail_property_titles hyphenate' style='border-bottom: 1px solid #ddd;'>"+items.Name+"</p>";
            competitionAnalysisHTML += "      <div class='col-xs-12 col-sm-4' style='font-size:12px'>";
            competitionAnalysisHTML += "        Bank Name #1<br />";
            competitionAnalysisHTML += "        <strong style='color:#000; font-size: 14px;'>"+competitionAnalysisItem.BankName1+"</strong>";
            if(competitionAnalysisItem.BankId1 != null){
            competitionAnalysisHTML += "         <br/><strong style='color:#000; font-size: 14px;'>"+competitionAnalysisItem.BankId1Portion+"</strong>";
            }
            competitionAnalysisHTML += "      </div>";
            competitionAnalysisHTML += "      <div class='col-xs-12 col-sm-4' style='font-size:12px'>";
            competitionAnalysisHTML += "        Bank Name #2<br />";
            competitionAnalysisHTML += "        <strong style='color:#000; font-size: 14px;'>"+competitionAnalysisItem.BankName2+"</strong>";
            if(competitionAnalysisItem.BankId2 != null){
            competitionAnalysisHTML += "         <br/><strong style='color:#000; font-size: 14px;'>"+competitionAnalysisItem.BankId2Portion+"</strong>";
            }
            competitionAnalysisHTML += "      </div>";
            competitionAnalysisHTML += "      <div class='col-xs-12 col-sm-4' style='font-size:12px'>";
            competitionAnalysisHTML += "        Bank Name #3<br />";
            competitionAnalysisHTML += "        <strong style='color:#000; font-size: 14px;'>"+competitionAnalysisItem.BankName3+"</strong>";
            if(competitionAnalysisItem.BankId3 != null){
            competitionAnalysisHTML += "         <br/><strong style='color:#000; font-size: 14px;'>"+competitionAnalysisItem.BankId3Portion+"</strong>";
            }
            competitionAnalysisHTML += "      </div>";
            competitionAnalysisHTML += "    </div>";
          });
        }
        if(item.FacilitiesBankingItemAddition.length > 0){
          $.each(item.FacilitiesBankingItemAddition, function(index, items){
            competitionAnalysisAdditionItem = items.CompetitionAnalysisAddition;
            competitionAnalysisHTML += "    <div class='row' style='padding: 10px 10px 10px 30px'>";
            competitionAnalysisHTML += "      <p class='detail_property_titles hyphenate' style='border-bottom: 1px solid #ddd;'>"+items.Name+"</p>";
            competitionAnalysisHTML += "      <div class='col-xs-12 col-sm-4' style='font-size:12px'>";
            competitionAnalysisHTML += "        Bank Name #1<br />";
            competitionAnalysisHTML += "        <strong style='color:#000; font-size: 14px;'>"+competitionAnalysisAdditionItem.BankName1+"</strong>";
            if(competitionAnalysisItem.BankId1 != null){
            competitionAnalysisHTML += "         <br/><strong style='color:#000; font-size: 14px;'>"+competitionAnalysisAdditionItem.BankId1Portion+"</strong>";
            }
            competitionAnalysisHTML += "      </div>";
            competitionAnalysisHTML += "      <div class='col-xs-12 col-sm-4' style='font-size:12px'>";
            competitionAnalysisHTML += "        Bank Name #2<br />";
            competitionAnalysisHTML += "        <strong style='color:#000; font-size: 14px;'>"+competitionAnalysisAdditionItem.BankName2+"</strong>";
            if(competitionAnalysisItem.BankId2 != null){
            competitionAnalysisHTML += "         <br/><strong style='color:#000; font-size: 14px;'>"+competitionAnalysisAdditionItem.BankId2Portion+"</strong>";
            }
            competitionAnalysisHTML += "      </div>";
            competitionAnalysisHTML += "      <div class='col-xs-12 col-sm-4' style='font-size:12px'>";
            competitionAnalysisHTML += "        Bank Name #3<br />";
            competitionAnalysisHTML += "        <strong style='color:#000; font-size: 14px;'>"+competitionAnalysisAdditionItem.BankName3+"</strong>";
            if(competitionAnalysisItem.BankId3 != null){
            competitionAnalysisHTML += "         <br/><strong style='color:#000; font-size: 14px;'>"+competitionAnalysisAdditionItem.BankId3Portion+"</strong>";
            }
            competitionAnalysisHTML += "      </div>";
            competitionAnalysisHTML += "    </div>";
          });
        }
        competitionAnalysisHTML += "      </div>";
        competitionAnalysisHTML += "    </div>";
        competitionAnalysisHTML += "  </div>";
        competitionAnalysisHTML += "</div>";
      });
    }
    $("#competition-analysis-container").append(competitionAnalysisHTML);

    /* Re-init Collapsable */
    $(".collapse-link-competition-analysis").on("click", function () {
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

    $(".btn_edit_competition_analysis").click(function(){
        var facilitiesBankingGroupMenengahId = $(this).data("id");
        window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_competition_analysis/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"); ?>"+facilitiesBankingGroupMenengahId;
      });
  }
</script>


