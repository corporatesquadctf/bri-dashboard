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
                            <form class="form-horizontal" id="formEditFTPPosition" method="POST" action="<?= site_url("ftp/ftp_position/process_edit_deposito_valas"); ?>" style="padding: 20px;">
                                <input type="hidden" id="FTPItemId" name="FTPItemId" value="<?= $FTPItemId; ?>" />
                                <input type="hidden" id="arrDepositoValas" name="arrDepositoValas" value="" />                            
                                <div id="depositoValasContainer">
                                    <?php if(empty($FTPDetail)){ ?>
                                        <div class="row depositoValas_0" style="margin-bottom: 10px;">
                                            <input type="hidden" id="FTPItemDepositoValasId_0" name="FTPItemDepositoValasId_0" value="0" />
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Jangka Waktu (Bulan) :</label>
                                                    <input type="text" id="term_0" name="term_0" class="form-control periode" data-a-dec="." data-a-sep="," value="" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Suku Bunga Counter (P.A %) < 100.000 USD :</label>
                                                    <input type="text" id="interestRateLess_0" name="interestRateLess_0" class="form-control percentage" data-a-dec="." data-a-sep="," value="" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Suku Bunga Counter (P.A %) ≥ 100.000 USD :</label>
                                                    <input type="text" id="interestRateMore_0" name="interestRateMore_0" class="form-control percentage" data-a-dec="." data-a-sep="," value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }else{
                                        $i=0;
                                        foreach ($FTPDetail as $row) :
                                    ?>
                                            <div class="row depositoValas_<?= $i; ?>" style="margin-bottom: 10px;">
                                                <input type="hidden" id="FTPItemDepositoValasId_<?= $i; ?>" name="FTPItemDepositoValasId_<?= $i; ?>" value="<?= $row->FTPItemDepositoValasId; ?>" />
                                                <?php if($i != 0): ?>
                                                    <div class="col-xs-12">
                                                        <div class="pull-left" onclick="removeDepositoValasField(<?= $i; ?>)">
                                                            <div class="div-action">
                                                                <i class="material-icons no-after no-before">delete_sweep</i>
                                                                <label class="label-action">Delete Deposito Valas</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label>Jangka Waktu (Bulan) :</label>
                                                        <input type="text" id="term_<?= $i; ?>" name="term_<?= $i; ?>" class="form-control periode" data-a-dec="." data-a-sep="," value="<?= $row->Term; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <label>Suku Bunga Counter (P.A %) < 100.000 USD :</label>
                                                        <input type="text" id="interestRateLess_<?= $i; ?>" name="interestRateLess_<?= $i; ?>" class="form-control percentage" data-a-dec="." data-a-sep="," value="<?= $row->InterestRateLess; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Suku Bunga Counter (P.A %) ≥ 100.000 USD :</label>
                                                    <input type="text" id="interestRateMore_<?= $i; ?>" name="interestRateMore_<?= $i; ?>" class="form-control percentage" data-a-dec="." data-a-sep="," value="<?= $row->InterestRateMore; ?>" required>
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
                                <button id="btnCancelDepositoValas" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                <button id="btnAddDepositoValas" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;" onclick="addDepositoValasField();">ADD DEPOSITO</button>
                                <button id="btnSaveDepositoValas" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px; margin-right: 0;">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edit-deposito" tabindex="-1" role="dialog" aria-hidden="true">
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
    var jumlahDepositoValas = <?= count($FTPDetail); ?>;
    if(jumlahDepositoValas == 0){
        var arrDepositoValas = [0];
    }else{
        var arrDepositoValas = [];
        for(var i=0; i<jumlahDepositoValas; i++){
            arrDepositoValas.push(Number(i));
        }
    }
    $("#arrDepositoValas").val(arrDepositoValas);

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

        $("#btnSaveDepositoValas").click(function(){
            if($("#formEditFTPPosition").valid()){
                $(".modal-edit-deposito").modal("show");
            }
        });

        $("#btnCancelDepositoValas").click(function(){
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
                    $(".modal-edit-deposito").modal("hide");
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

    function addDepositoValasField(){
        if(arrDepositoValas.length == 0)
            var depositoValas = 0
        else {
            var depositoValas = arrDepositoValas[arrDepositoValas.length-1] +1;
        }
        
        var inner = "";
        var objTo = document.getElementById("depositoValasContainer")
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row depositoValas_"+depositoValas);
        divtest.setAttribute("style", "margin-bottom: 10px");
        inner +=    "<input type='hidden' id='FTPItemDepositoValasId_"+depositoValas+"' name='FTPItemDepositoValasId_"+depositoValas+"' value='0' />";
        inner +=    "<div class='col-xs-12'>";
        inner +=    "   <div class='pull-left' onclick='removeDepositoValasField("+depositoValas+")'>";
        inner +=    "       <div class='div-action'>";
        inner +=    "           <i class='material-icons no-after no-before'>delete_sweep</i>";
        inner +=    "           <label class='label-action'>Delete Deposito Valas</label>";
        inner +=    "       </div>";
        inner +=    "   </div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Jangka Waktu (Bulan) :</label>";
        inner +=    "       <input type='text' id='term_"+depositoValas+"' name='term_"+depositoValas+"' class='form-control periode' data-a-dec='.' data-a-sep=',' value='' required>";
        inner +=	"	</div>";
        inner +=    "</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Suku Bunga Counter (P.A %) < 100.000 USD :</label>";
        inner +=    "       <input type='text' id='interestRateLess_"+depositoValas+"' name='interestRateLess_"+depositoValas+"' class='form-control percentage' data-a-dec='.' data-a-sep=',' value='' required>";
        inner +=	"	</div>";
        inner +=	"</div>";
        inner +=    "<div class='col-xs-4'>";
        inner +=	"	<div class='form-group'>";
        inner +=    "       <label>Suku Bunga Counter (P.A %) ≥ 100.000 USD :</label>";
        inner +=    "       <input type='text' id='interestRateMore_"+depositoValas+"' name='interestRateMore_"+depositoValas+"' class='form-control percentage' data-a-dec='.' data-a-sep=',' value='' required>";
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

        arrDepositoValas.push(Number(depositoValas));
        $("#arrDepositoValas").val(arrDepositoValas);        
    }

    function removeDepositoValasField (depositoValas){
        $(".depositoValas_"+depositoValas).remove();
        var index = arrDepositoValas.indexOf(depositoValas);
        if (index > -1) {
            arrDepositoValas.splice(index, 1);
        }
        $("#arrDepositoValas").val(arrDepositoValas);
        
    }
</script>