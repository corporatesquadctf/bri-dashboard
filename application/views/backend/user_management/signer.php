<div class="right_col" role="main">
    <div class="container">
    	<!-- isi konten ditaro disini -->
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
	    		<div class="x_panel">
		    		<div class="x_title">
		    			<h2>Role Menu<small>Master Data</small></h2>
						<!-- <div class="pull-right">
							<button id="addBtn" data-toggle="modal" data-target="#add_signer" class="btn btn-success btn-sm" type="button">
								<i class="fa fa-plus"></i>&nbsp;
								<b>Add New</b>
							</button>
						</div> -->
						<div class="clearfix"></div>
						<div id="notif">
							
						</div>
		    		</div>
        				
    				<div class="x_content">
    					<table data-toggle="table" data-pagination="true" class="table table-striped table-hover">
						<thead style="background-color: #012D5A; color: #FFF;">
							<tr class="headings">
								<th class="" data-sortable="true">#</th>
								<th class="" data-sortable="true" data-field="name">Signer Name</th>
								<th class="" data-sortable="true">Description</th>
								<!-- <th class="" align="center" style="text-align: center;">Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($data_signer as $signer) :
							?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $signer->SUBROLE_NAME; ?></td>
								<td><?php echo $signer->DESCRIPTION; ?></td>
    							<!-- <td class="last" align="center" style="text-align: center;">
    								<a href="#" data-toggle="modal" data-target="#role_<?php echo $signer->ID; ?>" class="btn btn-xs btn-info">
    									<i class="fa fa-edit"></i>&nbsp;<b>Edit</b>
    								</a>
    								<a href="#" class="btn btn-xs btn-danger">
    									<i class="fa fa-trash"></i>&nbsp;<b>Delete</b>
    								</a>
    							</td> -->
							</tr>
							<?php endforeach;?>
						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <!-- Modal -->
    <?php
		$i = 1;
		foreach ($data_signer as $signer) :
	?>
	<div class="modal fade" id="role_<?php echo $signer->ID; ?>" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Module</h4>
	        </div>
	        <div class="modal-body">
	          	<form>
			    <div class="form-group">
			      <label for="usr">Role Name:</label>
			      <input type="text" class="form-control" id="usr" value="<?php echo $signer->SUBROLE_NAME; ?>">
			    </div>
			    <div class="form-group">
			      <label for="comment">Description:</label>
			      <textarea class="form-control" rows="5" id="comment"><?php echo $signer->DESCRIPTION; ?></textarea>
			    </div>
			    <div class="form-group">
			    	<table data-toggle="table" data-pagination="true" class="table table-striped table-hover">
						<thead style="background-color: #012D5A; color: #FFF;">
							<tr class="headings">
								<th class="" data-sortable="true">#</th>
								<th class="" data-sortable="true" data-field="name">Modul Name</th>
								<th width="10%"></th>
								<!-- <th class="" align="center" style="text-align: center;">Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($data_signer as $key_menu) :
							?>
							<tr>
								<td>aaa</td>
								<td>dddd></td>
								<td>
									<div class="checkboxs">
									  <label><input type="checkbox" value="s"></label>
									</div>
								</td>
    							<!-- <td class="last" align="center" style="text-align: center;">
    								<a href="#" data-toggle="modal" data-target="#role_" class="btn btn-xs btn-info">
    									<i class="fa fa-edit"></i>&nbsp;<b>Edit</b>
    								</a>
    								<a href="#" class="btn btn-xs btn-danger">
    									<i class="fa fa-trash"></i>&nbsp;<b>Delete</b>
    								</a>
    							</td> -->
							</tr>
							<?php endforeach;?>
						</tbody>
    				</table>
			    </div>
			  	</form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<?php endforeach;?>

</div>