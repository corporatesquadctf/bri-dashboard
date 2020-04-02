<style>
  .show-more {
    margin: 0;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    background: #218FD8;
    box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    cursor: pointer;
  }
  .show-more a {
    display: block;
    padding: 5px;
    color: #FFF;
    text-align: center;
  }
  .show-more label {
    cursor: pointer;
    font-size: 12px;
    font-weight: normal;
    margin-bottom:0;
  }
  table {
    width: 100%;
    table-layout: fixed;
    margin-bottom: 5px;
  }
  thead {
    background: transparent;
    margin-bottom: 5px;
  }
  th {
    color: #4BB8FF;
    font-size: 12px;
    padding: 5px 8px;
  }
  td {
    color: #8F8F8F;
    font-size: 12px;
    padding: 0 8px;
    vertical-align: top;
  }
</style>
<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Approval</li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('confirmation/approver');?>">Approver</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="margin-bottom: 0px;">
                <div class="x_title">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <i class="material-icons detail_head_title_icon">album</i> Value <sub style="font-size: 60%;">UNIT</sub>
                            <div style="margin-top: 10px;margin-left: 20px">
                                <span style="font-size: 11px;">In <?= VALUE_UNIT ?></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <i class="material-icons detail_head_title_icon">business_center</i> Pinjaman <sub style="font-size: 60%;">LAST UPADATE</sub>
                            <div style="margin-top: 10px;margin-left: 20px">
                                <span style="font-size: 11px;">Total: <?= $totalPinjamanLastUpdateDate ?></span>
                                <br>
                                <span style="font-size: 11px">Ratas: <?= $ratasPinjamanLastUpdateDate ?></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <i class="material-icons detail_head_title_icon">account_balance_wallet</i> Simpanan <sub style="font-size: 60%;">LAST UPADATE</sub>
                            <div style="margin-top: 10px;margin-left: 20px">
                                <span style="font-size: 11px;"> Total: <?= $totalSimpananLastUpdateDate ?></span>
                                <br>
                                <span style="font-size: 11px;"> Ratas: <?= $ratasSimpananLastUpdateDate ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="text-align:right">
                        <?php
                        echo form_open('confirmation/approver/search');
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
      <div class="col-xs-12">
          <div class="x_panel no-padding" style="border: none;">
              <div class="x_content content-container">
              <?php
                if (!empty($result)) {
                  foreach ($result as $row) : 
              ?>
                    <div class="row no-margin">
                    <form class="form-horizontal form-label-left cmxform" id="createAccountPlanningForm_<?= $row["CIF"]; ?>" method="POST" action="<?= site_url('tasklist/account_planning_menengah/create_account_planning/process_create') ?>">
                      <input type="hidden" id="cif" name="cif" value="<?= $row["CIF"]; ?>">
                      <div class="col-xs-12 customer-header">
                        <div class="row">
                          <div class="col-xs-12 col-sm-4">
                            <div class="row form-group">
                              <div class="col-xs-12">
                                <label class="detail_title" style="font-size: 16px; line-height: 22px; letter-spacing: 0.5px; color: #252525;"><?= html_escape($row["CustomerName"]); ?></label>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col-xs-12">
                                <div class="row">
                                  <div class="col-xs-12">
                                    <i class="fa fa-calendar" title="Account Planning Year" style="font-size: 14px; margin-right: 6px; vertical-align: middle;"></i>
                                    <label style="font-size: 12px; color: <?= $row['ap_year_color'] ?>; font-weight: bold;"><?= html_escape($row['Year']); ?></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <div class="row form-group">
                              <div class="col-xs-12">
                                <i class="material-icons detail_property_title_icon">business_center</i>
                                <label class="detail_property_title">Pinjaman</label>
                              </div>
                            </div>
                            <div class="row form-group" style="margin-top: 13px;">
                              <div class="col-xs-6 col-sm-12">
                                <div class="row">
                                  <div class="col-xs-2">
                                    <label class="detail_property_text">Total</label>
                                  </div>
                                  <div class="col-xs-10">
                                    <label class="detail_property_text">: <?= $row["PinjamanTotalAP"]; ?></label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-6 col-sm-12">
                                <div class="row">
                                  <div class="col-xs-2">
                                    <label class="detail_property_text">Ratas</label>
                                  </div>
                                  <div class="col-xs-10">
                                    <label class="detail_property_text">: <?= $row["PinjamanRatasAP"]; ?></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-3">
                            <div class="row form-group">
                              <div class="col-xs-12">
                                <i class="material-icons detail_property_title_icon">account_balance_wallet</i>
                                <label class="detail_property_title">Simpanan</label>
                              </div>
                            </div>
                            <div class="row form-group" style="margin-top: 13px;">
                              <div class="col-xs-6 col-sm-12">
                                <div class="row">
                                  <div class="col-xs-2">
                                    <label class="detail_property_text">Total</label>
                                  </div>
                                  <div class="col-xs-10">
                                    <label class="detail_property_text">: <?= $row["SimpananTotalAP"]; ?></label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-6 col-sm-12">
                                <div class="row">
                                  <div class="col-xs-2">
                                    <label class="detail_property_text">Ratas</label>
                                  </div>
                                  <div class="col-xs-10">
                                    <label class="detail_property_text">: <?= $row["SimpananRatasAP"]; ?></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                              <div class="row form-group pull-right">
                                <div class="col-xs-12">
                                  <button class="btn btnViewAccountPlanning" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" data-id="<?= $row["AccountPlanningMenengahId"]; ?>" type="button" >VIEW ACCOUNT PLANNING</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    </div>
                    <div class="row" id="collapseCommentAccountPlanning_<?= $row["AccountPlanningMenengahId"]; ?>" style="margin: 0; display: none; background: #E5F0FF;">
                      <input type="hidden" id="collapseCommentAccountPlanning_<?= $row["AccountPlanningMenengahId"]; ?>" value="0">
                      <div class="col-xs-12" style="padding: 0 35px; margin:10px 0; ">
                      <?php
                        if(!empty($row["CommentAP"])){
                          echo "<table style='width: 100%;'>";
                          echo "  <thead>";
                          echo "    <tr>";
                          echo "      <th style='width: 5%;'>No</th>";
                          echo "      <th style='width: 25%;'>Approver</th>";
                          echo "      <th style='width: 10%;'>Status</th>";
                          echo "      <th style='width: 45%;'>Comment</th>";
                          echo "      <th style='width: 15%;'>Date</th>";
                          echo "    </tr>";
                          echo "  </thead>";
                          echo "  <tbody>";
                          $i = 1;
                          foreach($row["CommentAP"] as $rowComment) {
                            $createdDate = date("d-m-Y", strtotime($rowComment->CreatedDate));
                      ?>
                          <tr>
                            <td><?= $i; ?>.</td>
                            <td class="hyphenate"><?= $rowComment->ApproverName; ?></td>
                            <td class="hyphenate"><?= $rowComment->DocumentStatusName; ?></td>
                            <td class="hyphenate"><?= $rowComment->Comment; ?></td>
                            <td class="hyphenate"><?= $createdDate; ?></td>
                        </tr>
                      <?php
                            $i++;
                          }
                          echo "</tbody>";
                          echo "</table>";
                        }else{
                          echo '<div class="row" style="margin:0;">';
                          echo    '<div class="col-xs-12" style="text-align:center; font-size: 12px;">';
                          echo    'Belum Ada Detail Komentar';
                          echo    '</div>';
                          echo '</div>';
                        }
                      ?>
                      </div>
                    </div>
                    <div class="row show-more" id="divCommentAccountPlanning_<?= $row["AccountPlanningMenengahId"]; ?>" data-id="<?= $row["AccountPlanningMenengahId"]; ?>">
                      <div class="col-xs-12">
                        <a>
                          <label id="labelCommentAccountPlanning_<?= $row["AccountPlanningMenengahId"]; ?>">Tampilkan Komentar<i class="fa fa-chevron-down" style="margin-left:10px;"></i></label>
                        </a>
                      </div>
                    </div>
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

<script>
  $(".btnViewAccountPlanning").on("click", function (event) {
    var apMenengahId = $(this).data("id");
    window.location.href = "<?= base_url("confirmation/approver/view/");?>"+apMenengahId;
  });

  $(document).ready(function() {
    $(".show-more").click(function(){
      var id = $(this).data("id");
      var collapseStatus = $("#collapseCommentAccountPlanning_"+id).val();
      if(collapseStatus == 0){
        $("#collapseCommentAccountPlanning_"+id).val(1);
        $("#labelCommentAccountPlanning_"+id).html("Tutup Komentar <i class='fa fa-chevron-up' style='margin-left:10px;'></i>");
        $("#collapseCommentAccountPlanning_"+id).fadeIn();                
      }else{
        $("#collapseCommentAccountPlanning_"+id).val(0);
        $("#labelCommentAccountPlanning_"+id).html("Tampilkan Komentar <i class='fa fa-chevron-down' style='margin-left:10px;'></i>");
        $("#collapseCommentAccountPlanning_"+id).fadeOut();                
      }
    });
  });
</script>