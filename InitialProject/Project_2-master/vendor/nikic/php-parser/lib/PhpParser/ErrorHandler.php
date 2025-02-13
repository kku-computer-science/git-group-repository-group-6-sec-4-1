<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
interface ErrorHandler
{
=======
interface ErrorHandler {
>>>>>>> main
    /**
     * Handle an error generated during lexing, parsing or some other operation.
     *
     * @param Error $error The error that needs to be handled
     */
<<<<<<< HEAD
    public function handleError(Error $error);
=======
    public function handleError(Error $error): void;
>>>>>>> main
}
