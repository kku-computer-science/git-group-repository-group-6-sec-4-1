<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> main
namespace GuzzleHttp\Promise;

interface TaskQueueInterface
{
    /**
     * Returns true if the queue is empty.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isEmpty();
=======
     */
    public function isEmpty(): bool;
>>>>>>> main

    /**
     * Adds a task to the queue that will be executed the next time run is
     * called.
     */
<<<<<<< HEAD
    public function add(callable $task);
=======
    public function add(callable $task): void;
>>>>>>> main

    /**
     * Execute all of the pending task in the queue.
     */
<<<<<<< HEAD
    public function run();
=======
    public function run(): void;
>>>>>>> main
}
