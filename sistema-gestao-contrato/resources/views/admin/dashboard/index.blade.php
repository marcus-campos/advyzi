@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-center">Contratos com menos de 30 dias</span>
                        <br>
                        <span class="info-box-number text-center"></span>
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
                        <div class="table-responsive">
                            <table id="dt-grid" class="table table-striped toggle-circle m-b-0" data-page-size="10">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Operadora</th>
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
                                @foreach($contracts as $contract)
                                    <tr>
                                        <td onClick="window.location.href='{{ route('admin.contract.edit', ['id' => $contract->id]) }}';">{{ $contract->name }}</td>
                                        <td onClick="window.location.href='{{ route('admin.contract.edit', ['id' => $contract->id]) }}';">{{ $contract->operator->name }}</td>
                                        <td onClick="window.location.href='{{ route('admin.contract.edit', ['id' => $contract->id]) }}';">{{ getDaysBetweenDates(formatDate($contract->end_date, 'mdy')) }} dias</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                                <ul class="dropdown-menu drop-menu-right" role="menu">
                                                    <li><a href="{{ route('admin.contract.edit', ['id' => $contract->id]) }}" class="text-center">Detalhes</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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