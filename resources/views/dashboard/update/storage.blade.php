@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<h2>{{__('storage_list')}}</h2>
<div class="card mb-4">
    <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-4">
            <label for="inputName">{{__('product_name')}} @if ($errors->has('name'))<p class="text-error">*{{$errors->first('name')}}</p>@endif</label>
            <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{$productStorage->name}}">
        </div>
        <div class="form-group mt-4">
            <label for="inputDescription">{{__('product_description')}} @if ($errors->has('description'))<p class="text-error">*{{$errors->first('description')}}</p>@endif</label>
            <input type="text" name="description" class="form-control" id="inputDescription" aria-describedby="nameHelp" value={{$productStorage->description}}>
        </div>
        <div class="form-group mt-4">
            <label for="inputDetail">{{__('detail')}} @if ($errors->has('detail'))<p class="text-error">*{{$errors->first('detail')}}</p>@endif</label>
            <textarea type="text" name="detail" class="form-control" id="inputDetail" aria-describedby="nameHelp">{{$productStorage->detail}}</textarea>
        </div>
        <div class="row">
            <div class="form-group mt-4 col-6">
                <label for="inputPrice">{{__('price')}} @if ($errors->has('price'))<p class="text-error">*{{$errors->first('price')}}</p>@endif</label>
                <input type="text" name="price" class="form-control" id="inputPrice" aria-describedby="nameHelp" value="{{$productStorage->price}}">
            </div>
            <div class="form-group mt-4 col-6">
                <label for="inputQuantity">{{__('quantity')}} @if ($errors->has('quantity'))<p class="text-error">*{{$errors->first('quantity')}}</p>@endif</label>
                <input type="text" name="quantity" class="form-control" id="inputQuantity" aria-describedby="nameHelp" value="{{$productStorage->quantity}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group mt-4 col-6">
                <div class="form-group">
                    <label for="inputImage">{{__('image')}} @if ($errors->has('image'))<p class="text-error">*{{$errors->first('image')}}</p>@endif</label>
                    <input type="file" name="image" class="form-control" id="inputImage" aria-describedby="nameHelp" value="{{Request::old('image')}}">
                </div>
                <div class="form-group">
                    <div class="col-6">
                        <label for="optionStatus">{{__('status')}} @if ($errors->has('status'))<p class="text-error">*{{$errors->first('status')}}</p>@endif</label>
                        <select name="status" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option value="1" {{$productStorage->status == 1 ? 'checked' : ''}}>{{__('display')}}</option>
                            <option value="0" {{$productStorage->status == 0 ? 'checked' : ''}}>{{__('hide')}}</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="form-group mt-4 col-6">
                <img src="{{asset('upload/images/products/' . $productStorage->image)}}" alt="">
            </div>
        </div>
        <a class="btn btn-secondary" href="{{route(RouteConstant::DASHBOARD['storage_list'], ['model' => $productModel->id])}}">{{__('back')}}</a>
        <a class="btn btn-danger"
            onclick="confirmDelete({{$productStorage->id}})">
            {{__('delete')}}
        </a>
        <button type="submit" class="btn btn-primary">{{__('update')}}</button>
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
<script>
    function confirmDelete(id) {
        swal({
            title: "Bạn có muốn xoá mục này?",
            text: "Dữ liệu xoá sẽ không thể khôi phục!",
            icon: "warning",
            buttons: [
                'Huỷ',
                'Xoá'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.get("{{route('dashboard.storage.delete', ['model' => $productModel->id])}}", {"id": id}, function(data) {
                    var url = '{{ route("dashboard.storage.list", ['model' => $productModel->id]) }}';
                    swal({
                        title: 'Đã xoá!',
                        text: 'Xoá thành công mục này!',
                        icon: 'success'
                    }).then(function() {
                        setTimeout(() => {
                            location.replace(url)
                        }, 500);
                    });
                });
            } else {
                swal("Huỷ", "Dữ liệu của bạn vẫn an toàn :)", "error");
            }
        })
    }
</script>
@endsection
