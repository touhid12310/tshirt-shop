@extends('ecom-layouts.app')
@section('title', 'Cart')
@section('style')
<style>

</style>
@endsection
@section('content')

{{-- <header class="container my-5">
        <img src="https://oo-prod.s3.amazonaws.com/public/artworks/2019/03/28/63d39126738c76ac/original.jpg" alt="" class="img-fluid">
</header> --}}
<section class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-success">Your order is successful. Order no - {{ $order->id }} </h3>
            </div>
        </div>

</section>
@endsection
@section('script')
<script>
    


    $(document).ready(function() {
        clearlStorage();
        $("#top-cart-count").html(0)
    })
    
    
</script>
@endsection