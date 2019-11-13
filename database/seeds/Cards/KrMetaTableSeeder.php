<?php

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\Card\KrMeta;

class KrMetaTableSeeder extends Seeder
{
    public function run()
    {
        $data = json_decode(File::get('/home/must012/LOR-Backend/data-ko_kr.json'));

        foreach($data as $obj){
            KrMeta::create(array(
                'card'=>$obj->cardCode,
                'name'=>$obj->name,
                'region'=>$obj->region,
                'rarity'=>$obj->rarity,
                'keywords'=>json_encode($obj->keywords),
                'type'=>$obj->type,
                'subtype'=>$obj->subtype,
                'super_type'=>$obj->supertype,
                'description'=>$obj->descriptionRaw,
                'flavor_text'=>$obj->flavorText,
                'path'=>$obj->assets[0]->gameAbsolutePath,
                'full_path'=>$obj->assets[0]->fullAbsolutePath
            ));
        }
    }
}
