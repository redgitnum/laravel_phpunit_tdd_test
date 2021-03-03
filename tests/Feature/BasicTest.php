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
        $response = $this->view('home');
        $response->assertSeeText('Login');
        $response->assertSeeText('Register');
    }

    public function test_cannot_see_login_and_register_button_when_logged_in()
    {
        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);
        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertDontSeeText('Login');
        $response->assertDontSeeText('Register');
        $response->assertSeeText($user->name);

    }

    public function test_see_username_button_when_logged_in()
    {
        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);
        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertSee('John Doe');
    }
}
