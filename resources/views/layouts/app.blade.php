<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Marketplace</title>

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      @auth
        <ul class="navbar-nav mr-auto">
          <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
            <a class="nav-link text-capitalize" href="{{ route('admin.orders.my') }}">
              Meus Pedidos
            </a>
          </li>

          <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
            <a class="nav-link text-capitalize" href="{{ route('admin.stores.index') }}">
              loja
            </a>
          </li>

          <li class="nav-item @if(request()->is('admin/products*')) active @endif">
            <a class="nav-link text-capitalize" href="{{ route('admin.products.index') }}">
              produtos
            </a>
          </li>

          <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
            <a class="nav-link text-capitalize" href="{{ route('admin.categories.index') }}">
              categorias
            </a>
          </li>
        </ul>

        <div class="my-2 my-lg-0">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="{{ route('admin.notification.index') }}" class="nav-link">
                <span class="badge badge-danger">
                  {{ auth()->user()->unreadNotifications->count() }}
                </span>

                <i class="fas fa-bell"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-capitalize" onclick="event.preventDefault(); document.querySelector('form.logout').submit()" href="#">
                sair
              </a>

              <form action="{{ route('logout') }}" method="POST" class="logout d-none">
                @csrf
              </form>
            </li>

            <li class="nav-item">
              <span class="nav-link text-capitalize">
                {{ auth()->user()->name }}
              </span>
            </li>
          </ul>
        @endauth
      </div>
    </div>
  </nav>

  <div class="container">
    @include('flash::message')

    @yield('content')
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>