$(document).ready(function(){

$("#btn_message").click(function(){
  $("#popur_messages").fadeIn(500);
  $("#popur_messages").css("display","block");
  $("#hover").css("display","block");
});

$('.send').click(function(e){
  e.preventDefault();
  let author = $('input[name="author"]').val(),
  poluchatel = $('input[name="poluchatel"]').val(),
  mess = $('textarea[name="mess"]').val();

  $.ajax({
    url: 'functions/action_message.php',
    type: 'POST',
    dataType: 'json',
    data: {
      author: author,
      poluchatel: poluchatel,
      mess: mess
    },
    success (data){
      console.log(data);
      $("#popur_messages").fadeOut(function(){

      });
      $("#hover").fadeOut(function(){

      });
      $("#ff")[0].reset();
    }
});

});
  $('#submit_5').click(function(e){
    e.preventDefault();
    let author = $('input[name="author"]').val(),
        poluchatel = $('input[name="poluchatel"]').val(),
        textarea = $('textarea[name="textarea"]').val();

    $.ajax({
      url: 'functions/action_message_2.php',
      type: 'POST',
      dataType: 'json',
      data: {
        author: author,
        poluchatel: poluchatel,
        textarea: textarea
      },
      success: function() {
        location.reload();
      }


    });

  });
});

$(document).keydown(function(event) {
  if (event.keyCode == 27) {
    $("#popur_messages").fadeOut(500);
    $("#hover").fadeOut(500);
  }
});
