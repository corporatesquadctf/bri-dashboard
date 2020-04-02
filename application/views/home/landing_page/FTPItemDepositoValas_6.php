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
	                                        		<?php if (!empty($FTPItemDepositoValas['result'])) : ?>
		                                        		<?php foreach ($FTPItemDepositoValas['result'] as $row) { ?>
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
									                    <?php if (!empty($FTPItemDepositoValas_6['links'])) { ?>
				 					                    <?php echo $FTPItemDepositoValas_6['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
<script type="text/javascript">
  	var base_url = "<?= base_url(); ?>";

	$(document).ready(function() {
		$('li[id=button_FTPItemDepositoValas_6_next] > a').removeAttr("href");
		$('li[id=button_FTPItemDepositoValas_6_prev] > a').removeAttr("href");

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
    });
</script>
