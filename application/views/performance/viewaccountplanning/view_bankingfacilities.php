<b>Direct Loan</b>
<div id="table-dirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr class="dirloan" style="background: #012D5A; color: #FFF;">
         <th>Kategori</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="12%">%</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="12%">%</th>
      </tr>
      <?php 
         $totalDl = count($BANKING_FACILITY['DIRECT_LOAN']);
         if ($totalDl > 0) :
            foreach($BANKING_FACILITY['DIRECT_LOAN'] as $dl) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">directloan</td>
         <td class="txt" contenteditable="false"><?php echo $dl->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($dl->AMOUNT_IDR); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($dl->AMOUNT_IDR_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($dl->AMOUNT_VALAS); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($dl->AMOUNT_VALAS_PERCENT * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="6" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-dirloan"></p>
</div>

<br>       

<b>InDirect Loan</b>
<div id="table-indirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr class="indirloan" style="background: #012D5A; color: #FFF;">
         <th>Kategori</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="12%">%</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="12%">%</th>
      </tr>
      <?php 
         $totalIl = count($BANKING_FACILITY['INDIRECT_LOAN']);
         if ($totalIl > 0) :
            foreach($BANKING_FACILITY['INDIRECT_LOAN'] as $Il) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">indirectloan</td>
         <td class="txt" contenteditable="false"><?php echo $Il->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($Il->AMOUNT_IDR); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($Il->AMOUNT_IDR_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($Il->AMOUNT_VALAS); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($Il->AMOUNT_VALAS_PERCENT * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="6" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-indirloan"></p>
</div>

<br>

<b>Cash</b>
<div id="table-cash" class="table-editable table-account-planning">
   <table class="table">
      <tr class="cash" style="background: #012D5A; color: #FFF;">
         <th>Kategori</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="12%">%</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="12%">%</th>
      </tr>
      <?php 
         $totalCs = count($BANKING_FACILITY['CASH']);
         if ($totalCs > 0) :
            foreach($BANKING_FACILITY['CASH'] as $cs) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">cash</td>
         <td class="txt" contenteditable="false"><?php echo $cs->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($cs->AMOUNT_IDR); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($cs->AMOUNT_IDR_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($cs->AMOUNT_VALAS); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($cs->AMOUNT_VALAS_PERCENT * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="6" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-cash"></p>
</div>

<br>

<b>Transaction Banking</b>
<div id="table-transc_banking" class="table-editable table-account-planning">
   <table class="table">
      <tr class="tranBank" style="background: #012D5A; color: #FFF;">
         <th>Kategori</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="12%">%</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="12%">%</th>
      </tr>
      <?php 
         $totalTb = count($BANKING_FACILITY['TRAN_BANK']);
         if ($totalTb > 0) :
            foreach($BANKING_FACILITY['TRAN_BANK'] as $tb) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">transactionalbank</td>
         <td class="txt" contenteditable="false"><?php echo $tb->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($tb->AMOUNT_IDR); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($tb->AMOUNT_IDR_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($tb->AMOUNT_VALAS); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($tb->AMOUNT_VALAS_PERCENT * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="6" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-transc_banking"></p>
</div>

<b>Other Informataions</b>
<div id="table-other_info" class="table-editable table-account-planning">
   <table class="table">
      <tr class="otherInfo" style="background: #012D5A; color: #FFF;">
         <th>Kategori</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="12%">%</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="12%">%</th>
      </tr>
      <?php 
         $totalOi = count($BANKING_FACILITY['OTHER_INFO']);
         if ($totalOi > 0) :
            foreach($BANKING_FACILITY['OTHER_INFO'] as $oi) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">transactionalbank</td>
         <td class="txt" contenteditable="false"><?php echo $oi->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($oi->AMOUNT_IDR); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($oi->AMOUNT_IDR_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($oi->AMOUNT_VALAS); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($oi->AMOUNT_VALAS_PERCENT * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="6" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-transc_banking"></p>
</div>
