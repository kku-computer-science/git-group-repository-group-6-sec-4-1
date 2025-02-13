<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Storage;

use Symfony\Component\HttpFoundation\Request;

// Help opcache.preload discover always-needed symbols
class_exists(MockFileSessionStorage::class);

/**
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class MockFileSessionStorageFactory implements SessionStorageFactoryInterface
{
    private $savePath;
    private $name;
    private $metaBag;

    /**
     * @see MockFileSessionStorage constructor.
     */
<<<<<<< HEAD
    public function __construct(string $savePath = null, string $name = 'MOCKSESSID', MetadataBag $metaBag = null)
=======
    public function __construct(?string $savePath = null, string $name = 'MOCKSESSID', ?MetadataBag $metaBag = null)
>>>>>>> main
    {
        $this->savePath = $savePath;
        $this->name = $name;
        $this->metaBag = $metaBag;
    }

    public function createStorage(?Request $request): SessionStorageInterface
    {
        return new MockFileSessionStorage($this->savePath, $this->name, $this->metaBag);
    }
}
