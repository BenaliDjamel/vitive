<?php

namespace Tests\Feature;

use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
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

    private function signupUser()
    {
        return $this->withoutExceptionHandling()->postJson('/api/signup', [
            "fullname" => "djamel benali",
            "email" => "djamel@Benali.Com",
            "password" => "12345678"
        ]);
    }

    /**
     * @test
     */
    public function already_existing_email_should_throw_an_exception()
    {

        $this->expectException(DomainException::class);

        $this->signupUser();
        $this->signupUser();
    }
}
