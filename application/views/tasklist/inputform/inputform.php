
<div class="right_col" role="main">
  <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel container_header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">Tasklist</li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning');?>">My Task</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/input/'.$AccountPlanningId.'/action_plans');?>">BRI Starting Position</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?=base_url('tasklist/AccountPlanning/input/'.$AccountPlanningId.'/action_plans/'.$BankFacilityGroupType);?>">Estimated Financial</a></li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">Input Account Planning</li> -->
                  </ol>
                </nav>
                <div class="page_title">
                    <div class="pull-left"><?= $BankFacilityGroupName; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form class="form-horizontal" id="add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>" method="POST" action="<?= site_url('tasklist/AccountPlanning/input_proc') ?>" style="text-align: left;">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <table width="100%" cellpadding="2" cellspacing="2" style="color: #00000; font-size: 13px;">
                  <?php if (isset($inputform[$BankFacilityGroupType])) {?>
                  <?php foreach ($inputform[$BankFacilityGroupType] as $rows => $values) : ?>
                  <tr>
                    <td style="vertical-align: bottom;" width="20%"><label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding-bottom: 8px;"><?= $values['BankFacilityItemName'] ?></label></td>
                    <!-- <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Total</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="TotalAmount[]" id="TotalAmount" class="form-control col-md-7 col-xs-12 money" data-a-sep=","></div>
                    </td> -->
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Projection Customer By IDR</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRProjection[]" id="IDRProjection" class="form-control col-md-7 col-xs-12 money" data-a-sep=","></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Projection Customer By Valas</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasProjection[]" id="ValasProjection" class="form-control col-md-7 col-xs-12 money" data-a-dec="."></div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <!-- <td></td> -->
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Target BRI By IDR</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="IDRTarget[]" id="IDRTarget" class="form-control col-md-7 col-xs-12 money" data-a-sep=","></div>
                    </td>
                    <td>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Target BRI By Valas</label>
                      <div class="col-md-12 col-sm-12 col-xs-12"><input type="text" name="ValasTarget[]" id="ValasTarget" class="form-control col-md-7 col-xs-12 money" data-a-dec="."></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" height="30">
                      <input type="hidden" name="AccountPlanningId[]" value="<?= $AccountPlanningId; ?>">
                      <input type="hidden" name="BankFacilityItemId[]" value="<?= $values['BankFacilityItemId']; ?>">
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php } ?>
                  <tr>
                    <td colspan="4">
                      <input type="hidden" name="AccountPlanningTab" value="<?= $AccountPlanningTab; ?>">
                      <input type="hidden" name="BankFacilityGroupType" value="<?= $BankFacilityGroupType; ?>">
                      <input type="hidden" name="InputTable" value="EstimatedFinancial">
                    </td>
                  </tr>
                </table>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12 margintop_con">
                <div style="text-align: right;">
                  <button type="button" class="btn btn-default w150"  onclick="window.location.href='<?=base_url('tasklist/AccountPlanning/input/'.$AccountPlanningId.'/action_plans/'.$BankFacilityGroupType);?>'">Back</button>
                  <button class="btn btn-warning btn-sm w150" type="submit" id="btn-upload">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url();?>assets/auto-numeric/autoNumeric.js"></script>

<script type="text/javascript">
var base_url = "<?= base_url(); ?>";

$(document).ready(function() {

  $('.money').autoNumeric('init',{
    aForm: true,
        vMax: '999999999999999',
        unformatOnSubmit: true
  });
  $('.portion').autoNumeric('init',{
    aForm: true,
        vMax: '100',
        unformatOnSubmit: true
  });

  $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').on('submit', function (e) {
    e.preventDefault();
    if(confirm('Anda yakin?')) {
      $.ajax({
        type: 'post',
        url : $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').attr('action'),
        data: $('#add-<?= $AccountPlanningTab; ?>-<?= $BankFacilityGroupType; ?>').serialize(),
          dataType : 'html',
        beforeSend:function(){
          $('.loaderImage').show();
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log(jqXHR);
          $('.loaderImage').hide();
          alert('<?=$this->config->item('ajax_error_message')?>');
        },
        success: function(data){
          setTimeout(function(){ 
            window.location.href= base_url+'tasklist/AccountPlanning/input/<?= $AccountPlanningId; ?>/<?= $AccountPlanningTab; ?>/<?= $BankFacilityGroupType; ?>';
            $('.loaderImage').hide();
          }, 1000);
        }
      });
    }
  });
    
});

</script>


