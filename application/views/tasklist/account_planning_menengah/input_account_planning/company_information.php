<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Debitur Overview</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding:10px 30px 10px 0;">
                    <div class="div-action btn_edit_debitur_overview">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row content_container shadow_content_container">
                    <div class="col-xs-12 col-md-12" style="padding:10px 20px 5px 20px;">
                        <div class="row form-group">
                            <div class="col-xs-4">
                                <div class="col-xs-12">
                                    <label class="label_title">ADDRESSS</label>
                                </div>
                                <div class="col-xs-12 hyphenate">
                                    <label class="label_desc" id="debitur-overview-address"></label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="col-xs-12">
                                    <label class="label_title">INDUSTRY</label>
                                </div>
                                <div class="col-xs-12 hyphenate">
                                    <label class="label_desc" id="debitur-overview-industry-name"></label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="col-xs-12">
                                    <label class="label_title">INDUSTRY TREND</label>
                                </div>
                                <div class="col-xs-12">
                                    <label class="label_desc" id="debitur-overview-industry-trend"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4">
                                <div class="col-xs-12">
                                    <label class="label_title">CITY</label>
                                </div>
                                <div class="col-xs-12">
                                    <label class="label_desc" id="debitur-overview-city"></label>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="col-xs-12">
                                    <label class="label_title">LIFE CYCLE</label>
                                </div>
                                <div class="col-xs-12">
                                    <label class="label_desc" id="debitur-overview-life-cycle"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Key Shareholder</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding: 10px 30px 10px 0;">
                    <div class="div-action btn_edit_key_shareholder">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row child_company_content" style="width: 100%; padding: 15px 20px;">
                    <div class="col-sm-4 col-xs-12" style="vertical-align: middle; text-align: center;" id="shareholder-chart-container">
                        <canvas id="shareholder-chart" height="150" width="150"></canvas>
                    </div>
                    <div class="col-sm-8 col-xs-12" style="vertical-align: middle; text-align: left;">
                        <table width="100%" id="shareholder-chart-information" style="table-layout: fixed;">
                        </table>
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Business Process and Organization</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding: 10px 30px 10px 0;">
                    <div class="div-action btn_edit_business_process_organitation">
                        <i class="material-icons no-after no-before">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row content_container shadow_content_container">
                    <div class="col-xs-12 col-sm-6" style="padding: 0;">
                        <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                            <label class="label_title" style="font-size: 14px;">Business Process</label>
                        </div>
                        <div class="col-xs-12 col-md-12" style="padding:0;" id="business-process-container">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6" style="padding: 0;">
                        <div class="col-xs-12" style="padding: 10px 30px 5px 30px;">
                            <label class="label_title" style="font-size: 14px;">Company Structure</label>
                        </div>
                        <div class="col-xs-12 col-md-12" style="padding:0;" id="company-structure-container">
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Strategic Plan</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" style="padding: 10px 30px 10px 0;">
                    <div class="div-action btn_edit_strategic_plan">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>                       
                <div class="row content_container shadow_content_container">
                    <div class="col-xs-12 col-md-12" style="padding:0;" id="strategic-plan-item-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel panel_container">
            <div class="x_title collapse-link title_container">
                <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
                <label>Coverage Mapping</label>
                <div class="clearfix"></div>
            </div>
            <div class="x_content content_container">
                <div class="col-xs-12 pull-right <?= $DisplayAction; ?>" data-id="<?= $APMenengahHeaderInformation->CIF; ?>" style="padding: 10px 30px 10px 0;">
                    <div class="div-action btn_edit_coverage_mapping">
                        <i class="material-icons">edit</i>
                        <label class="label-action">Edit Data</label>
                    </div>
                </div>
                <div class="row content_container shadow_content_container">
                    <div style="padding:0;">
                        <div class="col-xs-12 col-md-12" style="padding:0;" id="coverage-mapping-item-container">
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
<script src="<?= base_url();?>assets/bigInt/bignumber.js"></script>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
    $(document).ready(function() {
        $('.btn_edit_debitur_overview').click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_debitur_overview/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/".$APMenengahHeaderInformation->CIF); ?>";
        });
        
        $('.btn_edit_key_shareholder').click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_key_shareholders/".$APMenengahHeaderInformation->AccountPlanningMenengahId); ?>";
        });

        $('.btn_edit_business_process_organitation').click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_business_organization/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/".$APMenengahHeaderInformation->CIF); ?>";
        });

        $('.btn_edit_strategic_plan').click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_strategic_plan/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/".$APMenengahHeaderInformation->CIF); ?>";
        });

        $('.btn_edit_coverage_mapping').click(function(){
            window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input_coverage_mapping/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/".$APMenengahHeaderInformation->CIF); ?>";
        });
    });

    function init_debitur_overview(debiturOverview){
        $("#debitur-overview-address").html(debiturOverview[0]["Address"]);
        $("#debitur-overview-industry-name").html(debiturOverview[0]["IndustryName"]);
        $("#debitur-overview-industry-trend").html(debiturOverview[0]["IndustryTrend"]);
        $("#debitur-overview-city").html(debiturOverview[0]["Province"]);
        $("#debitur-overview-life-cycle").html(debiturOverview[0]["LifeCycle"]);
    }

    function init_key_shareholder(shareholder){
        $("#shareholder-chart-container").empty();
        var chartItem = "<canvas id='shareholder-chart' height='150' width='150'></canvas>";
        $("#shareholder-chart-container").append(chartItem);

        var labelShareholder = [],
            dataShareholder = [],
            colorShareholder = [],
            keyShareholderItem = "",
            totalPortion = 0,
            totalShare = new BigNumber(0),
            totalNominal = new BigNumber(0);

        $("#shareholder-chart-information").empty();
        keyShareholderItem += "<tr>";
        keyShareholderItem += " <td style='width:5%; vertical-align: top; padding: 5px;'></td>";
        keyShareholderItem += " <td class='hyphenate' style='width:30%; padding: 5px;'><label class='label_desc' style='margin:0; color:#505D6F; font-weight:600;'>Shareholder</label></td>";
        keyShareholderItem += " <td style='text-align:right; width:15%; padding: 5px;'><label class='label_desc' style='margin:0; color:#505D6F; font-weight:600;'>Percentage Shares</label></td>";
        keyShareholderItem += " <td style='text-align:right; width:20%; padding: 5px;'><label class='label_desc money' data-a-dec='.' data-a-sep=',' style='margin:0; color:#505D6F; font-weight:600;'>Shares (qty)</label></td>";
        keyShareholderItem += " <td style='text-align:right; width:30%; padding: 5px;'><label class='label_desc money' data-a-dec='.' data-a-sep=',' style='margin:0; color:#505D6F; font-weight:600;'>Nominal</label></td>";
        keyShareholderItem += "</tr>";
        $.each(shareholder, function(index, item){
            labelShareholder.push(item.Name);
            dataShareholder.push(item.Value);
            colorShareholder.push(item.Color);
            totalPortion += Number(item.Portion);
            totalShare = totalShare.add(new BigNumber(item.Value));
            totalNominal = totalNominal.add(new BigNumber(item.Nominal));
            keyShareholderItem += "<tr>";
            keyShareholderItem += " <td style='vertical-align: top; padding: 5px;'><i class='fa fa-square' style='margin:0 5px 0  0; color: "+item.Color+"; padding: 5px;'></i></td>";
            keyShareholderItem += " <td class='hyphenate' style=' padding: 5px;'><label class='label_desc' style='margin:0; color:#505D6F; font-weight:normal;'>"+item.Name+"</label></td>";
            keyShareholderItem += " <td class='hyphenate' style='text-align:right; padding: 5px; vertical-align: top'><label class='label_desc' style='margin:0; color:#218FD8; font-weight:600;'>"+item.Portion+" %</label></td>";
            keyShareholderItem += " <td class='hyphenate' style='text-align:right; padding: 5px; vertical-align: top'><label class='label_desc money' data-a-dec='.' data-a-sep=',' style='margin:0; color:#505D6F; font-weight:600;'>"+item.Value+"</label></td>";
            keyShareholderItem += " <td class='hyphenate' style='text-align:right; padding: 5px; vertical-align: top'><label class='label_desc money' data-a-dec='.' data-a-sep=',' style='margin:0; color:#505D6F; font-weight:600;'>"+item.Nominal+"</label></td>";
            keyShareholderItem += "</tr>";
        });
        if(totalPortion == 99.99) totalPortion = 100;
        keyShareholderItem += "<tr>";
        keyShareholderItem += "    <td></td>";
        keyShareholderItem += "    <td style=' padding: 5px;'><label class='label_desc' style='margin:15px 0 0 0; color:#505D6F; font-weight:bold;'>Total</label></td>";
        keyShareholderItem += "    <td class='hyphenate' style='text-align:right; padding: 5px;'><label class='label_desc' style='margin:15px 0 0 0; color:#218FD8; font-weight:600;'>"+totalPortion+" %</label></td>";
        keyShareholderItem += "    <td class='hyphenate' style='text-align:right; padding: 5px;'><label class='label_desc money' data-a-dec='.' data-a-sep=',' style='margin:15px 0 0 0; color:#505D6F; font-weight:600;'>"+totalShare+"</label></td>";
        keyShareholderItem += "    <td class='hyphenate' style='text-align:right; padding: 5px;'><label class='label_desc money' data-a-dec='.' data-a-sep=',' style='margin:15px 0 0 0; color:#505D6F; font-weight:600;'>"+totalNominal+"</label></td>";
        keyShareholderItem += "</tr>";
        draw_chart_key_shareholder(dataShareholder, labelShareholder, colorShareholder);
        $("#shareholder-chart-information").append(keyShareholderItem);
        $('.money').autoNumeric('init',{
            vMax: '9999999999999999999',
            mDec: '0'
        });              
    }

    function init_business_process(businessProcess){
        $("#business-process-container").empty();
        var businessProcessItem = "";
        $.each(businessProcess, function(index, item){
            businessProcessItem += "<div class='col-xs-12 child_content' style='padding-right: 30px !important;'>";
            businessProcessItem += "  <div class='row'>";
            businessProcessItem += "    <div class='col-xs-12'>";
            businessProcessItem += "      <a href='<?php echo base_url()."uploads/account_planning_menengah/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"; ?>"+item.CIF+"/"+item.FilePath+"' target='_blank'>";
            businessProcessItem += "        <i class='fa fa-file-pdf-o' style='color:red; cursor: pointer;'></i> ";
            businessProcessItem += "        <label class='label_desc' style='margin-left: 5px; cursor: pointer;'>"+item.FilePath+"</label>";
            businessProcessItem += "      </a>";
            businessProcessItem += "    </div>";
            businessProcessItem += "  </div>";
            businessProcessItem += "</div>";
        });
        $("#business-process-container").append(businessProcessItem);
    }

    function init_company_structure(companyStructure){
        $("#company-structure-container").empty();
        var companyStructureItem = "";
        $.each(companyStructure, function(index, item){
            companyStructureItem += "<div class='col-xs-12 child_content' style='padding-right: 30px !important;'>";
            companyStructureItem += "  <div class='row'>";
            companyStructureItem += "    <div class='col-xs-12'>";
            companyStructureItem += "      <a href='<?php echo base_url()."uploads/account_planning_menengah/".$APMenengahHeaderInformation->AccountPlanningMenengahId."/"; ?>"+item.CIF+"/"+item.FilePath+"' target='_blank'>";
            companyStructureItem += "        <i class='fa fa-file-pdf-o' style='color:red; cursor: pointer;'></i> ";
            companyStructureItem += "        <label class='label_desc' style='margin-left: 5px; cursor: pointer;'>"+item.FilePath+"</label>";
            companyStructureItem += "      </a>";
            companyStructureItem += "    </div>";
            companyStructureItem += "  </div>";
            companyStructureItem += "</div>";
        });
        $("#company-structure-container").append(companyStructureItem);
    }

    function init_strategic_plan(strategicPlan){            
        $("#strategic-plan-item-container").empty();
        var strategicPlanItem = "",
            indexStrategicPlanItem = 1;
        $.each(strategicPlan, function(index, item){
            strategicPlanItem += "<div class='col-xs-12 child_content'>";
            strategicPlanItem += "  <div class='hyphenate' style='width:2%;'><label class='label_desc'>"+indexStrategicPlanItem+".</label></div>";
            strategicPlanItem += "  <div class='hyphenate' style='width:18%;'><label class='label_desc' style='font-weight: bold;'>"+item.StrategicPlanTypeName+"</label></div>";
            strategicPlanItem += "  <div class='hyphenate' style='width:80%;'><label class='label_desc'>"+item.Name+"</label></div>";
            strategicPlanItem += "</div>";
            indexStrategicPlanItem++;
        });
        $("#strategic-plan-item-container").append(strategicPlanItem);
    }

    function init_coverage_mapping(coverageMapping){
        $("#coverage-mapping-item-container").empty();
        var coverageMappingItem = "",
            indexCoverageMappingItem = 1;
        $.each(coverageMapping, function(index, item){
            coverageMappingItem += "<div class='col-xs-12 child_content'>";
            coverageMappingItem += "    <div style='width:2%;'><label class='label_desc' style='margin-bottom: 0px;'>"+indexCoverageMappingItem+".</label></div>";
            coverageMappingItem += "    <div style='width:98%;'>";
            coverageMappingItem += "        <div class='row'>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Client Name</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12 hyphenate'>";
            coverageMappingItem += "                        <label class='label_desc'>"+item.ClientName+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Client Contact</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12 hyphenate'>";
            coverageMappingItem += "                        <label class='label_desc'>"+item.ContactNumber+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Client Position</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12 hyphenate'>";
            coverageMappingItem += "                        <label class='label_desc'>"+item.ClientPosition+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Client Information</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_desc hyphenate'>"+item.OtherInformation+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "        </div>";
            coverageMappingItem += "        <div class='row'>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Bank Person Name</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_desc hyphenate'>"+item.BankPerson+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Bank Contact</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_desc hyphenate'>"+item.BankContact+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "            <div class='col-xs-3'>";
            coverageMappingItem += "                <div class='row'>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_title'>Bank Position</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                    <div class='col-xs-12'>";
            coverageMappingItem += "                        <label class='label_desc hyphenate'>"+item.BankPosition+"</label>";
            coverageMappingItem += "                    </div>";
            coverageMappingItem += "                </div>";
            coverageMappingItem += "            </div>";
            coverageMappingItem += "        </div>";
            coverageMappingItem += "    </div>";
            coverageMappingItem += "</div>";
            indexCoverageMappingItem++;
        });
        $("#coverage-mapping-item-container").append(coverageMappingItem);
    }

    function draw_chart_key_shareholder(dataShareholder, labelShareholder, colorShareholder){
        if( typeof (Chart) === 'undefined'){ return; }                
        if ($('#shareholder-chart').length){                    
        var chart_doughnut_settings = {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: labelShareholder,
                    datasets: [{
                        data: dataShareholder,
                        backgroundColor: colorShareholder
                    }]
                },
                options: { 
                    legend: false, 
                    responsive: false,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(2));
                                return percentage+' %';
                            }
                        }
                    }
                },
                
            }
        
            $('#shareholder-chart').each(function(){                        
                var chart_element = $(this);
                var chart_doughnut = new Chart( chart_element, chart_doughnut_settings);                        
            });                
        }               
    }
</script>