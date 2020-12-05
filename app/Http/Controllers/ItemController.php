<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show(int $id)
    {
        $items = SubCategory::with(['items' => function ($query) {
            $query->orderBy('level', 'ASC')->onlyActive()->take(24);
        }, 'items.set', 'items.set.items'])->find($id);

        return view('user.item-show', compact('items'));
    }

    public function showMore(int $id)
    {
        return SubCategory::with(['items' => function ($query) {
            return $query->orderBy('level', 'ASC')->onlyActive()->skip(24)->take(PHP_INT_MAX)->get();
        }, 'items.set', 'items.set.items'])->find($id);
    }
}
