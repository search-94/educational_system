@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/user/create.css')}}
  <script>
    var error_identity_card = "{{Lang::get('admin.user.error.identity_card')}}";
    var error_password = "{{Lang::get('admin.user.error.password')}}";
    var error_first_name = "{{Lang::get('admin.user.error.first_name')}}";
    var error_second_name = "{{Lang::get('admin.user.error.second_name')}}";
    var error_gender = "{{Lang::get('admin.user.error.gender')}}";
    var error_role = "{{Lang::get('admin.user.error.role')}}";
    var error_grade = "{{Lang::get('admin.user.error.grade')}}";

  </script>
  {{HTML::script('js/admin/user/create.js')}}
@stop

@section('content')
   <h1 class="text-center">@lang('admin.user.manage')</h1> 
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>@lang('admin.user.create')</h4>
        </div>

        <div class="panel-body">
          {{Form::open(array('action' => 'AdminUserController@store', 'class' => 'form-horizontal'))}}

          <div class="form-group">
            <label class="control-label col-sm-3" for="identity_card">@Lang('admin.user.id'):</label>
            <div class="col-sm-9">          
              {{Form::number('identity_card', null, array('id' => 'identity_card', 'placeholder'=>Lang::get('admin.user.id'), 'class' => 'form-control', 'autofocus' => 'true'))}} 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="first_name">@lang('admin.user.first_name'):</label>
            <div class="col-sm-9">          
              {{Form::text('first_name', null, array('id' => 'first_name', 'placeholder'=>Lang::get('admin.user.first_name'), 'class' => 'form-control'))}}  
            </div>
          </div>         

          <div class="form-group">
            <label class="control-label col-sm-3" for="second_name">@lang('admin.user.second_name'):</label>
            <div class="col-sm-9">          
              {{Form::text('second_name', null, array('id' => 'second_name', 'placeholder'=>Lang::get('admin.user.second_name'), 'class' => 'form-control'))}}  
            </div>
          </div>     

          <div class="form-group">
            <label class="control-label col-sm-3" for="id_gender">@lang('admin.user.gender'):</label>
            <div class="col-sm-9">          
              <select class="form-control" id="id_gender" name="id_gender">
                <option value="">@Lang('admin.user.select_gender')</option>
                @foreach($genders as $gender)
                  <option value="{{$gender->id}}">{{$gender->description}}</option>
                @endforeach
              </select>
            </div>
          </div>                 

          <div class="form-group">
            <label class="control-label col-sm-3" for="id_role">@lang('admin.user.role'):</label>
            <div class="col-sm-9">          
              <select class="form-control" id="id_role" name="id_role">
                <option value="">@Lang('admin.user.select_role')</option>
                @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->description}}</option>
                @endforeach
              </select>
            </div>
          </div>    

          <div class="form-group" id="grade_container" style="display:none">
            <label class="control-label col-sm-3" for="id_grade">@lang('admin.user.grade'):</label>
            <div class="col-sm-9">          
              <select class="form-control" id="id_grade" name="id_grade">
                <option value="">@Lang('admin.user.select_grade')</option>
                @foreach($grades as $grade)
                  <option value="{{$grade->id}}">{{$grade->description}}</option>
                @endforeach
              </select>
            </div>
          </div>              
          <hr>
          <div class="form-group"> 
            <center>
              {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-default', 'id' => 'create_user_submit'))}}
            </center>
          </div>     

          {{Form::close()}}
          <div class="alert alert-danger" style="display:none;" id="error_msg"></div>
          @if(Session::has('message'))
            <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{Session::get('message')}}</div>
          @endif
        </div>
      </div>
      <br>


@stop