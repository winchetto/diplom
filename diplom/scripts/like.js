$(document).ready(function(){
    $(".counter_l").on('click',function(e) {

        var counter_l = $(this).attr('href');
        console.log(counter_l);
        $.ajax({
            url:'functions/like.php',
            type:'POST',
            dataType: 'html',
            data: { 'counter_l': counter_l},
            success: function() {
                location.reload();
            }
        });
        e.preventDefault();
    });
});