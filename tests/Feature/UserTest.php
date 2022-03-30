<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    private function signupUser(
        string $fullname = "djamel benali",
        string $email = "djamel@benali.com",
        string $password = "12345678"
    ) {
        return $this->withoutExceptionHandling()->postJson('/api/signup', [
            "fullname" => $fullname,
            "email" => $email,
            "password" => $password
        ]);
    }

    /**
     * @test
     */
    public function already_existing_email_should_throw_an_exception()
    {

        $this->expectException(ValidationException::class);

        $this->signupUser();
        $this->signupUser();
    }

    /**
     * @test
     */
    public function empty_password_throw_an_exception()
    {
        $this->expectException(ValidationException::class);
        $this->signupUser(password: " ");
    }

    /**
     * @test
     */
    public function fullname_less_than_two_characters_throw_an_exception()
    {
        $this->expectException(ValidationException::class);
        $this->signupUser(fullname: "d");
    }

    /**
     * @test
     */
    public function fullname_more_than_twenty_characters_throw_an_exception()
    {
        $this->expectException(ValidationException::class);
        $this->signupUser(fullname: "ddddddddddddddddddddd");
    }

    /**
     * @test
     */
    public function register_user()
    {
        $response = $this->postJson('/register', [
            'fullname' => 'Test User',
            'email' => 'test123@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();

        $this->assertDatabaseHas('users', [
            'email' => 'test123@example.com',
            'fullname' => 'Test User'
        ]);
    }

    /**
     * @test
     */
    public function login_user()
    {

        $user = User::factory()->create();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /**
     * @test
     */
    public function logout_user()
    {
        $response = $this->postJson('/logout');

        $this->assertGuest();
    }
}
