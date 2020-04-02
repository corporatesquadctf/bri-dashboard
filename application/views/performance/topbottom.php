<style>
    .alnright { text-align: right; }
    thead{
        background-color: #012D5A; color: #FFF; 
    }
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Top and Bottom Customer <small></small></h3>
            </div>

        </div>

        <div class="clearfix"></div>
        <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-bars"></i> <?= $periode; ?></h2>
                        <?php if ($user_is_restricted == false) : ?>
                            <div class="title_right">
                                <div class="col-sm-3 pull-right">
                                    <select class="selectpicker filter-selectpicker form-control" data-live-search="true" id="divisi" name="divisi" value="<?= $_SESSION['DIVISION']; ?>">
                                        <option value="0">Please Select</option>
                                        <option value="all" <?= "all" == $divisiNow ? 'selected' : '' ?>>All Division</option>
                                        <?php foreach ($masterDivisi as $md) : ?>
                                            <option value="<?= $md->id; ?>"
                                            <?= $md->id == $divisiNow ? 'selected' : '' ?>
                                                    >
                                                        <?= $md->division_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                            </div>
                        <?php endif; ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="pull-right lbl-million" style="padding-right: 10px;">
                            *In Million
                        </div>
                        <br>

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Top Customer</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Bottom Customer</a>
                                </li>

                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                    <div class="table-responsive">
                                        <table data-toggle="table" data-pagination="false" class="table table-striped jambo_table bulk_action">
                                            <thead style="background-color: #012D5A; color: #FFF;">
                                                <tr class="headings">

                                                    <th data-sortable="true" class="column-title">No </th>
                                                    <th data-sortable="true" class="column-title">Customer</th>
                                                    <th data-sortable="true" class="column-title hide">VCIF</th>
                                                    <th data-sortable="true" class="column-title">Ratas Simpanan</th>
                                                    <th data-sortable="true" class="column-title">Ratas Pinjaman</th>
                                                    <th data-sortable="true" class="column-title">Current CPA</th>
                                                    <th data-sortable="true" class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $index = 1; ?>
                                                <?php foreach ($topbottom as $tb) : ?>
                                                    <tr class="even pointer">

                                                        <td class=" "><?= $index ++ ?></td>
                                                        <td class=" "><?= $tb->NAMA_NASABAH; ?></td>
                                                        <td class="hide"><?= $tb->VCIF; ?> </td>
                                                        <td class="alnright" align="right">
                                                            <?= number_format($tb->kredit) ?> 
                                                        </td>
                                                        <td class="alnright" align="right">
                                                            <?= number_format($tb->simpanan) ?> 
                                                        </td>
                                                        <td class="alnright" align="right">
                                                            <?= number_format($tb->jumlah); ?>
                                                        </td>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                        <div class="table-responsive">
                                            <table data-toggle="table" class="table table-striped jambo_table bulk_action">
                                                <thead style="background-color: #012D5A; color: #FFF;">
                                                    <tr class="headings">
                                                        <!-- <th>
                                                            <input type="checkbox" id="check-all" class="flat">
                                                        </th> -->
                                                        <th data-sortable="true" class="column-title">No</th>
                                                        <th data-sortable="true" class="column-title">Customer</th>
                                                        <th data-sortable="true" class="column-title hide">VCIF</th>
                                                        <th data-sortable="true" class="column-title">Ratas Simpanan</th>
                                                        <th data-sortable="true" class="column-title">Ratas Pinjaman</th>
                                                        <th data-sortable="true" class="column-title">Current CPA</th>
                                                        <th data-sortable="true" class="bulk-actions" colspan="7">
                                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $index = 1; ?>
                                                    <?php foreach ($topbottomAsc as $tba) : ?>
                                                        <tr class="even pointer">

                                                            <td class=" "><?= $index ++ ?></td>
                                                            <td class=" "><?= $tba->NAMA_NASABAH; ?></td>
                                                            <td class="hide"><?= $tba->VCIF; ?> </td>
                                                            <td class="alnright" align="right">
                                                                <?= number_format($tba->kredit) ?> 
                                                            </td>
                                                            <td class="alnright" align="right">
                                                                <?= number_format($tba->simpanan) ?> 
                                                            </td>
                                                            <td class="alnright" align="right">
                                                                <?= number_format($tba->jumlah); ?>
                                                            </td>
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
                </div>
            </div>

            <div class="clearfix"></div>

        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        if ($(".pagination-info") && $(".pagination-info")[0]) {
            $(".pagination-info")[0].innerHTML = "Showing 1 to <?= $index - 1 ?> of <?= $index - 1 ?> ";
        }
        ;
        $("#divisi").on('change', function (e) {
            e.preventDefault();
            location.replace("<?= base_url('/performance/topbottom/') ?>" + $(this).val());
        })
    });
</script>