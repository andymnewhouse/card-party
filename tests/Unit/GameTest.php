<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function each_round_assignes_next_player_as_first_active_player()
    {
        // Create Players
        $andy = factory(User::class)->create(['name' => 'Andy']);
        $becca = factory(User::class)->create(['name' => 'Becca']);
        $dan = factory(User::class)->create(['name' => 'Dan']);
        $pam = factory(User::class)->create(['name' => 'Pam']);
        $jess = factory(User::class)->create(['name' => 'Jess']);
        $michelle = factory(User::class)->create(['name' => 'Michelle']);
        $trevor = factory(User::class)->create(['name' => 'Trevor']);

        // Create Games
        $threePlayerGame = $andy->games()->create(['game_type_id' => 1, 'owner_id' => $andy->id]);
        $fourPlayerGame = $andy->games()->create(['game_type_id' => 1, 'owner_id' => $andy->id]);
        $fivePlayerGame = $andy->games()->create(['game_type_id' => 1, 'owner_id' => $andy->id]);

        // Attach Players
        $threePlayerGame->players()->attach($michelle);
        $threePlayerGame->players()->attach($trevor);

        $fourPlayerGame->players()->attach($becca);
        $fourPlayerGame->players()->attach($dan);
        $fourPlayerGame->players()->attach($pam);

        $fivePlayerGame->players()->attach($becca);
        $fivePlayerGame->players()->attach($dan);
        $fivePlayerGame->players()->attach($pam);
        $fivePlayerGame->players()->attach($jess);

        // Create Rounds
        $threePlayerGameRoundThreeThree = $threePlayerGame->startRound(0);
        $threePlayerGameRoundThreeFour = $threePlayerGame->startRound(1);
        $threePlayerGameRoundFourFour = $threePlayerGame->startRound(2);
        $threePlayerGameRoundThreeThreeThree = $threePlayerGame->startRound(3);
        $threePlayerGameRoundThreeThreeFour = $threePlayerGame->startRound(4);
        $threePlayerGameRoundThreeFourFour = $threePlayerGame->startRound(5);
        $threePlayerGameRoundFourFourFour = $threePlayerGame->startRound(6);

        $fourPlayerGameRoundThreeThree = $fourPlayerGame->startRound(0);
        $fourPlayerGameRoundThreeFour = $fourPlayerGame->startRound(1);
        $fourPlayerGameRoundFourFour = $fourPlayerGame->startRound(2);
        $fourPlayerGameRoundThreeThreeThree = $fourPlayerGame->startRound(3);
        $fourPlayerGameRoundThreeThreeFour = $fourPlayerGame->startRound(4);
        $fourPlayerGameRoundThreeFourFour = $fourPlayerGame->startRound(5);
        $fourPlayerGameRoundFourFourFour = $fourPlayerGame->startRound(6);

        $fivePlayerGameRoundThreeThree = $fivePlayerGame->startRound(0);
        $fivePlayerGameRoundThreeFour = $fivePlayerGame->startRound(1);
        $fivePlayerGameRoundFourFour = $fivePlayerGame->startRound(2);
        $fivePlayerGameRoundThreeThreeThree = $fivePlayerGame->startRound(3);
        $fivePlayerGameRoundThreeThreeFour = $fivePlayerGame->startRound(4);
        $fivePlayerGameRoundThreeFourFour = $fivePlayerGame->startRound(5);
        $fivePlayerGameRoundFourFourFour = $fivePlayerGame->startRound(6);

        // Test Rounds set correct active user
        $this->assertEquals($andy->id, $threePlayerGameRoundThreeThree->active_player_id);
        $this->assertEquals($michelle->id, $threePlayerGameRoundThreeFour->active_player_id);
        $this->assertEquals($trevor->id, $threePlayerGameRoundFourFour->active_player_id);
        $this->assertEquals($andy->id, $threePlayerGameRoundThreeThreeThree->active_player_id);
        $this->assertEquals($michelle->id, $threePlayerGameRoundThreeThreeFour->active_player_id);
        $this->assertEquals($trevor->id, $threePlayerGameRoundThreeFourFour->active_player_id);
        $this->assertEquals($andy->id, $threePlayerGameRoundFourFourFour->active_player_id);

        $this->assertEquals($andy->id, $fourPlayerGameRoundThreeThree->active_player_id);
        $this->assertEquals($becca->id, $fourPlayerGameRoundThreeFour->active_player_id);
        $this->assertEquals($dan->id, $fourPlayerGameRoundFourFour->active_player_id);
        $this->assertEquals($pam->id, $fourPlayerGameRoundThreeThreeThree->active_player_id);
        $this->assertEquals($andy->id, $fourPlayerGameRoundThreeThreeFour->active_player_id);
        $this->assertEquals($becca->id, $fourPlayerGameRoundThreeFourFour->active_player_id);
        $this->assertEquals($dan->id, $fourPlayerGameRoundFourFourFour->active_player_id);

        $this->assertEquals($andy->id, $fivePlayerGameRoundThreeThree->active_player_id);
        $this->assertEquals($becca->id, $fivePlayerGameRoundThreeFour->active_player_id);
        $this->assertEquals($dan->id, $fivePlayerGameRoundFourFour->active_player_id);
        $this->assertEquals($pam->id, $fivePlayerGameRoundThreeThreeThree->active_player_id);
        $this->assertEquals($jess->id, $fivePlayerGameRoundThreeThreeFour->active_player_id);
        $this->assertEquals($andy->id, $fivePlayerGameRoundThreeFourFour->active_player_id);
        $this->assertEquals($becca->id, $fivePlayerGameRoundFourFourFour->active_player_id);
    }
}
