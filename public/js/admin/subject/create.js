  $('document').ready(function() {

  	//darkens the subjects tab
    $("#subjects").attr('class', 'dropdown active');

    //validations
    $("#create_subject_submit").click(function() {

      $("#create_subject_submit").hide();
      $("#error_msg").hide();
      $("#server_msg").hide();
    	$("#error_msg").html('');

      var re =  /^([a-zA-Z0-9_-°ñáéíóúü ]){2,30}$/;
      if (!re.test($("#name").val())) {
        $('#error_msg').html("<p>"+error_name+"</p>");
      }

    	if ($("#id_grade").val() == "") {

    		$("#error_msg").html($("#error_msg").html()+"<p>"+error_grade+"</p>");
    	}

      if ($("#id_user").val() == "") {

        $("#error_msg").html($("#error_msg").html()+"<p>"+error_user+"<br>");
      }

    	//if data pass the validation
      if ($('#error_msg').html()!='') {

        $("#create_subject_submit").show();
        $("#error_msg").show();
        return false;
      }

      return true;
	   
    });

  });
