                  <?php if (!empty($results)) {?>
                    <table width="100%" id="table_ClassificationList" class="table" style="font-size: 12px;">
                      <thead style="background-color: transparent; color: #218FD8;">
                        <tr class="modal_table_title">
                          <th width="5%">No</th>
                          <th>Company</th>
                          <th style="text-align: right;">Ratas Pinjaman</th>
                          <th style="text-align: right;">Total Pinjaman</th>
                          <th style="text-align: right;">Ratas Simpanan</th>
                          <th style="text-align: right;">Total Simpanan</th>
                          <!-- <th style="text-align: right;">RoRa</th>
                          <th style="text-align: right;">RaRoc</th> -->
                          <th style="text-align: right;">Current CPA</th>
                       </tr>
                      </thead>
                      <tbody>
                        <?php $indexAP = 1; ?>
                        <?php foreach ($results as $rows => $values) : ?>
                        <tr class="modal_table_list">
                          <td><?= $indexAP; ?></td>
                          <td><?= $values['CustomerGroupName'] ?></td>
                          <td align="right"><?= $values['PinjamanTotalGroup'] ?></td>
                          <td align="right"><?= $values['PinjamanTotalGroup'] ?></td>
                          <td align="right"><?= $values['SimpananTotalGroup'] ?></td>
                          <td align="right"><?= $values['SimpananRatasGroup'] ?></td>
                          <!-- <td align="right"><?= $values['RoRaGroup'] ?></td>
                          <td align="right"><?= $values['RarocGroup'] ?></td> -->
                          <td align="right"><?= $values['CurrentCPAGroup'] ?></td>
                        </tr>
                        <?php $indexAP++?>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    <div>No data.</div>
                  <?php } ?>


<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_ClassificationList').DataTable({
      "pageLength": 20,
      "initComplete": function () {
      }
    });
  });  
</script>


