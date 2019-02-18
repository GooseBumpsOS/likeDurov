

$('#sendMsg').click(function () {
        that = $(this);
        $.ajax({
            url:'aj1ax',
            type: "POST",
            dataType: "json",
            data: {
                "msg":  $("#textAreaClear").val()
            },
            async: true,
            success: function (data)
            {
                $("#textAreaClear").val('');
                console.log(data);
                var html ='<div class="d-flex justify-content-start mb-4">\n' +
                    '    <div class="img_cont_msg">\n' +
                    '    <img src="' + data.usrData + '" class="rounded-circle user_img_msg">\n' +
                    '    </div>\n' +
                    '    <div class="msg_cotainer">\n' +
                    data.msg +
                    '<span class="msg_time">9:00</span>\n' +
                    '</div>\n' +
                    '</div>';

                $(".msg_card_body").append(html);

                $('.card-body').animate({ scrollTop: 10000000000}, "slow" );



            }
        });

    }
    );


setInterval(function () {
    $.ajax({
        url: 'ajax_toDB',
        type: "POST",
        dataType: "json",
        data: {
            "LastMsg":  'sdfgh'
        },
        async: true,
        success: function(data) {
            // do something with "data"
            if (data.length > 0) {
                //alert(data);
            }
         // InfiniteAjaxRequest(uri);
                console.log(data[0].id);

        },
        // error: function(xhr, ajaxOptions, thrownError) {
        //     alert(thrownError);
        // }
    });
}, 3000);







