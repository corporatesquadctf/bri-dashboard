<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?= base_url('/assets/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>">
<script src="<?= base_url('/assets/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>

<style type="text/css">
    .submitBtn { display: none; }

    .fstMultipleMode { display: block; }
    .fstMultipleMode .fstControls { width: 100%; }

    .chosen-container-multi .chosen-choices {
        width: 400px;
        background: none;
    }
    .chosen-container.chosen-with-drop .chosen-drop {
        display: block;
        width: 400px;
    }
    .fixed-table-container {
        border:none;
    }
    .search-choice-close{
        color:#444;
    }
</style>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Delegation Workflow</h2>
                        <!--   <div class="pull-right">
                              <button id="addBtn" data-toggle="modal" data-target="#add_" class="btn btn-success btn-sm" type="button">
                                  <i class="fa fa-plus"></i>&nbsp;
                                  <b>Add New</b>
                              </button>
                          </div> -->
                        <div class="clearfix"></div>
                        <div id="notif" class="">
                            <!-- NOTIFICATION -->
                        </div>
                    </div>

                    <div class="x_content">
                        <!-- <div class="form-group">
                            <div class="col-md-4 nopadding pull-right">
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Masukkan Customer name...." class="form-control">
                            </div>
                        </div> -->
                        <!-- <div>
                            &nbsp 
                        </div> -->
                        <!-- <table data-toggle="table" data-pagination="true" class="table table-hover table-bordered" style="border-collapse: collapse;"> -->


                        <table id="myTable" data-search="true" data-toggle="table" data-pagination="true" class="table table-hover table-striped table-bordered table-condensed" style="border-collapse: collapse; margin-top: 20px;">
                            <thead style="background-color: #012D5A; color: #FFF; ">
                                <tr class="headings">
                                    <th data-sortable="true">No</th>
                                    <!-- <th data-sortable="true" data-field="customer_name">Group / Company</th> -->
                                    <th data-sortable="true">Company Name</th>
                                    <th data-sortable="true">RM Name</th>
                                    <!-- <th data-sortable="true">vcif</th> -->
                                    <th width="12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                <?php foreach ($companies as $vcif => $company) : ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $index ++ ?></td>
                                        <td>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?= $company['company_name'] ?>      
                                        </td>
                                        <td>
                                            <ul>
                                                <?php foreach ($company['makers'] as $maker) : ?>
                                                    <li><?= $maker['name'] ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                       <!--  <td><?= $vcif ?></td> -->
                                        <td width="12%" style="text-align: center;">
                                            <a id="groupAP" class="btn btn-xs btn-success btn-block groupAP" data-toggle="modal" 
                                               data-target="#edit_<?= $vcif ?>">
                                                <i class="fa fa-eye"></i> <b>Delegation</b>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div> 
        </div>
    </div>
</div>



<?php foreach ($companies as $vcif => $company) : ?>

    <div id="edit_<?= $vcif ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Select PIC</h4>
                </div>
                <div class="modal-body">
                    <form id="delegation-form" action="<?= base_url('admin/configuration/delegate') ?>" method="POST">
                        <div class="form-group">
                            <label for="usr">Customer Name:</label>
                            <input readonly type="text" class="form-control" name="company_name" id="company_name" 
                                   value="<?= $company['company_name'] ?>">
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="usr">VCIF:</label>
                            <input type="text" class="form-control" name="vcif"  id="usr" value="<?= $vcif ?>">
                        </div>
                        <div class="form-group">
                            <label for="usr">RM Existing:</label>
                            <ul>
                                <?php foreach ($company['makers'] as $maker) : ?>
                                    <li><?= $maker['name'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="form-group">
                            <!-- TAG -->

                            <label>Ganti RM</label>
                            <br>


                            <?php foreach ($company['makers'] as $vcif => $maker) : ?>


                                <!-- jika divisi RM terpilih sama dengan divisi session dan RM terpilih null -->
                                <?php if ($maker['division_id'] == $_SESSION['DIVISION'] && $maker['maker_id'] == null && $_SESSION['DIVISION'] !== NULL): ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="company" name="maker_ids[]">
                                        <option 
                                            value="<?= $maker['maker_id']; ?>" 
                                            selected><?= $maker['name']; ?></option>
                                        <option value="0">- None -</option>
                                        <?php foreach ($delegate_candidates as $dc) : ?>
                                            <option value="<?= $dc->id; ?>" data-tokens="<?php echo $dc->name; ?>"><?php echo $dc->name; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif; ?>

                                <!-- jika divisi RM terpilih sama dengan divisi session dan jumlah RM terpilih ada dua -->
                                <?php if ($maker['division_id'] == $_SESSION['DIVISION'] && count($company['makers']) == 2): ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="company" name="maker_ids[]">
                                        <option 
                                            value="<?= $maker['maker_id']; ?>" 
                                            selected><?= $maker['name']; ?></option>
                                        <option value="0">- None -</option>
                                        <?php foreach ($delegate_candidates as $dc) : ?>
                                            <option value="<?= $dc->id; ?>" data-tokens="<?php echo $dc->name; ?>"><?php echo $dc->name; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif; ?>

                                <!-- jika tidak ada yg terpilih (masih kosong) -->
                                <?php if ($maker['maker_id'] == null && $_SESSION['DIVISION'] !== NULL): ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="company" name="maker_ids[]">
                                        <option selected="true" disabled="true">- Pilih RM -</option>
                                        <?php foreach ($delegate_candidates as $dc) : ?>
                                            <option value="<?= $dc->id; ?>" data-tokens="<?php echo $dc->name; ?>"><?php echo $dc->name; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select> 
                                <?php endif; ?>

                                <!-- jika RM terpilih kurang dari dua dan RM terpilih tidak null dan divisi RM terpilih tidak sama-->
                                <?php if (count($company['makers']) < 2 && $maker['maker_id'] !== null && $maker['division_id'] !== $_SESSION['DIVISION'] && $_SESSION['DIVISION'] !== NULL): ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="company" name="maker_ids[]">
                                        <option selected="true" disabled="true">- Pilih RM -</option>
                                        <?php foreach ($delegate_candidates as $dc) : ?>
                                            <option value="<?= $dc->id; ?>" data-tokens="<?php echo $dc->name; ?>"><?php echo $dc->name; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif; ?> 

                                <!-- jika RM terpilih kurang dari dua dan RM terpilih tidak null dan divisi RM terpilih sama-->
                                <?php if (count($company['makers']) < 2 && $maker['maker_id'] !== null && $maker['division_id'] == $_SESSION['DIVISION']): ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="company" name="maker_ids[]">
                                        <option 
                                            value="<?= $maker['maker_id']; ?>" 
                                            selected><?= $maker['name']; ?></option>
                                        <option value="0">- None -</option>
                                        <?php foreach ($delegate_candidates as $dc) : ?>
                                            <option value="<?= $dc->id; ?>" data-tokens="<?php echo $dc->name; ?>"><?php echo $dc->name; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif; ?> 

                                <!-- jika RM terpilih kurang dari dua dan RM terpilih tidak null -->
                                <?php if ($maker['division_id'] !== $_SESSION['DIVISION'] && count($company['makers']) == 2 && $_SESSION['DIVISION'] !== NULL): ?>
                                    <select class="selectpicker form-control"  id="company" name="maker_ids[]">
                                        <option selected="true" disabled>- RM sudah terpilih divisi lain -</option>
                                    </select>
                                <?php endif; ?> 

                                <?php if ($_SESSION['DIVISION'] == NULL): ?>
                                    <select class="selectpicker form-control"  id="company" name="maker_ids[]">
                                        <option selected="true" disabled>- Anda tidak mempunyai divisi-</option>
                                    </select>
                                <?php endif; ?> 

                            <?php endforeach ?>


                        </div>
                        <p>
                            <input type="submit" class="btn btn-sm btn-success form-control" value="Submit">
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/fastselect/fastselect.standalone.js"></script>


<script src="<?= base_url(); ?>assets/chosen/chosen.js"></script>

<script type="text/javascript">
    $(".chosen-select").chosen({
    no_results_text: "Oops, Pilihan Tidak tersedia",
    max_selected_options: 2
    });</script>
<script type="text/javascript">
    $(".chosen-select").chosen({max_selected_options: 2});
    $(".chosen-select").chosen({
    no_results_text: "Oops, Pilihan Tidak tersedia"
    });</script>

<script>
    function searchDelegation() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
    if (td.innerHTML.toUpperCase().indexOf(filter) > - 1) {
    tr[i].style.display = "";
    } else {
    tr[i].style.display = "none";
    }
    }
    }
    }
</script>