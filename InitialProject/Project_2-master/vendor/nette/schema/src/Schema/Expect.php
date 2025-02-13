<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Schema;

use Nette;
use Nette\Schema\Elements\AnyOf;
use Nette\Schema\Elements\Structure;
use Nette\Schema\Elements\Type;


/**
 * Schema generator.
 *
 * @method static Type scalar($default = null)
 * @method static Type string($default = null)
 * @method static Type int($default = null)
 * @method static Type float($default = null)
 * @method static Type bool($default = null)
 * @method static Type null()
<<<<<<< HEAD
 * @method static Type array($default = [])
=======
>>>>>>> main
 * @method static Type list($default = [])
 * @method static Type mixed($default = null)
 * @method static Type email($default = null)
 * @method static Type unicode($default = null)
 */
final class Expect
{
<<<<<<< HEAD
	use Nette\SmartObject;

=======
>>>>>>> main
	public static function __callStatic(string $name, array $args): Type
	{
		$type = new Type($name);
		if ($args) {
			$type->default($args[0]);
		}
<<<<<<< HEAD
=======

>>>>>>> main
		return $type;
	}


	public static function type(string $type): Type
	{
		return new Type($type);
	}


<<<<<<< HEAD
	/**
	 * @param  mixed|Schema  ...$set
	 */
	public static function anyOf(...$set): AnyOf
=======
	public static function anyOf(mixed ...$set): AnyOf
>>>>>>> main
	{
		return new AnyOf(...$set);
	}


	/**
<<<<<<< HEAD
	 * @param  Schema[]  $items
	 */
	public static function structure(array $items): Structure
	{
		return new Structure($items);
	}


	/**
	 * @param  object  $object
	 */
	public static function from($object, array $items = []): Structure
	{
		$ro = new \ReflectionObject($object);
		foreach ($ro->getProperties() as $prop) {
			$type = Helpers::getPropertyType($prop) ?? 'mixed';
			$item = &$items[$prop->getName()];
			if (!$item) {
				$item = new Type($type);
				if (PHP_VERSION_ID >= 70400 && !$prop->isInitialized($object)) {
					$item->required();
				} else {
					$def = $prop->getValue($object);
=======
	 * @param  Schema[]  $shape
	 */
	public static function structure(array $shape): Structure
	{
		return new Structure($shape);
	}


	public static function from(object $object, array $items = []): Structure
	{
		$ro = new \ReflectionObject($object);
		$props = $ro->hasMethod('__construct')
			? $ro->getMethod('__construct')->getParameters()
			: $ro->getProperties();

		foreach ($props as $prop) {
			$item = &$items[$prop->getName()];
			if (!$item) {
				$type = Helpers::getPropertyType($prop) ?? 'mixed';
				$item = new Type($type);
				if ($prop instanceof \ReflectionProperty ? $prop->isInitialized($object) : $prop->isOptional()) {
					$def = ($prop instanceof \ReflectionProperty ? $prop->getValue($object) : $prop->getDefaultValue());
>>>>>>> main
					if (is_object($def)) {
						$item = static::from($def);
					} elseif ($def === null && !Nette\Utils\Validators::is(null, $type)) {
						$item->required();
					} else {
						$item->default($def);
					}
<<<<<<< HEAD
				}
			}
		}
=======
				} else {
					$item->required();
				}
			}
		}

>>>>>>> main
		return (new Structure($items))->castTo($ro->getName());
	}


	/**
<<<<<<< HEAD
	 * @param  string|Schema  $valueType
	 * @param  string|Schema|null  $keyType
	 */
	public static function arrayOf($valueType, $keyType = null): Type
=======
	 * @param  mixed[]  $shape
	 */
	public static function array(?array $shape = []): Structure|Type
	{
		return Nette\Utils\Arrays::first($shape ?? []) instanceof Schema
			? (new Structure($shape))->castTo('array')
			: (new Type('array'))->default($shape);
	}


	public static function arrayOf(string|Schema $valueType, string|Schema|null $keyType = null): Type
>>>>>>> main
	{
		return (new Type('array'))->items($valueType, $keyType);
	}


<<<<<<< HEAD
	/**
	 * @param  string|Schema  $type
	 */
	public static function listOf($type): Type
=======
	public static function listOf(string|Schema $type): Type
>>>>>>> main
	{
		return (new Type('list'))->items($type);
	}
}
