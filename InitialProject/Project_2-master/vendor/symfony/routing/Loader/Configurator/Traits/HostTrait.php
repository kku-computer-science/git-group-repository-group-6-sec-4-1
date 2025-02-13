<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Loader\Configurator\Traits;

use Symfony\Component\Routing\RouteCollection;

/**
 * @internal
 */
trait HostTrait
{
    final protected function addHost(RouteCollection $routes, $hosts)
    {
        if (!$hosts || !\is_array($hosts)) {
            $routes->setHost($hosts ?: '');

            return;
        }

        foreach ($routes->all() as $name => $route) {
            if (null === $locale = $route->getDefault('_locale')) {
<<<<<<< HEAD
=======
                $priority = $routes->getPriority($name) ?? 0;
>>>>>>> main
                $routes->remove($name);
                foreach ($hosts as $locale => $host) {
                    $localizedRoute = clone $route;
                    $localizedRoute->setDefault('_locale', $locale);
                    $localizedRoute->setRequirement('_locale', preg_quote($locale));
                    $localizedRoute->setDefault('_canonical_route', $name);
                    $localizedRoute->setHost($host);
<<<<<<< HEAD
                    $routes->add($name.'.'.$locale, $localizedRoute);
=======
                    $routes->add($name.'.'.$locale, $localizedRoute, $priority);
>>>>>>> main
                }
            } elseif (!isset($hosts[$locale])) {
                throw new \InvalidArgumentException(sprintf('Route "%s" with locale "%s" is missing a corresponding host in its parent collection.', $name, $locale));
            } else {
                $route->setHost($hosts[$locale]);
                $route->setRequirement('_locale', preg_quote($locale));
<<<<<<< HEAD
                $routes->add($name, $route);
=======
                $routes->add($name, $route, $routes->getPriority($name) ?? 0);
>>>>>>> main
            }
        }
    }
}
