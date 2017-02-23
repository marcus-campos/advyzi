<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! env('BUSINESS_NAME', 'Adevyzi') !!}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="http://devyzi.com">{!! env('BUSINESS_NAME', 'Adevyzi') !!}</a>
    </div>
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Ops!</strong> Encontramos alguns erros.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Faça login para começar a sua sessão</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
            {!! csrf_field() !!}

            <div class="form-group ">
                <div class="col-xs-12">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" class="form-control" name="password" placeholder="Senha">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <div class="checkbox text-center">
                        <input type="checkbox" name="remember"> Continuar conectado
                    </div>

                </div>
            </div>

            <div class="form-group text-center m-t-40">
                <div class="col-xs-12">
                    <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                </div>
            </div>

            <!--<div class="form-group m-t-30 m-b-0">
                <div class="col-sm-12">
                    <a href="{{ url('/password/reset')}}" class="text-dark"><i class="fa fa-lock m-r-5"></i> Esqueceu sua senha?</a>
                </div>
            </div>-->
        </form>

        <!--<a href="#">Eu esqueci minha senha</a><br>-->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Angular-->
<script src="../../plugins/km/angular.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>