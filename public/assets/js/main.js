

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
                console.log(data)
                $('div#ajax-results').html(data.output);

            }
        });

    }
    );