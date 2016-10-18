@section('left-menu')
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">PAINEL DE INSTRUMENTOS</li>
                <li class="treeview">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="header">CADASTROS</li>
                <li class="treeview">
                    <a href="{{ route('admin.operator.index') }}">
                        <i class="fa fa-building-o"></i> <span>Operadoras</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fa fa-users"></i> <span>Usuários</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
@endsection