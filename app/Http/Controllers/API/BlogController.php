<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Blog;
use Validator;
use App\Http\Resources\Blog as BlogResources;
class BlogController extends BaseController
{
    public function index(){
        $blog = Blog::latest()->get();
        return $this->sendResponse(BlogResources::collection($blog),'Blog Fetched Success');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_blog' => 'required',
            'title' => 'required',
            'date' => 'required|date',
            'body' => 'required|string'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $blog = Blog::create([
            'id_category_blog' => $request->category_blog,
            'title' => $request->title,
            'date'=> $request->date,
            'body' => $request->body
        ]);

        return $this->sendResponse(new BlogResources($blog),'Blog stores Success');
    }

    public function show($params){
        $blog = Blog::find($params);
        return $this->sendResponse(new BlogResources($blog), 'Blog Show Success');
    }

    public function update(Request $request, $params){
        $validator = Validator::make($request->all(), [
            'category_blog' => 'required',
            'title' => 'required',
            'date' => 'required|date',
            'body' => 'required|string'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $blog = Blog::find($params);
        $blog->id_category_blog = $request->category_blog;
        $blog->title = $request->title;
        $blog->date = $request->date;
        $blog->body = $request->body;
        $blog->save();
        // $blog = Blog::where('id', $params)
        // ->update([
        //     'id_category_blog' => $request->category_blog,
        //     'title' => $request->title,
        //     'date'=> $request->date,
        //     'body' => $request->body
        // ]);

        return $this->sendResponse(new BlogResources($blog), 'Blog Updated success');
    }
    
    public function destroy($params){
        $data = Blog::where('id',$params)->first();
        $data->delete();

        return $this->sendResponse([], 'Blog deleted success');
    }
}
