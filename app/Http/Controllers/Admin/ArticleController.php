<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    public function search(string $key)
    {
        return Article::where('title', 'like', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function articles()
    {
        return Article::orderBy('created_at', 'DESC')
            ->paginate(10);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
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
            'title' => 'required|unique:articles',
            'content' => 'required'
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title, '-'),
        ]);

        return response()->json(['success' => true, 'message' => 'You successfully create a article.'], 201);
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
        $article = Article::find($id);
        return view('admin.articles.edit', compact('article'));
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
            'title' => 'required|unique:articles,title,' . $id,
            'content' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title, '-');
        $article->status = $request->status;
        $article->save();

        return response()->json(['success' => true, 'message' => 'You successfully update a article.'], 202);
    }

    /**
     * For widgets in administrator panel
     */
    public function count(): int
    {
        return Article::count();
    }
}
