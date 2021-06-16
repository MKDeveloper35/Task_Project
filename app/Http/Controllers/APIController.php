<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class APIController extends Controller
{


    //-- Home Page API
    public function index(){

        $TYPE = "month"; //-- Dummy Rent Type

        //--Our Categories List
        //--I Just get Category List Without any Condition
        $categories = Category::all();

        //--Trending Products List
        //-- Without any Condition (Most selling etc)
        //--Add Limit here
        $products   = Product::limit(4)->get();


        //-- I'm adding image path here to easy rendering in frontend
        $CategoryList = $categories->map(function($data) {
            return[
                'id'    => $data->id,
                'name'  => $data->name,
                'image' => asset('upload/category/'.$data->image), //Image path
            ];
        });


        //-- I'm adding image path here to easy rendering in frontend
        //-- Adding few columns in list
        $ProductList = $products->map(function($data) use ($TYPE) {
            return[
                'id'    => $data->id,
                'name'  => $data->name,
                'rent'  => $data->rent.'/'.$TYPE,
                'image' => asset('upload/product/'.$data->image),
            ];
        });


        //-- Return Response
        return response()->json([
            'categories' => $CategoryList,
            'products'   => $ProductList,
            'success'    => true,
            'status'     => 200
        ]);
    }



    //--Get Product By ID
    public function GetProduct($id){

        if($Getproduct = Product::find($id)){

            $TYPE = "month"; //-- Dummy Rent Type

            //--Option 1
            //return response()->json([$Getproduct,200]);

            //--Option 2

            $product = [
                    'id'        => $Getproduct->id,
                    'name'      => $Getproduct->name,
                    'category'  => $Getproduct->productCategory->name,
                    'rent'      => $Getproduct->rent.'/'.$TYPE,
                    'image'     => asset('upload/product/'.$Getproduct->image),
                    'deposit'   => $Getproduct->deposit,
                    'size'      => $Getproduct->size,
                    'details'   => $Getproduct->details,
                    ];

            return response()->json([$product,200]);

        }else{
            return response()->json([
                'success'    => false,
                'status'     => 404
            ]);
        }
    }
}
