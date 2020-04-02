<style type="text/css">
    th{
        text-align: center;
        font-size: 12px;
    }
    td{
        font-size: 11px;
    }
     .rght{
        text-align: right;
    }
</style>
<div class="right_col" role="main">
        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-lg-9 col-xs-12">
                        <h2> RM Monitoring </h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- <div class="title_right">
                            <div  class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input id="myInput" onkeyup="myFunction()" type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <table id="myTable" data-search="true" data-toggle="table" data-pagination="true" class="table table-striped table-hover">
                        <thead style="background-color: #012D5A; color: #FFF;">
                            <tr class="headings">
                                <th data-sortable="true" rowspan="2">No </th>
                                <th data-sortable="true" data-field="customer_name" rowspan="2">RM</th>
                                <th data-sortable="true" rowspan="2">Divisi</th>
                                <th data-sortable="false" colspan="2">Pinjaman</th>
                                <th data-sortable="false" colspan="2">Simpanan</th>
                                <th data-sortable="true" data-sortable="true" rowspan="2">Current CPA</th>
                                <th data-sortable="true" data-sortable="true" rowspan="2">Task</th>
                             <!--    <th width="12%" rowspan="2">Action</th> -->
                            </tr>
                            <tr>
                                <th data-sortable="true">Total</th>
                                <th data-sortable="true">Ratas</th>
                                <th data-sortable="true">Total</th>
                                <th data-sortable="true">Ratas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($rmusers as $rmuser_id => $rmuser) : ?>
                            <tr>
                                <td><?= $index; ?></td>
                                <td><?= $rmuser['rm_name']; ?></td>
                                <td><?= $rmuser['division']; ?></td>
                                <td class="rght"><?= $rmuser['outstanding']; ?></td>
                                <td class="rght"><?= $rmuser['outstanding_ratas']; ?></td>
                                <td class="rght"><?= $rmuser['simpanan']; ?></td>
                                <td class="rght"><?= $rmuser['simpanan_ratas']; ?></td>
                                <td class="rght"><?= $rmuser['current_cpa']; ?></td>
                                <td>
                                    <?php foreach($rmuser['tasks'] as $task) : ?>
                                       <p> <?= $task['customer_name']; ?> </p>
                                    <?php endforeach; ?>
                                </td>
                                <!-- <td></td> -->
                            </tr>
                            <?php $index++?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>