@extends('layouts.teacher')
@section('libraries')
  @parent
  {{HTML::style('css/teacher/proposed_homework/create.css')}}
  {{HTML::script('js/teacher/proposed_homework/create.js')}}
  <script>
    var error_subject = "{{Lang::get('teacher.proposed_homework.error.subject')}}";
    var error_name = "{{Lang::get('teacher.proposed_homework.error.name')}}";
    var error_file = "{{Lang::get('teacher.proposed_homework.error.file')}}";
    var error_weighing = "{{Lang::get('teacher.proposed_homework.error.weighing')}}";
    var error_culmination_date_empty = "{{Lang::get('teacher.proposed_homework.error.culmination_date_empty')}}";
    var error_culmination_date = "{{Lang::get('teacher.proposed_homework.error.culmination_date')}}";
    var current_date = "{{$current_date}}";
    var error_file_size = "{{Lang::get('teacher.proposed_homework.error.file_size')}}";
  </script>

<script>
  $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '<Ant',
     nextText: 'Sig>',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'yy-mm-dd',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#culmination_date").datepicker();
  });
</script>

@stop
@section('content')
   <h1 class="text-center">@lang('teacher.proposed_homework.manage')</h1> 
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>@lang('teacher.proposed_homework.create')</h4>
        </div>

        <div class="panel-body">
        {{Form::open(array('action' => 'TeacherProposedHomeworkController@store', 'files' => true, 'class' => 'form-horizontal' ))}}  
          
          <p>
            <input type="text" name="current_date" value="{{$current_date}}" style="display:none">
          </p> 

          <div class="form-group">
            <label class="control-label col-sm-3" for="id_subject">@Lang('teacher.proposed_homework.name_subject'):</label>
            <div class="col-sm-9">
              <select class="form-control" id="id_subject" name="id_subject">
                <option value="">@Lang('teacher.proposed_homework.subject')</option>
                @foreach($subjects as $subject)
                  <option value="{{$subject->id}}">{{$subject->name}} ({{$subject->id_grade}}°)</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="name">@Lang('teacher.proposed_homework.name'):</label>
            <div class="col-sm-9">
              {{Form::text('name', null, array('id' => 'name', 'placeholder'=>Lang::get('teacher.content.name'), 'class' => 'form-control'))}}  
            </div>
          </div>      

          <div class="form-group">
            <label class="control-label col-sm-3" for="weighing">@Lang('teacher.proposed_homework.weighing'):</label>
            <div class="col-sm-9">
              {{Form::select('weighing', array('' => Lang::get('teacher.proposed_homework.select_weighing'), '5' => '5%', '10' => '10%', '15' => '15%', '20' => '20%', '25' => '25%'), null, array('id' => 'weighing', 'class' => 'form-control'))}}
            </div>
          </div>          

          <div class="form-group">
            <label class="control-label col-sm-3" for="culmination_date">@Lang('teacher.proposed_homework.culmination_date'):</label>
            <div class="col-sm-9">
              {{Form::text('culmination_date', null, array('id' => 'culmination_date', 'placeholder'=>Lang::get('teacher.proposed_homework.culmination_date'), 'class' => 'form-control', 'onkeydown' => "return false"))}}
            </div>
          </div>      

          <div class="form-group">
            <label class="control-label col-sm-3" for="file">@Lang('teacher.proposed_homework.file'):</label>
            <div class="col-sm-9">
              {{Form::file('file', array('id' => 'file', 'class' => 'form-control'))}}
            </div>
          </div>   
          <hr>
          <p> 
            <center>
              {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-default', 'id' => 'create_proposed_homework_submit'))}}
            </center>
          </p>   
             
          {{Form::close()}}
          <div class="alert alert-danger" style="display:none;" id="error_msg"></div>
          @if(Session::has('message'))
            <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{Session::get('message')}}</div>
          @endif
        </div>
      </div>
      <br>
@stop