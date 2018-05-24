<?php

namespace Tests;

use Core\TrotterJohnsonPermutation;
use PHPUnit\Framework\TestCase;

class TrotterJohnsonPermutationTest extends TestCase
{
    private $permutation;

    private $results = [
            [1,2,4,3],
            [1,4,2,3],
            [4,1,2,3],
            [4,1,3,2],
            [1,4,3,2],
            [1,3,4,2],
            [1,3,2,4],
            [3,1,2,4],
            [3,1,4,2],
            [3,4,1,2],
            [4,3,1,2],
            [4,3,2,1],
            [3,4,2,1],
            [3,2,4,1],
            [3,2,1,4],
            [2,3,1,4],
            [2,3,4,1],
            [2,4,3,1],
            [4,2,3,1],
            [4,2,1,3],
            [2,4,1,3],
            [2,1,4,3]
        ];

    public function setUp()
    {
        $this->permutation = new TrotterJohnsonPermutation;
    }

    public function testSuccesor()
    {
        $perm = [1,2,3,4];

        // Check next permutations
        foreach ($this->results as $expect) {
            $perm = $this->permutation->successor($perm);
            $this->assertEquals($perm, $expect);
        }
    }

    public function testPredecessor()
    {
        $perm = [2,1,3,4];

        foreach (array_reverse($this->results) as $expect) {
            $perm = $this->permutation->predeccessor($perm);
            $this->assertEquals($perm, $expect);
        }
    }

    public function testRanAndUnrank()
    {
        // for len 2
        $len = 2;
        $rank = 0;
        for($i = 0; $i < 2; $i++) {
            $perm = $this->permutation->unrank($len, $rank);
            $this->assertEquals($this->permutation->rank($perm), $rank);
            $rank++;
        }

        // for len 3
        $len = 3;
        $rank = 0;
        for($i = 0; $i < 6; $i++) {
            $perm = $this->permutation->unrank($len, $rank);
            $this->assertEquals($this->permutation->rank($perm), $rank);
            $rank++;
        }

        // for len 4
        $len = 4;
        $rank = 0;
        for($i = 0; $i < 24; $i++) {
            $perm = $this->permutation->unrank($len, $rank);
            $this->assertEquals($this->permutation->rank($perm), $rank);
            $rank++;
        }

        // for len 5
        $len = 5;
        $rank = 0;
        for($i = 0; $i < 120; $i++) {
            $perm = $this->permutation->unrank($len, $rank);
            $this->assertEquals($this->permutation->rank($perm), $rank);
            $rank++;
        }
    }
}