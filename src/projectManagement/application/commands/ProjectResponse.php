<?php declare(strict_types=1);
namespace Vitive\projectManagement\application\commands;


final class ProjectResponse{
    

    public function __construct(public string $id, public string $name){}
}