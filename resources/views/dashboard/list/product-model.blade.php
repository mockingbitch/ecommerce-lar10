@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h3 align="center" style="text-shadow: 1px 1px 2px grey;">{{__('product_model_list')}}</h3>
                <a href="{{route(RouteConstant::DASHBOARD['product_model_create'])}}">
                    <button class="btn btn-primary" style="float: right;">{{__('create')}}</button>
                </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9"><b>{{__('product_model_name')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9 ps-2"><b>{{__('price')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><b>{{__('category_name')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><b>{{__('brand_name')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><b>{{__('quantity')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><b>{{__('image')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><b>{{__('status')}}</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productModels as $item)
                        <tr class="tb-row" onclick="handleClickRow({{$item->id}})">
                            <td>
                                <div class="px-2 py-1">
                                    <div class="flex-column justify-content-center">
                                        <h6 class="mb-0">{{mb_strimwidth($item->name, 0, 50, "...");}} </h6>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center">
                                <p class="text-sm font-weight-bold mb-0"">
                                    {{number_format($item->price)}}
                                </p>
                            </td>
                            <td style="text-align: center">
                                <a href="{{route(RouteConstant::DASHBOARD['product_model_list'])}}?category={{$item->category_id}}">
                                    <p class="text-sm font-weight-bold mb-0">
                                        {{$item->category->name}}
                                    </p>
                                </a>
                            </td>
                            <td style="text-align: center">
                                <a href="{{route(RouteConstant::DASHBOARD['product_model_list'])}}?brand={{$item->brand_id}}">
                                    <p class="text-sm font-weight-bold mb-0">
                                        {{$item->brand->name}}
                                    </p>
                                </a>
                            </td>
                            <td style="text-align: center">
                                <p class="text-sm font-weight-bold mb-0"">
                                    {{number_format($item->quantity)}}
                                </p>
                            </td>
                            <td style="text-align: center"><img width="100px" src="{{asset('upload/images/products/' . $item->image)}}" alt="Product Image" /></td>
                            <td style="text-align: center">
                                @if ($item->status == 1)
                                    <i class="far fa-thumbs-up" style="color:green"></i>
                                @else
                                    <i class="far fa-thumbs-down" style="color:red"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>
    {{-- {!! $products->links("pagination::bootstrap-4") !!} --}}
@if (Session::has('msg'))
    <script>
        swal({title: "{{__('success')}}",text: "{{Session::get('msg')}}", icon: "success",button: "{{__('close')}}",});
    </script>
@endif
@if (Session::has('errMsg'))
    <script>
        swal({title: "{{__('warning')}}",text: "{{Session::get('errMsg')}}", icon: "warning",button: "{{__('close')}}",});
    </script>
@endif
</div>
<script>
    function handleClickRow(id) {
        var url = '{{ route("dashboard.product.model.update") }}' + '?id=' + id;
        location.replace(url);
    }
</script>
@endsection
