<b>Direct Loan</b>
<div id="table-comp_analyst_dirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr class="comp_analyst_dirloan" style="background: #012D5A; color: #FFF;">
         <th>Facilities</th>
         <th style="text-align: center;" width="21%">1</th>
         <th style="text-align: center;" width="21%">2</th>
         <th style="text-align: center;" width="21%">3</th>
      </tr>
      <?php
         $totalDl = count($COMPETITION_ANALYSIS['DIRECT_LOAN']);
         if ($totalDl > 0) :
            foreach($COMPETITION_ANALYSIS['DIRECT_LOAN'] as $dl) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $dl->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $dl->FIRST_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $dl->SECOND_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $dl->THIRD_BANK; ?></td>
      </tr>
      <?php
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="4" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-comp_analyst_dirloan"></p>
</div>

<br>

<b>InDirect Loan</b>
<div id="table-comp_analyst_indirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr class="comp_analyst_indirloan" style="background: #012D5A; color: #FFF;">
         <th>Facilities</th>
         <th style="text-align: center;" width="21%">1</th>
         <th style="text-align: center;" width="21%">2</th>
         <th style="text-align: center;" width="21%">3</th>
      </tr>
      <?php
         $totalIl = count($COMPETITION_ANALYSIS['INDIRECT_LOAN']);
         if ($totalIl > 0) :
            foreach($COMPETITION_ANALYSIS['INDIRECT_LOAN'] as $il) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $il->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $il->FIRST_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $il->SECOND_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $il->THIRD_BANK; ?></td>
      </tr>
      <?php
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="4" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-comp_analyst_indirloan"></p>
</div>

<br>

<b>Cash</b>
<div id="table-comp_analyst_cash" class="table-editable table-account-planning">
   <table class="table">
      <tr class="comp_analyst_cash" style="background: #012D5A; color: #FFF;">
         <th>Facilities</th>
         <th style="text-align: center;" width="21%">1</th>
         <th style="text-align: center;" width="21%">2</th>
         <th style="text-align: center;" width="21%">3</th>
      </tr>
      <?php
         $totalCs = count($COMPETITION_ANALYSIS['CASH']);
         if ($totalCs > 0) :
            foreach($COMPETITION_ANALYSIS['CASH'] as $cs) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $cs->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $cs->FIRST_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $cs->SECOND_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $cs->THIRD_BANK; ?></td>
      </tr>
      <?php
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="4" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-comp_analyst_cash"></p>
</div>

<br>

<b>Transaction Banking</b>
<div id="table-comp_analyst_transc_banking" class="table-editable table-account-planning">
   <table class="table">
      <tr class="comp_analyst_transc_banking" style="background: #012D5A; color: #FFF;">
         <th>Facilities</th>
         <th style="text-align: center;" width="21%">1</th>
         <th style="text-align: center;" width="21%">2</th>
         <th style="text-align: center;" width="21%">3</th>
      </tr>
      <?php
         $totalTb = count($COMPETITION_ANALYSIS['TRAN_BANK']);
         if ($totalTb > 0) :
            foreach($COMPETITION_ANALYSIS['TRAN_BANK'] as $tb) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $tb->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $tb->FIRST_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $tb->SECOND_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $tb->THIRD_BANK; ?></td>
      </tr>
      <?php
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="4" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-comp_analyst_transc_banking"></p>
</div>

<br>

<b>Other Information</b>
<div id="table-comp_analyst_other_information" class="table-editable table-account-planning">
   <table class="table">
      <tr class="comp_analyst_other_information" style="background: #012D5A; color: #FFF;">
         <th>Facilities</th>
         <th style="text-align: center;" width="21%">1</th>
         <th style="text-align: center;" width="21%">2</th>
         <th style="text-align: center;" width="21%">3</th>
      </tr>
      <?php
         $totalOi = count($COMPETITION_ANALYSIS['OTHER_INFO']);
         if ($totalOi > 0) :
            foreach($COMPETITION_ANALYSIS['OTHER_INFO'] as $oi) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $oi->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $oi->FIRST_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $oi->SECOND_BANK; ?></td>
         <td class="txt" contenteditable="false" style="text-align: center;"><?php echo $oi->THIRD_BANK; ?></td>
      </tr>
      <?php
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="4" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-comp_analyst_other_information"></p>
</div>