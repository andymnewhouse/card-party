<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    public $casts = [
        'hands' => 'collection',
        'players' => 'collection',
    ];

    public static function start($type, $playerNames) {
        $gameType = GameType::find($type);

        $playersForHands = (new Game)->getPlayersForHands($playerNames);
        $hands = [
            ['num_cards' => 6, 'goal' => 'Two sets of three', 'players' => $playersForHands],
            ['num_cards' => 7, 'goal' => 'One set of three, One run of four', 'players' => $playersForHands],
            ['num_cards' => 8, 'goal' => 'Two runs of four', 'players' => $playersForHands],
            ['num_cards' => 9, 'goal' => 'Three sets of three', 'players' => $playersForHands],
            ['num_cards' => 10, 'goal' => 'Two sets of three, One run of four', 'players' => $playersForHands],
            ['num_cards' => 11, 'goal' => 'One set of three, Two runs of four', 'players' => $playersForHands],
            ['num_cards' => 12, 'goal' => 'Three runs of four', 'players' => $playersForHands],
        ];

        foreach($hands as $hand) {
            $hand['deck'] = new Deck(round(count($playerNames) / 2), 'normal-with-jokers');
            $hand = (new Game)->deal($hand, $hand['num_cards']);
        }

        return self::create([
            'game_type_id' => $gameType->id, 
            'num_players' => count($playerNames), 
            'hands' => $hands,
            'players' => (new Game)->getPlayers($playerNames),
        ]);
    }

    public function game_type() {
        return $this->belongsTo(GameType::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function getPlayLinkAttribute() {
        return route('games.play', Hashids::encode($this->id));
    }

    public function getSetupLinkAttribute() {
        return route('games.setup', Hashids::encode($this->id));
    }

    private function deal($hand, $numberOfCards)
    {
        foreach (range(1, $numberOfCards) as $card) {
            foreach ($hand['players'] as  $index => $player) {
                $hand['players'][$index]['hand'][] = $hand['deck']->cards->shift();
            }
        }

        return $hand;
    }

    private function getPlayers($names) {
        $players = [];
        foreach($names as $name) {
            $players[] = ['name' => $name, 'user_id' => null, 'icon' => null];
        }

        return $players;
    }

    private function getPlayersForHands($names) {
        $players = [];
        foreach($names as $name) {
            $players[] = ['name' => $name, 'hand' => []];
        }

        return $players;
    }
    
}
