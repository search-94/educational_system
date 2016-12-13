@extends('layouts.coordinator')
@section('libraries')
  @parent
  {{HTML::style('css/coordinator/account/password.css')}}
  {{HTML::script('js/coordinator/account/password.js')}}
    <script>
    var error_password          = "{{Lang::get('account.error.password')}}";
    var error_password_confirm  = "{{Lang::get('account.error.password_confirm')}}";  
    var error_actual_password   = "{{Lang::get('account.error.actual_password')}}";  
  </script>
@stop
@section('content')
<h1 class="text-center">@lang('account.manage')</h1> 
<div class="panel panel-default">
  <div class="panel-heading">
    <h4>@lang('account.update')</h4>
  </div>

  <div class="panel-body">
    {{Form::open(array('action' => 'CoordinatorAccountController@update', 'class' => 'form-horizontal'))}}
      <div class="form-group">
        <label class="control-label col-sm-3" for="actual_password_introduced">@lang('account.actual_password'):</label>
        <div class="col-sm-9">
          {{Form::password('actual_password_introduced', array('id' => 'actual_password_introduced', 'placeholder'=>Lang::get('account.actual_password'), 'class' => 'form-control', 'autofocus' => 'true'))}}  
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="new_password">@lang('account.new_password'):</label>
        <div class="col-sm-9">
          {{Form::password('new_password', array('id' => 'new_password', 'placeholder'=>Lang::get('account.new_password'), 'class' => 'form-control'))}}  
        </div>
      </div>  

      <div class="form-group">
        <label class="control-label col-sm-3" for="confirm_password">@lang('account.confirm_password'):</label>
        <div class="col-sm-9">
          {{Form::password('confirm_password', array('id' => 'confirm_password', 'placeholder'=>Lang::get('account.confirm_password'), 'class' => 'form-control'))}}  
        </div>
      </div> 
      <hr>
    <p> 
      <center>
      {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-default', 'id' => 'change_password_submit'))}}
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