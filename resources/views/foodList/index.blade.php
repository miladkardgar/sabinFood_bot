@extends('layout.master')
@section('title','منو غذا')
@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">منو غذا</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('foodList.create')}}" class="btn btn-primary">افزودن غذا</a>
            </div>
        </div>
    </div>


    <h2>لیست</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام غذا</th>
                <th>توضیحات</th>
                <th>قیمت (تومان)</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lists as $list)
                <tr>
                    <td>{{$list['id']}}</td>
                    <td>{{$list['title']}}</td>
                    <td>{{$list['description']}}</td>
                    <td>{{$list['price']}}</td>
                    <td>{{$list['status']}}</td>
                    <td>
                        <a class="btn btn-sm" href="{{route('foodList.destroy',['id'=>$list['id']])}}"><i class="fa fa-trash"></i></a>
                        <a class="btn btn-sm" href="{{route('foodList.edit',['id'=>$list['id']])}}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
