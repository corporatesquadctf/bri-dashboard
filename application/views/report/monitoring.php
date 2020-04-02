<!-- page content -->
<link href="<?=base_url();?>template/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="<?=base_url();?>template/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
<link href="<?= base_url();?>assets/chosen/chosen.css" rel="stylesheet"/>
<link href="<?=base_url();?>build/css/custom.min.css" rel="stylesheet">
<style type="text/css">
    .chosen-container{
        width: 375px !important;
    }
</style>
<script>
    var masterDivisi = {};
</script>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Loan Monitoring </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Calendar</h2>
                        <!-- <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>
    function submit1(evt) {
        evt.preventDefault();
        $(".antosubmit").click();
        return false;
    }
    function submit2(evt) {
        evt.preventDefault();
        $(".antosubmit2").click();
        return false;
    }
</script>

<!-- calendar modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
            </div>
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
                    <form id="antoform" class="form-horizontal calender" role="form" onsubmit="return submit1(event)">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Divisi</label>
                            <div class="col-sm-9">
                                <!-- <select class="form-control" style="height:55px;" id="divisi" name="divisi">
                                    <option>Choose a number</option>
                                </select> -->
                                <select input="text" data-placeholder="Search Division Name" class="chosen-select form-control" name="divisi" id="divisi" multiple>
                                    <!-- <option value=""></option> -->
                                    <?php foreach ($divisions as $division) : ?>
                                        <option value="<?= $division->ID; ?>">
                                            <?= $division->DIVISION_NAME; ?>  
                                        </option>
                                    <?php endforeach ?> 
                                    <!-- <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>13</option> -->
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary antosubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
            </div>
            <div class="modal-body">

                <div id="testmodal2" style="padding: 5px 20px;">
                    <form id="antoform2" class="form-horizontal calender" role="form" onsubmit="return submit2(event)">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="id2" name="id2">
                                <input type="text" class="form-control" id="title2" name="title2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Divisi</label>
                            <div class="col-sm-9">
                                <!--
                                <select class="form-control" style="height:55px;" id="divisi2" name="divisi">
                                    <option>Choose a number</option>
                                </select>
                                -->
                                <select input="text" data-placeholder="Search Division Name" class="chosen-select form-control" name="divisi2" id="divisi2" multiple>
                                    <!-- <option value=""></option> -->
                                    <?php foreach ($divisions as $division) : ?>
                                        <option value="<?= $division->ID; ?>">
                                            <?= $division->DIVISION_NAME; ?>  
                                        </option>
                                    <?php endforeach ?> 
                                    <!-- <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>13</option> -->
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="CalenderModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel2">View Calendar Entry</h4>
            </div>
            <div class="modal-body">

                <div id="testmodal2" style="padding: 5px 20px;">
                    <form id="antoform2" class="form-horizontal calender" role="form">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title3" name="title2" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height:55px;" id="descr3" name="descr" disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Divisi</label>
                            <div class="col-sm-9">
                                <select class="form-control" style="height:55px;" id="divisi3" name="divisi" disabled>
                                    <option>Choose a number</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="baseurl" hide value="<?= base_url('/rest/calendar/') ?>">
<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
<div id="fc_view" data-toggle="modal" data-target="#CalenderModalView"></div>
<!-- /calendar modal -->

<script>
    var url = '<?= base_url('/rest/calendar/get_calendar') ?>';
    var success = function(result) {
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', result.data);         
        $('#calendar').fullCalendar('rerenderEvents' );
        /*
        masterDivisi = result.divisi;
        $('#divisi').empty();
        $('#divisi').append($('<option></option>').val('0').html('Choose a Division'));
        $('#divisi2').empty();
        $('#divisi3').empty();
        $.each(masterDivisi, function(i, p) {
            $('#divisi').append($('<option></option>').val(p.id).html(p.division_name));
            $('#divisi2').append($('<option></option>').val(p.id).html(p.division_name));
            $('#divisi3').append($('<option></option>').val(p.id).html(p.division_name));
        });
        $('#divisi').val(result.divisiNow);
        */
    };
    $(document).ready(
        $("#CalenderModalNew").on('shown.bs.modal', function(){
            $(this).find('#title').focus();
        }),
        $("#CalenderModalEdit").on('shown.bs.modal', function(){
            $(this).find('#title2').focus();
        }),
        $.post(url, {}, success)
    );
</script>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/chosen/chosen.js"></script>
<script type="text/javascript">
    $(".chosen-select").chosen({
        no_results_text: "Oops, Pilihan Tidak tersedia"
    })
</script>
<script type="text/javascript">
    function defModalWidth(obj) {
      if (obj.container_width() == '0px') {
        return '600px';    
      } else {
        return obj.container_width();
      }
    }
</script>