<?php

namespace App\Http\Controllers\Client;

use App\Product;
use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home(){
        $categories = DB::table('categories')->where('status','=','1')->orderByDesc('id')->get();
        $brands = DB::table('brands')->where('status','=','1')->orderByDesc('id')->get();
        $products = DB::table('products')->where('status','=','1')->orderByDesc('id')->get();
        return view('client.pages.index',compact('categories','brands','products'));
    }

    public function getCategory($category_id){
        $categories = DB::table('categories')->where('status','=','1')->orderByDesc('id')->get();
        $brands = DB::table('brands')->where('status','=','1')->orderByDesc('id')->get();
        $products = Product::where(['category_id'=>$category_id])->get();
//        $products = DB::table('products')->join('categories','products.category_id','=','categories.id')->where('products.category_id',$id);


        return view('client.pages.get_category',compact('categories','brands','products'));
    }

    public function getBrand($brand_id){
        $categories = DB::table('categories')->where('status','=','1')->orderByDesc('id')->get();
        $brands = DB::table('brands')->where('status','=','1')->orderByDesc('id')->get();
        $products = Product::where(['brand_id'=>$brand_id])->get();
        return view('client.pages.get_brand',compact('categories','brands','products'));
    }

    public function productDetails($id){
        $categories = DB::table('categories')->where('status','=','1')->orderByDesc('id')->get();
        $brands = DB::table('brands')->where('status','=','1')->orderByDesc('id')->get();
        $product = Product::find($id);
        return view('client.pages.product_details',compact('categories','brands','product'));
    }

    public function loginClient(){
        return view('client.pages.login_client');
    }

    public function cart(){
        return view('client.pages.cart');
    }

    public function postSaveProduct(Request $request){
        $productId = $request->product_id_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('products')->where('id',$productId)->first();

        $data['id'] = $product_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = '0';
        $data['options']['image'] = $product_info->image;
        Cart::add($data);

        return redirect()->route('cart');
    }

    public function updateCartQty(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return redirect()->route('cart');

    }

    public function deleteCart($rowId){
        Cart::update($rowId,0);
        return redirect()->route('cart');
    }
}
