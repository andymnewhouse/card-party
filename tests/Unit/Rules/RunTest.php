<?php

namespace Tests\Unit\Rules;

use App\Card;
use App\Round;
use App\Rules\Run;
use App\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RunTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function must_have_four_cards()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('five')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertTrue($v->fails());
        $this->assertEquals('A run must have at least four cards.', $v->errors()->messages()['cards'][0]);
    }

    /** @test */
    public function must_be_all_the_same_suit()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('five')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('five')->whereSuit('heart')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertTrue($v->fails());
        $this->assertEquals('All cards in a run must be the same suit.', $v->errors()->messages()['cards'][0]);
    }

    /** @test */
    public function must_be_in_order()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('five')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('seven')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('eight')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertTrue($v->fails());
        $this->assertEquals('There are 3 cards missing from this run.', $v->errors()->messages()['cards'][0]);
    }

    /** @test */
    public function ace_can_be_high_and_low()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('ace')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('jack')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('queen')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('king')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('ace')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());
    }

    /** @test */
    public function run_cannot_wrap()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('ace')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('king')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('queen')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertTrue($v->fails());
        $this->assertEquals('There are 9 cards missing from this run.', $v->errors()->messages()['cards'][0]);

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('ace')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('five')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('six')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('seven')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('eight')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('nine')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('ten')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('jack')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('queen')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('king')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('ace')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());
    }

    /** @test */
    public function can_include_joker()
    {
        $round = factory(Round::class)->create();
        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('five')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('four')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());

        $cards = [
            'cards' => [
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('two')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('three')->whereSuit('spade')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('heart')->first()]),
                factory(Stock::class)->create(['round_id' => $round->id, 'card_id' => Card::whereValue('joker')->whereSuit('spade')->first()]),
            ]
        ];
        $v = Validator::make($cards, ['cards' => new Run]);
        $this->assertFalse($v->fails());
    }
}
