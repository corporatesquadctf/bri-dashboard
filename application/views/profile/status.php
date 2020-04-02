<link rel="stylesheet" href="<?= base_url(); ?>assets/fastselect/fastselect.css">
<style type="text/css">
    .roundedImg {
        border-radius: 50%;
    }
    /*.fstElement { font-size: 1.2em; }
    .fstToggleBtn { min-width: 16.5em; }*/

    .submitBtn { display: none; }

    .fstMultipleMode { display: block; }
    .fstMultipleMode .fstControls { width: 100%; }
</style>
<?php
$d = strtotime("10:30pm April 15 2014");
?>
<div class="tab-content">
    <div id="profile" class="tab-pane fade in active">
        <div class="col-md-12 col-xs-12 nopadding">
            <div class="x_panel">
                <!-- <div class="x_title">
                    <h2>Recent Activity </h2>
                    <div class="clearfix"></div>
                </div> -->
                <div class="x_content">
                    <div style="background: #f5f5f5; padding: 20px; margin-bottom: 20px; height: 250px;">
                        <form id="statusform" method="GET">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <input type="hidden" name="nama" value="<?php echo $_SESSION['NAME']; ?>">
                                <!-- <input type="text" name="pic" value="<?php echo $_SESSION['PROFILE_PIC']; ?>"> -->
                                <!-- <input type="text" name="date" id="date" value="<?php echo date("Y-m-d h:i:sa", $d); ?>"> -->
                                <textarea name="status" class="form-control" rows="5" id="comment"></textarea>
                            </div>
                            <div class="col-md-9 nopadding">
                                <!-- <div type="text" id="tags" contenteditable name="tags" placeholder="Tagging To Division" data-autocomplete-spy data-autocomplete data-autocomplete-multiple></div type="text">
                                <input type="text" name="taging" id="form-title" style="display:none;"></input> -->
                                <select multiple="multiple" class="multipleSelect" style="height: 35px;">
                                    <?php foreach ($data_div as $dd) : ?>
                                        <option value="<?php echo $dd->DIVISION_NAME; ?>" multiple><?php echo $dd->DIVISION_NAME; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3 ">
                                <!-- <a href="#" class="btn input-block-level form-control btn-primary" value="Submit"> Submit</a> -->
                                <input type="submit" class="btn btn-sm btn-success input-block-level form-control" value="Submit">
                            </div>
                        </form>
                    </div>

                    <?php foreach ($status as $ab) : ?>
                        <div class="col-md-12 nopadding">
                            <div class="comments-list">
                                <div class="media">
                                    <p class="pull-right">
                                        <small>
                                            <?php
                                            $addon = new DateTime($ab->addon);
                                            echo $addon->format("F j, Y");
                                            ?> 
                                        </small>
                                    </p>
                                    <a class="media-left" href="#">
                                      <!-- <img width="50px" class="roundedImg" src="<?= base_url(); ?>assets/images/user_profile/mei_nindya.png" > -->
                                        <?php $userImage = $ab->profile_pic;
                                        if ($userImage) :
                                            ?>
                                            <img class="roundedImg" width="50px;" height="50px" src="<?php echo base_url($userImage); ?>" class="img-responsive" alt="">   
                                        <?php else : ?>
                                            <img class="roundedImg" width="50px;" height="50px" src="<?= base_url(); ?>assets/images/user_profile/default.png" class="img-responsive" alt="">
    <?php endif; ?>
                                    </a>
                                    <div class="media-body">

                                        <h4 class="media-heading user_name">
    <?php echo $ab->name; ?>
                                        </h4>
                                        <span>
    <?php echo $ab->status; ?>
                                        </span>
                                        <p>
                                            <small><a href=""><?php echo $ab->tags; ?> </a></small>
                                            <!-- <small><a href="">IT, </a></small>
                                            <small><a href="">Production ,</a></small> -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div> 
                        </div>
<?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>assets/fastselect/fastselect.standalone.js"></script>
<script>

    $('.multipleSelect').fastselect();

</script>

<script type="text/javascript">
    // CREATE
    $('#statusform').validate({
        debug: true,
        rules: {
            status: {
                required: true
            }
        },
        messages: {
            status: {
                required: "Please Fill The Column..."
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: "profile/insertNew",
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

                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                }
            });
        }
    });
</script>

