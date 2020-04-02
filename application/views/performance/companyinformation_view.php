<!-- EXTERNAL CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/custom/css/mycss.css">
<?php 
   foreach ($accountplanning as $key) {
      $Vcif = $key['VCIF'];
   }
?>

<div class="right_col" role="main">
   <div class="container">
      <div class="1" style="margin-bottom: -40px;">
         <div class="x_title" style="text-transform: uppercase; padding: 20px; background: #2a3f54; color: #fff;">
         <?php foreach($accountplanning as $dt) :  ?>
            <div class="col-lg-6 col-xs-12">
               <b style="text-transform: uppercase;">
                  <h3>ACCOUNT PLANNING</h3>
                  <?php echo $dt['CUSTOMER_NAME']; ?>
               </b>
            </div>
            <div class="col-lg-2 col-xs-12">
               <br>YEAR : </br>
               <span style="font-size: 16px; color: #FFF;"><b><?php echo $dt['DOC_YEAR']; ?></b></span>
            </div>
            <div class="col-lg-2 col-xs-12">
               <br>Division : </br>
               <span style="font-size: 16px; color: #FFF;"><b>BUMN 1</b></span>
            </div>
            <div class="col-lg-2 col-xs-12">
               <br>Clasification: </br>
               <span style="font-size: 16px; color: #FFF;"><b>PLATINUM</b></span>
            </div>
            <div class="clearfix"></div>
         <?php endforeach; ?>
      </div>
   </div>
   
   <div class="1">
      <section>
         <div class="wizard">
            <div class="wizard-inner">
               <div class="connecting-line"></div>
               <ul class="nav nav-tabs1" role="tablist">
                  <li role="presentation" class="active">
                     <a href="#step1" data-toggle="tab" aria-controls="Company Information" role="tab" title="Company Information">
                        <span class="round-tab">
                           <i class="fa fa-building"></i>
                        </span>
                     </a>
                     <div class="label-wizard">
                        <center>Company<br> Information</center>
                     </div>
                  </li>
                  <li role="presentation" class="disabled">
                     <a href="#step2" data-toggle="tab" aria-controls="bri" role="tab" title="BRI Starting Position">
                        <span class="round-tab">
                           <i class="fa fa-users"></i>
                        </span>
                     </a>
                     <div class="label-wizard">
                        <center>BRI Starting<br> Position</center>
                     </div>
                  </li>
                  <li role="presentation" class="disabled">
                     <a href="#step3" data-toggle="tab" aria-controls="Client Needs" role="tab" title="Client Needs">
                        <span class="round-tab">
                           <i class="fa fa-user"></i>
                        </span>
                     </a>
                     <div class="label-wizard">
                        <center>Client <br>Needs</center>
                     </div>
                  </li>
                  <li role="presentation" class="disabled">
                     <a href="#step4" data-toggle="tab" aria-controls="Action Plan" role="tab" title="Action Plan">
                        <span class="round-tab">
                           <i class="fa fa-sitemap"></i>
                        </span>
                     </a>
                     <div class="label-wizard">
                        <center>Action <br>Plan</center>
                     </div>
                  </li>
                  <li role="presentation" class="disabled">
                     <a href="#step5" data-toggle="tab" aria-controls="Input_" role="tab" title="Input _">
                        <span class="round-tab">
                           <i class="fa fa-file"></i>
                        </span>
                     </a>
                     <div class="label-wizard">
                        <center>Input <br> Simulasi</center>
                     </div>
                  </li>
               </ul>
            </div>
            <div>
               <div class="tab-content">
                  <div class="tab-pane active" role="tabpanel" id="step1">
                     <?php $this->load->view('performance/viewaccountplanning/view_companyinformation.php'); ?>
                     <ul class="list-inline pull-right tab-btn">
                   
                        <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                     </ul>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="step2">
                     <?php $this->load->view('performance/viewaccountplanning/view_bristartingpoint.php'); ?>
                     <ul class="list-inline pull-right tab-btn">
                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        <li><button type="button" class="btn btn-primary next-step bristartingpoint">Next Step</button></li>
                     </ul>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="step3">
                     <?php $this->load->view('performance/viewaccountplanning/view_clientneeds.php'); ?>
                     <ul class="list-inline pull-right tab-btn">
                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                     </ul>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="step4">
                     <?php $this->load->view('performance/viewaccountplanning/view_actionplans.php'); ?>
                     <ul class="list-inline pull-right tab-btn">
                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                     </ul>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="step5">
                     <?php $this->load->view('performance/viewaccountplanning/view_inputsimulasi.php'); ?>
                     <ul class="list-inline pull-right tab-btn">
                        <li class="center"><button type="button" class="btn btn-default prev-step">Previous</button></li>  
                     </ul>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>
</div>

<div class="modal fade" id="rejected" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-group">
            <label for="comment">Beri Catatan (Optional) :</label>
            <textarea class="form-control" rows="5" id="comment"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Send</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
  $(document).ready(function () {
    //Initialize tooltips
      $('.nav-tabs1 > li a[title]').tooltip();
      
      //Wizard
      $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

          var $target = $(e.target);
      
          if ($target.parent().hasClass('disabled')) {
              return false;
          }
      });

      $(".next-step").click(function (e) {

          var $active = $('.wizard .nav-tabs1 li.active');
          $active.next().removeClass('disabled');
          nextTab($active);

      });
      $(".prev-step").click(function (e) {

          var $active = $('.wizard .nav-tabs1 li.active');
          prevTab($active);

      });
  });

  function nextTab(elem) {
      $(elem).next().find('a[data-toggle="tab"]').click();
  }
  function prevTab(elem) {
      $(elem).prev().find('a[data-toggle="tab"]').click();
  }
</script>
<?php $this->load->view('performance/company/assets.php'); ?>