<style type="text/css">
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

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
          <div class="x_content">
            <div class="row">
				<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats" style="height: 139px;">
						<div style="margin: 10px; height: auto; float: left; width: 50%;"><i class="material-icons" style="font-size: 12px;">account_balance</i> Customer</div>
						<div style="margin: 10px; height: auto; float: right;"></div>
						<div style="padding-bottom: 20px; float: left; width: 100%;">
							<h3><?=$TotalCustomer?><sub style="font-size: 60%;"></sub></h3>
						</div>
						<!-- <div class="sparkline_three" style="margin: 15px; padding-top: 120px;">
							<canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
						</div> -->
					</div>
				</div>
				<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats" style="height: 139px;">
						<div style="margin: 10px; height: auto; float: left; width: 50%;"><i class="material-icons" style="font-size: 12px;">insert_chart_outlined</i> Profitability</div>
						<div style="margin: 10px; height: auto; float: right;"></div>
						<div style="padding-bottom: 20px; float: left; width: 100%;">
							<h3><?=$LastDataCpaAllGroup?>T<sub style="font-size: 60%;">/<?=$cpaLastUpdateDate?></sub></h3>
						</div>
						<!-- <div class="sparkline_three" style="margin: 15px; padding-top: 50px; padding-top: 120px;">
							<canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
						</div> -->
					</div>
				</div>
				<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats">
						<div style="margin: 10px; height: auto; float: left; width: 50%;"><i class="material-icons" style="font-size: 12px;">show_chart</i> CASA</div>
						<div style="margin: 10px; height: auto; float: right;">
							<?php
								$icon = '<i class="material-icons" style="font-size: 12px; vertical-align: baseline;">arrow_upward</i>';
								$colors = '#2CBB1F';
								if ($CASA_persen < 0) {
									$icon = '<i class="material-icons" style="font-size: 12px; vertical-align: baseline;">arrow_downward</i>';
									$colors = '#EF4141';
								}
							?>
							<span style="color: <?=$colors?>;"><?=$icon?> <?=$CASA_persen?>%</span>
						</div>
						<div style="padding-bottom: 20px; float: left; width: 100%;">
							<h3><?=$LastTotalSimpananAllGroup?>T<sub style="font-size: 60%;">/<?=$totalSimpananLastUpdateDate?></sub></h3>
						</div>
						<div style="padding-bottom: 20px; float: left; width: 50%;">
							<h3><?=$YODTotalSimpananAllGroups?>T<sub style="font-size: 60%;"> YOD</sub></h3>
						</div>
						<div style="padding-bottom: 20px; float: right; width: 50%;">
							<h3><?=$YOYTotalSimpananAllGroups?>T<sub style="font-size: 60%;"> YOY</sub></h3>
						</div>
						<!-- <div class="sparkline_three" style="margin: 15px;">
							<canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
						</div> -->
					</div>
				</div>
				<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats">
						<div style="margin: 10px; height: auto; float: left; width: 50%;"><i class="material-icons" style="font-size: 12px;">business_center</i> Loan</div>
						<div style="margin: 10px; height: auto; float: right;">
							<?php
								$icon = '<i class="material-icons" style="font-size: 12px; vertical-align: baseline;">arrow_upward</i>';
								$colors = '#2CBB1F';
								if ($Loan_persen < 0) {
									$icon = '<i class="material-icons" style="font-size: 12px; vertical-align: baseline;">arrow_downward</i>';
									$colors = '#EF4141';
								}
							?>
							<span style="color: <?=$colors?>;"><?=$icon?> <?=$Loan_persen?>%</span>
						</div>
						<div style="padding-bottom: 20px; float: left; width: 100%;">
							<h3><?=$LastTotalPinjamanAllGroup?>T<sub style="font-size: 60%;">/<?=$totalPinjamanLastUpdateDate?></sub></h3>
						</div>
						<div style="padding-bottom: 20px; float: left; width: 50%;">
							<h3><?=$YODTotalPinjamanAllGroups?>T<sub style="font-size: 60%;"> YOD</sub></h3>
						</div>
						<div style="padding-bottom: 20px; float: right; width: 50%;">
							<h3><?=$YOYTotalPinjamanAllGroups?>T<sub style="font-size: 60%;"> YOY</sub></h3>
						</div>
						<!-- <div class="sparkline_three" style="margin: 15px;">
							<canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
						</div> -->
					</div>
				</div>
            </div>

            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		      	    <div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
						    <label style="cursor: pointer; font-size: 15px;">CASA</label>
						</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
			                    <div class="form_actions" style="width: 350px; padding-bottom: 20px;">
			                      	<div style="text-align: left;">
				                        <button class="btn btn-sm active_tab" type="button" style="width: 100px;" id="button_casa_saldo">Saldo</button>
				                        <button class="btn btn-sm nonactive_tab" type="button" style="width: 100px;" id="button_casa_ratas">Ratas</button>
			                      	</div>
			                    </div>
			                    <div id="echart_casa_saldo" style="height:350px;"></div>
			                    <div id="echart_casa_ratas" style="height:350px; display: none;"></div>
			                </div>
			            </div>
	                </div>
	            </div>
            </div>

            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		      	    <div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
						    <label style="cursor: pointer; font-size: 15px;">Loan</label>
						</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
			                    <div class="form_actions" style="width: 350px; padding-bottom: 20px;">
									<div style="text-align: left;">
										<button class="btn btn-sm active_tab" type="button" style="width: 100px;" id="button_loan_saldo">Saldo</button>
										<button class="btn btn-sm nonactive_tab" type="button" style="width: 100px;" id="button_loan_ratas">Ratas</button>
									</div>
			                    </div>
			                    <div id="echart_loan_saldo" style="height:350px;"></div>
			                    <div id="echart_loan_ratas" style="height:350px; display: none;"></div>
			                </div>
			            </div>
	                </div>
	            </div>
            </div>

            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
						    <label style="cursor: pointer; font-size: 15px;">Customer Casa</label>
						</div>
						<div class="x_content">
			                <div class="col-md-3 col-sm-3 col-xs-12" style="padding: 20px 30px 0 70px;">
			                  Daily Last Update : 
			                </div>
			                <div class="col-md-9 col-sm-9 col-xs-12" style="padding: 20px 30px 0 0;">
			                  <span style="font-weight: 600; font-size: 14px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=$totalSimpananLastUpdateDate?></span>
			                </div>
			                <div class="col-md-3 col-sm-3 col-xs-12" style="padding: 0 30px 20px 70px;">
			                  Monthly Last Update : 
			                </div>
			                <div class="col-md-9 col-sm-9 col-xs-12" style="padding: 0 30px 20px 0;">
			                  <span style="font-weight: 600; font-size: 14px; line-height: 24px; letter-spacing: 0.5px; color: #F58C38;"><?=$ratasSimpananLastUpdateDate?></span>
			                </div>
							<div class="row" style="padding: 10px 30px 10px 30px;">
				                <table width="100%" id="table-casa" class="table">
				                  <thead style="background-color: #FFFFFF; color: #218FD8;" >
				                    <tr>
				                      <td style="text-align: left; width: 5%">No</td>
				                      <td style="text-align: left;">Customer</td>
				                      <td style="text-align: center;">Giro Harian</td>
				                      <td style="text-align: center;">Depo Harian</td>
				                      <td style="text-align: center;">Ratas Giro</td>
				                      <td style="text-align: center;">Ratas Depo</td>
				                      <td style="text-align: right;">YOY</td>
				                      <td style="text-align: right;">YOD</td>
				                    </tr>
				                  </thead>
				                  <tbody>
			                        <?php $index_casa = 1; ?>
				                  	<?php foreach ($DataSimpananPerCustomer as $key => $value) { ?>
				                    <tr>
				                      <td style="text-align: left; width: 5%"><?=$index_casa?></td>
				                      <td style="text-align: left;">
				                      	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
					                      	<img class="img-responsive img-circle img_logo" src="<?php if (!file_exists ('uploads/CustomerGroupLogo/'.$value['CustomerLogo'])) echo base_url('uploads/CustomerGroupLogo/default.png'); elseif (isset($value['CustomerLogo'])) echo base_url('uploads/CustomerGroupLogo/'.$value['CustomerLogo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>" style="width: 30px; height: 30px;">
				                      	</div>
				                      	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
					                      	<?=$value['CustomerName']?>
				                      	</div>
				                      </td>
				                      <td style="text-align: right;"><?=number_format($value['GiroDaily']/1000000)?></td>
				                      <td style="text-align: right;"><?=number_format($value['DepoMonthly']/1000000)?></td>
				                      <td style="text-align: right;"><?=number_format($value['GiroMonthly']/1000000)?></td>
				                      <td style="text-align: right;"><?=number_format($value['DepoMonthly']/1000000)?></td>
				                      <td style="text-align: right;"><?=number_format($value['YOY'], 1)?>%</td>
				                      <td style="text-align: right;"><?=number_format($value['YOD'], 1)?>%</td>
				                    </tr>
			                        <?php $index_casa++; ?>
				                  	<?php } ?>
				                  </tbody>
				              	</table>
			              </div>
			          </div>
	                </div>
	            </div>
            </div>

            <div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-left">
			      	<div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
						    <label style="cursor: pointer; font-size: 15px;">Account Planning Progress</label>
						</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-1 col-sm-1 col-xs-12" style="height: 50px;">
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12" style="height: 50px;">
										Platinum Classification
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12" style="vertical-align: middle; height: 50px;">
										<div class="progress" style="height: 20px; width: 100%; margin-bottom: 0px;" title="<?=$AccountPlanningPublishByClassification['ProgressPlatinum']?> %">
											<div class="progress-bar" data-transitiongoal="<?=$AccountPlanningPublishByClassification['ProgressPlatinum']?>" style="background-color: rgb(33, 143, 216); width: 100%;" title="<?=$AccountPlanningPublishByClassification['ProgressPlatinum']?> %" aria-valuenow="<?=$AccountPlanningPublishByClassification['ProgressPlatinum']?>">
											</div>
		                                </div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12" style="height: 50px;">
										<span style="color: #218FD8; font-size: 15px; font-weight: bolder;"><?=$AccountPlanningPublishByClassification['ProgressPlatinum']?> %</span>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-1 col-sm-1 col-xs-12" style="height: 50px;">
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12" style="height: 50px;">
										Gold Classification
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12" style="vertical-align: middle; height: 50px;">
										<div class="progress" style="height: 20px; width: 100%; margin-bottom: 0px;" title="<?=$AccountPlanningPublishByClassification['ProgressGold']?> %">
											<div class="progress-bar" data-transitiongoal="<?=$AccountPlanningPublishByClassification['ProgressGold']?>" style="background-color: rgb(33, 143, 216); width: 100%;" title="<?=$AccountPlanningPublishByClassification['ProgressGold']?> %" aria-valuenow="<?=$AccountPlanningPublishByClassification['ProgressGold']?>">
											</div>
		                                </div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12" style="height: 50px;">
										<span style="color: #218FD8; font-size: 15px; font-weight: bolder;"><?=$AccountPlanningPublishByClassification['ProgressGold']?> %</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
						    <label style="cursor: pointer; font-size: 15px;">Customer Summarize</label>
						</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-3 col-sm-3 col-xs-12" style="height: 50px;">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px;">
										Platinum Classification
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px; text-align: right;">
										<span style="color: #218FD8; font-size: 22px; font-weight: bolder;"><?=$CustomerGroupClassification['Platinum']?></span>
									</div>
									<div class="col-md-1 col-sm-1 col-xs-1" style="height: 50px; text-align: right;">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-3 col-sm-3 col-xs-12" style="height: 50px;">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px;">
										Gold Classification
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px; text-align: right;">
										<span style="color: #218FD8; font-size: 22px; font-weight: bolder;"><?=$CustomerGroupClassification['Gold']?></span>
									</div>
									<div class="col-md-1 col-sm-1 col-xs-1" style="height: 50px; text-align: right;">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-3 col-sm-3 col-xs-12" style="height: 50px;">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px;">
										Silver Classification
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px; text-align: right;">
										<span style="color: #218FD8; font-size: 22px; font-weight: bolder;"><?=$CustomerGroupClassification['Silver']?></span>
									</div>
									<div class="col-md-1 col-sm-1 col-xs-1" style="height: 50px; text-align: right;">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-3 col-sm-3 col-xs-12" style="height: 50px;">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px;">
										Bronze Classification
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12" style="height: 50px; text-align: right;">
										<span style="color: #218FD8; font-size: 22px; font-weight: bolder;"><?=$CustomerGroupClassification['Bronze']?></span>
									</div>
									<div class="col-md-1 col-sm-1 col-xs-1" style="height: 50px; text-align: right;">
									</div>
								</div>
							</div>
						</div>
	                </div>
	            </div>

            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			      	<div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
							<label style="cursor: pointer; font-size: 15px;">Corporate Loan Segment</label>
						</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
								<div id="echart_donuts1" style="height: 300px;"></div>
							</div>
							<div class="row" style="padding: 10px 30px 10px 30px;">
								<table style="width: 80%;" align="center">
									<tr>
										<td style="width: 5%; padding: 10px;">
											<div style="background-color: #9522F0; padding: 10px 5px 10px 5px;"></div>
										</td>
										<td style="width: 3%;"></td>
										<td style="width: 25%;"><?=$CustomerLoanSegment['Raroc1Name']?></td>
										<td align="right" style="width: 1%;">
											<span style="color: #218FD8; font-size: 16px; font-weight: bolder;"><?=$CustomerLoanSegment['Raroc1']?></span>
										</td>
										<td align="right" style="width: 3%;"><?=number_format((($CustomerLoanSegment['Raroc1']*100)/$CustomerLoanSegment['TotalRaroc']), 2)?>%</td>
									</tr>
									<tr>
										<td style="width: 5%; padding: 10px;">
											<div style="background-color: #FEB247; padding: 10px 5px 10px 5px;"></div>
										</td>
										<td></td>
										<td><?=$CustomerLoanSegment['Raroc2Name']?></td>
										<td align="right">
											<span style="color: #218FD8; font-size: 16px; font-weight: bolder;"><?=$CustomerLoanSegment['Raroc2']?></span>
										</td>
										<td align="right" style="width: 3%;"><?=number_format((($CustomerLoanSegment['Raroc2']*100)/$CustomerLoanSegment['TotalRaroc']), 2)?>%</td>
									</tr>
									<tr>
										<td style="width: 5%; padding: 10px;">
											<div style="background-color: #5FD855; padding: 10px 5px 10px 5px;"></div>
										</td>
										<td></td>
										<td><?=$CustomerLoanSegment['Raroc3Name']?></td>
										<td align="right">
											<span style="color: #218FD8; font-size: 16px; font-weight: bolder;"><?=$CustomerLoanSegment['Raroc3']?></span>
										</td>
										<td align="right" style="width: 3%;"><?=number_format((($CustomerLoanSegment['Raroc3']*100)/$CustomerLoanSegment['TotalRaroc']), 2)?>%</td>
									</tr>
									<tr>
										<td style="width: 5%; padding: 10px;">
											<div style="background-color: #31AAEE; padding: 10px 5px 10px 5px;"></div>
										</td>
										<td></td>
										<td><?=$CustomerLoanSegment['Raroc4Name']?></td>
										<td align="right">
											<span style="color: #218FD8; font-size: 16px; font-weight: bolder;"><?=$CustomerLoanSegment['Raroc4']?></span>
										</td>
										<td align="right" style="width: 3%;"><?=number_format((($CustomerLoanSegment['Raroc4']*100)/$CustomerLoanSegment['TotalRaroc']), 2)?>%</td>
									</tr>
									<tr>
										<td style="width: 5%; padding: 10px;">
											<div style="background-color: #F8EF20; padding: 10px 5px 10px 5px;"></div>
										</td>
										<td></td>
										<td><?=$CustomerLoanSegment['Raroc5Name']?></td>
										<td align="right">
											<span style="color: #218FD8; font-size: 16px; font-weight: bolder;"><?=$CustomerLoanSegment['Raroc5']?></span>
										</td>
										<td align="right" style="width: 3%;"><?=number_format((($CustomerLoanSegment['Raroc5']*100)/$CustomerLoanSegment['TotalRaroc']), 2)?>%</td>
									</tr>
									<tr>
										<td style="width: 5%; padding: 10px;">
											<div style="background-color: #C7C7C7; padding: 10px 5px 10px 5px;"></div>
										</td>
										<td></td>
										<td><?=$CustomerLoanSegment['Raroc6Name']?></td>
										<td align="right">
											<span style="color: #218FD8; font-size: 16px; font-weight: bolder;"><?=$CustomerLoanSegment['Raroc6']?></span>
										</td>
										<td align="right" style="width: 3%;"><?=number_format((($CustomerLoanSegment['Raroc6']*100)/$CustomerLoanSegment['TotalRaroc']), 2)?>%</td>
									</tr>
								</table>
							</div>
						</div>

	                </div>
	            </div>
            </div>

            <div class="row">
            	<div class="col-md-12">
		      	  <div class="x_panel panel_container">
					<div class="x_title collapse-link title_container" style="cursor: pointer;">
					    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
					    <label style="cursor: pointer; font-size: 15px;">Profitability</label>
					</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
	                    	<div id="echart_profitablity" style="height:350px;"></div>
	                    </div>
	                </div>
	              </div>
	            </div>
            </div>

            <div class="row">
            	<table style="width: 100%;">
            		<tr>
            			<td style="width: 20%;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="tile-stats" style="padding: 10px 0 0 0;">
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align: center; font-size: 16px; padding: 0;">Pinjaman Korporasi</div>
									<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding: 0; float: right;">
                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/7'); ?>'">build</i>
                                    	<?php endif; ?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 20px 0 20px 0; font-size: 14px;">
										Suku Bunga
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 0 0 10px 0;">
										<span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemPinjaman[0]->BottomMarginInterestRate ?>%</span> - <span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemPinjaman[0]->TopMarginInterestRate ?>%</span>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
										<div style="border-bottom-style: solid; border-color: #31AAEE; width: 100%;"></div>
									</div>
								</div>
							</div>
            			</td>
            			<td style="width: 20%;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="tile-stats" style="padding: 10px 0 0 0;">
									<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11" style="text-align: center; font-size: 16px; padding: 0;">Transit Interest Rupiah</div>
									<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding: 0; float: right;">
                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/8'); ?>'">build</i>
                                    	<?php endif; ?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 20px 0 20px 0; font-size: 14px;">
										Suku Bunga
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 0 0 10px 0;">
										<span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemTransitInterestRupiah[0]->BottomMarginInterestRate ?>%</span> - <span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemTransitInterestRupiah[0]->TopMarginInterestRate ?>%</span>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
										<div style="border-bottom-style: solid; border-color: #FEB247; width: 100%;"></div>
									</div>
								</div>
							</div>
            			</td>
            			<td style="width: 20%;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="tile-stats" style="padding: 10px 0 0 0;">
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align: center; font-size: 16px; padding: 0;">Transit Interest Valas</div>
									<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding: 0; float: right;">
                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/9'); ?>'">build</i>
                                    	<?php endif; ?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 20px 0 20px 0; font-size: 14px;">
										Suku Bunga
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 0 0 10px 0;">
										<span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemTransitInterestValas[0]->BottomMarginInterestRate ?>%</span> - <span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemTransitInterestValas[0]->TopMarginInterestRate ?>%</span>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
										<div style="border-bottom-style: solid; border-color: #9522F0; width: 100%;"></div>
									</div>
								</div>
							</div>
            			</td>
            			<td style="width: 20%;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="tile-stats" style="padding: 10px 0 0 0;">
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align: center; font-size: 16px; padding: 0;">Pinjaman Valas</div>
									<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding: 0; float: right;">
                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/12'); ?>'">build</i>
                                    	<?php endif; ?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 20px 0 20px 0; font-size: 14px;">
										Suku Bunga
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 0 0 10px 0;">
										<span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemPinjamanValas[0]->BottomMarginInterestRate ?>%</span> - <span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemPinjamanValas[0]->TopMarginInterestRate ?>%</span>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
										<div style="border-bottom-style: solid; border-color: #5FD855; width: 100%;"></div>
									</div>
								</div>
							</div>
            			</td>
            			<td style="width: 20%;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="tile-stats" style="padding: 10px 0 0 0;">
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align: center; font-size: 16px; padding: 0;">SBDK</div>
									<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding: 0; float: right;">
                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/13'); ?>'">build</i>
                                    	<?php endif; ?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 10px 0 10px 0; font-size: 14px;">
										<span style="font-size: 13px;">Suku Bunga Kredit Korporasi</span>
										<br>
										<?= $FTPItemSBDK[0]->SBDK ?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center; padding: 0 0 10px 0;">
										<span style="color: 000; font-size: 18px; font-weight: bolder;"><?= $FTPItemSBDK[0]->KreditKorporasi ?>%</span>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
										<div style="border-bottom-style: solid; border-color: #F8EF20; width: 100%;"></div>
									</div>
								</div>
							</div>
            			</td>
            		</tr>
            	</table>
            </div>

            <div class="row">
            	<div class="col-md-12">
		      	  	<div class="x_panel panel_container">
						<div class="x_title collapse-link title_container" style="cursor: pointer;">
						    <i class="fa fa-chevron-up" style="color:#218FD8;"></i>
						    <label style="cursor: pointer; font-size: 15px;">Fund Transfer Price</label>
						</div>
						<div class="x_content">
							<div class="row" style="padding: 10px 30px 10px 30px;">
			                    <div class="form_actions" style="width: 100%; padding-bottom: 20px;">
			                      	<div style="text-align: left;">
				                        <button class="btn btn-sm active_tab" id="btnFTP" type="button" style="width: auto;" onclick="showTabFTP('FTP')">FTP</button>
				                        <button class="btn btn-sm nonactive_tab" id="btnSimpanan" type="button" style="width: auto;" onclick="showTabFTP('Simpanan')">Simpanan</button>
				                        <button class="btn btn-sm nonactive_tab" id="btnDepoRupiah" type="button" style="width: auto;" onclick="showTabFTP('DepoRupiah')">Deposito Rupiah</button>
				                        <button class="btn btn-sm nonactive_tab" id="btnDepoValas" type="button" style="width: auto;" onclick="showTabFTP('DepoValas')">Deposito Valas USD</button>
				                        <button class="btn btn-sm nonactive_tab" id="btnInterest" type="button" style="width: auto;" onclick="showTabFTP('Interest')">Transit Interest</button>
			                      	</div>
			                    </div>
			                    <!-- FTP -->
			                    <div id="FTP" style="height: auto;">
			                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			                    		<table style="width: 100%;">
											<thead style="background: #FFFFFF; box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px;">
                                                <tr>
                                                    <th style="height: 56px; color: #4BB8FF; padding: 8px; font-size: 15px; width: 50%;">FTP Rupiah 
                                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/14'); ?>'">build</i>
                                                    	<?php endif; ?>
                                                    </th>
                                                    <th style="height: 56px; color: #4BB8FF; padding: 8px; font-size: 15px; width: 50%; float: left;">
													</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                            	<?php foreach ($FTPItemRupiah as $row) : ?>
                                            		<td style="background: #FFFFFF; min-height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	<?= $row->Description ?> 
                                            	<?php endforeach; ?>
                                                </tr>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                  	Rupiah 
                                                    </td>
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                  	Rupiah 
                                                    </td>
                                                </tr>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                    <td style="background: #FFFFFF; min-height: 56px; color: #F58C38; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	Suku Bunga 
                                                    </td>
                                                    <td style="background: #FFFFFF; min-height: 56px; color: #F58C38; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	Suku Bunga 
                                                    </td>
                                                </tr>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                            	<?php 
                                        	if (!empty($FTPItemRupiah)) :
                                            	foreach ($FTPItemRupiah as $row) : 
                                            	?>
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                  	<?= $row->InterestRate ?>% 
                                                    </td>
                                            	<?php 
	                                            endforeach; 
                                            else :
	                                            ?>
                                            	<?php 
                                        	endif;
                                            	?>
                                                </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			                    		<table style="width: 100%;">
											<thead style="background: #FFFFFF; box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px;">
                                                <tr>
                                                    <th style="height: 56px; color: #4BB8FF; padding: 8px; font-size: 15px; width: 50%;">FTP Valas 
                                                    	<?php if($this->session->ROLE_ID == 1) : ?>
                                                    	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/15'); ?>'">build</i>
                                                    	<?php endif; ?>
                                                    </th>
                                                    <th style="height: 56px; color: #4BB8FF; padding: 8px; font-size: 15px; width: 50%; float: left;">
													</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                            	<?php 
                                        	if (!empty($FTPItemValas)) :
                                            	foreach ($FTPItemValas as $row) : 
                                            	?>
                                            		<td style="background: #FFFFFF; min-height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	<?= $row->Description ?> 
                                            	<?php 
                                            	endforeach; 
                                            else :
                                            	?>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                    <td style="background: #FFFFFF; min-height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	Pinjaman 
                                                    </td>
                                                    <td style="background: #FFFFFF; min-height: 56px; color: #4BB8FF; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	Simpanan 
                                                    </td>
                                                </tr>
                                            	<?php 
                                        	endif;
                                            	?>
                                                </tr>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                  	Valas 
                                                    </td>
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                  	Valas 
                                                    </td>
                                                </tr>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED;">
                                                    <td style="background: #FFFFFF; min-height: 56px; color: #F58C38; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	Suku Bunga 
                                                    </td>
                                                    <td style="background: #FFFFFF; min-height: 56px; color: #F58C38; font-size: 12px; padding: 8px; vertical-align: top; border-top: 1px solid #ddd; font-weight: bold;">
                                                  	Suku Bunga 
                                                    </td>
                                                </tr>
                                                <tr style="box-shadow: 0 4px 4px #EDEDED; height: 37px;">
                                            	<?php 
                                        	if (!empty($FTPItemValas)) :
                                            	foreach ($FTPItemValas as $row) : 
                                            	?>
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                  	<?= $row->InterestRate ?>% 
                                                    </td>
                                            	<?php 
                                            	endforeach; 
                                            else :
                                            	?>
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                    </td>
                                                    <td style="background: #FFFFFF; min-height: 56px; font-size: 12px; padding: 0 0 20px 8px; vertical-align: top; font-weight: bold;">
                                                    </td>
                                            	<?php 
                                        	endif;
                                            	?>
                                                </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    </div>
			                    <!-- Simpanan -->
			                    <div id="Simpanan" style="height: auto; display: none;">
			                    	<div id="FTPSimpananRupiah" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">Giro Rupiah</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/1'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
									    <!-- Left and right controls -->
									    <!-- <a class="left carousel-control" href="#pref" data-slide="prev" style="z-index: 10; width: 40px;">
									      <span class="glyphicon glyphicon-chevron-left"></span>
									    </a>
									    <a class="right carousel-control" href="#next" data-slide="next" style="z-index: 10; width: 40px;">
									      <span class="glyphicon glyphicon-chevron-right"></span>
									    </a> -->
										<table id="tableFTPSimpananRupiah" style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemSimpanan['Rupiah']['result'])) : ?>
		                                        		<?php foreach ($FTPItemSimpanan['Rupiah']['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			Giro Rupiah
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Saldo
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            		<?php
                                                            $descSaldo = "";
                                                            if($row->BottomMargin != null){
                                                                $btmMargin = $row->BottomMargin == 0 ? $row->BottomMargin : $row->BottomMargin -1;
                                                                $btmMargin = $btmMargin / 1000000;
                                                                $descSaldo .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                            }
                                                            if($row->TopMargin != null){
                                                                $topMargin = $row->TopMargin / 1000000;
                                                                $descSaldo .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                            }
	                                            		?>
	                                            			<?= $descSaldo; ?>
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
												    <!-- Left and right controls -->
								                    <?php if (!empty($FTPItemSimpanan['Rupiah']['links'])) { ?>
			 					                    <?php echo $FTPItemSimpanan['Rupiah']['links'] ?>
								                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div id="FTPSimpananValas" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">Giro Valas</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/2'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
									    <!-- Left and right controls -->
									    <!-- <a class="left carousel-control" href="#pref" data-slide="prev" style="z-index: 10; width: 40px;">
									      <span class="glyphicon glyphicon-chevron-left"></span>
									    </a>
									    <a class="right carousel-control" href="#next" data-slide="next" style="z-index: 10; width: 40px; right: 0; left: auto;">
									      <span class="glyphicon glyphicon-chevron-right"></span>
									    </a> -->
									    <table id="tableFTPSimpananValas" style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemSimpanan['Valas']['result'])) : ?>
		                                        		<?php foreach ($FTPItemSimpanan['Valas']['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			Giro Valas USD
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Saldo
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            		<?php
                                                            $descSaldo = "";
                                                            if($row->BottomMargin != null){
                                                                $btmMargin = $row->BottomMargin == 0 ? $row->BottomMargin : $row->BottomMargin -1;
                                                                $btmMargin = $btmMargin / 1000000;
                                                                $descSaldo .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                            }
                                                            if($row->TopMargin != null){
                                                                $topMargin = $row->TopMargin / 1000000;
                                                                $descSaldo .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                            }
	                                            		?>
	                                            			<?= $descSaldo; ?>
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
												    <!-- Left and right controls -->
								                    <?php if (!empty($FTPItemSimpanan['Valas']['links'])) { ?>
			 					                    <?php echo $FTPItemSimpanan['Valas']['links'] ?>
								                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    </div>

			                    <div id="DepoRupiah" style="height: auto; display: none;">
			                    	<div id="FTPItemDeposito_3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">< RP 100 Juta / BILYET</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/3'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemDeposito[3]['result'])) : ?>
		                                        		<?php foreach ($FTPItemDeposito[3]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			< RP 100 Juta / BILYET
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Jangka Waktu
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Term; ?> Bulan
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemDeposito[3]['links'])) { ?>
				 					                    <?php echo $FTPItemDeposito[3]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div id="FTPItemDeposito_4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">RP 100 Juta s/d RP 2 Milyar / BILYET</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/4'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemDeposito[4]['result'])) : ?>
		                                        		<?php foreach ($FTPItemDeposito[4]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			RP 100 Juta s/d RP 2 Milyar / BILYET
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Jangka Waktu
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Term; ?> Bulan
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemDeposito[4]['links'])) { ?>
				 					                    <?php echo $FTPItemDeposito[4]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div id="FTPItemDeposito_5" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">> RP 2 Milyar / BILYET</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/5'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemDeposito[5]['result'])) : ?>
		                                        		<?php foreach ($FTPItemDeposito[5]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			> RP 2 Milyar / BILYET
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Jangka Waktu
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Term; ?> Bulan
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemDeposito[5]['links'])) { ?>
				 					                    <?php echo $FTPItemDeposito[5]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>

			                    </div>

			                    <div id="DepoValas" style="height: auto; display: none;">
			                    	<div id="FTPItemDepositoValas_6" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">Deposito USD</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/6'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemDepositoValas[6]['result'])) : ?>
		                                        		<?php foreach ($FTPItemDepositoValas[6]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Term; ?> Bulan
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Suku Bunga Counter < 100.000 USD
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRateLess ?> %
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter ≥ 100.000 USD
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRateMore ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemDepositoValas[6]['links'])) { ?>
				 					                    <?php echo $FTPItemDepositoValas[6]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    </div>

			                    <div id="Interest" style="height: auto; display: none;">
			                    	<div id="FTPItemTransitInterest_8" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">Transit Interest Rupiah</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/8'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemTransitInterest[8]['result'])) : ?>
		                                        		<?php foreach ($FTPItemTransitInterest[8]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			Transit Interest Rupiah
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Keterangan
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Description; ?>
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->BottomMarginInterestRate; ?> - <?= $row->TopMarginInterestRate; ?>
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemTransitInterest[8]['links'])) { ?>
				 					                    <?php echo $FTPItemTransitInterest[8]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div id="FTPItemTransitInterest_9" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">Transit Interest Valas</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/9'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemTransitInterest[9]['result'])) : ?>
		                                        		<?php foreach ($FTPItemTransitInterest[9]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			Transit Interest Valas
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Keterangan
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Description; ?>
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->BottomMarginInterestRate; ?> - <?= $row->TopMarginInterestRate; ?>
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemTransitInterest[9]['links'])) { ?>
				 					                    <?php echo $FTPItemTransitInterest[9]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div id="FTPItemTransitInterest_10" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">SCF Rupiah</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/10'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemTransitInterest[10]['result'])) : ?>
		                                        		<?php foreach ($FTPItemTransitInterest[10]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			SFC Rupiah
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Keterangan
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            		<?php
                                                            $descTenor = "";
                                                            if($row->BottomMarginTerm != null){
                                                                $btmMargin = $row->BottomMarginTerm == 0 ? $row->BottomMarginTerm : $row->BottomMarginTerm -1;
                                                                $descTenor .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                            }
                                                            if($row->TopMarginTerm != null){
                                                                $topMargin = $row->TopMarginTerm;
                                                                $descTenor .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                            }                                                            
	                                            		?>
	                                            			<?= $descTenor; ?>
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate; ?>
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemTransitInterest[10]['links'])) { ?>
				 					                    <?php echo $FTPItemTransitInterest[10]['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    	</div>
			                    	<div id="FTPItemTransitInterest_11" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">SCF Valas</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/11'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemTransitInterest[11]['result'])) : ?>
		                                        		<?php foreach ($FTPItemTransitInterest[11]['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			SFC Valas
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Keterangan
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            		<?php
                                                            $descTenor = "";
                                                            if($row->BottomMarginTerm != null){
                                                                $btmMargin = $row->BottomMarginTerm == 0 ? $row->BottomMarginTerm : $row->BottomMarginTerm -1;
                                                                $descTenor .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                            }
                                                            if($row->TopMarginTerm != null){
                                                                $topMargin = $row->TopMarginTerm;
                                                                $descTenor .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                            }                                                            
	                                            		?>
	                                            			<?= $descTenor; ?>
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate; ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemTransitInterest[11]['links'])) { ?>
				 					                    <?php echo $FTPItemTransitInterest[11]['links'] ?>
									                    <?php } ?>
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
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script src="<?=base_url();?>template/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?=base_url();?>template/vendors/echarts/dist/echarts.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">

  	var base_url = "<?= base_url(); ?>";

	// $(document).ready(function() {

	    $("#button_FTPItemTransitInterest_11_next").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_11_next").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_11_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_11_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_11_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_11_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_11_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_11_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_11_prev").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_11_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_11_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_11_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_11_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_11_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_11_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_11_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_10_next").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_10_next").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_10_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_10_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_10_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_10_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_10_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_10_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_10_prev").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_10_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_10_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_10_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_10_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_10_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_10_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_10_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_9_next").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_9_next").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_9_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_9_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_9_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_9_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_9_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_9_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_9_prev").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_9_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_9_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_9_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_9_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_9_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_9_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_9_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_8_next").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_8_next").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_8_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_8_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_8_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_8_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_8_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_8_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemTransitInterest_8_prev").click(function(){
	        var rell 		= $("#button_FTPItemTransitInterest_8_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemTransitInterest_8_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemTransitInterest_8_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemTransitInterest_8_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemTransitInterest_8_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemTransitInterest_8_next] > a').removeAttr("href");
			$('li[id=button_FTPItemTransitInterest_8_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDepositoValas_6_next").click(function(){
	        var rell 		= $("#button_FTPItemDepositoValas_6_next").attr('rell');
	        var refTable 	= $("#button_FTPItemDepositoValas_6_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDepositoValas_6_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDepositoValas_6_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDepositoValas_6_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDepositoValas_6_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDepositoValas_6_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDepositoValas_6_prev").click(function(){
	        var rell 		= $("#button_FTPItemDepositoValas_6_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemDepositoValas_6_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDepositoValas_6_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDepositoValas_6_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDepositoValas_6_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDepositoValas_6_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDepositoValas_6_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_5_next").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_5_next").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_5_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_5_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_5_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_5_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_5_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_5_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_5_prev").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_5_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_5_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_5_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_5_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_5_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_5_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_5_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_4_next").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_4_next").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_4_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_4_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_4_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_4_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_4_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_4_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_4_prev").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_4_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_4_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_4_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_4_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_4_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_4_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_4_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_3_next").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_3_next").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_3_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_3_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_3_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_3_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_3_prev").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_3_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_3_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_3_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_3_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_3_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_3_next").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_3_next").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_3_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_3_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_3_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_3_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);

		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
	    });
	    
	    $("#button_FTPItemDeposito_3_prev").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_3_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_3_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_3_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_3_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_3_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPSimpananRupiah_next").click(function(){
	        var rell 		= $("#button_FTPSimpananRupiah_next").attr('rell');
	        var refTable 	= $("#button_FTPSimpananRupiah_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPSimpananRupiah_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPSimpananRupiah_next").attr('refview');
	        var pages 		= $('li[id=button_FTPSimpananRupiah_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);

		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPSimpananRupiah_next] > a').removeAttr("href");
			$('li[id=button_FTPSimpananRupiah_prev] > a').removeAttr("href");
	    });
	    
	    $("#button_FTPSimpananRupiah_prev").click(function(){
	        var rell 		= $("#button_FTPSimpananRupiah_prev").attr('rell');
	        var refTable 	= $("#button_FTPSimpananRupiah_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPSimpananRupiah_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPSimpananRupiah_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPSimpananRupiah_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPSimpananRupiah_next] > a').removeAttr("href");
			$('li[id=button_FTPSimpananRupiah_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPSimpananValas_next").click(function(){
	        var rell 		= $("#button_FTPSimpananValas_next").attr('rell');
	        var refTable 	= $("#button_FTPSimpananValas_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPSimpananValas_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPSimpananValas_next").attr('refview');
	        var pages 		= $('li[id=button_FTPSimpananValas_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPSimpananValas_next] > a').removeAttr("href");
			$('li[id=button_FTPSimpananValas_prev] > a').removeAttr("href");
	    });
	    
	    $("#button_FTPSimpananValas_prev").click(function(){
	        var rell 		= $("#button_FTPSimpananValas_prev").attr('rell');
	        var refTable 	= $("#button_FTPSimpananValas_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPSimpananValas_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPSimpananValas_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPSimpananValas_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPSimpananValas_next] > a').removeAttr("href");
			$('li[id=button_FTPSimpananValas_prev] > a').removeAttr("href");
	    });
    // });

  	function showTabFTP(Tab) {
		$('#FTP').hide();
		$('#btnFTP').removeClass('active_tab');
		$('#btnFTP').addClass('nonactive_tab');
		
		$('#Simpanan').hide();
		$('#btnSimpanan').removeClass('active_tab');
		$('#btnSimpanan').addClass('nonactive_tab');
		
		$('#DepoRupiah').hide();
		$('#btnDepoRupiah').removeClass('active_tab');
		$('#btnDepoRupiah').addClass('nonactive_tab');
		
		$('#DepoValas').hide();
		$('#btnDepoValas').removeClass('active_tab');
		$('#btnDepoValas').addClass('nonactive_tab');
		
		$('#Interest').hide();
		$('#btnInterest').removeClass('active_tab');
		$('#btnInterest').addClass('nonactive_tab');
		
		$('#'+Tab).show();
		$('#btn'+Tab).addClass('active_tab');
  	}

	var a = {
	    color: [

	    	"#9522F0", //Purple
	    	"#FEB247", //Orange 
	    	"#5FD855", //Green
			"#31AAEE", //Blue
			"#F8EF20", //Yellow
	        "#C7C7C7", //Silver

	        "#FFD15C", //Gold
	        "#E4E4E4", //Platinum
	        "#E3A051", //Bronze
			"#FF8989", //Red

	        "#26B99A",
	        "#34495E",
	        "#BDC3C7",
	        "#3498DB",
	        "#9B59B6",
	        "#8abb6f",
	        "#759c6a",
	        "#bfd3b7"],
	    title: {
	        itemGap: 8,
	        textStyle: {
	            fontWeight: "normal", color: "#2980B9"
	        }
	    }
	    ,
	    dataRange: {
	        color: ["#1f610a", "#97b58d"]
	    }
	    ,
	    toolbox: {
	        color: ["#408829", "#408829", "#408829", "#408829"]
	    }
	    ,
	    tooltip: {
	        backgroundColor: "rgba(0,0,0,0.5)",
	        axisPointer: {
	            type: "line",
	            lineStyle: {
	                color: "#408829", type: "dashed"
	            }
	            ,
	            crossStyle: {
	                color: "#408829"
	            }
	            ,
	            shadowStyle: {
	                color: "rgba(200,200,200,0.3)"
	            }
	        }
	    }
	    ,
	    dataZoom: {
	        dataBackgroundColor: "#eee", fillerColor: "rgba(64,136,41,0.2)", handleColor: "#408829"
	    }
	    ,
	    grid: {
	        borderWidth: 0
	    }
	    ,
	    categoryAxis: {
	        axisLine: {
	            lineStyle: {
	                color: "#408829"
	            }
	        }
	        ,
	        splitLine: {
	            lineStyle: {
	                color: ["#eee"]
	            }
	        }
	    }
	    ,
	    valueAxis: {
	        axisLine: {
	            lineStyle: {
	                color: "#408829"
	            }
	        }
	        ,
	        splitArea: {
	            show: !0,
	            areaStyle: {
	                color: ["rgba(250,250,250,0.1)", "rgba(200,200,200,0.1)"]
	            }
	        }
	        ,
	        splitLine: {
	            lineStyle: {
	                color: ["#eee"]
	            }
	        }
	    }
	    ,
	    timeline: {
	        lineStyle: {
	            color: "#408829"
	        }
	        ,
	        controlStyle: {
	            normal: {
	                color: "#408829"
	            }
	            ,
	            emphasis: {
	                color: "#408829"
	            }
	        }
	    }
	    ,
	    k: {
	        itemStyle: {
	            normal: {
	                color: "#68a54a",
	                color0: "#a9cba2",
	                lineStyle: {
	                    width: 1, color: "#408829", color0: "#86b379"
	                }
	            }
	        }
	    }
	    ,
	    map: {
	        itemStyle: {
	            normal: {
	                areaStyle: {
	                    color: "#ddd"
	                }
	                ,
	                label: {
	                    textStyle: {
	                        color: "#c12e34"
	                    }
	                }
	            }
	            ,
	            emphasis: {
	                areaStyle: {
	                    color: "#99d2dd"
	                }
	                ,
	                label: {
	                    textStyle: {
	                        color: "#c12e34"
	                    }
	                }
	            }
	        }
	    }
	    ,
	    force: {
	        itemStyle: {
	            normal: {
	                linkStyle: {
	                    strokeColor: "#408829"
	                }
	            }
	        }
	    }
	    ,
	    chord: {
	        padding: 4,
	        itemStyle: {
	            normal: {
	                lineStyle: {
	                    width: 1, color: "rgba(128, 128, 128, 0.5)"
	                }
	                ,
	                chordStyle: {
	                    lineStyle: {
	                        width: 1, color: "rgba(128, 128, 128, 0.5)"
	                    }
	                }
	            }
	            ,
	            emphasis: {
	                lineStyle: {
	                    width: 1, color: "rgba(128, 128, 128, 0.5)"
	                }
	                ,
	                chordStyle: {
	                    lineStyle: {
	                        width: 1, color: "rgba(128, 128, 128, 0.5)"
	                    }
	                }
	            }
	        }
	    }
	    ,
	    textStyle: {
	        fontFamily: "Arial, Verdana, sans-serif"
	    }
	}
	;

	function get_echart_casa_saldo() {
	// if ($("#echart_casa_saldo").length) {
	    var f = echarts.init(document.getElementById("echart_casa_saldo"),
	            a);
	    f.setOption({
	        title: {
	            text: "Saldo Harian", subtext: "in Billion"
	        }
	        ,
	        tooltip: {
	            trigger: "axis"
	        }
	        ,
	        legend: {
	            x: 220, y: 40, data: ["Saldo", "Deposito", "Giro"]
	        }
	        ,
	        toolbox: {
	            show: !0,
	            feature: {
	                magicType: {
	                    show: !0,
	                    title: {
	                        line: "Line", bar: "Bar", stack: "Stack", tiled: "Tiled"
	                    }
	                    ,
	                    type: ["line",
	                        "bar",
	                        "stack",
	                        "tiled"]
	                }
	                ,
	                restore: {
	                    show: !0, title: "Restore"
	                }
	                ,
	                saveAsImage: {
	                    show: !0, title: "Save Image"
	                }
	            }
	        }
	        ,
	        calculable: !0,
	        xAxis: [{
	                type: "category", boundaryGap: !1, data: [
                <?php foreach ($month_list as $key => $value) { 
                	echo '"'.$value['year_month'].'", ';
                } ?>
	                ]
	            }
	        ],
	        yAxis: [{
	                type: "value"
	            }
	        ],
	        series: [
	            {
	                name: "Saldo",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$TotalSimpanan = str_replace(',', '', number_format($DataSimpananAllGroups[0]['TotalSimpanan'.$i]/1000000000, 2));
	                	echo '"'.$TotalSimpanan.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            , {
	                name: "Deposito",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$DepoSimpanan = str_replace(',', '', number_format($DataSimpananAllGroups[0]['DepoSimpanan'.$i]/1000000000, 2));
	                	echo '"'.$DepoSimpanan.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            , {
	                name: "Giro",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$GiroSimpanan = str_replace(',', '', number_format($DataSimpananAllGroups[0]['GiroSimpanan'.$i]/1000000000, 2));
	                	echo '"'.$GiroSimpanan.'", ';
	                } 
	                ?>	                
	                    ]
	            }

	        ]
	    }
	    )
	}

	function get_echart_casa_ratas() {
	// if ($("#echart_casa_ratas").length) {
	    var f = echarts.init(document.getElementById("echart_casa_ratas"),
	            a);
	    f.setOption({
	        title: {
	            text: "Ratas Simpanan", subtext: "in Billion"
	        }
	        ,
	        tooltip: {
	            trigger: "axis"
	        }
	        ,
	        legend: {
	            x: 220, y: 40, data: ["Ratas Simpanan", "Deposito", "Giro"]
	        }
	        ,
	        toolbox: {
	            show: !0,
	            feature: {
	                magicType: {
	                    show: !0,
	                    title: {
	                        line: "Line", bar: "Bar", stack: "Stack", tiled: "Tiled"
	                    }
	                    ,
	                    type: ["line",
	                        "bar",
	                        "stack",
	                        "tiled"]
	                }
	                ,
	                restore: {
	                    show: !0, title: "Restore"
	                }
	                ,
	                saveAsImage: {
	                    show: !0, title: "Save Image"
	                }
	            }
	        }
	        ,
	        calculable: !0,
	        xAxis: [{
	                type: "category", boundaryGap: !1, data: [
                <?php foreach ($month_list as $key => $value) { 
                	echo '"'.$value['year_month'].'", ';
                } ?>
	                ]
	            }
	        ],
	        yAxis: [{
	                type: "value"
	            }
	        ],
	        series: [
	            {
	                name: "Ratas Simpanan",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php /*foreach ($DataSimpananAllGroup as $key => $value) { 
	                	$RatasSimpanan = str_replace(',', '', number_format($value['RatasSimpanan']/1000000000, 2));
	                	echo '"'.$RatasSimpanan.'", ';
	                } */?>	                
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$RatasSimpanan = str_replace(',', '', number_format($DataSimpananAllGroups[0]['RatasSimpanan'.$i]/1000000000, 2));
	                	echo '"'.$RatasSimpanan.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            , {
	                name: "Deposito",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$DepoRatasSimpanan = str_replace(',', '', number_format($DataSimpananAllGroups[0]['DepoRatasSimpanan'.$i]/1000000000, 2));
	                	echo '"'.$DepoRatasSimpanan.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            , {
	                name: "Giro",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$GiroRatasSimpanan = str_replace(',', '', number_format($DataSimpananAllGroups[0]['GiroRatasSimpanan'.$i]/1000000000, 2));
	                	echo '"'.$GiroRatasSimpanan.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	        ]
	    }
	    )
	}

	function get_echart_loan_saldo() {
	// if ($("#echart_loan_saldo").length) {
	    var f = echarts.init(document.getElementById("echart_loan_saldo"),
	            a);
	    f.setOption({
	        title: {
	            text: "Saldo Harian", subtext: "in Billion"
	        }
	        ,
	        tooltip: {
	            trigger: "axis"
	        }
	        ,
	        legend: {
	            x: 220, y: 40, data: ["Pinjaman", "KI", "KMK"]
	        }
	        ,
	        toolbox: {
	            show: !0,
	            feature: {
	                magicType: {
	                    show: !0,
	                    title: {
	                        line: "Line", bar: "Bar", stack: "Stack", tiled: "Tiled"
	                    }
	                    ,
	                    type: ["line",
	                        "bar",
	                        "stack",
	                        "tiled"]
	                }
	                ,
	                restore: {
	                    show: !0, title: "Restore"
	                }
	                ,
	                saveAsImage: {
	                    show: !0, title: "Save Image"
	                }
	            }
	        }
	        ,
	        calculable: !0,
	        xAxis: [{
	                type: "category", boundaryGap: !1, data: [
                <?php foreach ($month_list as $key => $value) { 
                	echo '"'.$value['year_month'].'", ';
                } ?>
	                ]
	            }
	        ],
	        yAxis: [{
	                type: "value"
	            }
	        ],
	        series: [
	        	{
	                name: "Pinjaman",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php /*foreach ($DataPinjamanAllGroup as $key => $value) { 
	                	$TotalPinjaman = str_replace(',', '', number_format($value['TotalPinjaman']/1000000000, 2));
	                	echo '"'.$TotalPinjaman.'", ';
	                }*/ ?>	                
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$TotalPinjaman = str_replace(',', '', number_format($DataPinjamanAllGroups[0]['TotalPinjaman'.$i]/1000000000, 2));
	                	echo '"'.$TotalPinjaman.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            ,
	        	{
	                name: "KI",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$TotalKIPinjaman = str_replace(',', '', number_format($DataPinjamanAllGroups[0]['TotalKIPinjaman'.$i]/1000000000, 2));
	                	echo '"'.$TotalKIPinjaman.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            ,
	        	{
	                name: "KMK",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$TotalKMKPinjaman = str_replace(',', '', number_format($DataPinjamanAllGroups[0]['TotalKMKPinjaman'.$i]/1000000000, 2));
	                	echo '"'.$TotalKMKPinjaman.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            ,
	        ]
	    }
	    )
	}

	function get_echart_loan_ratas() {
	// if ($("#echart_loan_ratas").length) {
	    var f = echarts.init(document.getElementById("echart_loan_ratas"),
	            a);
	    f.setOption({
	        title: {
	            text: "Ratas Pinjaman", subtext: "in Billion"
	        }
	        ,
	        tooltip: {
	            trigger: "axis"
	        }
	        ,
	        legend: {
	            x: 220, y: 40, data: ["KI", "KMK", "Outstanding"]
	        }
	        ,
	        toolbox: {
	            show: !0,
	            feature: {
	                magicType: {
	                    show: !0,
	                    title: {
	                        line: "Line", bar: "Bar", stack: "Stack", tiled: "Tiled"
	                    }
	                    ,
	                    type: ["line",
	                        "bar",
	                        "stack",
	                        "tiled"]
	                }
	                ,
	                restore: {
	                    show: !0, title: "Restore"
	                }
	                ,
	                saveAsImage: {
	                    show: !0, title: "Save Image"
	                }
	            }
	        }
	        ,
	        calculable: !0,
	        xAxis: [{
	                type: "category", boundaryGap: !1, data: [
                <?php foreach ($month_list as $key => $value) { 
                	echo '"'.$value['year_month'].'", ';
                } ?>
	                ]
	            }
	        ],
	        yAxis: [{
	                type: "value"
	            }
	        ],
	        series: [{
	                name: "KI",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$RatasPinjamanKI = str_replace(',', '', number_format($DataPinjamanAllGroups[0]['RatasPinjamanKI'.$i]/1000000000, 2));
	                	echo '"'.$RatasPinjamanKI.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            ,
	            {
	                name: "KMK",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$RatasPinjamanKMK = str_replace(',', '', number_format($DataPinjamanAllGroups[0]['RatasPinjamanKMK'.$i]/1000000000, 2));
	                	echo '"'.$RatasPinjamanKMK.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            ,
	            {
	                name: "Outstanding",
	                type: "line",
	                smooth: !0,
	                itemStyle: {
	                    normal: {
	                        areaStyle: {
	                            type: "default"
	                        }
	                    }
	                }
	                ,
	                data: [
	                <?php 
			        for ($i=$max_periode; $i > $min_periode; $i--) {
	                	$RatasPinjaman = str_replace(',', '', number_format($DataPinjamanAllGroups[0]['RatasPinjaman'.$i]/1000000000, 2));
	                	echo '"'.$RatasPinjaman.'", ';
	                } 
	                ?>	                
	                    ]
	            }
	            ,
	        ]
	    }
	    )
	}

	$(document).ready(function() {
		$('li[id=button_FTPSimpananRupiah_next] > a').removeAttr("href");
		$('li[id=button_FTPSimpananRupiah_prev] > a').removeAttr("href");
		$('li[id=button_FTPSimpananValas_next] > a').removeAttr("href");
		$('li[id=button_FTPSimpananValas_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_4_next] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_4_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_5_next] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_5_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemDepositoValas_6_next] > a').removeAttr("href");
		$('li[id=button_FTPItemDepositoValas_6_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_8_next] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_8_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_9_next] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_9_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_10_next] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_10_prev] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_11_next] > a').removeAttr("href");
		$('li[id=button_FTPItemTransitInterest_11_prev] > a').removeAttr("href");

		get_echart_casa_saldo();
		// get_echart_casa_ratas();
		get_echart_loan_saldo();
		// get_echart_loan_ratas();

		$("#button_casa_saldo").click(function(){
			$('#button_casa_saldo').removeClass('nonactive_tab');
			$('#button_casa_saldo').addClass('active_tab');
			$('#button_casa_ratas').removeClass('active_tab');
			$('#button_casa_ratas').addClass('nonactive_tab');

			$('#echart_casa_ratas').hide();
			$('#echart_casa_saldo').show();

			get_echart_casa_saldo();
	    });

		$("#button_casa_ratas").click(function(){
			$('#button_casa_saldo').addClass('nonactive_tab');
			$('#button_casa_saldo').removeClass('active_tab');
			$('#button_casa_ratas').addClass('active_tab');
			$('#button_casa_ratas').removeClass('nonactive_tab');

			$('#echart_casa_saldo').hide();
			$('#echart_casa_ratas').show();

			get_echart_casa_ratas();
	    });

		$("#button_loan_saldo").click(function(){
			$('#button_loan_saldo').removeClass('nonactive_tab');
			$('#button_loan_saldo').addClass('active_tab');
			$('#button_loan_ratas').removeClass('active_tab');
			$('#button_loan_ratas').addClass('nonactive_tab');

			$('#echart_loan_ratas').hide();
			$('#echart_loan_saldo').show();

			get_echart_loan_saldo();
	    });

		$("#button_loan_ratas").click(function(){
			$('#button_loan_saldo').addClass('nonactive_tab');
			$('#button_loan_saldo').removeClass('active_tab');
			$('#button_loan_ratas').addClass('active_tab');
			$('#button_loan_ratas').removeClass('nonactive_tab');

			$('#echart_loan_saldo').hide();
			$('#echart_loan_ratas').show();

			get_echart_loan_ratas();
		});

		$('#table-casa').DataTable({
			"pageLength": 5,
			"initComplete": function () {
			}
		});

		if ($("#echart_donuts1").length) {
		    var i = echarts.init(document.getElementById("echart_donuts1"),
		            a);
		    i.setOption({
		        tooltip: {
		            trigger: "item",
		            // formatter: "{a} <br/>{b} : {c} ({d}%)"
		            formatter: "<center><b>{b}</b><br/><h2>{c}</h2><br/>({d}%)</center>"
		        }
		        ,
		        calculable: !0,
		        // legend: {
		        //     x: "center"
		        //     , y: "bottom"
		        //     , data: [
		        //     	"<?=$CustomerLoanSegment['Raroc1Name']?>"
		        //     	, "<?=$CustomerLoanSegment['Raroc2Name']?>"
		        //     	, "<?=$CustomerLoanSegment['Raroc3Name']?>"
		        //     	, "<?=$CustomerLoanSegment['Raroc4Name']?>"
		        //     	, "<?=$CustomerLoanSegment['Raroc5Name']?>"
		        //     	, "<?=$CustomerLoanSegment['Raroc6Name']?>"
		        //     ]
		        // }
		        // ,
		        toolbox: {
		            show: !0,
		            feature: {
		                magicType: {
		                    show: !0,
		                    type: ["pie",
		                        "funnel"],
		                    option: {
		                        funnel: {
		                            x: "25%", width: "50%", funnelAlign: "center", max: 1548
		                        }
		                    }
		                }
		                ,
		                restore: {
		                    show: !0, title: "Restore"
		                }
		                ,
		                saveAsImage: {
		                    show: !0, title: "Save Image"
		                }
		            }
		        }
		        ,
		        series: [{
		                name: "Corporate Loan Segment",
		                type: "pie",
		                radius: ["35%",
		                    "55%"],
		                itemStyle: {
		                    normal: {
		                        label: {
		                            show: !0
		                        }
		                        ,
		                        labelLine: {
		                            show: !0
		                        }
		                    }
		                    ,
		                    emphasis: {
		                        label: {
		                            show: !0,
		                            position: "center",
		                            textStyle: {
		                                fontSize: "14", fontWeight: "normal"
		                            }
		                        }
		                    }
		                }
		                ,
		                data: [
		                    {
		                        value: <?=$CustomerLoanSegment['Raroc1']?>, name: "<?=$CustomerLoanSegment['Raroc1Name']?>"
		                    }
		                    ,
		                    {
		                        value: <?=$CustomerLoanSegment['Raroc2']?>, name: "<?=$CustomerLoanSegment['Raroc2Name']?>"
		                    }
		                    ,
		                    {
		                        value: <?=$CustomerLoanSegment['Raroc3']?>, name: "<?=$CustomerLoanSegment['Raroc3Name']?>"
		                    }
		                    ,
		                    {
		                        value: <?=$CustomerLoanSegment['Raroc4']?>, name: "<?=$CustomerLoanSegment['Raroc4Name']?>"
		                    }
		                    ,
		                    {
		                        value: <?=$CustomerLoanSegment['Raroc5']?>, name: "<?=$CustomerLoanSegment['Raroc5Name']?>"
		                    }
		                    ,
		                    {
		                        value: <?=$CustomerLoanSegment['Raroc6']?>, name: "<?=$CustomerLoanSegment['Raroc6Name']?>"
		                    }
		                ]
		            }
		        ]
		    }
		    )
		}

		if ($("#echart_profitablity").length) {
		    var f = echarts.init(document.getElementById("echart_profitablity"),
		            a);
		    f.setOption({
		        title: {
		            text: "Profitability", subtext: "in Billion"
		        }
		        ,
		        tooltip: {
		            trigger: "axis"
		        }
		        ,
		        legend: {
		            x: 220, y: 40, data: ["Profitability"]
		        }
		        ,
		        toolbox: {
		            show: !0,
		            feature: {
		                magicType: {
		                    show: !0,
		                    title: {
		                        line: "Line", bar: "Bar", stack: "Stack", tiled: "Tiled"
		                    }
		                    ,
		                    type: ["line",
		                        "bar",
		                        "stack",
		                        "tiled"]
		                }
		                ,
		                restore: {
		                    show: !0, title: "Restore"
		                }
		                ,
		                saveAsImage: {
		                    show: !0, title: "Save Image"
		                }
		            }
		        }
		        ,
		        calculable: !0,
		        xAxis: [{
		                type: "category", boundaryGap: !1, data: [
	                <?php foreach ($month_list as $key => $value) { 
	                	echo '"'.$value['year_month'].'", ';
	                } ?>
		                ]
		            }
		        ],
		        yAxis: [{
		                type: "value"
		            }
		        ],
		        series: [{
		                name: "Profitability",
		                type: "line",
		                smooth: !0,
		                itemStyle: {
		                    normal: {
		                        areaStyle: {
		                            type: "default"
		                        }
		                    }
		                }
		                ,
		                data: [
                <?php /*foreach ($DataCpaAllGroup as $key => $value) { 
                	$Cpa = str_replace(',', '', number_format($value['Cpa']/1000000000, 2));
                	echo '"'.$Cpa.'", ';
                }*/ ?>	                
                <?php 
		        for ($i=$max_periode; $i > $min_periode; $i--) {
                	$Cpa = str_replace(',', '', number_format($DataCpaAllGroups['Cpa'.$i]/1000000000, 2));
                	echo '"'.$Cpa.'", ';
                } 
                ?>	                
		                    ]
		            }
		            ,                
		        ]
		    }
		    )
		}

	});
 
</script>

