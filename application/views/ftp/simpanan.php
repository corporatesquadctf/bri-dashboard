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
                            <form class="form-horizontal" id="formEditFTPPosition" method="POST" action="<?= site_url("ftp/ftp_position/process_edit_simpanan"); ?>" style="padding: 20px;">
                                <input type="hidden" id="FTPItemId" name="FTPItemId" value="<?= $FTPItemId; ?>" />
                                <input type="hidden" id="arrSimpanan" name="arrSimpanan" value="" />                            
                                <div id="simpananContainer">
                                    <?php if(empty($FTPDetail)){ ?>
                                        <div class="row simpanan_0" style="margin-bottom: 10px;">
                                            <input type="hidden" id="FTPItemSimpananId_0" name="FTPItemSimpananId_0" value="0" />
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Batas Bawah Saldo :</label>
                                                    <input type="text" id="bottomMargin_0" name="bottomMargin_0" class="form-control money" data-a-dec="." data-a-sep="," value="" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <div class="form-group" style="text-align: center;">
                                                    <label style="margin-top: 30px;">S/D</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Batas Atas Saldo :</label>
                                                    <input type="text" id="topMargin_0" name="topMargin_0" class="form-control top-margin money" data-a-dec="." data-a-sep="," value="" readonly>
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
                                        foreach ($FTPDetail as $row) :
                                            $readonly = "";
                                            if($i == count($FTPDetail) -1) $readonly = "readonly";

                                            $btmMarginReadonly = "readonly";
                                            if($i == 0) $btmMarginReadonly = "";
                                    ?>
                                            <div class="row simpanan_<?= $i; ?>" style="margin-bottom: 10px;">
                                                <input type="hidden" id="FTPItemSimpananId_<?= $i; ?>" name="FTPItemSimpananId_<?= $i; ?>" value="<?= $row->FTPItemSimpananId; ?>" />
                                                <?php if($i != 0): ?>
                                                    <div class="col-xs-12">
                                                        <div class="pull-left" onclick="removeSimpanan(<?= $i; ?>)">
                                                            <div class="div-action">
                                                                <i class="material-icons no-after no-before">delete_sweep</i>
                                                                <label class="label-action">Delete Simpanan</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label>Batas Bawah Saldo :</label>
                                                        <input type="text" id="bottomMargin_<?= $i; ?>" name="bottomMargin_<?= $i; ?>" class="form-control money" data-a-dec="." data-a-sep="," value="<?= $row->BottomMargin; ?>" <?= $btmMarginReadonly; ?> required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-1">
                                                    <div class="form-group" style="text-align: center;">
                                                        <label style="margin-top: 30px;">S/D</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label>Batas Atas Saldo :</label>
                                                        <input type="text" id="topMargin_<?= $i; ?>" name="topMargin_<?= $i; ?>" class="form-control top-margin money" data-a-dec="." data-a-sep="," value="<?= $row->TopMargin; ?>" <?= $readonly; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>Suku Bunga Counter (P.A %) :</label>
                                                        <input type="text" id="interestRate_<?= $i; ?>" name="interestRate_<?= $i; ?>" class="form-control percentage" data-a-dec="." data-a-sep="," value="<?= $row->InterestRate; ?>" required>
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
                                <button id="btnCancelSimpanan" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                <button id="btnAddSimpanan" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="addSimpananField();">ADD SIMPANAN</button>
                                <button id="btnSaveSimpanan" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right: 0;">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edit-simpanan" tabindex="-1" role="dialog" aria-hidden="true">
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
<script src="<?= base_url();?>assets/bigInt/bignumber.js"></script>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>
<script>
    var jumlahSimpanan = <?= count($FTPDetail); ?>;
    if(jumlahSimpanan == 0){
        var arrSimpanan = [0];
    }else{
        var arrSimpanan = [];
        for(var i=0; i<jumlahSimpanan; i++){
            arrSimpanan.push(Number(i));
        }
    }
    $("#arrSimpanan").val(arrSimpanan);

    $(document).ready(function() {
        $(".money").autoNumeric("init",{
            vMax: "999999999999999",
            mDec: "0"
        });

        $(".percentage").autoNumeric("init",{
            vMax: "999"
        });

        $(".money, .percentage").click(function() {
            this.select();
        });

        $(".top-margin").change(function(e){
            var id = (this.id).split("_")[1];
            var topMargin = new BigNumber($("#topMargin_"+id).autoNumeric("get"));
            var bottomMargin = topMargin.add(1);
            //console.log(bottomMargin);

            var index = arrSimpanan.indexOf(Number(id)) + 1;
            //console.log(index);
            //console.log(arrSimpanan);
            $("#bottomMargin_"+arrSimpanan[index]).autoNumeric("set", bottomMargin);
        });

        $.validator.addMethod("lowerValue", function(value, element) {
            if(arrSimpanan.length > 1){
                var bottomMargin = $("#bottomMargin_0").autoNumeric("get");
                var topMargin = $("#topMargin_0").autoNumeric("get");
                if(bottomMargin == "") {
                    bottomMargin = 0;
                }else {
                    bottomMargin = Number(bottomMargin);
                }
                if(topMargin == ""){
                    topMargin = 0;
                }else{
                    topMargin = new Number(topMargin);
                }
                if(bottomMargin >= topMargin){
                    return false;
                }else return true;
            }else return true;    
        }, "Must lower than top margin");

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
                results["bottomMargin_0"] = {
                    lowerValue: true
                };
                return results;
            })()
        });

        $("#btnSaveSimpanan").click(function(){
            //console.log(arrSimpanan);
            
            if($("#formEditFTPPosition").valid()){
                $(".modal-edit-simpanan").modal("show");
            }
        });

        $("#btnCancelSimpanan").click(function(){
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
                    $(".modal-edit-simpanan").modal("hide");
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

    function addSimpananField(){
        if(arrSimpanan.length == 0)
            var simpanan = 0
        else {
            for(var i=0; i<arrSimpanan.length; i++){
                $("#topMargin_"+arrSimpanan[i]).prop("readonly", false);
                $("#topMargin_"+arrSimpanan[i]).prop("required", true);
            }            
            var simpanan = arrSimpanan[arrSimpanan.length-1] +1;
        }
        
        var inner = "";
        var objTo = document.getElementById("simpananContainer")
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row simpanan_"+simpanan);
        divtest.setAttribute("style", "margin-bottom: 10px");
        inner +=    "<input type='hidden' id='FTPItemSimpananId_"+simpanan+"' name='FTPItemSimpananId_"+simpanan+"' value='0' />";
        inner +=    "<div class='col-xs-12'>";
        inner +=    "   <div class='pull-left' onclick='removeSimpanan("+simpanan+")'>";
        inner +=    "       <div class='div-action'>";
        inner +=    "           <i class='material-icons no-after no-before'>delete_sweep</i>";
        inner +=    "           <label class='label-action'>Delete Simpanan</label>";
        inner +=    "       </div>";
        inner +=    "   </div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Batas Bawah Saldo :</label>";
        inner +=    "       <input type='text' id='bottomMargin_"+simpanan+"' name='bottomMargin_"+simpanan+"' class='form-control money' data-a-dec='.' data-a-sep=',' value='' readonly required>";
        inner +=	"	</div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-1'>";
        inner +=    "   <div class='form-group' style='text-align: center;'>";
        inner +=    "      <label style='margin-top: 30px;'>S/D</label>";
        inner +=    "   </div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Batas Atas Saldo :</label>";
        inner +=    "       <input type='text' id='topMargin_"+simpanan+"' name='topMargin_"+simpanan+"' class='form-control top-margin money' data-a-dec='.' data-a-sep=',' value='' readonly>";
        inner +=	"	</div>";
        inner +=	"</div>";
        inner +=    "<div class='col-xs-3'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Suku Bunga Counter (P.A %) :</label>";
        inner +=    "       <input type='text' id='interestRate_"+simpanan+"' name='interestRate_"+simpanan+"' class='form-control percentage' data-a-dec='.' data-a-sep=',' value='' required>";
        inner +=	"	</div>";
        inner +=	"</div>";
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);

        $(".money").autoNumeric("init",{
            vMax: "999999999999999",
            mDec: "0"
        });

        $(".percentage").autoNumeric("init",{
            vMax: "999"
        });

        $(".money, .percentage").click(function() {
            this.select();
        });

        $(".top-margin").change(function(e){
            var id = (this.id).split("_")[1];
            var topMargin = new BigNumber($("#topMargin_"+id).autoNumeric("get"));
            var bottomMargin = topMargin.add(1);
            //console.log(bottomMargin);

            var index = arrSimpanan.indexOf(Number(id)) + 1;
            //console.log(index);
            //console.log(arrSimpanan);
            $("#bottomMargin_"+arrSimpanan[index]).autoNumeric("set", bottomMargin);
        });

        arrSimpanan.push(Number(simpanan));
        $("#arrSimpanan").val(arrSimpanan);        
    }

    function removeSimpanan(simpanan){
        var index = arrSimpanan.indexOf(simpanan);
        var idx = arrSimpanan[index - 1];
        var idxx = arrSimpanan[index + 1];
        
        if(arrSimpanan[arrSimpanan.length-1] == simpanan){
            $("#topMargin_"+idx).prop("readonly", true);
            $("#topMargin_"+idx).prop("required", false);
        }

        var topMargin = new BigNumber($("#topMargin_"+idx).autoNumeric("get"));
        var bottomMargin = topMargin.add(1);
        $("#bottomMargin_"+idxx).autoNumeric("set", bottomMargin);
        
        $(".simpanan_"+simpanan).remove();
        if (index > -1) {
            arrSimpanan.splice(index, 1);
        }
        $("#arrSimpanan").val(arrSimpanan);
        
    }
</script>