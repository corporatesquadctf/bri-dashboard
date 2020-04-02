<b>Direct Loan</b>
<div id="table-dirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr class="dirloan" style="background: #012D5A; color: #FFF;">
         <th>Facilities</th>
         <th style="text-align: center;" width="18%">TOTAL</th>
         <th style="text-align: center;" width="18%">BRI</th>
         <th style="text-align: center;" width="10%">% BRI</th>
         <th style="text-align: center;" width="18%">OTHER BANK</th>
         <th style="text-align: center;" width="10%">% OTHER BANK</th>
      </tr>
      <?php 
         $totalDl = count($WALLET_SHARE['DIRECT_LOAN']);
         if ($totalDl > 0) :
            foreach($WALLET_SHARE['DIRECT_LOAN'] as $dl) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">directloan</td>
         <td class="txt" contenteditable="false"><?php echo $dl->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($dl->TOTAL_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($dl->BRI_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($dl->BRI_SHARE_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($dl->OTHER_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($dl->OTHER_SHARE_PERCENT * 100))/100; ?> %</td>
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
         <th>Facilities</th>
         <th style="text-align: center;" width="18%">TOTAL</th>
         <th style="text-align: center;" width="18%">BRI</th>
         <th style="text-align: center;" width="10%">% BRI</th>
         <th style="text-align: center;" width="18%">OTHER BANK</th>
         <th style="text-align: center;" width="10%">% OTHER BANK</th>
      </tr>
      <?php 
         $totalIl = count($WALLET_SHARE['INDIRECT_LOAN']);
         if ($totalIl > 0) :
            foreach($WALLET_SHARE['INDIRECT_LOAN'] as $Il) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">indirectloan</td>
         <td class="txt" contenteditable="false"><?php echo $Il->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($Il->TOTAL_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($Il->BRI_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($Il->BRI_SHARE_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($Il->OTHER_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($Il->OTHER_SHARE_PERCENT * 100))/100; ?> %</td>
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
         <th>Facilities</th>
         <th style="text-align: center;" width="18%">TOTAL</th>
         <th style="text-align: center;" width="18%">BRI</th>
         <th style="text-align: center;" width="10%">% BRI</th>
         <th style="text-align: center;" width="18%">OTHER BANK</th>
         <th style="text-align: center;" width="10%">% OTHER BANK</th>
      </tr>
      <?php 
         $totalCs = count($WALLET_SHARE['CASH']);
         if ($totalCs > 0) :
            foreach($WALLET_SHARE['CASH'] as $cs) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">cash</td>
         <td class="txt" contenteditable="false"><?php echo $cs->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($cs->TOTAL_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($cs->BRI_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($cs->BRI_SHARE_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($cs->OTHER_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($cs->OTHER_SHARE_PERCENT * 100))/100; ?> %</td>
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
         <th>Facilities</th>
         <th style="text-align: center;" width="18%">TOTAL</th>
         <th style="text-align: center;" width="18%">BRI</th>
         <th style="text-align: center;" width="10%">% BRI</th>
         <th style="text-align: center;" width="18%">OTHER BANK</th>
         <th style="text-align: center;" width="10%">% OTHER BANK</th>
      </tr>
      <?php 
         $totalTb = count($WALLET_SHARE['TRAN_BANK']);
         if ($totalTb > 0) :
            foreach($WALLET_SHARE['TRAN_BANK'] as $tb) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">transactionalbank</td>
         <td class="txt" contenteditable="false"><?php echo $tb->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($tb->TOTAL_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($tb->BRI_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($tb->BRI_SHARE_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($tb->OTHER_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($tb->OTHER_SHARE_PERCENT * 100))/100; ?> %</td>
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
         <th>Facilities</th>
         <th style="text-align: center;" width="18%">TOTAL</th>
         <th style="text-align: center;" width="18%">BRI</th>
         <th style="text-align: center;" width="10%">% BRI</th>
         <th style="text-align: center;" width="18%">OTHER BANK</th>
         <th style="text-align: center;" width="10%">% OTHER BANK</th>
      </tr>
      <?php 
         $totalOi = count($WALLET_SHARE['OTHER_INFO']);
         if ($totalOi > 0) :
            foreach($WALLET_SHARE['OTHER_INFO'] as $oi) :
      ?>
      <tr align="center">
         <td class="txt dis-none" contenteditable="false">transactionalbank</td>
         <td class="txt" contenteditable="false"><?php echo $oi->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($oi->TOTAL_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo number_format($oi->BRI_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($oi->BRI_SHARE_PERCENT * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false"><?php echo number_format($oi->OTHER_SHARE); ?></td>
         <td class="txt" contenteditable="false"><?php echo floor(($oi->OTHER_SHARE_PERCENT * 100))/100; ?> %</td>
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
