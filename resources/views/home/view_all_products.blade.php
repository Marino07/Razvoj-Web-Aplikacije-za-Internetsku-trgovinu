<!DOCTYPE html>
<html>
<head>
    <style>

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

    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>products</span>
                </h2>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <a href="{{ url('/product_details',$product->id) }}" class="btn-custom"
                                       style="background-color: #dc4a38; color: #ffffff;">
                                        Product details
                                    </a>
                                    <form action="/add_to_cart/{{ $product->id }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn-custom">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Picture not working at the moment" class="img-fluid">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $product->title }}
                                </h5>
                                @if($product->discount_price)
                                    <h6 style="color: red;">
                                        ${{ $product->discount_price }}
                                    </h6>
                                    <h6 style="text-decoration: line-through; color: gray;">
                                        ${{ $product->price }}
                                    </h6>
                                @else
                                    <h6>
                                        ${{ $product->price }}
                                    </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="btn-box mt-4">
                <a href="/all_products" class="btn btn-primary">
                    View All products
                </a>
            </div>
        </div>
    </section>

</div>
    <!-- end header section -->

<!-- footer start -->
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
