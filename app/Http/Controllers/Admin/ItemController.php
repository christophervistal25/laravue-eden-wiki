<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function search(string $key)
    {
        return Item::where('name', 'like', '%' . $key . '%')
            ->with(['sub_category:id,name,category_id', 'sub_category.category:id,name'])
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
    }

    public function items()
    {
        return Item::with(['sub_category:id,name,category_id', 'sub_category.category:id,name'])
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = SubCategory::with('category')
            ->get(['id', 'name', 'category_id']);
        return view('admin.items.create', compact('sub_categories'));
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
            'name'            => 'required',
            'description'     => 'required',
            'sub_category_id' => 'required|exists:App\Models\SubCategory,id',
            'icon'            => 'required',
        ], [], ['sub_category_id' => 'category / sub - category']);

        $destination = rtrim(app()->basePath('public/images'), '/');
        $name        = $request->file('icon')->getClientOriginalName();
        $request->file('icon')->move($destination, $name);

        $record = Item::create([
            'name'            => $request->name,
            'description'     => $request->description,
            'gender'          => $request->gender ?? '',
            'level'           => $request->level ?? 1,
            'sub_category_id' => $request->sub_category_id,
            'job'             => $request->job ?? '',
            'effect_1'        => $request->effect_1 ?? ' = : = ',
            'effect_2'        => $request->effect_2 ?? ' = : = ',
            'effect_3'        => $request->effect_3 ?? ' = : = ',
            'handed'          => $request->handed ?? '',
            'icon'            => $name,
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully create a item.'], 201);
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
        $sub_categories = SubCategory::with('category')
            ->get(['id', 'name', 'category_id']);
        $item = Item::find($id);
        return view('admin.items.edit', compact('sub_categories', 'item'));
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
        $name = null;

        if ($request->hasFile('icon')) {
            $destination = rtrim(app()->basePath('public/images'), '/');
            $name        = $request->file('icon')->getClientOriginalName();
            $request->file('icon')->move($destination, $name);
        }

        $item = Item::find($id);
        $item->name            = $request->name;
        $item->description     = $request->description;
        $item->gender          = $request->gender;
        $item->level           = $request->level;
        $item->sub_category_id = $request->sub_category_id;
        $item->job             = $request->job;
        $item->effect_1        = $request->effect_1 ?? '';
        $item->effect_2        = $request->effect_2 ?? '';
        $item->effect_3        = $request->effect_3 ?? '';
        $item->handed          = $request->handed;
        $item->icon            = $name ?? $item->icon;
        $item->status          = $request->status;
        $item->save();

        return response()->json(['success' => true, 'message' => 'Successfully update a item.'], 202);
    }

    /**
     * This methods is for widgets in adminsitrator panel
     */
    public function count(): int
    {
        return Item::count();
    }
}
