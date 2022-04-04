<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\User;

use DomainException;
use Vitive\ProjectManagement\Domain\Project;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\vo\EmailAddress;

class User
{

    private function __construct(
        private UserId $userId,
        private string $fullname,
        private EmailAddress $email,
        private string $password,
        private  $projects = []
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

    public function password()
    {
        return $this->password;
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
