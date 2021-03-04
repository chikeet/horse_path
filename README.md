# Shortest horse path finder

## Basic usage
Use method `Chikeet\HorsePath\PathFinder::findShortestHorsePath()` to find shortest chess horse path from start to end position.

The method accepts two instances of `Chikeet\HorsePath\ValueObjects\ChessPosition` and returns array of `ChessPosition` instances 
representing visited fields.

`ChessPosition` is defined by a pair of `Chikeet\HorsePath\ValueObjects\ChessCoordinate`s. Method `ChessPosition::__construct()` accepts 
two instances of `ChessCoordinate` which may be created with numeric or alphabetic coordinate. 

## More comfortable input & output
Use `ChessCoordinate::createFromInt()` to create new instance with human readable numeric coordinate (1 to 8) or 
`ChessCoordinate::createFromLetter` to create new instance with alphabetic coordinate ("A" to "H", case insensitive).  

It is matter of your choice if you use numeric or alphabetic value since the coordinates are interpreted as a number internally. 

You may also get numeric or alphabetic coordinate representation from `ChessCoordinate` by `ChessCoordinate::toHumanReadableInt()` (numeric) 
or `ChessCoordinate::toLetter()` (alphabetic) or use `ChessPosition::toHumanReadableString()` to get usual combination of alphabetic and numeric coordinate (e. g. `a1`);

## Sandbox
Feel free to use `index.php` as a sandbox to test any horse path you can imagine. All paths are possible to walk through by maximum 7 moves. (Tested. No horses were harmed.)

## Tests

To run tests, run `"vendor/bin/tester" ./tests` in project root folder. More details about running tests may be found in [Nette\Tester documentation](https://tester.nette.org/cs/running-tests).

