<div class="right_col" role="main">
    <div class="container">
    	<!-- isi konten ditaro disini -->
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
	    		<div class="x_panel">
		    		<div class="x_title">
		    			<h2>Access Role<small>Master Data</small></h2>
						<!-- <div class="pull-right">
							<button id="addBtn" data-toggle="modal" data-target="#addAcc" class="btn btn-success btn-sm" type="button">
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
								<th class="" data-sortable="true" width="7%">#</th>
								<th class="" data-sortable="true" data-field="name">Role Name</th>
								<th class="" style="text-align: center;" width="15%">Action</th>
								<th width="5%" class="" data-sortable="true" width="7%">#</th>
								<th class="" data-sortable="true" data-field="name">Role Name</th>
								<th width="15%" class="" style="text-align: center;" width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$i = 1;
							foreach ($MASTER_ROLE as $mr) :
						?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td>
									<input type="hidden" id="roleId" name="roleId" value="<?php echo $mr->ROLE_ID?>">
									<?php echo $mr->ROLE_NAME; ?>
								</td>
								<td>
									<a href="<?=base_url()?>admin/user_management/editAccess/<?php echo $mr->ROLE_ID; ?>" class="btn btn-xs btn-info btn-block">
    									<i class="fa fa-edit"></i>&nbsp;<b>Edit</b>
    									<i class="fa fa-edit"></i>&nbsp;<b>Setting</b>
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

    <div id="addAcc" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Access Role</h4>
	      </div>
	      <div class="modal-body">
	        <form>
			    <div class="form-group">
				  <label for="sel1">Choose Role:</label>
				  <input type="hidden" id="curUser" name="curUser" value="<?php echo $_SESSION['USER_ID']; ?>">
				  <select class="form-control" id="role" name="role">
				  	<?php
						$i = 1;
						foreach ($data_role as $key_users) :
					?>
				    <option value="<?php echo $key_users->ID; ?>"><?php echo $key_users->ROLE_NAME; ?></option>
				    <?php endforeach;?>
				  </select>
				</div>
				<div class="form-group">
					<label for="sel1">Choose Module:</label>
			    	<table data-toggle="table" data-pagination="true" class="table table-striped table-hover">
						<thead style="background-color: #012D5A; color: #FFF;">
							<tr class="headings">
								<th width="10%" class="" data-sortable="true">#</th>
								<th class="" data-sortable="true" data-field="name">Module Name</th>
								<th style="display: none;" width="10%">Access</th>
								<!-- <th class="" align="center" style="text-align: center;">Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($data_module as $key_menu) :
							?>
							<tr>
								<td>
									<div class="checkboxs">
									  <label><input type="checkbox" value="<?php echo $key_menu->ID; ?>" name="moduleID[]" id="moduleID"></label>
									</div>
								</td>
								<td><?php echo $key_menu->MODULE_NAME; ?></td>
								<td style="display: none;"><?php echo $key_menu->STATUS; ?></td>
								
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
	      	<input type="button" id="saveBtn" class="btn btn-primary saveBtn" data-dismiss="modal" value="Submit">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<?php foreach ($ACCESS_ROLES as $ar) : ?>
	<div id="edit<?php echo $key_users->ID; ?>" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Role</h4>
	      </div>
	      <div class="modal-body">
	        <form>
			    <div class="form-group">
			      <label for="usr">Name:</label>
			      <input type="text" class="form-control" id="usr" value="1111">
			    </div>
			    <div class="form-group">
				  <label for="sel1">Choose Signer Role:</label>
				  <select class="form-control" id="sel1">
				  	<?php
						$i = 1;
						foreach ($data_subrole as $key_users) :
					?>
				    <option>
				    	<?php echo $key_users->SUBROLE_NAME; ?>
				    </option>
				    <?php endforeach;?>
				  </select>
				</div>
				<div class="form-group">
					<label for="sel1">Choose Modul:</label>
			    	<table data-toggle="table" data-pagination="true" class="table table-striped table-hover">
						<thead style="background-color: #012D5A; color: #FFF;">
							<tr class="headings">
								<th width="10%" class="" data-sortable="true">#</th>
								<th class="" data-sortable="true" data-field="name">Modul Name</th>
								<th style="display: none;" width="10%"></th>
								<!-- <th class="" align="center" style="text-align: center;">Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($data_module as $key_menu) :
							?>
							<tr>
								<td>
									<div class="checkboxs">
									  <label><input type="checkbox" value="s"></label>
									</div>
								</td>
								<td><?php echo $key_menu->MODULE_NAME; ?></td>
								<td style="display: none;"><?php echo $key_menu->STATUS; ?></td>
								
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
			    <div class="form-group">
				  <label for="comment">Description:</label>
				  <textarea class="form-control" rows="5" id="comment"></textarea>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-PRIMARY" data-dismiss="modal">Save</button>
	      </div>
	    </div>

	  </div>
	</div>
	<?php endforeach;?>
</div>

<script src="<?=base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?=base_url();?>assets/jquery-validation/dist/additional-methods.min.js"></script>

