<?php

require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('STRIPE_SECRET_KEY');

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'T-shirt',
            ],
            'unit_amount' => 2000,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost:4242/success',
    'cancel_url' => 'http://example.com/cancel',
]);

?>

<html>
<head>
    <title>Buy cool new product</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<style>
    .center {
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .my-button {
        width: 180px;
        height: 140px;
        border-radius: 12px;
        border: 5px solid;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<div class="center">
    <button class="my-button" id="checkout-button">
        Checkout
    </button>
</div>


<script>
    let stripe = Stripe('STRIPE_PUBLIC_KEY');
    const btn = document.getElementById("checkout-button")
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        stripe.redirectToCheckout({
            sessionId: "<?php echo $session->id; ?>"
        });
    });
</script>
</body>
</html>







