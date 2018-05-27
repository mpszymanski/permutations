<?php

namespace Core;

interface Permutation {
    /**
     * Get next permutation.
     * @param  array  $perm
     * @return array
     */
    public function successor(array $perm);

    /**
     * Get previus permutation.
     * @param  array  $perm
     * @return array
     */
    public function predeccessor(array $perm);

    /**
     * Find rank number of permutation.
     * @param  array  $perm
     * @return Integer
     */
    public function rank(array $perm);

    /**
     * Make permutation from rank number.
     * @param  int    $n    length
     * @param  int    $rank
     * @return array
     */
    public function unrank(int $n, int $rank);
}