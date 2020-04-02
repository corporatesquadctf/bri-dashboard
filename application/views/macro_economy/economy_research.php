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
  .form_action .btn_save:hover {
    background-color: #c4702c;
  }
  .form_action .btn_save:active {
    border-color: #F58C38;
    background-color: #f9ba87;
  }
  .form_action .btn_save:focus {
    border-color: #F58C38;
    background-color: #f9ba87;
  }
  .form_action .btn_save:active:focus {
    border-color: #F58C38;
  }
  .macro-analysis-container{
    text-align: center;
  }
  .macro-analysis{
    width: 100px; height:100px; border-radius: 10px; padding: 0; margin: 0;
  }
  .macro-analysis:focus{
    border-color: #89B6EC;
  }
  .pin{
    cursor: pointer;
  }
  .macro-analysis .x_title{
    padding: 0;
  }
  .macro-analysis .nav{
    min-width: 0;
  }
  .download-macro-analysis{
    position: absolute;
    right:0;
    bottom: 0;
    cursor: pointer;
  }
  .macro-analysis-context-menu{
    min-width:0;
  }
  .macro-analysis-context-menu>li>a{
    width: 100%; float: right; font-size: 10px;
  }
  .macro-analysis-content{
    height: calc(100% - 30px); margin: 0; padding: 0;
  }
  .image-zip{
    height: 40px;
  }
  .macro-analysis-container .title-container{
    margin: 8px 0 20px 0;
  }
  .macro-analysis-title{
    font-size: 12px; color: #000;
  }
  .detail-header{
    padding:0 10px; margin-bottom: 10px; display:none;
  }
  .table-detail-analysis::-webkit-scrollbar-track
  {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }
  .table-detail-analysis::-webkit-scrollbar
  {
    width: 7px;
    background-color: #F5F5F5;
  }
  .table-detail-analysis::-webkit-scrollbar-thumb
  {
    background-color: #218FD8;
  }
  .detail-img{
    text-align: center;
    display: none;
  }
  .detail-title{
    font-weight: 600;
    font-size: 14px;
    text-align: center;
    color: #000;
    margin-bottom: 20px;
  }
  .table-detail-analysis{
    display: none;
    width: 100%; color: #000; font-size: 13px; border-spacing: 0 5px; border-collapse: separate;
  }
</style>

<?php $this->load->view("macro_economy/file_upload"); ?>
<?php $this->load->view("macro_economy/move_analysis"); ?>

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
      <div class="col-xs-12 col-sm-3" style="min-height: inherit; padding:10px;">
        <div class="row" style="min-height: inherit; background-color: #FFF; margin-right: 0; padding: 10px;">
          <div class="col-xs-12" style="padding:0 10px; margin-bottom: 10px;">
            <button id="btnCreateDirectory" class="btn btn-primary" type="button" style="width: 100%;" disabled>Create Analysis Directory</button>
          </div>
          <div id="tree_container" class="col-xs-12" style="height: 435px; overflow-y: auto;">
            <div id="sector_economy_tree" class="scrollbar"></div>
          </div>
        </div>
      </div>
      
      <div class="col-xs-12 col-sm-6" style="min-height: inherit; padding:10px;">
        <div class="row" style="min-height: inherit; background-color: #FFF; margin-right: 0; padding: 10px;">
          <div class="col-xs-12" style="padding:0 10px; margin-bottom: 10px;">
            <label id="breadcrumb-folder" style="font-size: 14px; color: #000000;"></label>
          </div>
          <div id="analysis_container" class="col-xs-12" style="height: 435px; overflow-y: auto;">
            <div class="row" id="analysis_directory">
              <!--
              <div class="col-xs-4 macro-analysis-container">
                <div class="x_panel tile macro-analysis" tabindex="-1">
                  <div class="x_title">
                    <div class="pull-left">
                      <img class="pin" src="<?= base_url("assets/images/icons/pin.svg"); ?>" />
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img src="<?= base_url("assets/images/icons/more.svg"); ?>" />
                        </a>
                        <ul class="dropdown-menu macro-analysis-context-menu" role="menu">
                          <li><a class="move-analysis" href="#">Move</a></li>
                          <li><a class="delete-analysis" href="#">Delete</a></li>
                          <li><a class="upload-file-analysis" href="#">Upload File</a></li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content macro-analysis-content">
                    <img src="<?= base_url("assets/images/icons/zip.svg"); ?>" class="image-zip" />
                    <div class="download-macro-analysis" style="">
                      <img src="<?= base_url("assets/images/icons/download.svg"); ?>" />
                    </div>
                  </div>
                </div>
                <div class="title-container">
                  <div class="macro-analysis-title">Lorem ipsum dolor sit amet Lorem ipsum dolor</div>
                </div>
              </div>
              -->
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-3" style="min-height: inherit; padding:10px;">
        <div class="row" style="min-height: inherit; background-color: #FFF; padding: 10px;">
          <div class="col-xs-12 detail-header">
            <label style="font-weight: 600; font-size: 24px; color: #8F8F8F;">Detail</label>
          </div>
          <div id="detail-container" class="col-xs-12" style="height: 435px;">
            <div class="row">
              <div class="col-xs-12 form-group  detail-img">
                <img src="<?= base_url("assets/images/icons/detail-zip.svg"); ?>" />
              </div>
              <div class="col-xs-12 form-group detail-title">
                <label id="detail-title"></label>
              </div>
              <div class="col-xs-12 form-group">
                <table class="table-detail-analysis" style="height: 250px; overflow-y: auto;">
                  <tr>
                    <td style="width: 35%; vertical-align: top;">Created By</td>
                    <td style="padding-left: 5px; vertical-align: top;">:</td>
                    <td style="padding-left: 5px;" id="detail-createdBy"></td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;">Created Date</td>
                    <td style="padding-left: 5px; vertical-align: top;">:</td>
                    <td style="padding-left: 5px;" id="detail-createdDate"></td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;">Periode</td>
                    <td style="padding-left: 5px; vertical-align: top;">:</td>
                    <td style="padding-left: 5px;" id="detail-periode"></td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;">Location</td>
                    <td style="padding-left: 5px; vertical-align: top;">:</td>
                    <td style="padding-left: 5px;" id="detail-nodePath"></td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;">Description</td>
                    <td style="padding-left: 5px; vertical-align: top;">:</td>
                    <td style="padding-left: 5px;" id="detail-description"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
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

  <div class="modal fade modal-create-directory" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="formCreateDirectory" name="formCreateDirectory" method="post" action="<?= base_url("macro_economy/economy_research/processCreateAnalysis"); ?>">          
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Analysis Directory</h4>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-bottom: 15px;">
            <div class="col-xs-12">
              <label style="font-weight: 600; font-size: 14px; color: #000000;">Tambah Direktori Analisis di :</label>
              <label id="modal-root-upload" style="font-weight: normal; font-size: 14px; color: #000000;"></label>
              <input type="hidden" id="nodePath" name="nodePath" value="" />
              <input type="hidden" id="node" name="node" value="" />
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
              <label style="font-weight: 600; font-size: 16px; color: #000000;">Periode (Awal - Akhir) :</label><br/>
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
        </div>
        <div class="modal-footer form_action" style="padding: 15px;">
          <button type="button" class="btn w150 btn-default btn_cancel" data-dismiss="modal">Cancel</button>
          <button id="btnSaveDirectory" type="button" class="btn w150 btn_save btn-primary modal-button-ok">Save</button>
        </div>        
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade modal-delete-analysis" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="macroEconomyAnalysisId" val="" />
          <input type="hidden" id="node" val="" />
          <p>You want to delete <label id="title"></label>. Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="btnDeleteAnalysis" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-pin-analysis" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="macroEconomyAnalysisId" val="" />
          <input type="hidden" id="node" val="" />
          <input type="hidden" id="pin" val="" />
          <p>You want to <label id="label-pinn" style="font-weight: 400;"></label> <label id="title"></label>. Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="btnPinAnalysis" type="button" class="btn w150 btn-primary modal-button-ok">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/jstree/dist/jstree.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
  var today = "<?= date("Y-m"); ?>";
  $(document).ready(function(){
    
    /* Start Tree Section */
    initTreeview();
    
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
          }, 2000); 
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
          }, 2000); 
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
    /* End Tree Section */

    /* Start Directory Modal Section */
    $("#start_periode").datetimepicker({
      useCurrent: false,
      minDate: today,
      format: "MM-YYYY",
      viewMode: "years",
      ignoreReadonly: true
    });

    $("#end_periode").datetimepicker({
      useCurrent: false,
      minDate: today,
      format: "MM-YYYY",
      viewMode: "years",
      ignoreReadonly: true
    });

    $("#btnCreateDirectory").click(function(){
      clearCreateDirectoryModal();
      var tree = $("#sector_economy_tree").jstree(true);
      if(typeof tree.get_selected(true)[0] !== 'undefined'){
        var data = tree.get_selected(true)[0].id;
        $(".modal-create-directory").modal("show");
      }
    });

    $("#btnSaveDirectory").click(function(e){
      var node = $(".modal-create-directory #node").val();
      if($("#formCreateDirectory").valid()){
        e.preventDefault();
        $.ajax({
          type: "post",
          url : $("#formCreateDirectory").attr("action"),
          data: $("#formCreateDirectory").serialize(),
          dataType : "json",
          beforeSend:function(){
            $(".modal-create-directory").modal("hide");
            $(".loaderImage").show();
          },
          success: function(response){
            $(".loaderImage").hide();
            if(response.status === "success"){
              new PNotify({
                  title: "Success!",
                  text: "Analysis Directory has been created.",
                  type: "success",
                  styling: "bootstrap3"
              });
              PNotify.prototype.options.delay = 1200;             
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
              selectNode(node);
            }, 2000); 
          }
        });
      }
    });
    /* End Directory Modal Section */

    $("#btnDeleteAnalysis").click(function(e){
      e.preventDefault();
      var macroEconomyAnalysisId = $(".modal-delete-analysis #macroEconomyAnalysisId").val();
      var node = $(".modal-delete-analysis #node").val();
      $.ajax({
        type: "post",
        url : "<?= base_url("macro_economy/economy_research/serviceDeleteAnalysis"); ?>",
        data: {
          "macroEconomyAnalysisId" : macroEconomyAnalysisId
        },
        dataType : "json",
        beforeSend:function(){
          $(".modal-delete-analysis").modal("hide");
        },
        success: function(response){
          if(response.status === "success"){
            new PNotify({
              title: "Success!",
              text: "Analysis Directory has been deleted.",
              type: "success",
              styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
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
            selectNode(node);
          }, 1500); 
        }
      });
      
    });

    $("#btnPinAnalysis").click(function(e){
      e.preventDefault();
      var macroEconomyAnalysisId = $(".modal-pin-analysis #macroEconomyAnalysisId").val();
      var pin = $(".modal-pin-analysis #pin").val();
      var node = $(".modal-pin-analysis #node").val();
      $.ajax({
        type: "post",
        url : "<?= base_url("macro_economy/economy_research/servicePinAnalysis"); ?>",
        data: {
          "macroEconomyAnalysisId" : macroEconomyAnalysisId,
          "pin" : pin
        },
        dataType : "json",
        beforeSend:function(){
          $(".modal-pin-analysis").modal("hide");
        },
        success: function(response){
          if(response.status === "success"){
            new PNotify({
              title: "Success!",
              text: response.message,
              type: "success",
              styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
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
            selectNode(node);
          }, 1500); 
        }
      });
      
    });

    $("#btnMoveAnalysis").click(function(e){
      e.preventDefault();
      var macroEconomyAnalysisId = $(".modal-move-analysis #macroEconomyAnalysisId").val();
      var currentNode = $(".modal-move-analysis #currentNode").val();
      var destinationNode = $(".modal-move-analysis #destinationNode").val();
      $.ajax({
        type: "post",
        url : "<?= base_url("macro_economy/economy_research/serviceMoveAnalysis"); ?>",
        data: {
          "MacroEconomyAnalysisId" : macroEconomyAnalysisId,
          "CurrentNode" : currentNode,
          "DestinationNode" : destinationNode,
        },
        dataType : "json",
        beforeSend:function(){
          $(".modal-move-analysis").modal("hide");
        },
        success: function(response){
          if(response.status === "success"){
            new PNotify({
              title: "Success!",
              text: "Analysis Directory has been moved.",
              type: "success",
              styling: "bootstrap3"
            });
            PNotify.prototype.options.delay = 1200;
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
            selectNode(destinationNode);
          }, 1500); 
        }
      });
    });
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

  function initPrimaryTreeview(){
    jQuery(".loaderImage").show();
    $.getJSON("<?= base_url("macro_economy/economy_research/serviceGetPrimaryTreeData"); ?>", function (data){
      drawPrimaryTreeview(data);   
    });
  }

  function drawPrimaryTreeview(data){
    $(".modal-move-analysis #move-tree").jstree("destroy").empty();
    var tree =  $("#move-tree").jstree({
      "core" : {
        "check_callback": false,
        "data" : data
      }
    });
    
    tree.bind("loaded.jstree", function (event, data) {
        $(this).jstree("open_all");
    });
    
    tree.on("select_node.jstree", function(event, data){
      var parents = data.node.parents;
      var node = data.node.id;

      if(parents.length > 2){
        $("#btnMoveAnalysis").prop("disabled", false);
        $(".modal-move-analysis #destinationNode").val(data.node.id);
      }else{
        $("#btnMoveAnalysis").prop("disabled", true); 
      }
    });
    
    jQuery(".loaderImage").hide();
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
      <?php if($this->session->ROLE_ID == USER_ROLE_SUPER_USER){ ?>
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
      <?php } ?>
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

      $(".detail-header").css("display","none");
      $(".detail-img").css("display","none");
      $(".detail-title").css("display","none");
      $(".table-detail-analysis").css("display","none");

      /* Start Config Create Directory Modal */
      if(parents.length > 2 && <?php echo $this->session->ROLE_ID; ?> == <?php echo USER_ROLE_SUPER_USER; ?>){
        $("#btnCreateDirectory").prop("disabled", false);
        $(".modal-create-directory #node").val(data.node.id);
        $(".modal-create-directory #modal-root-upload").html(breadcrumb);
      }else{
        $("#btnCreateDirectory").prop("disabled", true); 
      }
      $(".modal-create-directory #nodePath").val(nodePath);
      /* End Config Create Directory Modal */

      initAnalysis(data.node.id);
      
      /* Start Config Node Directory */
      $("#breadcrumb-folder").html(breadcrumb);
      /* End Config Node Directory */
    });
    
    jQuery(".loaderImage").hide();
  }

  function clearCreateDirectoryModal(){
    $("#formCreateDirectory")[0].reset();

    var today = "<?= date("m-Y"); ?>";
    $(".modal-create-directory #start_periode").val(today);
  }

  function initAnalysis(id){
    jQuery(".loaderImage").show();
    var url = "<?= base_url("macro_economy/economy_research/"); ?>";
    switch(id){
      case "2": url += "serviceGetMyFiles/"+id; break;
      case "3": url += "serviceGetRecentAnalysis/"+id; break;
      case "4": url += "serviceGetPinAnalysis/"+id; break;
      default: url += "serviceGetAnalysis/"+id; break;
    }
    $.getJSON(url, function (data){
      showAnalysis(data);   
    });
  }

  function showAnalysis(data){
    $("#analysis_directory").empty();
    if(data.length > 0){
      //console.log(data);
      var element = "";
      $.each(data, function(key, value){
        var icon = "pin.svg";
        if(value.Pinned == 1) icon = "blue-pin.svg" ;
        element += "<div class='col-xs-4 macro-analysis-container'>";
        element += "  <div class='x_panel tile macro-analysis' tabindex='-1' onclick='showDetailAnalysis("+value.MacroEconomyAnalysisId+")'>";
        element += "    <div class='x_title'>";
        element += "      <div class='pull-left'>";
        element += "        <img class='pin' src='<?= base_url('assets/images/icons/'); ?>"+icon+"' data-id='"+value.MacroEconomyAnalysisId+"' data-node='"+value.MacroEconomyId+"' data-name='"+value.Title+"' data-pinn='"+value.Pinned+"' />";
        element += "      </div>";
        <?php if($this->session->ROLE_ID == USER_ROLE_SUPER_USER) { ?>
        element += "      <ul class='nav navbar-right panel_toolbox'>";
        element += "        <li class='dropdown'>";
        element += "          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>";
        element += "            <img src='<?= base_url('assets/images/icons/more.svg'); ?>' />";
        element += "          </a>";
        element += "          <ul class='dropdown-menu macro-analysis-context-menu' role='menu'>";
        element += "            <li><a class='move-analysis' data-id='"+value.MacroEconomyAnalysisId+"' data-node='"+value.MacroEconomyId+"' data-name='"+value.Title+"' href='#'>Move</a></li>";
        element += "            <li><a class='delete-analysis' data-id='"+value.MacroEconomyAnalysisId+"' data-node='"+value.MacroEconomyId+"' data-name='"+value.Title+"' href='#'>Delete</a></li>";
        element += "            <li><a class='upload-file-analysis' data-id='"+value.MacroEconomyAnalysisId+"' data-nodepath='"+value.NodePath+"' href='#'>Manage File</a></li>";
        element += "          </ul>";
        element += "        </li>";
        element += "      </ul>";
        <?php } ?>
        element += "      <div class='clearfix'></div>";
        element += "    </div>";
        element += "    <div class='x_content macro-analysis-content'>";
        element += "      <img src='<?= base_url('assets/images/icons/zip.svg'); ?>' class='image-zip' />";
        element += "      <div class='download-macro-analysis' style=''>";
        element += "        <a href='<?= base_url('macro_economy/economy_research/downloadAnalysis/');?>"+value.MacroEconomyAnalysisId+"' target='_blank'><img src='<?= base_url('assets/images/icons/download.svg'); ?>' /></a>";
        element += "      </div>";
        element += "    </div>";
        element += "  </div>";
        element += "  <div class='title-container'>";
        element += "    <div class='macro-analysis-title'>"+value.Title+"</div>";
        element += "  </div>";
        element += "</div>";
      });
    }
    $("#analysis_directory").append(element);
    
    $(".pin").click(function(e){
      var id = $(this).data("id");
      var node = $(this).data("node");
      var title = $(this).data("name");
      var pinn = $(this).data("pinn");
      if(pinn == 1) {
        var label_pin = "Unpin";
        var pin = 0;
      }else{
        var label_pin = "Pin";
        var pin = 1;
      }
      $(".modal-pin-analysis #macroEconomyAnalysisId").val(id);
      $(".modal-pin-analysis #node").val(node);
      $(".modal-pin-analysis #pin").val(pin);
      $(".modal-pin-analysis #title").html(title);
      $(".modal-pin-analysis #label-pinn").html(label_pin);
      $(".modal-pin-analysis").modal("show");
    });

    $(".move-analysis").click(function(e){
      var id = $(this).data("id");
      var node = $(this).data("node");
      var title = $(this).data("name");
      initPrimaryTreeview();
      $("#btnMoveAnalysis").prop("disabled", true); 
      $(".modal-move-analysis #macroEconomyAnalysisId").val(id);
      $(".modal-move-analysis #currentNode").val(node);
      $(".modal-move-analysis").modal("show");
    });

    $(".delete-analysis").click(function(e){
      var id = $(this).data("id");
      var node = $(this).data("node");
      var title = $(this).data("name");
      $(".modal-delete-analysis #macroEconomyAnalysisId").val(id);
      $(".modal-delete-analysis #node").val(node);
      $(".modal-delete-analysis #title").html(title);
      $(".modal-delete-analysis").modal("show");
    });

    $(".upload-file-analysis").click(function(e){
      var id = $(this).data("id");
      var nodepath = $(this).data("nodepath");
      loadFileUpload(id);
      $(".modal-file-upload #macroEconomyAnalysisId").val(id);
      $(".modal-file-upload #rootPath").html(nodepath);
      $(".modal-file-upload #btnFile").val("");
      $(".modal-file-upload #btnFile").parents(".input-group").find(":text").val("");
      $(".modal-file-upload #btnUpload").prop("disabled", true);
      $(".modal-file-upload").modal("show");
    });
    jQuery(".loaderImage").hide();
  }

  function showDetailAnalysis(id){
    var breadcrumb = $("#breadcrumb-folder").html();
    //jQuery(".loaderImage").show();
    $.getJSON("<?= base_url("macro_economy/economy_research/serviceGetDetailAnalysis/"); ?>"+id, function (data){
      $(".detail-header").css("display","block");
      $(".detail-img").css("display","block");

      $("#detail-title").html(data.Title);
      $(".detail-title").css("display","block");
      
      $(".table-detail-analysis").css("display","block");
      $("#detail-createdBy").html(data.CreatedByName);
      $("#detail-createdDate").html(data.CreatedDate);
      $("#detail-periode").html(data.Periode);
      $("#detail-nodePath").html(data.NodePath);
      $("#detail-description").html(data.Description);
      //jQuery(".loaderImage").hide();    
    });
    
  }

  function loadFileUpload(id){
    jQuery(".loaderImage").show();
    $(".table-file-upload").empty();
    var element = "";
    $.getJSON("<?= base_url("macro_economy/economy_research/serviceGetFileUpload/"); ?>"+id, function (data){
      if(data.length > 0){
        $.each(data, function(key, value){
          element += "<tr>";
          element += "    <td style='font-size: 12px; color: #707070; width: 90%;'>"+value.Name+"</td>";
          element += "    <td style='font-size: 12px; color: #707070; width: 10%;'>";
          element += "      <div class='form-group' style='margin-bottom:0;'>";
          element += "        <div class='input-group pull-right' style='margin-bottom:0;'>";
          element += "          <div class='div-action'>";
          element += "            <div style='padding-left:0px;'>";
          element += "              <i class='material-icons' style='font-size: 20px;' onclick='removeFileUpload("+value.MacroEconomyFileId+");'>delete</i>";
          element += "            </div>";                                                                 
          element += "          </div>";
          element += "        </div>";
          element += "      </div>";
          element += "    </td>";
          element += "</tr>";
        });
      }
      $(".table-file-upload").append(element);
      jQuery(".loaderImage").hide();
    });      
  }

  function removeFileUpload(id){
    var macroEconomyAnalysisId = $(".modal-file-upload #macroEconomyAnalysisId").val();
    var form_data = new FormData();
        form_data.append("macroEconomyFileId", id);
        $.ajax({
          type: "post",
          url: "<?php echo base_url()."macro_economy/economy_research/serviceRemoveFileUpload"; ?>",
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success	: function (data){
            if(data.status != "error"){
              new PNotify({
                  title: "Success!",
                  text: "File successfully deleted.",
                  type: "success",
                  styling: "bootstrap3"
              });
              PNotify.prototype.options.delay = 1200;
              loadFileUpload(macroEconomyAnalysisId);
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