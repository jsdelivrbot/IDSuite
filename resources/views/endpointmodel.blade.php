@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Model</div>
                </div>

                <table class="table table-bordered" id="model-table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>manufacturer</th>
                        <th>architecture</th>
                        <th>key</th>
                    </tr>
                    </thead>
                    <tbody id="model-table-body">
                    @if(isset($model))
                        @foreach($model as $m)

                            <tr><td><a href="/model/{{$m->id}}">{{$m->id}}</a></td><td>{{$m->name}}</td><td>{{$m->manufacturer}}</td><td>{{$m->architecture}}</td><td>{{$m->key}}</td></tr>

                        @endforeach
                    @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection