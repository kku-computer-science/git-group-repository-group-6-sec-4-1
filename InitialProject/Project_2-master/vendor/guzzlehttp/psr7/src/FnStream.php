<?php

declare(strict_types=1);

namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Compose stream implementations based on a hash of functions.
 *
 * Allows for easy testing and extension of a provided stream without needing
 * to create a concrete class for a simple extension point.
 */
<<<<<<< HEAD
=======
#[\AllowDynamicProperties]
>>>>>>> main
final class FnStream implements StreamInterface
{
    private const SLOTS = [
        '__toString', 'close', 'detach', 'rewind',
        'getSize', 'tell', 'eof', 'isSeekable', 'seek', 'isWritable', 'write',
<<<<<<< HEAD
        'isReadable', 'read', 'getContents', 'getMetadata'
=======
        'isReadable', 'read', 'getContents', 'getMetadata',
>>>>>>> main
    ];

    /** @var array<string, callable> */
    private $methods;

    /**
     * @param array<string, callable> $methods Hash of method name to a callable.
     */
    public function __construct(array $methods)
    {
        $this->methods = $methods;

        // Create the functions on the class
        foreach ($methods as $name => $fn) {
<<<<<<< HEAD
            $this->{'_fn_' . $name} = $fn;
=======
            $this->{'_fn_'.$name} = $fn;
>>>>>>> main
        }
    }

    /**
     * Lazily determine which methods are not implemented.
     *
     * @throws \BadMethodCallException
     */
    public function __get(string $name): void
    {
        throw new \BadMethodCallException(str_replace('_fn_', '', $name)
<<<<<<< HEAD
            . '() is not implemented in the FnStream');
=======
            .'() is not implemented in the FnStream');
>>>>>>> main
    }

    /**
     * The close method is called on the underlying stream only if possible.
     */
    public function __destruct()
    {
        if (isset($this->_fn_close)) {
<<<<<<< HEAD
            call_user_func($this->_fn_close);
=======
            ($this->_fn_close)();
>>>>>>> main
        }
    }

    /**
     * An unserialize would allow the __destruct to run when the unserialized value goes out of scope.
     *
     * @throws \LogicException
     */
    public function __wakeup(): void
    {
        throw new \LogicException('FnStream should never be unserialized');
    }

    /**
     * Adds custom functionality to an underlying stream by intercepting
     * specific method calls.
     *
     * @param StreamInterface         $stream  Stream to decorate
     * @param array<string, callable> $methods Hash of method name to a closure
     *
     * @return FnStream
     */
    public static function decorate(StreamInterface $stream, array $methods)
    {
        // If any of the required methods were not provided, then simply
        // proxy to the decorated stream.
        foreach (array_diff(self::SLOTS, array_keys($methods)) as $diff) {
            /** @var callable $callable */
            $callable = [$stream, $diff];
            $methods[$diff] = $callable;
        }

        return new self($methods);
    }

    public function __toString(): string
    {
        try {
<<<<<<< HEAD
            return call_user_func($this->_fn___toString);
=======
            /** @var string */
            return ($this->_fn___toString)();
>>>>>>> main
        } catch (\Throwable $e) {
            if (\PHP_VERSION_ID >= 70400) {
                throw $e;
            }
            trigger_error(sprintf('%s::__toString exception: %s', self::class, (string) $e), E_USER_ERROR);
<<<<<<< HEAD
=======

>>>>>>> main
            return '';
        }
    }

    public function close(): void
    {
<<<<<<< HEAD
        call_user_func($this->_fn_close);
=======
        ($this->_fn_close)();
>>>>>>> main
    }

    public function detach()
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_detach);
=======
        return ($this->_fn_detach)();
>>>>>>> main
    }

    public function getSize(): ?int
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_getSize);
=======
        return ($this->_fn_getSize)();
>>>>>>> main
    }

    public function tell(): int
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_tell);
=======
        return ($this->_fn_tell)();
>>>>>>> main
    }

    public function eof(): bool
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_eof);
=======
        return ($this->_fn_eof)();
>>>>>>> main
    }

    public function isSeekable(): bool
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_isSeekable);
=======
        return ($this->_fn_isSeekable)();
>>>>>>> main
    }

    public function rewind(): void
    {
<<<<<<< HEAD
        call_user_func($this->_fn_rewind);
=======
        ($this->_fn_rewind)();
>>>>>>> main
    }

    public function seek($offset, $whence = SEEK_SET): void
    {
<<<<<<< HEAD
        call_user_func($this->_fn_seek, $offset, $whence);
=======
        ($this->_fn_seek)($offset, $whence);
>>>>>>> main
    }

    public function isWritable(): bool
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_isWritable);
=======
        return ($this->_fn_isWritable)();
>>>>>>> main
    }

    public function write($string): int
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_write, $string);
=======
        return ($this->_fn_write)($string);
>>>>>>> main
    }

    public function isReadable(): bool
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_isReadable);
=======
        return ($this->_fn_isReadable)();
>>>>>>> main
    }

    public function read($length): string
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_read, $length);
=======
        return ($this->_fn_read)($length);
>>>>>>> main
    }

    public function getContents(): string
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_getContents);
    }

    /**
     * {@inheritdoc}
     *
=======
        return ($this->_fn_getContents)();
    }

    /**
>>>>>>> main
     * @return mixed
     */
    public function getMetadata($key = null)
    {
<<<<<<< HEAD
        return call_user_func($this->_fn_getMetadata, $key);
=======
        return ($this->_fn_getMetadata)($key);
>>>>>>> main
    }
}
