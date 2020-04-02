<style type="text/css">
    th{
        text-align: center;
    }
    .hide{display:none;}
    .pp{
        border: 1px solid;
        background: #337ab7;
        position: absolute;
        float: right;
        right: 0;
        color: #fff;
    }

</style>
<div class="right_col" role="main">
    <div class="">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>PROFILE</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3">
                            <?php $this->load->view('layout/profile_sidebar.php'); ?>
                        </div>
                        <form id="settings" method="GET">
                            <div class="col-md-9">
                                <div class="x_title">
                                    <h2>Edit Profile</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-8 col-xs-12">                                
                                    <div class="form-group">
                                        <label for="usr">Personal Number :</label>
                                        <input type="hidden" id="id" name="id" value="<?= $user->id; ?>">
                                        <input type="text" class="form-control" id="usr" disabled="true" value="<?= $user->personal_number; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Name :</label>
                                        <input type="text" class="form-control" id="usr" disabled="true" value="<?= $user->name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <div class="form-group">
                                        <label for="usr">Organization Unit :</label>
                                        <input name="orgUnit" type="text" class="form-control" id="usr" disabled="true" value="<?= $user->division_name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Corporate Title :</label>
                                        <input name="CorpTitle" type="text" class="form-control" id="usr" disabled="true" value="<?= $user->corporate_title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Corporate Email :</label>
                                        <input type="email" class="form-control" id="mail_korp" name="mail_korp" value="<?= $user->email_corporate; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Email Pribadi :</label>
                                        <?php if ($user->email_lainnya) : ?>
                                            <input type="email" name="mail" type="text" class="form-control" id="mail" value="<?= $user->email_lainnya; ?>">
                                        <?php else : ?>
                                            <input type="text" name="mail" type="text" class="form-control" id="mail" >
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Office Phone Number :</label>
                                        <?php if ($user->phone_number1) : ?>
                                            <input type="tel" pattern="^(?!0+$)\d{8,}$" maxlength="13" onkeypress="return isNumberKey(event)" id="phone1" name="phone1" class="form-control" id="phone1" value="<?= $user->phone_number1; ?>" placeholder="02xxxxxx">
                                        <?php else : ?>
                                            <input type="tel" pattern="^(?!0+$)\d{8,}$" maxlength="13" onkeypress="return isNumberKey(event)" id="phone1" name="phone1" class="form-control" id="phone1" placeholder="02xxxxxx">
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Mobile Phone Number :</label>
                                        <?php if ($user->phone_number2) : ?>
                                            <input type="tel" pattern="^(?!0+$)\d{8,}$" maxlength="13" onkeypress="return isNumberKey(event)" name="phone2" class="form-control" id="phone2" value="<?= $user->phone_number2; ?>" placeholder="08xxxxxx">
                                        <?php else : ?>
                                            <input type="tel" pattern="^(?!0+$)\d{8,}$" maxlength="13" onkeypress="return isNumberKey(event)" name="phone2" class="form-control" id="phone2" placeholder="08xxxxxx">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-8" style="margin-top: 20px;">
                                    <center>
                                      <!-- <input type="submit" class="btn btn-md btn-primary" value="Save Data"> -->
                                        <input type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Save Your Data">
                                    </center>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript">
// CREATE
$('#settings').validate({
    debug: true,
    rules: {
        mail: {
            required: true
        },
        phone1: {
            required: true
        },
        phone2: {
            required: true
        }
    },
    messages: {
        mail: {
            required: "Please fill this column"
        },
        phone1: {
            required: "Please fill this column"
        },
        phone2: {
            required: "Please fill this column"
        }
    },
    submitHandler: function (form) {
        var sid = $('#id').val();
        var mail = $('#mail').val();
        var mail_korp = $('#mail_korp').val();
        var phone1 = $('#phone1').val();
        var phone2 = $('#phone2').val();

        var newData = {
            'id': sid,
            'email_lainnya': mail,
            'email_corporate': mail_korp,
            'phone_number1': phone1,
            'phone_number2': phone2
        };

        form.preventDefault;
        $.ajax({
            type: 'POST',
            url: 'updateSetting',
            data: newData,
            success: function (response) {
                if (response == 1) {
                    new PNotify({
                        title: 'Success!',
                        text: 'Data Has Been Saved',
                        type: 'success',
                        styling: 'bootstrap3'
                    });

                    PNotify.prototype.options.delay = 1200;

                    setTimeout(function () {
                        location.href = "<?= base_url(); ?>/profile/setting"
                    }, 1500);
                }
            }
        });
    }
});

</script>
<script type="text/javascript">
    $('#imageUpload').change(function () {
        readImgUrlAndPreview(this);
        function readImgUrlAndPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result);
                }
            }
            ;
            reader.readAsDataURL(input.files[0]);
        }
    });
    $('#imageUpload').change(function () {
        readImgUrlAndPreview(this);
        function readImgUrlAndPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result);
                }
            }
            ;
            reader.readAsDataURL(input.files[0]);
        }
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 14 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>