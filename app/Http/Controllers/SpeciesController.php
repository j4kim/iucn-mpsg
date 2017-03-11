<?php

namespace App\Http\Controllers;

use App\Image;
use App\Island;
use App\Species;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Intervention;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('species.index', ['species' => Species::orderBy("name")->get()]);
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
        $imgs = $species->images->all();
        $header_img = $imgs[array_rand($imgs)];
        $header_img_url = asset('images/' . $header_img->url);
        return view('species.show', compact('species', 'header_img_url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $species = Species::find($id);
        $species_islands = [];
        foreach($species->islands as $spe){
            $species_islands[] = $spe->id;
        }
        return view('species.edit', ['species' => $species, 'islands' => Island::all(), 'species_islands' => $species_islands]);
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

        $imgs = ['img'=>[],'map'=>[]];
        foreach($request->all() as $k => $v){
            foreach (['img','map'] as $cat){
                if(strpos($k, $cat) === 0){
                    $id = filter_var($k, FILTER_SANITIZE_NUMBER_INT);
                    $imgs[$cat][$id][$k] = $v;
                    if($imgs[$cat][$id]["is_new"] = strpos($k, 'new'))
                        $imgs[$cat][$id]["file"] = $request->file($k);
                    if(strpos($k, 'title'))
                        $imgs[$cat][$id]["title"] = $v;
                    if(strpos($k, 'legend'))
                        $imgs[$cat][$id]["legend"] = $v;
                }
            }
        }

        foreach ($imgs['img'] as $id => $img){
            if($img['is_new']){
                $url = $img['title'] . $id . '.' . $img['file']->getClientOriginalExtension();
                Intervention::make($img['file'])->save("images/$url")
                    ->widen(480)->save("images/small/$url");
                Image::create([
                    'title'=>$img['title'],
                    'legend'=>$img['legend'],
                    'url'=>$url,
                    'species_id'=>$species->id
                ]);
            }else{
                Image::find($id)->update($img);
            }
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
