function fill_user() {

    if ($("#identity_card").val() == "") {

        $('#error_msg').html("Debe ingresar un N° de cédula");
        $("#error_msg").show();
        $("#info").hide();  

    } else {

        $.ajax({

          url: 'info',
          type: "post",
          data: {'identity_card':$('input[name=identity_card]').val()},

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

                $("#buttons_active").show();
                $("#buttons_inactive").hide();

                //load data of the update modal window
                $("#update_user_id").val(user_info.id);
                $("#update_first_name").val(user_info.first_name);
                $("#update_second_name").val(user_info.second_name);
                $("#delete_user").attr('href', 'destroy/'+user_info.id);

              } else {

                $("#info_is_active").attr('style', 'color:red');
                $("#info_is_active").text(inactive);

                $("#buttons_inactive").show();
                $("#buttons_active").hide();

                //load data of the restore modal window
                $("#restore_user_id").val(user_info.id);
                $("#restore_first_name").val(user_info.first_name);
                $("#restore_second_name").val(user_info.second_name);
                $("#restore_role").val(user_info.id_role);
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
    $("#server_error_msg").hide();
    $("#error_msg").hide();
    fill_user(); 
  });

  $('#show_modal_edit_user').click(function() {

    $("#modal_edit_user").modal('show');   
  });

  $("#update").click(function() {

    $('#update_error_msg').html('');

    if ($("#update_first_name").val().length < 2 || $("#update_first_name").val().length > 30) {

      $("#update_error_msg").html("<p>"+length_first_name+"</p>");
    }

    if ($("#update_second_name").val().length < 2 || $("#update_second_name").val().length > 30) {

      $("#update_error_msg").html($("#update_error_msg").html()+"<p>"+length_second_name+"</p>");
    } 

    var re = /^[A-Za-zñáéíóúü]+$/i;
    if (!re.test($("#update_first_name").val())) {
      $("#update_error_msg").html("<p>"+error_first_name+"</p>");
    }

    if (!re.test($("#update_second_name").val())) {
      $("#update_error_msg").html("<p>"+error_second_name+"</p>");
    }

    if ($("#update_error_msg").html() != '') {

      $("#update_error_msg").show();
      return false;
    } 
    $("#update_error_msg").hide();
     return true;
    

  });

  $('#show_modal_restore_user').click(function() {

    $("#modal_restore_user").modal('show');   
  });  

  $("#restore").click(function() {

    $('#restore_error_msg').html('');
    if ($("#restore_first_name").val() == "") {

    }
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
        fill_user();
    }
});

