<style>
    .form-control{
        border-radius: 4px;
        border: 1px solid rgba(25, 25, 25, 0.32);
    }
    .x_content label{
        font-weight: 600;
        font-size: 16px;
        color: rgba(0, 0, 0, 0.87);
    }
    .error {
        font-weight: normal !important;
        color: #f00 !important;
    }
</style>
<div class="right_col" role="main">    
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">FTP</li>
                            <li class="breadcrumb-item"><a href="<?= base_url()."ftp/ftp_position"; ?>">FTP Position</a></li>
                            <li class="breadcrumb-item active"><?= $FTPGroupName; ?></li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left"><?= $FTPItemName; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0">
                        <div style="box-shadow: 0px 3px 5px rgba(149, 149, 149, 0.15);">
                            <form class="form-horizontal" id="formEditFTPPosition" method="POST" action="<?= site_url("ftp/ftp_position/process_edit_prime_lending_rate"); ?>" style="padding: 20px;">
                                <input type="hidden" id="FTPItemId" name="FTPItemId" value="<?= $FTPItemId; ?>" />
                                <div id="pinjamanContainer">
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Suku Bunga Dasar Kredit :</label>
                                                <input type="text" id="sbdk" name="sbdk" maxlength="100" class="form-control" value="<?php $sbdk = empty($FTPDetail) ? "" : $FTPDetail[0]->SBDK; echo $sbdk; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Kredit Korporasi (%) :</label>
                                                <input type="text" id="kreditKorporasi" name="kreditKorporasi" class="form-control percentage" data-a-dec="." data-a-sep="," value="<?php $kreditKorporasi = empty($FTPDetail) ? "" : $FTPDetail[0]->KreditKorporasi; echo $kreditKorporasi; ?>" required>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </form>
                        </div>
                        <div class="row form_action" style="padding: 30px 20px 0 20px;">
                            <div class="pull-right">
                                <button id="btnCancel" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                <button id="btnSave" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right: 0;">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edit-pinjaman" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>You want to make data changes, are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">No</button>
                    <button id="btn-save-confirmation" type="button" class="btn w150 btn-primary modal-button-ok">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
    $(document).ready(function() {
        $(".percentage").autoNumeric("init",{
            vMax: "999"
        });

        $(".percentage").click(function() {
            this.select();
        });

        $("#btnSave").click(function(){
            if($("#formEditFTPPosition").valid()){
                $(".modal-edit-pinjaman").modal("show");
            }
        });

        $("#btnCancel").click(function(){
            window.location.href = "<?= base_url("ftp/ftp_position"); ?>";
        });

        $("#btn-save-confirmation").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url : $("#formEditFTPPosition").attr("action"),
                data: $("#formEditFTPPosition").serialize(),
                dataType : "json",
                beforeSend:function(){
                    $(".modal-edit-pinjaman").modal("hide");
                    $(".loaderImage").show();
                },
                success: function(response){
                    $(".loaderImage").hide();
                        if(response.status === "success"){
                        new PNotify({
                            title: "Success!",
                            text: "Data has been saved.",
                            type: "success",
                            styling: "bootstrap3"
                        });
                        PNotify.prototype.options.delay = 1200;
                        setTimeout(function(){ 
                            window.location.href= "<?= base_url("ftp/ftp_position"); ?>";
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
        });
    });
</script>