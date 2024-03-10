<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="bg-light">

    <header class="text-center p-4 bg-primary text-white mb-3">
        <h4>Select Your Payment Method</h4>
    </header>
    <main class="container">
        <div class="row">
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="card-img py-3">
                            <img src="https://www.edigitalagency.com.au/wp-content/uploads/new-PayPal-Logo-horizontal-full-color-png.png" alt="2checkout" width="150">
                        </div>
                        <h5 class="card-title">PayPal</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="{{ route('payment') }}" class="btn btn-primary">Pay with PayPal</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="card-img">
                            <img src="https://1000logos.net/wp-content/uploads/2021/06/Stripe-Logo-2009.png" alt="stripe" width="130">
                        </div>
                        <h5 class="card-title">Stripe</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="{{ route('payment') }}" class="btn btn-primary">Pay with Stripe</a>
                    </div>
                </div>
            </div>

            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="card-img py-3">
                            <img src="https://seeklogo.com/images/1/2checkout-logo-D1E93B6D17-seeklogo.com.png" alt="2checkout" width="150">
                        </div>
                        <h5 class="card-title">2Checkout</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="{{ route('payment') }}" class="btn btn-primary">Pay with 2Checkout</a>
                    </div>
                </div>
            </div>

            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="card-img py-3">
                            <img src="https://play-lh.googleusercontent.com/Vfshn6wtfUF-Ugo96Jy4o_3T-UrsQL4v4z_doqABVf4h4pgldF_xFzKg-OSy2fgobSXx" alt="2checkout" width="60" height="55">
                        </div>
                        <h5 class="card-title">SSL Commerz</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="{{ route('payment') }}" class="btn btn-primary">Pay with SSL</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
