@extends('layouts.app')

@section('content')
  <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <h1>
      Editar categoria
    </h1>
    
    <div class="form-group">
      <label>Nome loja</label>
      <input type="text" name="name" class="form-control" value="{{ $category->name }}">
    </div>
    
    <div class="form-group">
      <label>Descrição</label>
      <input type="text" name="description" class="form-control" value="{{ $category->description }}">
    </div>
    
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Atualizar categoria</button>
    </div>
  </form>
@endsection