<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation;

/**
<<<<<<< HEAD
 * MetadataAwareInterface.
=======
 * This interface is used to get, set, and delete metadata about the translation messages.
>>>>>>> main
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface MetadataAwareInterface
{
    /**
     * Gets metadata for the given domain and key.
     *
     * Passing an empty domain will return an array with all metadata indexed by
     * domain and then by key. Passing an empty key will return an array with all
     * metadata for the given domain.
     *
     * @return mixed The value that was set or an array with the domains/keys or null
     */
<<<<<<< HEAD
    public function getMetadata(string $key = '', string $domain = 'messages');
=======
    public function getMetadata(string $key = '', string $domain = 'messages'): mixed;
>>>>>>> main

    /**
     * Adds metadata to a message domain.
     *
<<<<<<< HEAD
     * @param mixed $value
     */
    public function setMetadata(string $key, $value, string $domain = 'messages');
=======
     * @return void
     */
    public function setMetadata(string $key, mixed $value, string $domain = 'messages');
>>>>>>> main

    /**
     * Deletes metadata for the given key and domain.
     *
     * Passing an empty domain will delete all metadata. Passing an empty key will
     * delete all metadata for the given domain.
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> main
     */
    public function deleteMetadata(string $key = '', string $domain = 'messages');
}
