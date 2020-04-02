<style>
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
<div class="modal fade modal-file-upload" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-xs-12">
                        <input type="hidden" id="macroEconomyAnalysisId" name="macroEconomyAnalysisId" value="" />
                        <label style="font-weight: 600; font-size: 14px; color: #000000;">Upload File ke :</label>
                        <label id="rootPath" style="font-weight: normal; font-size: 14px; color: #000000;"></label>
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
            <div class="modal-footer form_action" style="padding: 15px;">
                <button type="button" class="btn w150 btn-default btn_cancel" data-dismiss="modal">Back</button>
                <button id="btnSaveFileUpload" type="button" class="btn w150 btn_save btn-primary modal-button-ok">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
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
                var filesize = $("#fileUpload").get(0).files[0].size;
                var filetype = $("#fileUpload").get(0).files[0].type;
                if($.inArray(filetype, ["image/gif", "image/jpeg", "image/png"]) >= 0 && filesize > 5242880){
                    alert("Image file must be less than 5MB");
                    input.val("");
                    $("#btnUpload").prop("disabled", true);
                }else{
                    var log = label;
                    if (input.length) {
                        input.val(log);
                        $("#btnUpload").prop("disabled", false);
                    }
                }
            }        
        });

        $("#btnSaveFileUpload").on("click", function(){
            $(".modal-file-upload").modal("hide");
        });
        
    });

    function doUpload(e){
        e.preventDefault();
        var id = $(".modal-file-upload #macroEconomyAnalysisId").val();
        var file_data = $("#fileUpload").prop("files")[0];
        var form_data = new FormData();
            form_data.append("macroEconomyAnalysisId", id);
            form_data.append("fileUpload", file_data);
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
                url: "<?php echo base_url()."macro_economy/economy_research/processUploadFile"; ?>",
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
                        $("#progressbarContainer").hide();
                        $("#fileUpload").val("");
                        $("#btnUpload").prop("disabled", true);
                        $("#btnFile").parents(".input-group").find(":text").val("");
                        loadFileUpload(id);
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