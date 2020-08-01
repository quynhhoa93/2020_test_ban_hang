@extends('admin.layouts.master')
@section('title')
    trang chu
@endsection
@push('css')
@endpush
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Responsive Table
                    </div>
                    <div class="table-responsive">
                        <table id="table_id" class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Ten san pham</th>
                                <th>trang thai san pham</th>
                                <th>ten danh muc san pham</th>
                                <th>ten thuong hieu san pham</th>
                                <th>mieu ta san pham</th>
                                <th>gia san pham</th>
                                <th>anh san pham</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$product->name}}</td>
                                    @if($product->status === 0)
                                        <td>An</td>
                                    @elseif($product->status === 1)
                                        <td>Hien</td>
                                    @endif
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->brand->name}}</td>
                                    <td>{!! str_limit($product->description, 30) !!}</td>
                                    <td>{{$product->price}}</td>
                                    <td><img src="{{asset('backend/images/products/small/'.$product->image)}}" style="width: 90px;height: 90px"></td>
                                    <td>
                                        <a href="{{route('admin.product.edit',$product->id)}}" class="active" ui-toggle-class="">
                                            <i class="fa fa-check text-success text-active"></i>
                                        </a>

                                        <a type="button"
                                           onclick="deleteCategory({{$product->id}})">
                                            <i class="fa fa-times text-danger text"></i>
                                        </a>
                                        <form id="delete-from-{{$product->id}}"
                                              action="{{route('admin.product.destroy',$product->id)}}"
                                              method="POST"style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>

@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        function deleteCategory(id){
            const swalWithBootstrapButtons=Swal.mixin({
                customClass:{
                    confirmButton:'btnbtn-success',
                    cancelButton:'btnbtn-danger'
                },
                buttonsStyling:false
            })

            swalWithBootstrapButtons.fire({
                title:'xoá danh mục',
                text:"bạn có chắc muốn xoá san pham này???",
                icon:'warning',
                showCancelButton:true,
                confirmButtonText:'có',
                cancelButtonText:'thôi',
                reverseButtons:true
            }).then((result)=>{
                if(result.value){
                    event.preventDefault();
                    document.getElementById('delete-from-'+id).submit();
                }else if(
                    result.dismiss === Swal.DismissReason.cancel
                ){
                    swalWithBootstrapButtons.fire(
                        'cảnh báo',
                        'san pham này vẫn tồn tại',
                        'error'
                    )
                }
            })
        }
    </script>

@endpush