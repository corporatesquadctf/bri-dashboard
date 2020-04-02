<style type="text/css">
  .jstree-container-ul{
    margin-bottom: 5px;
  }
  .jstree-default .jstree-themeicon-custom {
    background-size: 24px !important;
  }
  .jstree-default .jstree-anchor {
    font-size: 12px;
    color: #000000;
    font-weight: normal;
  }
  .vakata-context li>a {
    padding: 0 1em;
  }
  .scrollbar
  {
    overflow-x: auto;
  }
  #tree_container::-webkit-scrollbar-track
  {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }
  #tree_container::-webkit-scrollbar
  {
    width: 7px;
    background-color: #F5F5F5;
  }
  #tree_container::-webkit-scrollbar-thumb
  {
    background-color: #218FD8;
  }
  #sector_economy_tree::-webkit-scrollbar-track
  {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }
  #sector_economy_tree::-webkit-scrollbar
  {
    height: 7px;
    background-color: #F5F5F5;
  }
  #sector_economy_tree::-webkit-scrollbar-thumb
  {
    background-color: #218FD8;
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
  .div-action i{
    font-size: 24px;
  }
  .form_action .btn_save:active {
    border-color: #F58C38;
  }
  .form_action .btn_save:focus {
    border-color: #F58C38;
  }
  .form_action .btn_save:active:focus {
    border-color: #F58C38;
  }
</style>

<div class="right_col" role="main">
  <div class="container" style="min-height: 515px;">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Kajian Ekonomi Makro</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('macro_economy/economy_research');?>">Economy Research</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Economy Research</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="min-height: inherit; padding: 0 10px 10px 10px;">
      <div class="col-xs-12 col-sm-3" style="min-height: inherit; padding:0 10px;">
        <div class="row" style="min-height: inherit; background-color: #FFF; margin-right: 0; padding: 10px;">
          <div class="col-xs-12" style="padding:0 10px; margin-bottom: 10px;">
            <button id="btnUploadFile" class="btn btn-primary" type="button" style="width: 100%;" disabled>Upload File Baru</button>
          </div>
          <div id="tree_container" class="col-xs-12" class="" style="height: 435px; overflow-y: auto;">
            <div id="sector_economy_tree" class="scrollbar"></div>
          </div>
        </div>
      </div>
      
      <div class="col-xs-12 col-sm-6" style="min-height: inherit; padding: 0 10px;">
        <div class="row" style="min-height: inherit; background-color: #FFF; margin-right: 0; padding: 10px;">
          <div class="col-xs-12" style="padding:0 10px; margin-bottom: 10px;">
            <label id="breadcrumb-folder" style="font-size: 14px; color: #000000;"></label>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-3" style="min-height: inherit; padding: 0 10px;">
        <div class="row" style="min-height: inherit; background-color: #FFF; padding: 10px;">
        </div>
      </div>
    </div>

  </div>

  <div class="modal fade modal-create-node" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="parents" name="parents" val="" />
          <input type="hidden" id="node" val="" />
          <p>You want to create new node, are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="btnCreateNode" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-edit-node" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="node" val="" />
          <input type="hidden" id="oldLabel" val="" />
          <p>You want to rename this node to <label id="newLabel" value="" ></label>, are you sure?</p>
        </div>
        <div class="modal-footer">
          <button id="btnCancelEditNode" type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="btnSaveEditNode" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-delete-node" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="node" val="" />
          <p>You want to delete this node, it will delete all of childs. Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="btnDeleteNode" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-upload-file" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="formFileUpload" name="formFileUpload" method="post" action="<?= base_url("macro_economy/economy_research/processFileUpload"); ?>">          
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Upload File</h4>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-bottom: 15px;">
            <div class="col-xs-12">
              <label style="font-weight: 600; font-size: 14px; color: #000000;">Upload File Ke :</label>
              <label id="modal-root-upload" style="font-weight: normal; font-size: 14px; color: #000000;"></label>
              <input type="hidden" id="nodePath" name="nodePath" value="" />
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-12">
              <label style="font-weight: 600; font-size: 16px; color: #000000;">Judul :</label>
              <input type="text" id="title" name="title" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <label style="font-weight: 600; font-size: 16px; color: #000000;">Periode (Start - End) :</label><br/>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-12" style="display: flex;">
              <div class="input-group date col-xs-6" style="margin-bottom: 0; margin-right: 5px;">
                <input type="text" name="start_periode" id="start_periode" class="action_plan form-control" readonly style="background-color: #FFF;">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
              <div class="input-group date col-xs-6" style="margin-bottom: 0; margin-left: 5px;">
                <input type="text" name="end_periode" id="end_periode" class="action_plan form-control" readonly style="background-color: #FFF;">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-12">
              <label style="font-weight: 600; font-size: 16px; color: #000000;">Deskripsi :</label>
              <textarea id="description" name="description" class="form-control" rows="5"></textarea>
            </div>
          </div>
          <!--
          <div class="row">
            <div class="col-xs-12">
              <label style="font-weight: 600; font-size: 16px; color: #000000;">Upload File :</label>
              <input type="hidden" id="dataFileUpload" name="dataFileUpload" />
            </div>
          </div>
          <div id="fileUploadContainer">
          <div class="row" style="margin-bottom: 5px;">
            <div class="col-xs-11">
              <div class="input-group" style="margin-bottom:0;">
                <span class="input-group-btn">
                    <span class="btn btn-default btn-file btn-choose" id="btnFile_0">
                        Choose File <input type="file" id="fileUpload_0" name="fileUpload_0">
                    </span>
                </span>
                <input type="text" class="form-control" style="background: #FFF;" readonly>
              </div>
            </div>
            <div class="col-xs-1"></div>
            <div class="col-xs-12">
              <input type="hidden" id="fileUploadExist_0" name="fileUploadExist_0" value="0">
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button id="btnAddMoreFile" class="btn btn-sm btn-default btn-choose" type="button" style="width: 200px;" onclick="addFileUpload();">ADD MORE FILE</button>
            </div>
          </div>
          -->
        </div>
        <div class="modal-footer form_action" style="padding: 15px;">
          <button type="button" class="btn w150 btn-default btn_cancel" data-dismiss="modal">Cancel</button>
          <button id="btnSaveUpload" type="button" class="btn w150 btn_save btn-primary modal-button-ok">Save</button>
        </div>        
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/jstree/dist/jstree.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
  var rules = {};
  var arrFileUpload = [0];
  $("#dataFileUpload").val(arrFileUpload);
  
  $(document).ready(function(){
    initTreeview();

    var today = "<?= date("Y-m"); ?>";
    $('#start_periode').datetimepicker({
        defaultDate: today,
        useCurrent: false,
        minDate: today,
        format: 'MM-YYYY',
        viewMode: 'years',
        ignoreReadonly: true
    });

    $('#end_periode').datetimepicker({
        useCurrent: false,
        minDate: today,
        format: 'MM-YYYY',
        viewMode: 'years',
        ignoreReadonly: true
    });

    $("#btnUploadFile").click(function(){
      clearUploadFileModal();
      var tree = $("#sector_economy_tree").jstree(true);
      if(typeof tree.get_selected(true)[0] !== 'undefined'){
        var data = tree.get_selected(true)[0].id;
        //console.log(tree.get_selected(true)[0].id);
        $(".modal-upload-file").modal("show");
      }
    });

    $("#btnCreateNode").click(function(){
      var parents = $(".modal-create-node #parents").val();
      var parent = $(".modal-create-node #node").val();
      $.ajax({
        type: "post",
        url : "<?= base_url("macro_economy/economy_research/serviceCreateSector"); ?>",
        data: {
          "Parents" : parents,
          "ParentNode" : parent,
          "Name" : "New Node"
        },
        dataType : "json",
        beforeSend:function(){
          $(".modal-create-node").modal("hide");
        },
        success: function(response){
            if(response.status === "success"){
              initTreeview();
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
        },
        complete: function(response){
          setTimeout(function(){ 
            selectEditNode(response.responseJSON.id);
          }, 1500); 
        }
      });
    });

    $("#btnCancelEditNode").click(function(){
      var tree = $("#sector_economy_tree").jstree(true);
      var node = $(".modal-edit-node #node").val();
      var oldLabel = $(".modal-edit-node #oldLabel").val();
      tree.rename_node(node, oldLabel);
    });

    $("#btnSaveEditNode").click(function(){
      var tree = $("#sector_economy_tree").jstree(true);
      var node = $(".modal-edit-node #node").val();
      var newLabel = $(".modal-edit-node #newLabel").html();
      $(".modal-edit-node").modal("hide");

      $.ajax({
        type: "post",
        url : "<?= base_url("macro_economy/economy_research/serviceUpdateSector"); ?>",
        data: {
          "MacroEconomyId" : node,
          "Name" : newLabel
        },
        dataType : "json",
        beforeSend:function(){
          $(".modal-edit-node").modal("hide");
        },
        success: function(response){
            if(response.status === "success"){
              initTreeview();
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
        },
        complete: function(response){
          setTimeout(function(){ 
            selectNode(response.responseJSON.id);
          }, 1500); 
        }
      });
    });

    $("#btnDeleteNode").click(function(){
      var node = $(".modal-delete-node #node").val();
      var tree = $("#sector_economy_tree").jstree(true);
      
      $.ajax({
        type: "post",
        url : "<?= base_url("macro_economy/economy_research/serviceDeleteSector"); ?>",
        data: {
          "MacroEconomyId" : node
        },
        dataType : "json",
        beforeSend:function(){
          $(".modal-delete-node").modal("hide");
        },
        success: function(response){
            if(response.status === "success"){
              initTreeview();
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
        },
        complete: function(response){
          setTimeout(function(){ 
            deselectNode();
          }, 1500); 
        }
      });
      
    });

    $("#btnFile_0 :file").on("change", function () {
      var id = this.id;
      var input = $(this);
      var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      
      input.trigger("fileselect", [label]);
    });

    $("#btnFile_0 :file").on("fileselect", function (event, label) {
      var id = this.id;
      var arrObject = id.split('_');
      var object = arrObject[1];
      var input = $(this).parents(".input-group").find(":text");
      
      if ($("#fileUpload_"+object).get(0).files.length === 0){
        alert("Please choose file");
        input.val("");
        $("#fileUploadExist_"+object).val(0);
      }else{
        var filesize = $("#fileUpload_"+object).get(0).files[0].size;
        var filetype = $("#fileUpload_"+object).get(0).files[0].type;
        if($.inArray(filetype, ["image/gif", "image/jpeg", "image/png"]) >= 0 && filesize > 5242880){
          alert("Image file must be less than 5MB");
          input.val("");
          $("#fileUploadExist_"+object).val(0);
        }else{
          var log = label;
          if (input.length) {
            input.val(log);
            $("#fileUploadExist_"+object).val(1);
          }
        }
      }
    });

    $.validator.addMethod("checkFileUpload", function(value, element) {
      var arrIndex = (element.id).split("_");
      var id = arrIndex[1];      
      if($("#fileUploadExist_"+id).val() == 0){
          return false;
      }else return true;
    }, "This file is required");

    $("#formFileUpload").validate({
      ignore: [],
      rules: (function() {
        results = {};
        for(var i = 0; i < arrFileUpload.length; i++) {
            results["fileUploadExist_"+i] = { checkFileUpload: true }
        }
        return results;
      })()
    });    
    
    $("#btnSaveUpload").click(function(e){
      if($("#formFileUpload").valid()){
        e.preventDefault();
        var form_data = new FormData();
        form_data.append("nodePath", $("#nodePath").val());
        form_data.append("title", $("#title").val());
        form_data.append("start_periode", $("#start_periode").val());
        form_data.append("end_periode", $("#end_periode").val());
        form_data.append("description", $("#description").val());
        form_data.append("dataFileUpload", $("#dataFileUpload").val());
        var dataUpload = ($("#dataFileUpload").val()).split(",");
        for(var i=0; i<dataUpload.length; i++){
          var file = $("#fileUpload_"+dataUpload[i]);
          form_data.append("fileUpload_"+dataUpload[i], file.prop("files")[0])
        }
        $.ajax({
          type: "post",
          contentType: false,
          url : $("#formFileUpload").attr("action"),
          data: form_data,
          processData: false,
          dataType : "json",
          beforeSend:function(){
            $(".modal-upload-file").modal("hide");
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
                    window.location.href= "<?= base_url("macro_economy/economy_research"); ?>";
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

    //$(".modal-upload-file").modal("show");
  });

  function selectEditNode(id){
    var tree = $("#sector_economy_tree").jstree(true);
    tree.deselect_all();
    tree.select_node(id);
    tree.edit(id);
  }

  function selectNode(id){
    var tree = $("#sector_economy_tree").jstree(true);
    tree.deselect_all();
    tree.select_node(id);
  }

  function deselectNode(){
    var tree = $("#sector_economy_tree").jstree(true);
    tree.deselect_all();
  }

  function initTreeview(){
    jQuery(".loaderImage").show();
    $.getJSON("<?= base_url("macro_economy/economy_research/serviceGetTreeData"); ?>", function (data){
      drawTreeview(data);   
    });
  }

  function drawTreeview(data){
    $('#sector_economy_tree').jstree("destroy").empty();
    var tree =  $("#sector_economy_tree").jstree({
      "core" : {
        "check_callback": true,
        "data" : data
      },
      "plugins": ["contextmenu"],
      "contextmenu": {
        "items": function ($node) {
          var tree = $("#sector_economy_tree").jstree(true);
          if($node.id == 1){
            return {
              "Create": {
                "separator_before": false,
                "separator_after": false,
                "label": "Create",
                "action": function (obj) {   
                  var parents = "";
                  if($node.parents.length > 0){
                    $.each($node.parents, function(key, value){
                      parents += value + "_";
                    });
                  }
                  $(".modal-create-node #parents").val(parents);
                  $(".modal-create-node #node").val($node.id);
                  $(".modal-create-node").modal("show");
                }                    
              },
            };
          }else{
            if($node.parents.length > 5){
              return {
                "Rename": {
                  "separator_before": false,
                  "separator_after": false,
                  "label": "Rename",
                  "action": function (obj) {
                    tree.edit($node);
                  }
                },
                "Remove": {
                  "separator_before": false,
                  "separator_after": false,
                  "label": "Remove",
                  "action": function (obj) {
                    $(".modal-delete-node #node").val($node.id);
                    $(".modal-delete-node").modal("show");
                  }
                }
              }
            }else{
              return {                
                "Create": {
                  "separator_before": false,
                  "separator_after": false,
                  "label": "Create",
                  "action": function (obj) {
                    console.log($node);
                    var parents = "";
                    if($node.parents.length > 0){
                      $.each($node.parents, function(key, value){
                        parents += value + "_";
                      });
                    }
                    $(".modal-create-node #parents").val(parents);
                    $(".modal-create-node #node").val($node.id);
                    $(".modal-create-node").modal("show");                    
                  }                      
                },
                "Rename": {
                  "separator_before": false,
                  "separator_after": false,
                  "label": "Rename",
                  "action": function (obj) {
                    tree.edit($node);                                      
                  }
                },
                "Remove": {
                  "separator_before": false,
                  "separator_after": false,
                  "label": "Remove",
                  "action": function (obj) {
                    $(".modal-delete-node #node").val($node.id);
                    $(".modal-delete-node").modal("show");
                  }
                }
              };
            }
          }
          
        }
      }
    });
    
    tree.bind("loaded.jstree", function (event, data) {
        $(this).jstree("open_all");
    });
    
    tree.bind("show_contextmenu.jstree", function(e, reference, element) {
      if (reference.node.id == 2 || reference.node.id == 3 || reference.node.id == 4){
        $(".vakata-context").remove();
      }
    });

    tree.bind("rename_node.jstree", function(event, data) {
      $(".modal-edit-node #node").val(data.node.id);
      $(".modal-edit-node #oldLabel").val(data.old);
      $(".modal-edit-node #newLabel").html(data.text);
      $(".modal-edit-node").modal("show");  
    });

    tree.on("select_node.jstree", function(event, data){
      //console.log(data.node);
      var parents = data.node.parents;
      //console.log(parents);
      var breadcrumb = data.node.text;
      var parentsLength = parents.length - 2;
      var tree = $("#sector_economy_tree").jstree(true);
      var nodePath = data.node.id;
      for(var i=0; i<parentsLength; i++){
        var node = tree.get_node(parents[i]);
        breadcrumb = node.text + " / " + breadcrumb;
        nodePath += "_"+data.node.parents[i];
      }

      $(".modal-upload-file #nodePath").val(nodePath);
      
      $("#breadcrumb-folder").html(breadcrumb);
      if(parents.length > 2){
        $("#btnUploadFile").prop("disabled", false);
        $(".modal-upload-file #modal-root-upload").html(breadcrumb);
      }else{
        $("#btnUploadFile").prop("disabled", true); 
      }
      //alert(data.node.text);
    });
    
    jQuery(".loaderImage").hide();
  }

  function addFileUpload(){
    var fileUpload = arrFileUpload[arrFileUpload.length - 1] +1;
    var container = document.getElementById("fileUploadContainer")
    var element = document.createElement("div");
    element.setAttribute("class", "row fileUpload_"+fileUpload);
    element.setAttribute("style", "margin-bottom: 5px;");

    var inner = "";
    inner += "<div class='col-xs-11'>";
    inner += "  <div class='input-group' style='margin-bottom:0;'>";
    inner += "    <span class='input-group-btn'>";
    inner += "      <span class='btn btn-default btn-file btn-choose' id='btnFile_"+fileUpload+"'>";
    inner += "        Choose File <input type='file' id='fileUpload_"+fileUpload+"' name='fileUpload_"+fileUpload+"'>";
    inner += "      </span>";
    inner += "    </span>";
    inner += "    <input type='text' class='form-control' style='background: #FFF;' readonly>";
    inner += "  </div>";
    inner += "</div>";
    inner += "<div class='col-xs-1'>";
    inner += "  <div class='form-group' style='margin-bottom:0;'>";
    inner += "    <div class='input-group' style='margin-bottom:0;'>";
    inner += "      <div class='div-action'>";
    inner += "        <div style='padding-left:0px; margin-top:5px;'>";
    inner += "          <i class='material-icons' onclick='removeFileUpload("+fileUpload+");'>delete</i>";
    inner += "        </div>";                                                                 
    inner += "      </div>";
    inner += "    </div>";
    inner += "  </div>";
    inner += "</div>";
    inner += "<div class='col-xs-12'>";
    inner += "  <input type='hidden' id='fileUploadExist_"+fileUpload+"' name='fileUploadExist_"+fileUpload+"' value='0'>";
    inner += "</div>";

    element.innerHTML = inner;
    container.appendChild(element);
    
    $("#btnFile_"+fileUpload+" :file").on("change", function () {
      var id = this.id;
      var input = $(this);
      var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      
      input.trigger("fileselect", [label]);
    });
    
    $("#btnFile_"+fileUpload+" :file").on("fileselect", function (event, label) {
      event.prefentDefault;
      var id = this.id;
      var arrObject = id.split('_');
      var object = arrObject[1];
      var input = $(this).parents(".input-group").find(":text");

      if ($("#fileUpload_"+object).get(0).files.length === 0){
        alert("Please choose file");
        input.val("");
        $("#fileUploadExist_"+object).val(0);
      }else{
        var filesize = $("#fileUpload_"+object).get(0).files[0].size;
        var filetype = $("#fileUpload_"+object).get(0).files[0].type;
        if($.inArray(filetype, ["image/gif", "image/jpeg", "image/png"]) >= 0 && filesize > 5242880){
          alert("Image file must be less than 5MB");
          input.val("");
          $("#fileUploadExist_"+object).val(0);
        }else{
          var log = label;
          if (input.length) {
            input.val(log);
            $("#fileUploadExist_"+object).val(1);
          }
        }
      }
    });
    
    arrFileUpload.push(Number(fileUpload));
    $("#dataFileUpload").val(arrFileUpload);

    $("#formFileUpload").validate().destroy();
    $("#formFileUpload").validate({
      ignore: [],
      rules: (function() {
        results = {};
        for(var i = 0; i < arrFileUpload.length; i++) {
            results["fileUploadExist_"+i] = { checkFileUpload: true }
        }
        return results;
      })()
    });
  }

  function removeFileUpload(id){
    //$("#fileUpload_"+id).val("");
    $(".fileUpload_"+id).remove();
    var index = arrFileUpload.indexOf(id);
    console.log(index);
    if (index > -1) {
      arrFileUpload.splice(index, 1);
    }
    $("#dataFileUpload").val(arrFileUpload);
  }

  function clearUploadFileModal(){
    /*
    $(".modal-upload-file #title").val("");
    
    var today = "<?= date("m-Y"); ?>";
    $(".modal-upload-file #start_periode").val(today);
    $(".modal-upload-file #end_periode").val("");

    $(".modal-upload-file #description").val("");

    for(var i=1; i<arrFileUpload.length; i++){
      $("#fileUpload_"+i).val("");
      $(".fileUpload_"+i).remove();
    }

    var input = $("#fileUpload_0").parents(".input-group").find(":text");
    input.val("");
    $("#fileUpload_0").val("");
    
    arrFileUpload = [0];
    $("#dataFileUpload").val(arrFileUpload);
    */
    $("#formFileUpload")[0].reset();

    var today = "<?= date("m-Y"); ?>";
    $(".modal-upload-file #start_periode").val(today);

    for(var i=1; i<arrFileUpload.length; i++){
      $(".fileUpload_"+i).remove();
    }

    arrFileUpload = [0];
    $("#dataFileUpload").val(arrFileUpload);
    
  }
</script>