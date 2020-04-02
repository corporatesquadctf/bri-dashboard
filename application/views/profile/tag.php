<link href="<?= base_url(); ?>assets/chosen/chosen.css" rel="stylesheet"/>
<style type="text/css">
    .chosen-container{
        width: 100% !important;
    }
</style>

<div class="right_col" role="main">
    <div class="">

        <div class="col-xs-3">
            <?php $this->load->view('layout/profile_sidebar.php'); ?>
        </div>
        <div class="col-xs-9">
            <div class="x_title">
                <h2>Disposisi</small></h2>
                <div class="clearfix"></div>
            </div>
            <!-- hanya bisa di lihat admin divisi  -->

            <table id="datatable" data-search="true" data-toggle="table" data-pagination="true" class="table table-hover table-striped table-bordered table-condensed" style="border-collapse: collapse; margin-top: 20px;">
                <thead style="background-color: #012D5A; color: #FFF; ">
                    <tr class="headings">
                        <th data-sortable="true" data-field="index">No</th>
                        <th data-sortable="true" data-field="COMPANY_NAME">Company Name</th>
                        <th data-sortable="true" data-formatter="staff_field" data-field="STAFF_NAME">Staff Name</th>
                        <th data-sortable="true" data-field="DATA_YEAR">Year</th>
                        <th data-events="disEvents" data-formatter="action_field" width="12%" >Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="disposisiLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="disposisiLabel">Select Staff Name</h4>
            </div>
            <div class="modal-body">
                <input id="idDoc" type="hidden" value="">
                <input id="vcifDoc" type="hidden" value="">
                <input id="companyDoc" type="hidden" value="">
                <input id="yearDoc" type="hidden" value="">
                <select input="text" data-placeholder="Search User Name" class="chosen-select form-control" name="masterUsers" id="masterUsers" multiple style='width:100%'>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="saved" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/chosen/chosen.js"></script>
<script type="text/javascript">
    $(".chosen-select").chosen({
        no_results_text: "Oops, Pilihan Tidak tersedia"
    });
    var staff_field = function (value, row) {
        temp = ''
        for (let x in value) {
            temp += '<div>' + value[x].name + '</div>';
        }
        return temp
    };
    var action_field = function (value, row) {
        if (row.roles == 0) {
            return '<button class="btn btn-xs btn-sm btn-info view_this" style="width: 75px"><span class="glyphicon glyphicon-eye-open icon-s" ></span>  View</a></button>';
        } else if (row.roles == 1) {
            return '<button class="btn btn-xs btn-sm btn-warning disposisi_this"><span class="glyphicon glyphicon-eye-open"></span> Disposisi</a></button> <button class="btn btn-xs btn-sm btn-info view_this" style="width: 75px"><span class="glyphicon glyphicon-eye-open icon-s" ></span>  View</a></button>';
        }
    };
    $("#saved").on('click', function (e) {
        e.preventDefault();
        let id = $("#idDoc").val();
        let users = $("#masterUsers").val();
        let request2 = JSON.stringify({
            id: id,
            users: users
        });
        let url2 = "<?= base_url('rest/disposisi/edit_disposisi') ?>";
        let success2 = function (response) {
            if (response.error == false) {
                $('#disposisiModal').modal('hide');
                loadData();
                new PNotify({
                    title: 'Success!',
                    text: 'Sukses merubah disposisi',
                    type: 'success',
                    styling: 'bootstrap3',
                    delay: 1200
                })
            } else {
                new PNotify({
                    title: 'Failed!',
                    text: response.msg,
                    type: 'danger',
                    styling: 'bootstrap3',
                    delay: 1200
                })
            }
        }
        $.post(url2, request2, success2);
    });
</script>

<script type="text/javascript">
    var loadData = function () {
        var url = "<?= base_url('/rest/disposisi/get_disposisi') ?>";
        var request = {};
        request = JSON.stringify(request);

        var success = function (res) {
            let masterUsers = res.master_users;
            $('#masterUsers').empty();
            $.each(res.master_users, function (i, p) {
                $('#masterUsers').append($('<option></option>').val(p.id).html(p.name));
            })
            $('#masterUsers').trigger("chosen:updated");
            $('#datatable').bootstrapTable("load", res.disposisi);

            new PNotify({
                title: 'Success!',
                text: "Data Loaded",
                type: 'success',
                styling: 'bootstrap3',
                delay: 500
            });
        };

        $.post(url, request, success);
    };
    $(window).load(function () {
        loadData();
    });
    window.disEvents = {
        'click .disposisi_this': function (e, value, row) {
            e.preventDefault();
            $('#masterUsers').val(row.STAFF_ID);
            $('#masterUsers').trigger("chosen:updated");
            $('#idDoc').val(row.ID);
            $('#vcifDoc').val(row.VCIF);
            $('#companyDoc').val(row.COMPANY_NAME);
            $('#yearDoc').val(row.DATA_YEAR);
            $('#disposisiModal').modal('show');
        },
        'click .view_this': function (e, value, row) {
            e.preventDefault();
            location.replace("<?= base_url('perform/viewaccountplannings/viewAp/') ?>" + row.VCIF + '/' + row.DATA_YEAR);
        }
    };
</script>