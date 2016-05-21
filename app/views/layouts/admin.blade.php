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
            <a class="navbar-brand" href="#">@Lang('common.institution')</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="index"><a href="{{url('admin/index')}}">@Lang('admin.home')</a></li>
              <li class="dropdown" id="users">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('admin.users')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('admin/user/create')}}">@Lang('common.create')</a></li>
                  <li><a href="{{url('admin/user/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="subjects">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('admin.subjects')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('admin/subject/create')}}">@Lang('common.create')</a></li>
                  <li><a href="{{url('admin/subject/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('common.system')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">@Lang('common.logout')</a></li>
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