<?php

namespace Maatwebsite\Excel\Cache;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Cache;
>>>>>>> main
use Psr\SimpleCache\CacheInterface;

class BatchCache implements CacheInterface
{
    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var MemoryCache
     */
    protected $memory;

    /**
<<<<<<< HEAD
     * @param  CacheInterface  $cache
     * @param  MemoryCache  $memory
     */
    public function __construct(CacheInterface $cache, MemoryCache $memory)
    {
        $this->cache  = $cache;
        $this->memory = $memory;
=======
     * @var null|int|\DateInterval|callable
     */
    protected $defaultTTL = null;

    /**
     * @param  CacheInterface  $cache
     * @param  MemoryCache  $memory
     * @param  null|int|\DateInterval|callable  $defaultTTL
     */
    public function __construct(
        CacheInterface $cache,
        MemoryCache $memory,
        null|int|\DateInterval|callable $defaultTTL = null
    ) {
        $this->cache      = $cache;
        $this->memory     = $memory;
        $this->defaultTTL = $defaultTTL;
    }

    public function __sleep()
    {
        return ['memory'];
    }

    public function __wakeup()
    {
        $this->cache = Cache::driver(
            config('excel.cache.illuminate.store')
        );
>>>>>>> main
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
        if ($this->memory->has($key)) {
            return $this->memory->get($key);
        }

        return $this->cache->get($key, $default);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function set($key, $value, $ttl = null)
    {
=======
    public function set(string $key, mixed $value, null|int|\DateInterval $ttl = null): bool
    {
        if (func_num_args() === 2) {
            $ttl = value($this->defaultTTL);
        }

>>>>>>> main
        $this->memory->set($key, $value, $ttl);

        if ($this->memory->reachedMemoryLimit()) {
            return $this->cache->setMultiple($this->memory->flush(), $ttl);
        }

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
        if ($this->memory->has($key)) {
            return $this->memory->delete($key);
        }

        return $this->cache->delete($key);
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
        $this->memory->clear();

        return $this->cache->clear();
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
        // Check if all keys are still in memory
        $memory              = $this->memory->getMultiple($keys, $default);
        $actualItemsInMemory = count(array_filter($memory));

        if ($actualItemsInMemory === count($keys)) {
            return $memory;
        }

        // Get all rows from cache if none is hold in memory.
        if ($actualItemsInMemory === 0) {
            return $this->cache->getMultiple($keys, $default);
        }

        // Add missing values from cache.
        foreach ($this->cache->getMultiple($keys, $default) as $key => $value) {
            if (null !== $value) {
                $memory[$key] = $value;
            }
        }

        return $memory;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function setMultiple($values, $ttl = null)
    {
=======
    public function setMultiple(iterable $values, null|int|\DateInterval $ttl = null): bool
    {
        if (func_num_args() === 1) {
            $ttl = value($this->defaultTTL);
        }

>>>>>>> main
        $this->memory->setMultiple($values, $ttl);

        if ($this->memory->reachedMemoryLimit()) {
            return $this->cache->setMultiple($this->memory->flush(), $ttl);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function deleteMultiple($keys)
=======
    public function deleteMultiple(iterable $keys): bool
>>>>>>> main
    {
        $keys = is_array($keys) ? $keys : iterator_to_array($keys);

        $this->memory->deleteMultiple($keys);

        return $this->cache->deleteMultiple($keys);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function has($key)
=======
    public function has(string $key): bool
>>>>>>> main
    {
        if ($this->memory->has($key)) {
            return true;
        }

        return $this->cache->has($key);
    }
}
