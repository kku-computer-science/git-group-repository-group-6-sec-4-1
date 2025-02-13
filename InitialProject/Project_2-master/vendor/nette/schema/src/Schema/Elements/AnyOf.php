<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Schema\Elements;

use Nette;
use Nette\Schema\Context;
use Nette\Schema\Helpers;
use Nette\Schema\Schema;


final class AnyOf implements Schema
{
	use Base;
<<<<<<< HEAD
	use Nette\SmartObject;

	/** @var array */
	private $set;


	/**
	 * @param  mixed|Schema  ...$set
	 */
	public function __construct(...$set)
=======

	private array $set;


	public function __construct(mixed ...$set)
>>>>>>> main
	{
		if (!$set) {
			throw new Nette\InvalidStateException('The enumeration must not be empty.');
		}
<<<<<<< HEAD
=======

>>>>>>> main
		$this->set = $set;
	}


	public function firstIsDefault(): self
	{
		$this->default = $this->set[0];
		return $this;
	}


	public function nullable(): self
	{
		$this->set[] = null;
		return $this;
	}


	public function dynamic(): self
	{
		$this->set[] = new Type(Nette\Schema\DynamicParameter::class);
		return $this;
	}


	/********************* processing ****************d*g**/


<<<<<<< HEAD
	public function normalize($value, Context $context)
=======
	public function normalize(mixed $value, Context $context): mixed
>>>>>>> main
	{
		return $this->doNormalize($value, $context);
	}


<<<<<<< HEAD
	public function merge($value, $base)
	{
		if (is_array($value) && isset($value[Helpers::PREVENT_MERGING])) {
			unset($value[Helpers::PREVENT_MERGING]);
			return $value;
		}
=======
	public function merge(mixed $value, mixed $base): mixed
	{
		if (is_array($value) && isset($value[Helpers::PreventMerging])) {
			unset($value[Helpers::PreventMerging]);
			return $value;
		}

>>>>>>> main
		return Helpers::merge($value, $base);
	}


<<<<<<< HEAD
	public function complete($value, Context $context)
=======
	public function complete(mixed $value, Context $context): mixed
	{
		$isOk = $context->createChecker();
		$value = $this->findAlternative($value, $context);
		$isOk() && $value = $this->doTransform($value, $context);
		return $isOk() ? $value : null;
	}


	private function findAlternative(mixed $value, Context $context): mixed
>>>>>>> main
	{
		$expecteds = $innerErrors = [];
		foreach ($this->set as $item) {
			if ($item instanceof Schema) {
				$dolly = new Context;
				$dolly->path = $context->path;
				$res = $item->complete($item->normalize($value, $dolly), $dolly);
				if (!$dolly->errors) {
					$context->warnings = array_merge($context->warnings, $dolly->warnings);
<<<<<<< HEAD
					return $this->doFinalize($res, $context);
				}
=======
					return $res;
				}

>>>>>>> main
				foreach ($dolly->errors as $error) {
					if ($error->path !== $context->path || empty($error->variables['expected'])) {
						$innerErrors[] = $error;
					} else {
						$expecteds[] = $error->variables['expected'];
					}
				}
			} else {
				if ($item === $value) {
<<<<<<< HEAD
					return $this->doFinalize($value, $context);
				}
=======
					return $value;
				}

>>>>>>> main
				$expecteds[] = Nette\Schema\Helpers::formatValue($item);
			}
		}

		if ($innerErrors) {
			$context->errors = array_merge($context->errors, $innerErrors);
		} else {
			$context->addError(
				'The %label% %path% expects to be %expected%, %value% given.',
<<<<<<< HEAD
				Nette\Schema\Message::TYPE_MISMATCH,
				[
					'value' => $value,
					'expected' => implode('|', array_unique($expecteds)),
				]
			);
		}
	}


	public function completeDefault(Context $context)
=======
				Nette\Schema\Message::TypeMismatch,
				[
					'value' => $value,
					'expected' => implode('|', array_unique($expecteds)),
				],
			);
		}

		return null;
	}


	public function completeDefault(Context $context): mixed
>>>>>>> main
	{
		if ($this->required) {
			$context->addError(
				'The mandatory item %path% is missing.',
<<<<<<< HEAD
				Nette\Schema\Message::MISSING_ITEM
			);
			return null;
		}
		if ($this->default instanceof Schema) {
			return $this->default->completeDefault($context);
		}
=======
				Nette\Schema\Message::MissingItem,
			);
			return null;
		}

		if ($this->default instanceof Schema) {
			return $this->default->completeDefault($context);
		}

>>>>>>> main
		return $this->default;
	}
}
