<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2022 Justin Hileman
=======
 * (c) 2012-2023 Justin Hileman
>>>>>>> main
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Exception;

/**
 * A RuntimeException for Psy.
 */
class RuntimeException extends \RuntimeException implements Exception
{
<<<<<<< HEAD
    private $rawMessage;
=======
    private string $rawMessage;
>>>>>>> main

    /**
     * Make this bad boy.
     *
     * @param string          $message  (default: "")
     * @param int             $code     (default: 0)
<<<<<<< HEAD
     * @param \Exception|null $previous (default: null)
     */
    public function __construct(string $message = '', int $code = 0, \Exception $previous = null)
=======
     * @param \Throwable|null $previous (default: null)
     */
    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
>>>>>>> main
    {
        $this->rawMessage = $message;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Return a raw (unformatted) version of the error message.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    public function getRawMessage(): string
    {
        return $this->rawMessage;
    }
}
