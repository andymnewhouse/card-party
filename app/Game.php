<?php

namespace App;

class Game
{
    public $game;
    public $players;
    public $deck;

    public function __construct($players)
    {
        $this->game = 'progressive';
        $this->players = $players;
        $this->deck = new Deck(round(count($this->players) / 2), 'normal-with-jokers');

        $this->deal(6);
    }

    private function deal($numberOfCards)
    {
        foreach (range(1, $numberOfCards) as $card) {
            foreach ($this->players as  $index => $player) {
                $this->players[$index]['hand'][] = $this->deck->cards->shift();
            }
        }
    }
}
