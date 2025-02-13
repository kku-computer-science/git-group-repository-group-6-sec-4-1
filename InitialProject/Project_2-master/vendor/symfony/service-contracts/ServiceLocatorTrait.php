<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Contracts\Service;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

// Help opcache.preload discover always-needed symbols
class_exists(ContainerExceptionInterface::class);
class_exists(NotFoundExceptionInterface::class);

/**
 * A trait to help implement ServiceProviderInterface.
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 * @author Nicolas Grekas <p@tchwork.com>
 */
trait ServiceLocatorTrait
{
<<<<<<< HEAD
    private $factories;
    private $loading = [];
    private $providedTypes;

    /**
     * @param callable[] $factories
=======
    private array $factories;
    private array $loading = [];
    private array $providedTypes;

    /**
     * @param array<string, callable> $factories
>>>>>>> main
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function has(string $id)
=======
    public function has(string $id): bool
>>>>>>> main
    {
        return isset($this->factories[$id]);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function get(string $id)
=======
    public function get(string $id): mixed
>>>>>>> main
    {
        if (!isset($this->factories[$id])) {
            throw $this->createNotFoundException($id);
        }

        if (isset($this->loading[$id])) {
            $ids = array_values($this->loading);
            $ids = \array_slice($this->loading, array_search($id, $ids));
            $ids[] = $id;

            throw $this->createCircularReferenceException($id, $ids);
        }

        $this->loading[$id] = $id;
        try {
            return $this->factories[$id]($this);
        } finally {
            unset($this->loading[$id]);
        }
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getProvidedServices(): array
    {
        if (null === $this->providedTypes) {
=======
    public function getProvidedServices(): array
    {
        if (!isset($this->providedTypes)) {
>>>>>>> main
            $this->providedTypes = [];

            foreach ($this->factories as $name => $factory) {
                if (!\is_callable($factory)) {
                    $this->providedTypes[$name] = '?';
                } else {
                    $type = (new \ReflectionFunction($factory))->getReturnType();

                    $this->providedTypes[$name] = $type ? ($type->allowsNull() ? '?' : '').($type instanceof \ReflectionNamedType ? $type->getName() : $type) : '?';
                }
            }
        }

        return $this->providedTypes;
    }

    private function createNotFoundException(string $id): NotFoundExceptionInterface
    {
        if (!$alternatives = array_keys($this->factories)) {
            $message = 'is empty...';
        } else {
            $last = array_pop($alternatives);
            if ($alternatives) {
                $message = sprintf('only knows about the "%s" and "%s" services.', implode('", "', $alternatives), $last);
            } else {
                $message = sprintf('only knows about the "%s" service.', $last);
            }
        }

        if ($this->loading) {
            $message = sprintf('The service "%s" has a dependency on a non-existent service "%s". This locator %s', end($this->loading), $id, $message);
        } else {
            $message = sprintf('Service "%s" not found: the current service locator %s', $id, $message);
        }

        return new class($message) extends \InvalidArgumentException implements NotFoundExceptionInterface {
        };
    }

    private function createCircularReferenceException(string $id, array $path): ContainerExceptionInterface
    {
        return new class(sprintf('Circular reference detected for service "%s", path: "%s".', $id, implode(' -> ', $path))) extends \RuntimeException implements ContainerExceptionInterface {
        };
    }
}
