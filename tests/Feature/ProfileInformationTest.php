<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    /** @skip */
    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->FirstName, $component->state['FirstName']);
        $this->assertEquals($user->LastName, $component->state['LastName']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', ['FirstName' => 'Test', 'LastName' => 'Test', 'email' => 'midou8687@gmail.com'])
                ->call('updateProfileInformation');

        $this->assertEquals('Test', $user->fresh()->FirstName);
        $this->assertEquals('Test', $user->fresh()->LastName);
        $this->assertEquals('midou8687@gmail.com', $user->fresh()->email);
    }
}
