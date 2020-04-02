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
      width: 210px; 
      height: 45px;
    }

</style>

<?php $this->load->view('tasklist/disposisi_group_list_rm.php'); ?>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Disposisi</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('tasklist/disposisi');?>">Disposisi Customer Group</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Disposisi</div>
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
                  echo form_open("tasklist/disposisi/search");
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
                          <!--<div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="material-icons detail_property_title_icon">local_activity</i> <b class="detail_property_title">Value Chain</b>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="detail_property_text col-md-4 col-sm-4 col-xs-4" style="margin-left: -20px;">
                              <?=$group_row['ValueChainGroup']?>
                            </div>
                          </div>-->
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" style="height: 2.3px; background: #C6D7EE; box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);"></div>
                      <div class="collapse col-md-12 col-sm-12 col-xs-12" id="collapseExample<?= html_escape($group_row['CustomerGroupId']); ?>" style="background: #E5F0FF; padding: 10px;">
                        <div class="card card-body">
                          <div class="col-md-4 col-sm-4 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">domain</i> <b class="detail_property_title2">Company List</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <?php
                                if (isset($group_row['group_customer_list'])) {
                                ?>
                                  <?php $index_vcif = 1; $jml_cust = 0;?>
                                  <?php foreach ($group_row['group_customer_list'] as $row => $value) : ?>
                                      <div class="col-md-1 col-sm-1 col-xs-12"><?= $index_vcif ?>. </div>
                                      <div class="col-md-11 col-sm-11 col-xs-12"><?= $value['CustomerName'] ?></div> 
                                  <?php $index_vcif++; $jml_cust++;?>
                                  <?php endforeach; ?>
                              <?php } ?>
                            </div>

                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <i class="material-icons detail_property_title_icon">person</i> <b class="detail_property_title2">Relationship Manager</b>
                            </div>
                            <div class="detail_property_text2 col-md-12 col-sm-12 col-xs-12">
                              <?php
                                if (isset($group_row['group_customer_list'])) {
                                ?>
                                  <?php $index_vcif = 1; ?>
                                  <?php foreach ($group_row['rm_selected_list'] as $row => $value) : ?>
                                      <div class="col-md-1 col-sm-1 col-xs-12"><?= $index_vcif ?>. </div>
                                      <div class="col-md-11 col-sm-11 col-xs-12"><?= $value['RMName'] ?> / <?= $value['UkerName'] ?></div> 
                                  <?php $index_vcif++?>
                                  <?php endforeach; ?>
                              <?php } ?>
                            </div>
                          </div>
                         <!-- <div class="col-md-2 col-sm-2 col-xs-12 padding_con">

                          </div> -->

                          <div class="col-md-3 col-sm-3 col-xs-12 padding_con">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <button type="button" class="btn action_buttons w150" onclick="disposisi('<?=$group_row['CustomerGroupId']?>');" id="disposisi_button" <?php if ($jml_cust==0) echo "disabled"; ?>>DISPOSISI</button>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                      <div class="detail_button_con col-md-12 col-sm-12 col-xs-12" data-toggle="collapse" href="#collapseExample<?= html_escape($group_row['CustomerGroupId']); ?>" aria-expanded="true" aria-controls="collapseExample<?= html_escape($group_row['CustomerGroupId']); ?>" style="cursor: pointer;">
                        <a class="detail_button">
                          LIHAT DETAIL GRUP
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
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  function disposisi(CustomerGroupId) {
    $(document).ready(function() {
      $('.loaderImage').show();
      
      var form = $('#addDisposisiModalForm');
      $(form).append('<input type="hidden" name="CustomerGroupId" value="'+CustomerGroupId+'" /> ');

      var rm_per_uker_list = $('#rm_per_uker_list');
      rm_per_uker_list.empty();
      
      var rm_selected_list = $('#rm_selected_list');
      rm_selected_list.empty();

      var totalSelected = 0;

      var x ='<table width="100%" id="table_rm_list_selected" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="40%">Personal Number</td><td width="55%">RM Name</td><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">delete_sweep</i></td></tr></thead>';

      $.getJSON(base_url+'tasklist/disposisi/getRMSelected/'+CustomerGroupId, function (data){
        console.log(data);
        if(data.length > 0){
          x += '<tbody>';
          /*$.each(data, function(index, item){
              x += '<tr class="modal_table_list">';
              x += '<td>' + item.UserId + '</td>';
              x += '<td>' + item.RMName + '</td>';
              x += '<td><label><input name="rm_selected_list[]" value="' + item.UserId + '" type="checkbox" class="flat"></label></td></td>';
              x += '</tr>';
          })
          x += '</tbody>';*/
          $.each(data, function(index, item){
              x += '<tr class="modal_table_list">';
              x += '<td>' + item.UserId + '</td>';
              x += '<td>' + item.RMName + '</td>';
              x += '<td><label><input id="rm_selected_list" name="rm_selected_list[]" value="' + item.UserId + '" type="checkbox" class="flat"></label></td></td>';
              x += '</tr>';
          })
          x += '</tbody>';
        }

        x += '</table>';
        rm_selected_list.append(x);

        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('input').on('ifChecked', function(event){
          totalSelected = totalSelected+1;
          if (totalSelected > 0){
            $("#btn-save-disp").attr("disabled", false);
          }
        });
        $('input').on('ifUnchecked', function(event){
          totalSelected = totalSelected-1;
          if (totalSelected <= 0){
            $("#btn-save-disp").attr("disabled", true);
          }
        });

        $('#table_rm_list_selected').DataTable({
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
      });

      var rm_per_uker_list = $('#rm_per_uker_list');
      rm_per_uker_list.empty();

      var y ='<table width="100%" id="table_rm_per_uker_list" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">check</i></td><td width="40%">Personal Number</td><td width="55%">Name</td></tr></thead>';

      $.getJSON(base_url+'tasklist/disposisi/getRMUnSelected/'+CustomerGroupId, function (data){
        console.log(data);
        if(data.length > 0){
          y += '<tbody>';
          /*$.each(data, function(index, item){
              y += '<tr class="modal_table_list">';
              y += '<td><label><input name="rm_per_uker_list[]" value="'+item.UserId+'" type="checkbox" class="flat"></label></td>';
              y += '<td>' + item.UserId + '</td>';
              y += '<td>' + item.RMName + '</td>';
              y += '</tr>';
          })*/
          $.each(data, function(index, item){
              y += '<tr class="modal_table_list">';
              y += '<td><label><input id="rm_per_uker_list" name="rm_per_uker_list[]" value="' + item.UserId + '" type="checkbox" class="flat")"></label></td></td>';
              y += '<td>' + item.UserId + '</td>';
              y += '<td>' + item.RMName + '</td>';
              y += '</tr>';
          })
          y += '</tbody>';
        }
        y += '</table>';
        rm_per_uker_list.append(y);
        
        $('.loaderImage').hide();

        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('input').on('ifChecked', function(event){
          totalSelected = totalSelected+1;
          if (totalSelected > 0){
            $("#btn-save-disp").attr("disabled", false);
          }
        });
        $('input').on('ifUnchecked', function(event){
          totalSelected = totalSelected-1;
          if (totalSelected <= 0){
           $("#btn-save-disp").attr("disabled", true);
          }
        });
        //$('#tbl_disposisi').DataTable({});
        $('#table_rm_per_uker_list').DataTable({
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
      });
      $('.modal-add-disposisi').modal('show');   
    });
  }

</script>

