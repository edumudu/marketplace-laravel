@extends('layouts.app')

@section('content')

<a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-success">Criar produto</a>

<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th>#</th>
      <th>nome</th>
      <th>preco</th>
      <th>loja</th>
      <th>ações</th>
    </tr>
  </thead>

  <tbody>
    @foreach($products as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->name }}</td>
        <td>R$ {{ number_format($p->price, 2, ',', '.') }}</td>
        <td>{{ $p->store->name }}</td>
        <td>
          <div class="btn-group">
            <a href="{{ route('admin.products.edit', ['product' => $p->id]) }}" class="btn btn-small btn-primary text-uppercase">editar</a>

            <form action="{{ route('admin.products.destroy', ['product' => $p->id]) }}" method="POST">
              <button type="submit" class="btn btn-small btn-danger text-uppercase">
                @method('DELETE')
                @csrf

                deletar
              </button>
            </form>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $products->links() }}

@endsection