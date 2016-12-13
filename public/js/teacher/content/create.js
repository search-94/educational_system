  $('document').ready(function() {

    //darkens the content tab
    $("#contents").attr('class', 'dropdown active');
    var control = false;

    $('#file').bind('change', function() {

      if (this.files[0].size > 100000000) {

       control = true;
      } else {

        control = false;
      }
    });

    //validations
    $('#create_content_submit').click(function() {

        $("#create_content_submit").hide();
        $('#error_msg').html('');
        $("#error_msg").hide();
        $("#server_msg").hide();

        if ($("#id_subject").val() == "") {

          $('#error_msg').html("<p>"+error_subject+"</p>");
        }

        if ($("#name").val() == "") {

          $('#error_msg').html($('#error_msg').html()+"<p>"+error_name+"</p>");
        }

        if ($("#file").get(0).files.length === 0) {

          $('#error_msg').html($('#error_msg').html()+"<p>"+error_file+"</p>");
        } else {

          if (control == true) {

            $('#error_msg').html($('#error_msg').html()+"<p>"+error_file_size+"</p>");
          }
        }

        if ($('#error_msg').html()!='') {

          $('#error_msg').show();
          $("#create_content_submit").show();
          return false;
        }

        return true;
       
    });
  });

