<?php

namespace Tests\Feature;

use DomainException;
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
    public function it_signup_a_user()
    {
        $response = $this->signupUser();

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'djamel@benali.com',
            'fullname' => 'djamel benali'
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
    public function register_user() {
         $fullname = "djamel benali";
         $email = "djamel@benali.com";
         $password = "aa12345678";

        $response = $this->withoutExceptionHandling()->postJson('/register', [
            "fullname" => $fullname,
            "email" => $email,
            "password" => $password,
            'password_confirmation' => $password
        ]);


        $response->assertStatus(204);

        $this->assertDatabaseHas('users', [
            'email' => 'djamel@benali.com',
            'fullname' => 'djamel benali'
        ]);
    }
}
