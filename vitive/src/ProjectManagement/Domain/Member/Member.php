<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\Member;

use DomainException;
use Vitive\ProjectManagement\Domain\vo\MemberId;

 class Member
{

    private function __construct(private MemberId $memberId, private string $fullname, private string $email)
    {
    }

    public static function create(MemberId $memberId, string $fullname, string $email)
    {

        if (!trim($fullname)) {
            throw new DomainException('Member fullname cannot be empty.');
        }

        return new Self($memberId, $fullname, $email);
    }

    public function id(): string
    {
        return $this->memberId->id();
    }

    public function fullname(): string
    {
        return $this->fullname;
    }

    public function email()
    {
        return $this->email;
    }
}
