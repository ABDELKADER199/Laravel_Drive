<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|min:3|max:20',
            'description'=>'required|string|min:3|max:50'
        ]);
      $category = new Category();
      $category->title = $request->title;
      $category->description = $request->description;
      $category->save();
      return redirect()->back()->with("done", "Create Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id )
    {
        $category = DB::table("categories")->where('id' , '=' , $id)->first();
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table("categories")->where('id' , '=' , $id)->update([
            'title' => $request->title,
            'description' =>$request->description
        ]);
        return redirect()->route('category.index')->with('done','Update Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = DB::table('categories')->where('id' , '=' , $id)->delete();
        return redirect()->route('category.index');
    }
}
