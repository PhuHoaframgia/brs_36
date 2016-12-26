$(document).ready(function() {

    $(".b.like_a_cm").click(function() {
        var id = $(this).attr('book-a');
        $(".show" + id + ".show_cmt").slideToggle();
    });

    $("#bt").click(function() {
        var temp = $(this).val();
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/markLike';
        var idBook = $(this).attr('idbv');
        $.ajax({
            url: url,
            type: "POST",
            data: {"type": 'favorites', "idBook": idBook, "_token": _token, "temp" : temp},
            success: function(kq) {

                if (kq == 1) {
                    $('#bt').val('Remove favorite mark');
                }

                if (kq == 2) {
                    $('#bt').val('Mark favorite');
                }
            }
        });
    });

    $("input:radio[name=mask]").click(function() {
        var value = $(this).val();
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/markbook';
        var idbook = $(this).attr('idbv');
        $.ajax({
            url: url,
            type: "POST",
            data: {"type": 'marks', "idbook": idbook,"_token": _token, "value": value},
            success: function(kq) {
               
            }
        });
    });

    $('input:text[name=txtreview]').keypress(function(event) {
        var data = $.trim($(this).val());
        var _token = $(".gettoken").attr('idtoken');
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var url = $('.hide').data('route') + '/review';
        var idbook = $(this).attr('idbv');

        if (keycode == '13') {

            if (data != "") {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {"idbook":idbook, "_token": _token, "data" : data},
                    success: function(response) {

                        if (response.success) {
                            $("#reviewhere").before(response.data);
                            $('input:text[name=txtreview]').val("");
                        } else {
                            alert("error");
                        }    
                    }
                });
            } 
        }
    });

    $('input:text[name=txtcomment]').keypress(function(event) {
        var data = $.trim($(this).val());
        var _token = $(".gettoken").attr('idtoken');
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var url = $('.hide').data('route') + '/comment';
        var id_review = $(this).attr('id_review');

        if (keycode == '13') {

            if (data != "") {
               $.ajax({
                    url: url,
                    type: "POST",
                    data: {"idReview": id_review, "_token":_token, "data" : data},
                    success: function(response) {

                        if (response.success) {
                            $("#temp_comment"+id_review).before(response.data);
                            $('input:text[name=txtcomment]').val("");
                        } else {
                            alert("error");
                        }                 
                    }
                });
            } 
        }
    });

    $(".glyphicon.glyphicon-star").click(function() {

        for (i = 1; i <= 5; i++) {
            $("#star" + i).removeClass("green");
        }

        var value = $(this).attr("starNumber");
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/rateBook';
        var bookId = $(this).attr('idbv');

        for (i = 1; i <= value; i++) {
            $("#star" + i).addClass("green");
        }

        $.ajax({
            url: url,
            type: "POST",
            data: {"bookId": bookId, "_token": _token, "value" : value},
            success: function(response) {

            }
        });
    });

    $(".glyphicon.glyphicon-remove").click(function() {
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/delComment';
        var idComment = $(this).attr('idComment');
        $.ajax({
            url: url,
            type: "POST",
            data: {"idComment": idComment, "_token": _token},
            success: function(response) {

            }
        });
    });

});
