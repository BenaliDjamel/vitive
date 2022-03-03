<?php

declare(strict_types=1);
namespace Vitive\projectManagement\domain\user;

use Vitive\projectManagement\domain\user\User;
use Vitive\projectManagement\domain\vo\EmailAddress;
use Vitive\projectManagement\domain\vo\UserId;

interface UserRepository {

    public function ofId(UserId $id): User;
    public function ofEmail(EmailAddress $email);
    public function save(User $project): User;
    public function nextIdentity(): UserId;
}