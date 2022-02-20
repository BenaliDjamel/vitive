<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\domain\EmptyProjectNameException;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;

final class ProjectTest extends TestCase
{

     /**
     * @test
     */
    public function create_project(): void
    {
        $project = Project::create(ProjectId::fromString('id-1'), 'p1');

        $this->assertEquals('p1', $project->name());
        $this->assertEquals('id-1', $project->id());

    }


     /**
     * @test
     */
    public function create_project_with_empty_name_throws_exception(): void {
       
        $this->expectException(EmptyProjectNameException::class);
        $project = Project::create(ProjectId::fromString('id-1'), "   ");

    }

   
}




