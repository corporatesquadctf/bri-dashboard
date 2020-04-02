<style type="text/css">
	.index {
		width: 2px;
		text-align: center;
	}

	.lft {
		text-align: left;
	}

	.editacc {
		width: 18%;
		text-align: left;
	}
	thead{
        background-color:#337ab7;
        color: #FFF;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
    	<!-- isi konten ditaro disini -->
		<div class="row">
			<div class="col-xs-12">
				<div class="x_panel container_header">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">User Management</li>
							<li class="breadcrumb-item active" aria-current="page">Access Role</li>
						</ol>
					</nav>
					<div class="page_title">
						<div class="pull-left" style="margin-left: 5px;">Access Role</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<div class="clearfix"></div>
						<div id="notif">
							
						</div>
					</div>
						
					<div class="x_content">
						<table data-toggle="table" data-pagination="true" class="table table-striped table-hover">
						<thead>
							<tr class="headings">
								<th class="index" data-sortable="true">No</th>
								<th class="lft" data-sortable="true">Role Name</th>
								<th class="editacc">Action</th>
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
									
									<?php echo $mr->ROLE_NAME; ?>
								</td>
								<td>
									<input type="hidden" id="roleId" name="roleId" value="<?php echo $mr->ROLE_ID?>">
									<a href="<?=base_url()?>admin/user_management/editAccess/<?php echo $mr->ROLE_ID; ?>">
										<div class="div-action pull-left">
											<i class="material-icons">edit</i>
											<label>Edit</label>
										</div>
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

<script src="<?=base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?=base_url();?>assets/jquery-validation/dist/additional-methods.min.js"></script>

