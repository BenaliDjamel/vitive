<?php

namespace Vitive\projectManagement\infrastructure\persistence\doctrine\type;

use Ramsey\Uuid\Doctrine\UuidType;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Vitive\projectManagement\domain\vo\EmailAddress;
use Vitive\projectManagement\domain\vo\ProjectId;

final class EmailAddressType extends Type
{
    const NAME = 'uuid';
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        // return the SQL used to create your column type. To create a portable column type, use the $platform.
    }
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }
        /* if ($value instanceof ProjectId) {
            return $value;
        } */
        try {
            return EmailAddress::fromString($value);
        } catch (\Exception $ex) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof EmailAddress) {
            return $value->email();
        }

        if (!empty($value)) {
            return $value;
        }

        throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function getName()
    {
        return self::NAME;
    }
}
