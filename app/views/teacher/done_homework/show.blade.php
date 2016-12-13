@extends('layouts.teacher')
@section('libraries')
  @parent
  {{HTML::style('css/teacher/done_homework/show.css')}}
  <script>
    var empty_score = "{{Lang::get('teacher.done_homework.error.score')}}";
  </script>
  {{HTML::script('js/teacher/done_homework/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('teacher.done_homework.manage')</h1>

   <div class="panel panel-default">
      <div class="panel-heading">
        <h4>@lang('teacher.done_homework.proposed_homework_info')</h4>
      </div>
        <table class="table table-bordered table-hover">
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.year'):</b>
            </td>
            <td>  
              {{$period->year}} / {{$period->year+1}} 
            </td>            
          </tr>  
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.lapse'):</b>
            </td>
            <td>  
              {{$period->lapse}}°
            </td>            
          </tr>                   
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.name_subject'):</b>
            </td>
            <td>  
              {{$subject}}
            </td>            
          </tr>
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.homework'):</b>
            </td>
            <td>  
              {{$proposed_homework->name}}
            </td>            
          </tr>
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.weighing'):</b>
            </td>
            <td>  
              {{$proposed_homework->weighing}}%
            </td>            
          </tr>
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.assignment_date'):</b>
            </td>
            <td>  
              {{$proposed_homework->spanish_creation_date}}
            </td>            
          </tr>    
          <tr>
            <td>  
              <b>@lang('teacher.done_homework.culmination_date'):</b>
            </td>
            <td>  
              {{$proposed_homework->spanish_culmination_date}}
            </td>            
          </tr>             

        </table>

   </div>
    <br>
   <div class="panel panel-default">

    @if($done_homeworks!=null) 
      <div class="panel-heading">
        <h4>@lang('teacher.done_homework.done_homeworks_info')</h4>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>@lang('teacher.done_homework.id')</th>
                <th>@lang('teacher.done_homework.first_name')</th>
                <th>@lang('teacher.done_homework.second_name')</th>
                <th>@lang('teacher.done_homework.state')</th>
                <th>@lang('teacher.done_homework.options')</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($done_homeworks as $done_homework)
              <tr>
                <td>
                  {{$done_homework->identity_card}}
                </td>
                <td>
                  {{$done_homework->first_name}}
                </td>
                <td>
                  {{$done_homework->second_name}}
                </td>
                @if($done_homework->score != null) <!-- if the done homework is corrected -->
                  <td>
                    @lang("teacher.done_homework.state_evaluated")
                  </td>
                  <td>
                  <a class="btn btn-primary" href = '/teacher/done_homework/download/{{$done_homework->id}}'>             
                    <i class= "glyphicon glyphicon-download-alt"></i> @lang('teacher.done_homework.download')
                  </a> 

                  <button class='btn btn-info' onclick='modal_info_done_homework({{$done_homework->id}}, "{{$done_homework->first_name}}", "{{$done_homework->second_name}}","{{$done_homework->identity_card}}", "{{$done_homework->spanish_creation_date}}", "{{$done_homework->spanish_evaluated_date}}", "{{$done_homework->score}}")'>
                     <i class= "glyphicon glyphicon-info-sign"></i> @lang('teacher.done_homework.info')
                  </button> 
                </td>
                @else <!--if the done homework is not corrected-->
                  <td>
                    @lang("teacher.done_homework.state_unevaluated")
                  </td>
                              
                  <td>
                    <a class="btn btn-primary" href = '/teacher/done_homework/download/{{$done_homework->id}}'>             
                      <i class= "glyphicon glyphicon-download-alt"></i> @lang('teacher.done_homework.download')
                    </a> 

                    <button class='btn btn-success' onclick='modal_evaluate_done_homework({{$done_homework->id}}, "{{$done_homework->first_name}}", "{{$done_homework->second_name}}","{{$done_homework->identity_card}}", "{{$done_homework->spanish_creation_date}}")'>
                       <i class= "glyphicon glyphicon-ok"></i> @lang('teacher.done_homework.evaluate')
                    </button> 
                  </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal window to evaluate done homework -->
    <div class="modal fade" id="modal_send_homework" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("teacher.done_homework.evaluate") </h4>
          </div>
          {{Form::open(array('id' => 'send_form', 'class'=>"form-horizontal"))}}  
            <div class="modal-body">

              <div class="row" style="margin:10px">
                <div class="col-md-3"><small><b>@lang("teacher.done_homework.first_name"):</b></small></div>
                <div class="col-md-3"> <p id='first_name'></p></div>
                <div class="col-md-3"><small><b>@lang("teacher.done_homework.second_name"):</b></small></div>
                <div class="col-md-3"> <p id='second_name'></p></div>
              </div>

              <div class="row" style="margin:10px">
                <div class="col-md-3"><small><b>@lang("teacher.done_homework.identity_card"):</b></small></div>
                <div class="col-md-3"> <p id='identity_card'></p></div>
                <div class="col-md-3"><small><b>@lang("common.culmination_date"):</b></small></div>
                <div class="col-md-3"> <p id='creation_date'></p></div>
              </div>

              <hr>
              <div class="form-group" style="margin:10px;">
                <label class="control-label col-sm-3" for="score">@Lang('teacher.done_homework.score'):</label>
                <div class="col-sm-9">
                  <select id="score" name="score" class="form-control">
                    <option value="">@lang('teacher.done_homework.select_score')</option>
                    @foreach($scores as $score)
                      <option value="{{$score}}">{{$score}}</option>
                    @endforeach()
                  </select>
                </div>
              </div>     

              <div class="form-group" style="margin:10px;">
                <label class="control-label col-sm-3" for="observations">@Lang('teacher.done_homework.observations'):</label>
                <div class="col-sm-9">
                  {{Form::textarea('observations', null, array('id' => 'observations', 'class' => 'form-control', 'rows' => 5, 'placeholder' => Lang::get('teacher.done_homework.observations'), 'style' => 'resize: none'))}}
                </div>
              </div>   

            <br>
            <div class="alert alert-danger" style="display:none" id="modal_send_error"></div> 

            </div>

            <div class="modal-footer">
            <a type="submit"  class="btn btn-default" data-dismiss="modal">@lang("common.close")</a>
              <input id="evaluate_homework_confirm" type='submit' class='btn btn-primary' value = "{{Lang::get('common.send')}}"> 
            </div>
          {{Form::close()}}
        </div>
      </div>
    </div>

      <!-- Modal window info done homework -->
    <div class="modal fade" id="modal_info_homework" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang("teacher.done_homework.info") </h4>
          </div>
          {{Form::open(array('id' => 'update_form', 'class' => 'form-horizontal'))}}  
            <div class="modal-body">

              <div class="row" style="margin:10px">
                <div class="col-md-2"><small><b>@lang("teacher.done_homework.first_name"):</b></small></div>
                <div class="col-md-4"> <p id='info_first_name'></p></div>
                <div class="col-md-2"><small><b>@lang("teacher.done_homework.second_name"):</b></small></div>
                <div class="col-md-4"> <p id='info_second_name'></p></div>
              </div>

              <div class="row" style="margin:10px">
                <div class="col-md-2"><small><b>@lang("teacher.done_homework.identity_card"):</b></small></div>
                <div class="col-md-4"> <p id='info_identity_card'></p></div>
                <div class="col-md-2"><small><b>@lang("teacher.done_homework.score"):</b></small></div>
                <div class="col-md-4"> <p id='info_score'></p></div>
              </div>

              <div class="row" style="margin:10px">
                <div class="col-md-2"><small><b>@lang("teacher.done_homework.assignment_date"):</b></small></div>
                <div class="col-md-4"> <p>{{$proposed_homework->spanish_creation_date}}</p></div>                                
                <div class="col-md-2"><small><b>@lang("common.culmination_date"):</b></small></div>
                <div class="col-md-4"> <p id='info_creation_date'></p></div>                  
              </div>

              <div class="row" style="margin:10px">                              
                <div class="col-md-2"><small><b>@lang("common.evaluated_date"):</b></small></div>
                <div class="col-md-4"> <p id='info_evaluated_date'></p></div>    
                <div class="col-md-6" >@lang('teacher.done_homework.update') {{Form::checkbox('update', 'Modificar', false, array('id' => 'update'))}}</div>              
              </div>              

              
              <br><hr>
                <div class="form-group" style="margin:10px;">
                  <label id = "update_score_label" class="control-label col-sm-3" for="update_score">@Lang('teacher.done_homework.score'):</label>
                  <div class="col-sm-9">
                    <select id="update_score" name="update_score" class="form-control">
                      <option value="">@lang('teacher.done_homework.select_score')</option>
                      @foreach($scores as $score)
                        <option value="{{$score}}">{{$score}}</option>
                      @endforeach()
                    </select>
                  </div>
                </div>     

                <div class="form-group" style="margin:10px;">
                  <label id="update_observations_label" class="control-label col-sm-3" for="update_observations">@Lang('teacher.done_homework.observations'):</label>
                  <div class="col-sm-9">
                    {{Form::textarea('update_observations', null, array('id' => 'update_observations', 'class' => 'form-control', 'rows' => 5, 'placeholder' => Lang::get('teacher.done_homework.observations'), 'style' => 'resize: none'))}}
                  </div>
                </div>   
           
 
            <br>
            <div class="alert alert-danger" style="display:none" id="modal_info_error"></div> 

            </div>

            <div class="modal-footer">
            <a type="submit"  class="btn btn-default" data-dismiss="modal">@lang("common.close")</a>
            <input id="modify_homework_confirm" type='submit' class='btn btn-primary' value = "{{Lang::get('common.send')}}"> 
            </div>
          {{Form::close()}}
        </div>
      </div>
    </div>

    @else

      <div class="alert alert-danger">
        <h4>@lang('teacher.done_homework.empty')</h4>
      </div>

    @endif

    <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
    @if(Session::has('message'))
      <div class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
    @endif
  </div>

@stop