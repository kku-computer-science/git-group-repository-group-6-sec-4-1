<?php
<<<<<<< HEAD
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
=======

/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
>>>>>>> main
 */

namespace Mockery;

<<<<<<< HEAD
interface LegacyMockInterface
{
    /**
     * Alternative setup method to constructor
     *
     * @param \Mockery\Container $container
     * @param object $partialObject
     * @return void
     */
    public function mockery_init(\Mockery\Container $container = null, $partialObject = null);

    /**
     * Set expected method calls
     *
     * @param string|array ...$methodNames one or many methods that are expected to be called in this mock
     *
     * @return \Mockery\ExpectationInterface|\Mockery\Expectation|\Mockery\HigherOrderMessage
     */
    public function shouldReceive(...$methodNames);

    /**
     * Shortcut method for setting an expectation that a method should not be called.
     *
     * @param string|array ...$methodNames one or many methods that are expected not to be called in this mock
     * @return \Mockery\ExpectationInterface|\Mockery\Expectation|\Mockery\HigherOrderMessage
     */
    public function shouldNotReceive(...$methodNames);

    /**
     * Allows additional methods to be mocked that do not explicitly exist on mocked class
     * @param String $method name of the method to be mocked
     */
    public function shouldAllowMockingMethod($method);

    /**
     * Set mock to ignore unexpected methods and return Undefined class
     * @param mixed $returnValue the default return value for calls to missing functions on this mock
     * @return Mock
     */
    public function shouldIgnoreMissing($returnValue = null);

    /**
     * @return Mock
     */
    public function shouldAllowMockingProtectedMethods();

    /**
     * Set mock to defer unexpected methods to its parent if possible
     *
     * @deprecated since 1.4.0. Please use makePartial() instead.
     *
     * @return Mock
     */
    public function shouldDeferMissing();

    /**
     * Set mock to defer unexpected methods to its parent if possible
     *
     * @return Mock
     */
    public function makePartial();

    /**
     * @param null|string $method
     * @param null|array|Closure $args
     * @return mixed
     */
    public function shouldHaveReceived($method, $args = null);

    /**
     * @return mixed
     */
    public function shouldHaveBeenCalled();

    /**
     * @param null|string $method
     * @param null|array|Closure $args
     * @return mixed
     */
    public function shouldNotHaveReceived($method, $args = null);

    /**
     * @param array $args (optional)
     * @return mixed
     */
    public function shouldNotHaveBeenCalled(array $args = null);

    /**
=======
use Closure;
use Throwable;

interface LegacyMockInterface
{
    /**
>>>>>>> main
     * In the event shouldReceive() accepting an array of methods/returns
     * this method will switch them from normal expectations to default
     * expectations
     *
     * @return self
     */
    public function byDefault();

    /**
<<<<<<< HEAD
     * Iterate across all expectation directors and validate each
     *
     * @throws \Mockery\CountValidator\Exception
     * @return void
     */
    public function mockery_verify();

    /**
     * Tear down tasks for this mock
     *
     * @return void
     */
    public function mockery_teardown();
=======
     * Set mock to defer unexpected methods to its parent if possible
     *
     * @return self
     */
    public function makePartial();
>>>>>>> main

    /**
     * Fetch the next available allocation order number
     *
     * @return int
     */
    public function mockery_allocateOrder();

    /**
<<<<<<< HEAD
     * Set ordering for a group
     *
     * @param mixed $group
     * @param int $order
     */
    public function mockery_setGroup($group, $order);

    /**
     * Fetch array of ordered groups
     *
     * @return array
     */
    public function mockery_getGroups();

    /**
     * Set current ordered number
     *
     * @param int $order
     */
    public function mockery_setCurrentOrder($order);
=======
     * Find an expectation matching the given method and arguments
     *
     * @template TMixed
     *
     * @param string        $method
     * @param array<TMixed> $args
     *
     * @return null|Expectation
     */
    public function mockery_findExpectation($method, array $args);

    /**
     * Return the container for this mock
     *
     * @return Container
     */
    public function mockery_getContainer();
>>>>>>> main

    /**
     * Get current ordered number
     *
     * @return int
     */
    public function mockery_getCurrentOrder();

    /**
<<<<<<< HEAD
     * Validate the current mock's ordering
     *
     * @param string $method
     * @param int $order
     * @throws \Mockery\Exception
     * @return void
     */
    public function mockery_validateOrder($method, $order);

    /**
=======
>>>>>>> main
     * Gets the count of expectations for this mock
     *
     * @return int
     */
    public function mockery_getExpectationCount();

    /**
     * Return the expectations director for the given method
     *
<<<<<<< HEAD
     * @var string $method
     * @return \Mockery\ExpectationDirector|null
     */
    public function mockery_setExpectationsFor($method, \Mockery\ExpectationDirector $director);

    /**
     * Return the expectations director for the given method
     *
     * @var string $method
     * @return \Mockery\ExpectationDirector|null
=======
     * @param string $method
     *
     * @return null|ExpectationDirector
>>>>>>> main
     */
    public function mockery_getExpectationsFor($method);

    /**
<<<<<<< HEAD
     * Find an expectation matching the given method and arguments
     *
     * @var string $method
     * @var array $args
     * @return \Mockery\Expectation|null
     */
    public function mockery_findExpectation($method, array $args);

    /**
     * Return the container for this mock
     *
     * @return \Mockery\Container
     */
    public function mockery_getContainer();
=======
     * Fetch array of ordered groups
     *
     * @return array<string,int>
     */
    public function mockery_getGroups();

    /**
     * @return string[]
     */
    public function mockery_getMockableMethods();

    /**
     * @return array
     */
    public function mockery_getMockableProperties();
>>>>>>> main

    /**
     * Return the name for this mock
     *
     * @return string
     */
    public function mockery_getName();

    /**
<<<<<<< HEAD
     * @return array
     */
    public function mockery_getMockableProperties();

    /**
     * @return string[]
     */
    public function mockery_getMockableMethods();
=======
     * Alternative setup method to constructor
     *
     * @param object $partialObject
     *
     * @return void
     */
    public function mockery_init(?Container $container = null, $partialObject = null);
>>>>>>> main

    /**
     * @return bool
     */
    public function mockery_isAnonymous();
<<<<<<< HEAD
=======

    /**
     * Set current ordered number
     *
     * @param int $order
     *
     * @return int
     */
    public function mockery_setCurrentOrder($order);

    /**
     * Return the expectations director for the given method
     *
     * @param string $method
     *
     * @return null|ExpectationDirector
     */
    public function mockery_setExpectationsFor($method, ExpectationDirector $director);

    /**
     * Set ordering for a group
     *
     * @param string $group
     * @param int    $order
     *
     * @return void
     */
    public function mockery_setGroup($group, $order);

    /**
     * Tear down tasks for this mock
     *
     * @return void
     */
    public function mockery_teardown();

    /**
     * Validate the current mock's ordering
     *
     * @param string $method
     * @param int    $order
     *
     * @throws Exception
     *
     * @return void
     */
    public function mockery_validateOrder($method, $order);

    /**
     * Iterate across all expectation directors and validate each
     *
     * @throws Throwable
     *
     * @return void
     */
    public function mockery_verify();

    /**
     * Allows additional methods to be mocked that do not explicitly exist on mocked class
     *
     * @param  string $method the method name to be mocked
     * @return self
     */
    public function shouldAllowMockingMethod($method);

    /**
     * @return self
     */
    public function shouldAllowMockingProtectedMethods();

    /**
     * Set mock to defer unexpected methods to its parent if possible
     *
     * @deprecated since 1.4.0. Please use makePartial() instead.
     *
     * @return self
     */
    public function shouldDeferMissing();

    /**
     * @return self
     */
    public function shouldHaveBeenCalled();

    /**
     * @template TMixed
     * @param string                     $method
     * @param null|array<TMixed>|Closure $args
     *
     * @return self
     */
    public function shouldHaveReceived($method, $args = null);

    /**
     * Set mock to ignore unexpected methods and return Undefined class
     *
     * @template TReturnValue
     *
     * @param null|TReturnValue $returnValue the default return value for calls to missing functions on this mock
     *
     * @return self
     */
    public function shouldIgnoreMissing($returnValue = null);

    /**
     * @template TMixed
     * @param null|array<TMixed> $args (optional)
     *
     * @return self
     */
    public function shouldNotHaveBeenCalled(?array $args = null);

    /**
     * @template TMixed
     * @param string                     $method
     * @param null|array<TMixed>|Closure $args
     *
     * @return self
     */
    public function shouldNotHaveReceived($method, $args = null);

    /**
     * Shortcut method for setting an expectation that a method should not be called.
     *
     * @param string ...$methodNames one or many methods that are expected not to be called in this mock
     *
     * @return Expectation|ExpectationInterface|HigherOrderMessage
     */
    public function shouldNotReceive(...$methodNames);

    /**
     * Set expected method calls
     *
     * @param string ...$methodNames one or many methods that are expected to be called in this mock
     *
     * @return Expectation|ExpectationInterface|HigherOrderMessage
     */
    public function shouldReceive(...$methodNames);
>>>>>>> main
}
