$(document).ready(function() {

  $("#contents").attr('class', 'dropdown active');

    	$("#search_contents").click(function() {

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
		                $("#table").html("<tr> <th>"+content_title+"</th> <th>"+publication_date+"</th> <th>"+options+"</th> </tr>");
		                $.each(content_info, function(i, item) {

			                $("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+item.spanish_creation_date+"</td> <td> <a class='btn btn-primary' href = '/student/content/download/"+item.id+"'> <span class='glyphicon glyphicon-download-alt'></span> "+download+" </a> </tr>");  
			              	
		              	}); 
		            }
		        },

	      	}); 
		}

	});

});
