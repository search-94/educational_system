@extends('layouts.teacher')
@section('libraries')
  @parent
  {{HTML::style('css/teacher/content/show.css')}}
  {{HTML::script('js/teacher/content/show.js')}}
  <script>
    var content_title = "{{Lang::get('common.content.name')}}";
    var publication_date = "{{Lang::get('common.content.publication_date')}}";
    var options = "{{Lang::get('common.options')}}";
    var download = "{{Lang::get('common.download')}}";
    var delete_content = "{{Lang::get('common.delete')}}";
    var empty_content = "{{Lang::get('common.content.empty')}}";
    var empty_subject = "{{Lang::get('common.empty_subject')}}";
  </script>
@stop

@section('content')
  <h1 class="text-center">@lang('teacher.content.manage')</h1>
    <div class="panel panel-default">
  
      <div class="panel-heading">
        <h4>@lang('teacher.content.information')</h4>
      </div>

      <div class="panel-body">
        <div class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2" for="subject">@Lang('teacher.proposed_homework.name_subject'):</label>
            <div class="col-md-8">
              <select class="form-control" id="subject" name="subject">
                <option value="">@Lang('teacher.content.subject')</option>
                @foreach($subjects as $subject)
                  <option value="{{$subject->id}}">{{$subject->name}} ({{$subject->id_grade}}°)</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              {{Form::button('Buscar', array('class'=>'btn btn-default', 'id' => 'search_contents')) }}   
            </div>              
          </div>
        </div>
      </div>
      <div class='table-responsive'>

        <table  id = "table" class="table table-bordered table-hover">
        </table>

      </div>  

      <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
      @if(Session::has('message'))
        <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
      @endif
    </div>

      <!-- Modal window to confirm delete -->
    <div class="modal fade" id="modal_delete_content" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("common.delete") </h4>
          </div>
          <div class="modal-body">
           @lang("teacher.content.delete_confirm")
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang("common.close")</button>
            <a  id = "delete_content" class="btn btn-primary">             
               @lang("common.accept")
            </a>
          </div>
        </div>
      </div>
    </div>
@stop