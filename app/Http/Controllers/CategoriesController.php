<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories= Category::orderBy('created_at','desc')->simplePaginate(10);
        return view('categories.index')->with('categories',$categories);
    }

    public function create()
    {
        return view('categories.createcategory');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        
        
            
        $category = new Category();
        $category->user_id = auth()->user()->id;
        $category->name = $request->name;
        $category->save();
        return redirect('/category')->with('success','Category Created');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show')->with('category',$category);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect('/category')->with('success','Category Updated');
        //return 'updated';
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category -> delete();
        return redirect('/categories')->with('success','Category Deleted Successfully');
        //return 'Deleted Successfully';
    }
}
