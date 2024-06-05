<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">E-Shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach ($categories as $slug => $title )

                <li><a class="dropdown-item" href="{{route('category.products',$slug)}}">{{$title}}</a></li>

                @endforeach
            </ul>
          </li>
          <li class="nav-item">
            @auth

            <a class="nav-link " href="{{route('cart.products')}}" tabindex="-1">Cart({{count(auth()->user()->cartProducts)}})</a>
            @endauth
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <ul class="navbar-nav  mb-2 mb-lg-0">
            @auth
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
              </li>

              @else
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="{{route('login')}}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Register</a>
              </li>
            @endauth


          </ul>
      </div>
    </div>
  </nav>
