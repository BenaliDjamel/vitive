<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain;

use Vitive\projectManagement\domain\vo\ProjectId;

final class Project {

    //private ProjectId $projectId;


    public function __construct( public string $id,  public string $name)
    {
    }

}