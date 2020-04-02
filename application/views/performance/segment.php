<style type="text/css">
    .centero{
        text-align: center;
    }
    .error {
        border-color: red !important; 
        border-width: 2px !important; 
    }
    .rightz{
        text-align: right;
    }

</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Segment Client <small></small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- PIE CHART -->
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <?php if ($user_is_restricted == false) : ?>
                            <div class="col-md-3 pull-right">
                                <select class="selectpicker filter-selectpicker form-control" data-live-search="true" id="divisi_segment" name="divisi" value="<?php echo $_SESSION['DIVISION']; ?>">
                                    <option value="0">Please Select</option>
                                    <!--<option value="all" <?= "all" == $divisiNow ? 'selected' : '' ?>>All Division</option>-->
                                    <?php foreach ($masterDivisi as $md) : ?>
                                        <option value="<?php echo $md->id; ?>"
                                        <?= $md->id == $divisiNow ? 'selected' : '' ?>
                                                >
                                                    <?php echo $md->division_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <h2><i class="fa fa-bars"></i> Segment Client Leaderboard</h2>
                        <!--  <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                            
                         </ul> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content2">
                        <div id="graph_donut2" style="width:100%; height:300px;"></div>
                    </div>
                    <!-- <div class="x_content"> -->
                       <!-- <canvas id="segmentClientChart"></canvas> -->
                    <!-- </div> -->
                </div>
            </div>
            <!-- PIE CHART -->
            <!-- TABLE -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-bars"></i> Classification </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="pull-right lbl-million">
                            *In Milion
                        </div>
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Platinum</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Gold</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Silver</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Bronze</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                    <div class="table-responsive">
                                        <table data-toggle="table" data-pagination="true" class="table table-striped jambo_table bulk_action">
                                            <thead style="background-color: #012D5A; color: #FFF; ">
                                                <tr class="headings">

                                                    <th data-sortable="true" class="column-title">No </th>
                                                    <th data-sortable="true" class="column-title">Group</th>
                                                    <th data-sortable="true" class="column-title">Ratas Simpanan</th>
                                                    <th data-sortable="true" class="column-title">Ratas Pinjaman</th>
                                                    <th data-sortable="true" class="column-title centero">Current CPA</th>
                                                    <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                        <th data-sortable="true" class="column-title">Action</th>
                                                    <?php endif; ?>
                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">
                                                            Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($platinum as $key => $sg) : ?>
                                                    <tr class="<?= $key % 2 == 0 ? 'odd' : 'even' ?> pointer">
                                                        <td class=""><?= $key + 1 ?></td>
                                                        <td class=""><?= $sg['group_name'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['fee'] ?> <!-- <i class="success fa fa-long-arrow-up"></i> --></td>
                                                        <td class="rightz" align="right"><?= $sg['outstanding'] ?></td>
                                                        <td class="rightz " align="right"><?= $sg['profit'] ?></td>
                                                        <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                            <td class="">
                                                                <button class="demote_this btn-danger" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                                    Demote
                                                                </button>
                                                                <?php if ($sg['promoted'] == 1) : ?>
                                                                    <button class="reset_this btn-warning" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                        <span class="fa fa-refresh"></span>
                                                                        Reset</button>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr> 
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                    <div class="table-responsive">
                                        <table data-toggle="table" class="table table-striped jambo_table bulk_action">
                                            <thead style="background-color: #012D5A; color: #FFF; ">
                                                <tr class="headings">
                                                    <th data-sortable="true" class="column-title">No</th>
                                                    <th data-sortable="true" class="column-title">Group</th>
                                                    <th data-sortable="true" class="column-title">Ratas Simpanan</th>
                                                    <th data-sortable="true" class="column-title">Ratas Pinjaman</th>
                                                    <th data-sortable="true" class="column-title centero">Current CPA</th>
                                                    <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                        <th data-sortable="true" class="column-title">Action</th>
                                                    <?php endif; ?>
                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($gold as $key => $sg) : ?>
                                                    <tr class="<?= $key % 2 == 0 ? 'odd' : 'even' ?> pointer">

                                                        <td class=""><?= $key + 1 ?></td>
                                                        <td class=""><?= $sg['group_name'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['fee'] ?> <!-- <i class="success fa fa-long-arrow-up"></i> --></td>
                                                        <td class="rightz" align="right"><?= $sg['outstanding'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['profit'] ?></td>
                                                        <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                            <td class="">
                                                                <button class="promote_this btn-primary" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                                    Promote
                                                                </button>
                                                                <button class="demote_this btn-danger " id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                                    Demote
                                                                </button>
                                                                <?php if ($sg['promoted'] == 1) : ?>
                                                                    <button class="reset_this btn-warning" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                        <span class="fa fa-refresh"></span>
                                                                        Reset</button>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>

                                                    </tr> 
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                    <div class="table-responsive">
                                        <table data-toggle="table" class="table table-striped jambo_table bulk_action">
                                            <thead style="background-color: #012D5A; color: #FFF; ">
                                                <tr class="headings">
                                                    <th data-sortable="true" class="column-title">No</th>
                                                    <th data-sortable="true" class="column-title">Group</th>
                                                    <th data-sortable="true" class="column-title">Ratas Simpanan</th>
                                                    <th data-sortable="true" class="column-title">Ratas Pinjaman</th>
                                                    <th class="column-title centero">Current CPA</th>
                                                    <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                        <th data-sortable="true" class="column-title">Action</th>
                                                    <?php endif; ?>

                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($silver as $key => $sg) : ?>
                                                    <tr class="<?= $key % 2 == 0 ? 'odd' : 'even' ?> pointer">

                                                        <td class=""><?= $key + 1 ?></td>
                                                        <td class=""><?= $sg['group_name'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['fee'] ?> <!-- <i class="success fa fa-long-arrow-up"></i> --></td>
                                                        <td class="rightz" align="right"><?= $sg['outstanding'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['profit'] ?></td>
                                                        <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                            <td class="">
                                                                <button class="promote_this btn-primary" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>"><span class="glyphicon glyphicon-arrow-up"></span> Promote</button>
                                                                <button class="demote_this btn-danger" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>"><span class="glyphicon glyphicon-arrow-down"></span> Demote</button>
                                                                <?php if ($sg['promoted'] == 1) : ?>
                                                                    <button class="reset_this btn-warning" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                        <span class="fa fa-refresh"></span>
                                                                        Reset</button>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>

                                                    </tr> 
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab3">
                                    <div class="table-responsive">
                                        <table data-toggle="table" class="table table-striped jambo_table bulk_action">
                                            <thead style="background-color: #012D5A; color: #FFF; ">
                                                <tr class="headings">
                                                    <th data-sortable="true" class="column-title">No</th>
                                                    <th data-sortable="true" class="column-title">Group</th>
                                                    <th data-sortable="true" class="column-title">Ratas Simpanan</th>
                                                    <th data-sortable="true" class="column-title">Ratas Pinjaman</th>
                                                    <th class="column-title centero">Current CPA</th>
                                                    <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                        <th data-sortable="true" class="column-title">Action</th>
                                                    <?php endif; ?>

                                                    <th class="bulk-actions" colspan="7">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($bronze as $key => $sg) : ?>
                                                    <tr class="<?= $key % 2 == 0 ? 'odd' : 'even' ?> pointer">

                                                        <td class=""><?= $key + 1 ?></td>
                                                        <td class=""><?= $sg['group_name'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['fee'] ?> <!-- <i class="success fa fa-long-arrow-up"></i> --></td>
                                                        <td class="rightz" align="right"><?= $sg['outstanding'] ?></td>
                                                        <td class="rightz" align="right"><?= $sg['profit'] ?></td>
                                                        <?php if ($user_is_restricted_filter_promote == false) : ?>
                                                            <td class="">
                                                                <button class="promote_this btn-primary" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                                    Promote
                                                                </button>
                                                                <?php if ($sg['promoted'] == 1) : ?>
                                                                    <button class="reset_this btn-warning" id="<?= $sg['group_id'] . '/' . $sg['current'] ?>">
                                                                        <span class="fa fa-refresh"></span>
                                                                        Reset</button>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
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

            <div class="clearfix"></div>

        </div>
    </div>
</div>


<!-- MODAL INSERT -->
<div class="modal fade" id="add_" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Description</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left cmxform" id="customerForm" method="GET">
                    <div class="form-group">
                        <label for="Group Name" class="control-label col-md-3 col-sm-3 col-xs-12 pull-left">Group Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="hidden" id="currentUser" name="currentUser" value="<?php echo $_SESSION['USER_ID']; ?>">
                            <input type="hidden" id="sementara" name="sementara" value="">
                            <input type="hidden" id="promote_demote" name="promote_demote" value="">
                            <input type="text" name="desc" id="desc" class="form-control textOnly" minlength="2" placeholder="Description">
                            <label id="error" for="Error" class="control-label hide"></label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 pull-right" style="margin-top: 20px">
                            <!-- <input type="button" class="btn btn-sm btn-danger" id="cancelBtn" value="Cancel" onclick="this.form.reset();"> -->
                            <input id="addThis" type="submit" class="btn btn-sm btn-success form-control" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <input type="submit"  id="saveBtn" class="btn btn-primary saveBtn" value="Submit" data-dismiss="modal">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>    
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url(); ?>assets/chart.js/dist/Chart.min.js"></script>

<script type="text/javascript">

<?php if ($user_is_restricted == false) : ?>
        $("select#divisi_segment").on('change', function (e) {
            e.preventDefault();
            if ($(this).val() == "0") {
                location.replace("<?= base_url('/perform/segment/') ?>");
            } else {
                location.replace("<?= base_url('/perform/segment/index/') ?>" + $(this).val());
            }
        })
<?php endif; ?>

    var success_promote = function () {
        location.reload();
    };

    var success_demote = function () {
        location.reload();
    };

    var success_reset = function () {
        location.reload();
    };

    $(window).load(function () {
        $(".promote_this").on('click', function (e) {
            e.preventDefault;
            var a = $(this)[0].id;
            $("#add_ #sementara").val(a);
            $("#add_ #promote_demote").val("promote");
            $("#add_").modal();
        })
        $("button.demote_this").on('click', function (e) {
            e.preventDefault;
            var a = $(this)[0].id;
            $("#add_ #sementara").val(a);
            $("#add_ #promote_demote").val("demote")
            $("#add_").modal();
        })
        $(".reset_this").on('click', function () {
            var a = $(this)[0].id;
            var arr = a.split("/");
            var param = {
                group_id: arr[0]
            }
            var url = '<?= base_url('/perform/segment/reset') ?>';
            $.post(url, param, success_reset)
        })
    });

    $("#addThis").on('click', function (e) {
        e.preventDefault();
        var a = $("#add_ #sementara").val();
        var trigger = $("#add_ #promote_demote").val()
        var desc = $("#add_ #desc").val()
        var error = false;
        $(".error").removeClass('error');
        $("#add_ #error").addClass('hide');

        //Validasi Desc -- mandatory
        if (desc.trim() == "") {
            error = true;
            $("#add_ #desc").addClass('error');
            $("#add_ #error").removeClass('hide');
            $("#add_ #error").html('Description is Mandatory');

        }
        if (error) {
            return
        }
        $('#add_').modal('hide');
        var arr = a.split("/");
        var param = {
            group_id: arr[0],
            current: arr[1],
            desc: desc
        }
        var url = '<?= base_url('/perform/segment/') ?>' + trigger;
        if (trigger == "promote") {
            $.post(url, param, success_promote)
        } else {
            $.post(url, param, success_demote)
        }
    })
    $(document).ready(function () {
        var clsf = ["Platinum", "Gold", "Silver", "Bronze"];
        var data = [{

            }]
        Morris.Donut({
            element: 'graph_donut2',
            data: [
                {label: 'Platinum', value: <?= $platinum_percentage ?>},
                {label: 'Gold', value: <?= $gold_percentage ?>},
                {label: 'Silver', value: <?= $silver_percentage ?>},
                {label: 'Bronze', value: <?= $bronze_percentage ?>}
            ],
            colors: ['#E5E4E2', '#FEEF61', '#C0C0C0', '#CD7F32'],
            formatter: function (y) {
                return y + "%";
            },
            resize: true
        });
    });
</script>

<!-- <script src="<?= base_url(); ?>/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        
    });
</script> -->