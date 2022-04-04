<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\User;

use DomainException;
use Vitive\ProjectManagement\Application\Commands\User\SignUpUserRequest;
use Vitive\ProjectManagement\Domain\User\User;
use Vitive\ProjectManagement\Domain\User\UserRepository;
use Vitive\ProjectManagement\Domain\vo\EmailAddress;

final class SignUpUser
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(SignUpUserRequest $request)
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

        return $user;

     //   return new UserResponse($user->id(), $user->fullname(), $user->email());
    }
}
