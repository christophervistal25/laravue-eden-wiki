<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function list()
    {
        return Monster::orderBy('slug')
            ->get(['title', 'slug'])
            ->chunk(11);
    }

    public function index()
    {
        // Process the from the files.

        return view('monsters');
    }

    public function show(string $slug)
    {
        $monster = Monster::where('slug', $slug)
            ->first();
        return view('monster-content', compact('monster'));
    }
}
