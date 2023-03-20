@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<h2>Thêm mới sản phẩm</h2>
<div class="card mb-4">
    <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-4">
            <label for="inputName">Tên sản phẩm @if ($errors->has('name'))<p class="text-error">*{{$errors->first('name')}}</p>@endif</label>
            <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{Request::old('name')}}">
        </div>
        <div class="form-group mt-4">
            <label for="inputDescription">Mô tả @if ($errors->has('description'))<p class="text-error">*{{$errors->first('description')}}</p>@endif</label>
            <input type="text" name="description" class="form-control" id="inputDescription" aria-describedby="nameHelp" value={{Request::old('description')}}>
        </div>
        <div class="form-group mt-4">
            <label for="inputDetail">Chi tiết @if ($errors->has('detail'))<p class="text-error">*{{$errors->first('detail')}}</p>@endif</label>
            <input type="text" name="detail" class="form-control" id="inputDetail" aria-describedby="nameHelp" value={{Request::old('detail')}}>
        </div>
        <div class="row">
            <div class="form-group mt-4 col-6">
                <label for="inputPrice">Giá @if ($errors->has('price'))<p class="text-error">*{{$errors->first('price')}}</p>@endif</label>
                <input type="text" name="price" class="form-control" id="inputPrice" aria-describedby="nameHelp" value="{{Request::old('price')}}">
            </div>
            <div class="form-group mt-4 col-6">
                <label for="inputQuantity">Số lượng @if ($errors->has('quantity'))<p class="text-error">*{{$errors->first('quantity')}}</p>@endif</label>
                <input type="text" name="quantity" class="form-control" id="inputQuantity" aria-describedby="nameHelp" value="{{Request::old('quantity')}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group mt-4 col-6">
                <label for="optionCategory">Danh mục @if ($errors->has('category_id'))<p class="text-error">*{{$errors->first('category_id')}}</p>@endif</label>
                <select name="category_id" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{Request::old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-4 col-6">
                <label for="optionCategory">Thương hiệu @if ($errors->has('brand_id'))<p class="text-error">*{{$errors->first('brand_id')}}</p>@endif</label>
                <select name="brand_id" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}" {{Request::old('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group mt-4 col-6">
            <label for="inputImage">Hình ảnh @if ($errors->has('image'))<p class="text-error">*{{$errors->first('image')}}</p>@endif</label>
            <input type="file" name="image" class="form-control" id="inputImage" aria-describedby="nameHelp" value="{{Request::old('image')}}">
        </div>
        <div class="form-group mt-4 row">
            <div class="col-4">
                <label for="optionStatus">Trạng thái @if ($errors->has('status'))<p class="text-error">*{{$errors->first('status')}}</p>@endif</label>
                <select name="status" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
        </div>

        <a href="{{route(RouteConstant::DASHBOARD['product_list'])}}"><input type="text" class="btn btn-secondary" value="Trở về" disabled></a>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
</div>
@if (Session::has('msg'))
    <script>
        swal({title: "{{__('success')}}",text: "{{Session::get('msg')}}", icon: "success",button: "{{__('close')}}",});
    </script>
@endif
@if (Session::has('errMsg'))
    <script>
        swal({title: "{{__('warning')}}",text: "{{Session::get('errMsg')}}", icon: "success",button: "{{__('close')}}",});
    </script>
@endif
@endsection
