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
>>>>>>> main
use InvalidArgumentException as BaseInvalidArgumentException;

class InvalidTypeException extends BaseInvalidArgumentException implements InvalidArgumentException
{
<<<<<<< HEAD
    /**
     * Constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
=======
    //
>>>>>>> main
}
