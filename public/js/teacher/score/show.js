$(document).ready(function() {

 	$("#scores").attr('class', 'dropdown active');

	$("#id_subject").change(function() {

		if ($("#id_subject").val() != "") {

			id_subject = $("#id_subject").val();
			$("#search_scores").attr("href", "/teacher/score/download/"+id_subject);
			$("#search_scores").show();
		}
	});

	$("#search_scores").click(function() {

		$("#server_msg").hide();
		$("#error_msg").hide();
		$("#error_msg").html('');
		if ($("#id_subject").val() == "") {

			$("#error_msg").html(error_subject);
		}

		if ($("#error_msg").html() != "") {

			$("#error_msg").show();
			return false;
		}

		return true;
	});

});