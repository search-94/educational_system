<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Educación a distancia</title>

    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/bootstrap-theme.min.css')}}
    {{HTML::style('js/jquery-ui-1.11.4/jquery-ui.css')}}

    {{HTML::script('js/jquery-1.12.3.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/jquery-ui-1.11.4/jquery-ui.js')}}

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
            <a class="navbar-brand" href="#">{{Auth::user()->first_name}} {{Auth::user()->second_name}} 
              @if(Auth::user()->id_gender == '1') 
                (@lang('teacher.f_teacher')) 
              @else 
                (@lang('teacher.m_teacher')) 
              @endif
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="index"><a href="{{url('teacher/index')}}">@Lang('teacher.home')</a></li>
              <li class="dropdown" id="contents">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('teacher.contents')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('teacher/content/create')}}">@Lang('common.create')</a></li>
                  <li><a href="{{url('teacher/content/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="homeworks">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('teacher.homeworks')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('teacher/proposed_homework/create')}}">@Lang('common.create')</a></li>
                  <li><a href="{{url('teacher/proposed_homework/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="scores">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('teacher.scores')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('teacher/score/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>              
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" id="account">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('account.name')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/teacher/account/password')}}">@Lang('account.change_password')</a></li>
                  <li><a href="{{url('/teacher/account/logout')}}">@Lang('account.logout')</a></li>
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