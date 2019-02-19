// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

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
                var html ='<div class="d-flex justify-content-start mb-4">' +
                    '    <div class="img_cont_msg">' +
                    '    <img src="' + 'https://thishosting.rocks/wp-content/uploads/2018/01/install-php-7-2-ubuntu-1024x438.jpg.webp' + '" class="rounded-circle user_img_msg">' +
                    '    </div>' +
                    '    <div class="msg_cotainer">' +data.msg+
                    '</div>' +
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
            "LastMsg":  $(".msg_cotainer:last").text()
        },
        async: false,
        success: function(data) {
            // do something with "data"
            if (data != "FirstError") {
                for(var i=0;i<data.length;i++)
                {
                    var html ='<div class="d-flex justify-content-start mb-4">' +
                        '    <div class="img_cont_msg">' +
                        '<img src="' +getCookie('i')+ '" class="rounded-circle user_img_msg">'+
                        '</div>' +
                        '<div class="msg_cotainer">'+data[i].chat+'</div>'+
                        '</div>';



                    $(".msg_card_body").append(html);

                                    $('.card-body').animate({ scrollTop: 10000000000}, "slow" );

                                    console.log(data.length);

                                   // data = null;
                                    //console.log(data.keys(data).length);
                }




            }
         // InfiniteAjaxRequest(uri)

        }
    });
}, 2000);







