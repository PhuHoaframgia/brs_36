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
        var value = $('.content' + idComment).text();
        $(".contain_cm" + idComment).hide();
        $(".edit_cm" + idComment).show();
        $("#comment" + idComment).hide();
        $(".cont" + idComment).val($.trim(value));
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
        var value = $('.ctReview' + idReview).text();
        $("#review" + idReview).hide();
        $(".edit_rv" + idReview).show();
        $("#" + idReview).val($.trim(value));
    });

    $(document).on('click', ".esc", function() {
        var idReview = $(this).attr("idReview");
        $("#review" + idReview).show();
        $(".edit_rv" + idReview).hide();
        var idReview = $(this).attr("idReview");
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

    $(document).on('click','.like_cmt',function() {
        var idComment = $(this).attr('idComment');
        var name = $(this).attr('name');
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/likeAction';
        var count = parseInt($('.load-like-comment' + idComment).attr('value'));
        var data = $.trim($('.like' + idComment).html());

        if(data == 'Like') {
            var value = 1;
        } else {
            var value = 2;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: {"_token": _token, "actionId": idComment, "value": value, "name": name},
            success: function(kq) {

                if (kq == 1) {
                    $('.like' + idComment).html('Unlike');
                    count++;
                }

                if (kq == 2) {
                   $('.like' + idComment).html('Like');
                   count--;
                }
                $('.load-like-comment' + idComment).html(count);
                $('.load-like-comment' + idComment).attr("value", count);
            }
        });


    });

    $(document).on('click','.like-review',function() {
        var idReview = $(this).attr('idReview');
        var name = $(this).attr('name');
        var _token = $(".gettoken").attr('idtoken');
        var url = $('.hide').data('route') + '/likeAction';
        var count = parseInt($('.load-like-review' + idReview).attr('value'));
        var data = $.trim($('.review-id' + idReview).html());

        if(data == 'Like') {
            var value = 1;
        } else {
            var value = 2;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: {"_token": _token, "actionId": idReview, "value": value, "name": name},
            success: function(kq) {

                if (kq == 1) {
                    $('.review-id' + idReview).html('Unlike');
                    count++;
                }

                if (kq == 2) {
                   $('.review-id' + idReview).html('Like');
                   count--;
                }
                $('.load-like-review' + idReview).html(count);
                $('.load-like-review' + idReview).attr("value", count);
            }
        });
    });
});
