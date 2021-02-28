<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTests extends TestCase
{

    public function test_login_view_exists()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertLocation('/login');
    }

    public function test_register_view_exists()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertLocation('/register');
    }

    public function test_redirect_to_dashboard_from_login_or_register_if_logged_in()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $loginResponse = $this->get('/login');
        $loginResponse->assertRedirect('/dashboard');

        $registerResponse = $this->get('/register');
        $registerResponse->assertRedirect('/dashboard');
    }

    public function test_can_login_with_valid_credentials()
    {
        User::factory()->create([
            'email' => 'test@email.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/login', [
            'email' => 'test@email.com',
            'password' => 'password',
        ]);
        $response->assertRedirect('/dashboard');
        $response->assertSessionHasNoErrors();
        $this->assertAuthenticated();     
    }

    public function test_cannot_login_with_invalid_credentials()
    {
        User::factory()->create([
            'email' => 'test@email.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/login', [
            'email' => 'test@email.com',
            'password' => 'wrongpassword',
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_can_register_with_valid_input()
    {
        $response = $this->post('/register', [
            'name' => 'Test username',
            'email' => 'test@email.com',
            'password' => 'password',
            'confirm_password' => 'password'
        ]);
        $this->assertDatabaseHas('users', ['email', 'test@email.com']);
        $response->assertRedirect('/login');
    }

    public function test_cannot_register_with_invalid_input()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@email.com',
            'password' => 'password',
            'confirm_password' => 'password'
        ]);
        $this->assertDatabaseMissing('users', ['email', 'test@email.com']);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors();
    }
}
