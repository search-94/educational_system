$(document).ready(function() {

	$("#homeworks").attr('class', 'dropdown active');

	$("#evaluate_homework_confirm").click(function() {

		$('#modal_send_error').hide();
	  	$("#evaluate_homework_confirm").hide();
	    $('#modal_send_error').html('');

	    if ($("#score").val() == "") {

	    	$('#modal_send_error').html(empty_score);
	    }

	  	if ($('#modal_send_error').html()!='') {

	        $('#modal_send_error').show();
	        $("#evaluate_homework_confirm").show();
	        return false;
	    }

	    return true;
	});

	$("#update").click(function() {

		if ($("#update").is(":checked")) {

			$("#update_score").show();
			$("#update_observations").show();
			$("#update_score_label").show();
			$("#update_observations_label").show();
			$("#modify_homework_confirm").show();

		} else {

			$("#modify_homework_confirm").hide();
			$("#update_score").hide()
			$("#update_score_label").hide();
			$("#update_score").val('');
			$("#update_observations").hide()
			$("#update_observations_label").hide()
			$("#update_observations").val('');			
		}

	});

	$("#modify_homework_confirm").click(function() {

		$('#modal_info_error').hide();
	  	$('#modify_homework_confirm').hide();
	    $('#modal_info_error').html('');

	    if ($("#update_score").val() == "") {

	    	$('#modal_info_error').html(empty_score);
	    }

	  	if ($('#modal_info_error').html()!='') {

	        $('#modal_info_error').show();
	        $("#modify_homework_confirm").show();
	        return false;
	    }

	    return true;
	});

});

function modal_evaluate_done_homework(id_done_homework, first_name, second_name, identity_card, creation_date) {

  $('#send_form').attr('action', '/teacher/done_homework/evaluate/'+id_done_homework);
  $("#first_name").text(first_name);
  $("#second_name").text(second_name);
  $("#identity_card").text(identity_card);  
  $("#creation_date").text(creation_date);
  $("#modal_send_error").hide();

  $("#score").val("");
  $("#observations").val("");

  $("#modal_send_homework").modal('show');   
}

function modal_info_done_homework(id_done_homework, first_name, second_name, identity_card, creation_date, evaluated_date, score) {

	$('#modal_info_error').hide();
	$('#update_form').attr('action', '/teacher/done_homework/update/'+id_done_homework);
	$("#modify_homework_confirm").hide();
	$("#update").attr("checked", false);
	$("#modify_homework_confirm").hide();
	$("#update_score").hide()
	$("#update_score").val('');
	$("#update_observations").hide()
	$("#update_observations").val('');	
	$("#update_score_label").hide()
	$("#update_observations_label").hide()
	$("#info_first_name").text(first_name);
  	$("#info_second_name").text(second_name);
  	$("#info_identity_card").text(identity_card);  
  	$("#info_creation_date").text(creation_date);
  	$("#info_evaluated_date").text(evaluated_date);
  	$("#info_score").text(score);
  	$("#modal_info_homework").modal('show'); 
}


