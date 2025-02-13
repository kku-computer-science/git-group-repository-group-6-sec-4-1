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
/**
 * @method \Mockery\Expectation withArgs(\Closure|array $args)
 */
class HigherOrderMessage
{
    private $mock;
    private $method;

=======
use Closure;

/**
 * @method Expectation withArgs(array|Closure $args)
 */
class HigherOrderMessage
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var LegacyMockInterface|MockInterface
     */
    private $mock;

>>>>>>> main
    public function __construct(MockInterface $mock, $method)
    {
        $this->mock = $mock;
        $this->method = $method;
    }

    /**
<<<<<<< HEAD
     * @return \Mockery\Expectation
=======
     * @param string $method
     * @param array  $args
     *
     * @return Expectation|ExpectationInterface|HigherOrderMessage
>>>>>>> main
     */
    public function __call($method, $args)
    {
        if ($this->method === 'shouldNotHaveReceived') {
            return $this->mock->{$this->method}($method, $args);
        }

        $expectation = $this->mock->{$this->method}($method);
<<<<<<< HEAD
=======

>>>>>>> main
        return $expectation->withArgs($args);
    }
}
