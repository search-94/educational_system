function fill_subject(id_subject) {

    $.ajax({

      url: 'info',
      type: "post",
      data: {'id_subject': id_subject},
      success: function(subject) {

          var subject_info = JSON.parse(subject);
          $("#subject_name").text(subject_info.subject_name);
          $("#id_grade").text(subject_info.subject_id_grade);

          if (subject_info.subject_id != null) {

            $("#teacher_info").show();
            $("#identity_card").text(subject_info.user_identity_card);
            $("#first_name").text(subject_info.user_first_name);
            $("#second_name").text(subject_info.user_second_name);
            $("#email").text(subject_info.user_email);
          } else {

            $("#teacher_info").hide();
          }
        
      },

    }); 
}

$(document).ready(function() {

  $("#subjects").attr('class', 'dropdown active');
  $('.info').click(function() {

    fill_subject(this.id); 
    $("#modal_info").modal('show');   
  });



});


function deleteSubjectConfirmation(subject_id) {


    $('#modal_subject_delete_confirm').attr('href', 'destroy/'+subject_id);

    $('#deleteSubject').modal('show');

}
