@extends('layouts.app')

@section('content')

@if(!$store)
  <a href="{{ route('admin.stores.create') }}" class="btn btn-lg btn-success">Criar loja</a>
@else

<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th>#</th>
      <th>loja</th>
      <th>Total de produtos</th>
      <th>ações</th>
    </tr>
  </thead>

  <tbody>
    <tr>
      <td>{{ $store->id }}</td>
      <td>{{ $store->name }}</td>
      <td>{{ $store->products->count() }}</td>
      <td>
        <div class="btn-group">
          <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-small btn-primary text-uppercase">editar</a>

          <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="POST">
            <button type="submit" class="btn btn-small btn-danger text-uppercase">
              @method('DELETE')
              @csrf

              deletar
            </button>
          </form>
      </td>
    </tr>
  </tbody>
</table>

@endif

@endsection