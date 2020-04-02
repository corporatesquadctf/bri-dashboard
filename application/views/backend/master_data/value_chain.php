<style>
    .form-control{
        color: #73879C;
    }
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    thead{
        background-color:#337ab7;
        color: #FFF;
    }
    .btn-choose{
        background: #F58C38;
        border: 1px solid #E68233;
        box-sizing: border-box;
        border-radius: 4px;
        color: #FFF;
    }
    .btn-choose:hover{
        color: #F58C38;
        background-color: #e6e6e6;
        border: 1px solid #F58C38;
    }
    .btn-choose:active{
        border: 1px solid #F58C38;
        color: #F58C38;
    }
    .btn-choose:active:hover{
        border: 1px solid #F58C38;
        color: #F58C38;
    }
    .btn-choose:focus{
        color: #F58C38;
    }
    .btn-choose:focus:hover{
        color: #F58C38;
    }
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 14px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .btn-upload:focus, .btn-upload:active{
        color: #FFF;
    }    
    .progress {
        border-radius: 4px;
        height: 5px;
    }
    .progress-bar {
        background: #F58C38;
    }
</style>

<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Value Chain</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Value Chain Data Management</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php if($this->session->ROLE_ID == USER_ROLE_SUPER_USER_MENENGAH || $this->session->ROLE_ID == USER_ROLE_ADMIN_WILAYAH): ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <button id="btnAddValueChain" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Upload Value Chain</button>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="tableValueChain"data-click-to-select="true" 
                                    data-toggle="table" 
                                    data-toolbar="#toolbar"
                                    data-page-list="[10,25,100, 1000]"
                                    data-pagination="true" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="cntrl no" data-sortable="true">No.</th>
                                            <th class="cntrl fname" data-sortable="true">Filename</th>
                                            <th class="cntrl uker" data-sortable="true">Unit Kerja</th>
                                            <th class="cntrl act" data-sortable="true">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 1;
                                        foreach($ValueChain as $row):
                                    ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row->Filename; ?></td>
                                                <td><?= $row->UnitKerjaName; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url("uploads/value_chain/".$row->UnitKerjaId."/".$row->Filename); ?>" target="_blank">
                                                        <img src="<?= base_url("assets/images/icons/excel.svg"); ?>" style="width: 20px;" title="Download Value Chain Document" />
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        endforeach;
                                    ?>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-add-value-chain" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Upload Value Chain</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-xs-12">
                            <p>Unit Kerja:</p>
                            <select class="form-control js-example-basic-single" id="unitKerjaId" name="unitKerjaId" style="width:100%;" <?= $disabled; ?>>
                                <?php
                                foreach ($UnitKerjaOption as $row){
                                    $selected = "";
                                    if($row->UnitKerjaId == $ukerId) $selected = "selected";
                                    echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->UnitKerjaName.'</option>';
                                }
                                ?>                                       
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-xs-9">
                            <div class="input-group" style="margin-bottom:0;">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file btn-choose" id="btnFile">
                                        Choose File <input type="file" id="fileUpload" name="fileUpload">
                                    </span>
                                </span>
                                <input type="text" class="form-control" style="background: #FFF;" readonly>
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin-bottom:5px;">
                            <button type="button" class="btn btn-choose btn-upload" id="btnUpload" name="btnUpload" style="margin-bottom:0; width: 100%;" onclick="doUpload(event);" disabled>Upload</button>
                        </div>
                        <div class="col-xs-12" id="progressbarContainer" style="display:none;">
                            <div class="progress">
                                <div id="progressbar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>
                            </div>
                        </div>  
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-xs-12">
                            <table class="table-file-upload" style="width: 100%;">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $(".js-example-basic-single").select2();

        $("#btnAddValueChain").click(function(e){
            $(".modal-add-value-chain").modal("show");
        });

        $("#btnFile :file").on("change", function () {
            var input = $(this);
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');            
            input.trigger("fileselect", [label]);
            $("#progressbar").css("width","0%");
        });

        $("#btnFile :file").on("fileselect", function (event, label) {
            var input = $(this).parents(".input-group").find(":text");
            
            if ($("#fileUpload").get(0).files.length === 0){
                alert("Please choose file");
                input.val("");
                $("#btnUpload").prop("disabled", true);
            }else{
                var filetype = $("#fileUpload").get(0).files[0].type;
                if($.inArray(filetype, ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"]) >= 0){
                    var filesize = $("#fileUpload").get(0).files[0].size;
                    if(filesize > 5242880){
                        alert("File must be less than 5MB");
                        input.val("");
                        $("#btnUpload").prop("disabled", true);
                    }else{
                        var log = label;
                        if (input.length) {
                            input.val(log);
                            $("#btnUpload").prop("disabled", false);
                        }
                    }
                }else{
                    alert("Must be Excel File");
                    input.val("");
                    $("#btnUpload").prop("disabled", true);
                }
            }        
        });

        $("#btnSaveFileUpload").on("click", function(){
            $(".modal-file-upload").modal("hide");
        });

        setTimeout(function(){ 
            setWidth();
        }, 0);
        
    });

    function setWidth(){
        $(".no").css("width","5%");
        $(".fname").css("width","50%");
        $(".uker").css("width","35%");
        $(".act").css("width","10%");
    }

    function doUpload(e){
        e.preventDefault();
        var file_data = $("#fileUpload").prop("files")[0];
        var unitKerjaId = $("#unitKerjaId").val();
        var form_data = new FormData();
            form_data.append("fileUpload", file_data);
            form_data.append("unitKerjaId", unitKerjaId);
            $("#progressbarContainer").show();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $("#progressbar").css("width",percentComplete+"%");
                        }
                    }, false);
                    return xhr;
                },
                url: "<?php echo base_url()."admin/value_chain/processUploadFile"; ?>",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: "post",
                success	: function (data)
                {
                    if(data.status != "error"){
                        new PNotify({
                            title: "Success!",
                            text: "File successfully uploaded.",
                            type: "success",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                        setTimeout(function(){ 
                            window.location.href= "<?= base_url("admin/value_chain"); ?>";
                        }, 2000);
                    }else{
                        new PNotify({
                            title: "Error!",
                            text: data.message,
                            type: "error",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                    }
                },
                error: function (jqXHR) {
                    $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Message:  "+jqXHR.statusText);
                    $(".modal-error-notification").modal("show");
                }
            });
    }
</script>