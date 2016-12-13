$(document).ready(function() {

  $("#homeworks").attr('class', 'dropdown active');

  var control = false;

  $('#done_homework').bind('change', function() {

    if (this.files[0].size > 50000000) {

     control = true;
    } else {

      control = false;
    }
  });  

  $("#send_homework_confirm").click(function() {

    $("#send_homework_confirm").hide();
    $("#modal_send_error").html('');
    $("#modal_send_error").hide();
    if ($("#done_homework").get(0).files.length === 0) {

      $("#modal_send_error").html(empty_done_homework);
    } else {

        if (control == true) {

          $('#modal_send_error').html(error_file_size);
        }
    }

    if ($("#modal_send_error").html() != '') {

      $("#modal_send_error").show();
      $("#send_homework_confirm").show();
      return false;
    }

    return true;
  });

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
              $('#error_msg').html(empty_proposed_homework);
              $("#error_msg").show();
              $("#table").hide();

            } else { //if the identity card exists

              var homework_info = JSON.parse(homework);
              var header = false;
              var state_array = [state_waiting, state_sent, state_evaluated, state_unsent];
              $.each(homework_info, function(i, item) {

                if (header == false) {

                  $("#table").html("<tr> <th>"+homework_title+"</th> <th>"+state+"</th> <th>"+culmination_date+"</th> <th>"+options+"</th> </tr>");
                  header = true;
                }

                if (item.state == 0) { //por entregar

                  $("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+state_array[item.state]+"</td> <td>"+item.spanish_culmination_date+"</td> <td> <a class='btn btn-primary' href = '/student/proposed_homework/download/"+item.id+"'> <span class='glyphicon glyphicon-download-alt'></span> "+download+" </a> </td> <td> <button class ='btn btn-success' onclick='modal_send_homework("+id_user+","+item.id+",\""+item.teacher_first_name+"\",\""+item.teacher_second_name+"\",\""+item.subject_name+"\",\""+item.name+"\","+item.weighing+",\""+item.spanish_creation_date+"\",\""+item.spanish_culmination_date+"\")'>  <span class='glyphicon glyphicon-pencil'></span> "+send_evaluation+"</button></td> </tr>");  
              
                } else if (item.state == 1) { //entregado

                  $("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+state_array[item.state]+"</td> <td>"+item.spanish_culmination_date+"</td> <td> <a class='btn btn-primary' href = '/student/proposed_homework/download/"+item.id+"'>  <span class='glyphicon glyphicon-download-alt'></span> "+download+" </a> </td> <td> <button class ='btn btn-info' onclick='modal_information_homework(\""+item.teacher_first_name+"\",\""+item.teacher_second_name+"\",\""+item.subject_name+"\",\""+item.name+"\","+item.weighing+",\""+item.spanish_creation_date+"\",\""+item.spanish_culmination_date+"\")'> <span class='glyphicon glyphicon-info-sign'></span> "+info+"</button></td>  </tr>");
              
                } else if(item.state == 2) { //corregido

                  $("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+state_array[item.state]+"</td> <td>"+item.spanish_culmination_date+"</td> <td> <a class='btn btn-primary' href = '/student/proposed_homework/download/"+item.id+"'>  <span class='glyphicon glyphicon-download-alt'></span> "+download+" </a> </td> <td> <button class ='btn btn-info' onclick='modal_evaluated_homework(\""+item.teacher_first_name+"\",\""+item.teacher_second_name+"\",\""+item.subject_name+"\",\""+item.name+"\","+item.weighing+",\""+item.spanish_creation_date+"\",\""+item.send_date+"\",\""+item.evaluated_date+"\", "+item.score+",\""+item.observations+"\")'> <span class='glyphicon glyphicon-info-sign'></span> "+info+"</button></td>  </tr>");
               
                } else if (item.state == 3) { //no entregado

                  $("#table").html($("#table").html()+"<tr> <td>"+item.name+"</td> <td>"+state_array[item.state]+"</td> <td>"+item.spanish_culmination_date+"</td> <td> <a class='btn btn-primary' href = '/student/proposed_homework/download/"+item.id+"'>  <span class='glyphicon glyphicon-download-alt'></span> "+download+" </a> </td> <td> <button class ='btn btn-info' onclick='modal_information_homework(\""+item.teacher_first_name+"\",\""+item.teacher_second_name+"\",\""+item.subject_name+"\",\""+item.name+"\","+item.weighing+",\""+item.spanish_creation_date+"\",\""+item.spanish_culmination_date+"\")'> <span class='glyphicon glyphicon-info-sign'></span> "+info+"</button></td>  </tr>");
                }
              	
              }); 

            }
          },

      }); 
	  }
	});
});

function modal_send_homework(id_user, id_proposed_homework, teacher_first_name, teacher_second_name, subject, content, weighing, creation_date, culmination_date) {

  $('#send_form').attr('action', '/student/done_homework/store/'+id_user+'/'+id_proposed_homework);
  $("#name_subject").text(subject);
  $("#teacher").text(teacher_first_name+" "+teacher_second_name);
  $("#name").text(content);
  $("#weighing").text(weighing+"%");
  $("#creation_date").text(creation_date);
  $("#culmination_date").text(culmination_date);
  $("#modal_send_error").hide();
  var file = $("#done_homework");
  file.replaceWith( file = file.clone(true));
  $("#modal_send_homework").modal('show');   
}

function modal_information_homework(teacher_first_name, teacher_second_name, subject, content, weighing, creation_date, culmination_date) {

  $("#info_name_subject").text(subject);
  $("#info_teacher").text(teacher_first_name+" "+teacher_second_name );  
  $("#info_name").text(content);
  $("#info_weighing").text(weighing+"%");
  $("#info_creation_date").text(creation_date);
  $("#info_culmination_date").text(culmination_date);
  $("#modal_info_homework").modal('show');   
}

function modal_evaluated_homework(teacher_first_name, teacher_second_name, subject, content, weighing, creation_date, culmination_date, evaluated_date, score, observations) {

  $("#evaluated_name_subject").text(subject);
  $("#evaluated_teacher").text(teacher_first_name+" "+teacher_second_name);    
  $("#evaluated_name").text(content);
  $("#evaluated_weighing").text(weighing+"%");
  $("#evaluated_assignment_date").text(creation_date);
  $("#evaluated_culmination_date").text(culmination_date);
  $("#evaluated_corrected_date").text(evaluated_date);  
  $("#evaluated_score").text(score);
  if ((observations == "") || (observations == "null")) {
    $("#evaluated_observations").text(empty_observations);
  } else {
    $("#evaluated_observations").text(observations);
  }
  
  $("#modal_evaluated_homework").modal('show');   
}
