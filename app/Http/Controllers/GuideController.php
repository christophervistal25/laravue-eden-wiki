<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class GuideController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')
            ->where('status', 'active')
            ->take(10)
            ->get();
        return view('user.guide', compact('articles'));
    }

    public function show(string $slug)
    {
        $article =  Article::where('slug', $slug)->first();
        return view('user.guide-show', compact('article'));
    }

    public function increment(string $slug)
    {
        $article = Article::where('slug', $slug)->first();
        $article->increment('views', 1);
        $article->save();
        return response()->json(['success' => true], 202);
    }
}
