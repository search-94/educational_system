@extends('layouts.teacher')
@section('libraries')
  @parent
  {{HTML::style('css/teacher/proposed_homework/show.css')}}
  <script>
    var homework_title = "{{Lang::get('teacher.proposed_homework.homework')}}";
    var culmination_date = "{{Lang::get('teacher.proposed_homework.culmination_date')}}";  
    var options = "{{Lang::get('student.proposed_homework.options')}}";
    var state = "{{Lang::get('student.proposed_homework.state')}}";
    var state_in_progress = "{{Lang::get('teacher.proposed_homework.state_in_progress')}}";
    var state_finished = "{{Lang::get('teacher.proposed_homework.state_finished')}}";
    var empty_subject = "{{Lang::get('common.empty_subject')}}";
    var empty_proposed_homework = "{{Lang::get('common.proposed_homework.empty')}}";
    var download = "{{Lang::get('common.download')}}";
    var evaluate = "{{Lang::get('common.evaluate')}}";
    var unevaluated_homeworks = "{{Lang::get('teacher.proposed_homework.unevaluated_homeworks')}}";
    var info = "{{Lang::get('common.info')}}";

  </script>
  {{HTML::script('js/teacher/proposed_homework/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('teacher.proposed_homework.manage')</h1>

   <div class="panel panel-default">

      <div class="panel-heading">
        <h4>@lang('teacher.proposed_homework.information')</h4>
      </div>

      <div class="panel-body">

        <div class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2" for="subject">@Lang('teacher.proposed_homework.name_subject'):</label>
            <div class="col-md-8">
              <select class="form-control" id="subject" name="subject">
                <option value="">@Lang('teacher.proposed_homework.subject')</option>
                @foreach($subjects as $subject)
                  <option value="{{$subject->id}}">{{$subject->name}} ({{$subject->id_grade}}°)</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              {{Form::button('Buscar', array('class'=>'btn btn-default', 'id' => 'search_homeworks')) }} 
            </div>              
          </div>
        </div>

        <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
    @if(Session::has('message'))
      <div class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
    @endif   
      </div>
      <div class='table-responsive'>

        <table  id = "table" class="table table-bordered table-hover">
        </table>

      </div>    
 
  </div>
  

@stop