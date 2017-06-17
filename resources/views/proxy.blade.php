@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Proxy</div>
                </div>

                <table class="table table-bordered" id="proxy-table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>ip</th>
                        <th>port</th>
                        <th>target</th>
                        <th>key</th>
                        <th>token</th>
                    </tr>
                    </thead>
                    <tbody id="proxy-table-body">
                    @if(isset($proxy))
                        @foreach($proxy as $p)

                            <tr><td><a href="/proxy/{{$p->id}}">{{$p->id}}</a></td><td>{{$p->name}}</td><td>{{$p->ip}}</td><td>{{$p->port}}</td><td>{{$p->target}}</td><td>{{$p->key}}</td><td>{{$p->token}}</td></tr>

                        @endforeach
                    @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection