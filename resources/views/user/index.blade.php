@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Collaborators</div>

                <div class="panel-body">
                  <div class="responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Name
                          </th>
                          <th>
                            Role
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{ $user->name }}</td>
                          <td>role</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="pull-right">
                    <a href="{{ url('invite/create') }}" class="btn btn-primary">Add Member</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
