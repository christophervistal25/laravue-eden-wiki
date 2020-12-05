<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SetEffect;
use App\Http\Repositories\SetPart;
use App\Models\Item;
use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{


    public function __construct(SetEffect $setEffect, SetPart $setPart)
    {
        $this->setEffect = $setEffect;
        $this->setPart = $setPart;
    }

    public function searchItem(string $key)
    {
        return Item::where('name', 'like', '%' . $key . '%')
            ->categorySettable()
            ->subCategorySettable()
            ->with(['sub_category:id,name,category_id', 'sub_category.category:id,name'])
            ->noSet()
            ->orderBy('level', 'DESC')
            ->paginate(15);
    }


    public function items()
    {
        return Item::categorySettable()
            ->subCategorySettable()
            ->with(['sub_category:id,name,category_id', 'sub_category.category:id,name'])
            ->noSet()
            ->orderBy('level', 'DESC')
            ->paginate(15);
    }

    public function searchSet(string $key)
    {
        return Set::where('name', 'like', '%' . $key . '%')
            ->has('items')
            ->with(['items'])
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
    }

    public function sets()
    {
        return Set::has('items')
            ->with(['items'])
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
        return view('admin.sets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sets.create');
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
            'name'       => 'required',
            'item_parts' => 'json_item',
            'effects'    => 'json_effect',
        ]);

        $parts         = [];
        $effects       = [];

        $items   = json_decode($request->item_parts);
        $effects = json_decode($request->effects);

        $parts   = $this->setPart->createUsingThis($items);
        $effects = $this->setEffect->createUsingThis($effects);
        $type    = $this->setPart->getBaseItem()->sub_category->category->name;


        $set = Set::updateOrCreate([
            'name'    => $request->name,
            'type'    => $type,
            'parts'   => json_encode($parts),
            'effects' => json_encode($effects),
        ]);

        foreach (json_decode($request->item_parts) as $item) {
            $item = Item::find($item->id);
            $item->set_id = $set->id;
            $item->save();
        }

        return response()->json(['success' => true, 'message' => 'Successfully create new set.'], 201);
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
        $set = Set::with(['items', 'items.sub_category:id,name,category_id', 'items.sub_category.category:id,name'])
            ->find($id);
        return view('admin.sets.edit', compact('set'));
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
            'name'       => 'required',
            'item_parts' => 'json_item',
            'effects'    => 'json_effect',
        ]);


        $set = Set::with(['items', 'items.sub_category:id,name,category_id', 'items.sub_category.category:id,name'])->find($id);

        $parts         = [];
        $effects       = [];



        $items   = json_decode($request->item_parts);
        $effects = json_decode($request->effects);



        $parts   = $this->setPart->createUsingThis($items);
        $effects = $this->setEffect->createUsingThis($effects);
        $type    = $this->setPart->getBaseItem()->sub_category->category->name;

        $set->name    = $request->name;
        $set->type    = $type;
        $set->effects = json_encode($effects);
        $set->parts   = json_encode($parts);
        $set->save();



        foreach ($set->items as $item) {
            $item->set_id = null;
            $item->save();
        }

        foreach (json_decode($request->item_parts) as $item) {
            $item = Item::find($item->id);
            $item->set_id = $set->id;
            $item->save();
        }

        return response()->json(['success' => true, 'message' => 'You successfully udpate a set.'], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
