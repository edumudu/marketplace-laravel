@extends('layouts.front')

@section('content')
  <h2>
    Muito obrigado por sua compra!
  </h2>

  <h3 class="alert alert-success">
    Seu pedido foi processado. Codigo do pedido: {{ request()->get('order') }}.
  </h3>
@endsection