<?php

namespace Tests\Feature\Http\Controllers;

use App\Game;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GamesPlayController
 */
class GamesPlayControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function invoke_returns_an_ok_response()
    {
        $andy = factory(User::class)->create(['name' => 'Andy']);
        $becca = factory(User::class)->create(['name' => 'Becca']);
        $dan = factory(User::class)->create(['name' => 'Dan']);
        $pam = factory(User::class)->create(['name' => 'Pam']);

        $game = Game::create(['game_type_id' => 1, 'owner_id' => $andy->id]);
        $game->players()->attach([$andy->id, $becca->id, $dan->id, $pam->id]);

        $response = $this->actingAs($andy)->get($game->playLink);

        $response->assertOk();
        $response->assertViewIs('games.play');
        $response->assertViewHas('game');

        // TODO: perform additional assertions
    }
}
