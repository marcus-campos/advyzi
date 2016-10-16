@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-user">Novo Usuário</a></p>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <div class="table-responsive">
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
                    @if(isset($categoryEdit))
                        {!! Form::model($categoryEdit,['route' => ['admin.user.update', $categoryEdit->id], 'method'=>'put']) !!}
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
                                        {!! Form::text('name', null,['class' => 'form-control', 'placeholder' => 'Ex: Marcus Vinícius Campos']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Email:</label>
                                        {!! Form::email('email', null,['class' => 'form-control', 'placeholder' => 'Ex: marcus.campos@devyzi.com']) !!}
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
                                        <label class="pull-left">Senha:</label>
                                        {!! Form::select('role', roles(), null,['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.box -->
@endsection

@section('extra-css')

@endsection

@section('extra-js')

@endsection