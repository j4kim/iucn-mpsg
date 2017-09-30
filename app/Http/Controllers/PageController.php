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
        $this->middleware('auth', ['except' => ['show', 'book']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('page.index', compact('pages'));
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
    public function show($titleOrId='home')
    {
        if(intval($titleOrId))
            $page = Page::find($titleOrId);
        else
            $page = Page::where('title',$titleOrId)->first();

        if(!$page) abort(404);

        if($page->options){
            if(isset($page->options["images"])){
                $images = Image::inRandomOrder()->take($page->options["images"])->get();
            }
            if(isset($page->options["asidePage"])){
                $asidePage = Page::where('title', $page->options["asidePage"])->first();
            }
        }

        return view('page.show', compact('page','images','asidePage'));
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
        $page->update(['content' => $request->content,
            'options' => json_decode($request->options)]);
        return redirect()->route('pages.show', strtolower($page->title));
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
        return view('book', ['species' => Species::orderBy("name")->get(), 'pages' => Page::all()]);
    }
}
