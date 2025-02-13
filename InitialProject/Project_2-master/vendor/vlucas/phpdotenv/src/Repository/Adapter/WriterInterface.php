<?php

declare(strict_types=1);

namespace Dotenv\Repository\Adapter;

interface WriterInterface
{
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
    public function write(string $name, string $value);

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
    public function delete(string $name);
}
