@extends('layouts.front')

@section('content')
  <div class="row">
    <div class="col-6">
      @if($product->photos->count())
        <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="" class="img-fluid">
      @else
        <img src="{{ asset('assets/images/no-photo.jpg') }}" alt="" class="img-fluid">
      @endif

      <div class="row mt-4">
        @foreach($product->photos as $photo)
          <div class="col-4">
            <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">
          </div>
        @endforeach
      </div>
    </div>

    <div class="col-6">
      <div class="col-12">
        <h2>
          {{ $product->name }}
        </h2>
  
        <p>
          {{ $product->description }}
        </p>
  
        <h3>
          R$ {{ number_format($product->price, 2, ',', '.') }}
        </h3>
  
        <span>
          Loja: 

          <a href="{{ route('store.single', ['slug' => $product->store->slug]) }}">
            {{ $product->store->name }}
          </a>
        </span>
      </div>

      <div class="product-add col-12">
        <hr>

        <form action="{{ route('cart.add') }}" method="POST">
          @csrf

          <input type="hidden" name="product[name]" value="{{ $product->name }}">
          <input type="hidden" name="product[price]" value="{{ $product->price }}">
          <input type="hidden" name="product[slug]" value="{{ $product->slug }}">

          <div class="form-group">
            <label>Quantidade</label>

            <input type="number" class="form-control col-md-2" name="product[amount]" value="1">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-lg btn-danger ">
              Comprar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <hr />
      
      {{ $product->body }}
    </div>
  </div>
@endsection