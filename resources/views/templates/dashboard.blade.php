<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ Config::get('project.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/resources.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
<div id="page">
    <div id="header">
        <nav class="navbar navbar-default">
            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ Config::get('project.name') }}</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    @if(!Auth::guest())
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/') }}">Dashboard</a></li>
                            <li><a href="{{ url('clients') }}">Clients</a></li>
                            <li><a href="{{ url('tickets') }}">Tickets</a></li>
                            @if(Auth::user()->hasRole('admin'))
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span
                                                class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('users') }}">Users</a></li>
                                        <li><a href="{{ url('settings') }}">Settings</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('account') }}">My Account</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('auth/login')  }}"><span class="glyphicon glyphicon-lock"></span> Login</a>
                            </li>
                        </ul>
                    @endif

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>

    <div id="main" class="container">
        <div class="messages">
            @if (Session::has('status'))
                <div class="alert alert-info">{{ Session::get('status') }}</div>
            @endif
            @include('flash::message')
        </div>

        @yield('content')
    </div>

    <div id="footer"></div>
</div>
<script src="{{ asset('assets/js/resources.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>