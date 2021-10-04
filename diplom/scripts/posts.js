let audio = false;

$('input[name="audio"]').change(function(e){
    //console.log(e);
    audio = e.target.files[0];
   // console.log(audio);
});

$('.btn_in_post').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('errorr');


    let name_post = $('input[name="name_post"]').val(),
        description = $('textarea[name="description"]').val();


    let formData = new FormData();
    formData.append('name_post',name_post);
    formData.append('description',description);
    formData.append('audio',audio);

    $.ajax({
        url: 'functions/action_post.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success (data){
            if(data.status){
                document.location.href = '/main.php';
            }
            else {
               if(data.type === 1){
                    data.fields.forEach(function(field) {
                       $(`input[name="${field}"]`).addClass('errorr');
                    });

                }
                $('.errors').removeClass('no-display').text(data.error);
                console.log(data);
            }


        }
    });
});

function noDigits(event) {
    if ("'&%{}`*+=^/".indexOf(event.key) != -1)
        event.preventDefault();
};