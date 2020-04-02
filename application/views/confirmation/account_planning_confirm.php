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
/*  button {
    font-size: 14px !important; 
  }
*/    
  .active_tab {
    font-size: 14px !important; 
    background-color: #FFFFFF; 
    color: #2980B9 !important; 
    font-weight: bold !important; 
    border-radius: 0px;
    box-shadow: 0px 5px 0px #2980B9;
  } 
    .nonactive_tab {
    font-size: 14px !important; 
    background-color: #FFFFFF; 
    font-weight: bold !important; 
  }

</style>
<?php $this->load->view('tasklist/account_planning_list_member.php'); ?>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Approval</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('confirmation/'.$confirmation_user);?>"><?=$confirmation_user?></a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Detail Account Planning</li> -->
                  </ol>
                </nav>
                <!-- <div class="page_title">
                    <div class="pull-left"><?=$confirmation_user?></div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
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
              <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="text-align:right">
                 <?php
                  if (!empty($history)) {
                    echo form_open('confirmation/'.$confirmation_user.'/history_search');
                  }
                  else {
                    echo form_open('confirmation/'.$confirmation_user.'/search');
                  }
                  ?>
                  <div class="input-group">
                      <input type="text" name="txtcari" id="txtcari" class="form-control" placeholder="Search for..." value="<?= isset($searchTxt) ? $searchTxt : "" ?>">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="submit" style="background: #F58C38; color: white">Go!</button>
                      </span>
                  </div>
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
                  <div class="row form_actions">
                    <div style="text-align: left; padding-left: 20px;">
                      <?php
                        $waiting_tab = ' nonactive_tab';
                        $history_tab = ' nonactive_tab';
                        if (!empty($history)) {
                          $history_tab = ' active_tab';
                        }
                        else {
                          $waiting_tab = ' active_tab';
                        }
                      ?>
                      <button class="btn btn-sm <?=$waiting_tab?>" type="button" style="width: 49%;" id="button_waitingApproval" tab_panel="waitingApproval" onclick="window.location.href='<?=base_url('confirmation/'.$confirmation_user);?>'">Waiting Approval</button>
                      <button class="btn btn-sm <?=$history_tab?>" type="button" style="width: 49%;" id="button_History" tab_panel="History" onclick="window.location.href='<?=base_url('confirmation/'.$confirmation_user.'/history');?>'">History</button>
                    </div>
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
                                <!-- <img class="img-responsive img-circle img_logo" src="<?php if (isset($ap_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/'.$ap_row['Logo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>"> -->
                              </div>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <h5 class="detail_title"><b><?= html_escape($ap_row['CustomerName']); ?></b></h5>
                                <b style="color: <?= $ap_row['ap_year_color'] ?>;"><?= html_escape($ap_row['Year']); ?></b>
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
                              <?=$ap_row['CurrentCPAGroup']?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" style="height: 2.3px; background: #C6D7EE; box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);"></div>
                      <div class="collapse col-md-12 col-sm-12 col-xs-12" id="collapseExample<?= html_escape($ap_row['AccountPlanningId']); ?>" style="background: #E5F0FF; padding: 10px;">
                        <div class="card card-body">
                          <div class="col-md-4 col-sm-4 col-xs-12 margintop_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">domain</i> <b class="detail_property_title2">Company List</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                                <?php if (isset($ap_row['account_planning_vcif_list'])) { ?>
                                  <?php $index_vcif = 1; ?>
                                  <?php foreach ($ap_row['account_planning_vcif_list'] as $row => $value) : ?>
                              <div class="col-md-12 col-sm-10 col-xs-12" style="padding: 0;">
                                        <div class="col-md-1 col-sm-1 col-xs-12">
                                          <?php if ($value['IsMain'] == 1) { ?>
                                            <i class="material-icons" title="Main Company" style="font-size: 15px; vertical-align: middle;">check_box</i>
                                          <?php } ?>
                                        </div> 
                                        <div class="col-md-1 col-sm-1 col-xs-12"><?= $index_vcif ?>. </div>
                                        <div class="col-md-10 col-sm-10 col-xs-12"><?= $value['Name'] ?></div>
                              </div>
                                  <?php $index_vcif++?>
                                  <?php endforeach; ?>
                                <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12 margintop_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">person</i> <b class="detail_property_title2">Relationship Manager</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <?= html_escape($ap_row['RMName']); ?>
                              </div>
                              <?php if (isset($ap_row['account_planning_member'])) { ?>
                                <?php foreach ($ap_row['account_planning_member'] as $row => $value) : ?>
                                  <div class="col-md-10 col-sm-12 col-xs-12"><?= $value['Name'] ?></div>
                                <?php endforeach; ?>
                              <?php } ?>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                              <i class="material-icons detail_property_title_icon">check_circle_outline</i> <b class="detail_property_title2">Checker</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                                <?php if (isset($ap_row['CheckerList'])) { 
                                  // print_r($ap_row['CheckerList']);
                                  ?>
                                  <?php foreach ($ap_row['CheckerList'] as $row => $value) : ?>
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                      <span><?= $value['CheckerName'] ?></span>
                                      <?php if ($value['IsApproved'] == 1) { ?>
                                       <i class="material-icons detail_property_title2" style="margin-left: 0;color: #5cb85c" title="Approved">check</i>
                                      <?php } elseif ($value['IsApproved'] == 2) { ?>
                                       <i class="material-icons detail_property_title2" style="margin-left: 0; color: #E74545;" title="Rejected">close</i>
                                      <?php } elseif ($value['IsApproved'] == NULL) { ?>
                                       <i class="material-icons detail_property_title2" style="margin-left: 0; color: #3498DB;" title="Not Confirmed">assignment_ind</i>
                                      <?php } ?>
                                    </div>
                                  <?php endforeach; ?>
                                <?php } ?>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                              <i class="material-icons detail_property_title_icon">assignment_turned_in</i> <b class="detail_property_title2">Signer</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                                <?php if (isset($ap_row['SignerList'])) { ?>
                                  <?php foreach ($ap_row['SignerList'] as $row => $value) : ?>
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                      <span><?= $value['SignerName'] ?></span>
                                      <?php if ($value['IsApproved'] == 1) { ?>
                                       <i class="material-icons detail_property_title2" style="margin-left: 0;color: #5cb85c" title="Approved">check</i>
                                      <?php } elseif ($value['IsApproved'] == 2) { ?>
                                       <i class="material-icons detail_property_title2" style="margin-left: 0; color: #E74545;" title="Rejected">close</i>
                                      <?php } elseif ($value['IsApproved'] == NULL) { ?>
                                       <i class="material-icons detail_property_title2" style="margin-left: 0; color: #3498DB;" title="Not Confirmed">assignment_ind</i>
                                      <?php } ?>
                                  </div>
                                  <?php endforeach; ?>
                                <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12 margintop_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">assistant_photo</i> <b class="detail_property_title2">Status</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <?= html_escape($ap_row['Status']); ?>
                              </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
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
                          <div class="col-md-3 col-sm-3 col-xs-12 margintop_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <button type="button" class="btn" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" onclick="window.location.href='<?= base_url('confirmation/'.$confirmation_user.'/view/'.$ap_row['AccountPlanningId'].'/details'); ?>'">VIEW ACCOUNT PLANNING</button>
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

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">

  var base_url = "<?= base_url(); ?>";
  $(document).ready(function() {
  });
 
</script>


