<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function search(string $key)
    {
        return SubCategory::where('name', 'like', '%' . $key . '%')
            ->with(['category' => function ($query) {
                $query->select('id', 'name', 'status');
            }])->select(['id', 'category_id', 'name', 'description', 'status', 'created_at'])
            ->withCount('items')
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
        return SubCategory::with(['category' => function ($query) {
            $query->select('id', 'name', 'status');
        }])->select(['id', 'category_id', 'name', 'description', 'status', 'created_at'])
            ->withCount('items')
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
        $categories = Category::get(['id', 'name']);
        return view('admin.sub_categories.create', compact('categories'));
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
            'name'        => 'required|unique:sub_categories',
            'category_id' => 'required|exists:App\Models\Category,id',
            'description' => 'required'
        ], [], ['category_id' => 'category']);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true, 'message' => 'You successfully create a sub-category.'], 201);
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
        $categories = Category::get(['id', 'name']);
        $sub_category = SubCategory::with('category')->find($id);

        return view('admin.sub_categories.edit', compact('sub_category', 'categories'));
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
            'name'        => 'required|unique:sub_categories,name,' . $id,
            'category_id' => 'required|exists:App\Models\Category,id',
            'description' => 'required',
            'status'      => 'required|in:' . implode(',', SubCategory::$statuses)
        ], [], ['category_id' => 'category']);

        $subCategory              = SubCategory::find($id);
        $subCategory->name        = $request->name;
        $subCategory->description = $request->description;
        $subCategory->category_id = $request->category_id;
        $subCategory->status      = $request->status;
        $subCategory->save();

        return response()->json(['success' => true, 'message' => 'You successfully update a sub-category.'], 202);
    }

    /**
     * For widgets in adminstrator panel
     */
    public function count(): int
    {
        return SubCategory::count();
    }
}
