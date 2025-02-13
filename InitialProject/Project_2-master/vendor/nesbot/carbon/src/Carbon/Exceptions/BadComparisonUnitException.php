<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Exceptions;

<<<<<<< HEAD
use Exception;
=======
use Throwable;
>>>>>>> main

class BadComparisonUnitException extends UnitException
{
    /**
<<<<<<< HEAD
=======
     * The unit.
     *
     * @var string
     */
    protected $unit;

    /**
>>>>>>> main
     * Constructor.
     *
     * @param string         $unit
     * @param int            $code
<<<<<<< HEAD
     * @param Exception|null $previous
     */
    public function __construct($unit, $code = 0, Exception $previous = null)
    {
        parent::__construct("Bad comparison unit: '$unit'", $code, $previous);
    }
=======
     * @param Throwable|null $previous
     */
    public function __construct($unit, $code = 0, Throwable $previous = null)
    {
        $this->unit = $unit;

        parent::__construct("Bad comparison unit: '$unit'", $code, $previous);
    }

    /**
     * Get the unit.
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
>>>>>>> main
}
