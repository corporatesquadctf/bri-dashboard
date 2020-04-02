<style type="text/css">
    .detail_button_con {
      background: #218FD8; 
      padding-top: 3px; 
      text-align: center; 
      height: 30px; 
      border-radius: 0px 0px 4px 4px; 
      vertical-align: middle;
    }
    .detail_button, .detail_button:focus, .detail_button:hover {
      letter-spacing: 0.15px; 
      color: #fff; 
      font-size: 10px; 
      font-weight: bold; 
    }
    .img_logo {
      padding-right:2px; 
      width:100%; 
      height:100%; 
      vertical-align: bottom;
    }
    .detail_title {
      font-weight: 600;
      font-size: 16px;
      line-height: 22px;
      letter-spacing: 0.5px;
      color: #252525;
    }
    .detail_property_title {
      font-weight: 600;
      font-size: 14px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.15px;
      color: #707070;
      vertical-align: middle;
    }
    .detail_property_title2 {
      font-weight: 600;
      font-size: 12px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.15px;
      color: #707070;
      vertical-align: middle;
    }
    .detail_property_title_icon {
      font-size: 15px;
      color: #218FD8;
      vertical-align: middle;
      margin-left: -10px;
    }
    .detail_head_title_icon {
      font-size: 15px;
      color: #F58C38;
      vertical-align: middle;
      /*margin-left: -10px;*/
    }
    .detail_property_text {
      font-weight: normal;
      font-size: 12px;
      line-height: 22px;
      letter-spacing: 0.15px;
      color: #707070;
    }
    .detail_property_text2 {
      font-style: normal;
      font-weight: 600;
      font-size: 11px;
      line-height: 20px;
      letter-spacing: 0.15px;
      color: #218FD8;
      margin-left: -20px;
    }
    .detail_cont_header {
      background: #FFFFFF;
      border-radius: 4px;
      min-height: 120px;
      padding-top: 20px
    }
    .margintop_con {
      margin-top: 20px;
    }
    .marginleft_con {
      margin-left: 15px;
    }
    .paddingleft_con {
      padding-left: 15px;
    }
    .padding_con {
      padding: 15px;
    }

</style>
<?php $this->load->view('tasklist/account_planning_list_member.php'); ?>
<?php $this->load->view('tasklist/account_planning_list_vcif.php'); ?>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Tasklist</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Account Planning</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div>
              <!-- <div class="col-md-2 col-sm-2 col-xs-12">
                Button
              </div> -->
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <i class="material-icons detail_head_title_icon">album</i> Value <sub style="font-size: 60%;">UNIT</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;">In <?= VALUE_UNIT ?></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <i class="material-icons detail_head_title_icon">business_center</i> Pinjaman <sub style="font-size: 60%;">LAST UPADATE</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;">Total: <?= $totalPinjamanLastUpdateDate ?></span>
                    <br>
                    <span style="font-size: 11px">Ratas: <?= $ratasPinjamanLastUpdateDate ?></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <i class="material-icons detail_head_title_icon">account_balance_wallet</i> Simpanan <sub style="font-size: 60%;">LAST UPADATE</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;"> Total: <?= $totalSimpananLastUpdateDate ?></span>
                    <br>
                    <span style="font-size: 11px;"> Ratas: <?= $ratasSimpananLastUpdateDate ?></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <i class="material-icons detail_head_title_icon">insert_chart</i> Current CPA <sub style="font-size: 60%;">LAST UPADATE</sub>
                  <div style="margin-top: 10px;margin-left: 20px">
                    <span style="font-size: 11px;"><?= $cpaLastUpdateDate ?></span>
                  </div>
                </div>
                
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="text-align:right; padding-bottom: 25px;">
                <div class="x_title">
                  <ul class="nav panel_toolbox">
                    <li><a class="btn btn-default collapse-link">Search By Filter <i class="fa fa-chevron-down" title="Expand" style="margin-left: 10px"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_title" style="padding-top: 15px;">
                  <?php if ($this->session->ROLE_ID == 1) { ?>
                    <!-- <button class="btn btn-default btn-xs pull-right" title="Mass Cloning Account Planning for next year" onclick="confirmModal_mass_clone('<?=$current_year?>'); return false;" style=" width: 36px; height: 36px;">
                        <i class="material-icons" style="border-radius: 2px; color: #f58c38; font-size: 18px; vertical-align: sub;">file_copy</i>
                    </button> -->
                  <?php } ?>
                </div>
              </div>
              <div class="x_content" <?= ($search_box) ? $search_box : 'style="display: none;"' ?>>
                  <form action="<?=base_url();?>tasklist/AccountPlanning/search" method="post" class="form-horizontal form-label-left" style="background-color: #f4f4f4; padding: 12px 12px 12px 12px; border: 1px solid #d0d0d0">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <?= $tahun_search_box; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <?= $status_search_box; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Keyword</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="keyword_search_box" id="keyword_search_box" class="form-control col-md-7 col-xs-12" placeholder="Search for..." value="<?= ($keyword_search_box) ? $keyword_search_box : "" ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn w150 btn-primary pull-left" type="submit">Search</button>
                        <!-- <button class="btn btn-default" style="background: #F58C38;color: white" type="submit">Search</button> -->
                      </div>
                    </div>
                  <div class="clearfix"></div>
                  </form>
                </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
              <?php
                if (isset($results)) {
                ?>
                  <?php foreach ($results as $ap_id => $ap_row) : ?>
                    <div class="x_panel col-md-12 col-sm-12 col-xs-12" style="padding: 0px; border-radius: 4px;">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="min-height: 120px; padding-top: 20px; padding-bottom: 20px;">
                        <div class="col-md-4 col-sm-4 col-xs-12" style="padding: 0px;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                <img class="img-responsive img-circle img_logo" src="<?php if (!file_exists ('uploads/CustomerGroupLogo/'.$ap_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/default.png'); elseif (isset($ap_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/'.$ap_row['Logo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>" style="width: 50px; height: 50px;">
                              </div>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <h5 class="detail_title"><b><?= html_escape($ap_row['CustomerName']); ?></b></h5>

                                <i class="fa fa-calendar" title="Account Planning Year" style="font-size: 14px; margin-right: 6px; vertical-align: middle;"></i> 
                                  <span style="font-size: 12px; color: <?= $ap_row['ap_year_color'] ?>;"><b><?= html_escape($ap_row['Year']); ?></b></span>
                                <br />
                                <i class="fa fa-flag" title="Account Planning Year" style="font-size: 14px; margin-right: 6px; vertical-align: middle;"></i>
                                  <span style="font-size: 12px; color: <?= $ap_row['ap_status_color'] ?>;"><b><?= html_escape($ap_row['Status']); ?></b></span>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="material-icons detail_property_title_icon">business_center</i> <b class="detail_property_title"> Pinjaman</b>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Total
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$ap_row['PinjamanTotalGroup']?>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Ratas
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$ap_row['PinjamanRatasGroup']?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="material-icons detail_property_title_icon">account_balance_wallet</i> <b class="detail_property_title">Simpanan</b>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Total
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$ap_row['SimpananTotalGroup']?>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Ratas
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$ap_row['SimpananRatasGroup']?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">Current CPA</b>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Total
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$ap_row['CurrentCPAGroup']?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12" style="padding-top: 35px; padding-right: 20px;">
                            <button class="btn btn-default btn-xs pull-right" title="Cloning Account Planning for next year" onclick="confirmModal_clone('<?=$ap_row['AccountPlanningId']?>'); return false;" style=" width: 36px; height: 36px;">
                                <i class="material-icons" style="border-radius: 2px; color: #218FD8; font-size: 18px; vertical-align: sub;">file_copy</i>
                            </button>
                          <?php if ($ap_row['Year'] == $current_year) { ?>
                            <?php if ($ap_row['DocumentStatusId'] == 0 || $ap_row['DocumentStatusId'] == 1) { ?>
                              <button class="btn btn-default btn-xs pull-right" title="Manage Account Planning Company" onclick="manage_vcif('<?=$ap_row['CustomerGroupId']?>', '<?=$ap_row['AccountPlanningId']?>'); return false;" style=" width: 36px; height: 36px;">
                                  <i class="material-icons" style="border-radius: 2px; color: #F58C38; font-size: 18px; vertical-align: sub;">business</i>
                              </button>
                            <?php } ?>
                            <!-- <button class="btn btn-default btn-xs" title="Delete Account Planning" onclick="confirmModal_delete('<?=$ap_row['CustomerGroupId']?>', '<?=$ap_row['AccountPlanningId']?>'); return false;" style=" width: 36px; height: 36px;">
                                <i class="material-icons" style="border-radius: 2px; color: #EF4141; font-size: 18px; vertical-align: sub;">delete_sweep</i>
                            </button> -->
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" style="height: 2.3px; background: #C6D7EE; box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);"></div>
                      <div class="collapse col-md-12 col-sm-12 col-xs-12" id="collapseExample<?= html_escape($ap_row['AccountPlanningId']); ?>" style="background: #E5F0FF; padding: 10px;">
                        <div class="card card-body">
                          <div class="col-md-4 col-sm-4 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">domain</i> <b class="detail_property_title2">Company List</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <?php if (isset($ap_row['account_planning_vcif_list'])) { ?>
                                <?php $index_vcif = 1; ?>
                                <?php foreach ($ap_row['account_planning_vcif_list'] as $row => $value) : ?>
                                      <div class="col-md-1 col-sm-1 col-xs-12">
                                        <?php if ($value['IsMain'] == 1) { ?>
                                          <i class="material-icons" title="Main Company" style="font-size: 15px; vertical-align: middle;">check_box</i>
                                        <?php } ?>
                                        </div> 
                                      <div class="col-md-1 col-sm-1 col-xs-12"><?= $index_vcif ?>. </div>
                                      <div class="col-md-10 col-sm-10 col-xs-12"><?= $value['Name'] ?></div>
                                <?php $index_vcif++?>
                                <?php endforeach; ?>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">person</i> <b class="detail_property_title2">CST Member</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <i class="material-icons" title="Owner" style="font-size: 15px; vertical-align: sub;">person_pin</i> <?= html_escape($ap_row['RMName']); ?>
                              </div>
                              <?php if (isset($ap_row['account_planning_member'])) { ?>
                                <?php foreach ($ap_row['account_planning_member'] as $row => $value) : ?>
                                  <div class="col-md-12 col-sm-12 col-xs-12" style="cursor: pointer;" title="Edit Tab Privilege" onclick="edit_privilege('<?= $value['AccountPlanningId']; ?>', '<?= $value['UserId']; ?>'); return false;">
                                      <i class="material-icons" style="color: #5cb85c; font-size: 15px; vertical-align: sub;">person_add</i>
                                      <span><?= $value['Name'] ?></span>
                                  </div>
                                <?php endforeach; ?>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">business_center</i> <b class="detail_property_title2">Pinjaman</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title2">Total : </span> 
                                <span class="detail_property_title2" style="color: #218FD8"><?= $ap_row['PinjamanTotalAP'] ?></span>
                              </div>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title2">Ratas : </span>
                                <span class="detail_property_title2" style="color: #218FD8"><?= $ap_row['PinjamanRatasAP'] ?></span>
                              </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                              <i class="material-icons detail_property_title_icon">account_balance_wallet</i> <b class="detail_property_title2">Simpanan</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title2">Total :</span>
                                <span class="detail_property_title2" style="color: #218FD8"><?= $ap_row['SimpananTotalAP'] ?></span>
                              </div>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title2">Ratas :</span>
                                <span class="detail_property_title2" style="color: #218FD8"><?= $ap_row['SimpananRatasAP'] ?></span>
                              </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                              <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title2">Current CPA</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="detail_property_title2">Total : </span>
                                <span class="detail_property_title2" style="color: #218FD8"><?= html_escape($ap_row['CurrentCPAAP']); ?></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php if ($ap_row['Year'] == $current_year) { ?>
                                <!-- <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" onclick="manage_vcif('<?=$ap_row['CustomerGroupId']?>', '<?=$ap_row['AccountPlanningId']?>');">MANAGE ACCOUNT PLANNING COMPANY</button> -->
                                <?php if ($ap_row['DocumentStatusId'] == 0 || $ap_row['DocumentStatusId'] == 1) { ?>
                                <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background:transparent; border: 1px solid #F58C38; box-sizing: border-box; border-radius: 2px; color: #F58C38; width: 210px; height: 45px;" onclick="add_member('<?=$ap_row['AccountPlanningId']?>');">MANAGE ACCOUNT PLANNING MEMBER</button>
                                <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" onclick="updateLastView('<?=$ap_row['AccountPlanningId']?>');"><?php if ($ap_row['DocumentStatusId'] == 0) echo "INPUT"; else echo "EDIT"; ?> ACCOUNT PLANNING</button>
                                <?php } else { ?>
                                <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background:transparent; border: 1px solid #F58C38; box-sizing: border-box; border-radius: 2px; color: #F58C38; width: 210px; height: 45px;" onclick="retrieve_accountplanning(<?= $ap_row['AccountPlanningId'] ?>);" id="retrieve_accountplanning_button<?= $ap_row['AccountPlanningId'] ?>">UPDATE ACCOUNT PLANNING</button>
                                <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" onclick="window.location.href='<?= base_url('tasklist/AccountPlanning/view/'.$ap_row['AccountPlanningId']).'/details'; ?>'">VIEW ACCOUNT PLANNING</button>
                                <?php } ?>
                              <?php }else { ?>
                                <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" onclick="window.location.href='<?= base_url('performance/AccountPlanning/view/'.$ap_row['AccountPlanningId'].'/details'); ?>'">VIEW ACCOUNT PLANNING</button>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>

                      <div class="detail_button_con col-md-12 col-sm-12 col-xs-12" data-toggle="collapse" href="#collapseExample<?= html_escape($ap_row['AccountPlanningId']); ?>" aria-expanded="true" aria-controls="collapseExample<?= html_escape($ap_row['AccountPlanningId']); ?>" style="cursor: pointer;">
                        <a class="detail_button">
                          LIHAT DETAIL ACCOUNT PLANNING
                        </a>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  <?php endforeach; ?>
                  <div class="pull-left">
                    <?php if (isset($links)) { ?>
                      <?php echo $links ?>
                    <?php } ?>
                  </div>
                <?php
                } else {
                ?>
                     <div>No data.</div>
                <?php
                }
                ?>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div id="modal-privilege" class="modal fade modal-privilege" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="PrivilegeModalForm" method="POST" action="<?= site_url('tasklist/AccountPlanning/manage_CST_privilege') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span><span id="modal_title"></span> CST Member Privilege Tab</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="form-group">
                <div class="control-label col-md-3 col-sm-3 col-xs-12" style="padding-top: 0;">
                  <label class="control-label" for="PrivilegeId1">Account Planning Tab</label>
                </div>                
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="checkbox" name="PrivilegeId[]" id="PrivilegeId1" value="1" style="vertical-align: text-bottom;"> <span for="PrivilegeId1" style="vertical-align: -webkit-baseline-middle;">Company Information</span>
                </div>
              </div>
              <div class="form-group">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="checkbox" name="PrivilegeId[]" id="PrivilegeId2" value="2" style="vertical-align: text-bottom;"> <span for="PrivilegeId2" style="vertical-align: -webkit-baseline-middle;">BRI Starting Position</span>
                </div>
              </div>
              <div class="form-group">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="checkbox" name="PrivilegeId[]" id="PrivilegeId3" value="3" style="vertical-align: text-bottom;" checked="" disabled=""> <span for="PrivilegeId3" style="vertical-align: -webkit-baseline-middle;">Client Needs</span>
                  <input type="hidden" id="PrivilegeId3" name="PrivilegeId[]" value="3" />
                </div>
              </div>
              <div class="form-group">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="checkbox" name="PrivilegeId[]" id="PrivilegeId4" value="4" style="vertical-align: text-bottom;"> <span for="PrivilegeId4" style="vertical-align: -webkit-baseline-middle;">Action Plans</span>
                </div>
              </div>
              <div class="form-group">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="checkbox" name="PrivilegeId[]" id="PrivilegeId5" value="5" style="vertical-align: text-bottom;"> <span for="PrivilegeId5" style="vertical-align: -webkit-baseline-middle;">Customer Profitability Account</span>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModal_privilege(); return false;">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div id="confirmModal_privilege" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">Your'e about to change privilege member's Account Planning. Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK_privilege" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal_mass_clone" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">Your'e about to Clone all Account Planning. Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK_mass_clone" type="button" class="btn w150 btn-primary modal-button-ok" onclick="massCloneAccountPlannings(); return false;">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal_clone" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">Your'e about to Clone this Account Planning. Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK_clone" type="button" class="btn w150 btn-primary modal-button-ok" onclick="cloneAccountPlanning(); return false;">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal_delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text2">YouAre you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK_delete" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">

  var base_url = "<?= base_url(); ?>";
  $(document).ready(function() {
  });

  function confirmModal_mass_clone(Year) {
    $('#confirmModal_mass_clone').modal('show');
    $('#OK_mass_clone').attr('Year', Year);
  }

  function confirmModal_clone(AccountPlanningId) {
    $('#confirmModal_clone').modal('show');
    $('#OK_clone').attr('AccountPlanningId', AccountPlanningId);
  }

  function massCloneAccountPlannings() {
    var Year = $('#OK_mass_clone').attr('Year');
    console.log(Year);
      $.ajax({
          type: "GET",
          url: "<?= base_url('tasklist/AccountPlanning/massCloneAccountPlannings/')?>" + Year,
          data: '',
          dataType: 'json',
          beforeSend: function() {
              $('.loaderImage').show();
          },
          success:function(response) {
            console.log(response);
            $('#confirmModal_mass_clone').modal('hide');
            $('.loaderImage').hide();
            $('.modal-backdrop').hide();

            if(response.status === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Mass Cloning Account Planning success.',
                  type: 'success',
                  styling: 'bootstrap3'
              });
            
              PNotify.prototype.options.delay = 3000;
            }
            else if(response.status === 'error'){
              new PNotify({
                  title: 'Response Error!',
                  text: response.message,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 3000;
            }
            setTimeout(function(){ 
              $('.loaderImage').hide();
              // window.location.href= base_url+'tasklist/AccountPlanning';
            }, 2000);
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
          }
      });
  }

  function cloneAccountPlanning() {
    var AccountPlanningId = $('#OK_clone').attr('AccountPlanningId');
    console.log(AccountPlanningId);
      $.ajax({
          type: "GET",
          url: "<?= base_url('tasklist/AccountPlanning/cloneAccountPlannings/')?>" + AccountPlanningId,
          data: '',
          dataType: 'json',
          beforeSend: function() {
              $('.loaderImage').show();
          },
          success:function(response) {
            console.log(response);
            $('#confirmModal_clone').modal('hide');
            $('.loaderImage').hide();
            $('.modal-backdrop').hide();

            if(response.status === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Cloning Account Planning success.',
                  type: 'success',
                  styling: 'bootstrap3'
              });
            
              PNotify.prototype.options.delay = 3000;
            }
            else if(response.status === 'error'){
              new PNotify({
                  title: 'Response Error!',
                  text: response.message,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 3000;
            }
            setTimeout(function(){ 
              $('.loaderImage').hide();
              // window.location.href= base_url+'tasklist/AccountPlanning';
            }, 2000);
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
          }
      });
  }

  function confirmModal_delete() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK_delete').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function confirmModal_privilege() {
    $('#confirmModal_privilege').modal('show');
  }

  function edit_privilege(AccountPlanningId, UserId) {
    $(document).ready(function() {
      $('#modal-privilege').modal('show');
      $('.loaderImage').show();

      $('#UserId').remove();
      $('#AccountPlanningId').remove();

      $("#PrivilegeId1").prop("checked", false);
      $("#PrivilegeId2").prop("checked", false);
      $("#PrivilegeId4").prop("checked", false);
      $("#PrivilegeId5").prop("checked", false);

      var form = $('#PrivilegeModalForm');
      $(form).append('<input type="hidden" id="UserId" name="UserId" value="'+UserId+'" /> ');
      $(form).append('<input type="hidden" id="AccountPlanningId" name="AccountPlanningId" value="'+AccountPlanningId+'" /> ');

      $.getJSON(base_url+'tasklist/AccountPlanning/getCSTPrivilegeTab/'+AccountPlanningId+'/'+UserId, function (data){
        if(data.length > 0){
          $.each(data, function(index, PrivilegeTab){
            console.log(PrivilegeTab);
            if(PrivilegeTab == 1){
              $("#PrivilegeId1").prop("checked", true);
            }
            if(PrivilegeTab == 2){
              $("#PrivilegeId2").prop("checked", true);
            }
            if(PrivilegeTab == 3){
              $("#PrivilegeId3").prop("checked", true);
            }
            if(PrivilegeTab == 4){
              $("#PrivilegeId4").prop("checked", true);
            }
            if(PrivilegeTab == 5){
              $("#PrivilegeId5").prop("checked", true);
            }
          })
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
          });
        }
        $('.loaderImage').hide();
      })


    })
  }

  $('#OK_privilege').click(function(){
      $.ajax({
        type: 'post',
        url : $('#PrivilegeModalForm').attr('action'),
        data: $('#PrivilegeModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('#confirmModal_privilege').modal('hide');
          $('#modal-privilege').modal('hide');
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('.loaderImage').hide();
          new PNotify({
              title: 'Error Thrown!',
              text: "Message : "+errorThrown,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;
        },
        success: function(response){
          if(response.status === 'success'){
            $('.loaderImage').hide();
            $('#modal-group').modal('hide');
            new PNotify({
                title: 'Success!',
                text: 'Update CST Privilege Success',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;

          }else if(response.status === 'error'){
            $('.modal-backdrop').hide();
            $('.loaderImage').hide();
            new PNotify({
                title: 'Response Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
          }
        }
      });
  });

  function updateLastView(AccountPlanningId) {
    $.ajax({
      type: "GET",
      url: base_url + "tasklist/AccountPlanning/updateLastView/" + AccountPlanningId,
      data: '',
      beforeSend: function() {
          $('.loaderImage').show();
      },
      success:function(response) {
        // console.log(response);
        // new PNotify({
        //     title: 'Success!',
        //     text: 'View Input Account Planning success.',
        //     type: 'success',
        //     styling: 'bootstrap3'
        // });
        
        // PNotify.prototype.options.delay = 1200;

        // setTimeout(function(){ 
          $('.loaderImage').hide();
          window.location.href= base_url+'tasklist/AccountPlanning/view/' + AccountPlanningId + '/input';
        // }, 2000);
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
      }
    });
  }

  function manage_vcif(CustomerGroupId, AccountPlanningId) {
    $(document).ready(function() {
      $('.modal-change-account_planning_vcif').modal('show');
      $('#oldIsMain').remove();
      // $('.loaderImage').show();

      var form = $('#changeVCIFModalForm');
      $(form).append('<input type="hidden" name="CustomerGroupId" value="'+CustomerGroupId+'" /> ');
      $(form).append('<input type="hidden" name="AccountPlanningId" value="'+AccountPlanningId+'" /> ');

      var vcif_list = $('#vcif_list');
      vcif_list.empty();
      var totalSelected = 0;

      var w ='<table width="100%" id="table_vcif_lists" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">check</i></td><td width="40%">VCIF</td><td width="55%">Company Name</td></tr></thead>';

      $.getJSON(base_url+'tasklist/AccountPlanning/getGroupVCIFList/'+CustomerGroupId+'/'+AccountPlanningId, function (data){
        if(data.length > 0){
          w += '<tbody>';
          $.each(data, function(index, item){
            console.log(data);
              w += '<tr class="modal_table_list">';
              if(item.AccountPlanningId != null) {
                // w += '<td><label><i class="material-icons" style="color: #218FD8; font-size: 16px; vertical-align: middle;">lock</i></label></td>';
                w += '<td><label><input id="vcif_list" name="vcif_list[]" value="' + item.VCIF + '" type="checkbox" class="flat"></label><i class="material-icons" style="color: #218FD8; font-size: 16px; vertical-align: middle;" title="Already in an Account Planning">assignment</i><input id="srcAccountPlanningId" name="srcAccountPlanningId[]" value="' + item.AccountPlanningId + '" type="hidden"></td>';
              }
              else {
                w += '<td><label><input id="vcif_list" name="vcif_list[]" value="' + item.VCIF + '" type="checkbox" class="flat"></label></td>';
              }
              w += '<td>' + item.VCIF + '</td>';
              w += '<td>' + item.CustomerName + '</td>';
              w += '</tr>';
          })
          w += '</tbody>';
        }
        console.log(w);

        vcif_list.append(w);
        w += '</table>';        
        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('input').on('ifChecked', function(event){
          totalSelected = totalSelected+1;
          if (totalSelected > 0){
            // $("#btn-save").attr("disabled", false);
          }
        });
        $('input').on('ifUnchecked', function(event){
          totalSelected = totalSelected-1;
          if (totalSelected <= 0){
           // $("#btn-save").attr("disabled", true);
          }
        });

        $('#table_vcif_lists').DataTable({
          "destroy": true,
          'dom': 'ft<"bottom"p>',
          "info": true,
          "pageLength": 10,
          "pagingType": "simple",
          "lengthChange": false,
          "columns": [
              { "orderable": false },
              null,
              null
            ]        
        });
      })
      
      var vcif_selected_list = $('#vcif_selected_list');
      vcif_selected_list.empty();

      var x ='<table width="100%" id="table_vcif_list_selected" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="40%">VCIF</td><td width="55%">Company Name</td><td width="55%">Main</td><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">delete_sweep</i></td></tr></thead>';

      $.getJSON(base_url+'tasklist/AccountPlanning/getAPVCIFSelected/'+AccountPlanningId, function (data){
        if(data.length > 0){
          x += '<tbody>';
          $.each(data, function(index, item){
            if(item.IsMain == 1){
              $(form).append('<input type="hidden" id="oldIsMain" name="oldIsMain[]" value="'+item.VCIF+'" /> ');
              var valIsMain = ' checked';
            }
            else {
              // $(form).append('<input type="hidden" name="oldIsMain[]" value="" /> ');
              var valIsMain = '';
            }
              x += '<tr class="modal_table_list">';
              x += '<td>' + item.VCIF + '</td>';
              x += '<td>' + item.Name + '</td>';
              // x += '<td><label><input id="vcif_main_company" name="vcif_main_company[]" title="Account Planning Main Company" value="' + item.IsMain + '" type="radio"'+valIsMain+'></label><input name="VCIF[]" value="' + item.VCIF + '" type="hidden"></td>';
              x += '<td><label><input id="vcif_main_company" name="IsMain[]" title="Account Planning Main Company" value="' + item.VCIF + '" type="radio"'+valIsMain+'></label><input name="VCIF[]" value="' + item.VCIF + '" type="hidden"></td>';
              x += '<td><label><input id="vcif_selected_list" name="vcif_selected_list[]" value="' + item.VCIF + '" type="checkbox" class="flat"></label></td></td>';
              x += '</tr>';
          })
          x += '</tbody>';
        }

        vcif_selected_list.append(x);
        x += '</table>';        
        $('.loaderImage').hide();
        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('input').on('ifChecked', function(event){
          totalSelected = totalSelected+1;
          if (totalSelected > 0){
            // $("#btn-save").attr("disabled", false);
          }
        });
        $('input').on('ifUnchecked', function(event){
          totalSelected = totalSelected-1;
          if (totalSelected <= 0){
           // $("#btn-save").attr("disabled", true);
          }
        });

        $('#table_vcif_list_selected').DataTable({
          "destroy": true,
          'dom': 'ft<"bottom"p>',
          "info": true,
          "pageLength": 10,
          "pagingType": "simple",
          "lengthChange": false,
          "columns": [
              null,
              null,
              { "orderable": false },
              { "orderable": false }
            ]        
        });
      })
      
    });
  }

  function add_member(AccountPlanningId) {
    $(document).ready(function() {
      $('.loaderImage').show();
      $('.modal-add-account_planning_member').modal('show');

      var form = $('#addMemberModalForm');
      $(form).append('<input type="hidden" name="AccountPlanningId" value="'+AccountPlanningId+'" /> ');

      var member_list = $('#member_list');
      member_list.empty();
      var totalSelected = 0;

      var w ='<table width="100%" id="table_member_lists" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">check</i></td><td width="40%">Personal Number</td><td width="55%">Name</td></tr></thead>';

      $.getJSON(base_url+'tasklist/AccountPlanning/getMemberList/'+AccountPlanningId, function (data){
        console.log(data);
        if(data.length > 0){
          w += '<tbody>';
          $.each(data, function(index, item){
              w += '<tr class="modal_table_list">';
              w += '<td><label><input id="member_list" name="member_list[]" value="' + item.UserId + '" type="checkbox" class="flat"></label></td></td>';
              w += '<td>' + item.UserId + '</td>';
              //w += '<td>' + item.Name + '</td>';
              w += '<td>' + item.Name + '<br><small>' + item.UkerName + '</small></td>';
              w += '</tr>';
          })
          w += '</tbody>';
        $('.loaderImage').hide();
        }

        member_list.append(w);
        w += '</table>';        
        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('input').on('ifChecked', function(event){
          totalSelected = totalSelected+1;
          if (totalSelected > 0){
            $("#btn-save").attr("disabled", false);
          }
        });
        $('input').on('ifUnchecked', function(event){
          totalSelected = totalSelected-1;
          if (totalSelected <= 0){
           $("#btn-save").attr("disabled", true);
          }
        });

        $('#table_member_lists').DataTable({
          "destroy": true,
          'dom': 'ft<"bottom"p>',
          "info": true,
          "pageLength": 10,
          "pagingType": "simple",
          "lengthChange": false,
          "columns": [
              { "orderable": false },
              null,
              null
            ]        
        });
      })
      
      var member_selected_list = $('#member_selected_list');
      member_selected_list.empty();

      var x ='<table width="100%" id="table_member_list_selected" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="40%">Personal Number</td><td width="55%">Name</td><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">delete_sweep</i></td></tr></thead>';

      $.getJSON(base_url+'tasklist/AccountPlanning/getMemberSelected/'+AccountPlanningId, function (data){
        console.log(data);
        if(data.length > 0){
          x += '<tbody>';
          $.each(data, function(index, item){
              x += '<tr class="modal_table_list">';
              x += '<td>' + item.UserId + '</td>';
              x += '<td>' + item.RMName + '<br><small>' + item.UkerName + '</small></td>';
              x += '<td><label><input id="member_selected_list" name="member_selected_list[]" value="' + item.UserId + '" type="checkbox" class="flat"></label></td></td>';
              x += '</tr>';
          })
          x += '</tbody>';
        }

        member_selected_list.append(x);
        x += '</table>';        

        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('input').on('ifChecked', function(event){
          totalSelected = totalSelected+1;
          if (totalSelected > 0){
            $("#btn-save").attr("disabled", false);
          }
        });
        $('input').on('ifUnchecked', function(event){
          totalSelected = totalSelected-1;
          if (totalSelected <= 0){
           $("#btn-save").attr("disabled", true);
          }
        });

        $('#table_member_list_selected').DataTable({
          "destroy": true,
          'dom': 'ft<"bottom"p>',
          "info": true,
          "pageLength": 10,
          "pagingType": "simple",
          "lengthChange": false,
          "columns": [
              null,
              null,
              { "orderable": false }
            ]        
        });
      })
      
    });
  }

  function retrieve_accountplanning(AccountPlanningId) {
    if(confirm("Your'e about to Retrieve this Account Planning. Are you sure?")) {
      $.ajax({
          type: "GET",
          url: "<?= base_url('tasklist/AccountPlanning/retrieve/')?>" + AccountPlanningId,
          data: '',
          beforeSend: function() {
              $('.loaderImage').show();
          },
          success:function(response) {
            console.log(response);
            new PNotify({
                title: 'Success!',
                text: 'Retireve Account Planning success.',
                type: 'success',
                styling: 'bootstrap3'
            });
            
            PNotify.prototype.options.delay = 1200;

            setTimeout(function(){ 
              $('.loaderImage').hide();
              window.location.href= base_url+'tasklist/AccountPlanning/view/' + AccountPlanningId + '/input';
            }, 2000);
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
          }
      });
    }
  }
 
</script>
