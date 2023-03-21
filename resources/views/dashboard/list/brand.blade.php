@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h3 align="center" style="text-shadow: 1px 1px 2px grey;">{{__('brand_list')}}</h3>
                <a href="{{route(RouteConstant::DASHBOARD['brand_create'])}}">
                    <button class="btn btn-primary" style="float: right;">{{__('create')}}</button>
                </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9"><b>{{__('brand_name')}}</b></th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9 ps-2"><b>{{__('brand_description')}}</b></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9"><b>{{__('status')}}</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $item)
                        <tr class="tb-row" onclick="handleClickRow({{$item->id}})">
                            <td>
                                <div class="px-2 py-1">
                                    <div class="flex-column justify-content-center">
                                        <h6 class="mb-0">{{$item->name}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">
                                    {{$item->description}}
                                </p>
                            </td>
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
    {{-- {!! $products->links("pagination::bootstrap-4") !!} --}}
</div>
<script>
    function handleClickRow(id) {
        var url = '{{ route("dashboard.brand.update") }}' + '?id=' + id;
        location.replace(url);
    }
</script>
@endsection
