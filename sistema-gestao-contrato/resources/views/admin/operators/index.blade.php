@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-operator">Nova operadora</a></p>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="data" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($operators as $operator)
                            <tr>
                                <td>{{ $operator->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                        <ul class="dropdown-menu drop-menu-right" role="menu">
                                            <li><a href="{{ route('admin.operator.edit', ['id' => $operator->id]) }}" class="text-center">Editar</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('admin.operator.delete', ['id' => $operator->id]) }}" class="text-center"><span class="text text-danger">Deletar</span></a></li>
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
    <div id="modal-operator" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                    @if(isset($operatorEdit))
                        {!! Form::model($operatorEdit,['route' => ['admin.operator.update', $operatorEdit->id], 'method'=>'put']) !!}
                        <h4 class="modal-title">Editar operadora</h4>
                    @else
                        {!! Form::open(['route'=>'admin.operator.store', 'method'=>'post']) !!}
                        <h4 class="modal-title">Nova operadora</h4>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="block-product-detail">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="pull-left">Nome:</label>
                                        {!! Form::text('name', null,['class' => 'form-control', 'placeholder' => 'Ex: MEO']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(isset($operatorEdit))
                        <a href="{{ route('admin.operator.index') }}" type="button" class="btn btn-default waves-effect">Fechar</a>
                    @else
                        <a type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</a>
                    @endif
                    <button type="submit" class="btn btn-info waves-effect waves-light">Salvar</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.box -->
@endsection

@section('extra-css')

@endsection

@section('extra-js')

    @if(isset($operatorEdit))
        <script>
            $('#modal-operator').modal('show');
        </script>
    @endif

@endsection