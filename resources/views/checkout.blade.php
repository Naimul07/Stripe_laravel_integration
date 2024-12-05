<!DOCTYPE html>
<html>
<head>
    <title>Stripe Checkout</title>
</head>
<body>
    <h1>Stripe Payment</h1>
    <p>Click the button below to proceed with payment.</p>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <button type="submit">Pay $20.00</button>
    </form>
</body>
</html>
