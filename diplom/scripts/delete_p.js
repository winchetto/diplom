$(document).ready(function(){
    $(".delete_p").on('click',function(e) {

        var delete_post = $(this).attr('href');
        console.log(delete_post);
        $.ajax({
            url:'functions/action_delete_post.php',
            type:'POST',
            dataType: 'html',
            data: { 'delete_post': delete_post},
            success: function() {
                location.reload();
            }
        });
        e.preventDefault();
    });
});