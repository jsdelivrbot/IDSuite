@extends('layouts.app')

@section('content')
    <div class="container p-lg-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{$name}}</h4>
                        <p class="card-text">This is customer {{$name}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-lg-5">
            <div class="col-lg-12 col-md-12 offset-md-2 offset-lg-0">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title"></h4>
                        <p class="card-text">This is customer {{$name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection