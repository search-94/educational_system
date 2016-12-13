    $('document').ready(function() {

    //darkens the users tab
    $("#users").attr('class', 'dropdown active');

    //shows grade field when the selected role is student
    $("#id_role").change(function() {

      if ($("#id_role").val() == "3") {
        $("#grade_container").attr('style', 'display:block');

      } else {

        $("#grade_container").attr('style', 'display:none');
        $("#id_grade").val("");
      }
    });

    //validations
    $('#create_user_submit').click(function() {

        $("#create_user_submit").hide();
        $('#error_msg').html('');
        $("#error_msg").hide();
        $("#server_msg").hide();

        var re =  /^([0-9]){5,10}$/;
        if (!re.test($("#identity_card").val())) {
          $('#error_msg').html("<p>"+error_identity_card+"</p>");
        }

        var re = /^([A-Za-zñáéíóúüÁÉÍÓÚ ]){2,30}$/;
        if (!re.test($("#first_name").val())) {
          $("#error_msg").html($('#error_msg').html()+"<p>"+error_first_name+"</p>");
        }

        if (!re.test($("#second_name").val())) {
          $("#error_msg").html($('#error_msg').html()+"<p>"+error_second_name+"</p>");
        }

        if ($("#id_gender").val() == "") {

          $('#error_msg').html($('#error_msg').html()+"<p>"+error_gender+"</p>");
        }         

        if ($("#id_role").val() == "") {

          $('#error_msg').html($('#error_msg').html()+"<p>"+error_role+"</p>");
        } else {

          if ($("#id_role").val() == "3") {

            if ($("#id_grade").val() == "") {

              $('#error_msg').html($('#error_msg').html()+"<p>"+error_grade+"</p>");
            }
          }
        }

        if ($('#error_msg').html()!='') {

          $('#error_msg').show();
          $("#create_user_submit").show();
          return false;
        }

        return true;
       
    });
  });

