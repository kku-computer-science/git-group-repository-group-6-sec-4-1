<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Formatter;

use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Contracts\Translation\TranslatorInterface;

// Help opcache.preload discover always-needed symbols
class_exists(IntlFormatter::class);

/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 */
class MessageFormatter implements MessageFormatterInterface, IntlFormatterInterface
{
<<<<<<< HEAD
    private $translator;
    private $intlFormatter;
=======
    private TranslatorInterface $translator;
    private IntlFormatterInterface $intlFormatter;
>>>>>>> main

    /**
     * @param TranslatorInterface|null $translator An identity translator to use as selector for pluralization
     */
<<<<<<< HEAD
    public function __construct(TranslatorInterface $translator = null, IntlFormatterInterface $intlFormatter = null)
=======
    public function __construct(?TranslatorInterface $translator = null, ?IntlFormatterInterface $intlFormatter = null)
>>>>>>> main
    {
        $this->translator = $translator ?? new IdentityTranslator();
        $this->intlFormatter = $intlFormatter ?? new IntlFormatter();
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function format(string $message, string $locale, array $parameters = [])
    {
        if ($this->translator instanceof TranslatorInterface) {
            return $this->translator->trans($message, $parameters, null, $locale);
        }

        return strtr($message, $parameters);
    }

    /**
     * {@inheritdoc}
     */
=======
    public function format(string $message, string $locale, array $parameters = []): string
    {
        return $this->translator->trans($message, $parameters, null, $locale);
    }

>>>>>>> main
    public function formatIntl(string $message, string $locale, array $parameters = []): string
    {
        return $this->intlFormatter->formatIntl($message, $locale, $parameters);
    }
}
