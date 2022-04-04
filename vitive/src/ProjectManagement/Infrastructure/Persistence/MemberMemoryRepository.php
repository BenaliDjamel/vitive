<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\infrastructure\persistence;

use DomainException;
use Vitive\ProjectManagement\domain\member\MemberRepository;
use Ramsey\Uuid\Uuid;
use Vitive\ProjectManagement\domain\member\Member;
use Vitive\ProjectManagement\domain\vo\MemberId;

final class MemberMemoryRepository implements MemberRepository
{


    private array $members = [];

    public function ofId(MemberId $id): Member
    {
        if (!isset($this->members[$id->id()])) {
            throw new DomainException("Member does not found");
        }

        return $this->members[$id->id()];
    }

    public function save(Member $member): Member
    {

        $this->members[$member->id()] = $member;

        return $this->members[$member->id()];
    }

    public function nextIdentity(): MemberId
    {
        return MemberId::fromString(Uuid::uuid4()->toString());
    }
    
    public function update() {
        
    }
}
