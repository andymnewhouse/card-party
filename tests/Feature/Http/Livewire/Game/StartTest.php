<?php

namespace Tests\Feature\Http\Livewire\Game;

use App\Game;
use App\GameType;
use App\Http\Livewire\Games\Start;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @see \App\Http\Livewire\Games\Start
 */
class StartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_game()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $livewire = Livewire::test(Start::class)
            ->set('game', GameType::whereName('progressive')->first()->id)
            ->call('create');

        $game = Game::whereOwnerId($user->id)->first();

        $livewire->assertRedirect($game->joinLink);
        $this->assertTrue($game->players->pluck('id')->contains($user->id));
    }
}
