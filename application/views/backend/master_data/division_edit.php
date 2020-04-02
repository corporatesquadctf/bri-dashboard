<div class="right_col" role="main">
    <div class="container">
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
    			<div class="x_panel">
    				<div class="x_title">
    					<h2>Edit<small>Division Data</small></h2>
    					<div class="clearfix"></div>
    				</div>
    				<div class="x_content">
    					<br/>
    					<form id="divForm" class="form-horizontal form-label-left" name="divForm" action="<?php echo base_url(); ?>admin/divisions/updateData" method="post">
    						<?php foreach ($currentData as $k) : ?>
    						<div class="form-group">
    							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="division-name">
    								Division Name
    								<span class="required">*</span>
    							</label>
    							<div class="col-md-6 col-sm-6 col-xs-12">
    								<input id="divId" type="hidden" name="divId" value="<?php echo $k->id; ?>" />
    								<input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['user_id']; ?>">
    								<input id="divName" type="text" name="divName" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $k->name; ?>" />
    							</div>
    						</div>
							<div class="form-group">
								<label class="col-md-3 col-sm-3 col-xs-12 control-label">
									Product Specialist
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div class="radio">
										<label class="">
											<div class="iradio_flat-green" style="position: relative;">
												<input type="radio" class="flat" name="prdSp" style="position: absolute; opacity: 0;" 
												<?php echo set_value('prdSp', $k->is_productspecialist) == 1 ? "checked" : ""; ?> />
												<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
											</div> Yes
										</label>
									</div>
									<div class="radio">
										<label class="">
											<div class="iradio_flat-green" style="position: relative;">
												<input type="radio" class="flat" name="prdSp" style="position: absolute; opacity: 0;" 
												<?php echo set_value('prdSp', $k->is_productspecialist) == 0 ? "checked" : ""; ?> />
												<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
											</div> No
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-sm-3 col-xs-12 control-label">
									Is Active
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div class="radio">
										<label class="">
											<div class="iradio_flat-green" style="position: relative;">
												<input type="radio" class="flat" name="stact" style="position: absolute; opacity: 0;" 
												<?php echo set_value('stact', $k->status) == 1 ? "checked" : ""; ?> />
												<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
											</div> Yes
										</label> 
									</div>
									<div class="radio">
										<label class="">
											<div class="iradio_flat-green" style="position: relative;">
												<input type="radio" class="flat" name="stact" style="position: absolute; opacity: 0;" 
												<?php echo set_value('stact', $k->status) == 0 ? "checked" : ""; ?> />
												<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
											</div> No
										</label>
									</div>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
									<button type="button" class="btn btn-warning">Cancel</button>
									<button type="submit" class="btn btn-success">Save</button>
								</div>
							</div>
    						<?php endforeach; ?>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
   </div>
</div>

<script>

window.onload = function() {
	
}

</script>