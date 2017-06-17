@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Endpoint</div>
                </div>

                <table class="table table-bordered" id="endpoint-table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>ip</th>
                        <th>mac</th>
                        <th>proxy</th>
                        <th>model</th>
                    </tr>
                    </thead>
                    <tbody id="endpoint-table-body">
                        @foreach($endpoints as $endpoint)

                            <tr><td><a href="/endpoint/{{$endpoint->id}}">{{$endpoint->id}}</a></td><td>{{$endpoint->name}}</td><td>{{$endpoint->ip}}</td><td>{{$endpoint->mac}}</td><td><a href="/proxy/{{$endpoint->proxy}}">{{$endpoint->proxy}}</a></td><td><a href="/model/{{$endpoint->model}}">{{$endpoint->model}}</a></td></tr>

                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection