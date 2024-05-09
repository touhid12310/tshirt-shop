@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    .product-name,
    .product-price {
        font-family: Roboto;
        font-weight: 500;
        font-size: 1.3em;
    }

    .product-name a {
        text-decoration: none;
        color: #080808;
    }

    .product-name a:hover {
        text-decoration: none;
        color: #3111fe;
    }

    .product-price {
        color: #292929;
    }

    .color-box {
        width: 24px;
        height: 24px;
        /* margin: 4px; */
        display: inline-block;
        /* padding: 8px; */
        cursor: pointer;
    }

    .color-box-holder {
        margin: 0;
        padding: 0;
        height: 32px;
        width: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .color-box-holder:hover {
        border: 1px solid black;
        border-radius: 100%;
    }

    .color-box-holder.active {
        border: 2px solid black;
        border-radius: 100%;
    }

    body {
        background-color: #efefef;
    }

    .cart-container {
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .cart-container:hover {
        background: rgb(255, 255, 255);
        transform: translate(0px, -20px);
        box-shadow: rgba(0, 0, 0, 0.16) 0px 0px 16px;
    }

    .size-container {
        opacity: 0;
        transform: translate(0px, 0px);
        transition: all 0.3s ease-in-out 0s;
    }

    .cart-container:hover .size-container {
        background: rgb(255, 255, 255);
        opacity: 1;
        transform: translate(0px, -10px);

    }

    .product-size-box {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background: #dddddd;
        border-radius: 100%;
        width: 36px;
        height: 36px;
        font-size: 9px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .product-size-box:hover {
        border: 1px solid black;
    }

    .product-size-box.active,
    .product-size-box-active {
        border: 2px solid black;
    }

    /* Scroll Bar  */
    /* For WebKit browsers (e.g., Chrome, Safari) */
    ::-webkit-scrollbar {
        width: 1px;
        /* Adjust the width as needed */
        height: 0px;

    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Change the background color as needed */
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        /* Change the color of the scrollbar thumb */
        border-radius: 50px;
        /* Adjust the border-radius for rounded corners */
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Change the color of the scrollbar thumb on hover */
    }

    .filter-product {
        padding: 1rem;
        font-size: 17px;
        font-weight: 600;
        color: grey;
        cursor: pointer;
    }

    .filter-product.active {
        text-decoration: underline;
        color: #000;
        text-decoration-thickness: 5px;
    }

    .filter-type-holder {
        padding: 10px;
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        transition: all 0.4s ease-in-out;
        cursor: pointer;
    }

    .filter-type {
        padding: 10px 40px;
        font-size: 20px;
        font-weight: 600;
    }

    .filter-type:hover {
        color: blue;
    }

    * {
        font-family: Roboto;
    }
</style>
@endsection