<?php

namespace App\Http\Controllers;

use App\Models\Card\KrCardMeta;
use App\Models\User\Deck;
use App\Models\User\User;
use Illuminate\Http\Request;
use MikeReinders\RuneTerraPHP\DeckEncoding;

class DeckController extends Controller
{
    public function share(Request $request)
    {
        $deck = $request->input('deck');

        if ($this->additionalValidate($deck)) {
            throw new \InvalidArgumentException("Given deck is invalid");
        }

        $id = User::first()->user_id;
        $code = $this->build($deck);
        $source = json_encode($deck);
        $regions = $request->input('region');
        $subject = $request->input('subject');
        $description = $request->input('description');
        $type = $request->input('type');

        $check = Deck::insertGetId([
            'user_id' => $id,
            'code' => $code,
            'source' => $source,
            'region_1' => $regions[0],
            'region_2' => $regions[1],
            'subject' => $subject,
            'description' => $description,
            'type' => $type,
        ]);

        return $check ? $check : "please try later";

    }

    private function build($deck)
    {
        $code = DeckEncoding::encode($deck);
        return $code;
    }

    private function additionalValidate($deck)
    {
        $totalChampion = 0;
        $factions = [];

        foreach ((array) $deck as $card) {
            $cardList[] = $card[0];
            $numList[] = $card[1];
        }
        
        $cardMeta = KrCardMeta::select('region', 'card', 'rarity')->whereIn('card', $cardList)->get();
        $champions = $cardMeta->where('rarity', '챔피언');
        $fections = $cardMeta->groupBy('region');

        foreach ($champions as $k) {
            $championPo[] = array_search($k->card, $cardList);
        }

        foreach ($championPo as $n) {
            $totalChampion += $numList[$n];
        }

        return (count($factions) > 2 || $totalChampion > 6) ? true : false;
    }
}
