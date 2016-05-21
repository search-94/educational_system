@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/user/create.css')}}
  <script>
    var error_identity_card = "{{Lang::get('admin.user.error.identity_card')}}";
    var error_password = "{{Lang::get('admin.user.error.password')}}";
    var error_first_name = "{{Lang::get('admin.user.error.first_name')}}";
    var error_second_name = "{{Lang::get('admin.user.error.second_name')}}";
    var error_role = "{{Lang::get('admin.user.error.role')}}";
    var error_grade = "{{Lang::get('admin.user.error.grade')}}";
  </script>
  {{HTML::script('js/admin/user/create.js')}}
@stop

@section('content')
   <h1 class="text-center">@lang('admin.user.manage')</h1> 
          <div class="panel panel-success">
            <div class="panel-heading">
              <h4>@lang('admin.user.create')</h4>
            </div>

            <div class="panel-body">
              {{Form::open(array('action' => 'AdminUserController@store'))}}
              <p>
                {{Form::number('identity_card', null, array('id' => 'identity_card', 'placeholder'=>Lang::get('admin.user.id'), 'class' => 'form-control', 'autofocus' => 'true'))}}  
              </p>
              <p>
                {{Form::password('password', array('id' => 'password', 'placeholder'=>Lang::get('admin.user.password'), 'class' => 'form-control'))}}  
              </p>      
              <p>
                {{Form::text('first_name', null, array('id' => 'first_name', 'placeholder'=>Lang::get('admin.user.first_name'), 'class' => 'form-control'))}}  
              </p>
              <p>
                {{Form::text('second_name', null, array('id' => 'second_name', 'placeholder'=>Lang::get('admin.user.second_name'), 'class' => 'form-control'))}}  
              </p>    
              <p>
              <select class="form-control" id="id_role" name="id_role">
                <option value="">@Lang('admin.user.role')</option>
                @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->description}}</option>
                @endforeach
              </select>
              </p> 
              <p class="hidden" id="grade_container"> 
                <select class="form-control" id="id_grade" name="id_grade">
                  <option value="">@Lang('admin.user.grade')</option>
                  @foreach($grades as $grade)
                    <option value="{{$grade->id}}">{{$grade->description}}</option>
                  @endforeach
                </select>
              </p>      
              <p> 
                <center>
                {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-success', 'id' => 'create_user_submit'))}}
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