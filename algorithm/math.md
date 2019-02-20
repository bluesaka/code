```php
# 最大公约数
function gcd(...$items)
{
    if (count($items) > 2) {
        return array_reduce($items, 'gcd');
    }

    $mod = $items[0] % $items[1];
    return $mod === 0 ? abs($items[1]) : gcd($items[1], $mod);
}


# 最小公倍数
function lcm(...$items)
{
    if (count($items) > 2) {
        return array_reduce($items, 'lcm');
    }

    $i0 = $items[0] ?: 1;
    return $i0 * $items[1] / gcd($i0, $items[1]);
}

# 最小公倍数2
function lcm2(...$items)
{
    $r = $items[0];
    for ($i = 1; $i < count($items); ++$i) {
        $r = $r * $items[$i] / gcd($r, $items[$i]);
    }

    return $r;
}

# 是否为素数
function isPrime($num)
{
    $root = floor(sqrt($num));
    for ($i = 2; $i <= $root; ++$i) {
        if ($num % $i == 0) return false;
    }

    return $num >= 2;
}
```php
