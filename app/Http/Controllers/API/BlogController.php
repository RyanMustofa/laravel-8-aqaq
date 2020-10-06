<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::with(['blogCategory'])->get();
        return response()->json($blog, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cover = $request->cover;
        $path_cover = "";
        $slug = $request->slug;

        if ($cover == null) {
            $path_cover = "";
        } else {
            $path_cover =
                "Photo-user" . date('dmyhis') . $cover->getClientOriginalName();
            $cover->move('image/blog/cover', $path_cover);
        }
        $blog = new Blog();
        $blog->user_id = $request->user_id;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->cover = "image/blog/cover/" . $path_cover;
        $blog->status = $request->status;
        $blog->slug = $slug;
        $blog->save();
        $success['success'] = "success add a new blog";
        if ($blog) {
            return response()->json($success, 201);
        } else {
            return response()->json(["error" => "error add blog"], 400);
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
        $blog = Blog::find($id);
        return response()->json($blog, 200);
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
        $cover = $request->cover;
        $path_cover = "";
        $slug = $request->slug;

        if ($cover == null) {
            $path_cover = "";
        } else {
            $path_cover =
                "Photo-user" . date('dmyhis') . $cover->getClientOriginalName();
            $cover->move('image/blog/cover', $path_cover);
        }
        $blog = Blog::find($id);
        $blog->user_id = $request->user_id;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->cover = "image/blog/cover/" . $path_cover;
        $blog->status = $request->status;
        $blog->slug = $slug;
        $blog->save();
        $success['success'] = "success add blog";

        if ($blog) {
            return response()->json($success, 201);
        } else {
            return response()->json(['error' => "error update blog"], 400);
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
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json(['success' => 'success delete'], 200);
    }
}
