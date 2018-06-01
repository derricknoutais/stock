<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

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

        $type = 'ALL';
        return view('products.index', compact('products', 'type'));
    }

    public function search(Request $request)
    {
        $type = $request->input('type');

        $products = ($type == "ALL") ? DB::table('products')->get() : DB::table('products')->where('type', $type)->get();

        return view('products.index', compact('products'));
    }

    public function show($name)
    {
        $product = Product::where('name', $name)->first();
        $stocks = $product->stock;

        return view('products.show', compact('product', 'stocks'));
    }

    public function showProductsCategory($type)
    {
        $products = Product::where('type', $type)->get();

        return view('products.index', compact('products', 'type'));
    }

    public function getProductInfo($id){

        $product =  Product::find($id);

        return $product->cost;
    }
    
}
