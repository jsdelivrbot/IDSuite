@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customer</div>

                </div>

                <table class="table table-bordered" id="customer-table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>

                    </tr>
                    </thead>
                    <tbody id="customer-table-body">
                        @if(isset($customer))
                        <tr>
                            <td><a href="endpoints/{{$customer->id}}">{{$customer->id}}</a></td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection