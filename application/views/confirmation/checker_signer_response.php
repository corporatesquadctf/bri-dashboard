<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<div id="dispo_2" class="modal fade modal-add-CheckerSignerResponse" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="addCheckerSignerResponseModalForm" method="POST" action="<?= site_url('confirmation/'.$confirmation_user.'/add_CheckerSignerResponse') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">event_available</i> <span><?=$confirmation_user?> <span id="responses"></span> Confirmation</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;"><?=$confirmation_user?> <span id="responses2"></span> Comment </label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <textarea name="Comment" id="comment_field" class="form-control col-md-7 col-xs-12" rows="10" required></textarea>
                      <input type="hidden" name="ConfirmationTable" value="<?= $confirmation_table ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <div class="row form_action">
                <button class="btn btn-sm btn-default btn_cancel w150" type="button" data-dismiss="modal" onclick="disableSaveButton()">BACK</button>
                <span id="btn_save_confirmation"></span>
              </div>
            </div>
          </form>
        </div>

    </div>
</div> 

<div id="confirmModalss" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p id="confirmation_text1">You're about to confirm Account Planning. <br>Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OKss" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  function confirmModalss() {
    $('#confirmModalss').modal('show');
    var confirmation_text1 = $('#OKss').attr('confirmation_text1');
    $("#confirmation_text1").html(confirmation_text1);
  }

    // $('#addCheckerSignerResponseModalForm').on('submit', function (e) {
      // e.preventDefault();
      // if(confirm('Anda yakin?')) {
    $('#OKss').click(function(){
        $.ajax({
          type: 'post',
          url : $('#addCheckerSignerResponseModalForm').attr('action'),
          data: $('#addCheckerSignerResponseModalForm').serialize(),
          dataType : 'json',
          beforeSend:function(){
            $('#confirmModalss').modal('hide');
            $('.modal-add-CheckerSignerResponse').modal('hide');
            $('.loaderImage').show();
          },
          error: function(jqXHR, textStatus, errorThrown){
            $('.loaderImage').hide();
            new PNotify({
                title: 'Error!',
                text: textStatus,
                type: 'error',
                styling: 'bootstrap3'
            });

            PNotify.prototype.options.delay = 1200;
          },
          success: function(response){
            $('.loaderImage').hide();
            if(response.status === 'success'){
              new PNotify({
                  title: 'Success!',
                  text: 'Approval Submited.',
                  type: 'success',
                  styling: 'bootstrap3'
              });

              PNotify.prototype.options.delay = 1200;

              setTimeout(function(){ 
                // window.location.href= base_url+'confirmation/<?=$confirmation_user?>/detail/<?=$account_planning['AccountPlanningId']?>';
                window.location.href= base_url+'confirmation/<?=$confirmation_user?>';
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


  function account_planning_response(Response, confirmation_user, AccountPlanningId, confirmation_table_id){
    $(document).ready(function() {
      $('.loaderImage').show();
      $('#responses').empty();
      $('#responses2').empty();
      var form = $('#addCheckerSignerResponseModalForm');
      $(form).append('<input type="hidden" name="confirmation_user" value="'+confirmation_user+'" /> ');
      $(form).append('<input type="hidden" name="confirmation_response" value="'+Response+'" /> ');
      $(form).append('<input type="hidden" name="AccountPlanningId" value="'+AccountPlanningId+'" /> ');
      $(form).append('<input type="hidden" name="confirmation_table_id" value="'+confirmation_table_id+'" /> ');

      $('#responses').append('<span id="responses">' + Response + '</span>');
      $('#responses2').append('<span id="responses2">' + Response + '</span>');
      if (Response == 'Approve') {
        var class_button = 'success'
      }
      else {
        var class_button = 'warning'
      }

      var comment_field = $('#comment_field');
      comment_field.empty();

      var btn_save_confirmation = $('#btn_save_confirmation');
      btn_save_confirmation.empty();
      // $(btn_save_confirmation).append('<button class="btn btn-'+class_button+' btn-sm w150" type="submit" id="btn-save-disp">'+Response.toUpperCase()+'</button>');
      $(btn_save_confirmation).append('<button class="btn btn-'+class_button+' btn-sm w150" type="submit" id="btn-save-disp" onclick="confirmModalss(); return false;" response="'+Response+'">'+Response.toUpperCase()+'</button>');

      setTimeout(function(){ 
        $('.loaderImage').hide();
      }, 1000);      

      $('.modal-add-CheckerSignerResponse').modal('show');  
      $('.loaderImage').hide();
    });
  }

</script>
