@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($endpoints as $endpoint)
                <div class="col-lg-4" style="margin-top: 15px;">
                    <div class="card" style="width: 20rem;">
                        <div class="card-block">
                            <h4 class="card-title">{{$endpoint->name}}</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="account/{{$endpoint->id}}" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

@endsection