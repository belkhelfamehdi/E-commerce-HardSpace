<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
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

    public function test_validation_fails_on_invalid_data(): void
    {
        $this->actingAs($user = User::factory()->create());

        // Testing invalid email
        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', ['FirstName' => 'Test', 'LastName' => 'Test', 'email' => 'invalid-email'])
                ->call('updateProfileInformation')
                ->assertHasErrors(['email' => 'email']);

        // Testing missing FirstName and LastName
        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', ['FirstName' => '', 'LastName' => '', 'email' => 'test@example.com'])
                ->call('updateProfileInformation')
                ->assertHasErrors(['FirstName', 'LastName']);
    }

    public function test_email_verification_is_sent_on_email_change(): void
    {
        Notification::fake(); // Fake notifications to avoid actually sending emails

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', ['FirstName' => 'Test', 'LastName' => 'Test', 'email' => 'mehdibelkhelfa6@gmail.com'])
                ->call('updateProfileInformation');

        // Check if email verification was sent
        Notification::assertSentTo($user, \Illuminate\Auth\Notifications\VerifyEmail::class);
    }
}
