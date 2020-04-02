<style type="text/css">
  .fnt {
      font-size: 12px;
   }   
</style>

<div id="table-initiative_action" class="table-editable table-account-planning">
   <table class="table">
      <tr class="initiative_action" style="background: #012D5A; color: #fff;">
         <th width="4%">#</th>
         <th>Initiative</th>
         <th  colspan="2">Action Plan</th>
         <th>Description</th>
      </tr>
      <?php if(!empty($INITIATIVES)) : ?>
         <?php $i=1; foreach($INITIATIVES as $intv) : ?>
         <tr class="fnt">
            <td class="txt" contenteditable="false"><?php echo $i++; ?></td>
            <td class="txt" contenteditable="false"><?php echo $intv['INITIATIVES']; ?></td>
            <td class="txt" contenteditable="false"><?php echo $intv['ACTION_QUARTER']; ?></td>
            <td class="txt" contenteditable="false"><?php echo $intv['ACTION_MONTH']; ?></td>
            <td class="txt" contenteditable="false"><?php echo $intv['DESCRIPTION']; ?></td>
         </tr>
         <?php endforeach; ?>
      <?php else : ?>
         <tr id="norecordInitiative" class="fnt">
            <td colspan="5" style="text-align: center;">No records available.</td>
         </tr>
      <?php endif; ?>
   </table>
</div>
<p id="export-initiative_action"></p>
</div>

<!-- SCRIPT -->
<script src="<?=base_url();?>assets/chart.js/dist/Chart.min.js"></script>