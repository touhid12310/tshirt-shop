@extends('ecom-layouts.app')
@section('title', 'Buy - '.$search_tags)
@include('ecom-layouts.menu')
@section('content')
<section class="container">
    <div class="row mb-5">
        <div class="col-md-12 text-center filter-type-holder">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold">
                @if(Menus())
                @foreach(Menus() as $menu)
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('tags', ['name' => $menu->menu])}}">{{
                        ucfirst($menu->menu) }}</a>
                </li>
                @endforeach
                @else
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Menu</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</section>


<header class="container my-5">
    <img src="https://oo-prod.s3.amazonaws.com/public/artworks/2019/03/28/63d39126738c76ac/original.jpg" alt=""
        class="img-fluid">
</header>
<section class="container my-5">

    <h5 class="mb-3">Shop Top - {{ $search_tags }}</h5>

    <div class="row">
        @foreach($products as $product)
        <div class="col-6 col-md-2">
            <div class="bg-white rounded p-2 single-product">
                <a href="{{ '/details/'.$product->id}}" class="text-decoration-none ">
                    <img src="{{ asset($product->default_front_image) }}" alt="" class="img-fluid block">
                    <p class="text-center">
                        <strong>{{ $product->name }}</strong>
                    </p>
                </a>
            </div>
        </div>
        @endforeach
    </div>

</section>
@endsection