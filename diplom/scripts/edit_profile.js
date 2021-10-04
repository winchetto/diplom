let new_avatar = false;

$('input[name="new_avatar"]').change(function(e){
  //console.log(e);
  new_avatar = e.target.files[0];
  //console.log(avatar);
});

$(document).ready(function() {



  $("#btn_message").click(function () {
    $("#popur_messages").fadeIn(500);
    $("#popur_messages").css("display", "block");
    $("#hover").css("display", "block");
  });

  $('.send').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('errorr');

    let formData = new FormData();
    formData.append('new_avatar',new_avatar);

    $.ajax({
      url: 'functions/edit_avatar.php',
      type: 'POST',
      dataType: 'json',
      processData: false,
      contentType: false,
      cache: false,
      data: formData,

      success (data){
        if(data.status){
          document.location.href = '/edit.php';
          $("#popur_messages").fadeOut(function(){

          });
          $("#hover").fadeOut(function(){

          });
          $("#ff")[0].reset();
        }else {

          if(data.type === 1){
            data.fields.forEach(function(field) {
              $(`input[name="${field}"]`).addClass('errorr');
            });

          }
          $('.errors5').removeClass('no-display').text(data.error);
          console.log(data);
        }


      }
    });
  });

  $('.send_2').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('errorr');

    let username = $('input[name="username"]').val(),
        userlastname = $('input[name="userlastname"]').val();

    $.ajax({
      url: 'functions/edit_name.php',
      type: 'POST',
      dataType: 'json',
      data: {
        username: username,
        userlastname: userlastname
      },
      success(data) {
        if (data.status) {
          document.location.href = '/edit.php';
          console.log(data);
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
  });

  $('.send_4').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('errorr');

    let usernickname = $('input[name="usernickname"]').val();

    $.ajax({
      url: 'functions/edit_nickname.php',
      type: 'POST',
      dataType: 'json',
      data: {
        usernickname: usernickname
      },
      success(data) {
        if (data.status) {
          document.location.href = '/edit.php';
          console.log(data);
        } else {

          if (data.type === 1) {
            data.fields.forEach(function (field) {
              $(`input[name="${field}"]`).addClass('errorr');
            });
          }
          $('.errors3').removeClass('no-display').text(data.error);
          console.log(data);
        }
      }
    });
  });

  $('.send_5').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('errorr');

    let usermail = $('input[name="usermail"]').val();

    $.ajax({
      url: 'functions/edit_mail.php',
      type: 'POST',
      dataType: 'json',
      data: {
        usermail: usermail
      },
      success(data) {
        if (data.status) {
          document.location.href = '/edit.php';
          console.log(data);
        } else {

          if (data.type === 1) {
            data.fields.forEach(function (field) {
              $(`input[name="${field}"]`).addClass('errorr');
            });

          }
          $('.errors2').removeClass('no-display').text(data.error);
          console.log(data);
        }
      }
    });
  });


  $('.send_6').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('errorr');

    let oldpassword = $('input[name="oldpassword"]').val(),
        newpassword = $('input[name="newpassword"]').val(),
        newpassword_2 = $('input[name="newpassword_2"]').val();

    $.ajax({
      url: 'functions/edit_pass.php',
      type: 'POST',
      dataType: 'json',
      data: {
        oldpassword: oldpassword,
        newpassword: newpassword,
        newpassword_2: newpassword_2
      },
      success(data) {
        if (data.status) {
          document.location.href = '/auth.php';
          console.log(data);
        } else {

          if (data.type === 1) {
            data.fields.forEach(function (field) {
              $(`input[name="${field}"]`).addClass('errorr');
            });

          }
          $('.errors4').removeClass('no-display').text(data.error);
          console.log(data);
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

});
$(document).keydown(function(event) {
  if (event.keyCode == 27) {
    $("#popur_messages").fadeOut(500);
    $("#hover").fadeOut(500);
  }
});