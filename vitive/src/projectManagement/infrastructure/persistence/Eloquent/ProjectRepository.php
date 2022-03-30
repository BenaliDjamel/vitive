<?php

namespace Vitive\projectManagement\infrastructure\persistence\Eloquent;

use App\Models\Project as ProjectEloquent;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\ProjectRepository as ProjectRepositoryInterface;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\domain\vo\UserId;

class ProjectRepository implements ProjectRepositoryInterface
{



    public function ofId(ProjectId $id): Project
    {
        $project = ProjectEloquent::where('id', $id->id())->first();

        if (is_null($project)) {
            throw new \Exception('Project not found');
        }

        return Project::create(
            ProjectId::fromString($project->id),
            $project->name,
            UserId::fromString($project->creator_id),
            $project->owner_id ? UserId::fromString($project->owner_id): null,
            $project->dueDate,
        );
    }

    public function save(Project $projectEntity): Project
    {
        $project = new ProjectEloquent();
        $project->id = $projectEntity->id();
        $project->name = $projectEntity->name();
        $project->creator_id = $projectEntity->creator();
        $project->owner_id = $projectEntity->owner();
        $project->due_date = $projectEntity->dueDate();

        $project->save();

        return $projectEntity;
    }

    public function update(Project $projectEntity)
    {
        $project = projectEloquent::where('id', $projectEntity->id())->first();
        $project->name = $projectEntity->name();
        $project->owner_id = $projectEntity->owner();
        $project->due_date = $projectEntity->dueDate();

        $project->save();
    }

    public function remove(Project $projectEntity)
    {
        $project = ProjectEloquent::where('id', $projectEntity->id());

        $project->delete();
    }


    public function nextIdentity(): ProjectId
    {
        return ProjectId::fromString(Uuid::uuid4()->toString());
    }
}
