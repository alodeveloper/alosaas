@extends('layouts.app')

@section('content')
  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
          <div class="panel-heading">Send Invite</div>
          <div class="panel-body">
            <form class="form" action="{{ url('invite') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email">
                <p class="help-block">Invitation will be sent to above email address.</p>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </form>
          </div>
      </div>
  </div>
@endsection
