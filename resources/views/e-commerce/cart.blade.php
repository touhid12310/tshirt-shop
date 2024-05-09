@extends('ecom-layouts.app')
@section('title', 'Cart')
@section('style')
<style>
    .single-cart-item {
        border: 1px solid gray;
    }
    .single-cart-item:not(:last-child) {
        border-bottom: inherit;
    }
    .fa-times {
        cursor: pointer;
    }
</style>
@endsection
@section('content')

{{-- <header class="container my-5">
        <img src="https://oo-prod.s3.amazonaws.com/public/artworks/2019/03/28/63d39126738c76ac/original.jpg" alt="" class="img-fluid">
</header> --}}
<section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h4>Your Cart - <span id="itemCounts"></span></h4>
                <div id="cartDetails">

                </div>
            </div>
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <h4>&nbsp;</h4>
                            {{-- <div class="card mb-3">
                                <div class="card-body">
                                    <div class="alert alert-success" role="alert">
                                        You've earned FREE shipping!
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <div><span>£0</span></div>
                                        <div><span>£32.17</span></div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div><span class="font-weight-bold">Subtotal</span></div>
                                        <div><span id="subTotal"></span></div>
                                    </div>
                                    <hr class="my-2">
                                    {{-- <div class="d-flex justify-content-between">
                                        <div><span class="font-weight-bold">Discount</span><i class="mdi mdi-tag ml-2 mr-1 text-secondary"></i></div>
                                        <div><span>-£6.42</span></div>
                                    </div>
                                    <hr class="my-2"> --}}
                                    <div class="d-flex justify-content-between">
                                        <div><span>Shipping &amp; Fees</span></div>
                                        <div><span class="font-italic text-secondary">Calculated at checkout</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 d-none">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Enter Email for Express Checkout</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" autocomplete="email">
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <a class="btn btn-primary" href="{{ route('checkout-page') }}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

</section>
@endsection
@section('script')
<script>
    

    function changeQty(index, qty) {
        

        var cartItems = pullObjectFromStorage('cartItems')

        let quantity = parseInt(cartItems[index].qty)
        quantity += qty

        if(quantity == 0 || quantity == 1) {
            quantity = 1
            $("#cartMinus").addClass("text-disabled")
        }

        if(quantity > 1) {
            $("#cartMinus").removeClass("text-disabled")
        }
        $(".cartQty").html(quantity)
        cartItems[index].qty = quantity
        pushObjectToStorage('cartItems', cartItems)
        renderCartUi(cartItems)

    }


    $(document).ready(function() {
        var cartItems = pullObjectFromStorage('cartItems')
        $("#itemCounts").html(cartItems.length + " items")
        renderCartUi(cartItems)
    })
    
    function renderCartUi(cartItems) {
        $("#cartDetails").empty();

        let subtotal = 0;
        // Loop through cartItems and create HTML for each item
        cartItems.forEach(function(item, index) {
            subtotal += parseFloat(item.qty) * parseFloat(item.productPrice);

            let singleCartItem = $('<div class="bg-white p-2 single-cart-item">' +
                '<div class="row">' +
                '<div class="col-md-2">' +
                '<img src="' + item.frontImage + '" alt="" style="width: 100%;">' +
                '</div>' +
                '<div class="col-md-8">' +
                '<p class="campaign-name cart-paragraph">' + item.campaignTitle + '</p>' +
                '<p class="product-info cart-paragraph">' + item.productName +'/'+ item.color +'/'+ item.size.toUpperCase() + '</p>' +
                '<div class="my-2">' +
                'Qty: ' +
                '<i onclick="changeQty('+index+', -1)" id="cartMinus" class="text-disabled fa-solid fa-circle-minus" style="cursor: pointer; font-size: 1rem"></i>' +
                '<span class="cartQty px-2" style="font-size: 1rem">' + item.qty + '</span>' +
                '<i onclick="changeQty('+index+', 1)" class="fa-solid fa-circle-plus" style="cursor: pointer; font-size: 1rem"></i>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2" style="text-align: right;">' +
                '<i class="fa fa-2x fa-times text-danger"></i>' +
                '<p class="product-price cart-paragraph"> $' + item.productPrice + '</p>' +
                '</div>' +
                '</div>' +
                '</div>');

            // Append the created HTML to the #cartDetails div
            $("#cartDetails").append(singleCartItem);
        });

        $("#subTotal").html("$"+subtotal)
    }

    $(document).on("click", ".fa-times", function() {
        // Get the index of the item to be removed
        let indexToRemove = $(this).closest('.single-cart-item').index();

        var cartItems = pullObjectFromStorage('cartItems')
        // Remove the item from cartItems array
        cartItems.splice(indexToRemove, 1);
        pushObjectToStorage('cartItems', cartItems)
        renderCartUi(cartItems)
        
        var newCartItems = pullObjectFromStorage('cartItems')
        $("#top-cart-count").html(newCartItems.length)
    })
</script>
@endsection