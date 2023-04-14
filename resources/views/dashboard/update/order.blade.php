@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
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

<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Thông tin chi tiết đơn hàng</h3>
                            <span style="color: red">
                                @if(isset($msg))
                                    {{$msg}}
                                    @endif
                            </span>
                        </div>
                        <div>
                            <div class="form-group">
                                <input class="input" type="text" name="customername" value="{{$order->name}}" disabled readonly>
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" value="{{$order->email}}"readonly disabled>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" value="{{$order->address}}" readonly disabled>
                            </div>

                            <div class="form-group">
                                <input class="input" type="tel" name="phone" value="{{$order->phone}}" readonly disabled>
                            </div>
                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" name="note" >{{$order->note}}</textarea>
                            </div>
                            <!-- /Order notes -->
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Đơn hàng</h3>
                    </div>

                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>Sản phẩm</strong></div>
                            <div><strong>Tổng</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach($orderDetail as $result)
                            <div class="order-col">
                                <div>{{$result['quantity']}} x {{$result['name']}}</div>
                                <div>@php $total = $result['quantity']*$result['price'];
                                    echo number_format($total, 0, ',', '.');
                                    @endphp Đ</div>
                            </div>
                            @endforeach

                        </div>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>Tổng thanh toán</strong></div>
                            <div><strong class="order-total">{{number_format($order->subTotal)}} Đ</strong></div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        <a href="{{route(RouteConstant::DASHBOARD['order_update'], ['id' => $order->id, 'type' => 'confirm'])}}" style="color: white;font-weight: bold">Xác nhận đơn hàng</a>
                    </button>
                    <button class="btn btn-primary" type="submit">
                        <a href="{{route(RouteConstant::DASHBOARD['order_update'], ['id' => $order->id, 'type' => 'shipping'])}}" style="color: white;font-weight: bold">Vận chuyển</a>
                    </button>

                </div>
            <button class="primary-btn order-submit" type="submit">
                <a href="{{route(RouteConstant::DASHBOARD['order_list'])}}" style="color: white;font-weight: bold">Trở về</a></button>

            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@endsection
