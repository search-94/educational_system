$(document).ready(function() {

  $("#homeworks").attr('class', 'dropdown active');

  $("#search_homeworks").click(function() {

  	$("#server_msg").hide();
    $("#error_msg").hide();

	if ($("#subject").val() == "") {

        $("#table").hide();
        $('#error_msg').html(empty_subject);
        $("#error_msg").show(); 

    } else {

    	$.ajax({

			url: 'info',
		    type: "post",
		    data: {'subject':$("#subject").val()},

	        success: function(homework) {

	            $("#error_msg").hide();
	            $("#table").show();
	       
	            if (homework == "[]") {

	            	$("#table").hide();
		            $('#error_msg').html(empty_proposed_homework);
		            $("#error_msg").show();

	            } else { //if the identity card exists

	              var homework_info = JSON.parse(homework);
	              var header = false;
	              var state_array = [state_in_progress, state_finished];
	              $.each(homework_info, function(i, item) {

	                if (header == false) {

	                  $("#table").html("<tr> <th>"+homework_title+"</th> <th>"+state+"</th> <th>"+unevaluated_homeworks+"</th> <th>"+culmination_date+"</th> <th>"+options+"</th> </tr>");
	                  header = true;
	                }

	                if (item.unevaluated_homeworks == 0) {

	                  	$("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+state_array[item.state]+"</td> <td>"+item.unevaluated_homeworks+"</td> <td>"+item.spanish_culmination_date+"</td> <td> <a class='btn btn-primary' href = '/teacher/proposed_homework/download/"+item.id+"'> <i class='glyphicon glyphicon-download-alt'></i> "+download+" </a> </td> <td> <a class='btn btn-info' href = '/teacher/done_homework/show/"+item.id+"'> <i class='glyphicon glyphicon-info-sign'></i> "+info+"</a> </td> </tr>");  

	                } else {

                  		$("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+state_array[item.state]+"</td> <td>"+item.unevaluated_homeworks+"</td> <td>"+item.spanish_culmination_date+"</td> <td> <a class='btn btn-primary' href = '/teacher/proposed_homework/download/"+item.id+"'> <i class='glyphicon glyphicon-download-alt'></i> "+download+" </a> </td> <td> <a class='btn btn-success' href = '/teacher/done_homework/show/"+item.id+"'> <i class='glyphicon glyphicon-ok'></i> "+evaluate+"</a> </td> </tr>");  
	                }

	              	
	              }); 

	            }
	        },

      	}); 
	}

	});

});
