<?php

namespace Illuminate\Support;

<<<<<<< HEAD
use Throwable;

=======
>>>>>>> main
class Timebox
{
    /**
     * Indicates if the timebox is allowed to return early.
     *
     * @var bool
     */
    public $earlyReturn = false;

    /**
     * Invoke the given callback within the specified timebox minimum.
     *
<<<<<<< HEAD
     * @template TCallReturnType
     *
     * @param  (callable($this): TCallReturnType)  $callback
     * @param  int  $microseconds
     * @return TCallReturnType
     *
     * @throws \Throwable
     */
    public function call(callable $callback, int $microseconds)
    {
        $exception = null;

        $start = microtime(true);

        try {
            $result = $callback($this);
        } catch (Throwable $caught) {
            $exception = $caught;
        }

        $remainder = intval($microseconds - ((microtime(true) - $start) * 1000000));
=======
     * @param  callable  $callback
     * @param  int  $microseconds
     * @return mixed
     */
    public function call(callable $callback, int $microseconds)
    {
        $start = microtime(true);

        $result = $callback($this);

        $remainder = $microseconds - ((microtime(true) - $start) * 1000000);
>>>>>>> main

        if (! $this->earlyReturn && $remainder > 0) {
            $this->usleep($remainder);
        }

<<<<<<< HEAD
        if ($exception) {
            throw $exception;
        }

=======
>>>>>>> main
        return $result;
    }

    /**
     * Indicate that the timebox can return early.
     *
     * @return $this
     */
    public function returnEarly()
    {
        $this->earlyReturn = true;

        return $this;
    }

    /**
     * Indicate that the timebox cannot return early.
     *
     * @return $this
     */
    public function dontReturnEarly()
    {
        $this->earlyReturn = false;

        return $this;
    }

    /**
     * Sleep for the specified number of microseconds.
     *
<<<<<<< HEAD
     * @param  int  $microseconds
     * @return void
     */
    protected function usleep(int $microseconds)
    {
        Sleep::usleep($microseconds);
=======
     * @param  $microseconds
     * @return void
     */
    protected function usleep($microseconds)
    {
        usleep($microseconds);
>>>>>>> main
    }
}
