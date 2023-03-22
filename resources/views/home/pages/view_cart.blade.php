@extends('layouts.homeLayout')
@section('content')
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12" id="list-cart">
                <!-- Shopping Summery -->
                @if(isset($carts)&& count($carts)>0)
                @php
                $subtotal = 0;
                @endphp
                <table class="table shopping-summery cart-change">
                    <thead>
                    <tr class="main-hading">
                        <th></th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Đơn giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Tổng</th>
                        <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <td><button class="delete" onclick="removeCart({{$cart['id']}})"><i class="fa fa-close"></i></button></td>
                        <td class="image" data-title="No"><img width="100px" src="{{asset('uploads/product/'.$cart['productImage'])}}" alt="#"></td>
                        <td class="product-des" data-title="Description">
                            <p class="product-name"><a href="#">{{$cart['productName']}}</a></p>

                        </td>
                        <td align="center" class="price" data-title="Price"><span>{{number_format($cart['productPrice'])}} Đ </span></td>
                        <td class="qty" data-title="Qty" align="center"><!-- Input Order -->
                            <div class="input-group sm">
                                <input onchange="updateCart({{$cart['id']}})" id="quantity_{{$cart['id']}}" type="number" name="quant[1]" class="input-number sm"    min="1" value="{{$cart['quantity']}}">
                            </div>
                            <!--/ End Input Order -->
                        </td>
                        <td align="center" class="total-amount" data-title="Total"><span>
                                @php
                                $total = $cart['quantity']*$cart['productPrice'];
                                echo number_format($total,0,',','.');
                                @endphp Đ</span></td>
                        <td align="center" class="action" data-title="Remove"><a href="#" onclick="removeCart({{$cart['id']}})"><i class="ti-trash remove-icon"></i></a></td>
                    </tr>
                    @php $subtotal+= $total; @endphp
                    @endforeach
                    </tbody>
                </table>
                @else
                <h2>Chưa có sản phẩm nào trong giỏ hàng. Vui lòng thêm sản phẩm!!!</h2>
                <h3><a href="{{route('home')}}">Quay trở lại mua sắm</a></h3>
            @endif
            <!--/ End Shopping Summery -->
            </div>
        </div>
        <hr>
        @if(isset($carts) && count($carts) > 0)
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <button class="btn">Apply</button>
                                    </form>
                                </div>
                                <div class="checkbox">
                                    {{-- <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7 col-12" id="sub" >
                            <div class="right sub-change" >
                                <ul>
                                    <li><h4 >Thành tiền: <span>@php if(isset($subtotal)) echo  number_format($subtotal,0,',','.') @endphp Đ</span></h4></li>
                                    <li>Vận chuyển:<span>Free</span></li>
                                    Tổng: &emsp; &emsp; <span style="color: red;font-size: 30px;font-weight: bold">@php if(isset($subtotal)) echo number_format($subtotal,0,',','.') @endphp Đ</span>
                                    <li class="last"></li>
                                </ul>
                                <div class="button5">
                                    <div class="row">
                                        <button class="btn btn-danger col-md-5"><a href="{{route('check-out')}}" class="btn"><h4>Thanh toán</h4></a></button>
                                        <button style="margin-left: 10px" class="btn btn-default col-md-5"><a href="{{route('home')}}" class="btn"><h4>Tiếp tục mua</h4></a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
        @endif
    </div>
</div>
<script>
    function updateCart(id){
        sl = $("#quantity_"+id).val();
        $.get("{{route('update-cart') }}",{"id":id,"quantity":sl},function(data){
                $("#list-cart").load("{{ route('view-cart') }} .cart-change");
                $("#sub").load("{{ route('view-cart') }} .sub-change");
        });
    }
    function removeCart(id){
        $.get("{{route('remove-cart')}}",{"id":id},function(data){
            $("#list-cart").load("{{ route('view-cart') }} .cart-change");
            $("#sub").load("{{ route('view-cart') }} .sub-change");
        });
    }
</script>
@endsection
