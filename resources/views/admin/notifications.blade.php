@extends('layouts.app')

@section('content')

<a href="{{ route('admin.notification.read.all') }}" class="btn btn-lg btn-success">Marcar todas como lidas</a>

<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th>Notificação</th>
      <th>Criado em</th>
      <th>Acções</th>
    </tr>
  </thead>

  <tbody>
    @forelse($unread as $notification)
      <tr>
        <td>{{ $notification->data['message'] }}</td>
        <td>{{ $notification->created_at->locale('pt')->diffForHumans() }}</td>
        <td>
          <div class="btn-group">
            <a href="{{route('admin.notification.read', ['notification' => $notification->id]) }}" class="btn btn-small btn-primary text-uppercase">
              Marcar como lida
            </a>
          </div>
        </td>
      </tr>

    @empty

      <tr>
        <td colspan="3">
          <div class="alert alert-warning">
            Nenhuma notificação encontrada
          </div>
        </td>
      </tr>

    @endforelse
  </tbody>
</table>

@endsection