<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li style="float: left;">
                    <div style="line-height: 32px; display: block; padding: 13px 15px 12px; left: 0px;">
                        Role: <label><?= $this->session->userdata('ROLE_NAME'); ?></label>
                    </div>
                </li>
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php
                    $d = $this->session->userdata('PROFILE_PIC');
                    $file = base_url('assets/images/user_profile/default.png');
                    $fileimage = base_url('/uploads/' . $d);
                    ?>
                    <?php if ($d == "") : ?>
                        <img src="<?= $file ?>">
                         <?php else: ?>
                        <img src="<?= $fileimage ?>">
                         <?php endif; ?>
                        <?= $this->session->userdata('NAME'); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= base_url(); ?>profile"> Profile</a></li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#logout">
                                <i class="fa fa-sign-out pull-right"></i>
                                Log Out
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Notification-->
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span id="jumlahNotif" class="badge bg-blue">0</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="max-height: 300px; overflow-y: scroll;">
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>

<div id="logout" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 class="modal-title">Logout</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin akan keluar dari aplikasi?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default w150" data-dismiss="modal">Tidak</button>
                <a href="<?= base_url('logins/logout'); ?>" class="btn btn-primary w150">
                    Ya
                </a>                
            </div>
        </div>

    </div>
</div>

<div class="modal fade modal-error-notification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Error</h4>
            </div>
            <div class="modal-body">
                <p id="error-messages"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn w150 btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="loaderImage no_display"></div>
<script>
    var renderNotif = function (r) {
        var container = $('<div />', {class: 'container'});
        $('#jumlahNotif')[0].innerHTML = r.length;
        $.each(r, function (i, e) {
            //console.log(r);
            var cList = $('<li class="tags"/>');
            var subject = e.Subject;
            var title = e.Title;
            switch(subject){
                case "Delegate": 
                    switch(title){
                        case "Delegate Account Planning":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="DelegateAccountPlanning"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                    }
                    break;
                case "Disposisi": 
                    switch(title){
                        case "Disposisi Customer Group":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="DisposisiCustomerGroup"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                    }
                    break;
                case "Account Planning": 
                    switch(title){
                        case "Account Planning Status":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="AccountPlanning"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Add Account Planning Member":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="AccountPlanning"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Add Account Planning Checker":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="AccountPlanning"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Add Account Planning Signer":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="AccountPlanning"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                    }
                    break;
                case "Pipeline":
                    switch(title){
                        case "Submitted Pipeline":
                            var item = $('<li>', {
                                html:   '<a id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="SubmittedPipelineNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Rejected Pipeline":
                            if(e.URL == "history")
                                var className ="HistoryPipelineNotification";
                            else if(e.URL == "submitted") 
                                var className ="SubmittedPipelineNotification";
                            else if(e.URL == "draft") 
                                var className ="DraftPipelineNotification";
                            var item = $('<li>', {
                                html:   '<a id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="'+className+'"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-danger">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                            });
                            break;
                        case "Approved Pipeline":
                            if(e.URL == "history")
                                var className ="HistoryPipelineNotification";
                            else if(e.URL == "submitted")
                                var className ="SubmittedPipelineNotification";
                            else if(e.URL == "approved")
                                var className ="ApprovedPipelineNotification";
                            var item = $('<li>', {
                                html:   '<a id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="'+className+'"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-success">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                            });
                            break;
                        case "Comment Pipeline":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="ApprovedDetailPipelineNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                            });
                            break;
                        case "Cancel Pipeline":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="ApprovedDetailPipelineNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-danger">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                            });
                            break;
                        
                    }
                    break;
                case "Monitoring Proses Kredit":
                    switch(title){
                        case "Komentar Proses Kredit":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="ProsesKreditNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Pengiriman Paket Kredit":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="ProsesKreditNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-success">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Pengembalian Paket Kredit":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="ProsesKreditNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-danger">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                    }
                    break;
                case "Account Planning Menengah": 
                        switch(title){
                            case "Add Account Planning Approver":
                                var item = $('<li>', {
                                    html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="AccountPlanning"><span>' +
                                                '<span class="time">' + e.CreatedDate + '</span></span>' +
                                                '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                                '<br>' + e.Message + '</span>' +
                                            '</a>'
                                    });
                                break;
                        }
                    break;
                case "Disposisi Customer Menengah":
                    switch(title){
                        case "Redisposisi Customer Menengah":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="AccountPlanning"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '' +
                                            '<br>' + e.Message + '</span>' +
                                        '</a>'
                                });
                            break;
                    }
                case "Monitoring Portofolio Kredit":
                    switch(title){
                        case "Komentar Portofolio Kredit":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="PortofolioKreditNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-primary">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Pengiriman Portofolio Kredit":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="PortofolioKreditNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-success">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                        case "Pengembalian Portofolio Kredit":
                            var item = $('<li>', {
                                html:   '<a data-path="'+e.URL+'" id="notif' + e.NotificationId + '_' + e.UserFrom + '" class="PortofolioKreditNotification"><span>' +
                                            '<span class="time">' + e.CreatedDate + '</span></span>' +
                                            '<span class="message"><span class="label label-danger">' + e.Title + '</span> - by ' + e.USER_FROM_NAME + ' / ' + e.CORPORATE_TITLE + ' / ' + e.DIVISION_NAME + '</span>' +
                                        '</a>'
                                });
                            break;
                    }
                    break;
                default:
                    break;
            }
            container.append(item);
        });
        container.appendTo($('ul#menu1'));

        /* Start of onClick Binding Event */
        $("a.AccountPlanning").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var path = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url() ?>' + path;
            });
        });
        $("a.DelegateAccountPlanning").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var path = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url() ?>' + path;
            });
        });
        $("a.DisposisiCustomerGroup").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var path = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url() ?>' + path;
            });
        });
        $("a.SubmittedPipelineNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/pipeline/submitted') ?>';
            });
        });
        $("a.DraftPipelineNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/pipeline/draft') ?>';
            });
        });
        $("a.HistoryPipelineNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/pipeline/history') ?>';
            });
        });
        $("a.ApprovedPipelineNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var path = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/pipeline/approved') ?>';
            });
        });
        $("a.ApprovedDetailPipelineNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var detail = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/pipeline') ?>/' + detail;
            });
        });
        $("a.ProsesKreditNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var path = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url() ?>' + path;
            });
        });
        $("a.PortofolioKreditNotification").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            var path = $(this).data('path');
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url() ?>' + path;
            });
        });
        /* End of onClick Binding Event */

        
        $("a.clickedNotif").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            let vcif = temp2[1];
            let data_year = temp2[2];
            if (vcif.length == 2) {
                vcif = temp2[1] + "_" + temp2[2];
                data_year = temp2[3];
            }
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/perform/viewaccountplannings/viewAp/') ?>' + vcif + '/' + data_year;
            });
            //$.post(url, null, renderAddNotif, 'json');
            //window.location.href = '<?= base_url('/pipeline/draft') ?>';
            //window.location.href = '<?= base_url('/perform/viewaccountplannings/viewAp/') ?>' + vcif + '/' + data_year;

        });
        $("a.clickedNotifMaker").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            let vcif = temp2[1];
            let data_year = temp2[2];
            if (vcif.length == 2) {
                vcif = temp2[1] + "_" + temp2[2];
                data_year = temp2[3];
            }
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/profile/task') ?>';
            });
            //$.post(url, null, renderAddNotif, 'json');
            //window.location.href = '<?= base_url('/pipeline/draft') ?>';
            //window.location.href = '<?= base_url('/profile/task') ?>';
        });
        $("a.clickedNotifcalendar").bind("click", function (e) {
            e.preventDefault();
            let temp = $(this)[0].id;
            temp = temp.substr(5, temp.length - 5);
            let temp2 = temp.split("_");
            let id = temp2[0];
            let vcif = temp2[1];
            let data_year = temp2[2];
            var url = '<?= base_url('/rest/bri_starting/readNotif/') ?>' + id;
            $.getJSON(url, function (data){
                window.location.href = '<?= base_url('/report/monitoring') ?>';
            });
            //$.post(url, null, renderAddNotif, 'json');
            //window.location.href = '<?= base_url('/report/monitoring') ?>';
        });
    };
    var url = '<?= base_url('/rest/bri_starting/get_notif') ?>';
    $.get(url, null, renderNotif, 'json');  
    
</script>
<!-- /top navigation -->