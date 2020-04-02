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
  .div-disabled{
        display: inline-flex;
        margin: auto;
        color: #d4d4d4;
        float: right;
    }
    .div-disabled i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-disabled .fa-chevron-down:before {
        content: "none";
    }
    .div-disabled label{
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }
  .label-action{
      margin:0 !important; 
      padding-left:5px !important; 
      font-weight: normal !important;
  }
  .btn-data-option:not([disabled]):not(.disabled).load, .show>.btn-data-option.dropdown-toggle {
        background-color: #1c71ff!important;
    }

    .btn-data-option.load, .btn-data-option:focus {
        background-color: #1c71ff;
        color: white;
    }

    .btn-data-option {
        background-color: white;
        border-radius:10px;
        border:1px solid #d4d4d4;
        color: #d4d4d4;
    }
</style>
                    <div class="row" style="padding-top: 3px; border-radius: 4px;">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 0;">
                        <div class="accordion" id="accordion_FacilitiesBanking" role="tablist" aria-multiselectable="true">
                            <?php foreach ($account_planning['FacilitiesBanking'] as $row => $value) : ?>
                            <div class="panel">
                              <a class="panel-heading<?=$value[0]['heading_panel']?>" role="tab" id="headingFacilitiesBanking<?=$value[0]['BankFacilityGroupId']?>" data-toggle="collapse" data-parent="#accordion_FacilitiesBanking" href="#collapseFacilitiesBanking<?=$value[0]['BankFacilityGroupId']?>" aria-expanded="<?=$value[0]['expanded_panel']?>" aria-controls="collapseFacilitiesBanking<?=$value[0]['BankFacilityGroupId']?>" style="border-bottom: 1px solid #ddd;">
                                <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> <?=$value[0]['BankFacilityGroupName']?></h4>
                              </a>
                              <div id="collapseFacilitiesBanking<?=$value[0]['BankFacilityGroupId']?>" class="panel-collapse<?=$value[0]['tab_panel']?>" role="tabpanel" aria-labelledby="headingFacilitiesBanking<?=$value[0]['BankFacilityGroupId']?>">
                                <div class="panel-body" style="padding: 0px;">
                                  <?php if (isset($account_planning_vcif_list)) {?>
                                  <?php foreach ($account_planning_vcif_list as $rows => $valuess) : ?>
                                    <div class="x_panel row content_container shadow_content_container">
                                      <div class="x_title row collapse-link" style="padding:0; margin:0;">
                                          <div class="col-xs-12">
                                              <div class="col-xs-12" style="padding: 10px 15px 5px 10px; cursor: pointer;">
                                                  <label class="label_title" style="font-size: 16px; cursor: pointer; color: #65B6F0;"><?= $valuess['Name'] ?></label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="x_content">
                                        <div class="row col-sm-6 col-xs-12" style="width: 100%; padding: 0px 10px;">
                                          <?php 
                                            if ($AccountPlanningTabType == 'input') {
                                          ?>
                                          <div class="btn-group" data-toggle="buttons" style="padding-left: 20px; padding-bottom: 20px">
                                            <label class="btn btn-data-option form-check-label <?php if($value[0][$valuess['VCIF']]['DataSource']=='lastyear') echo 'load'; ?>" title="Last Year" id="btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>-lastyear">
                                              <i class="material-icons" style="font-size: 18px">history</i>
                                            </label>
                                            <label class="btn btn-data-option form-check-label <?php if($value[0][$valuess['VCIF']]['DataSource']=='datamart') echo 'load'; ?>" title="Data Mart" id="btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>-datamart">
                                              <i class="material-icons"  style="font-size: 18px">cloud_download</i>
                                            </label>
                                            <label class="btn btn-data-option form-check-label <?php if($value[0][$valuess['VCIF']]['DataSource']=='manual') echo 'load'; ?>" title="Manual Input" id="btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>-manual">
                                              <i class="material-icons" style="font-size: 18px">edit</i>
                                            </label>
                                          
                                          </div>
                                          <div class="col-sm-6 col-xs-12  pull-right">
                                              <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/bri_starting_position/facilities_banking/'.$value[0]['BankFacilityGroupId'].'/'.$valuess['VCIF']); ?>'">
                                                  <i class="material-icons">edit</i>
                                                  <label class="label-action">Edit Data</label>
                                              </div>
                                          </div>
                                          <!-- Modal -->
    <div class="modal fade" id="alertModal-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alertModalLabel">Info
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </h5>
          </div>
          <div class="modal-body">
            <img src="<?= base_url('assets/images/error.png') ?>" style="width: 64px; height: 64px; margin-right: 20px;"><span id="infoMessage-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>"> Data history not available. </span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="confirmModal-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Confirm
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </h5>
          </div>
          <div class="modal-body">
            <img src="<?= base_url('assets/images/question-icon.png') ?>" style="width: 64px; height: 64px; margin-right: 20px;">Load data <?= $value[0]['BankFacilityGroupName'] ?> for <?= $valuess['Name'] ?> from <span id="confirmMessage-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>">data mart</span>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancel-btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="save-btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>" data-dismiss="modal">Load & Save</button>
          </div>
        </div>
      </div>
    </div>
                                          <?php 
                                            }
                                          ?>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-4 col-sm-4 col-xs-12">
                                            Notes : 
                                            <!-- <br> -->
                                            <span class="detail_property_titles2"><?=View_Notes1?></span>
                                          </div>
                                          <table width="100%" class="table" cellpadding="20" cellspacing="20" style=" font-size: 12px;">
                                            <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold;" >
                                              <tr class="modal_table_title">
                                                <td style="text-align: left; width: 25%;">Facilities</td>
                                                <td style="text-align: left; width: 10%;">Currency</td>
                                                <td style="text-align: right; width: 30%;">Nominal</td>
                                                <td style="text-align: center; width: 35%;">Rate</td>
                                              </tr>
                                            </thead>
                                            <tbody>
                                          <?php if (isset($value['FacilitiesBanking_details'][$valuess['VCIF']])) { ?>
                                          <?php foreach ($value['FacilitiesBanking_details'][$valuess['VCIF']] as $rows => $values) : ?>
                                              <tr class="modal_table_title">
                                                <td rowspan="2" style="font-weight: bold;"><?=$values['BankFacilityItemName']?></td>
                                                <td style="text-align: left; font-weight: bold;">IDR</td>
                                                <td style="text-align: right;">
                                                  <label class="money"><?=$values['IDRAmount']?></label>
                                                </td>
                                                <td style="text-align: center;">
                                                  <!-- <div class="progress" style="height: 20px; width: 100%;">
                                                    <div class="progress-bar" data-transitiongoal="<?=$values['IDRRate']?>" style="background-color: #218FD8;" title="<?=$values['IDRRate']?> %"> -->
                                                      <label class="money"><?=$values['IDRRate']?></label> %
                                                    <!-- </div>
                                                  </div> -->
                                                </td>
                                              </tr>
                                              <tr class="modal_table_title">
                                                <td style="text-align: left; font-weight: bold;">Valas</td>
                                                <td style="text-align: right;"><label class="money"><?=$values['ValasAmount']?></label></td>
                                                <td style="text-align: center;">
                                                  <!-- <div class="progress" style="height: 20px; width: 100%;">
                                                    <div class="progress-bar" data-transitiongoal="<?=$values['ValasRate']?>" style="background-color: #218FD8;" title="<?=$values['ValasRate']?> %"> -->
                                                      <label class="money"><?=$values['ValasRate']?></label> %
                                                    <!-- </div>
                                                  </div> -->
                                                </td>
                                              </tr>
                                          <?php endforeach; ?>
                                          <?php } ?>                                            
                                           <?php if (isset($value['BankFacilityAddition_detail'][$valuess['VCIF']])) { ?>
                                          <?php foreach ($value['BankFacilityAddition_detail'][$valuess['VCIF']] as $rows => $values) : ?>
                                              <tr class="modal_table_title">
                                                <td rowspan="2" style="font-weight: bold;"><?=$values['BankFacilityItemAdditionName']?></td>
                                                <td style="text-align: left; font-weight: bold;">IDR</td>
                                                <td style="text-align: right;">
                                                  <label class="money"><?=$values['IDRAmountAddition']?></label>
                                                </td>
                                                <td style="text-align: center;">
                                                  <!-- <div class="progress" style="height: 20px; width: 100%;">
                                                    <div class="progress-bar" data-transitiongoal="<?=$values['IDRRateAddition']?>" style="background-color: #218FD8;" title="<?=$values['IDRRateAddition']?> %"> -->
                                                      <label class="money"><?=$values['IDRRateAddition']?></label> %
                                                    <!-- </div>
                                                  </div> -->
                                                </td>
                                              </tr>
                                              <tr class="modal_table_title">
                                                <td style="text-align: left; font-weight: bold;">Valas</td>
                                                <td style="text-align: right;">
                                                  <label class="money"><?=$values['ValasAmountAddition']?></label>
                                                </td>
                                                <td style="text-align: center;">
                                                  <!-- <div class="progress" style="height: 20px; width: 100%;">
                                                    <div class="progress-bar" data-transitiongoal="<?=$values['ValasRateAddition']?>" style="background-color: #218FD8;" title="<?=$values['ValasRateAddition']?> %"> -->
                                                      <label class="money"><?=$values['ValasRateAddition']?></label> %
                                                    <!-- </div>
                                                  </div> -->
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
                                  <?php }?>
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

      // $('.money').autoNumeric('init',{
      //   aForm: true,
      //   vMax: '999999999999999999',
      //   vMin: '-999999999999999999',
      //   mDec: '2',
      //   aPad: false,
      //   unformatOnSubmit: true
      // });
      // $('.portion').autoNumeric('init',{
      //   aForm: true,
      //   mDec: '2',
      //   aPad: false,
      //   // vMax: '999',
      //   unformatOnSubmit: true
      // });


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

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });

    // var current_opt_load = [];
      <?php
      if ($AccountPlanningTabType == 'input') {
        foreach($account_planning['FacilitiesBanking'] as $row => $value):
          foreach ($account_planning_vcif_list as $rows => $valuess) :
        ?>
            // current_opt_load[<?= $value[0]['BankFacilityGroupId'] ?>,'<?= $valuess['VCIF'] ?>'] = '<?= $value[0][$valuess['VCIF']]['DataSource'] ?>';
        
            $("#edit-btn-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>").click(function(){
                edit_url('tasklist/AccountPlanning/inputform/<?= $account_planning['AccountPlanningId'] ?>/bri_starting_position/facilities_banking/<?= $value[0]['BankFacilityGroupId'].'/'.$valuess['VCIF'] ?>');
            });

            $("#btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>-lastyear").click(function(){
                $('#save-btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').off();
                $('#save-btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').on('click', function(){save_confirm_bankFacility('lastyear',<?= $value[0]['BankFacilityGroupId'] ?>, '<?= $valuess['VCIF'] ?>');});
                $('#confirmMessage-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').html(" <b>last year\'s</b> data ");
                $('#confirmModal-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').modal('show');

            });

            $("#btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>-datamart").click(function(){
                $('#save-btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').off();
                $('#save-btn-opt-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').on('click', function(){save_confirm_bankFacility('datamart', <?= $value[0]['BankFacilityGroupId'] ?>, '<?= $valuess['VCIF'] ?>');});
                $('#confirmMessage-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').html(" <b>data mart</b> ");
                $('#confirmModal-<?= $value[0]['BankFacilityGroupId'].'-'.$valuess['VCIF'] ?>').modal('show');

            });
        <?php
          endforeach;
        endforeach;
      }
      ?>
  })

  function edit_url(url){
      window.location.href= "<?= base_url() ?>/"+url;
  }

  /*Acitve status
  lastyear | datamart | manual
  */
  function save_confirm_bankFacility(newactive, groupId, vcif){
      $('.loaderImage').show();
      var loadFunction = '';
      if(newactive === 'lastyear')
          loadFunction = 'loadBankFacilityLastYear';
      else if(newactive === 'datamart')
          loadFunction = 'loadBankFacilityDataMart';
       
      $.getJSON(base_url+'tasklist/DataLoadOption/'+loadFunction+'/<?= $account_planning['AccountPlanningId'] ?>/'+groupId+'/'+vcif).done(function(result, status, xhr){
          if(result.status === 'success'){

             /* $('#btn-opt-'+groupId+'-'+vcif+'-'+current_opt_load[groupId, vcif]).removeClass('load');
              $('#btn-opt-'+groupId+'-'+vcif+'-'+newactive).addClass('load');
              
              current_opt_load[groupId, vcif] = newactive;*/

              window.location.href= '<?=base_url('tasklist/AccountPlanning/view/'.$account_planning['AccountPlanningId'].'/input/bri_starting_position/facilities_banking');?>';
          } else if(result.status === 'error'){
              if(newactive === 'lastyear'){
                  $('#infoMessage-'+groupId+'-'+vcif).text('Data history not available.');
              } else if(newactive === 'datamart'){
                  $('#infoMessage-'+groupId+'-'+vcif).text('Data mart not available.');
              }
              $('.loaderImage').hide();
              $('#alertModal-'+groupId+'-'+vcif).modal('show');
          }
      }).fail(function(xhr, status, error){
          // alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
          $('#infoMessage-'+groupId+'-'+vcif).text("Result: [" + status + "] " + error);
          $('.loaderImage').hide();
          $('#alertModal-'+groupId+'-'+vcif).modal('show');
      });
  }  
</script>