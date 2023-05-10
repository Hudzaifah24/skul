<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->where('status', 'Active')->with(['user', 'category'])->paginate(5);

        return $this->success($articles, 'Success');
    }

    public function show($id)
    {
        $article = Article::with(['user', 'category'])->findOrFail($id);

        return $this->success($article, 'Success');
    }
}
