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
                                <th>Ten danh muc san pham</th>
                                <th>trang thai danh muc san pham</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=>$category)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$category->name}}</td>
                                @if($category->status === 0)
                                    <td>An</td>
                                @elseif($category->status === 1)
                                    <td>Hien</td>
                                @endif
                                <td>
                                    <a href="{{route('admin.category.edit',$category->id)}}" class="active" ui-toggle-class="">
                                        <i class="fa fa-check text-success text-active"></i>
                                    </a>
                                    {{--<a href="">--}}
                                        {{--<i class="fa fa-times text-danger text"></i>--}}
                                    {{--</a>--}}

                                    <a type="button"
                                    onclick="deleteCategory({{$category->id}})">
                                    <i class="fa fa-times text-danger text"></i>
                                    </a>
                                    <form id="delete-from-{{$category->id}}"
                                    action="{{route('admin.category.destroy',$category->id)}}"
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
            text:"bạn có chắc muốn xoá danh mục này???",
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
                    'danh mục này vẫn tồn tại',
                    'error'
                )
            }
        })
    }
    </script>

@endpush