@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Accounts</div>

                <div class="panel-body">
                    <h3>You have these accounts</h3>
                    <ul class="nav nav-stacked">
                      @foreach($memberships as $membership)
                      <li><a href="{{ url('accounts/'.$membership->account->subdomain) }}">{{ $membership->account->subdomain }} <span class="pull-right">{{ $membership->role }}</span></a></li
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
