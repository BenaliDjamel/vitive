<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain\member;

use Vitive\projectManagement\domain\Member;
use Vitive\projectManagement\domain\vo\MemberId;

interface MemberRepository {

    public function ofId(MemberId $id): Member;
    public function save(Member $member): Member;
    public function nextIdentity(): MemberId;
}