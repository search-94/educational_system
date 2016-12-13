<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Customer Service Application</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('css/bootstrap.min.css');}}

    <!-- Custom styles for this template -->
    {{HTML::style('css/signin/signin.css');}}

  </head>

  <body>
   <center> <h2>Plataforma de Gestión de Contenidos y Evaluaciones</h2> </center>
      <center> <h2>Colegio Jesús de Nazaret</h2> </center>
    <div class="container">
      {{Form::open(array('url'=>'login','class'=>'form-signin'))}}
        <h2 class="form-signin-heading">Bienvenido</h2>
        {{Form::text('identity_card', null, array('placeholder'=>'ID', 'class'=>'form-control', 'maxlength'=>30, 'required'=>'true', 'autofocus'=>'true'))}} <br>
        {{Form::password('password', array('placeholder'=>'Contraseña', 'class'=>'form-control', 'required'=>'true'))}}<br>
        {{Form::submit('Ingresar', array('class'=>'btn btn-lg btn-primary btn-block'))}}
        <br>
        @if (Session::get('fail_log')==true)
          <div class="alert alert-danger" role="alert">@lang('common.error_validation')</div>
        @endif
      {{Form::close()}}

    </div> <!-- /container -->

  </body>
</html>
