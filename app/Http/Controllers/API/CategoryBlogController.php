<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\CategoryBlog;
use App\Http\Resources\CategoryBlog as CategoryBlogResource;
use Illuminate\Support\Str;

class CategoryBlogController extends BaseController
{
    public function index()
    {
        $categoryblogs = CategoryBlog::all();
        return $this->sendResponse(CategoryBlogResource::collection($categoryblogs), 'Category blog fetched.');
    }

    public function store(Request $request){
        // $input = $request->all();
         $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        //  $data = CategoryBlog::create($input);
        $data = new CategoryBlog();
        $data->category = $request->category;
        $data->slug = Str::slug($request->category, '-');
        $data->save();

        return $this->sendResponse(new CategoryBlogResource($data), 'Category blog created.');
        
    }

    public function show($params){
        $data = CategoryBlog::find($params);
        if (is_null($data)) {
            return $this->sendError('Category blog does no exist');
        }

        return $this->sendResponse(new CategoryBlogResource($data), 'Category blog fetched');
    }

    public function update(Request $request, $params){
        // return $CategoryBlog;
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $categoryblog = CategoryBlog::find($params);
        $categoryblog->category = $request->category;
        $categoryblog->slug = Str::slug($request->category, '-');
        $categoryblog->save();

        return $this->sendResponse(new CategoryBlogResource($categoryblog), 'Category blog updated.');
    }

    public function destroy($params){
        // $categoryblog->delete();
        CategoryBlog::find($params)->delete();
        return $this->sendResponse([], 'Category blog deleted');
    }
}
