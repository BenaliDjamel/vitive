<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\ProjectManagement\Common\MemberFactory;

final class MemberTest  extends TestCase
{


    /**
     * @test
     */
    public function it_create_a_member()
    {
        $member =  MemberFactory::create();

        $this->assertSame("djamel benali", $member->fullname());
        $this->assertSame("djamel@benali.com", $member->email());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_fullname_is_empty()
    {
        $this->expectException(DomainException::class);

        $member =  MemberFactory::create(fullname: ' ');
    }
}
