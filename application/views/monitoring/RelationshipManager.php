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

</style>
<script type="text/javascript" language="javascript">
// function validateForm() {
//     var x = document.forms["search_txt"]["txtcari"].value;
//     if (x == "") {
//         alert("Masukan kata kunci");
//         return false;
//     }
// }
</script>

<div class="right_col" role="main">
<div class="container">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel container_header">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Monitoring</li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('monitoring/RelationshipManager');?>">Relationship Manager</a></li>
              </ol>
          </nav>
          <div class="x_title">
            <div class="page_title">
                <div class="pull-left">Relationship Manager</div>
            </div>
              <div  class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
      <?php
      $attributes = array('name' => 'search_txt', 'onsubmit' => 'return validateForm()' );
      echo form_open("monitoring/RelationshipManager/search_result", $attributes);
      ?>
                  <div class="input-group">
                      <input type="text" name="txtcari" id="txtcari" class="form-control" placeholder="Search for..." value="<?= ($txtcari) ? $txtcari : "" ?>">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Go!</button>
                      </span>
                  </div>
                </form>
              </div>
              <div class="clearfix"></div>
          </div>
      </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
          <div class="x_content scollable">
<?php
  if (isset($results)) {
  ?>
    <?php $index = 1; ?>
    <?php foreach ($results as $rmuser_id => $rmuser) : ?>
        <div style="box-shadow: 1px 5px 5px #2980b9;" class="x_panel col-md-12 col-sm-12 col-xs-12" style="">
          <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <h3 style="color: #2980b9"><b><?= html_escape($rmuser['RmName']); ?></b></h3>
                  <div style="border-bottom-style: solid; border-color: #2980b9; width: 50px"></div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="height: 30px">
                  <div class="clearfix"></div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 12px;">
                  <p>
                      <i class="fas fa-user-tie" title="Personal Number" style="color: #f58c38; font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                      <?= html_escape($rmuser['PersonalNumber']); ?>
                  </p>
                  <p>
                      <i class="fa fa-calendar" title="Account Planning Year" style="color: #f58c38; font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                      <?= html_escape($rmuser['Year']); ?>
                  </p>
              <!-- </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="height: 10px">
                  <div class="clearfix"></div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 14px;"> -->
                  <p>
                      <i class="fa fa-building" title="Unit Kerja" style="color: #f58c38; font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                      <?= html_escape($rmuser['Division']); ?>
                  </p>
                  <p>
                      <i class="fa fa-clock-o" title="Last login" style="color: #f58c38; font-size: 23px; margin-right: 8px; vertical-align: middle;"></i> 
                      <?php
                      switch (strtotime($rmuser['LastActivity'])) {
                        case '':
                          $LastActivity = '';
                          break;                        
                        default:
                          $LastActivity = date("F j, Y, g:i a", strtotime($rmuser['LastActivity']));
                          break;
                      }
                      ?>
                      <?= html_escape($LastActivity); ?>
                  </p>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12" style="border-left-style: solid; border-color: #2980b9; border-right-style: solid; border-color: #2980b9; border-width: 1px; min-height: 200px">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <h4><b>Daftar Account Planning</b></h4>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="clearfix"></div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="min-height: 170px;">
                  <div class="scollable">
                  <?php $index_ap = 1; ?>
                  <?php foreach ($rmuser['AccountPlanningList'] as $account_planning_list) : ?>
                      <?php  
                        if ($account_planning_list['doc_status'] == 0 || $account_planning_list['doc_status'] == 1) {
                            $ap_icon = 'fa-file-text';
                            $ap_icon_text = 'Draft';
                        }
                        elseif ($account_planning_list['doc_status'] == 2 || $account_planning_list['doc_status'] == 3) {
                            $ap_icon = 'fa-inbox';
                            $ap_icon_text = 'Waiting Approval';
                        }
                        elseif ($account_planning_list['doc_status'] == 4) {
                            $ap_icon = 'fa-check-square';
                            $ap_icon_text = 'Publish';
                        }
                        elseif ($account_planning_list['doc_status'] == 5 || $account_planning_list['doc_status'] == 6) {
                            $ap_icon = 'fa-times-circle';
                            $ap_icon_text = 'Reject';
                        }
                      ?>
                      <div class="col-md-1 col-sm-1 col-xs-1"><?= $index_ap ?>.</div>
                      <div class="col-md-1 col-sm-1 col-xs-1"><i class="fa <?= $ap_icon ?>" title="<?= $ap_icon_text ?>" style="font-size: 11px;"></i></div>
                      <div class="col-md-10 col-sm-10 col-xs-10"><?= trim($account_planning_list['customer_name']); ?></div>
                  <?php $index_ap++?>
                  <?php endforeach; ?>
                  </div> 
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
              <div class="progress" style="height: 35px; width: 100%">
                <div class="progress-bar progress-bar-info" data-transitiongoal="<?= html_escape($rmuser['AccountPlanningProgress']); ?>"></div>
              </div>
              <p>
                <table width="100%">
                    <tr>
                        <td colspan="2" style="font-size: 13px">Overall Progress :</td>
                        <td colspan="2" style="font-size: 13px">Detail Progress :</td>
                    </tr>
                    <tr>
                        <td colspan="4" height="5"></td>
                    </tr>
                    <tr>
                        <td width="50" rowspan="7" colspan="2" valign="middle">
                          <p style=" font-size: 37px; color: #262e30; font-weight: bold;">
                            <?= html_escape($rmuser['AccountPlanningProgress']); ?>%                          
                          </p>
                        </td>
                        <td width="40%"><i class="fa fa-check-square" style="vertical-align: middle;"></i> Publish</td>
                        <td><?= html_escape($rmuser['AccountPlanningPublish']); ?> / <?= html_escape($rmuser['AccountPlanningTotal']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" height="5"></td>
                    </tr>
                    <tr>
                        <td nowrap><i class="fa fa-inbox" style="vertical-align: middle;"></i> Waiting Approval</td>
                        <td><?= html_escape($rmuser['AccountPlanningWa']); ?> / <?= html_escape($rmuser['AccountPlanningTotal']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" height="5"></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-times-circle" style="vertical-align: middle;"></i> Reject</td>
                        <td><?= html_escape($rmuser['AccountPlanningReject']); ?> / <?= html_escape($rmuser['AccountPlanningTotal']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" height="5"></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-file-text" style="vertical-align: middle;"></i> Draft</td>
                        <td><?= html_escape($rmuser['AccountPlanningDraft']); ?> / <?= html_escape($rmuser['AccountPlanningTotal']); ?></td>
                    </tr>
                </table>
              </p>
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
?>          </div>
     </div>
  </div>
</div>
</div>



