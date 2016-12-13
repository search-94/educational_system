@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/period/update.css')}}
  <script>
    var error_year = "{{Lang::get('admin.period.error.year')}}";
    var error_lapse = "{{Lang::get('admin.period.error.lapse')}}";
  </script>
  {{HTML::script('js/admin/period/update.js')}}
@stop

@section('content')
   <h1 class="text-center">@lang('admin.period.manage')</h1> 
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>@lang('admin.period.create')</h4>
            </div>

            <div class="panel-body">
              <div class="panel-responsive">
                <table class='table table-hover table-bordered'>
                  <tr>
                    <td>
                      @lang('admin.period.actual_year')
                    </td>
                    <td>
                      {{$previous_year}} / {{$previous_year+1}}
                    </td>
                  </tr>
                    <td>
                      @lang('admin.period.actual_lapse')
                    </td>
                    <td>
                      {{$previous_lapse}}
                    </td>
                  <tr>
                  </tr>
                </table>
              </div>

              {{Form::open(array('action' => 'AdminPeriodController@update', 'class' => 'form-horizontal'))}}

                <div class="form-group">
                  <label class="control-label col-sm-5" for="year">@Lang('admin.period.new_year'):</label>
                  <div class="col-sm-7">          
                      <select class="form-control" id="year" name="year">
                        @foreach($years as $year)
                          @if ($year == $previous_year + 1 and $previous_lapse == 3) {
                            <option value="{{$year}}" selected>{{$year}} / {{$year+1}}</option>
                          @elseif($year == $previous_year and $previous_lapse != 3)
                           <option value="{{$year}}" selected>{{$year}} / {{$year+1}}</option>
                          @else
                            <option value="{{$year}}">{{$year}} / {{$year+1}}</option>
                          @endif
                        @endforeach
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5" for="first_name">@lang('admin.period.new_lapse'):</label>
                  <div class="col-sm-7">          
                    <select class="form-control" id="lapse" name="lapse">
                      @foreach($lapses as $lapse)
                        @if($lapse==1 and $previous_lapse == 3)
                            <option value="{{$lapse}}" selected>{{$lapse}}</option>
                        @elseif($lapse == $previous_lapse + 1) {
                          <option value="{{$lapse}}" selected>{{$lapse}}</option>
                        @else
                          <option value="{{$lapse}}">{{$lapse}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>         
                <hr>
                <p> 
                  <center>
                    {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-default', 'id' => 'update_period_submit'))}}
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