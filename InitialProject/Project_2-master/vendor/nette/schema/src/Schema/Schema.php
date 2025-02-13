<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Schema;


interface Schema
{
	/**
	 * Normalization.
	 * @return mixed
	 */
<<<<<<< HEAD
	function normalize($value, Context $context);
=======
	function normalize(mixed $value, Context $context);
>>>>>>> main

	/**
	 * Merging.
	 * @return mixed
	 */
<<<<<<< HEAD
	function merge($value, $base);
=======
	function merge(mixed $value, mixed $base);
>>>>>>> main

	/**
	 * Validation and finalization.
	 * @return mixed
	 */
<<<<<<< HEAD
	function complete($value, Context $context);
=======
	function complete(mixed $value, Context $context);
>>>>>>> main

	/**
	 * @return mixed
	 */
	function completeDefault(Context $context);
}
