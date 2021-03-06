<?php

namespace Vitive\projectManagement\infrastructure\persistence\doctrine;

use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\ProjectRepository as ProjectRepositoryInterface;
use Vitive\projectManagement\domain\vo\ProjectId;

class ProjectRepository implements ProjectRepositoryInterface
{

    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Project::class);
    }


    public function ofId(ProjectId $id): Project
    {
        $project = $this->repository->findOneBy(['projectId' => $id->id()]);
        if (is_null($project)) {
            throw new \Exception('Project not found');
        }

        return $project;
    }

    public function save(Project $project): Project
    {
        $this->entityManager->persist($project);
        $this->entityManager->flush();
        return $project;
    }

    public function update(Project $project)
    {
        $this->entityManager->flush();
    }

    public function remove(Project $project)
    {
        $this->entityManager->remove($project);
        $this->entityManager->flush();
    }

    public function nextIdentity(): ProjectId
    {
        return ProjectId::fromString(Uuid::uuid4()->toString());
    }
}
