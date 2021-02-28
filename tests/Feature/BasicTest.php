<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicTests extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_view_exists()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function test_see_login_and_register_button_when_not_logged()
    {
        $response = $this->get('/');
        $response->assertSeeText('Login');
        $response->assertSeeText('Register');
    }

    public function test_not_see_login_and_register_button_when_logged_in()
    {
        $response = $this->get('/');
        $response->assertDontSeeText('Login');
        $response->assertDontSeeText('Register');
    }

    public function test_see_username_button_when_logged_in()
    {
        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);
        $this->actingAs($user);
        $response = $this->get('/');
        $response->assertSeeText('John Doe');
    }
}
