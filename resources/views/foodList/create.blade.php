@extends('layout.master')
@section('title','افزودن غذا')
@section('body')
    <form action="{{route('foodList.store')}}" method="post">
        @csrf
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">افزودن غذا</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{route('foodList.index')}}" class="btn btn-outline-dark px-3 m-1">انصراف</a>
                <button type="submit" class="btn btn-success px-3  m-1">افزودن</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4 form-group">
                    <label for="title">نام غذا</label>
                    <input type="text" class="form-control" value="{{old('title')}}" required name="title" id="title">
                </div>
                <div class="col-4 form-group">
                    <label for="price">قیمت <small>(تومان)</small></label>
                    <input type="text" class="form-control" value="{{old('price')}}" name="price" id="price">
                </div>
                <div class="col-4 form-group">
                    <label for="status">وضعیت</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>انتخاب نمایید.</option>
                        <option value="1">فعال</option>
                        <option value="0">غیر فعال</option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label for="description">توضیحات</label>
                    <textarea name="description" class="form-control" id="description" cols="30"
                              rows="10">{{old('description')}}</textarea>
                </div>
                @include('errors')
            </div>
        </div>
    </form>
@endsection
@push('script')
    <script>
        $('#price').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
            });
        });
    </script>
@endpush