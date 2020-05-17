function processPayment(token){
  let body = {
    card_token: token,
    hash: PagSeguroDirectPayment.getSenderHash(),
    installment: document.querySelector('select[name=payment_installment]').value,
    card_name: document.querySelector('input[name=card_name]'),
    _token: csrfToken,
  }

  body = Object.keys(body).reduce((formData, key) => {
    formData.append(key, body[key])
    return formData
  }, new FormData())

  fetch(urlProccess, {
    method: 'POST',
    body
  }).then(response => response.json())
    .then(({data}) => location.href = `${urlThanks}?order=${data.order}`)
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