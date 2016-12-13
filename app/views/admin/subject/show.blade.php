@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/subject/show.css')}}
  <script>
    var name = "{{Lang::get('admin.subject.name')}}";
    var options = "{{Lang::get('admin.subject.options')}}";
    var del = "{{Lang::get('admin.subject.del')}}";
    var empty_subject = "{{Lang::get('admin.subject.empty_subject')}}";
    var inf = "{{Lang::get('admin.subject.infor')}}";
    var assign_teacher = "{{Lang::get('admin.subject.assign_teacher')}}";
    var unassign_teacher = "{{Lang::get('admin.subject.unassign_teacher')}}";
    var error_assign = "{{Lang::get('admin.subject.error.user')}}";
  </script>
  {{HTML::script('js/admin/subject/show.js')}}
@stop

@section('content')
  <h1 class="text-center">@lang('admin.subject.manage')</h1>
  <div class="panel panel-default">

    <div class="panel-heading">
      <h4>@lang('admin.subject.information')</h4>
    </div>

    <div class="panel-body">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="control-label col-md-2" for="grade">@Lang('admin.subject.grade'):</label>
          <div class="col-md-8">
            <select class="form-control" id="grade" name="grade">
              <option value="">@Lang('admin.subject.select_grade')</option>
              @foreach($grades as $grade)
                <option value="{{$grade->id}}">{{$grade->description}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            {{Form::button('Buscar', array('class'=>'btn btn-default', 'id' => 'search_subjects')) }}   
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



<div id="subject_info" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('common.info')</h4>
      </div>
      <div class="modal-body">
        <div class="page-header">
           <h4>@lang('admin.subject.subject_info')</h4>
        </div>

                
        <div class="row" style="margin:10px">
          <div class="col-md-2"><small><b>@lang('admin.subject.name'):</b></small></div>
          <div class="col-md-4"> <p id='subject_name'></p></div>
          <div class="col-md-2"><small><b>@lang('admin.subject.grade'):</b></small></div>
          <div class="col-md-4"> <p id='id_grade'></p></div>
        </div>

        <div id="teacher_info">
          <div class="page-header">
           <h4>@lang('admin.subject.teacher_info')</h4>
          </div>
          <div class="row" style="margin:10px">
            <div class="col-md-2"><small><b>@lang('admin.user.identity_card'):</b></small></div>
            <div class="col-md-4"> <p id='identity_card'></p></div>
            <div class="col-md-2"><small><b>@lang('admin.user.first_name'):</b></small></div>
            <div class="col-md-4"> <p id='first_name'></p></div>
          </div>
         <div class="row" style="margin:10px">
            <div class="col-md-2"><small><b>@lang('admin.user.second_name'):</b></small></div>
            <div class="col-md-4"> <p id='second_name'></p></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

    <!-- Modal window to confirm delete -->
    <div class="modal fade" id="subject_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang('admin.subject.delete.title') </h4>
          </div>
          <div class="modal-body">
           @lang('admin.subject.delete.content')
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
            <a  id = "delete_confirm" class="btn btn-primary">             
               @lang('common.accept')
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal window to assign teacher -->
    <div class="modal fade" id="subject_assign_teacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang('admin.subject.assign_teacher') </h4>
          </div>
          <div class="modal-body">
            {{Form::open(array('action' => 'AdminSubjectController@assignTeacher', 'class' => 'form-horizontal'))}}
              <input id='id_subject' name='id_subject' style="display:none">

              <div class="form-group"  style="margin:10px">
                <label class="control-label col-sm-2" for="name">@lang('admin.subject.teacher'):</label>
                <div class="col-sm-10">
                  <select class="form-control" id="id_user" name="id_user">
                    <option value="">@lang('admin.subject.select_assign_teacher')</option>
                    @foreach($teachers as $teacher)
                      <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->second_name}} ({{$teacher->identity_card}})</option>
                    @endforeach
                  </select>
                </div>
              </div>   

              <p>
                <div class="alert alert-danger" style="display:none;" id="assign_error_msg"></div>
              </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
            {{Form::submit(Lang::get('common.send'), array('class' => 'btn btn-primary', 'id' => 'assign_teacher_submit'))}}
            {{Form::close()}}

          </div>
        </div>

      </div>
    </div>

        <!-- Modal window to unassign teacher -->
    <div class="modal fade" id="subject_unassign_teacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang('admin.subject.unassign.title') </h4>
          </div>
          <div class="modal-body">
           @lang('admin.subject.unassign.content')
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
            <a  id = "unassign_teacher_confirm" class="btn btn-primary">             
               @lang('common.accept')
            </a>
          </div>
        </div>
      </div>
    </div>



@stop