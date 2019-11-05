<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Card\Keyword;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('/home/must012/LOR-Backend/keywords.json');
        $data = json_decode($json);

        foreach($data->keywords as $obj){
            Keyword::create(array(
                'keyword'=>$obj->nameRef,
                'description'=>$obj->description,
                'kr_keyword'=>$obj->name
            ));
        }

    }
}
