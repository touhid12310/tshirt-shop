@extends('ecom-layouts.app')
@section('title', $campaign->title . ' - ' .$product->name)
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    #zoom_01 {
        width: 80%;
    }
    .text-disabled {
        color: lightgray !important;
    }
</style>
@endsection

@section('content')

<hr>
<section class="container my-5">
    {{-- <h6 id="">Shop Top - {{ $product->name }}</h6> --}}

        <div class="row">
            <div class="col-4 col-md-2">
                @foreach($products as $product)
                    @if($loop->first)
                        <div class="col-3 d-none" id="thumb">
                            <img id="frontImage" class="changeImage" src="{{ asset($product->default_front_image) }}" alt="" style="width: 100%" /> <br>
                            <img id="backImage" class="changeImage" src="{{ asset($product->default_back_image) }}" alt="" style="width: 100%" /> <br>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-8 col-md-5">
                <img id="zoom_01" class="d-none" 
                    src='{{ asset($products->first()->default_front_image) }}' 
                    data-zoom-image="{{ asset($products->first()->default_front_image) }}"
                 />

                 
            </div>
            <div class="col-12 col-md-5 relative">
                <div id="zoom-container d-none d-md-block" style="position: absolute">
                    
                </div>

                <div>
                    <strong class="d-block mb-2">
                        <span id="campaign-title" data-campaign-id="{{ $campaign->id }}">{{ $campaign->title . ' - ' .$product->name }} </span>
                        <span id="product-name">
                            {{$products->first()->name}}
                        </span>
                        <p>
                            <span class="text-danger" id="product-price">${{$products->first()->price}}</span> <strike id="product-original-price">${{$products->first()->price + 3}}</strike>
                        </p>
                        <p class="text-success" style="font-size: .8rem">
                            You save $3
                        </p>
                    </strong>

                    <select name="" id="product-select" class="form-select">
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                        @endforeach
                    </select>

                    <div class="row mt-3">
                        @foreach($products as $product)
                        <div class="col-3">
                            <img src="{{ asset($product->default_front_image) }}" 
                            class="changeProduct border border-secondary" 
                            alt="" 
                            style="width: 100%" 
                            data-front-image="{{ asset($product->default_front_image) }}" 
                            data-back-image="{{ asset($product->default_back_image) }}" 
                            data-variations="{{ json_encode($product->variations) }}"
                            data-sizes="{{ json_encode($product->mockup->sizes) }}"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-product-price="{{ $product->price }}"
                            />
                        </div>
                        @endforeach
                    </div>

                    <strong class="d-block mt-3">Color: <span id="colorName">{{ $products->first()->variations->first()->color_name }}</span></strong>
                    <div class="row" id="variations">
                        @foreach($products->first()->variations as $variation)
                            <div class="col-1">
                                <div class="color border border-secondary" 
                                data-name="{{ $variation->color_name }}" 
                                data-front-image="{{ asset($variation->front_image_path) }}" 
                                data-back-image="{{ asset($variation->back_image_path) }}" 
                                style="background: #{{ $variation->color_hex }}; width: 30px; min-height: 30px; border-radius: 100%;
                                
                                "></div>
                            </div>
                        @endforeach
                    </div>

                    <strong class="d-block">Size:</strong>
                    <div class="row">
                        <div class="col-md-12" id="sizes">
                        @foreach($products->first()->mockup->sizes as $size)
                            <span class="m-1 d-inline-block text-uppercase size-btn btn {{ ($loop->first) ? 'btn-secondary btn-info' : 'btn-secondary' }}">{{ $size->size }}</span>
                        @endforeach
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <strong >Qty: </strong><span class="cartQty" style="font-size: 1.2rem">1</span>
                            <div class="my-2">
                                <i onclick="changeQty(-1)" id="cartMinus" class="text-disabled fa-solid fa-circle-minus" style="cursor: pointer; font-size: 1.5rem"></i>
                                <span class="cartQty px-2" id="currentCartQty" style="font-size: 1.5rem">1</span>
                                <i onclick="changeQty(1)" class="fa-solid fa-circle-plus" style="cursor: pointer; font-size: 1.5rem"></i>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary add-to-cart" type="button" style="width: 100%">Add to Cart</button>
                        </div>

                        <div class="col-md-12 my-3 d-none d-md-block">
                            <h5>Campaign Details</h5>

                            {!! $campaign->description !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
<hr>

        <div class="row">
            <div class="col-12">
                <div class="mt-5 d-none" id="recommendation">
                    <h5>Related <span class="text-primary">Products</span></h5>
                    <div class="row">
                        @foreach($relateds as $related)
                        <div class="col-md-6 col-md-2">
                            <div class="bg-white rounded p-2 single-product border border-secondary">
                                <a href="{{ '/details/'.$related->id }}" class="text-decoration-none ">
                                    <img src="{{ asset($related->default_front_image) }}" alt="" class="img-fluid block">
                                    
                                </a>
                                <p class="text-left mt-2">
                                    <strong class="text-sm d-block">{{ $related->name }}</strong>
                                    <span class="text-danger">${{ $related->price }}</span> <strike>${{ $related->price + 3 }}</strike>
                                </p>

                                <button class="btn border border-primary d-block" type="button" style="font-size: 12px; width: 100%">View Products</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                 </div>
            </div>
        </div>

</section>

@endsection

@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


<script>

    function changeQty(qty) {
        let quantity = parseInt($("#currentCartQty").html())
        quantity += qty

        if(quantity == 0 || quantity == 1) {
            quantity = 1
            $("#cartMinus").addClass("text-disabled")
        }

        if(quantity > 1) {
            $("#cartMinus").removeClass("text-disabled")
        }
        $(".cartQty").html(quantity)
    }

    $('#zoom_01').ezPlus({
        zoomWindowPosition: 'zoom-container',
        zoomWindowOffsetX: 0
    });

    $("body").on("click", ".changeProduct", function() {

        $("#colorName").text($(this).attr("data-name"))
        $(".changeProduct").removeClass("border border-success")
        $(".changeProduct").addClass("border border-secondary")
        $(this).addClass("border border-success")

        let frontImage = $(this).attr("data-front-image");
        let backImage = $(this).attr("data-back-image");

        $("#zoom_01").attr("src", frontImage);
        $("#zoom_01").attr("data-zoom-image", frontImage);

        $("#frontImage").attr("src", frontImage);
        $("#backImage").attr("src", backImage);

        $('#zoom_01').ezPlus({
            zoomWindowPosition: 'zoom-container',
            zoomWindowOffsetX: 0
        });
    })

    $("body").on("click", ".size-btn", function() {
        $(".size-btn").removeClass("btn-info")
        $(this).addClass("btn-info")
    })


    $("#product-select").change(function() {
        let selectedProductId = $(this).val();
        // Filter the elements with matching data-product-id and trigger the click event
        $(".changeProduct[data-product-id='" + selectedProductId + "']").trigger("click");
    })

    $(".changeProduct").click(function() {
        let frontImage = $(this).attr("data-front-image");
        let backImage = $(this).attr("data-back-image");
        let productId = $(this).attr("data-product-id");
        let variations =JSON.parse($(this).attr("data-variations"));
        let sizes =JSON.parse($(this).attr("data-sizes"));

        $("#product-name").html($(this).attr("data-product-name"))
        $("#product-price").html("$" + $(this).attr("data-product-price"))
        $("#product-original-price").html("$" + (parseInt($(this).attr("data-product-price")) + 3))

        $("#product-select").val(productId)

        $("#zoom_01").attr("src", frontImage);
        $("#zoom_01").attr("data-zoom-image", frontImage);

        $("#frontImage").attr("src", frontImage);
        $("#backImage").attr("src", backImage);

        $('#zoom_01').ezPlus({
            zoomWindowPosition: 'zoom-container',
            zoomWindowOffsetX: 0
        });

        let variationContainer = document.getElementById("variations");
        let sizesContainer = document.getElementById("sizes");

        // Clean the container before appending new div blocks
        variationContainer.innerHTML = ''; 
        sizesContainer.innerHTML = ''; 
        let server = "{{ asset('/') }}";

        variations.forEach(function(variation) {
            let div = document.createElement("div");
            div.className = "col-1";

            let innerDiv = document.createElement("div");
            innerDiv.className = "color border border-secondary";
            innerDiv.setAttribute("data-name", variation.color_name);
            innerDiv.setAttribute("data-front-image", server+variation.front_image_path);
            innerDiv.setAttribute("data-back-image", server+variation.back_image_path);
            innerDiv.style.background = "#" + variation.color_hex;
            innerDiv.style.width = "30px";
            innerDiv.style.minHeight = "30px";
            innerDiv.style.borderRadius = "100%";

            div.appendChild(innerDiv);
            variationContainer.appendChild(div);
        });

        sizes.forEach(function (size, index) {
            var span = document.createElement("span");
            span.className = "m-1 d-inline-block text-uppercase btn size-btn " + (index === 0 ? 'btn-secondary btn-info' : 'btn-secondary');
            span.textContent = size.size;

            sizesContainer.appendChild(span);
        });

        console.log("variations", variations)
    })

    $(".changeImage").click(function() {
        let image = $(this).attr("src");

        $("#zoom_01").attr("src", image);
        $("#zoom_01").attr("data-zoom-image", image);

        $('#zoom_01').ezPlus({
            zoomWindowPosition: 'zoom-container',
            zoomWindowOffsetX: 0
        });
    });

    $(".add-to-cart").click(function() {
        let qty = $("#currentCartQty").html()
        let size = $(".size-btn.btn-info").html()
        let color = $("#colorName").html()
        let productId = $("#product-select").find(":selected").val()
        let campaignId = $("#campaign-title").attr("data-campaign-id")
        let campaignTitle = $("#campaign-title").html()

        let frontImage = $(".changeProduct[data-product-id='" + productId + "']").attr("data-front-image");
        let backImage = $(".changeProduct[data-product-id='" + productId + "']").attr("data-back-image");
        let productName = $(".changeProduct[data-product-id='" + productId + "']").attr("data-product-name")
        let productPrice = $(".changeProduct[data-product-id='" + productId + "']").attr("data-product-price")

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

    $(document).ready(function() {
        let selectedProductId = {{ $productId }};
        $(".changeProduct[data-product-id='" + selectedProductId + "']").trigger("click");
        $("#thumb").removeClass("d-none")
        $("#zoom_01").removeClass("d-none")
        $("#recommendation").removeClass("d-none")
    })
</script>
@endsection