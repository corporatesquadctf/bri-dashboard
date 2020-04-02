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
                      <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('utility/Vcif');?>">Vcif Company</a></li>
                  </ol>
                </nav>
                <div class="x_title">
                    <div class="page_title">
                        <div class="pull-left">Vcif Company</div>
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
                  <button class="btn btn-default pull-left" title="Create Vcif" onclick="create_Vcif();">
                    <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i> Create Vcif
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
                    <table width="100%" id="table_Vcif_lists" class="table">
                      <thead style="background-color: #FFFFFF; color: #218FD8;" >
                        <tr class="modal_table_title">
                          <th width="5%">No</th>
                          <!-- <th width="10%">VCIF</th> -->
                          <th width="30%">Name</th>
                          <th width="20%">Group</th>
                          <th width="15%">Status Nasabah</th>
                          <th width="5%">Status</th>
                          <th width="5%">Group Main</th>
                          <th width="10%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($results)) { ?>
                        <?php $index_Vcif = 1; ?>
                        <?php foreach ($results as $Vcif_id => $Vcif_row) : ?>
                        <tr class="modal_table_list">
                          <td><?= $index_Vcif ?></td>
                          <!-- <td><?= $Vcif_row['VCIF'] ?> - <?= $Vcif_row['isVCIFMainAP'] ?></td> -->
                          <td>
                            <?= $Vcif_row['CustomerName']; ?>
                          </td>
                          <td><?= $Vcif_row['CustomerGroupName'] ?></td>
                          <td>
                            <?php 
                            $IsExisting = 'Calon Nasabah';
                            if ($Vcif_row['IsExisting'] == 1) {
                              $IsExisting = 'Nasabah';
                            }
                            ?>
                            <?= $IsExisting ?>
                          </td>
                          <td align="center">
                          <?php
                          $checked = '';
                          if ($Vcif_row['IsActive'] == 1) {
                            $checked = ' checked';
                          }

                          ?>
                            <label class="switch">
                              <input type="checkbox" id="IsActive_<?= $Vcif_row['VCIF']; ?>" value="<?= $Vcif_row['IsActive']; ?>" CustomerName="<?= $Vcif_row['CustomerName']; ?>" onchange="confirmModalStatus('<?= $Vcif_row['VCIF']; ?>'); return false;"<?= $checked ?>>
                              <span class="slider round"></span>
                            </label>

                          </td>
                          <td align="center">
                          <?php
                          $checked = '';
                          if ($Vcif_row['IsMain'] == 1) {
                            $checked = ' checked';
                          }

                          ?>
                            <label class="switch">
                              <input type="checkbox" id="IsMain_<?= $Vcif_row['VCIF']; ?>" value="<?= $Vcif_row['IsMain']; ?>" CustomerName="<?= $Vcif_row['CustomerName']; ?>" onchange="confirmModalIsMain('<?= $Vcif_row['VCIF']; ?>', '<?= $Vcif_row['CustomerGroupId']; ?>'); return false;"<?= $checked ?>>
                              <span class="slider round"></span>
                            </label>

                          </td>
                          <td>
                            <button class="btn btn-default btn-success btn-xs" title="Edit Vcif" onclick="edit_Vcif('<?= $Vcif_row['VCIF']; ?>'); return false;">
                              <i class="material-icons" style="color: #FFFFFF; font-size: 14px; vertical-align: sub;">edit</i>
                            </button>
                            <?php if ($Vcif_row['IsExisting'] == 1) { ?>
                            <button class="btn btn-default btn-xs" title="Add CIF" onclick="add_cif('<?= $Vcif_row['VCIF']; ?>'); return false;">
                              <i class="material-icons" style="font-size: 14px; vertical-align: sub;">add_circle</i> CIF
                            </button>
                            <!--
                            <button class="btn btn-default btn-xs" title="Mass Upload CIF" onclick="window.location.href='<?= base_url('utility/Vcif/mass_upload_cif/'.$Vcif_row['VCIF']); ?>'">
                              <i class="material-icons" style="font-size: 14px; vertical-align: sub;">cloud_upload</i> Upload CIF
                            </button>
                            -->
                            <?php } ?>
                          </td>
                        </tr>
                        <?php $index_Vcif++; ?>
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

<div id="modal-VCIF" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="VcifModalForm" method="POST" action="<?= site_url('utility/Vcif/vcif_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span><span id="modal_title_vcif"></span> VCIF</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="VCIF">Group <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select data-placeholder="Search Group" class="form-control col-md-6 col-xs-12 js-example-basic-single" id="CustomerGroupId_select" name="CustomerGroupId" style="width: 100%;" required="required">
                    <?php foreach ($group_list as $row => $value) : ?>
                      <option id="option_<?= $value['CustomerGroupId'] ?>" CustomerGroupName="<?= $value['CustomerGroupName'] ?>" value="<?= $value['CustomerGroupId'] ?>"><?= $value['CustomerGroupName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <input type="checkbox" name="NewGroup" id="NewGroup" value="1" style="vertical-align: text-bottom;"> <span for="NewGroup" style="vertical-align: -webkit-baseline-middle;" checked="false">Group Baru</span>
                </div>
              </div>
              <div class="form-group" id="CustomerGroupName" style="display: none;">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="CustomerGroupName">Nama Group Baru <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="CustomerGroupName" name="CustomerGroupName" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="NameVCIF">Nama Customer (VCIF) <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="NameVCIF" name="NameVCIF" class="form-control col-md-7 col-xs-12" value="" required="required" >
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
              <!-- <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Group Main Company</label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 8px;">
                  <div id="IsMainGroup" class="btn-group" data-toggle="buttons">
                    <input type="radio" name="IsMainGroup" id="IsMainGroup1" value="1" checked="" required> <span for="IsMainGroup1" style="vertical-align: top;">Yes</span>
                    <input type="radio" name="IsMainGroup" id="IsMainGroup0" value="0" style="margin-left: 30px; margin-top: 5px;" required> <span for="IsMainGroup0" style="vertical-align: top;">No</span>
                  </div>
                </div>
              </div> -->
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
          <form class="form-horizontal form-label-left cmxform" id="CifModalForm" method="POST" action="<?= site_url('utility/Vcif/cif_proc') ?>">
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
                  <input type="text" id="CIF_1" name="CIF" required="required" class="form-control col-md-7 col-xs-12" value="" maxlength="10">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CIF_1">Name
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="CIF_1Name" name="CIFName" readonly class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <!--
              <button id="button_upload_cif" class="btn btn-default" title="Mass Upload CIF">
                <i class="material-icons" style="font-size: 14px; vertical-align: sub;">cloud_upload</i> Upload CIF
              </button>
              -->
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <!--
              <button class="btn btn-default btn_cancel" type="button" style="width: 200px;" onclick="add_cif_fields();" Title="Add New Row">ADD ROW</button>
              -->
              <!-- <button class="btn btn-warning w150" type="submit" id="btn-save">Save</button> -->
              <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModalCif(); return false;">Save</button>
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

<div id="confirmModalIsMain" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text_main">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="set_main" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
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
          <h4 class="modal-title" id="myModalLabel">Remapping VCIF Confirmation</h4>
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

<div id="confirmModalCif" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text_cif">Are you sure?</p>
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
    $('#table_Vcif_lists').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });

    $('.js-example-basic-single').select2();
    // $('#CustomerGroupName').prop("disabled", true);
    // $('.js-example-basic-single').prop("required", true);

    $("#NewGroup").on("click", function(){
      if ($('#NewGroup').prop('checked')) {
        $('#CustomerGroupName').show();
        $('.js-example-basic-single').prop("disabled", true);

        // $('#CustomerGroupName').prop("disabled", false);
        // $('.js-example-basic-single').prop("required", false);
      }
      else {
        $('#CustomerGroupName').hide();
        $('.js-example-basic-single').prop("disabled", false);

        // $('#CustomerGroupName').prop("disabled", true);
        // $('.js-example-basic-single').prop("required", true);
      }
    });

    $("#CIF_1").change(function(){
      var cifId = $(this).val();
      getCustomerInformation(cifId);
    });

    $("#CifModalForm").validate({
      ignore: [],
      rules: {
        CIF: {
          required: true
        },
        CIFName: {
          required: true
        }
      },
      messages:{
        CIFName: {
          required: "Customer is not found"
        }
      }
    });
  })

  function getCustomerInformation(cifId=""){
    $(".loaderImage").show();
    $.getJSON("<?= base_url();?>"+'logins/checkCustomer/'+cifId, function (data){
      if(data["success"] == true){
        var rsCompany = data["data"];
        var companyName = rsCompany[0]["NAMA"];
        $("#CIF_1Name").val(companyName);
      }else{
        $("#CIF_1Name").val("");
      }
      $(".loaderImage").hide();
    }).fail(function(jqXHR) {
        $(".loaderImage").hide();
        $("#modal-CIF").modal("hide");
        $(".modal-error-notification #error-messages").html("Error Code: "+jqXHR.status+"<br/>Error Status:  "+jqXHR.statusText+"<br/>Error Messages: Connection to BRISTARS is not established.");
        $(".modal-error-notification").modal("show");
    });            
  }

  function clearModal(modalType){
    $("#CIF_1").val("");
    $("#CIF_1Name").val("");
  }


  function add_cif_fields(){
    $(document).ready(function() {
      var div_modal = $('.cif-add-field');
      
      // var value = parseInt(document.getElementById('rownumber').value, 10);
      // value = isNaN(value) ? 0 : value;
      // value++;
      // document.getElementById('rownumber').value = value;
      // var rownumber = value;

      // alert(rownumber);


      $(div_modal).append('<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="CIF_1">CIF <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="CIF_1" name="CIF[]" class="form-control col-md-7 col-xs-12" value="" maxlength="10"></div></div>');
      // $(div_modal).append('<input type="hidden" id="rownumber" value="'+rownumber+'">');

    });
  }

  function create_Vcif() {
    $(document).ready(function() {
      $('#modal-VCIF').modal('show');

      $('#modal_title_vcif').empty();
      $('#VCIF').removeAttr("value");
      $('#submit_type_vcif').remove();

      // $('.select2-selection__rendered').empty();
      $('#oldCustomerGroupId').remove();

      $("#NameVCIF").removeAttr("value");
      $('#NewGroup').prop("disabled", false);

      $('.js-example-basic-multiple').select2();

      var form = $('#VcifModalForm');
      $(form).append('<input id="submit_type_vcif" type="hidden" name="submit_type_vcif" value="add" /> ');
      // $('#modal_title_vcif').append('<span id="modal_title_vcif">Create</span>');
      $('#modal_title_vcif').append('<span id="modal_title_vcif">Create</span>');
      $("#OK").attr("confirmation_text1", "Your'e about to Add New VCIF. <br> Are you sure?");
    })
  }

  function edit_Vcif(VCIF) {
    $(document).ready(function() {
      $('#modal-VCIF').modal('show');
      $('.loaderImage').show();

      $('#modal_title_vcif').empty();
      $('#VCIF').removeAttr("value");
      $('#submit_type_vcif').remove();
      $('#isVCIFMainAP').remove();
      $('#oldVCIF').remove();

      $('.select2-selection__rendered').empty();
      $('#isVCIFMainAP').remove();
      $('#AccountPlanningId').remove();
      $('#IsAccountPlanningExist').remove();
      $('#oldCustomerGroupId').remove();
      $('#oldCustomerGroupName').remove();
      $('#oldIsExisting').remove();

      $("#NameVCIF").removeAttr("value");
      $('#NewGroup').prop("disabled", false);

      $('#IsExisting1').prop("checked", false);
      $('#IsExisting0').prop("checked", false);
      $('#IsExisting1').prop("disabled", false);
      $('#IsExisting0').prop("disabled", false);

      var form = $('#VcifModalForm');
      $(form).append('<input id="submit_type_vcif" type="hidden" name="submit_type_vcif" value="edit" /> ');
      $(form).append('<input id="oldVCIF" type="hidden" name="oldVCIF" value="'+VCIF+'" /> ');
      $('#modal_title_vcif').append('<span id="modal_title_vcif">Edit</span>');
      $("#OK").attr("confirmation_text1", "Your'e about to change VCIF details. <br> Are you sure?");

      $.getJSON(base_url+'utility/Vcif/getDetails/'+VCIF, function (data){
        console.log(data);
        if(data.VCIF != null){
          $("#VCIF").attr("value", data.VCIF);
        }
        if(data.AccountPlanningId != null){
          $(form).append('<input id="AccountPlanningId" type="hidden" name="AccountPlanningId" value="'+data.AccountPlanningId+'" /> ');
          $(form).append('<input id="IsAccountPlanningExist" type="hidden" name="IsAccountPlanningExist" value="1" /> ');
        }
        if(data.CustomerName != null){
          $("#NameVCIF").attr("value", data.CustomerName);
        }
        if(data.CustomerVcifDescription != null || data.CustomerVcifDescription != ''){
          $('#DescriptionVCIF').append(data.CustomerVcifDescription);
        }
        if(data.CustomerGroupId != null){
          $(form).append('<input id="oldCustomerGroupId" type="hidden" name="oldCustomerGroupId" value="'+data.CustomerGroupId+'" /> ');
          $(form).append('<input id="oldCustomerGroupName" type="hidden" name="oldCustomerGroupName" value="'+data.CustomerGroupName+'" /> ');
          $(".select2-selection__rendered").attr("title", data.CustomerGroupName);
          $(".select2-selection__rendered").text(data.CustomerGroupName);
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
        if(data.IsMainGroup == 1){
          $('#IsMainGroup1').prop("checked", true);
          $('#IsMainGroup0').prop("checked", false);
        }
        if(data.IsMainGroup == 0){
          $('#IsMainGroup1').prop("checked", false);
          $('#IsMainGroup0').prop("checked", true);
        }
        if(data.IsMainGroup == null){
          $('#IsMainGroup1').prop("checked", false);
          $('#IsMainGroup0').prop("checked", true);
        }
        if(data.IsMain == 1){
          $(form).append('<input id="oldIsExisting" type="hidden" name="oldIsExisting" value="'+data.IsExisting+'" /> ');
          $(form).append('<input id="isVCIFMainAP" type="hidden" name="isVCIFMainAP" value="'+data.IsMain+'" /> ');
          $('#NewGroup').prop("disabled", true);
          $('#IsExisting1').prop("disabled", true);
          $('#IsExisting0').prop("disabled", true);
        }

        $('.js-example-basic-multiple').select2();

        $('.loaderImage').hide();
      })

    })
  }

  function confirmModal() {
    // $('#modal-VCIF').modal('hide');
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  $('#OKRemapping').click(function(){
    var form = $('#VcifModalForm');
    $("#IsAccountPlanningExist").attr("value", 2);

    $.ajax({
      type: 'post',
      url : $('#VcifModalForm').attr('action'),
      data: $('#VcifModalForm').serialize(),
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
        console.log(response.status);
        if(response.status_remapping === 'success'){
          new PNotify({
              title: 'Remapping VCIF Success!',
              text: 'Data Saved',
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;

          setTimeout(function(){ 
            $('.loaderImage').hide();
            window.location.href= base_url+'utility/Vcif';
          }, 2000);

        }
        if(response.status === 'success'){
          $('.loaderImage').hide();
          new PNotify({
              title: 'Update Data VCIF Success!',
              text: 'Data Saved',
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;

          setTimeout(function(){ 
            window.location.href= base_url+'utility/Vcif';
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

          PNotify.prototype.options.delay = 3000;
        }
      }
    });
  });

  $('#OK').click(function(){
    $.ajax({
      type: 'post',
      url : $('#VcifModalForm').attr('action'),
      data: $('#VcifModalForm').serialize(),
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
        console.log(response.status);
        if(response.warning === 'warning'){
          new PNotify({
              title: 'Warning!',
              text: response.warning_message,
              type: 'warning',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;
        }

        if(response.status === 'success'){
          $('#modal-VCIF').modal('hide');
          $('.loaderImage').hide();
          new PNotify({
              title: 'Success!',
              text: 'Data Saved',
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 3000;

          setTimeout(function(){ 
            window.location.href= base_url+'utility/Vcif';
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

          PNotify.prototype.options.delay = 3000;
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

  function confirmModalIsMain(VCIF, CustomerGroupId) {
    var IsMain = $('#IsMain_'+VCIF).val();
    var CustomerName = $('#IsMain_'+VCIF).attr('CustomerName');

    $('#confirmModalIsMain').modal('show');
    $("#confirmation_text_main").html('Your\'e about to change Group Main Company details. <br>Are you sure?');
    $("#set_main").attr("VCIF", VCIF);
    $("#set_main").attr("CustomerGroupId", CustomerGroupId);
    $("#set_main").attr("IsMain_"+VCIF, IsMain);
  }

  $('#set_main').click(function(){
    $(document).ready(function() {
      var VCIF = $('#set_main').attr('VCIF');
      var CustomerGroupId = $('#set_main').attr('CustomerGroupId');
      var IsMain = $('#set_main').attr('IsMain_'+VCIF);
      $.ajax({type: "GET",
          url: "<?= base_url('utility/Vcif/set_main/')?>" + VCIF + "/" + IsMain + "/" + CustomerGroupId,
          beforeSend: function() {
              $('.loaderImage').show();
          },
          error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown);
            $('.loaderImage').hide();
            new PNotify({
                title: 'Error!',
                text: "Message : "+errorThrown,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
          },
          success:function(response) {
            console.log(response);

            new PNotify({
                title: 'Success!',
                text: 'Set Main Group Success.',
                type: 'success',
                styling: 'bootstrap3'
            });
            
            PNotify.prototype.options.delay = 3000;
            $('.loaderImage').hide();
            $('#confirmModalIsMain').modal('hide');
            setTimeout(function(){ 
              window.location.href= base_url+'utility/Vcif';
            }, 2000);
          }
      });
    })
  });

  function confirmModalStatus(VCIF) {
    var IsActive = $('#IsActive_'+VCIF).val();
    var CustomerName = $('#IsActive_'+VCIF).attr('CustomerName');

    $('#confirmModalStatus').modal('show');
    $("#confirmation_text_status").text('Set Status ' + CustomerName + ' (' + VCIF + ')?');
    $("#set_status").attr("VCIF", VCIF);
    $("#set_status").attr("IsActive_"+VCIF, IsActive);
  }

  $('#set_status').click(function(){
    $(document).ready(function() {
      var VCIF = $('#set_status').attr('VCIF');
      var IsActive = $('#set_status').attr('IsActive_'+VCIF);
      $.ajax({type: "GET",
          url: "<?= base_url('utility/Vcif/set_status/')?>" + VCIF + "/" + IsActive,
          beforeSend: function() {
              $('.loaderImage').show();
          },
          error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown);
            $('.loaderImage').hide();
            new PNotify({
                title: 'Error!',
                text: "Message : "+errorThrown,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;
          },
          success:function(response) {
            console.log(response);

            new PNotify({
                title: 'Success!',
                text: 'Set Status VCIF '+response+'.',
                type: response,
                styling: 'bootstrap3'
            });
            
            PNotify.prototype.options.delay = 3000;
            $('.loaderImage').hide();
            $('#confirmModalStatus').modal('hide');
          }
      });
    })
  });

  function add_cif(VCIF) {
    $(document).ready(function() {
      clearModal();
      $('#modal-CIF').modal('show');

      $('#modal_title_cif').empty();
      $('#button-upload-cif').remove();
      $('#VCIF_cif').remove();
      $('#submit_type_cif').remove();

      $("#CIF").removeAttr("value");
      $("#NameVCIF").removeAttr("value");
      var upload_url = base_url+'utility/Vcif/mass_upload_cif/'+VCIF;

      $("#button_upload_cif").attr("onclick", 'window.location.href=\''+upload_url+'\'');

      var form = $('#CifModalForm');
      $(form).append('<input id="VCIF_cif" type="hidden" name="VCIF" value="'+VCIF+'" /> ');
      $(form).append('<input id="submit_type_cif" type="hidden" name="submit_type_cif" value="add" /> ');
      $('#modal_title_cif').append('<span id="modal_title_cif">Add</span>');
    })
  }

  function confirmModalCif() {
    // $('#CifModalForm').modal('hide');
    if($("#CifModalForm").valid()){
      $('#confirmModalCif').modal('show');
      $("#confirmation_text_cif").html("Your'e about to add new CIF details. <br> Are you sure?");
    }
  }

  // $('#CifModalForm').on('submit', function (e) {
  //   e.preventDefault();
  //   if(confirm('Anda yakin?')) {
  $('#OK-CIF').click(function(){
    
      $.ajax({
        type: 'post',
        url : $('#CifModalForm').attr('action'),
        data: $('#CifModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('#confirmModalCif').modal('hide');
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
          $('#CifModalForm').modal('hide');
          $('.loaderImage').hide();
          console.log(response.status);
          if(response.status === 'success'){
            new PNotify({
                title: 'Success!',
                text: 'Data Saved',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 3000;

            setTimeout(function(){ 
              window.location.href= base_url+'utility/Vcif';
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

</script>

