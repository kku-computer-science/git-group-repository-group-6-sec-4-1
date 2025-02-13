<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

<<<<<<< HEAD
=======
use JetBrains\PhpStorm\Language;
>>>>>>> main
use Nette;
use function is_array, is_int, is_object, count;


/**
 * Array tools library.
 */
class Arrays
{
	use Nette\StaticClass;

	/**
	 * Returns item from array. If it does not exist, it throws an exception, unless a default value is set.
	 * @template T
	 * @param  array<T>  $array
	 * @param  array-key|array-key[]  $key
	 * @param  ?T  $default
	 * @return ?T
	 * @throws Nette\InvalidArgumentException if item does not exist and default value is not provided
	 */
<<<<<<< HEAD
	public static function get(array $array, $key, $default = null)
=======
	public static function get(array $array, string|int|array $key, mixed $default = null): mixed
>>>>>>> main
	{
		foreach (is_array($key) ? $key : [$key] as $k) {
			if (is_array($array) && array_key_exists($k, $array)) {
				$array = $array[$k];
			} else {
				if (func_num_args() < 3) {
					throw new Nette\InvalidArgumentException("Missing item '$k'.");
				}

				return $default;
			}
		}

		return $array;
	}


	/**
	 * Returns reference to array item. If the index does not exist, new one is created with value null.
	 * @template T
	 * @param  array<T>  $array
	 * @param  array-key|array-key[]  $key
	 * @return ?T
	 * @throws Nette\InvalidArgumentException if traversed item is not an array
	 */
<<<<<<< HEAD
	public static function &getRef(array &$array, $key)
=======
	public static function &getRef(array &$array, string|int|array $key): mixed
>>>>>>> main
	{
		foreach (is_array($key) ? $key : [$key] as $k) {
			if (is_array($array) || $array === null) {
				$array = &$array[$k];
			} else {
				throw new Nette\InvalidArgumentException('Traversed item is not an array.');
			}
		}

		return $array;
	}


	/**
	 * Recursively merges two fields. It is useful, for example, for merging tree structures. It behaves as
	 * the + operator for array, ie. it adds a key/value pair from the second array to the first one and retains
	 * the value from the first array in the case of a key collision.
	 * @template T1
	 * @template T2
	 * @param  array<T1>  $array1
	 * @param  array<T2>  $array2
	 * @return array<T1|T2>
	 */
	public static function mergeTree(array $array1, array $array2): array
	{
		$res = $array1 + $array2;
		foreach (array_intersect_key($array1, $array2) as $k => $v) {
			if (is_array($v) && is_array($array2[$k])) {
				$res[$k] = self::mergeTree($v, $array2[$k]);
			}
		}

		return $res;
	}


	/**
	 * Returns zero-indexed position of given array key. Returns null if key is not found.
<<<<<<< HEAD
	 * @param  array-key  $key
	 * @return int|null offset if it is found, null otherwise
	 */
	public static function getKeyOffset(array $array, $key): ?int
	{
		return Helpers::falseToNull(array_search(self::toKey($key), array_keys($array), true));
=======
	 */
	public static function getKeyOffset(array $array, string|int $key): ?int
	{
		return Helpers::falseToNull(array_search(self::toKey($key), array_keys($array), strict: true));
>>>>>>> main
	}


	/**
	 * @deprecated  use  getKeyOffset()
	 */
	public static function searchKey(array $array, $key): ?int
	{
		return self::getKeyOffset($array, $key);
	}


	/**
	 * Tests an array for the presence of value.
<<<<<<< HEAD
	 * @param  mixed  $value
	 */
	public static function contains(array $array, $value): bool
=======
	 */
	public static function contains(array $array, mixed $value): bool
>>>>>>> main
	{
		return in_array($value, $array, true);
	}


	/**
<<<<<<< HEAD
	 * Returns the first item from the array or null if array is empty.
	 * @template T
	 * @param  array<T>  $array
	 * @return ?T
	 */
	public static function first(array $array)
	{
		return count($array) ? reset($array) : null;
=======
	 * Returns the first item (matching the specified predicate if given). If there is no such item, it returns result of invoking $else or null.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  ?callable(V, K, array<K, V>): bool  $predicate
	 * @return ?V
	 */
	public static function first(array $array, ?callable $predicate = null, ?callable $else = null): mixed
	{
		$key = self::firstKey($array, $predicate);
		return $key === null
			? ($else ? $else() : null)
			: $array[$key];
>>>>>>> main
	}


	/**
<<<<<<< HEAD
	 * Returns the last item from the array or null if array is empty.
	 * @template T
	 * @param  array<T>  $array
	 * @return ?T
	 */
	public static function last(array $array)
	{
		return count($array) ? end($array) : null;
=======
	 * Returns the last item (matching the specified predicate if given). If there is no such item, it returns result of invoking $else or null.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  ?callable(V, K, array<K, V>): bool  $predicate
	 * @return ?V
	 */
	public static function last(array $array, ?callable $predicate = null, ?callable $else = null): mixed
	{
		$key = self::lastKey($array, $predicate);
		return $key === null
			? ($else ? $else() : null)
			: $array[$key];
	}


	/**
	 * Returns the key of first item (matching the specified predicate if given) or null if there is no such item.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  ?callable(V, K, array<K, V>): bool  $predicate
	 * @return ?K
	 */
	public static function firstKey(array $array, ?callable $predicate = null): int|string|null
	{
		if (!$predicate) {
			return array_key_first($array);
		}
		foreach ($array as $k => $v) {
			if ($predicate($v, $k, $array)) {
				return $k;
			}
		}
		return null;
	}


	/**
	 * Returns the key of last item (matching the specified predicate if given) or null if there is no such item.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  ?callable(V, K, array<K, V>): bool  $predicate
	 * @return ?K
	 */
	public static function lastKey(array $array, ?callable $predicate = null): int|string|null
	{
		return $predicate
			? self::firstKey(array_reverse($array, preserve_keys: true), $predicate)
			: array_key_last($array);
>>>>>>> main
	}


	/**
	 * Inserts the contents of the $inserted array into the $array immediately after the $key.
	 * If $key is null (or does not exist), it is inserted at the beginning.
<<<<<<< HEAD
	 * @param  array-key|null  $key
	 */
	public static function insertBefore(array &$array, $key, array $inserted): void
	{
		$offset = $key === null ? 0 : (int) self::getKeyOffset($array, $key);
		$array = array_slice($array, 0, $offset, true)
			+ $inserted
			+ array_slice($array, $offset, count($array), true);
=======
	 */
	public static function insertBefore(array &$array, string|int|null $key, array $inserted): void
	{
		$offset = $key === null ? 0 : (int) self::getKeyOffset($array, $key);
		$array = array_slice($array, 0, $offset, preserve_keys: true)
			+ $inserted
			+ array_slice($array, $offset, count($array), preserve_keys: true);
>>>>>>> main
	}


	/**
	 * Inserts the contents of the $inserted array into the $array before the $key.
	 * If $key is null (or does not exist), it is inserted at the end.
<<<<<<< HEAD
	 * @param  array-key|null  $key
	 */
	public static function insertAfter(array &$array, $key, array $inserted): void
=======
	 */
	public static function insertAfter(array &$array, string|int|null $key, array $inserted): void
>>>>>>> main
	{
		if ($key === null || ($offset = self::getKeyOffset($array, $key)) === null) {
			$offset = count($array) - 1;
		}

<<<<<<< HEAD
		$array = array_slice($array, 0, $offset + 1, true)
			+ $inserted
			+ array_slice($array, $offset + 1, count($array), true);
=======
		$array = array_slice($array, 0, $offset + 1, preserve_keys: true)
			+ $inserted
			+ array_slice($array, $offset + 1, count($array), preserve_keys: true);
>>>>>>> main
	}


	/**
	 * Renames key in array.
<<<<<<< HEAD
	 * @param  array-key  $oldKey
	 * @param  array-key  $newKey
	 */
	public static function renameKey(array &$array, $oldKey, $newKey): bool
=======
	 */
	public static function renameKey(array &$array, string|int $oldKey, string|int $newKey): bool
>>>>>>> main
	{
		$offset = self::getKeyOffset($array, $oldKey);
		if ($offset === null) {
			return false;
		}

		$val = &$array[$oldKey];
		$keys = array_keys($array);
		$keys[$offset] = $newKey;
		$array = array_combine($keys, $array);
		$array[$newKey] = &$val;
		return true;
	}


	/**
	 * Returns only those array items, which matches a regular expression $pattern.
	 * @param  string[]  $array
	 * @return string[]
	 */
<<<<<<< HEAD
	public static function grep(array $array, string $pattern, int $flags = 0): array
	{
=======
	public static function grep(
		array $array,
		#[Language('RegExp')]
		string $pattern,
		bool|int $invert = false,
	): array
	{
		$flags = $invert ? PREG_GREP_INVERT : 0;
>>>>>>> main
		return Strings::pcre('preg_grep', [$pattern, $array, $flags]);
	}


	/**
	 * Transforms multidimensional array to flat array.
	 */
	public static function flatten(array $array, bool $preserveKeys = false): array
	{
		$res = [];
		$cb = $preserveKeys
			? function ($v, $k) use (&$res): void { $res[$k] = $v; }
<<<<<<< HEAD
		: function ($v) use (&$res): void { $res[] = $v; };
=======
			: function ($v) use (&$res): void { $res[] = $v; };
>>>>>>> main
		array_walk_recursive($array, $cb);
		return $res;
	}


	/**
	 * Checks if the array is indexed in ascending order of numeric keys from zero, a.k.a list.
<<<<<<< HEAD
	 * @param  mixed  $value
	 */
	public static function isList($value): bool
=======
	 * @return ($value is list ? true : false)
	 */
	public static function isList(mixed $value): bool
>>>>>>> main
	{
		return is_array($value) && (PHP_VERSION_ID < 80100
			? !$value || array_keys($value) === range(0, count($value) - 1)
			: array_is_list($value)
		);
	}


	/**
	 * Reformats table to associative tree. Path looks like 'field|field[]field->field=field'.
	 * @param  string|string[]  $path
<<<<<<< HEAD
	 * @return array|\stdClass
	 */
	public static function associate(array $array, $path)
=======
	 */
	public static function associate(array $array, $path): array|\stdClass
>>>>>>> main
	{
		$parts = is_array($path)
			? $path
			: preg_split('#(\[\]|->|=|\|)#', $path, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

		if (!$parts || $parts === ['->'] || $parts[0] === '=' || $parts[0] === '|') {
			throw new Nette\InvalidArgumentException("Invalid path '$path'.");
		}

		$res = $parts[0] === '->' ? new \stdClass : [];

		foreach ($array as $rowOrig) {
			$row = (array) $rowOrig;
			$x = &$res;

			for ($i = 0; $i < count($parts); $i++) {
				$part = $parts[$i];
				if ($part === '[]') {
					$x = &$x[];

				} elseif ($part === '=') {
					if (isset($parts[++$i])) {
						$x = $row[$parts[$i]];
						$row = null;
					}
				} elseif ($part === '->') {
					if (isset($parts[++$i])) {
						if ($x === null) {
							$x = new \stdClass;
						}

						$x = &$x->{$row[$parts[$i]]};
					} else {
						$row = is_object($rowOrig) ? $rowOrig : (object) $row;
					}
				} elseif ($part !== '|') {
					$x = &$x[(string) $row[$part]];
				}
			}

			if ($x === null) {
				$x = $row;
			}
		}

		return $res;
	}


	/**
	 * Normalizes array to associative array. Replace numeric keys with their values, the new value will be $filling.
<<<<<<< HEAD
	 * @param  mixed  $filling
	 */
	public static function normalize(array $array, $filling = null): array
=======
	 */
	public static function normalize(array $array, mixed $filling = null): array
>>>>>>> main
	{
		$res = [];
		foreach ($array as $k => $v) {
			$res[is_int($k) ? $v : $k] = is_int($k) ? $filling : $v;
		}

		return $res;
	}


	/**
	 * Returns and removes the value of an item from an array. If it does not exist, it throws an exception,
	 * or returns $default, if provided.
	 * @template T
	 * @param  array<T>  $array
<<<<<<< HEAD
	 * @param  array-key  $key
=======
>>>>>>> main
	 * @param  ?T  $default
	 * @return ?T
	 * @throws Nette\InvalidArgumentException if item does not exist and default value is not provided
	 */
<<<<<<< HEAD
	public static function pick(array &$array, $key, $default = null)
=======
	public static function pick(array &$array, string|int $key, mixed $default = null): mixed
>>>>>>> main
	{
		if (array_key_exists($key, $array)) {
			$value = $array[$key];
			unset($array[$key]);
			return $value;

		} elseif (func_num_args() < 3) {
			throw new Nette\InvalidArgumentException("Missing item '$key'.");

		} else {
			return $default;
		}
	}


	/**
<<<<<<< HEAD
	 * Tests whether at least one element in the array passes the test implemented by the
	 * provided callback with signature `function ($value, $key, array $array): bool`.
	 */
	public static function some(iterable $array, callable $callback): bool
	{
		foreach ($array as $k => $v) {
			if ($callback($v, $k, $array)) {
=======
	 * Tests whether at least one element in the array passes the test implemented by the provided function.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  callable(V, K, array<K, V>): bool  $predicate
	 */
	public static function some(iterable $array, callable $predicate): bool
	{
		foreach ($array as $k => $v) {
			if ($predicate($v, $k, $array)) {
>>>>>>> main
				return true;
			}
		}

		return false;
	}


	/**
<<<<<<< HEAD
	 * Tests whether all elements in the array pass the test implemented by the provided function,
	 * which has the signature `function ($value, $key, array $array): bool`.
	 */
	public static function every(iterable $array, callable $callback): bool
	{
		foreach ($array as $k => $v) {
			if (!$callback($v, $k, $array)) {
=======
	 * Tests whether all elements in the array pass the test implemented by the provided function.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  callable(V, K, array<K, V>): bool  $predicate
	 */
	public static function every(iterable $array, callable $predicate): bool
	{
		foreach ($array as $k => $v) {
			if (!$predicate($v, $k, $array)) {
>>>>>>> main
				return false;
			}
		}

		return true;
	}


	/**
<<<<<<< HEAD
	 * Calls $callback on all elements in the array and returns the array of return values.
	 * The callback has the signature `function ($value, $key, array $array): bool`.
	 */
	public static function map(iterable $array, callable $callback): array
	{
		$res = [];
		foreach ($array as $k => $v) {
			$res[$k] = $callback($v, $k, $array);
=======
	 * Returns a new array containing all key-value pairs matching the given $predicate.
	 * @template K of int|string
	 * @template V
	 * @param  array<K, V>  $array
	 * @param  callable(V, K, array<K, V>): bool  $predicate
	 * @return array<K, V>
	 */
	public static function filter(array $array, callable $predicate): array
	{
		$res = [];
		foreach ($array as $k => $v) {
			if ($predicate($v, $k, $array)) {
				$res[$k] = $v;
			}
		}
		return $res;
	}


	/**
	 * Returns an array containing the original keys and results of applying the given transform function to each element.
	 * @template K of int|string
	 * @template V
	 * @template R
	 * @param  array<K, V>  $array
	 * @param  callable(V, K, array<K, V>): R  $transformer
	 * @return array<K, R>
	 */
	public static function map(iterable $array, callable $transformer): array
	{
		$res = [];
		foreach ($array as $k => $v) {
			$res[$k] = $transformer($v, $k, $array);
		}

		return $res;
	}


	/**
	 * Returns an array containing new keys and values generated by applying the given transform function to each element.
	 * If the function returns null, the element is skipped.
	 * @template K of int|string
	 * @template V
	 * @template ResK of int|string
	 * @template ResV
	 * @param  array<K, V>  $array
	 * @param  callable(V, K, array<K, V>): ?array{ResK, ResV}  $transformer
	 * @return array<ResK, ResV>
	 */
	public static function mapWithKeys(array $array, callable $transformer): array
	{
		$res = [];
		foreach ($array as $k => $v) {
			$pair = $transformer($v, $k, $array);
			if ($pair) {
				$res[$pair[0]] = $pair[1];
			}
>>>>>>> main
		}

		return $res;
	}


	/**
	 * Invokes all callbacks and returns array of results.
	 * @param  callable[]  $callbacks
	 */
	public static function invoke(iterable $callbacks, ...$args): array
	{
		$res = [];
		foreach ($callbacks as $k => $cb) {
			$res[$k] = $cb(...$args);
		}

		return $res;
	}


	/**
	 * Invokes method on every object in an array and returns array of results.
	 * @param  object[]  $objects
	 */
	public static function invokeMethod(iterable $objects, string $method, ...$args): array
	{
		$res = [];
		foreach ($objects as $k => $obj) {
			$res[$k] = $obj->$method(...$args);
		}

		return $res;
	}


	/**
	 * Copies the elements of the $array array to the $object object and then returns it.
	 * @template T of object
	 * @param  T  $object
	 * @return T
	 */
<<<<<<< HEAD
	public static function toObject(iterable $array, $object)
=======
	public static function toObject(iterable $array, object $object): object
>>>>>>> main
	{
		foreach ($array as $k => $v) {
			$object->$k = $v;
		}

		return $object;
	}


	/**
	 * Converts value to array key.
<<<<<<< HEAD
	 * @param  mixed  $value
	 * @return array-key
	 */
	public static function toKey($value)
=======
	 */
	public static function toKey(mixed $value): int|string
>>>>>>> main
	{
		return key([$value => null]);
	}


	/**
	 * Returns copy of the $array where every item is converted to string
	 * and prefixed by $prefix and suffixed by $suffix.
	 * @param  string[]  $array
	 * @return string[]
	 */
	public static function wrap(array $array, string $prefix = '', string $suffix = ''): array
	{
		$res = [];
		foreach ($array as $k => $v) {
			$res[$k] = $prefix . $v . $suffix;
		}

		return $res;
	}
}
