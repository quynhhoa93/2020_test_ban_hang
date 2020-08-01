@extends('admin.layouts.master')
@section('title')
    trang chu
@endsection
@push('css')
@endpush
@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="form-w3layouts">
                <!-- page start-->
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Basic Forms
                            </header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <form role="form" action="{{route('admin.category.update',$category->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ten danh muc</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="name" value="{{$category->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hien thi</label>
                                            <select class="form-control input-sm m-bot15" name="status">
                                                <option value="0"@if($category->status===0)selected @endif>Ẩn</option>
                                                <option value="1"@if($category->status===1)selected @endif>Hiển thị</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-info">sua</button>
                                    </form>
                                </div>

                            </div>
                        </section>

                    </div>
                </div>
                <!-- page end-->
            </div>
        </section>
    </section>

    <!--main content end-->
@endsection
@push('js')
@endpush