

$('#sendMsg').click(function () {
        that = $(this);
        $.ajax({
            url:'ajax',
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
                    '    <img src="https://is1-ssl.mzstatic.com/image/thumb/Purple118/v4/ec/5b/b5/ec5bb5dd-b4c7-ca71-37e2-b8b407144b55/AppIcon-2-0-1x_U007emarketing-0-85-220-9.png/246x0w.jpg" class="rounded-circle user_img_msg">\n' +
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



