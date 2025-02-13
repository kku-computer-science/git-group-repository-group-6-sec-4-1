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

use BadMethodCallException as BaseBadMethodCallException;
<<<<<<< HEAD
use Exception;
=======
use Throwable;
>>>>>>> main

class BadFluentConstructorException extends BaseBadMethodCallException implements BadMethodCallException
{
    /**
<<<<<<< HEAD
=======
     * The method.
     *
     * @var string
     */
    protected $method;

    /**
>>>>>>> main
     * Constructor.
     *
     * @param string         $method
     * @param int            $code
<<<<<<< HEAD
     * @param Exception|null $previous
     */
    public function __construct($method, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf("Unknown fluent constructor '%s'.", $method), $code, $previous);
    }
=======
     * @param Throwable|null $previous
     */
    public function __construct($method, $code = 0, Throwable $previous = null)
    {
        $this->method = $method;

        parent::__construct(sprintf("Unknown fluent constructor '%s'.", $method), $code, $previous);
    }

    /**
     * Get the method.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
>>>>>>> main
}
