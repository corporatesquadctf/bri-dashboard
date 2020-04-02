<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<div id="change_VCIF" class="modal fade modal-change-account_planning_vcif" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="changeVCIFModalForm" method="POST" action="<?= site_url('tasklist/AccountPlanning/manage_VCIF_proc') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span>Change Company</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
                  <div class="col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #C4C4C4;">
                    <p class="detail_head_title_icon">Company List</p>
                    <p id="vcif_list"></p>
               </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="detail_head_title_icon">Company Selected</p>
                    <p id="vcif_selected_list"></p>
                  </div>
                <!-- </div> -->
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <!-- <button class="btn btn-warning w150" type="submit" id="btn-save">Save</button> -->
              <button class="btn btn-warning w150" type="button" id="btnSave" onclick="confirmModalManageVCIF(); return false;">Save</button>

            </div>
          </form>
        </div>

    </div>
</div>

<div id="confirmModalManageVCIF" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmationModalManageVCIF_text">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK_ManageVCIF" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
// $(document).ready(function() {

  function confirmModalManageVCIF() {
    $('#change_VCIF').modal('hide');
    $('#confirmModalManageVCIF').modal('show');
    var confirmationModalManageVCIF_text = "Your'e about to manage VCIF in this Account Planning. <br>Your'e Account Planning Status will be set to Draft. <br>Are you sure?";
    $("#confirmationModalManageVCIF_text").html(confirmationModalManageVCIF_text);
  }

  function disableSaveButton(){
    // $("#btn-save").attr("disabled", true);
  }

  $("#change_VCIF").on("hidden.bs.modal", function () {
    disableSaveButton();
  });
  
    // $('#changeVCIFModalForm').on('submit', function (e) {
    //   e.preventDefault();
  $('#OK_ManageVCIF').click(function(){
      $.ajax({
        type: 'post',
        url : $('#changeVCIFModalForm').attr('action'),
        data: $('#changeVCIFModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('.modal-change-account_planning_vcif').modal('hide');
          $('#confirmModalManageVCIF').hide();
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log(jqXHR);
          $('.modal-backdrop.in').hide();
          $('.confirmModalManageVCIF').hide();
          $('.loaderImage').hide();
          new PNotify({
              title: 'Error!',
              text: "Message : "+errorThrown,
              type: 'error',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1200;
        },
        success: function(response){
          $('.loaderImage').hide();
          $('.modal-backdrop.in').hide();
          $('.confirmModalManageVCIF').hide();
          // console.log(response);
          // alert(response.insertStatus);
          if(response.insertStatus === 'success'){
            new PNotify({
                title: 'Success!',
                text: 'VCIF successfully inserted.',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;
          }else if(response.insertStatus === 'error'){
              new PNotify({
                  title: 'Error!',
                  text: response.insertMessage,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
          }

          if(response.moveStatus === 'success'){
            new PNotify({
                title: 'Success!',
                text: 'VCIF successfully inserted.',
                type: 'success',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;
          }else if(response.moveStatus === 'error'){
              new PNotify({
                  title: 'Error!',
                  text: response.moveMessage,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
          }

          if(response.removeStatus === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'VCIF successfully removed.',
                  type: 'success',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
          }else if(response.removeStatus === 'error'){
              new PNotify({
                  title: 'Error!',
                  text: response.removeMessage,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
          }          

          if(response.updateStatus === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Account Planning Main Company successfully Changed.',
                  type: 'success',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
          }else if(response.updateStatus === 'error'){
              new PNotify({
                  title: 'Error!',
                  text: response.updateMessage,
                  type: 'error',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;
          }
          

          setTimeout(function(){ 
            // if(response.insertStatus === 'success' || response.removeStatus === 'success')
              location.reload();
          }, 2000);
        }
      });
    });

// });
</script>

