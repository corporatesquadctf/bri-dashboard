<style type="text/css">
    th{
        text-align: center;
        font-size: 12px;
    }
    td{
        font-size: 11px;
    }
     .rght{
        text-align: right;
    }
    .dataTables_paginate {
    float: left !important;
    }
    .dataTables_info {
        width: 40%;
        float: left;
        margin-left: 25px;
    }
    .dataTables_filter {
        width: auto;
        float: right;
        text-align: right;
    }
    thead{
        background-color:#337ab7;
    }
    .update_link{
        vertical-align:middle; 
        text-decoration: underline; 
        color:#337ab7;
    }
    .btn-primary{
      color: #FFF !important;
    }
    .btn-primary:hover {
      color: #fff !important;
      background-color: #286090 !important;
      border-color: #204d74 !important;
    }
    .btn-primary.focus, .btn-primary:focus {
        color: #fff !important;
        background-color: #286090 !important;
        border-color: #122b40 !important;
    }

</style>
<script type="text/javascript" language="javascript">
function validateForm() {
    var x = document.forms["search_txt"]["txtcari"].value;
    if (x == "") {
        alert("Masukan kata kunci");
        return false;
    }
}
</script>

<div class="right_col" role="main">
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="x_panel container_header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Monitoring</li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('monitoring/AccountPlanning');?>">Account Planning</a></li>
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
            <div class="x_title">
              <ul class="nav panel_toolbox">
                <li>
                  <a href="<?= base_url("export/monitoring_account_planning"); ?>" target="_blank" id="btnExportAccountPlanning" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px; font-size: 14px;" type="button">Export as Excel</a>
                </li>
                <li><a class="btn btn-default collapse-link">Search By Filter <i class="fa fa-chevron-down" title="Expand" style="margin-left: 10px"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content" <?= ($search_box) ? $search_box : 'style="display: none;"' ?>>
              <form action="<?=base_url();?>monitoring/AccountPlanning/search_box" method="get" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Kerja</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $uker_search_box; ?>
                  </div>
                </div>
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
                <!-- <div class="ln_solid"></div> -->
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button class="btn w150 btn-sm btn-primary pull-left" type="submit">Search</button>
                  </div>
                </div>
              <div class="clearfix"></div>
              </form>
            </div>
          </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content scollable">
              <?php
                if (isset($results)) {
                ?>
                  <?php $index = 1; ?>
                  <?php foreach ($results as $ap_id => $ap_row) : ?>
                      <div style="box-shadow: 1px 5px 5px #f58c38;" class="x_panel col-md-12 col-sm-12 col-xs-12" style="">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12" style=" margin-left: -20px">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <img class="img-responsive img-circle img_logo" src="<?php if (!file_exists ('uploads/CustomerGroupLogo/'.$ap_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/default.png'); elseif (isset($ap_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/'.$ap_row['Logo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>">
                                  <!-- <img class="img-responsive img-circle " style="padding-right:2px; width:100%; height:100%; vertical-align: top;" src="<?= base_url('assets/images/default.png'); ?>"> -->
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <h3 style="color: #262e30"><b><?= html_escape($ap_row['CustomerName']); ?></b></h3>
                                  <div style="border-bottom-style: solid; border-color: #f58c38; width: 50px"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 20px">
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 12px;">
                                <!-- <p>
                                    <i class="fa fa-bullseye" title="Sektor Usaha" style="font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                                    <?= html_escape($ap_row['SektorUsaha']); ?>
                                </p> -->
                                <p>
                                    <i class="fa fa-calendar" title="Account Planning Year" style="font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                                    <?= html_escape($ap_row['Year']); ?>
                                </p>
                                <p>
                                    <i class="fa fa-crosshairs" title="Classified" style="font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                                    <?= html_escape($ap_row['Clasified']); ?>
                                </p>
                                <p>
                              <?php if ($ap_row['DocumentStatusId'] == 0) { ?>
                                  <span class="label label-info" style="font-size: 11px;"><?= html_escape($ap_row['Status']); ?></span>
                              <?php } elseif ($ap_row['DocumentStatusId'] == 1) { ?>
                                  <span class="label label-primary" style="font-size: 11px;"><?= html_escape($ap_row['Status']); ?></span>
                              <?php } elseif ($ap_row['DocumentStatusId'] == 2) { ?>
                                  <span class="label label-warning" title="<?= html_escape($ap_row['CheckerList']); ?>" style="cursor: pointer; font-size: 11px;"><?= html_escape($ap_row['Status']); ?></span>
                              <?php } elseif ($ap_row['DocumentStatusId'] == 3) { ?>
                                  <span class="label label-warning" title="<?= html_escape($ap_row['SignerList']); ?>" style="cursor: pointer; font-size: 11px;"><?= html_escape($ap_row['Status']); ?></span>
                              <?php } elseif ($ap_row['DocumentStatusId'] == 4) { ?>
                                  <span class="label label-success" style="font-size: 11px;"><?= html_escape($ap_row['Status']); ?></span>
                              <?php } elseif ($ap_row['DocumentStatusId'] == 5 || $ap_row['DocumentStatusId'] == 6) { ?>
                                  <span class="label label-danger" style="font-size: 11px;"><?= html_escape($ap_row['Status']); ?></span>
                              <?php } ?>
                                </p>
                              <p>
                                <?= ($ap_row['LastView']) ? $ap_row['LastView'] : "" ?>
                              </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12" style="border-right-style: solid; border-color: #f58c38; border-left-style: solid; border-color: #f58c38; border-width: 1px; min-height: 200px">
                            <div class="col-md-12 col-sm-12 col-xs-12" style=" margin-top: 20px;">
                            <p>
                              <i class="fas fa-user-tie" title="Relationship Manager" style="font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                                <?= html_escape($ap_row['RMName']); ?>
                            </p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4><b>Daftar Member</b></h4>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p>
                                <?php $index_ap = 1; ?>
                                <?php foreach ((array) $ap_row['Member'] as $Member) : ?>
                                    <?= $index_ap ?>. <?= $Member['name'] ?><br> 
                                <?php $index_ap++?>
                                <?php endforeach; ?>
                               </p> 
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4><b>Progress Details</b></h4>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="progress" style="height: 35px; width: 100%;">
                                <div class="progress-bar" data-transitiongoal="<?= html_escape($ap_row['ProgressTotal']); ?>" style="background-color: #e6531b;"></div>
                              </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <p>
                                Overall Progress :                          
                              </p>
                              <p style=" font-size: 37px; color: #262e30; font-weight: bold;">
                                <?= html_escape($ap_row['ProgressTotal']); ?>%                          
                              </p>
                              <p><i class="fa fa-clock" title="Created Date" style="color: #5bc0de;"></i> <?= ($ap_row['AccountPlanningAddon']) ? $ap_row['AccountPlanningAddon'] : "" ?> <?= ($ap_row['AccountPlanningPublish']) ? $ap_row['AccountPlanningPublish'] : "" ?> <?= ($ap_row['dateDiff']) ? $ap_row['dateDiff'] : "" ?></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                  <?php $index++?>
                  <?php endforeach;?>
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



