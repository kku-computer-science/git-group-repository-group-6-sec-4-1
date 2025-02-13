<?php

<<<<<<< HEAD
namespace GuzzleHttp\Promise;

use Exception;
=======
declare(strict_types=1);

namespace GuzzleHttp\Promise;

>>>>>>> main
use Generator;
use Throwable;

/**
 * Creates a promise that is resolved using a generator that yields values or
 * promises (somewhat similar to C#'s async keyword).
 *
 * When called, the Coroutine::of method will start an instance of the generator
 * and returns a promise that is fulfilled with its final yielded value.
 *
 * Control is returned back to the generator when the yielded promise settles.
 * This can lead to less verbose code when doing lots of sequential async calls
 * with minimal processing in between.
 *
 *     use GuzzleHttp\Promise;
 *
 *     function createPromise($value) {
 *         return new Promise\FulfilledPromise($value);
 *     }
 *
 *     $promise = Promise\Coroutine::of(function () {
 *         $value = (yield createPromise('a'));
 *         try {
 *             $value = (yield createPromise($value . 'b'));
<<<<<<< HEAD
 *         } catch (\Exception $e) {
=======
 *         } catch (\Throwable $e) {
>>>>>>> main
 *             // The promise was rejected.
 *         }
 *         yield $value . 'c';
 *     });
 *
 *     // Outputs "abc"
 *     $promise->then(function ($v) { echo $v; });
 *
 * @param callable $generatorFn Generator function to wrap into a promise.
 *
 * @return Promise
 *
<<<<<<< HEAD
 * @link https://github.com/petkaantonov/bluebird/blob/master/API.md#generators inspiration
=======
 * @see https://github.com/petkaantonov/bluebird/blob/master/API.md#generators inspiration
>>>>>>> main
 */
final class Coroutine implements PromiseInterface
{
    /**
     * @var PromiseInterface|null
     */
    private $currentPromise;

    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var Promise
     */
    private $result;

    public function __construct(callable $generatorFn)
    {
        $this->generator = $generatorFn();
<<<<<<< HEAD
        $this->result = new Promise(function () {
=======
        $this->result = new Promise(function (): void {
>>>>>>> main
            while (isset($this->currentPromise)) {
                $this->currentPromise->wait();
            }
        });
        try {
            $this->nextCoroutine($this->generator->current());
<<<<<<< HEAD
        } catch (\Exception $exception) {
            $this->result->reject($exception);
=======
>>>>>>> main
        } catch (Throwable $throwable) {
            $this->result->reject($throwable);
        }
    }

    /**
     * Create a new coroutine.
<<<<<<< HEAD
     *
     * @return self
     */
    public static function of(callable $generatorFn)
=======
     */
    public static function of(callable $generatorFn): self
>>>>>>> main
    {
        return new self($generatorFn);
    }

    public function then(
<<<<<<< HEAD
        callable $onFulfilled = null,
        callable $onRejected = null
    ) {
        return $this->result->then($onFulfilled, $onRejected);
    }

    public function otherwise(callable $onRejected)
=======
        ?callable $onFulfilled = null,
        ?callable $onRejected = null
    ): PromiseInterface {
        return $this->result->then($onFulfilled, $onRejected);
    }

    public function otherwise(callable $onRejected): PromiseInterface
>>>>>>> main
    {
        return $this->result->otherwise($onRejected);
    }

<<<<<<< HEAD
    public function wait($unwrap = true)
=======
    public function wait(bool $unwrap = true)
>>>>>>> main
    {
        return $this->result->wait($unwrap);
    }

<<<<<<< HEAD
    public function getState()
=======
    public function getState(): string
>>>>>>> main
    {
        return $this->result->getState();
    }

<<<<<<< HEAD
    public function resolve($value)
=======
    public function resolve($value): void
>>>>>>> main
    {
        $this->result->resolve($value);
    }

<<<<<<< HEAD
    public function reject($reason)
=======
    public function reject($reason): void
>>>>>>> main
    {
        $this->result->reject($reason);
    }

<<<<<<< HEAD
    public function cancel()
=======
    public function cancel(): void
>>>>>>> main
    {
        $this->currentPromise->cancel();
        $this->result->cancel();
    }

<<<<<<< HEAD
    private function nextCoroutine($yielded)
=======
    private function nextCoroutine($yielded): void
>>>>>>> main
    {
        $this->currentPromise = Create::promiseFor($yielded)
            ->then([$this, '_handleSuccess'], [$this, '_handleFailure']);
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public function _handleSuccess($value)
=======
    public function _handleSuccess($value): void
>>>>>>> main
    {
        unset($this->currentPromise);
        try {
            $next = $this->generator->send($value);
            if ($this->generator->valid()) {
                $this->nextCoroutine($next);
            } else {
                $this->result->resolve($value);
            }
<<<<<<< HEAD
        } catch (Exception $exception) {
            $this->result->reject($exception);
=======
>>>>>>> main
        } catch (Throwable $throwable) {
            $this->result->reject($throwable);
        }
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public function _handleFailure($reason)
=======
    public function _handleFailure($reason): void
>>>>>>> main
    {
        unset($this->currentPromise);
        try {
            $nextYield = $this->generator->throw(Create::exceptionFor($reason));
            // The throw was caught, so keep iterating on the coroutine
            $this->nextCoroutine($nextYield);
<<<<<<< HEAD
        } catch (Exception $exception) {
            $this->result->reject($exception);
=======
>>>>>>> main
        } catch (Throwable $throwable) {
            $this->result->reject($throwable);
        }
    }
}
