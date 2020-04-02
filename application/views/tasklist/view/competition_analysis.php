                    <div class="row" style="padding-top: 3px; border-radius: 4px;">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 0;">
                        <div class="accordion" id="accordion_CompetitionAnalysis" role="tablist" aria-multiselectable="true">
                          <?php ?>  <?php foreach ($account_planning['CompetitionAnalysis'] as $row => $value) : ?>
                            <div class="panel">
                              <a class="panel-heading<?=$value[0]['heading_panel']?>" role="tab" id="headingCompetitionAnalysis<?=$value[0]['BankFacilityGroupId']?>" data-toggle="collapse" data-parent="#accordion_CompetitionAnalysis" href="#collapseCompetitionAnalysis<?=$value[0]['BankFacilityGroupId']?>" aria-expanded="<?=$value[0]['expanded_panel']?>" aria-controls="collapseCompetitionAnalysis<?=$value[0]['BankFacilityGroupId']?>" style="border-bottom: 1px solid #ddd;">
                                <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> <?=$value[0]['BankFacilityGroupName']?></h4>
                              </a>
                              <div id="collapseCompetitionAnalysis<?=$value[0]['BankFacilityGroupId']?>" class="panel-collapse<?=$value[0]['tab_panel']?>" role="tabpanel" aria-labelledby="headingCompetitionAnalysis<?=$value[0]['BankFacilityGroupId']?>"><?php ?>
                                <div class="panel-body" style="min-height: 70px; padding: 10px 15px 5px 10px;">
                                  <div class="col-xs-2 pull-right">
                                      <!-- <div class="col-xs-12"> -->
                                          <?php 
                                            if ($AccountPlanningTabType == 'input') {
                                          ?>
                                          <div class="div-action" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/inputform/'.$account_planning['AccountPlanningId'].'/bri_starting_position/competition_analysis/'.$value[0]['BankFacilityGroupId']); ?>'">
                                              <i class="material-icons">edit</i>
                                              <label>Edit Data</label>
                                          </div>
                                           <?php 
                                            }
                                          ?>
                                     <!-- </div> -->
                                  </div>
                                  <?php if (isset($value['CompetitionAnalysis_detail'])) {?>
                                  <?php foreach ($value['CompetitionAnalysis_detail'] as $rows => $values) : ?>
                                  <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                                        <p class="detail_property_titles" style="border-bottom: 1px solid #ddd;"><?=$values['BankFacilityItemName']?></p>
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="font-size: 12px;">
                                        Bank Name #1<br />
                                        <strong style="color:#000; font-size: 14px;"><?=$values['BankName1']?></strong>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="font-size: 12px;">
                                        Bank Name #2<br />
                                        <strong style="color:#000; font-size: 14px;"><?=$values['BankName2']?></strong>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="font-size: 12px;">
                                        Bank Name #3<br />
                                        <strong style="color:#000; font-size: 14px;"><?=$values['BankName3']?></strong>
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


