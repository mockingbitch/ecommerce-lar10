@php
    use App\Constants\RouteConstant;
    use App\Constants\ColorConstant;
@endphp
@extends('layouts.homeLayout')
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->

                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>
                        {{-- <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div> --}}
                        @foreach ($productStorage as $storage)
                            <div class="product-preview">
                                <img src="{{asset('upload/images/products/' . $storage->image)}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->

                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>
                        {{-- <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="{{asset('upload/images/products/' . $productModel->image)}}" alt="">
                        </div> --}}
                        @foreach ($productStorage as $storage)
                            <div class="product-preview">
                                <img src="{{asset('upload/images/products/' . $storage->image)}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$productModel->name}}</h2>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#">10 Bình luận | Thêm bình luận</a>
                        </div>
                        <div>
                            <h3 class="product-price">{{isset($productStorage[0]) ? number_format($productStorage[0]->price) : '0'}} Đ</h3>
                            @if (isset($productStorage[0]))
                                <span class="product-available">Còn hàng</span>
                            @else
                                <span class="product-available">Hết hàng</span>
                            @endif
                        </div>
                        <p>{{$productModel->description}}</p>
                        <div class="product-options">
                            <label>
                                Loại:
                                <select class="form-control" name="product_detail" id="product_detail">
                                    @foreach ($productStorage as $item)
                                        <option value="{{$item->id}}">{{$item->ram}} GB - {{$item->color}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <div class="add-to-cart">
                            <div class="qty-label">
                                Số lượng
                                <div class="input-number">
                                    <input type="number" class="quantity" name="quantity" value="1" min="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            @if(isset($productStorage[0]))
                                <button class="add-to-cart-btn" onclick="addToCartWithQuantity()"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                            @else
                                <button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i>Hết hàng</button>
                            @endif
                            <a href="{{route(RouteConstant::HOME_LIST_CART)}}" style="color: white;font-weight: bold"> <button style="margin: 30px 0px 0px 170px" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Xem giỏ hàng</button></a>
                        </div>

                        <ul class="product-btns">
                            <li><a href="#"><i class="fa fa-heart-o"></i> Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-exchange"></i> So sánh</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Danh mục:</li>
                            <li><a href="#">{{$productModel->category->name}}</a></li>
                            <li><a href="#">{{$productModel->brand->name}}</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Chia sẻ:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
                            <!--                        <li><a data-toggle="tab" href="#tab2">Details</a></li>-->
                            <li><a data-toggle="tab" href="#tab3">Bình luận</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $productModel->content !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                            <!-- tab3  -->
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">
                                    <!-- Rating -->
                                    <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>4.5</span>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 80%;"></div>
                                                    </div>
                                                    <span class="sum">3</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <span class="sum">2</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Rating -->

                                    <!-- Reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="reviews-pagination">
                                                <li class="active">1</li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form">
                                                <input class="input" type="text" placeholder="Your Name">
                                                <input class="input" type="email" placeholder="Your Email">
                                                <textarea class="input" placeholder="Your Review"></textarea>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Review Form -->
                                </div>
                            </div>
                            <!-- /tab3  -->
                        </div>

                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>

        <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Sản phẩm liên quan</h3>
                    </div>
                </div>
            @foreach($relatedProducts as $products)
            <!-- product -->
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            <img src="{{asset('upload/images/products/' . $products->image)}}" alt="">
                            <div class="product-label">
                                <span class="sale">-30%</span>
                            </div>
                        </div>
                        <div class="product-body">
                            <!--                        <p class="product-category">Category</p>-->
                            <h3 class="product-name"><a href="{{route(RouteConstant::HOME_PRODUCT_DETAIL, ['id'=>$products->id])}}">{{$products->name}}</a></h3>
                            <h4 class="product-price">{{number_format($products->price)}} Đ</h4>
                            <div class="product-rating">
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn" onclick="addCart({{$products->id}})"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </div>
                </div>
                <!-- /product -->
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <script>
        function addToCartWithQuantity() {
            let id = $('#product_detail').find(':selected').val();
            let quantity = $('.quantity').val();
            $.get('{{route(RouteConstant::HOME_ADD_CART)}}', {"id": id, "quantity": quantity}, function (data) {
                if (data.type === 'warning') {
                    swal("Thất bại", "Sản phẩm hết hàng!", "warning");
                }
                if (data.type === 'success') {
                    console.log(data);
                    swal('Thành công', 'Đã thêm vào giỏ hàng', 'success')
                }
                if (data.type === 'error') {
                    swal('Lỗi', 'Đã xảy ra lỗi, vui lòng thử lại', 'warning')
                }
                if (null === data.type || data.type === undefined) {
                    swal('Error', 'JS error', 'warning')
                }
            })
        }
    </script>
@endsection

