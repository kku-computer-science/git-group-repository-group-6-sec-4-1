<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * A read-only proxy for an event dispatcher.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ImmutableEventDispatcher implements EventDispatcherInterface
{
<<<<<<< HEAD
    private $dispatcher;
=======
    private EventDispatcherInterface $dispatcher;
>>>>>>> main

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function dispatch(object $event, string $eventName = null): object
=======
    public function dispatch(object $event, ?string $eventName = null): object
>>>>>>> main
    {
        return $this->dispatcher->dispatch($event, $eventName);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function addListener(string $eventName, $listener, int $priority = 0)
=======
     * @return never
     */
    public function addListener(string $eventName, callable|array $listener, int $priority = 0)
>>>>>>> main
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return never
>>>>>>> main
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function removeListener(string $eventName, $listener)
=======
     * @return never
     */
    public function removeListener(string $eventName, callable|array $listener)
>>>>>>> main
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return never
>>>>>>> main
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getListeners(string $eventName = null)
=======
    public function getListeners(?string $eventName = null): array
>>>>>>> main
    {
        return $this->dispatcher->getListeners($eventName);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getListenerPriority(string $eventName, $listener)
=======
    public function getListenerPriority(string $eventName, callable|array $listener): ?int
>>>>>>> main
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function hasListeners(string $eventName = null)
=======
    public function hasListeners(?string $eventName = null): bool
>>>>>>> main
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}
