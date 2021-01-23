<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($category,$product_id){
        $item = Product::where('id',$product_id)->first();

        return view('products.show',[
            'item' => $item
        ]);
    }
    public function showCategory(Request $request, $category_alias){

        $category = Category::where('alias',$category_alias)->first();
        // $paganate = 2;

        // $products = Product::where('category_id',$category->id)->paginate($paganate);

        $products = Product::where('category_id',$category->id)->get();
        // if(isset($request->orderBy)){
        //     if($request->orderBy == 'prise-low-high'){
        //         $products = Product::where('category_id',$category->id)->orderBy('price')->get();
        //     }
        // }

        if($request->ajax()){
            return view('ajax.order-by',[
                'products' => $products
            ])->render();
        }

        return view('categories.index',[
            'category' => $category,
            'products' => $products
        ]);
    }
}
