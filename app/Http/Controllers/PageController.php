<?php

namespace App\Http\Controllers;

use App\Image;
use App\Page;
use App\Species;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show', 'book']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $title
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $page = Page::where('title',$title)->first();

        if($title == "about"){
            $images = Image::inRandomOrder()->take(4)->get();
//            dd($images);
        }

        return view('page.show', compact('page','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('page.edit', ['page'=>$page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page->update($request->all());
        return redirect()->route('pages.show', $page->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    public function book(){
        return view('book', ['species' => Species::all(), 'pages' => Page::all()]);
    }
}
