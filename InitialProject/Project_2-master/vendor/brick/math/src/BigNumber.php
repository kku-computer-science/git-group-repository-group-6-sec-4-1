<?php

declare(strict_types=1);

namespace Brick\Math;

use Brick\Math\Exception\DivisionByZeroException;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;

/**
 * Common interface for arbitrary-precision rational numbers.
 *
 * @psalm-immutable
 */
<<<<<<< HEAD
abstract class BigNumber implements \Serializable, \JsonSerializable
{
    /**
     * The regular expression used to parse integer, decimal and rational numbers.
     */
    private const PARSE_REGEXP =
        '/^' .
            '(?<sign>[\-\+])?' .
            '(?:' .
                '(?:' .
                    '(?<integral>[0-9]+)?' .
                    '(?<point>\.)?' .
                    '(?<fractional>[0-9]+)?' .
                    '(?:[eE](?<exponent>[\-\+]?[0-9]+))?' .
                ')|(?:' .
                    '(?<numerator>[0-9]+)' .
                    '\/?' .
                    '(?<denominator>[0-9]+)' .
                ')' .
            ')' .
=======
abstract class BigNumber implements \JsonSerializable
{
    /**
     * The regular expression used to parse integer or decimal numbers.
     */
    private const PARSE_REGEXP_NUMERICAL =
        '/^' .
            '(?<sign>[\-\+])?' .
            '(?<integral>[0-9]+)?' .
            '(?<point>\.)?' .
            '(?<fractional>[0-9]+)?' .
            '(?:[eE](?<exponent>[\-\+]?[0-9]+))?' .
        '$/';

    /**
     * The regular expression used to parse rational numbers.
     */
    private const PARSE_REGEXP_RATIONAL =
        '/^' .
            '(?<sign>[\-\+])?' .
            '(?<numerator>[0-9]+)' .
            '\/?' .
            '(?<denominator>[0-9]+)' .
>>>>>>> main
        '$/';

    /**
     * Creates a BigNumber of the given value.
     *
     * The concrete return type is dependent on the given value, with the following rules:
     *
     * - BigNumber instances are returned as is
     * - integer numbers are returned as BigInteger
     * - floating point numbers are converted to a string then parsed as such
     * - strings containing a `/` character are returned as BigRational
     * - strings containing a `.` character or using an exponential notation are returned as BigDecimal
     * - strings containing only digits with an optional leading `+` or `-` sign are returned as BigInteger
     *
<<<<<<< HEAD
     * @param BigNumber|int|float|string $value
     *
     * @return BigNumber
     *
=======
>>>>>>> main
     * @throws NumberFormatException   If the format of the number is not valid.
     * @throws DivisionByZeroException If the value represents a rational number with a denominator of zero.
     *
     * @psalm-pure
     */
<<<<<<< HEAD
    public static function of($value) : BigNumber
=======
    final public static function of(BigNumber|int|float|string $value) : static
    {
        $value = self::_of($value);

        if (static::class === BigNumber::class) {
            // https://github.com/vimeo/psalm/issues/10309
            assert($value instanceof static);

            return $value;
        }

        return static::from($value);
    }

    /**
     * @psalm-pure
     */
    private static function _of(BigNumber|int|float|string $value) : BigNumber
>>>>>>> main
    {
        if ($value instanceof BigNumber) {
            return $value;
        }

        if (\is_int($value)) {
            return new BigInteger((string) $value);
        }

<<<<<<< HEAD
        /** @psalm-suppress RedundantCastGivenDocblockType We cannot trust the untyped $value here! */
        $value = \is_float($value) ? self::floatToString($value) : (string) $value;

        $throw = static function() use ($value) : void {
            throw new NumberFormatException(\sprintf(
                'The given value "%s" does not represent a valid number.',
                $value
            ));
        };

        if (\preg_match(self::PARSE_REGEXP, $value, $matches) !== 1) {
            $throw();
        }

        $getMatch = static function(string $value) use ($matches) : ?string {
            return isset($matches[$value]) && $matches[$value] !== '' ? $matches[$value] : null;
        };

        $sign        = $getMatch('sign');
        $numerator   = $getMatch('numerator');
        $denominator = $getMatch('denominator');

        if ($numerator !== null) {
            assert($denominator !== null);

            if ($sign !== null) {
                $numerator = $sign . $numerator;
            }

            $numerator   = self::cleanUp($numerator);
            $denominator = self::cleanUp($denominator);
=======
        if (is_float($value)) {
            $value = (string) $value;
        }

        if (str_contains($value, '/')) {
            // Rational number
            if (\preg_match(self::PARSE_REGEXP_RATIONAL, $value, $matches, PREG_UNMATCHED_AS_NULL) !== 1) {
                throw NumberFormatException::invalidFormat($value);
            }

            $sign        = $matches['sign'];
            $numerator   = $matches['numerator'];
            $denominator = $matches['denominator'];

            assert($numerator !== null);
            assert($denominator !== null);

            $numerator   = self::cleanUp($sign, $numerator);
            $denominator = self::cleanUp(null, $denominator);
>>>>>>> main

            if ($denominator === '0') {
                throw DivisionByZeroException::denominatorMustNotBeZero();
            }

            return new BigRational(
                new BigInteger($numerator),
                new BigInteger($denominator),
                false
            );
<<<<<<< HEAD
        }

        $point      = $getMatch('point');
        $integral   = $getMatch('integral');
        $fractional = $getMatch('fractional');
        $exponent   = $getMatch('exponent');

        if ($integral === null && $fractional === null) {
            $throw();
        }

        if ($integral === null) {
            $integral = '0';
        }

        if ($point !== null || $exponent !== null) {
            $fractional = ($fractional ?? '');
            $exponent = ($exponent !== null) ? (int) $exponent : 0;

            if ($exponent === PHP_INT_MIN || $exponent === PHP_INT_MAX) {
                throw new NumberFormatException('Exponent too large.');
            }

            $unscaledValue = self::cleanUp(($sign ?? ''). $integral . $fractional);

            $scale = \strlen($fractional) - $exponent;

            if ($scale < 0) {
                if ($unscaledValue !== '0') {
                    $unscaledValue .= \str_repeat('0', - $scale);
                }
                $scale = 0;
            }

            return new BigDecimal($unscaledValue, $scale);
        }

        $integral = self::cleanUp(($sign ?? '') . $integral);

        return new BigInteger($integral);
    }

    /**
     * Safely converts float to string, avoiding locale-dependent issues.
     *
     * @see https://github.com/brick/math/pull/20
     *
     * @param float $float
     *
     * @return string
     *
     * @psalm-pure
     * @psalm-suppress ImpureFunctionCall
     */
    private static function floatToString(float $float) : string
    {
        $currentLocale = \setlocale(LC_NUMERIC, '0');
        \setlocale(LC_NUMERIC, 'C');

        $result = (string) $float;

        \setlocale(LC_NUMERIC, $currentLocale);

        return $result;
    }

    /**
     * Proxy method to access protected constructors from sibling classes.
     *
     * @internal
     *
     * @param mixed ...$args The arguments to the constructor.
     *
     * @return static
     *
     * @psalm-pure
     * @psalm-suppress TooManyArguments
     * @psalm-suppress UnsafeInstantiation
     */
    protected static function create(... $args) : BigNumber
    {
        return new static(... $args);
=======
        } else {
            // Integer or decimal number
            if (\preg_match(self::PARSE_REGEXP_NUMERICAL, $value, $matches, PREG_UNMATCHED_AS_NULL) !== 1) {
                throw NumberFormatException::invalidFormat($value);
            }

            $sign = $matches['sign'];
            $point = $matches['point'];
            $integral = $matches['integral'];
            $fractional = $matches['fractional'];
            $exponent = $matches['exponent'];

            if ($integral === null && $fractional === null) {
                throw NumberFormatException::invalidFormat($value);
            }

            if ($integral === null) {
                $integral = '0';
            }

            if ($point !== null || $exponent !== null) {
                $fractional = ($fractional ?? '');
                $exponent = ($exponent !== null) ? (int)$exponent : 0;

                if ($exponent === PHP_INT_MIN || $exponent === PHP_INT_MAX) {
                    throw new NumberFormatException('Exponent too large.');
                }

                $unscaledValue = self::cleanUp($sign, $integral . $fractional);

                $scale = \strlen($fractional) - $exponent;

                if ($scale < 0) {
                    if ($unscaledValue !== '0') {
                        $unscaledValue .= \str_repeat('0', -$scale);
                    }
                    $scale = 0;
                }

                return new BigDecimal($unscaledValue, $scale);
            }

            $integral = self::cleanUp($sign, $integral);

            return new BigInteger($integral);
        }
    }

    /**
     * Overridden by subclasses to convert a BigNumber to an instance of the subclass.
     *
     * @throws MathException If the value cannot be converted.
     *
     * @psalm-pure
     */
    abstract protected static function from(BigNumber $number): static;

    /**
     * Proxy method to access BigInteger's protected constructor from sibling classes.
     *
     * @internal
     * @psalm-pure
     */
    final protected function newBigInteger(string $value) : BigInteger
    {
        return new BigInteger($value);
    }

    /**
     * Proxy method to access BigDecimal's protected constructor from sibling classes.
     *
     * @internal
     * @psalm-pure
     */
    final protected function newBigDecimal(string $value, int $scale = 0) : BigDecimal
    {
        return new BigDecimal($value, $scale);
    }

    /**
     * Proxy method to access BigRational's protected constructor from sibling classes.
     *
     * @internal
     * @psalm-pure
     */
    final protected function newBigRational(BigInteger $numerator, BigInteger $denominator, bool $checkDenominator) : BigRational
    {
        return new BigRational($numerator, $denominator, $checkDenominator);
>>>>>>> main
    }

    /**
     * Returns the minimum of the given values.
     *
     * @param BigNumber|int|float|string ...$values The numbers to compare. All the numbers need to be convertible
     *                                              to an instance of the class this method is called on.
     *
<<<<<<< HEAD
     * @return static The minimum value.
     *
     * @throws \InvalidArgumentException If no values are given.
     * @throws MathException             If an argument is not valid.
     *
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-pure
     */
    public static function min(...$values) : BigNumber
=======
     * @throws \InvalidArgumentException If no values are given.
     * @throws MathException             If an argument is not valid.
     *
     * @psalm-pure
     */
    final public static function min(BigNumber|int|float|string ...$values) : static
>>>>>>> main
    {
        $min = null;

        foreach ($values as $value) {
            $value = static::of($value);

            if ($min === null || $value->isLessThan($min)) {
                $min = $value;
            }
        }

        if ($min === null) {
            throw new \InvalidArgumentException(__METHOD__ . '() expects at least one value.');
        }

        return $min;
    }

    /**
     * Returns the maximum of the given values.
     *
     * @param BigNumber|int|float|string ...$values The numbers to compare. All the numbers need to be convertible
     *                                              to an instance of the class this method is called on.
     *
<<<<<<< HEAD
     * @return static The maximum value.
     *
     * @throws \InvalidArgumentException If no values are given.
     * @throws MathException             If an argument is not valid.
     *
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-pure
     */
    public static function max(...$values) : BigNumber
=======
     * @throws \InvalidArgumentException If no values are given.
     * @throws MathException             If an argument is not valid.
     *
     * @psalm-pure
     */
    final public static function max(BigNumber|int|float|string ...$values) : static
>>>>>>> main
    {
        $max = null;

        foreach ($values as $value) {
            $value = static::of($value);

            if ($max === null || $value->isGreaterThan($max)) {
                $max = $value;
            }
        }

        if ($max === null) {
            throw new \InvalidArgumentException(__METHOD__ . '() expects at least one value.');
        }

        return $max;
    }

    /**
     * Returns the sum of the given values.
     *
     * @param BigNumber|int|float|string ...$values The numbers to add. All the numbers need to be convertible
     *                                              to an instance of the class this method is called on.
     *
<<<<<<< HEAD
     * @return static The sum.
     *
     * @throws \InvalidArgumentException If no values are given.
     * @throws MathException             If an argument is not valid.
     *
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-pure
     */
    public static function sum(...$values) : BigNumber
    {
        /** @var BigNumber|null $sum */
=======
     * @throws \InvalidArgumentException If no values are given.
     * @throws MathException             If an argument is not valid.
     *
     * @psalm-pure
     */
    final public static function sum(BigNumber|int|float|string ...$values) : static
    {
        /** @var static|null $sum */
>>>>>>> main
        $sum = null;

        foreach ($values as $value) {
            $value = static::of($value);

            $sum = $sum === null ? $value : self::add($sum, $value);
        }

        if ($sum === null) {
            throw new \InvalidArgumentException(__METHOD__ . '() expects at least one value.');
        }

        return $sum;
    }

    /**
     * Adds two BigNumber instances in the correct order to avoid a RoundingNecessaryException.
     *
     * @todo This could be better resolved by creating an abstract protected method in BigNumber, and leaving to
     *       concrete classes the responsibility to perform the addition themselves or delegate it to the given number,
     *       depending on their ability to perform the operation. This will also require a version bump because we're
     *       potentially breaking custom BigNumber implementations (if any...)
     *
<<<<<<< HEAD
     * @param BigNumber $a
     * @param BigNumber $b
     *
     * @return BigNumber
     *
=======
>>>>>>> main
     * @psalm-pure
     */
    private static function add(BigNumber $a, BigNumber $b) : BigNumber
    {
        if ($a instanceof BigRational) {
            return $a->plus($b);
        }

        if ($b instanceof BigRational) {
            return $b->plus($a);
        }

        if ($a instanceof BigDecimal) {
            return $a->plus($b);
        }

        if ($b instanceof BigDecimal) {
            return $b->plus($a);
        }

        /** @var BigInteger $a */

        return $a->plus($b);
    }

    /**
<<<<<<< HEAD
     * Removes optional leading zeros and + sign from the given number.
     *
     * @param string $number The number, validated as a non-empty string of digits with optional leading sign.
     *
     * @return string
     *
     * @psalm-pure
     */
    private static function cleanUp(string $number) : string
    {
        $firstChar = $number[0];

        if ($firstChar === '+' || $firstChar === '-') {
            $number = \substr($number, 1);
        }

=======
     * Removes optional leading zeros and applies sign.
     *
     * @param string|null $sign   The sign, '+' or '-', optional. Null is allowed for convenience and treated as '+'.
     * @param string      $number The number, validated as a non-empty string of digits.
     *
     * @psalm-pure
     */
    private static function cleanUp(string|null $sign, string $number) : string
    {
>>>>>>> main
        $number = \ltrim($number, '0');

        if ($number === '') {
            return '0';
        }

<<<<<<< HEAD
        if ($firstChar === '-') {
            return '-' . $number;
        }

        return $number;
=======
        return $sign === '-' ? '-' . $number : $number;
>>>>>>> main
    }

    /**
     * Checks if this number is equal to the given one.
<<<<<<< HEAD
     *
     * @param BigNumber|int|float|string $that
     *
     * @return bool
     */
    public function isEqualTo($that) : bool
=======
     */
    final public function isEqualTo(BigNumber|int|float|string $that) : bool
>>>>>>> main
    {
        return $this->compareTo($that) === 0;
    }

    /**
     * Checks if this number is strictly lower than the given one.
<<<<<<< HEAD
     *
     * @param BigNumber|int|float|string $that
     *
     * @return bool
     */
    public function isLessThan($that) : bool
=======
     */
    final public function isLessThan(BigNumber|int|float|string $that) : bool
>>>>>>> main
    {
        return $this->compareTo($that) < 0;
    }

    /**
     * Checks if this number is lower than or equal to the given one.
<<<<<<< HEAD
     *
     * @param BigNumber|int|float|string $that
     *
     * @return bool
     */
    public function isLessThanOrEqualTo($that) : bool
=======
     */
    final public function isLessThanOrEqualTo(BigNumber|int|float|string $that) : bool
>>>>>>> main
    {
        return $this->compareTo($that) <= 0;
    }

    /**
     * Checks if this number is strictly greater than the given one.
<<<<<<< HEAD
     *
     * @param BigNumber|int|float|string $that
     *
     * @return bool
     */
    public function isGreaterThan($that) : bool
=======
     */
    final public function isGreaterThan(BigNumber|int|float|string $that) : bool
>>>>>>> main
    {
        return $this->compareTo($that) > 0;
    }

    /**
     * Checks if this number is greater than or equal to the given one.
<<<<<<< HEAD
     *
     * @param BigNumber|int|float|string $that
     *
     * @return bool
     */
    public function isGreaterThanOrEqualTo($that) : bool
=======
     */
    final public function isGreaterThanOrEqualTo(BigNumber|int|float|string $that) : bool
>>>>>>> main
    {
        return $this->compareTo($that) >= 0;
    }

    /**
     * Checks if this number equals zero.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isZero() : bool
=======
     */
    final public function isZero() : bool
>>>>>>> main
    {
        return $this->getSign() === 0;
    }

    /**
     * Checks if this number is strictly negative.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isNegative() : bool
=======
     */
    final public function isNegative() : bool
>>>>>>> main
    {
        return $this->getSign() < 0;
    }

    /**
     * Checks if this number is negative or zero.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isNegativeOrZero() : bool
=======
     */
    final public function isNegativeOrZero() : bool
>>>>>>> main
    {
        return $this->getSign() <= 0;
    }

    /**
     * Checks if this number is strictly positive.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isPositive() : bool
=======
     */
    final public function isPositive() : bool
>>>>>>> main
    {
        return $this->getSign() > 0;
    }

    /**
     * Checks if this number is positive or zero.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isPositiveOrZero() : bool
=======
     */
    final public function isPositiveOrZero() : bool
>>>>>>> main
    {
        return $this->getSign() >= 0;
    }

    /**
     * Returns the sign of this number.
     *
<<<<<<< HEAD
=======
     * @psalm-return -1|0|1
     *
>>>>>>> main
     * @return int -1 if the number is negative, 0 if zero, 1 if positive.
     */
    abstract public function getSign() : int;

    /**
     * Compares this number to the given one.
     *
<<<<<<< HEAD
     * @param BigNumber|int|float|string $that
     *
     * @return int [-1,0,1] If `$this` is lower than, equal to, or greater than `$that`.
     *
     * @throws MathException If the number is not valid.
     */
    abstract public function compareTo($that) : int;
=======
     * @psalm-return -1|0|1
     *
     * @return int -1 if `$this` is lower than, 0 if equal to, 1 if greater than `$that`.
     *
     * @throws MathException If the number is not valid.
     */
    abstract public function compareTo(BigNumber|int|float|string $that) : int;
>>>>>>> main

    /**
     * Converts this number to a BigInteger.
     *
<<<<<<< HEAD
     * @return BigInteger The converted number.
     *
=======
>>>>>>> main
     * @throws RoundingNecessaryException If this number cannot be converted to a BigInteger without rounding.
     */
    abstract public function toBigInteger() : BigInteger;

    /**
     * Converts this number to a BigDecimal.
     *
<<<<<<< HEAD
     * @return BigDecimal The converted number.
     *
=======
>>>>>>> main
     * @throws RoundingNecessaryException If this number cannot be converted to a BigDecimal without rounding.
     */
    abstract public function toBigDecimal() : BigDecimal;

    /**
     * Converts this number to a BigRational.
<<<<<<< HEAD
     *
     * @return BigRational The converted number.
=======
>>>>>>> main
     */
    abstract public function toBigRational() : BigRational;

    /**
     * Converts this number to a BigDecimal with the given scale, using rounding if necessary.
     *
<<<<<<< HEAD
     * @param int $scale        The scale of the resulting `BigDecimal`.
     * @param int $roundingMode A `RoundingMode` constant.
     *
     * @return BigDecimal
=======
     * @param int          $scale        The scale of the resulting `BigDecimal`.
     * @param RoundingMode $roundingMode An optional rounding mode, defaults to UNNECESSARY.
>>>>>>> main
     *
     * @throws RoundingNecessaryException If this number cannot be converted to the given scale without rounding.
     *                                    This only applies when RoundingMode::UNNECESSARY is used.
     */
<<<<<<< HEAD
    abstract public function toScale(int $scale, int $roundingMode = RoundingMode::UNNECESSARY) : BigDecimal;
=======
    abstract public function toScale(int $scale, RoundingMode $roundingMode = RoundingMode::UNNECESSARY) : BigDecimal;
>>>>>>> main

    /**
     * Returns the exact value of this number as a native integer.
     *
     * If this number cannot be converted to a native integer without losing precision, an exception is thrown.
     * Note that the acceptable range for an integer depends on the platform and differs for 32-bit and 64-bit.
     *
<<<<<<< HEAD
     * @return int The converted value.
     *
=======
>>>>>>> main
     * @throws MathException If this number cannot be exactly converted to a native integer.
     */
    abstract public function toInt() : int;

    /**
     * Returns an approximation of this number as a floating-point value.
     *
     * Note that this method can discard information as the precision of a floating-point value
     * is inherently limited.
     *
     * If the number is greater than the largest representable floating point number, positive infinity is returned.
     * If the number is less than the smallest representable floating point number, negative infinity is returned.
<<<<<<< HEAD
     *
     * @return float The converted value.
=======
>>>>>>> main
     */
    abstract public function toFloat() : float;

    /**
     * Returns a string representation of this number.
     *
     * The output of this method can be parsed by the `of()` factory method;
     * this will yield an object equal to this one, without any information loss.
<<<<<<< HEAD
     *
     * @return string
     */
    abstract public function __toString() : string;

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : string
=======
     */
    abstract public function __toString() : string;

    final public function jsonSerialize() : string
>>>>>>> main
    {
        return $this->__toString();
    }
}
