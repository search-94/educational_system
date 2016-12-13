  $('document').ready(function() {

    //darkens the account tab
    $("#period").attr('class', 'dropdown active');

    //validations
    $('#update_period_submit').click(function() {

        $("#update_period_submit").hide();
        $('#error_msg').html('');
        $("#error_msg").hide();
        $("#server_msg").hide();

        if ($("#year").val() == "") {

          $('#error_msg').html("<p>"+error_year+"</p>");
        }

        if ($("#lapse").val() == "") {

          $('#error_msg').html($('#error_msg').html()+"<p>"+error_lapse+"</p>");
        }

        if ($('#error_msg').html()!='') {

          $('#error_msg').show();
          $("#update_period_submit").show();
          return false;
        }

        return true;
       
    });
  });

