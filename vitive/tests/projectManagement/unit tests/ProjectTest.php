<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\projectManagement\common\ProjectFactory;
use Tests\projectManagement\common\UserFactory;
use Vitive\projectManagement\domain\vo\MemberId;
use Vitive\projectManagement\domain\vo\UserId;

final class ProjectTest extends TestCase
{

    /**
     * @test
     */
    public function it_create_project_without_an_owner(): void
    {
        $id = $this->createUuid();
        $user = UserFactory::create();

        $project = ProjectFactory::create(id: $id, creatorId: $user->id());

        $this->assertEquals('asana-cl', $project->name());
        $this->assertEquals($id, $project->id());
        $this->assertEquals($user->id(), $project->creator());
    }


    /**
     * @test
     */
    public function it_create_project_with_empty_name_throws_exception(): void
    {

        $this->expectException(DomainException::class);

        $id = $this->createUuid();
        $user = UserFactory::create();

        ProjectFactory::create(id: $id, name: "  ", creatorId: $user->id());
    }

    /**
     * @test
     */
    public function it_update_project_name()
    {

        $id = $this->createUuid();
        $user = UserFactory::create();
        $project = ProjectFactory::create(id: $id, creatorId: $user->id());

        $project->updateName("vivite");

        $this->assertSame("vivite", $project->name());
    }

    /**
     * @test
     */
    public function it_add_an_owner_to_project()
    {

        $id = $this->createUuid();
        $user = UserFactory::create();
        $project = ProjectFactory::create(id: $id, creatorId: $user->id());

        $project->addOwner(UserId::fromString($user->id()));

        $this->assertSame($user->id(), $project->owner());
    }

    /**
     * @test
     */
    public function it_can_create_project_with_all_properties()
    {
        $id = $this->createUuid();
        $user = UserFactory::create();
        $dueDate = new DateTimeImmutable('2022-02-25');

        $project = ProjectFactory::create(
            id: $id,
            name: "vitive",
            ownerId: UserId::fromString($user->id()),
            dueDate: $dueDate,
            creatorId: $user->id()
        );

        $this->assertEquals('vitive', $project->name());
        $this->assertEquals($id, $project->id());
        $this->assertEquals($user->id(), $project->owner());
        $this->assertEquals($user->id(), $project->creator());
        $this->assertEquals($dueDate, $project->dueDate());
    }

    /**
     * @test
     */
    public function it_add_a_member_to_poject()
    {
        $id = $this->createUuid();
        $user = UserFactory::create();
        $project = ProjectFactory::create(id: $id, creatorId: $user->id());

        $project->addMember(MemberId::fromString($user->id()));

        $this->assertCount(1, $project->members());
    }

    private function createUuid(): string
    {
        return Uuid::uuid4()->toString();
    }
}
