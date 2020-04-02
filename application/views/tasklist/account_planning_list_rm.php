<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<div id="add_member" class="modal fade modal-add-account_planning_delegate" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="delegateAPModalForm" method="POST" action="<?= site_url('tasklist/delegate/add_delegate') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span>Delegate Account Planning</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
              <div class="col-md-12 col-sm-12 col-xs-12">
                    <p class="detail_head_title_icon">Delegate to</p>
                    <p id="new_owner"></p>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <!-- <button class="btn btn-warning w150" type="submit" id="btn-save" disabled>Save</button> -->
              <button class="btn btn-warning w150" type="button" id="btn-save" onclick="confirmModal(); return false;">Save</button>
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
        <p id="confirmation_text1">Your'e about to Delegate Account Planning to new RM. <br> Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
// $(document).ready(function() {

  function confirmModal() {
    $('#confirmModal').modal('show');
    var confirmation_text1 = $('#OK').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

  function disableSaveButton(){
    $("#btn-save").attr("disabled", true);
  }

  $("#add_member").on("hidden.bs.modal", function () {
    disableSaveButton();
  });
  
  // $('#delegateAPModalForm').on('submit', function (e) {
  //   e.preventDefault();
  $('#OK').click(function(){
    $.ajax({
      type: 'post',
      url : $('#delegateAPModalForm').attr('action'),
      data: $('#delegateAPModalForm').serialize(),
      dataType : 'json',
      beforeSend:function(){
        $('.modal-add-account_planning_delegate').modal('hide');
        $('.loaderImage').show();
        $('#confirmModal').hide('show');
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('.loaderImage').hide();
      },
      success: function(response){
        if(response.status === 'success'){
          new PNotify({
              title: 'Success!',
              text: 'Delegate Account planning success.',
              type: 'success',
              styling: 'bootstrap3'
          });

          PNotify.prototype.options.delay = 1200;
        }else if(response.status === 'error'){
            new PNotify({
                title: 'Error!',
                text: response.insertMessage,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;
        }

        setTimeout(function(){ 
          $('.loaderImage').hide();
          // if(response.insertStatus === 'success' || response.removeStatus === 'success')
          if(response.status === 'success')
            location.reload();
        }, 2000);
      }
    });
  });

// });
</script>

