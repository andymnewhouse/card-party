<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\Settings;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use MailCoachSeeder;
use Tests\TestCase;

/**
 * @see \App\Http\Livewire\Settings
 */
class SettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_update_name()
    {
        $this->seed(MailCoachSeeder::class);

        $user = factory(User::class)->create(['name' => 'Rebecca']);

        Livewire::test(Settings::class)
            ->set('name', 'Becca')
            ->call('updateProfile')
            ->assertEmitted('notify');

        $this->assertEquals('Becca', $user->fresh()->name);
    }

    /** @test */
    public function can_update_email()
    {
    }

    /** @test */
    public function can_update_name_and_email()
    {
    }

    /** @test */
    public function can_update_password()
    {
    }

    /** @test */
    public function can_update_notifications()
    {
    }

    /** @test */
    public function can_delete_account()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        Livewire::test(Settings::class)
            ->call('deleteAccount');

        $this->assertNull(User::find($user->id));
    }
}
