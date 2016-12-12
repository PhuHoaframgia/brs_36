$(document).ready(function(){
    $(".b.like_a_cm").click(function(){
        var id = $(this).attr('data-a');
        $(".show" + id + ".show_cmt").slideToggle();
    });
});
