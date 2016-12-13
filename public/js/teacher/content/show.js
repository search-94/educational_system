$(document).ready(function() {

 	$("#contents").attr('class', 'dropdown active');

  	$("#search_contents").click(function() {
  		$("#error_msg").hide();
  		$("#server_msg").hide();
		if ($("#subject").val() == "") {

	        $("#table").hide();
	        $('#error_msg').html(empty_subject);
	        $("#error_msg").show();

	    } else {

	    	$.ajax({

				url: 'info',
			    type: "post",
			    data: {'subject':$("#subject").val()},

		        success: function(content) {

		            $("#error_msg").hide();
		            $("#table").show();
		       
		            if (content == "[]") {

		            	$("#table").hide();
			            $('#error_msg').html(empty_content);
			            $("#error_msg").show();

		            } else { //if the identity card exists
 
		                var content_info = JSON.parse(content);
		                var header = false;
		                $.each(content_info, function(i, item) {

		                	if (header == false) {

			                    $("#table").html("<tr> <th>"+content_title+"</th> <th>"+publication_date+"</th> <th>"+options+"</th> </tr>");
			                    header = true;
			                }

			                $("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+item.spanish_creation_date+"</td> <td> <a class='btn btn-primary' href = '/teacher/content/download/"+item.id+"'> <i class='glyphicon glyphicon-download-alt'></i> "+download+" </a> <button class='btn btn-danger' onclick='deleteContentConfirmation("+item.id+")'> <i class='glyphicon glyphicon-remove'></i> "+delete_content+" </button> </td> </tr>");  
			              	
		              	}); 
		            }
		        },

	      	}); 
		}

	});

});

function deleteContentConfirmation(content_id) {

  $('#delete_content').attr('href', '/teacher/content/destroy/'+content_id);
  $("#modal_delete_content").modal('show'); 

}