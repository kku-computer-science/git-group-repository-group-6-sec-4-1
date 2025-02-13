<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\DataCollector\LateDataCollectorInterface;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 *
 * @final
 */
class TranslationDataCollector extends DataCollector implements LateDataCollectorInterface
{
<<<<<<< HEAD
    private $translator;
=======
    private DataCollectorTranslator $translator;
>>>>>>> main

    public function __construct(DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function lateCollect()
=======
    public function lateCollect(): void
>>>>>>> main
    {
        $messages = $this->sanitizeCollectedMessages($this->translator->getCollectedMessages());

        $this->data += $this->computeCount($messages);
        $this->data['messages'] = $messages;

        $this->data = $this->cloneVar($this->data);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Throwable $exception = null)
=======
    public function collect(Request $request, Response $response, ?\Throwable $exception = null): void
>>>>>>> main
    {
        $this->data['locale'] = $this->translator->getLocale();
        $this->data['fallback_locales'] = $this->translator->getFallbackLocales();
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function reset()
=======
    public function reset(): void
>>>>>>> main
    {
        $this->data = [];
    }

<<<<<<< HEAD
    /**
     * @return array|Data
     */
    public function getMessages()
=======
    public function getMessages(): array|Data
>>>>>>> main
    {
        return $this->data['messages'] ?? [];
    }

    public function getCountMissings(): int
    {
        return $this->data[DataCollectorTranslator::MESSAGE_MISSING] ?? 0;
    }

    public function getCountFallbacks(): int
    {
        return $this->data[DataCollectorTranslator::MESSAGE_EQUALS_FALLBACK] ?? 0;
    }

    public function getCountDefines(): int
    {
        return $this->data[DataCollectorTranslator::MESSAGE_DEFINED] ?? 0;
    }

<<<<<<< HEAD
    public function getLocale()
=======
    public function getLocale(): ?string
>>>>>>> main
    {
        return !empty($this->data['locale']) ? $this->data['locale'] : null;
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public function getFallbackLocales()
=======
    public function getFallbackLocales(): Data|array
>>>>>>> main
    {
        return (isset($this->data['fallback_locales']) && \count($this->data['fallback_locales']) > 0) ? $this->data['fallback_locales'] : [];
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> main
    public function getName(): string
    {
        return 'translation';
    }

<<<<<<< HEAD
    private function sanitizeCollectedMessages(array $messages)
=======
    private function sanitizeCollectedMessages(array $messages): array
>>>>>>> main
    {
        $result = [];
        foreach ($messages as $key => $message) {
            $messageId = $message['locale'].$message['domain'].$message['id'];

            if (!isset($result[$messageId])) {
                $message['count'] = 1;
                $message['parameters'] = !empty($message['parameters']) ? [$message['parameters']] : [];
                $messages[$key]['translation'] = $this->sanitizeString($message['translation']);
                $result[$messageId] = $message;
            } else {
                if (!empty($message['parameters'])) {
                    $result[$messageId]['parameters'][] = $message['parameters'];
                }

                ++$result[$messageId]['count'];
            }

            unset($messages[$key]);
        }

        return $result;
    }

<<<<<<< HEAD
    private function computeCount(array $messages)
=======
    private function computeCount(array $messages): array
>>>>>>> main
    {
        $count = [
            DataCollectorTranslator::MESSAGE_DEFINED => 0,
            DataCollectorTranslator::MESSAGE_MISSING => 0,
            DataCollectorTranslator::MESSAGE_EQUALS_FALLBACK => 0,
        ];

        foreach ($messages as $message) {
            ++$count[$message['state']];
        }

        return $count;
    }

<<<<<<< HEAD
    private function sanitizeString(string $string, int $length = 80)
=======
    private function sanitizeString(string $string, int $length = 80): string
>>>>>>> main
    {
        $string = trim(preg_replace('/\s+/', ' ', $string));

        if (false !== $encoding = mb_detect_encoding($string, null, true)) {
            if (mb_strlen($string, $encoding) > $length) {
                return mb_substr($string, 0, $length - 3, $encoding).'...';
            }
        } elseif (\strlen($string) > $length) {
            return substr($string, 0, $length - 3).'...';
        }

        return $string;
    }
}
