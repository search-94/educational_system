@extends('layouts.student')
@section('libraries')
  @parent
  {{HTML::style('css/student/proposed_homework/show.css')}}
  <script>
    var homework_title = "{{Lang::get('student.proposed_homework.homework')}}";
    var culmination_date = "{{Lang::get('student.proposed_homework.culmination_date')}}";
    var options = "{{Lang::get('student.proposed_homework.options')}}";
    var state = "{{Lang::get('student.proposed_homework.state')}}";
    var state_waiting = "{{Lang::get('student.proposed_homework.state_waiting')}}";
    var state_sent = "{{Lang::get('student.proposed_homework.state_sent')}}";
    var state_evaluated = "{{Lang::get('student.proposed_homework.state_evaluated')}}";
    var state_unsent = "{{Lang::get('student.proposed_homework.state_unsent')}}";
    var id_user = "{{$id_user}}";
    var empty_subject = "{{Lang::get('common.empty_subject')}}";
    var empty_proposed_homework = "{{Lang::get('common.proposed_homework.empty')}}";
    var download = "{{Lang::get('common.download')}}";
    var send_evaluation = "{{Lang::get('common.send_evaluation')}}";
    var info = "{{Lang::get('common.info')}}";
    var empty_done_homework = "{{Lang::get('student.done_homework.empty')}}"
    var error_file_size = "{{Lang::get('student.done_homework.error_file_size')}}"
    var empty_observations = "{{Lang::get('student.done_homework.empty_observations')}}"
  </script>
  {{HTML::script('js/student/proposed_homework/show.js')}}
@stop

@section('content')
  <h1 class="text-center">@lang('student.proposed_homework.manage')</h1>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>@lang('student.proposed_homework.information')</h4>
      </div>
      <div class="panel-body">
        <div class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2" for="subject">@Lang('student.proposed_homework.name_subject'):</label>
            <div class="col-md-8">
              <select class="form-control" id="subject" name="subject">
                <option value="">@Lang('student.content.select_subject')</option>
                @foreach($subjects as $subject)
                  <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              {{Form::button('Buscar', array('class'=>'btn btn-default', 'id' => 'search_homeworks')) }}   
            </div>              
          </div>
          
        </div>
        <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
        @if(Session::has('message'))
          <div id="server_msg" class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
        @endif
      </div>
      <div class='table-responsive'>

        <table  id = "table" class="table table-bordered table-hover">
        </table>

      </div>  

    </div>

      <!-- Modal window to send homework -->
    <div class="modal fade" id="modal_send_homework" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("student.done_homework.send") </h4>
          </div>
          {{Form::open(array('id' => 'send_form', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal' ))}}  
            <div class="modal-body">

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("student.proposed_homework.name_subject"):</b></small></div>
                <div class="col-md-3"> <p id='name_subject'></p></div>
                <div class="col-md-3"><small><b>@lang("student.proposed_homework.teacher"):</b></small></div>
                <div class="col-md-3"> <p id='teacher'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.name"):</b></small></div>
                <div class="col-md-3"> <p id='name'></p></div>
                <div class="col-md-3"><small><b>@lang("common.weighing"):</b></small></div>
                <div class="col-md-3"> <p id='weighing'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.assignment_date"):</b></small></div>
                <div class="col-md-3"> <p id='creation_date'></p></div>
                <div class="col-md-3"><small><b>@lang("common.culmination_date"):</b></small></div>
                <div class="col-md-3"> <p id='culmination_date'></p></div>
              </div>
              <hr>
              <div class="form-group" style="margin:10px;">
                <label class="control-label col-sm-2" for="done_homework">@Lang('common.file'):</label>
                <div class="col-sm-10">
                  {{Form::file('done_homework', array('id' => 'done_homework', 'class' => 'form-control'))}}
                </div>
              </div>
               <br>
            <div class="alert alert-danger" style="display:none" id="modal_send_error"></div> 

            </div>

            <div class="modal-footer">
            <a type="submit"  class="btn btn-default" data-dismiss="modal">@lang("common.close")</a>
              <input id="send_homework_confirm" type='submit' class='btn btn-primary' value = "{{Lang::get('common.send')}}"> 
            </div>
          {{Form::close()}}
        </div>
      </div>
    </div>

          <!-- Modal window to view information of the homework -->
    <div class="modal fade" id="modal_info_homework" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("common.info") </h4>
          </div>
            <div class="modal-body">

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("student.proposed_homework.name_subject"):</b></small></div>
                <div class="col-md-3"> <p id='info_name_subject'></p></div>
                <div class="col-md-3"><small><b>@lang("student.proposed_homework.teacher"):</b></small></div>
                <div class="col-md-3"> <p id='info_teacher'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.name"):</b></small></div>
                <div class="col-md-3"> <p id='info_name'></p></div>
                <div class="col-md-3"><small><b>@lang("common.weighing"):</b></small></div>
                <div class="col-md-3"> <p id='info_weighing'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.assignment_date"):</b></small></div>
                <div class="col-md-3"> <p id='info_creation_date'></p></div>
                <div class="col-md-3"><small><b>@lang("common.culmination_date"):</b></small></div>
                <div class="col-md-3"> <p id='info_culmination_date'></p></div>
              </div>

            </div>

            <div class="modal-footer">
              <a type="submit"  class="btn btn-default" data-dismiss="modal">@lang("common.close")</a>
            </div>
        
        </div>
      </div>
    </div>

       <!-- Modal window to view score of the homework -->
    <div class="modal fade" id="modal_evaluated_homework" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("common.info") </h4>
          </div>
            <div class="modal-body">

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("student.proposed_homework.name_subject"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_name_subject'></p></div>
                <div class="col-md-3"><small><b>@lang("student.proposed_homework.teacher"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_teacher'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.name"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_name'></p></div>
                <div class="col-md-3"><small><b>@lang("common.weighing"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_weighing'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.assignment_date"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_assignment_date'></p></div>
                <div class="col-md-3"><small><b>@lang("common.send_date"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_culmination_date'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.evaluated_date"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_corrected_date'></p></div>                  
                <div class="col-md-3"><small><b>@lang("common.score"):</b></small></div>
                <div class="col-md-3"> <p id='evaluated_score'></p></div>
              </div>

              <div class="row" style="margin:10px;">
                <div class="col-md-3"><small><b>@lang("common.observations"):</b></small></div>
                <div class="col-md-9"> <p id='evaluated_observations'></p></div>
              </div>              

            </div>

            <div class="modal-footer">
              <a type="submit"  class="btn btn-default" data-dismiss="modal">@lang("common.close")</a>
            </div>
        
        </div>
      </div>
    </div>

  </div>

@stop