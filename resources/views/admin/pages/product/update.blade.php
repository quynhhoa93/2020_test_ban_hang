@extends('admin.layouts.master')
@section('title')
    sua san pham
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
                                    <form role="form" action="{{route('admin.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ten san pham</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="name" value="{{$product->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">danh muc san pham</label>
                                            <select class="form-control input-sm m-bot15" name="category_id">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($category->id === $product->category_id)selected @endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">thuong hieu san pham</label>
                                            <select class="form-control input-sm m-bot15" name="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" @if($brand->id == $product->brand_id)selected @endif>{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">mieu ta san pham</label>
                                            <textarea type="text" class="form-control"  id="summary-ckeditor" placeholder="Enter email" name="description">{!! $product->description !!}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Gia san pham</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="price" value="{{$product->price}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Anh san pham</label>
                                            <input type="hidden" name="current_image" value="{{$product->image}}">
                                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="image">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hien thi</label>
                                            <select class="form-control input-sm m-bot15" name="status">
                                                <option value="0" @if($product->status == 0)selected @endif>an</option>
                                                <option value="1"@if($product->status == 1)selected @endif>hien</option>
                                            </select>
                                        </div>


                                        <button type="submit" class="btn btn-info">Them</button>
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

