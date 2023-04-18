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
                        <th>Tên người nhận</th>
                        <th>Địa chỉ người nhận</th>
                        <th>Số điện thoại</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Tổng đơn</th>
                        <th>Ngày mua</th>
                        <th>Xem</th>

                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach($orders as $order)
                        <tr>
                            <td>{{$order->customerName}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->note}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{number_format($order->subTotal) }} Đ</td>
                            <td>{{$order->created_at}}</td>

                            <td align="left"><a
                                    href="{{route('order-details.history',['id' => $order->id])}}">
                                    <i class="fa fa-eye"></i>
                                </a></td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div align="center" class="col-md-12" style="margin: 100px auto;">
                <button  class="btn btn-danger"><a href="{{route('home')}}">Trở về</a></button>
            </div>
        </div>
    </div>
</div>
@endsection