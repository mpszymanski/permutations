<?php

require __DIR__ . '/vendor/autoload.php';

use Core\LexPermutation;

$lex = new LexPermutation;

echo "=======================\n";
echo "#1 Successor example\n";
$perm = [1,2,3,4];
echo 'Init -> [' . implode($perm, ',') . "]\n";
while(true) {
	$perm = $lex->successor($perm);
	if($perm == null) break;
	echo 'next -> [' . implode($perm, ',') . "]\n";
}

echo "=======================\n";
echo "#2 Predeccessor example\n";
$perm = [4,3,2,1];
echo 'Init -> [' . implode($perm, ',') . "]\n";
while(true) {
	$perm = $lex->predeccessor($perm);
	if($perm == null) break;
	echo 'Prev -> [' . implode($perm, ',') . "]\n";
}

echo "=======================\n";
echo "#3 Rank and unrank example\n";
$rank = -1;
$len = 4;
while(true) {
	$rank++;
	$perm = $lex->unrank($len, $rank);
	if($perm == null) break;
	$rank = $lex->rank($perm);
	echo "Rank: $rank -> Unrank: [" . implode($perm, ',') . "]\n";
};

/*
while($next !== null) {
	echo 'Input[' . implode($next, ',') . "]\n";
	$rank = $lex->rank($next) . " ";
	echo '[' . implode($lex->unrank(4, (int) $rank), ',') . "]\n";
	$next = $lex->successor($next);
}
*/
/*
$next = [1,2,3,4];
while($next !== null) {
	echo $lex->rank($next) . "\n";
	$next = $lex->successor($next);
}
*/
/*
$next = [1,2,3,4];
while($next !== null) {
	echo '[' . implode($next, ',') . "]\n";
	$next = $lex->successor($next);
}
*/
