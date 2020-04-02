<style type="text/css">
    th{
        text-align: center;
        font-size: 12px;
    }
    td{
        font-size: 11px;
    }
    .action{
        min-width: 275px;
    }
    .rght{
        text-align: right;
    }


    .parent ~ .cchild {
        display: none;
    }
    .open .parent ~ .cchild {
        display: table-row;
    }
    .parent {
        cursor: pointer;
    }
    tbody {
        color: #212121;
    }
    .open {
        background-color: #e6e6e6;
    }

    .open .cchild {
        background-color: #999;
        color: white;
    }
    .parent > *:last-child {
        width: 30px;
    }
    .parent i {
        transform: rotate(0deg);
        transition: transform .3s cubic-bezier(.4,0,.2,1);
        margin: -.5rem;
        padding: .5rem;

    }
    .open .parent i {
        transform: rotate(180deg)
    }
    .smallwid {
        width: 5%;
        text-align: left;
    }
    .group{
        background: #dcdcdc;
    }
    .smallwidno {
        width: 5%;
    }
    .hdr{
        padding-bottom: 20px;
    }
</style>

<?php
$date = date("Y");
?>
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Customer Leaderboards</h2>
                        <div class="clearfix"></div>
                        <div id="notif" class="">
                            <!-- NOTIFICATION -->
                        </div>
                    </div>
                    <div class="pull-right lbl-million">
                        * In Million
                    </div>
                    <div class="x_content">

                        <div>
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                                </li>
                                <li role="presentation" class=""><a href="#existing" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Existing</a>
                                </li>
                                <li role="presentation" class=""><a href="#new" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">New</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <!-- ALL -->
                                <div id="home" class="tab-pane fade in active">
                                    <table id="myTable" data-toggle="table" data-search="true" data-pagination="true" class=" table table-hover table-bordered table-condensed" >
                                        <thead style="background-color: #012D5A; color: #FFF; ">
                                            <tr class="headings">
                                                <th data-sortable="true" rowspan="2">No</th>
                                                <th data-sortable="true" data-field="customer_name" rowspan="2">Group / Company</th>
                                                <th data-sortable="true" rowspan="2">RM</th>
                                                <th data-sortable="false" colspan="2">Pinjaman</th>
                                                <th data-sortable="false" colspan="2">Simpanan</th>
                                                <th data-sortable="true" data-sortable="true" rowspan="2">Current CPA</th>
                                                <th class="smallwid" rowspan="2" class="action">Value Chain</th>
                                                <th rowspan="2" class="action">Action</th>
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
                                            <?php foreach ($groups as $group_id => $group) : ?>
                                                <tr align="center" class="group">
                                                    <td style="text-align: center;"><b><?= $index; ?></b></td>
                                                    <td>
                                                        <b><?= $group['group_name']; ?></b>
                                                        <?php if (!empty($group['companies'])) : ?>
                                                            <a  data-toggle="collapse" 
                                                                data-target="._no_cif<?= $group_id ?>" 
                                                                aria-expanded="false" aria-controls="detailsRow_1">
                                                                <span class="glyphicon glyphicon-triangle-bottom"></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> </td>
                                                    <td class="rght"><?= number_format($group['outstanding']); ?></td>
                                                    <td class="rght"><?= number_format($group['outstanding_ratas']); ?></td>
                                                    <td class="rght"><?= number_format($group['simpanan']); ?></td>
                                                    <td class="rght"><?= number_format($group['simpanan_ratas']); ?></td>
                                                    <td class="rght"><?= number_format($group['current_cpa']); ?></td>
                                                    <td class="rght">-</td>
                                                    <td>
                                            <center>
                                                <?php if (!empty($group['companies'])) : ?>
                                                    <a data-toggle="collapse"
                                                       onclick="toggleChevron(this)" 
                                                       data-target="._no_cif<?= $group_id ?>" 
                                                       aria-expanded="false" aria-controls="detailsRow_1">
                                                        Lihat Group <span class="glyphicon glyphicon-chevron-down"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </center>
                                            </td>

                                            </tr>
                                            <?php $company_index = 1; ?>
                                            <?php foreach ($group['companies'] as $vcif => $company) : ?>
                                                <tr class=" no_cif_perusahaan _no_cif<?= $group_id; ?>" align="center">
                                                    <td style="text-align: center;"><?= $index . '.' . $company_index++; ?></td>
                                                    <td>
                                                        <?= $company['company_name'] ?>      
                                                    </td>
                                                    <td>     
                                                        <?php foreach ($company['makers'] as $maker) : ?>
                                                            <p><?= $maker['name'] ?></p>                                                        
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="rght"><?= number_format($company['outstanding']) ?></td>
                                                    <td class="rght"><?= number_format($company['outstanding_ratas']) ?></td>
                                                    <td class="rght"><?= number_format($company['simpanan']) ?></td>
                                                    <td class="rght"><?= number_format($company['simpanan_ratas']) ?></td>
                                                    <td class="rght"><?= number_format($company['current_cpa']) ?></td>
                                                    <td></td>
                                                    <td width="12%" style="text-align: center;">
                                                        <div style="margin-top: 10px;">
                                                            <center>
                                                                <a  
                                                                    id="openAP" 
                                                                    name="openAP" 
                                                                    class="btn <?= $company['view'] ?> btn-xs openAP" 
                                                                    href="<?= base_url('perform/viewaccountplannings/viewAp/' . $vcif . '/' . $date) ?>">
                                                                    <i class="fa fa-edit"></i> Account Planning
                                                                </a>
                                                                <a 
                                                                    class="btn btn-primary btn-xs" 
                                                                    style="padding: 0px 34px;"
                                                                    target=”_blank”
                                                                    href="<?= base_url('perform/summary_cpa/view/' . $vcif); ?>">
                                                                    <i class="fa fa-eye"></i> CPA
                                                                </a>
                                                            </center> 
                                                        </div>   
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php $company_index++; ?>
                                            <?php $index++; ?>

                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div id="existing" class="tab-pane fade">
                                    <table id="existTable" data-toggle="table" data-search="true" data-pagination="true" class=" table table-hover table-bordered table-condensed" >
                                        <thead style="background-color: #012D5A; color: #FFF; ">
                                            <tr class="headings">
                                                <th data-sortable="true" rowspan="2">No</th>
                                                <th data-sortable="true" data-field="customer_name" rowspan="2">Group / Company</th>
                                                <th data-sortable="true" rowspan="2">RM</th>
                                                <th data-sortable="false" colspan="2">Pinjaman</th>
                                                <th data-sortable="false" colspan="2">Simpanan</th>
                                                <th data-sortable="true" data-sortable="true" rowspan="2">Current CPA</th>
                                                <th class="smallwid" rowspan="2" class="action">Value Chain</th>
                                                <th rowspan="2" class="action">Action</th>
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
                                            <?php foreach ($old as $group_id => $group) : ?>
                                                <tr align="center" class="group">
                                                    <td style="text-align: center;"><b><?= $index; ?></b></td>
                                                    <td>
                                                        <b><?= $group['group_name']; ?></b>
                                                        <?php if (!empty($group['companies'])) : ?>
                                                            <a  data-toggle="collapse" 
                                                                data-target="._no_cif<?= $group_id ?>" 
                                                                aria-expanded="false" aria-controls="detailsRow_1">
                                                                <span class="glyphicon glyphicon-triangle-bottom"></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> </td>
                                                    <td class="rght"><?= number_format($group['outstanding']); ?></td>
                                                    <td class="rght"><?= number_format($group['outstanding_ratas']); ?></td>
                                                    <td class="rght"><?= number_format($group['simpanan']); ?></td>
                                                    <td class="rght"><?= number_format($group['simpanan_ratas']); ?></td>
                                                    <td class="rght"><?= number_format($group['current_cpa']); ?></td>
                                                    <td class="rght">-</td>
                                                    <td>
                                            <center>
                                                <?php if (!empty($group['companies'])) : ?>
                                                    <a data-toggle="collapse"
                                                       onclick="toggleChevron(this)" 
                                                       data-target="._no_cif<?= $group_id ?>" 
                                                       aria-expanded="false" aria-controls="detailsRow_1">
                                                        Lihat Group <span class="glyphicon glyphicon-chevron-down"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </center>
                                            </td>

                                            </tr>
                                            <?php $company_index = 1; ?>
                                            <?php foreach ($group['companies'] as $vcif => $company) : ?>
                                                <tr class=" no_cif_perusahaan _no_cif<?= $group_id; ?>" align="center">
                                                    <td style="text-align: center;"><?= $index . '.' . $company_index++; ?></td>
                                                    <td>
                                                        <?= $company['company_name'] ?>      
                                                    </td>
                                                    <td>     
                                                        <?php foreach ($company['makers'] as $maker) : ?>
                                                            <p><?= $maker['name'] ?></p>                                                        
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="rght"><?= number_format($company['outstanding']) ?></td>
                                                    <td class="rght"><?= number_format($company['outstanding_ratas']) ?></td>
                                                    <td class="rght"><?= number_format($company['simpanan']) ?></td>
                                                    <td class="rght"><?= number_format($company['simpanan_ratas']) ?></td>
                                                    <td class="rght"><?= number_format($company['current_cpa']) ?></td>
                                                    <td></td>
                                                    <td width="12%" style="text-align: center;">
                                                        <div style="margin-top: 10px;">
                                                            <center>
                                                                <a  
                                                                    id="openAP" 
                                                                    name="openAP" 
                                                                    class="btn <?= $company['view'] ?> btn-xs openAP" 
                                                                    href="<?= base_url('perform/viewaccountplannings/viewAp/' . $vcif . '/' . $date) ?>">
                                                                    <i class="fa fa-edit"></i> Account Planning
                                                                </a>
                                                                <a 
                                                                    class="btn btn-primary btn-xs" 
                                                                    style="padding: 0px 34px;"
                                                                    target=”_blank”
                                                                    href="<?= base_url('perform/summary_cpa/view/' . $vcif); ?>">
                                                                    <i class="fa fa-eye"></i> CPA
                                                                </a>
                                                            </center> 
                                                        </div>   
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php $company_index++; ?>
                                            <?php $index++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div id="new" class="tab-pane fade">
                                    <table id="myTable" data-toggle="table" data-search="true" data-pagination="true" class=" table table-hover table-bordered table-condensed" >
                                        <thead style="background-color: #012D5A; color: #FFF; ">
                                            <tr class="headings" style="height: 80px;">
                                                <th class="hdr" data-sortable="true">No</th>
                                                <th class="hdr" data-sortable="true" data-field="customer_name">Group / Company</th>
                                                <th class="hdr" style="width: 25%;" data-sortable="true">RM</th>
                                                <th class="hdr">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $index = 1; ?>
                                            <?php foreach ($new as $group_id => $group) : ?>
                                                <tr align="center" class="group">
                                                    <td style="text-align: left;"><b><?= $index; ?></b></td>
                                                    <td style="text-align: left;">
                                                        <b><?= $group['group_name'] ?></b>
                                                        <?php if (!empty($group['companies'])) : ?>
                                                            <a  data-toggle="collapse" 
                                                                data-target="._no_cif<?= $group_id ?>" 
                                                                aria-expanded="false" aria-controls="detailsRow_1">
                                                                <span class="glyphicon glyphicon-triangle-bottom"></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> </td>
                                                    <td>
                                            <center>
                                                <?php if (!empty($group['companies'])) : ?>
                                                    <a data-toggle="collapse"
                                                       onclick="toggleChevron(this)" 
                                                       data-target="._no_cif<?= $group_id ?>" 
                                                       aria-expanded="false" aria-controls="detailsRow_1">
                                                        Lihat Group <span class="glyphicon glyphicon-chevron-down"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </center>
                                            </td>

                                            </tr>
                                            <?php $company_index = 1; ?>
                                            <?php foreach ($group['companies'] as $vcif => $company) : ?>
                                                <tr class=" no_cif_perusahaan _no_cif<?= $group_id; ?>" align="center">
                                                    <td style="text-align: left;"><?= $index . '.' . $company_index++; ?></td>
                                                    <td style="text-align: left;"> 
                                                        <?= $company['company_name'] ?>      
                                                    </td>
                                                    <td>     
                                                        <?php foreach ($company['makers'] as $maker) : ?>
                                                            <p><?= $maker['name'] ?></p>                                                        
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td width="12%" style="text-align: center;">
                                                        <div style="margin-top: 10px;">
                                                            <center>
                                                                <a  
                                                                    id="openAP" 
                                                                    name="openAP" 
                                                                    class="btn <?= $company['view'] ?> btn-xs openAP" 
                                                                    href="<?= base_url('perform/viewaccountplannings/viewAp/' . $vcif . '/' . $date) ?>">
                                                                    <i class="fa fa-edit"></i> Account Planning
                                                                </a>
                                                                <a 
                                                                    class="btn btn-primary btn-xs" 
                                                                    style="padding: 0px 34px;"
                                                                    target=”_blank”
                                                                    href="<?= base_url('perform/summary_cpa/view/' . $vcif); ?>">
                                                                    <i class="fa fa-eye"></i> CPA
                                                                </a>
                                                            </center> 
                                                        </div>   
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php $company_index++; ?>
                                            <?php $index++; ?>
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
</div>
<script type="text/javascript">
    $(window).load(function () {
        if ($(".pagination-info") && $(".pagination-info")[0]) {
            $(".pagination-info")[0].innerHTML = "Showing 1 to <?= $index - 1 ?> of <?= $index - 1 ?> ";
        }
        ;
    });
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

    $(".toggle-project-stages").hide();

    $(".toggle-project-status-downArrow").click(function (e) {
        e.preventDefault();
        var $el = $(this);
        var toggleDiv = $el.closest('div').prev('.panel-heading').find(".toggle-project-stages").toggle(200, function () {
            $el.find('i').toggleClass('fa-chevron-down fa-chevron-up');
        });

        $(".toggle-project-stages").not(toggleDiv).slideUp(200);


    });

    window.toggleChevron = function (button) {
        $(button).find('span').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
</script>