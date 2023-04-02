@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<script src="{{asset('dashboard/assets/js/ckeditor.js')}}"></script>
<h2>{{__('product_model_update')}}</h2>
<a class="btn btn-primary" href="{{route(RouteConstant::DASHBOARD['storage_list'], ['model' => $productModel->id])}}">{{__('product_list')}}</a>
<div class="card mb-4">
    <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-4">
            <label for="inputName">{{__('product_model_name')}} @if ($errors->has('name'))<p class="text-error">*{{$errors->first('name')}}</p>@endif</label>
            <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{$productModel->name}}">
        </div>
        <div class="form-group mt-4">
            <label for="inputDescription">{{__('product_model_description')}} @if ($errors->has('description'))<p class="text-error">*{{$errors->first('description')}}</p>@endif</label>
            <input type="text" name="description" class="form-control" id="inputDescription" aria-describedby="nameHelp" value={{$productModel->description}}>
        </div>
        <div class="form-group mt-4">
            <label for="inputContent">{{__('content')}} @if ($errors->has('content'))<p class="text-error">*{{$errors->first('content')}}</p>@endif</label>
            <textarea type="text" name="content" class="form-control" id="inputContent" aria-describedby="nameHelp">{{$productModel->content}}</textarea>
        </div>
        <div class="row">
            <div class="form-group mt-4 col-6">
                <label for="optionCategory">{{__('category_name')}} @if ($errors->has('category_id'))<p class="text-error">*{{$errors->first('category_id')}}</p>@endif</label>
                <select name="category_id" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{$productModel->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-4 col-6">
                <label for="optionCategory">{{__('brand_name')}} @if ($errors->has('brand_id'))<p class="text-error">*{{$errors->first('brand_id')}}</p>@endif</label>
                <select name="brand_id" class="select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}" {{$productModel->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                    @endforeach
                </select>
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
                            <option value="1" {{$productModel->status == 1 ? 'checked' : ''}}>{{__('display')}}</option>
                            <option value="0" {{$productModel->status == 0 ? 'checked' : ''}}>{{__('hide')}}</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="form-group mt-4 col-6">
                <img src="{{asset('upload/images/product_models/' . $productModel->image)}}" alt="">
            </div>
        </div>
        <a class="btn btn-secondary" href="{{route(RouteConstant::DASHBOARD['product_model_list'])}}">{{__('back')}}</a>
        <a class="btn btn-danger"
            onclick="confirmDelete({{$productModel->id}})">
            {{__('delete')}}
        </a>
        <button type="submit" class="btn btn-primary">{{__('update')}}</button>
    </form>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#inputContent' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
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
                $.get("{{route('dashboard.product.model.delete')}}", {"id": id}, function(data) {
                    var url = '{{ route("dashboard.product.model.list") }}';
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
