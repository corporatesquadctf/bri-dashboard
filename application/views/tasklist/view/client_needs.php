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

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="accordion" id="accordion_Initiatives" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                          <a class="panel-heading" role="tab" id="headingInitiatives1" data-toggle="collapse" data-parent="#accordion_Initiatives" href="#collapseInitiatives1" aria-expanded="true" aria-controls="collapseInitiatives1" style="border-bottom: 1px solid #ddd;">
                            <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Fundings</h4>
                          </a>
                          <div id="collapseInitiatives1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingInitiatives1">
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
                                                <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/client_needs/fundings/0/'.$valuess['VCIF']); ?>'">
                                                    <?php
                                                        $button_icon  = 'add';
                                                        $button_label = 'Add Data';
                                                         if (isset($account_planning['Funding'][$valuess['VCIF']][0])) {
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
                                    <div class="x_content" style="margin-bottom: 10px;">
                                        <div class="col-md-12 col-sm-12 col-xs-12"  style="margin-bottom: 10px; padding-top: 0;">
                                            <div class="detail_property_title col-md-1 col-sm-1 col-xs-12" style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                No
                                            </div>
                                            <div class="detail_property_title col-md-3 col-sm-3 col-xs-12" style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Kebutuhan Pendanaan
                                            </div>
                                            <div class="detail_property_title col-md-2 col-sm-2 col-xs-12" style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Jangka Waktu
                                            </div>
                                            <div class="detail_property_title col-md-2 col-sm-2 col-xs-12" style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Nominal
                                            </div>
                                            <div class="detail_property_title col-md-3 col-sm-3 col-xs-12" style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Description
                                            </div>
                                        </div>
                                        <?php if (isset($account_planning['Funding'][$valuess['VCIF']])) {?>
                                        <?php $index_funding = 1; ?>
                                        <?php foreach ($account_planning['Funding'][$valuess['VCIF']] as $row => $value) : ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="detail_property_text col-md-1 col-sm-1 col-xs-12">
                                                <?= $index_funding ?>
                                            </div>
                                            <div class="detail_property_text col-md-3 col-sm-3 col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                <?=$value['FundingNeed']?>
                                            </div>
                                            <div class="detail_property_text col-md-2 col-sm-2 col-xs-12">
                                                <?=$value['TimePeriod']?> Bulan
                                            </div>
                                            <div class="detail_property_text col-md-2 col-sm-2 col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                Rp. <?=number_format($value['Amount'], 2)?>
                                            </div>
                                            <div class="detail_property_text col-md-3 col-sm-3 col-xs-12" style="word-break: break-word; word-wrap: break-word;">
                                                <?=$value['Description']?>
                                            </div>
                                        </div>
                                        <?php $index_funding++?>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                              <?php endforeach; ?>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margintop_con">
				<div class="col-md-12 col-sm-12 col-xs-12">    
                  <div class="accordion" id="accordion_Services" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                      <a class="panel-heading" role="tab" id="headingServices1" data-toggle="collapse" data-parent="#accordion_Services" href="#collapseServices1" aria-expanded="true" aria-controls="collapseServices1" style="border-bottom: 1px solid #ddd;">
                        <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Services</h4>
                      </a>
                      <div id="collapseServices1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingServices1">
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
                                                <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/client_needs/services/0/'.$valuess['VCIF']); ?>'">
                                                    <?php
                                                        $button_icon  = 'add';
                                                        $button_label = 'Add Data';
                                                         if (isset($account_planning['Service'][$valuess['VCIF']][0])) {
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
                                    <div class="x_content" style="margin-bottom: 10px;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-weight: bold; padding-bottom: 10px;">
                                            <div class="detail_property_title col-md-1 col-sm-1 col-xs-12 " style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                No
                                            </div>
                                            <div class="detail_property_title col-md-4 col-sm-4 col-xs-12 " style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Service Name
                                            </div>
                                            <div class="detail_property_title col-md-2 col-sm-2 col-xs-12 " style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Service Target
                                            </div>
                                            <div class="detail_property_title col-md-4 col-sm-4 col-xs-12 " style="color: #4BB8FF; font-weight: bold; font-weight: 13px;">
                                                Service Description
                                            </div>
                                        </div>
                                        <?php if (isset($account_planning['Service'][$valuess['VCIF']])) {?>
                                        <?php $index_service = 1; ?>
                                        <?php foreach ($account_planning['Service'][$valuess['VCIF']] as $row => $value) : ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="detail_property_text col-md-1 col-sm-1 col-xs-12 ">
                                                <?= $index_service ?>
                                            </div>
                                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-12 " style="word-break: break-word; word-wrap: break-word;">
                                                <?=$value['ServiceName']?>
                                            </div>
                                            <div class="detail_property_text col-md-2 col-sm-2 col-xs-12 ">
                                                <?=$value['ServiceTarget']?> Bulan
                                            </div>
                                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-12 " style="word-break: break-word; word-wrap: break-word;">
                                                <?=$value['ServiceDescription']?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 0;">
                                            <div class="detail_property_text col-md-1 col-sm-1 col-xs-12">
                                            </div>
                                            <div class="detail_property_text col-md-11 col-sm-11 col-xs-12 ">
                                                <?php if (isset($value['TagServiceUnitKerja'])) {?>
                                                <?php foreach ($value['TagServiceUnitKerja'] as $rows => $values) : ?>
                                                <label class="label label-info"># <?=$values['TagServiceUnitKerja']?></label>
                                                <?php endforeach; ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php $index_service++?>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                              <?php endforeach; ?>
                            <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row margintop_con">
            </div>

<script type="text/javascript">

// Panel toolbox
$(document).ready(function() {
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