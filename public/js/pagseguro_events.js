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