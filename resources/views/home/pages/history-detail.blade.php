@php
    use App\Constants\RouteConstant;
@endphp

@extends('layouts.homeLayout')
@section('content')
<div class="section">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 align="center" style="text-shadow: 1px 1px 5px grey; margin: 50px">Lịch sử mua hàng</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Hình ảnh sản phẩm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails as $order)
                        <tr>
                            <td>{{$order->productName}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{number_format($order->productPrice)}}</td>
                            <td>{{number_format($order->total)}}</td>
                            <td><img width="150px" src="{{asset('uploads/product/'.$order->productImage)}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div align="center" class="col-md-12" style="margin: 100px auto;">
                <button  class="btn btn-danger"><a href="{{route('history.index')}}">Trở về</a></button>
                <button  class="btn btn-primary"><a href="?pdf=true">In hoá đơn</a></button>
            </div>
        </div>
    </div>
</div>
@endsection