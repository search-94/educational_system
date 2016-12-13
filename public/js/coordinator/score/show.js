$(document).ready(function() {

  	$("#scores").attr('class', 'dropdown active');

    $("#id_grade").change(function() {
    	$("#server_msg").hide();
    	$("#error_msg").hide();

		if ($("#id_grade").val() != "") {
			$("#search_scores").hide();
	    	$.ajax({

				url: 'fill_subjects',
			    type: "post",
			    data: {'id_grade':$("#id_grade").val()},

		        success: function(subjects) {
						

		            if (subjects != "[]") {

 						var subjects_info = JSON.parse(subjects);
 						$("#id_subject").empty();
		                $("#id_subject").append("<option value=''>"+select_subject+"</option>");  
		                $("#div_subject").show();
		                $.each(subjects_info, function(i, item) {

			                $("#id_subject").append("<option value="+item.id+"> "+item.name+" </option>");
		              	}); 
						$("#error_msg").hide();
		            } else {

						$("#div_subject").hide();
						$('#error_msg').html("<p>"+empty_subjects+"</p>");	
						$("#error_msg").show();
		            }
		        },

	      	}); 
		} else {

			$("#div_subject").hide();
			$("#search_scores").hide();		
			$('#error_msg').html("<p>"+empty_grade+"</p>");	
			$("#error_msg").show();
		}

	});

	$("#id_subject").change(function() {

		if ($("#id_subject").val() == "") {

			$("#search_scores").hide();		
			$('#error_msg').html("<p>"+empty_subject+"</p>");	
			$("#error_msg").show();	
		} else {

			$("#error_msg").hide();
			id_grade = $("#id_grade").val();
			id_subject = $("#id_subject").val();
			$("#search_scores").attr("href", "/coordinator/score/download/"+id_grade+"/"+id_subject);
			$("#search_scores").show();

		}
	});

	$("#search_scores").click(function() {

		$("#server_msg").hide();
	});

});
