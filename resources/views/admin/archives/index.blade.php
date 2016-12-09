@extends('template')
@extends('vendor.admin.css-js.js')
@extends('vendor.admin.css-js.css')
@extends('vendor.admin.menu.left-menu')
@extends('vendor.admin.top-bar.top-bar')
@extends('vendor.admin.page.title-page')

@section('content')
    <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-archive">Novo arquivo</a></p>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <div>
                    <table id="dt-grid" class="table table-striped toggle-circle m-b-0" data-page-size="10">
                        <thead>
                        <tr>
                            <th>Arquivo</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($archives as  $archive)
                                <tr>
                                    <td onClick="window.location.href='{{ asset('assets/admin/storage/'.$archive['directory'].'/'.$archive['path']) }}';">{{ $archive['name'] }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                                <li><a href="{{ route('admin.archive.destroy', ['id' => $archive['id'], 'contractId' => $contractId]) }}" class="text-center"><span class="text text-danger">Apagar</span></a></li>
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
    <div id="modal-archive" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Carregar ficheiros</h4>
                </div>
                <div class="modal-body">
                    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

                    <!-- The main CSS file -->
                    <link href="{{URL::asset('/')}}assets/admin/uploader/css/style.css" rel="stylesheet" />
                <!--<form id="upload" method="post" action="app\controllers\admin\GalleryController@store" enctype="multipart/form-data">-->
                    {!! Form::open(['id' => 'upload', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true, 'route' => ['admin.archive.store', 'id' => $contractId]]) !!}
                    <div id="drop">
                        Arreste para aqui<br>

                        <a>Procurar...</a>
                        <input type="file" name="upl" multiple />
                    </div>

                    <ul>
                        <!-- The file uploads will be shown here -->
                    </ul>

                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>-->
                    <a class="btn btn-success pull-left"  href="{{ route('admin.archive.index', ['id' => $contractId]) }}">Fechar</a>
                    <!--<button type="button" class="btn btn-primary">Finalizar</button>-->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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

            <script src="{{ asset('assets/admin/uploader/js/jquery.knob.js') }}"></script>

            <!-- jQuery File Upload Dependencies -->
            <script src="{{ asset('assets/admin/uploader/js/jquery.ui.widget.js') }}"></script>
            <script src="{{ asset('assets/admin/uploader/js/jquery.iframe-transport.js') }}"></script>
            <script src="{{ asset('assets/admin/uploader/js/jquery.fileupload.js') }}"></script>

            <!-- Our main JS file -->
            <script src="{{ asset('assets/admin/uploader/js/script.js') }}"></script>

            <script>
                function modal(){
                    $('.modal').modal({
                        show: true
                    });
                }
            </script>


    @if(isset($archiveEdit))
        <script>
            $('#modal-archive').modal('show');
        </script>
    @endif

@endsection