@extends('main')

@section('content')
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column text-center">
    <header class="my-5">
        <img src="https://fabelio.com/static/version1584023378/frontend/Fabelio/aurela/id_ID/images/fabelio-logo-2.svg" class="mainlogo">
    </header>
    <main role="main" class="inner cover mt-5">
        <h1 class="cover-heading">Hello, Dude!</h1>
        <p class="lead">Your submitted link:<br />{{ $data->url }}</p>
        <div class="container text-left">
            <div class="row">
                <div class="col-3 mr-0">
                    <img src="{{ $data->images }}" class="img-fluid" alt="">
                </div>
                <div class="col-9 ml-0 px-0">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            {{ $data->name }}
                        </div>
                        <div class="card-body">
                            {{ str_replace(' "','',str_replace('" ','',$data->description)) }}
                            <br>
                            <h4>Rp. {{ number_format($data->price,0,',','.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection