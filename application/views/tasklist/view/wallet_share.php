<style type="text/css">
.detail_title {
  font-weight: 600;
  font-size: 14px;
  line-height: 136.89%;
  display: flex;
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
.detail_property_titles2 {
  font-weight: 600;
  font-size: 12px;
  line-height: 24px;
  letter-spacing: 0.5px;
  color: #F58C38;
}
</style>

                    <div class="row" style="padding-top: 3px; border-radius: 4px;">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 0;">
                        <div class="accordion" id="accordion_WalletShare" role="tablist" aria-multiselectable="true">
                            <?php foreach ($account_planning['WalletShare'] as $row => $value) : ?>
                            <div class="panel">
                              <a class="panel-heading<?=$value[0]['heading_panel']?>" role="tab" id="headingWalletShare<?=$value[0]['BankFacilityGroupId']?>" data-toggle="collapse" data-parent="#accordion_WalletShare" href="#collapseWalletShare<?=$value[0]['BankFacilityGroupId']?>" aria-expanded="<?=$value[0]['expanded_panel']?>" aria-controls="collapseWalletShare<?=$value[0]['BankFacilityGroupId']?>" style="border-bottom: 1px solid #ddd;">
                                <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> <?=$value[0]['BankFacilityGroupName']?></h4>
                              </a>
                              <div id="collapseWalletShare<?=$value[0]['BankFacilityGroupId']?>" class="panel-collapse<?=$value[0]['tab_panel']?>" role="tabpanel" aria-labelledby="headingWalletShare<?=$value[0]['BankFacilityGroupId']?>">
                                <div class="panel-body" style="padding: 0px;">
                                <?php if (isset($account_planning_vcif_list)) { ?>
                                  <?php foreach ($account_planning_vcif_list as $rowss => $valuess) : ?>
                                    <div class="x_panel row content_container shadow_content_container">
                                      <div class="x_title row collapse-link" style="padding:0 12px; margin:0;">
                                          <div class="col-xs-12">
                                              <div class="col-xs-12" style="padding: 10px 15px 5px 10px; cursor: pointer;">
                                                  <label class="label_title" style="font-size: 16px; cursor: pointer; color: #65B6F0;"><?= $valuess['Name'] ?></label>
                                                  <div class="col-xs-3 pull-right">
                                          <?php 
                                            if ($AccountPlanningTabType == 'input') {
                                          ?>
                                                    <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/bri_starting_position/wallet_share/'.$value[0]['BankFacilityGroupId'].'/'.$valuess['VCIF']); ?>'">
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
                                      <div class="x_content" style="padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                          <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0 0 0 32px;">
                                            Notes : 
                                            <span class="detail_property_titles2"><?=View_Notes1?></span>
                                          </div>
                                          <div class="col-xs-12" style="padding: 0 32px 15px 32px;">
                                            <table style="width: 100%;">
                                              <thead style="background: #FFFFFF; box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px;">
                                                <tr>
                                                    <th style="height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; width: 15%;">Facility</th>
                                                    <th style="height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; width: 20%;">Total</th>
                                                    <th style="height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; width: 20%;">BRI Nominal</th>
                                                    <th style="height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; width: 20%;">Other Bank Nominal</th>                                                    
                                                    <th style="height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; width: 25%;">BRI Portion</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php 
                                                  if(!empty($value['WalletShare_details'][$valuess['VCIF']])):
                                                  foreach ($value['WalletShare_details'][$valuess['VCIF']] as $rows => $WalletShare) :
                                                ?>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;"><?= $WalletShare['BankFacilityItemName']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShare['TotalAmount']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShare['BRINominal']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShare['OtherNominal']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;">
                                                    <div class="progress" style="height: 20px; width: 100%; margin-bottom: 0px;" title="<?= $WalletShare['BRIPortion']; ?> %">
                                                      <div class="progress-bar" data-transitiongoal="<?= $WalletShare['BRIPortion']; ?>" style="background-color: #218FD8;" title="<?= $WalletShare['BRIPortion']; ?> %"><span><?= $WalletShare['BRIPortion']; ?> %</span></div>
                                                    </div>
                                                  </td>                                                  
                                                </tr>
                                                <?php 
                                                  endforeach; 
                                                  endif;
                                                ?>
                                                <?php 
                                                  if(!empty($value['WalletShareAddition_detail'][$valuess['VCIF']])):
                                                  foreach ($value['WalletShareAddition_detail'][$valuess['VCIF']] as $rows => $WalletShareAddition) : 
                                                ?>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;"><?= $WalletShareAddition['BankFacilityItemAdditionName']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShareAddition['TotalAmountAddition']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShareAddition['BRINominalAddition']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;" class="money" data-a-sep=","><?= $WalletShareAddition['OtherNominalAddition']; ?></td>
                                                  <td style="background: #FFFFFF; min-height: 56px; color: #8F8F8F; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd;">
                                                    <div class="progress" style="height: 20px; width: 100%; margin-bottom: 0px;" title="<?= $WalletShareAddition['BRIPortionAddition']; ?> %">
                                                      <div class="progress-bar" data-transitiongoal="<?= $WalletShareAddition['BRIPortionAddition']; ?>" style="background-color: #218FD8;" title="<?= $WalletShareAddition['BRIPortionAddition']; ?> %"><span><?= $WalletShareAddition['BRIPortionAddition']; ?> %</span></div>
                                                    </div>
                                                  </td>                                                  
                                                </tr>
                                                <?php 
                                                  endforeach;
                                                  endif;
                                                ?>
                                              </tbody>
                                            </table>
                                          </div>
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

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  $(document).ready(function() {
  // Panel toolbox
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
    // Progressbar
    if ($(".progress .progress-bar")[0]) {
        $('.progress .progress-bar').progressbar();
    }
    // /Progressbar
  })

  function inputform(AccountPlanningId, AccountPlanningTab, BankFacilityGroupType, BankFacilityGroupId) {
    // alert('BankFacilityGroupId');
    $(document).ready(function() {
      $('.money').autoNumeric('init',{
        aForm: true,
            vMax: '999999999999999',
            mDec: '0',
            unformatOnSubmit: true
      });

      $('.modal-add-'+AccountPlanningTab+'-'+BankFacilityGroupType+'-'+BankFacilityGroupId).modal('show');
      var form = $('#add-'+AccountPlanningTab+'-'+BankFacilityGroupType);
      $(form).append('<input type="hidden" name="AccountPlanningId" value="'+AccountPlanningId+'" /> ');
    });
  }

</script>