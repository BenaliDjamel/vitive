<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\domain\EmptyProjectNameException;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;
use Ramsey\Uuid\Uuid;


final class ProjectTest extends TestCase
{

     /**
     * @test
     */
    public function create_project(): void
    {
        $id = $this->createUuid();

        $project = Project::create(ProjectId::fromString($id), 'p1');

        $this->assertEquals('p1', $project->name());
        $this->assertEquals($id, $project->id());

    }


     /**
     * @test
     */
    public function create_project_with_empty_name_throws_exception(): void {
       
        $this->expectException(EmptyProjectNameException::class);

        $id = $this->createUuid();

        $project = Project::create(ProjectId::fromString($id), "   ");

    }

    private function createUuid(): string {
        return Uuid::uuid4()->toString();
    }

   
}




