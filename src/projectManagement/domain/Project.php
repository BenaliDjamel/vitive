<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain;

use Vitive\projectManagement\domain\vo\OwnerId;
use Vitive\projectManagement\domain\vo\ProjectId;

final class Project {

    private function __construct( private ProjectId $projectId,  private string $name, private ?string $ownerId = null)
    {
    }

    public static function create(ProjectId $projectId, string $name): Self{

        if(!trim($name)) {
           throw new EmptyProjectNameException('Project name cannot be empty.');
           
        }

        return new Self($projectId, $name);

    }

    public function updateName(string $name) {
        if(!trim($name)) {
            throw new EmptyProjectNameException('Project name cannot be empty.');
            
         }

         $this->name = $name;

    }

    public function addOwner(OwnerId $owner) {

        $this->ownerId = $owner->id();

    }

    public function owner(): string {
        return $this->ownerId;
    }

    public function name(): string {
        return $this->name;
    }

    public function id(): string {
        return $this->projectId->id();
    }

}