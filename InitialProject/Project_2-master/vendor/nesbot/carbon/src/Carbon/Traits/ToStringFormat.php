<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> main
/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Traits;

<<<<<<< HEAD
use Carbon\FactoryImmutable;
=======
>>>>>>> main
use Closure;

/**
 * Trait ToStringFormat.
 *
 * Handle global format customization for string cast of the object.
 */
trait ToStringFormat
{
    /**
<<<<<<< HEAD
=======
     * Format to use for __toString method when type juggling occurs.
     *
     * @var string|Closure|null
     */
    protected static $toStringFormat;

    /**
>>>>>>> main
     * Reset the format used to the default when type juggling a Carbon instance to a string
     *
     * @return void
     */
<<<<<<< HEAD
    public static function resetToStringFormat(): void
    {
        FactoryImmutable::getDefaultInstance()->resetToStringFormat();
=======
    public static function resetToStringFormat()
    {
        static::setToStringFormat(null);
>>>>>>> main
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather let Carbon object being cast to string with DEFAULT_TO_STRING_FORMAT, and
     *             use other method or custom format passed to format() method if you need to dump another string
     *             format.
     *
     * Set the default format used when type juggling a Carbon instance to a string.
     *
     * @param string|Closure|null $format
     *
     * @return void
     */
<<<<<<< HEAD
    public static function setToStringFormat(string|Closure|null $format): void
    {
        FactoryImmutable::getDefaultInstance()->setToStringFormat($format);
=======
    public static function setToStringFormat($format)
    {
        static::$toStringFormat = $format;
>>>>>>> main
    }
}
