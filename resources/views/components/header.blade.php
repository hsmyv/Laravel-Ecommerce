    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="{{ route('auth.index') }}">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.0</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @auth
                                    <div class="header__top__hover">
                                    <a href="{{route('account.show', auth()->id())}}">Welcome {{ auth()->user()->name }}</a>


                                        <ul>
                                            <li>
                                                <form method="POST" action="{{ route('auth.logout') }}"
                                                    style="display: inline">
                                                    @csrf
                                                    <button
                                                        style="color:black background-color:transparent background-repeat: no-repeat;
    border: none; cursor: pointer;
    overflow: hidden;
    outline: none;"
                                                        type="submit">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('auth.index') }}">Sign in</a>
                                @endauth
                                <a href="#">FAQs</a>
                            </div>
                            <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>USD</li>
                                    <li>EUR</li>
                                    <li>USD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ setActiveHeader('index') }}"><a href="{{ route('index') }}">Home</a></li>
                            <li class="{{ setActiveHeader('shop') }}"><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="{{ route('cart') }}">Shopping Cart</a></li>
                                    <li><a href="{{ route('checkout.index') }}">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li class="{{ setActiveHeader('contact.show') }}"><a
                                    href="{{ route('contact.show') }}">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="{{ route('cart') }}"><img src="/img/icon/heart.png" alt=""></a>
                        <a href="{{ route('cart') }}"><img src="/img/icon/cart.png" alt=""><span
                                style="font-size: 55%">
                                @if (Cart::instance('default')->count() < 10)
                                    {{ Cart::instance('default')->count() }}
                                @else
                                    9+
                                @endif
                            </span></a>
                        <div class="price">$0.10</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
