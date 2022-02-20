<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain\vo;


final class ProjectId {

    private function __construct(private string $id)
    {
        
    }
    

    public static function fromString(string $id): Self {
        return new Self($id);
    }

    public function id(): string {
        return $this->id;
    }


}