<?php

namespace Core;

class TrotterJohnsonPermutation
{

  public function successor(array $perm)
  {
      $n = count($perm);

      $st = 0;
      $done = false;
      $local = [];

      for ($i=0; $i < $n; $i++) {
          $local[$i]=$perm[$i];
      }

      $m = $n;

      while ($m > 1 && !$done) {
          $d = 1;
          while ($local[$d-1] != $m) {
              $d++;
          }

          for ($i = $d; $i < $m; $i++) {
              $local[$i-1] = $local[$i];
          }

          $parity = $this->permParity($local, $m-1);

          if ($parity == 1) {
              if ($d == $m) {
                  $m--;
              } else {
                  $temp = $perm[$st + $d - 1];
                  $perm[$st+$d-1] = $perm[$st+$d];
                  $perm[$st+$d] = $temp;
                  $done = true;
              }
          } else {
              if ($d == 1) {
                  $m--;
                  $st++;
              } else {
                  $temp = $perm[$st + $d-1];
                  $perm[$st + $d - 1] = $perm[$st + $d - 2];
                  $perm[$st + $d - 2] = $temp;
                  $done = true;
              }
          }
      }

      if ($m == 1)
      {
          return null;
      }

      return $perm;
  }

  /**
   * Get previus permutation.
   * @param  array  $perm
   * @return array
   */
  public function predeccessor(array $perm)
  {
      $rank = $this->rank($perm) - 1;
      if($rank < 0) return null;
      return $this->unrank(count($perm), $rank);
  }

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
    $tmp = array_values($tmp);

    $one_less_perm = $tmp;
    $position_of_perm_max = $index + 1;
    $one_less_perm_rank = $this->rank($one_less_perm);
    $epsilon = $this->epsilon($position_of_perm_max, $n, $one_less_perm_rank);

    return $n * $one_less_perm_rank + $epsilon;
  }

    public function unrank(int $n, int $rank) // 4, 0
    {
        if($n == 1) {
            return [1];
        }

        $prev_rank = floor($rank / $n); // 0
        $epsilon = $rank - $n * $prev_rank; // 0

        if($prev_rank % 2 === 0) {
            $max_index = $n - $epsilon - 1; // 1
        } else {
            $max_index = $epsilon;
        }

        $perm = $this->unrank($n - 1, $prev_rank);

        array_splice($perm, $max_index, 0, $n);

        return $perm;
    }

  private function epsilon(int $k, int $n, int $parity)
  {
    if ($parity % 2 == 0) {
        $epsilon = $n - $k;
    } else {
        $epsilon = $k - 1;
    }

    return $epsilon;
  }

  private function fact(int $num)
  {
    if(! $num) return 0;

    $factorial = 1;
    for ($x = $num; $x >= 1; $x--) {
        $factorial = $factorial * $x;
    }

    return $factorial;
  }

  private function permParity($perm, $size)
  {
    $flags = [];
    $c = 0;
    for ($i = 0; $i < $size; $i++)
    {
        $flags[$i] = false;
    }

    for ($j = 1; $j <= $size; $j++)
    {
        if (! $flags[$j-1])
        {
            $c++;
            $flags[$j-1] = true;
            $i = $j;
            while ($perm[$i-1] != $j)
            {
                $i = $perm[$i-1];
                $flags[$i-1] = true;
            }
        }
    }
    return ($size-$c) % 2;
    }
}
