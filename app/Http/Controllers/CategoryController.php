<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $categories=Category::orderBy('id', 'desc')->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.category.create');
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
            'about'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);


        $category=new Category();
        if($validate==true){

            if($request->hasFile('image')){

                $image = $request->file('image');
                $ReName_image ='Category_'.time().'.' . $image->getClientOriginalExtension();
                $image ->move(public_path('upload/category/'), $ReName_image);
                $category->image = $ReName_image;

            }

            $category->name         = $request->name;
            $category->about        = $request->about;

            if($category->save()){
                return redirect()->route('category.index')->with('done','Category has been inserted successfully');
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::find($id);
        if($category){
            return view('admin.category.show',compact('category'));
        }else{
            return back()->with('deny','Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        if($category){
            return view('admin.category.edit',compact('category'));
        }else{
            return back()->with('deny','Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validate=$request->validate([
            'name'=>'required',
            'about'=>'required',
        ]);


        $category=Category::find($id);
        if($validate==true){

            if($request->hasFile('image')){

                $image = $request->file('image');
                $ReName_image ='Category_'.time().'.' . $image->getClientOriginalExtension();
                $image ->move(public_path('upload/category/'), $ReName_image);
                $category->image = $ReName_image;

            }

            $category->name         = $request->name;
            $category->about        = $request->about;

            if($category->update()){
                return redirect()->route('category.index')->with('done','Category has been Updated successfully');
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);

                if($category->delete()){
                    return back()->with('done','Category has been deleted successfully');
                }else{
                    return back()->with('deny','Something went wrong');
                }

    }

}
