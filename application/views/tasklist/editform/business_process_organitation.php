<style type="text/css">
    .form_container{
        margin: 0;
        padding: 15px 30px;
        box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .form_container label{
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.87);
    }
    .form_container .form-control{
        border-radius: 4px;
    }
    .form_action{
        margin: 0;
        padding: 30px 30px 0 15px;
    }
    .form_action button{
        border: 1px solid #F58C38;
        box-sizing: border-box;
        border-radius: 2px;
        font-size: 10px;
        color: #FFFFFF;
    }
    .form_action .btn_save{
        background: #F58C38;
    }
    .form_action .btn_save:hover{
        border: 1px solid #F58C38;
    }
    .form_action .btn_save:active:hover{
        background: #c4702c;
        border: 1px solid #F58C38;
    }
    .form_action .btn_cancel{
        color: #F58C38;
    }
    .form_action .btn_cancel:hover{
        border: 1px solid #F58C38;
    }
    .form_action .btn-default.focus, .btn-default:focus {
        border-color: #F58C38;
    }
    .div-action{
        display: inline-flex;
        margin: auto;
        color: #F58C38;
        float: right;
    }
    .div-action i{
        font-size: 14px;
        font-weight: normal;
        margin: auto;
    }
    .div-action label{
        color: #F58C38;
        font-size: 14px;
        font-weight: normal;
        padding-left: 5px;
        margin-bottom: 0px;
    }
    .div-action:hover i, .div-action:hover label{
        cursor: pointer;
        font-weight: bold !important;
    }
    .label-action{
        margin:0 !important; 
        padding-left:5px !important; 
        font-weight: normal !important;
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
        color: #FFF;
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
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .label_desc{
        color: #707070 !important;
        font-weight: normal !important;
        font-size: 12px !important;
    }
    .progress {
        border-radius: 4px;
        height: 5px;
    }
    .progress-bar {
        background: #F58C38;
    }
    .label_title{
        color: #218FD8 !important;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Tasklist</li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');?>">Company Information</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Business Process Organitation</li>
                    </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left">Business Process Organitation</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:0 0 10px 0;">
                    <div class="x_content" style="padding: 0; margin-top: 0px;">
                        <form method="post" action="<?= base_url().'tasklist/AccountPlanning/proses_business_process_organitation/'.$AccountPlanningId; ?>">
                            <div class="row form_container">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label>Group Structure</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="margin-bottom:5px;">
                                            <label>Upload File :</label>
                                        </div>
                                        <div class="col-xs-9" style="margin-bottom:5px;">
                                            <div class="input-group" style="margin-bottom:0;">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file btn-choose">
                                                        Choose File <input type="file" id="file-group_structure" name="file-group_structure">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" style="background: #FFF;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin-bottom:5px;">
                                            <button type="button" class="btn btn-choose btn-upload" id="group_structure" name="group_structure" style="margin-bottom:0;" disabled>Upload</button>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="label_desc">Allowed File Type :</label><label style="margin-left:5px; font-size:12px;">.pdf</label>
                                        </div>
                                        <div class="col-xs-12" style="margin-bottom:5px;">
                                            <label class="label_desc">File must be less than :</label><label style="margin-left:5px; font-size:12px;">.5 Mb</label>
                                        </div>
                                        <div class="col-xs-9" id="progress-group_structure" style="display:none;">
                                            <div class="progress">
                                                <div id="progressbar-group_structure" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row" id="row-group_structure">
                                    <?php if(!empty($GroupStructure)): ?>
                                        <div class="col-xs-9">
                                            <div class="col-xs-12 form_container">
                                                <a href="<?php echo base_url().'uploads/account_planning/'.$AccountPlanningId.'/'.$GroupStructure[0]->FilePath;?>" target="_blank">
                                                <i class="fa fa-file-pdf-o" style="color:red; cursor:pointer;"></i>
                                                <label class="label_title" style="margin-left: 5px; cursor:pointer;"><?= $GroupStructure[0]->FilePath; ?></label>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($AssignedCompany)) {?>
                            <div class="row" style="margin:0;">
                                <?php 
                                    $i = 0;
                                    foreach ($AssignedCompany as $row) : 
                                ?>
                                <div class="col-xs-12 form_container">
                                    <div class="col-xs-12">
                                        <label class="label_title" style="font-size: 16px;"><?= $row->Name; ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label>Business Process</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12" style="margin-bottom:5px;">
                                                <label>Upload File :</label>
                                            </div>
                                            <div class="col-xs-9" style="margin-bottom:5px;">
                                                <div class="input-group" style="margin-bottom:0;">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-default btn-file btn-choose">
                                                            Choose File <input type="file" id="file-business_process-<?= $row->VCIF; ?>" name="file-business_process-<?= $row->VCIF; ?>">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" style="background: #FFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin-bottom:5px;">
                                                <button type="button" class="btn btn-choose btn-upload" id="business_process-<?= $row->VCIF; ?>" name="business_process-<?= $row->VCIF; ?>" style="margin-bottom:0;" disabled>Upload</button>
                                            </div>
                                            <div class="col-xs-12">
                                                <label class="label_desc">Allowed File Type :</label><label style="margin-left:5px; font-size:12px;">.pdf</label>
                                            </div>
                                            <div class="col-xs-12" style="margin-bottom:5px;">
                                                <label class="label_desc">File must be less than :</label><label style="margin-left:5px; font-size:12px;">.5 Mb</label>
                                            </div>
                                            <div class="col-xs-9" id="progress-business_process-<?= $row->VCIF; ?>" style="display:none;">
                                                <div class="progress">
                                                    <div id="progressbar-business_process-<?= $row->VCIF; ?>" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="row-business_process-<?= $row->VCIF; ?>">
                                            <?php if(!empty($row->BusinessProcess)): ?>
                                            <div class="col-xs-9">
                                                <div class="col-xs-12 form_container">
                                                    <a href="<?php echo base_url().'uploads/account_planning/'.$AccountPlanningId.'/'.$row->VCIF.'/'.$row->BusinessProcess[0]->FilePath;?>" target="_blank">
                                                        <i class="fa fa-file-pdf-o" style="color:red; cursor:pointer;"></i>
                                                        <label class="label_title" style="margin-left: 5px; cursor:pointer;"><?= $row->BusinessProcess[0]->FilePath; ?></label>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label>Company Structure</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12" style="margin-bottom:5px;">
                                                <label>Upload File :</label>
                                            </div>
                                            <div class="col-xs-9" style="margin-bottom:5px;">
                                                <div class="input-group" style="margin-bottom:0;">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-default btn-file btn-choose">
                                                            Choose File <input type="file" id="file-company_structure-<?= $row->VCIF; ?>" name="file-company_structure-<?= $row->VCIF; ?>">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" style="background: #FFF;" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin-bottom:5px;">
                                                <button type="button" class="btn btn-choose btn-upload" id="company_structure-<?= $row->VCIF; ?>" name="company_structure-<?= $row->VCIF; ?>" style="margin-bottom:0;" disabled>Upload</button>
                                            </div>
                                            <div class="col-xs-12">
                                                <label class="label_desc">Allowed File Type :</label><label style="margin-left:5px; font-size:12px;">.pdf</label>
                                            </div>
                                            <div class="col-xs-12" style="margin-bottom:5px;">
                                                <label class="label_desc">File must be lest than :</label><label style="margin-left:5px; font-size:12px;">.5 Mb</label>
                                            </div>
                                            <div class="col-xs-9" id="progress-company_structure-<?= $row->VCIF; ?>" style="display:none;">
                                                <div class="progress">
                                                    <div id="progressbar-company_structure-<?= $row->VCIF; ?>" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="row" id="row-company_structure-<?= $row->VCIF; ?>">
                                            <?php if(!empty($row->CompanyStructure)): ?>
                                            <div class="col-xs-9">
                                                <div class="col-xs-12 form_container">
                                                    <a href="<?php echo base_url().'uploads/account_planning/'.$AccountPlanningId.'/'.$row->VCIF.'/'.$row->CompanyStructure[0]->FilePath;?>" target="_blank">
                                                    <i class="fa fa-file-pdf-o" style="color:red; cursor:pointer;"></i>
                                                    <label class="label_title" style="margin-left: 5px; cursor:pointer;"><?= $row->CompanyStructure[0]->FilePath; ?></label>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php } ?>
                            <div class="row form_action">
                                <div class="form-group pull-right">
                                    <div class="col-xs-12">
                                        <button id="btn_cancel_edit_business_process_organization" class="btn btn-sm btn-default btn_cancel" type="button" style="width: 200px;">BACK</button>
                                        <button id="btn_save_edit_business_process_organization" class="btn btn-sm btn-primary btn_save" type="button" style="width: 200px;">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-upload').on('click', function () {
            var id = this.id;
            var arrId = id.split('-');
            switch(arrId[0]){
                case 'group_structure': 
                    var structureTypeId = 2;
                    var vcif = null;
                    break;
                case 'business_process':
                    var structureTypeId = 1;
                    var vcif = arrId[1];
                    break;
                case 'company_structure':
                    var structureTypeId = 3;
                    var vcif = arrId[1];
                    break;
            }
            var fileData = $('#file-'+id).prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', fileData);
            form_data.append('structureTypeId', structureTypeId);
            form_data.append('vcif', vcif);
            $('#progress-'+id).show();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        //$('#progressbar-'+id).show();
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('#progressbar-'+id).css('width',percentComplete+"%");
                            //$('#progressbar-'+id).html(percentComplete+"%");
                            if (percentComplete === 100) {
                            }
                        }
                    }, false);
                    return xhr;
                },
                url: "<?php echo base_url().'tasklist/AccountPlanning/upload_businessprocessorganitation/'.$AccountPlanningId; ?>",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success	: function (data)
                {
                    if(data.status != 'error')
                    {
                        //refresh_files();
                        showFileDiv(id);
                        $('#progress-'+id).hide();
                    }else{
                        alert(data.msg);
                    }
                },
                error: function (response) {
                    //$('#msg').html(response);
                }
            });
        });

        $('#btn_cancel_edit_business_process_organization').click(function(){
            window.location.href= '<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/company_information');?>';
        });

        $('#btn_save_edit_business_process_organization').click(function(){
            window.location.href= '<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/company_information');?>';
        });

        $('.btn-file :file').on('change', function () {
            var id = this.id;
            //alert('change : '+id);
            var arrObject = id.split('-');
            var object = '';
            if(arrObject.length > 2){
                for(var i=1; i<arrObject.length; i++){
                    object += arrObject[i];
                    if(i != (arrObject.length -1)){
                        object += '-';
                    }
                }
            }else{
                object = arrObject[1];
            }
            var input = $(this);
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
            //$('#progressbar-'+arrObject[1]).hide();
            $('#progressbar-'+object).css('width',"0%");
        });

        $('.btn-file :file').on('fileselect', function (event, label) {
            var id = this.id;
            var arrObject = id.split('-');
            var object = '';
            if(arrObject.length > 2){
                for(var i=1; i<arrObject.length; i++){
                    object += arrObject[i];
                    if(i != (arrObject.length -1)){
                        object += '-';
                    }
                }
            }else{
                object = arrObject[1];
            }
            //alert(object);
            var ext = $('#file-'+object).val().split(".").pop().toLowerCase();
            var input = $(this).parents('.input-group').find(':text')
            if ($('#file-'+object).get(0).files.length === 0) {
                alert("Please choose file");
            }else{
                if($.inArray(ext, ['pdf']) == -1) {
                    alert("File must be .pdf");
                    input.val('');
                }else{
                    var filesize = $('#file-'+object).get(0).files[0].size;
                    if(filesize > 5242880){
                        alert("File must be less than 5MB");
                    }else{
                        var log = label;
                        if (input.length) {
                            input.val(log);
                            $('#'+object).prop('disabled', false);
                        } else {
                            if (log) {
                                //alert(log);
                            }
                        }
                    }
                }    
            }
        });
    });

    function showFileDiv(id){
        arrId = id.split('-');
        var object = '';
        if(arrId.length > 2){
            for(var i=1; i<arrId.length; i++){
                object += arrId[i];
                if(i != (arrId.length -1)){
                    object += '-';
                }
            }
        }else{
            object = arrId[1];
        }
        var label = '';
        var path = '';
        switch(arrId[0]){
            case 'group_structure':
                label = 'Group_Structure.pdf';
                path += label;
                break;
            case 'business_process':
                label = 'Business_Process_'+object+'.pdf';
                path += '/'+object+'/'+label;
                break;
            case 'company_structure':
                label = 'Company_Structure_'+object+'.pdf';
                path += '/'+object+'/'+label;
                break;
            default: break;
        }
        var inner = '';
        var objTo = document.getElementById('row-'+id);
        $('#row-'+id).empty();
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "col-xs-9");
        inner +=    '<div class="col-xs-12 form_container">';
        inner +=    '   <a href="<?php echo base_url().'uploads/account_planning/'.$AccountPlanningId;?>'+'/'+path+'" target="_blank">';
        inner +=    '       <i class="fa fa-file-pdf-o" style="color:red; cursor:pointer;"></i>';
        inner +=    '       <label class="label_title" style="margin-left: 5px; cursor:pointer;">'+label+'</label>';
        inner +=    '   </a>';
        inner +=    '</div>';
        divtest.innerHTML = inner;
        objTo.appendChild(divtest);
    }
</script>