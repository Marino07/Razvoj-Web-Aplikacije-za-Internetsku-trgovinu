<!doctype html>
<html lang="en">
<head>
    <style>
    .payment-methods {
    text-align: center;
    margin-top: 20px;
    }

    .method-buttons {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    }

    .btn-payment {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 10px;
    cursor: pointer;
    border-radius: 12px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-payment:hover {
    background-color: #45a049;
    transform: translateY(-2px);
    }

    #payment-form {
    display: none;
    }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="payment-methods">
    <h3>Select Payment Method</h3>
    <div class="method-buttons">
        <button class="btn-payment" id="pay-card">Pay by Card</button>
        <button class="btn-payment" id="pay-cash">Pay by Cash</button>
    </div>
    <form id="payment-form" style="display: none;">
        <!-- Additional fields for card payment can go here if needed -->
        <button type="submit" class="btn-order">Confirm Payment</button>
    </form>
</div>

</body>
<script>
    document.getElementById('pay-card').addEventListener('click', function() {
        document.getElementById('payment-form').style.display = 'block';
        // Implement any additional logic for card payments
    });

    document.getElementById('pay-cash').addEventListener('click', function() {
        document.getElementById('payment-form').style.display = 'none';
        alert('You have selected to pay by cash.');
    });

</script>
</html>
