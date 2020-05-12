<?php

namespace Tests\Unit\Rules;

use App\Card;
use App\Round;
use App\Rules\Set;
use App\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function must_have_three_cards()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('heart')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('diamond')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Set]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('heart')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Set]);
        $this->assertTrue($v->fails());
    }

    /** @test */
    public function must_all_be_same_value()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('heart')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('diamond')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Set]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('heart')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('heart')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Set]);
        $this->assertTrue($v->fails());
    }

    /** @test */
    public function can_include_joker()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('heart')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Set]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('heart')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Set]);
        $this->assertTrue($v->fails());
    }
}
