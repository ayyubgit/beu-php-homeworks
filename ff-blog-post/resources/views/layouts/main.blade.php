<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Shareen - Personal Blog Template</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='{{ asset("fonts/elegant-font/style.css") }}'>
    <link href="https://fonts.googleapis.com/css?family=Cormorant:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href='{{ asset("fonts/font-awesome/css/font-awesome.min.css") }}'>

    <link rel="stylesheet" href='{{ asset("styles/bootstrap.css") }}'/>
    <link rel="stylesheet" href='{{ asset("styles/main.css") }}'/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
{{--<div id="js-preloader" class="js-preloader">--}}
{{--    <div class="cp-preloader cp-preloader_type1">--}}
{{--        <span class="cp-preloader__letter" data-preloader="L">L</span>--}}
{{--        <span class="cp-preloader__letter" data-preloader="O">O</span>--}}
{{--        <span class="cp-preloader__letter" data-preloader="A">A</span>--}}
{{--        <span class="cp-preloader__letter" data-preloader="D">D</span>--}}
{{--        <span class="cp-preloader__letter" data-preloader="I">I</span>--}}
{{--        <span class="cp-preloader__letter" data-preloader="N">N</span>--}}
{{--        <span class="cp-preloader__letter" data-preloader="G">G</span>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Mobile Menu -->
<div class="mobile-nav-wrapper">
    <div class="mobile-menu-inner">
        <ul class="mobile-menu">
            <li class="has-sub"><a href="#">Home <i class="sub-icon fa fa-angle-down"></i></a>
                <ul class="sub-menu">
                    <li><a href="index.html">Standard Posts</a></li>
                    <li><a href="home-recent.html">Recent Posts</a></li>
                    <li><a href="home-masonry.html">Masonry Posts</a></li>
                    <li><a href="home-list.html">List Posts</a></li>
                    <li><a href="home-full-width.html">Full Width Posts</a></li>
                    <li><a href="home-without-sidebar.html">Without Sidebar</a></li>
                </ul>
            </li>
            <li class="has-sub"><a href="#">Sliders <i class="sub-icon fa fa-angle-down"></i></a>
                <ul class="sub-menu">
                    <li><a href="slider-boxed.html">Boxed Slider</a></li>
                    <li><a href="slider-full-width.html">Full Width Slider</a></li>
                    <li><a href="slider-medium.html">Two Big Posts</a></li>
                    <li><a href="slider-small.html">Three Big Posts</a></li>
                    <li><a href="slider-infinity.html">Infinity Scroll</a></li>
                </ul>
            </li>
            <li><a href="pages-about-me-v1.html">About</a></li>
            <li class="has-sub"><a href="#">Pages <i class="sub-icon fa fa-angle-down"></i></a>
                <ul class="sub-menu">
                    <li><a href="pages-left-sidebar.html">Left Sidebar</a></li>
                    <li><a href="pages-right-sidebar.html">Right Sidebar</a></li>
                    <li><a href="pages-without-sidebar.html">Without Sidebar</a></li>
                    <li><a href="pages-about-me-v1.html">About Version 1</a></li>
                    <li><a href="pages-about-me-v2.html">About Version 2</a></li>
                    <li><a href="pages-contact-me-v1.html">Contact Version 1</a></li>
                    <li><a href="pages-contact-me-v2.html">Contact Version 2</a></li>
                    <li><a href="pages-error-404.html">Error Page 404</a></li>
                    <li><a href="pages-coming-soon.html">Coming Soon Page</a></li>
                </ul>
            </li>
            <li class="has-sub"><a href="#">Posts <i class="sub-icon fa fa-angle-down"></i></a>
                <ul class="sub-menu">
                    <li><a href="single-standard-post.html">Standard Post</a></li>
                    <li><a href="single-audio-post.html">Audio Post</a></li>
                    <li><a href="single-video-post.html">Video Post</a></li>
                    <li><a href="single-gallery-post.html">Gallery Post</a></li>
                    <li><a href="single-quote-post.html">Quote Post</a></li>
                    <li><a href="single-post-left-sidebar.html">Left Sidebar Post</a></li>
                    <li><a href="single-post-right-sidebar.html">Right Sidebar Post</a></li>
                    <li><a href="single-post-without-sidebar.html">Without Sidebar Post</a></li>
                </ul>
            </li>
            <li><a href="pages-contact-me-v2.html">Contact Us</a></li>
        </ul>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
<section class="above-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 align-self-center">
                <ul class="social-icons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Header -->
<header class="site-header fixed-header">
    <div class="container expanded">
        <div class="header-wrap">
            <div class="header-logo">
                <a href="index.html"><img width="500px" src="{{ asset('images/logo.jpg') }}" alt=""></a>
            </div>
            <div class="header-nav">
                <ul class="main-menu">
                    <li class="{{request()->is('/') ? "active" : null }}"><a href="{{ url('/') }}">Home</a></li>
                    @if(!auth()->check())
                        <li class="{{request()->is('auth/login') ? "active" : null }}"><a href="{{ url('auth/login') }}">Sign In</a></li>
                        <li class="{{request()->is('auth/register') ? "active" : null }}"><a href="{{ url('auth/register') }}">Sign Up</a></li>
                    @else
                        @if(auth()->user()->isAdmin())
                            <li class="{{request()->is('admin/post/create') ? "active" : null }}"><a href="{{ url('admin/post/create') }}">Create Post</a></li>
                        @endif
                            <li class="{{request()->is('auth/logout') ? "active" : null }}"><a href="{{ url('auth/logout') }}">Logout</a></li>
                    @endif
                </ul>
            </div>
            <div class="header-widgets">
                <ul class="right-menu">
                    <li class="menu-item menu-mobile-nav">
                        <a href="#" class="menu-bar" id="menu-show-mobile-nav">
                            <span class="hamburger"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- /Header -->

<div>


    <hr/>
</div>

<section class="medium-gap single-post standard-home recent-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="standard-posts single-posts">
                    <div class="row">
@yield('content')
                    </div>
                </div>
            </div>
            @if(request()->is('/') || request()->is('post/*'))
                <div class="col-lg-4">
                    <div class="main-sidebar right-sidebar">
                        <div class="row">
                            @if($latestPosts)
                                <div class="col-lg-12">
                                    <div class="widget-sidebar latest-posts">
                                        <div class="widget-header">
                                            <h4>Latest Posts</h4>
                                        </div>
                                        <div class="widget-content">
                                            <ul class="latest-post-list">
                                                @foreach($latestPosts as $latestPost)
                                                    <li>
                                                        <a href="{{ url('post/'.$latestPost->slug) }}">
                                                            <div class="left-image">
                                                                <img src="{{ asset($latestPost->thumbnail) ?: 'http://placehold.it/370x305' }}" alt="">
                                                            </div>
                                                            <div class="right-content">
                                                                <h6>{{ $latestPost->title }}</h6>
                                                                <span>January 14, 2020</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($categories)
                                <div class="col-lg-12">
                                    <div class="widget-sidebar categories">
                                        <div class="widget-header">
                                            <h4>Categories</h4>
                                        </div>
                                        <div class="widget-content">
                                            <ul class="categories">
                                                @foreach($categories as $category)
                                                    <li><a href="{{ url('/?category='.$category->id) }}">{{ $category->title }} <span>({{ $category->post_count }})</span></a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

@if($errors->any())
    <script>

        swal('{{ $errors->first() }}', '', 'error');

    </script>
@endif

@stack('footer')


<!-- Scripts -->
{{--<script src='{{ asset("scripts/vendors/jquery-3.4.1.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/jquery.hoverIntent.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/perfect-scrollbar.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/jquery.easing.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/wow.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/parallax.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/isotope.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/imagesloaded.pkgd.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/packery-mode.pkgd.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/owl-carousel.min.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/jquery.appear.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/vendors/jquery.countTo.js") }}'></script>--}}
{{--<script src='{{ asset("scripts/main.js") }}'></script>--}}

<script>

    function deletePost(id) {

        var confirmation = confirm('Are you sure?');

        if (confirmation) window.location = '{{ url("admin/post") }}/' + id + '/delete';

    }

</script>
</body>

</html>
