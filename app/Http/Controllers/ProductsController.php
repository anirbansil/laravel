<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    //
    public function index()
    {
        $productlist = Products::orderBy('product_id', 'asc')->get();
        return view('products', compact('productlist'));
    }

    
    public function new()
    {
        return view('new_product');
    }


    public function store(Request $request)
    {
        $filepath = "";
        if($request->hasFile('product_image')){
            $image = $request->product_image;
            $filename = time()."-blueberry-product.".$image->getClientOriginalExtension();
            $filepath = $request->product_image->move('uploads',$filename);
        }

        $product = [];
        $product['product_name'] = $request->product_name;
        $product['product_price'] = $request->product_price;
        $product['product_image'] = $filepath;
        $product['product_stock'] = $request->product_stock;

        Products::insert($product);
        
        return response()->json(['success'=>true, 'message'=>'Product successfully added']);
    }
    
    
    public function edit($id)
    {
        $productData = Products::find($id);
        return view('edit_product', compact('productData'));
    }


    public function update(Request $request)
    {

        // dd($request->all());

        $product = Products::findOrFail($request->product_id);
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $filepath = "";
        if($request->hasFile('product_image')){
            $image = $request->product_image;
            $filename = time()."-blueberry-product.".$image->getClientOriginalExtension();
            $filepath = $request->product_image->move('uploads',$filename);
            $product->product_image = $filepath;
        }
        $product->product_stock = $request->product_stock;
        $product->save();
        
        return response()->json(['success'=>true, 'message'=>'Product successfully updated']);
    }


    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return response()->json(['success'=>true, 'message' => 'Product successfully deleted']);
    }
}
