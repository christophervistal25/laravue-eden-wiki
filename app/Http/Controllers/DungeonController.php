<?php

namespace App\Http\Controllers;

use App\Models\Dungeon;
use Illuminate\Http\Request;

class DungeonController extends Controller
{
    public function list()
    {
        return Dungeon::orderBy('slug')
            ->get(['title', 'slug'])
            ->chunk(11);
    }

    public function index()
    {
        return view('dungeons');
    }

    public function show(string $slug)
    {
        $dungeon = Dungeon::where('slug', $slug)->first();
        return view('dungeon-content', compact('dungeon'));
    }
}
