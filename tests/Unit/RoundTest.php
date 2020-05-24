<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoundTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_instructions()
    {
        // Create Players
        $andy = factory(User::class)->create(['name' => 'Andy']);
        $becca = factory(User::class)->create(['name' => 'Becca']);
        $dan = factory(User::class)->create(['name' => 'Dan']);
        $pam = factory(User::class)->create(['name' => 'Pam']);

        // Create Games
        $game = $andy->games()->create(['game_type_id' => 1, 'owner_id' => $andy->id]);

        // Attach Players
        $game->players()->attach($becca);
        $game->players()->attach($dan);
        $game->players()->attach($pam);

        // Create Rounds
        $round = $game->startRound(0);

        $this->assertEquals('Please click the deck to start the game.', $round->instructions);

        $round->has_started = true;
        $round->save();

        $this->assertEquals("It's Andy's turn.", $round->instructions);
    }
}
