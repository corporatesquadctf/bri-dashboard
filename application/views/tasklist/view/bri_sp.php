<style type="text/css">
  .panel_container{
      padding:0;
      border-radius: 4px;
  }
  .panel_container .title_container{
      border-bottom: 1px solid #e5e5e5;
      padding: 15px 30px;
      box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  .panel_container .title_container label{
      margin: 0 0 0 15px;
      font-weight: 600;
      font-size: 14px;
  }
  .content_container{
      padding: 0 0 20px 0;
      margin: 0;
      border: none;
  }
  .content_container .child_company_content{
      margin: 0;
      padding: 15px 10px;
      box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  .shadow_content_container{
      margin: 0;
      padding: 0;
      box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
  }
  /*
  .content_container .child_company_content button{
      font-size: 10px;
      line-height: 136.89%;
      letter-spacing: 0.15px;
      background: #F58C38;
      border-radius: 2px;
      color: #fff;
      width: 125px;
      height: 36px;
  }
  */
  .content_container .label_title{
      color: #218FD8;
      font-weight: 600;
      font-size: 14px;
  }
  .content_container .label_desc{
      color: #707070;
      font-weight: normal;
      font-size: 14px;
  }
  .child_content{
      padding: 5px 30px !important;
      display: flex;
  }
  .div-action{
      display: inline-flex;
      margin: auto;
      color: #F58C38;
      float: right;
  }
  .div-action i{
      font-size: 14px;
      font-weight: normal;
      margin: auto;
  }
  .div-action .fa-chevron-down:before {
      content: "none";
  }
  .div-action label{
      font-size: 14px;
      font-weight: normal;
      padding-left: 5px;
      margin-bottom: 0px;
  }
  .div-action:hover i, .div-action:hover label{
      cursor: pointer;
      font-weight: bold !important;
  }
  .label-action{
      margin:0 !important; 
      padding-left:5px !important; 
      font-weight: normal !important;
  }
  .div-cst{
      display: inline-flex;
      margin: 10px 0;
  }
  .detail_title {
    font-weight: 600;
    font-size: 14px;
    line-height: 136.89%;
    display: flex;
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
  .detail_property_titles2 {
    font-weight: 600;
    font-size: 12px;
    line-height: 24px;
    letter-spacing: 0.5px;
    color: #F58C38;
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
    <ul id="bri_sp_tab" class="nav nav-tabss tabs-left">
      <li class="<?= $account_planning['ap_tab_sub']['financial_highlights'] ?>"><a href="#financial_highlights" id="financial_highlights-tab" data-toggle="tab" tab_panel_type="<?=$AccountPlanningTabType?>" AccountPlanningId="<?= $AccountPlanningId ?>">Financial Highlights</a>
      </li>
      <li class="<?= $account_planning['ap_tab_sub']['facilities_banking'] ?>"><a href="#facilities_banking" id="facilities_banking-tab" data-toggle="tab" tab_panel_type="<?=$AccountPlanningTabType?>" AccountPlanningId="<?= $AccountPlanningId ?>">Facilities with Banking</a>
      </li>
      <li class="<?= $account_planning['ap_tab_sub']['wallet_share'] ?>"><a href="#wallet_share" id="wallet_share-tab" data-toggle="tab" tab_panel_type="<?=$AccountPlanningTabType?>" AccountPlanningId="<?= $AccountPlanningId ?>">Wallet Share Analysis</a>
      </li>
      <li class="<?= $account_planning['ap_tab_sub']['competition_analysis'] ?>"><a href="#competition_analysis" id="competition_analysis-tab" data-toggle="tab" tab_panel_type="<?=$AccountPlanningTabType?>" AccountPlanningId="<?= $AccountPlanningId ?>">Competition Analysis</a>
      </li>
    </ul>
  </div>

                      <div class="col-xs-10" id="bri_sp_tabContent">
<!-- start bri_sp_tabContent -->


