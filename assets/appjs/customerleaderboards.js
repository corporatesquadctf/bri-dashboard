$(window).load(function () {
    $('.groupAP').on('click', function () {

        var id = $(this).data('id');
        console.log(id);
        var data = {
            'id': id
        };

        if (id) {
            $.ajax({
                type: 'POST',
                url: 'customerleaderboards/openAccountPlanning',
                data: data,
                success: function (response) {
                    if (response.status === true) {
                        document.location.href = response.redirect;
                    } else {
                        $('#notif').html('<div style="border:1px solid red;font-size: 11px;margin:0 auto !important;">' + response.error + '</div>');
                    }
                }
            });
        }
    });
});