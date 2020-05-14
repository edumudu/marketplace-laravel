@extends('layouts.front')

@section('content')
  <div class="row mb-4">
    <div class="col-4">
      @if($store->logo)
        <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo da loja {{ $store->name }}" class="img-fluid">
      @else
        <img src="https://via.placeholder.com/1280X720.png?text=logo" class="img-fluid">
      @endif
    </div>

    <div class="col-8">
      <h2 class="text-capitalize">{{ $store->name }}</h2>

      <p>
        {{ $store->description }}
      </p>

      <p>
        <strong>Contatos:</strong>
        <span>{{ $store->phone }}</span> | <span>{{ $store->mobile_phone }}</span>
      </p>
    </div>

    <div class="col-12 mb-3">
      <hr>
      
      <h3>
        Produtos dessa loja
      </h3>
    </div>

    @forelse($store->products as $key => $product)
      <div class="col-12 col-md-4">
        <div class="card">
          @if($product->photos->count())
            <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="" class="card-img-top">
          @else
            <img src="{{ asset('assets/images/no-photo.jpg') }}" alt="" class="card-img-top">
          @endif

          <div class="card-body">
            <h2 class="card-title">
              {{ $product->name }}
            </h2>

            <p class="card-text">
              {{ $product->description }}
            </p>

            <h3>
              R$ {{ number_format($product->price, 2, ',', '.') }}
            </h3>

            <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">
              Ver produto
            </a>
          </div>
        </div>
      </div>

      @if(($key + 1) % 3 === 0)
        </div>
        <div class="row mb-4">
      @endif
      
    @empty

      <div class="col-12">
        <h3 class="alert alert-warning">Nenhum produto encontrado para esta loja.</h3>
      </div>

    @endforelse
  </div>
@endsection