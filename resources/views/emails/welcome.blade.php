<h1>Welcome to AloSaaS</h1>
<p>
  You have been invited by {{ $invitation->user->email }}
</p>
<p>
  Click <a href="{{ url('invite/accept?code='.$invitation->invitation_code) }}">here</a> to join {{ $invitation->user->email }}
</p>
