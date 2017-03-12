<?php

namespace App\Http\Controllers;

use App\Image;
use App\Island;
use App\Map;
use App\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Intervention;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class SpeciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

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
        $new = Species::create();
        return redirect()->route('species.edit', $new->id);
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
        if(!count($imgs))
            return view('species.show', compact('species'));
        $header_img = $imgs[array_rand($imgs)];
        $header_img_url = asset('uploads/images/medium/' . $header_img->url);
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
        $this->middleware('auth');
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

        /*
         * Summary
         */
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

        /*
         * Islands
         */
        // detach all
        $species->islands()->detach();
        // attach new islands
        if(count($request->islands)){
            $species->islands()->attach($request->islands);
        }

        /*
         * Images and Maps
         */
        // peuple deux tableaux $imgs['img'] et $imgs['map']
        $imgs = ['img'=>[],'map'=>[]];
        foreach($request->all() as $k => $v){
            foreach (['img','map'] as $cat){
                // si le nom de l'attribut commence par img ou map
                if(strpos($k, $cat) === 0){
                    if(strpos($k, "remove")){
                        // on doit supprimer une ou plusieurs images ou carte
                        foreach($v as $id_to_del){
                            $model = $cat=='img' ? Image::class : Map::class;
                            if($toDelete = $model::find($id_to_del))
                                $toDelete->realDelete();
                        }
                    }else{
                        // récupère un entier dans le nom de l'input
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
        }

        // reçoit un tableau d'images à créer dans dans un modèle
        function saveImages($imgs, $model, $folder, $species){
            foreach ($imgs as $id => $img){
                if($img['is_new']){
                    $url = uniqid() . '.' . $img['file']->getClientOriginalExtension();
                    Intervention::make($img['file'])->save("uploads/$folder/$url")
                        ->widen(1170)->save("uploads/$folder/medium/$url")
                        ->widen(320)->save("uploads/$folder/small/$url");
                    $model::create([
                        'title'=>$img['title'],
                        'legend'=>$img['legend'],
                        'url'=>$url,
                        'species_id'=>$species->id
                    ]);
                }else{
                    $model::find($id)->update($img);
                }
            }
        }

        saveImages($imgs['img'], Image::class, 'images', $species);
        saveImages($imgs['map'], Map::class, 'maps', $species);

        /*
         * Text and references
         */
        $data["Text"] = $request->Text;
        $data["Additional References"] = $request->Additional_References;

        /*
         * Save and redirect
         */
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
        $toDelete = Species::find($id);
        $toDelete->islands()->detach();
        foreach ($toDelete->images as $img){
            $img->realDelete();
        }
        foreach ($toDelete->maps as $map){
            $map->realDelete();
        }
        $toDelete->delete();
        return redirect()->route('species.index');
    }
}
