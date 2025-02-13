<?php

namespace Maatwebsite\Excel\Cache;

<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Cell\Cell;
>>>>>>> main
use Psr\SimpleCache\CacheInterface;

class MemoryCache implements CacheInterface
{
    /**
     * @var int|null
     */
    protected $memoryLimit;

    /**
     * @var array
     */
    protected $cache = [];

    /**
     * @param  int|null  $memoryLimit
     */
<<<<<<< HEAD
    public function __construct(int $memoryLimit = null)
=======
    public function __construct(?int $memoryLimit = null)
>>>>>>> main
    {
        $this->memoryLimit = $memoryLimit;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function clear()
=======
    public function clear(): bool
>>>>>>> main
    {
        $this->cache = [];

        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function delete($key)
=======
    public function delete(string $key): bool
>>>>>>> main
    {
        unset($this->cache[$key]);

        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function deleteMultiple($keys)
=======
    public function deleteMultiple($keys): bool
>>>>>>> main
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function get($key, $default = null)
=======
    public function get(string $key, mixed $default = null): mixed
>>>>>>> main
    {
        if ($this->has($key)) {
            return $this->cache[$key];
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getMultiple($keys, $default = null)
=======
    public function getMultiple(iterable $keys, mixed $default = null): iterable
>>>>>>> main
    {
        $results = [];
        foreach ($keys as $key) {
            $results[$key] = $this->get($key, $default);
        }

        return $results;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function has($key)
=======
    public function has($key): bool
>>>>>>> main
    {
        return isset($this->cache[$key]);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function set($key, $value, $ttl = null)
=======
    public function set(string $key, mixed $value, null|int|\DateInterval $ttl = null): bool
>>>>>>> main
    {
        $this->cache[$key] = $value;

        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setMultiple($values, $ttl = null)
=======
    public function setMultiple($values, $ttl = null): bool
>>>>>>> main
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function reachedMemoryLimit(): bool
    {
        // When no limit is given, we'll never reach any limit.
        if (null === $this->memoryLimit) {
            return false;
        }

        return count($this->cache) >= $this->memoryLimit;
    }

    /**
     * @return array
     */
    public function flush(): array
    {
        $memory = $this->cache;

<<<<<<< HEAD
=======
        foreach ($memory as $cell) {
            if ($cell instanceof Cell) {
                $cell->detach();
            }
        }

>>>>>>> main
        $this->clear();

        return $memory;
    }
}
