@section('title-page')
    <h1>
        {{ isset($title) ? $title : '' }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa {{ isset($fa) ? $fa : ''}}"></i> {{ isset($page) ? $page : '' }} </a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection