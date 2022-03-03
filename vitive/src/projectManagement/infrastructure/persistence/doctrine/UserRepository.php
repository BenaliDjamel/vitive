<?php

namespace Vitive\projectManagement\infrastructure\persistence\doctrine;

use Doctrine\ORM\EntityManager;
use DomainException;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\user\UserRepository as UserRepositoryInterface;
use Vitive\projectManagement\domain\user\User;
use Vitive\projectManagement\domain\vo\EmailAddress;
use Vitive\projectManagement\domain\vo\UserId;

class UserRepository implements UserRepositoryInterface
{

    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }


    public function ofId(UserId $id): User
    {
        $user = $this->repository->findOneBy(['userId' => $id->id()]);
        if (is_null($user)) {
            throw new \Exception('User not found');
        }

        return $user;
    }

    public function ofEmail(EmailAddress $email)
    {
        $user = $this->repository->findOneBy(['email' => $email->email()]);
       /*  if (!is_null($user)) {
            throw new DomainException('User already exist');
        }
 */
        return $user;
    }

    public function save(User $user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    public function update()
    {
        $this->entityManager->flush();
    }

    public function remove(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function nextIdentity(): UserId
    {
        return UserId::fromString(Uuid::uuid4()->toString());
    }
}
