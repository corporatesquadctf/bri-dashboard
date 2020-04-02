<style type="text/css">
.detail_title {
  font-weight: 600;
  font-size: 14px;
  line-height: 136.89%;
  align-items: center;
  letter-spacing: 0.25px;
  color: #707070;
}
.detail_property_titles {
  font-weight: 600;
  font-size: 12px;
  line-height: 24px;
  letter-spacing: 0.5px;
  color: #218FD8;
}
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

<!-- <div class="x_title detail_section_header_con">
  <h5 class="detail_section_title">Action Plans</h5>
</div> -->
<div class="detail_section_con">
  <div class="col-xs-2" style="padding: 0;">
    <!-- required for floating -->
    <!-- Nav tabs -->
    <ul id="action_plans_tab" class="nav nav-tabss tabs-left">
      <li class="<?= $account_planning['ap_tab_sub']['estimated_financial'] ?>"><a href="#estimated_financial" data-toggle="tab">Estimated Financial</a>
      </li>
      <li class="<?= $account_planning['ap_tab_sub']['initiatives_action'] ?>"><a href="#initiatives_action" data-toggle="tab">Initiatives & Action Plan</a>
      </li>
    </ul>
  </div>

  <div class="col-xs-10" id="action_plans_tabContent">
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane<?= $account_planning['ap_tab_sub_content']['estimated_financial'] ?>" id="estimated_financial">
          <?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/estimated_financial.php'); ?>
        </div>
        <div class="tab-pane<?= $account_planning['ap_tab_sub_content']['initiatives_action'] ?>" id="initiatives_action">
          <?php $this->load->view('tasklist/account_planning_menengah/input_account_planning/initiatives_action.php'); ?>
        </div>
    </div>
  </div>
</div>



