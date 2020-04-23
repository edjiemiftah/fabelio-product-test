@extends('main')

@section('content')
<div class="cover-container d-flex w-100 p-3 mx-auto flex-column text-center">
    <header class="my-5">
        <img src="https://fabelio.com/static/version1584023378/frontend/Fabelio/aurela/id_ID/images/fabelio-logo-2.svg" class="mainlogo">
    </header>
    <main role="main" class="inner cover mt-5">
        <h1 class="cover-heading">Hello, Dude!</h1>
        <p class="lead">Welcome to Fabelio Product Engine. Please paste your product page link below.</p>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col">
                    <form class="form-inline" method="post" action="{{ url('/link') }}" onsubmit="return cariProduk()">
                        @csrf
                        <div class="form-group col-10 ml-5 mb-2">
                            <input class="form-control form-control-lg col-12" type="text" id="q" name="q" placeholder="e.g https://fabelio.com/cp/ruang-kerja/meja-kerja/meja-laptop.html">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg mb-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('javascript')
<script>
    function cariProduk() {
        var q = document.querySelector('#q').value;
        if(!q.includes('http')) {
            alert('Please provide a proper URL');
            return false;
        } else {
            return;
        }
        // $.get(q, function(data) {
        //     console.log('hasil scrap : ' + q);
        // });
        // $.get('https://fabelio.com/catalogsearch/result/', {
        //     q : q
        // }, function(r) {
        //     console.log(r);
        // });
        // alert('Keywordnya adalah : ' + document.querySelector('#q').value);
        // return false;
    }
</script>
@endsection