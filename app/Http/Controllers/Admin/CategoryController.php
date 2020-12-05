<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function search(string $key)
    {
        return Category::where('name', 'like', '%' . $key . '%')
            ->withCount('sub_category')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::withCount('sub_category')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'description' => 'required',
        ]);

        Category::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true, 'message' => 'You successfully create a category.'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
        $this->validate($request, [
            'name'        => 'required|unique:categories,name,' . $id,
            'description' => 'required',
            'status' => 'required|in:' . implode(',', Category::$statuses),
        ]);

        $category              = Category::find($id);
        $category->name        = $request->name;
        $category->description = $request->description;
        $category->status      = $request->status;
        $category->save();

        return response()->json(['success' => true, 'message' => 'You successfully update a category'], 202);
    }

    /** 
     * For widgets in adminstrator panel
     */
    public function count(): int
    {
        return Category::count();
    }
}
