<?php

<<<<<<< HEAD
/**
 * provides type inference and auto-completion for magic static methods of Assert.
 */

=======
>>>>>>> main
namespace Webmozart\Assert;

use ArrayAccess;
use Closure;
use Countable;
use Throwable;

/**
<<<<<<< HEAD
 * This trait aids static analysis tooling in introspecting assertion magic methods.
=======
 * This trait provides nurllOr*, all* and allNullOr* variants of assertion base methods.
>>>>>>> main
 * Do not use this trait directly: it will change, and is not designed for reuse.
 */
trait Mixin
{
    /**
     * @psalm-pure
     * @psalm-assert string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrString($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrString', array($value, $message));
=======
        null === $value || static::string($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allString($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allString', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::string($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrString($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::string($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert non-empty-string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrStringNotEmpty($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrStringNotEmpty', array($value, $message));
=======
        null === $value || static::stringNotEmpty($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<non-empty-string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allStringNotEmpty($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allStringNotEmpty', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::stringNotEmpty($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<non-empty-string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrStringNotEmpty($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::stringNotEmpty($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert int|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrInteger($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrInteger', array($value, $message));
=======
        null === $value || static::integer($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<int> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allInteger($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allInteger', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::integer($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<int|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrInteger($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::integer($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert numeric|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIntegerish($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIntegerish', array($value, $message));
=======
        null === $value || static::integerish($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<numeric> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIntegerish($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIntegerish', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::integerish($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<numeric|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIntegerish($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::integerish($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert positive-int|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrPositiveInteger($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrPositiveInteger', array($value, $message));
=======
        null === $value || static::positiveInteger($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<positive-int> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allPositiveInteger($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allPositiveInteger', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::positiveInteger($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<positive-int|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrPositiveInteger($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::positiveInteger($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert float|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrFloat($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrFloat', array($value, $message));
=======
        null === $value || static::float($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<float> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allFloat($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allFloat', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::float($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<float|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrFloat($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::float($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert numeric|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNumeric($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNumeric', array($value, $message));
=======
        null === $value || static::numeric($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<numeric> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNumeric($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNumeric', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::numeric($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<numeric|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNumeric($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::numeric($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert positive-int|0|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNatural($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNatural', array($value, $message));
=======
        null === $value || static::natural($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<positive-int|0> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNatural($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNatural', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::natural($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<positive-int|0|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNatural($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::natural($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert bool|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrBoolean($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrBoolean', array($value, $message));
=======
        null === $value || static::boolean($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<bool> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allBoolean($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allBoolean', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::boolean($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<bool|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrBoolean($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::boolean($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert scalar|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrScalar($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrScalar', array($value, $message));
=======
        null === $value || static::scalar($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<scalar> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allScalar($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allScalar', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::scalar($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<scalar|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrScalar($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::scalar($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert object|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrObject($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrObject', array($value, $message));
=======
        null === $value || static::object($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<object> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allObject($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allObject', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::object($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<object|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrObject($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::object($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert resource|null $value
     *
     * @param mixed       $value
     * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrResource($value, $type = null, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrResource', array($value, $type, $message));
=======
        null === $value || static::resource($value, $type, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<resource> $value
     *
     * @param mixed       $value
     * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allResource($value, $type = null, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allResource', array($value, $type, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::resource($entry, $type, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<resource|null> $value
     *
     * @param mixed       $value
     * @param string|null $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrResource($value, $type = null, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::resource($entry, $type, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert callable|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsCallable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsCallable', array($value, $message));
=======
        null === $value || static::isCallable($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<callable> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsCallable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsCallable', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isCallable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<callable|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsCallable($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isCallable($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert array|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsArray($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsArray', array($value, $message));
=======
        null === $value || static::isArray($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<array> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsArray($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsArray', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isArray($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<array|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsArray($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isArray($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable|null $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsTraversable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsTraversable', array($value, $message));
=======
        null === $value || static::isTraversable($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<iterable> $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsTraversable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsTraversable', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isTraversable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<iterable|null> $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsTraversable($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isTraversable($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert array|ArrayAccess|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsArrayAccessible($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsArrayAccessible', array($value, $message));
=======
        null === $value || static::isArrayAccessible($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<array|ArrayAccess> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsArrayAccessible($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsArrayAccessible', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isArrayAccessible($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<array|ArrayAccess|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsArrayAccessible($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isArrayAccessible($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert countable|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsCountable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsCountable', array($value, $message));
=======
        null === $value || static::isCountable($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<countable> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsCountable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsCountable', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isCountable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<countable|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsCountable($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isCountable($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsIterable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsIterable', array($value, $message));
=======
        null === $value || static::isIterable($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<iterable> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsIterable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsIterable', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isIterable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<iterable|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsIterable($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isIterable($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert ExpectedType|null $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsInstanceOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsInstanceOf', array($value, $class, $message));
=======
        null === $value || static::isInstanceOf($value, $class, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<ExpectedType> $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsInstanceOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsInstanceOf', array($value, $class, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isInstanceOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<ExpectedType|null> $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsInstanceOf($value, $class, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isInstanceOf($entry, $class, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotInstanceOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotInstanceOf', array($value, $class, $message));
=======
        null === $value || static::notInstanceOf($value, $class, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotInstanceOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotInstanceOf', array($value, $class, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notInstanceOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<!ExpectedType|null> $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotInstanceOf($value, $class, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notInstanceOf($entry, $class, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsInstanceOfAny($value, $classes, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsInstanceOfAny', array($value, $classes, $message));
=======
        null === $value || static::isInstanceOfAny($value, $classes, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsInstanceOfAny($value, $classes, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsInstanceOfAny', array($value, $classes, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isInstanceOfAny($entry, $classes, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsInstanceOfAny($value, $classes, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isInstanceOfAny($entry, $classes, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert ExpectedType|class-string<ExpectedType>|null $value
     *
     * @param object|string|null $value
     * @param string             $class
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsAOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsAOf', array($value, $class, $message));
=======
        null === $value || static::isAOf($value, $class, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<ExpectedType|class-string<ExpectedType>> $value
     *
     * @param iterable<object|string> $value
     * @param string                  $class
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsAOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsAOf', array($value, $class, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isAOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<ExpectedType|class-string<ExpectedType>|null> $value
     *
     * @param iterable<object|string|null> $value
     * @param string                       $class
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsAOf($value, $class, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isAOf($entry, $class, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template UnexpectedType of object
     * @psalm-param class-string<UnexpectedType> $class
     *
     * @param object|string|null $value
     * @param string             $class
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsNotA($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsNotA', array($value, $class, $message));
=======
        null === $value || static::isNotA($value, $class, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template UnexpectedType of object
     * @psalm-param class-string<UnexpectedType> $class
     *
     * @param iterable<object|string> $value
     * @param string                  $class
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsNotA($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsNotA', array($value, $class, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isNotA($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template UnexpectedType of object
     * @psalm-param class-string<UnexpectedType> $class
     * @psalm-assert iterable<!UnexpectedType|null> $value
     * @psalm-assert iterable<!class-string<UnexpectedType>|null> $value
     *
     * @param iterable<object|string|null> $value
     * @param string                       $class
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsNotA($value, $class, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isNotA($entry, $class, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param array<class-string> $classes
     *
     * @param object|string|null $value
     * @param string[]           $classes
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsAnyOf($value, $classes, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsAnyOf', array($value, $classes, $message));
=======
        null === $value || static::isAnyOf($value, $classes, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param array<class-string> $classes
     *
     * @param iterable<object|string> $value
     * @param string[]                $classes
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsAnyOf($value, $classes, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsAnyOf', array($value, $classes, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isAnyOf($entry, $classes, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-param array<class-string> $classes
     *
     * @param iterable<object|string|null> $value
     * @param string[]                     $classes
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsAnyOf($value, $classes, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isAnyOf($entry, $classes, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert empty $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsEmpty($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsEmpty', array($value, $message));
=======
        null === $value || static::isEmpty($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<empty> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsEmpty($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsEmpty', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::isEmpty($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<empty|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsEmpty($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::isEmpty($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotEmpty($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotEmpty', array($value, $message));
=======
        null === $value || static::notEmpty($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotEmpty($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotEmpty', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notEmpty($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<!empty|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotEmpty($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notEmpty($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNull($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNull', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::null($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotNull($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotNull', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notNull($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert true|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrTrue($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrTrue', array($value, $message));
=======
        null === $value || static::true($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<true> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allTrue($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allTrue', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::true($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<true|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrTrue($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::true($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert false|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrFalse($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrFalse', array($value, $message));
=======
        null === $value || static::false($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<false> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allFalse($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allFalse', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::false($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<false|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrFalse($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::false($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotFalse($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotFalse', array($value, $message));
=======
        null === $value || static::notFalse($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotFalse($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotFalse', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notFalse($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<!false|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotFalse($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notFalse($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIp($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIp', array($value, $message));
=======
        null === $value || static::ip($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIp($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIp', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::ip($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIp($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::ip($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIpv4($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIpv4', array($value, $message));
=======
        null === $value || static::ipv4($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIpv4($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIpv4', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::ipv4($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIpv4($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::ipv4($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIpv6($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIpv6', array($value, $message));
=======
        null === $value || static::ipv6($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIpv6($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIpv6', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::ipv6($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIpv6($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::ipv6($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrEmail($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrEmail', array($value, $message));
=======
        null === $value || static::email($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allEmail($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allEmail', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::email($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrEmail($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::email($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param array|null $values
     * @param string     $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrUniqueValues($values, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrUniqueValues', array($values, $message));
=======
        null === $values || static::uniqueValues($values, $message);
>>>>>>> main
    }

    /**
     * @param iterable<array> $values
     * @param string          $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allUniqueValues($values, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allUniqueValues', array($values, $message));
=======
        static::isIterable($values);

        foreach ($values as $entry) {
            static::uniqueValues($entry, $message);
        }
    }

    /**
     * @param iterable<array|null> $values
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrUniqueValues($values, $message = '')
    {
        static::isIterable($values);

        foreach ($values as $entry) {
            null === $entry || static::uniqueValues($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrEq($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrEq', array($value, $expect, $message));
=======
        null === $value || static::eq($value, $expect, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allEq($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allEq', array($value, $expect, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::eq($entry, $expect, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrEq($value, $expect, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::eq($entry, $expect, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotEq($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotEq', array($value, $expect, $message));
=======
        null === $value || static::notEq($value, $expect, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotEq($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotEq', array($value, $expect, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notEq($entry, $expect, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotEq($value, $expect, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notEq($entry, $expect, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrSame($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrSame', array($value, $expect, $message));
=======
        null === $value || static::same($value, $expect, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allSame($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allSame', array($value, $expect, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::same($entry, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrSame($value, $expect, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::same($entry, $expect, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotSame($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotSame', array($value, $expect, $message));
=======
        null === $value || static::notSame($value, $expect, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotSame($value, $expect, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotSame', array($value, $expect, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notSame($entry, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotSame($value, $expect, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notSame($entry, $expect, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrGreaterThan($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrGreaterThan', array($value, $limit, $message));
=======
        null === $value || static::greaterThan($value, $limit, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allGreaterThan($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allGreaterThan', array($value, $limit, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::greaterThan($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrGreaterThan($value, $limit, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::greaterThan($entry, $limit, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrGreaterThanEq($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrGreaterThanEq', array($value, $limit, $message));
=======
        null === $value || static::greaterThanEq($value, $limit, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allGreaterThanEq($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allGreaterThanEq', array($value, $limit, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::greaterThanEq($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrGreaterThanEq($value, $limit, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::greaterThanEq($entry, $limit, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrLessThan($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrLessThan', array($value, $limit, $message));
=======
        null === $value || static::lessThan($value, $limit, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allLessThan($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allLessThan', array($value, $limit, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::lessThan($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrLessThan($value, $limit, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::lessThan($entry, $limit, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrLessThanEq($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrLessThanEq', array($value, $limit, $message));
=======
        null === $value || static::lessThanEq($value, $limit, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allLessThanEq($value, $limit, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allLessThanEq', array($value, $limit, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::lessThanEq($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrLessThanEq($value, $limit, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::lessThanEq($entry, $limit, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrRange($value, $min, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrRange', array($value, $min, $max, $message));
=======
        null === $value || static::range($value, $min, $max, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allRange($value, $min, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allRange', array($value, $min, $max, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::range($entry, $min, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrRange($value, $min, $max, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::range($entry, $min, $max, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrOneOf($value, $values, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrOneOf', array($value, $values, $message));
=======
        null === $value || static::oneOf($value, $values, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allOneOf($value, $values, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allOneOf', array($value, $values, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::oneOf($entry, $values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrOneOf($value, $values, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::oneOf($entry, $values, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrInArray($value, $values, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrInArray', array($value, $values, $message));
=======
        null === $value || static::inArray($value, $values, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allInArray($value, $values, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allInArray', array($value, $values, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::inArray($entry, $values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrInArray($value, $values, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::inArray($entry, $values, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $subString
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrContains($value, $subString, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrContains', array($value, $subString, $message));
=======
        null === $value || static::contains($value, $subString, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $subString
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allContains($value, $subString, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allContains', array($value, $subString, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::contains($entry, $subString, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $subString
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrContains($value, $subString, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::contains($entry, $subString, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $subString
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotContains($value, $subString, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotContains', array($value, $subString, $message));
=======
        null === $value || static::notContains($value, $subString, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $subString
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotContains($value, $subString, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotContains', array($value, $subString, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notContains($entry, $subString, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $subString
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotContains($value, $subString, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notContains($entry, $subString, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotWhitespaceOnly($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotWhitespaceOnly', array($value, $message));
=======
        null === $value || static::notWhitespaceOnly($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotWhitespaceOnly($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotWhitespaceOnly', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notWhitespaceOnly($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotWhitespaceOnly($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notWhitespaceOnly($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $prefix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrStartsWith($value, $prefix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrStartsWith', array($value, $prefix, $message));
=======
        null === $value || static::startsWith($value, $prefix, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $prefix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allStartsWith($value, $prefix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allStartsWith', array($value, $prefix, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::startsWith($entry, $prefix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $prefix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrStartsWith($value, $prefix, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::startsWith($entry, $prefix, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $prefix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotStartsWith($value, $prefix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotStartsWith', array($value, $prefix, $message));
=======
        null === $value || static::notStartsWith($value, $prefix, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $prefix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotStartsWith($value, $prefix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotStartsWith', array($value, $prefix, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notStartsWith($entry, $prefix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $prefix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotStartsWith($value, $prefix, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notStartsWith($entry, $prefix, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrStartsWithLetter($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrStartsWithLetter', array($value, $message));
=======
        null === $value || static::startsWithLetter($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allStartsWithLetter($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allStartsWithLetter', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::startsWithLetter($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrStartsWithLetter($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::startsWithLetter($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $suffix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrEndsWith($value, $suffix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrEndsWith', array($value, $suffix, $message));
=======
        null === $value || static::endsWith($value, $suffix, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $suffix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allEndsWith($value, $suffix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allEndsWith', array($value, $suffix, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::endsWith($entry, $suffix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $suffix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrEndsWith($value, $suffix, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::endsWith($entry, $suffix, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $suffix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotEndsWith($value, $suffix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotEndsWith', array($value, $suffix, $message));
=======
        null === $value || static::notEndsWith($value, $suffix, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $suffix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotEndsWith($value, $suffix, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotEndsWith', array($value, $suffix, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notEndsWith($entry, $suffix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $suffix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotEndsWith($value, $suffix, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notEndsWith($entry, $suffix, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $pattern
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrRegex($value, $pattern, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrRegex', array($value, $pattern, $message));
=======
        null === $value || static::regex($value, $pattern, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $pattern
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allRegex($value, $pattern, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allRegex', array($value, $pattern, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::regex($entry, $pattern, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $pattern
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrRegex($value, $pattern, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::regex($entry, $pattern, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $pattern
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrNotRegex($value, $pattern, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrNotRegex', array($value, $pattern, $message));
=======
        null === $value || static::notRegex($value, $pattern, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $pattern
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNotRegex($value, $pattern, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allNotRegex', array($value, $pattern, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::notRegex($entry, $pattern, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $pattern
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrNotRegex($value, $pattern, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::notRegex($entry, $pattern, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrUnicodeLetters($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrUnicodeLetters', array($value, $message));
=======
        null === $value || static::unicodeLetters($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allUnicodeLetters($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allUnicodeLetters', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::unicodeLetters($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrUnicodeLetters($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::unicodeLetters($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrAlpha($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrAlpha', array($value, $message));
=======
        null === $value || static::alpha($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allAlpha($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allAlpha', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::alpha($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrAlpha($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::alpha($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrDigits($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrDigits', array($value, $message));
=======
        null === $value || static::digits($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allDigits($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allDigits', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::digits($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrDigits($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::digits($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrAlnum($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrAlnum', array($value, $message));
=======
        null === $value || static::alnum($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allAlnum($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allAlnum', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::alnum($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrAlnum($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::alnum($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert lowercase-string|null $value
     *
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrLower($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrLower', array($value, $message));
=======
        null === $value || static::lower($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<lowercase-string> $value
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allLower($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allLower', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::lower($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<lowercase-string|null> $value
     *
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrLower($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::lower($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrUpper($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrUpper', array($value, $message));
=======
        null === $value || static::upper($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allUpper($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allUpper', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::upper($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<!lowercase-string|null> $value
     *
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrUpper($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::upper($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param int         $length
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrLength($value, $length, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrLength', array($value, $length, $message));
=======
        null === $value || static::length($value, $length, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param int              $length
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allLength($value, $length, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allLength', array($value, $length, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::length($entry, $length, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param int                   $length
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrLength($value, $length, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::length($entry, $length, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param int|float   $min
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrMinLength($value, $min, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrMinLength', array($value, $min, $message));
=======
        null === $value || static::minLength($value, $min, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param int|float        $min
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allMinLength($value, $min, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allMinLength', array($value, $min, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::minLength($entry, $min, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param int|float             $min
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrMinLength($value, $min, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::minLength($entry, $min, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param int|float   $max
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrMaxLength($value, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrMaxLength', array($value, $max, $message));
=======
        null === $value || static::maxLength($value, $max, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param int|float        $max
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allMaxLength($value, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allMaxLength', array($value, $max, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::maxLength($entry, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param int|float             $max
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrMaxLength($value, $max, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::maxLength($entry, $max, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param int|float   $min
     * @param int|float   $max
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrLengthBetween($value, $min, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrLengthBetween', array($value, $min, $max, $message));
=======
        null === $value || static::lengthBetween($value, $min, $max, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param int|float        $min
     * @param int|float        $max
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allLengthBetween($value, $min, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allLengthBetween', array($value, $min, $max, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::lengthBetween($entry, $min, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param int|float             $min
     * @param int|float             $max
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrLengthBetween($value, $min, $max, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::lengthBetween($entry, $min, $max, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrFileExists($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrFileExists', array($value, $message));
=======
        null === $value || static::fileExists($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allFileExists($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allFileExists', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::fileExists($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrFileExists($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::fileExists($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrFile($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrFile', array($value, $message));
=======
        null === $value || static::file($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allFile($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allFile', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::file($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrFile($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::file($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrDirectory($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrDirectory', array($value, $message));
=======
        null === $value || static::directory($value, $message);
>>>>>>> main
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allDirectory($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allDirectory', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::directory($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrDirectory($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::directory($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrReadable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrReadable', array($value, $message));
=======
        null === $value || static::readable($value, $message);
>>>>>>> main
    }

    /**
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allReadable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allReadable', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::readable($entry, $message);
        }
    }

    /**
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrReadable($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::readable($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrWritable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrWritable', array($value, $message));
=======
        null === $value || static::writable($value, $message);
>>>>>>> main
    }

    /**
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allWritable($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allWritable', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::writable($entry, $message);
        }
    }

    /**
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrWritable($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::writable($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-assert class-string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrClassExists($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrClassExists', array($value, $message));
=======
        null === $value || static::classExists($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-assert iterable<class-string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allClassExists($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allClassExists', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::classExists($entry, $message);
        }
    }

    /**
     * @psalm-assert iterable<class-string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrClassExists($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::classExists($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert class-string<ExpectedType>|ExpectedType|null $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrSubclassOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrSubclassOf', array($value, $class, $message));
=======
        null === $value || static::subclassOf($value, $class, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<class-string<ExpectedType>|ExpectedType> $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allSubclassOf($value, $class, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allSubclassOf', array($value, $class, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::subclassOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $class
     * @psalm-assert iterable<class-string<ExpectedType>|ExpectedType|null> $value
     *
     * @param mixed         $value
     * @param string|object $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrSubclassOf($value, $class, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::subclassOf($entry, $class, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-assert class-string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrInterfaceExists($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrInterfaceExists', array($value, $message));
=======
        null === $value || static::interfaceExists($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-assert iterable<class-string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allInterfaceExists($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allInterfaceExists', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::interfaceExists($entry, $message);
        }
    }

    /**
     * @psalm-assert iterable<class-string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrInterfaceExists($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::interfaceExists($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $interface
     * @psalm-assert class-string<ExpectedType>|null $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrImplementsInterface($value, $interface, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrImplementsInterface', array($value, $interface, $message));
=======
        null === $value || static::implementsInterface($value, $interface, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $interface
     * @psalm-assert iterable<class-string<ExpectedType>> $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allImplementsInterface($value, $interface, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allImplementsInterface', array($value, $interface, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::implementsInterface($entry, $interface, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $interface
     * @psalm-assert iterable<class-string<ExpectedType>|null> $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrImplementsInterface($value, $interface, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::implementsInterface($entry, $interface, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param string|object|null $classOrObject
     * @param mixed              $property
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrPropertyExists($classOrObject, $property, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrPropertyExists', array($classOrObject, $property, $message));
=======
        null === $classOrObject || static::propertyExists($classOrObject, $property, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<string|object> $classOrObject
     * @param mixed                   $property
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allPropertyExists($classOrObject, $property, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allPropertyExists', array($classOrObject, $property, $message));
=======
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            static::propertyExists($entry, $property, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<string|object|null> $classOrObject
     * @param mixed                        $property
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrPropertyExists($classOrObject, $property, $message = '')
    {
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            null === $entry || static::propertyExists($entry, $property, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param string|object|null $classOrObject
     * @param mixed              $property
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrPropertyNotExists($classOrObject, $property, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrPropertyNotExists', array($classOrObject, $property, $message));
=======
        null === $classOrObject || static::propertyNotExists($classOrObject, $property, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<string|object> $classOrObject
     * @param mixed                   $property
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allPropertyNotExists($classOrObject, $property, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allPropertyNotExists', array($classOrObject, $property, $message));
=======
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            static::propertyNotExists($entry, $property, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<string|object|null> $classOrObject
     * @param mixed                        $property
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrPropertyNotExists($classOrObject, $property, $message = '')
    {
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            null === $entry || static::propertyNotExists($entry, $property, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param string|object|null $classOrObject
     * @param mixed              $method
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrMethodExists($classOrObject, $method, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrMethodExists', array($classOrObject, $method, $message));
=======
        null === $classOrObject || static::methodExists($classOrObject, $method, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<string|object> $classOrObject
     * @param mixed                   $method
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allMethodExists($classOrObject, $method, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allMethodExists', array($classOrObject, $method, $message));
=======
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            static::methodExists($entry, $method, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<string|object|null> $classOrObject
     * @param mixed                        $method
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrMethodExists($classOrObject, $method, $message = '')
    {
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            null === $entry || static::methodExists($entry, $method, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param string|object|null $classOrObject
     * @param mixed              $method
     * @param string             $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrMethodNotExists($classOrObject, $method, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrMethodNotExists', array($classOrObject, $method, $message));
=======
        null === $classOrObject || static::methodNotExists($classOrObject, $method, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<string|object> $classOrObject
     * @param mixed                   $method
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allMethodNotExists($classOrObject, $method, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allMethodNotExists', array($classOrObject, $method, $message));
=======
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            static::methodNotExists($entry, $method, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<string|object|null> $classOrObject
     * @param mixed                        $method
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrMethodNotExists($classOrObject, $method, $message = '')
    {
        static::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            null === $entry || static::methodNotExists($entry, $method, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param array|null $array
     * @param string|int $key
     * @param string     $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrKeyExists($array, $key, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrKeyExists', array($array, $key, $message));
=======
        null === $array || static::keyExists($array, $key, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<array> $array
     * @param string|int      $key
     * @param string          $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allKeyExists($array, $key, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allKeyExists', array($array, $key, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::keyExists($entry, $key, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<array|null> $array
     * @param string|int           $key
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrKeyExists($array, $key, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::keyExists($entry, $key, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param array|null $array
     * @param string|int $key
     * @param string     $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrKeyNotExists($array, $key, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrKeyNotExists', array($array, $key, $message));
=======
        null === $array || static::keyNotExists($array, $key, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<array> $array
     * @param string|int      $key
     * @param string          $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allKeyNotExists($array, $key, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allKeyNotExists', array($array, $key, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::keyNotExists($entry, $key, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<array|null> $array
     * @param string|int           $key
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrKeyNotExists($array, $key, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::keyNotExists($entry, $key, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert array-key|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrValidArrayKey($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrValidArrayKey', array($value, $message));
=======
        null === $value || static::validArrayKey($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<array-key> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allValidArrayKey($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allValidArrayKey', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::validArrayKey($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<array-key|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrValidArrayKey($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::validArrayKey($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @param Countable|array|null $array
     * @param int                  $number
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrCount($array, $number, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrCount', array($array, $number, $message));
=======
        null === $array || static::count($array, $number, $message);
>>>>>>> main
    }

    /**
     * @param iterable<Countable|array> $array
     * @param int                       $number
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allCount($array, $number, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allCount', array($array, $number, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::count($entry, $number, $message);
        }
    }

    /**
     * @param iterable<Countable|array|null> $array
     * @param int                            $number
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrCount($array, $number, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::count($entry, $number, $message);
        }
>>>>>>> main
    }

    /**
     * @param Countable|array|null $array
     * @param int|float            $min
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrMinCount($array, $min, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrMinCount', array($array, $min, $message));
=======
        null === $array || static::minCount($array, $min, $message);
>>>>>>> main
    }

    /**
     * @param iterable<Countable|array> $array
     * @param int|float                 $min
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allMinCount($array, $min, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allMinCount', array($array, $min, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::minCount($entry, $min, $message);
        }
    }

    /**
     * @param iterable<Countable|array|null> $array
     * @param int|float                      $min
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrMinCount($array, $min, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::minCount($entry, $min, $message);
        }
>>>>>>> main
    }

    /**
     * @param Countable|array|null $array
     * @param int|float            $max
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrMaxCount($array, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrMaxCount', array($array, $max, $message));
=======
        null === $array || static::maxCount($array, $max, $message);
>>>>>>> main
    }

    /**
     * @param iterable<Countable|array> $array
     * @param int|float                 $max
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allMaxCount($array, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allMaxCount', array($array, $max, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::maxCount($entry, $max, $message);
        }
    }

    /**
     * @param iterable<Countable|array|null> $array
     * @param int|float                      $max
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrMaxCount($array, $max, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::maxCount($entry, $max, $message);
        }
>>>>>>> main
    }

    /**
     * @param Countable|array|null $array
     * @param int|float            $min
     * @param int|float            $max
     * @param string               $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrCountBetween($array, $min, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrCountBetween', array($array, $min, $max, $message));
=======
        null === $array || static::countBetween($array, $min, $max, $message);
>>>>>>> main
    }

    /**
     * @param iterable<Countable|array> $array
     * @param int|float                 $min
     * @param int|float                 $max
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allCountBetween($array, $min, $max, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allCountBetween', array($array, $min, $max, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::countBetween($entry, $min, $max, $message);
        }
    }

    /**
     * @param iterable<Countable|array|null> $array
     * @param int|float                      $min
     * @param int|float                      $max
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrCountBetween($array, $min, $max, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::countBetween($entry, $min, $max, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert list|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsList($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsList', array($array, $message));
=======
        null === $array || static::isList($array, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<list> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsList($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsList', array($array, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::isList($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<list|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsList($array, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::isList($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert non-empty-list|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsNonEmptyList($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsNonEmptyList', array($array, $message));
=======
        null === $array || static::isNonEmptyList($array, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<non-empty-list> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsNonEmptyList($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsNonEmptyList', array($array, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::isNonEmptyList($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-assert iterable<non-empty-list|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsNonEmptyList($array, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::isNonEmptyList($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template T
     * @psalm-param mixed|array<T>|null $array
     * @psalm-assert array<string, T>|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsMap($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsMap', array($array, $message));
=======
        null === $array || static::isMap($array, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template T
     * @psalm-param iterable<mixed|array<T>> $array
     * @psalm-assert iterable<array<string, T>> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsMap($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsMap', array($array, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::isMap($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template T
     * @psalm-param iterable<mixed|array<T>|null> $array
     * @psalm-assert iterable<array<string, T>|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsMap($array, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::isMap($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template T
     * @psalm-param mixed|array<T>|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrIsNonEmptyMap($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrIsNonEmptyMap', array($array, $message));
=======
        null === $array || static::isNonEmptyMap($array, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     * @psalm-template T
     * @psalm-param iterable<mixed|array<T>> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allIsNonEmptyMap($array, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allIsNonEmptyMap', array($array, $message));
=======
        static::isIterable($array);

        foreach ($array as $entry) {
            static::isNonEmptyMap($entry, $message);
        }
    }

    /**
     * @psalm-pure
     * @psalm-template T
     * @psalm-param iterable<mixed|array<T>|null> $array
     * @psalm-assert iterable<array<string, T>|null> $array
     * @psalm-assert iterable<!empty|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrIsNonEmptyMap($array, $message = '')
    {
        static::isIterable($array);

        foreach ($array as $entry) {
            null === $entry || static::isNonEmptyMap($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param string|null $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrUuid($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrUuid', array($value, $message));
=======
        null === $value || static::uuid($value, $message);
>>>>>>> main
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allUuid($value, $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allUuid', array($value, $message));
=======
        static::isIterable($value);

        foreach ($value as $entry) {
            static::uuid($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string|null> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrUuid($value, $message = '')
    {
        static::isIterable($value);

        foreach ($value as $entry) {
            null === $entry || static::uuid($entry, $message);
        }
>>>>>>> main
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param Closure|null $expression
     * @param string       $class
     * @param string       $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function nullOrThrows($expression, $class = 'Exception', $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('nullOrThrows', array($expression, $class, $message));
=======
        null === $expression || static::throws($expression, $class, $message);
>>>>>>> main
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param iterable<Closure> $expression
     * @param string            $class
     * @param string            $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allThrows($expression, $class = 'Exception', $message = '')
    {
<<<<<<< HEAD
        static::__callStatic('allThrows', array($expression, $class, $message));
=======
        static::isIterable($expression);

        foreach ($expression as $entry) {
            static::throws($entry, $class, $message);
        }
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param iterable<Closure|null> $expression
     * @param string                 $class
     * @param string                 $message
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public static function allNullOrThrows($expression, $class = 'Exception', $message = '')
    {
        static::isIterable($expression);

        foreach ($expression as $entry) {
            null === $entry || static::throws($entry, $class, $message);
        }
>>>>>>> main
    }
}
