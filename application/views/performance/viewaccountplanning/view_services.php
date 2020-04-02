<style type="text/css">
   .fnt {
      font-size: 12px;
      color: #000;
   }   
</style>

<div class="x_panel">
   <div class="x_title">
      <h2><small>Services</small></h2>
      <ul class="nav navbar-right panel_toolbox">
         <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
      </ul>
      <div class="clearfix"></div>
   </div>

  <div class="x_content">
      <br />
      <div id="table-cnservices" class="table-editable table-account-planning">
         <table class="table">
            <tr class="cnservices" style="background: #012D5A; color: #fff;">
               <th width="4%">#</th>
               <th>Nama Services</th>
            </tr>
            <?php if(!empty($SERVICES)) : ?>
               <?php $i=1; foreach($SERVICES as $srvc) : ?>
               <tr class="fnt">
                  <td class="txt" contenteditable="false"><?php echo $i++; ?></td>
                  <td class="txt" contenteditable="false"><?php echo $srvc['SERVICE_NAME']; ?></td>
               </tr>
               <?php endforeach; ?>
            <?php else : ?>
               <tr id="norecordService" class="fnt">
                  <td colspan="2" style="text-align: center;">No records available.</td>
               </tr>
            <?php endif; ?>
         </table>
      </div>
   </div>
</div>
