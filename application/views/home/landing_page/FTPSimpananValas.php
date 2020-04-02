        <script src="<?=base_url();?>assets/jquery/dist/jquery.min.js"></script>

				                    	<div style="height: 36px;">
				                    		<span style="font-weight: bold; padding: 0; font-size: 15px;">Giro Valas</span>
                                        	<?php if($this->session->ROLE_ID == 1) : ?>
                                        	<i class="material-icons" style="font-size: 10px; color: #F58C38; vertical-align: baseline; cursor: pointer;" onclick="window.location.href='<?= base_url('ftp/ftp_position/edit_ftp_position/2'); ?>'">build</i>
                                        	<?php endif; ?>
				                    	</div>
										<table id="FTPSimpananValas" style="width: 100%;">
	                                        <tbody>
	                                            <tr>
	                                        		<td style="width: 2.5%; text-align: left;">
	                                        		</td>
	                                        		<?php if (!empty($FTPItemSimpanan['result'])) : ?>
		                                        		<?php foreach ($FTPItemSimpanan['result'] as $row) { ?>
	                                        		<td style="box-shadow: 0px 4px 4px #EDEDED; border-radius: 5px 5px 0px 0px; width: 181px;">
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; font-weight: bold;">
	                                            			Giro Valas USD
	                                            		</div>
	                                        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #4BB8FF; font-size: 12px; padding: 10px; vertical-align: middle; border-top: 1px solid #ddd; font-weight: bold;">
	                                            			Saldo
	                                            		</div>
	                                            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 12px; padding: 0 0 20px 8px; vertical-align: middle; font-weight: bold;">
	                                            		<?php
                                                            $descSaldo = "";
                                                            if($row->BottomMargin != null){
                                                                $btmMargin = $row->BottomMargin == 0 ? $row->BottomMargin : $row->BottomMargin -1;
                                                                $btmMargin = $btmMargin / 1000000;
                                                                $descSaldo .= "≥ ".number_format($btmMargin, 0, ".", ",");
                                                            }
                                                            if($row->TopMargin != null){
                                                                $topMargin = $row->TopMargin / 1000000;
                                                                $descSaldo .= " s/d ".number_format($topMargin, 0, ".", ",");
                                                            }
	                                            		?>
	                                            			<?= $descSaldo; ?>
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
								                    <?php if (!empty($FTPSimpananValas['links'])) { ?>
			 					                    <?php echo $FTPSimpananValas['links'] ?>
								                    <?php } ?>
	                                        		</td>
	                                            </tr>
			                    			</tbody>
			                    		</table>
<script type="text/javascript">
  	var base_url = "<?= base_url(); ?>";

	$(document).ready(function() {
		$('li[id=button_FTPSimpananValas_next] > a').removeAttr("href");
		$('li[id=button_FTPSimpananValas_prev] > a').removeAttr("href");

	    $("#button_FTPSimpananValas_next").click(function(){
	        var rell 		= $("#button_FTPSimpananValas_next").attr('rell');
	        var refTable 	= $("#button_FTPSimpananValas_next").attr('reftable');
	        var FTPItemId 	= $("#button_FTPSimpananValas_next").attr('ftpitemid');
	        var refView 	= $("#button_FTPSimpananValas_next").attr('refview');
	        var pages 		= $('li[id=button_FTPSimpananValas_next] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
	        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPSimpananValas_next] > a').removeAttr("href");
			$('li[id=button_FTPSimpananValas_prev] > a').removeAttr("href");
	    });
	    
	    $("#button_FTPSimpananValas_prev").click(function(){
	        var rell 		= $("#button_FTPSimpananValas_prev").attr('rell');
	        var refTable 	= $("#button_FTPSimpananValas_prev").attr('reftable');
	        var FTPItemId 	= $("#button_FTPSimpananValas_prev").attr('ftpitemid');
	        var refView 	= $("#button_FTPSimpananValas_prev").attr('refview');
	        var pages 		= $('li[id=button_FTPSimpananValas_prev] > a').attr('data-ci-pagination-page');

	        console.log(rell);
	        console.log(refTable);
	        console.log(FTPItemId);
	        console.log(refView);
	        console.log(pages);
		        
		    $('#'+refView).load("<?= base_url('Home/getLoadFTPDetailByPage/')?>" + refTable + "/" + FTPItemId + "/" + pages + "/" + refView + "/" + rell, function(responseTxt, statusTxt, xhr){
	      	});
			$('li[id=button_FTPSimpananValas_next] > a').removeAttr("href");
			$('li[id=button_FTPSimpananValas_prev] > a').removeAttr("href");
	    });
    });

</script>
