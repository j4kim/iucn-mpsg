<?php

use Illuminate\Database\Seeder;

class MultipleSynonymsOnSpecies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Species::all() as $s){
            echo $s->id . "\n";
            $data = $s->data;
            if(isset($data['Summary']['Synonym'])){
                $data['Summary']['Synonyms'] = [$data['Summary']['Synonym']];
                unset($data['Summary']['Synonym']);
            }else if(! isset($data['Summary']['Synonyms'])){
                $data['Summary']['Synonyms'] = [];
            }
            print_r($data['Summary']['Synonyms']);
            $s->update(compact('data'));
        }
    }
}
