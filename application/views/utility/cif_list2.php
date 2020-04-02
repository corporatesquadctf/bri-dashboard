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

  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 30px;
    height: 17px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 13px;
    width: 13px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(13px);
    -ms-transform: translateX(13px);
    transform: translateX(13px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 17px;
  }

  .slider.round:before {
    border-radius: 50%;
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
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('utility/CIF');?>">CIF</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">CIF</div>
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
                  <button class="btn btn-default pull-left" title="Create CIF" onclick="create_CIF();">
                    <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i> Create CIF
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
                    <table width="100%" id="table_CIF_lists" class="table">
                      <thead style="background-color: #FFFFFF; color: #218FD8;" >
                        <tr class="modal_table_title">
                          <th width="5%">No</th>
                          <th width="15%">CIF</th>
                          <th width="25%">Name</th>
                          <th width="25%">Customer</th>
                          <th width="5%">Status</th>
                          <th width="20%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($results)) { ?>
                        <?php $index_CIF = 1; ?>
                        <?php foreach ($results as $CIF_id => $Cif_row) : ?>
                        <tr class="modal_table_list">
                          <td><?= $index_CIF ?></td>
                          <td><?= $Cif_row['CIF'] ?></td>
                          <td>
                            <?= $Cif_row['CompanyName']; ?>
                          </td>
                          <td><?= $Cif_row['CustomerName'] ?></td>
                          <td align="center">
                          <?php
                          $checked = '';
                          if ($Cif_row['IsActive'] == 1) {
                            $checked = ' checked';
                          }

                          ?>
                            <label class="switch">
                              <input type="checkbox" id="IsActive_<?= $Cif_row['CIF']; ?>" value="<?= $Cif_row['IsActive']; ?>" CompanyName="<?= $Cif_row['CompanyName']; ?>" onchange="confirmModalStatus('<?= $Cif_row['CIF']; ?>'); return false;"<?= $checked ?>>
                              <span class="slider round"></span>
                            </label>

                          </td>
                          <td>
                            <button class="btn btn-default btn-success btn-xs" title="Edit CIF" onclick="edit_CIF('<?= $Cif_row['CIF']; ?>'); return false;">
                              <i class="material-icons" style="color: #FFFFFF; font-size: 14px; vertical-align: sub;">edit</i>
                            </button>
                            <button class="btn btn-default btn-xs" title="Add CIF" onclick="add_cif('<?= $Cif_row['CIF']; ?>'); return false;">
                              <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i> CIF
                            </button>
                            <button class="btn btn-default btn-xs" title="Mass Upload CIF" onclick="window.location.href='<?= base_url('utility/CIF/mass_upload_cif/'.$Cif_row['CIF']); ?>'">
                              <i class="material-icons" style="font-size: 14px; vertical-align: sub;">cloud_upload</i> Upload CIF
                            </button>
                          </td>
                        </tr>
                        <?php $index_CIF++; ?>
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

<div id="modal-CIF" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="CIFModalForm" method="POST" action="<?= site_url('utility/CIF/CIF_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span><span id="modal_title_CIF"></span> CIF</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="CIF">Group <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select data-placeholder="Search Group" class="form-control col-md-6 col-xs-12 js-example-basic-single" id="CustomerGroupId_select" name="CustomerGroupId" style="width: 100%;" required="required">
                    <?php foreach ($group_list as $row => $value) : ?>
                      <option id="option_<?= $value['CustomerGroupId'] ?>" value="<?= $value['CustomerGroupId'] ?>"><?= $value['CustomerName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <input type="checkbox" name="NewGroup" id="NewGroup" value="1" style="vertical-align: text-bottom;"> <span for="NewGroup" style="vertical-align: -webkit-baseline-middle;" checked="false">Group Baru</span>
                </div>
              </div>
              <div class="form-group" id="CustomerName" style="display: none;">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="CustomerName">Nama Group Baru <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="CustomerName" name="CustomerName" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="CIF">CIF <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="CIF" name="CIF" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="NameCIF">Nama Customer (CIF) <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="NameCIF" name="NameCIF" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Status Nasabah</label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 8px;">
                  <div id="IsExisting" class="btn-group" data-toggle="buttons">
                    <input type="radio" name="IsExisting" id="IsExisting1" value="1" checked="" required> <span for="IsExisting1" style="vertical-align: top;">Nasabah</span>
                    <input type="radio" name="IsExisting" id="IsExisting0" value="0" style="margin-left: 30px; margin-top: 5px;" required> <span for="IsExisting0" style="vertical-align: top;">Calon Nasabah</span>
                  </div>
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


<div id="modal-CIF" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="CIFModalForm" method="POST" action="<?= site_url('utility/CIF/cif_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span><span id="modal_title_cif"></span> CIF</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body cif-add-field">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CIF_1">CIF <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="CIF_1" name="CIF[]" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NameCIF_1">Nama CIF <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="NameCIF_1" name="NameCIF[]" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div> -->
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button id="button_upload_cif" class="btn btn-default" title="Mass Upload CIF">
                <i class="material-icons" style="font-size: 14px; vertical-align: sub;">cloud_upload</i> Upload CIF
              </button>
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <button class="btn btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_cif_fields();" Title="Add New Row">ADD ROW</button>
              <button class="btn btn-warning w150" type="submit" id="btn-save">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>


<div id="confirmModalStatus" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text_status">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="set_status" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
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
        <p id="confirmation_text">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmModalCIF" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK-CIF" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  $(document).ready(function() {
    $('#table_CIF_lists').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });

    $('.js-example-basic-single').select2();
    // $('#CustomerName').prop("disabled", true);
    // $('.js-example-basic-single').prop("required", true);

    $("#NewGroup").on("click", function(){
      if ($('#NewGroup').prop('checked')) {
        $('#CustomerName').show();
        $('.js-example-basic-single').prop("disabled", true);

        // $('#CustomerName').prop("disabled", false);
        // $('.js-example-basic-single').prop("required", false);
      }
      else {
        $('#CustomerName').hide();
        $('.js-example-basic-single').prop("disabled", false);

        // $('#CustomerName').prop("disabled", true);
        // $('.js-example-basic-single').prop("required", true);
      }
    });

  })


  function add_cif_fields(){
    $(document).ready(function() {
      var div_modal = $('.cif-add-field');

      $(div_modal).append('<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="CIF_1">CIF <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="CIF_1" name="CIF[]" class="form-control col-md-7 col-xs-12" value=""></div></div>');

    });
  }

  function create_CIF() {
    $(document).ready(function() {
      $('#modal-CIF').modal('show');

      $('#modal_title_CIF').empty();
      $('#CIF').removeAttr("value");
      $('#submit_type_CIF').remove();

      // $('.select2-selection__rendered').empty();
      $('#oldCustomerGroupId').remove();

      $("#NameCIF").removeAttr("value");

      $('.js-example-basic-multiple').select2();

      var form = $('#CIFModalForm');
      $(form).append('<input id="submit_type_CIF" type="hidden" name="submit_type_CIF" value="add" /> ');
      // $('#modal_title_CIF').append('<span id="modal_title_CIF">Create</span>');
      $('#modal_title_CIF').append('<span id="modal_title_CIF">Create</span>');
      $("#OK").attr("confirmation_text", "Add New CIF?");
    })
  }

  function edit_CIF(CIF) {
    $(document).ready(function() {
      $('#modal-CIF').modal('show');
      $('.loaderImage').show();

      $('#modal_title_CIF').empty();
      $('#CIF').removeAttr("value");
      $('#submit_type_CIF').remove();

      $('.select2-selection__rendered').empty();
      $('#oldCustomerGroupId').remove();

      $("#NameCIF").removeAttr("value");

      $('#IsExisting1').prop("checked", false);
      $('#IsExisting0').prop("checked", false);

      var form = $('#CIFModalForm');
      $(form).append('<input id="submit_type_CIF" type="hidden" name="submit_type_CIF" value="edit" /> ');
      $('#modal_title_CIF').append('<span id="modal_title_CIF">Edit</span>');
      $("#OK").attr("confirmation_text", "Edit CIF?");

      $.getJSON(base_url+'utility/CIF/getDetails/'+CIF, function (data){
        console.log(data);
        if(data.CIF != 'null'){
          $("#CIF").attr("value", data.CIF);
        }
        if(data.CompanyName != 'null'){
          $("#NameCIF").attr("value", data.CompanyName);
        }
        if(data.CustomerCIFDescription != 'null' || data.CustomerCIFDescription != ''){
          $('#DescriptionCIF').append(data.CustomerCIFDescription);
        }
        if(data.CustomerGroupId != 'null' || data.CustomerGroupId != ''){
          $(form).append('<input id="oldCustomerGroupId" type="hidden" name="oldCustomerGroupId" value="'+data.CustomerGroupId+'" /> ');
          $(".select2-selection__rendered").attr("title", data.CustomerName);
          $(".select2-selection__rendered").text(data.CustomerName);
          $("#option_"+data.CustomerGroupId).attr("selected", "selected");
        }
        if(data.IsExisting == 1){
          $('#IsExisting1').prop("checked", true);
          $('#IsExisting0').prop("checked", false);
        }
        if(data.IsExisting == 0){
          $('#IsExisting1').prop("checked", false);
          $('#IsExisting0').prop("checked", true);
        }

        $('.js-example-basic-multiple').select2();

        $('.loaderImage').hide();
      })

    })
  }

  function confirmModal() {
    $('#modal-CIF').modal('hide');
    $('#confirmModal').modal('show');
    var confirmation_text = $('#OK').attr('confirmation_text');
    $("#confirmation_text").text(confirmation_text);
  }

  // $('#CIFModalForm').on('submit', function (e) {
    // e.preventDefault();
    // if(confirm('Anda yakin?')) {
  $('#OK').click(function(){
      $.ajax({
        type: 'post',
        url : $('#CIFModalForm').attr('action'),
        data: $('#CIFModalForm').serialize(),
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

          PNotify.prototype.options.delay = 1200;
        },
        success: function(response){
          console.log(response.status);
          if(response.status === 'success'){
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;

            setTimeout(function(){ 
              $('.loaderImage').hide();
              window.location.href= base_url+'utility/CIF';
            }, 2000);

          }else if(response.status === 'error'){
            $('.loaderImage').hide();
            new PNotify({
                title: 'Response Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;
          }
        }
      });
    // }
  });

  function confirmModalStatus(CIF) {
    var IsActive = $('#IsActive_'+CIF).val();
    var CompanyName = $('#IsActive_'+CIF).attr('CompanyName');

    $('#confirmModalStatus').modal('show');
    $("#confirmation_text_status").text('Set Status ' + CompanyName + ' (' + CIF + ')?');
    $("#set_status").attr("CIF", CIF);
    $("#set_status").attr("IsActive", IsActive);
  }

  $('#set_status').click(function(){
    $(document).ready(function() {
      var CIF = $('#set_status').attr('CIF');
      var IsActive = $('#set_status').attr('IsActive_'+CIF);
        $.ajax({type: "GET",
            url: "<?= base_url('utility/CIF/set_status/')?>" + CIF + "/" + IsActive,
            beforeSend: function() {
                $('.loaderImage').show();
            },
            error: function(jqXHR, textStatus, errorThrown){
              console.log(jqXHR);
              $('.loaderImage').hide();
              new PNotify({
                  title: 'Error!',
                  text: "Message : "+errorThrown,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
            },
            success:function(response) {
              console.log(response);

              new PNotify({
                  title: 'Success!',
                  text: 'Set Status CIF '+response+'.',
                  type: response,
                  styling: 'bootstrap3'
              });
              
              PNotify.prototype.options.delay = 1200;
              $('.loaderImage').hide();
              $('#confirmModalStatus').modal('hide');
            }
        });
    })
  });

  function add_cif(CIF) {
    $(document).ready(function() {
      $('#modal-CIF').modal('show');

      $('#modal_title_cif').empty();
      $('#button-upload-cif').remove();
      $('#CIF_cif').remove();
      $('#submit_type_cif').remove();

      $("#CIF").removeAttr("value");
      $("#NameCIF").removeAttr("value");
      // $('#DescriptionCIF').empty();
      var upload_url = base_url+'utility/CIF/mass_upload_cif/'+CIF;

      $("#button_upload_cif").attr("onclick", 'window.location.href=\''+upload_url+'\'');

      var form = $('#CIFModalForm');
      $(form).append('<input id="CIF_cif" type="hidden" name="CIF" value="'+CIF+'" /> ');
      $(form).append('<input id="submit_type_cif" type="hidden" name="submit_type_cif" value="add" /> ');
      $('#modal_title_cif').append('<span id="modal_title_cif">Add</span>');
    })
  }


  function confirmModalCIF() {
    $('#CIFModalForm').modal('hide');
    $('#confirmModalCIF').modal('show');
    $("#confirmation_text").text('Add new CIF?');
  }


  $('#CIFModalForm').on('submit', function (e) {
    e.preventDefault();
    if(confirm('Anda yakin?')) {
      $.ajax({
        type: 'post',
        url : $('#CIFModalForm').attr('action'),
        data: $('#CIFModalForm').serialize(),
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

          PNotify.prototype.options.delay = 1200;
        },
        success: function(response){
          console.log(response.status);
          if(response.status === 'success'){
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;

            setTimeout(function(){ 
              $('.loaderImage').hide();
              window.location.href= base_url+'utility/CIF';
            }, 2000);

          }else if(response.status === 'error'){
            $('.loaderImage').hide();
            new PNotify({
                title: 'Response Error!',
                text: response.message,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;
          }
        }
      });
    }
  });

</script>

