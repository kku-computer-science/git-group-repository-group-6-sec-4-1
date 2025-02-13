<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher\Debug;

use Psr\EventDispatcher\StoppableEventInterface;
use Psr\Log\LoggerInterface;
<<<<<<< HEAD
=======
use Symfony\Component\EventDispatcher\EventDispatcher;
>>>>>>> main
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Contracts\Service\ResetInterface;

/**
 * Collects some data about event listeners.
 *
 * This event dispatcher delegates the dispatching to another one.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableEventDispatcher implements EventDispatcherInterface, ResetInterface
{
    protected $logger;
    protected $stopwatch;

    /**
<<<<<<< HEAD
     * @var \SplObjectStorage<WrappedListener, array{string, string}>
     */
    private $callStack;
    private $dispatcher;
    private $wrappedListeners;
    private $orphanedEvents;
    private $requestStack;
    private $currentRequestHash = '';

    public function __construct(EventDispatcherInterface $dispatcher, Stopwatch $stopwatch, LoggerInterface $logger = null, RequestStack $requestStack = null)
=======
     * @var \SplObjectStorage<WrappedListener, array{string, string}>|null
     */
    private ?\SplObjectStorage $callStack = null;
    private EventDispatcherInterface $dispatcher;
    private array $wrappedListeners = [];
    private array $orphanedEvents = [];
    private ?RequestStack $requestStack;
    private string $currentRequestHash = '';

    public function __construct(EventDispatcherInterface $dispatcher, Stopwatch $stopwatch, ?LoggerInterface $logger = null, ?RequestStack $requestStack = null)
>>>>>>> main
    {
        $this->dispatcher = $dispatcher;
        $this->stopwatch = $stopwatch;
        $this->logger = $logger;
<<<<<<< HEAD
        $this->wrappedListeners = [];
        $this->orphanedEvents = [];
=======
>>>>>>> main
        $this->requestStack = $requestStack;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function addListener(string $eventName, $listener, int $priority = 0)
=======
     * @return void
     */
    public function addListener(string $eventName, callable|array $listener, int $priority = 0)
>>>>>>> main
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->addSubscriber($subscriber);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function removeListener(string $eventName, $listener)
    {
        if (isset($this->wrappedListeners[$eventName])) {
            foreach ($this->wrappedListeners[$eventName] as $index => $wrappedListener) {
                if ($wrappedListener->getWrappedListener() === $listener) {
=======
     * @return void
     */
    public function removeListener(string $eventName, callable|array $listener)
    {
        if (isset($this->wrappedListeners[$eventName])) {
            foreach ($this->wrappedListeners[$eventName] as $index => $wrappedListener) {
                if ($wrappedListener->getWrappedListener() === $listener || ($listener instanceof \Closure && $wrappedListener->getWrappedListener() == $listener)) {
>>>>>>> main
                    $listener = $wrappedListener;
                    unset($this->wrappedListeners[$eventName][$index]);
                    break;
                }
            }
        }

<<<<<<< HEAD
        return $this->dispatcher->removeListener($eventName, $listener);
    }

    /**
     * {@inheritdoc}
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        return $this->dispatcher->removeSubscriber($subscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function getListeners(string $eventName = null)
=======
        $this->dispatcher->removeListener($eventName, $listener);
    }

    /**
     * @return void
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->removeSubscriber($subscriber);
    }

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
        // we might have wrapped listeners for the event (if called while dispatching)
        // in that case get the priority by wrapper
        if (isset($this->wrappedListeners[$eventName])) {
<<<<<<< HEAD
            foreach ($this->wrappedListeners[$eventName] as $index => $wrappedListener) {
                if ($wrappedListener->getWrappedListener() === $listener) {
=======
            foreach ($this->wrappedListeners[$eventName] as $wrappedListener) {
                if ($wrappedListener->getWrappedListener() === $listener || ($listener instanceof \Closure && $wrappedListener->getWrappedListener() == $listener)) {
>>>>>>> main
                    return $this->dispatcher->getListenerPriority($eventName, $wrappedListener);
                }
            }
        }

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

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function dispatch(object $event, string $eventName = null): object
    {
        $eventName = $eventName ?? \get_class($event);

        if (null === $this->callStack) {
            $this->callStack = new \SplObjectStorage();
        }
=======
    public function dispatch(object $event, ?string $eventName = null): object
    {
        $eventName ??= $event::class;

        $this->callStack ??= new \SplObjectStorage();
>>>>>>> main

        $currentRequestHash = $this->currentRequestHash = $this->requestStack && ($request = $this->requestStack->getCurrentRequest()) ? spl_object_hash($request) : '';

        if (null !== $this->logger && $event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
            $this->logger->debug(sprintf('The "%s" event is already stopped. No listeners have been called.', $eventName));
        }

        $this->preProcess($eventName);
        try {
            $this->beforeDispatch($eventName, $event);
            try {
                $e = $this->stopwatch->start($eventName, 'section');
                try {
                    $this->dispatcher->dispatch($event, $eventName);
                } finally {
                    if ($e->isStarted()) {
                        $e->stop();
                    }
                }
            } finally {
                $this->afterDispatch($eventName, $event);
            }
        } finally {
            $this->currentRequestHash = $currentRequestHash;
            $this->postProcess($eventName);
        }

        return $event;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function getCalledListeners(Request $request = null)
=======
    public function getCalledListeners(?Request $request = null): array
>>>>>>> main
    {
        if (null === $this->callStack) {
            return [];
        }

        $hash = $request ? spl_object_hash($request) : null;
        $called = [];
        foreach ($this->callStack as $listener) {
            [$eventName, $requestHash] = $this->callStack->getInfo();
            if (null === $hash || $hash === $requestHash) {
                $called[] = $listener->getInfo($eventName);
            }
        }

        return $called;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function getNotCalledListeners(Request $request = null)
    {
        try {
            $allListeners = $this->getListeners();
        } catch (\Exception $e) {
            if (null !== $this->logger) {
                $this->logger->info('An exception was thrown while getting the uncalled listeners.', ['exception' => $e]);
            }
=======
    public function getNotCalledListeners(?Request $request = null): array
    {
        try {
            $allListeners = $this->dispatcher instanceof EventDispatcher ? $this->getListenersWithPriority() : $this->getListenersWithoutPriority();
        } catch (\Exception $e) {
            $this->logger?->info('An exception was thrown while getting the uncalled listeners.', ['exception' => $e]);
>>>>>>> main

            // unable to retrieve the uncalled listeners
            return [];
        }

        $hash = $request ? spl_object_hash($request) : null;
        $calledListeners = [];

        if (null !== $this->callStack) {
            foreach ($this->callStack as $calledListener) {
                [, $requestHash] = $this->callStack->getInfo();

                if (null === $hash || $hash === $requestHash) {
                    $calledListeners[] = $calledListener->getWrappedListener();
                }
            }
        }

        $notCalled = [];
<<<<<<< HEAD
        foreach ($allListeners as $eventName => $listeners) {
            foreach ($listeners as $listener) {
                if (!\in_array($listener, $calledListeners, true)) {
                    if (!$listener instanceof WrappedListener) {
                        $listener = new WrappedListener($listener, null, $this->stopwatch, $this);
=======

        foreach ($allListeners as $eventName => $listeners) {
            foreach ($listeners as [$listener, $priority]) {
                if (!\in_array($listener, $calledListeners, true)) {
                    if (!$listener instanceof WrappedListener) {
                        $listener = new WrappedListener($listener, null, $this->stopwatch, $this, $priority);
>>>>>>> main
                    }
                    $notCalled[] = $listener->getInfo($eventName);
                }
            }
        }

<<<<<<< HEAD
        uasort($notCalled, [$this, 'sortNotCalledListeners']);
=======
        uasort($notCalled, $this->sortNotCalledListeners(...));
>>>>>>> main

        return $notCalled;
    }

<<<<<<< HEAD
    public function getOrphanedEvents(Request $request = null): array
=======
    public function getOrphanedEvents(?Request $request = null): array
>>>>>>> main
    {
        if ($request) {
            return $this->orphanedEvents[spl_object_hash($request)] ?? [];
        }

        if (!$this->orphanedEvents) {
            return [];
        }

        return array_merge(...array_values($this->orphanedEvents));
    }

<<<<<<< HEAD
=======
    /**
     * @return void
     */
>>>>>>> main
    public function reset()
    {
        $this->callStack = null;
        $this->orphanedEvents = [];
        $this->currentRequestHash = '';
    }

    /**
     * Proxies all method calls to the original event dispatcher.
     *
     * @param string $method    The method name
     * @param array  $arguments The method arguments
<<<<<<< HEAD
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
=======
     */
    public function __call(string $method, array $arguments): mixed
>>>>>>> main
    {
        return $this->dispatcher->{$method}(...$arguments);
    }

    /**
     * Called before dispatching the event.
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> main
     */
    protected function beforeDispatch(string $eventName, object $event)
    {
    }

    /**
     * Called after dispatching the event.
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> main
     */
    protected function afterDispatch(string $eventName, object $event)
    {
    }

    private function preProcess(string $eventName): void
    {
        if (!$this->dispatcher->hasListeners($eventName)) {
            $this->orphanedEvents[$this->currentRequestHash][] = $eventName;

            return;
        }

        foreach ($this->dispatcher->getListeners($eventName) as $listener) {
            $priority = $this->getListenerPriority($eventName, $listener);
            $wrappedListener = new WrappedListener($listener instanceof WrappedListener ? $listener->getWrappedListener() : $listener, null, $this->stopwatch, $this);
            $this->wrappedListeners[$eventName][] = $wrappedListener;
            $this->dispatcher->removeListener($eventName, $listener);
            $this->dispatcher->addListener($eventName, $wrappedListener, $priority);
            $this->callStack->attach($wrappedListener, [$eventName, $this->currentRequestHash]);
        }
    }

    private function postProcess(string $eventName): void
    {
        unset($this->wrappedListeners[$eventName]);
        $skipped = false;
        foreach ($this->dispatcher->getListeners($eventName) as $listener) {
            if (!$listener instanceof WrappedListener) { // #12845: a new listener was added during dispatch.
                continue;
            }
            // Unwrap listener
            $priority = $this->getListenerPriority($eventName, $listener);
            $this->dispatcher->removeListener($eventName, $listener);
            $this->dispatcher->addListener($eventName, $listener->getWrappedListener(), $priority);

            if (null !== $this->logger) {
                $context = ['event' => $eventName, 'listener' => $listener->getPretty()];
            }

            if ($listener->wasCalled()) {
<<<<<<< HEAD
                if (null !== $this->logger) {
                    $this->logger->debug('Notified event "{event}" to listener "{listener}".', $context);
                }
=======
                $this->logger?->debug('Notified event "{event}" to listener "{listener}".', $context);
>>>>>>> main
            } else {
                $this->callStack->detach($listener);
            }

            if (null !== $this->logger && $skipped) {
                $this->logger->debug('Listener "{listener}" was not called for event "{event}".', $context);
            }

            if ($listener->stoppedPropagation()) {
<<<<<<< HEAD
                if (null !== $this->logger) {
                    $this->logger->debug('Listener "{listener}" stopped propagation of the event "{event}".', $context);
                }
=======
                $this->logger?->debug('Listener "{listener}" stopped propagation of the event "{event}".', $context);
>>>>>>> main

                $skipped = true;
            }
        }
    }

<<<<<<< HEAD
    private function sortNotCalledListeners(array $a, array $b)
=======
    private function sortNotCalledListeners(array $a, array $b): int
>>>>>>> main
    {
        if (0 !== $cmp = strcmp($a['event'], $b['event'])) {
            return $cmp;
        }

        if (\is_int($a['priority']) && !\is_int($b['priority'])) {
            return 1;
        }

        if (!\is_int($a['priority']) && \is_int($b['priority'])) {
            return -1;
        }

        if ($a['priority'] === $b['priority']) {
            return 0;
        }

        if ($a['priority'] > $b['priority']) {
            return -1;
        }

        return 1;
    }
<<<<<<< HEAD
=======

    private function getListenersWithPriority(): array
    {
        $result = [];

        $allListeners = new \ReflectionProperty(EventDispatcher::class, 'listeners');

        foreach ($allListeners->getValue($this->dispatcher) as $eventName => $listenersByPriority) {
            foreach ($listenersByPriority as $priority => $listeners) {
                foreach ($listeners as $listener) {
                    $result[$eventName][] = [$listener, $priority];
                }
            }
        }

        return $result;
    }

    private function getListenersWithoutPriority(): array
    {
        $result = [];

        foreach ($this->getListeners() as $eventName => $listeners) {
            foreach ($listeners as $listener) {
                $result[$eventName][] = [$listener, null];
            }
        }

        return $result;
    }
>>>>>>> main
}
