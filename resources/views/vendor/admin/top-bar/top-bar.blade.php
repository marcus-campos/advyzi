@section('top-bar')
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Olá, {{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Body -->
                        <li class="user-body">
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a data-toggle="modal" data-target="#modal-changepassword" class="btn btn-flat">Alterar senha</a>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a href="{{ route('auth.logout') }}" class="btn btn-flat">Sair</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
@endsection