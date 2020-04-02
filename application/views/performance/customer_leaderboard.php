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
    .img_Logo {
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

<div class="right_col" role="main">
  <div class="container">
    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel container_header">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Performance</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('performance/CustomerLeaderboard');?>">Customer Leaderboard</a></li>
                  </ol>
              </nav>
              <div class="x_title">
                <div class="page_title">
                    <div class="pull-left">Customer Leaderboard</div>
                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
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

              <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="text-align:right; padding-bottom: 40px">
                <div class="x_title">
                  <ul class="nav panel_toolbox">
                    <li><a class="btn btn-default collapse-link">Search By Filter <i class="fa fa-chevron-down" title="Expand" style="margin-left: 10px"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="x_content" <?= ($search_box) ? $search_box : 'style="display: none;"' ?>>
                <form action="<?=base_url();?>performance/CustomerLeaderboard/search?group_rowno=0" method="get" class="form-horizontal form-label-left" style="background-color: #f4f4f4; padding: 12px 12px 12px 12px; border: 1px solid #d0d0d0">
                  <!-- <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Kerja</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?= $uker_search_box; ?>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Keyword</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="keyword_search_box" id="keyword_search_box" class="form-control col-md-7 col-xs-12" placeholder="Search for..." value="<?= ($keyword_search_box) ? $keyword_search_box : "" ?>">
                      </div>
                  </div>
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

    <div class="group_row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content scollable">
        <?php if (isset($results)) {?>
        <?php $index = 1; ?>
        <?php foreach ($results as $CustomerGroupId => $group_row) : ?>
          <div class="x_panel col-md-12 col-sm-12 col-xs-12" style="padding: 0px; border-radius: 4px;">
            <div class="col-md-12 col-sm-12 col-xs-12" style="min-height: 120px; padding-top: 20px; padding-bottom: 20px;">
              <div class="col-md-4 col-sm-4 col-xs-12" style="padding: 0px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <img class="img-responsive img-circle img_logo" src="<?php if (!file_exists ('uploads/CustomerGroupLogo/'.$group_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/default.png'); elseif (isset($group_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/'.$group_row['Logo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>" style="width: 50px; height: 50px;">
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <h5 class="detail_title"><b><?= $group_row['CustomerGroupName']; ?></b></h5>
                      <span style="font-size: 12px; color: #218FD8;"><b></b></span>
                    </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">Current CPA</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-3 col-sm-3 col-xs-3" style="margin-left: -20px;">
                    Total
                  </div>
                  <div class="detail_property_text col-md-9 col-sm-9 col-xs-9">
                    : <?=$group_row['CurrentCPAGroup']?>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">business_center</i> <b class="detail_property_title"> Pinjaman</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-3 col-sm-3 col-xs-3" style="margin-left: -20px;">
                    Total
                  </div>
                  <div class="detail_property_text col-md-9 col-sm-9 col-xs-9">
                    : <?=$group_row['PinjamanTotalGroup']?>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-3 col-sm-3 col-xs-3" style="margin-left: -20px;">
                    Ratas
                  </div>
                  <div class="detail_property_text col-md-9 col-sm-9 col-xs-9">
                    : <?=$group_row['PinjamanRatasGroup']?>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">account_balance_wallet</i> <b class="detail_property_title">Simpanan</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-3 col-sm-3 col-xs-3" style="margin-left: -20px;">
                    Total
                  </div>
                  <div class="detail_property_text col-md-9 col-sm-9 col-xs-9">
                    : <?=$group_row['SimpananTotalGroup']?>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-3 col-sm-3 col-xs-3" style="margin-left: -20px;">
                    Ratas
                  </div>
                  <div class="detail_property_text col-md-9 col-sm-9 col-xs-9">
                    : <?=$group_row['SimpananRatasGroup']?>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">RoRa</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=$group_row['RoRaGroup']?>
                  </div>
                </div> -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">Raroc</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=$group_row['RarocGroup']?>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 35px; padding-right: 20px;">
                  <button class="btn btn-default btn-xs pull-right" title="Financial Highlight Details" onclick="Modal_Details('<?=$group_row['CustomerGroupId']?>'); return false;" style=" width: 36px; height: 36px;">
                      <i class="material-icons" style="border-radius: 2px; color: #218FD8; font-size: 18px; vertical-align: sub;">insert_chart</i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 2.3px; background: #C6D7EE; box-shadow: 0px 1px 1px rgba(181, 181, 181, 0.17);"></div>
            <div class="collapse col-md-12 col-sm-12 col-xs-12" id="collapseExample<?= $index ?>" style="padding: 10px;">
              <div class="card card-body">
                <div class="col-md-12 col-sm-12 col-xs-12 padding_con">
                    <?php if (!empty($group_row['group_customer_list'])) {?>
                    <table width="100%" id="table_Vcif_lists" class="table" style="font-size: 12px;">
                      <thead style="background-color: transparent; color: #218FD8;">
                        <tr class="modal_table_title">
                          <th width="5%">No</th>
                          <th>Company</th>
                          <th style="text-align: right;">Ratas Pinjaman</th>
                          <th style="text-align: right;">Total Pinjaman</th>
                          <th style="text-align: right;">Ratas Simpanan</th>
                          <th style="text-align: right;">Total Simpanan</th>
                          <!-- <th style="text-align: right;">RoRa</th> -->
                          <th style="text-align: right;">RaRoc</th>
                          <th style="text-align: right;">Current CPA</th>
                       </tr>
                      </thead>
                      <tbody>
                        <?php $indexAP = 1; ?>
                        <?php foreach ($group_row['group_customer_list'] as $group_customer_list => $customer_list) : ?>
                        <tr class="modal_table_list">
                          <td><?= $indexAP; ?></td>
                          <td><a href="<?=base_url('performance/CustomerLeaderboard/details/'.$customer_list['VCIF']);?>" target="_blank" style="color: #218FD8; text-decoration-line: underline;"><?= $customer_list['CustomerName'] ?></a></td>
                          <!-- <td><a href="#" target="_blank" style="color: #218FD8; text-decoration-line: underline;"><?= $customer_list['CustomerName'] ?></a></td> -->
                          <td align="right"><?= $customer_list['PinjamanRatasVCIF'] ?></td>
                          <td align="right"><?= $customer_list['PinjamanTotalVCIF'] ?></td>
                          <td align="right"><?= $customer_list['SimpananTotalVCIF'] ?></td>
                          <td align="right"><?= $customer_list['SimpananRatasVCIF'] ?></td>
                          <!-- <td align="right"><?= $customer_list['RoRaVCIF'] ?></td> -->
                          <td align="right"><?= $customer_list['RarocVCIF'] ?></td>
                          <td align="right"><?= $customer_list['CurrentCPAVCIF'] ?></td>
                        </tr>
                        <?php $indexAP++?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                    <?php } else { ?>
                      <div>No data.</div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="detail_button_con col-md-12 col-sm-12 col-xs-12">
              <a class="detail_button" data-toggle="collapse" href="#collapseExample<?= $index ?>" aria-expanded="true" aria-controls="collapseExample<?= $index ?>">
                LIHAT DETAIL
              </a>
            </div>
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

        <?php if (isset($results)) {?>
        <?php $index = 1; ?>
        <?php foreach ($results as $CustomerGroupId => $group_row) : ?>

<div id="Modal_Details_<?=$CustomerGroupId;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
          <div class="modal_property_title paddingleft_con">
            <i class="material-icons" style="vertical-align: middle;">insert_chart</i> <?= $group_row['CustomerGroupName']; ?>
          </div>
        </div>
        <div class="modal-body" style="height: 320px;">
            <div class="col-xs-12">
              <span>Derived Variables</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #C4C4C4;">
              <p id="DSRI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">DSRI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['DSRI'], 4)?>
                  </div>
                </div>
              </p>
              <p id="GMI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">GMI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['GMI'], 4)?>
                  </div>
                </div>
              </p>
              <p id="AQI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">AQI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['AQI'], 4)?>
                  </div>
                </div>
              </p>
              <p id="SGI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">SGI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['SGI'], 4)?>
                  </div>
                </div>
              </p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <p id="DEPI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">DEPI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['DEPI'], 4)?>
                  </div>
                </div>
              </p>
              <p id="SGAI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">SGAI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['SGAI'], 4)?>
                  </div>
                </div>
              </p>
              <p id="LIVIGI">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">LIVIGI</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['LIVIGI'], 4)?>
                  </div>
                </div>
              </p>
              <p id="TATA">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">TATA</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8">
                    <?=number_format($group_row['GroupFHCalc']['TATA'], 4)?>
                  </div>
                </div>
              </p>
            </div>
            <div class="col-xs-12" style="margin-top: 10px;">
              <span>M-Score</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #C4C4C4;">
              <p id="MODEL5V">
                <?php number_format($group_row['GroupFHCalc']['Model5V'], 3) > -2.22? $style5V = "color:#FF0000;": $style5V = ""; ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">5 Variable Model</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8" style="<?= $style5V; ?>">
                    <?=number_format($group_row['GroupFHCalc']['Model5V'], 3)?>
                  </div>
                </div>
              </p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <p id="MODEL8V">
                <?php number_format($group_row['GroupFHCalc']['Model8V'], 3) > -2.22? $style8V = "color:#FF0000;": $style8V = ""; ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <i class="material-icons detail_property_title_icon">insert_chart</i> <b class="detail_property_title">8 Variable Model</b>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="detail_property_text col-md-8 col-sm-8 col-xs-8" style="<?= $style8V; ?>">
                    <?=number_format($group_row['GroupFHCalc']['Model8V'], 3)?>
                  </div>
                </div>
              </p>
            </div>
        </div>
        <div class="modal-footer" style="text-align: center;">
          <button type="button" class="btn btn-default w150" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>

        <?php endforeach;?>
        <?php } ?>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  function Modal_Details(CustomerGroupId) {
    $('#Modal_Details_' + CustomerGroupId).modal('show');
    $('#OK_clone').attr('CustomerGroupId', CustomerGroupId);
  }


</script>
