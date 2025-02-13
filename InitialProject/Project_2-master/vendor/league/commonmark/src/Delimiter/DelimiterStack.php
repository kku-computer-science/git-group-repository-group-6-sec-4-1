<?php

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * Additional emphasis processing code based on commonmark-java (https://github.com/atlassian/commonmark-java)
 *  - (c) Atlassian Pty Ltd
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Delimiter;

<<<<<<< HEAD
use League\CommonMark\Delimiter\Processor\DelimiterProcessorCollection;
use League\CommonMark\Node\Inline\AdjacentTextMerger;
=======
use League\CommonMark\Delimiter\Processor\CacheableDelimiterProcessorInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorCollection;
use League\CommonMark\Node\Inline\AdjacentTextMerger;
use League\CommonMark\Node\Node;
>>>>>>> main

final class DelimiterStack
{
    /** @psalm-readonly-allow-private-mutation */
    private ?DelimiterInterface $top = null;

<<<<<<< HEAD
    public function push(DelimiterInterface $newDelimiter): void
    {
=======
    /** @psalm-readonly-allow-private-mutation */
    private ?Bracket $brackets = null;

    /**
     * @deprecated This property will be removed in 3.0 once all delimiters MUST have an index/position
     *
     * @var \SplObjectStorage<DelimiterInterface, int>|\WeakMap<DelimiterInterface, int>
     */
    private $missingIndexCache;


    private int $remainingDelimiters = 0;

    public function __construct(int $maximumStackSize = PHP_INT_MAX)
    {
        $this->remainingDelimiters = $maximumStackSize;

        if (\PHP_VERSION_ID >= 80000) {
            /** @psalm-suppress PropertyTypeCoercion */
            $this->missingIndexCache = new \WeakMap(); // @phpstan-ignore-line
        } else {
            $this->missingIndexCache = new \SplObjectStorage(); // @phpstan-ignore-line
        }
    }

    public function push(DelimiterInterface $newDelimiter): void
    {
        if ($this->remainingDelimiters-- <= 0) {
            return;
        }

>>>>>>> main
        $newDelimiter->setPrevious($this->top);

        if ($this->top !== null) {
            $this->top->setNext($newDelimiter);
        }

        $this->top = $newDelimiter;
    }

<<<<<<< HEAD
    private function findEarliest(?DelimiterInterface $stackBottom = null): ?DelimiterInterface
    {
        $delimiter = $this->top;
        while ($delimiter !== null && $delimiter->getPrevious() !== $stackBottom) {
            $delimiter = $delimiter->getPrevious();
        }

        return $delimiter;
=======
    /**
     * @internal
     */
    public function addBracket(Node $node, int $index, bool $image): void
    {
        if ($this->brackets !== null) {
            $this->brackets->setHasNext(true);
        }

        $this->brackets = new Bracket($node, $this->brackets, $index, $image);
    }

    /**
     * @psalm-immutable
     */
    public function getLastBracket(): ?Bracket
    {
        return $this->brackets;
    }

    private function findEarliest(int $stackBottom): ?DelimiterInterface
    {
        // Move back to first relevant delim.
        $delimiter   = $this->top;
        $lastChecked = null;

        while ($delimiter !== null && self::getIndex($delimiter) > $stackBottom) {
            $lastChecked = $delimiter;
            $delimiter   = $delimiter->getPrevious();
        }

        return $lastChecked;
    }

    /**
     * @internal
     */
    public function removeBracket(): void
    {
        if ($this->brackets === null) {
            return;
        }

        $this->brackets = $this->brackets->getPrevious();

        if ($this->brackets !== null) {
            $this->brackets->setHasNext(false);
        }
>>>>>>> main
    }

    public function removeDelimiter(DelimiterInterface $delimiter): void
    {
        if ($delimiter->getPrevious() !== null) {
            /** @psalm-suppress PossiblyNullReference */
            $delimiter->getPrevious()->setNext($delimiter->getNext());
        }

        if ($delimiter->getNext() === null) {
            // top of stack
            $this->top = $delimiter->getPrevious();
        } else {
            /** @psalm-suppress PossiblyNullReference */
            $delimiter->getNext()->setPrevious($delimiter->getPrevious());
        }
<<<<<<< HEAD
=======

        // Nullify all references from the removed delimiter to other delimiters.
        // All references to this particular delimiter in the linked list should be gone,
        // but it's possible we're still hanging on to other references to things that
        // have been (or soon will be) removed, which may interfere with efficient
        // garbage collection by the PHP runtime.
        // Explicitly releasing these references should help to avoid possible
        // segfaults like in https://bugs.php.net/bug.php?id=68606.
        $delimiter->setPrevious(null);
        $delimiter->setNext(null);

        // TODO: Remove the line below once PHP 7.4 support is dropped, as WeakMap won't hold onto the reference, making this unnecessary
        unset($this->missingIndexCache[$delimiter]);
>>>>>>> main
    }

    private function removeDelimiterAndNode(DelimiterInterface $delimiter): void
    {
        $delimiter->getInlineNode()->detach();
        $this->removeDelimiter($delimiter);
    }

    private function removeDelimitersBetween(DelimiterInterface $opener, DelimiterInterface $closer): void
    {
<<<<<<< HEAD
        $delimiter = $closer->getPrevious();
        while ($delimiter !== null && $delimiter !== $opener) {
=======
        $delimiter      = $closer->getPrevious();
        $openerPosition = self::getIndex($opener);
        while ($delimiter !== null && self::getIndex($delimiter) > $openerPosition) {
>>>>>>> main
            $previous = $delimiter->getPrevious();
            $this->removeDelimiter($delimiter);
            $delimiter = $previous;
        }
    }

<<<<<<< HEAD
    public function removeAll(?DelimiterInterface $stackBottom = null): void
    {
        while ($this->top && $this->top !== $stackBottom) {
=======
    /**
     * @param DelimiterInterface|int|null $stackBottom
     */
    public function removeAll($stackBottom = null): void
    {
        $stackBottomPosition = \is_int($stackBottom) ? $stackBottom : self::getIndex($stackBottom);

        while ($this->top && $this->getIndex($this->top) > $stackBottomPosition) {
>>>>>>> main
            $this->removeDelimiter($this->top);
        }
    }

<<<<<<< HEAD
=======
    /**
     * @deprecated This method is no longer used internally and will be removed in 3.0
     */
>>>>>>> main
    public function removeEarlierMatches(string $character): void
    {
        $opener = $this->top;
        while ($opener !== null) {
            if ($opener->getChar() === $character) {
                $opener->setActive(false);
            }

            $opener = $opener->getPrevious();
        }
    }

    /**
<<<<<<< HEAD
=======
     * @internal
     */
    public function deactivateLinkOpeners(): void
    {
        $opener = $this->brackets;
        while ($opener !== null && $opener->isActive()) {
            $opener->setActive(false);
            $opener = $opener->getPrevious();
        }
    }

    /**
     * @deprecated This method is no longer used internally and will be removed in 3.0
     *
>>>>>>> main
     * @param string|string[] $characters
     */
    public function searchByCharacter($characters): ?DelimiterInterface
    {
        if (! \is_array($characters)) {
            $characters = [$characters];
        }

        $opener = $this->top;
        while ($opener !== null) {
            if (\in_array($opener->getChar(), $characters, true)) {
                break;
            }

            $opener = $opener->getPrevious();
        }

        return $opener;
    }

<<<<<<< HEAD
    public function processDelimiters(?DelimiterInterface $stackBottom, DelimiterProcessorCollection $processors): void
    {
        $openersBottom = [];

        // Find first closer above stackBottom
        $closer = $this->findEarliest($stackBottom);

        // Move forward, looking for closers, and handling each
        while ($closer !== null) {
            $delimiterChar = $closer->getChar();

            $delimiterProcessor = $processors->getDelimiterProcessor($delimiterChar);
=======
    /**
     * @param DelimiterInterface|int|null $stackBottom
     *
     * @todo change $stackBottom to an int in 3.0
     */
    public function processDelimiters($stackBottom, DelimiterProcessorCollection $processors): void
    {
        /** @var array<string, int> $openersBottom */
        $openersBottom = [];

        $stackBottomPosition = \is_int($stackBottom) ? $stackBottom : self::getIndex($stackBottom);

        // Find first closer above stackBottom
        $closer = $this->findEarliest($stackBottomPosition);

        // Move forward, looking for closers, and handling each
        while ($closer !== null) {
            $closingDelimiterChar = $closer->getChar();

            $delimiterProcessor = $processors->getDelimiterProcessor($closingDelimiterChar);
>>>>>>> main
            if (! $closer->canClose() || $delimiterProcessor === null) {
                $closer = $closer->getNext();
                continue;
            }

<<<<<<< HEAD
=======
            if ($delimiterProcessor instanceof CacheableDelimiterProcessorInterface) {
                $openersBottomCacheKey = $delimiterProcessor->getCacheKey($closer);
            } else {
                $openersBottomCacheKey = $closingDelimiterChar;
            }

>>>>>>> main
            $openingDelimiterChar = $delimiterProcessor->getOpeningCharacter();

            $useDelims            = 0;
            $openerFound          = false;
            $potentialOpenerFound = false;
            $opener               = $closer->getPrevious();
<<<<<<< HEAD
            while ($opener !== null && $opener !== $stackBottom && $opener !== ($openersBottom[$delimiterChar] ?? null)) {
=======
            while ($opener !== null && ($openerPosition = self::getIndex($opener)) > $stackBottomPosition && $openerPosition >= ($openersBottom[$openersBottomCacheKey] ?? 0)) {
>>>>>>> main
                if ($opener->canOpen() && $opener->getChar() === $openingDelimiterChar) {
                    $potentialOpenerFound = true;
                    $useDelims            = $delimiterProcessor->getDelimiterUse($opener, $closer);
                    if ($useDelims > 0) {
                        $openerFound = true;
                        break;
                    }
                }

                $opener = $opener->getPrevious();
            }

            if (! $openerFound) {
<<<<<<< HEAD
                if (! $potentialOpenerFound) {
                    // Only do this when we didn't even have a potential
                    // opener (one that matches the character and can open).
                    // If an opener was rejected because of the number of
                    // delimiters (e.g. because of the "multiple of 3"
                    // Set lower bound for future searches for openersrule),
                    // we want to consider it next time because the number
                    // of delimiters can change as we continue processing.
                    $openersBottom[$delimiterChar] = $closer->getPrevious();
                    if (! $closer->canOpen()) {
                        // We can remove a closer that can't be an opener,
                        // once we've seen there's no matching opener.
                        $this->removeDelimiter($closer);
                    }
                }

                $closer = $closer->getNext();
=======
                // Set lower bound for future searches
                // TODO: Remove this conditional check in 3.0. It only exists to prevent behavioral BC breaks in 2.x.
                if ($potentialOpenerFound === false || $delimiterProcessor instanceof CacheableDelimiterProcessorInterface) {
                    $openersBottom[$openersBottomCacheKey] = self::getIndex($closer);
                }

                if (! $potentialOpenerFound && ! $closer->canOpen()) {
                    // We can remove a closer that can't be an opener,
                    // once we've seen there's no matching opener.
                    $next = $closer->getNext();
                    $this->removeDelimiter($closer);
                    $closer = $next;
                } else {
                    $closer = $closer->getNext();
                }

>>>>>>> main
                continue;
            }

            \assert($opener !== null);

            $openerNode = $opener->getInlineNode();
            $closerNode = $closer->getInlineNode();

            // Remove number of used delimiters from stack and inline nodes.
            $opener->setLength($opener->getLength() - $useDelims);
            $closer->setLength($closer->getLength() - $useDelims);

            $openerNode->setLiteral(\substr($openerNode->getLiteral(), 0, -$useDelims));
            $closerNode->setLiteral(\substr($closerNode->getLiteral(), 0, -$useDelims));

            $this->removeDelimitersBetween($opener, $closer);
            // The delimiter processor can re-parent the nodes between opener and closer,
            // so make sure they're contiguous already. Exclusive because we want to keep opener/closer themselves.
            AdjacentTextMerger::mergeTextNodesBetweenExclusive($openerNode, $closerNode);
            $delimiterProcessor->process($openerNode, $closerNode, $useDelims);

            // No delimiter characters left to process, so we can remove delimiter and the now empty node.
            if ($opener->getLength() === 0) {
                $this->removeDelimiterAndNode($opener);
            }

            // phpcs:disable SlevomatCodingStandard.ControlStructures.EarlyExit.EarlyExitNotUsed
            if ($closer->getLength() === 0) {
                $next = $closer->getNext();
                $this->removeDelimiterAndNode($closer);
                $closer = $next;
            }
        }

        // Remove all delimiters
<<<<<<< HEAD
        $this->removeAll($stackBottom);
=======
        $this->removeAll($stackBottomPosition);
    }

    /**
     * @internal
     */
    public function __destruct()
    {
        while ($this->top) {
            $this->removeDelimiter($this->top);
        }

        while ($this->brackets) {
            $this->removeBracket();
        }
    }

    /**
     * @deprecated This method will be dropped in 3.0 once all delimiters MUST have an index/position
     */
    private function getIndex(?DelimiterInterface $delimiter): int
    {
        if ($delimiter === null) {
            return -1;
        }

        if (($index = $delimiter->getIndex()) !== null) {
            return $index;
        }

        if (isset($this->missingIndexCache[$delimiter])) {
            return $this->missingIndexCache[$delimiter];
        }

        $prev = $delimiter->getPrevious();
        $next = $delimiter->getNext();

        $i = 0;
        do {
            $i++;
            if ($prev === null) {
                break;
            }

            if ($prev->getIndex() !== null) {
                return $this->missingIndexCache[$delimiter] = $prev->getIndex() + $i;
            }
        } while ($prev = $prev->getPrevious());

        $j = 0;
        do {
            $j++;
            if ($next === null) {
                break;
            }

            if ($next->getIndex() !== null) {
                return $this->missingIndexCache[$delimiter] = $next->getIndex() - $j;
            }
        } while ($next = $next->getNext());

        // No index was defined on this delimiter, and none could be guesstimated based on the stack.
        return $this->missingIndexCache[$delimiter] = $this->getIndex($delimiter->getPrevious()) + 1;
>>>>>>> main
    }
}
