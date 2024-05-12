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

    hr {
        margin: 0 !important;
    }
</style>
@endsection
@section('content')

{{-- <header class="container my-5">
        <img src="https://oo-prod.s3.amazonaws.com/public/artworks/2019/03/28/63d39126738c76ac/original.jpg" alt="" class="img-fluid">
</header> --}}
<section class="container my-5">
        <div class="row">
            
            
            <div class="col-md-6 order-md-2">
                <div class="container-fluid bg-white rounded p-2">
                    <div id="invoice-summary">
                        <div class="border rounded border-secondary" data-bdd="receipt-container">
                            <div class="p-2 rounded-top" style="background: lightgray;">
                                <span>Order will ship as early as <span class="font-weight-bold text-secondary">Apr 25</span></span>
                            </div>
                            <div class="border-top border-bottom border-secondary bg-white" data-bdd="invoice-item">
                                <div class="">
                                    <div class="row">
                                        <div id="cartDetails">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background: lightgray;" class="p-2 rounded-bottom" data-bdd="total-container">
                                <div class="row">
                                    <div class="col">Subtotal</div>
                                    <div class="col-auto" id="subTotal"></div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col">Shipping &amp; Fees</div>
                                    <div class="col-auto" id="shippingCharge"></div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col">Tax</div>
                                    <div class="col-auto">$0.00</div>
                                </div>
                                <hr>
                                <div class="" data-bdd="total">
                                    <div class="row">
                                        <div class="col">Total</div>
                                        <div class="col-auto" id="grandTotal"></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="mt-1">
                            <span class="me-2">Have a promotion code?</span>
                            <span class="text-primary cursor-pointer" type="text">Apply here</span>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6 order-md-1 bg-white rounded">
                <form action="{{ route('order-confirmation') }}" method="post">
                    @csrf
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="pt-2 pb-3">
                                    <h3 class=" m-0" style="font-weight: 100;"><span>Checkout</span></h3>
                                    <h5 class="fs-lg mt-1 text-capitalize" style="font-weight: 100;"><span>Shipping address</span></h5>
                                    <div>
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="" autocomplete="email" value="">
                                            </div>
                                        
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label for="full-name" class="form-label">Full Name *</label>
                                                    <input type="text" class="form-control" id="full-name" name="full_name" placeholder="" autocomplete="name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label for="address1" class="form-label">Address *</label>
                                                    <input type="text" class="form-control" id="address1" name="address_line_1" placeholder="" autocomplete="address-line1" value="">
                                                </div>
                                                <div class="col">
                                                    <label for="address2" class="form-label">Apt, Suite</label>
                                                    <input type="text" class="form-control" id="address2" name="address_line_2" placeholder="" autocomplete="address-line2" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label for="country" class="form-label">Country *</label>
                                                    <input type="text" class="form-control" id="country" name="country" placeholder="" autocomplete="address-level2" value="">
                                                </div>
                                                <div class="col">
                                                    <label for="city" class="form-label">City *</label>
                                                    <input type="text" class="form-control" id="city" name="city" placeholder="" autocomplete="address-level2" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label for="state" class="form-label">State *</label>
                                                    <input type="text" class="form-control" id="state" name="state" placeholder="" autocomplete="state" value="">

                                                    {{-- <select class="form-select" id="state" name="state" autocomplete="address-level1">
                                                        <option value="">State *</option>
                                                    </select> --}}
                                                </div>
                                                <div class="col">
                                                    <label for="zip" class="form-label">Zip *</label>
                                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="" autocomplete="postal-code" value="">
                                                </div>
                                            </div>
                                            <input hidden id="cartInfo" name="cart_info" />
                                            <div class="form-group row">
                                                <div class="col-md-12 mt-2">
                                                    <button type="submit" class="btn btn-info" style="width: 100%;">Place Your Order</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
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

        $("#cartInfo").val(JSON.stringify(cartItems))
    })
    
    function renderCartUi(cartItems) {
        $("#cartDetails").empty();

        let subtotal = 0;
        // Loop through cartItems and create HTML for each item
        cartItems.forEach(function(item, index) {
            subtotal += parseFloat(item.qty) * parseFloat(item.productPrice);

            let singleCartItem = $('<div class="bg-white p-2 ">' +
                '<div class="row">' +
                '<div class="col-md-2">' +
                '<img src="' + item.frontImage + '" alt="" style="width: 100%;">' +
                '</div>' +
                '<div class="col-md-8">' +
                '<p class="campaign-name cart-paragraph" style="margin-bottom: 5px;">' + item.campaignTitle + '</p>' +
                '<p class="product-info cart-paragraph" style="margin-bottom: 5px;">' + item.productName +'/'+ item.color +'/'+ item.size.toUpperCase() + '</p>' +
                '</div>' +
                '<div class="col-md-2" style="text-align: right;">' +
                '<p class="product-price cart-paragraph"> $' + item.productPrice + '</p>' +
                '</div>' +
                '</div>' +
                '</div>'+
                '<hr />'
            );

            // Append the created HTML to the #cartDetails div
            $("#cartDetails").append(singleCartItem);
        });

        let shippingCharge = 4.5;
        $("#subTotal").html("$"+subtotal)
        $("#shippingCharge").html("$"+shippingCharge)
        $("#grandTotal").html("$"+parseFloat(subtotal+shippingCharge))
    }

    $(document).on("click", ".fa-times", function() {
        // Get the index of the item to be removed
        let indexToRemove = $(this).closest('.single-cart-item').index();

        var cartItems = pullObjectFromStorage('cartItems')
        // Remove the item from cartItems array
        cartItems.splice(indexToRemove, 1);
        pushObjectToStorage('cartItems', cartItems)
        renderCartUi(cartItems)
        

    })
</script>
@endsection