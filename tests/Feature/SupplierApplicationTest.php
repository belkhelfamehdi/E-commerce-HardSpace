<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\SupplierApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
class SupplierApplicationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /** @test */
    public function display_the_supplier_application_form()
    {
        $user = User::factory()->create(['role' => 'user', 'email_verified_at' => now()]);
        $response = $this->actingAs($user)->get(route('supplier.application'));
        $response->assertStatus(200);
        $response->assertViewIs('frontend.frontend_layout.supplier');
    }
    /** @test */
    public function admin_can_store_a_new_supplier_application()
    {
        $user = User::factory()->create(['role' => 'user', 'email_verified_at' => now()]);
        $data = [
            'company_name' => $this->faker->company,
            'company_email' => $this->faker->unique()->safeEmail,
            'company_number' => $this->faker->phoneNumber,
            'company_country' => $this->faker->country,
            'company_street' => $this->faker->streetAddress,
            'company_city' => $this->faker->city,
            'company_state' => $this->faker->state,
            'company_zip' => $this->faker->postcode,
            'message' => $this->faker->paragraph,
        ];
        $response = $this->actingAs($user)->post(route('supplier.application.send'), $data);
        $response->assertRedirect(route('supplier.application'));
        $response->assertSessionHas('success', 'Informations envoyé.');
        $this->assertDatabaseHas('supplier_applications', [
            'user_id' => $user->id,
            'company_name' => $data['company_name'],
            'company_email' => $data['company_email'],
            'company_number' => $data['company_number'],
            'company_country' => $data['company_country'],
            'company_street' => $data['company_street'],
            'company_city' => $data['company_city'],
            'company_state' => $data['company_state'],
            'company_zip' => $data['company_zip'],
            'message' => $data['message'],
        ]);
    }
    /** @test */
    public function admin_can_accept_a_supplier_application()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create(['role' => 'user', 'email_verified_at' => now()]);
        $application = SupplierApplication::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($admin, 'admin')->put(route('admin.applications.accept', $application->id));
        $response->assertRedirect(route('admin.applications'));
        $response->assertSessionHas('success', 'Application accepté.');
        $this->assertDatabaseHas('supplier_applications', [
            'id' => $application->id,
            'statut' => 'accept',
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => 'supplier',
        ]);
    }
    /** @test */
    public function admin_can_reject_a_supplier_application()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create(['role' => 'user', 'email_verified_at' => now()]);
        $application = SupplierApplication::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($admin, 'admin')->put(route('admin.applications.reject', $application->id));
        $response->assertRedirect(route('admin.applications'));
        $response->assertSessionHas('success', 'Application rejeté.');
        $this->assertDatabaseHas('supplier_applications', [
            'id' => $application->id,
            'statut' => 'reject',
        ]);
    }

}
