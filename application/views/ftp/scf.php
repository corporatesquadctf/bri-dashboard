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
                            <form class="form-horizontal" id="formEditFTPPosition" method="POST" action="<?= site_url("ftp/ftp_position/process_edit_scf"); ?>" style="padding: 20px;">
                                <input type="hidden" id="FTPItemId" name="FTPItemId" value="<?= $FTPItemId; ?>" />
                                <input type="hidden" id="arrSCF" name="arrSCF" value="" />                            
                                <div id="SCFContainer">
                                    <?php if(empty($FTPDetail)){ ?>
                                        <div class="row scf_0" style="margin-bottom: 10px;">
                                            <input type="hidden" id="FTPItemTransitInterestId_0" name="FTPItemTransitInterestId_0" value="0" />
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Batas Bawah Tenor (Hari) :</label>
                                                    <input type="text" id="bottomMargin_0" name="bottomMargin_0" class="form-control periode" data-a-dec="." data-a-sep="," value="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <div class="form-group" style="text-align: center;">
                                                    <label style="margin-top: 30px;">S/D</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Batas Atas Tenor (Hari) :</label>
                                                    <input type="text" id="topMargin_0" name="topMargin_0" class="form-control top-margin periode" data-a-dec="." data-a-sep="," value="" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="form-group">
                                                    <label>Suku Bunga Counter (P.A %) :</label>
                                                    <input type="text" id="interestRate_0" name="interestRate_0" class="form-control percentage" data-a-dec="." data-a-sep="," value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }else{
                                        $i=0;
                                        foreach ($FTPDetail as $row):
                                            $btmMarginRequired = "required";
                                            if($i == 0) $btmMarginRequired = "";

                                            $btmMarginReadonly = "readonly";

                                            $topMarginRequired = "required";
                                            $topMarginReadonly = "";
                                            if($i == count($FTPDetail)-1){
                                                $topMarginRequired = ""; $topMarginReadonly = "readonly";
                                            }

                                    ?>
                                            <div class="row scf_<?= $i; ?>" style="margin-bottom: 10px;">
                                                <input type="hidden" id="FTPItemTransitInterestId_<?= $i; ?>" name="FTPItemTransitInterestId_<?= $i; ?>" value="<?= $row->FTPItemTransitInterestId; ?>" />
                                                <?php if($i != 0): ?>
                                                    <div class="col-xs-12">
                                                        <div class="pull-left" onclick="removeSCFField(<?= $i; ?>)">
                                                            <div class="div-action">
                                                                <i class="material-icons no-after no-before">delete_sweep</i>
                                                                <label class="label-action">Delete SCF</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label>Batas Bawah Jangka Waktu :</label>
                                                        <input type="text" id="bottomMargin_<?= $i; ?>" name="bottomMargin_<?= $i; ?>" class="form-control periode" data-a-dec="." data-a-sep="," value="<?= $row->BottomMarginTerm; ?>" <?= $btmMarginReadonly; ?> <?= $btmMarginRequired; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-xs-1">
                                                    <div class="form-group" style="text-align: center;">
                                                        <label style="margin-top: 30px;">S/D</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label>Batas Atas Jangka Waktu :</label>
                                                        <input type="text" id="topMargin_<?= $i; ?>" name="topMargin_<?= $i; ?>" class="form-control top-margin periode" data-a-dec="." data-a-sep="," value="<?= $row->TopMarginTerm; ?>" <?= $topMarginReadonly; ?> <?= $topMarginRequired; ?> >
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>Suku Bunga Counter (P.A %) :</label>
                                                        <input type="text" maxlength="100" id="interestRate_<?= $i; ?>" name="interestRate_<?= $i; ?>" class="form-control" value="<?= $row->InterestRate; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php 
                                        $i++;
                                        endforeach;
                                        }
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="row form_action" style="padding: 30px 20px 0 20px;">
                            <div class="pull-right">
                                <button id="btnCancelSCF" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                <button id="btnAddSCF" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="addSCFField();">ADD SCF</button>
                                <button id="btnSaveSCF" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right: 0;">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edit-scf" tabindex="-1" role="dialog" aria-hidden="true">
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
    var jumlahSCF = <?= count($FTPDetail); ?>;
    if(jumlahSCF == 0){
        var arrSCF = [0];
    }else{
        var arrSCF = [];
        for(var i=0; i<jumlahSCF; i++){
            arrSCF.push(Number(i));
        }
    }
    $("#arrSCF").val(arrSCF);

    $(document).ready(function() {
        $(".periode").autoNumeric("init",{
            vMax: "999",
            mDec: "0"
        });

        $(".percentage").autoNumeric("init",{
            vMax: "999"
        });

        $(".periode, .percentage").click(function() {
            this.select();
        });

        $(".top-margin").change(function(e){
            var id = (this.id).split("_")[1];
            var topMargin = Number($("#topMargin_"+id).autoNumeric("get"));
            var bottomMargin = topMargin + 1;
            
            var index = arrSCF.indexOf(Number(id)) + 1;
            $("#bottomMargin_"+arrSCF[index]).autoNumeric("set", bottomMargin);
        });

        $.validator.addMethod("checkHigherValue", function(value, element) {
            var arrIndex = (element.id).split("_");
            var id = arrIndex[1];
            var bottomMargin = $("#bottomMargin_"+id).autoNumeric("get");
            var topMargin = $("#topMargin_"+id).autoNumeric("get");
            if(bottomMargin == "") {
                bottomMargin = 0;
            }else {
                bottomMargin = Number(bottomMargin);
            }
            if(topMargin == ""){
                topMargin = 0;
            }else{
                topMargin = Number(topMargin);
            }
            if($("#topMargin_"+id).prop("readonly")){ 
                return true;
            }else{
                if(topMargin <= bottomMargin){
                    return false;
                }else
                    return true;
            }
            
        }, "Must higher than bottom margin");

        $("#formEditFTPPosition").validate({
            rules: (function() {
                results = {};
                for(var i=0; i<10; i++) {
                    results["topMargin_"+i] = { 
                        checkHigherValue: true
                    }
                };
                return results;
            })()
        });

        $("#btnSaveSCF").click(function(){
            if($("#formEditFTPPosition").valid()){
                $(".modal-edit-scf").modal("show");
            }
        });

        $("#btnCancelSCF").click(function(){
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
                    $(".modal-edit-scf").modal("hide");
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

    function addSCFField(){
        if(arrSCF.length == 0)
            var scf = 0
        else {
            for(var i=0; i<arrSCF.length; i++){
                $("#topMargin_"+arrSCF[i]).prop("readonly", false);
                $("#topMargin_"+arrSCF[i]).prop("required", true);
            }            
            var scf = arrSCF[arrSCF.length-1] +1;
        }
        
        var inner = "";
        var objTo = document.getElementById("SCFContainer")
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row scf_"+scf);
        divtest.setAttribute("style", "margin-bottom: 10px");
        inner +=    "<input type='hidden' id='FTPItemTransitInterestId_"+scf+"' name='FTPItemTransitInterestId_"+scf+"' value='0' />";
        inner +=    "<div class='col-xs-12'>";
        inner +=    "   <div class='pull-left' onclick='removeSCFField("+scf+")'>";
        inner +=    "       <div class='div-action'>";
        inner +=    "           <i class='material-icons no-after no-before'>delete_sweep</i>";
        inner +=    "           <label class='label-action'>Delete SCF</label>";
        inner +=    "       </div>";
        inner +=    "   </div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Batas Bawah Tenor (Hari) :</label>";
        inner +=    "       <input type='text' id='bottomMargin_"+scf+"' name='bottomMargin_"+scf+"' class='form-control periode' data-a-dec='.' data-a-sep=',' value='' readonly required>";
        inner +=	"	</div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-1'>";
        inner +=    "   <div class='form-group' style='text-align: center;'>";
        inner +=    "      <label style='margin-top: 30px;'>S/D</label>";
        inner +=    "   </div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Batas Atas Tenor (Hari) :</label>";
        inner +=    "       <input type='text' id='topMargin_"+scf+"' name='topMargin_"+scf+"' class='form-control top-margin periode' data-a-dec='.' data-a-sep=',' value='' readonly>";
        inner +=	"	</div>";
        inner +=	"</div>";
        inner +=    "<div class='col-xs-3'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Suku Bunga Counter (P.A %) :</label>";
        inner +=    "       <input type='text' maxlength='100' id='interestRate_"+scf+"' name='interestRate_"+scf+"' class='form-control' value='' required>";
        inner +=	"	</div>";
        inner +=	"</div>";
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);

        $(".periode").autoNumeric("init",{
            vMax: "999",
            mDec: "0"
        });

        $(".percentage").autoNumeric("init",{
            vMax: "999"
        });

        $(".periode, .percentage").click(function() {
            this.select();
        });

        $(".top-margin").change(function(e){
            var id = (this.id).split("_")[1];
            var topMargin = Number($("#topMargin_"+id).autoNumeric("get"));
            var bottomMargin = topMargin + 1;

            var index = arrSCF.indexOf(Number(id)) + 1;
            $("#bottomMargin_"+arrSCF[index]).autoNumeric("set", bottomMargin);
        });

        if(arrSCF.length == 1){
            var topMargin = Number($("#topMargin_"+arrSCF[arrSCF.length-1]).autoNumeric("get"));
            var bottomMargin = topMargin + 1;
            $("#bottomMargin_"+scf).autoNumeric("set", bottomMargin);
        }

        arrSCF.push(Number(scf));
        $("#arrSCF").val(arrSCF);        
    }

    function removeSCFField(scf){
        var index = arrSCF.indexOf(scf);
        var idx = arrSCF[index - 1];
        var idxx = arrSCF[index + 1];
        
        if(arrSCF[arrSCF.length-1] == scf){
            $("#topMargin_"+idx).prop("readonly", false);
            $("#topMargin_"+idx).prop("required", true);
        }

        var topMargin = Number($("#topMargin_"+idx).autoNumeric("get"));
        var bottomMargin = topMargin + 1;
        $("#bottomMargin_"+idxx).autoNumeric("set", bottomMargin);
        
        $(".scf_"+scf).remove();
        if (index > -1) {
            arrSCF.splice(index, 1);
        }
        $("#arrSCF").val(arrSCF);
        
    }
</script>