<style type="text/css">
  .form_container{
      margin: 0;
      padding: 15px 30px;
      box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  .form_container label{
      font-style: normal;
      font-weight: 600;
      font-size: 14px;
      color: rgba(0, 0, 0, 0.87);
  }
  .form_container .form-control{
      border-radius: 4px;
  }
  .form_action{
      margin: 0;
      padding: 30px 30px 0 15px;
  }
  .form_action button{
      border: 1px solid #F58C38;
      box-sizing: border-box;
      border-radius: 2px;
      font-size: 10px;
      color: #FFFFFF;
  }
  .form_action .btn_save{
      background: #F58C38;
  }
  .form_action .btn_save:hover{
      border: 1px solid #F58C38;
  }
  .form_action .btn_save:active:hover{
      background: #c4702c;
      border: 1px solid #F58C38;
  }
  .form_action .btn_cancel{
      color: #F58C38;
  }
  .form_action .btn_cancel:hover{
      border: 1px solid #F58C38;
  }
  .form_action .btn-default.focus, .btn-default:focus {
      border-color: #F58C38;
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
  .div-action label{
      color: #F58C38;
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
  .shadow_content_container {
      margin: 0;
      padding: 0;
      box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
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
                      <li class="breadcrumb-item"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/simulation');?>">Credit Simulation</a></li>
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left"><?= $BankFacilityGroupName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="padding-right: 0; padding-left: 0;">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if (!empty($inputform[$BankFacilityGroupType])) {?>
                <?php foreach ($inputform[$BankFacilityGroupType] as $rows => $values) : ?>
                  <div class="x_panel">
                    <div class="x_title collapse-link" style="padding: 0;">
                      <!-- <i class="fa fa-chevron-up" style="color:#218FD8;"></i> -->
                      <label style="color:#218FD8;"><?= $values['BankFacilityItemName'] ?></label>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table width="100%" style="color: #00000; font-size: 13px;">
                        <?php if ($BankFacilityGroupId == 3) { ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Outstanding / Saldo</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRPlafond[]" id="IDRPlafond_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['IDRPlafond'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRPlafond[]" value="<?= $values['IDRPlafond'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasPlafond[]" id="ValasPlafond_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['ValasPlafond'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasPlafond[]" value="<?= $values['ValasPlafond'] ?>"></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Beban Bunga</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRBebanBunga[]" id="IDRBebanBunga_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['IDRBebanBunga'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRBebanBunga[]" id="IDRBebanBunga_hidden_<?= $values['BankFacilityItemId'] ?>" value="<?= $values['IDRBebanBunga'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasBebanBunga[]" id="ValasBebanBunga_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['ValasBebanBunga'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasBebanBunga[]" id="ValasBebanBunga_hidden_<?= $values['BankFacilityItemId'] ?>" value="<?= $values['ValasBebanBunga'] ?>"></td>
                          </tr>
                        </tbody>
                        <?php } else { ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Plafond</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRPlafond[]" id="IDRPlafond_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['IDRPlafond'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRPlafond[]" value="<?= $values['IDRPlafond'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasPlafond[]" id="ValasPlafond_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['ValasPlafond'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasPlafond[]" value="<?= $values['ValasPlafond'] ?>"></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <?php if ($BankFacilityGroupId == 1 || $BankFacilityGroupId == 2) { ?>
                            <th>Baki Debet</th>
                            <?php } else { ?>
                            <th>Outstanding</th>
                            <?php } ?>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDROutstanding[]" id="IDROutstanding_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['IDROutstanding'] ?>" style="text-align: right;"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasOutstanding[]" id="ValasOutstanding_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['ValasOutstanding'] ?>" style="text-align: right;"></td>
                          </tr>
                        </tbody>
                        <?php }?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Ratas Harian</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRDailyRatas[]" id="IDRDailyRatas_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['IDRDailyRatas'] ?>" style="text-align: right;"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasDailyRatas[]" id="ValasDailyRatas_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['ValasDailyRatas'] ?>" style="text-align: right;"></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Tenor</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRTenor[]" id="IDRTenor_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 month" data-a-sep="," value="<?= $values['IDRTenor'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">Bulan</label></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasTenor[]" id="ValasTenor_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 month" data-a-sep="," value="<?= $values['ValasTenor'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">Bulan</label></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Indicative Rate</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRIndicativeRate[]" id="IDRIndicativeRate_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values['IDRIndicativeRate'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasIndicativeRate[]" id="ValasIndicativeRate_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values['ValasIndicativeRate'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <?php if ($BankFacilityGroupId == 3) { ?>
                            <th>Pendapatan FTP</th>
                            <?php } else { ?>
                            <th>Income / Expense</th>
                            <?php } ?>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRIncomeExpense[]" id="IDRIncomeExpense_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['IDRIncomeExpense'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" id="IDRIncomeExpense_hidden_<?= $values['BankFacilityItemId'] ?>" name="IDRIncomeExpense[]" value="<?= $values['IDRIncomeExpense'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasIncomeExpense[]" id="ValasIncomeExpense_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['ValasIncomeExpense'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" id="ValasIncomeExpense_hidden_<?= $values['BankFacilityItemId'] ?>" name="ValasIncomeExpense[]" value="<?= $values['ValasIncomeExpense'] ?>"></td>
                          </tr>
                        </tbody>
                        <?php if ($BankFacilityGroupId != 3) { ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Provision Rate</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRProvisionRate[]" id="IDRProvisionRate_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values['IDRProvisionRate'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasProvisionRate[]" id="ValasProvisionRate_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values['ValasProvisionRate'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Provision</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRProvision[]" id="IDRProvision_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['IDRProvision'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" id="IDRProvision_hidden_<?= $values['BankFacilityItemId'] ?>" name="IDRProvision[]" value="<?= $values['IDRProvision'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasProvision[]" id="ValasProvision_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values['ValasProvision'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" id="ValasProvision_hidden_<?= $values['BankFacilityItemId'] ?>" name="ValasProvision[]" value="<?= $values['ValasProvision'] ?>"></td>
                          </tr>
                        </tbody>
                        <?php } ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Fee</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRFee[]" id="IDRFee_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['IDRFee'] ?>" style="text-align: right;"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasFee[]" id="ValasFee_<?= $values['BankFacilityItemId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values['ValasFee'] ?>" style="text-align: right;"></td>
                          </tr>
                        </tbody>
                          <tr>
                            <td colspan="4" height="30">
                              <input type="hidden" name="BankFacilityItemId[]" value="<?= $values['BankFacilityItemId']; ?>">
                              <input type="hidden" name="CreditSimulationId[]" value="<?=$values['CreditSimulationId']?>">
                            </td>
                          </tr>
                      </table>
                    </div>
                  </div>
                <?php endforeach; ?>
                <?php } ?>

                <?php if (!empty($inputform[$BankFacilityGroupType.'_addition'])) {?>
                <?php foreach ($inputform[$BankFacilityGroupType.'_addition'] as $rows => $values_addition) : ?>
                  <div class="x_panel">
                    <div class="x_title collapse-link" style="padding: 0;">
                      <!-- <i class="fa fa-chevron-up" style="color:#218FD8;"></i> -->
                      <label style="color:#218FD8;"><?= $values_addition['BankFacilityItemAdditionName'] ?></label>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table width="100%" style="color: #00000; font-size: 13px;">
                        <?php if ($BankFacilityGroupId == 3) { ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Outstanding / Saldo</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRPlafondAddition[]" id="IDRPlafondAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['IDRPlafondAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRPlafondAddition[]" value="<?= $values_addition['IDRPlafondAddition'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasPlafondAddition[]" id="ValasPlafondAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['ValasPlafondAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasPlafondAddition[]" value="<?= $values_addition['ValasPlafondAddition'] ?>"></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Beban Bunga</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRBebanBungaAddition[]" id="IDRBebanBungaAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['IDRBebanBungaAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRBebanBungaAddition[]" id="IDRBebanBungaAddition_hidden_<?= $values_addition['BankFacilityItemAdditionId'] ?>" value="<?= $values_addition['IDRBebanBungaAddition'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasBebanBungaAddition[]" id="ValasBebanBungaAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['ValasBebanBungaAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasBebanBungaAddition[]" id="ValasBebanBungaAddition_hidden_<?= $values_addition['BankFacilityItemAdditionId'] ?>" value="<?= $values_addition['ValasBebanBungaAddition'] ?>"></td>
                          </tr>
                        </tbody>
                        <?php } else { ?>
                          <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Plafond</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRPlafondAddition[]" id="IDRPlafondAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['IDRPlafondAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRPlafondAddition[]" value="<?= $values_addition['IDRPlafondAddition'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasPlafondAddition[]" id="ValasPlafondAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['ValasPlafondAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasPlafondAddition[]" value="<?= $values_addition['ValasPlafondAddition'] ?>"></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Baki Debet</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDROutstandingAddition[]" id="IDROutstandingAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values_addition['IDROutstandingAddition'] ?>" style="text-align: right;"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasOutstandingAddition[]" id="ValasOutstandingAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values_addition['ValasOutstandingAddition'] ?>" style="text-align: right;"></td>
                          </tr>
                        </tbody>
                        <?php } ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Ratas Harian</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRDailyRatasAddition[]" id="IDRDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values_addition['IDRDailyRatasAddition'] ?>" style="text-align: right;"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasDailyRatasAddition[]" id="ValasDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values_addition['ValasDailyRatasAddition'] ?>" style="text-align: right;"></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Tenor</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRTenorAddition[]" id="IDRTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 month" data-a-sep="," value="<?= $values_addition['IDRTenorAddition'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">Bulan</label></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasTenorAddition[]" id="ValasTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 month" data-a-sep="," value="<?= $values_addition['ValasTenorAddition'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">Bulan</label></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Indicative Rate</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRIndicativeRateAddition[]" id="IDRIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values_addition['IDRIndicativeRateAddition'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasIndicativeRateAddition[]" id="ValasIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values_addition['ValasIndicativeRateAddition'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <?php if ($BankFacilityGroupId == 3) { ?>
                            <th>Pendapatan FTP</th>
                            <?php } else { ?>
                            <th>Income / Expense</th>
                            <?php } ?>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRIncomeExpenseAddition[]" id="IDRIncomeExpenseAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['IDRIncomeExpenseAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" id="IDRIncomeExpenseAddition_hidden_<?= $values_addition['BankFacilityItemAdditionId'] ?>" name="IDRIncomeExpenseAddition[]" value="<?= $values_addition['IDRIncomeExpenseAddition'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasIncomeExpenseAddition[]" id="ValasIncomeExpenseAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['ValasIncomeExpenseAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" id="ValasIncomeExpenseAddition_hidden_<?= $values_addition['BankFacilityItemAdditionId'] ?>" name="ValasIncomeExpenseAddition[]" value="<?= $values_addition['ValasIncomeExpenseAddition'] ?>"></td>
                          </tr>
                        </tbody>
                        <?php if ($BankFacilityGroupId != 3) { ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Provision Rate</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRProvisionRateAddition[]" id="IDRProvisionRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values_addition['IDRProvisionRateAddition'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasProvisionRateAddition[]" id="ValasProvisionRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 portion" data-a-sep="," value="<?= $values_addition['ValasProvisionRateAddition'] ?>" style="text-align: right; width: 50%;"><label class="control-label col-md-5 col-xs-12" style="text-align: left;">%</label></td>
                          </tr>
                        </tbody>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Provision</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRProvisionAddition[]" id="IDRProvisionAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['IDRProvisionAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="IDRProvisionAddition[]" id="IDRProvisionAddition_hidden_<?= $values_addition['BankFacilityItemAdditionId'] ?>"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasProvisionAddition[]" id="ValasProvisionAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 total" data-a-sep="," value="<?= $values_addition['ValasProvisionAddition'] ?>" style="text-align: right;" disabled>
                              <input type="hidden" name="ValasProvisionAddition[]" id="ValasProvisionAddition_hidden_<?= $values_addition['BankFacilityItemAdditionId'] ?>"></td>
                          </tr>
                        </tbody>
                        <?php } ?>
                        <thead style="background-color: #FFFFFF; color: #218FD8;" >
                          <tr>
                            <th style="width: 2%"></th>
                            <th style="width: 17%"></th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">IDR :</th>
                            <th style="width: 40%; padding-right: 20px; padding-left: 20px; padding-bottom: 5px; padding-top: 20px;">Valas :</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <th>Fee</th>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="IDRFeeAddition[]" id="IDRFeeAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values_addition['IDRFeeAddition'] ?>" style="text-align: right;"></td>
                            <td style="padding-right: 20px; padding-left: 20px;"><input type="text" name="ValasFeeAddition[]" id="ValasFeeAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>" class="form-control col-md-7 col-xs-12 money" data-a-sep="," value="<?= $values_addition['ValasFeeAddition'] ?>" style="text-align: right;"></td>
                          </tr>
                          <tr>
                            <td colspan="4" height="30">
                              <input type="hidden" name="BankFacilityItemAdditionId[]" value="<?= $values_addition['BankFacilityItemAdditionId']; ?>">
                              <input type="hidden" name="CreditSimulationAdditionId[]" value="<?=$values_addition['CreditSimulationAdditionId']?>">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php endforeach; ?>
                <?php } ?>
                      <input type="hidden" name="AccountPlanningId" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                      <input type="hidden" name="CreditSimulationSubmit" value="<?= $CreditSimulationSubmit; ?>">
                      <input type="hidden" name="CreditSimulationSubmitAddition" value="<?= $CreditSimulationSubmitAddition; ?>">
                      <input type="hidden" name="InputTable" value="CreditSimulation">
                      <input type="hidden" name="InputTableAddition" value="CreditSimulationAddition">
              </div>

              <div class="row form_action">
                <div class="form-group pull-right">
                  <div class="col-xs-12">
                    <button class="btn w150 btn-sm btn-default btn_cancel" type="button" onclick="window.location.href='<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/simulation');?>'">BACK</button>
                    <!-- <button class="btn btn-sm btn-primary btn_save" type="submit" style="width: 200px;">SAVE</button> -->
                    <button class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right: 0px;" onclick="confirmModal(); return false;">SAVE</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">You're about to saved Credit Simulation details. <br>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }

  function setZero(ItemName, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    var Currency = Currency;
    if ($('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('get') == '') {
      $('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('set', 0);
    }
  }

  function removeZero(ItemName, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    var Currency = Currency;
    if ($('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('get') == 0) {
      $('#' + Currency + ItemName + aItemType + aItemId).autoNumeric('set', '');
    }
  }

  function calculateBebanBunga(Tenor, DailyRatas, IndicativeRate, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    var Currency = Currency;

    if (Tenor < 12) {
      aTenor = Tenor / 12;
    } else if (Tenor >= 12) {
      aTenor = 1;
    } else {
      aTenor = 0;
    }

    if (DailyRatas > 0) {
      aDailyRatas = DailyRatas;
    } else {
      aDailyRatas = 0;
    }

    if (IndicativeRate > 0) {
      aIndicativeRate = IndicativeRate;
    } else {
      aIndicativeRate = 0;
    }

    aBebanBunga = aDailyRatas / 100;
    bBebanBunga = aBebanBunga * aIndicativeRate;
    cBebanBunga = bBebanBunga * aTenor;

    $('#' + Currency + 'BebanBunga' + aItemType + aItemId).autoNumeric('set',cBebanBunga);
    $('#' + Currency + 'BebanBunga' + aItemType + '_hidden' + aItemId).val(cBebanBunga);
  }

  function calculateIncomeExpense(Tenor, DailyRatas, IndicativeRate, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    var Currency = Currency;

    if (Tenor < 12) {
      aTenor = Tenor / 12;
    } else if (Tenor >= 12) {
      aTenor = 1;
    } else {
      aTenor = 0;
    }

    if (DailyRatas > 0) {
      aDailyRatas = DailyRatas;
    } else {
      aDailyRatas = 0;
    }

    if (IndicativeRate > 0) {
      aIndicativeRate = IndicativeRate;
    } else {
      aIndicativeRate = 0;
    }

    aIncomeExpense = aDailyRatas / 100;
    bIncomeExpense = aIncomeExpense * aIndicativeRate;
    cIncomeExpense = bIncomeExpense * aTenor;

    $('#' + Currency + 'IncomeExpense' + aItemType + aItemId).autoNumeric('set',cIncomeExpense);
    $('#' + Currency + 'IncomeExpense' + aItemType + '_hidden' + aItemId).val(cIncomeExpense);
  }

  function calculateProvision(Plafond, ProvisionRate, ItemId, ItemType, Currency) {
    var aItemId = '_' + ItemId;
    var aItemType = '';
    if (ItemType == 'Addition') {
      var aItemType = 'Addition';
    }
    var Currency = Currency;

    if (Plafond > 0) {
      aPlafond = Plafond;
    } else {
      aPlafond = 0;
    }

    if (ProvisionRate > 0) {
      aProvisionRate = ProvisionRate;
    } else {
      aProvisionRate = 0;
    }

    aProvision = aPlafond / 100;
    bProvision = aProvision * aProvisionRate;

    $('#' + Currency + 'Provision' + aItemType + aItemId).autoNumeric('set',bProvision);
    $('#' + Currency + 'Provision' + aItemType + '_hidden' + aItemId).val(bProvision);
  }

// start ready function
  $(document).ready(function() {

    $('.total').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '<?=MAX_NUMERIC_TOTAL?>',
      vMin: '<?=MIN_NUMERIC_TOTAL?>',
      unformatOnSubmit: true,
      aPad: false,
    });

    $('.money').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      // vMax: '999999999999999999999999',
      vMax: '<?=MAX_NUMERIC?>',
      vMin: '<?=MIN_NUMERIC?>',
      unformatOnSubmit: true
    });
    $('.portion').autoNumeric('init',{
      aForm: true,
      mDec: '2',
      vMax: '99',
      unformatOnSubmit: true
    });
    $('.month').autoNumeric('init',{
      aForm: true,
      mDec: '0',
      vMax: '1000',
      unformatOnSubmit: true
    });

    // $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').on('submit', function (e) {
    //   e.preventDefault();
    //   if(confirm('Your\'e about to saved Input Credit Simulation details. \nAre you sure?')) {
    $('#OK').click(function(){
        $.ajax({
          type: 'post',
          url : $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').attr('action'),
          data: $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').serialize(),
          dataType : 'json',
          beforeSend:function(){
            $('#confirmModal').hide();
            $('.loaderImage').show();
          },
          error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
            $('.loaderImage').hide();
            new PNotify({
                title: 'Error!',
                text: "Message : "+errorThrown,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
          },
          success: function(response){
            console.log(response);
            if(response.status === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Data Saved',
                  type: 'success',
                  styling: 'bootstrap3'
              });
              
              PNotify.prototype.options.delay = 3000;
              
              setTimeout(function(){ 
                window.location.href= base_url+'tasklist/AccountPlanning<?=$isCST?>/view/<?= $AccountPlanningId; ?>/input/<?= $AccountPlanningTab; ?>';
                $('.loaderImage').hide();
              }, 2000);
            }
            else if(response.status === 'error'){
              $('.modal-backdrop.in').hide();
              $('.loaderImage').hide();
              new PNotify({
                  title: 'Response Error!',
                  text: response.message,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 3000;
              setTimeout(function(){
                window.location.reload();
              }, 2000);
            }          
          }
        });
      // }
    });

<?php if (!empty($inputform[$BankFacilityGroupType])) {?>
<?php foreach ($inputform[$BankFacilityGroupType] as $rows => $values) : ?>

    $('#IDROutstanding_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('Outstanding', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDROutstanding_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('Outstanding', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#ValasOutstanding_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('Outstanding', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasOutstanding_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('Outstanding', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });

    $('#IDRFee_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('Fee', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRFee_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('Fee', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#ValasFee_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('Fee', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasFee_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('Fee', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });

    $('#IDRDailyRatas_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('DailyRatas', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRDailyRatas_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('DailyRatas', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      var aIDRTenor = Number($('#IDRTenor_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRDailyRatas = Number($('#IDRDailyRatas_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRIndicativeRate = Number($('#IDRIndicativeRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRFTPSimpanan = Number(<?= $values['IDRFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aIDRTenor, aIDRDailyRatas, aIDRFTPSimpanan, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
        calculateBebanBunga(aIDRTenor, aIDRDailyRatas, aIDRIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      <?php } else { ?>
        calculateIncomeExpense(aIDRTenor, aIDRDailyRatas, aIDRIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      <?php } ?>
    });

    $('#IDRIndicativeRate_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('IndicativeRate', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRIndicativeRate_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('IndicativeRate', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      var aIDRTenor = Number($('#IDRTenor_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRDailyRatas = Number($('#IDRDailyRatas_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRIndicativeRate = Number($('#IDRIndicativeRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRFTPSimpanan = Number(<?= $values['IDRFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateBebanBunga(aIDRTenor, aIDRDailyRatas, aIDRIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      <?php } else { ?>
        calculateIncomeExpense(aIDRTenor, aIDRDailyRatas, aIDRIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      <?php } ?>
    });

    $('#IDRTenor_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('Tenor', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRTenor_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('Tenor', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      var aIDRTenor = Number($('#IDRTenor_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRDailyRatas = Number($('#IDRDailyRatas_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRIndicativeRate = Number($('#IDRIndicativeRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRFTPSimpanan = Number(<?= $values['IDRFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aIDRTenor, aIDRDailyRatas, aIDRFTPSimpanan, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
        calculateBebanBunga(aIDRTenor, aIDRDailyRatas, aIDRIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      <?php } else { ?>
        calculateIncomeExpense(aIDRTenor, aIDRDailyRatas, aIDRIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      <?php } ?>
    });

    $('#ValasDailyRatas_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('DailyRatas', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasDailyRatas_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('DailyRatas', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      var aValasTenor = Number($('#ValasTenor_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasDailyRatas = Number($('#ValasDailyRatas_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasIndicativeRate = Number($('#ValasIndicativeRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasFTPSimpanan = Number(<?= $values['ValasFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aValasTenor, aValasDailyRatas, aValasFTPSimpanan, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
        calculateBebanBunga(aValasTenor, aValasDailyRatas, aValasIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      <?php } else { ?>
        calculateIncomeExpense(aValasTenor, aValasDailyRatas, aValasIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      <?php } ?>
    });

    $('#ValasIndicativeRate_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('IndicativeRate', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasIndicativeRate_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('IndicativeRate', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      var aValasTenor = Number($('#ValasTenor_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasDailyRatas = Number($('#ValasDailyRatas_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasIndicativeRate = Number($('#ValasIndicativeRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasFTPSimpanan = Number(<?= $values['ValasFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateBebanBunga(aValasTenor, aValasDailyRatas, aValasIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      <?php } else { ?>
        calculateIncomeExpense(aValasTenor, aValasDailyRatas, aValasIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      <?php } ?>
    });

    $('#ValasTenor_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('Tenor', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasTenor_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('Tenor', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      var aValasTenor = Number($('#ValasTenor_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasDailyRatas = Number($('#ValasDailyRatas_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasIndicativeRate = Number($('#ValasIndicativeRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasFTPSimpanan = Number(<?= $values['ValasFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aValasTenor, aValasDailyRatas, aValasFTPSimpanan, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
        calculateBebanBunga(aValasTenor, aValasDailyRatas, aValasIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      <?php } else { ?>
        calculateIncomeExpense(aValasTenor, aValasDailyRatas, aValasIndicativeRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      <?php } ?>
    });

    $('#IDRProvisionRate_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('ProvisionRate', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });
    $('#IDRProvisionRate_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('ProvisionRate', <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
      var aIDRPlafond = Number($('#IDRPlafond_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aIDRProvisionRate = Number($('#IDRProvisionRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

      calculateProvision(aIDRPlafond, aIDRProvisionRate, <?= $values['BankFacilityItemId'] ?>, '', 'IDR');
    });

    $('#ValasProvisionRate_<?= $values['BankFacilityItemId'] ?>').on('focus', function() {
      removeZero('ProvisionRate', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
    $('#ValasProvisionRate_<?= $values['BankFacilityItemId'] ?>').on('blur', function() {
      setZero('ProvisionRate', <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
      var aValasPlafond = Number($('#ValasPlafond_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));
      var aValasProvisionRate = Number($('#ValasProvisionRate_<?= $values['BankFacilityItemId'] ?>').autoNumeric("get"));

      calculateProvision(aValasPlafond, aValasProvisionRate, <?= $values['BankFacilityItemId'] ?>, '', 'Valas');
    });
<?php endforeach; ?>
<?php } ?>
<?php if (!empty($inputform[$BankFacilityGroupType.'_addition'])) {?>
<?php foreach ($inputform[$BankFacilityGroupType.'_addition'] as $rows => $values_addition) : ?>

    $('#IDROutstandingAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
      removeZero('Outstanding', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'IDR');
    });
    $('#IDROutstandingAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      setZero('Outstanding', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'IDR');
    });
    $('#ValasOutstandingAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
      removeZero('Outstanding', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'Valas');
    });
    $('#ValasOutstandingAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      setZero('Outstanding', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'Valas');
    });

    $('#IDRFeeAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
      removeZero('Fee', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'IDR');
    });
    $('#IDRFeeAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      setZero('Fee', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'IDR');
    });
    $('#ValasFeeAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('focus', function() {
      removeZero('Fee', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'Valas');
    });
    $('#ValasFeeAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      setZero('Fee', <?= $values_addition['BankFacilityItemAdditionId'] ?>, '', 'Valas');
    });

    $('#IDRDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aIDRTenorAddition = Number($('#IDRTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRDailyRatasAddition = Number($('#IDRDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRIndicativeRateAddition = Number($('#IDRIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRFTPSimpananAddition = Number(<?= $values['IDRFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRFTPSimpananAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
        calculateBebanBunga(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
      <?php } else { ?>
        calculateIncomeExpense(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
      <?php } ?>
    });

    $('#IDRIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aIDRTenorAddition = Number($('#IDRTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRDailyRatasAddition = Number($('#IDRDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRIndicativeRateAddition = Number($('#IDRIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRFTPSimpananAddition = Number(<?= $values['IDRFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateBebanBunga(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
      <?php } else { ?>
        calculateIncomeExpense(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
      <?php } ?>
    });

    $('#IDRTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aIDRTenorAddition = Number($('#IDRTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRDailyRatasAddition = Number($('#IDRDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRIndicativeRateAddition = Number($('#IDRIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRFTPSimpananAddition = Number(<?= $values['IDRFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRFTPSimpananAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
        calculateBebanBunga(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
      <?php } else { ?>
        calculateIncomeExpense(aIDRTenorAddition, aIDRDailyRatasAddition, aIDRIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
      <?php } ?>
    });

    $('#ValasDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aValasTenorAddition = Number($('#ValasTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasDailyRatasAddition = Number($('#ValasDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasIndicativeRateAddition = Number($('#ValasIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasFTPSimpananAddition = Number(<?= $values['ValasFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aValasTenorAddition, aValasDailyRatasAddition, aValasFTPSimpananAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
        calculateBebanBunga(aValasTenorAddition, aValasDailyRatasAddition, aValasIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
      <?php } else { ?>
        calculateIncomeExpense(aValasTenorAddition, aValasDailyRatasAddition, aValasIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
      <?php } ?>
    });

    $('#ValasIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aValasTenorAddition = Number($('#ValasTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasDailyRatasAddition = Number($('#ValasDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasIndicativeRateAddition = Number($('#ValasIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasFTPSimpananAddition = Number(<?= $values['ValasFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateBebanBunga(aValasTenorAddition, aValasDailyRatasAddition, aValasIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
      <?php } else { ?>
        calculateIncomeExpense(aValasTenorAddition, aValasDailyRatasAddition, aValasIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
      <?php } ?>
    });

    $('#ValasTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aValasTenorAddition = Number($('#ValasTenorAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasDailyRatasAddition = Number($('#ValasDailyRatasAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasIndicativeRateAddition = Number($('#ValasIndicativeRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasFTPSimpananAddition = Number(<?= $values['ValasFTPSimpanan'] ?>);

      <?php if ($BankFacilityGroupId == 3) { ?>
        calculateIncomeExpense(aValasTenorAddition, aValasDailyRatasAddition, aValasFTPSimpananAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
        calculateBebanBunga(aValasTenorAddition, aValasDailyRatasAddition, aValasIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
      <?php } else { ?>
        calculateIncomeExpense(aValasTenorAddition, aValasDailyRatasAddition, aValasIndicativeRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
      <?php } ?>
    });

    $('#IDRProvisionRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aIDRPlafondAddition = Number($('#IDRPlafondAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aIDRProvisionRateAddition = Number($('#IDRProvisionRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

      calculateProvision(aIDRPlafondAddition, aIDRProvisionRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'IDR');
    });

    $('#ValasProvisionRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').on('blur', function() {
      var aValasPlafondAddition = Number($('#ValasPlafondAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));
      var aValasProvisionRateAddition = Number($('#ValasProvisionRateAddition_<?= $values_addition['BankFacilityItemAdditionId'] ?>').autoNumeric("get"));

      calculateProvision(aValasPlafondAddition, aValasProvisionRateAddition, <?= $values_addition['BankFacilityItemAdditionId'] ?>, 'Addition', 'Valas');
    });
<?php endforeach; ?>
<?php } ?>

  });
// end ready function
</script>
