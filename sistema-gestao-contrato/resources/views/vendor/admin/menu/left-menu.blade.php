@section('left-menu')
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">PAINEL DE INSTRUMENTOS</li>
                <li class="treeview">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="fa fa-dashboard"></i> <span>Resumo</span>
                    </a>
                </li>
                <li class="header">Menu</li>
                <li class="treeview">
                    <a href="{{ route('admin.contract.index') }}">
                        <i class="fa fa-users"></i> <span>Clientes</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.operator.index') }}">
                        <i class="fa fa-building-o"></i> <span>Operadoras</span>
                    </a>
                </li>
                @if(Auth::user()->role == 'boss' || Auth::user()->role == 'admin')
                <li class="treeview">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fa fa-user"></i> <span>Utilizadores</span>
                    </a>
                </li>
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
@endsection