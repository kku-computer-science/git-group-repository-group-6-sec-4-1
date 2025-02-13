<?php declare(strict_types=1);

namespace PhpParser\ErrorHandler;

use PhpParser\Error;
use PhpParser\ErrorHandler;

/**
 * Error handler that collects all errors into an array.
 *
 * This allows graceful handling of errors.
 */
<<<<<<< HEAD
class Collecting implements ErrorHandler
{
    /** @var Error[] Collected errors */
    private $errors = [];

    public function handleError(Error $error) {
=======
class Collecting implements ErrorHandler {
    /** @var Error[] Collected errors */
    private array $errors = [];

    public function handleError(Error $error): void {
>>>>>>> main
        $this->errors[] = $error;
    }

    /**
     * Get collected errors.
     *
     * @return Error[]
     */
<<<<<<< HEAD
    public function getErrors() : array {
=======
    public function getErrors(): array {
>>>>>>> main
        return $this->errors;
    }

    /**
     * Check whether there are any errors.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function hasErrors() : bool {
=======
     */
    public function hasErrors(): bool {
>>>>>>> main
        return !empty($this->errors);
    }

    /**
     * Reset/clear collected errors.
     */
<<<<<<< HEAD
    public function clearErrors() {
=======
    public function clearErrors(): void {
>>>>>>> main
        $this->errors = [];
    }
}
