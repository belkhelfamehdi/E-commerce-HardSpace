<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the index page displays categories.
     */
    public function test_admin_can_view_categories_list()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Category::factory()->count(5)->create();

        $response = $this->get(route('admin.category'));

        $response->assertStatus(200);
        $response->assertViewHas('categories');
    }

    /**
     * Test if the create page is accessible.
     */
    public function test_admin_can_access_create_category_page()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.category.create'));

        $response->assertStatus(200);
    }

    /**
     * Test if a category can be created.
     */
    public function test_admin_can_create_a_category()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('admin.category.store'), [
            'category_name' => 'Electronics',
        ]);

        $response->assertRedirect(route('admin.category'));
        $this->assertDatabaseHas('categories', ['category_name' => 'Electronics']);
    }

    /**
     * Test if a category can be updated.
     */
    public function test_admin_can_update_a_category()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $category = Category::factory()->create(['category_name' => 'Old Category']);

        $response = $this->put(route('admin.category.update', $category->id), [
            'category_name' => 'Updated Category',
        ]);

        $response->assertRedirect(route('admin.category'));
        $this->assertDatabaseHas('categories', ['category_name' => 'Updated Category']);
    }

    /**
     * Test if a category can be deleted.
     */
    public function test_admin_can_delete_a_category()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $category = Category::factory()->create();

        $response = $this->delete(route('admin.category.destroy', $category->id));

        $response->assertRedirect(route('admin.category'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Test if category search works.
     */
    public function test_admin_can_search_categories()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Category::factory()->create(['category_name' => 'Electronics']);
        Category::factory()->create(['category_name' => 'Furniture']);

        $response = $this->post(route('search.category'), ['keyword' => 'Electro']);

        $response->assertJsonFragment(['category_name' => 'Electronics']);
        $response->assertJsonMissing(['category_name' => 'Furniture']);
    }
}
