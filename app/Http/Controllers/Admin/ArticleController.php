<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $articles = Article::where('user_id',Auth::id())->get();
      return view('admin.posts.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
          'title' => 'required',
          'slug' => 'required|unique:articles',
          'content' => 'required',
          'image' => 'image'
        ]);

        $path = Storage::disk('public')->put('images',$data['image']);

        $newArticle = new Article;
        $newArticle->user_id = Auth::id();
        $newArticle->title = $data['title'];
        $newArticle->slug = $data['slug'];
        $newArticle->content = $data['content'];
        $newArticle->image = $path;

        $newArticle->save();

        Mail::to($newArticle->user->email)->send(new SendNewMail($newArticle));

        return redirect()->route('admin.posts.show', $newArticle->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('admin.posts.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
