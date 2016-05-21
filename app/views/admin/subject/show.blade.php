@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/subject/show.css')}}
  <script>
    var active = "{{Lang::get('common.active')}}";
    var inactive = "{{Lang::get('common.inactive')}}";
  </script>
  {{HTML::script('js/admin/subject/show.js')}}
@stop

@section('content')
 <h1 class="text-center">@lang('admin.subject.manage')</h1>
<div class="alert alert-danger" style="display:none;" id="error_msg"></div> 
   <div class="panel panel-success">
   	<div class="panel-heading">
      <h4>@lang('admin.subject.information')</h4>
    </div>

    <div class="panel-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>@lang('admin.subject.grade')</th>
            <th>@lang('admin.subject.subject')</th>
            <th>@lang('admin.subject.options')</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($subjects as $subject)
          <tr>
            <th scope="row">{{$subject->subject_id_grade}}</th>
            <td>
              {{$subject->subject_name}}
            </td>
            <td>
              @if($subject->user_id == null)
                <button class='btn btn-primary pull-left assign' id='{{$subject->subject_id}}' data-toggle="modal" data-target="#modal_window" style="margin:5px">
                  <i class="fa fa-info-circle"></i>
                  @lang('admin.subject.assign_teacher')
                </button> 
              @else
                <button class='btn btn-primary pull-left unassign' id='{{$subject->subject_id}}' data-toggle="modal" data-target="#modal_window" style="margin:5px">
                  <i class="fa fa-info-circle"></i>
                  @lang('admin.subject.unassign_teacher')
                </button> 
              @endif

            <button class='btn btn-primary pull-left delete' onclick="deleteSubjectConfirmation({{$subject->subject_id}})" id='{{$subject->subject_id}}' data-toggle="modal" data-target="#modal_window" style="margin:5px">
               <i class="fa  fa-info-circle"></i>
               @lang('admin.subject.delete')
            </button> 

            <button class='btn btn-primary pull-left info' id='{{$subject->subject_id}}' data-toggle="modal" data-target="#modal_window" style="margin:5px">
               <i class="fa  fa-info-circle"></i>
               @lang('admin.subject.info')
            </button> 

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
	  @if(Session::has('message'))
	    <div class="alert alert-{{Session::get('class')}}">{{ Session::get('message')}}</div>
	  @endif
  </div>

<div id="modal_info" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Información</h4>
      </div>
      <div class="modal-body">

        <div class="page-header">
           <h4>Datos de la materia</h4>
        </div>
                
        <div class="row">
          <div class="col-md-2">Nombre</div>
          <div class="col-md-4"> <p id='subject_name'></p></div>
          <div class="col-md-2">Grado</div>
          <div class="col-md-4"> <p id='id_grade'></p></div>
        </div>

        <div id="teacher_info">
          <div class="page-header">
             <h4>Datos del profesor</h4>
          </div>
          <div class="row">
            <div class="col-md-2">Cédula</div>
            <div class="col-md-4"> <p id='identity_card'></p></div>
            <div class="col-md-2">Nombre</div>
            <div class="col-md-4"> <p id='first_name'></p></div>
          </div>
         <div class="row">
            <div class="col-md-2">Apellido</div>
            <div class="col-md-4"> <p id='second_name'></p></div>
            <div class="col-md-2">Email</div>
            <div class="col-md-4"> <p id='email'></p></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

    <!-- Modal window to confirm delete -->
    <div class="modal fade" id="deleteSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">eliminar </h4>
          </div>
          <div class="modal-body">
           desea eliminar?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a  id = "modal_subject_delete_confirm" class="btn btn-primary">             
               aceptar
            </a>
          </div>
        </div>
      </div>
    </div>
@stop