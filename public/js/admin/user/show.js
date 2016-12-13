function fill_user() {

    if ($("#identity_card").val() == "") {

        $('#error_msg').html("Debe ingresar un N° de cédula");
        $("#error_msg").show();
        $("#info").hide();  

    } else {

        var a = $('input[name=identity_card]').val();
        var ident = a.replace(/[^0-9]/g,''); //get only the numbers of the string (identity card)

        $.ajax({

          url: 'info',
          type: "post",
          data: {'identity_card':ident},

          success: function(user) {

            if (user == 'error') {

              $('#error_msg').html("No existe el N° de cédula introducido");
              $("#error_msg").show();
              $("#info").hide(); 

            } else { //if the identity card exists

              var user_info = JSON.parse(user);
              $("#update").attr('action', 'update/'+user_info.id); //set action of the button

              //fill basic info
              $("#info_first_name").text(user_info.first_name);
              $("#info_second_name").text(user_info.second_name);
              $("#info_gender").text(user_info.gender);
              $("#info_role").text(user_info.role);
              if (user_info.id_grade != null) {

                $("#info_grade").text(user_info.id_grade);
                $("#info_grade_row").show();
              } else {

                $("#info_grade_row").hide();
                $("#info_grade").text('');
              }

              //fills info when user is active
              if (user_info.is_active == 1) {

                $("#info_is_active").attr('style', 'color:green');
                $("#info_is_active").text(active);

                if (user_info.id == id_usr) {
                  $("#confirm_delete_user").hide();
                } else {
                  $("#confirm_delete_user").show();
                }
                $("#buttons_active").show();
                $("#buttons_inactive").hide();

                //load data of the update modal window
                $("#update_user_id").val(user_info.id);
                $("#update_identity_card").val(user_info.identity_card);
                $("#update_first_name").val(user_info.first_name);
                $("#update_second_name").val(user_info.second_name);
                $("#update_gender").val(user_info.id_gender);
                $("#delete_user").attr('href', 'destroy/'+user_info.id);

              } else {

                $("#info_is_active").attr('style', 'color:red');
                $("#info_is_active").text(inactive);

                $("#buttons_inactive").show();
                $("#buttons_active").hide();

                //load data of the restore modal window
                $("#restore_user_id").val(user_info.id);
                $("#restore_identity_card").val(user_info.identity_card);
                $("#restore_first_name").val(user_info.first_name);
                $("#restore_second_name").val(user_info.second_name);
                $("#restore_id_gender").val(user_info.id_gender);
                $("#restore_id_role").val(user_info.id_role);

                if (user_info.id_role == 3) {
               
                  $("#restore_grade_row").show();
                  $("#restore_id_grade").val(user_info.id_grade);
                } else {
                 
                  $("#restore_grade_row").hide();
                  $("#restore_id_grade").val('');
                }

                $("#restore_user").attr('href', 'restore/'+user_info.id);
              }
              

              $("#info").show();    
            }
          },

      }); 
    }
}

$(document).ready(function() {

  $("#users").attr('class', 'dropdown active');
  $('#send-btn').click(function() {
    $("#server_msg").hide();
    $("#error_msg").hide();
    fill_user(); 
  });

  $('#show_modal_edit_user').click(function() {
    $('#reset_password').attr('checked', false);
    $("#update_error_msg").hide();
    $("#modal_edit_user").modal('show');   
  });

  $("#update").click(function() {

    $("#update_error_msg").html('');
    $("#update_error_msg").hide();
    $("#update").hide();

    var re = /^([A-Za-zñáéíóúüÁÉÍÓÚ ]){2,30}$/;
    if (!re.test($("#update_first_name").val())) {

      $("#update_error_msg").html("<p>"+error_first_name+"</p>");
    }

    if (!re.test($("#update_second_name").val())) {

      $("#update_error_msg").html($("#update_error_msg").html()+"<p>"+error_second_name+"</p>");
    }

    if ($("#update_gender").val() == "") {

      $("#update_error_msg").html($("#update_error_msg").html()+"<p>"+error_gender+"</p>");
    }

    if ($("#reset_password").is(":checked"))  {

        $("#r_pass").val('true');
    } else {
        $("#r_pass").val('false');
    }

    if ($("#update_error_msg").html() != '') {

      $("#update_error_msg").show();
      $("#update").show();
      return false;
    } 

     return true;

  });


  $('#show_modal_restore_user').click(function() {

    $("#restore_error_msg").hide();
    $("#modal_restore_user").modal('show');   
  });  

  $("#restore_id_role").change(function() {

    if ($("#restore_id_role").val() == 3) {

      $("#restore_grade_row").show();
    } else {

      $("#restore_grade_row").hide()
      $("#restore_id_grade").val('');
    }
  });


  $("#restore").click(function() {

    $("#restore_error_msg").html('');
    $("#restore_error_msg").hide();
    $("#restore").hide();

    var re = /^([A-Za-zñáéíóúüÁÉÍÓÚ ]){2,30}$/;
    if (!re.test($("#restore_first_name").val())) {

      $("#restore_error_msg").html("<p>"+error_first_name+"</p>");
    }

    if (!re.test($("#restore_second_name").val())) {

      $("#restore_error_msg").html($("#restore_error_msg").html()+"<p>"+error_second_name+"</p>");
    }

    if ($("#restore_id_gender").val() == "") {

      $('#restore_error_msg').html($('#restore_error_msg').html()+"<p>"+error_gender+"</p>");
    }     

    if ($("#restore_id_role").val() == "") {

      $('#restore_error_msg').html($('#restore_error_msg').html()+"<p>"+error_role+"</p>");
    } else {

      if ($("#restore_id_role").val() == "3") {

        if ($("#restore_id_grade").val() == "") {

          $('#restore_error_msg').html($('#restore_error_msg').html()+"<p>"+error_grade+"</p>");
        }
      }
    }

    if ($("#restore_error_msg").html() != '') {

      $("#restore_error_msg").show();
      $("#restore").show();
      return false;
    } 

     return true;

  });

  $("#restore_role").change(function() {

    if ($("#restore_role").val()==3) {

      $("#restore_grade_row").show()
    } else {

      $("#restore_grade_row").hide()
      $("#restore_id_grade").val("");
    }
  }); 
});

$(document).keypress(function(e) {
    if(e.which == 13) {

        $("#server_msg").hide();
        $("#error_msg").hide();
        fill_user();
    }
});

