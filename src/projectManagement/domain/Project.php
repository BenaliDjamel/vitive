<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain;

use Vitive\projectManagement\domain\vo\ProjectId;

final class Project {

    private function __construct( private ProjectId $projectId,  private string $name)
    {
    }

    public static function create(ProjectId $projectId, string $name): Self{

        if(!trim($name)) {
           throw new EmptyProjectNameException('Project name cannot be empty.');
           
        }

        return new Self($projectId, $name);

    }

    public function name(): string {
        return $this->name;
    }

    public function id(): string {
        return $this->projectId->id();
    }

}