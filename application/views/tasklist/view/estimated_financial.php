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
  .nav-tabss>li>a {
    background: #FFFFFF;
    border-radius: 4px;
    color: #707070;
    border: 1px solid #ddd;
    font-size: 14px;
    padding: 20px;
  }
  .nav-tabss>li.active>a, .nav-tabss>li.active>a:focus {
    background: #218FD8;
    border-radius: 4px;
    color: #FFFFFF;
    border: 1px solid #ddd;
    font-size: 14px;
    padding: 20px;
  }
</style>

<!-- <div class="x_title detail_section_header_con">
  <h5 class="detail_section_title">Action Plans</h5>
</div> -->
<div class="detail_section_con" id="action_plans_tabContent">
  <div class="col-xs-2" style="padding: 0;">
    <!-- required for floating -->
    <!-- Nav tabs -->
    <ul id="action_plans_tab" class="nav nav-tabss tabs-left">
      <li class="active"><a href="#estimated_financial" data-toggle="tab" id="estimated_financial-tabContent" tab_panel_type="<?=$AccountPlanningTabType?>" AccountPlanningId="<?= $AccountPlanningId ?>">Estimated Financial</a>
      </li>
      <li class=""><a href="#initiatives_action" data-toggle="tab" id="initiatives_action-tabContent" tab_panel_type="<?=$AccountPlanningTabType?>" AccountPlanningId="<?= $AccountPlanningId ?>">Initiatives & Action Plan</a>
      </li>
    </ul>
  </div>

  <div class="col-xs-10">
    <!-- Tab panes -->

      <div class="row" style="padding-top: 3px; border-radius: 4px;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 0;">
              <div class="accordion" id="accordion_EstimatedFinancial" role="tablist" aria-multiselectable="true">
                <?php foreach ($account_planning['EstimatedFinancial'] as $row => $value) : ?>
                  <div class="panel">
                    <a class="panel-heading<?=$value[0]['heading_panel']?>" role="tab" id="headingEstimatedFinancial<?=$value[0]['BankFacilityGroupId']?>" data-toggle="collapse" data-parent="#accordion_EstimatedFinancial" href="#collapseEstimatedFinancial<?=$value[0]['BankFacilityGroupId']?>" aria-expanded="<?=$value[0]['expanded_panel']?>" aria-controls="collapseEstimatedFinancial<?=$value[0]['BankFacilityGroupId']?>" style="border-bottom: 1px solid #ddd;">
                      <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> <?=$value[0]['BankFacilityGroupName']?></h4>
                    </a>
                    <div id="collapseEstimatedFinancial<?=$value[0]['BankFacilityGroupId']?>" class="panel-collapse<?=$value[0]['tab_panel']?>" role="tabpanel" aria-labelledby="headingEstimatedFinancial<?=$value[0]['BankFacilityGroupId']?>">
                      <div class="panel-body" style="padding: 0px;">
                      <?php if (isset($account_planning_vcif_list)) {?>
                        <?php foreach ($account_planning_vcif_list as $rowss => $valuess) : ?>
                          <div class="x_panel row content_container shadow_content_container">
                            <div class="x_title row collapse-link" style="padding:0; margin:0;">
                                <div class="col-xs-12">
                                    <div class="col-xs-12" style="padding: 10px 15px 5px 10px; cursor: pointer;">
                                        <label class="label_title" style="font-size: 16px; cursor: pointer; color: #65B6F0;"><?= $valuess['Name'] ?></label>
                                        <div class="col-xs-3 pull-right">
                                          <?php 
                                            if ($AccountPlanningTabType == 'input') {
                                          ?>
                                          <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/action_plans/estimated_financial/'.$value[0]['BankFacilityGroupId'].'/'.$valuess['VCIF']); ?>'">
                                              <?php
                                                  $button_icon  = 'add';
                                                  $button_label = 'Add Data';
                                                   if (isset($valuess['VCIF'])) {
                                                      $button_icon  = 'edit';
                                                      $button_label = 'Edit Data';
                                                  } 
                                              ?>
                                              <i class="material-icons"><?= $button_icon; ?></i>
                                              <label><?= $button_label; ?></label>
                                          </div>
                                          <?php 
                                            }
                                          ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="x_content">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                  Notes : 
                                  <!-- <br> -->
                                  <span class="detail_property_titles2"><?=View_Notes1?></span>
                                </div>
                                <table width="100%" class="table" cellpadding="20" cellspacing="20" style="font-size: 12px;">
                                  <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                    <tr class="modal_table_title">
                                      <td style="text-align: left; width: 20%;">Facilities</td>
                                      <td style="text-align: left; width: 10%;">Currency</td>
                                      <td style="text-align: right; width: 20%;">Projection Customer</td>
                                      <td style="text-align: right; width: 20%;">Target BRI</td>
                                      <td style="text-align: center; width: 30%;">Portion</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                <?php if (isset($value['EstimatedFinancial_detail'][$valuess['VCIF']])) { ?>
                                <?php foreach ($value['EstimatedFinancial_detail'][$valuess['VCIF']] as $rows => $EstimatedFinancial) : ?>
                                    <tr class="modal_table_title">
                                      <td rowspan="2" style="font-weight: bold;"><?=$EstimatedFinancial['BankFacilityItemName']?></td>
                                      <td style="text-align: left; font-weight: bold;">IDR</td>
                                      <td style="text-align: right;"><?=$EstimatedFinancial['IDRProjection']?></td>
                                      <td style="text-align: right;"><?=$EstimatedFinancial['IDRTarget']?></td>
                                      <td style="text-align: left;">
                                        <div class="progress" style="height: 20px; width: 100%;">
                                          <div class="progress-bar" data-transitiongoal="<?=$EstimatedFinancial['IDRProgressBar']?>" style="background-color: #218FD8;" title="<?=$EstimatedFinancial['IDRProgressValue']?> %"><?=$EstimatedFinancial['IDRProgressValue']?> %</div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr class="modal_table_title">
                                      <td style="text-align: left; font-weight: bold;">Valas</td>
                                      <td style="text-align: right;"><?=$EstimatedFinancial['ValasProjection']?></td>
                                      <td style="text-align: right;"><?=$EstimatedFinancial['ValasTarget']?></td>
                                      <td style="text-align: left;">
                                        <div class="progress" style="height: 20px; width: 100%;">
                                          <div class="progress-bar" data-transitiongoal="<?=$EstimatedFinancial['ValasProgressBar']?>" style="background-color: #218FD8;" title="<?=$EstimatedFinancial['ValasProgressValue']?> %"><?=$EstimatedFinancial['ValasProgressValue']?> %</div>
                                        </div>
                                      </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php } ?>
                                 <?php if (isset($value['EstimatedFinancialAddition_detail'][$valuess['VCIF']])) { ?>
                                <?php foreach ($value['EstimatedFinancialAddition_detail'][$valuess['VCIF']] as $rows => $EstimatedFinancialAddition) : ?>
                                    <tr class="modal_table_title">
                                      <td rowspan="2" style="font-weight: bold;"><?=$EstimatedFinancialAddition['BankFacilityItemAdditionName']?></td>
                                      <td style="text-align: left;" style="font-weight: bold;">IDR</td>
                                      <td style="text-align: right;"><?=$EstimatedFinancialAddition['IDRProjectionAddition']?></td>
                                      <td style="text-align: right;"><?=$EstimatedFinancialAddition['IDRTargetAddition']?></td>
                                      <td style="text-align: left;">
                                        <div class="progress" style="height: 20px; width: 100%;">
                                          <div class="progress-bar" data-transitiongoal="<?=$EstimatedFinancialAddition['IDRProgressAdditionBar']?>" style="background-color: #218FD8;" title="<?=$EstimatedFinancialAddition['IDRProgressAdditionBar']?> %"><?=$EstimatedFinancialAddition['IDRProgressAdditionValue']?> %</div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr class="modal_table_title">
                                      <td style="text-align: left;" style="font-weight: bold;">Valas</td>
                                      <td style="text-align: right;"><?=$EstimatedFinancialAddition['ValasProjectionAddition']?></td>
                                      <td style="text-align: right;"><?=$EstimatedFinancialAddition['ValasTargetAddition']?></td>
                                      <td style="text-align: left;">
                                        <div class="progress" style="height: 20px; width: 100%;">
                                          <div class="progress-bar" data-transitiongoal="<?=$EstimatedFinancialAddition['ValasProgressAdditionBar']?>" style="background-color: #218FD8;" title="<?=$EstimatedFinancialAddition['ValasProgressAdditionBar']?> %"><?=$EstimatedFinancialAddition['ValasProgressAdditionValue']?> %</div>
                                        </div>
                                      </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
        </div>
      </div>

  </div>
</div>

<!-- Chart.js -->
<!-- <script src="<?=base_url();?>template/vendors/Chart.js/dist/Chart.PieceLabel.min.js"></script> -->
<script src="<?=base_url();?>template/vendors/Chart.js/dist/Chart.min.js"></script>


<script type="text/javascript">
  // Progressbar
  if ($(".progress .progress-bar")[0]) {
      $('.progress .progress-bar').progressbar();
  }
  // /Progressbar

  // Panel toolbox
  $(document).ready(function() {

    // estimated_financial
    $("#estimated_financial-tabContent").click(function(){

      var tab_target = $(this).attr('href');
      var tab_panel_type = $(this).attr('tab_panel_type');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $('#action_plans_tabContent').load("<?= base_url('tasklist/AccountPlanning/view_estimated_financial/')?>" + AccountPlanningId +"/" + tab_panel_type , function(responseTxt, statusTxt, xhr){
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

    // initiatives_action
    $("#initiatives_action-tabContent").click(function(){

      var tab_target = $(this).attr('href');
      var tab_panel_type = $(this).attr('tab_panel_type');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $('#action_plans_tabContent').load("<?= base_url('tasklist/AccountPlanning/view_initiatives_action/')?>" + AccountPlanningId +"/" + tab_panel_type , function(responseTxt, statusTxt, xhr){
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

    $('.collapse-link').on('click', function() {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');
        
        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200); 
            $BOX_PANEL.css('height', 'auto');  
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
  });
  // /Panel toolbox

</script>