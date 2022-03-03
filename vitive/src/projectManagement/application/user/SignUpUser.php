<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\user;

use DomainException;
use Vitive\projectManagement\application\commands\user\SignUpUserRequest;
use Vitive\projectManagement\application\commands\user\UserResponse;
use Vitive\projectManagement\domain\user\User;
use Vitive\projectManagement\domain\user\UserRepository;
use Vitive\projectManagement\domain\vo\EmailAddress;

final class SignUpUser
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(SignUpUserRequest $request): UserResponse
    {
        $email = EmailAddress::fromString($request->email);

        $user = $this->userRepository->ofEmail($email);

        if ($user) {
            throw new DomainException("User already exist");
        }

        $user = User::create(
            $this->userRepository->nextIdentity(),
            $request->fullname,
            $email,
            $request->password
        );
        $this->userRepository->save($user);

        return new UserResponse($user->id(), $user->fullname(), $user->email());
    }
}
