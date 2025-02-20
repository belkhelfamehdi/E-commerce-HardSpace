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
use Livewire\Livewire;
use Darryldecode\Cart\Facades\CartFacade as Cart;
class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can create a new product.
     */
    public function test_admin_can_create_product()
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
        $this->assertTrue(Storage::disk('public')->exists('image/products/thumbnail/' . $image->hashName()));
        foreach ($images as $imageFile) {
            $this->assertTrue(Storage::disk('public')->exists('image/products/images/' . $imageFile->hashName()));
        }
        $response->assertRedirect(route('admin.products'))->assertSessionHas('success');
    }

    /**
     * Test if a user can view the product create page.
     */
    public function test_admin_can_access_create_product_page()
    {
        // Créer un admin et l'authentifier
        $admin = Admin::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($admin, 'admin');

        // Créer des catégories et des marques
        $categories = Category::factory()->count(3)->create();
        $brands = Brand::factory()->count(2)->create();

        // Faire la requête GET vers la page de création
        $response = $this->get(route('admin.products.create') );

        // Vérifier que la page est accessible
        $response->assertStatus(200);

        // Vérifier que la vue contient bien les catégories et marques
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('brands', $brands);
    }
    /**
     * Test if a user can update an existing product.
     */
    public function test_admin_can_view_product_edit_page()
    {
        // Create an admin user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a category and brand for the product
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        // Create a product to edit
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Make the GET request to the product edit page
        $response = $this->get(route('admin.products.edit', $product->id));

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the correct product data is passed to the view
        $response->assertViewHas('product', $product);

        // Assert that the categories and brands are passed to the view
        $response->assertViewHas('categories');
        $response->assertViewHas('brands');

        // Optionally, check if the page contains specific data (product name, category, brand)
        $response->assertSee($product->product_name);
        $response->assertSee($category->name);
        $response->assertSee($brand->name);
    }

    /**
     * Test if a user can update an existing product.
     */
    public function test_admin_can_update_product()
    {
        // Create an admin user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a category and brand for the product
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        // Create a product to update
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'product_name' => 'Old Product Name',
            'product_code' => 'Old123',
            'price' => 50,
            'product_qty' => 5,
            'description' => 'Old description',
        ]);

        // Prepare the update data
        $updateData = [
            'product_name' => 'Updated Product Name',
            'product_code' => 'Updated123',
            'price' => 100,
            'product_qty' => 10,
            'description' => 'Updated description',
            'category' => $category->id,
            'brands' => $brand->id,
            'featured' => true,
            'new_arrival' => true,
        ];

        // Prepare an image file for update (fake image for testing)
        $image = UploadedFile::fake()->image('new-thumbnail.jpg');

        // Add the image to the update data
        $updateData['image'] = $image;

        // Make the PUT request to update the product
        $response = $this->put(route('admin.products.update', $product->id), $updateData);

        // Assert that the product's data has been updated in the database
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'product_name' => 'Updated Product Name',
            'product_code' => 'Updated123',
            'price' => 100,
            'product_qty' => 10,
            'description' => 'Updated description',
            'featured' => 1,  // Assuming featured is stored as 1/0
            'new_arrival' => 1,  // Assuming new_arrival is stored as 1/0
        ]);

        // Assert that the old product thumbnail is deleted and the new one is stored
        $this->assertFalse(Storage::disk('public')->exists('image/products/thumbnail/' . $product->product_thumbnail));
        $this->assertTrue(Storage::disk('public')->exists('image/products/' . $image->hashName()));

        // Assert success message and redirection
        $response->assertRedirect(route('admin.products'))->assertSessionHas('success', 'Le produit a été mis à jour.');
    }

    /**
     * Test if a user can delete a product.
        */
    public function test_user_can_delete_product()
    {
        // Create a user (admin) and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a category and brand for the product
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        // Create a product and associated images
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        // Assert the product and images exist in the database
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
        ]);

        // Perform the DELETE request
        $response = $this->delete(route('admin.products.destroy', $product->id));

        // Assert the product is deleted from the database
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);

        // Assert success message
        $response->assertRedirect(route('admin.products'))->assertSessionHas('success');
    }

    /**
     * Test if a user can search for a product.
     */
    public function test_admin_can_search_products()
    {
        // Créer un admin et l'authentifier
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Créer des produits
        $matchingProduct = Product::factory()->create(['product_name' => 'Laptop Gaming']);
        $nonMatchingProduct = Product::factory()->create(['product_name' => 'Smartphone']);

        // Effectuer une requête POST avec un mot-clé de recherche
        $response = $this->postJson(route('search.product'), ['keyword' => 'Laptop']);

        // Vérifier que la réponse est OK (200)
        $response->assertStatus(200);

        // Vérifier que le produit correspondant est bien retourné
        $response->assertJsonFragment([
            'product_name' => 'Laptop Gaming'
        ]);

        // Vérifier que le produit non correspondant n'est pas inclus
        $response->assertJsonMissing([
            'product_name' => 'Smartphone'
        ]);
    }


    /**
     * Test if a user can view the list of products.
     */
    public function test_admin_can_view_products()
    {
        // Create a user and authenticate
        $admin = Admin::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($admin, 'admin');
        // Create a product
        $product = Product::factory()->create();
        // Make the GET request to the product list page
        $response = $this->get(route('admin.products'));
        // Assert the response is successful and contains the product data
        $response->assertStatus(200);
        $response->assertViewHas('products');
        $response->assertSee($product->product_name);
    }

}
