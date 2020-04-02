<!-- top navigation -->
<style type="text/css">
	.txt{text-align: left;}
	.modal-dialog-lg {
	  width: 100%;
	  height: 100%;
	  margin: 0;
	  margin-top: -10px;
	  padding: 0;
	  background: #fff;
	}

	.modal-content-lg {
	  height: auto;
	  min-height: 100%;
	  background: #fff;
	  border-radius: 0;
	}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="container">
    	
		<?php $this->load->view('performance/simulasi_cpa/asumption.php'); ?>
		<?php $this->load->view('performance/simulasi_cpa/simulation.php'); ?>
		<?php $this->load->view('performance/simulasi_cpa/fee.php'); ?>

		<div class="col-md-12" style="padding: 10px;">
			<center>
	    		<!-- <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#calculate">
	    			Calculate 
	    		</button> -->
	    		<a class="btn btn-lg btn-primary" href="<?=base_url();?>perform/companyinformations/simulasicpa_calc/" target="_blank">
	    			Calculate 
	    		</a>
	    		<button class="btn btn-lg btn-warning clr">
	    			Reset Form
	    		</button>
	    	</center>
	    </div>
    </div>
    
</div>
                
<div id="calculate" class="modal fade" role="dialog">
  <div class="modal-dialog-lg ">

    <!-- Modal content-->
    <div class="modal-content-lg">
      
      <div class="modal-bodys">
      	<div style="padding: 0 10% 0 10% ; border-top:none;">
      		<h2>Result CPA</h2>
        	<?php $this->load->view('performance/simulasi_cpa/modal_calculate.php'); ?>
        </div>
      </div>
      <div class="modal-footer">
      	<!-- <center>
        	<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
    	</center> -->
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	$(".numberOnly").keypress(function(e) {
	    if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
	});
</script>

<script type="text/javascript">
	$('.clr').click(function(){$('.numberOnly').empty()})
</script>