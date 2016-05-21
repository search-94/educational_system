@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/user/show.css')}}
  <script>
    var active = "{{Lang::get('common.active')}}";
    var inactive = "{{Lang::get('common.inactive')}}";

    var empty_role = "{{Lang::get('admin.user.empty.role')}}";
    var empty_grade = "{{Lang::get('admin.user.empty.grade')}}";
    var empty_password = "{{Lang::get('admin.user.empty.password')}}";

    var error_first_name = "{{Lang::get('admin.user.error.first_name')}}";
    var error_second_name = "{{Lang::get('admin.user.error.second_name')}}";

    var length_first_name = "{{Lang::get('admin.user.length.first_name')}}";
    var length_second_name = "{{Lang::get('admin.user.length.second_name')}}";

  </script>
  {{HTML::script('js/admin/user/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('admin.user.manage')</h1>
   <div class="panel panel-success">
   	<div class="panel-heading">
      <h4>@lang('admin.user.information')</h4>
    </div>

    <div class="panel-body">
       	<div class="row">
            <div class="form-group col-md-10">
              {{Form::number('identity_card','',array('id'=>'identity_card','class'=>'form-control','placeholder' => 'Cédula de identidad', 'autofocus' => 'true'))}}
            </div>

            <div class="form-group col-md-2">
					     {{Form::button('Buscar', array('class'=>'btn btn-confirm', 'id' => 'send-btn')) }}
            </div>
   	    </div>
    </div>
    <div id='info' style='display:none'>
      <div class='table-responsive'>
        <table class='table table-hover table-bordered'>
          <tr>
            <td>
              @lang('admin.user.state')
            </td>
            <td>
              <label id='info_is_active'></label>
            </td>
          </tr>
          <tr>
            <td>
              @lang('admin.user.first_name')
            </td>
            <td>
              <label id='info_first_name'>
            </td>
          </tr>

          <tr>
            <td>
              @lang('admin.user.second_name')
            </td>
            <td>
              <label id='info_second_name'>
            </td>
          </tr> 

          <tr>
            <td>
              @lang('admin.user.role')
            </td>
            <td>
              <label id='info_role'></label>
            </td>
          </tr>

          <tr id='info_grade_row' style='display:none'>
            <td>
              @lang('admin.user.grade')
            </td>
            <td>
            <label id='info_grade'></label>
            </td>
          </tr>
        </table>
      </div>  

      <div id='buttons_active' style="display:none">
        <button id='show_modal_edit_user' class='btn btn-info' value='submit'>Actualizar</button> 
        <button id='confirm_delete_user' type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_delete_user">Eliminar</button>
      </div>

      <div id='buttons_inactive' style="display:none">
        <button class='btn btn-info' id ="show_modal_restore_user">Reactivar</button>
      </div>
    </div>

	  @if(Session::has('message'))
	    <div id="server_error_msg" class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
	  @endif

    <div class="alert alert-danger alert-dismissable" style="display:none;" id="error_msg"></div> 
  </div>

<div id="modal_edit_user" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >Actualizar</h4>
      </div>
      <div class="modal-body">
      {{Form::open(array('action' => 'AdminUserController@update'))}}
        <input id='update_user_id' name='update_user_id' style="display:none">
        <div class='table-responsive'>
        <table class='table table-hover table-bordered'>
          <tr>
            <td>
              @lang('admin.user.first_name')
            </td>
            <td>
              <input id='update_first_name' name='update_first_name' class='form-control' type='text' style='width: 100%' required>
            </td>
          </tr>

          <tr>
            <td>
              @lang('admin.user.second_name')
            </td>
            <td>
              <input id='update_second_name' name='update_second_name' class='form-control' type='text' style='width: 100%' required>
              
            </td>
          </tr> 

          <tr>
            <td>
              @lang('admin.user.password')
            </td>
            <td>
              {{Form::password('update_password', array('id' => 'update_password', 'class' => 'form-control'))}}  
              
            </td>
          </tr> 
        </table>
      </div>  
      <div class="alert alert-danger" style="display:none;" id="update_error_msg"></div> 
      </div>
      <div class="modal-footer">
        {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-success', 'id' => 'update'))}}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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


<div id="modal_restore_user" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >@lang("common.restore")</h4>
      </div>
      <div class="modal-body">
      {{Form::open(array('action' => 'AdminUserController@restore'))}}
        <input id='restore_user_id' name='user_id' style="display:none">
        <div class='table-responsive'>
        <table class='table table-hover table-bordered'>
          <tr>
            <td>
              @lang('admin.user.first_name')
            </td>
            <td>
              <input id='restore_first_name' name='first_name' class='form-control' type='text' style='width: 100%' required>
            </td>
          </tr>

          <tr>
            <td>
              @lang('admin.user.second_name')
            </td>
            <td>
              <input id='restore_second_name' name='second_name' class='form-control' type='text' style='width: 100%' required>
              
            </td>
          </tr> 

          <tr>
              <td>
                @lang('admin.user.role')
              </td>
              <td>
                <select id='restore_role' name='id_role' class='form-control' required>
                  <option>Seleccione</option>
                  @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->description}}</option>
                  @endforeach
                </select>
              </td>
          </tr> 

          <tr>
              <td>
                @lang('admin.user.password')
              </td>
              <td>
                {{Form::password('password', array('id' => 'restore_password', 'placeholder'=>Lang::get('admin.user.password'), 'class' => 'form-control', 'required' => 'true'))}}  
              </td>
          </tr> 


          <tr id="restore_grade_row">
              <td>
                @lang('admin.user.grade')
              </td>
              <td>
                <select class="form-control" id="restore_id_grade" name="id_grade">
                  <option value="">@Lang('admin.user.grade')</option>
                  @foreach($grades as $grade)
                    <option value="{{$grade->id}}">{{$grade->description}}</option>
                  @endforeach
                </select>
              </td>
          </tr> 

        </table>
      </div>  

      </div>
      <div class="modal-footer">
        {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-success', 'id' => 'restore'))}}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      {{Form::close()}}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
@stop