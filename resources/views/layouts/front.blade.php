<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Marketplace</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  @yield('stylesheets')
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item @if(request()->is('/')) active @endif">
          <a class="nav-link text-capitalize" href="{{ route('home') }}">
            home
          </a>
        </li>
        @foreach($categories as $category)
          <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
            <a class="nav-link text-capitalize" href="{{ route('category.single', ['slug' => $category->slug]) }}">
              {{ $category->name }}
            </a>
          </li>
        @endforeach
      </ul>

      <div class="my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
          @auth

            <li class="nav-item @if(request()->is('my-orders')) active @endif">
              <a href="{{ route('user.orders') }}" class="nav-link text-capitalize">
                Meus pedidos
              </a>
            </li>

          @endauth

          <li class="nav-item">
            <a href="{{ route('cart.index') }}" class="nav-link text-capitalize">
              @if(session()->has('cart'))
                <span class="badge badge-danger">
                  {{ count(session()->get('cart')) }}
                </span>
              @endif

              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @include('flash::message')

    @yield('content')
  </div>

  @yield('scripts')
</body>
</html>