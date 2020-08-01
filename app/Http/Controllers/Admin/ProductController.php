<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Intervention\Image\ImageManagerStatic as Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = DB::table('categories')->where('status','=',1)->get();
        $brands = DB::table('brands')->where('status','=',1)->get();
        return view('admin.pages.product.index',compact('categories','brands','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->where('status','=',1)->get();
        $brands = DB::table('brands')->where('status','=',1)->get();
        return view('admin.pages.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;

        if ($request->hasFile('image')){
            $image_tmp = Input::file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $large_image_path = 'backend/images/products/large/'.$filename;
                $medium_image_path = 'backend/images/products/medium/'.$filename;
                $small_image_path = 'backend/images/products/small/'.$filename;

                Image::make($image_tmp) ->save($large_image_path);
                Image::make($image_tmp) ->resize(600,600)->save($medium_image_path);
                Image::make($image_tmp) ->resize(300,300)->save($small_image_path);

                $product->image = $filename;
            }
        }

        $product->save();

        Toastr::success('đã thêm thành công một san pham' ,'Success');
        return redirect()->route('admin.product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = DB::table('categories')->where('status','=',1)->get();
        $brands = DB::table('brands')->where('status','=',1)->get();
        return view('admin.pages.product.update',compact('categories','brands','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;

        if ($request->hasFile('image')){
            $image_tmp = Input::file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $large_image_path = 'backend/images/products/large/'.$filename;
                $medium_image_path = 'backend/images/products/medium/'.$filename;
                $small_image_path = 'backend/images/products/small/'.$filename;

                Image::make($image_tmp) ->save($large_image_path);
                Image::make($image_tmp) ->resize(600,600)->save($medium_image_path);
                Image::make($image_tmp) ->resize(300,300)->save($small_image_path);

                //xoa anh cu
                $large_image_path = 'backend/images/products/large/';
                $medium_image_path = 'backend/images/products/medium/';
                $small_image_path = 'backend/images/products/small/';
                if (file_exists($large_image_path.$product->image)){
                    unlink($large_image_path.$product->image);
                    unlink($medium_image_path.$product->image);
                    unlink($small_image_path.$product->image);
                }
            }
        } else{
            $filename = $request->current_image;
        }

        $product->image = $filename;

        $product->save();
        Toastr::success('đã xua thành công một san pham' ,'Success');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $large_image_path = 'backend/images/products/large/';
        $medium_image_path = 'backend/images/products/medium/';
        $small_image_path = 'backend/images/products/small/';
        if (file_exists($large_image_path.$product->image)){
            unlink($large_image_path.$product->image);
            unlink($medium_image_path.$product->image);
            unlink($small_image_path.$product->image);
        }

        $product->delete();
        Toastr::warning('da xoa 1 san pham','canh bao');
        return redirect()->back();
    }
}
