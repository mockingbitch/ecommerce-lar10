@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Danh sách đơn hàng</h3>
            <span>
                @if(isset($msg))
                    echo {{$msg}}
                    @endif
            </span>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Ngày đặt đơn</th>
                    <th>Tổng đơn</th>
                    <th>Xem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>@if($order->status == 0)
                                <span style="color: red">Chưa xử lý</span>
                            @elseif($order->status == 1)
                                <span style="color: blue">Đã xác nhận, chờ vận chuyển</span>
                            @else
                                <span style="color: green">Đã giao</span>
                            @endif
                        </td>
                        <td>{{$order->created_at->format('h:m:s-d/m/Y')}}</td>
                        <td>{{number_format($order->subTotal)}}</td>
                        <td align="left"><a
                                            href="{{route(RouteConstant::DASHBOARD['order_detail'], ['id' => $order->id])}}">
                                <i class="fas fa-eye"></i>
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
