<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\vo;

use Assert\Assert;
use DomainException;

final class EmailAddress
{

    private function __construct(private string $email)
    {

        Assert::that($email)->email();
    }


    public static function fromString(string $email): Self
    {
        $email = trim($email);

        if (!$email) {
            throw new DomainException('Email should not be empty');
        }

        return new Self(strtolower($email));
    }

    public function email(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email();
    }
}
