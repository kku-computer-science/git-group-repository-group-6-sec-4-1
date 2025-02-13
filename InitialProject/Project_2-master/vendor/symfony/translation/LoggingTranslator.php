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

use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\Exception\InvalidArgumentException;
use Symfony\Contracts\Translation\LocaleAwareInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 */
class LoggingTranslator implements TranslatorInterface, TranslatorBagInterface, LocaleAwareInterface
{
<<<<<<< HEAD
    private $translator;
    private $logger;
=======
    private TranslatorInterface $translator;
    private LoggerInterface $logger;
>>>>>>> main

    /**
     * @param TranslatorInterface&TranslatorBagInterface&LocaleAwareInterface $translator The translator must implement TranslatorBagInterface
     */
    public function __construct(TranslatorInterface $translator, LoggerInterface $logger)
    {
        if (!$translator instanceof TranslatorBagInterface || !$translator instanceof LocaleAwareInterface) {
            throw new InvalidArgumentException(sprintf('The Translator "%s" must implement TranslatorInterface, TranslatorBagInterface and LocaleAwareInterface.', get_debug_type($translator)));
        }

        $this->translator = $translator;
        $this->logger = $logger;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function trans(?string $id, array $parameters = [], string $domain = null, string $locale = null)
=======
    public function trans(?string $id, array $parameters = [], ?string $domain = null, ?string $locale = null): string
>>>>>>> main
    {
        $trans = $this->translator->trans($id = (string) $id, $parameters, $domain, $locale);
        $this->log($id, $domain, $locale);

        return $trans;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * @return void
>>>>>>> main
     */
    public function setLocale(string $locale)
    {
        $prev = $this->translator->getLocale();
        $this->translator->setLocale($locale);
        if ($prev === $locale) {
            return;
        }

        $this->logger->debug(sprintf('The locale of the translator has changed from "%s" to "%s".', $prev, $locale));
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
        return $this->translator->getLocale();
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getCatalogue(string $locale = null)
=======
    public function getCatalogue(?string $locale = null): MessageCatalogueInterface
>>>>>>> main
    {
        return $this->translator->getCatalogue($locale);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function getCatalogues(): array
    {
        return $this->translator->getCatalogues();
    }

    /**
     * Gets the fallback locales.
<<<<<<< HEAD
     *
     * @return array
     */
    public function getFallbackLocales()
=======
     */
    public function getFallbackLocales(): array
>>>>>>> main
    {
        if ($this->translator instanceof Translator || method_exists($this->translator, 'getFallbackLocales')) {
            return $this->translator->getFallbackLocales();
        }

        return [];
    }

    /**
<<<<<<< HEAD
     * Passes through all unknown calls onto the translator object.
=======
     * @return mixed
>>>>>>> main
     */
    public function __call(string $method, array $args)
    {
        return $this->translator->{$method}(...$args);
    }

    /**
     * Logs for missing translations.
     */
<<<<<<< HEAD
    private function log(string $id, ?string $domain, ?string $locale)
    {
        if (null === $domain) {
            $domain = 'messages';
        }
=======
    private function log(string $id, ?string $domain, ?string $locale): void
    {
        $domain ??= 'messages';
>>>>>>> main

        $catalogue = $this->translator->getCatalogue($locale);
        if ($catalogue->defines($id, $domain)) {
            return;
        }

        if ($catalogue->has($id, $domain)) {
            $this->logger->debug('Translation use fallback catalogue.', ['id' => $id, 'domain' => $domain, 'locale' => $catalogue->getLocale()]);
        } else {
            $this->logger->warning('Translation not found.', ['id' => $id, 'domain' => $domain, 'locale' => $catalogue->getLocale()]);
        }
    }
}
