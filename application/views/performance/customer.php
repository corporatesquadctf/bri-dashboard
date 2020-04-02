<!-- Datatables -->
<link href="<?=base_url();?>template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url();?>template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url();?>template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url();?>template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url();?>template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">
    $('.no_cif_perusahaan').on('hidden.bs.collapse', function(event) {
      event.stopPropagation();
      $('.glyphicon').addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
    });
    $('.no_cif_perusahaan').on('show.bs.collapse', function(event) {
      event.stopPropagation();
      $('.glyphicon').addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
    });
</script>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customer Monitoring <small>Some examples to get you started</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Board<small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table is="cust_table" class="table table-striped table-bordered" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th data-field="index">No</th>
                                <th data-field="NAME">Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url();?>template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?=base_url();?>template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?=base_url();?>template/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?=base_url();?>template/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url();?>template/vendors/pdfmake/build/vfs_fonts.js"></script>

