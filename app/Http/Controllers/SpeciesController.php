<?php

namespace App\Http\Controllers;

use App\Island;
use App\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('species.index', ['species' => Species::all()]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $species = Species::find($id);

        $summary = $species->data["Summary"];
        // plural if there are several common names, ie if there is a semicolon
        if(strpos($summary["Common name"],';')){
            $summary["Common names"] = $summary["Common name"];
            unset($summary["Common name"]);
        }

        $imgs = $species->data["Images"];
        $header_img = $imgs[array_rand($imgs)];
        $header_img_url = asset('images/' . $header_img['url']);
        return view('species.show', compact('species', 'summary', 'header_img_url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('species.edit', ['species' => Species::find($id), 'islands' => Island::all()]);
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
        $species = Species::find($id);

        $name = $request->Latin_name;
        $data = $species->data;

        $data['Summary']['Latin name'] = ["Name" => $name, "Author" => $request->Latin_name_Author];

        if(!empty($request->Synonym))
            $data['Summary']['Synonym'] = ["Name" => $request->Synonym, "Author" => $request->Synonym_Author];

        $keys = ['Common name', 'Family', 'Status'];
        foreach($keys as $key){
            $value = $request[str_replace(' ', '_', $key)];
            if (!empty($value))
                $data["Summary"][$key] = $value;
        }

        $data["Text"] = $request->Text;
        $data["Additional References"] = $request->Additional_References;

        $species->update(compact('name', 'data'));

        return redirect()->route('species.show', compact('species'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
