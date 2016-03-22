@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('account/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('subdomain') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Subdomain</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">http://www.alotracker.com/accounts/</span>
                                  <input type="text" class="form-control" name="subdomain" value="{{ old('subdomain') }}">
                                </div>

                                @if ($errors->has('subdomain'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subdomain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
