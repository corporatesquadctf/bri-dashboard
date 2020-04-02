
<b>Direct Loan</b>
<div id="table-estimated_financial_dirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr style="background: #012D5A; color: #fff;">
         <th rowspan="2">Facilities</th>
         <th colspan="2">Projection (Customer)</th>
         <th colspan="2">Target (BRI)</th>
      </tr>
      <tr class="estimated_financial_dirloan" style="background: #012D5A; color: #fff;">
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
      </tr>
      <?php 
         $totalDl = count($ESTIMATED_FINANCIAL['DIRECT_LOAN']);
         if ($totalDl > 0) :
            foreach($ESTIMATED_FINANCIAL['DIRECT_LOAN'] as $dl) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $dl->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($dl->PROJECTION_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($dl->PROJECTION_VALAS * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($dl->TARGET_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($dl->TARGET_VALAS * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-estimated_financial_dirloan"></p>
</div>  

<b>InDirect Loan</b>
<div id="table-estimated_financial_indirloan" class="table-editable table-account-planning">
   <table class="table">
      <tr style="background: #012D5A; color: #fff;">
         <th rowspan="2">Facilities</th>
         <th colspan="2">Projection (Customer)</th>
         <th colspan="2">Target (BRI)</th>
      </tr>
      <tr class="estimated_financial_indirloan" style="background: #012D5A; color: #fff;">
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
      </tr>
      <?php 
         $totalIl = count($ESTIMATED_FINANCIAL['INDIRECT_LOAN']);
         if ($totalIl > 0) :
            foreach($ESTIMATED_FINANCIAL['INDIRECT_LOAN'] as $il) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $il->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($il->PROJECTION_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($il->PROJECTION_VALAS * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($il->TARGET_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($il->TARGET_VALAS * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-estimated_financial_indirloan"></p>
</div>

<b>Cash</b>
<div id="table-estimated_financial_cash" class="table-editable table-account-planning">
   <table class="table">
      <tr style="background: #012D5A; color: #fff;">
         <th rowspan="2">Facilities</th>
         <th colspan="2">Projection (Customer)</th>
         <th colspan="2">Target (BRI)</th>
      </tr>
      <tr class="estimated_financial_cash" style="background: #012D5A; color: #fff;">
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
      </tr>
      <?php 
         $totalCs = count($ESTIMATED_FINANCIAL['CASH']);
         if ($totalCs > 0) :
            foreach($ESTIMATED_FINANCIAL['CASH'] as $cs) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $cs->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($cs->PROJECTION_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($cs->PROJECTION_VALAS * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($cs->TARGET_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($cs->TARGET_VALAS * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
<p id="export-estimated_financial_cash"></p>
</div>

<b>Transaction Banking</b>
<div id="table-estimated_financial_transc_banking" class="table-editable table-account-planning">
   <table class="table">
      <tr style="background: #012D5A; color: #fff;">
         <th rowspan="2">Facilities</th>
         <th colspan="2">Projection (Customer)</th>
         <th colspan="2">Target (BRI)</th>
      </tr>
      <tr class="estimated_financial_transc_banking" style="background: #012D5A; color: #fff;">
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
      </tr>
      <?php 
         $totalTb = count($ESTIMATED_FINANCIAL['TRAN_BANK']);
         if ($totalTb > 0) :
            foreach($ESTIMATED_FINANCIAL['TRAN_BANK'] as $tb) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $tb->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($tb->PROJECTION_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($tb->PROJECTION_VALAS * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($tb->TARGET_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($tb->TARGET_VALAS * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-estimated_financial_transc_banking"></p>
</div>
=======
<br />
    <b>Direct Loan</b>
    <div id="table-estimated_financial_dirloan" class="table-editable table-account-planning">
      <!-- <span class="table-estimated_financial_dirloan-add glyphicon glyphicon-plus"></span> -->
      <table class="table">
        <tr style="background: #012D5A; color: #fff;">
          <th rowspan="2">Facilities</th>
          <th colspan="2">Projection (Customer)</th>
          <th colspan="2">Target (BRI)</th>
          <!-- <th rowspan="2"></th> -->
        </tr>
        <tr class="estimated_financial_dirloan" style="background: #012D5A; color: #fff;">
          <!-- <th>No.</th> -->
          <th>IDR</th>
          <th>Valas</th>
          <th>IDR</th>
          <th>Valas</th>
        </tr>
        <tr align="center">
          <td class="txt" contenteditable="false" style="text-align: left;">KI Capex 2018</td>
          <td class="txt" contenteditable="false" style="text-align: right;">100,000</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <td class="txt" contenteditable="false" style="text-align: right;">800,000 </td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <!-- <td><span class="table-remove glyphicon glyphicon-remove"></span></td> -->
        </tr>
        <tr align="center">
          <td class="txt" contenteditable="false" style="text-align: left;">KMK</td>
          <td class="txt" contenteditable="false" style="text-align: right;">500,000</td>
          <td class="txt" contenteditable="false" style="text-align: right;">100<span> %</span></td>
          <td class="txt" contenteditable="false" style="text-align: right;">300,000 </td>
          <td class="txt" contenteditable="false" style="text-align: right;">60<span> %</span></td>
          <!-- <td><span class="table-remove glyphicon glyphicon-remove"></span></td> -->
        </tr>
        <!-- This is our clonable table line -->
        <tr class="hide" align="center">
          <!-- <td class="txt" contenteditable="false">Untitled</td> -->
          <td class="txt" contenteditable="false" placeholder=". . ."></td>
          <td class="txt" contenteditable="false" placeholder=". . ."></td>
          <td class="txt" contenteditable="false" placeholder=". . ."></td>
          <td class="txt" contenteditable="false" placeholder=". . ."></td>
          <td class="txt" contenteditable="false" placeholder=". . ."></td>
          <!-- <td>
            <span class="table-estimated_financial_dirloan-up glyphicon glyphicon-arrow-up"></span>
            <span class="table-estimated_financial-down glyphicon glyphicon-arrow-down"></span>
            <span class="table-remove glyphicon glyphicon-remove"></span>
          </td> -->
        </tr>
      </table>
     <!--  <div class="btn-annual">
        <button id="export-estimated_financial_dirloan-btn" class="btn btn-primary">Save Data</button>
        <button id="export-btn" class="btn btn-warning table-estimated_financial_dirloan-add">
          <span class="glyphicon glyphicon-plus"></span> Row
        </button>
      </div>
    <p id="export-estimated_financial_dirloan"></p> -->
    </div>
  

    <b>InDirect Loan</b>
    <div id="table-estimated_financial_indirloan" class="table-editable table-account-planning">
      <table class="table">
        <tr style="background: #012D5A; color: #fff;">
          <th rowspan="2">Facilities</th>
          <th colspan="2">Projection (Customer)</th>
          <th colspan="2">Target (BRI)</th>
          <!-- <th rowspan="2"></th> -->
        </tr>
        <tr class="estimated_financial_dirloan" style="background: #012D5A; color: #fff;">
          <!-- <th>No.</th> -->
          <th>IDR</th>
          <th>Valas</th>
          <th>IDR</th>
          <th>Valas</th>
        </tr>
        <tr align="center">
          <td class="txt" contenteditable="false" style="text-align: left;">Bank Guarantee</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <td class="txt" contenteditable="false" style="text-align: right;">0</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <!-- <td><span class="table-remove glyphicon glyphicon-remove"></span></td> -->
        </tr>
        <tr align="center">
          <td class="txt" contenteditable="false" style="text-align: left;">L/C</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <td class="txt" contenteditable="false" style="text-align: right;">0</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <!-- <td><span class="table-remove glyphicon glyphicon-remove"></span></td> -->
        </tr>
        <tr align="center">
          <td class="txt" contenteditable="false" style="text-align: left;">SKBDN</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <td class="txt" contenteditable="false" style="text-align: right;">0</td>
          <td class="txt" contenteditable="false" style="text-align: right;">0<span> %</span></td>
          <!-- <td><span class="table-remove glyphicon glyphicon-remove"></span></td> -->
        </tr>
        <!-- This is our clonable table line -->
        <tr class="hide" align="center">
          <!-- <td class="txt" contenteditable="false">Untitled</td> -->
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
         <!--  <td>
            <span class="table-estimated_financial_indirloan-up glyphicon glyphicon-arrow-up"></span>
            <span class="table-estimated_financial_indirloan-down glyphicon glyphicon-arrow-down"></span>
            <span class="table-remove glyphicon glyphicon-remove"></span>
          </td> -->
        </tr>
      </table>
    <!--  <div class="btn-annual">
      <button id="export-estimated_financial_indirloan-btn" class="btn btn-primary">Save Data</button>
      <button id="export-btn" class="btn btn-warning table-estimated_financial_indirloan-add">
        <span class="glyphicon glyphicon-plus"></span> Row
      </button>
    </div>
    <p id="export-estimated_financial_indirloan"></p> -->
    </div>
    <br>
    

    <b>Transaction Banking</b>
    <div id="table-estimated_financial_transc_banking" class="table-editable table-account-planning">
      <!-- <span class="table-estimated_financial_transc_banking-add glyphicon glyphicon-plus"></span> -->
      <table class="table">
        <tr class="estimated_financial_transc_banking" style="background: #012D5A; color: #fff;">
          <th>Facilities</th>
          <th>IDR</th>
          <th>Valas</th>
          <th>IDR</th>
          <th>Valas</th>
          <!-- <th></th> -->
        </tr>
        <tr align="center">
          <!-- <td class="txt" contenteditable="false">1</td> -->
          <td class="txt" contenteditable="false">Pengembangan </td>
          <td class="txt" contenteditable="false">100%</td>
          <td class="txt" contenteditable="false">100%</td>
          <td class="txt" contenteditable="false">20020 </td>
          <td class="txt" contenteditable="false">30% </td>
          <!-- <td>
            <span class="table-estimated_financial_transc_banking-up glyphicon glyphicon-arrow-up"></span>
            <span class="table-estimated_financial_transc_banking-down glyphicon glyphicon-arrow-down"></span>
            <span class="table-remove glyphicon glyphicon-remove"></span>
          </td> -->
        </tr>
        <!-- This is our clonable table line -->
        <tr class="hide" align="center">
          <!-- <td class="txt" contenteditable="false">Untitled</td> -->
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td>
            <!-- <span class="table-estimated_financial_transc_banking-up glyphicon glyphicon-arrow-up"></span>
            <span class="table-estimated_financial_transc_banking-down glyphicon glyphicon-arrow-down"></span> -->
            <span class="table-remove glyphicon glyphicon-remove"></span>
          </td>
        </tr>
      </table>
      <!-- <div class="btn-annual">
          <button id="export-estimated_financial_transc_banking-btn" class="btn btn-primary">Save Data</button>
          <button id="export-btn" class="btn btn-warning table-estimated_financial_transc_banking-add">
            <span class="glyphicon glyphicon-plus"></span> Row
          </button>
        </div>
        <p id="export-estimated_financial_transc_banking"></p> -->
    </div>

    <b>Cash</b>
    <div id="table-estimated_financial_cash" class="table-editable table-account-planning">
      <!-- <span class="table-estimated_financial_cash-add glyphicon glyphicon-plus"></span> -->
      <table class="table">
        <tr class="estimated_financial_cash" style="background: #012D5A; color: #fff;">
          <th>Facilities</th>
          <th>IDR</th>
          <th>Valas</th>
          <th>IDR</th>
          <th>Valas</th>
          <!-- <th></th> -->
        </tr>
        <tr align="center">
          <!-- <td class="txt" contenteditable="false">1</td> -->
          <td class="txt" contenteditable="false">Pengembangan </td>
          <td class="txt" contenteditable="false">100%</td>
          <td class="txt" contenteditable="false">100%</td>
          <td class="txt" contenteditable="false">20020 </td>
          <td class="txt" contenteditable="false">30% </td>
          <!-- <td>
            <span class="table-estimated_financial_cash-up glyphicon glyphicon-arrow-up"></span>
            <span class="table-estimated_financial_cash-down glyphicon glyphicon-arrow-down"></span>
            <span class="table-remove glyphicon glyphicon-remove"></span>
          </td> -->
        </tr>
        <!-- This is our clonable table line -->
        <tr class="hide" align="center">
          <!-- <td class="txt" contenteditable="false">Untitled</td> -->
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <td class="txt" contenteditable="false">...</td>
          <!-- <td>
            <span class="table-estimated_financial_cash-up glyphicon glyphicon-arrow-up"></span>
            <span class="table-estimated_financial_cash-down glyphicon glyphicon-arrow-down"></span>
            <span class="table-remove glyphicon glyphicon-remove"></span>
          </td> -->
        </tr>
      </table>
      <!-- <div class="btn-annual">
        <button id="export-estimated_financial_cash-btn" class="btn btn-primary">Save Data</button>
        <button id="export-btn" class="btn btn-warning table-estimated_financial_cash-add">
          <span class="glyphicon glyphicon-plus"></span> Row
        </button>
      </div>
      <p id="export-estimated_financial_cash"></p> -->

<b>Other Informations</b>
<div id="table-estimated_financial_other_info" class="table-editable table-account-planning">
   <table class="table">
      <tr style="background: #012D5A; color: #fff;">
         <th rowspan="2">Facilities</th>
         <th colspan="2">Projection (Customer)</th>
         <th colspan="2">Target (BRI)</th>
      </tr>
      <tr class="estimated_financial_other_info" style="background: #012D5A; color: #fff;">
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
         <th style="text-align: center;" width="18%">IDR</th>
         <th style="text-align: center;" width="18%">Valas</th>
      </tr>
      <?php 
         $totalOi = count($ESTIMATED_FINANCIAL['OTHER_INFO']);
         if ($totalOi > 0) :
            foreach($ESTIMATED_FINANCIAL['OTHER_INFO'] as $oi) :
      ?>
      <tr align="center">
         <td class="txt" contenteditable="false" style="text-align: left;"><?php echo $oi->DETAIL_NAME; ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($oi->PROJECTION_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($oi->PROJECTION_VALAS * 100))/100; ?> %</td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo number_format($oi->TARGET_IDR); ?></td>
         <td class="txt" contenteditable="false" style="text-align: right;"><?php echo floor(($oi->TARGET_VALAS * 100))/100; ?> %</td>
      </tr>
      <?php 
            endforeach;
         else :
      ?>
      <tr align="center"><td colspan="5" style="text-align: center;">No records available.</td></tr>
      <?php endif; ?>
   </table>
   <p id="export-estimated_financial_other_info"></p>
</div>