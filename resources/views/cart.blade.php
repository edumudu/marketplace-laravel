@extends('layouts.front')

@section('content')
  <div class="row">
    <div class="col-12">
      <h2>Carinho de compra</h2>

      <hr>
    </div>

    <div class="col-12">
      @if($cart)
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Produto</th>
              <th>preço</th>
              <th>quantidade</th>
              <th>subtotal</th>
              <th>ação</th>
            </tr>
          </thead>

          <tbody>
            @foreach($cart as $c)
              <tr>
                <td>{{ $c['name'] }}</td>
                <td>R$ {{ number_format($c['price'], 2, ',', '.') }}</td>
                <td>{{ $c['amount'] }}</td>
                <td>
                  R$ {{ number_format(($c['amount'] * $c['price']), 2, ',', '.') }}
                </td>
                <td>
                  <a href="{{ route('cart.remove', ['slug' => $c['slug']]) }}" class="btn btn-danger">
                    remover
                  </a>
                </td>
              </tr>
            @endforeach

            <tr>
              <td colspan="3">Total:</td>
              <td colspan="2">
                @php
                  $total = array_reduce($cart, fn($total, $c) => ($c['amount'] * $c['price']) + $total, 0);
                @endphp

                R$ {{ number_format($total, 2, ',', '.') }}
              </td>
            </tr>
          </tbody>
        </table>

        <hr>

        <div class="col-12">
          <a href="{{ route('checkout.index') }}" class="btn btn-lg btn-success float-right ml-2">Concluir compra</a>
          <a href="{{ route('cart.cancel') }}" class="btn btn-lg btn-danger float-right">Cancelar compra</a>
        </div>
      @else
        <div class="alert alert-warning">
          Carrinho vazio...
        </div>
      @endif
    </div>
  </div>
@endsection