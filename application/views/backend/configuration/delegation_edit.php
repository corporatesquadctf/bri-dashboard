<link href="<?=base_url();?>assets/chosen/chosen.css" rel="stylesheet"/>
<style type="text/css">
  .submitBtn { display: none; }

  .fstMultipleMode { display: block; }
  .fstMultipleMode .fstControls { width: 100%; }

</style>
<div class="right_col" role="main">
<div class="col-md-6">
  <form id="delegasi" method="GET">
    <div class="form-group">
      <label for="usr">Customer Name:</label>
      <!-- <input disabled="true" type="text" class="form-control" name="name"  id="usr" value="<?php echo $c['COMPANY_NAME']?>"> -->
      <input disabled="true" type="text" class="form-control" name="name"  id="usr" value="nama">
    </div>
    <div class="form-group" style="display: none;">
      <label for="usr">VCIF:</label>
      <input disabled="true" type="text" class="form-control" name="vcif"  id="usr" value="vcif">
    </div>
    <div class="form-group">
      <label for="usr">Select PIC:</label><br>
      <select data-placeholder="Search RM Name" multiple class="chosen-select form-control" name="tags[]" >
          <option value=""></option>
          <?php foreach($datauser as $dd) : ?>
          <option><?php echo $dd->name; ?></option>
          <?php endforeach ?>
      </select>
    </div>
    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Save</button>
    
  </form>
  </div>
</div>
<script src="<?=base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?=base_url();?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?=base_url();?>assets/chosen/chosen.js"></script>
<script>
    $('.multipleSelect').fastselect();
</script>
<script type="text/javascript">
  $(".chosen-select").chosen({
    no_results_text: "Oops, Pilihan Tidak tersedia"
  })
</script>