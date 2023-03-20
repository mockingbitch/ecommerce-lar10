@php
use App\Constants\RouteConstant;
@endphp

@extends('layouts.dashboardLayout')
@section('content')
<h2>Cập nhật danh mục</h2>
<a href="{{route(RouteConstant::DASHBOARD['category_list'])}}" class="btn btn-secondary">Trở về</a>

<div class="card mb-4">
    <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-4">
            <label for="inputName">Tên danh mục @if ($errors->has('name'))<p class="text-error">*{{$errors->first('name')}}</p>@endif</label>
            <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{$category->name}}">
        </div>
        <div class="form-group mt-4">
            <label for="inputDescription">Mô tả @if ($errors->has('description'))<p class="text-error">*{{$errors->first('description')}}</p>@endif</label>
            <input type="text" name="description" class="form-control" id="inputDescription" aria-describedby="nameHelp" value="{{$category->description}}">
        </div>
        <div class="form-group mt-4">
            <label for="optionStatus">Trạng thái @if ($errors->has('status'))<p class="text-error">*{{$errors->first('status')}}</p>@endif</label>
            <select name="status" id="optionStatus" style="width: 50%; height: 50px;" class="select form-control mb-3" aria-label=".form-select-lg example">
                <option value="1" {{$category->status == 1 ? 'selected' : ''}}>Hiển thị</option>
                <option value="0" {{$category->status == 0 ? 'selected' : ''}}>Ẩn</option>
            </select>
        </div>
        <br>
        <a class="btn btn-danger"
            onclick="confirmDelete({{$category->id}})">
            <i class="far fa-trash-alt"></i>
        </a>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@if (Session::has('msg'))
    <script>
        swal({title:"{{__('success')}}", text:"{{Session::get('msg')}}", icon:"success", button:"{{__('close')}}",});
    </script>
@endif
@if (Session::has('errMsg'))
    <script>
        swal({title:"{{__('warning')}}", text:"{{Session::get('errMsg')}}", icon:"success", button:"{{__('close')}}",});
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
                $.get("{{route('dashboard.category.delete')}}", {"id": id}, function(data) {
                    var url = '{{ route("dashboard.category.list") }}';
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
