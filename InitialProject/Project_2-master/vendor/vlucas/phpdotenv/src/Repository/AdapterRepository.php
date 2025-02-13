<?php

declare(strict_types=1);

namespace Dotenv\Repository;

use Dotenv\Repository\Adapter\ReaderInterface;
use Dotenv\Repository\Adapter\WriterInterface;
<<<<<<< HEAD
=======
use InvalidArgumentException;
>>>>>>> main

final class AdapterRepository implements RepositoryInterface
{
    /**
     * The reader to use.
     *
     * @var \Dotenv\Repository\Adapter\ReaderInterface
     */
    private $reader;

    /**
     * The writer to use.
     *
     * @var \Dotenv\Repository\Adapter\WriterInterface
     */
    private $writer;

    /**
     * Create a new adapter repository instance.
     *
     * @param \Dotenv\Repository\Adapter\ReaderInterface $reader
     * @param \Dotenv\Repository\Adapter\WriterInterface $writer
     *
     * @return void
     */
    public function __construct(ReaderInterface $reader, WriterInterface $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * Determine if the given environment variable is defined.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name)
    {
<<<<<<< HEAD
        return $this->reader->read($name)->isDefined();
=======
        return '' !== $name && $this->reader->read($name)->isDefined();
>>>>>>> main
    }

    /**
     * Get an environment variable.
     *
     * @param string $name
     *
<<<<<<< HEAD
=======
     * @throws \InvalidArgumentException
     *
>>>>>>> main
     * @return string|null
     */
    public function get(string $name)
    {
<<<<<<< HEAD
=======
        if ('' === $name) {
            throw new InvalidArgumentException('Expected name to be a non-empty string.');
        }

>>>>>>> main
        return $this->reader->read($name)->getOrElse(null);
    }

    /**
     * Set an environment variable.
     *
     * @param string $name
     * @param string $value
     *
<<<<<<< HEAD
=======
     * @throws \InvalidArgumentException
     *
>>>>>>> main
     * @return bool
     */
    public function set(string $name, string $value)
    {
<<<<<<< HEAD
=======
        if ('' === $name) {
            throw new InvalidArgumentException('Expected name to be a non-empty string.');
        }

>>>>>>> main
        return $this->writer->write($name, $value);
    }

    /**
     * Clear an environment variable.
     *
     * @param string $name
     *
<<<<<<< HEAD
=======
     * @throws \InvalidArgumentException
     *
>>>>>>> main
     * @return bool
     */
    public function clear(string $name)
    {
<<<<<<< HEAD
=======
        if ('' === $name) {
            throw new InvalidArgumentException('Expected name to be a non-empty string.');
        }

>>>>>>> main
        return $this->writer->delete($name);
    }
}
