@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/subject/create.css')}}
  <script>
    var error_name = "{{Lang::get('admin.subject.error.name')}}";
    var error_grade = "{{Lang::get('admin.subject.error.grade')}}";
    var error_user = "{{Lang::get('admin.subject.error.user')}}";
  </script>
  {{HTML::script('js/admin/subject/create.js')}}
@stop

@section('content')
   <h1 class="text-center">@lang('admin.subject.manage')</h1>
        
          <div class="panel panel-success">
            <div class="panel-heading">
              <h4>@lang('admin.subject.create')</h4>
            </div>

            <div class="panel-body">
              {{Form::open(array('action' => 'AdminSubjectController@store'))}}
              <p>
                {{Form::text('name', null, array('id'=>'name', 'placeholder'=>Lang::get('admin.subject.name'), 'class' => 'form-control'))}}  
              </p>
              <p id="grade_container"> 
                <select class="form-control" id="id_grade" name="id_grade">
                  <option value="">@Lang('admin.subject.grade')</option>
                  @foreach($grades as $grade)
                    <option value="{{$grade->id}}">{{$grade->description}}</option>
                  @endforeach
                </select>
              </p>      
              <p id="grade_container"> 
                <select class="form-control" id="id_user" name="id_user">
                  <option value="">@Lang('admin.subject.teacher')</option>
                  @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->second_name}} ({{$user->identity_card}})</option>
                  @endforeach
                </select>
              </p>  
              <p> 
                <center>
                {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-success', 'id' => 'create_subject_submit'))}}
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