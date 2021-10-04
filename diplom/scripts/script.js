$('.log-btn').click(function (e) {
  e.preventDefault();

  $(`input`).removeClass('errorr');

  let nickname = $('input[name="nickname"]').val(),
  password = $('input[name="password"]').val();

  $.ajax({
    url: 'functions/signin.php',
    type: 'POST',
    dataType: 'json',
    data: {
      nickname: nickname,
      password: password
    },
    success (data){
      if(data.status){
        document.location.href = '/feed.php';
      }else {

        if(data.type === 1){
          data.fields.forEach(function(field) {
            $(`input[name="${field}"]`).addClass('errorr');
          });

        }
        $('.errors').removeClass('no-display').text(data.error);
        //console.log(data);
      }


    }
  });
});

let avatar = false;

$('input[name="avatar"]').change(function(e){
  //console.log(e);
  avatar = e.target.files[0];
  //console.log(avatar);
});

$('.reg-btn').click(function (e) {
  e.preventDefault();

  $(`input`).removeClass('errorr');


  let username = $('input[name="username"]').val(),
  lastname = $('input[name="lastname"]').val(),
  nickname = $('input[name="nickname"]').val(),
  mail = $('input[name="mail"]').val(),
  password = $('input[name="password"]').val(),
  repeat_pass = $('input[name="repeat_pass"]').val();

  let formData = new FormData();
  formData.append('username',username);
  formData.append('lastname',lastname);
  formData.append('nickname',nickname);
  formData.append('mail',mail);
  formData.append('password',password);
  formData.append('repeat_pass',repeat_pass);
  formData.append('avatar',avatar);

  $.ajax({
    url: 'functions/signup.php',
    type: 'POST',
    dataType: 'json',
    processData: false,
    contentType: false,
    cache: false,
    data: formData,

    success (data){
      if(data.status){
        document.location.href = '/auth.php';
      }else {

        if(data.type === 1){
          data.fields.forEach(function(field) {
            $(`input[name="${field}"]`).addClass('errorr');
          });

        }
        $('.errors').removeClass('no-display').text(data.error);
        //console.log(data);
      }


    }
  });
});

function noDigits(event) {
  if ("1234567890,.';:!&%<>#№@(){}`*+=-_^ /[]".indexOf(event.key) != -1)
    event.preventDefault();
};

function noDigits2(event) {
  if (",.';:<>!&%#№@(){}`*+=-_^ /[]".indexOf(event.key) != -1)
    event.preventDefault();
};

function noDigits3(event) {
  if (",';:!&<>%#№(){}`*+=^ /[]".indexOf(event.key) != -1)
    event.preventDefault();
};
