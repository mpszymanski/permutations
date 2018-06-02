<?php

namespace Core;

use Core\Permutation;

class GrayPermutation implements Permutation
{
    /**
     * Get next permutation.
     * @param  array  $perm
     * @return array
     */
    public function successor(array $perm)
    {
        $n = count($perm);
        $rank = $this->rank($perm);
        if($rank >= pow($n, 2) - 2) return null;

        $changed_bits = $rank ^ ($rank + 1);
        $gray_bits = $changed_bits ^ ($changed_bits >> 1);
        $perm_string = implode("", $perm);
        $code_value = bindec($perm_string) ^ $gray_bits;
        $code_bin = decbin($code_value);
        $gray = str_split($code_bin);

        while(count($gray) != $n) {
            array_unshift($gray, 0);
        }

        return $gray;
    }

    /**
     * Get previus permutation.
     * @param  array  $perm
     * @return array
     */
    public function predeccessor(array $perm)
    {
        $n = count($perm);
        $rank = $this->rank($perm);
        if($rank == 0) return null;

        $changed_bits = ($rank - 1) ^ $rank;
        $gray_bits = $changed_bits ^ ($changed_bits >> 1);
        $perm_string = implode("", $perm);
        $code_value = bindec($perm_string) ^ $gray_bits;
        $code_bin = decbin($code_value);
        $gray = str_split($code_bin);

        while(count($gray) != $n) {
            array_unshift($gray, 0);
        }

        return $gray;
    }

    /**
     * Find rank number of permutation.
     * @param  array  $perm
     * @return Integer
     */
    public function rank(array $perm)
    {
        $binary = "";
 
        // MSB of binary code is same as gray code
        $binary .= $perm[0];
     
        // Compute remaining bits
        for ($i = 1; $i < count($perm); $i++) {
            // If current bit is 0, concatenate
            // previous bit
            if ($perm[$i] == '0')
                $binary .= $binary[$i - 1];
     
            // Else, concatenate invert of
            // previous bit
            else
                $binary .= $this->flip($binary[$i - 1]);
        }
     
        return bindec($binary);   
    }

    /**
     * Make permutation from rank number.
     * @param  int    $n    length
     * @param  int    $rank
     * @return array
     */
    public function unrank(int $n, int $rank)
    {
        if($rank >= pow($n, 2) - 1) return null;

        $binary = decbin($rank);

        $gray = [];
 
        // MSB of gray code is same as binary code
        $gray[] += $binary[0];
     
        // Compute remaining bits, next bit is comuted by
        // doing XOR of previous and current in Binary
        for ($i = 1; $i < strlen($binary); $i++) {
            // Concatenate XOR of previous bit
            // with current bit
            $gray[] += $this->xor_c($binary[$i - 1], $binary[$i]);
        }

        while(count($gray) != $n) {
            array_unshift($gray, 0);
        }
 
        return $gray;
    }

    // Helper function to xor two characters
    private function xor_c($a, $b) { return ($a == $b) ? '0' : '1'; }

    // Helper function to flip the bit
    private function flip($c) { return ($c == '0') ? '1' : '0'; }
}
