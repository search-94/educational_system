@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/user/show.css')}}
  <script>
    var active = "{{Lang::get('common.active')}}";
    var inactive = "{{Lang::get('common.inactive')}}";

    var error_first_name = "{{Lang::get('admin.user.error.first_name')}}";
    var error_second_name = "{{Lang::get('admin.user.error.second_name')}}";
    var error_role = "{{Lang::get('admin.user.error.role')}}";
    var error_grade = "{{Lang::get('admin.user.error.grade')}}";
    var error_gender = "{{Lang::get('admin.user.error.gender')}}";

    var id_usr = "{{$id_usr}}";
  </script>
  {{HTML::script('js/admin/user/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('admin.user.manage')</h1>
   <div class="panel panel-default">
   	<div class="panel-heading">
      <h4>@lang('admin.user.information')</h4>
    </div>

    <div class="panel-body">

      <div class="form-horizontal">
        <div class="form-group">
          <label class="control-label col-md-3" for="identity_card">@Lang('admin.user.user'):</label>
          <div class="col-md-7">
            {{Form::text('identity_card','',array('id'=>'identity_card','class'=>'form-control','placeholder' => Lang::get('admin.user.user'), 'autofocus' => 'true'))}}
          </div>
          <div class="col-md-2">
             {{Form::button('Buscar', array('class'=>'btn btn-default', 'id' => 'send-btn')) }}
          </div>              
        </div>
      </div>

    </div>
    <div id='info' style='display:none'>
      <div class='table-responsive'>
        <table class='table table-hover table-bordered'>
          <tr>
            <td>
             <b> @lang('admin.user.state'): </b>
            </td>
            <td>
              <span id='info_is_active'></span>
            </td>
          </tr>
          <tr>
            <td>
              <b>@lang('admin.user.first_name'): </b>
            </td>
            <td>
              <span id='info_first_name'></span>
            </td>
          </tr>

          <tr>
            <td>
             <b> @lang('admin.user.second_name'):</b>
            </td>
            <td>
              <span id='info_second_name'></span>
            </td>
          </tr> 

          <tr>
            <td>
              <b>@lang('admin.user.gender'):</b>
            </td>
            <td>
              <span id='info_gender'></span>
            </td>
          </tr>           

          <tr>
            <td>
              <b>@lang('admin.user.role'):</b>
            </td>
            <td>
              <span id='info_role'></span>
            </td>
          </tr>

          <tr id='info_grade_row' style='display:none'>
            <td>
              <b>@lang('admin.user.grade'):</b>
            </td>
            <td>
            <span id='info_grade'></span>
            </td>
          </tr>
        </table>
      </div>  

      <div id='buttons_active' style="display:none">
        <button id='show_modal_edit_user' class='btn btn-primary' value='submit'><span class='glyphicon glyphicon-wrench'></span> @lang('common.update')</button> 
        <button id='confirm_delete_user' type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_delete_user"> <span class='glyphicon glyphicon-remove'></span> @lang('common.delete')</button>
      </div>

      <div id='buttons_inactive' style="display:none">
        <button class='btn btn-primary' id ="show_modal_restore_user">@lang('common.reactivate')</button>
      </div>
    </div>

	  @if(Session::has('message'))
	    <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
	  @endif

    <div class="alert alert-danger alert-dismissable" style="display:none;" id="error_msg"></div> 
  </div>

<!-- Update user -->

<div id="modal_edit_user" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >@lang('common.update')</h4>
      </div>
      <div class="modal-body">
      {{Form::open(array('action' => 'AdminUserController@update', 'class' => 'form-horizontal'))}}
        <input id='update_user_id' name='update_user_id' style="display:none">
        <input id='update_identity_card' name='update_identity_card' style="display:none">
        <input id='r_pass' name='r_pass' style="display:none">


        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="update_first_name">@lang('admin.user.first_name'):</label>
          <div class="col-sm-10">
            <input id='update_first_name' name='update_first_name' class='form-control' type='text' style='width: 100%'>
          </div>
        </div>

        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="update_second_name">@lang('admin.user.second_name'):</label>
          <div class="col-sm-10">
            <input id='update_second_name' name='update_second_name' class='form-control' type='text' style='width: 100%'>
          </div>
        </div>

        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="update_gender">@lang('admin.user.gender'):</label>
          <div class="col-sm-10">
            <select id='update_gender' name='update_gender' class='form-control'>
              <option value="">@Lang('admin.user.gender')</option>
              @foreach($genders as $gender)
                <option value="{{$gender->id}}">{{$gender->description}}</option>
              @endforeach
            </select>
          </div>
        </div>        

      <div style="margin:25px;">@lang('admin.user.restore_password')
        {{Form::checkbox('reset_password', 'no', false, array('id' => 'reset_password'))}}
      </div>
      <div class="alert alert-danger" style="display:none;" id="update_error_msg"></div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-primary', 'id' => 'update'))}}
      </div>
      {{Form::close()}}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<!-- Modal window to confirm delete -->
    <div class="modal fade" id="modal_delete_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("common.delete") </h4>
          </div>
          <div class="modal-body">
           @lang("admin.user.delete_confirm")
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang("common.close")</button>
            <a  id = "delete_user" class="btn btn-primary">             
               @lang("common.accept")
            </a>
          </div>
        </div>
      </div>
    </div>

<!-- Modal window to restore user -->
<div id="modal_restore_user" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >@lang("common.restore")</h4>
      </div>
      <div class="modal-body">
      {{Form::open(array('action' => 'AdminUserController@restore', 'class' => 'form-horizontal'))}}
        <input id='restore_user_id' name='restore_user_id' style="display:none">
        <input id='restore_identity_card' name='restore_identity_card' style="display:none">


        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="restore_first_name">@lang('admin.user.first_name'):</label>
          <div class="col-sm-10">
            <input id='restore_first_name' name='restore_first_name' class='form-control' type='text' style='width: 100%'>
          </div>
        </div>

        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="restore_second_name">@lang('admin.user.second_name'):</label>
          <div class="col-sm-10">
            <input id='restore_second_name' name='restore_second_name' class='form-control' type='text' style='width: 100%'>
          </div>
        </div>
 
        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="restore_id_gender">@lang('admin.user.gender'):</label>
          <div class="col-sm-10">
            <select id='restore_id_gender' name='restore_id_gender' class='form-control'>
              <option value="">@Lang('admin.user.gender')</option>
              @foreach($genders as $gender)
                <option value="{{$gender->id}}">{{$gender->description}}</option>
              @endforeach
            </select>
          </div>
        </div>           

        <div class="form-group" style="margin:10px;">
          <label class="control-label col-sm-2" for="restore_id_role">@lang('admin.user.role'):</label>
          <div class="col-sm-10">
            <select id='restore_id_role' name='restore_id_role' class='form-control'>
              <option value="">@Lang('admin.user.role')</option>
              @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->description}}</option>
              @endforeach
            </select>
          </div>
        </div>    

        <div class="form-group" id="restore_grade_row" style="margin:10px;">
          <label class="control-label col-sm-2" for="restore_id_grade">@lang('admin.user.grade'):</label>
          <div class="col-sm-10">
            <select class="form-control" id="restore_id_grade" name="restore_id_grade">
              <option value="">@Lang('admin.user.grade')</option>
              @foreach($grades as $grade)
                <option value="{{$grade->id}}">{{$grade->description}}</option>
              @endforeach
            </select>
          </div>          
        </div>  

      <div class="alert alert-danger" style="display:none;" id="restore_error_msg"></div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-primary', 'id' => 'restore'))}}
      </div>
      {{Form::close()}}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script>
  $(function(){
    var names = {{$names}};

    $("#identity_card").autocomplete({

      source: function(request, response) {
          var results = $.ui.autocomplete.filter(names, request.term);

          response(results.slice(0, 10));
      }
    });
  });

</script>
@stop