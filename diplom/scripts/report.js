$(document).ready(function(){

$(".btn_in_post").click(function(e) {

    $(`input`).removeClass('errorr');

    let id_post = $('input[name="id_post"]').val(),
        description = $('textarea[name="description"]').val();

    $.ajax({
        url: 'functions/report.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id_post: id_post,
            description: description
        },
        success(data) {
            if (data.status) {
                document.location.href = '/feed.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('errorr');
                    });
                }
                $('.errors1').removeClass('no-display').text(data.error);
                console.log(data);
            }
        }
    });
    e.preventDefault();
});
});
