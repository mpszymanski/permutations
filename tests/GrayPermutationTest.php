<?php

namespace Tests;

use Core\GrayPermutation;
use PHPUnit\Framework\TestCase;

class GrayPermutationTest extends TestCase
{
    private $permutation;

    private $results = [
            [0,0,1],
            [0,1,1],
            [0,1,0],
            [1,1,0],
            [1,1,1],
            [1,0,1]
        ];

    public function setUp()
    {
        $this->permutation = new GrayPermutation;
    }

    public function testSuccesor()
    {
        $perm = [0,0,0];

        // Check next permutations
        foreach ($this->results as $expect) {
            $perm = $this->permutation->successor($perm);
            $this->assertEquals($perm, $expect);
        }
    }

    public function testPredecessor()
    {
        $perm = [1,0,0];

        foreach (array_reverse($this->results) as $expect) {
            $perm = $this->permutation->predeccessor($perm);
            $this->assertEquals($perm, $expect);
        }
    }

    public function testRanAndUnrank()
    {
        for($len = 2; $len <= 8; $len++) {
            $rank = 0;
            while($perm = $this->permutation->unrank($len, $rank)) {
                $this->assertEquals($this->permutation->rank($perm), $rank);
                $rank++;
            }
        }
    }
}