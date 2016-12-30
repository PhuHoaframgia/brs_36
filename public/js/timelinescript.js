window.onload = (function () {
    $(".clickOnChange").click(function () {
        var token  = $("input[name = '_token']").val();
        var url = $('.hide').data('route') + '/unfollow/';
        var followed_id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: url + followed_id,
            cache: false,
            data: {'_token': token,'id': followed_id},
            success: function(data) {

                if (data == "Success") {
                    $('#follow').load(location.href + " #follow>*", "");
                    $('#timeline').load(location.href + " #timeline>*", "");
                } else {
                    alert('Fail');
                }
            }
        });
    });

    $(".form-control-user").click(function () {
        var token  = $("input[name = '_token']").val();
        var followed_id = $(this).attr('id');
        var url = $('.hide').data('route') + '/follow/' + followed_id;
        $.ajax({
            type: 'POST',
            url: url,
            cache: false,
            data: {'_token': token,'id': followed_id},
            success: function(data) {

                if (data == 'Success') {
                    $('.form-control-user').hide();
                } else {
                    alert('Fail');
                    $('.form-control-user').val('Follow');
                }
            }
        });
    });
});
