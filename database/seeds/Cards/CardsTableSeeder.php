<?php

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\Card;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get('/home/must012/LOR-Backend/data-ko_kr.json'));

        foreach($data as $obj){
            Card\Card::create(array(
                'card'=>$obj->cardCode,
                'name'=>$obj->name,
                'region'=>$obj->regionRef,
                'cost'=>$obj->cost,
                'attack'=>$obj->attack,
                'health'=>$obj->health,
                'rarity'=>$obj->rarityRef,
                'artist_name'=>$obj->artistName,
                'keywords'=>json_encode($obj->keywordRefs),
                'association'=>json_encode($obj->associatedCardRefs)
            ));
            Card\KrDescription::create(array(
                'card'=>$obj->cardCode,
                'description'=>$obj->descriptionRaw,
                'flavor_text'=>$obj->flavorText
            ));
            Card\KrPath::create(array(
                'card'=>$obj->cardCode,
                'path'=>$obj->assets[0]->gameAbsolutePath,
                'full_path'=>$obj->assets[0]->fullAbsolutePath,
            ));
            Card\KrType::create(array(
                'card'=>$obj->cardCode,
                'type'=>$obj->type,
                'subtype'=>$obj->subtype,
                'super_type'=>$obj->supertype
            ));
        }
        
    }
}
