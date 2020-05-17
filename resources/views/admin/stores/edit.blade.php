@extends('layouts.app')

@section('content')
  <form action="{{ route('admin.stores.update', ['store' => $store->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h1>
      Editar Loja
    </h1>
    
    <div class="form-group">
      <label>Nome loja</label>
      <input type="text" name="name" class="form-control" value="{{ $store->name }}">
    </div>
    
    <div class="form-group">
      <label>Descrição</label>
      <input type="text" name="description" class="form-control" value="{{ $store->description }}">
    </div>
    
    <div class="form-group">
      <label>Telefone</label>
      <input type="text" name="phone" class="form-control" value="{{ $store->phone }}">
    </div>
    
    <div class="form-group">
      <label>Celular</label>
      <input type="text" name="mobile_phone" class="form-control" value="{{ $store->mobile_phone }}">
    </div>

    <div class="form-group">
      @if($store->logo)
        <p>
          <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="img-responsive">
        </p>
      @endif

      <label>Logo</label>
      <input type="file" name="logo" class="form-control" accept="image/*">
    </div>
    
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Atualizar loja</button>
    </div>
  </form>
@endsection