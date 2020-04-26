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

    public static function start($type, $playerIds) {
        $gameType = GameType::find($type);

        $playersForHands = (new Game)->getPlayersForHands($playerIds);
        $hands = [
            ['num_cards' => 6, 'goal' => 'Two sets of three', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(0, $playersForHands), 'turn' => 0],
            ['num_cards' => 7, 'goal' => 'One set of three, One run of four', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(1, $playersForHands), 'turn' => 0],
            ['num_cards' => 8, 'goal' => 'Two runs of four', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(2, $playersForHands), 'turn' => 0],
            ['num_cards' => 9, 'goal' => 'Three sets of three', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(3, $playersForHands), 'turn' => 0],
            ['num_cards' => 10, 'goal' => 'Two sets of three, One run of four', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(4, $playersForHands), 'turn' => 0],
            ['num_cards' => 11, 'goal' => 'One set of three, Two runs of four', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(5, $playersForHands), 'turn' => 0],
            ['num_cards' => 12, 'goal' => 'Three runs of four', 'players' => $playersForHands, 'active_player' => (new Game)->getActivePlayer(6, $playersForHands), 'turn' => 0],
        ];

        foreach($hands as $index => $hand) {
            $hand['deck'] = (new Deck(round(count($playerIds) / 2), 'normal-with-jokers'))->cards;
            $hand['discard'] = [];
            $hand = (new Game)->deal($hand, $hand['num_cards']);
            $hands[$index] = $hand;
        }

        $game = self::create([
            'game_type_id' => $gameType->id, 
            'num_players' => count($playerIds), 
            'hands' => $hands,
        ]);

        $game->players()->attach($playerIds);

        return $game;
    }

    public function game_type() {
        return $this->belongsTo(GameType::class);
    }

    public function players() {
        return $this->belongsToMany(User::class);
    }

    public function getPlayLinkAttribute() {
        return route('games.play', Hashids::encode($this->id));
    }

    private function deal($hand, $numberOfCards)
    {
        foreach (range(1, $numberOfCards) as $card) {
            foreach ($hand['players'] as  $index => $player) {
                $hand['players'][$index]['hand'][] = $hand['deck']->shift();
            }
        }

        return $hand;
    }

    private function getActivePlayer($hand, $players) 
    {
        if(isset($players[$hand])) {
            return $hand;
        } else {
            return count($players) - $hand;
        }
    }

    private function getPlayersForHands($ids) {
        return User::whereIn('id', $ids)->get()->map(function($user) {
            return ['name' => $user->name, 'user_id' => $user->id, 'hand' => [], 'buys' => 0];
        })->toArray();
    }
}
