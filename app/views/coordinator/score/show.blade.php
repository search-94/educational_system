@extends('layouts.coordinator')
@section('libraries')
  @parent
  {{HTML::style('css/coordinator/score/show.css')}}
  {{HTML::script('js/coordinator/score/show.js')}}
  <script>

    var empty_grade = "{{Lang::get('coordinator.scores.empty_grade')}}";
    var empty_subjects = "{{Lang::get('coordinator.scores.empty_subjects')}}";
    var empty_subject = "{{Lang::get('coordinator.scores.empty_subject')}}";
    var select_subject = "{{Lang::get('coordinator.scores.select_subject')}}";
  </script>
@stop

@section('content')
 <h1 class="text-center">@lang('coordinator.scores.manage')</h1>
  <div class="panel panel-default">
  
      <div class="panel-heading">
        <h4>@lang('coordinator.scores.information')</h4>
      </div>

      <div class="panel-body">
 
        <div class="form-horizontal">

          <div class="form-group">
            <label class="control-label col-sm-2" for="id_grade">@Lang('coordinator.scores.grade'):</label>
            <div class="col-sm-10">
              <select class="form-control" id="id_grade" name="id_grade">
                <option value="">@Lang('coordinator.scores.select_grade')</option>
                @foreach($grades as $grade)
                  <option value="{{$grade->id}}">{{$grade->description}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group" id="div_subject" style="display:none">
            <label class="control-label col-sm-2" for="id_subject">@Lang('coordinator.scores.subject'):</label>
            <div class="col-sm-10">
              <select class="form-control" id="id_subject" name="id_subject">

              </select>
            </div>
          </div>


        </div>

   
        <p>
          <select class="form-control" id="id_subject" name="id_subject" style="display:none">

          </select>
        </p>

       <center> <a class='btn btn-default' id='search_scores' style='display:none'> @lang('common.generate') </a> </center>

      </div>

    <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
    @if(Session::has('message'))
    <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
    @endif
  </div>

@stop