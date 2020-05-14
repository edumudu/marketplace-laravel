@extends('layouts.app')

@section('content')
  <form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf

    <h1>
      Criar Categoria
    </h1>
    
    <div class="form-group">
      <label>Nome da categoria</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="form-group">
      <label>Descrição</label>
      <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror">
        {{ old('description') }}
      </textarea>

      @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Criar categoria</button>
    </div>
  </form>
@endsection