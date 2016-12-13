  $('document').ready(function() {

    //darkens the users tab
    $("#account").attr('class', 'dropdown active');

    //validations
    $('#change_password_submit').click(function() {

        $("#change_password_submit").hide();
        $('#error_msg').html('');
        $("#error_msg").hide();
        $("#server_msg").hide();

        var re =  /^([a-zA-Z0-9_-]){6,12}$/;

        if (!re.test($("#new_password").val())) {
          $("#error_msg").html($('#error_msg').html()+"<p>"+error_password+"</p>");
        } 

        if ($("#new_password").val() != $("#confirm_password").val()) {

          $("#error_msg").html($('#error_msg').html()+"<p>"+error_password_confirm+"</p>");
        }

        if ($('#error_msg').html()!='') {

          $('#error_msg').show();
          $("#change_password_submit").show();
          return false;
        }

        return true;
       
    });
  });

