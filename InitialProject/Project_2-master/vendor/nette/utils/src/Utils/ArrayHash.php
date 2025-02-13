<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * Provides objects to work as array.
 * @template T
<<<<<<< HEAD
=======
 * @implements \IteratorAggregate<array-key, T>
 * @implements \ArrayAccess<array-key, T>
>>>>>>> main
 */
class ArrayHash extends \stdClass implements \ArrayAccess, \Countable, \IteratorAggregate
{
	/**
	 * Transforms array to ArrayHash.
	 * @param  array<T>  $array
<<<<<<< HEAD
	 * @return static
	 */
	public static function from(array $array, bool $recursive = true)
=======
	 */
	public static function from(array $array, bool $recursive = true): static
>>>>>>> main
	{
		$obj = new static;
		foreach ($array as $key => $value) {
			$obj->$key = $recursive && is_array($value)
<<<<<<< HEAD
				? static::from($value, true)
=======
				? static::from($value)
>>>>>>> main
				: $value;
		}

		return $obj;
	}


	/**
	 * Returns an iterator over all items.
<<<<<<< HEAD
	 * @return \RecursiveArrayIterator<array-key, T>
	 */
	public function getIterator(): \RecursiveArrayIterator
	{
		return new \RecursiveArrayIterator((array) $this);
=======
	 * @return \Iterator<array-key, T>
	 */
	public function &getIterator(): \Iterator
	{
		foreach ((array) $this as $key => $foo) {
			yield $key => $this->$key;
		}
>>>>>>> main
	}


	/**
	 * Returns items count.
	 */
	public function count(): int
	{
		return count((array) $this);
	}


	/**
	 * Replaces or appends a item.
<<<<<<< HEAD
	 * @param  string|int  $key
=======
	 * @param  array-key  $key
>>>>>>> main
	 * @param  T  $value
	 */
	public function offsetSet($key, $value): void
	{
		if (!is_scalar($key)) { // prevents null
<<<<<<< HEAD
			throw new Nette\InvalidArgumentException(sprintf('Key must be either a string or an integer, %s given.', gettype($key)));
=======
			throw new Nette\InvalidArgumentException(sprintf('Key must be either a string or an integer, %s given.', get_debug_type($key)));
>>>>>>> main
		}

		$this->$key = $value;
	}


	/**
	 * Returns a item.
<<<<<<< HEAD
	 * @param  string|int  $key
=======
	 * @param  array-key  $key
>>>>>>> main
	 * @return T
	 */
	#[\ReturnTypeWillChange]
	public function offsetGet($key)
	{
		return $this->$key;
	}


	/**
	 * Determines whether a item exists.
<<<<<<< HEAD
	 * @param  string|int  $key
=======
	 * @param  array-key  $key
>>>>>>> main
	 */
	public function offsetExists($key): bool
	{
		return isset($this->$key);
	}


	/**
	 * Removes the element from this list.
<<<<<<< HEAD
	 * @param  string|int  $key
=======
	 * @param  array-key  $key
>>>>>>> main
	 */
	public function offsetUnset($key): void
	{
		unset($this->$key);
	}
}
