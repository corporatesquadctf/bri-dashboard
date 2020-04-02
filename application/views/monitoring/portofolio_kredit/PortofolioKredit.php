<style type="text/css">
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
    .update_link{
        vertical-align:middle; 
        text-decoration: underline; 
        color:#337ab7;
    }
    thead{
        background-color:#218FD8;
    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #218FD8;
        border-color: #337ab7;
    }
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    .search-form{
        margin-bottom: 0px;
        font-weight: normal;
    }
    table { 
        border-collapse: separate; 
        border-spacing: 0 10px; 
        margin-top: -10px;
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
    thead{
        color:#218FD8;
    }
    thead tr{
        background-color:#F7F7F7;
        box-shadow: none;
    }
    .div-action{
        display: inline-flex;
        margin: auto;
        color: #218FD8;
    }
    .div-action i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-action label{
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }
    .div-action:hover i, .div-action:hover label{
        cursor: pointer;
        font-weight: bold;
    }
</style>
<div class="right_col" role="main">    
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Monitoring</li>
                            <li class="breadcrumb-item active" aria-current="page">Portofolio Kredit</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Portofolio Kredit</div>
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
                            <li>
                                <a class="collapse-link btn w150 btn-sm btn-default" style="margin-bottom:0px;"><label class="search-form">Hide Filter</label></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="searchForm" method="POST" class="form-horizontal form-label-left">
                        <?php if($user['ROLE_ID'] != 12 && $user['ROLE_ID'] != 13 && $user['ROLE_ID'] != 14 && $user['ROLE_ID'] != 17 && $user['ROLE_ID'] != 18):?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ukerId">Unit Kerja</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="ukerId" name="ukerId" style="width:100%;">
                                    <?php
                                    if($user['ROLE_ID'] == 16)
                                        echo '<option value="0" >Semua Unit Kerja</option>';
                                        foreach ($rsUker as $row){
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
                                    <option value="0">Semua RM</option>
                                    <?php
                                    foreach ($rsRM as $row){
                                        $selected = '';
                                        if($rm_id == $row->UserId) $selected = 'selected="selected"';
                                        echo '<option value="'.$row->UserId.'" '.$selected.'>'.$row->Name.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($user['ROLE_ID'] == 14 || $user['ROLE_ID'] == 16){ ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usulanPlafond">Usulan Plafond</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="usulanPlafond" name="usulanPlafond" style="width:100%;">
                                    <option value="0">Semua Usulan Plafond</option>
                                    <?php
                                    foreach ($rsUsulanPlafond as $row){
                                        $selected = '';
                                        if($usulanPlafond == $row->id) $selected = 'selected="selected"';
                                        echo '<option value="'.$row->id.'" '.$selected.'>'.$row->name.'</option>';
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
                        <form id="PortofolioKreditForm" action="<?= base_url().'monitoring/portofolio_kredit/multiple_comment'; ?>" method="POST">
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="tblPortofolioKredit" class="table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;"><input name="select_all" value="1" type="checkbox"></th>
                                            <th style="width:3%;">No.</th>
                                            <th style="width:20%;">Nama Debitur</th>
                                            <th style="width:12%;">Nama RM</th>
                                            <th style="width:15%;">Alamat</th>
                                            <th style="width:15%;">Sub Sektor Ekonomi</th>
                                            <th style="width:10%;">Plafon Awal</th>
                                            <th style="width:5%;">Status Aplikasi</th>
                                            <th style="width:5%;">TAT</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach($PortofolioKredit as $row){
                                                $startDate = date("Y-m-d", strtotime($row->CreatedDate));
                                                $startDateTime = strtotime($startDate);
                                                $endDate = $row->TanggalPutusan;
                                                if($row->StatusPutusan == 0){
                                                    $label_status = "style='color:#FFA500; font-weight: bold;'";
                                                    $endDate = date("Y-m-d");
                                                }else if($row->StatusPutusan == 1){
                                                    $label_status = "style='color:#198c19; font-weight: bold;'";
                                                    $endDate = date("Y-m-d", strtotime($row->TanggalPutusan));
                                                }else{
                                                    $label_status = "style='color:#cc0000; font-weight: bold;'";
                                                    $endDate = date("Y-m-d", strtotime($row->TanggalPutusan));
                                                }
                                                $endDateTime = strtotime($endDate);
                                                $difference = $endDateTime - $startDateTime;
                                                $TAT = floor($difference / (60*60*24) );                
                                                if($TAT < 0) $TAT = 0;

                                                if($row->StatusApplicationId == 14){
                                                    $row->StatusApplicationName = 'Komite';
                                                }
                                        ?>
                                                <tr>
                                                    <td><?= $row->PortofolioKreditId; ?></td>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $row->CustomerName; ?></td>
                                                    <td><?= $row->RMName; ?></td>
                                                    <td><?= $row->Address; ?></td>
                                                    <td><?= $row->SubsectorEconomyName; ?></td>
                                                    <td><label style="font-weight:normal;" class="money" data-a-sep="," data-a-dec="."><?= $row->Plafond; ?></label></td>
                                                    <td><?= $row->StatusApplicationName; ?></td>
                                                    <td><label <?= $label_status; ?>><?= $TAT.' Hari'; ?></label></td>
                                                    <td>
                                                        <div class="div-action btnViewPortofolioKredit pull-left" data-id="<?= $row->PortofolioKreditId; ?>">
                                                            <i class="material-icons">center_focus_strong</i>
                                                            <label>View</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal fade modal-comment-portofolio-kredit" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Komentar</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row form-group">
                                        <div class="col-xs-12">
                                            <p>Tuliskan pesan yang ingin anda berikan:</p>
                                            <textarea maxlength="100" id="comment" name="comment" class="form-control" rows="3" placeholder="Max 100 Character"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Batal</button>
                                    <button id="btn_confirm_comment_portofolio_kredit" type="button" class="btn w150 btn-primary modal-button-ok">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-checkbox/js/dataTables.checkboxes.min.js"></script>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script>
    var base_url = "<?= base_url(); ?>";
    var user_role = <?= $user['ROLE_ID']; ?>;
    var hide = 0;
    var rows_selected = [];
        
    function updateDataTableSelectAllCtrl(table){
        var $table             = table.table().node();
        var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

        if($chkbox_checked.length === 0){
            chkbox_select_all.checked = false;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }
        } else if ($chkbox_checked.length === $chkbox_all.length){
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }
        } else {
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = true;
            }
        }
    }

    function updateRMOption(uker_id){
        jQuery(".loaderImage").show();  
        var dropdownRM = $('#rm_id');
        dropdownRM.empty();
        dropdownRM.append($('<option>',
        {
            value: 0,
            text: 'Semua RM'
        },'</option>'));
        $.getJSON(base_url+'pipeline/serviceGetRM/'+uker_id, function (data){
            if(data.length > 0){
                $.each(data, function(index, item){
                    dropdownRM.append($('<option>',
                    {
                        value: item.id,
                        text: item.name
                    },'</option>'));
                })
            }
            jQuery(".loaderImage").hide();
        })    
    }

    $(document).ready(function() {
        $('.money').autoNumeric('init');
        $('.js-example-basic-single').select2();

        if(user_role == 16){           
            var visible = true;
            var display = "";
        }else {
            var visible = false;
            var display = "no_display";
        }

        var table = $('#tblPortofolioKredit').DataTable({
            'bLengthChange': false,
            'dom': 'rt<"bottom"pi><"comment_div">',
            'pageLength': 10,
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'width': '1%',
                'className': 'dt-body-center',
                'visible' : visible,
                'render': function (data, type, full, meta){
                    return '<input type="checkbox">';
                }
            }],
            'pageLength': 10,
            'ordering': false,
            'order': [[1, 'asc']],
            'rowCallback': function(row, data, dataIndex){
                var rowId = data[0];
                
                if($.inArray(rowId, rows_selected) !== -1){
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        $("div.comment_div").html('<button id="btn_comment_proses_kredidt" class="btn w150 btn-sm btn-primary pull-right '+display+'" style="margin-right:0px;" type="button" data-toggle="modal" data-target=".modal-comment-portofolio-kredit" disabled>Komentar</button>');

        $('#tblPortofolioKredit tbody').on('click', 'input[type="checkbox"]', function(e){
            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var rowId = data[0];
            var index = $.inArray(rowId, rows_selected);

            if(this.checked && index === -1){
                rows_selected.push(rowId);

            } else if (!this.checked && index !== -1){
                rows_selected.splice(index, 1);
            }

            if(this.checked){
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            updateDataTableSelectAllCtrl(table);
            e.stopPropagation();

            if(rows_selected.length != 0){
                $('#btn_comment_proses_kredidt').prop("disabled", false); 
            }else{
                $('#btn_comment_proses_kredidt').prop("disabled", true);
            }

        });

        $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
            if(this.checked){
                $('#tblPortofolioKredit tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#tblPortofolioKredit tbody input[type="checkbox"]:checked').trigger('click');
            }
            e.stopPropagation();
        });

        table.on('draw', function(){
            updateDataTableSelectAllCtrl(table);
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

        $('.btnViewPortofolioKredit').click(function(){
            var portofolioKreditId = $(this).data('id');
            window.location.href = "<?= base_url(); ?>monitoring/portofolio_kredit/detail/"+portofolioKreditId;
        });

        $('#btn_confirm_comment_portofolio_kredit').click(function(){
            var form = $("#PortofolioKreditForm");
            var comment = $(".modal-comment-portofolio-kredit #comment").val();
            $.each(rows_selected, function(index, rowId){
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });
            
            $(form).append('<input type="hidden" name="comment" value="'+comment+'" /> ');

            $.ajax({
                type: "post",
                url : $("#PortofolioKreditForm").attr("action"),
                data: $("#PortofolioKreditForm").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-comment-portofolio-kredit").modal("hide");
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
                            location.reload();
                        }, 2000);                
                    }else if(response.status === "error"){
                        new PNotify({
                            title: "Error!",
                            text: response.message,
                            type: "error",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $(".loaderImage").hide();
                    $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                    $(".modal-error-notification").modal("show");
                }
            });
            /*
            setTimeout(function(){ 
                $('#PortofolioKreditForm').submit();
            }, 500);
            */
        });

        $('#ukerId').change(function(){
            var uker_id =  this.value;
            updateRMOption(uker_id);
        });
        
    });
</script>