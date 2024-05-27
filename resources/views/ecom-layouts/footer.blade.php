
<footer style="background: #f0f0f0">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5 class="py-3">Service</h5>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping & Return Policies</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="py-3">Explore</h5>
                <ul>
                    <li><a href="#">Popular Storefronts</a></li>
                    <li><a href="#">Tags directory</a></li>
                    <li><a href="#">Shop by Product</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="py-3">Need Help</h5>
                <ul>
                    <li>
                        39899 Balentine Drive <br />
                        Suite 200 <br />
                        Newark <br />
                        CA 94560
                    </li>
                    <li><a href="mailto:support@gmail.com">support@gmail.com</a></li>
                    <li><a href="#">Submit a Request</a></li>

                </ul>
            </div>
            <div class="col-md-3">
                <h5>&nbsp;</h5>
            </div>
        </div>
    </div>
</footer>
    <script src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('js/jquery.ez-plus.js') }}"></script>
    <script src="{{ url('js/storage.js') }}"></script>

    <script>
        var cartItems = pullObjectFromStorage('cartItems')
        $("#top-cart-count").html(cartItems.length)
    </script>
    @yield('script')

</body>
</html>