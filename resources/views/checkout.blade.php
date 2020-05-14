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
    let cardNumber = document.querySelector('input[name=card_number]');
    let spanBrand = document.querySelector('span.brand');

    cardNumber.addEventListener('keyup', function() {
      if(cardNumber.value.length >= 6) {
        PagSeguroDirectPayment.getBrand({
          cardBin: cardNumber.value.substr(0, 6),
          success ({ brand }) {
            const imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${brand.name}.png" />`
            spanBrand.innerHTML = imgFlag
            document.querySelector('input[name=card_brand]').value = brand.name

            getInstallments(amoutnTransaction, brand.name)
          },
          error: err => console.log(err),
          // complete: res => console.log(`Complete:`, res)
        });
      }
    }, false)

    let submitButton = document.querySelector('button.processCheckout');

    submitButton.addEventListener('click', function(e){
      e.preventDefault();

      PagSeguroDirectPayment.createCardToken({
        cardNumber: document.querySelector('input[name=card_number]').value,
        brand: document.querySelector('input[name=card_brand]').value,
        cvv: document.querySelector('input[name=card_cvv]').value,
        expirationMonth: document.querySelector('input[name=card_month]').value,
        expirationYear: document.querySelector('input[name=card_year]').value,

        success: ({card}) => processPayment(card.token),
      })
    }, false)

    function processPayment(token){
      let body = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select[name=payment_installment]').value,
        card_name: document.querySelector('input[name=card_name]'),
        _token: '{{csrf_token()}}',
      }

      body = Object.keys(body).reduce((formData, key) => {
        formData.append(key, body[key])
        return formData
      }, new FormData())

      fetch('{{ route('checkout.process') }}', {
        method: 'POST',
        body
      }).then(response => response.json())
        .then(({data}) => location.href = '{{ route('checkout.thanks') }}?order=' + data.order )
    }

    function getInstallments(amount, brand) {
      PagSeguroDirectPayment.getInstallments({
        amount,
        brand,
        maxInstallmentNoInterest: 0,

        success ({ installments }) {
          let selectInstallments = drawSelectInstallments(installments[brand]);
          document.querySelector('div.installments').innerHTML = selectInstallments;
        },
        error: (err) => console.log(err),
        complete: (res) => console.log(res),
      })
    }

    function drawSelectInstallments(installments) {
      let select = '<label>Opções de Parcelamento:</label>';

      select += '<select class="form-control" name="payment_installment">';

      for(let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
      }


      select += '</select>';

      return select;
	  }
  </script>
@endsection