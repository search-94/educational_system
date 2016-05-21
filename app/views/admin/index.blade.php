@extends('layouts.admin')
@section('libraries')
  @parent
  {{HTML::style('css/admin/index.css')}}
  {{HTML::script('js/admin/index.js')}}
@stop
@section('content')
<div class="jumbotron">
        <h1>Navbar example</h1>
        {{Form::open(array('files'=> true))}}
          {{Form::file('file')}}
          {{Form::submit('save')}}
        {{Form::close()}}

        <a href="/admin/user/download" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> Download Brochure </a>
        <p>This example is a quick exercise to illustrate how the default, static navbar and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
        </p>
      </div>
@stop