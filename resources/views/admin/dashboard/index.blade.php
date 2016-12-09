@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('vendor.errors.messages')
        @include('vendor.partials.flash')
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-center">Contratos com menos de 30 dias</span>
                        <br>
                        <span class="info-box-number text-center">{{ contracts() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-file-text-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-center">Contratos adicionados</span>
                        <br>
                        <span class="info-box-number text-center">{{ contractsAdded() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-center">Clientes adicionados</span>
                        <br>
                        <span class="info-box-number text-center">{{ clientsAdded() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="box-body">
                        <h3>Contratos com menos de 30 dias</h3>
                        <div>
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
                                        @if(Auth::user()->role == 'admin')
                                            <tr>
                                                <td onClick="window.location.href='{{ route('admin.customer.contract.edit.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}';">{{ $contract['customer']['name'] }}</td>

                                                <td onClick="window.location.href='{{ route('admin.customer.contract.edit.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}';">
                                                    {{ (getDaysBetweenDates(formatDate($contract['end_date'], 'mdy'))) > 0 ? getDaysBetweenDates(formatDate($contract['end_date'], 'mdy')).' dias.': 'Terminou dia '.formatDate($contract['end_date'], 'mdy').'.'}}
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                                        <ul class="dropdown-menu drop-menu-right" role="menu">
                                                            <li><a href="{{ route('admin.customer.contract.edit.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}" class="text-center">Editar</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="{{ route('admin.customer.contract.delete.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}" class="text-center"><span class="text text-danger">Apagar</span></a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @if($contract['customer']['user_id'] == Auth::user()->id)
                                                <tr>
                                                    <td onClick="window.location.href='{{ route('admin.customer.contract.edit.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}';">{{ $contract['customer']['name'] }}</td>

                                                    <td onClick="window.location.href='{{ route('admin.customer.contract.edit.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}';">
                                                        {{ getDaysBetweenDates(formatDate($contract['end_date'], 'mdy')) > 0 ? getDaysBetweenDates(formatDate($contract['end_date'], 'mdy')).' dias.': 'Terminou dia '.formatDate($contract['end_date'], 'mdy').'.'}}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                                                <li><a href="{{ route('admin.customer.contract.edit.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}" class="text-center">Editar</a></li>
                                                                <li class="divider"></li>
                                                                <li><a href="{{ route('admin.customer.contract.delete.callback', ['id' => $contract['id'], 'callBack' => 'admin.dashboard.index']) }}" class="text-center"><span class="text text-danger">Apagar</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
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
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extra-css')

@endsection

@section('extra-js')

@endsection