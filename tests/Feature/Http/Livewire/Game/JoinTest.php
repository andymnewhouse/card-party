<?php

namespace Tests\Feature\Http\Livewire\Game;

use App\Http\Livewire\Games\Join;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @see \App\Http\Livewire\Games\Join
 */
class JoinTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_of_game_sees_lets_play_button()
    {
        $andy = factory(User::class)->create(['name' => 'Andy']);
        $becca = factory(User::class)->create(['name' => 'Becca']);
        $dan = factory(User::class)->create(['name' => 'Dan']);
        $pam = factory(User::class)->create(['name' => 'Pam']);

        $game = $andy->games()->create(['game_type_id' => 1, 'owner_id' => $andy->id]);

        $this->actingAs($andy)->get($game->joinLink);
        $this->actingAs($becca)->get($game->joinLink);
        $this->actingAs($dan)->get($game->joinLink);
        $this->actingAs($pam)->get($game->joinLink);

        Livewire::actingAs($andy)->test(Join::class, ['game' => $game])->assertSee('All Set');
        Livewire::actingAs($becca)->test(Join::class, ['game' => $game->refresh()])->assertDontSee('All Set')->assertSee('Andy');
        Livewire::actingAs($dan)->test(Join::class, ['game' => $game->refresh()])->assertDontSee('All Set')->assertSee('Andy')->assertSee('Becca');
        Livewire::actingAs($pam)->test(Join::class, ['game' => $game->fresh()])->assertDontSee('All Set')->assertSee('Andy')->assertSee('Becca')->assertSee('Dan');
    }
}
