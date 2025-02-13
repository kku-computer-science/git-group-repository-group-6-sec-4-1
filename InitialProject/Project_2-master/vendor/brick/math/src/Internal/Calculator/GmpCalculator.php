<?php

declare(strict_types=1);

namespace Brick\Math\Internal\Calculator;

use Brick\Math\Internal\Calculator;

/**
 * Calculator implementation built around the GMP library.
 *
 * @internal
 *
 * @psalm-immutable
 */
class GmpCalculator extends Calculator
{
<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function add(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_add($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function sub(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_sub($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function mul(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_mul($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function divQ(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_div_q($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function divR(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_div_r($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function divQR(string $a, string $b) : array
    {
        [$q, $r] = \gmp_div_qr($a, $b);

        return [
            \gmp_strval($q),
            \gmp_strval($r)
        ];
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function pow(string $a, int $e) : string
    {
        return \gmp_strval(\gmp_pow($a, $e));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function modInverse(string $x, string $m) : ?string
    {
        $result = \gmp_invert($x, $m);

        if ($result === false) {
            return null;
        }

        return \gmp_strval($result);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function modPow(string $base, string $exp, string $mod) : string
    {
        return \gmp_strval(\gmp_powm($base, $exp, $mod));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function gcd(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_gcd($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function fromBase(string $number, int $base) : string
    {
        return \gmp_strval(\gmp_init($number, $base));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function toBase(string $number, int $base) : string
    {
        return \gmp_strval($number, $base);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function and(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_and($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function or(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_or($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function xor(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_xor($a, $b));
    }

<<<<<<< HEAD
    /**
     * {@inheritDoc}
     */
=======
>>>>>>> main
    public function sqrt(string $n) : string
    {
        return \gmp_strval(\gmp_sqrt($n));
    }
}
