<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\ProjectManagement\Common\UserFactory;

final class UserTest extends TestCase
{

    /**
     * @test
     */
    public function it_create_a_user()
    {
        $user =  UserFactory::create();

        $this->assertSame("djamel benali", $user->fullname());
        $this->assertSame("djamel@benali.com", $user->email());
    }

    /**
     * @test
     */
    public function empty_password_should_throw_exception()
    {
        $this->expectException(DomainException::class);

        UserFactory::create(password: '');
    }

    /**
     * @test
     */
    public function empty_email_should_throw_exception()
    {
        $this->expectException(DomainException::class);

        UserFactory::create(email: '   ');
    }

     /**
     * @test
     */
    public function invalid_email_should_throw_exception() {
        $this->expectException(InvalidArgumentException::class);
        UserFactory::create(email:"invalid@error");
    }

    /**
     * @test
     */
    public function it_should_santize_email() {
        $user =  UserFactory::create(email: "DJAMEl@BENalI.COm");
        $this->assertSame("djamel@benali.com", $user->email());
    }

     /**
     * @test
     */
    public function password_less_then_eight_should_throw_exception()
    {
        $this->expectException(DomainException::class);

        UserFactory::create(password: 'ff4546é');
    }

   
}
