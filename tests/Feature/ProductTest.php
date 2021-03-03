<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTests extends TestCase
{
    use RefreshDatabase;

    public function test_see_product_create_form_when_logged()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $resource = $this->get('/dashboard/products/create');
        $resource->assertSeeInOrder(['Add new Product', 'Name', 'Count', 'Price']);
    }

    public function test_cannot_see_product_create_form_when_not_logged_in()
    {
        $resource = $this->get('/dashboard/products/create');
        $resource->assertRedirect('/login');
    }

    public function test_can_add_product_as_logged_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $resource = $this->post('/dashboard/products', [
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $resource->assertRedirect('/dashboard');
        $resource->assertSessionHas('success', 'Product Added Successfully');
        $this->get('/dashboard')->assertSeeText('Example product 1');
    }

    public function test_cannot_add_product_when_not_logged_in()
    {
        $resource = $this->post('/dashboard/products', [
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $resource->assertRedirect('/login');
    }

    public function test_can_see_edit_form_as_logged_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $this->actingAs($user);
        $resource = $this->get('/dashboard/products/'.$product->id.'/edit');
        $resource->assertViewIs('product');
        $resource->assertSee(['Example product 1', '50', '19999']);
    
    }

    public function test_cannot_see_edit_form_when_not_logged_in()
    {
        $product = Product::factory()->create([
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $resource = $this->get('/dashboard/products/'.$product->id.'/edit');
        $resource->assertRedirect('/login');
    }

    public function test_can_edit_product_as_logged_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $this->actingAs($user);
        $resource = $this->put('/dashboard/products/'.$product->id, [
            'name' => 'Modified product name 1',
            'count' => 50,
            'price' => 19999
        ]);
        $resource->assertRedirect('/dashboard');
        $this->followRedirects($resource)->assertSee(['Modified product name 1', '50', '19999']);
    }

    public function test_cannot_edit_product_when_not_logged_in()
    {
        $product = Product::factory()->create([
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $resource = $this->put('/dashboard/products/'.$product->id, [
            'name' => 'Modified product name 1'
        ]);
        $resource->assertRedirect('/login');
    }

    public function test_can_delete_product_as_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $this->actingAs($user);
        $resource = $this->delete('/dashboard/products/'.$product->id);
        $resource->assertRedirect('/dashboard');
        $resource->assertSessionHas('success', 'Product Deleted Successfully');
        $this->followRedirects($resource)->assertDontSee('Example product 1');
    }

    public function test_cannot_delete_product_when_not_logged_in()
    {
        Product::factory()->create([
            'name' => 'Example product 1',
            'count' => 50,
            'price' => 19999
        ]);
        $resource = $this->delete('/dashboard/products/1');
        $resource->assertRedirect('/login');
    }
}
