<?php

require __DIR__ . '/vendor/autoload.php';

use Core\LexPermutation;
use Core\TrotterJohnsonPermutation;

$lex = new LexPermutation;

echo "=======================\n";
echo "***LEX PERMUTATION****\n";
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

$trotter = new TrotterJohnsonPermutation;

echo "=======================\n";
echo "***TROTTER PERMUTATION****\n";
echo "=======================\n";
echo "#1 Successor example\n";
$perm = [1,2,3,4];
echo 'Init -> [' . implode($perm, ',') . "]\n";
while(true) {
    $perm = $trotter->successor($perm);
    if($perm == null) break;
    echo 'next -> [' . implode($perm, ',') . "]\n";
}

echo "=======================\n";
echo "#2 Predeccessor example\n";
$perm = [4,3,2,1];
echo 'Init -> [' . implode($perm, ',') . "]\n";
while(true) {
    $perm = $trotter->predeccessor($perm);
    if($perm == null) break;
    echo 'Prev -> [' . implode($perm, ',') . "]\n";
}

echo "=======================\n";
echo "#3 Rank and unrank example\n";
$rank = 0;
$len = 4;
while(true) {
    $rank++;
    $perm = $trotter->unrank($len, $rank);
    if($rank == 24) break;
    $rank = $trotter->rank($perm);
    echo "Rank: $rank -> Unrank: [" . implode($perm, ',') . "]\n";
};
