<?php

$input = file_get_contents('inputs/day3');
$triangles = explode("\n", $input);
$arrangedTriangles = [];

$sides = [];
foreach ($triangles as $line) {
	$sides = array_merge($sides, preg_split('/\s+/', $line, 3, PREG_SPLIT_NO_EMPTY));
}

for ($i = 0; isset($sides[$i+8]); $i += 9) {
	$arrangedTriangles[] = new Triangle([
		$sides[$i],
		$sides[$i+3],
		$sides[$i+6],
	]);
	$arrangedTriangles[] = new Triangle([
		$sides[$i+1],
		$sides[$i+4],
		$sides[$i+7],
	]);
	$arrangedTriangles[] = new Triangle([
		$sides[$i+2],
		$sides[$i+5],
		$sides[$i+8],
	]);
}

$triangles = array_map(function ($triangle) {
	return new Triangle(preg_split('/\s+/', $triangle));
}, $triangles);


echo "Part1: ".countTrueTriangles($triangles)."\n";
echo "Part2: ".countTrueTriangles($arrangedTriangles)."\n";

function countTrueTriangles(array $triangles)
{
	return array_reduce($triangles, function ($trueTriangles, $triangle) {
		return $triangle->isValid() ? $trueTriangles +1 : $trueTriangles;
	}, 0);
}

class Triangle
{
	private $sides;
	private $sum;

	public function __construct(array $sides)
	{
		$this->sides = $sides;
		$this->sum   = array_sum($sides);
	}

	public function isValid()
	{
		foreach ($this->sides as $side) {
			if ($this->sum - $side <= $side) {
				return false;
			}
		}
		return true;
	}
}
