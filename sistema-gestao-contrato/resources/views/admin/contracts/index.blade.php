@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-contract">{{ isset($contractEdit) ? 'Editar contrato' : 'Novo contrato' }}</a></p>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="dt-grid" class="table table-striped toggle-circle m-b-0" data-page-size="10">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Final do contrato</th>
                            <th>Ação</th>
                        </tr>
                        </thead>

                        <div class="form-inline m-b-20">
                            <div class="row">
                                <div class="col-sm-12 text-xs-center text-right">
                                    <div class="form-group">
                                        <input id="dt-search" type="text" placeholder="Pesquisar" class="form-control input-sm" autocomplete="on">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tbody>
                        @if(isset($contracts))
                            @foreach($contracts as $contract)
                                <tr>
                                    <td onClick="window.location.href='{{ route('admin.contract.edit', ['id' => $contract['contract']['id']]) }}';">{{ $contract['customer']['name'] }}</td>

                                    <td onClick="window.location.href='{{ route('admin.contract.edit', ['id' => $contract['contract']['id']]) }}';">{{ getDaysBetweenDates(formatDate($contract['contract']['end_date'], 'mdy')) }} dias</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                                <li><a href="{{ route('admin.customer.contract.edit', ['id' => $contract['contract']['id']]) }}" class="text-center">Editar</a></li>
                                                <li class="divider"></li>
                                                <li><a href="{{ route('admin.customer.contract.delete', ['id' => $contract['contract']['id']]) }}" class="text-center"><span class="text text-danger">Apagar</span></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="12">
                                <div class="text-center">
                                    <ul class="pagination pagination-split m-t-30 m-b-0"></ul>
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
@endsection

@section('modal')
    <div id="modal-contract" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="{{ route('admin.contract.index') }}" type="button" class="close" aria-hidden="true">×</a>
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                    @if(isset($contractEdit))
                        {!! Form::model($contractEdit,['route' => ['admin.customer.contract.update', $contractEdit->id], 'method'=>'put']) !!}
                        <h4 class="modal-title">Editar contrato</h4>
                    @else
                        {!! Form::open(['route'=>'admin.customer.contract.store', 'method'=>'post']) !!}
                        <h4 class="modal-title">Novo contrato</h4>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="block-product-detail">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group contracts col-xs-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="pull-left">O que contratou?</label>
                                                {!! Form::text('which_hired', null,['class' => 'form-control']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Operadora:</label>

                                        {{ Form::select('operator_id', $operators, null, ['id'=>'category_id', 'class' => 'form-control']) }}
                                        <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Início contrato:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                {!! Form::text('start_date', null,['id' => 'start_datemask', 'class' => 'form-control']) !!}
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Fim contrato:</label>

                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                {!! Form::text('end_date', null,['id' => 'end_datemask', 'class' => 'form-control']) !!}
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Cliente:</label>

                                        {{ Form::select('customer_contracts_id', $customer, null, ['id'=>'customer_contracts_id', 'class' => 'form-control']) }}
                                        <!-- /.input group -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="pull-left">Observações</label>
                                                {!! Form::textarea('description', null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(isset($contractEdit))
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
@endsection

@section('extra-css')

    <link href="{{ asset('../../plugins/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('../../plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('../../plugins/daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('../../plugins/datepicker/datepicker3.css') }}">

@endsection

@section('extra-js')

    <script src="{{ asset('../../plugins/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ asset('../../plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('../../pages/jquery.footable.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('../../plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('../../plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('../../plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="{{ asset('../../plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('../../plugins/datepicker/bootstrap-datepicker.js') }}"></script>


    //Page script



    //Date picker
    <script>
        $("#start_datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        $("#end_datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    </script>


    @if(isset($contractEdit))
        <script>
            $('#modal-contract').modal('show');
        </script>
    @endif

@endsection