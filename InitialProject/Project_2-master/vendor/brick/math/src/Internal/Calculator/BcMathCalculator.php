<?php

declare(strict_types=1);

namespace Brick\Math\Internal\Calculator;

use Brick\Math\Internal\Calculator;

/**
 * Calculator implementation built around the bcmath library.
 *
 * @internal
 *
 * @psalm-immutable
 */
class BcMathCalculator extends Calculator
{
<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function add(string $a, string $b) : string
    {
        return \bcadd($a, $b, 0);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function sub(string $a, string $b) : string
    {
        return \bcsub($a, $b, 0);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function mul(string $a, string $b) : string
    {
        return \bcmul($a, $b, 0);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     *
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     */
=======
>>>>>>> main
    public function divQ(string $a, string $b) : string
    {
        return \bcdiv($a, $b, 0);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     *
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     */
    public function divR(string $a, string $b) : string
    {
        if (version_compare(PHP_VERSION, '7.2') >= 0) {
            return \bcmod($a, $b, 0);
        }

        return \bcmod($a, $b);
    }

    /**
     * {@inheritdoc}
     */
    public function divQR(string $a, string $b) : array
    {
        $q = \bcdiv($a, $b, 0);

        if (version_compare(PHP_VERSION, '7.2') >= 0) {
            $r = \bcmod($a, $b, 0);
        } else {
            $r = \bcmod($a, $b);
        }

        assert($q !== null);
        assert($r !== null);
=======
    public function divR(string $a, string $b) : string
    {
        return \bcmod($a, $b, 0);
    }

    public function divQR(string $a, string $b) : array
    {
        $q = \bcdiv($a, $b, 0);
        $r = \bcmod($a, $b, 0);
>>>>>>> main

        return [$q, $r];
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function pow(string $a, int $e) : string
    {
        return \bcpow($a, (string) $e, 0);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     *
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     */
=======
>>>>>>> main
    public function modPow(string $base, string $exp, string $mod) : string
    {
        return \bcpowmod($base, $exp, $mod, 0);
    }

<<<<<<< HEAD
    /**
     * {@inheritDoc}
     *
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress InvalidNullableReturnType
     */
=======
>>>>>>> main
    public function sqrt(string $n) : string
    {
        return \bcsqrt($n, 0);
    }
}
