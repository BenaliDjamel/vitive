<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\Member;

use Vitive\ProjectManagement\Domain\Member\Member;
use Vitive\ProjectManagement\Domain\vo\MemberId;

interface MemberRepository
{

    public function ofId(MemberId $id): Member;
    public function save(Member $member): Member;
    public function nextIdentity(): MemberId;
}
