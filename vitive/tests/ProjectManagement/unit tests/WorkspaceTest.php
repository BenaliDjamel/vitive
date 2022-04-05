<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;
use Vitive\ProjectManagement\Domain\Workspace\Workspace;

final class WorkspaceTest extends TestCase
{


    /**
     * @test
     */
    public function it_create_a_workspace()
    {
        $workspace = Workspace::create(
            WorkspaceId::fromString('55e42502-79ee-47ac-b085-4571fc0f719c'),
            'IT',
            UserId::fromString('65e42502-79ee-47ac-b085-4571fc0f719c')
        );

        $this->assertEquals('IT', $workspace->name());
        $this->assertEquals(
            '65e42502-79ee-47ac-b085-4571fc0f719c',
            $workspace->creator()
        );
    }

    /**
     * @test
     */
    public function it_create_workspace_with_empty_name_throws_exception()
    {
        $this->expectException(DomainException::class);

        Workspace::create(
            WorkspaceId::fromString('55e42502-79ee-47ac-b085-4571fc0f719c'),
            '',
            UserId::fromString('65e42502-79ee-47ac-b085-4571fc0f719c')
        );
    }

    /**
     * @test
     */
    public function it_changes_workspace_name()
    {
        $workspace = Workspace::create(
            WorkspaceId::fromString('55e42502-79ee-47ac-b085-4571fc0f719c'),
            'IT',
            UserId::fromString('65e42502-79ee-47ac-b085-4571fc0f719c')
        );

        $workspace->changeName("IT-V2");

        $this->assertEquals("IT-V2", $workspace->name());
    }
}
