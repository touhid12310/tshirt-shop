@include('ecom-layouts.header')
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid"> 
                  <a class="navbar-brand" href="{{url('/')}}">
                    <h4>{{ domainDetail()->title }}</h4>
                        {{-- <img src="https://img001.prntscr.com/file/img001/XaM2wZjHTtK9T6_eSPgGag.png" alt="" style="width: 100px"> --}}
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      {{-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Shop</a>
                      </li> --}}
                    </ul>
                    <div class="d-flex">
                      <a class="position-relative" href="{{ url('/order/cart') }}">
                        <i class="fa fa-shopping-cart" style="color: gray; font-size: 1.5em"></i>
                        <span id="top-cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                          0
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </nav>
        @yield('content')
</div>
<hr>
@include('ecom-layouts.footer')