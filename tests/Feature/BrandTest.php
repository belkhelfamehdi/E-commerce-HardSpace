<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Admin; // Use Admin model instead of User
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the index page displays the brands.
     */
    public function test_admin_can_view_brands_list()
    {
        $admin = Admin::factory()->create(); // Create an admin
        $this->actingAs($admin, 'admin'); // Specify the guard if applicable

        Brand::factory()->create();

        $response = $this->get(route('admin.brand'));

        $response->assertStatus(200);
        $response->assertViewHas('brands');
    }

    /**
     * Test if the create page is accessible.
     */
    public function test_admin_can_access_create_brand_page()
    {
        $admin = Admin::factory()->create(); // Use Admin model
        $this->actingAs($admin, 'admin'); // Specify the guard if applicable

        $response = $this->get(route('admin.brand.create'));

        $response->assertStatus(200);
    }

    /**
     * Test if a brand can be created.
     */
    public function test_admin_can_create_a_brand()
    {
        $admin = Admin::factory()->create(); // Use Admin model
        $this->actingAs($admin, 'admin'); // Specify the guard if applicable

        $response = $this->post(route('admin.brand.store'), [
            'brand_name' => 'Nike',
        ]);

        $response->assertRedirect(route('admin.brand'));
        $this->assertDatabaseHas('brands', ['brand_name' => 'Nike']);
    }

    /**
     * Test if a brand can be updated.
     */
    public function test_admin_can_update_a_brand()
    {
        $admin = Admin::factory()->create(); // Use Admin model
        $this->actingAs($admin, 'admin'); // Specify the guard if applicable

        $brand = Brand::factory()->create(['brand_name' => 'Old Name']);

        $response = $this->put(route('admin.brand.update', $brand->id), [
            'brand_name' => 'Updated Name',
        ]);

        $response->assertRedirect(route('admin.brand'));
        $this->assertDatabaseHas('brands', ['brand_name' => 'Updated Name']);
    }

    /**
     * Test if a brand can be deleted.
     */
    public function test_admin_can_delete_a_brand()
    {
    $admin = Admin::factory()->create(); // Use Admin model
    $this->actingAs($admin, 'admin'); // Specify the guard if applicable

    $brand = Brand::factory()->create(); // Create a single brand

    $response = $this->delete(route('admin.brand.destroy', $brand->id)); // Ensure $brand is a single instance

    $response->assertRedirect(route('admin.brand'));
    $this->assertDatabaseMissing('brands', ['id' => $brand->id]); // Assert the brand is deleted
    }

    /**
     * Test if search returns correct brands.
     */
    public function test_admin_can_search_brands()
    {
        $admin = Admin::factory()->create(); // Use Admin model
        $this->actingAs($admin, 'admin'); // Specify the guard if applicable

        Brand::factory()->create(['brand_name' => 'Adidas']);
        Brand::factory()->create(['brand_name' => 'Puma']);

        $response = $this->post(route('search.brand'), ['keyword' => 'Adi']);

        $response->assertJsonFragment(['brand_name' => 'Adidas']);
        $response->assertJsonMissing(['brand_name' => 'Puma']);
    }
}
