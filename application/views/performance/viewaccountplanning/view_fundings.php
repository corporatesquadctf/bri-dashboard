<style type="text/css">
   .fnt {
      font-size: 12px;
   }   
</style>

<div class="x_panel">
   <div class="x_title">
      <h2><small>Funding</small></h2>
      <ul class="nav navbar-right panel_toolbox">
         <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
      </ul>
      <div class="clearfix"></div>
   </div>
  
   <div class="x_content">
      <div id="table-cnfunding" class="table-editable table-account-planning">
         <table id="fundingTable" class="table">
            <tr class="cnfunding" style="background: #012D5A; color: #fff;">
               <th>#</th>
               <th>Kebutuhan Pendanaan (Loan & Non-loan)</th>
               <th colspan="2">Jangka waktu</th>
               <th>Nominal (Dalam Rupiah)</th>
            </tr>
            <?php if(!empty($FUNDING)) : ?>
               <?php $i=1; foreach($FUNDING as $fnd) : ?>
               <tr class="fnt">
                  <td class="txt" contenteditable="false"><?php echo $i++; ?></td>
                  <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $fnd['FUNDING_NEED']; ?></td>
                  <td class="txt num" contenteditable="false" style="text-align: center;"><?php echo $fnd['TIME_PERIOD']; ?></td>
                  <td class="txt" width="18%" style="text-align: center; background: #D7DBD7;">Bulan/Month</td>
                  <td class="txt num" contenteditable="false" style="text-align: right;">
                     <b><?php echo number_format($fnd['NOMINAL']); ?></b>
                  </td>
               </tr>
               <?php endforeach; ?>
            <?php else : ?>
               <tr id="norecordFunding" class="fnt">
                  <td colspan="5" style="text-align: center;">No records available.</td>
               </tr>
            <?php endif; ?>
         </table>
      </div>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
   $('.addRow').on('click', function() {
      $('#norecordFunding').hide();
   });
});
</script>