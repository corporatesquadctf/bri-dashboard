<style type="text/css">
    .content-container{
        padding: 0; 
        background: #FBFBFB; 
        margin-top: 0px;
    }
    .no-margin{
        margin: 0;
    }
    .customer-header{
        margin-top: 10px;
        padding: 10px 25px;
        background: #FFF;
        box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);
        border-radius: 4px;
    }
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
      font-size: 16px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.15px;
      color: #707070;
      vertical-align: middle;
      margin-bottom: 2px;
      margin-left: 5px;
    }
    .detail_property_title2 {
      font-weight: 600;
      font-size: 12px;
      line-height: 136.89%;
      align-items: center;
      letter-spacing: 0.15px;
      color: #707070;
      vertical-align: middle;
      margin-bottom: 0px;
    }
    .modal_property_title {
      font-weight: 600;
      font-size: 14px;
      line-height: 34px;
      align-items: center;
      letter-spacing: 0.5px;
      color: #2980B9;
    }
    .modal_table_title {
      font-weight: 600;
      font-size: 14px;
      line-height: 22px;
      align-items: center;
      letter-spacing: 0.25px;
      color: rgba(0, 0, 0, 0.8);
    }
    .modal_table_list {
      font-weight: normal;
      font-size: 13px;
      line-height: 22px;
      align-items: center;
      letter-spacing: 0.15px;
      color: rgba(0, 0, 0, 0.8);
    }
    .detail_property_title_icon {
      font-size: 15px;
      color: #218FD8;
      vertical-align: middle;
    }
    .detail_head_title_icon {
      font-weight: 600;
      font-size: 16px;
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
    .action_buttons, .action_buttons:hover, .action_buttons:focus {
      font-size: 12px; 
      line-height: 136.89%; 
      letter-spacing: 0.15px; 
      background: #F58C38; 
      border-radius: 2px; 
      color: #fff; 
    }
    .search-form{
        margin-bottom: 0px;
        font-weight: normal;
    }
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
                      <li class="breadcrumb-item">Task List</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/manage_account_planning');?>">Manage Account Planning Menengah</a></li>
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
                <a class="collapse-link btn w150 btn-sm btn-default" style="margin-bottom:0px;"><label class="search-form">Show Filter</label></a>
              </div>
            </div>
            <div class="x_content" id="filter-content" style="display:none;" >
              <form action="<?=base_url();?>tasklist/account_planning_menengah/manage_account_planning/search" method="post" class="form-horizontal form-label-left" style="background-color: #f4f4f4; padding: 12px 12px 12px 12px; border: 1px solid #d0d0d0">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control js-example-basic-single" id="tahun_search_box" name="tahun_search_box" style="width:100%;">
                      <?php
                        foreach ($yearOption as $row){
                          $selected = '';
                          if($year_search_box == $row["id"]) $selected = 'selected="selected"';
                          echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control js-example-basic-single" id="status_search_box" name="status_search_box" style="width:100%;">
                      <?php 
                        if($status_search_box == -1) $selectedAll = "selected='selected'";
                        else $selectedAll = "";
                      ?>
                      <option value="all" <?= $selectedAll; ?>>All Status</option>
                    <?php
                      foreach ($docStatusOption as $row){
                        $selectedDocStatus = '';
                        if($status_search_box == $row["DocumentStatusId"]) $selectedDocStatus = 'selected="selected"';
                        echo '<option value="'.$row["DocumentStatusId"].'" '.$selectedDocStatus.'>'.$row["Name"].'</option>';
                      }
                    ?>
                    </select>
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
                    <button class="btn btn-default" style="background: #F58C38;color: white" type="submit">Search</button>
                  </div>
                </div>
              </form>
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
                                <label class="detail_title"><?= html_escape($row["CustomerName"]); ?></label>
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
                              <div class="col-xs-12">
                                <div class="row">
                                  <div class="col-xs-12">
                                    <i class="fa fa-flag" title="Account Planning Year" style="font-size: 14px; margin-right: 6px; vertical-align: middle;"></i>
                                    <label style="font-size: 12px; color: <?= $row['ap_status_color'] ?>; font-weight: bold;"><?= html_escape($row['Status']); ?></label>
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
                                  <?php 
                                  if($row["DocumentStatusId"] == 0 || $row["DocumentStatusId"] == 1){
                                    $btnText = $row["DocumentStatusId"] == 0 ? "INPUT" : "EDIT" ;
                                  ?>
                                  <button class="btn btnInputAccountPlanning" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" data-id="<?= $row["AccountPlanningMenengahId"]; ?>" type="button" ><?= $btnText; ?> ACCOUNT PLANNING</button>
                                  <?php
                                  }else{
                                  ?>
                                  <button class="btn btnRetrieveAccountPlanning" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px; margin-bottom: 5px;" data-id="<?= $row["AccountPlanningMenengahId"]; ?>" type="button" >UPDATE ACCOUNT PLANNING</button>
                                  <button class="btn btnInputAccountPlanning" style="font-size: 10px; line-height: 136.89%; letter-spacing: 0.15px; background: #F58C38; border-radius: 2px; color: #fff; width: 210px; height: 45px;" data-id="<?= $row["AccountPlanningMenengahId"]; ?>" type="button" >VIEW ACCOUNT PLANNING</button>
                                  <?php
                                  }
                                  ?>
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

  <div class="modal fade modal-retrieve" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="accountPlanningSelected" name="accountPlanningSelected" value="" />
          <p>You want to update account planning, it will change status back to Draft. Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">No</button>
          <button id="btn-save-confirmation" type="button" class="btn w150 btn-primary modal-button-ok">Yes</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script type="text/javascript">
  var hide = <?= $hideFilter; ?>;
  $(document).ready(function() {
    $('.js-example-basic-single').select2();

    if(hide == 1){
      $('.search-form').html('Show Filter');
      $("#filter-content").hide();
    }else{
      $('.search-form').html('Hide Filter');
      $("#filter-content").show();
    }

    $('.collapse-link').click(function(){
        if(hide == 1){
            $('.search-form').html('Hide Filter');
            hide = 0;
        }else{
            $('.search-form').html('Show Filter');
            hide = 1;
        }
    });

    $(".btnInputAccountPlanning").on("click", function (event) {
        var apMenengahId = $(this).data("id");
        window.location.href = "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/input/");?>"+apMenengahId;
    });

    $(".btnRetrieveAccountPlanning").click(function(){
      var apMenengahId = $(this).data("id");
      $(".modal-retrieve #accountPlanningSelected").val(apMenengahId);
      $(".modal-retrieve").modal("show");
    });

    $("#btn-save-confirmation").on("click", function (event) {
      var apMenengahId = $(".modal-retrieve #accountPlanningSelected").val();
      $.ajax({
        type: "GET",
        url: "<?= base_url("tasklist/account_planning_menengah/manage_account_planning/retrieve_account_planning/")?>" + apMenengahId,
        data: "",
        dataType: "json",
        beforeSend: function() {
          $(".modal-retrieve").modal("hide");
          $(".loaderImage").show();
        },
        success:function(response) {
          $(".loaderImage").hide();
          if(response.status === "success"){
            new PNotify({
                title: "Success!",
                text: "Account Planning successfully Retrieved.",
                type: 'success',
                styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
            setTimeout(function(){ 
              window.location.href= "<?= base_url("tasklist/account_planning_menengah/manage_account_planning");?>";
            }, 2000);                
          }else if(response.status === "error"){
            new PNotify({
                title: "Error!",
                text: response.message,
                type: "error",
                styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          $(".loaderImage").hide();
          $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
          $(".modal-error-notification").modal("show");
        }
      });
    });

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

