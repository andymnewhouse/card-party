<?php

namespace Tests\Feature\Http\Controllers;

use App\Game;
use App\GameType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GamesController
 */
class GamesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_returns_an_ok_response()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('games.create'));

        $response->assertOk();
        $response->assertViewIs('games.create');
    }

    /** @test */
    public function store_returns_an_ok_response()
    {
        $andy = factory(\App\User::class)->create(['name' => 'Andy']);
        $becca = factory(\App\User::class)->create(['name' => 'Becca']);
        $dan = factory(\App\User::class)->create(['name' => 'Dan']);
        $pam = factory(\App\User::class)->create(['name' => 'Pam']);

        $response = $this->actingAs($andy)->withoutExceptionHandling()->post(route('games.store'), [
            'game' => GameType::find(1),
            'players' => [
                $andy->id,
                $becca->id,
                $dan->id,
                $pam->id,
            ]
        ]);

        $game = Game::find(1);
        dd($game);

        $response->assertRedirect($game->playLink);

        // TODO: perform additional assertions
    }
}
