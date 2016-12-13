@extends('layouts.student')
@section('libraries')
  @parent
  {{HTML::style('css/student/content/show.css')}}
  <script>
    var content_title = "{{Lang::get('common.content.name')}}";
    var publication_date = "{{Lang::get('common.content.publication_date')}}";
    var options = "{{Lang::get('common.options')}}";
    var download = "{{Lang::get('common.download')}}";
    var empty_content = "{{Lang::get('common.content.empty')}}";
    var empty_subject = "{{Lang::get('common.empty_subject')}}";
  </script>
  {{HTML::script('js/student/content/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('student.content.manage')</h1>
   <div class="panel panel-default">
  
      <div class="panel-heading">
        <h4>@lang('teacher.content.information')</h4>
      </div>

      <div class="panel-body">

          <div class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-2" for="subject">@Lang('student.content.name_subject'):</label>
              <div class="col-md-8">
                <select class="form-control" id="subject" name="subject">
                  <option value="">@Lang('student.content.select_subject')</option>
                  @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
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
      <div class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
    @endif
  </div>

@stop