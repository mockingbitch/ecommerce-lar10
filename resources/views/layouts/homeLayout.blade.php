@php
    use App\Constants\RouteConstant;
    $user = auth()->guard('user')->user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tech Shop</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/sweet-alert.css')}}">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->

    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +0123456789</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> tran.phong@jvb-corp.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Laptop Buy</a></li>
            </ul>
            <ul class="header-links pull-right">
                @if (null !== $user)
                    <li>
                        <div class="dropdown">
                            <button > <i class="fa fa-user-o"></i>{{$user->name ?? ''}}</button>
                            <div class="dropdown-content">
                                <a href="" style="color: black"><i class="fa fa-user-o"></i>Thông tin</a>
                                @if ($user->role === 'ADMIN')
                                    <a href="{{route(RouteConstant::DASHBOARD['home'])}}" style="color: black"><i class="fa fa-user-o"></i>Trang quản trị</a>
                                @else
                                    <a href="" style="color: black"><i class="fa fa-user-o"></i>Lịch sử mua hàng</a>
                                @endif

                                <a href="{{route('logout')}}" style="color: red">Đăng xuất</a>
                            </div>
                        </div>
                    </li>
                @else
                    <li>
                        <a href="{{route('login')}}">
                            <i class="fa fa-user-o"></i>
                            Tài khoản
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo">
                            <img src="{{asset('backend/dist/img/logo.svg')}}" width="60%" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                            <form method="GET">
                            <select class="input-select">
                                <option value="0">All Products</option>
                            </select>
                                <input class="input" type="text" name="textSearch" placeholder="Tìm kiếm">
                                <button formaction=""  class="search-btn" type="submit" >Tìm kiếm</button>
                            </form>

                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix" id="listcart" >
                    <div class="header-ctn cart">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Yêu thích</span>
{{--                                <div class="qty">2</div>--}}
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown ">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Giỏ hàng</span>
                                <div class="qty">{{$cartQuantity ?? 1}}</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list"  >
                                    @if(isset($carts))
                                        @php $subtotal = 0; @endphp
                                        @foreach($carts as $cart)
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img width="50px" src="{{asset('upload/images/products/' . $cart['image'])}}" alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="#">{{$cart['name']}}</a></h3>
                                                    <h4 class="product-price"><span class="qty">{{$cart['quantity']}}x</span>{{number_format($cart['price'])}} Đ</h4>
                                                    @php $total = $cart['quantity'] * $cart['price'] @endphp
                                                </div>
                                            @php $subtotal = $subtotal+$total; @endphp
                                                <button class="delete" onclick="removeCart({{$cart['id']}})"><i class="fa fa-close"></i></button>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Chưa có sản phẩm nào trong giỏ hàng!</p>
                                    @endif
                                <!--cart-->
                                </div>
                                <div class="cart-summary">
                                    <!--<small>3 Item(s) selected</small>-->
                                    @if(isset($carts))
                                    <h5>Tổng tiền: @php echo number_format($subtotal,0,',','.'); @endphp Đ</h5>
                                    @endif
                                </div>
                                <div class="cart-btns">
                                    <a href="{{route(RouteConstant::HOME_LIST_CART)}}">Giỏ hàng</a>
                                    <a href="{{route(RouteConstant::HOME_CHECK_OUT)}}">Thanh toán  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation" >
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="/">Trang chủ</a></li>
                @foreach ($categories as $category)
                    <li><a href="{{route(RouteConstant::HOME_LIST_PRODUCT)}}?category_id={{$category->id}}">{{$category->name}}</a></li>
                @endforeach
                <li><a href="">All products</a></li>
                <li><a href="">About Us</a></li>

            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
@yield('content');

<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Về chúng tôi</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>250 Kim Giang</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+0123456789</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>phongtq1@smartosc.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Danh mục</h3>
                        <ul class="footer-links">
                            <li><a href="#">Hot deals</a></li>
                            <li><a href="#">Máy tính</a></li>
                            <li><a href="#">Điện thoại</a></li>
                            <li><a href="#">Máy ảnh</a></li>
                            <li><a href="#">Phụ kiện</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Thông tin</h3>
                        <ul class="footer-links">
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Liên hệ</a></li>
                            <li><a href="#">Chính sách</a></li>
                            <li><a href="#">Đổi trả</a></li>
                            <li><a href="#">Điều kiện</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Dịch vụ</h3>
                        <ul class="footer-links">
                            <li><a href="#">Tài khoản</a></li>
                            <li><a href="#">Xem giỏ hàng</a></li>
                            <li><a href="#">Yêu thích</a></li>
                            <li><a href="#">Theo dõi đơn hàng</a></li>
                            <li><a href="#">Hỗ trợ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website belong to our team. Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Phong Trần</a>
                                - <a href="https://colorlib.com" target="_blank">Ngọc Thọ</a> -
                                <a href="https://colorlib.com" target="_blank">Hà Phương</a> -
                                <a href="https://colorlib.com" target="_blank">Phạm Nam</a> -
                                <a href="https://colorlib.com" target="_blank">Nguyễn Hoàng</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/sweet-alert.js')}}"></script>

<script>
    // function addCart(id){
    //     $.get('{{route(RouteConstant::HOME_ADD_CART)}}', {"id": id, "quantity": 1}, function(data) {
    //         $("#listcart").load("{{route('home')}} .cart");
    //         if (data.type === 'warning') {
    //                 swal("Thất bại", "Sản phẩm hết hàng!", "warning");
    //             }
    //             if (data.type === 'success') {
    //                 console.log(data);
    //                 swal('Thành công', 'Đã thêm vào giỏ hàng', 'success')
    //             }
    //             if (data.type === 'error') {
    //                 swal('Lỗi', 'Đã xảy ra lỗi, vui lòng thử lại', 'warning')
    //             }
    //             if (null === data.type || data.type === undefined) {
    //                 swal('Error', 'JS error', 'warning')
    //             }
    //     });
    // }

    function removeCart(id){
        $.get('{{route(RouteConstant::HOME_REMOVE_CART)}}', {"id": id}, function(data) {
            $("#list-cart").load(" .cart-change");
            $("#listcart").load("{{route('home')}} .cart");
            $("#sub").load(" .sub-change");
        });
    }
</script>
</body>
</html>


