<style type="text/css">
  button {
   font-size: 14px !important; 
  }
 .cpa_active {
   background-color: #FFFFFF; 
   color: #2980B9 !important; 
   font-weight: bold !important; 
   border-radius: 0px;
   box-shadow: 0px 5px 0px #2980B9;

 } 
 .cpa_nonactive {
   background-color: #FFFFFF; 
 }
 thead{
  background: #FFFFFF; 
  /*box-shadow: 0px 4px 4px #EDEDED; */
  border-radius: 5px 5px 0px 0px;
 }
 th {
  height: 56px; 
  color: #4BB8FF; 
  font-size: 12px; 
  padding: 8px;
  vertical-align: middle !important;
  text-align: center;
 }
 tr {
   /*box-shadow: 0 4px 4px #EDEDED;*/
 }
 td {
   background: #FFFFFF; 
   min-height: 56px; 
   color: #8F8F8F; 
   font-size: 12px; 
   padding: 8px; 
   vertical-align: top; 
   border-top: 1px solid #ddd; 
   font-weight: bold;
 }
</style>

<div id="content_detail_Simulation">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel row content_container shadow_content_container">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                    <div class="row form_actions">
                      <div style="text-align: left; padding-left: 20px;">
                        <button class="btn btn-sm cpa_nonactive" type="button" style="width: 32%;" id="button_detail_cpa_existing" tab_panel="existing" AccountPlanningId="<?= $account_planning['AccountPlanningId'] ?>">CPA Existing</button>
                        <button class="btn btn-sm cpa_active" type="button" style="width: 32%;" id="button_detail_cpa_projection" tab_panel="projection" AccountPlanningId="<?= $account_planning['AccountPlanningId'] ?>">CPA Projection</button>
                        <button class="btn btn-sm cpa_nonactive" type="button" style="width: 32%;" id="button_detail_cpa_delta" tab_panel="delta" AccountPlanningId="<?= $account_planning['AccountPlanningId'] ?>">CPA Delta</button>
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row marginstop_con">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel row content_container shadow_content_container" style="padding-bottom: 10px;">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h3>CPA Projection</h3>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordion_Credit_assumption" role="tablist" aria-multiselectable="true">
                <div class="panel">
                  <a class="panel-heading" role="tab" id="headingCredit_assumption" data-toggle="collapse" data-parent="#accordion_Credit_assumption" href="#collapseCredit_assumption" aria-expanded="true" aria-controls="collapseCredit_assumption" style="border-bottom: 1px solid #ddd;">
                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Assumption</h4>
                  </a>
                  <div id="collapseCredit_assumption" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingCredit_assumption">
                    <div class="panel-body" style="padding: 0px;">
                        <div class="row content_container shadow_content_container">
                            <div class="x_title row collapse-link" style="padding:0; margin:0;">
                              <div class="col-xs-12">
                                  <div class="col-xs-12" style="padding: 10px 15px 5px 10px;">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                      <span style="color: #4BB8FF;">Kurs USD : <label class="money"><?= $Projection['Assumption']['USDExchange'] ?></label></span>
                                    </div>
                                    <div class="col-xs-3 pull-right">
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                                  <table width="100%" class="table" cellpadding="5" cellspacing="5" style="font-size: 12px;">
                                    <thead style="background-color: #FFFFFF; color: #4BB8FF; font-weight: bold; font-size: 13px;" >
                                      <tr class="modal_table_title">
                                        <th style="text-align: left; width: 5%;">No</th>
                                        <th style="text-align: left; width: 60%;">FTP</th>
                                        <th style="text-align: center;">IDR (%)</th>
                                        <th style="text-align: center;">Valas (%)</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td style="text-align: left;">1</td>
                                        <td style="text-align: left;">FTP Simpanan</td>
                                        <td style="text-align: center;">
                                          <label class="money"><?= $Projection['Assumption']['IDRFTPSimpanan'] ?></label> %
                                        </td>
                                        <td style="text-align: center;">
                                          <label class="money"><?= $Projection['Assumption']['ValasFTPSimpanan'] ?></label> %
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="text-align: left;">2</td>
                                        <td style="text-align: left;">FTP Pinjaman</td>
                                        <td style="text-align: center;">
                                          <label class="money"><?= $Projection['Assumption']['IDRFTPPinjaman'] ?></label> %
                                        </td>
                                        <td style="text-align: center;">
                                          <label class="money"><?= $Projection['Assumption']['ValasFTPPinjaman'] ?></label> %
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordion_cpa_projection_simpanan" role="tablist" aria-multiselectable="true">
                <div class="panel">
                  <a class="panel-heading" role="tab" id="headingcpa_projection_simpanan" data-toggle="collapse" data-parent="#accordion_cpa_projection_simpanan" href="#collapsecpa_projection_simpanan" aria-expanded="true" aria-controls="collapsecpa_projection_simpanan" style="border-bottom: 1px solid #ddd;">
                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Simpanan</h4>
                  </a>
                  <div id="collapsecpa_projection_simpanan" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingcpa_projection_simpanan">
                    <div class="panel-body" style="padding: 0px;">
                        <div class="row content_container shadow_content_container">
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 0;">
                                  <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                      <thead>
                                          <tr>
                                              <!-- <th style="width: 3%">No</th> -->
                                              <th style="width: 40%; text-align: left;">Keterangan</th>
                                              <th style="text-align: right; padding-right: 20px;">IDR</th>
                                              <th style="text-align: right; padding-right: 20px;">Valas</th>
                                              <th style="text-align: right; padding-right: 20px;">Total</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <!-- <td align="left">1</td> -->
                                              <td >Saldo </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['IDRSaldo']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['ValasSaldo']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['TotalSaldo']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <!-- <td align="left">2</td> -->
                                              <td >Ratas Harian Saldo </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['IDRRatas']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['ValasRatas']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['TotalRatas']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <!-- <td align="left">3</td> -->
                                              <td >Fee Based Income </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['IDRFeeBased']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['ValasFeeBased']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['TotalFeeBased']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <!-- <td align="left">4</td> -->
                                              <td >Beban Bunga </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['IDRBebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['ValasBebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['TotalBebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <!-- <td align="left">5</td> -->
                                              <td >Beban Bunga Akumulasi </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['IDRBebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['ValasBebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Simpanan']['TotalBebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordion_cpa_projection_pinjaman" role="tablist" aria-multiselectable="true">
                <div class="panel">
                  <a class="panel-heading" role="tab" id="headingcpa_projection_pinjaman" data-toggle="collapse" data-parent="#accordion_cpa_projection_pinjaman" href="#collapsecpa_projection_pinjaman" aria-expanded="true" aria-controls="collapsecpa_projection_pinjaman" style="border-bottom: 1px solid #ddd;">
                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Pinjaman</h4>
                  </a>
                  <div id="collapsecpa_projection_pinjaman" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingcpa_projection_pinjaman">
                    <div class="panel-body" style="padding: 0px;">
                        <div class="row content_container shadow_content_container">
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                                  <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                      <thead>
                                          <tr>
                                              <th style="width: 3%"><!-- No --></th>
                                              <th style="width: 40%; text-align: left;">Keterangan</th>
                                              <th style="text-align: right; padding-right: 20px;">IDR</th>
                                              <th style="text-align: right; padding-right: 20px;">Valas</th>
                                              <th style="text-align: right; padding-right: 20px;">Total</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td align="left"><!-- 3 --></td>
                                              <td >Baki Debet </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDROutstanding']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasOutstanding']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalOutstanding']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 4 --></td>
                                              <td >Ratas Harian Baki Debet </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRDailyRatas']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasDailyRatas']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalDailyRatas']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 5 --></td>
                                              <td >Plafond </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRPlafond']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasPlafond']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalPlafond']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 6 --></td>
                                              <td >Kelonggaran tarik </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRTarik']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasTarik']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalTarik']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 7 --></td>
                                              <td >Fee Based Income </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRFeeBasedPinjaman']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasFeeBasedPinjaman']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalFeeBasedPinjaman']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 8 --></td>
                                              <td >Pendapatan bunga </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRIncomeExpense']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasIncomeExpense']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalIncomeExpense']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 9 --></td>
                                              <td >Pendapatan bunga akumulasi </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRIncomeExpense']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasIncomeExpense']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalIncomeExpense']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>

                                          <!-- ================Trade Finance============= -->
                                          <tr>
                                              <th colspan="5" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Trade Finance</b></th>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 11 --></td>
                                              <td >Outstanding </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDROutstandingTradeFinance']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasOutstandingTradeFinance']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalOutstandingTradeFinance']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 12 --></td>
                                              <td >Fee Based Income Trade Finance</td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRFeeBasedTradeFinance']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasFeeBasedTradeFinance']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalFeeBasedTradeFinance']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>

                                          <!-- ================Lain nya============= -->
                                          <tr>
                                              <th colspan="5" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Lainnya</b></th>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 14 --></td>
                                              <td >Fee Based Income </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['IDRFeeBasedLain']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['ValasFeeBasedLain']/VALUE_PER) ?></label>
                                              </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['Pinjaman']['TotalFeeBasedLain']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordion_cpa_projection_labarugi" role="tablist" aria-multiselectable="true">
                <div class="panel">
                  <a class="panel-heading" role="tab" id="headingcpa_projection_labarugi" data-toggle="collapse" data-parent="#accordion_cpa_projection_labarugi" href="#collapsecpa_projection_labarugi" aria-expanded="true" aria-controls="collapsecpa_projection_labarugi" style="border-bottom: 1px solid #ddd;">
                    <h4 class="panel-title detail_title"><i class="fa fa-chevron-down" style="font-size: 8px; padding-right: 10px; color: #218FD8;"></i> Laba Rugi</h4>
                  </a>
                  <div id="collapsecpa_projection_labarugi" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingcpa_projection_labarugi">
                    <div class="panel-body" style="padding: 0px;">
                        <div class="row content_container shadow_content_container">
                            <div class="x_content">
                                <div class="col-md-12 col-sm-12 col-xs-12 marginstop_con" style="padding-top: 0;">
                                  <table width="100%" class="table" cellpadding="20" cellspacing="20">
                                      <thead>
                                          <tr>
                                              <th style="width: 3%"><!-- No --></th>
                                              <th style="width: 40%; text-align: left;">Keterangan</th>
                                              <th style="text-align: right; padding-right: 20px;">Total</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Pendapatan Bunga</b> </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;" ><?= number_format($Projection['LabaRugi']['TotalPendapatanBunga']/VALUE_PER) ?></th>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 1 --></td>
                                              <td >Pendapatan Bunga </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['PendapatanBunga']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 2 --></td>
                                              <td >Pendapatan FTP </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['PendapatanFTP']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>

                                          <!-- ================Total Beban Bunga============= -->
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;" ><b>Total Beban Bunga</b> </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20Px;" >
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalBebanBunga']/VALUE_PER) ?></label>
                                              </th>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 4 --></td>
                                              <td >Beban Bunga </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['BebanBunga']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 5 --></td>
                                              <td >Beban Bunga FTP </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['BebanBungaFTP']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <!-- ================NII============= -->
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['NII']/VALUE_PER) ?></label>
                                              </th>
                                          </tr>
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;">NII Dengan FTP </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['NIIFTP']/VALUE_PER) ?></label>
                                              </th>
                                          </tr>

                                          <!-- ================Fee Based============= -->
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Fee Based</b> </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['FeeBased']/VALUE_PER) ?></label>
                                              </th>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 6 --></td>
                                              <td >Jasa Perkreditan* </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaPerkreditan']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 7 --></td>
                                              <td >Jasa Simpanan* </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaSimpanan']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 8 --></td>
                                              <td >Jasa Transaksi Bisnis Internasional* </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaTransaksi']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 9 --></td>
                                              <td >Jasa Transfer*</td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalJasaTransfer']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 3 --></td>
                                              <td >Provisi</td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalProvision']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>

                                          <!-- ================Total Biaya Operasional============= -->
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Operasional</b> </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalBiayaOperasional']/VALUE_PER) ?></label>
                                              </th>

                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 10 --></td>
                                              <td >Beban Administrasi & Umum* </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalAdministrasi']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 11 --></td>
                                              <td >Beban Operasional Lain* </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalOperasional']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 12 --></td>
                                              <td >Beban Personalia* </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalPersonalia']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <!-- ================PPAP============= -->
                                          <tr>
                                              <th colspan="2" align="left" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>PPAP</b> </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['BiayaPpap']/VALUE_PER) ?></label>
                                              </th>
                                          </tr>
                                          <!-- ================Laba Sebelum Modal============= -->

                                          <tr>
                                              <td align="left"><!-- 13 --></td>
                                              <td >Laba Rugi Sebelum Modal Tanpa FTP </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiSebelumModal']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 14 --></td>
                                              <td >Laba Rugi Sebelum Modal Dengan FTP</td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiFtpSeblumModal']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <!-- ================Total Biaya Modal============= -->
                                          <tr>
                                              <th colspan="2" style="background: #CBEAFF; text-align: left; height: 20px; padding-left: 20px;"><b>Total Biaya Modal</b> </th>
                                              <th align="right" style="background: #CBEAFF; text-align: right; height: 20px;">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['TotalBiayaModal']/VALUE_PER) ?></label>
                                              </th>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 15 --></td>
                                              <td >Laba rugi tanpa FTP </td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiSetelahModal']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="left"><!-- 16 --></td>
                                              <td >Laba rugi dengan FTP</td>
                                              <td align="right">
                                                <label class="money"><?= number_format($Projection['LabaRugi']['LabaRugiFtpSetelahModal']/VALUE_PER) ?></label>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="row margintop_con">
      </div>
</div>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  $(document).ready(function(){

    // $('.money').autoNumeric('init',{
    //   aForm: true,
    //   aDec: '.',
    //   aSep: ',',
    //   mDec: '2',
    //   vMax: '999999999999999999',
    //   vMin: '-999999999999999999',
    //   aPad: false,
    //   unformatOnSubmit: true
    // });

    $("#button_detail_cpa_existing").click(function(){

      var tab_panel = $(this).attr('tab_panel');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $("#content_detail_Simulation").load("<?= base_url('tasklist/AccountPlanning/view_cpa/')?>" + tab_panel +"/" + AccountPlanningId , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });

    $("#button_detail_cpa_projection").click(function(){

      var tab_panel = $(this).attr('tab_panel');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $("#content_detail_Simulation").load("<?= base_url('tasklist/AccountPlanning/view_cpa/')?>" + tab_panel +"/" + AccountPlanningId , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });

    $("#button_detail_cpa_delta").click(function(){

      var tab_panel = $(this).attr('tab_panel');
      var AccountPlanningId = $(this).attr('AccountPlanningId');

      $('.loaderImage').show();

      $("#content_detail_Simulation").load("<?= base_url('tasklist/AccountPlanning/view_cpa/')?>" + tab_panel +"/" + AccountPlanningId , function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success") {
          $('.loaderImage').hide();
        }

        if(statusTxt == "error") {
          $('.loaderImage').hide();
          new PNotify({
              title: xhr.status,
              text: "Error: " + xhr.status + ": " + xhr.statusText,
              type: xhr.status,
              styling: 'bootstrap3'
          });
          
          PNotify.prototype.options.delay = 1200;
        }

      });
    });



  });  

</script>


