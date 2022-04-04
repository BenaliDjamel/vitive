<?php

declare(strict_types=1);
namespace Vitive\ProjectManagement\Domain\User;

use Vitive\ProjectManagement\Domain\User\User;
use Vitive\ProjectManagement\Domain\vo\EmailAddress;
use Vitive\ProjectManagement\Domain\vo\UserId;

interface UserRepository {

    public function ofId(UserId $id): User;
    public function ofEmail(EmailAddress $email);
    public function save(User $project): User;
    public function nextIdentity(): UserId;
}