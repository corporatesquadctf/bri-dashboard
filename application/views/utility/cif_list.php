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
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('utility/Cif');?>">CIF</a></li>
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
                <!-- <button class="btn btn-default pull-left" title="Create CIF" onclick="create_CIF(); return true;">
                  <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i> Create CIF
                </button> -->
                <div  class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
        <?php
        $attributes = array('name' => 'search_txt', 'onsubmit' => 'return validateForm()' );
        echo form_open("utility/Cif/search_result", $attributes);
        ?>
                    <div class="input-group">
                        <input type="text" name="txtcari" id="txtcari" class="form-control" placeholder="Search for..." value="<?= ($txtcari) ? $txtcari : "" ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                  </form>
                </div>
                <div class="clearfix"></div>
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
                  <?php if (!empty($results)) { ?>
                    <table width="100%" id="table_CIF_lists" class="table">
                      <thead style="background-color: #FFFFFF; color: #218FD8;" >
                        <tr class="modal_table_title">
                          <!-- <th width="5%">No</th> -->
                          <th width="25%">Group Company</th>
                          <th width="25%">VCIF</th>
                          <th width="25%">Customer Name</th>
                          <th width="20%">CIF</th>
                          <th width="5%">Status</th>
                          <th width="5%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $index_CIF = 1; ?>
                        <?php foreach ($results as $CIF_id => $Cif_row) : ?>
                        <tr class="modal_table_list">
                          <!-- <td><?= $index_CIF ?></td> -->
                          <td>
                            <?= $Cif_row['CustomerGroupName']; ?>
                          </td>
                          <td><?= $Cif_row['VCIF'] ?></td>
                          <td><?= $Cif_row['CustomerName'] ?></td>
                          <td><?= $Cif_row['CIF'] ?></td>
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
                          </td>
                        </tr>
                        <?php $index_CIF++; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <div class="pull-left">
                      <?php if (isset($links)) { ?>
                      <?php echo $links ?>
                      <?php } ?>
                    </div>
                  <?php
                  } else {
                  ?>
                         <div>No data.</div>
                  <?php } ?>

              </div>
            </div>
          </div>
      </div>
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

<div id="modal-CIF" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="CifModalForm" method="POST" action="<?= site_url('utility/Cif/cif_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span id="modal_title_vcif"></span> <span id="modal_title_cifno"></span>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="VCIF">Customer Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select data-placeholder="Search VCIF" class="form-control col-md-6 col-xs-12 js-example-basic-single" id="VCIF_select" name="VCIF" style="width: 100%;" required="required">
                    <?php foreach ($vcif_list as $row => $value) : ?>
                      <option id="option_<?= $value['VCIF'] ?>" value="<?= $value['VCIF'] ?>"><?= $value['CustomerName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <!-- <div class="col-md-2 col-sm-2 col-xs-12">
                  <input type="checkbox" name="NewVCIF" id="NewVCIF" value="1" style="vertical-align: text-bottom;"> <span for="NewVCIF" style="vertical-align: -webkit-baseline-middle;" checked="false">VCIF Baru</span>
                </div> -->
              </div>
              <div class="form-group" id="CompanyName" style="display: none;">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="CompanyName">Nama VCIF Baru <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="CompanyName" name="CompanyName" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <!--
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="NameCIF">Nama Company (CIF) <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="NameCIF" name="NameCIF" required="required" class="form-control col-md-7 col-xs-12" value="">
                </div>
              </div>
              -->
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

<div id="confirmModalRemapping" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Remapping CIF Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="remapping_text">Are you sure??</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OKRemapping" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="ErrorModalRemapping" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" style="color: #d40000;"><i class="material-icons" style="vertical-align: middle;">error</i> Error !</h4>
      </div>
      <div class="modal-body" style="text-align: center; color: #000;">
        <p id="confirmation_text"></p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
  $(document).ready(function() {
  $('.js-example-basic-single').select2();
    // $('#CustomerGroupName').prop("disabled", true);
    // $('.js-example-basic-single').prop("required", true);

  })

  function confirmModalStatus(CIF) {
    var IsActive = $('#IsActive_'+CIF).val();
    var CompanyName = $('#IsActive_'+CIF).attr('CompanyName');

    if (IsActive == 1) {
      var statuses = 'InActive';
    }
    else {
      var statuses = 'Active';
    }
    $('#confirmModalStatus').modal('show');
    $("#confirmation_text_status").text('Set status '+ statuses + ' for ' + CompanyName + ' (' + CIF + ')?');
    $("#set_status").attr("CIF", CIF);
    $("#set_status").attr('IsActive_'+CIF, IsActive);
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

  function create_CIF() {
    $(document).ready(function() {
      $('#modal-CIF').modal('show');

      $('#modal_title_vcif').empty();
      $('#modal_title_cifno').empty();
      $('#CIF').removeAttr("value");
      $('#submit_type_cif').remove();
      $('#CIF').remove();

      $('.select2-selection__rendered').empty();
      $('#AccountPlanningId').remove();
      $('#IsCIFRemapping').remove();
      $('#oldVCIF').remove();

      //$("#NameCIF").removeAttr("value");
      $('#NewVCIF').prop("disabled", false);

      $('.js-example-basic-multiple').select2();

      var form = $('#CifModalForm');
      $(form).append('<input id="submit_type_cif" type="hidden" name="submit_type_cif" value="edit" /> ');
      $(form).append('<input id="CIF" type="hidden" name="CIF" value="'+CIF+'" /> ');
      $('#modal_title_vcif').append('<span id="modal_title_vcif">Add</span>');
      $('#modal_title_cifno').text('CIF');
      $("#OK").attr("confirmation_text1", "Your'e about to add new CIF details. <br> Are you sure?");
    })
  }

  function edit_CIF(CIF) {
    $(document).ready(function() {
      $('#modal-CIF').modal('show');
      $('.loaderImage').show();

      $('#modal_title_vcif').empty();
      $('#modal_title_cifno').empty();
      $('#CIF').removeAttr("value");
      $('#submit_type_cif').remove();
      $('#CIF').remove();

      $('.select2-selection__rendered').empty();
      $('#AccountPlanningId').remove();
      $('#IsCIFRemapping').remove();
      $('#oldVCIF').remove();

      //$("#NameCIF").removeAttr("value");
      $('#NewVCIF').prop("disabled", false);

      var form = $('#CifModalForm');
      $(form).append('<input id="submit_type_cif" type="hidden" name="submit_type_cif" value="edit" /> ');
      $(form).append('<input id="CIF" type="hidden" name="CIF" value="'+CIF+'" /> ');
      $('#modal_title_vcif').append('<span id="modal_title_vcif">Edit</span>');
      $("#OK").attr("confirmation_text1", "Your'e about to change CIF details. <br> Are you sure?");

      $.getJSON(base_url+'utility/Cif/getDetails/'+CIF, function (data){
        console.log(data);
        if(data.CIF != null){
          $("#CIF").attr("value", data.CIF);
          $(form).append('<input id="IsCIFRemapping" type="hidden" name="IsCIFRemapping" value="1" /> ');
          $('#modal_title_cifno').text(data.CIF);
        }
        if(data.IsActive != null){
          $(form).append('<input id="IsActive" type="hidden" name="IsActive" value="'+data.IsActive+'" /> ');
        }
        if(data.CompanyName != null){
          //$("#NameCIF").attr("value", data.CompanyName);
        }
        if(data.VCIF != null){
          $(form).append('<input id="oldVCIF" type="hidden" name="oldVCIF" value="'+data.VCIF+'" /> ');
          $(".select2-selection__rendered").attr("title", data.CustomerName);
          $(".select2-selection__rendered").text(data.CustomerName);
          $("#option_"+data.VCIF).attr("selected", "selected");
        }

        $('.js-example-basic-multiple').select2();

        $('.loaderImage').hide();
      })

    })
  }

  function confirmModal() {
    $('#modal-CIF').modal('hide');
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  $('#OK').click(function(){
    $.ajax({
      type: 'post',
      url : $('#CifModalForm').attr('action'),
      data: $('#CifModalForm').serialize(),
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

        PNotify.prototype.options.delay = 1800;
      },
      success: function(response){
        console.log(response.status);
        if(response.warning === 'warning'){
          new PNotify({
              title: 'Warning!',
              text: response.warning_message,
              type: 'warning',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;
        }

        if(response.status_remapping === 'success'){
          new PNotify({
              title: 'Success!',
              text: response.remapping_message,
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;
        }

        if(response.status === 'success'){
          new PNotify({
              title: 'Success!',
              text: 'Data Saved',
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;

          setTimeout(function(){ 
            $('.loaderImage').hide();
            window.location.href= base_url+'utility/Cif';
          }, 2000);

        }
        else if(response.status === 'error'){
          $('.loaderImage').hide();
          new PNotify({
              title: 'Response Error!',
              text: response.message,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;
        }
        else if(response.status === 'modal'){
          $('.loaderImage').hide();

          $('#ErrorModalRemapping').modal('show');
          var confirmation_text = response.message;
          $("#confirmation_text").html(confirmation_text);
        }
        else if(response.status === 'confirms'){
          $('.loaderImage').hide();
          $('.modal-backdrop fade in').hide();

          $('#confirmModalRemapping').modal('show');
          var remapping_text = response.message;
          $("#remapping_text").html(remapping_text);
        }
      }
    });
  });

  $('#OKRemapping').click(function(){
    $('#confirmModalRemapping').modal('hide');
    var form = $('#CifModalForm');
    $('#IsCIFRemapping').remove();
    $("#IsCIFRemapping").attr("value", 2);

    $.ajax({
      type: 'post',
      url : $('#CifModalForm').attr('action'),
      data: $('#CifModalForm').serialize(),
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

        PNotify.prototype.options.delay = 1800;
      },
      success: function(response){
        console.log(response.status);
        if(response.status_remapping === 'success'){
          new PNotify({
              title: 'Remapping CIF Success!',
              text: response.remapping_message,
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;

          setTimeout(function(){ 
            $('.loaderImage').hide();
            window.location.href= base_url+'utility/Cif';
          }, 2000);

        }
        if(response.status === 'success'){
          new PNotify({
              title: 'Update Data CIF Success!',
              text: 'Data Saved',
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;

          setTimeout(function(){ 
            $('.loaderImage').hide();
            window.location.href= base_url+'utility/Cif';
          }, 2000);

        }
        else if(response.status === 'error'){
          $('.loaderImage').hide();
          new PNotify({
              title: 'Response Error!',
              text: response.message,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1800;
        }
      }
    });
  });

</script>

