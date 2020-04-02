<link rel="stylesheet" href="<?= base_url(); ?>template/vendors/tagify-master/dist/tagify.css">
<style>
    p { 
        line-height:1.4; 
    }
    code {
        padding:2px 3px; background:lightyellow; 
    }

    tags {
        min-width:400px;
        max-width:600px;
        margin: 1.5em 0;
    }

    /* for disabling the script */
    /*label{ position:fixed; bottom:10px; right:10px; cursor:pointer; font:600 .8em Arial; }*/
    .disabled tags {
        max-width:none;
        min-width:0;
        border:0;
    }

    .disabled tags tag,
    .disabled tags div{ display:none }

    .disabled tags input,
    .disabled tags textarea{ display:initial; border:1px inset; }
</style>

<div class="col-md-12 col-sm-12 col-xs-12">
    <?php $this->load->view('performance/viewaccountplanning/view_fundings.php'); ?>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <?php $this->load->view('performance/viewaccountplanning/view_services.php'); ?>
</div>

<!-- SCRIPT -->
<script src="<?= base_url(); ?>template/vendors/tagify-master/dist/tagify.min.js"></script>
<script src="<?= base_url(); ?>template/vendors/tagify-master/dist/jQuery.tagify.min.js"></script>
<script src="<?= base_url(); ?>template/vendors/tagify-master/dist/popper.js"></script>
<!--
    <script src="<?= base_url(); ?>template/vendors/tagify-master/dist/tagify.suggestions.js"></script>
--> 
<script>
    // document.forms[0].reset();
    // var input1 = document.querySelector('input[name=tags]'),
    //         input2 = document.querySelector('textarea[name=tags2]'),
    //         // init Tagify script on the above inputs
    //         tagify1 = new Tagify(input1, input2, {
    //             whitelist: ["IT support", "Mmarketing", "sales"],
    //             maxTags: 5
    //         });

    // tagify1.on('add', onAddTag);
    // tagify1.on('remove', onRemoveTag);
    // tagify1.on('duplicate', onDuplicateAdded);

////////////////////////////////////////////
</script>
