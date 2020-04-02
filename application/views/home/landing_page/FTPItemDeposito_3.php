				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">< RP 100 Juta / BILYET</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/3'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemDeposito['result'])) : ?>
		                                        		<?php foreach ($FTPItemDeposito['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			< RP 100 Juta / BILYET
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Jangka Waktu
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->Term; ?> Bulan
	                                            		</div>
	                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #F58C38; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                                  		Suku Bunga Counter
	                                                    </div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            			<?= $row->InterestRate ?> %
	                                            		</div>
													</td>
		                                        		<?php } ?>
	                                        		<?php endif ?>
	                                        		<td style="width: 2.5%; text-align: right;">
									                    <?php if (!empty($FTPItemDeposito_3['links'])) { ?>
				 					                    <?php echo $FTPItemDeposito_3['links'] ?>
									                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
			                    		</table>
<script type="text/javascript">
  	var base_url = "<?= base_url(); ?>";

	$(document).ready(function() {
		$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
		$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");

	    $("#button_FTPItemDeposito_3_next").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_3_next").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_3_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_3_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_3_next").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_3_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
	    });

	    $("#button_FTPItemDeposito_3_prev").click(function(){
	        var rell 		= $("#button_FTPItemDeposito_3_prev").attr('rell');
	        var refTable 	= $("#button_FTPItemDeposito_3_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPItemDeposito_3_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPItemDeposito_3_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPItemDeposito_3_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPItemDeposito_3_next] > a').removeAttr("href");
			$('li[id=button_FTPItemDeposito_3_prev] > a').removeAttr("href");
	    });
    });
</script>
