<style type="text/css">
  .panel_container{
      padding:0;
      border-radius: 4px;
  }
  .panel_container .title_container{
      border-bottom: 1px solid #e5e5e5;
      padding: 15px 30px;
      box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  .panel_container .title_container label{
      margin: 0 0 0 15px;
      font-weight: 600;
      font-size: 14px;
  }
  .content_container{
      padding: 0 0 20px 0;
      margin: 0;
      border: none;
  }
  .content_container .child_company_content{
      margin: 0;
      padding: 15px 10px;
      box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  .shadow_content_container{
      margin: 0;
      padding: 0;
      box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  /*
  .content_container .child_company_content button{
      font-size: 10px;
      line-height: 136.89%;
      letter-spacing: 0.15px;
      background: #F58C38;
      border-radius: 2px;
      color: #fff;
      width: 125px;
      height: 36px;
  }
  */
  .content_container .label_title{
      color: #218FD8;
      font-weight: 600;
      font-size: 14px;
  }
  .content_container .label_desc{
      color: #707070;
      font-weight: normal;
      font-size: 14px;
  }
  .child_content{
      padding: 5px 30px !important;
      display: flex;
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
  .div-cst{
      display: inline-flex;
      margin: 10px 0;
  }
  .detail_title {
    font-weight: 600;
    font-size: 14px;
    line-height: 136.89%;
    display: flex;
    align-items: center;
    letter-spacing: 0.25px;
    color: #707070;
  }
</style>

<div id="Simulation">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordion_input_simulasi" role="tablist" aria-multiselectable="true">
                <div class="panel">
                  <a class="panel-heading" role="tab" id="headinginput_simulasi" data-toggle="collapse" data-parent="#accordion_input_simulasi" href="#collapseinput_simulasi" aria-expanded="true" aria-controls="collapseinput_simulasi" style="border-bottom: 1px solid #ddd;">
                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i>Input Projection CPA</h4>
                  </a>
                  <div id="collapseinput_simulasi" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headinginput_simulasi">
                    <div class="panel-body" style="padding: 0px;">

                      <div class="row content_container" style="padding-bottom: 0;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="accordion" id="accordion_Credit_assumption" role="tablist" aria-multiselectable="true">
                                <div class="panel">
                                  <a class="panel-heading" role="tab" id="headingCredit_assumption" data-toggle="collapse" data-parent="#accordion_Credit_assumption" href="#collapseCredit_assumption" aria-expanded="true" aria-controls="collapseCredit_assumption" style="border-bottom: 1px solid #ddd;">
                                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Assumption</h4>
                                  </a>
                                  <div id="collapseCredit_assumption" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingCredit_assumption">
                                    <div class="panel-body" style="padding: 0px;">
                                        <div class="row content_container shadow_content_container">
                                            <div class="x_title row collapse-link" style="padding:0; margin:0;">
                                              <div class="col-xs-12">
                                                  <div class="col-xs-12" style="padding: 10px 15px 5px 10px;">
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                      <span style="color: #4BB8FF;">Kurs USD : <label class="money"><?= $account_planning['CreditSimulationAssumption']['USDExchange'] ?></label></span>
                                                    </div>
                                                      <div class="col-xs-3 pull-right">
                                                        <?php 
                                                          if ($AccountPlanningTabType == 'input') {
                                                        ?>
                                                        <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/simulation/assumption/0'); ?>'">
                                                            <i class="material-icons">edit</i>
                                                            <label>Edit Data</label>
                                                        </div>
                                                        <?php
                                                          }
                                                        ?>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="x_content">
                                                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                                                  <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                                                    <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                                      <tr class="modal_table_title">
                                                        <td style="text-align: left; width: 10%;">No</td>
                                                        <td style="text-align: left; width: 25%;">FTP</td>
                                                        <td style="text-align: center;">IDR (%)</td>
                                                        <td style="text-align: center;">Valas (%)</td>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <td style="text-align: left;">1</td>
                                                        <td style="text-align: left;">FTP Simpanan</td>
                                                        <td style="text-align: center;"><label class="portion"><?= $account_planning['CreditSimulationAssumption']['IDRFTPSimpanan'] ?></label> %</td>
                                                        <td style="text-align: center;"><label class="portion"><?= $account_planning['CreditSimulationAssumption']['ValasFTPSimpanan'] ?></label> %</td>
                                                      </tr>
                                                      <tr>
                                                        <td style="text-align: left;">2</td>
                                                        <td style="text-align: left;">FTP Pinjaman</td>
                                                        <td style="text-align: center;"><label class="portion"><?= $account_planning['CreditSimulationAssumption']['IDRFTPPinjaman'] ?></label> %</td>
                                                        <td style="text-align: center;"><label class="portion"><?= $account_planning['CreditSimulationAssumption']['ValasFTPPinjaman'] ?></label> %</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row content_container" style="padding-bottom: 0;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="accordion" id="accordion_Simulation" role="tablist" aria-multiselectable="true">
                              <div class="panel">
                                <a class="panel-heading" role="tab" id="headingSimulation" data-toggle="collapse" data-parent="#accordion_Simulation" href="#collapseSimulation" aria-expanded="true" aria-controls="collapseSimulation" style="border-bottom: 1px solid #ddd;">
                                  <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Simulation</h4>
                                </a>
                                <div id="collapseSimulation" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSimulation">
                                  <div class="panel-body" style="padding: 0px;">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="accordion" id="accordion_Simulation1" role="tablist" aria-multiselectable="true">
                                              <?php foreach ($account_planning['CreditSimulation'] as $row => $value) : ?>
                                                <div class="panel">
                                                  <a class="panel-heading<?=$value[0]['heading_panel']?>" role="tab" id="headingSimulation<?=$value[0]['BankFacilityGroupId']?>" data-toggle="collapse" data-parent="#accordion_Simulation1" href="#collapseSimulation<?=$value[0]['BankFacilityGroupId']?>" aria-expanded="<?=$value[0]['expanded_panel']?>" aria-controls="collapseSimulation<?=$value[0]['BankFacilityGroupId']?>" style="border-bottom: 1px solid #ddd;">
                                                    <h4 class="panel-title detail_title" style="color: #65B6F0; font-weight: bold;"><?=$value[0]['BankFacilityGroupName']?></h4>
                                                  </a>
                                                  <div id="collapseSimulation<?=$value[0]['BankFacilityGroupId']?>" class="panel-collapse<?=$value[0]['tab_panel']?>" role="tabpanel" aria-labelledby="headingSimulation<?=$value[0]['BankFacilityGroupId']?>">
                                                    <div class="panel-body" style="padding: 0px;">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                                                              <div class="col-md-4 col-sm-4 col-xs-12">
                                                                Notes : 
                                                                <span class="detail_property_titles2"><?=View_Notes1?></span>
                                                              </div>
                                                              <div class="col-xs-3 pull-right">
                                                        <?php 
                                                          if ($AccountPlanningTabType == 'input') {
                                                        ?>
                                                                <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/simulation/credit_simulation/'.$value[0]['BankFacilityGroupId']); ?>'">
                                                                    <i class="material-icons">edit</i>
                                                                    <label>Edit Data</label>
                                                                </div>
                                                        <?php 
                                                          }
                                                        ?>
                                                              </div>
                                                            <?php if ($value[0]['BankFacilityGroupId'] == 3) { ?>
                                                              <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px; margin-top: 30px;">
                                                                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left; width: 4%;">No</td>
                                                                    <td style="text-align: left; width: 16%;">Facilities</td>
                                                                    <td style="text-align: left;">Currency</td>
                                                                    <td style="text-align: right;">Outstanding / Saldo</td>
                                                                    <td style="text-align: right;" nowrap>Ratas Harian</td>
                                                                    <td style="text-align: right;">Tenor</td>
                                                                    <td style="text-align: right;">Rate</td>
                                                                    <td style="text-align: right;">Pendapatan FTP</td>
                                                                    <td style="text-align: right;">Fee</td>
                                                                    <td style="text-align: right;">Beban Bunga</td>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                              <?php if (isset($value['CreditSimulation_detail'])) { ?>
                                                              <?php $index_simulation = 1; ?>
                                                              <?php foreach ($value['CreditSimulation_detail'] as $rows => $CreditSimulation) : ?>
                                                                  <tr class="modal_table_title">
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$index_simulation?></td>
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$CreditSimulation['BankFacilityItemName']?></td>
                                                                    <td style="text-align: left; font-weight: bold;">IDR</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRPlafond']?></label></td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRDailyRatas']?></label></td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['IDRTenor']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['IDRIndicativeRate']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRIncomeExpense']?></label></td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRFee']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRBebanBunga']?></label>
                                                                    </td>
                                                                  </tr>
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left; font-weight: bold;">Valas</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasPlafond']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasDailyRatas']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['ValasTenor']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['ValasIndicativeRate']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasIncomeExpense']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasFee']?>
                                                                    </label></td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasBebanBunga']?></label>
                                                                    </td>
                                                                  </tr>
                                                              <?php $index_simulation++?>
                                                              <?php endforeach; ?>
                                                              <?php } ?>
                                                               <?php if (isset($value['CreditSimulationAddition_detail'])) { ?>
                                                                <?php $index_simulation_addition = $index_simulation; ?>
                                                              <?php foreach ($value['CreditSimulationAddition_detail'] as $rows => $CreditSimulationAddition) : ?>
                                                                  <tr class="modal_table_title">
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$index_simulation_addition?></td>
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$CreditSimulationAddition['BankFacilityItemAdditionName']?></td>
                                                                    <td style="text-align: left; font-weight: bold;">IDR</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRPlafondAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRDailyRatasAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['IDRTenorAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['IDRIndicativeRateAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRIncomeExpenseAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRFeeAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRBebanBungaAddition']?></label>
                                                                    </td>
                                                                  </tr>
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left; font-weight: bold;">Valas</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasPlafondAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasDailyRatasAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['ValasTenorAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['ValasIndicativeRateAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasIncomeExpenseAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasFeeAddition']?></label></td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasBebanBungaAddition']?></label>
                                                                    </td>
                                                                  </tr>
                                                              <?php $index_simulation_addition++?>
                                                              <?php endforeach; ?>
                                                              <?php } ?>
                                                                </tbody>
                                                              </table>
                                                            <?php } else { ?>
                                                              <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px; margin-top: 30px;">
                                                                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left; width: 4%;">No</td>
                                                                    <td style="text-align: left; width: 16%;">Facilities</td>
                                                                    <td style="text-align: left; width: 8%;">Currency</td>
                                                                    <td style="text-align: right; width: 8%;">Plafond</td>
                                                            <?php if ($value[0]['BankFacilityGroupId'] == 1 || $value[0]['BankFacilityGroupId'] == 2) { ?>
                                                                    <td style="text-align: right; width: 8%;" nowrap>Baki Debet</td>
                                                            <?php } else { ?>
                                                                    <td style="text-align: right; width: 8%;">Outstanding</td>
                                                            <?php } ?>
                                                                    <td style="text-align: right; width: 8%;" nowrap>Ratas Harian</td>
                                                                    <td style="text-align: right; width: 8%;">Tenor</td>
                                                                    <td style="text-align: right; width: 8%;">Rate</td>
                                                                    <td style="text-align: right; width: 8%;">Income</td>
                                                                    <td style="text-align: right; width: 8%;">Provisi (%)</td>
                                                                    <td style="text-align: right; width: 8%;">Provisi</td>
                                                                    <td style="text-align: right; width: 8%;">Fee</td>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                              <?php if (isset($value['CreditSimulation_detail'])) { ?>
                                                              <?php $index_simulation = 1; ?>
                                                              <?php foreach ($value['CreditSimulation_detail'] as $rows => $CreditSimulation) : ?>
                                                                  <tr class="modal_table_title">
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$index_simulation?></td>
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$CreditSimulation['BankFacilityItemName']?></td>
                                                                    <td style="text-align: left; font-weight: bold;">IDR</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRPlafond']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDROutstanding']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRDailyRatas']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['IDRTenor']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['IDRIndicativeRate']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRIncomeExpense']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['IDRProvisionRate']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRProvision']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['IDRFee']?></label>
                                                                    </td>
                                                                  </tr>
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left; font-weight: bold;">Valas</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasPlafond']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasOutstanding']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasDailyRatas']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['ValasTenor']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['ValasIndicativeRate']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasIncomeExpense']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulation['ValasProvisionRate']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasProvision']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulation['ValasFee']?></label>
                                                                    </td>
                                                                  </tr>
                                                              <?php $index_simulation++?>
                                                              <?php endforeach; ?>
                                                              <?php } ?>
                                                               <?php if (isset($value['CreditSimulationAddition_detail'])) { ?>
                                                                <?php $index_simulation_addition = $index_simulation; ?>
                                                              <?php foreach ($value['CreditSimulationAddition_detail'] as $rows => $CreditSimulationAddition) : ?>
                                                                  <tr class="modal_table_title">
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$index_simulation_addition?></td>
                                                                    <td rowspan="2" style="font-weight: bold;"><?=$CreditSimulationAddition['BankFacilityItemAdditionName']?></td>
                                                                    <td style="text-align: left; font-weight: bold;">IDR</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRPlafondAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDROutstandingAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRDailyRatasAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['IDRTenorAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['IDRIndicativeRateAddition']?></label>
                                                                  </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRIncomeExpenseAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['IDRProvisionRateAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRProvisionAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['IDRFeeAddition']?></label>
                                                                    </td>
                                                                  </tr>
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left; font-weight: bold;">Valas</td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasPlafondAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasOutstandingAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasDailyRatasAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['ValasTenorAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['ValasIndicativeRateAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasIncomeExpenseAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="portion"><?=$CreditSimulationAddition['ValasProvisionRateAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasProvisionAddition']?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationAddition['ValasFeeAddition']?></label>
                                                                    </td>
                                                                  </tr>
                                                              <?php $index_simulation_addition++?>
                                                              <?php endforeach; ?>
                                                              <?php } ?>
                                                                </tbody>
                                                              </table>
                                                            <?php } ?>
                                                            </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              <?php endforeach; ?>
                                            </div>
                                      </div>

                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="row content_container" style="padding-bottom: 0;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="accordion" id="accordion_Credit_fee" role="tablist" aria-multiselectable="true">
                                <div class="panel">
                                  <a class="panel-heading" role="tab" id="headingCredit_fee" data-toggle="collapse" data-parent="#accordion_Credit_fee" href="#collapseCredit_fee" aria-expanded="true" aria-controls="collapseCredit_fee" style="border-bottom: 1px solid #ddd;">
                                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Fee</h4>
                                  </a>
                                  <div id="collapseCredit_fee" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingCredit_fee">
                                    <div class="panel-body" style="padding: 0px;">
                                        <div class="row content_container shadow_content_container">
                                            <div class="x_title row collapse-link" style="padding:0; margin:0;">
                                              <div class="col-xs-12">
                                                  <div class="col-xs-12" style="padding: 10px 15px 5px 10px;">
                                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                                        Notes : 
                                                        <span class="detail_property_titles2" style="color: #F58C38;"><?=View_Notes1?></span>
                                                      </div>
                                                      <div class="col-xs-3 pull-right">
                                                        <?php 
                                                          if ($AccountPlanningTabType == 'input') {
                                                        ?>
                                                        <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/simulation/fee/0'); ?>'">
                                                            <i class="material-icons">edit</i>
                                                            <label>Edit Data</label>
                                                        </div>
                                                        <?php 
                                                          }
                                                        ?>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="x_content">
                                                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                                                              <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px; font-weight: bold;">
                                                                <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                                                  <tr class="modal_table_title">
                                                                    <th style="text-align: left; width: 5%;">No</th>
                                                                    <th style="text-align: center; width: 35%;">Keterangan</th>
                                                                    <th style="text-align: right;">IDR</th>
                                                                    <th style="text-align: right;">Valas</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                              <?php $index_simulation_fee = 1; ?>
                                                              <?php foreach ($account_planning['CreditSimulationFee'] as $rows => $CreditSimulationFee) : ?>
                                                                  <tr class="modal_table_title">
                                                                    <td style="text-align: left;"><?=$index_simulation_fee;?></td>
                                                                    <td style="text-align: left; font-weight: bold;"><?=$CreditSimulationFee['FeeTypeName'];?></td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationFee['IDRAmount'];?></label>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                      <label class="money"><?=$CreditSimulationFee['ValasAmount'];?></label>
                                                                    </td>
                                                                  </tr>
                                                              <?php $index_simulation_fee++?>
                                                              <?php endforeach; ?>
                                                                </tbody>
                                                              </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row margintop_con">
                      </div>

                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="row margintop_con">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel content_container shadow_content_container">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                    <div class="form_actions">
                      <div style="text-align: right;">
                          <button class="btn btn-sm btn-default btn_cancels" type="button" style="width: 200px;" id="button_view_simulation" tab_panel="existing" AccountPlanningId="<?= $account_planning['AccountPlanningId'] ?>">VIEW CPA Simulation</button>
                        <?php if ($confirmation_user) { ?>
                          <?php if ($account_planning['status']['DocumentStatusId'] == $confirmation_docstatus_id) { ?>
                          <button class="btn btn-sm btn-warning btn_cancels" type="button" style="width: 200px;" onclick="account_planning_response('Reject', '<?=$confirmation_user?>', <?= $account_planning['AccountPlanningId'] ?>, <?= $account_planning['ConfirmationDetail'][$confirmation_table_id] ?>);" title="REJECT">REJECT</button>
                          <button class="btn btn-sm btn-success" type="button" style="width: 200px;" onclick="account_planning_response('Approve', '<?=$confirmation_user?>', <?= $account_planning['AccountPlanningId'] ?>, <?= $account_planning['ConfirmationDetail'][$confirmation_table_id] ?>);" title="APPROVE">APPROVE</button>
                          <?php } ?>
                        <?php } else { ?>
                          <?php if ($AccountPlanningTabType == 'input') { ?>
                          <button class="btn btn-sm btn-success" type="button" style="width: 200px;" onclick="account_planning_submit(<?= $account_planning['AccountPlanningId'] ?>);">FINAL SUBMIT ACCOUNT PLANNING</button>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
<?php 
if ($confirmation_user) { 
  $this->load->view('confirmation/checker_signer_response.php');
}
else {
  $this->load->view('tasklist/inputform/checker_signer.php');
}
?>

</div>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  $(document).ready(function(){

    // $('.money').autoNumeric('init',{
    //   aForm: true,
    //   // mDec: '2',
    //   vMax: '999999999999999999',
    //   aPad: false,
    //   unformatOnSubmit: true
    // });
    // $('.portion').autoNumeric('init',{
    //   aForm: true,
    //   // mDec: '2',
    //   aPad: false,
    //   vMax: '999',
    //   unformatOnSubmit: true
    // });

    $("#button_view_simulation").click(function(){
      var tab_panel = $(this).attr('tab_panel');
      var AccountPlanningId = $(this).attr('AccountPlanningId');
      $('.loaderImage').show();

      $("#Simulation").load("<?= base_url('tasklist/AccountPlanning/view_cpa/')?>" + tab_panel +"/" + AccountPlanningId , function(responseTxt, statusTxt, xhr){
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

  });  

</script>