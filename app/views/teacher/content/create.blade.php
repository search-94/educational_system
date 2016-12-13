@extends('layouts.teacher')
@section('libraries')
  @parent
  {{HTML::style('css/teacher/content/create.css')}}
  <script>
    var error_subject = "{{Lang::get('teacher.content.error.subject')}}";
    var error_name = "{{Lang::get('teacher.content.error.name')}}";
    var error_file = "{{Lang::get('teacher.content.error.file')}}";
    var error_file_size = "{{Lang::get('teacher.content.error.file_size')}}";
  </script>
  {{HTML::script('js/teacher/content/create.js')}}
@stop

@section('content')
   <h1 class="text-center">@lang('teacher.content.manage')</h1> 
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>@lang('teacher.content.create')</h4>
            </div>

            <div class="panel-body">
            {{Form::open(array('action' => 'TeacherContentController@store', 'files' => true, 'class' => 'form-horizontal'))}}  
              <div class="form-group">
                <label class="control-label col-sm-2" for="id_subject">@Lang('teacher.content.name_subject'):</label>
                <div class="col-sm-10">
                  <select class="form-control" id="id_subject" name="id_subject">
                    <option value="">@Lang('teacher.content.subject')</option>
                    @foreach($subjects as $subject)
                      <option value="{{$subject->id}}">{{$subject->name}} ({{$subject->id_grade}}°)</option>
                    @endforeach
                  </select>
                </div>  
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="name">@Lang('teacher.content.name'):</label>
                <div class="col-sm-10">
                  {{Form::text('name', null, array('id' => 'name', 'placeholder'=>Lang::get('teacher.content.name'), 'class' => 'form-control'))}}  
                </div>  
              </div>              
            
              <div class="form-group">
                <label class="control-label col-sm-2" for="file">@Lang('teacher.content.file'):</label>
                <div class="col-sm-10">
                  {{Form::file('file', array('id' => 'file', 'class' => 'form-control'))}}
                </div>  
              </div>  
              <hr>
              <p> 
                <center>
                  {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-default', 'id' => 'create_content_submit'))}}
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