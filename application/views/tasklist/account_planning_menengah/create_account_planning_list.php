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

</style>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Task List</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/account_planning_menengah/create_account_planning');?>">Create Account Planning Menengah</a></li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="margin-bottom: 0px;">
            <div class="x_content">
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
                  echo form_open("tasklist/account_planning_menengah/create_account_planning/search");
                  ?>
                  <div class="input-group">
                      <input type="text" name="txtcari" id="txtcari" class="form-control" placeholder="Search for..." value="<?= isset($searchTxt) ? $searchTxt : "" ?>">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="submit" style="background: #F58C38; color: white"><i class="material-icons" style="font-size: 14px">search</i></button>
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
                                  <label class="detail_title"><?= html_escape($row["CustomerName"]); ?></label>
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
                              <div class="row form-group">
                                <div class="col-xs-6 col-sm-12">
                                  <div class="row">
                                    <div class="col-xs-2">
                                      <label class="detail_property_text">Total</label>
                                    </div>
                                    <div class="col-xs-10">
                                      <label class="detail_property_text">: <?= $row["PinjamanTotal"]; ?></label>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                  <div class="row">
                                    <div class="col-xs-2">
                                      <label class="detail_property_text">Ratas</label>
                                    </div>
                                    <div class="col-xs-10">
                                      <label class="detail_property_text">: <?= $row["PinjamanRatas"]; ?></label>
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
                              <div class="row form-group">
                                <div class="col-xs-6 col-sm-12">
                                  <div class="row">
                                    <div class="col-xs-2">
                                      <label class="detail_property_text">Total</label>
                                    </div>
                                    <div class="col-xs-10">
                                      <label class="detail_property_text">: <?= $row["SimpananTotal"]; ?></label>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                  <div class="row">
                                    <div class="col-xs-2">
                                      <label class="detail_property_text">Ratas</label>
                                    </div>
                                    <div class="col-xs-10">
                                      <label class="detail_property_text">: <?= $row["SimpananRatas"]; ?></label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                              <div class="row form-group pull-right">
                                <div class="col-xs-12">
                                  <?php
                                    if($row["AccountPlanningMenengahId"] == NULL){
                                      $btnDisabled = "";
                                    }else $btnDisabled = "style='display:none;'";
                                  ?>
                                  <button class="btn btn-warning btn-sm w150 btnCreateAccountPlanning" data-id="<?= $row["CIF"]; ?>" type="button" <?= $btnDisabled; ?>>CREATE</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </form>
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

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".btnCreateAccountPlanning").on("click", function (event) {
        var cif = $(this).data("id");
        createApSubmit(cif);
    });
  }); 

  function createApSubmit(cif){
    $.ajax({
      type: 'post',
      url : $('#createAccountPlanningForm_'+cif).attr('action'),
      data: $('#createAccountPlanningForm_'+cif).serialize(),
      dataType : 'json',
      beforeSend:function(){
        $('.loaderImage').show();
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('.loaderImage').hide();
      },
      success: function(response){
        $('.loaderImage').hide();
        if(response.status === 'success'){
            new PNotify({
                title: 'Success!',
                text: 'Account Planning successfully created.',
                type: 'success',
                styling: 'bootstrap3'
            });
            PNotify.prototype.options.delay = 1200;
            setTimeout(function(){ 
              window.location.href= '<?= base_url(); ?>tasklist/account_planning_menengah/manage_account_planning';
            }, 2000);
        }else if(response.status === 'error'){
            new PNotify({
                title: 'Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });
            PNotify.prototype.options.delay = 1200;
        }
      }
    });
  }
</script>

