<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectIfAuthenticatedTest extends TestCase
{
    use RefreshDatabase; // Ensures a fresh database for each test

    public function test_authenticated_user_is_redirected_from_guest_routes()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Define routes that should be restricted for authenticated users
        $guestRoutes = [
            route('login'),
            route('register')
        ];

        foreach ($guestRoutes as $route) {
            // Send a GET request to a guest-only route
            $response = $this->get($route);

            // Assert the user is redirected to the home page
            $response->assertRedirect(RouteServiceProvider::HOME);
        }
    }

    public function test_guest_can_access_guest_routes()
    {
        // Define routes that should be accessible to guests
        $guestRoutes = [
            route('login'),
            route('register')
        ];

        foreach ($guestRoutes as $route) {
            // Send a GET request as a guest
            $response = $this->get($route);

            // Assert successful access (status 200)
            $response->assertStatus(200);
        }
    }
}
