<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\domain\EmptyProjectNameException;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\vo\OwnerId;

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

    /**
     * @test
     */
    public function it_update_project_name() {
        $id = $this->createUuid();

        $project = Project::create(ProjectId::fromString($id), "p1");
        $project->updateName("vivite");
        $this->assertSame("vivite", $project->name());

    }

    /**
     * @test
     */
    public function it_add_an_owner_to_project() {

        $id = $this->createUuid();
        $ownerId = $this->createUuid();
        $project = Project::create(ProjectId::fromString($id), "p1");
        
        $project->addOwner(OwnerId::fromString($ownerId));
        
        $this->assertSame($ownerId, $project->owner());

    }

    private function createUuid(): string {
        return Uuid::uuid4()->toString();
    }

   
}




