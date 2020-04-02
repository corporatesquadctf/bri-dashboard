<script type="text/javascript">
	
	$(document).ready(function(e){

		$('#btn-download').click(function(e){
			e.preventDefault();
			document.location.href = "<?=site_url('utility/Vcif/download_mass_upload_cif/'.$VCIF)?>";
		});
	
	});

</script>
<div class="right_col" role="main">
  <div class="container">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Utility</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('utility/Vcif');?>">Vcif Company</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Mass Upload CIF</div>
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

		<div class="panel panel-primary">
			<div class="panel-body">
				<?=form_open_multipart(site_url('utility/Vcif/uploaded_mass_input_cif'), array('role'=>'form','class'=>'form-horizontal','id'=>'form-upload','name'=>'form_upload'));?>
					<div class="form-group form-group-sm">
						<label for="nama_pemohon" class="col-sm-2 control-label">Input File CIF</label>
						<div class="col-sm-10">
							<input id="file-cif" type="file" name="file_cif" accept="application/vnd.ms-excel" placeholder="Pilih File Value Chain" style="border: 1px solid #ccc; width: 100%;" required="">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<div class="col-sm-10 col-sm-offset-2">
							<input type="hidden" name="VCIF" value="<?= $VCIF ?>">
              <button type="button" class="btn btn-default w150 btn-sm" onclick="window.location.href='<?=base_url('utility/Vcif');?>'">Back</button>
							<button class="btn btn-info btn-sm" type="submit" id="btn-upload">Upload Batch CIF</button>
							<button class="btn btn-success btn-sm" type="button" id="btn-download">Download Template</button>
						</div>
					</div>
				</form>
			</div>
		</div>
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


<div id="progress" class="progress" style="display: none;">
	<div  id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
		<span class="sr-only">60% Complete</span>
	</div>
</div>
<div id="subcontent">

</div>
</div>
              </div>
            </div>
          </div>
      </div>
    </div>

  </div>
</div>

