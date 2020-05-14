@extends('layouts.app')

@section('content')
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <h1>
      Criar produto
    </h1>
    
    <div class="form-group">
      <label>Nome do produto</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="form-group">
      <label>Descrição</label>
      <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">

      @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="form-group">
      <label>Conteudo</label>
      <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror">
        {{ old('body') }}
      </textarea>

      @error('body')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="form-group">
      <label>Preco</label>
      <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">

      @error('price')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="form-group">
      <label>Categorias</label>
      <select name="categories[]" id="" multiple class="form-control">
        @foreach($categories as $category)
          <option value="{{ $category->id }}">
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Fotos do produto</label>
      <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple accept="image/*">

      @error('photos')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Criar produto</button>
    </div>
  </form>
@endsection