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
                (@lang('admin.menu.f_admin')) 
              @else 
                (@lang('admin.menu.m_admin')) 
              @endif
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="index"><a href="{{url('admin/index')}}">@Lang('admin.home')</a></li>
              <li class="dropdown" id="users">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('admin.menu.users')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('admin/user/create')}}">@Lang('common.create')</a></li>
                  <li><a href="{{url('admin/user/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="subjects">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('admin.menu.subjects')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('admin/subject/create')}}">@Lang('common.create')</a></li>
                  <li><a href="{{url('admin/subject/show')}}">@Lang('common.show')</a></li>
                </ul>
              </li>
              <li class="dropdown" id="period">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('admin.menu.period')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('admin/period/update')}}">@Lang('common.create')</a></li>
                </ul>
              </li>              
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" id="account">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@Lang('account.name')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/admin/account/password')}}">@Lang('account.change_password')</a></li>
                  <li><a href="{{url('/admin/account/logout')}}">@Lang('account.logout')</a></li>
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