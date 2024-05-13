@extends('ecom-layouts.app')
@section('title', domainDetail()->title)
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
    <img src="https://oo-prod.s3.amazonaws.com/public/artworks/2019/03/28/63d39126738c76ac/original.jpg" alt=""
        class="img-fluid">

    <div class="row mb-5 my-2">
        <hr>
        <div class="col-md-12 text-center">
            <h2 class="text-black">
                Fresh Arrivals
            </h2>
        </div>
        <div class="col-md-12 text-center">
            <span class="filter-product active" data-filter="All">All</span>

            @foreach ($filterables as $id => $item)
            <span class="filter-product" data-filter="{{$item}}">{{$item}}</span>
            @endforeach
        </div>
    </div>


    <div class="row">

        @foreach($products as $product)
        <div class="col-md-3 mb-5 remove-filter filter-{{ $product->category }}">
            <div class="p-3 cart-container  bg-white rounded">
                <a href="{{ url('/details/'.$product->id) }}" class="text-decoration-none">
                    <img src="{{ asset($product->default_front_image) }}" alt="" class="img-fluid d-block">
                    <div class="product-name">
                        {{ $product?->campaign?->title }}
                        <span><i class="fa fa-arrow-right" style="transform: rotate(315deg)"></i></span>
                    </div>
                </a>
                <div class="product-price">
                    ${{ number_format((float)$product->price, 2, '.', '') }}

                </div>
                <div class="row colors-holder">

                    <div class="col-12">
                        <div class="product-colors" style="overflow-x: auto; white-space: nowrap;">
                            @foreach($product->variations as $variation)
                            <div class="color-box-holder {{ ($loop->first) ? 'active' : null }}">
                                <span class="color-box rounded-circle" data-color-name="{{ $variation->color_name }}"
                                    style="background: #{{ $variation->color_hex }}"></span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="empty">
                    <p></p>
                </div>
                <div class="size-container">
                    <div class="row">

                        <div class="col-12">
                            <div class="sizes-container" style="overflow-x: auto; white-space: nowrap;">
                                @foreach($product->product->sizes as $size)
                                <div class="choose-product-size text-uppercase product-size-box">{{ $size->size }}</div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="add-to-cart-holder d-none mt-2">
                    <div class="row">
                        <div class="col-2">
                            <div class="change-product-size product-size-box product-size-box-active text-uppercase">
                                <span class="size-name"></span>
                                <i class="size-edit d-none fa fa-pencil fa-2x"></i>
                            </div>
                        </div>
                        <div class="col-10">
                            <button type="button" class="add-to-cart btn btn-info" style="width: 100%;"
                                data-product-id="{{ $product->id }}" data-campaign-id="{{ $product->campaign_id }}"
                                data-campaign-title="{{ $product?->campaign?->title }}"
                                data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}"
                                data-front-image="{{ asset($product->default_front_image) }}">ADD TO CART</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>
@endsection
@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $(".choose-product-size").click(function() {
        $(".choose-product-size").removeClass("active")
        $(this).addClass("active")

        $(this).parent().parent().parent().parent().siblings(".add-to-cart-holder").removeClass("d-none")
        $(this).parent().parent().parent().parent().siblings(".add-to-cart-holder").children(".row").children(".col-2").children(".product-size-box-active").children(".size-name").html($(this).html())

        $(this).parent('.sizes-container').addClass("d-none")

    })

    $(".color-box").click(function() {
        $(this).parent().siblings(".color-box-holder").removeClass("active")
        $(this).parent('.color-box-holder').addClass("active")
    })


    $(".change-product-size").hover(
        function() {
        $(this).find(".size-name").addClass("d-none");
        $(this).find(".size-edit").removeClass("d-none");
        },
        function() {
        $(this).find(".size-name").removeClass("d-none");
        $(this).find(".size-edit").addClass("d-none");
        }
    );

    $(".size-edit").click(function() {
        $(this).parent().parent().parent().parent(".add-to-cart-holder").addClass("d-none")
        $(this).parent().parent().parent().parent(".add-to-cart-holder").siblings(".size-container").children().children().children(".sizes-container").removeClass("d-none")
    })

    $(".add-to-cart").click(function() {
        $(this).parent().parent().parent(".add-to-cart-holder").addClass("d-none")
        $(this).parent().parent().parent(".add-to-cart-holder").siblings(".size-container").children().children().children(".sizes-container").removeClass("d-none")

        let qty = 1
        let size = $(this).parent().siblings().children().children(".size-name").html()
        let color = $(this).parent().parent().parent().siblings(".colors-holder").children().children().children(".color-box-holder.active").children(".color-box").attr("data-color-name")

        let productId = $(this).attr("data-product-id")
        let campaignId = $(this).attr("data-campaign-id")
        let campaignTitle = $(this).attr("data-campaign-title")

        let frontImage = $(this).attr("data-front-image");
        let backImage = null;
        let productName = $(this).attr("data-product-name")
        let productPrice = $(this).attr("data-product-price")

        Toastify({
            text: "Product added to cart!",
            duration: 3000,
            destination: "{{ url('/order/cart') }}",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
        }).showToast();

        var cartItems = pullObjectFromStorage('cartItems')

        console.log(cartItems)
        if(cartItems == null) {
            pushObjectToStorage('cartItems', [{
                    campaignId,
                    campaignTitle,
                    productId,
                    productName,
                    productPrice,
                    frontImage,
                    backImage,
                    size,
                    color,
                    qty
                }]
            )
        } else {
            let index = itemExistInCart(cartItems, productId, size, color)

            if (index !== -1) {
                // If item exists, replace it
                cartItems[index] = {
                    campaignId,
                    campaignTitle,
                    productId,
                    productName,
                    productPrice,
                    frontImage,
                    backImage,
                    size,
                    color,
                    qty
                };
            } else {
                // If item does not exist, push a new item to the array
                cartItems.push({
                    campaignId,
                    campaignTitle,
                    productId,
                    productName,
                    productPrice,
                    frontImage,
                    backImage,
                    size,
                    color,
                    qty
                });
            }

            pushObjectToStorage('cartItems', cartItems)
        }

        var newCartItems = pullObjectFromStorage('cartItems')
        $("#top-cart-count").html(newCartItems.length)

        console.log("qty: ", qty, ", size: ", size, ", color:", color, ", product id: ", productId, ", product name: ", productName, " product price:", productPrice, ", campaign id: ", campaignId, ", campaign Title: ", campaignTitle)
    })

    function itemExistInCart(cartItems, productId, size, color) {
        for (let i = 0; i < cartItems.length; i++) {
            if (cartItems[i].productId === productId && cartItems[i].size == size && cartItems[i].color == color) {
                return i; // Return the index of the existing item
            }
        }
        return -1; // Return -1 if item not found
    }

    $(".filter-product").click(function() {
        $(".filter-product").removeClass("active")
        $(this).addClass("active")
        let filter = $(this).data("filter")

        if(filter == 'All')
        {
            $(".remove-filter").removeClass("d-none")
        } else {
            $(".remove-filter").addClass("d-none")

            let filterClass = '.filter-'+filter

            $(filterClass).removeClass("d-none")
        }
        console.log("filter", filter)
    })
</script>
@endsection