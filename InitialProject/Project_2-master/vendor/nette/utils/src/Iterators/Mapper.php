<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Iterators;


<<<<<<< HEAD

/**
 * Applies the callback to the elements of the inner iterator.
=======
/**
 * @deprecated use Nette\Utils\Iterables::map()
>>>>>>> main
 */
class Mapper extends \IteratorIterator
{
	/** @var callable */
	private $callback;


	public function __construct(\Traversable $iterator, callable $callback)
	{
		parent::__construct($iterator);
		$this->callback = $callback;
	}


<<<<<<< HEAD
	#[\ReturnTypeWillChange]
	public function current()
=======
	public function current(): mixed
>>>>>>> main
	{
		return ($this->callback)(parent::current(), parent::key());
	}
}
