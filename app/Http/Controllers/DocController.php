<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DocController extends Controller
{
    public function index()
    {
        $categories = Category::with(['sub_category' => function ($query) {
            $query->select('id', 'category_id', 'name')
                ->activeOnly();
        }])->onlyActive()->get(['id', 'name']);

        return view('user.doc', compact('categories'));
    }
}
