<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_current_hand()
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

        $this->assertCount(6, $andy->getHand($round));
    }
}
