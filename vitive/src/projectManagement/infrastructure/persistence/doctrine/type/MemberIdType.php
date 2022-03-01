<?php

namespace Vitive\projectManagement\infrastructure\persistence\doctrine\type;

use Ramsey\Uuid\Doctrine\UuidType;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Vitive\projectManagement\domain\vo\MemberId;

final class MemberIdType extends UuidType
{
    const NAME = 'uuid';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }
        /* if ($value instanceof ProjectId) {
            return $value;
        } */
        try {
            return MemberId::fromString($value);
        } catch (\Exception $ex) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof MemberId) {
            return $value->id();
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
