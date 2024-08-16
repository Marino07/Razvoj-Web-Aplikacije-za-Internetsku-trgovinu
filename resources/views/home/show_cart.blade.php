<!DOCTYPE html>
<html>
<head>
    <style>
        th{
            font-style: italic;
            color: #2f323a;
            text-align: center !important;

        }
        td{
            font-style: italic;
            color: #2f323a;
            text-align: center;
        }

    </style>

    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css"/>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet"/>
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <div class="container mt-5">
        <h2>Your Cart</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_price = 0;
            @endphp
            @foreach($carts as $cart)
                <tr>
                    <td><img src="{{ asset('storage/' . $cart->product->image) }}" alt="Product Image" style="width: 100px;"></td>
                    <td>{{ $cart->product->title }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>${{ $cart->product->price }}</td>
                    <td>${{ $cart->product->price * $cart->quantity }}</td>
                    <td>
                        <form action="/delete_from_cart/{{ $cart->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want delete')" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @php
                    $total_price += $cart->product->price;
                @endphp
            @endforeach
            </tbody>
        </table>
        <div class="total-price">
            To Pay : <span>${{ $total_price }}</span>
        </div>
    </div>
    </div>
</div>

    <!-- end header section -->
    <!-- slider section -->

@include('home.footer')
<!-- footer end -->
<div class="cpy_">

</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</body>
</html>
