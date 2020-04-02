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
      margin-left: -10px;
    }
    .detail_head_title_icon {
      font-weight: 600;
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
      margin-left: -10px;
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
      width: 210px; 
      height: 45px;
    }

</style>

<?php //$this->load->view('tasklist/disposisi_group_list_rm.php'); ?>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Tasklist</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/MyTask');?>">My Task</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Create Account Planning</div>
                    </div>
                </div>
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
                <!--<div class="col-md-3 col-sm-3 col-xs-12">
                   <i class="material-icons detail_head_title_icon">local_activity</i> Value Chain
                  <br>
                  In Million 
                </div>-->
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="text-align:right">
                 <?php
                  //$attributes = array('name' => 'search_txt', 'onsubmit' => 'return validateForm()' );
                  echo form_open("tasklist/MyTask/search");//, $attributes);
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
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
              <?php
                if (isset($results)) {
                  $data_id = 1;
                ?>
                  <?php foreach ($results as $group_id => $group_row) : ?>
                    <div class="x_panel col-md-12 col-sm-12 col-xs-12" style="padding: 0px; border-radius: 4px;">
                      <div class="col-md-12 col-sm-12 col-xs-12" style="min-height: 120px; padding-top: 20px; padding-bottom: 20px;">
                        <div class="col-md-4 col-sm-4 col-xs-12" style="padding: 0px;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                <img class="img-responsive img-circle img_logo" src="<?php if (!file_exists ('uploads/CustomerGroupLogo/'.$group_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/default.png'); elseif (isset($group_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/'.$group_row['Logo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>" style="width: 50px; height: 50px;">
                              </div>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <h5 class="detail_title"><b><?= html_escape($group_row['CustomerGroupName']); ?></b></h5>
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
                              : <?=$group_row['PinjamanTotalGroup']?>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Ratas
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$group_row['PinjamanRatasGroup']?>
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
                              : <?=$group_row['SimpananTotalGroup']?>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              Ratas
                            </div>
                            <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                              : <?=$group_row['SimpananRatasGroup']?>
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
                              : <?=$group_row['CurrentCPAGroup']?>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- <i class="material-icons detail_property_title_icon">local_activity</i> <b class="detail_property_title">Value Chain</b> -->
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              <?=$group_row['ValueChainGroup']?>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" style="height: 2.3px; background: #C6D7EE; box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);""></div>
                      <div class="collapse col-md-12 col-sm-12 col-xs-12" id="collapseExample<?= html_escape($group_row['CustomerGroupId']); ?>" style="background: #E5F0FF; padding: 10px;">
                        <div class="card card-body">
                          <!-- <div class="col-md-12 col-sm-12 col-xs-12 padding_con"> -->
                          <form class="form-horizontal form-label-left cmxform" id="createAccountPlanningForm_<?= $group_row['CustomerGroupId'] ?>" method="POST" action="<?= site_url('tasklist/MyTask/create_ap') ?>">
                            <table width="100%">
                              <?php if (isset($group_row['group_customer_list'][$group_row['CustomerGroupId']])) { ?>
                              <?php $index_vcif = 1; ?>
                              <?php foreach ($group_row['group_customer_list'][$group_row['CustomerGroupId']] as $row => $value) : ?>
                                <tr style="vertical-align: top;">
                                  <td width="5%" rowspan="2" align="right" valign="top">
                                    <label class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                      <?php
                                      if (isset($value['AccountPlanningId'])) {
                                      ?>
                                        <i class="material-icons detail_property_title_icon">lock</i> 
                                      <?php
                                      } else {
                                      ?>
                                        <input name="VCIF[]" value="<?= $value['VCIF'] ?>" type="checkbox" class="flat cbCompany">
                                      <?php } ?>
                                    </label>
                                  </td>
                                  <td width="25%">
                                    <label class="col-md-12 col-sm-12 col-xs-12">
                                      <i class="material-icons detail_property_title_icon">domain</i> <b class="detail_property_title2" style="color: #218FD8;"><?= $value['CustomerName'] ?></b>
                                    </label>
                                  </td>
                                  <td width="20%">
                                    <label class="col-md-12 col-sm-12 col-xs-12">
                                      <i class="material-icons detail_property_title_icon">business_center</i> <b class="detail_property_title2">Pinjaman</b>
                                    </label>
                                  </td>
                                  <td width="20%">
                                    <label class="col-md-12 col-sm-12 col-xs-12">
                                      <i class="material-icons detail_property_title_icon">account_balance_wallet</i> <b class="detail_property_title2">Simpanan</b>
                                    </label>
                                  </td>
                                  <td width="15%">
                                      <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title2">Current CPA</b>
                                  </td>
                                  <td width="15%">
                                      <!-- <i class="material-icons detail_property_title_icon">local_activity</i> <b class="detail_property_title2">Value Chain</b> -->
                                  </td>
                                </tr>
                                <tr style="vertical-align: top;">
                                  <td>
                                    <?php
                                      if (!isset($value['AccountPlanningId'])) {
                                      ?>
                                    <label class="col-md-12 col-sm-12 col-xs-12 detail_property_title2" style="padding-top: 5px;">
                                      <input name="IsMain" value="<?= $value['VCIF'] ?>" type="radio" class="flat detail_property_title2 radioMain" data-id="<?= $data_id ?>" required disabled>
                                      Main Company
                                    </label>
                                  <?php } ?>
                                  </td>
                                  <td>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                      <label class="col-md-3 col-sm-3 col-xs-12">
                                        <b class="detail_property_text2">Total</b>
                                      </label>
                                      <label class="col-md-9 col-sm-9 col-xs-12">
                                         <span class="detail_property_title2"> : <?= $value['PinjamanTotal'] ?></span>
                                      </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                      <label class="col-md-3 col-sm-3 col-xs-12">
                                        <b class="detail_property_text2">Ratas</b>
                                      </label>
                                      <label class="col-md-9 col-sm-9 col-xs-12">
                                         <span class="detail_property_title2"> : <?= $value['PinjamanRatas'] ?></span>
                                      </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                      <label class="col-md-3 col-sm-3 col-xs-12">
                                        <b class="detail_property_text2">Total</b>
                                      </label>
                                      <label class="col-md-9 col-sm-9 col-xs-12">
                                         <span class="detail_property_title2"> : <?= $value['SimpananTotal'] ?></span>
                                      </label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                      <label class="col-md-3 col-sm-3 col-xs-12">
                                        <b class="detail_property_text2">Ratas</b>
                                      </label>
                                      <label class="col-md-9 col-sm-9 col-xs-12">
                                         <span class="detail_property_title2"> : <?= $value['SimpananRatas'] ?></span>
                                      </label>
                                    </div>
                                  </td>
                                  <td>
                                    <label class="col-md-3 col-sm-3 col-xs-12">
                                        <b class="detail_property_text2">Total</b>
                                      </label>
                                    <label class="col-md-9 col-sm-9 col-xs12">
                                      <b class="detail_property_title2"> : <?= $value['CurrentCPA'] ?></b>
                                  </td>
                                  <td>
                                    <label class="col-md-12 col-sm-12 col-xs-12">
                                      <!-- <b class="detail_property_title2" style="margin-left: -20px;"><?= $value['ValueChain'] ?></b> -->
                                    </label>
                                  </td>
                                </tr>
                              <?php $index_vcif++?>
                              <?php endforeach; ?>
                              <?php } ?>
                              <tr>
                                <td colspan="6" style="text-align: right;">
                                  <button class="btn btn-warning btn-sm w150" type="button" id="btn-submit-<?= $data_id ?>" onclick="createApSubmit(<?= $group_row['CustomerGroupId'] ?>)" disabled>CREATE</button>
                                </td>
                              </tr>
                            </table>
                            <div class="clearfix"></div>
                          </form>
                        </div>
                      </div>
                      <div class="detail_button_con col-md-12 col-sm-12 col-xs-12" data-toggle="collapse" href="#collapseExample<?= html_escape($group_row['CustomerGroupId']); ?>" aria-expanded="true" aria-controls="collapseExample<?= html_escape($group_row['CustomerGroupId']); ?>" style="cursor: pointer;">
                        <a class="detail_button">
                          LIHAT DETAIL GRUP
                        </a>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $data_id++?>
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


<!-- Modal -->
<!--<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to create this Account Planning?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="noButton">No</button>
        <button type="button" class="btn btn-primary" id="yesButton">Yes</button>
      </div>
    </div>
  </div>
</div>
-->
<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

 

$(document).ready(function() {
  $('.cbCompany').on('ifChecked', function(event){
    $(".radioMain[value="+$(this).val()+"]").iCheck('enable');
  });

  $('.cbCompany').on('ifUnchecked', function(){
    $(".radioMain[value="+$(this).val()+"]").iCheck('disable');
    $(".radioMain[value="+$(this).val()+"]").iCheck('uncheck');
  });

  $('.radioMain').on('ifChecked', function(event){
    $("#btn-submit-"+$(this).data('id')).attr("disabled", false);
  });

  $('.radioMain').on('ifUnchecked', function(event){
    $("#btn-submit-"+$(this).data('id')).attr("disabled", true);
  });
});

function createApSubmit(groupId){
  $.ajax({
    type: 'post',
    url : $('#createAccountPlanningForm_'+groupId).attr('action'),
    data: $('#createAccountPlanningForm_'+groupId).serialize(),
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
            window.location.href= base_url+'tasklist/AccountPlanning';
          }, 2000);
      }else if(response.status === 'error'){
          new PNotify({
              title: 'Error!',
              text: response.message,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1200;
          // $("#confirmModal").modal('hide');
      }
    }
  });
}

</script>



