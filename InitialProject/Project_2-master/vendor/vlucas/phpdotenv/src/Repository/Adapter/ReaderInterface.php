<?php

declare(strict_types=1);

namespace Dotenv\Repository\Adapter;

interface ReaderInterface
{
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
    public function read(string $name);
}
