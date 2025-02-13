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

use Symfony\Component\Config\Resource\ResourceInterface;
use Symfony\Component\Translation\Exception\LogicException;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
class MessageCatalogue implements MessageCatalogueInterface, MetadataAwareInterface
{
    private $messages = [];
    private $metadata = [];
    private $resources = [];
    private $locale;
    private $fallbackCatalogue;
    private $parent;
=======
class MessageCatalogue implements MessageCatalogueInterface, MetadataAwareInterface, CatalogueMetadataAwareInterface
{
    private array $messages = [];
    private array $metadata = [];
    private array $catalogueMetadata = [];
    private array $resources = [];
    private string $locale;
    private ?MessageCatalogueInterface $fallbackCatalogue = null;
    private ?self $parent = null;
>>>>>>> main

    /**
     * @param array $messages An array of messages classified by domain
     */
    public function __construct(string $locale, array $messages = [])
    {
        $this->locale = $locale;
        $this->messages = $messages;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getLocale()
=======
    public function getLocale(): string
>>>>>>> main
    {
        return $this->locale;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getDomains()
=======
    public function getDomains(): array
>>>>>>> main
    {
        $domains = [];

        foreach ($this->messages as $domain => $messages) {
            if (str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
                $domain = substr($domain, 0, -\strlen(self::INTL_DOMAIN_SUFFIX));
            }
            $domains[$domain] = $domain;
        }

        return array_values($domains);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function all(string $domain = null)
=======
    public function all(?string $domain = null): array
>>>>>>> main
    {
        if (null !== $domain) {
            // skip messages merge if intl-icu requested explicitly
            if (str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
                return $this->messages[$domain] ?? [];
            }

            return ($this->messages[$domain.self::INTL_DOMAIN_SUFFIX] ?? []) + ($this->messages[$domain] ?? []);
        }

        $allMessages = [];

        foreach ($this->messages as $domain => $messages) {
            if (str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
                $domain = substr($domain, 0, -\strlen(self::INTL_DOMAIN_SUFFIX));
                $allMessages[$domain] = $messages + ($allMessages[$domain] ?? []);
            } else {
                $allMessages[$domain] = ($allMessages[$domain] ?? []) + $messages;
            }
        }

        return $allMessages;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function set(string $id, string $translation, string $domain = 'messages')
    {
        $this->add([$id => $translation], $domain);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function has(string $id, string $domain = 'messages')
=======
    public function has(string $id, string $domain = 'messages'): bool
>>>>>>> main
    {
        if (isset($this->messages[$domain][$id]) || isset($this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id])) {
            return true;
        }

        if (null !== $this->fallbackCatalogue) {
            return $this->fallbackCatalogue->has($id, $domain);
        }

        return false;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function defines(string $id, string $domain = 'messages')
=======
    public function defines(string $id, string $domain = 'messages'): bool
>>>>>>> main
    {
        return isset($this->messages[$domain][$id]) || isset($this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id]);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function get(string $id, string $domain = 'messages')
=======
    public function get(string $id, string $domain = 'messages'): string
>>>>>>> main
    {
        if (isset($this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id])) {
            return $this->messages[$domain.self::INTL_DOMAIN_SUFFIX][$id];
        }

        if (isset($this->messages[$domain][$id])) {
            return $this->messages[$domain][$id];
        }

        if (null !== $this->fallbackCatalogue) {
            return $this->fallbackCatalogue->get($id, $domain);
        }

        return $id;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function replace(array $messages, string $domain = 'messages')
    {
        unset($this->messages[$domain], $this->messages[$domain.self::INTL_DOMAIN_SUFFIX]);

        $this->add($messages, $domain);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function add(array $messages, string $domain = 'messages')
    {
        if (!isset($this->messages[$domain])) {
            $this->messages[$domain] = [];
        }
        $intlDomain = $domain;
        if (!str_ends_with($domain, self::INTL_DOMAIN_SUFFIX)) {
            $intlDomain .= self::INTL_DOMAIN_SUFFIX;
        }
        foreach ($messages as $id => $message) {
            if (isset($this->messages[$intlDomain]) && \array_key_exists($id, $this->messages[$intlDomain])) {
                $this->messages[$intlDomain][$id] = $message;
            } else {
                $this->messages[$domain][$id] = $message;
            }
=======
     * @return void
     */
    public function add(array $messages, string $domain = 'messages')
    {
        $altDomain = str_ends_with($domain, self::INTL_DOMAIN_SUFFIX) ? substr($domain, 0, -\strlen(self::INTL_DOMAIN_SUFFIX)) : $domain.self::INTL_DOMAIN_SUFFIX;
        foreach ($messages as $id => $message) {
            unset($this->messages[$altDomain][$id]);
            $this->messages[$domain][$id] = $message;
        }

        if ([] === ($this->messages[$altDomain] ?? null)) {
            unset($this->messages[$altDomain]);
>>>>>>> main
        }
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function addCatalogue(MessageCatalogueInterface $catalogue)
    {
        if ($catalogue->getLocale() !== $this->locale) {
            throw new LogicException(sprintf('Cannot add a catalogue for locale "%s" as the current locale for this catalogue is "%s".', $catalogue->getLocale(), $this->locale));
        }

        foreach ($catalogue->all() as $domain => $messages) {
            if ($intlMessages = $catalogue->all($domain.self::INTL_DOMAIN_SUFFIX)) {
                $this->add($intlMessages, $domain.self::INTL_DOMAIN_SUFFIX);
                $messages = array_diff_key($messages, $intlMessages);
            }
            $this->add($messages, $domain);
        }

        foreach ($catalogue->getResources() as $resource) {
            $this->addResource($resource);
        }

        if ($catalogue instanceof MetadataAwareInterface) {
            $metadata = $catalogue->getMetadata('', '');
            $this->addMetadata($metadata);
        }
<<<<<<< HEAD
    }

    /**
     * {@inheritdoc}
=======

        if ($catalogue instanceof CatalogueMetadataAwareInterface) {
            $catalogueMetadata = $catalogue->getCatalogueMetadata('', '');
            $this->addCatalogueMetadata($catalogueMetadata);
        }
    }

    /**
     * @return void
>>>>>>> main
     */
    public function addFallbackCatalogue(MessageCatalogueInterface $catalogue)
    {
        // detect circular references
        $c = $catalogue;
        while ($c = $c->getFallbackCatalogue()) {
            if ($c->getLocale() === $this->getLocale()) {
                throw new LogicException(sprintf('Circular reference detected when adding a fallback catalogue for locale "%s".', $catalogue->getLocale()));
            }
        }

        $c = $this;
        do {
            if ($c->getLocale() === $catalogue->getLocale()) {
                throw new LogicException(sprintf('Circular reference detected when adding a fallback catalogue for locale "%s".', $catalogue->getLocale()));
            }

            foreach ($catalogue->getResources() as $resource) {
                $c->addResource($resource);
            }
        } while ($c = $c->parent);

        $catalogue->parent = $this;
        $this->fallbackCatalogue = $catalogue;

        foreach ($catalogue->getResources() as $resource) {
            $this->addResource($resource);
        }
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getFallbackCatalogue()
=======
    public function getFallbackCatalogue(): ?MessageCatalogueInterface
>>>>>>> main
    {
        return $this->fallbackCatalogue;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getResources()
=======
    public function getResources(): array
>>>>>>> main
    {
        return array_values($this->resources);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function addResource(ResourceInterface $resource)
    {
        $this->resources[$resource->__toString()] = $resource;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getMetadata(string $key = '', string $domain = 'messages')
=======
    public function getMetadata(string $key = '', string $domain = 'messages'): mixed
>>>>>>> main
    {
        if ('' == $domain) {
            return $this->metadata;
        }

        if (isset($this->metadata[$domain])) {
            if ('' == $key) {
                return $this->metadata[$domain];
            }

            if (isset($this->metadata[$domain][$key])) {
                return $this->metadata[$domain][$key];
            }
        }

        return null;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function setMetadata(string $key, $value, string $domain = 'messages')
=======
     * @return void
     */
    public function setMetadata(string $key, mixed $value, string $domain = 'messages')
>>>>>>> main
    {
        $this->metadata[$domain][$key] = $value;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function deleteMetadata(string $key = '', string $domain = 'messages')
    {
        if ('' == $domain) {
            $this->metadata = [];
        } elseif ('' == $key) {
            unset($this->metadata[$domain]);
        } else {
            unset($this->metadata[$domain][$key]);
        }
    }

<<<<<<< HEAD
=======
    public function getCatalogueMetadata(string $key = '', string $domain = 'messages'): mixed
    {
        if (!$domain) {
            return $this->catalogueMetadata;
        }

        if (isset($this->catalogueMetadata[$domain])) {
            if (!$key) {
                return $this->catalogueMetadata[$domain];
            }

            if (isset($this->catalogueMetadata[$domain][$key])) {
                return $this->catalogueMetadata[$domain][$key];
            }
        }

        return null;
    }

    /**
     * @return void
     */
    public function setCatalogueMetadata(string $key, mixed $value, string $domain = 'messages')
    {
        $this->catalogueMetadata[$domain][$key] = $value;
    }

    /**
     * @return void
     */
    public function deleteCatalogueMetadata(string $key = '', string $domain = 'messages')
    {
        if (!$domain) {
            $this->catalogueMetadata = [];
        } elseif (!$key) {
            unset($this->catalogueMetadata[$domain]);
        } else {
            unset($this->catalogueMetadata[$domain][$key]);
        }
    }

>>>>>>> main
    /**
     * Adds current values with the new values.
     *
     * @param array $values Values to add
     */
<<<<<<< HEAD
    private function addMetadata(array $values)
=======
    private function addMetadata(array $values): void
>>>>>>> main
    {
        foreach ($values as $domain => $keys) {
            foreach ($keys as $key => $value) {
                $this->setMetadata($key, $value, $domain);
            }
        }
    }
<<<<<<< HEAD
=======

    private function addCatalogueMetadata(array $values): void
    {
        foreach ($values as $domain => $keys) {
            foreach ($keys as $key => $value) {
                $this->setCatalogueMetadata($key, $value, $domain);
            }
        }
    }
>>>>>>> main
}
