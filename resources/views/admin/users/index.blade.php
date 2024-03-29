@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-user">Novo utilizador</a></p>
    @include('vendor.errors.messages')
    @include('vendor.partials.flash')
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <div>
                    <table id="data" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ roles()[$user->role] }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                        <ul class="dropdown-menu drop-menu-right" role="menu">
                                            <li class="divider"></li>
                                            <li><a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="text-center">Editar</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('admin.user.transfer', ['id' => $user->id]) }}" class="text-center"><span class="text text-danger">Apagar</span></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
@endsection

@section('modal')
    <div id="modal-user" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                    @if(isset($userEdit))
                        {!! Form::model($userEdit,['route' => ['admin.user.update', $userEdit->id], 'method'=>'put']) !!}
                        <h4 class="modal-title">Editar usuário</h4>
                    @else
                        {!! Form::open(['route'=>'admin.user.store', 'method'=>'post']) !!}
                        <h4 class="modal-title">Novo usuário</h4>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="block-product-detail">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Nome:</label>
                                        {!! Form::text('name', null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Email:</label>
                                        {!! Form::email('email', null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Senha:</label>
                                        {!! Form::password('password',['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Tipo de usuário:</label>
                                        {!! Form::select('role', roles(), null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(isset($userEdit))
                        <a href="{{ route('admin.user.index') }}" type="button" class="btn btn-default waves-effect">Fechar</a>
                    @else
                        <a type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</a>
                    @endif
                    <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.box -->
    @if(isset($userToDelete))
    <div id="modal-transfercontracts" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route'=> ['admin.user.destroy', 'id' => $userToDelete], 'method'=>'POST']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Transferir contratos</h4>
                </div>
                <div class="modal-body">
                    <div class="block-product-detail">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Transferir clientes para: </label>
                                        {!! Form::select('userToTransfer', $users->pluck('name','id'), null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.user.index') }}" type="button" class="btn btn-default waves-effect">Fechar</a>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Transferir e Apagar</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.box -->
    @endif
@endsection

@section('extra-css')

@endsection

@section('extra-js')

    @if(isset($userEdit))
        <script>
            $('#modal-user').modal('show');
        </script>
    @endif

    @if(isset($userToDelete))
        <script>
            $('#modal-transfercontracts').modal('show');
        </script>
    @endif

@endsection