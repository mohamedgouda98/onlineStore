@include('assets.navbar')

        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.html">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <input type="text" placeholder="Search">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="wishlist.html" class="btn wishlist">
                                <i class="fa fa-heart"></i>
                                <span>(0)</span>
                            </a>
                            <a href="cart.html" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span>(0)</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->

        <!-- Main Slider Start -->
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                @foreach($categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa {{$category->icon}}"></i>{{$category->name}}</a>
                                    </li>
                                @endforeach
{{--                             --}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-shopping-bag"></i>Best Selling</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-plus-square"></i>New Arrivals</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-female"></i>Fashion & Beauty</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-child"></i>Kids & Babies Clothes</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-tshirt"></i>Men & Women Clothes</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-mobile-alt"></i>Gadgets & Accessories</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#"><i class="fa fa-microchip"></i>Electronics & Accessories</a>--}}
{{--                                </li>--}}
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-6">
                        <div class="header-slider normal-slider">
                            <div class="header-slider-item">
                                <img src="img/slider-1.jpg" alt="Slider Image" />
                                <div class="header-slider-caption">
                                    <p>Some text goes here that describes the image</p>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                </div>
                            </div>
                            <div class="header-slider-item">
                                <img src="img/slider-2.jpg" alt="Slider Image" />
                                <div class="header-slider-caption">
                                    <p>Some text goes here that describes the image</p>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                </div>
                            </div>
                            <div class="header-slider-item">
                                <img src="img/slider-3.jpg" alt="Slider Image" />
                                <div class="header-slider-caption">
                                    <p>Some text goes here that describes the image</p>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="header-img">
                            @foreach($ads as $ad)
                                <div class="img-item">
                                    <img src="{{public_path('images/test1.png')}}" />
                                    <a class="img-text" href="">
                                        <p>{{$ad->slug}}</p>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Slider End -->

        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- Brand End -->

        <!-- Feature Start-->
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fab fa-cc-mastercard"></i>
                            <h2>Secure Payment</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Worldwide Delivery</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-sync-alt"></i>
                            <h2>90 Days Return</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>24/7 Support</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur elit
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->

        <!-- Category Start-->
        <div class="category">
            <div class="container-fluid">
                <div class="row">
                    @foreach($subAds as $subAd)
                        <div class="col-md-3">
                            <div class="category-item ch-{{$subAd->size}}">
                                <img src="img/category-3.jpg" />
                                <a class="category-name" href="">
                                    <p>{{$subAd->slug}}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Category End-->

        <!-- Call to Action Start -->
        <div class="call-to-action">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1>call us for any queries</h1>
                    </div>
                    <div class="col-md-6">
                        <a href="tel:0123456789">+012-345-6789</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Call to Action End -->

        <!-- Featured Product Start -->
        <div class="featured-product product">
            <div class="container-fluid">
                <div class="section-header">
                    <h1>Our Categories</h1>
                </div>
                <div class="row align-items-center product-slider product-slider-4">
                    @foreach($categories as $category)
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#">{{$category->name}}</a>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img src="{{public_path('images/categories/'. $category->image)}}" alt="Product Image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Featured Product End -->

      @include('assets.footer')
