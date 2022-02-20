<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain\vo;

use Assert\Assert;


final class OwnerId {

    private function __construct(private string $id)
    {
     
        Assert::that($id)->uuid();

    }
    

    public static function fromString(string $id): Self {
        return new Self($id);
    }

    public function id(): string {
        return $this->id;
    }


}