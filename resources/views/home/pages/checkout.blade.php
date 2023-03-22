@extends('layouts.homeLayout')
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form action="{{route('confirm-check-out')}}" method="POST">
                    @csrf
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Thông tin nhận hàng</h3>
                            </div>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            </div>
                        @if(isset($customer))
                            <div class="form-group">
                                <input class="input" type="text" name="customerName" value="{{$customer->customerName}}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" value="{{$customer->email}}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="phone" placeholder="Phone Number">
                            </div>
                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" name="note" placeholder="Note"></textarea>
                            </div>
                            <!-- /Order notes -->
                            @else
                            <h4>Vui lòng  <a href="{{route('customer-login-page')}}" style=" font-weight: bold">đăng nhập</a> để nhận được nhiều phần quà giá trị hơn.</h4>
                            <h3>Hoặc mua nhanh</h3>
                            <div class="form-group">
                                <input class="input" type="text" name="customerName" placeholder="Customer">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="phone" placeholder="Phone Number">
                            </div>
                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" name="note" placeholder="Note"></textarea>
                            </div>
                            @endif
                        </div>



                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Đơn hàng của bạn</h3>
                        </div>

                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>Sản phẩm</strong></div>
                                <div><strong>Tổng</strong></div>
                            </div>
                            @php $subtotal=0; @endphp
                            @if(isset($carts))
                            @foreach($carts as $cart)
                            <div class="order-products">
                                <div class="order-col">
                                    <div>{{$cart['quantity']}} x {{$cart['productName']}}</div>
                                    <div>@php $total = $cart['quantity']*$cart['productPrice'];
                                        echo number_format($total,0,',','.');
                                        @endphp Đ</div>
                                </div>
                            </div>
                            @php $subtotal+=$total; @endphp
                                @endforeach
                            @else
                                <h4 style="color: red">Chưa có sản phẩm nào trong giỏ hàng, vui lòng <a href="{{route('home')}}">thêm sản phẩm</a> để tiến hành thanh toán!!!</h4>
                            @endif
                            <div class="order-col">
                                <div>Shipping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>Tổng thanh toán</strong></div>
                                <div><strong class="order-total">@php echo number_format($subtotal,0,',','.');@endphp Đ</strong></div>
                            </div>
                        </div>
                        @if(isset($carts) )
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2">
                                <label for="payment-2">
                                    <span></span>
                                    Cheque Payment
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Paypal System
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#">terms & conditions</a>
                            </label>
                        </div>
                            <button class="primary-btn order-submit" type="submit" name="checkout">Xác nhận đơn hàng</button>
                        @endif
                    </div>
                </form>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
