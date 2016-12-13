@extends('layouts.student')
@section('libraries')
  @parent
  {{HTML::style('css/student/score/show.css')}}
  {{HTML::script('js/student/score/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('student.score.manage')</h1>
   <div class="panel panel-default">
  
      <div class="panel-heading">
        <h4>@lang('student.score.information')</h4>
      </div>

      <div class="panel-body">
        <div class="table-responsive">
        	<table class="table table-bordered table-hover">
        		<tr>
        			<td>
        				<b>@lang('student.score.first_name'):</b>
         			</td>
        			<td>
        				{{$user->first_name}}
         			</td>       			
        		</tr>
        		<tr>
        			<td>
        				<b>@lang('student.score.second_name'):</b>
        			</td>
        			<td>
        				{{$user->second_name}}
         			</td>      			
        		</tr>      		
        		<tr>
        			<td>
        				<b>@lang('student.score.identity_card'):</b>
        			</td>
        			<td>
        				{{$user->identity_card}}
         			</td>      			
        		</tr>
        		<tr>
        			<td>
        				<b>@lang('student.score.scholar_year'):</b>
        			</td>
        			<td>
        				{{$period->year}} / {{$period->year +1}}
         			</td>      			
        		</tr>
            <tr>
              <td>
                <b>@lang('student.score.scholar_lapse'):</b>
              </td>
              <td>
                {{$period->lapse}}
              </td>           
            </tr>            
         		<tr>
        			<td>
        				<b>@lang('student.score.grade'):</b>
        			</td>
        			<td>
        				{{$grade->description}}
         			</td>      			
        		</tr>
        	</table>
        </div>
      </div>
      <hr>

	   <center> <a href="/student/score/download" class="btn btn-default">@lang('common.generate')</a> </center>
     <br>
    <div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
    @if(Session::has('message'))
      <div class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
    @endif
  </div>

@stop