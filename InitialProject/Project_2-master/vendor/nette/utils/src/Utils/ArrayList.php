<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * Provides the base class for a generic list (items can be accessed by index).
 * @template T
<<<<<<< HEAD
=======
 * @implements \IteratorAggregate<int, T>
 * @implements \ArrayAccess<int, T>
>>>>>>> main
 */
class ArrayList implements \ArrayAccess, \Countable, \IteratorAggregate
{
	use Nette\SmartObject;

<<<<<<< HEAD
	/** @var mixed[] */
	private $list = [];
=======
	private array $list = [];
>>>>>>> main


	/**
	 * Transforms array to ArrayList.
<<<<<<< HEAD
	 * @param  array<T>  $array
	 * @return static
	 */
	public static function from(array $array)
=======
	 * @param  list<T>  $array
	 */
	public static function from(array $array): static
>>>>>>> main
	{
		if (!Arrays::isList($array)) {
			throw new Nette\InvalidArgumentException('Array is not valid list.');
		}

		$obj = new static;
		$obj->list = $array;
		return $obj;
	}


	/**
	 * Returns an iterator over all items.
<<<<<<< HEAD
	 * @return \ArrayIterator<int, T>
	 */
	public function getIterator(): \ArrayIterator
	{
		return new \ArrayIterator($this->list);
=======
	 * @return \Iterator<int, T>
	 */
	public function &getIterator(): \Iterator
	{
		foreach ($this->list as &$item) {
			yield $item;
		}
>>>>>>> main
	}


	/**
	 * Returns items count.
	 */
	public function count(): int
	{
		return count($this->list);
	}


	/**
	 * Replaces or appends a item.
	 * @param  int|null  $index
	 * @param  T  $value
	 * @throws Nette\OutOfRangeException
	 */
	public function offsetSet($index, $value): void
	{
		if ($index === null) {
			$this->list[] = $value;

		} elseif (!is_int($index) || $index < 0 || $index >= count($this->list)) {
			throw new Nette\OutOfRangeException('Offset invalid or out of range');

		} else {
			$this->list[$index] = $value;
		}
	}


	/**
	 * Returns a item.
	 * @param  int  $index
	 * @return T
	 * @throws Nette\OutOfRangeException
	 */
<<<<<<< HEAD
	#[\ReturnTypeWillChange]
	public function offsetGet($index)
=======
	public function offsetGet($index): mixed
>>>>>>> main
	{
		if (!is_int($index) || $index < 0 || $index >= count($this->list)) {
			throw new Nette\OutOfRangeException('Offset invalid or out of range');
		}

		return $this->list[$index];
	}


	/**
	 * Determines whether a item exists.
	 * @param  int  $index
	 */
	public function offsetExists($index): bool
	{
		return is_int($index) && $index >= 0 && $index < count($this->list);
	}


	/**
	 * Removes the element at the specified position in this list.
	 * @param  int  $index
	 * @throws Nette\OutOfRangeException
	 */
	public function offsetUnset($index): void
	{
		if (!is_int($index) || $index < 0 || $index >= count($this->list)) {
			throw new Nette\OutOfRangeException('Offset invalid or out of range');
		}

		array_splice($this->list, $index, 1);
	}


	/**
	 * Prepends a item.
	 * @param  T  $value
	 */
<<<<<<< HEAD
	public function prepend($value): void
=======
	public function prepend(mixed $value): void
>>>>>>> main
	{
		$first = array_slice($this->list, 0, 1);
		$this->offsetSet(0, $value);
		array_splice($this->list, 1, 0, $first);
	}
}
