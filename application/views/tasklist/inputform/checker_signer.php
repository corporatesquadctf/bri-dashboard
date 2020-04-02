<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<div id="dispo_2" class="modal fade modal-add-checkersigner" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="addCheckerSignerModalForm" method="POST" action="<?= site_url('tasklist/AccountPlanning/add_checkersigner') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span>Add Checker & Signer</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #2980B9;">
                  <div class="col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #C4C4C4;">
                    <p class="detail_head_title_icon">Checker</p>
                    <p id="checker_per_uker_list"></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="detail_head_title_icon">Signer</p>
                    <p id="signer_per_uker_list"></p>
                  </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-sm btn-default btn_cancel w150" data-dismiss="modal" onclick="disableSaveButton()">Back</button>
              <button class="btn btn-warning btn-sm" type="submit" id="btn-save-disp" onclick="confirmModals(); return false;" disabled>Submit Account Planning</button>
              <!-- <button class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right: 0px;" onclick="confirmModal(); return false;">SAVE</button> -->
            </div>
          </form>
        </div>

    </div>
</div>

<div id="confirmModals" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">You're about to submit Account Planning. <br>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OKs" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  function confirmModals() {
    $('#confirmModals').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }


    // $('#addCheckerSignerModalForm').on('submit', function (e) {
    //   e.preventDefault();
      // if(confirm('Anda yakin?')) {
    $('#OKs').click(function(){
        $.ajax({
          type: 'post',
          url : $('#addCheckerSignerModalForm').attr('action'),
          data: $('#addCheckerSignerModalForm').serialize(),
          dataType : 'json',
          beforeSend:function(){
            $('#confirmModals').modal('hide');
            $('.modal-add-checkersigner').modal('hide');
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

            PNotify.prototype.options.delay = 3000;
          },
          success: function(response){
            $('.loaderImage').hide();
            if(response.status === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Account Planning successfully Submited.',
                  type: 'success',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;

              setTimeout(function(){ 
                window.location.href= base_url+'tasklist/AccountPlanning/view/<?= $account_planning['AccountPlanningId'] ?>/detail';
              }, 2000);
              
            }else if(response.status === 'error'){
              new PNotify({
                  title: 'Error!',
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


  function account_planning_submit(AccountPlanningId){
    $(document).ready(function() {
      $('.modal-add-checkersigner').modal('show');  
      $('.loaderImage').show();

      var form = $('#addCheckerSignerModalForm');
      $(form).append('<input type="hidden" name="AccountPlanningId" value="'+AccountPlanningId+'" /> ');

      var checker_per_uker_list = $('#checker_per_uker_list');
      checker_per_uker_list.empty();
      
      var signer_per_uker_list = $('#signer_per_uker_list');
      signer_per_uker_list.empty();

      var totalSelectedchecker = 0;
      var totalSelectedsigner = 0;

      var y ='<table width="100%" id="table_checker_per_uker_list" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">check_circle_outline</i></td><td width="40%">Personal Number</td><td width="55%">Name</td></tr></thead>';

      $.getJSON(base_url+'tasklist/AccountPlanning/getChecker/'+AccountPlanningId, function (data){
        // console.log(data);
        if(data.length > 0){
          y += '<tbody>';
          $.each(data, function(index, item){
              y += '<tr class="modal_table_list">';
              y += '<td><label><input id="checker_per_uker_list" name="checker_per_uker_list[]" value="' + item.UserId + '" type="checkbox" class="flat" ' + item.Checkerchecked + '></label></td></td>';
              y += '<td>' + item.UserId + '</td>';
              y += '<td>' + item.CheckerName + '</td>';
              y += '</tr>';
          })
          y += '</tbody>';
        }
        y += '</table>';
        checker_per_uker_list.append(y);

        $('#checker_per_uker_list').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('#checker_per_uker_list').on('ifChecked', function(event){
          totalSelectedchecker = totalSelectedchecker+1;
          if (totalSelectedchecker > 0 && totalSelectedsigner > 0){
            $("#btn-save-disp").attr("disabled", false);
          }
        });
        $('#checker_per_uker_list').on('ifUnchecked', function(event){
          totalSelectedchecker = totalSelectedchecker-1;
          if (totalSelectedchecker == 0 || totalSelectedsigner == 0){
           $("#btn-save-disp").attr("disabled", true);
          }
        });

        //$('#tbl_disposisi').DataTable({});
        $('#table_checker_per_uker_list').DataTable({
          "destroy": true,
          'dom': 'ft<"bottom"p>',
          "info": true,
          "pageLength": 10,
          "pagingType": "simple",
          "lengthChange": false,
          "columns": [
              { "orderable": false },
              null,
              null
            ]        
        });
      });

      var x ='<table width="100%" id="table_signer_list" class="table table-condensed table-striped table-hover"><thead style="background-color: #FFFFFF; color: #218FD8;" ><tr class="modal_table_title"><td width="40%">Personal Number</td><td width="55%">Name</td><td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">assignment_turned_in</i></td></tr></thead>';

      $.getJSON(base_url+'tasklist/AccountPlanning/getSigner/'+AccountPlanningId, function (data){
        if(data.length > 0){
          x += '<tbody>';
          $.each(data, function(index, item){
              x += '<tr class="modal_table_list">';
              x += '<td>' + item.UserId + '</td>';
              x += '<td>' + item.SignerName + '</td>';
              x += '<td><label><input id="signer_per_uker_list" name="signer_per_uker_list[]" value="' + item.UserId + '" type="checkbox" class="flat" ' + item.Signerchecked + '></label></td></td>';
              x += '</tr>';
          })
          x += '</tbody>';
        }

        x += '</table>'; 
        signer_per_uker_list.append(x);

        $('#signer_per_uker_list').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        $('#signer_per_uker_list').on('ifChecked', function(event){
          totalSelectedsigner = totalSelectedsigner+1;
          if (totalSelectedchecker > 0 && totalSelectedsigner > 0){
            $("#btn-save-disp").attr("disabled", false);
          }
        });
        $('#signer_per_uker_list').on('ifUnchecked', function(event){
          totalSelectedsigner = totalSelectedsigner-1;
          if (totalSelectedchecker == 0 || totalSelectedsigner == 0){
           $("#btn-save-disp").attr("disabled", true);
          }
        });

        $('#table_signer_list').DataTable({
          "destroy": true,
          'dom': 'ft<"bottom"p>',
          "info": true,
          "pageLength": 10,
          "pagingType": "simple",
          "lengthChange": false,
          "columns": [
              null,
              null,
              { "orderable": false }
            ]        
        });
      })
      setTimeout(function(){ 
        $('.loaderImage').hide();
      }, 2000);      

    });
  }

</script>
