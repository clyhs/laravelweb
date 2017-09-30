<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Article;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = DB::table('articles')
            ->select('id', 'body', 'title')
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('welcome', ['articles' => $articles]);
    }

    public function show($id)
    {
        return view('article')->withArticle(Article::find($id));
    }
}
