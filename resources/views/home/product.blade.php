<head><base href="/public"></head>
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        <div id="trazilica">
            <form style="padding-top: 25px; padding-left: 60px; width: 500px" action="{{ url('/search_home') }}#trazilica" method="get" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                @csrf
                <input type="text" name="search" class="form-control" placeholder="Search products">
                <button style="padding-bottom: 40px" class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>

        </div>
        </div>
        <div class="row" id="products">
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

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>

        <div class="btn-box mt-4">
            <a href="/all_products" class="btn btn-primary">
                View All products
            </a>
        </div>
    </div>
</section>
