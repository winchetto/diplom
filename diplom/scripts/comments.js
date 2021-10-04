$(document).ready(function() {

    $("#btn_comm").click(function () {
        $("#popur_comm").fadeIn(500);
        $("#popur_comm").css("display", "block");
        $('.popur_comm').css('z-index',999);
    });
});

$(document).ready(function(){
    $(".send_2").on('click',function(e) {

        e.preventDefault();
        let post = $('input[name="post"]').val(),
            comment = $('textarea[name="comment"]').val();

        console.log(post);
        $.ajax({
            url:'functions/comments.php',
            type:'POST',
            dataType: 'json',
            data: {
                post: post,
                comment: comment
            },
            success: function() {
                location.reload();
                $("#popur_comm").fadeOut(function(){

                });
                $("#ff")[0].reset();
            }
        });

    });
});

$(document).keydown(function(event) {
    if (event.keyCode == 27) {
        $("#popur_comm").fadeOut(500);
    }
});