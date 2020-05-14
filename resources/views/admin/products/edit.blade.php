@extends('layouts.app')

@section('content')
  <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h1>
      Editar produto
    </h1>
    
    <div class="form-group">
      <label>Nome do produto</label>
      <input type="text" name="name" class="form-control" value="{{ $product->name }}">
    </div>
    
    <div class="form-group">
      <label>Descrição</label>
      <input type="text" name="description" class="form-control" value="{{ $product->description }}"">
    </div>
    
    <div class="form-group">
      <label>Conteudo</label>
      <textarea type="text" name="body" class="form-control">{{ $product->body }}</textarea>
    </div>
    
    <div class="form-group">
      <label>Preco</label>
      <input type="text" name="price" class="form-control" value="{{ $product->price }}">
    </div>

    <div class="form-group">
      <label>Categorias</label>
      <select name="categories[]" id="" multiple class="form-control">
        @foreach($categories as $category)
          <option value="{{ $category->id }}"
            @if($product->categories->contains($category)) selected @endif
          >
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Fotos do produto</label>
      <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
    </div>
    
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Atualizar produto</button>
    </div>
  </form>

  <hr>

  <div class="row">
    @foreach($product->photos as $photo)
      <div class="col-12 col-md-4 text-center">
        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $product->name }}" class="img-fluid">

        <form action="{{ route('admin.photo.destroy') }}" method="POST">
          @csrf
          <input type="hidden" name="photoName" value="{{ $photo->image }}">

          <button type="submit" class="btn btn-lg btn-danger mt-3">
            Remover
          </button>
        </form>
      </div>
    @endforeach
  </div>
@endsection