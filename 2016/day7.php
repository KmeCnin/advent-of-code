<?php

$input = file_get_contents('inputs/day7');
$IPs = explode("\n", $input);

$IPsObjects = array_map(function ($rawIP) {
	return new IP($rawIP);
}, $IPs);

$tlsIPs = array_filter($IPsObjects, function (IP $ip) {
	return $ip->supportsTLS();
});

foreach ($tlsIPs as $ip) {
}

echo "Part1: ".count($tlsIPs)."\n";
echo "Part2: \n";

class IP
{
	private $rawInput;
	private $regularSequencies;
	private $hypernetSequencies;

	public function __construct($rawInput)
	{
		$this->rawInput = $rawInput;
		preg_match_all('/\[([a-z]+)\]/', $rawInput, $matchs);
		foreach ($matchs[1] as $match) {
			$this->hypernetSequencies[] = $match;
		}
		preg_match_all('/(?:^|\])([a-z]+)(?:\[|$)/', $rawInput, $matchs);
		foreach ($matchs[1] as $match) {
			$this->regularSequencies[] = $match;
		}
	}

	public function supportsTLS()
	{
		return 
			!self::hasABBA($this->hypernetSequencies) &&
			self::hasABBA($this->regularSequencies);
	}

	private static function hasABBA($seqs)
	{
		return 0 < count(array_filter($seqs, function ($seq) {
			return preg_match('/(.)([^\1])\2\1/', $seq);
		}));
	}
}
