<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Spanish;

use Doctrine\Inflector\Rules\Pattern;

final class Uninflected
{
<<<<<<< HEAD
    /**
     * @return Pattern[]
     */
=======
    /** @return Pattern[] */
>>>>>>> main
    public static function getSingular(): iterable
    {
        yield from self::getDefault();
    }

<<<<<<< HEAD
    /**
     * @return Pattern[]
     */
=======
    /** @return Pattern[] */
>>>>>>> main
    public static function getPlural(): iterable
    {
        yield from self::getDefault();
    }

<<<<<<< HEAD
    /**
     * @return Pattern[]
     */
=======
    /** @return Pattern[] */
>>>>>>> main
    private static function getDefault(): iterable
    {
        yield new Pattern('lunes');
        yield new Pattern('rompecabezas');
        yield new Pattern('crisis');
    }
}
