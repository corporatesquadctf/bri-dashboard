<style type="text/css">
  .detail_button_con {
    background: #218FD8; 
    padding-top: 3px; 
    text-align: center; 
    height: 30px; 
    border-radius: 0px 0px 4px 4px; 
    vertical-align: middle;
  }
  .detail_button, .detail_button:focus, .detail_button:hover {
    letter-spacing: 0.15px; 
    color: #fff; 
    font-size: 10px; 
    font-weight: bold; 
  }
  .img_logo {
    padding-right:2px; 
    width:100%; 
    height:100%; 
    vertical-align: bottom;
  }
  .detail_title {
    font-weight: 600;
    font-size: 16px;
    line-height: 22px;
    letter-spacing: 0.5px;
    color: #252525;
  }
  .detail_property_title {
    font-weight: 600;
    font-size: 14px;
    line-height: 136.89%;
    align-items: center;
    letter-spacing: 0.15px;
    color: #707070;
    vertical-align: middle;
  }
  .detail_property_title2 {
    font-weight: 600;
    font-size: 12px;
    line-height: 136.89%;
    align-items: center;
    letter-spacing: 0.15px;
    color: #707070;
    vertical-align: middle;
  }
  .modal_property_title {
    font-weight: 600;
    font-size: 14px;
    line-height: 34px;
    align-items: center;
    letter-spacing: 0.5px;
    color: #2980B9;
  }
  .modal_table_title {
    font-weight: 600;
    font-size: 14px;
    line-height: 22px;
    align-items: center;
    letter-spacing: 0.25px;
    color: rgba(0, 0, 0, 0.8);
  }
  .modal_table_list {
    font-weight: normal;
    font-size: 13px;
    line-height: 22px;
    align-items: center;
    letter-spacing: 0.15px;
    color: rgba(0, 0, 0, 0.8);
  }
  .detail_property_title_icon {
    font-size: 15px;
    color: #218FD8;
    vertical-align: middle;
    margin-left: -10px;
  }
  .detail_head_title_icon {
    font-weight: 600;
    font-size: 15px;
    color: #F58C38;
    vertical-align: middle;
    /*margin-left: -10px;*/
  }
  .detail_property_text {
    font-weight: normal;
    font-size: 12px;
    line-height: 22px;
    letter-spacing: 0.15px;
    color: #707070;
  }
  .detail_property_text2 {
    font-style: normal;
    font-weight: 600;
    font-size: 11px;
    line-height: 20px;
    letter-spacing: 0.15px;
    color: #218FD8;
    margin-left: -20px;
  }
  .detail_cont_header {
    background: #FFFFFF;
    border-radius: 4px;
    min-height: 120px;
    padding-top: 20px
  }
  .margintop_con {
    margin-top: 20px;
  }
  .marginleft_con {
    margin-left: 15px;
  }
  .paddingleft_con {
    padding-left: 15px;
  }
  .padding_con {
    padding: 15px;
  }
  .action_buttons, .action_buttons:hover, .action_buttons:focus {
    font-size: 12px; 
    line-height: 136.89%; 
    letter-spacing: 0.15px; 
    background: #F58C38; 
    border-radius: 2px; 
    color: #fff; 
    width: 210px; 
    height: 45px;
  }
  .x_panels {
    position: relative;
    width: 100%;
    margin-bottom: 0;
    padding: 0;
    display: inline-block;
    background: #fff;
    border: none;
  } 
  .x_contents {
      padding: 0 5px 6px;
      position: relative;
      width: 100%;
      float: left;
      clear: both;
      margin-top: 5px;
  }
</style>

<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Utility</li>
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('utility/Group');?>">Group Company</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Group Company</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-default pull-left" title="Create Group" onclick="create_group();">
                    <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i> Create Group
                  </button>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <div class="col-md-12 col-sm-12 col-xs-12">
                    <table width="100%" id="table_group_lists" class="table">
                      <thead style="background-color: #FFFFFF; color: #218FD8;" >
                        <tr class="modal_table_title">
                          <th width="5%">No</th>
                          <th width="10%">Logo</th>
                          <th width="20%">Group</th>
                          <th width="10%">Classification</th>
                          <th width="15%">Customer Type</th>
                          <th width="25%">Create/Modified</th>
                          <th width="15%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($results)) { ?>
                        <?php $index_group = 1; ?>
                        <?php foreach ($results as $group_id => $group_row) : ?>
                        <tr class="modal_table_list">
                          <td><?= $index_group ?></td>
                          <td><img class="img-responsive img-circle img_logo" src="<?php if (!file_exists ('uploads/CustomerGroupLogo/'.$group_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/default.png'); elseif (isset($group_row['Logo'])) echo base_url('uploads/CustomerGroupLogo/'.$group_row['Logo']); else echo base_url('uploads/CustomerGroupLogo/default.png'); ?>" style="width: 50px; height: 50px;"></td>
                          <td style="padding: 8px 0 0 0; height: 10px;">
                            <div class="x_panels">
                              <div class="x_title collapse-links" style="cursor: pointer; padding-bottom: 0;">
                                  <i class="fa fa-chevron-down pull-right" style="color:#218FD8;"></i>
                                  <label style="cursor: pointer;"><?= $group_row['CustomerGroupName']; ?></label>
                                  <div class="clearfix"></div>
                              </div>
                              <div class="x_contents" style="display: none; padding-bottom: 10px;">
                                <button class="btn btn-default btn-xs pull-right" title="Add Company" onclick="add_vcif('<?= $group_row['CustomerGroupId']; ?>'); return false;">
                                  <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i>
                                </button>
                                <ul>
                                <?php if (!empty($group_row['group_customer_list'])) { ?>
                                    <?php $index_vcif = 1;?>
                                    <?php foreach ($group_row['group_customer_list'] as $row => $value) : ?>
                                        <li><?= $value['CustomerName'] ?></li>
                                    <?php $index_vcif++;?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php } ?>
                              </div>
                            </div>
                          </td>
                          <td><?= $group_row['CustomerClassificationName'] ?></td>
                          <td><?= $group_row['CustomerTypeName'] ?></td>
                          <td>
                            <?php if (!empty($group_row['CreatedDate']) && !empty($group_row['CreatedBy'])) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
                              Created :
                              <br>
                              <i class="fa fa-calendar" title="Created Date" style="color:#218FD8;"></i> <b><?= $group_row['CreatedDate'] ?></b>      
                              <br>
                              <i class="fas fa-user-tie" title="Created By" style="color:#218FD8;"></i> <b><?= $group_row['CreatedBy'] ?></b>                              
                            </div>
                            <?php } ?>
                            <?php if (!empty($group_row['ModifiedDate']) && !empty($group_row['ModifiedBy'])) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              Modified :
                              <br>
                              <i class="fa fa-calendar" title="Modified Date" style="color:#f58c38;"></i> <b><?= $group_row['ModifiedDate'] ?></b>      
                              <br>
                              <i class="fas fa-user-tie" title="Modified By" style="color:#f58c38;"></i> <b><?= $group_row['ModifiedBy'] ?></b>                              
                            </div>
                            <?php } ?>
                          </td>
                          <td>
                            <button class="btn btn-default btn-success btn-xs" title="Edit Group" onclick="edit_group('<?= $group_row['CustomerGroupId']; ?>'); return false;" style=" width: 36px; height: 36px;">
                              <i class="material-icons" style="color: #FFFFFF; font-size: 18px; vertical-align: sub;">edit</i>
                            </button>
                            <button class="btn btn-default btn-xs" title="Upload Logo Group" onclick="upload_logo('<?= $group_row['CustomerGroupId']; ?>'); return false;" style=" width: 36px; height: 36px;">
                              <i class="material-icons" style="font-size: 18px; vertical-align: sub;">cloud_upload</i>
                            </button>
                          </td>
                        </tr>
                        <?php $index_group++; ?>
                        <?php endforeach; ?>
                        <?php } ?>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
      </div>
    </div>

  </div>
</div>

<div id="upload-logo" class="modal fade upload-logo" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="LogoModalForm" method="POST" action="<?= site_url('utility/Group/upload_proc') ?>" enctype="multipart/form-data">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">cloud_upload</i> <span id="modal_title"></span> Group <span id="GroupName_title"></span>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Logo Group <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="logo-group" type="file" name="logo_group" accept="image/*" placeholder="Pilih Logo Group" class="form-control col-md-7 col-xs-12" style="border: 1px solid #ccc; width: 100%; margin-bottom: 20px;" required="">
                  <ul class="small">
                    <li>Max size : 5MB</li>
                    <li>Max width : 1024px</li>
                    <li>Max height : 1024px</li>
                    <li>Filetype: gif, jpg, jpeg, png</li>
                  </ul>
                  <!-- <sub >Max size : 5MB, Max width : 1024px, Max height : 1024px, Filetype: gif|jpg|jpeg|png </sub> -->
                </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <!-- <button class="btn btn-warning w150" type="submit" id="btn-save">Save</button> -->
              <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModalLogo(); return false;">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div id="modal-group" class="modal fade modal-group" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="GroupModalForm" method="POST" action="<?= site_url('utility/Group/group_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span><span id="modal_title"></span> Group</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Group Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="Name" name="Name" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="Description" name="Description" class="form-control col-md-7 col-xs-12" rows="4" style="width: 100%; height: 100%;"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Classification">Classification</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select data-placeholder="Search Group" class="form-control col-md-6 col-xs-12 js-example-basic-single" id="ClassificationId_select" name="ClassificationId" style="width: 100%;" required="required">
                    <?php foreach ($classification_list as $row => $value) : ?>
                      <option id="option_<?= $value['ClassificationId'] ?>" Name="<?= $value['Name'] ?>" value="<?= $value['ClassificationId'] ?>"><?= $value['Name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CustomerTypeId">Customer Type</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select data-placeholder="Search Group" class="form-control col-md-6 col-xs-12 js-example-basic-single" id="CustomerTypeId_select" name="CustomerTypeId" style="width: 100%;" required="required">
                    <?php foreach ($CustomerType_list as $row => $value) : ?>
                      <option id="CustomerType_<?= $value['CustomerTypeId'] ?>" Name="<?= $value['CustomerTypeName'] ?>" value="<?= $value['CustomerTypeId'] ?>"><?= $value['CustomerTypeName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <!-- <button class="btn btn-warning w150" type="submit" id="btn-save">Save</button> -->
              <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModal(); return false;">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div id="modal-vcif" class="modal fade modal-vcif" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="VcifModalForm" method="POST" action="<?= site_url('utility/Group/vcif_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span><span id="modal_title_vcif"></span> VCIF</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="VCIF">VCIF <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="VCIF" name="VCIF" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div> -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NameVCIF">VCIF Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="NameVCIF" name="NameVCIF" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DescriptionVCIF">Description VCIF</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="DescriptionVCIF" name="DescriptionVCIF" class="form-control col-md-7 col-xs-12" rows="4" style="width: 100%; height: 100%;"></textarea>
                </div>
              </div> -->
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <!-- <button class="btn btn-warning w150" type="submit" id="btn-save">Save</button> -->
              <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModalVCIF(); return false;">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>

<div id="confirmModalVCIF" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text_vcif">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK-VCIF" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModalLogo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text_logo">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK-logo" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  // $('#GroupModalForm').on('submit', function (e) {
  //   e.preventDefault();
  //   if(confirm('Anda yakin?')) {
  $('#OK-logo').click(function(){
      var url = $('#LogoModalForm').attr('action');
      var fileData = $('#logo-group').prop('files');
      var CustomerGroupId = $('#CustomerGroupId').prop('value');
      var oldLogo = $('#oldLogo').prop('value');

      // console.log(fileData);
      // console.log(CustomerGroupId);
      // console.log(oldLogo);

      var formData = new FormData(LogoModalForm);

      formData.append('file', fileData);
      formData.append('CustomerGroupId', CustomerGroupId);
      formData.append('oldLogo', oldLogo);

      $.ajax({
        type: 'post',
        url : url,
        data: formData,
        dataType : 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function(){
          $('#confirmModalLogo').modal('hide');
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('.loaderImage').hide();
          new PNotify({
              title: 'Error Thrown!',
              text: "Message : "+errorThrown,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;
        },
        success: function(response){
          console.log(response.status);
          console.log(response.message);
          if(response.status === 'success'){
            $('.loaderImage').hide();
            $('#modal-group').modal('hide');
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;

            setTimeout(function(){ 
              window.location.href= base_url+'utility/Group';
            }, 2000);

          }else if(response.status === 'error'){
            $('.modal-backdrop').hide();
            $('.loaderImage').hide();
            new PNotify({
                title: 'Response Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
            setTimeout(function(){ 
              window.location.href= base_url+'utility/Group';
            }, 2000);
          }
        }
      });
    // }
  });

  $('#OK').click(function(){
      $.ajax({
        type: 'post',
        url : $('#GroupModalForm').attr('action'),
        data: $('#GroupModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('#confirmModal').modal('hide');
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('.loaderImage').hide();
          new PNotify({
              title: 'Error Thrown!',
              text: "Message : "+errorThrown,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;
        },
        success: function(response){
          if(response.status === 'success'){
            $('.loaderImage').hide();
            $('#modal-group').modal('hide');
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;

            setTimeout(function(){ 
              window.location.href= base_url+'utility/Group';
            }, 2000);

          }else if(response.status === 'error'){
            $('.modal-backdrop').hide();
            $('.loaderImage').hide();
            new PNotify({
                title: 'Response Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
          }
        }
      });
    // }
  });

  // $('#VcifModalForm').on('submit', function (e) {
  //   e.preventDefault();
  //   if(confirm('Anda yakin?')) {
  $('#OK-VCIF').click(function(){
      $.ajax({
        type: 'post',
        url : $('#VcifModalForm').attr('action'),
        data: $('#VcifModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('#confirmModalVCIF').modal('hide');
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log(jqXHR);
          $('.loaderImage').hide();
          new PNotify({
              title: 'Error Thrown!',
              text: "Message : "+errorThrown,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;
        },
        success: function(response){
          if(response.status === 'success'){
            $('#modal-vcif').modal('hide');
            $('.loaderImage').hide();
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;

            setTimeout(function(){ 
              window.location.href= base_url+'utility/Group';
            }, 2000);

          }else if(response.status === 'error'){
            $('.loaderImage').hide();
            new PNotify({
                title: 'Response Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
          }
        }
      });
    // }
  });

  function upload_logo(CustomerGroupId) {
    $(document).ready(function() {
      $('.loaderImage').show();

      $('#upload-logo').modal('show');
      $('#modal_title').text('Upload Logo');
      $('#submit_type').remove();
      $('#oldLogo').remove();
      $('#CustomerGroupId').remove();

      var form = $('#LogoModalForm');
      $(form).append('<input id="submit_type" type="hidden" name="submit_type" value="upload_logo" /> ');
      $(form).append('<input id="CustomerGroupId" type="hidden" name="CustomerGroupId" value="' + CustomerGroupId + '" /> ');
      $(form).append('<input id="oldLogo" type="hidden" name="oldLogo" value="" /> ');

      $.getJSON(base_url+'utility/Group/getDetails/'+CustomerGroupId, function (data){
        console.log(data);
        // if(data.CustomerGroupName != null){
          $('#GroupName_title').text(data.CustomerGroupName);
        // }
        if(data.Logo != null){
          $('#oldLogo').remove();
          $(form).append('<input id="oldLogo" type="hidden" name="oldLogo" value="'+data.Logo+'" /> ');
        }

        $('.loaderImage').hide();
      })

    })
  }

  function add_vcif(CustomerGroupId) {
    $(document).ready(function() {
      $('#modal-vcif').modal('show');

      $('#modal_title_vcif').empty();
      $('#CustomerGroupId').remove();
      $('#submit_type_vcif').remove();

      $("#VCIF").removeAttr("value");
      $("#NameVCIF").removeAttr("value");
      // $('#DescriptionVCIF').empty();

      var form = $('#VcifModalForm');
      $(form).append('<input id="CustomerGroupId" type="hidden" name="CustomerGroupId" value="'+CustomerGroupId+'" /> ');
      $(form).append('<input id="submit_type_vcif" type="hidden" name="submit_type_vcif" value="add" /> ');
      $('#modal_title_vcif').append('<span id="modal_title_vcif">Add</span>');
      $("#OK-VCIF").attr("confirmation_text_vcif", "Your'e about to add new VCIF details to Group. <br> Are you sure?");
    })
  }

  function create_group() {
    $(document).ready(function() {
      $('#modal-group').modal('show');

      $('#modal_title').empty();
      $('#CustomerGroupId').remove();
      $('#submit_type').remove();
      $("#Name").removeAttr("value");
      $('#Description').empty();

      var form = $('#GroupModalForm');
      $(form).append('<input id="submit_type" type="hidden" name="submit_type" value="add" /> ');

      $('#modal_title').append('<span id="modal_title">Create</span>');
      $("#OK").attr("confirmation_text1", "Your'e about to add new Group details. <br> Are you sure?");
    })
  }

  function confirmModalLogo() {
    $('#upload-logo').hide('show');
    $('#confirmModalLogo').modal('show');
    var confirmation_text_logo = "Your'e about to Upload Group logo. <br> Are you sure?";
    $("#confirmation_text_logo").html(confirmation_text_logo);
  }

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function confirmModalVCIF() {
    $('#confirmModalVCIF').modal('show');
    var confirmation_text_vcif = $('#OK-VCIF').attr('confirmation_text_vcif');
    $("#confirmation_text_vcif").html(confirmation_text_vcif);
  }

  function edit_group(CustomerGroupId) {
    $(document).ready(function() {
      $('#modal-group').modal('show');
      $('.loaderImage').show();

      $('#modal_title').empty();
      $('#CustomerGroupId').remove();
      $('#submit_type').remove();
      $("#Name").removeAttr("value");
      $('#Description').empty();

      $('.select2-selection__rendered').empty();
      $('#oldClassificationId').remove();
      $('#oldCustomerClassificationName').remove();

      var form = $('#GroupModalForm');
      $(form).append('<input id="CustomerGroupId" type="hidden" name="CustomerGroupId" value="'+CustomerGroupId+'" /> ');
      $(form).append('<input id="submit_type" type="hidden" name="submit_type" value="edit" /> ');

      $('#modal_title').append('<span id="modal_title">Edit</span>');
      $("#OK").attr("confirmation_text1", "Your'e about to change Group details. <br> Are you sure?");

      $.getJSON(base_url+'utility/Group/getDetails/'+CustomerGroupId, function (data){
        console.log(data);
        if(data.CustomerGroupName != null){
          $("#Name").attr("value", data.CustomerGroupName);
        }
        if(data.CustomerGroupDescription != null || data.CustomerGroupDescription != ''){
          $('#Description').append(data.CustomerGroupDescription);
        }
        if(data.ClassificationId != null){
          $(form).append('<input id="oldClassificationId" type="hidden" name="oldClassificationId" value="'+data.ClassificationId+'" /> ');
          $(form).append('<input id="oldCustomerClassificationName" type="hidden" name="oldCustomerClassificationName" value="'+data.CustomerClassificationName+'" /> ');
          $(".select2-selection__rendered").attr("title", data.CustomerClassificationName);
          $(".select2-selection__rendered").text(data.CustomerClassificationName);
          $("#option_"+data.ClassificationId).attr("selected", "selected");
        }

        if(data.CustomerTypeId != null){
          $(form).append('<input id="oldCustomerTypeId" type="hidden" name="oldCustomerTypeId" value="'+data.CustomerTypeId+'" /> ');
          $(form).append('<input id="oldCustomerTypeName" type="hidden" name="oldCustomerTypeName" value="'+data.CustomerTypeName+'" /> ');
          $(".select2-selection__rendered").attr("title", data.CustomerTypeName);
          $(".select2-selection__rendered").text(data.CustomerTypeName);
          $("#CustomerType_"+data.CustomerTypeId).attr("selected", "selected");
        }

        $('.loaderImage').hide();
      })

    })
  }

  $(document).ready(function() {

    $('#table_group_lists').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });

    $('#table_group_lists tbody').on('click', '.collapse-links', function () {
        var $BOX_PANEL = $(this).closest('.x_panels'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_contents');
        
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200); 
            $BOX_PANEL.css('height', 'auto');  
        } else {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

  });

</script>

