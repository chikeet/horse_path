<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Utils;

use function get_class;
use function gettype;
use function is_object;
use function sprintf;

/**
 * Utility class for validation of array parameters.
 */
class ArrayValidator
{
    /**
     * Validates that every element of array is instance of given class.
     * @param array<mixed, mixed> $arrayToValidate
     * @param string $class
     * @param string $parameterName
     *
     * @throws \InvalidArgumentException if any of the elements is anything else than instance of required class
     */
    public static function validateEveryIsInstanceOf(array $arrayToValidate, string $class, string $parameterName): void
    {
        foreach ($arrayToValidate as $item) {
            if (!$item instanceof $class) {
                $itemType = is_object($item) ? ' instance of ' . get_class($item) : gettype($item);
                throw new \InvalidArgumentException(sprintf('Array $%s must contain only instances of %s, %s given.', $parameterName, $class, $itemType));
            }
        }
    }
}
