<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\vo\UserId;
use Vitive\projectManagement\domain\vo\WorkspaceId;
use Vitive\projectManagement\domain\Workspace\Workspace;

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
}
