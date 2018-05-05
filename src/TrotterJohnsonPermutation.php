<?php

namespace Core;

class TrotterJohnsonPermutation
{
  public function rank(array $perm)
  {
    $n = count($perm);

    if ($n == 0)
    {
      return null;
    }
    if ($n == 1)
    {
      return 0;
    }

    $perm_max = max($perm);
    $index = array_search($perm_max, $perm);
    $tmp = $perm;
    unset($tmp[$index]);

    $one_less_subset = $tmp;
    $position_of_subset_max = $index + 1;
    $one_less_subset_rank = $this->rank($one_less_subset);
    $epsilon = $this->epsilon($position_of_subset_max, $n, $one_less_subset_rank);

    return $n * $one_less_subset_rank + $epsilon;
  }

  public function unrank(int $n, int $rank)
  {
      $r1=0;
      $r2=0;
      $r = $rank;

      $perm = [];

      $perm[0] = 1;
      for ($j=2; $j <= $n; $j++)
      {
          $r1 = $r * $this->fact($j) / $this->fact($n);
          $k = $r1 - $j * $r2;
          if ($r2 % 2 == 0)
          {
              for ($i = $j-1; $i >= $j-$k; $i--)
              {
                  $perm[$i] = $perm[$i-1];
              }
              $perm[$j-$k-1] = $j;
          }
          else
          {
              for ($i = $j-1; $i >= $k+1; $i--)
              {
                  $perm[$i] = $perm[$i-1];
              }
              $perm[$k] = $j;
          }
          $r2=$r1;
      }

      return $perm;
  }

  private function epsilon(int $k, int $n, int $parity)
  {

    if ($parity % 2 == 0)
    {
      $epsilon = $n - $k;
    }
    else
    {
      $epsilon = $k - 1;
    }

    return $epsilon;
  }

  private function fact(int $num)
  {
      if(! $num) return 0;

      $factorial = 1;
      for ($x = $num; $x >= 1; $x--)
      {
        $factorial = $factorial * $x;
      }

      return $factorial;
  }
}
