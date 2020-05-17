@extends('layouts.front')

@section('content')
  <div class="container">
    <div class="col-md-6">
      <div class="row">
        <div class="col-12">
          <h2>Dados para pagamento</h2>
        </div>
      </div>

      <hr>

      <form action="" method="post">
        <div class="row">
          <div class="form-group col-12">
            <label>
              Numero do cartão

              <span class="brand"></span>
            </label>

            <input type="text" class="form-control" name="card_number">
            <input type="hidden" class="form-control" name="card_brand">
          </div>

          <div class="form-group col-12">
            <label> Nome no cartão </label>
  
            <input type="text" class="form-control" name="card_name">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-4">
            <label>Mês de expiração</label>

            <input type="text" class="form-control" name="card_month">
          </div>

          <div class="form-group col-md-4">
            <label>Ano de expiração</label>

            <input type="text" class="form-control" name="card_year">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-5">
            <label>Codigo de segurança</label>

            <input type="text" class="form-control" name="card_cvv">
          </div>

          <div class="col-12 installments form-group"></div>
        </div>

        <button class="btn btn-lg btn-success processCheckout">
          Efetuar pagamento
        </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

  <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

  <script>
    const sessionId = '{{ session()->get('pagseguro_session_code') }}'
    PagSeguroDirectPayment.setSessionId(sessionId);
  </script>

  <script>
    const amoutnTransaction = '{{ $total }}';
    const urlThanks = '{{ route('checkout.thanks') }}';
    const urlProccess = '{{ route('checkout.process') }}';
    const csrfToken = '{{csrf_token()}}';
  </script>

  <script src="{{ asset('js/pagseguro_functions.js') }}"></script>
  <script src="{{ asset('js/pagseguro_events.js') }}"></script>
@endsection