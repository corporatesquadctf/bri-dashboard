<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_contents">
      <div class="containerw">
         <div class="x_panels">
            <div class="x_contents">
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="cpaTab" class="nav nav-tabs bar_tabs" role="tablist">
                     <li role="presentation" class="active">
                        <a href="#tab_content1" id="existing-tab" role="tab" data-toggle="tab" aria-expanded="true">CPA Existing</a>
                     </li>
                     <li role="presentation" class="">
                        <a href="#tab_content2" role="tab" id="projection-tab" data-toggle="tab" aria-expanded="true">CPA Projection</a>
                     </li>
                     <li role="presentation" class="">
                        <a href="#tab_content3" role="tab" id="delta-tab" data-toggle="tab" aria-expanded="true">CPA Delta</a>
                     </li>
                  </ul>
                  <div id="cpaTabContent" class="tab-content" style="border: 1px solid #dcdcdc;padding: 20px; padding-bottom: 50px; margin-top: -15px;">
                     <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="existing-tab">
                        <?php $this->load->view('performance/viewaccountplanning/view_cpaexisting.php'); ?>
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="projection-tab">
                        <?php $this->load->view('performance/viewaccountplanning/view_cpaprojection.php'); ?>
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="delta-tab">
                        <?php $this->load->view('performance/viewaccountplanning/view_cpadelta.php'); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
