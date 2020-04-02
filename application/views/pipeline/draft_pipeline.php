<style type="text/css">
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    .dataTables_paginate {
        float: left !important;
    }
    .dataTables_info {
        width: 40%;
        float: left;
        margin-left: 25px;
    }
    .dataTables_filter {
        width: auto;
        float: right;
        text-align: right;
    }
    table { 
        border-collapse: separate; 
        border-spacing: 0 10px; 
        margin-top: -10px;
    }    
    thead{
        color:#218FD8;
    }
    thead tr{
        background-color:#F7F7F7;
        box-shadow: none;
    }
    tr{
        box-shadow: 0px 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    tr th{
        border: none !important;
    }
    td {
        border: 1px solid #ddd;
        border-style: solid none;
        padding: 10px;
        background: #FFF;        
    }
    td>a:hover{
        font-weight:bold;
    }
    td:first-child{
        border-left-style: solid;
        border-top-left-radius: 4px; 
        border-bottom-left-radius: 4px;
    }
    td:last-child{
        border-right-style: solid;
        border-bottom-right-radius: 4px; 
        border-top-right-radius: 4px; 
    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #218FD8;
        border-color: #337ab7;
    }
</style>
<div class="right_col" role="main">    
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Pipeline</li>
                            <li class="breadcrumb-item active" aria-current="page">Draft</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Draft</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="padding:1px 0px;">
                        <ul class="nav navbar-right panel_toolbox" style="min-width:0px;">
                            <?php if($this->session->ROLE_ID == USER_ROLE_RM_MENENGAH): ?>
                            <li>
                                <button id="btn_add_pipeline" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Create</button>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a class="collapse-link btn w150 btn-sm btn-default" style="margin-bottom:0px;"><label class="search-form">Hide Filter</label></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <form id="updatePipelineForm" method="POST" class="form-horizontal form-label-left">
                        <?php if($user['ROLE_ID'] != 12 && $user['ROLE_ID'] != 13 && $user['ROLE_ID'] != 14):?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uker_id">Unit Kerja</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="uker_id" name="uker_id" style="width:100%;">
                                    <?php
                                    foreach ($uker_option as $row){
                                        $selected = '';
                                        if($uker_id == $row->UnitKerjaId) $selected = 'selected="selected"';
                                        echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->Name.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($user['ROLE_ID'] != 12){ ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rm_id">Nama RM</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="rm_id" name="rm_id" style="width:100%;">
                                    <?php
                                    foreach ($rm_option as $row){
                                        $selected = '';
                                        if($rm_id == $row->UserId) $selected = 'selected="selected"';
                                        echo '<option value="'.$row->UserId.'" '.$selected.'>'.$row->Name.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Pencarian</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="keyword" name="keyword" class="form-control col-md-7 col-xs-12" value="<?= $keyword; ?>" placeholder="Ketik Keyword">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
                                <button id="btn_filter_pipeline" class="btn w150 btn-sm btn-primary pull-left" style="margin-right:0px;" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background:none; border:none; padding: 0px;">
                    <div class="x_content">
                        <form id="submitPipelineForm" action="<?= base_url().'pipeline/submit_pipeline'; ?>" method="POST">
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="tbl_draft_pipeline" class="table table-striped table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;"><input name="select_all" value="1" type="checkbox"></th>
                                            <th style="width:3%;">No.</th>
                                            <th style="width:20%;">Nama Debitur</th>
                                            <th style="width:10%;">Status Permohonan</th>
                                            <th style="width:20%;">Alamat</th>
                                            <th style="width:12%;">Jenis Usaha</th>
                                            <th style="width:3%;">LPG</th>
                                            <th style="width:5%;">Sumber Debitur</th>
                                            <th style="width:9%;">Usulan Plafond</th>
                                            <?php if($this->session->ROLE_ID == USER_ROLE_RM_MENENGAH): ?>
                                            <th style="width:10%;">Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 1;
                                        foreach($pipeline as $row){
                                            switch($row->LPGStatus){
                                                case '1': $lpg = '<i id="lpg_red" class="fa fa-square" style="color:#E74545"></i>'; break;
                                                case '2': $lpg = '<i id="lpg_yellow" class="fa fa-square" style="color:#FFEF9D"></i>'; break;
                                                case '3': $lpg = '<i id="lpg_green" class="fa fa-square" style="color:#62D159"></i>'; break;
                                                case '4': $lpg = '<i id="lpg_blue" class="fa fa-square" style="color:#218FD8"></i>'; break;
                                                default: $ews = ''; break;
                                            }
                                            switch($row->CustomerResouceId){
                                                case '1': $tdb_status = 'TDB'; break;
                                                case '2': $tdb_status = 'Non TDB'; break;
                                                default: $tdb_status = ''; break;
                                            }
                                    ?>
                                            <tr id="r<?= $row->PipelineId; ?>">
                                                <td><?= $row->PipelineId; ?></td>
                                                <td><?= $i; ?></td>
                                                <td><?= $row->CustomerName; ?></td>
                                                <td><?= $row->DataSourceName; ?></td>
                                                <td><?= $row->Address; ?></td>
                                                <td><?= $row->BusinessType; ?></td>
                                                <td><?= $lpg; ?></td>
                                                <td><?= $tdb_status; ?></td>
                                                <td style="text-align: right;"><label style="font-weight:normal;" class="money" data-a-sep="," data-a-dec="."><?= $row->Plafond; ?></label></td>
                                                <?php if($this->session->ROLE_ID == USER_ROLE_RM_MENENGAH): ?>
                                                <td>
                                                    <div class="div-action pull-left btn_edit_pipeline" data-id="<?= $row->PipelineId; ?>">
                                                        <i class="material-icons">edit</i>
                                                        <label>Edit</label>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <span style="font-size:11px;">
                            Catatan:<br/>
                            1) RM diharuskan membuat minimal 15 pipeline dalam 1 tahun<br/>
                            2) RM diharuskan memilih minimal 15 pipeline untuk pertama kali agar dapat disubmit<br/>
                            </span>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-submit-pipeline" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    <p>Anda akan mengirim pipeline yang telah dipilih. Lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Tidak</button>
                    <button id="btn_confirm_submit_pipeline" type="button" class="btn w150 btn-primary modal-button-ok">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-checkbox/js/dataTables.checkboxes.min.js"></script>
<script>
    var hide = 1;
//
// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}
$(document).ready(function() {
    $('.money').autoNumeric('init');
    
    var jumlah_submitted_pipeline = <?php echo count($pipeline2); ?>;
    $('.js-example-basic-single').select2();

    $('#btn_add_pipeline').click(function(){
        window.location.href= '<?php echo base_url()."pipeline/create"; ?>';
    });
    
    // Array holding selected row IDs
    var rows_selected = [];
    /*
    var table = $('#tbl_draft_pipeline').DataTable({
        
    });
    */
    
    var table = $('#tbl_draft_pipeline').DataTable({
        'bLengthChange': false,
        'dom': 'rt<"bottom"pi><"submit_div">',
        //'dom': '<"search"fl><"top">rt<"bottom"ip><"clear">',
        'language': {
            'search': '',
            'searchPlaceholder' : "Search"
        },
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox">';
            }
        }],
        'pageLength': 10,
        'ordering': false,
        'order': [[1, 'asc']],
        'rowCallback': function(row, data, dataIndex){
            // Get row ID
            var rowId = data[0];

            // If row ID is in the list of selected row IDs
            if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
            }
        },
        "drawCallback": function( settings ) {
            <?php
            foreach($pipeline as $row){
                if($row->isActive == 1):
            ?>
                    var id = $("#r<?= $row->PipelineId; ?>");
                    if(id.length > 0){
                        var element = document.querySelector("#r<?= $row->PipelineId; ?> td input");
                        if(element!=null)element.remove();
                    }
            <?php
                    endif;
                }
            ?>
        }
    });

    //$('div.dataTables_filter input').addClass('form-control');
    $('div.dataTables_filter input').removeClass('input-sm');
    $('div.dataTables_filter input').css('border-radius','25px');

    <?php if($this->session->ROLE_ID == USER_ROLE_RM_MENENGAH): ?>
    $("div.submit_div").html('<button id="btn_submit_pipeline" class="btn w150 btn-sm btn-primary pull-right" type="button" data-toggle="modal" data-target=".modal-submit-pipeline" disabled>Submit</button>');
    <?php endif; ?>

    // Handle click on checkbox
    $('#tbl_draft_pipeline tbody').on('click', 'input[type="checkbox"]', function(e){
        var $row = $(this).closest('tr');

        // Get row data
        var data = table.row($row).data();

        // Get row ID
        var rowId = data[0];

        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);

        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
            rows_selected.push(rowId);

        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
            rows_selected.splice(index, 1);
        }

        if(this.checked){
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);

        // Prevent click event from propagating to parent
        e.stopPropagation();

        if((rows_selected.length + jumlah_submitted_pipeline) >= <?= MIN_SUBMITED_PIPELINE; ?> && (rows_selected.length != 0)){
            $('#btn_submit_pipeline').prop("disabled", false); 
        }else{
            $('#btn_submit_pipeline').prop("disabled", true);
        }

        //console.log(rows_selected);
   });

    // Handle click on "Select all" control
    $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
        if(this.checked){
            $('#tbl_draft_pipeline tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#tbl_draft_pipeline tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

    // Handle table draw event
    table.on('draw', function(){
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });

    
    $('#btn_confirm_submit_pipeline').click(function(e){
        var form = $("#submitPipelineForm");
        $.each(rows_selected, function(index, rowId){
            $(form).append(
                $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'id[]')
                    .val(rowId)
            );
        });

        /*
        setTimeout(function(){ 
            $('#submitPipelineForm').submit();
        }, 500);
        */
        e.preventDefault();
        $.ajax({
            type: "post",
            url : $("#submitPipelineForm").attr("action"),
            data: $("#submitPipelineForm").serialize(),
            dataType : "json",
            beforeSend:function(){
                $(".modal-submit-pipeline").modal("hide");
                $(".loaderImage").show();
            },
            success: function(response){
                $(".loaderImage").hide();
                    if(response.status === "success"){
                    new PNotify({
                        title: "Success!",
                        text: response.message,
                        type: "success",
                        styling: "bootstrap3"
                    });
                    PNotify.prototype.options.delay = 1200;
                    setTimeout(function(){ 
                        window.location.href= "<?= base_url("pipeline/draft"); ?>";
                    }, 2000);                
                }else if(response.status === "error"){
                    new PNotify({
                        title: "Error!",
                        text: response.message,
                        type: "error",
                        styling: "bootstrap3"
                    });
                    PNotify.prototype.options.delay = 1200;
                    setTimeout(function(){ 
                        window.location.href= "<?= base_url("pipeline/draft"); ?>";
                    }, 2000);  
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                $(".loaderImage").hide();
                $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                $(".modal-error-notification").modal("show");
            }
        });
    });

    $('.collapse-link').click(function(){
        if(hide == 0){
            $('.search-form').html('Show Filter');
            hide = 1;
        }else{
            $('.search-form').html('Hide Filter');
            hide = 0;
        }
    });

    $('.btn_edit_pipeline').click(function(){
        var pipelineId = $(this).data('id');
        window.location.href = "<?= base_url(); ?>pipeline/edit/"+pipelineId;
    });
});

</script>