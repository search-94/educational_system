function fill_subject(id_subject) {

    $.ajax({

      url: 'info',
      type: 'post',
      data: {'id_subject': id_subject},
      success: function(subject) {

          var subject_info = JSON.parse(subject);
          $('#subject_name').text(subject_info.subject_name);
          $('#id_grade').text(subject_info.subject_id_grade);

          if (subject_info.subject_id != null) {

            $('#teacher_info').show();
            $('#identity_card').text(subject_info.user_identity_card);
            $('#first_name').text(subject_info.user_first_name);
            $('#second_name').text(subject_info.user_second_name);
          } else {

            $('#teacher_info').hide();
          }
        
      },

    }); 
}

$(document).ready(function() {

    $('#search_subjects').click(function() {
      $('#error_msg').hide();
      $('#server_msg').hide();
      if ($('#grade').val() == '') {

          $('#table').hide();
          $('#error_msg').html(empty_subject);
          $('#error_msg').show();

      } else {

        $.ajax({

        url: 'info_subjects',
        type: 'post',
        data: {'grade':$('#grade').val()},

          success: function(subjects) {

              $('#error_msg').hide();
              $('#table').show();
         
              if (subjects == '[]') {

                $('#table').hide();
                $('#error_msg').html(empty_subject);
                $('#error_msg').show();

              } else { //if the identity card exists

                  var subjects_info = JSON.parse(subjects);
                  var header = false;
                  $('#table').html('<tr> <th>'+name+'</th> <th>'+options+'</th> </tr>');
                  $.each(subjects_info, function(i, item) {
                    if (item.user_id == null) {

                      $('#table').html($('#table').html()+"<tr> <td>"+item.subject_name+"</td> <td> <button class='btn btn-danger pull-left' onclick='deleteSubjectConfirmation("+item.subject_id+")' style='margin:5px'> <i class='glyphicon glyphicon-remove-sign'></i> "+del+" </button> <button class='btn btn-info pull-left' onclick='info("+item.subject_id+")' style='margin:5px'> <i class='glyphicon glyphicon-info-sign'></i> "+inf+"</button> <button class='btn btn-primary pull-left' onclick='assignTeacher("+item.subject_id+")' style='margin:5px'><i class='glyphicon glyphicon-plus-sign'></i> "+assign_teacher+"</button></td> </tr>");  

                    } else {

                      $('#table').html($('#table').html()+"<tr> <td>"+item.subject_name+"</td> <td> <button class='btn btn-danger pull-left' onclick='deleteSubjectConfirmation("+item.subject_id+")' style='margin:5px'> <i class='glyphicon glyphicon-remove-sign'></i> "+del+" </button> <button class='btn btn-info pull-left' onclick='info("+item.subject_id+")' style='margin:5px'> <i class='glyphicon glyphicon-info-sign'></i> "+inf+"</button> <button class='btn btn-primary pull-left' onclick='unassignTeacher("+item.subject_id+")' style='margin:5px'><i class='glyphicon glyphicon-minus-sign'></i> "+unassign_teacher+"</button></td> </tr>");
                    }
                    
                  }); 
              }
          },

        }); 
      }

    });



  $('#subjects').attr('class', 'dropdown active');

  $('#assign_teacher_submit').click(function () {

    $('#assign_error_msg').html('');
    $('#assign_error_msg').hide();
    $('#assign_teacher_submit').hide();

    if ($('#id_user').val() == '') {

      $('#assign_error_msg').html('<p>'+error_assign+'</p>');
    }

    if ($('#assign_error_msg').html() != '') {
    
      $('#assign_error_msg').show();
      $('#assign_teacher_submit').show();
      return false;
    } 

     return true;
  });

});


function info(subject_id) {

  fill_subject(subject_id);
  $('#subject_info').modal('show'); 
}


function deleteSubjectConfirmation(subject_id) {

  $('#delete_confirm').attr('href', 'destroy/'+subject_id);
  $('#subject_delete').modal('show'); 

}


function assignTeacher(subject_id) {

  $('#id_subject').val(subject_id);
  $('#subject_assign_teacher').modal('show'); 
}

function unassignTeacher(subject_id) {

  $('#unassign_teacher_confirm').attr('href', 'unassignTeacher/'+subject_id);
  $('#subject_unassign_teacher').modal('show'); 
}