<script src="<?= base_url(); ?>assets/jsPdf/jsPdf.js"></script>

<!--
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script> // dependency for Kendo UI API
 <script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
 <script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
-->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/custom/css/mycss.css">
<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<style type="text/css">
    .submitBtn { display: none; }

    .fstMultipleMode { display: block; }
    .fstMultipleMode .fstControls { width: 100%; }
    .chosen-container-multi{width: 100% !important;}
    .chosen-container{width: 100% !important;}
</style>


<div id="html-2-pdfwrapper" class="right_col" role="main">

    <div class="container">
        <div class="1" style="margin-bottom: -40px;">
            <div class="x_title" style="text-transform: uppercase; padding: 20px; background: #2a3f54; color: #fff;">
                <div class="col-lg-5 col-xs-12">
                    <b style="text-transform: uppercase;">
                        <h3>ACCOUNT PLANNING</h3>
                        <?= $account_planning['customer_name']; ?>
                    </b>
                </div>
                <div class="col-lg-2 col-xs-12">
                    <br>YEAR : </br>
                    <span style="font-size: 16px; color: #FFF;"><b><?= $account_planning['doc_year']; ?></b></span>
                    <?php if ($mode == 'view') : ?>
                        <a href="#" data-toggle="modal" data-target="#history">
                            <span class="glyphicon glyphicon-time"></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <br>Division : </br>
                    <!-- <select id="division" class="form-control" required="true"> -->
                    <?php foreach ($mydivisi as $md) : ?>

                        <?= $md->DIVISION_NAME; ?>
                    <?php endforeach; ?>
                    <!-- </select> -->


                </div>

                <div class="col-lg-2 col-xs-12">
                    <br>Classification : </br>
                    <?php
                    $a = $parameter[0]->MASTER_SUPER_CLASSIFICATIONS;

                    if ($a == "") {
                        echo '- Not classified -';
                    } else {
                        echo $a;
                    }
                    ?> 
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="1">
            <section>
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs1" role="tablist">
                            <li role="presentation" class="<?php echo $page == 1 ? "active" : ""; ?>">
                                <a href="#step1" data-toggle="tab" aria-controls="Company Information" role="tab" title="Company Information">
                                    <span class="round-tab">
                                        <i class="fa fa-building"></i>
                                    </span>
                                </a>
                                <div class="label-wizard">
                                    <center>Company<br> Information</center>
                                </div>
                            </li>
                            <li role="presentation" class="
                            <?php
                            if ($page == 2) {
                                echo "active";
                            } else if ($page > 2) {
                                echo "";
                            } else {
                                echo "disabled";
                            }
                            ?>
                                ">
                                <a href="#step2" data-toggle="tab" aria-controls="bri" role="tab" title="BRI Starting Position">
                                    <span class="round-tab">
                                        <i class="fa fa-users"></i>
                                    </span>
                                </a>
                                <div class="label-wizard">
                                    <center>BRI Starting<br> Position</center>
                                </div>
                            </li>
                            <li role="presentation" class="
                            <?php
                            if ($page == 3) {
                                echo "active";
                            } else if ($page > 3) {
                                echo "";
                            } else {
                                echo "disabled";
                            }
                            ?>
                                ">
                                <a href="#step3" data-toggle="tab" aria-controls="Client Needs" role="tab" title="Client Needs">
                                    <span class="round-tab">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </a>
                                <div class="label-wizard">
                                    <center>Client <br>Needs</center>
                                </div>
                            </li>
                            <li role="presentation" class="
                            <?php
                            if ($page == 4) {
                                echo "active";
                            } else if ($page > 4) {
                                echo "";
                            } else {
                                echo "disabled";
                            }
                            ?>
                                ">
                                <a href="#step4" data-toggle="tab" aria-controls="Action Plan" role="tab" title="Action Plan">
                                    <span class="round-tab">
                                        <i class="fa fa-sitemap"></i>
                                    </span>
                                </a>
                                <div class="label-wizard">
                                    <center>Action <br>Plan</center>
                                </div>
                            </li>
                            <li role="presentation" class="
                            <?php
                            if ($page == 5) {
                                echo "active";
                            } else {
                                echo "disabled";
                            }
                            ?>
                                ">
                                <a href="#step5" data-toggle="tab" aria-controls="Input_" role="tab" title="Input Simulasi">
                                    <span class="round-tab">
                                        <i class="fa fa-file"></i>
                                    </span>
                                </a>
                                <div class="label-wizard">
                                    <center>Input <br> Simulasi</center>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <div class="tab-content">
                            <div class="tab-pane <?php echo $page == 1 ? "active" : ""; ?>" role="tabpanel" id="step1">
                                <?php $this->load->view('performance/company/company_information.php'); ?>
                                <ul class="list-inline pull-right tab-btn">
                                    <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane <?php echo $page == 2 ? "active" : "disabled"; ?>" role="tabpanel" id="step2">
                                <?php $this->load->view('performance/company/bri_starting/bri_starting.php'); ?>
                                <ul class="list-inline pull-right tab-btn">
                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary next-step bri_starting" onclick="loadEstimatedFinan();">Next Step</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane <?php echo $page == 3 ? "active" : "disabled"; ?>" role="tabpanel" id="step3">
                                <?php $this->load->view('performance/company/client_needs/client_needs.php'); ?>
                                <ul class="list-inline pull-right tab-btn">
                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                                </ul>
                            </div>
                            <div class="tab-pane <?php echo $page == 4 ? "active" : "disabled"; ?>" role="tabpanel" id="step4">
                                <?php $this->load->view('performance/company/action_plan/action_plan.php'); ?>
                                <ul class="list-inline pull-right tab-btn">
                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary next-step">Next Step</button></li>
                                </ul>
                            </div>

                            <div class="tab-pane <?php echo $page == 5 ? "active" : "disabled"; ?>" role="tabpanel" id="step5">
                                <?php $this->load->view('performance/company/credit_simulation/credit_simulation.php'); ?>
                                <ul class="list-inline pull-right tab-btn">
                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                    <?php if ($mode == 'edit') : ?>
                                        <!-- <?php if ($this->session->userdata('SUBROLE_ID') == '1') : ?> 
                                                    <li><a data-toggle="modal" data-target="#sign" type="button" class="btn btn-success">Submit All Data</a></li> 
                                        <?php endif; ?> -->
                                        <?php if ($this->session->userdata('SUBROLE_ID') == '2') : ?> 
                                            <li><a href="#" type="button" class="btn btn-warning">Checked</a></li> 
                                            <li><a href="#" type="button" data-toggle="modal" data-target="#rejected" class="btn btn-danger">Rejected</a></li>
                                        <?php endif; ?>
                                        <?php if ($this->session->userdata('SUBROLE_ID') == '3') : ?> 
                                            <li><a href="#" type="button" class="btn btn-success">Aprove</a></li> 
                                            <li><a href="#" type="button" data-toggle="modal" data-target="#rejected" class="btn btn-danger">Rejected</a></li>  
                                        <?php endif; ?>
                                        <?php
                                        $a = $account_planning['doc_status'];
                                        if ($a == NULL || $a == 1 || $a == 5 || $a == 6) {
                                            echo ' <li><a data-toggle="modal" data-target="#sign" type="button" class="btn btn-success">Submit All Data</a></li>';
                                        } else {
                                            echo '<li><a type="button" class="btn btn-success" disabled>Data Has Been Submited</a></li>';
                                        }
                                        ?>
                                    <?php else: ?>
                                        <?php if ($signer == 2 || $signer == 3) : ?>
                                            <li><a data-toggle="modal" data-target="#no_signer" type="button" class="btn btn-success">Reject</a></li> 
                                            <!--<li><a id="deny" type="button" class="btn btn-success deny">Reject</a></li>-->
                                            <li><a id="approve" type="button" class="btn btn-success approve">Approved</a></li>
                                        <?php endif; ?>
                                        <a href="<?= base_url('perform/export_pdf/index/' . $vcif . '/' . $year); ?>" type="button" class="btn btn-danger export" target="blank">Export To PDF</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="sign" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background: #337ab7; color:#fff;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">APPROVAL</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="<?= base_url('perform/companyinformations/delegateSigner') ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="vcif" id="vcif" value="<?= $account_planning['vcif'] ?>">
                        <input type="hidden" name="id" id="id" value="<?= $account_planning['account_planning_id'] ?>">
                        <input type="hidden" name="nama" id="nama" value="<?= $_SESSION['USER_ID'] ?>">
                        <input type="hidden" name="comp_name" id="comp_name" value="<?= $account_planning['customer_name'] ?>">
                        <input type="hidden" name="account_year" id="account_year" value="<?= $account_planning['doc_year'] ?>">
                        <label class="control-label col-sm-2" for="checkers">CHECKER:</label>
                        <div class="col-sm-10">
                            <select data-placeholder="Maximum 2 Checker" multiple class="chosen-selectd form-control maxchecker" name="checker_ids[]" style="width: 100%; z-index: 99;" required>
                                <?php foreach ($dataCheckers as $dataChecker) : ?>
                                    <option value="<?= $dataChecker->id; ?>"><?= $dataChecker->name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    

                        <label class="control-label col-sm-2" for="checkers">SIGNER:</label>
                        <div class="col-sm-10">
                            <select data-placeholder="Maximum 2 Signer" multiple class="chosen-selectd form-control maxsigner" name="signer_ids[]" style="width: 100%; z-index: 99;" required>
                                <?php foreach ($dataCheckers as $dataChecker) : ?>
                                    <option value="<?= $dataChecker->id; ?>"><?= $dataChecker->name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <!-- <div>
                          <select data-placeholder="Your Favorite Football Team" class="chosen-selectd" multiple tabindex="6">
                            <option value=""></option>
                            <optgroup label="NFC EAST">
                              <option>Dallas Cowboys</option>
                              <option>New York Giants</option>
                              <option>Philadelphia Eagles</option>
                              <option>Washington Redskins</option>
                            </optgroup>
                          </select>
                        </div> -->
                    </div>
            </div>
            <div style="padding: 0% 20% 5% 20%;">
                <input type="submit" class="btn btn-sm btn-primary form-control" value="KIRIM" >
            </div>

            </form>
        </div>

    </div>
</div>
</div>

<div class="modal fade" id="history" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="sel1">Pilih Tahun:</label>
                    <select class="form-control" onchange="location = this.value;">
                        <option disabled="true" selected>- Pilih Tahun -</option>
                        <?php foreach ($APLN as $apl) : ?>
                            <option value=" <?= base_url('perform/viewaccountplannings/viewAp/' . $apl['VCIF'] . "/" . $apl['YEAR']) ?>">
                                <?= $apl['YEAR']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- <button type="button" class="btn btn-sm btn-primary pull-right" data-dismiss="modal">Lihat</button> -->
            </div>

        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/appjs/companyinformations.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/chosen/chosen_planning.js"></script>
<script src="<?= base_url(); ?>/template/vendors/datatables.net/js/bootstrap-multiselect.js"></script>
<script>
                        $('.multipleSelect').multiselect();</script>
<script type="text/javascript">
    $(".chosen-select").chosen({
    no_results_text: "Oops, Pilihan Tidak tersedia",
    max_selected_options: 2
    })
</script>
<!-- <script type="text/javascript">
    $(".maxchecker").chosen().change(function(){
    var cnt = $('li.search-choice').length;
    if(cnt>2)
    {
    alert('Max 2 Checker');
    $('li.search-choice').last().remove();
    return false;
    }
    });
</script> -->
<script type="text/javascript">
            $(".chosen-selectd").chosen({max_selected_options: 2});</script>
<script type="text/javascript">
    $(".chosen-select").chosen();</script>
<script type="text/javascript">
    $(document).ready(function () {
    window.thisTab = 1;
    //Initialize tooltips
    $('.nav-tabs1 > li a[title]').tooltip();
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

    var $target = $(e.target);
    if ($target.parent().hasClass('disabled')) {
    return false;
    }
    });
<?php if ($mode == 'edit') : ?>

        let page = parseInt("<?= $page ?>");
        $('a[href$="#step5"]').click(function(e){
        window.location.href = "<?= base_url('perform/companyinformations/main/' . $vcif . '/' . $year . '/5'); ?>";
        });
        $(".next-step").click(function (e) {
        if (window.thisTab == 44){
        window.location.href = "<?= base_url('perform/companyinformations/main/' . $vcif . '/' . $year . '/5'); ?>";
        } else{
        var $active = $('.wizard .nav-tabs1 li.active');
        window.thisTab += 1;
        $active.next().removeClass('disabled');
        nextTab($active);
        }
        });
<?php else : ?>
        $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs1 li.active');
        window.thisTab += 1;
        $active.next().removeClass('disabled');
        nextTab($active);
        });
<?php endif; ?>
    $(".prev-step").click(function (e) {
    window.thisTab -= 1;
    var $active = $('.wizard .nav-tabs1 li.active');
    prevTab($active);
    });
    });
    function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
    }
</script>

<script type="text/javascript">
    $('#eskl').validate({
    debug: true,
            submitHandler: function (form) {
            $.ajax({
            type: "POST",
                    url: "selectChecker",
                    data: $(form).serialize(),
                    success: function (response) {
                    if (response == 1) {
                    new PNotify({
                    title: 'Success!',
                            text: 'New Comment Added',
                            type: 'success',
                            styling: 'bootstrap3'
                    });
                    PNotify.prototype.options.delay = 1200;
                    }
                    }
            });
            }
    });
    $('.td-number').on('click', function () {
    var tdElement = $(this);
    var tdText = tdElement.text();
    let kurung = (tdText.indexOf('(') !== - 1 && tdText.indexOf(')') !== - 1);
    tdText = tdText.replace(/,/g, '');
    if (tdText == 0 || tdText == "0.00"){
    tdElement.text("");
    } else if (kurung){
    tdText = tdText.replace(/\(/g, '');
    tdText = tdText.replace(/\)/g, '').trim();
    tdText = '-' + tdText;
    tdElement.text(tdText);
    } else{
    tdElement.text(tdText);
    }
    })
            $("#export").on('click', function (){
    window.location.href = "<?= base_url('perform/export_pdf/index/' . $vcif . '/' . $year); ?>";
    })
</script>

<script type="text/javascript">
            $("td[contenteditable]").keypress(function (evt) {

    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 13) { //Enter key's keycode
    return false;
    }
    });</script>

<?php if ($mode != 'edit') : ?>
    <?php $signer == 2 ? $note = "Note (why decline this From Checker):" : $note = "Note (why decline this From Signer):" ?>
    <div class="modal fade" id="no_signer" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">
                        <form id="dcsign" method="GET">
                            <div class="form-group">
                                <label for="comment"><?= $note ?></label>
                                <textarea class="form-control" rows="5" id="comment" name="msg"></textarea>
                            </div>
                            <input id="deny" type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php if ($signer == 2) : ?>
        <script>
            $("#approve").on('click', function(e){
            $.ajax({
            type: "POST",
                    url: "<?= base_url('profile/OKb') ?>",
                    data: {
                    'vcif': "<?= $account_planning['vcif'] ?>",
                            'comp_name': "<?= $account_planning['customer_name'] ?>"
                    },
                    success: function (response) {
                    if (response == 1) {
                    new PNotify({
                    title: 'Success!',
                            text: 'New Comment Added',
                            type: 'success',
                            styling: 'bootstrap3',
                            delay: 1200
                    });
                    setTimeout(function() {
                    window.location.href = "<?= base_url('profile/APconfirmation'); ?>"
                    }, 1500);
                    }
                    }
            });
            });
            $("#deny").on('click', function(e){
            $.ajax({
            type: "POST",
                    url: "<?= base_url('profile/declines') ?>",
                    data: {
                    'vcif': "<?= $account_planning['vcif'] ?>",
                            'comp_name': "<?= $account_planning['customer_name'] ?>",
                            'msg': $("#comment").val()
                    },
                    success: function (response) {
                    if (response == 1) {
                    new PNotify({
                    title: 'Success!',
                            text: 'New Comment Added',
                            type: 'success',
                            styling: 'bootstrap3',
                            delay: 1200
                    });
                    setTimeout(function() {
                    window.location.href = "<?= base_url('profile/APconfirmation'); ?>"
                    }, 1500);
                    }
                    }
            });
            });</script>
    <?php elseif ($signer == 3) : ?>
        <script>
            $("#approve").on('click', function(e){
            $.ajax({
            type: "POST",
                    url: "<?= base_url('profile/OKsigner') ?>",
                    data: {
                    'vcif': "<?= $account_planning['vcif'] ?>",
                            'comp_name': "<?= $account_planning['customer_name'] ?>"
                    },
                    success: function (response) {
                    if (response == 1) {
                    new PNotify({
                    title: 'Success!',
                            text: 'New Comment Added',
                            type: 'success',
                            styling: 'bootstrap3',
                            delay: 1200
                    });
                    setTimeout(function() {
                    window.location.href = "<?= base_url('profile/APconfirmation'); ?>"
                    }, 1500);
                    }
                    }
            });
            });
            $("#deny").on('click', function(e){
            $.ajax({
            type: "POST",
                    url: "<?= base_url('profile/DCsigner') ?>",
                    data: {
                    'vcif': "<?= $account_planning['vcif'] ?>",
                            'comp_name': "<?= $account_planning['customer_name'] ?>",
                            'msg': $("#comment").val()
                    },
                    success: function (response) {
                    if (response == 1) {
                    new PNotify({
                    title: 'Success!',
                            text: 'New Comment Added',
                            type: 'success',
                            styling: 'bootstrap3',
                            delay: 1200
                    });
                    setTimeout(function() {
                    window.location.href = "<?= base_url('profile/APconfirmation'); ?>"
                    }, 1500);
                    }
                    }
            });
            });
        </script>

    <?php endif; ?>    
<?php endif; ?>