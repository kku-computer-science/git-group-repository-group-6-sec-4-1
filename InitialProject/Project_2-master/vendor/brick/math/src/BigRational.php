<?php

declare(strict_types=1);

namespace Brick\Math;

use Brick\Math\Exception\DivisionByZeroException;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;

/**
 * An arbitrarily large rational number.
 *
 * This class is immutable.
 *
 * @psalm-immutable
 */
final class BigRational extends BigNumber
{
    /**
     * The numerator.
<<<<<<< HEAD
     *
     * @var BigInteger
     */
    private $numerator;

    /**
     * The denominator. Always strictly positive.
     *
     * @var BigInteger
     */
    private $denominator;
=======
     */
    private readonly BigInteger $numerator;

    /**
     * The denominator. Always strictly positive.
     */
    private readonly BigInteger $denominator;
>>>>>>> main

    /**
     * Protected constructor. Use a factory method to obtain an instance.
     *
     * @param BigInteger $numerator        The numerator.
     * @param BigInteger $denominator      The denominator.
     * @param bool       $checkDenominator Whether to check the denominator for negative and zero.
     *
     * @throws DivisionByZeroException If the denominator is zero.
     */
    protected function __construct(BigInteger $numerator, BigInteger $denominator, bool $checkDenominator)
    {
        if ($checkDenominator) {
            if ($denominator->isZero()) {
                throw DivisionByZeroException::denominatorMustNotBeZero();
            }

            if ($denominator->isNegative()) {
                $numerator   = $numerator->negated();
                $denominator = $denominator->negated();
            }
        }

        $this->numerator   = $numerator;
        $this->denominator = $denominator;
    }

    /**
<<<<<<< HEAD
     * Creates a BigRational of the given value.
     *
     * @param BigNumber|int|float|string $value
     *
     * @return BigRational
     *
     * @throws MathException If the value cannot be converted to a BigRational.
     *
     * @psalm-pure
     */
    public static function of($value) : BigNumber
    {
        return parent::of($value)->toBigRational();
=======
     * @psalm-pure
     */
    protected static function from(BigNumber $number): static
    {
        return $number->toBigRational();
>>>>>>> main
    }

    /**
     * Creates a BigRational out of a numerator and a denominator.
     *
     * If the denominator is negative, the signs of both the numerator and the denominator
     * will be inverted to ensure that the denominator is always positive.
     *
     * @param BigNumber|int|float|string $numerator   The numerator. Must be convertible to a BigInteger.
     * @param BigNumber|int|float|string $denominator The denominator. Must be convertible to a BigInteger.
     *
<<<<<<< HEAD
     * @return BigRational
     *
=======
>>>>>>> main
     * @throws NumberFormatException      If an argument does not represent a valid number.
     * @throws RoundingNecessaryException If an argument represents a non-integer number.
     * @throws DivisionByZeroException    If the denominator is zero.
     *
     * @psalm-pure
     */
<<<<<<< HEAD
    public static function nd($numerator, $denominator) : BigRational
    {
=======
    public static function nd(
        BigNumber|int|float|string $numerator,
        BigNumber|int|float|string $denominator,
    ) : BigRational {
>>>>>>> main
        $numerator   = BigInteger::of($numerator);
        $denominator = BigInteger::of($denominator);

        return new BigRational($numerator, $denominator, true);
    }

    /**
     * Returns a BigRational representing zero.
     *
<<<<<<< HEAD
     * @return BigRational
     *
=======
>>>>>>> main
     * @psalm-pure
     */
    public static function zero() : BigRational
    {
        /**
         * @psalm-suppress ImpureStaticVariable
         * @var BigRational|null $zero
         */
        static $zero;

        if ($zero === null) {
            $zero = new BigRational(BigInteger::zero(), BigInteger::one(), false);
        }

        return $zero;
    }

    /**
     * Returns a BigRational representing one.
     *
<<<<<<< HEAD
     * @return BigRational
     *
=======
>>>>>>> main
     * @psalm-pure
     */
    public static function one() : BigRational
    {
        /**
         * @psalm-suppress ImpureStaticVariable
         * @var BigRational|null $one
         */
        static $one;

        if ($one === null) {
            $one = new BigRational(BigInteger::one(), BigInteger::one(), false);
        }

        return $one;
    }

    /**
     * Returns a BigRational representing ten.
     *
<<<<<<< HEAD
     * @return BigRational
     *
=======
>>>>>>> main
     * @psalm-pure
     */
    public static function ten() : BigRational
    {
        /**
         * @psalm-suppress ImpureStaticVariable
         * @var BigRational|null $ten
         */
        static $ten;

        if ($ten === null) {
            $ten = new BigRational(BigInteger::ten(), BigInteger::one(), false);
        }

        return $ten;
    }

<<<<<<< HEAD
    /**
     * @return BigInteger
     */
=======
>>>>>>> main
    public function getNumerator() : BigInteger
    {
        return $this->numerator;
    }

<<<<<<< HEAD
    /**
     * @return BigInteger
     */
=======
>>>>>>> main
    public function getDenominator() : BigInteger
    {
        return $this->denominator;
    }

    /**
     * Returns the quotient of the division of the numerator by the denominator.
<<<<<<< HEAD
     *
     * @return BigInteger
=======
>>>>>>> main
     */
    public function quotient() : BigInteger
    {
        return $this->numerator->quotient($this->denominator);
    }

    /**
     * Returns the remainder of the division of the numerator by the denominator.
<<<<<<< HEAD
     *
     * @return BigInteger
=======
>>>>>>> main
     */
    public function remainder() : BigInteger
    {
        return $this->numerator->remainder($this->denominator);
    }

    /**
     * Returns the quotient and remainder of the division of the numerator by the denominator.
     *
     * @return BigInteger[]
<<<<<<< HEAD
=======
     *
     * @psalm-return array{BigInteger, BigInteger}
>>>>>>> main
     */
    public function quotientAndRemainder() : array
    {
        return $this->numerator->quotientAndRemainder($this->denominator);
    }

    /**
     * Returns the sum of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The number to add.
     *
<<<<<<< HEAD
     * @return BigRational The result.
     *
     * @throws MathException If the number is not valid.
     */
    public function plus($that) : BigRational
=======
     * @throws MathException If the number is not valid.
     */
    public function plus(BigNumber|int|float|string $that) : BigRational
>>>>>>> main
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->denominator);
        $numerator   = $numerator->plus($that->numerator->multipliedBy($this->denominator));
        $denominator = $this->denominator->multipliedBy($that->denominator);

        return new BigRational($numerator, $denominator, false);
    }

    /**
     * Returns the difference of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The number to subtract.
     *
<<<<<<< HEAD
     * @return BigRational The result.
     *
     * @throws MathException If the number is not valid.
     */
    public function minus($that) : BigRational
=======
     * @throws MathException If the number is not valid.
     */
    public function minus(BigNumber|int|float|string $that) : BigRational
>>>>>>> main
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->denominator);
        $numerator   = $numerator->minus($that->numerator->multipliedBy($this->denominator));
        $denominator = $this->denominator->multipliedBy($that->denominator);

        return new BigRational($numerator, $denominator, false);
    }

    /**
     * Returns the product of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The multiplier.
     *
<<<<<<< HEAD
     * @return BigRational The result.
     *
     * @throws MathException If the multiplier is not a valid number.
     */
    public function multipliedBy($that) : BigRational
=======
     * @throws MathException If the multiplier is not a valid number.
     */
    public function multipliedBy(BigNumber|int|float|string $that) : BigRational
>>>>>>> main
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->numerator);
        $denominator = $this->denominator->multipliedBy($that->denominator);

        return new BigRational($numerator, $denominator, false);
    }

    /**
     * Returns the result of the division of this number by the given one.
     *
     * @param BigNumber|int|float|string $that The divisor.
     *
<<<<<<< HEAD
     * @return BigRational The result.
     *
     * @throws MathException If the divisor is not a valid number, or is zero.
     */
    public function dividedBy($that) : BigRational
=======
     * @throws MathException If the divisor is not a valid number, or is zero.
     */
    public function dividedBy(BigNumber|int|float|string $that) : BigRational
>>>>>>> main
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->denominator);
        $denominator = $this->denominator->multipliedBy($that->numerator);

        return new BigRational($numerator, $denominator, true);
    }

    /**
     * Returns this number exponentiated to the given value.
     *
<<<<<<< HEAD
     * @param int $exponent The exponent.
     *
     * @return BigRational The result.
     *
=======
>>>>>>> main
     * @throws \InvalidArgumentException If the exponent is not in the range 0 to 1,000,000.
     */
    public function power(int $exponent) : BigRational
    {
        if ($exponent === 0) {
            $one = BigInteger::one();

            return new BigRational($one, $one, false);
        }

        if ($exponent === 1) {
            return $this;
        }

        return new BigRational(
            $this->numerator->power($exponent),
            $this->denominator->power($exponent),
            false
        );
    }

    /**
     * Returns the reciprocal of this BigRational.
     *
     * The reciprocal has the numerator and denominator swapped.
     *
<<<<<<< HEAD
     * @return BigRational
     *
=======
>>>>>>> main
     * @throws DivisionByZeroException If the numerator is zero.
     */
    public function reciprocal() : BigRational
    {
        return new BigRational($this->denominator, $this->numerator, true);
    }

    /**
     * Returns the absolute value of this BigRational.
<<<<<<< HEAD
     *
     * @return BigRational
=======
>>>>>>> main
     */
    public function abs() : BigRational
    {
        return new BigRational($this->numerator->abs(), $this->denominator, false);
    }

    /**
     * Returns the negated value of this BigRational.
<<<<<<< HEAD
     *
     * @return BigRational
=======
>>>>>>> main
     */
    public function negated() : BigRational
    {
        return new BigRational($this->numerator->negated(), $this->denominator, false);
    }

    /**
     * Returns the simplified value of this BigRational.
<<<<<<< HEAD
     *
     * @return BigRational
=======
>>>>>>> main
     */
    public function simplified() : BigRational
    {
        $gcd = $this->numerator->gcd($this->denominator);

        $numerator = $this->numerator->quotient($gcd);
        $denominator = $this->denominator->quotient($gcd);

        return new BigRational($numerator, $denominator, false);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function compareTo($that) : int
=======
    public function compareTo(BigNumber|int|float|string $that) : int
>>>>>>> main
    {
        return $this->minus($that)->getSign();
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function getSign() : int
    {
        return $this->numerator->getSign();
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function toBigInteger() : BigInteger
    {
        $simplified = $this->simplified();

        if (! $simplified->denominator->isEqualTo(1)) {
            throw new RoundingNecessaryException('This rational number cannot be represented as an integer value without rounding.');
        }

        return $simplified->numerator;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function toBigDecimal() : BigDecimal
    {
        return $this->numerator->toBigDecimal()->exactlyDividedBy($this->denominator);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function toBigRational() : BigRational
    {
        return $this;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function toScale(int $scale, int $roundingMode = RoundingMode::UNNECESSARY) : BigDecimal
=======
    public function toScale(int $scale, RoundingMode $roundingMode = RoundingMode::UNNECESSARY) : BigDecimal
>>>>>>> main
    {
        return $this->numerator->toBigDecimal()->dividedBy($this->denominator, $scale, $roundingMode);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function toInt() : int
    {
        return $this->toBigInteger()->toInt();
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function toFloat() : float
    {
        return $this->numerator->toFloat() / $this->denominator->toFloat();
    }

    /**
     * {@inheritdoc}
     */
=======
    public function toFloat() : float
    {
        $simplified = $this->simplified();
        return $simplified->numerator->toFloat() / $simplified->denominator->toFloat();
    }

>>>>>>> main
    public function __toString() : string
    {
        $numerator   = (string) $this->numerator;
        $denominator = (string) $this->denominator;

        if ($denominator === '1') {
            return $numerator;
        }

        return $this->numerator . '/' . $this->denominator;
    }

    /**
     * This method is required for serializing the object and SHOULD NOT be accessed directly.
     *
     * @internal
     *
     * @return array{numerator: BigInteger, denominator: BigInteger}
     */
    public function __serialize(): array
    {
        return ['numerator' => $this->numerator, 'denominator' => $this->denominator];
    }

    /**
     * This method is only here to allow unserializing the object and cannot be accessed directly.
     *
     * @internal
     * @psalm-suppress RedundantPropertyInitializationCheck
     *
     * @param array{numerator: BigInteger, denominator: BigInteger} $data
     *
<<<<<<< HEAD
     * @return void
     *
=======
>>>>>>> main
     * @throws \LogicException
     */
    public function __unserialize(array $data): void
    {
        if (isset($this->numerator)) {
            throw new \LogicException('__unserialize() is an internal function, it must not be called directly.');
        }

        $this->numerator = $data['numerator'];
        $this->denominator = $data['denominator'];
    }
<<<<<<< HEAD

    /**
     * This method is required by interface Serializable and SHOULD NOT be accessed directly.
     *
     * @internal
     *
     * @return string
     */
    public function serialize() : string
    {
        return $this->numerator . '/' . $this->denominator;
    }

    /**
     * This method is only here to implement interface Serializable and cannot be accessed directly.
     *
     * @internal
     * @psalm-suppress RedundantPropertyInitializationCheck
     *
     * @param string $value
     *
     * @return void
     *
     * @throws \LogicException
     */
    public function unserialize($value) : void
    {
        if (isset($this->numerator)) {
            throw new \LogicException('unserialize() is an internal function, it must not be called directly.');
        }

        [$numerator, $denominator] = \explode('/', $value);

        $this->numerator   = BigInteger::of($numerator);
        $this->denominator = BigInteger::of($denominator);
    }
=======
>>>>>>> main
}
