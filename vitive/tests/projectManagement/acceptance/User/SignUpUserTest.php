<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\application\commands\user\SignUpUserRequest;
use Vitive\projectManagement\application\user\SignUpUser;
use Vitive\projectManagement\domain\user\UserRepository;
use Vitive\projectManagement\infrastructure\persistence\UserInMemoryRepository;

final class SignUpUserTest extends TestCase
{

    private UserRepository $userRepository;
    private SignUpUser $signUpUser;



    protected function setUp(): void
    {

        $this->userRepository = new UserInMemoryRepository();
        $this->signUpUser = new SignUpUser($this->userRepository);
    }

    /**
     * @test
     */
    public function it_signup_a_new_user()
    {
        $response = $this->signup_a_user();

        $this->assertEquals("djamel@benali.com", $response->email());
    }

    /**
     * @test
     */
    public function already_existing_email_should_throw_an_exception()
    {

        $this->expectException(DomainException::class);
        $this->signup_a_user();
        $this->signup_a_user();
    }

    private function signup_a_user()
    {
        return $this->signUpUser->execute(new SignUpUserRequest(
                "djamel benali",
                "djamel@benali.com",
                "12345678"
            ));
    }
}
