<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_category = BlogCategory::with(['blog'])->get();
        return response()->json($blog_category, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog_category = new BlogCategory();
        $blog_category->category_name = $request->category_name;
        $blog_category->save();
        $success['success'] = "success add category";

        if ($blog_category) {
            return response()->json($success, 201);
        } else {
            return response()->json(['error' => "error add category"], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog_category = BlogCategory::find($id);
        return response()->json($blog_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog_category = BlogCategory::find($id);
        $blog_category->category_name = $request->category_name;
        $blog_category->save();
        $success['success'] = "success update category";

        if ($blog_category) {
            return response()->json($success, 201);
        } else {
            return response()->json(['error' => "error update category"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_category = BlogCategory::find($id);
        $blog_category->delete();
        return response()->json(['success' => "success delete category"], 200);
    }
}
