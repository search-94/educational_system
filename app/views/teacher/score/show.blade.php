@extends('layouts.teacher')
@section('libraries')
  @parent
  {{HTML::style('css/teacher/score/show.css')}}
  {{HTML::script('js/teacher/score/show.js')}}
  <script>
    var error_subject = "@lang('teacher.score.error_subject')";
  </script>
@stop

@section('content')
 <h1 class="text-center">@lang('teacher.score.manage')</h1>
   <div class="panel panel-default">
  
      <div class="panel-heading">
        <h4>@lang('teacher.score.information')</h4>
      </div>

      <div class="panel-body">

        <div class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2" for="subject">@Lang('teacher.proposed_homework.name_subject'):</label>
            <div class="col-md-8">
              <select class="form-control" id="id_subject" name="id_subject">
                <option value="">@Lang('teacher.proposed_homework.subject')</option>
                @foreach($subjects as $subject)
                  <option value="{{$subject->id}}">{{$subject->name}} ({{$subject->id_grade}}°)</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <a class='btn btn-default' id='search_scores'> @lang('common.generate') </a> 
            </div>              
          </div>
        </div>

      </div>

    <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
    @if(Session::has('message'))
      <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
    @endif
  </div>

@stop