<?php
declare(strict_types=1);

namespace Chikeet\HorsePath;

use Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;

use function array_map;
use function implode;

// ensure classes autoloading
if (@!include __DIR__ . '/vendor/autoload.php') {
	echo "Please run `composer install` first.\n";
	exit(1);
}

// set start and end positions - feel free to play
$startPosition = new ChessPosition(
    ChessCoordinate::createFromLetter('a'),
    ChessCoordinate::createFromHumanReadableInt(1),
);
$endPosition = new ChessPosition(
    ChessCoordinate::createFromLetter('b'),
    ChessCoordinate::createFromHumanReadableInt(2),
);

// get shortest path
$path = PathFinder::findShortestHorsePath($startPosition, $endPosition);

// get human readable result
$positionNames = array_map(fn(ChessPosition $position) => $position->toHumanReadableString(), $path);
echo "Path from $startPosition to $endPosition: " . implode(', ', $positionNames);
