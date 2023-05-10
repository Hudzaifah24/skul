<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category','user')->get();

        $categories = Category::all();

        $users = User::all();

        return view('pages.article.index')->with([
            'articles' => $articles,
            'categories' => $categories,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->all();

        $request->validate([
            'image' => 'required',
        ], [
            'image.required' => 'Gambar harus diisi',
        ]);

        $image_file = $this->uploadImage($request->file('image'));

        $data['image'] = $image_file;

        Article::create($data);

        return redirect()->route('article.index')->with('notification-success-add', '');

    }

    /**
     * Show the form for editing the specified resource.
     *

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    public function update(ArticleRequest $request, $id)
    {
        $articles = Article::find($id);

        $data = $request->all();

        if($request->file('image') == null){
            $articles['image'] = $articles->image;
        }else {
            $this->removeImage($articles->image);

            $image_file = $this->uploadImage($request->file('image'));

            $data['image'] = $image_file;
        }

        $articles->update($data);

        return redirect()->route('article.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = Article::findOrFail($id);

        $articles->delete();

        return redirect()->route('article.index')->with('notification-success-delete', '');

    }

    public function uploadImage($image)
    {
        $new_name_image =time() . '.'. $image->getClientOriginalExtension();

        $image->move(public_path('profile'), $new_name_image);

        return $new_name_image;

    }

    public function removeImage($image)
    {
        if (file_exists('profile/'.$image)){

            unlink('profile/'.$image);
        }
    }

    // Edit Active Or Not Active

    public function isActive(Request $request, $id)
    {
        $period = Article::findOrFail($id);

        if ($request->status == 'active') {
            $period->update([
                'status' => 'Active'
            ]);
        } else{
            $period->update([
                'status' => 'Not active'
            ]);
        }

        return redirect()->route('article.index')->with('notification-success-'.$request->status, '');
    }
}
