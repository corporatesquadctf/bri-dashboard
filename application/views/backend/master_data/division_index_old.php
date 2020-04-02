<div class="right_col" role="main">
    <div class="container">
    	<!-- isi konten ditaro disini -->
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
	    		<div class="x_panel">
		    		<div class="x_title">
		    			<h2>Divisions <small>Master Data</small></h2>
						<div class="pull-right">
							<button id="addBtn" class="btn btn-success btn-sm" type="button">
								<i class="fa fa-plus"></i>&nbsp;
								<b>Add New</b>
							</button>
						</div>
						<div class="clearfix"></div>
						<div id="notif">
							
						</div>
		    		</div>

		    		<div class="x_content">
    					<table data-toggle="table" data-pagination="true" class="table table-striped table-hover">
    					<thead style="background-color: #012D5A; color: #FFF;">
    						<tr class="headings">
    							<th class="" data-sortable="true">#</th>
    							<th class="" data-sortable="true" data-field="name">Division Name</th>
    							<th class="" data-sortable="true">Product Specialist</th>
    							<th class="" data-sortable="true">Status</th>
    							<th class="">Created Date</th>
    							<th class="">Modified Date</th>
    							<th class="" align="center" style="text-align: center;">
    								<span class="">Action</span>
    							</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php 
    							$i = 1;
    							foreach ($divisionData as $k) :
    						?>
							<tr>
    							<td><?php echo $i++; ?></td>
    							<td><?php echo $k->name; ?></td>
    							<td >
    								<?php 
    									$prdsp = $k->is_productspecialist;
    									if ($prdsp != 0) {
    										echo "Yes";
    									} else {
    										echo "No";
    									}
    								?>
    							</td>
    							<td>
    								<?php 
    									$status = $k->status;
    									if ($status != 0) {
    										echo "Active";
    									} else {
    										echo "Not Active";
    									}
    								?>
    							</td>
    							<td><?php echo date("d-m-Y H:i:s", strtotime($k->addon)); ?></td>
    							<td><?php echo $k->modion; ?></td>
    							<td class="last" align="center" style="text-align: center;">
    								<a href="<?php echo base_url()?>admin/divisions/editView/<?php echo $k->id;?>" class="btn btn-xs btn-info">
    									<i class="fa fa-edit"></i>&nbsp;<b>Edit</b>
    								</a>
    								<a href="#" class="btn btn-xs btn-danger">
    									<i class="fa fa-trash"></i>&nbsp;<b>Delete</b>
    								</a>
    							</td>
    						</tr>
    						<?php endforeach; ?>
    					</tbody>
    				</table>
		    	</div>
	    	</div>
    	</div>
   </div>
</div>

<div class="modal modal-success fade in" id="addDivision">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                	<i class=""></i>Add New Division
                </h4>
            </div>
            <div class="modal-body">
            	<form id="modalForm" role="form">
            		<div class="row"> 
	            		<div class="col-md-12">
								<div class="form-group">
									<label>Division Name</label>
									<input id="divName" name="divName" type="text" class="form-control" placeholder="Place new division name here...">
									<input id="userId" name="userId" type="hidden" value="<?php echo $_SESSION['user_id']; ?>">
								</div>
	            		</div>
            		</div>
	            	<div class="row">
	            		<div class="col-md-4">
	            			<div class="form-group">
		                    	<span style="font-weight: 500;">Is Product Specialist ?&nbsp;</span>
								</div>
	            		</div>
	            		<div class="col-md-4">
	            			<label class="form-check-label">
		                     <input class="form-check-input" type="radio" name="prdsp" style="margin-left: 10px;"> Yes
	                    	</label>
	            		</div>
	            		<div class="col-md-4">
	                    	<label class="form-check-label">
		                     <input class="form-check-input" type="radio" name="prdsp">  No
	                    	</label>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-4">
	            			<div class="form-group">
		                    	<span style="font-weight: 500;">Is Active ?&nbsp;</span>
								</div>
	            		</div>
	            		<div class="col-md-4">
	            			<label class="form-check-label">
		                     <input class="form-check-input" type="radio" name="status" style="margin-left: 10px;"> Yes
	                    	</label>
	            		</div>
	            		<div class="col-md-4">
	                    	<label class="form-check-label">
		                     <input class="form-check-input" type="radio" name="status">  No
	                    	</label>
	            		</div>
	            	</div>
	            </form>
         	</div>
         	<div class="modal-footer">
               <button id="modalSave" name="modalSave" type="submit" class="btn btn-sm btn-success">
               	<i class="fa fa-check"></i>&nbsp;Save
               </button>
               <button id="modalClose" name="modalClose" type="button" class="btn btn-sm btn-warning" data-dismiss="modal">
               	<i class="fa fa-close"></i>&nbsp;Cancel
               </button>
         	</div>
        </div>
    </div>
</div>

<script>

window.onload = function() {
	$('#addBtn').on('click', function() {
		$('#addDivision').modal('show');
	});

	$('#addDivision').on('shown.bs.modal', function(e) {
		$('#modalClose').on('click', function() {
			$(this).modal('hide');
		});

		$('#modalSave').on('click', function() {
			var form 	= $('#modalForm');
			var dName 	= $('#divName').val();
			var st1		= $('input[name=prdsp]:checked').val();
			var st2		= $('input[name=status]:checked').val();

			e.preventDefault();

			if (dName != '') {
				if (st1 == 'on') {
					if (st2 == 'on') {
						$('#modalForm', form).html('<img src="template/build/images/loading.gif" /> Please wait...');
						$.ajax({
							type		: "POST",
							url 		: "<?php echo base_url(); ?>admin/divisions/insertToDb",
							data 		: $('#modalForm').serialize(),
							success 	: function(response, status) {
								
								if (response == 1) {
									$('#addDivision').modal('hide');
									
									new PNotify({
										title: 'Success!',
										text: 'New Division has been saved successfuly.',
										type: 'success',
										styling: 'bootstrap3'
									});

									PNotify.prototype.options.delay = 1000;

									setTimeout(function() {
										location.reload();
									}, 1200);
								}
							},
							error		: function(request, status, error) {
								
							}
						});
					} else {
						alert("Status cannot be null!");
					}
				} else {
					alert("Is Product Specialist cannot be null!");
				}
			} else {
				alert("Division Name cannot be null!");
			}
		});
	});
}

</script>