<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('id', 'desc')->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required',
            'rent'=>'required',
            'deposit'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);


        $product=new Product();
        if($validate==true){

            if($request->hasFile('image')){

                $image = $request->file('image');
                $ReName_image ='Product'.time().'.' . $image->getClientOriginalExtension();
                $image ->move(public_path('upload/product/'), $ReName_image);
                $product->image = $ReName_image;

            }

            $product->category_id  = $request->category;
            $product->name         = $request->name;
            $product->rent         = $request->rent;
            $product->deposit      = $request->deposit;
            $product->size         = json_encode($request->size);
            $product->details      = $request->details;

            if($product->save()){
                return redirect()->route('product.index')->with('done','Product has been inserted successfully');
            }else{
                return back()->with('deny','Something went wrong');
            }
        }else{
            return back()->with('deny','Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        $categories = Category::all();
        if($product){
            return view('admin.product.show',compact('product','categories'));
        }else{
            return back()->with('deny','Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categories = Category::all();
        if($product){
            return view('admin.product.edit',compact('product','categories'));
        }else{
            return back()->with('deny','Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate=$request->validate([
            'name'=>'required',
            'rent'=>'required',
            'deposit'=>'required',
        ]);


        $product=Product::findOrFail($id);
        if($validate==true){

            if($request->hasFile('image')){

                $image = $request->file('image');
                $ReName_image ='Product'.time().'.' . $image->getClientOriginalExtension();
                $image ->move(public_path('upload/product/'), $ReName_image);
                $product->image = $ReName_image;

            }

            $product->category_id  = $request->category;
            $product->name         = $request->name;
            $product->rent         = $request->rent;
            $product->deposit      = $request->deposit;
            $product->size         = json_encode($request->size);
            $product->details      = $request->details;

            if($product->update()){
                return redirect()->route('product.index')->with('done','Product has been Update successfully');
            }else{
                return back()->with('deny','Something went wrong');
            }
        }else{
            return back()->with('deny','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);

        if($product->delete()){
            return back()->with('done','Product has been deleted successfully');
        }else{
            return back()->with('deny','Something went wrong');
        }

    }
}
