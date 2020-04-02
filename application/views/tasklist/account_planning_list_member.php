<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<div id="add_member" class="modal fade modal-add-account_planning_member" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <form class="form-horizontal form-label-left cmxform" id="addMemberModalForm" method="POST" action="<?= site_url('tasklist/AccountPlanning/add_member') ?>">
            <div class="modal-header" style="border-bottom: 1px solid #2980B9;">
              <div class="modal_property_title paddingleft_con">
                <i class="material-icons" style="vertical-align: middle;">description</i> <span>Add Member</span> 
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 modal-body">
                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->

                  <!-- <div class="form-group form-group-sm" id="con_param_rm_1">
                    <label for="nama_rm" class="col-sm-2 control-label">Search</label>
                    <div class="col-sm-10">
                      <input type="text" tabindex="1" class="required" id="param_rm_1" name="param_rm[]" value="" placeholder="Pilih RMName 1" style="width: 100%;" />
                    </div>
                  </div> -->
                         
                <!-- </div> -->
                <!-- <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #2980B9;"> -->
                  <div class="col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #C4C4C4;">
                    <p class="detail_head_title_icon">Member List</p>
                    <p id="member_list"></p>
                    <!-- <table width="100%" id="table_member_lists" class="table table-condensed table-striped table-hover">
                      <thead style="background-color: #FFFFFF; color: #218FD8;" >
                        <tr class="modal_table_title">
                          <td width="5%"><i class="material-icons" style="color: rgba(0, 0, 0, 0.54);">check</i></td>
                          <td width="40%">Personal Number</td>
                          <td width="55%">Name</td>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if (isset($member_list)) {?>
                      <?php $indexss = 0; ?>
                      <?php foreach ($member_list as $rows => $values) : ?>
                        <tr class="modal_table_list">
                          <td>
                              <label>
                                <input id="member_list" name="member_list[]" value="<?= $values['UserId'] ?>" type="checkbox" class="flat">
                              </label>
                          </td>
                          <td><?= $values['UserId'] ?></td>
                          <td><?= $values['Name'] ?></td>
                        </tr>
                      <?php $indexss++?>
                      <?php endforeach; ?>
                      <?php } ?>
                      </tbody>
                    </table> -->
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="detail_head_title_icon">Member Selected</p>
                    <p id="member_selected_list"></p>
                  </div>
                <!-- </div> -->
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-default w150" data-dismiss="modal">Back</button>
              <button class="btn btn-warning w150" type="submit" id="btn-save" disabled>Save</button>

            </div>
          </form>
        </div>

    </div>
</div>

<script type="text/javascript">
// $(document).ready(function() {
  function disableSaveButton(){
    $("#btn-save").attr("disabled", true);
  }

  $("#add_member").on("hidden.bs.modal", function () {
    disableSaveButton();
  });
  
    $('#addMemberModalForm').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        url : $('#addMemberModalForm').attr('action'),
        data: $('#addMemberModalForm').serialize(),
        dataType : 'json',
        beforeSend:function(){
          $('.modal-add-account_planning_member').modal('hide');
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('.loaderImage').hide();
        },
        success: function(response){
          //alert(response.removeStatus);
          if(response.insertStatus === 'success'){
            //window.location.href= base_url+'tasklist/disposisi';
            new PNotify({
                title: 'Success!',
                text: 'Account planning member successfully inserted.',
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
                  text: 'Account planning member successfully removed.',
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

