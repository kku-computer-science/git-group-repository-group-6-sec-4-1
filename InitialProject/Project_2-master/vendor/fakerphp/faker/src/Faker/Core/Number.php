<?php

declare(strict_types=1);

namespace Faker\Core;

use Faker\Extension;

/**
 * @experimental This class is experimental and does not fall under our BC promise
 */
final class Number implements Extension\NumberExtension
{
    public function numberBetween(int $min = 0, int $max = 2147483647): int
    {
<<<<<<< HEAD
        $int1 = $min < $max ? $min : $max;
        $int2 = $min < $max ? $max : $min;
=======
        $int1 = min($min, $max);
        $int2 = max($min, $max);
>>>>>>> main

        return mt_rand($int1, $int2);
    }

    public function randomDigit(): int
    {
<<<<<<< HEAD
        return mt_rand(0, 9);
=======
        return $this->numberBetween(0, 9);
>>>>>>> main
    }

    public function randomDigitNot(int $except): int
    {
<<<<<<< HEAD
        $result = self::numberBetween(0, 8);
=======
        $result = $this->numberBetween(0, 8);
>>>>>>> main

        if ($result >= $except) {
            ++$result;
        }

        return $result;
    }

    public function randomDigitNotZero(): int
    {
<<<<<<< HEAD
        return mt_rand(1, 9);
=======
        return $this->numberBetween(1, 9);
>>>>>>> main
    }

    public function randomFloat(?int $nbMaxDecimals = null, float $min = 0, ?float $max = null): float
    {
        if (null === $nbMaxDecimals) {
            $nbMaxDecimals = $this->randomDigit();
        }

        if (null === $max) {
            $max = $this->randomNumber();

            if ($min > $max) {
                $max = $min;
            }
        }

        if ($min > $max) {
            $tmp = $min;
            $min = $max;
            $max = $tmp;
        }

<<<<<<< HEAD
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), $nbMaxDecimals);
    }

    public function randomNumber(int $nbDigits = null, bool $strict = false): int
=======
        return round($min + $this->numberBetween() / mt_getrandmax() * ($max - $min), $nbMaxDecimals);
    }

    public function randomNumber(?int $nbDigits = null, bool $strict = false): int
>>>>>>> main
    {
        if (null === $nbDigits) {
            $nbDigits = $this->randomDigitNotZero();
        }
        $max = 10 ** $nbDigits - 1;

        if ($max > mt_getrandmax()) {
            throw new \InvalidArgumentException('randomNumber() can only generate numbers up to mt_getrandmax()');
        }

        if ($strict) {
<<<<<<< HEAD
            return mt_rand(10 ** ($nbDigits - 1), $max);
        }

        return mt_rand(0, $max);
=======
            return $this->numberBetween(10 ** ($nbDigits - 1), $max);
        }

        return $this->numberBetween(0, $max);
>>>>>>> main
    }
}
