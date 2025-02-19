<?php
namespace Tests\Feature;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if a user can create a new product.
     */
    public function test_supplier_can_create_product()
    {
        // Create a user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
        // Create category and brand for the product
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        // Prepare the file for the product image
        Storage::fake('public');
        $image = UploadedFile::fake()->image('thumbnail.jpg');
        $images = [
            UploadedFile::fake()->image('image1.jpg'),
            UploadedFile::fake()->image('image2.jpg'),
        ];
        // Prepare the request data
        $data = [
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'product_name' => 'Test Product',
            'product_code' => 'T123',
            'product_qty' => 10,
            'price' => 100,
            'image' => $image,
            'images' => $images,
            'description' => 'Test product description',
        ];
        // Make the POST request
        $response = $this->post(route('admin.products.store'), $data);
        // Assert product has been created
        $this->assertDatabaseHas('products', [
            'product_name' => 'Test Product',
            'product_code' => 'T123',
            'price' => 100,
        ]);
        // Assert the images are stored
        $this->assertTrue(Storage::disk('public')->exists('image/products/thumbnail/' . $image->hashName()));
        foreach ($images as $imageFile) {
            $this->assertTrue(Storage::disk('public')->exists('image/products/images/' . $imageFile->hashName()));
        }
        // Assert success message
        $response->assertRedirect(route('admin.products'))->assertSessionHas('success');
    }
    /**
     * Test if a user can update an existing product.
     */
    public function test_user_can_update_product()
    {
        // Create a user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
        // Create a category and brand for the product
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        // Create a product to update
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);
        // Prepare the update data
        $updateData = [
            'brand_id' => $brand->id,
            'category' => $category->id,
            'product_name' => 'Updated Product',
            'product_code' => 'T124',
            'product_qty' => 20,
            'price' => 150,
            'description' => 'Updated product description',
        ];
        // Make the PUT request to update the product
        $response = $this->put(route('admin.products.update', $product->id), $updateData);
        // Assert product has been updated
        $this->assertDatabaseHas('products', [
            'product_name' => 'Updated Product',
            'product_code' => 'T124',
            'price' => 150,
        ]);
        // Assert success message
        $response->assertRedirect(route('admin.products'))->assertSessionHas('success');
    }
    /**
     * Test if a user can delete a product.
     */
    public function test_user_can_delete_product()
    {
        // Create a user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
        // Create a category and brand for the product
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        // Create a product to delete
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);
        // Make the DELETE request to delete the product
        $response = $this->delete(route('admin.products.destroy', $product->id));
        // Assert product has been deleted
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
        // Assert success message
        $response->assertRedirect(route('admin.products'))->assertSessionHas('success');
    }
    /**
     * Test if a user can view the list of products.
     */

}
