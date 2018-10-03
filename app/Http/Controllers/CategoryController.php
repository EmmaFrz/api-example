<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
    	return Category::orderBy('id','desc')->get();
    	//$category->load('jobs');
    }

    public function store(CreateCategoryRequest $request)
	{
		$category = Category::create([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
		]);

		return $category;
	}

    public function show(Category $category)
    {
    	return $category;
    }

    public function delete(Category $category)
    {
    	$category->delete();
    	return $category;
    }

    public function update(Category $category, Request $request){
    	$category->update($request->all());

    	return response()->json($category,201);
    }
}
