@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <h3>You have these accounts</h3>
                    <ul class="nav nav-tabs">
                      @foreach($accounts as $account)
                      <li><a href="#">{{ $account->subdomain }}</a></li>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
