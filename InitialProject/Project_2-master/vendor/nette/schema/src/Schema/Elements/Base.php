<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Schema\Elements;

use Nette;
use Nette\Schema\Context;
<<<<<<< HEAD
=======
use Nette\Schema\Helpers;
>>>>>>> main


/**
 * @internal
 */
trait Base
{
<<<<<<< HEAD
	/** @var bool */
	private $required = false;

	/** @var mixed */
	private $default;

	/** @var callable|null */
	private $before;

	/** @var array[] */
	private $asserts = [];

	/** @var string|null */
	private $castTo;

	/** @var string|null */
	private $deprecated;


	public function default($value): self
=======
	private bool $required = false;
	private mixed $default = null;

	/** @var ?callable */
	private $before;

	/** @var callable[] */
	private array $transforms = [];
	private ?string $deprecated = null;


	public function default(mixed $value): self
>>>>>>> main
	{
		$this->default = $value;
		return $this;
	}


	public function required(bool $state = true): self
	{
		$this->required = $state;
		return $this;
	}


	public function before(callable $handler): self
	{
		$this->before = $handler;
		return $this;
	}


	public function castTo(string $type): self
	{
<<<<<<< HEAD
		$this->castTo = $type;
=======
		return $this->transform(Helpers::getCastStrategy($type));
	}


	public function transform(callable $handler): self
	{
		$this->transforms[] = $handler;
>>>>>>> main
		return $this;
	}


<<<<<<< HEAD
	public function assert(callable $handler, string $description = null): self
	{
		$this->asserts[] = [$handler, $description];
		return $this;
=======
	public function assert(callable $handler, ?string $description = null): self
	{
		$expected = $description ?: (is_string($handler) ? "$handler()" : '#' . count($this->transforms));
		return $this->transform(function ($value, Context $context) use ($handler, $description, $expected) {
			if ($handler($value)) {
				return $value;
			}
			$context->addError(
				'Failed assertion ' . ($description ? "'%assertion%'" : '%assertion%') . ' for %label% %path% with value %value%.',
				Nette\Schema\Message::FailedAssertion,
				['value' => $value, 'assertion' => $expected],
			);
		});
>>>>>>> main
	}


	/** Marks as deprecated */
	public function deprecated(string $message = 'The item %path% is deprecated.'): self
	{
		$this->deprecated = $message;
		return $this;
	}


<<<<<<< HEAD
	public function completeDefault(Context $context)
=======
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
=======
				Nette\Schema\Message::MissingItem,
			);
			return null;
		}

>>>>>>> main
		return $this->default;
	}


<<<<<<< HEAD
	public function doNormalize($value, Context $context)
=======
	public function doNormalize(mixed $value, Context $context): mixed
>>>>>>> main
	{
		if ($this->before) {
			$value = ($this->before)($value);
		}
<<<<<<< HEAD
=======

>>>>>>> main
		return $value;
	}


	private function doDeprecation(Context $context): void
	{
		if ($this->deprecated !== null) {
			$context->addWarning(
				$this->deprecated,
<<<<<<< HEAD
				Nette\Schema\Message::DEPRECATED
=======
				Nette\Schema\Message::Deprecated,
>>>>>>> main
			);
		}
	}


<<<<<<< HEAD
	private function doValidate($value, string $expected, Context $context): bool
	{
		if (!Nette\Utils\Validators::is($value, $expected)) {
			$expected = str_replace(['|', ':'], [' or ', ' in range '], $expected);
			$context->addError(
				'The %label% %path% expects to be %expected%, %value% given.',
				Nette\Schema\Message::TYPE_MISMATCH,
				['value' => $value, 'expected' => $expected]
			);
			return false;
		}
		return true;
	}


	private function doValidateRange($value, array $range, Context $context, string $types = ''): bool
	{
		if (is_array($value) || is_string($value)) {
			[$length, $label] = is_array($value)
				? [count($value), 'items']
				: (in_array('unicode', explode('|', $types), true)
					? [Nette\Utils\Strings::length($value), 'characters']
					: [strlen($value), 'bytes']);

			if (!self::isInRange($length, $range)) {
				$context->addError(
					"The length of %label% %path% expects to be in range %expected%, %length% $label given.",
					Nette\Schema\Message::LENGTH_OUT_OF_RANGE,
					['value' => $value, 'length' => $length, 'expected' => implode('..', $range)]
				);
				return false;
			}

		} elseif ((is_int($value) || is_float($value)) && !self::isInRange($value, $range)) {
			$context->addError(
				'The %label% %path% expects to be in range %expected%, %value% given.',
				Nette\Schema\Message::VALUE_OUT_OF_RANGE,
				['value' => $value, 'expected' => implode('..', $range)]
			);
			return false;
		}
		return true;
	}


	private function isInRange($value, array $range): bool
	{
		return ($range[0] === null || $value >= $range[0])
			&& ($range[1] === null || $value <= $range[1]);
	}


	private function doFinalize($value, Context $context)
	{
		if ($this->castTo) {
			if (Nette\Utils\Reflection::isBuiltinType($this->castTo)) {
				settype($value, $this->castTo);
			} else {
				$object = new $this->castTo;
				foreach ($value as $k => $v) {
					$object->$k = $v;
				}
				$value = $object;
			}
		}

		foreach ($this->asserts as $i => [$handler, $description]) {
			if (!$handler($value)) {
				$expected = $description ?: (is_string($handler) ? "$handler()" : "#$i");
				$context->addError(
					'Failed assertion ' . ($description ? "'%assertion%'" : '%assertion%') . ' for %label% %path% with value %value%.',
					Nette\Schema\Message::FAILED_ASSERTION,
					['value' => $value, 'assertion' => $expected]
				);
				return;
			}
		}

		return $value;
	}
=======
	private function doTransform(mixed $value, Context $context): mixed
	{
		$isOk = $context->createChecker();
		foreach ($this->transforms as $handler) {
			$value = $handler($value, $context);
			if (!$isOk()) {
				return null;
			}
		}
		return $value;
	}


	/** @deprecated use Nette\Schema\Validators::validateType() */
	private function doValidate(mixed $value, string $expected, Context $context): bool
	{
		$isOk = $context->createChecker();
		Helpers::validateType($value, $expected, $context);
		return $isOk();
	}


	/** @deprecated use Nette\Schema\Validators::validateRange() */
	private static function doValidateRange(mixed $value, array $range, Context $context, string $types = ''): bool
	{
		$isOk = $context->createChecker();
		Helpers::validateRange($value, $range, $context, $types);
		return $isOk();
	}


	/** @deprecated use doTransform() */
	private function doFinalize(mixed $value, Context $context): mixed
	{
		return $this->doTransform($value, $context);
	}
>>>>>>> main
}
