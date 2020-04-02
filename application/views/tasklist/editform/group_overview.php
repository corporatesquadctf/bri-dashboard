<style type="text/css">
    .form_container{
        margin: 0;
        padding: 15px 30px;
        box-shadow: 0 4px 5px rgba(14, 65, 142, 0.05), 0px 2px 2px rgba(81, 118, 213, 0.05);
    }
    .form_container label{
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.87);
    }
    .form_container .form-control{
        border-radius: 4px;
    }
    .form_action{
        margin: 0;
        padding: 30px 30px 0 15px;
    }
    .form_action button{
        border: 1px solid #F58C38;
        box-sizing: border-box;
        border-radius: 2px;
        font-size: 10px;
        color: #FFFFFF;
    }
    .form_action .btn_save{
        background: #F58C38;
    }
    .form_action .btn_save:hover{
        border: 1px solid #F58C38;
    }
    .form_action .btn_save:active:hover{
        background: #c4702c;
        border: 1px solid #F58C38;
    }
    .form_action .btn_cancel{
        color: #F58C38;
    }
    .form_action .btn_cancel:hover{
        border: 1px solid #F58C38;
    }
    .form_action .btn-default.focus, .btn-default:focus {
        border-color: #F58C38;
    }
    .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
        border-radius: 4px;
    }
    .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
        min-height: 34px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-top: 3px;
    }    
    .error {
        font-weight: normal !important;
        color: #f00 !important;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel container_header">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Tasklist</li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning');?>">Account Planning</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/view/'.$AccountPlanningId.'/input/company_information');?>">Company Information</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Group Overview</li>
                    </ol>
                    </nav>
                    <div class="page_title">
                        <div class="pull-left">Group Overview</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel" style="padding:10px 0;">
                    <div class="x_content" style="padding: 0">
                        <form id="formGroupOverview" method="post" action="<?= base_url().'tasklist/AccountPlanning/proses_editgroupoverview/'.$VCIF; ?>">
                            <div class="row form_container">
                                <input type="hidden" id="account_planning_id" name="account_planning_id" value="<?= $AccountPlanningId; ?>">
                                <input type="hidden" id="vcif" name="vcif" value="<?= $VCIF; ?>">
                                <?php
                                    if(!empty($GroupOverview)){
                                ?>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Customer Name :</label>
                                        <input type="text" id="child_company" name="child_company" class="form-control" value="<?= $CustomerName; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Address :</label>
                                        <textarea id="address" name="address" class="form-control" rows="5" required maxlength="225"><?= $GroupOverview->Address1; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>City :</label>
                                        <select class="form-control js-example-basic-single" id="city" name="city" style="width:100%;">
                                            <?php
                                                foreach ($CityOption as $row){
                                                    $selected = '';
                                                    if($GroupOverview->ProvinceId == $row->ProvinceId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->ProvinceId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label>Global Ratings :</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <select class="form-control js-example-basic-single" id="global_ratings" name="global_ratings" style="width:100%;">
                                                    <?php
                                                        foreach ($GlobalRatingOption as $row){
                                                            $selected = '';
                                                            if($GroupOverview->GlobalRatingId == $row->GlobalRatingId) $selected = 'selected="selected"';
                                                            echo '<option value="'.$row->GlobalRatingId.'" '.$selected.'>'.$row->Name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" id="global_ratings_name" name="global_ratings_name" class="form-control" value="<?= $GroupOverview->GlobalRatingDescription; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Domestic Ratings :</label>
                                        <select class="form-control js-example-basic-single" id="domestic_ratings" name="domestic_ratings" style="width:100%;">
                                            <?php
                                                foreach ($DomesticRatingOption as $row){
                                                    $selected = '';
                                                    if($GroupOverview->DomesticRatingId == $row->DomesticRatingId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->DomesticRatingId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:21px;">
                                        <label>Industry :</label>
                                        <input type="text" id="industry" name="industry" class="form-control" value="<?= $GroupOverview->IndustryName; ?>" required maxlength="225">
                                    </div>
                                    <div class="form-group">
                                        <label>Industry Trend :</label>
                                        <select class="form-control js-example-basic-single" id="industry_trend" name="industry_trend" style="width:100%;">
                                            <?php
                                                foreach ($IndustryTrendOption as $row){
                                                    $selected = '';
                                                    if($GroupOverview->IndustryTrendId == $row->IndustryTrendId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->IndustryTrendId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Life Cycle :</label>
                                        <select class="form-control js-example-basic-single" id="life_cycle" name="life_cycle" style="width:100%;">
                                            <?php
                                                foreach ($LifeCycleOption as $row){
                                                    $selected = '';
                                                    if($GroupOverview->LifeCycleId == $row->LifeCycleId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->LifeCycleId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    }else{
                                ?>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Customer Name :</label>
                                            <input type="text" id="child_company" name="child_company" class="form-control" value="<?= $CustomerName; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <textarea id="address" name="address" class="form-control" rows="5" required maxlength="225"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>City :</label>
                                            <select class="form-control js-example-basic-single" id="city" name="city" style="width:100%;">
                                                <?php
                                                    foreach ($CityOption as $row){
                                                        echo '<option value="'.$row->ProvinceId.'">'.$row->Name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label>Global Ratings :</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <select class="form-control js-example-basic-single" id="global_ratings" name="global_ratings" style="width:100%;">
                                                    <?php
                                                        foreach ($GlobalRatingOption as $row){
                                                            echo '<option value="'.$row->GlobalRatingId.'">'.$row->Name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" id="global_ratings_name" name="global_ratings_name" class="form-control" value="<?= $defaultGlobalRatingDescription; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Domestic Ratings :</label>
                                        <select class="form-control js-example-basic-single" id="domestic_ratings" name="domestic_ratings" style="width:100%;">
                                            <?php
                                                foreach ($DomesticRatingOption as $row){
                                                    echo '<option value="'.$row->DomesticRatingId.'">'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:21px;">
                                        <label>Industry :</label>
                                        <input type="text" id="industry" name="industry" class="form-control" value="" required maxlength="225">
                                    </div>
                                    <div class="form-group">
                                        <label>Industry Trend :</label>
                                        <select class="form-control js-example-basic-single" id="industry_trend" name="industry_trend" style="width:100%;">
                                            <?php
                                                foreach ($IndustryTrendOption as $row){
                                                    echo '<option value="'.$row->IndustryTrendId.'">'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Life Cycle :</label>
                                        <select class="form-control js-example-basic-single" id="life_cycle" name="life_cycle" style="width:100%;">
                                            <?php
                                                foreach ($LifeCycleOption as $row){
                                                    $selected = '';
                                                    if($GroupOverview->LifeCycleId == $row->LifeCycleId) $selected = 'selected="selected"';
                                                    echo '<option value="'.$row->LifeCycleId.'" '.$selected.'>'.$row->Name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="row form_action">
                                    <div class="form-group pull-right">
                                        <div class="col-xs-12">
                                            <button id="btn_cancel_edit_group_overview" class="btn w150 btn-sm btn-default btn_cancel" type="button">BACK</button>
                                            <button id="btn_save_edit_group_overview" class="btn w150 btn-sm btn-primary btn_save" type="submit" style="margin-right:0px;">SAVE</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
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
      <div class="modal-body" style="text-align: left;">
        <p id="confirmation_text1">You're about to saved Group Overview details. Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn w150 btn-default" data-dismiss="modal">Cancel</button>
          <button id="OK" type="button" class="btn w150 btn-primary modal-button-ok">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">

      function confirmModal() {
        $('#confirmModal').modal('show');
        var confirmation_text1 = $('#OK').attr('confirmation_text1');
        $("#confirmation_text1").html(confirmation_text1);
      }

    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('#global_ratings').change(function(){
            var globalRatingsId =  this.value;
            updateGlobalRatingsName(globalRatingsId);
        });

        $('#btn_cancel_edit_group_overview').click(function(){
            window.location.href= '<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/company_information');?>';
        });

        $('#formGroupOverview').validate({
            submitHandler: function(form) {
                confirmModal();
            }
        });

        $('#OK').click(function(){
            $.ajax({
              type: 'post',
              url : $('#formGroupOverview').attr('action'),
              data: $('#formGroupOverview').serialize(),
              dataType : 'html',
              beforeSend:function(){
                $('#confirmModal').hide();
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
              success: function(data){
                new PNotify({
                    title: 'Success!',
                    text: 'Data Saved',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                
                PNotify.prototype.options.delay = 1200;

                setTimeout(function(){ 
                    window.location.href= '<?=base_url('tasklist/AccountPlanning'.$isCST.'/view/'.$AccountPlanningId.'/input/company_information');?>';
                    $('.loaderImage').hide();
                }, 2000);
              }
            });
        });

    });

    function updateGlobalRatingsName(globalRatingsId){
        jQuery(".loaderImage").show();  
        $.getJSON('<?= base_url();?>'+'tasklist/AccountPlanning/serviceGetGlobalRatingDescription/'+globalRatingsId, function (data){
            $('#global_ratings_name').val(data);
            jQuery(".loaderImage").hide();
        })    
    }
</script>