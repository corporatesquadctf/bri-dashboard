<div class="right_col" role="main">
    <div class="container">
    	<!-- isi konten ditaro disini -->
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
	    		<div class="x_panel">
		    		<div class="x_title">
		    			<h2>Role Menu<small>Master Data</small></h2>
						<!-- <div class="pull-right">
							<button id="addBtn" class="btn btn-success btn-sm" type="button">
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
								<th class="" data-sortable="true">No</th>
								<th class="" data-sortable="true" data-field="name">Module Name</th>
								<th class="" data-sortable="true">Controller</th>
								<th class="">Access</th>
								<!-- <th class="" align="center" style="text-align: center;">Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach 	($data as $module) :
							?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $module->MODULE_NAME; ?></td>
								<td><?php echo $module->MODULE_PATH; ?></td>
    							<td><?php echo $module->STATUS; ?></td>
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
    			</div>
    		</div>
    	</div>
    </div>

    
</div>