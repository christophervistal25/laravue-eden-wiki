<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dungeon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DungeonController extends Controller
{

    public function search(string $key)
    {
        return Dungeon::where('title', 'like', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->select('id', 'title', 'slug', 'created_at')
            ->paginate(10);
    }

    public function dungeon()
    {
        return Dungeon::orderBy('created_at', 'DESC')
            ->select('id', 'title', 'slug', 'created_at')
            ->paginate(10);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dungeons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dungeons.create');
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
            'title' => 'required|unique:dungeons',
            'content' => 'required',
        ]);

        Dungeon::create([
            'title' => $request->title,
            'content' => htmlentities(utf8_encode($request->content)),
            'slug' => Str::slug($request->title),
        ]);

        return response()->json(['success' => true, 'message' => 'You successfully create a dungeon.'], 201);
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
        $dungeon = Dungeon::find($id);
        return view('admin.dungeons.edit', compact('dungeon'));
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
            'title' => 'required|unique:dungeons,title,' . $id,
            'content' => 'required'
        ]);

        $monster = Dungeon::find($id);
        $monster->title = $request->title;
        $monster->content =  htmlentities(utf8_encode($request->content));
        $monster->slug = Str::slug($request->title);
        $monster->save();

        return response()->json(['success' => true, 'message' => 'You successfully update a dungeon.'], 202);
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
