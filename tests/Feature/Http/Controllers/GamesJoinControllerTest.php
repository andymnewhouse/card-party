<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GamesJoinController
 */
class GamesJoinControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_who_visit_page_are_added_to_game()
    {
        $andy = factory(User::class)->create(['name' => 'Andy']);
        $becca = factory(User::class)->create(['name' => 'Becca']);
        $dan = factory(User::class)->create(['name' => 'Dan']);
        $pam = factory(User::class)->create(['name' => 'Pam']);
        
        $game = $andy->games()->create(['game_type_id' => 1, 'owner_id' => $andy->id]);

        $this->actingAs($andy)->get($game->joinLink)->assertViewHas('game', $game);
        $this->actingAs($becca)->get($game->joinLink)->assertViewHas('game', $game->fresh());
        $this->actingAs($dan)->get($game->joinLink)->assertViewHas('game', $game->fresh());
        $this->actingAs($pam)->get($game->joinLink)->assertViewHas('game', $game->fresh());

        $this->assertCount(4, $game->players);
    }
}
