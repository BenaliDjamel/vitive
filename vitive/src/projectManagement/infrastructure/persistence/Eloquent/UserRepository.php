<?php

namespace Vitive\projectManagement\infrastructure\persistence\Eloquent;

use App\Models\User as UserEloquent;
use DomainException;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\user\UserRepository as UserRepositoryInterface;
use Vitive\projectManagement\domain\user\User;
use Vitive\projectManagement\domain\vo\EmailAddress;
use Vitive\projectManagement\domain\vo\UserId;

class UserRepository implements UserRepositoryInterface
{


    public function ofId(UserId $id): User
    {
        $user = UserEloquent::where('id', $id->id())->first();

        if (is_null($user)) {
            throw new \Exception('User not found');
        }

        return User::create(
            UserId::fromString($user->id),
            $user->fullname,
            EmailAddress::fromString($user->email),
            $user->password
        );
    }

    public function ofEmail(EmailAddress $email)
    {
        $user = UserEloquent::where('email', $email->email())->first();
        if ($user) {
            return User::create(
                UserId::fromString($user->id),
                $user->fullname,
                EmailAddress::fromString($user->email),
                $user->password
            );
        }

        
    }

    public function save(User $userEntity): User
    {
        $user = new UserEloquent();
        $user->id = $userEntity->id();
        $user->fullname = $userEntity->fullname();
        $user->email = $userEntity->email();
        $user->password = $userEntity->password();

        $user->save();

        return $userEntity;
    }

    /*  public function update(User $userEntity)
    {
        $user = UserEloquent::where('id', $userEntity->id());
        $user->fullname = $userEntity->fullname();
        $user->email = $userEntity->email();
        $user->password = $userEntity->password();

        $user->save();
    } */

    public function remove(User $userEntity)
    {
        $user = UserEloquent::where('id', $userEntity->id());

        $user->delete();
    }

    public function nextIdentity(): UserId
    {
        return UserId::fromString(Uuid::uuid4()->toString());
    }
}
