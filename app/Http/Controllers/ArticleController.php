<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return JWTAuth::parseToken()->authenticate();
        $articles = Article::all();
        $response = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'message' => 'List of articles.',
            'data'    => $articles
        ];
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json('coming soon...',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $response = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'message' => 'show single article.',
            'data'    => $article
        ];
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        $response = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'message' => 'Update the article successfully.',
            'data'    => $article
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Article $article)
    {
        $article->delete();
        
        return response()->json(null, 204);
    }
}
