@extends('layouts.app')

@section('content')

<a href="{{ route('admin.categories.create') }}" class="btn btn-lg btn-success">Criar categoria</a>

<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th>#</th>
      <th>nome</th>
      <th>ações</th>
    </tr>
  </thead>

  <tbody>
    @foreach($categories as $category)
      <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>
          <div class="btn-group">
            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-small btn-primary text-uppercase">editar</a>

            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
              <button type="submit" class="btn btn-small btn-danger text-uppercase">
                @method('DELETE')
                @csrf

                deletar
              </button>
            </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection