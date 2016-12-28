$(document).ready(function() {
    $(document).on('click', ".b.like_a_cm", function() {
        var id = $(this).attr('book-a');
        $(".show" + id + ".show_cmt").slideToggle();
    });

    $(document).on('click', "#bt", function(){
        var temp = $(this).val();
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/markLike';
        var idBook = $(this).attr('idbv');
        $.ajax({
            url: url,
            type: "POST",
            data: {"type": 'favorites', "idBook": idBook, "_token": _token, "temp": temp},
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

    $(document).on('click', "input:radio[name=mask]", function(){
        var value = $(this).val();
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/markbook';
        var idbook = $(this).attr('idbv');
        $.ajax({
            url: url,
            type: "POST",
            data: {"type": 'marks', "idbook": idbook, "_token": _token, "value": value},
            success: function(kq) {
               
            }
        });
    });

    $(document).on('keypress', 'input:text[name=txtreview]', function(event) {
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
                    data: {"idbook": idbook, "_token": _token, "data": data},
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

    $(document).on('keypress', 'input:text[name=txtcomment]', function(event) {
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
                    data: {"idReview": id_review, "_token": _token, "data": data},
                    success: function(response) {

                        if (response.success) {
                            $("#temp_comment" + id_review).before(response.data);
                            $('input:text[name=txtcomment]').val("");
                        } else {
                            alert("error");
                        }                 
                    }
                });
            } 
        }
    });


    $(document).on('click', ".glyphicon.glyphicon-star", function() {

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
            data: {"bookId": bookId, "_token": _token, "value": value},
            success: function(response) {

            }
        });
    });

    $(document).on('click', ".comment.glyphicon.glyphicon-remove", function() {
        var _token = $(".gettoken").attr('idtoken');
        var idComment = $(this).attr('idComment');
        var url = $('.hide').data('route') + '/delComment/' + idComment;
        $.ajax({
            url: url,
            type: "POST",
            data: {"_token": _token},
            success: function(response) {

                if (response.success) {
                    $("#cont_cm" + idComment).hide();
                } else {
                    alert("error");
                }    
            }
        });
    });

    $(document).on('click', ".review.glyphicon.glyphicon-remove", function() {
        var _token = $(".gettoken").attr('idtoken');
        var idReview = $(this).attr('idReview');
        var url = $('.hide').data('route') + '/delReview/'+idReview;
        $.ajax({
            url: url,
            type: "POST",
            data: {"_token": _token},
            success: function(response) {

                if (response.success) {
                    $("#cont_review" + idReview).hide();
                } else {
                    alert('error');
                }    
            }
        });
    });

    $(document).on('click', ".comment.glyphicon.glyphicon-pencil", function() {
        var idComment = $(this).parent().find(".comment.glyphicon.glyphicon-remove").attr("idComment");
        $(".contain_cm" + idComment).hide();
        $(".edit_cm" + idComment).show();
        $("#comment" + idComment).hide();
    });

    $(document).on('click', ".Cancle", function() {
        var idComment = $(this).attr('idComment');
        $(".contain_cm" + idComment).show();
        $(".edit_cm" + idComment).hide();
        $("#comment" + idComment).show();
    });

    $(document).on('keypress', 'input:text[name=txtedit]', function(event) {
        var data = $.trim($(this).val());
        var _token = $(".gettoken").attr('idtoken');
        var idComment = $(this).parent().find("a").attr("idComment");
        var url = $('.hide').data('route') + '/editComment/' + idComment;
        var keycode = (event.keyCode ? event.keyCode : event.which);

        if (keycode == '13') {

            if (data != "") {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {"_token":_token, "data": data},
                    success: function(response) {

                        if (response.success) {
                            $(".contain_cm" + idComment).show();
                            $(".edit_cm" + idComment).hide();
                            $("#comment" + idComment).show(); 
                            $('.content' + idComment).html(data);
                        } else {
                            alert("error");
                        }                 
                    }
                });
            } 
        }
    });

    $(document).on('click', ".review.glyphicon.glyphicon-pencil", function() {
        var idReview = $(this).parent().find(".b.like_a_cm").attr("book-a");
        $("#review" + idReview).hide();
        $(".edit_rv" + idReview).show();
        var idReview = $(this).parent().find(".review").attr("idReview");
        $('.ctReview' + idReview).attr('value', $('.content-review' + idReview).val());
    });

    $(document).on('click', ".esc", function() {
        var idReview = $(this).attr("idReview");
        $("#review" + idReview).show();
        $(".edit_rv" + idReview).hide();
        var idReview = $(this).attr("idReview");
        $('#' + idReview).val("");
    });

    $(document).on('keypress', 'input:text[name=editReview]', function(event) {
        var data = $.trim($(this).val());
        var _token = $(".gettoken").attr('idtoken');
        var idReview = $(this).parent().find("a").attr("idReview");
        var url = $('.hide').data('route') + '/editReview/' + idReview;
        var keycode = (event.keyCode ? event.keyCode : event.which);

        if (keycode == '13') {

            if (data != "") {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {"_token":_token, "data": data},
                    success: function(response) {

                        if (response.success) {
                            $("#review" + idReview).show();
                            $(".edit_rv" + idReview).hide(); 
                            $('.ctReview' + idReview).html(data);
                        } else {
                            alert("error");
                        }                 
                    }
                });
            } 
        }
    });

});
