<style type="text/css">
.nav-tabss>li>a {
  background: #FFFFFF;
  border-radius: 4px;
  color: #707070;
  border: 1px solid #ddd;
  font-size: 14px;
  padding: 20px;
}
.nav-tabss>li.active>a, .nav-tabss>li.active>a:focus {
  background: #218FD8;
  border-radius: 4px;
  color: #FFFFFF;
  border: 1px solid #ddd;
  font-size: 14px;
  padding: 20px;
}
</style>

<div class="detail_section_con">
	<div class="col-xs-2" style="padding: 0;">
		<!-- required for floating -->
		<!-- Nav tabs -->
		<ul id="bri_sp_tab" class="nav nav-tabss tabs-left">
			<li class="<?= $account_planning['ap_tab_sub']['financial_highlights'] ?>"><a href="#financial_highlights" data-toggle="tab">Financial Highlights</a>
			</li>
			<li class="<?= $account_planning['ap_tab_sub']['facilities_banking'] ?>"><a href="#facilities_banking" data-toggle="tab">Facilities with Banking</a>
			</li>
			<li class="<?= $account_planning['ap_tab_sub']['wallet_share'] ?>"><a href="#wallet_share" data-toggle="tab">Wallet Share Analysis</a>
			</li>
			<li class="<?= $account_planning['ap_tab_sub']['competition_analysis'] ?>"><a href="#competition_analysis" data-toggle="tab">Competition Analysis</a>
			</li>
		</ul>
	</div>

	<div class="col-xs-10" id="bri_sp_tabContent">
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane<?= $account_planning['ap_tab_sub_content']['financial_highlights'] ?>" id="financial_highlights">
				<?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/financial_highlights.php'); ?>
			</div>
			<div class="tab-pane<?= $account_planning['ap_tab_sub_content']['facilities_banking'] ?>" id="facilities_banking">
				<?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/facilities_banking.php'); ?>
			</div>
			<div class="tab-pane<?= $account_planning['ap_tab_sub_content']['wallet_share'] ?>" id="wallet_share">
				<?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/wallet_share.php'); ?>
			</div>
			<div class="tab-pane<?= $account_planning['ap_tab_sub_content']['competition_analysis'] ?>" id="competition_analysis">
				<?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/competition_analysis.php'); ?>
			</div>
		</div>
	</div>
</div>



