
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_contents">
        <div class="containerw">
            <div class="x_panels">
                <div class="x_contents">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Financial Highlights</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Facilities With Banking</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Wallet Share Analysis</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Competition Analysis</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content" style="border: 1px solid #dcdcdc;padding: 20px; padding-bottom: 50px; margin-top: -15px;">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <?php $this->load->view('performance/viewaccountplanning/view_financialhighlights.php'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                <?php $this->load->view('performance/viewaccountplanning/view_bankingfacilities.php'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <?php $this->load->view('performance/viewaccountplanning/view_walletshares.php'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                                <?php $this->load->view('performance/viewaccountplanning/view_competitions.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
