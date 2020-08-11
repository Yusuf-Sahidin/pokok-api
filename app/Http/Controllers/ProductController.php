<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductResourceCollection;

class ProductController extends Controller
{
    //
    public function index(){
        // $products = DB::select('select * from products');
        // return $products;
        $criteria = Product::paginate(4);
        return new ProductResourceCollection($criteria);
    }

    public function view($id){
        // $product = DB::select('select * from products where id = :id', [
        //     'id' => $id
        // ]);
        $product = new ProductResource(Product::find($id));
        return $product;
    }

    public function top($count){
        $criteria = Product::select('*')
            -> orderBy('name', 'DESC')
            -> limit($count)
            -> get();
        return new ProductResourceCollection($criteria);
    }

    public function slug($slug){
        $criteria = Product::where('slug', $slug) -> first();
        return new ProductResource($criteria);
    }

    public function search($keyword){
        $criteria = Product::select('*')
            -> where('name', 'LIKE', "%".$keyword."%")
            -> orderBy('name', 'DESC')
            -> get();
        return new ProductResourceCollection($criteria);
    }
}
