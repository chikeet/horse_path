# Shortest horse path finder

Use method `Chikeet\HorsePath\PathFinder::findShortestHorsePath()` to find shortest chess horse path from start to end position.

The method accepts two instances of `Chikeet\HorsePath\ValueObjects\ChessPosition` and returns array of `ChessPosition` instances representing visited fields.

`ChessPosition::__construct` accepts two instances of `Chikeet\HorsePath\ValueObjects\ChessCoordinate` which may be created with numeric or alphabetic coordinates. Use `ChessCoordinate::__construct` to create new instance with numeric coordinate or `ChessCoordinate::createFromLetter` to create new instance with alphabetic coordinate.  
It is matter of your choice if you use numeric or alphabetic value since the coordinates are interpreted as a number internally. 

