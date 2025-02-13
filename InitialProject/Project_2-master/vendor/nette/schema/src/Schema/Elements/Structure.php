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


final class Structure implements Schema
{
	use Base;
<<<<<<< HEAD
	use Nette\SmartObject;

	/** @var Schema[] */
	private $items;

	/** @var Schema|null  for array|list */
	private $otherItems;

	/** @var array{?int, ?int} */
	private $range = [null, null];

	/** @var bool */
	private $skipDefaults = false;


	/**
	 * @param  Schema[]  $items
	 */
	public function __construct(array $items)
	{
		(function (Schema ...$items) {})(...array_values($items));
		$this->items = $items;
		$this->castTo = 'object';
=======

	/** @var Schema[] */
	private array $items;

	/** for array|list */
	private ?Schema $otherItems = null;

	/** @var array{?int, ?int} */
	private array $range = [null, null];
	private bool $skipDefaults = false;


	/**
	 * @param  Schema[]  $shape
	 */
	public function __construct(array $shape)
	{
		(function (Schema ...$items) {})(...array_values($shape));
		$this->items = $shape;
		$this->castTo('object');
>>>>>>> main
		$this->required = true;
	}


<<<<<<< HEAD
	public function default($value): self
=======
	public function default(mixed $value): self
>>>>>>> main
	{
		throw new Nette\InvalidStateException('Structure cannot have default value.');
	}


	public function min(?int $min): self
	{
		$this->range[0] = $min;
		return $this;
	}


	public function max(?int $max): self
	{
		$this->range[1] = $max;
		return $this;
	}


<<<<<<< HEAD
	/**
	 * @param  string|Schema  $type
	 */
	public function otherItems($type = 'mixed'): self
=======
	public function otherItems(string|Schema $type = 'mixed'): self
>>>>>>> main
	{
		$this->otherItems = $type instanceof Schema ? $type : new Type($type);
		return $this;
	}


	public function skipDefaults(bool $state = true): self
	{
		$this->skipDefaults = $state;
		return $this;
	}


<<<<<<< HEAD
	/********************* processing ****************d*g**/


	public function normalize($value, Context $context)
	{
		if ($prevent = (is_array($value) && isset($value[Helpers::PREVENT_MERGING]))) {
			unset($value[Helpers::PREVENT_MERGING]);
=======
	public function extend(array|self $shape): self
	{
		$shape = $shape instanceof self ? $shape->items : $shape;
		return new self(array_merge($this->items, $shape));
	}


	public function getShape(): array
	{
		return $this->items;
	}


	/********************* processing ****************d*g**/


	public function normalize(mixed $value, Context $context): mixed
	{
		if ($prevent = (is_array($value) && isset($value[Helpers::PreventMerging]))) {
			unset($value[Helpers::PreventMerging]);
>>>>>>> main
		}

		$value = $this->doNormalize($value, $context);
		if (is_object($value)) {
			$value = (array) $value;
		}

		if (is_array($value)) {
			foreach ($value as $key => $val) {
				$itemSchema = $this->items[$key] ?? $this->otherItems;
				if ($itemSchema) {
					$context->path[] = $key;
					$value[$key] = $itemSchema->normalize($val, $context);
					array_pop($context->path);
				}
			}
<<<<<<< HEAD
			if ($prevent) {
				$value[Helpers::PREVENT_MERGING] = true;
			}
		}
=======

			if ($prevent) {
				$value[Helpers::PreventMerging] = true;
			}
		}

>>>>>>> main
		return $value;
	}


<<<<<<< HEAD
	public function merge($value, $base)
	{
		if (is_array($value) && isset($value[Helpers::PREVENT_MERGING])) {
			unset($value[Helpers::PREVENT_MERGING]);
=======
	public function merge(mixed $value, mixed $base): mixed
	{
		if (is_array($value) && isset($value[Helpers::PreventMerging])) {
			unset($value[Helpers::PreventMerging]);
>>>>>>> main
			$base = null;
		}

		if (is_array($value) && is_array($base)) {
<<<<<<< HEAD
			$index = 0;
=======
			$index = $this->otherItems === null ? null : 0;
>>>>>>> main
			foreach ($value as $key => $val) {
				if ($key === $index) {
					$base[] = $val;
					$index++;
<<<<<<< HEAD
				} elseif (array_key_exists($key, $base)) {
					$itemSchema = $this->items[$key] ?? $this->otherItems;
					$base[$key] = $itemSchema
						? $itemSchema->merge($val, $base[$key])
						: Helpers::merge($val, $base[$key]);
				} else {
					$base[$key] = $val;
				}
			}
			return $base;
		}

		return Helpers::merge($value, $base);
	}


	public function complete($value, Context $context)
=======
				} else {
					$base[$key] = array_key_exists($key, $base) && ($itemSchema = $this->items[$key] ?? $this->otherItems)
						? $itemSchema->merge($val, $base[$key])
						: $val;
				}
			}

			return $base;
		}

		return $value ?? $base;
	}


	public function complete(mixed $value, Context $context): mixed
>>>>>>> main
	{
		if ($value === null) {
			$value = []; // is unable to distinguish null from array in NEON
		}

		$this->doDeprecation($context);

<<<<<<< HEAD
		if (!$this->doValidate($value, 'array', $context)
			|| !$this->doValidateRange($value, $this->range, $context)
		) {
			return;
		}

		$errCount = count($context->errors);
=======
		$isOk = $context->createChecker();
		Helpers::validateType($value, 'array', $context);
		$isOk() && Helpers::validateRange($value, $this->range, $context);
		$isOk() && $this->validateItems($value, $context);
		$isOk() && $value = $this->doTransform($value, $context);
		return $isOk() ? $value : null;
	}


	private function validateItems(array &$value, Context $context): void
	{
>>>>>>> main
		$items = $this->items;
		if ($extraKeys = array_keys(array_diff_key($value, $items))) {
			if ($this->otherItems) {
				$items += array_fill_keys($extraKeys, $this->otherItems);
			} else {
				$keys = array_map('strval', array_keys($items));
				foreach ($extraKeys as $key) {
<<<<<<< HEAD
					$hint = Nette\Utils\ObjectHelpers::getSuggestion($keys, (string) $key);
					$context->addError(
						'Unexpected item %path%' . ($hint ? ", did you mean '%hint%'?" : '.'),
						Nette\Schema\Message::UNEXPECTED_ITEM,
						['hint' => $hint]
=======
					$hint = Nette\Utils\Helpers::getSuggestion($keys, (string) $key);
					$context->addError(
						'Unexpected item %path%' . ($hint ? ", did you mean '%hint%'?" : '.'),
						Nette\Schema\Message::UnexpectedItem,
						['hint' => $hint],
>>>>>>> main
					)->path[] = $key;
				}
			}
		}

		foreach ($items as $itemKey => $itemVal) {
			$context->path[] = $itemKey;
			if (array_key_exists($itemKey, $value)) {
				$value[$itemKey] = $itemVal->complete($value[$itemKey], $context);
			} else {
				$default = $itemVal->completeDefault($context); // checks required item
				if (!$context->skipDefaults && !$this->skipDefaults) {
					$value[$itemKey] = $default;
				}
			}
<<<<<<< HEAD
			array_pop($context->path);
		}

		if (count($context->errors) > $errCount) {
			return;
		}

		return $this->doFinalize($value, $context);
	}


	public function completeDefault(Context $context)
=======

			array_pop($context->path);
		}
	}


	public function completeDefault(Context $context): mixed
>>>>>>> main
	{
		return $this->required
			? $this->complete([], $context)
			: null;
	}
}
