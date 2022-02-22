<?php

declare(strict_types=1);

namespace Tests\projectManagement\common;

use Vitive\projectManagement\domain\member\Member;
use Vitive\projectManagement\domain\vo\MemberId;

final class MemberFactory
{


    private function __construct()
    {
    }

    public static function create(
        string $fullname = "djamel benali",
        string $email = "djamel@benali.com"
    ): Member {
        $member =  Member::create(
            MemberId::fromString("48e42502-79ee-47ac-b085-4571fc0f719c"),
            $fullname,
            $email
        );

        return $member;
    }
}
