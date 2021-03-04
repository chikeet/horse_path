<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Model\ValueObjects;

use Chikeet\HorsePath\Utils\UuidGenerator;

class Uuid4
{
    private string $rawValue;

    public function __construct(string $rawUuid4)
    {
        if (!UuidGenerator::isValidUuid4($rawUuid4)){
            throw new \Chikeet\HorsePath\Model\ValueObjects\Exceptions\InvalidUuid4Exception($rawUuid4);
        }
        $this->rawValue = $rawUuid4;
    }

    public function getRaw(): string
    {
        return $this->rawValue;
    }

    public function equals(Uuid4 $other): bool
    {
        return $this->getRaw() === $other->getRaw();
    }
}
