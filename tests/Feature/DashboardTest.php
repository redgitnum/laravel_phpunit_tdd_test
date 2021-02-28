<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTests extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_dashboard_when_logged_in()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_redirect_to_homepage_when_accessing_dashboard_as_guest()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/');
    }

    public function test_can_see_products_table_in_dashboard()
    {
        $user = User::factory()->create();
        Product::factory()->count(10)->create();

        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertSeeText('Products');
        $response->assertViewHas('products');
    }

}
