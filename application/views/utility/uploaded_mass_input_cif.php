<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
	
	$(document).ready(function(e){
		$('[data-toggle="tooltip"]').tooltip();

		// $('#form-cif').submit(function(e){
		// 	e.preventDefault();
		$('#OK_mass_cif').click(function(){
		    $('#confirmModal').modal('hide');
			// if(confirm('Anda yakin akan menyimpan data CIF ini?')) {
				$.ajax({
					type: 'post',
					url : '<?=site_url('utility/Vcif/save_uploaded_mass_upload_cif')?>',
					data: $('#form-cif').serialize(),
					dataType: 'json',
					beforeSend:function(){
						$('.loaderImage').show();
					},
					error: function(jqXHR, textStatus, errorThrown){
						$('.loaderImage').hide();
						new PNotify({
						  title: 'Error Thrown!',
						  text: "Message : "+errorThrown,
						  type: 'error',
						  styling: 'bootstrap3'
						});

						PNotify.prototype.options.delay = 4000;
					},
			        success: function(response){
			          console.log(response.status);
			          if(response.status === 'success'){
			            new PNotify({
			                title: 'Success!',
			                text: response.message,
			                type: 'success',
			                styling: 'bootstrap3'
			            });

			            PNotify.prototype.options.delay = 4000;

			            setTimeout(function(){ 
			              $('.loaderImage').hide();
			              window.location.href= base_url+'utility/Vcif';
			            }, 4500);

			          }else if(response.status === 'error'){
			            $('.loaderImage').hide();
			            new PNotify({
			                title: 'Response Error!',
			                text: response.message,
			                type: 'error',
			                styling: 'bootstrap3'
			            });

			            PNotify.prototype.options.delay = 4000;
			          }
			        }
				});
			// }
			
		});
	});

  function confirmModal() {
    $('#modal-VCIF').modal('hide');
    $('#confirmModal').modal('show');
    var confirmation_text = $('#OK').attr('confirmation_text');
    $("#confirmation_text").text(confirmation_text);
  }

</script>


<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text">Your'e about to Upload mass CIF details. <br> Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK_mass_cif" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="right_col" role="main">
  <div class="container">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Utility</li>
                      <li class="breadcrumb-item"><a href="<?=base_url('utility/Vcif');?>">Vcif Company</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('utility/Vcif/mass_upload_cif/'.$VCIF);?>">Vcif Company</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Mass Upload CIF to <?=$VCIF?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <div class="col-md-12 col-sm-12 col-xs-12">

<?php if($result): ?>
<?=form_open('utility/Vcif/save_uploaded_mass_upload_cif', 'id="form-cif"');?>
<?=form_input(array('type'=>'hidden', 'name'=>'VCIF', 'value'=>$VCIF));?>
<?=form_input(array('type'=>'hidden', 'name'=>'filename', 'value'=>$filename));?>
<?=form_input(array('type'=>'hidden', 'name'=>'summary', 'value'=>'data_sukses:'.$ctr_success.';data_gagal:'.$ctr_failure))?>
<div class="alert alert-info">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6">Valid = <?=$ctr_success?> row(s)</div>
		<div class="col-lg-6 col-md-6 col-sm-6">Failed = <?=$ctr_failure?> row(s)</div>
	</div>
</div>
<div class="table-responsive">
	<?php $colspan="7"; ?>
	<table class="table table-brispot table-bordered table-striped table-condensed">
		<thead>
			<tr class="theader">
				<td align="center" width="5%">No</td>
				<td align="center" width="10%">Valid</td>
				<td align="center" width="30%">Response</td>
				<td align="center">CIF</td>
			</tr>
		</thead>
		<tbody>
			<?php if($content): ?>
			<?php $counter = 0; ?>
			<?php $numbers = 1; ?>
			<?php foreach($content as $key => $row): ?>
			<?php $class = $counter % 2 ? 'odd' : 'even'; ?>
			<?php if($row['valid']): ?>
			<?=form_input(array('type'=>'hidden', 'name'=>'cif[]', 'value'=>$row['cif']));?>
			<?php endif; ?>
			<tr>
			<!-- Valid -->
				<td class="<?=$class?>" align="left">
					 <?=$numbers?>
				</td>
				<td class="<?=$class?>" align="center">
					<?php if($row['valid']): ?>
					<span style="cursor: pointer;"><i class="fa fa-check" style="color: green;"></i></span>
					<?php else: ?>
					<span data-toggle="tooltip" data-placement="right" title="<?=$row['message']?>" style="cursor: pointer;"><i class="fa fa-remove" style="color: red;"></i></span>
					<?php endif; ?>
				</td>
				<td class="<?=$class?>" align="center">
					 <?=$row['message']?>
				</td>
			<!-- CIF -->
				<td class="<?=$class?>" align="center">
					<?=$row['cif'] ? $row['cif'] : 'n/a'?><br/>
				</td>
			</tr>
			<?php $counter++; ?>
			<?php $numbers++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td align="left" colspan="<?=$colspan?>">Total Row : <?=$content ? count($content) : 0; ?></td>
			</tr>
		</tfoot>
	</table>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 text-right">
      <button type="button" class="btn btn-default w150 btn-sm" onclick="window.location.href='<?=base_url('utility/Vcif/mass_upload_cif/'.$VCIF);?>'">Back</button>
		<!-- <?=form_button(array('id'=>'btn-disposisi', 'type'=>'submit', 'class'=>'btn btn-info w150 btn-sm', 'content'=>'Simpan Data CIF'));?> -->
      <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModal(); return false;">Save</button>
	</div>
</div>
<?=form_close();?>
<?php else: ?>
	<div class="alert alert-danger text-center">
		<?=$result_message?>
	</div>
<?php endif; ?>

              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>