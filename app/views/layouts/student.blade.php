<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Educación a distancia</title>

    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/bootstrap-theme.min.css')}}

    {{HTML::script('js/jquery-1.12.3.js')}}
    {{HTML::script('js/bootstrap.min.js')}}

    @yield('libraries')

</head>
 <body>
  
    <div class="container">
      @section('menu')
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{Auth::user()->first_name}} {{Auth::user()->second_name}} (@lang('student.student') {{Auth::user()->id_grade}}°)</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="index"><a href="{{url('student/index')}}">@Lang('student.home')</a></li>
              <li class="dropdown" id="contents">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('student.contents')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('student/content/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="homeworks">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('student.homeworks')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('student/proposed_homework/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="scores">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('student.scores')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('student/score/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>              
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" id="account">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('account.name')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/student/account/password')}}">@Lang('account.change_password')</a></li>
                  <li><a href="{{url('/student/account/logout')}}">@Lang('account.logout')</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    @section('show')

    @yield('content')

    </div>

  </body>
</html>