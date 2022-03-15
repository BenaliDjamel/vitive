<?php

declare(strict_types=1);

namespace Vitive\projectManagement\domain\user;

use DomainException;
use Vitive\projectManagement\domain\vo\UserId;
use Vitive\projectManagement\domain\vo\EmailAddress;
use Laravel\Sanctum\HasApiTokens;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vitive\projectManagement\domain\Project;

class User // implements \Illuminate\Contracts\Auth\Authenticatable
{

 /*    use \LaravelDoctrine\ORM\Auth\Authenticatable;
    use HasApiTokens; */


    private function __construct(
        private UserId $userId,
        private string $fullname,
        private EmailAddress $email,
        private string $password,
        private Collection $projects = new ArrayCollection()
    ) {
    }

    public static function create(
        UserId $id,
        string $fullname,
        EmailAddress $email,
        string $password
    ): Self {
        $password = trim($password);

        if (mb_strlen($password) < 8) {
            throw new DomainException('Password should at least 8 characters');
        }

        return new Self($id, $fullname, $email, $password);
    }

    public function addProject(Project $project)
    {
        $this->projects->add($project);
    }

    public function fullname()
    {
        return $this->fullname;
    }

    public function email()
    {
        return $this->email->email();
    }

    public function id()
    {
        return $this->userId->id();
    }

    public function projects()
    {
        return $this->projects();
    }

    public function getAuthIdentifierName()
    {
        return 'userId';
    }
}
