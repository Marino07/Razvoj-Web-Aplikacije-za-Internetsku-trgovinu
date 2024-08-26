
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="/"><img width="250" src="{{asset('images/logo.png')}}" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}#trazilica">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/show_orders">My orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/show_cart">
                            Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                    </li>
                    <form class="form-inline" action="{{url('/')}}#trazilica">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                    @if (Route::has('login')) <!-- bilo koja ruta se mogla stavit -->
                        @auth
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" id="logincss">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary" href="/login" id="logincss">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-secondary" href="/register">Register</a>
                            </li>
                        @endauth
                    @endif



                </ul>
            </div>
        </nav>
    </div>
</header>
