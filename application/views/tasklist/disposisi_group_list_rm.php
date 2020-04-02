<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<div id="dispo_2" class="modal fade modal-add-disposisi" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="addDisposisiModalForm" method="POST" action="<?= site_url('tasklist/disposisi/add_disposisi') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span>Disposition</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12">

                  <!-- <div class="form-group form-group-sm" id="con_param_rm_1">
                    <label for="nama_rm" class="col-sm-2 control-label">Search</label>
                    <div class="col-sm-10">
                      <input type="text" tabindex="1" class="required" id="param_rm_1" name="param_rm[]" value="" placeholder="Pilih RMName 1" style="width: 100%;" />
                    </div>
                  </div> -->
                         
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #2980B9;">
                  <div class="col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #C4C4C4;">
                    <p class="detail_head_title_icon">Relationship Manager List</p>
                    <p id="rm_per_uker_list"></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="detail_head_title_icon">Relationship Manager Selected</p>
                    <p id="rm_selected_list"></p>
                  </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default btn_cancel w150" data-dismiss="modal" onclick="disableSaveButton()">Back</button>
              <button class="btn btn-warning w150" type="submit" id="btn-save-disp" disabled>Save</button>
            </div>
          </form>
        </div>

    </div>
</div>

<script type="text/javascript">
  function disableSaveButton(){
    $("#btn-save-disp").attr("disabled", true);
  }

  $("#dispo_2").on("hidden.bs.modal", function () {
    disableSaveButton();
  });
// $(document).ready(function() {
    $('#addDisposisiModalForm').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        url : $('#addDisposisiModalForm').attr('action'),
        data: $('#addDisposisiModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('.modal-add-disposisi').modal('hide');
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('.loaderImage').hide();
          //alert(errorThrown);
        },
        success: function(response){
          if(response.insertStatus === 'success'){
              //window.location.href= base_url+'tasklist/disposisi';
              new PNotify({
                  title: 'Success!',
                  text: 'Customer group disposition successfully inserted.',
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

          if(response.removeStatus === 'success'){
              //window.location.href= base_url+'tasklist/disposisi';
              new PNotify({
                  title: 'Success!',
                  text: 'Customer group disposition successfully removed.',
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

          
          setTimeout(function(){ 
            $('.loaderImage').hide();
            if(response.insertStatus === 'success' || response.removeStatus === 'success')
              location.reload();
          }, 2000);
        }
      });
    });

// });
</script>

