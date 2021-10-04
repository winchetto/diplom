$(document).ready(function(){
    $(".counter").on('click',function(event) {

        var counter = $(this).attr('href');

        console.log(counter);
        $.ajax({
            url:'functions/download.php',
            type:'POST',
            dataType: 'html',
            data: { 'counter': counter},
            success: function() {
                location.reload();
            }
        });

    });
});
