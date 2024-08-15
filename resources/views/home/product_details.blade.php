<!DOCTYPE html>
<html>
<head>
    <base href="/public">
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

    <style>
        .product-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .img-box {
            margin-bottom: 20px;
        }

        .img-box img {
            max-width: 100%;
            height: auto;
        }

        .detail-box {
            text-align: center;
        }

        .btn-custom {
            background-color: #ff6f61;
            border: none;
            border-radius: 25px;
            padding: 8px 16px;
            font-size: 16px;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
            text-decoration: none; /* Removes underline */
        }

        .btn-custom i {
            margin-right: 5px;
        }

        .btn-custom:hover {
            background-color: #e65c50; /* Darker shade on hover */
        }
    </style>
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->

    <!-- Product details section start -->
    <div class="container product-container">
        <div class="img-box">
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid rounded" style="height: 250px; height: 250px;" >
        </div>
        <div class="detail-box">
            <h2>{{ $product->title }}</h2>
            <p>{{ $product->description }}</p>

            @if($product->discount_price)
                <h5>Regular price: <span style="text-decoration: line-through; color: gray;">${{ $product->price }}</span></h5>
                <h4 style="color: red;">Discount :${{ $product->discount_price }}</h4>
            @else
                <h4>${{ $product->price }}</h4>
            @endif

            <p><strong>Category:</strong> {{ $product->category->category_name }}</p>
            <p><strong>Quantity Available:</strong> {{ $product->quantity }}</p>
            <form action="/add_to_cart/{{ $product->id }}" method="post">
                @csrf
                <button type="submit" class="btn-custom">
                    <i class="fa fa-shopping-cart"></i>
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
    <!-- Product details section end -->

</div>

<!-- footer start -->
@include('home.footer')
<!-- footer end -->
<div class="cpy_"></div>

<!-- jQuery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</body>
</html>





