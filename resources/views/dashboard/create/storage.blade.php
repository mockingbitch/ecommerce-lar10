@php
use App\Constants\RouteConstant;
use App\Constants\ColorConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<h2>{{__('storage_create')}}: <h3>{{$productModel->name}}</h3></h2>
<div class="card mb-4">
    <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-4 row">
            <div class="col-6">
                <label for="optionColor">{{__('color')}} @if ($errors->has('color'))<p class="text-error">*{{$errors->first('color')}}</p>@endif</label>
                <select name="color" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    @foreach (ColorConstant::COLOR as $color)
                        <option value="{{array_search($color, ColorConstant::COLOR)}}">{{$color}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="inputRam">{{__('ram')}} @if ($errors->has('ram'))<p class="text-error">*{{$errors->first('ram')}}</p>@endif</label>
                <input type="text" name="ram" class="form-control" id="inputRam" aria-describedby="nameHelp" value={{Request::old('ram')}}>
            </div>
        </div>
        <div class="row">
            <div class="form-group mt-4 col-6">
                <label for="inputPrice">{{__('price')}} @if ($errors->has('price'))<p class="text-error">*{{$errors->first('price')}}</p>@endif</label>
                <input type="text" name="price" class="form-control" id="inputPrice" aria-describedby="nameHelp" value="{{Request::old('price')}}">
            </div>
            <div class="form-group mt-4 col-6">
                <label for="inputQuantity">{{__('quantity')}} @if ($errors->has('quantity'))<p class="text-error">*{{$errors->first('quantity')}}</p>@endif</label>
                <input type="text" name="quantity" class="form-control" id="inputQuantity" aria-describedby="nameHelp" value="{{Request::old('quantity')}}">
            </div>
        </div>
        <div class="form-group mt-4 col-6">
            <label for="inputImage">{{__('image')}} @if ($errors->has('image'))<p class="text-error">*{{$errors->first('image')}}</p>@endif</label>
            <input type="file" name="image" class="form-control" id="inputImage" aria-describedby="nameHelp" value="{{Request::old('image')}}">
        </div>
        <div class="form-group mt-4 row">
            <div class="col-4">
                <label for="optionStatus">{{__('status')}} @if ($errors->has('status'))<p class="text-error">*{{$errors->first('status')}}</p>@endif</label>
                <select name="status" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option value="1">{{__('display')}}</option>
                    <option value="0">{{__('hide')}}</option>
                </select>
            </div>
        </div>

        <a class="btn btn-secondary" href="{{route(RouteConstant::DASHBOARD['storage_list'], ['model' => $productModel->id])}}">{{__('back')}}</a>
        <button type="submit" class="btn btn-primary">{{__('create')}}</button>
    </form>
</div>
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
@endsection
