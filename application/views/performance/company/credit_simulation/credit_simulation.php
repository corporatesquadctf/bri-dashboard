<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2><small>ASSUMPTION</small></h2>
         
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	 <?php $this->load->view('performance/company/credit_simulation/input_simulation_assumptions'); ?>
      </div>
   </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2><small>SIMULATION</small></h2>
         <div class="clearfix"></div>
      </div>
      <ul class="nav navbar-right panel_toolbox">
            <p class="help-block lbl-million">*Valas dalam bentuk dollar dan IDR dalam bentuk rupiah</small></p>
         </ul>
      <div class="x_content">
         <?php $this->load->view('performance/company/credit_simulation/input_simulation_parameters'); ?>
      </div>
   </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
      <div class="x_title">
         <h2><small>Fee</small></h2>
         <div class="clearfix"></div>
      </div>
      <ul class="nav navbar-right panel_toolbox">
            <p class="help-block lbl-million">*Valas dalam bentuk dollar dan IDR dalam bentuk rupiah</small></p>
         </ul>
      <div class="x_content">
         <?php $this->load->view('performance/company/credit_simulation/input_fee'); ?>
      </div>
   </div>
</div>

    