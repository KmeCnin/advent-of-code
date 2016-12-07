<?php

$input = file_get_contents('inputs/day4');
$rawRooms = explode("\n", $input);

$rooms = array_map(function ($rawRoom) {
	return new Room($rawRoom);
}, $rawRooms);

$realRooms = array_filter($rooms, function (Room $room) {
	return $room->isReal();
});

$sumSectorIDs = array_sum(array_map(function (Room $room) {
	return $room->sectorID;
}, $realRooms));

echo "Part1: $sumSectorIDs\n";
echo "Part2: \n";

class Room
{
	public $sectorID;

	private $name;
	private $checksum;

	public function __construct($raw)
	{
		preg_match('/([a-z-]+)([0-9]+)\[([a-z]+)\]/', $raw, $match);
		$this->name 	= $match[1];
		$this->sectorID = $match[2];
		$this->checksum = $match[3];
	}

	public function isReal()
	{
		$analyse = array_count_values(
			preg_split('/|-/', $this->name, -1, PREG_SPLIT_NO_EMPTY)
		);

		$occurrencies = [];
		foreach ($analyse as $letter => $frequency) {
			$occurrencies[] = new Occurrency($letter, $frequency);
		}

		usort($occurrencies, function (Occurrency $a, Occurrency $b) {
			return $a->frequency === $b->frequency
				? strcmp($a->letter, $b->letter)
				: $b->frequency - $a->frequency;
		});

		$occurrencies = array_map(function (Occurrency $occurrency) {
			return $occurrency->letter;
		}, $occurrencies);

		return implode(array_slice($occurrencies, 0, 5)) === $this->checksum;
	}
}

class Occurrency
{
	public $letter;
	public $frequency;

	public function __construct($letter, $frequency)
	{
		$this->letter 	 = $letter;
		$this->frequency = $frequency;
	}
}
