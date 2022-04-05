<?php

namespace Vitive\ProjectManagement\Infrastructure\Persistence\Eloquent;

use Ramsey\Uuid\Uuid;
use App\Models\Workspace as WorkspaceEloquent;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;
use Vitive\ProjectManagement\Domain\Workspace\Workspace;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository as WorkspacerepositoryInterface;

class WorkspaceRepository implements WorkspacerepositoryInterface
{



    public function ofId(WorkspaceId $id): Workspace
    {
        $workspace = WorkspaceEloquent::where('id', $id->id())->first();

        if (is_null($workspace)) {
            throw new \Exception('Workspace not found');
        }

        return Workspace::create(
            WorkspaceId::fromString($workspace->id),
            $workspace->name,
            UserId::fromString($workspace->creator_id),
        );
    }

    public function save(Workspace $workspaceEntity): Workspace
    {
        $workspace = new WorkspaceEloquent();
        $workspace->id = $workspaceEntity->id();
        $workspace->name = $workspaceEntity->name();
        $workspace->creator_id = $workspaceEntity->creator();
        $workspace->save();

        return $workspaceEntity;
    }

    public function update(Workspace $workspaceEntity)
    {
        $workspace = WorkspaceEloquent::where('id', $workspaceEntity->id())->first();
        $workspace->name = $workspaceEntity->name();
        $workspace->creator_id = $workspaceEntity->creator();
        $workspace->save();
    }

    public function remove(Workspace $workspaceEntity)
    {
        $workspace = WorkspaceEloquent::where('id', $workspaceEntity->id());

        $workspace->delete();
    }


    public function nextIdentity(): WorkspaceId
    {
        return WorkspaceId::fromString(Uuid::uuid4()->toString());
    }
}
