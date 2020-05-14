<h1>Ola, {{ $user->name }}, tudo bem? Espero que sim!</h1>

<h3>Obrigado por sua inscração</h3>

<p>
  Faça excelente compras e venda em nosso market place <br>
  Seu email de cadastro é <strong>{{ $user->email }}</strong> <br>
  Sua senha <strong>Por questoes de segurança não enviamos sua senha, mas deve se lembrar</strong>
</p>

<hr>

Email enviado em {{ now() }}