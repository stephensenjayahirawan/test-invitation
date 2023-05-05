<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManagerProductTest extends TestCase
{
    use RefreshDatabase;
   
    private User $user;

    protected function setUp(): void{
        parent::setUp();
        $this->user = $this->create_user();
    }
     
    public function create_user(){
        return User::factory()->create([
            'role' => 'manager',
        ]);
    }

    public function test_guest_access_products_page()
    {

        
        $response = $this->get('/products');

        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    public function test_access_products_page()
    {
        
        
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
    }

    public function test_access_create_products_page()
    {   
        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(200);
    }

    public function test_create_products()
    { 
        Storage::fake('public/product');
        $product = [
            'name' => 'Blackp[ink',
            'sku' => 'bp',
            'description' => 'Lorem Ipsum',
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ];
        
        
        $response = $this->actingAs($this->user)->post('/products', $product);

        $response->assertStatus(302);
        $response->assertRedirectToRoute( 'products' );
        $this->assertDatabaseHas( table: 'products' , data: [
            'name' => 'Blackp[ink',
            'sku' => 'bp',
            'description' => 'Lorem Ipsum',
        ]);
    }

    public function test_see_detail_products_page()
    { 
        $product = Product::factory()->create([
            'created_by' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->get('/products/show/'. $product->sku);

        $response->assertStatus(200);
        $response->assertSee("Update");
    }

    public function test_update_products()
    { 
        $product = Product::factory()->create([
            'created_by' => $this->user->id
        ]);
        
        $response = $this->actingAs($this->user)->put('/products/update/'. $product->sku, $product->toArray());

        $response->assertStatus(302);
        $response->assertRedirectToRoute('products');
    }

    public function test_see_other_manager_products()
    { 
        $product = Product::factory()->create([
            'created_by' => rand(100, 999)
        ]);
        
        $response = $this->actingAs($this->user)->get('/products/show/'. $product->sku);

        $response->assertStatus(403);
    }

    public function test_update_other_manager_products()
    { 
        $product = Product::factory()->create([
            'created_by' => rand(100, 999)
        ]);
        
        $response = $this->actingAs($this->user)->get('/products/show/'. $product->sku);

        $response->assertStatus(403);
    }

    public function test_delete_products()
    { 
        $product = Product::factory()->create([
            'created_by' => $this->user->id
        ]);
        $this->assertDatabaseHas( table: 'products' , data: [
            'sku' => $product->sku
        ]);
        $response = $this->actingAs($this->user)->delete('/products/delete/'. $product->sku);

        $this->assertDatabaseMissing( table: 'products' , data: [
            'sku' => $product->sku
        ]);
        $response->assertStatus(302);
        $response->assertRedirectToRoute( 'products' );
    }

    public function test_unique_sku()
    { 
       
        Storage::fake('public/product');
        $product = [
            'name' => 'Blackp[ink',
            'sku' => 'bp',
            'description' => 'Lorem Ipsum',
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ];
        
        $response = $this->actingAs($this->user)->post('/products', $product);
        
        $response->assertStatus(302);
        $response->assertRedirectToRoute( 'products' );
        $this->assertDatabaseHas( table: 'products' , data: [
            'sku' => $product['sku']
        ]);

        $product = [
            'name' => 'Blackp[ink',
            'sku' => 'bp',
            'description' => 'Lorem Ipsum',
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ];
        
        $response = $this->actingAs($this->user)->post('/products', $product);
        $response->assertSessionHasErrors('sku');
    }
    
}
