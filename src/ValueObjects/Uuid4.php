<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\ValueObjects;

use Chikeet\HorsePath\Utils\UuidGenerator;

class Uuid4
{
    private string $rawValue;

    public function __construct(string $rawUuid4)
    {
        if (!UuidGenerator::isValidUuid4($rawUuid4)){
            throw new \App\Model\ValueObject\Exceptions\InvalidUuid4Exception($rawUuid4);
        }
        $this->rawValue = $rawUuid4;
    }

    public function getRaw()
    {
        return $this->rawValue;
    }
}
