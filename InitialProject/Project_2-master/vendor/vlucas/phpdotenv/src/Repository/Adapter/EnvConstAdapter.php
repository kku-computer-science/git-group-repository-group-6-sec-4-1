<?php

declare(strict_types=1);

namespace Dotenv\Repository\Adapter;

use PhpOption\Option;
use PhpOption\Some;

final class EnvConstAdapter implements AdapterInterface
{
    /**
     * Create a new env const adapter instance.
     *
     * @return void
     */
    private function __construct()
    {
        //
    }

    /**
     * Create a new instance of the adapter, if it is available.
     *
     * @return \PhpOption\Option<\Dotenv\Repository\Adapter\AdapterInterface>
     */
    public static function create()
    {
        /** @var \PhpOption\Option<AdapterInterface> */
        return Some::create(new self());
    }

    /**
     * Read an environment variable, if it exists.
     *
<<<<<<< HEAD
     * @param string $name
=======
     * @param non-empty-string $name
>>>>>>> main
     *
     * @return \PhpOption\Option<string>
     */
    public function read(string $name)
    {
        /** @var \PhpOption\Option<string> */
        return Option::fromArraysValue($_ENV, $name)
<<<<<<< HEAD
=======
            ->filter(static function ($value) {
                return \is_scalar($value);
            })
>>>>>>> main
            ->map(static function ($value) {
                if ($value === false) {
                    return 'false';
                }

                if ($value === true) {
                    return 'true';
                }

<<<<<<< HEAD
                return $value;
            })->filter(static function ($value) {
                return \is_string($value);
=======
                /** @psalm-suppress PossiblyInvalidCast */
                return (string) $value;
>>>>>>> main
            });
    }

    /**
     * Write to an environment variable, if possible.
     *
<<<<<<< HEAD
     * @param string $name
     * @param string $value
=======
     * @param non-empty-string $name
     * @param string           $value
>>>>>>> main
     *
     * @return bool
     */
    public function write(string $name, string $value)
    {
        $_ENV[$name] = $value;

        return true;
    }

    /**
     * Delete an environment variable, if possible.
     *
<<<<<<< HEAD
     * @param string $name
=======
     * @param non-empty-string $name
>>>>>>> main
     *
     * @return bool
     */
    public function delete(string $name)
    {
        unset($_ENV[$name]);

        return true;
    }
}
