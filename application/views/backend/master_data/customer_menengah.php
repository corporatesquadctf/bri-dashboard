<style>
    .form-control{
        color: #73879C;
    }
    .panel_toolbox>li>a {
        padding: 5px 10px;
        color: #000;
        font-size:12px;
    }
    /*
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
    */
    thead{
        background-color:#337ab7;
        color: #FFF;
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
                            <li class="breadcrumb-item active" aria-current="page">Customer Menengah</li>
                        </ol>
                    </nav>
                    <div class="x_title">
                        <div class="page_title">
                            <div class="pull-left">Customer Management</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="padding:1px 0px;">
                        <ul class="nav navbar-right panel_toolbox" style="min-width:0px;">
                            <?php if($RoleId == USER_ROLE_SUPER_USER || $RoleId == USER_ROLE_SUPER_USER_MENENGAH || $RoleId == USER_ROLE_ADMIN_WILAYAH): ?>
                            <li>
                                <button id="btnAddCustomer" class="btn w150 btn-sm btn-primary pull-right" style="margin-bottom:0px;" type="button">Add Customer</button>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a class="collapse-link btn w150 btn-sm btn-default" style="margin-bottom:0px;"><label class="search-form">Hide Filter</label></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <form id="filterCustomerForm" method="POST" class="form-horizontal form-label-left">
                        <?php if($RoleId != USER_ROLE_RM_MENENGAH && $RoleId != USER_ROLE_ADMIN_WILAYAH): ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unitKerjaId">Unit Kerja</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="unitKerjaId" name="unitKerjaId" style="width:100%;">
                                    <option value="all">All Unit Kerja</option>
                                    <?php
                                    foreach ($UnitKerjaOption as $row){
                                        $selected = "";
                                        if($row->UnitKerjaId == $UnitKerjaId) $selected = "selected";
                                        echo '<option value="'.$row->UnitKerjaId.'" '.$selected.'>'.$row->UnitKerjaName.'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isActiveId">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control js-example-basic-single" id="isActiveId" name="isActiveId" style="width:100%;">
                                    <option value="all">All Status</option>
                                    <?php
                                    foreach ($IsActiveOption as $row){
                                        $selected = "";
                                        if($row["IsActiveId"] == $IsActiveId) $selected = "selected";
                                        echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                    }
                                    ?>                                       
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Keyword</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="keyword" name="keyword" class="form-control col-md-7 col-xs-12" value="<?= $Keyword; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
                                <button id="btnFilterCustomer" class="btn w150 btn-sm btn-primary pull-left" style="margin-right:0px;" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="tableCustomer"data-click-to-select="true" 
                                    data-toggle="table" 
                                    data-toolbar="#toolbar"
                                    data-page-list="[10,25,100, 1000]"
                                    data-pagination="true" class="table table-striped table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="cntrl" data-sortable="true" style="width: 5%;">No.</th>
                                            <th class="cntrl" data-sortable="true" style="width: 6%;">CIF</th>
                                            <th class="cntrl" data-sortable="true" style="width: 15%;">Name</th>
                                            <th class="cntrl" data-sortable="true" style="width: 30%;">Address</th>
                                            <th class="cntrl" data-sortable="true" style="width: 15%;">Contact Person</th>
                                            <th class="cntrl" data-sortable="true" style="width: 17%;">Unit Kerja</th>
                                            <th class="cntrl" data-sortable="true" style="width: 6%;">Status</th>
                                            <th class="cntrl" data-sortable="true" style="width: 6%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 1;
                                        foreach($CustomerMenengah as $row){
                                    ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row->CIF; ?></td>
                                                <td><?= $row->CustomerName; ?></td>
                                                <td><?= $row->Address; ?></td>
                                                <td><?= $row->ContactPerson; ?></td>
                                                <td><?= $row->UnitKerjaName; ?></td>
                                                <td><?= $row->Status; ?></td>
                                                <td>
                                                    <div class="div-action pull-left btnEditCustomer" data-id="<?= $row->CIF; ?>" 
                                                        data-name="<?= $row->CustomerName; ?>" data-npwp="<?= $row->NPWP; ?>"
                                                        data-address="<?= $row->Address; ?>" data-cp="<?= $row->ContactPerson; ?>"
                                                        data-phone="<?= $row->PhoneNumber; ?>" data-status="<?= $row->IsActive; ?>"
                                                        data-uker="<?= $row->UnitKerjaId; ?>" data-type="<?= $row->CustomerMenengahTypeId; ?>">
                                                        <i class="material-icons">edit</i>
                                                        <label>Edit</label>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-add-customer" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Customer Information</h4>
                </div>
                <div class="modal-body">
                    <form id="formAddCustomer" class="form-horizontal" method="post" action="<?= base_url("admin/customer_menengah/add_customer") ?>" >
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>CIF</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="addCIF" name="addCIF" class="form-control" <?= $classWilayah; ?> >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Name</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="addName" name="addName" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Type</p>
                        </div>
                        <div class="col-xs-9">
                            <select class="form-control js-example-basic-single" id="addType" name="addType" style="width:100%;">
                                <option value="0">Pilih Tipe Customer</option>
                                <?php
                                foreach ($CustomerTypeOption as $row){
                                    echo '<option value="'.$row->CustomerMenengahTypeId.'">'.$row->CustomerMenengahTypeName.'</option>';
                                }
                                ?>                                       
                            </select>
                            <input type="hidden" id="addTypeId" name="addTypeId" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>NPWP</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="addNPWP" name="addNPWP" class="form-control npwp">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Address</p>
                        </div>
                        <div class="col-xs-9">
                            <textarea id="addAddress" name="addAddress" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Contact Person</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="addCP" name="addCP" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Phone</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="addPhone" name="addPhone" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Unit Kerja</p>
                        </div>
                        <div class="col-xs-9">
                            <select class="form-control js-example-basic-single" id="addUnitKerja" name="addUnitKerja" style="width:100%;" <?= $classDropdownWilayah; ?>>
                                <?php
                                if($RoleId != USER_ROLE_RM_MENENGAH && $RoleId != USER_ROLE_ADMIN_WILAYAH){
                                    echo "<option value='0'>Pilih Unit Kerja</option>";
                                }
                                foreach ($UnitKerjaOption as $row){
                                    echo '<option value="'.$row->UnitKerjaId.'">'.$row->UnitKerjaName.'</option>';
                                }
                                ?>                                       
                            </select>
                            <input type="hidden" id="addUnitKerjaId" name="addUnitKerjaId" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Status</p>
                        </div>
                        <div class="col-xs-9">
                            <select class="form-control js-example-basic-single" id="addIsActive" name="addIsActive" style="width:100%;">
                                <option value="0">Pilih Status</option>
                                <?php
                                foreach ($IsActiveOption as $row){
                                    echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                }
                                ?>                                      
                            </select>
                            <input type="hidden" id="addIsActiveId" name="addIsActiveId" />
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                    <button id="btnInsertCustomer" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edit-customer" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Customer Information</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditCustomer" class="form-horizontal" method="post" action="<?= base_url("admin/customer_menengah/edit_customer") ?>" >
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>CIF</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="editCIF" name="editCIF" class="form-control" readonly >
                            <input type="hidden" id="oldCIF" name="oldCIF">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Name</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="editName" name="editName" class="form-control" readonly required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Type</p>
                        </div>
                        <div class="col-xs-9">
                            <select class="form-control js-example-basic-single" id="editType" name="editType" style="width:100%;">
                                <option value="0">Pilih Tipe Customer</option>
                                <?php
                                foreach ($CustomerTypeOption as $row){
                                    echo '<option value="'.$row->CustomerMenengahTypeId.'">'.$row->CustomerMenengahTypeName.'</option>';
                                }
                                ?>                                       
                            </select>
                            <input type="hidden" id="editTypeId" name="editTypeId" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>NPWP</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="editNPWP" name="editNPWP" class="form-control npwp">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Address</p>
                        </div>
                        <div class="col-xs-9">
                            <textarea id="editAddress" name="editAddress" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Contact Person</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="editCP" name="editCP" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Phone</p>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" id="editPhone" name="editPhone" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Unit Kerja</p>
                        </div>
                        <div class="col-xs-9">
                            <select class="form-control js-example-basic-single" id="editUnitKerja" name="editUnitKerja" style="width:100%;" <?= $classDropdownWilayah; ?>>
                                <option value="0">Pilih Unit Kerja</option>
                                <?php
                                foreach ($UnitKerjaOption as $row){
                                    echo '<option value="'.$row->UnitKerjaId.'">'.$row->UnitKerjaName.'</option>';
                                }
                                ?>                                       
                            </select>
                            <input type="hidden" id="editUnitKerjaId" name="editUnitKerjaId" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xs-3">
                            <p>Status</p>
                        </div>
                        <div class="col-xs-9">
                            <select class="form-control js-example-basic-single" id="editIsActive" name="editIsActive" style="width:100%;">
                                <option value="0">Pilih Status</option>
                                <?php
                                foreach ($IsActiveOption as $row){
                                    echo '<option value="'.$row["IsActiveId"].'" '.$selected.'>'.$row["IsActiveName"].'</option>';
                                }
                                ?>                                      
                            </select>
                            <input type="hidden" id="editIsActiveId" name="editIsActiveId" />
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
                    <button id="btnUpdateCustomer" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery.maskedinput-master/src/jquery.maskedinput.js"></script>

<script>
    var hide = 0;
    $(document).ready(function() {
        $(".js-example-basic-single").select2();
        $(".npwp").mask("99.999.999.9-999.99");
        /*
        $("#tableCustomer").DataTable({
            "bLengthChange": false,
            "dom": "rt<'bottom'pi>",
            "pageLength": 10,
            "language": {
                "search": "",
                "searchPlaceholder" : "Search"
            },
            "pageLength": 10,
            "ordering": true,
            "order": [[0, "asc"]]
        });
        */

        $.validator.addMethod("letterNumber", function(value, element) {
            return this.optional(element) || /^[a-z0-9\\s]+$/i.test(value);
        }, "Must contain only letters or numbers");

        $.validator.addMethod("mustChoose", function(value, element) {
            if(value == 0){
                return false;
            }else return true;
        }, "Please choose one option on this field");

        $("#formEditCustomer").validate({
            ignore: [],
            rules: {
                editCIF:{
                    required: true,
                    letterNumber: true,
                    remote: {
                        url: "<?= base_url("admin/customer_menengah/serviceCheckCIFCustomer"); ?>",
                        type: "POST",
                        data: {
                            cif: function() {
                                return $("#editCIF").val()
                            },
                            oldcif: function() {
                                return $("#oldCIF").val()
                            }
                        }
                    }
                },
                editName: {
                    required: true
                },
                editNPWP: {
                    <?php if($isRequired != ""): ?>
                    required: true,
                    <?php endif; ?>
                    remote: {
                        url: "<?= base_url("admin/customer_menengah/serviceCheckNPWPCustomer"); ?>",
                        type: "POST",
                        data: {
                            cif: function() {
                                return $("#editCIF").val()
                            },
                            npwp: function() {
                                return $("#editNPWP").val()
                            }
                        }
                    }
                },
                <?php if($isRequired != ""): ?>
                    editTypeId: {
                        mustChoose: true
                    },
                    editAddress: {
                        required: true
                    },
                    editCP: {
                        required: true
                    },
                    editCP: {
                        required: true
                    },
                    editPhone: {
                        required: true
                    },
                    editUnitKerjaId: {
                        mustChoose: true
                    },
                    editIsActiveId: {
                        mustChoose: true
                    },
                <?php endif; ?> 
            },
            messages:{
                editCIF: {
                    remote: "CIF is already taken"
                },
                editNPWP: {
                    remote: "NPWP is already taken"
                }
            }
        });

        $("#tableCustomer tbody").on("click", ".btnEditCustomer", function () {
            clearModal("edit");
            $("#oldCIF").val("");
            
            var cif = $(this).data("id");
            $("#editCIF").val(cif);
            $("#oldCIF").val(cif);
            
            var name = $(this).data("name");
            $("#editName").val(name);
            
            var type = $(this).data("type");
            if(type == "") type = 0;
            $("#editType").val(type).trigger("change");
            $("#editTypeId").val(type);
            
            var npwp = $(this).data("npwp");
            $("#editNPWP").val(npwp);
            
            var address = $(this).data("address");
            $("#editAddress").val(address);
            
            var cp = $(this).data("cp");
            $("#editCP").val(cp);
            
            var phone = $(this).data("phone");
            $("#editPhone").val(phone);
            
            var uker = $(this).data("uker");
            if(uker == "") uker = 0;
            $("#editUnitKerja").val(uker).trigger("change");
            $("#editUnitKerjaId").val(uker);
            
            var status = $(this).data("status");
            if(status == "") status = 0;
            $("#editIsActive").val(status).trigger("change");
            $("#editIsActiveId").val(status);
            
            $(".modal-edit-customer").modal("show");
        });

        $("#btnUpdateCustomer").click(function(e){
            if($("#formEditCustomer").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#formEditCustomer").attr("action"),
                    data: $("#formEditCustomer").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-edit-customer").modal("hide");
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
                                window.location.href= "<?= base_url("admin/customer_menengah"); ?>";
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
            }
        });

        $("#editType").change(function(){
            var type =  this.value;
            $("#editTypeId").val(type);
            $("#editTypeId").removeClass("error");
            $("#editTypeId-error").css("display","none");
        });

        $("#editUnitKerja").change(function(){
            var type =  this.value;
            $("#editUnitKerjaId").val(type);
            $("#editUnitKerjaId").removeClass("error");
            $("#editUnitKerjaId-error").css("display","none");
        });

        $("#editIsActive").change(function(){
            var type =  this.value;
            $("#editIsActiveId").val(type);
            $("#editIsActiveId").removeClass("error");
            $("#editIsActiveId-error").css("display","none");
        });

        $("#btnAddCustomer").click(function(){
            clearModal("add");
            $("#addUnitKerjaId").val(<?= $UnitKerjaOption[0]->UnitKerjaId; ?>);
            $(".modal-add-customer").modal("show");
        });

        $("#addCIF").change(function(){
            var cifId = $(this).val();
            getCustomerInformation(cifId,"add");
        });
        
        $("#formAddCustomer").validate({
            ignore: [],
            rules: {
                addCIF:{
                    required: true,
                    letterNumber: true,
                    remote: {
                        url: "<?= base_url("admin/customer_menengah/serviceCheckCIFCustomer"); ?>",
                        type: "POST",
                        data: {
                            cif: function() {
                                return $("#addCIF").val()
                            }
                        }
                    }
                },
                addName:{
                    required: true
                },
                addNPWP: {
                    <?php if($isRequired != ""): ?>
                    required: true,
                    <?php endif; ?>
                    remote: {
                        url: "<?= base_url("admin/customer_menengah/serviceCheckNPWPCustomer"); ?>",
                        type: "POST",
                        data: {
                            cif: function() {
                                return $("#addCIF").val()
                            },
                            npwp: function() {
                                return $("#addNPWP").val()
                            }
                        }
                    }
                },
                <?php if($isRequired != ""): ?>
                    addTypeId: {
                        mustChoose: true
                    },
                    addAddress: {
                        required: true
                    },
                    addCP: {
                        required: true
                    },
                    addCP: {
                        required: true
                    },
                    addPhone: {
                        required: true
                    },
                    addUnitKerjaId: {
                        mustChoose: true
                    },
                    addIsActiveId: {
                        mustChoose: true
                    },
                <?php endif; ?>                    
            },
            messages:{
                addName: {
                    required: "Customer is not found"
                },
                addCIF: {
                    remote: "CIF is already taken"
                },
                addNPWP: {
                    remote: "NPWP is already taken"
                }
            }
        });

        $("#btnInsertCustomer").click(function(e){
            if($("#formAddCustomer").valid()){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url : $("#formAddCustomer").attr("action"),
                    data: $("#formAddCustomer").serialize(),
                    dataType : "json",
                    beforeSend:function(){
                        $(".modal-add-customer").modal("hide");
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
                                window.location.href= "<?= base_url("admin/customer_menengah"); ?>";
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
            }
        });

        $("#addType").change(function(){
            var type =  this.value;
            $("#addTypeId").val(type);
            $("#addTypeId").removeClass("error");
            $("#addTypeId-error").css("display","none");
        });

        $("#addUnitKerjaId").change(function(){
            var type =  this.value;
            $("#addUnitKerjaId").val(type);
            $("#addUnitKerjaId").removeClass("error");
            $("#addUnitKerjaId-error").css("display","none");
        });

        $("#addIsActive").change(function(){
            var type =  this.value;
            $("#addIsActiveId").val(type);
            $("#addIsActiveId").removeClass("error");
            $("#addIsActiveId-error").css("display","none");
        });
    });

    function clearModal(modalType){
        $("#"+modalType+"CIF").val("");
        $("#"+modalType+"CIF").removeClass("error");
        $("#"+modalType+"CIF-error").css("display","none");

        $("#"+modalType+"Name").val("");
        $("#"+modalType+"Name").removeClass("error");
        $("#"+modalType+"Name-error").css("display","none");

        $("#"+modalType+"Type").val(0).trigger("change");
        $("#"+modalType+"TypeId").removeClass("error");
        $("#"+modalType+"TypeId-error").css("display","none");

        $("#"+modalType+"NPWP").val("");
        $("#"+modalType+"NPWP").removeClass("error");
        $("#"+modalType+"NPWP-error").css("display","none");

        $("#"+modalType+"Address").val("");
        $("#"+modalType+"Address").removeClass("error");
        $("#"+modalType+"Address-error").css("display","none");

        $("#"+modalType+"CP").val("");
        $("#"+modalType+"CP").removeClass("error");
        $("#"+modalType+"CP-error").css("display","none");
        
        $("#"+modalType+"Phone").val("");
        $("#"+modalType+"Phone").removeClass("error");
        $("#"+modalType+"Phone-error").css("display","none");

        $("#"+modalType+"UnitKerja :nth-child(1)").prop("selected", true).trigger("change");
        $("#"+modalType+"UnitKerjaId").removeClass("error");
        $("#"+modalType+"UnitKerjaId-error").css("display","none");

        $("#"+modalType+"IsActive").val(0).trigger("change");
        $("#"+modalType+"IsActiveId").removeClass("error");
        $("#"+modalType+"IsActiveId-error").css("display","none");
    }

    function getCustomerInformation(cifId="", modalType){
        $("#"+modalType+"Name-error").remove();
        $(".loaderImage").show();
        $.getJSON("<?= base_url();?>"+'logins/checkCustomer/'+cifId, function (data){
            if(data["success"] == true){
                var rsCustomer = data["data"];
                var customerName = rsCustomer[0]["NAMA"];

                $("#"+modalType+"Name").val(customerName);
                $("#"+modalType+"Name").removeClass("error");
                $("#"+modalType+"Name-error").css("display","none");
            }else{
                $("#"+modalType+"Name").val("");
                $("#"+modalType+"Name").addClass("error");

                $("#"+modalType+"Name").after("<label id='addName-error' class='error' for='addName'>Customer is not found</label>" );
            }
            $(".loaderImage").hide();
        }).fail(function(jqXHR) {
            $(".loaderImage").hide();
            $(".modal-"+modalType+"-customer").modal("hide");
            $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Status:  "+jqXHR.statusText+"<br/>Error Messages: Connection to BRISTARS is not established.");
            $(".modal-error-notification").modal("show");
        });            
    }
</script>