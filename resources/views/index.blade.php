@extends('main')

@section('content')
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column text-center">
    <header class="my-5">
        <img src="https://fabelio.com/static/version1584023378/frontend/Fabelio/aurela/id_ID/images/fabelio-logo-2.svg" class="mainlogo">
    </header>
    <main role="main" class="inner cover mt-5">
        <h1 class="cover-heading">Hello, Dude!</h1>
        <p class="lead">These are all your submitted product page links</p>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col">
                    <table class="table table-sm table-bordered table-striped bg-white">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no=1; @endphp
                        @foreach($links as $link)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $link->name}}</td>
                                <td>{{ $link->description}}</td>
                                <td>Rp. {{ number_format($link->price,0,',','.')}}</td>
                                <td><a href="{{ url('/link/'.$link->id) }}" target="_blank">View</a></td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection