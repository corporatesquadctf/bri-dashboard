<div class="right_col" role="main">
    <div class="container">
    	<!-- isi konten ditaro disini -->
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
	    		<div class="x_panel">
		    		<div class="x_title">
		    			<h2>Financial Groups <small>Master Data</small></h2>
						<div class="pull-right">
							<button id="buttonAdd" class="btn btn-success btn-sm" type="button">
								<i class="fa fa-plus"></i>&nbsp;
								<b>Add New</b>
							</button>
						</div>
						<div class="clearfix"></div>
						<?php if($this->session->flashdata('Success')) { ?>
						<div class="alert alert-success alert-dismissable fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Success!</strong>
							<?php echo $this->session->flashdata('Success'); ?>
						</div>
						<?php } ?>
		    		</div>
        				
    				<div class="x_content">
    					<table data-toggle="table" data-pagination="true" class="table table-condensed table-striped table-hover">
						<thead style="background-color: #012D5A; color: #FFF;">
							<tr class="headings">
								<th class="" data-sortable="true">#</th>
								<th class="" data-sortable="true" data-field="group_name">Information Name</th>
								<th class="" data-sortable="true">Information Group</th>
								<th class="" data-sortable="true">Is Default ?</th>
								<th class="">Created Date</th>
								<th class="">Modified Date</th>
								<th class="" align="center" style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($data as $key) :
							?>

							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $key->info_name; ?></td>
								<td><?php echo $key->GROUP_NAME; ?></td>
								<td>
								<?php  
									$isdef = $key->IS_DEFAULT;
									if ($isdef == 1) {
										echo "Yes";
									} else {
										echo "No";
									}
								?>
								</td>
    							<td><?php echo date("d-m-Y H:i:s", strtotime($key->ADDON)); ?></td>
    							<td align="center">
								<?php 
									$MODION = $key->MODION;
									if ($MODION == '') {
										echo "<span>-</span>";
									} else {
										echo date("d-m-Y H:i:s", strtotime($MODION)); 	
									}
								?>
    							</td>
    							<td class="last" align="center" style="text-align: center;">
    								<a class="btn btn-xs btn-info btnEdit" 
										data-toggle="modal" 
    									data-target="#modalEdit<?php echo $key->info_id; ?>"
    									data-id="<?php echo $key->info_id; ?>">
    									<i class="fa fa-edit"></i>&nbsp;<b>Edit</b>
    								</a>
    								<a class="btn btn-xs btn-danger btnDelete"
    									data-toggle="modal"
    									data-target="#delModal<?php echo $key->info_id; ?>" 
    									data-id="<?php echo $key->info_id; ?>">
    									<i class="fa fa-trash"></i>&nbsp;<b>Delete</b>
    								</a>
    							</td>
							</tr>
							<?php endforeach;?>
						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    			<h4 class="modal-title" id="myModalLabel">Add Financial Highlight</h4>
			</div>

			<div class="modal-body">
				<form action="<?php echo base_url(); ?>admin/financialgroups/insertData" method="POST">
					<div class="form-group">
						<label class="control-label" for="infoName" required>Information Name</label>
						<input id="userId" type="hidden" name="userId" value="<?php echo $_SESSION['USER_ID']; ?>"/>
						<input id="infoName" type="text" name="infoName" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="infoGroup">Information Group</label>
						<select id="infoGroup" name="infoGroup" class="form-control">
							<option value="0"><span> -- Choose -- </span></option>
							<?php foreach($group as $g) :?>
							<option value="<?php echo $g->ID; ?>">
								<h6><?php echo $g->GROUP_NAME; ?></h6>
							</option>
							<?php endforeach; ?>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label class="control-label" for="isDef">Is Default ?</label>
						<div class="btn-group pull-right" data-toggle="buttons">
							<label class="btn btn-info btn-sm">
								<input type="radio" name="isDef" id="option1" value="1"/> Yes
							</label>
							<label class="btn btn-info btn-sm">
								<input type="radio" name="isDef" id="option1" value="0"/> No
							</label>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<br>
					<div class="clearfix"></div>
					<div class="form-group pull-right">
						<button id="btnCancel" class="btn btn-danger btn-sm">Cancel</button>
						<button id="btnSave" type="submit" class="btn btn-success btn-sm">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- MODAL EDIT -->
<?php foreach($data as $key) :?>
<div class="modal fade" id="modalEdit<?php echo $key->info_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    			<h4 class="modal-title" id="myModalLabel2">Edit Financial Highlight</h4>
			</div>

			<div class="modal-body">
				<form action="<?php echo base_url(); ?>admin/financialgroups/editData" method="POST">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12 pull-left" for="infoNameEdit" required>Information Name</label>
						<input type="hidden" id="userIdEdit" name="userIdEdit" value="<?php echo $_SESSION['USER_ID']; ?>">
						<input type="hidden" id="infoIdEdit" name="infoIdEdit" value="<?php echo $key->info_id; ?>">
						<input id="infoNameEdit" type="text" name="infoNameEdit" class="form-control" value="<?php echo $key->info_name; ?>" />
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12 pull-left" for="infoGroup">Information Group</label>
						<select id="infoGroupEdit" name="infoGroupEdit" class="form-control">
							<option value="0"><span> -- Choose -- </span></option>
							<?php foreach($group as $g) :?>
							<option value="<?php echo $g->ID; ?>" <?php if($g->ID == $key->GROUP_ID){echo 'selected'; }?>>
								<h6><?php echo $g->GROUP_NAME; ?></h6>
							</option>
							<?php endforeach; ?>
						</select>
						<div class="help-block with-errors"></div>				
						</div>					

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12 pull-left" for="isDefEdit">Is Default ?</label>
						<div class="btn-group col-md-3 col-sm-3 col-xs-12 pull-left" data-toggle="buttons">
							<label class="btn btn-info btn-sm">
								
								<input type="radio" name="isDefEdit" value= "1" <?php echo set_value('isDefEdit', $key->IS_DEFAULT) == 1 ? "on" : ""; ?> /> Yes
							</label>
							<label class="btn btn-info btn-sm">
								<input type="radio" name="isDefEdit" value= "0" <?php echo set_value('isDefEdit', $key->IS_DEFAULT) == 0 ? "on" : ""; ?> /> No
							</label>
						</div>
						<div class="help-block with-errors"></div>
					</div>
				</br>
			</br>
					<div class="form-group pull-right">
						<button id="btnCancelEdit" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button>
						<button id="btnSaveEdit"  type="submit" class="btn btn-success btn-sm">Save</button>
					</div>
				</form>
			</div>
		</div> 
	</div>
</div>
<?php endforeach; ?>
<!-- MODAL DELETE -->
<?php foreach($data as $key) : ?>
<div class="modal fade" id="delModal<?php echo $key->info_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #CD5C5C; color: #FFF;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" >DELETE <small style="color: #FFF;">Financial Group</small></h4>
			</div>
		<form action="<?php echo base_url(); ?>admin/financialgroups/deleteData" method="POST">
			<div class="modal-body" >
				<p> Are you sure to delete this data? </p>
				<input type="hidden" id="delUserId" name="delUserId" value="<?php echo $_SESSION['USER_ID']; ?>">
				<input type="hidden" id="delInfoId" name="delInfoId" value="<?php echo $key->info_id; ?>">
			</div>
			<div class="form-group pull-right">
				<button id="btnCancelDelete" data-dismiss="modal" class="btn btn-danger btn-sm" >No</button>
				<button id="btnYesDel"  type="submit" class="btn btn-success btn-sm">Yes</button>
			</div>
		</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<script src="<?=base_url();?>assets/appjs/mfinancialgroups.js"></script>