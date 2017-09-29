<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Intervention;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploads = Upload::orderBy('created_at','desc')->get();
        return view('upload.index', compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->file('files') as $file) {
            $filename = $file->getClientOriginalName();
            if(strpos($file->getMimeType(), "image") === 0){
                $folder = "images";
            }else{
                $folder = "files";
            }
            $exploded = explode('.', $filename, 2);
            $counter = 0;
            while(Storage::exists("uploads/$folder/$filename")){
                $filename = $exploded[0] . '(' . ++$counter . ').' . $exploded[1];
            }
            $url = $file->storeAs("uploads/$folder", $filename);

            if($folder == "images" && $request->resize){
                Intervention::make($url)
                    ->widen($request->width)
                    ->save();
            }

            $size = Storage::size($url);

            Upload::create(compact('url','size'));
        }
        return redirect()->route('upload.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        unlink($upload->url);
        $upload->delete();
        return redirect()->route('upload.index');
    }
}
