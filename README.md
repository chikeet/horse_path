# Shortest horse path finder

Use method `Chikeet\HorsePath\PathFinder::findShortestHorsePath()` to find optimal chess horse path from start to end position.

The method accepts two instances of `Chikeet\HorsePath\ValueObjects\ChessPosition` and returns array of `ChessPosition` instances 
representing visited fields.

`ChessPosition` is defined by a pair of `Chikeet\HorsePath\ValueObjects\ChessCoordinate`s. Method `ChessPosition::__construct()` accepts 
two instances of `ChessCoordinate` which may be created with numeric or alphabetic coordinate. 

Use `ChessCoordinate::createFromInt()` to create new instance with human readable numeric coordinate (1 to 8) or 
`ChessCoordinate::createFromLetter` to create new instance with alphabetic coordinate.  
It is matter of your choice if you use numeric or alphabetic value since the coordinates are interpreted as a number internally. 
You may also get numeric or alphabetic coordinate representation from `ChessCoordinate` by `ChessCoordinate::toHumanReadableInt()` (numeric) 
or `ChessCoordinate::toLetter()` (alphabetic) or use `ChessPosition::getHumanReadable()` to get usual combination of alphabetic and numeric coordinate (e. g. `A1`);

