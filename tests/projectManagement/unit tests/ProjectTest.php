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
    public function it_create_project_without_an_owner(): void
    {
        $id = $this->createUuid();

        $project = Project::create(ProjectId::fromString($id), 'p1');

        $this->assertEquals('p1', $project->name());
        $this->assertEquals($id, $project->id());

    }


     /**
     * @test
     */
    public function it_create_project_with_empty_name_throws_exception(): void {
       
        $this->expectException(EmptyProjectNameException::class);

        $id = $this->createUuid();

        Project::create(ProjectId::fromString($id), "   ");

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

    /**
     * @test
     */
    public function it_can_create_project_with_all_properties() {
        $id = $this->createUuid();
        $ownerId = $this->createUuid();
        $dueDate = new DateTimeImmutable('2022-02-25');

        $project = Project::create(ProjectId::fromString($id), 'p1', OwnerId::fromString($ownerId), $dueDate);

        $this->assertEquals('p1', $project->name());
        $this->assertEquals($id, $project->id());
        $this->assertEquals($ownerId, $project->owner());
        $this->assertEquals($dueDate , $project->dueDate());

    }

    private function createUuid(): string {
        return Uuid::uuid4()->toString();
    }
}




