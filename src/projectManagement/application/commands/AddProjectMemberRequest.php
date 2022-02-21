<?php declare(strict_types=1);
namespace Vitive\projectManagement\application\commands;


final class AddProjectMemberRequest{

    public function __construct(public string $projectId, public string $memberId)
    {
        
    }
    
}

